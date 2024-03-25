@extends('admin.layout')

@section('page_title', 'Size')
@section('size_select', 'active')
@section('container')

@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif


    <h1 class="mb10">Size</h1>
    <a href="size/manage_size">
        <button type="button" class="btn btn-success">Add Size</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sizes as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->size }}</td>

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
                            <a href="{{ url('admin/size/status/') }}/{{ $status_id }}/{{ $list->id }}"><button type="button" class="btn btn-{{ $class }}">{{ $status_title }}</button></a>
                        <a href="{{ url('admin/size/manage_size/') }}/{{ $list->id }}"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="{{ url('admin/size/delete/') }}/{{ $list->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
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