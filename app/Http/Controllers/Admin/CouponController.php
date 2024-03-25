<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CouponController extends Controller
{
    public function index()
    {
        $result['coupons'] = Coupon::all();
       return view('admin.coupon', $result);
    }

    public function manage_coupon($id=null)
    {
        if($id>0){
            $arr = Coupon::where(['id'=>$id])->get();
            $result['coupon_id'] = $arr[0]->id;
            $result['title'] = $arr[0]->title;
            $result['code'] = $arr[0]->code;
            $result['value'] = $arr[0]->value;

            $result['type'] = $arr[0]->type;
            $result['min_order_amt'] = $arr[0]->min_order_amt;
            $result['is_one_time'] = $arr[0]->is_one_time;
        }else{
            $result['coupon_id'] = '';
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['type'] = '';
            $result['min_order_amt'] ='';
            $result['is_one_time'] = '';
        }
        
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)//url form-submit
    {
        $request->validate([
            'title' =>  'required',
            'code' =>  'required|unique:coupons,code,'.$request->post('coupon_id'),
            'value' =>  'required',
        ]);
       
        $coupon_msg = '';
        if($request->post('coupon_id')>0){
           $model = Coupon::find($request->post('coupon_id'));
           $coupon_msg = "Coupon Updated Successfully";
        }else{
            $model = new Coupon();
            $coupon_msg = "Coupon Inserted Successfully";
        }
        
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');

        $model->type = $request->post('type');
        $model->min_order_amt = $request->post('min_order_amt');
        $model->is_one_time = $request->post('is_one_time');

        $model->save();
        $request->session()->flash('message', $coupon_msg);
        return redirect('admin/coupon');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/coupon');
    }

    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        $request->session()->flash('message', 'Coupon Deleted');
        return redirect('admin/coupon');
    }
}
