<?php
	use Illuminate\Support\Facades\DB;
    $html='';
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

function formateData($result)
{
    $arr = [];
    foreach ($result as $row) {
        $arr[$row->id]['category_name'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_category_id;
        $arr[$row->id]['category_slug'] = $row->category_slug;
    }

   return buildTreeView($arr, 0);
}
function getTopNavCat()
{
    $result = DB::table('categories')
                ->where(['status'=>1])
                ->get();
    $str = formateData($result);
    return $str;
}

function buildTreeView($arr, $parent_id, $level=0, $prelevel=-1)
{
    global $html;
    foreach($arr as $id=>$data)
    {
        if($parent_id==$data['parent_id'])
        {
            if($level > $prelevel)
            {
                if($html=='') {
                    $html .= '<ul class="nav navbar-nav">';
                }else{
                    $html.='<ul class="dropdown-menu">';
                }
            }
            if($level == $prelevel)
            {
                $html.="</li>";
            }
            $_url = url('category/'.$data['category_slug']);
                $html.='<li><a href="'.$_url.'">'.$data['category_name'].'<span class="caret"></span></a>';
            if($level > $prelevel)
            {
                $prelevel = $level;
            }
            $level++;
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }
    if($level==$prelevel)
    {
        $html.="</li></ul>";
    }
    return $html;
}

    function getUserTempId()
    {
        if(session()->has('USER_TEMP_ID')==null)
        {
            $rand = rand(111111111,999999999);
            session()->put('USER_TEMP_ID', $rand);
            return $rand;
        }else{
            return session()->get('USER_TEMP_ID');
        }
    }

    function getCardData()
    {
        if(session()->has('FRONT_USER_LOGIN'))
        {
            $uid = session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }else{
            $uid = getUserTempId();
            $user_type="Non-Reg";
        }

        $result =
            DB::table('cart')
                ->leftJoin('products', 'products.id', '=', 'cart.product_id')
                ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->select('cart.id','cart.qty','products.name','products.id as pid','products.image','products.slug','product_attr.price','product_attr.id as attr_id','sizes.size','colors.color')
                ->get();
        //prx($result['carts']);
        return $result;
    }

    function get_coupon_code_val($coupon_code)
    {
        $total_price = 0;
        $totalPrice = 0;
         $coupon_code_cd = 0;
         $coupon_code_value = 0;
        $result=DB::table('coupons')
            ->where(['code'=>$coupon_code])
            ->get();
            
       
        if(isset($result[0]))    
        {
            $value = $result[0]->value;
            $type = $result[0]->type;

            $coupon_code_cd = $result[0]->code;
            if($result[0]->status==1)
            {
                if($result[0]->is_one_time==1){
                    $status = "error";
                    $msg = "Coupon Code Alrady Used";
                }else{
                    $min_order_amt = $result[0]->min_order_amt;
                    if($min_order_amt>0 || 2==2)
                    {
                        $getCardData = getCardData();
                       
                        foreach($getCardData as $data)
                        {
                            $totalPrice = $totalPrice+($data->price*$data->qty);
                        }
                        if($min_order_amt < $totalPrice)
                        {
                            $status = "success";
                            $msg = "Coupon Code Applied";
                        }else{
                            $status = "error";
                            $msg = "Cart amount must be greater than ".$min_order_amt;
                        }
                    }else{
                        $status = "success";
                        $msg = "Coupon Code Available";
                    }
                }
            }else{
                $status = "error";
                $msg = "Coupon Code deactivated";
            }
        }else{
            $status = "error";
            $msg = "Please enter valid coupon code";
        }
        $coupon_code_value=0;
        if($status == "success")
        {
            if($type=="Value")
            {
                $totalPrice = $totalPrice-$value;
                $coupon_code_value = $value;
            }
            if($type=="Per")
            {
                $newPrice = ($value/100)*$totalPrice;
                $totalPrice = $total_price - $newPrice;
                $coupon_code_value = $newPrice;
            }
        }
        return json_encode(['status'=>$status, 'msg'=>$msg, 'totalPrice'=>$totalPrice, 'coupon_code'=>$coupon_code_cd, 'coupon_code_value'=>$coupon_code_value]);
    }
?>
