<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['taxs'] = Tax::all();
       return view('admin.tax', $result);
    }

    public function manage_tax($id=null)
    {
        if($id>0){
            $arr = Tax::where(['id'=>$id])->get();
            $result['tax_id'] = $arr[0]->id;
            $result['tax_desc'] = $arr[0]->tax_desc;
            $result['tax_value'] = $arr[0]->tax_value;
        }else{
            $result['tax_id'] = '';
            $result['tax_desc'] = '';
            $result['tax_value'] = '';
        }
        
        return view('admin/manage_tax',$result);
    }

    public function manage_tax_process(Request $request)
    {
        $request->validate([
            'tax_desc' =>  'required|unique:taxs,tax_desc,'.$request->post('tax_id'),
            //'code' =>  'required|unique:coupons,code,'.$request->post('coupon_id'),
        ]);
       
        if($request->post('tax_id')>0){
           $model = Tax::find($request->post('tax_id'));
           $msg = "Tax record updated";
        }else{
            $model = new Tax();
            $msg = "Tax record inserted";
        }
        
        $model->tax_desc = $request->post('tax_desc');
        $model->tax_value = $request->post('tax_value');

        $model->save();
        $request->session()->flash('message',  $msg);
        return redirect('admin/tax');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/tax');
    }

    public function delete(Request $request, $id)
    {
        $model = Tax::find($id);
        $model->delete();
        $request->session()->flash('message', 'Tax Deleted');
        return redirect('admin/tax');
    }
}
