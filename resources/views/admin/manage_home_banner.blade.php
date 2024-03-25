@extends('admin.layout')
@section('page_title', 'Manage Banner')
@section('banner_select', 'active')
<style>
   .error_message{
   color: #df0f24;
   }
   .success_message{
   color: #044919;
   }
</style>
@section('container')
<h1 class="mb10">Banner</h1>
<a href="{{ url('admin/banner') }}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            {{-- 
            <form action="{{ route('f.submit') }}" method="post"> --}}
            <form action="{{ route('banner.manage_banner_process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="banner_id" value="{{ $banner_id }}">


               <div class="row">

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="btn_txt" class="control-label mb-1">Button Text</label>
                     <input id="btn_txt" name="btn_txt" type="text" class="form-control" value="{{ $btn_txt }}" placeholder="Button Text">
                     @error('btn_txt')
                     <li class='error_message'>{{ $message }}
                     </li>
                     @enderror
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="btn_link" class="control-label mb-1">Button Link</label>
                     <input id="btn_link" name="btn_link" type="text" class="form-control" value="{{ $btn_link }}" placeholder="Button Link">
                     @error('btn_link')
                     <li class='error_message'>{{ $message }}
                     </li>
                     @enderror
                  </div>
               </div>

            </div>




               <div class="form-group">
                  <label for="image" class="control-label mb-1">Banner Image</label>
                  <input id="image" name="image" type="file" class="form-control" value="{{ $image }}" placeholder="Banner Image">
                  
                  @if($image !='')
                  <a href="{{ asset('storage/media/banner/'.$image) }}" target="_blank"><img src="{{ asset('storage/media/banner/'.$image) }}" alt=""></a>
                  
                  @endif
                  @error('image')
                  <li class='error_message'>{{ $message }}</li>
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