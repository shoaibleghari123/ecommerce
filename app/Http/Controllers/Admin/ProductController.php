<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['products'] = Product::all();
        return view('admin.product', $result);
    }

    public function manage_product($id=null)
    {

        if($id>0){

            $arr = Product::where(['id'=>$id])->get();
            $result['product_id'] = $arr[0]->id;
            $result['category_id'] = $arr[0]->category_id;
            $result['name'] = $arr[0]->name;
            $result['slug'] = $arr[0]->slug;
            $result['image'] = $arr[0]->image;
            $result['brand'] = $arr[0]->brand;
            $result['model'] = $arr[0]->model;
            $result['short_desc'] = $arr[0]->short_desc;
            $result['desc'] = $arr[0]->desc;
            $result['technical_specification'] = $arr[0]->technical_specification;
            $result['keywords'] = $arr[0]->keywords;
            $result['uses'] = $arr[0]->uses;
            $result['warranty'] = $arr[0]->warranty;

            $result['lead_time'] = $arr[0]->lead_time;
            $result['tax_id'] = $arr[0]->tax_id;
            $result['is_promo'] = $arr[0]->is_promo;
            $result['is_featured'] = $arr[0]->is_featured;
            $result['is_discounted'] = $arr[0]->is_discounted;
            $result['is_tranding'] = $arr[0]->is_tranding;

            $result['product_atrri_data'] = DB::table('product_attr')->where(['product_id'=>$id])->get();

            $product_atrri_images = DB::table('product_images')->where(['product_id'=>$id])->get();
            if(!isset($product_atrri_images[0]))
            {
                $result['product_atrri_images'][0]['id']='';
                $result['product_atrri_images'][0]['images']='';

            }else{
                $result['product_atrri_images'] = $product_atrri_images;
            }

            $result['sizes'] = DB::table('sizes')->get();
            $result['colors'] = DB::table('colors')->get();

        }else{

            $result['product_id'] = '';
            $result['category_id'] = '';
            $result['name'] = '';
            $result['slug'] = '';
            $result['image'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['technical_specification'] = '';
            $result['keywords'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';

            $result['lead_time'] = '';
            $result['tax_id'] = '';
            $result['is_promo'] = '';
            $result['is_featured'] = '';
            $result['is_discounted'] = '';
            $result['is_tranding'] = '';

            $result['product_atrri_data'][0]['product_id']='';
            $result['product_atrri_data'][0]['id']='';
            $result['product_atrri_data'][0]['sku']='';
            $result['product_atrri_data'][0]['mrp']='';
            $result['product_atrri_data'][0]['price']='';
            $result['product_atrri_data'][0]['qty']='';
            $result['product_atrri_data'][0]['attr_image']='';
            $result['product_atrri_data'][0]['size_id']='';
            $result['product_atrri_data'][0]['color_id']='';
            $result['product_atrri_images'][0]['id']='';
            $result['product_atrri_images'][0]['images']='';
        }
        $result['categories'] = DB::table('categories')->where(['status'=>1])->get();
        $result['sizes'] = DB::table('sizes')->where(['status'=>1])->get();
        $result['colors'] = DB::table('colors')->where(['status'=>1])->get();
        $result['brands'] = DB::table('brands')->where(['status'=>1])->get();
        $result['taxs'] = DB::table('taxs')->where(['status'=>1])->get();
        return view('admin/manage_product',$result);
    }


    public function product_attri_delete(Request $request, $paid, $pid)
    {
        $arrImage = DB::table('product_attr')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }

        $res = DB::table('product_attr')->where(['id'=>$paid])->delete();
        $request->session()->flash('message', 'Product Attribute Deleted');
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function product_image_delete(Request $request, $piid, $pid)
    {
        $arrImage = DB::table('product_images')->where(['id'=>$piid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        $res = DB::table('product_images')->where(['id'=>$piid])->delete();

        $request->session()->flash('message', 'Product Image Deleted');
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function manage_product_process(Request $request)//url form-submit
    {

        if($request->post('product_id')>0){
            $image_required = 'mimes:jpeg,jpg,png';
        }else{
            $image_required = 'required|mimes:jpeg,jpg,png';
        }

        $request->validate([
                'name'  =>  'required',
                'slug'  =>  'required|unique:products,slug,'.$request->post('product_id'),
                'image'  =>  $image_required,
                'attr_image.*'  => 'mimes:jpg,jpeg,png',
                'images.*'  => 'mimes:jpg,jpeg,png'
            ]);


        if($request->post('product_id')>0){
           $model = Product::find($request->post('product_id'));
           $session_message = "Product Updated";
        }else{
            $model = new Product();
            $session_message = "Product Inserted";
        }

        if($request->hasfile('image')){

            if($request->post('product_id')>0){
                $arrImage = DB::table('products')->where(['id'=>$request->post('product_id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $model->category_id = $request->post('category_id');
        $model->name = $request->post('name');
        $model->slug = $request->post('slug');

        $model->brand = $request->post('brand');
        $model->model = $request->post('model');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->technical_specification = $request->post('technical_specification');
        $model->keywords = $request->post('keywords');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');

        $model->lead_time = $request->post('lead_time');
        $model->tax_id = $request->post('tax_id');
        $model->is_promo = $request->post('is_promo');
        $model->is_featured = $request->post('is_featured');
        $model->is_discounted = $request->post('is_discounted');
        $model->is_tranding = $request->post('is_tranding');
        $model->status = 1;
        $model->save();


        $sku_size = sizeof($request->post('sku'));
        $product_attri_arr = array();
        for($i=0; $i<$sku_size; $i++)
        {
            $product_attri_arr=[];
            $product_attri_arr['product_id']=$model->id;

            if($request->post('color_id')[$i]=='')
                $product_attri_arr['color_id'] = 0;
            else
                $product_attri_arr['color_id'] = $request->post('color_id')[$i];
            if($request->post('size_id')[$i]=='')
                $product_attri_arr['size_id'] = 0;
            else
                $product_attri_arr['size_id'] = $request->post('size_id')[$i];

                $product_attri_arr['sku'] = $request->post('sku')[$i];
                $product_attri_arr['price'] = (int)$request->post('price')[$i];
                $product_attri_arr['mrp'] = (int)$request->post('mrp')[$i];
                $product_attri_arr['qty'] = (int)$request->post('qty')[$i];

                $check = DB::table('product_attr')->where('sku','=', $request->post('sku')[$i])->where('id', '!=', $request->post('update_product_atrri_id')[$i])->get();

                if(isset($check[0]))
                {
                    session()->flash('sku_error', $request->post('sku')[$i].' SKU already exists');
                    return redirect(request()->headers->get('referer'));
                }



                if($request->hasFile("attr_image.$i"))
                {
                    if($request->post('update_product_atrri_id')[$i] != ''){
                            $arrImage = DB::table('product_attr')->where(['id'=>$request->post('update_product_atrri_id')[$i]])->get();
                            if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
                                Storage::delete('/public/media/'.$arrImage[0]->attr_image);
                            }
                        }

                    $rand = rand('111111111','999999999');
                    $attr_image = $request->file("attr_image.$i");
                    $ext = $attr_image->extension();
                    $image_name = $rand.'.'.$ext;
                    $request->file("attr_image.$i")->storeAs('public/media/', $image_name);
                    $product_attri_arr['attr_image']=$image_name;
                }


            if($request->post('update_product_atrri_id')[$i] != ''){
                DB::table('product_attr')->where(['id'=>$request->post('update_product_atrri_id')[$i]])->update($product_attri_arr);
            }else{
                DB::table('product_attr')->insert($product_attri_arr);
            }
        }


        //***** product images start *****//
        $piidArr = $request->post('piid');
        foreach($piidArr as $key=>$val){
            $product_images_arr=[];
            $product_images_arr['product_id']=$model->id;
            if($request->hasFile("images.$key"))
            {

                if($piidArr[$key]!=''){
                    $arrImage = DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images)){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand = rand('111111111','999999999');
                $_image = $request->file("images.$key");
                $ext = $_image->extension();
                $image_name = $rand.'.'.$ext;
                $request->file("images.$key")->storeAs('public/media/', $image_name);
                $product_images_arr['images']=$image_name;
            }

            if($piidArr[$key]!=''){
                DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($product_images_arr);
            }else{
                DB::table('product_images')->insert($product_images_arr);
            }

        }
        //***** product images end *****//

        $request->session()->flash('message', $session_message);
        return redirect('admin/product');
    }


    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/product');
    }

    public function delete(Request $request, $id)
    {
        $model = Product::find($id);
        $model->delete();
        $request->session()->flash('message', 'Product Deleted');
        return redirect('admin/product');
    }
}
