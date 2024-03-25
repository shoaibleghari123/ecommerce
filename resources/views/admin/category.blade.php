@extends('admin.layout')

@section('page_title', 'Category')
@section('category_select', 'active')
@section('container')


@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

    <h1>Category</h1>
    <a href="category/manage_category">
        <button type="button" class="btn btn-success">Add Category</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->category_name }}</td>
                        <td>{{ $list->category_slug }}</td>
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
                        <a href="{{ url('admin/category/status/') }}/{{ $status_id }}/{{ $list->id }}"><button type="button" class="btn btn-{{ $class }}">{{ $status_title }}</button></a>
                        <a href="{{ url('admin/category/manage_category/') }}/{{ $list->id }}"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="{{ url('admin/category/delete/') }}/{{ $list->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
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