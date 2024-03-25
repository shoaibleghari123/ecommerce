<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Crypt;
use Mail;
class FrontController extends Controller
{

    public function send_mail()
    {
        $is_rand = rand(111111111,999999999);
        $data = ['name'=>'Shoaib Leghari', 'data'=>'Hello Shoaib', 'is_rand'=>$is_rand];
        $user['to']='shoaibsaqib2013@gmail.com';
        Mail::send('front/test_email', $data, function($message) use ($user){
            $message->to($user['to']);
            $message->subject('Hello Dev');
        });

    }
    public function index(Request $request)
    {
        //get item form modal with order by clause
        //return Item::orderBy('created_at', 'DESC')->get();


        $result['home_categories'] =
            DB::table('categories')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();

        foreach($result['home_categories'] as $list){
          $result['home_categories_product'][$list->id] =
              DB::table('products')
              ->where(['status'=>1])
              ->where(['category_id'=>$list->id])
              ->get();

          foreach($result['home_categories_product'][$list->id] as $hcp){
            $result['home_product_attr'][$hcp->id] =
                DB::table('product_attr')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.product_id'=>$hcp->id])
                ->get();
          }
        }

        $result['home_brand'] = DB::table('brands')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();

      $result['home_featured_product'][$list->id] =
              DB::table('products')
              ->where(['status'=>1])
              ->where(['is_featured'=>1])
              ->get();

        foreach($result['home_featured_product'][$list->id] as $fpa){
          $result['home_featured_product_attr'][$fpa->id] =
              DB::table('product_attr')
              ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
              ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
              ->where(['product_attr.product_id'=>$fpa->id])
              ->get();
        }

        $result['home_tranding_product'][$list->id] =
              DB::table('products')
              ->where(['status'=>1])
              ->where(['is_tranding'=>1])
              ->get();

        foreach($result['home_tranding_product'][$list->id] as $tpa){
          $result['home_tranding_product_attr'][$tpa->id] =
              DB::table('product_attr')
              ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
              ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
              ->where(['product_attr.product_id'=>$tpa->id])
              ->get();
        }

        $result['home_discounted_product'][$list->id] =
              DB::table('products')
              ->where(['status'=>1])
              ->where(['is_discounted'=>1])
              ->get();

        foreach($result['home_discounted_product'][$list->id] as $hdp){
          $result['home_discounted_product_attr'][$hdp->id] =
              DB::table('product_attr')
              ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
              ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
              ->where(['product_attr.product_id'=>$hdp->id])
              ->get();
        }

        $result['home_banners'] = DB::table('home_banners')
                ->where(['status'=>1])
                ->get();
       return view('front.index', $result);
    }

    public function product(Request $request, $slug)
    {

      $result['product'] =
            DB::table('products')
            ->where(['status'=>1])
            ->where(['slug'=>$slug])
            ->get();

      foreach($result['product'] as $tpa){
        $result['product_attr'][$tpa->id] =
            DB::table('product_attr')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['product_attr.product_id'=>$tpa->id])
            ->get();

      }

      $result['product_images'] =
            DB::table('product_images')
            ->where(['product_id'=>$result['product'][0]->id])
            ->get();


      $result['related_product'] =
          DB::table('products')
          ->where(['status'=>1])
          ->where('slug','!=',$slug)
          ->where(['category_id'=>$result['product'][0]->category_id])
          ->get();

      foreach($result['related_product'] as $rp){
        $result['related_product_attr'][$rp->id] =
            DB::table('product_attr')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['product_attr.product_id'=>$rp->id])
            ->get();

      }
      return view('front.product', $result);
    }

    public function add_to_cart(request $request)
    {
       if($request->session()->has('FRONT_USER_LOGIN'))
       {
           $uid = $request->session()->get('FRONT_USER_ID');
           $user_type="Reg";
       }else{
           $uid = getUserTempId();
           $user_type="Non-Reg";
       }
       $size_id=$request->post('size_id');
       $color_id=$request->post('color_id');
       $product_id=$request->post('product_id');
       $pqty=$request->post('pqty');

        $product_attr_id =
            DB::table('product_attr')
                ->select('product_attr.id')
                ->Join('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->Join('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where('sizes.size','=',$size_id)
                ->where('colors.color','=',$color_id)
                ->where('product_attr.product_id','=',$product_id)
                ->get();
        $product_attr_id= $product_attr_id[0]->id;
        $check = DB::table('cart')
                    ->where(['user_id'=>$uid])
                    ->where(['user_type'=>$user_type])
                    ->where(['product_id'=>$product_id])
                    ->where(['product_attr_id'=>$product_attr_id])
                    ->get();

        if(isset($check[0]))
        {
            if($pqty==0){
                $update_id = $check[0]->id;
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->delete();
                $msg = "Remove";
            }else{
                $update_id = $check[0]->id;
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$pqty]);
                $msg = "Update";
            }

        }else{
            $id = DB::table('cart')->insertGetId([
                    'user_id'=>$uid,
                    'user_type'=>$user_type,
                    'product_id'=>$product_id,
                    'product_attr_id'=>$product_attr_id,
                    'qty'=>$pqty,
                    'added_on'=>date('Y-m-d h:i:s'),
                ]);
            $msg = "Inserted";
        }

        $data = DB::table('cart')
                ->leftJoin('products', 'products.id', '=', 'cart.product_id')
                ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->select('cart.id','cart.qty','products.name','products.id as pid','products.image','products.slug','product_attr.price','product_attr.id as attr_id','sizes.size','colors.color')
                ->get();

           $totalItem=count($data);
        return response()->json(['msg'=>$msg, 'data'=>$data, 'total'=>$totalItem]);
    }

    public function cart(request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN'))
        {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }else{
            $uid = getUserTempId();
            $user_type="Non-Reg";
        }
        $result['carts'] =
            DB::table('cart')
                ->leftJoin('products', 'products.id', '=', 'cart.product_id')
                ->leftJoin('product_attr', 'product_attr.id', '=', 'cart.product_attr_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->select('cart.id','cart.qty','products.name','products.id as pid','products.image','products.slug','product_attr.price','product_attr.id as attr_id','sizes.size','colors.color')
                ->get();
           // prx($result['carts']);    
        return view('front.cart', $result);
    }

    public function category(request $request, $slug)
    {
        $sort='';
        $sort_txt='';
        $start_price_filter='';
        $end_price_filter='';
        $color_res='';
        $colorArr = [];
        $colorArrFilter=[];
        $color='';
        $cat_select='';

        if($request->get('sort')!==null)
        {
            $sort = $request->get('sort');
        }

                $query = DB::table('products');
                $query= $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
                $query= $query->leftJoin('product_attr', 'product_attr.product_id', '=', 'products.id');
                $query= $query->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id');
                $query = $query->where(['products.status'=>1]);
                $query = $query->where(['categories.category_slug'=>$slug]);
                if($sort=='name')
                {
                    $query = $query->orderBy('products.name', 'asc');
                    $sort_txt = "Product Name";
                }
                if($sort=='date')
                {
                    $query = $query->orderBy('products.id', 'desc');
                    $sort_txt = "Date";
                }
                if($sort=='price_desc')
                {
                    $query = $query->orderBy('product_attr.price', 'desc');
                    $sort_txt = "Price - DESC";
                }
                if($sort=='price_asc')
                {
                    $query = $query->orderBy('product_attr.price', 'asc');
                    $sort_txt = "Price - ASC";
                }
                if($request->get('lower_price_filter')!==null && $request->get('end_price_filter')!==null)
                {
                    $start_price_filter = $request->get('lower_price_filter');
                    $end_price_filter = $request->get('end_price_filter');
                    if($start_price_filter > 0 && $end_price_filter > 0 )
                    {
                        $query = $query->whereBetween('product_attr.price',[$start_price_filter, $end_price_filter]);
                    }
                }
                if($request->get('color_filter')!==null)
                {
                    $color_res = $request->get('color_filter');
                    $colorArr = explode(':', $color_res);
                    $colorArrFilter = array_filter($colorArr);
                   $query = $query->where(['product_attr.color_id'=>$colorArrFilter]);
                }
                
                $query = $query->distinct()->select('categories.id as cat_id','categories.category_name as cat_name','products.name','products.id as pid','products.slug','products.image');
                $query = $query->get();
                $result['products']=$query;

        foreach($result['products'] as $product) {
            $query = DB::table('product_attr');
            $query = $query->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query = $query->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query = $query->where(['product_attr.product_id' => $product->pid]);
            $query = $query->get();
            $result['product_attr'][$product->pid] = $query;
        }

        $result['colors'] = DB::table('colors')
                            ->where(['status' => 1])
                            ->get();

        $result['categories_left'] = DB::table('categories')
                            ->where(['status' => 1])
                            ->get();
        $result['sort_val']=$sort;
        $result['sort_txt']=$sort_txt;
        $result['color_selected']=$color_res;
        $result['color_filter']=$colorArrFilter;
        $result['slug']=$slug;
 
        $result['start_price_filter']=$start_price_filter;
        $result['end_price_filter']=$end_price_filter;
        return view('front.category', $result);
    }

    public function search(request $request, $str)
    {
            $query = DB::table('products');
                $query= $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
                $query= $query->leftJoin('product_attr', 'product_attr.product_id', '=', 'products.id');
                $query = $query->where(['products.status'=>1]);
                $query = $query->where('name','like',"%$str%");
                $query = $query->orwhere('model','like',"%$str%");
                $query = $query->orwhere('short_desc','like',"%$str%");
                $query = $query->orwhere('desc','like',"%$str%");
                $query = $query->orwhere('keywords','like',"%$str%");
                $query = $query->orwhere('technical_specification','like',"%$str%");
               
              
                $query = $query->distinct()->select('categories.id as cat_id','categories.category_name as cat_name','products.name','products.id as pid','products.slug','products.image');
                $query = $query->get();
                $result['products']=$query;

        foreach($result['products'] as $product) {
            $query = DB::table('product_attr');
            $query = $query->leftJoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query = $query->leftJoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query = $query->where(['product_attr.product_id' => $product->pid]);
            $query = $query->get();
            $result['product_attr'][$product->pid] = $query;
        }
      return view('front.search', $result);
    }

    public function login_process(request $request)
    {
        $status='';
        $msg = '';
            $result=DB::table('customers')
                ->where(['email'=>$request->str_login_email])
                ->get();
        if(isset($result[0]))
        {
            $db_pwd = decrypt($result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_verify;

            $is_verify = 1;
            $status = 1;
            if($is_verify==0)
            {
                return response()->json(['status'=>'error', 'msg'=>'Verify your email id']);
            }
            if($status==0)
            {
                return response()->json(['status'=>'error', 'msg'=>'Your account has been deactivated']);
            }

            if($request->str_login_password == $db_pwd)//$db_pwd
            {
                if($request->rememberme != null)
                {
                    /*
                    minutes = 60, seconds=60, hours=24, days=365 total equal to 1 year
                    time()+60*60*24*365
                    minutes = 60, seconds=60, hours=24, days=100 total equal 100 days
                    time()+60*60*24*100
                    */
                    setcookie('login_email', $request->str_login_email, time()+60*60*24*100);
                    setcookie('login_pwd', $request->str_login_password, time()+60*60*24*100);
                }else{
                    setcookie('login_email', 100);
                    setcookie('login_pwd', 100);
                }
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $status='success';
                $msg = '';

                $get_temp_user_id = getUserTempId();
                    $result=DB::table('cart')
                        ->where(['user_id'=>$get_temp_user_id, 'user_type'=>'Non-Reg'])
                        ->update(['user_id'=>$result[0]->id, 'user_type'=>'Reg']);

            }else{
                echo "password else";
                $status='error';
                $msg = 'Enter valid password';
            }
        }else{
            $status='error';
            $msg = 'Email does not exists';
        }
        
        
        return response()->json(['status'=>$status, 'msg'=>$msg]);
    }

    public function registration(request $request)
    {
        $result=[];
        if($request->session()->has('FRONT_USER_LOGIN') != null)
            {
                return redirect('/');
            }
            return view('front.registration', $result);
    }
    public function register(request $request)
    {
        $result = [];
        if($_POST)
        {
            $valid = validator::make($request->all(),
                [
                'name'  =>  'required',
                'email'  =>  'required|email|unique:customers,email',
                'mobile'  =>  'required|numeric|digits:10',
                'password'  =>  'required',
                ]
            );

            if(!$valid->passes())
            {
               return response()->json(['status'=>'error', 'error'=>$valid->errors()]);
            }
            else{
                $is_rand = rand(111111111,999999999);
                $arr = [
                    "name"  =>  $request->name,
                    "email"  =>  $request->email,
                    "mobile"  =>  $request->mobile,
                    "password"  =>  Crypt::encrypt($request->password),
                    "status"  =>  1,
                    "is_verify"  =>  0,
                    "is_rand"  =>  $is_rand,
                ];
                $res = DB::table('customers')->insert($arr);

                if($res && 3==9){
                    $data = ['name'=>$request->name, 'is_rand'=>$is_rand];
                    $user['to'] = $request->email;
                    Mail::send('front/email_verification', $data, function($message) use ($user){
                        $message->to($user['to']);
                        $message->subject('Email Id Verification');
                    });

                    return response()->json(['status'=>'success', 'msg'=>'Registration Successfully. Please check your email id for verification']);
                }else{
                    return response()->json(['status'=>'success', 'msg'=>'Registration Successfully without email verification.']);
                }
            }
        }
    }

    public function email_verification(request $request, $id)
    {
                $result=DB::table('customers')
                    ->where(['is_rand'=>$id])
                    ->where(['is_verify'=>0])
                    ->get();
                if(isset($result[0]))    
                {
                     $result=DB::table('customers')
                        ->where(['id'=>$result[0]->id])
                        ->update(['is_verify'=>1, 'is_rand'=>'']);
                        return view('front/verification');
                }else{
                    return redirect('/');
                }
    }

    public function forgot_process(request $request)
    {
            $result=DB::table('customers')
                ->where(['email'=>$request->str_forgot_email])
                ->get();

            if(isset($result[0])){
                $is_rand = rand(111111111,999999999);

                $result=DB::table('customers')
                        ->where(['email'=>$request->str_forgot_email])
                        ->update(['is_forgot_password'=>1, 'is_rand'=>$is_rand]);

                    $data = ['name'=>$result[0]->name, 'is_rand'=>$is_rand];
                    $user['to'] = $request->str_forgot_email;
                    Mail::send('front/forgot_password', $data, function($message) use ($user){
                        $message->to($user['to']);
                        $message->subject('Forgot Password');
                    });
                    return response()->json(['status'=>'success', 'msg'=>'Please check your email id for forgot password']);
                }else{
                    return response()->json(['status'=>'error', 'msg'=>'Your email not found']);
                }
    }

    public function forgot_password_change(request $request, $id)
    {
         $result=DB::table('customers')
            ->where(['is_rand'=>$id])
            ->where(['is_forgot_password'=>1])
            ->get();
        if(isset($result[0]))    
        {
                $request->session()->put('FORGOT_PASSWORD_USER_ID',$result[0]->id);
                return view('front/forgot_password_change');
        }else{
            return redirect('/');
        }
    }

    public function forgot_password_change_process(request $request)
    {
        //FORGOT_PASSWORD_USER_ID
         $result=DB::table('customers')
            ->where(['id'=>session()->get('FORGOT_PASSWORD_USER_ID')])
            ->update([
                'is_forgot_password'=>0,
                'is_rand'=>'',
                'password'=>Crypt::encrypt($request->forgot_password)
            ]);
        return response()->json(['status'=>'success', 'msg'=>'Your password has been changed']);
    }

    public function checkout(request $request)
    {
        $result['cart_data'] = getCardData();
        //prx($result); 
        //mani hest season
        if(isset($result['cart_data'][0]))
        {
         if($request->session()->has('FRONT_USER_LOGIN'))
            {
                $uid = $request->session()->get('FRONT_USER_ID');
                $customers_info=DB::table('customers')
                                ->where(['id'=>$uid])
                                ->get();
            //    prx($customers_info);                
                $result['customers']['name'] = $customers_info[0]->name;
                $result['customers']['email'] = $customers_info[0]->email;
                $result['customers']['mobile'] = $customers_info[0]->mobile;
                $result['customers']['state'] = $customers_info[0]->state;
                $result['customers']['company'] = $customers_info[0]->company;
                $result['customers']['city'] = $customers_info[0]->city;
                $result['customers']['gstin'] = $customers_info[0]->gstin;
                $result['customers']['zip'] = $customers_info[0]->zip;
            }else{
                $result['customers']['name'] = '';
                $result['customers']['email'] = '';
                $result['customers']['mobile'] = '';
                $result['customers']['state'] = '';
                $result['customers']['company'] = '';
                $result['customers']['gstin'] = '';
                $result['customers']['city'] = '';
                $result['customers']['zip'] = '';
            }

           return view('front/checkout', $result);
        }else{
            return redirect('/');
        }
    }

    public function apply_coupon_code(request $request)
    {

         $arr = get_coupon_code_val($request->coupon_code);
         $arr = json_decode($arr, true);
         return response()->json(['status'=>$arr['status'], 'msg'=>$arr['msg'], 'totalPrice'=>$arr['totalPrice']]);
    }

    public function remove_coupon_code(request $request)
    {
        $totalPrice = 0;
        $result=DB::table('coupons')
            ->where(['code'=>$request->coupon_code])
            ->get();
           // prx($result);
        if($result[0]->status==1)
        {
            $getCardData = getCardData();
            foreach($getCardData as $data)
                {
                    $totalPrice = $totalPrice+($data->price*$data->qty);
                }
        return response()->json(['status'=>'success', 'msg'=>'Coupon Code Removed', 'totalPrice'=>$totalPrice]);
        }else{
        return response()->json(['status'=>'error', 'msg'=>'Coupon is not active', 'totalPrice'=>$totalPrice]);
        }

    }

    public function place_order(request $request)
    {
        ini_set('memory_limit', '2048M');
        if($request->session()->has('FRONT_USER_LOGIN'))
        {
            $uid = $request->session()->get('FRONT_USER_ID');
            $coupon_code_value=0;
           
           if($request->couponCode !='')
           {
             $arr = get_coupon_code_val($request->couponCode);
             $arr = json_decode($arr, true);

             if($arr['status']=='success')
            {
                $coupon_code_value = $arr['coupon_code_value'];
            }else{
                return response()->json(['status'=>'error', 'msg'=>$arr['msg']]);
            }
           }
        
        $totalPrice = 0;
        $getCardData = getCardData();
       
        foreach($getCardData as $data)
            {
                $totalPrice = $totalPrice+($data->price*$data->qty);
            }

        $arr = [
                "customer_id"  =>  $uid,
                "name"  =>  $request->name,
                "email"  =>  $request->email,
                "mobile"  =>  $request->mobile,
                "address"  =>  $request->address,
                "city"  =>  $request->city,
                "state"  =>  $request->state,
                "pincode"  =>  $request->zip,
                "coupon_code"  => $request->couponCode,
                "coupon_value"  => $coupon_code_value,
                "payment_type"  => $request->payment_type,
                "payment_status"  => "Pending",
                "total_amt"  => $totalPrice,
                "order_status"  => 1,
                "added_on" => date('Y-m-d h:i:s'),
                
                
            ];
            $order_id = DB::table('orders')->insertGetId($arr);
                if($order_id > 0){
                    $productDetailArr = [];
                    foreach($getCardData as $data)
                    {
                        $productDetailArr['order_id'] = $order_id;
                        $productDetailArr['product_id'] = $data->pid;
                        $productDetailArr['product_attr_id'] = $data->attr_id;
                        $productDetailArr['price'] = $data->price;
                        $productDetailArr['qty'] = $data->price;
                        DB::table('order_detail')->insert($productDetailArr);
                    }
                    DB::table('cart')
                        ->where(['user_id'=>$uid])
                        ->where(['user_type'=>"Reg"])
                        ->delete();

                    $request->session()->put('ORDER_ID',$uid);
                    $status = "success";
                    $msg = "Your order placed successfully";
            }else{
                $status = "error";
                $msg = "Please try after sometime";
            }
        }else{
            $status = "error";
            $msg = "Please register to place an order";
        }
        return response()->json(['status'=>$status, 'msg'=>$msg]);
    }

    public function order_placed(request $request)
    {
        if($request->session()->has('ORDER_ID'))
        {

            return view('front/order_placed');
        }else{
            return redirect('/');
        }
    }

     public function logout()
    {
        session()->forget('FRONT_USER_LOGIN');
        session()->forget('FRONT_USER_NAME');
        session()->forget('FRONT_USER_ID');
        session()->forget('USER_TEMP_ID');
        return redirect('/');
    }



}
