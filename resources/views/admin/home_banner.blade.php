@extends('admin.layout')

@section('page_title', 'Home Banner')
@section('banner_select', 'active')
@section('container')


@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif

    <h1>Banner</h1>
    <a href="banner/manage_banner">
        <button type="button" class="btn btn-success">Add Banner</button>
    </a>
   <div class="row m-t-30">
    
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Image</th>
                        <th>Text Button</th>
                        <th>Text Link</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($home_banners as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->image }}</td>
                        <td>{{ $list->btn_txt }}</td>
                        <td>{{ $list->btn_link }}</td>
                        <td>
                            <a href="{{ asset('storage/media/banner/'.$list->image) }}" target="_blank"><img style="width: 100px" src="{{ asset('storage/media/banner/'.$list->image) }}" /></a>
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
                        <a href="{{ url('admin/banner/status/') }}/{{ $status_id }}/{{ $list->id }}"><button type="button" class="btn btn-{{ $class }}">{{ $status_title }}</button></a>
                        <a href="{{ url('admin/banner/manage_banner/') }}/{{ $list->id }}"><button type="button" class="btn btn-success">Edit</button></a>
                        <a href="{{ url('admin/banner/delete/') }}/{{ $list->id }}"><button type="button" class="btn btn-danger">Delete</button></a>
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