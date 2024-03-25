<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest; 
use Illuminate\Support\Facades\DB;
use Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $result['categories'] = Category::all();
       return view('admin.category', $result);
    }

    public function manage_category($id=null)
    {
        if($id>0){
            $arr = Category::where(['id'=>$id])->get();
            $result['category_id'] = $arr[0]->id;
            $result['category_name'] = $arr[0]->category_name;
            $result['category_slug'] = $arr[0]->category_slug;
            $result['parent_category_id'] = $arr[0]->parent_category_id;
            $result['category_image'] = $arr[0]->category_image;
            $result['is_home'] = $arr[0]->is_home;
            $is_home_selected="";
            if($arr[0]->is_home==1)
                $is_home_selected="checked";
            $result['is_home_selected']=$is_home_selected;
            $result['categories'] = DB::table('categories')->where(['status'=>1])->where('id', '!=',$id)->get();
        }else{
            $result['category_id'] = '';
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['parent_category_id'] = '';
            $result['category_image'] = '';
            $result['is_home'] = '';
            $result['is_home_selected']='';
            $result['categories'] = DB::table('categories')->where(['status'=>1])->get();
        }
        
        return view('admin/manage_category',$result);
    }

    public function manage_category_process(CategoryRequest $request)//url form-submit
    {
        if($request->post('category_id')>0){
           $model = Category::find($request->post('category_id'));
        }else{
            $model = new Category();
        }

        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');
        $model->is_home= 0;
        if($request->post('is_home')!==null)
        {
            $model->is_home= 1;
        }

        if($request->hasfile('category_image'))
        {
            if($request->post('category_id')>0){
                    $arrImage = DB::table('categories')->where(['id'=>$request->post('category_id')])->get();
                    if(Storage::exists('/public/media/category/'.$arrImage[0]->category_image)){
                        Storage::delete('/public/media/category/'.$arrImage[0]->category_image);
                    }
                }

            $image = $request->file('category_image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/category', $image_name);
            $model->category_image = $image_name;
        }
        $model->save();
        $request->session()->flash('message', 'Category Inserted');
        return redirect('admin/category');
        
    }


    public function status(Request $request, $status, $id)
    {
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/category');
    }

    public function delete(Request $request, $id)
    {
        //Category::destroy($id)//directly delete record without to maintain history

        $model = Category::find($id);
        //find method to maintain trail
        /* $trail = new Trail([
            'category_name' =>  $model->category_name,
            'category_slug' =>  $model->category_slug
        ]);
        $trail->save(); */

        $model->delete();
        $request->session()->flash('message', 'Category Deleted');
        return redirect('admin/category');
    }

}
