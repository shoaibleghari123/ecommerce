@extends('admin.layout')
@section('page_title', 'Manage Brand')
@section('brand_select', 'active')
<style>
   .error_message {
   color: #df0f24;
   }
   .success_message {
   color: #044919;
   }
</style>
@section('container')
@error('image')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{ $message }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
@enderror
<h1 class="mb10">Brand</h1>
<a href="{{ url('admin/brand') }}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form action="{{ route('brand.manage_brand_process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="brand_id" value="{{ $brand_id }}">


               <div class="row">
                  <div class="col-md-8">
                     <div class="form-group">
                        <label for="" class="control-label mb-1"> Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $name }}"
                           placeholder="Name" required>
                        @error('name')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="show" class="control-label mb-4" style="padding-top: 15px"> Show in Home Page</label>
                        <input type="checkbox" id="is_home" name="is_home" class="form-control" {{ $is_home_selected }}>
                     </div>
                  </div>
               </div>


               <div class="form-group">
                  <label for="image" class="control-label mb-1"> Image</label>
                  <input id="image" name="image" type="file" class="form-control" value="{{ $image }}"
                     placeholder="Image">
                  @if ($image !=='')
                  <img width="70" height="70" src="{{ asset('storage/media/brand/' . $image) }}" alt="">
                  @endif
                  @error('image')
                  <li class='error_message'>{{ $message }}
                  </li>
                  @enderror
               </div>
               <div>
                  <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                  Submit
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection