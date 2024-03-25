<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['customers'] = Customer::all();
       return view('admin.customer', $result);
    }

    public function manage_customer($customer_id=null)
    {
        if($customer_id > 0 )
        {
            $customers = Customer::all();
            
        }

    }

    public function show($id=null)
    {
        if($id>0){
            $arr = Customer::where(['id'=>$id])->get();
            $result['customer_list'] = $arr[0];
        }else{
            $result['customer_list'] = '';
        }
       
        return view('admin/customer_show',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Customer::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/customer');
    }

   
}
