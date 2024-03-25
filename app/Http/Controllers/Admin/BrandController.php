<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class BrandController extends Controller
{
    public function index()
    {
        $result['brands'] = Brand::all();
       return view('admin.brand', $result);
    }

    public function manage_brand($id=null)
    {
        if($id>0){
            $arr = Brand::where(['id'=>$id])->get();
            $result['brand_id'] = $arr[0]->id;
            $result['name'] = $arr[0]->name;
            $result['image'] = $arr[0]->image;
            $result['is_home'] = $arr[0]->is_home;
            $is_home_selected="";
            if($arr[0]->is_home==1)
                $is_home_selected="checked";
            $result['is_home_selected']=$is_home_selected;
        }else{
            $result['brand_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['is_home_selected']='';
        }
        
        return view('admin/manage_brand',$result);
    }

    public function manage_brand_process(Request $request)
    {
        
        if($request->post('brand_id')>0){
            $model = Brand::find($request->post('brand_id'));
            $image_required = 'mimes:jpeg,jpg,png';
            $message = "Brand Updated";
         }else{
             $model = new Brand();
             $message = "Brand Inserted";
             $image_required = 'required|mimes:jpeg,jpg,png';
         }

        $request->validate([
            'name' =>  'required|unique:brands,name,'.$request->post('brand_id'),
            'image'=>$image_required,
        ]);
       
        
        if($request->hasfile('image')){
            
            if($request->post('brand_id')>0){
                $arrImage = DB::table('brands')->where(['id'=>$request->post('brand_id')])->get();
                if(Storage::exists('/public/media/brand/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/brand/'.$arrImage[0]->image);
                }
            }

            $img = $request->file('image');
            $ext = $img->extension();
            $img_name = time().'.'.$ext;
            $img->storeAs('/public/media/brand/',$img_name);
            $model->image = $img_name;
        }


        $model->name = $request->post('name');
        $model->is_home= 0;
        if($request->post('is_home')!==null)
        {
            $model->is_home= 1;
        }

        $model->save();
        $request->session()->flash('message', $message);
        return redirect('admin/brand');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/brand');
    }

    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $model->delete();
        $request->session()->flash('message', 'Brand Deleted');
        return redirect('admin/brand');
    }
}
