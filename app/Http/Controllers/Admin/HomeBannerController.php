<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $result['home_banners'] = HomeBanner::all();
       return view('admin.home_banner', $result);
    }

    public function manage_banner($id=null)
    {
        if($id>0){
            $arr = HomeBanner::where(['id'=>$id])->get();
            $result['banner_id'] = $arr[0]->id;
            $result['image'] = $arr[0]->image;
            $result['btn_txt'] = $arr[0]->btn_txt;
            $result['btn_link'] = $arr[0]->btn_link;
        }else{
            $result['banner_id'] = '';
            $result['image'] = '';
            $result['btn_txt'] = '';
            $result['btn_link'] = '';
        }
        
        return view('admin/manage_home_banner',$result);
    }

    public function manage_banner_process(Request $request)
    {
        
        if($request->post('banner_id')>0){
            $model = HomeBanner::find($request->post('banner_id'));
            $message = "Banner Updated";
            $required = 'mimes:jpeg,jpg,png';
         }else{
             $model = new HomeBanner();
             $message = "Banner Inserted";
             $required = 'required|mimes:jpeg,jpg,png';
         }

        $request->validate([
            'image'=>$required,
        ]);
       
        
        if($request->hasfile('image')){
            
            if($request->post('banner_id')>0){
                $arrImage = DB::table('home_banners')->where(['id'=>$request->post('banner_id')])->get();
                if(Storage::exists('/public/media/banner/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/banner/'.$arrImage[0]->image);
                }
            }

            $img = $request->file('image');
            $ext = $img->extension();
            $img_name = time().'.'.$ext;
            $img->storeAs('/public/media/banner/',$img_name);
            $model->image = $img_name;
        }

        $model->btn_txt = $request->post('btn_txt');
        $model->btn_link = $request->post('btn_link');
       
        $model->save();
        $request->session()->flash('message', $message);
        return redirect('admin/banner');
    }

    public function status(Request $request, $status, $id)
    {
        $model = HomeBanner::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/banner');
    }

    public function delete(Request $request, $id)
    {
        $model = HomeBanner::find($id);
        $model->delete();
        $request->session()->flash('message', 'Banner Deleted');
        return redirect('admin/banner');
    }
}
