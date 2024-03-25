<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['colors'] = Color::all();
       return view('admin.color', $result);
    }

    public function manage_color($id=null)
    {
        if($id>0){
            $arr = Color::where(['id'=>$id])->get();
            $result['color_id'] = $arr[0]->id;
            $result['color'] = $arr[0]->color;
        }else{
            $result['color_id'] = '';
            $result['color'] = '';
        }
        
        return view('admin/manage_color',$result);
    }

    public function manage_color_process(Request $request)
    {
        $request->validate([
            'color' =>  'required|unique:colors,color,'.$request->post('color'),
        ]);
       
        if($request->post('color_id')>0){
           $model = Color::find($request->post('color_id'));
        }else{
            $model = new Color();
        }
        
        $model->color = $request->post('color');

        $model->save();
        $request->session()->flash('message', 'Color Inserted');
        return redirect('admin/color');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/color');
    }

    public function delete(Request $request, $id)
    {
        $model = Color::find($id);
        $model->delete();
        $request->session()->flash('message', 'Color Deleted');
        return redirect('admin/color');
    }
}
