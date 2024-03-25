@extends('admin.layout')

@section('page_title', 'Customer')
@section('customer_select', 'active')
@section('container')

@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif


    <h1 class="mb10">Customer</h1>

    <a href="{{ url('admin/customer') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

   <div class="row m-t-30">
    
    <div class="col-md-8">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
            
                <tbody>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{ $customer_list['name'] }}</td>
                    </tr>
                    
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $customer_list['email'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Mobile</strong></td>
                        <td>{{ $customer_list['mobile'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>City</strong></td>
                        <td>{{ $customer_list['city'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>State</strong></td>
                        <td>{{ $customer_list['state'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Company</strong></td>
                        <td>{{ $customer_list['company'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>{{ \Carbon\Carbon::parse($customer_list['created_at'])->format('m-d-Y h:i') }}</td>
                    </tr>

                    <tr>
                        <td><strong>Updated At</strong></td>
                        <td>{{ \Carbon\Carbon::parse($customer_list['updated_at'])->format('m-d-Y h:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
   </div>
@endsection