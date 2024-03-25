<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            
            return view('admin.login');
        }

       
    }

    public function auth_rename(Request $request) //dependency injection with type hint
    {
        //$email = $request->post('emails', 'Not found');//if email not exists
        //input all, only and excep method are also available
        //directly echo input field $request->email
   
    }

    public function auth(LoginRequest $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
    
        $result = Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'), $result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
                return redirect()->to('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error','Your email does not exists');
            return redirect('admin');
        }
    
    }


    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function updatepassword()
    {
        $result = Admin::find(1);
        $result->password = Hash::make('admin@123');
        $rs = $result->save();
        session()->flash('success_message','Password has been updated successfully');
        return redirect('admin');
    }

    public function category()
    {
        exit('category page');
    }


    public function formsubmit()//url form-submit
    {
        //dd($request->all());
        echo "form submit";   
    }

    public function logout()
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        return redirect('admin');
    }

}
