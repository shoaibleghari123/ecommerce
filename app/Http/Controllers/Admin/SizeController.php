<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  
    public function index()
    {
        $result['sizes'] = Size::all();
       return view('admin.size', $result);
    }

    public function manage_size($id=null)
    {
        if($id>0){
            $arr = Size::where(['id'=>$id])->get();
            $result['size_id'] = $arr[0]->id;
            $result['size'] = $arr[0]->size;
        }else{
            $result['size_id'] = '';
            $result['size'] = '';
        }
        
        return view('admin/manage_size',$result);
    }

    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' =>  'required|unique:sizes,size,'.$request->post('size'),
            //'code' =>  'required|unique:coupons,code,'.$request->post('coupon_id'),
        ]);
       
        if($request->post('size_id')>0){
           $model = Size::find($request->post('size_id'));
        }else{
            $model = new Size();
        }
        
        $model->size = $request->post('size');

        $model->save();
        $request->session()->flash('message', 'Size Inserted');
        return redirect('admin/size');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/size');
    }

    public function delete(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('message', 'Size Deleted');
        return redirect('admin/size');
    }
}
