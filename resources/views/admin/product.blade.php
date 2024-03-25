@extends('admin.layout')

@section('page_title', 'Product')
@section('product_select', 'active')
@section('container')


@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

    <h1 class="mb10">Product</h1>
    <a href="product/manage_product">
        <button type="button" class="btn btn-success">Add Product</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->slug }}</td>
                        <td>
                            <a href="{{ asset('storage/media/'.$list->image) }}" target="_blank"><img style="width: 100px" src="{{ asset('storage/media/'.$list->image) }}" /></a>
                        </td>
                        <?php if($list->status==0){
                            $status_id = 1;
                            $status_title = "Deactive";
                            $class = "warning";
                        }else{
                            $status_id = 0;
                            $status_title = "Active";
                            $class = "info";
                        }
                        ?>
                        <td>
                        <a href="{{ url('admin/product/status/') }}/{{ $status_id }}/{{ $list->id }}"><button type="button" class="btn btn-{{ $class }}">{{ $status_title }}</button></a>
                        <a href="{{ url('admin/product/manage_product/') }}/{{ $list->id }}"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="{{ url('admin/product/delete/') }}/{{ $list->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
                    </td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>


   </div>


@endsection