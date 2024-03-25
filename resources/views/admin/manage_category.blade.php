@extends('admin.layout')
@section('page_title', 'Manage Category')
@section('category_select', 'active')
<style>
   .error_message{
   color: #df0f24;
   }
   .success_message{
   color: #044919;
   }
</style>
@section('container')
<h1 class="mb10">Category</h1>
<a href="{{ url('admin/category') }}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            {{-- 
            <form action="{{ route('f.submit') }}" method="post"> --}}
            <form action="{{ route('category.manage_category_process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="category_id" value="{{ $category_id }}">


               <div class="row">

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="category_name" class="control-label mb-1">Category Name</label>
                     <input id="category_name" name="category_name" type="text" class="form-control" value="{{ $category_name }}" placeholder="Category Name" required>
                     @error('category_name')
                     <li class='error_message'>{{ $message }}
                     </li>
                     @enderror
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label for="parent_category_id" class="control-label mb-1">Parent Category Name</label>
                     <select name="parent_category_id" id="parent_category_id" class="form-control">
                        <option value="0">Select Category</option>
                        @foreach($categories as $cat)
                        @if($cat->id==$parent_category_id)
                        <option selected value="{{ $cat->id }}">
                           @else
                        <option value="{{ $cat->id }}">
                           @endif
                           {{ $cat->category_name }}
                        </option>
                        @endforeach
                     </select>
   
                     @error('parent_category_id')
                       <li class='error_message'>{{ $message }}</li>
                     @enderror
   
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="category_slug" class="control-label mb-1">Category Slug</label>
                     <input id="category_slug" name="category_slug" type="text" class="form-control" value="{{ $category_slug }}" placeholder="Category Slug" required>
                     @error('category_slug')
                     <li class='error_message'>{{ $message }}
                     </li>
                     @enderror
                  </div>
               </div>

            </div>




               <div class="form-group">
                  <label for="category_image" class="control-label mb-1">Category Image</label>
                  <input id="category_image" name="category_image" type="file" class="form-control" value="{{ $category_image }}" placeholder="Category Image">
                  
                  @if($category_image !='')
                  <a href="{{ asset('storage/media/category/'.$category_image) }}" target="_blank"><img src="{{ asset('storage/media/category/'.$category_image) }}" alt=""></a>
                  
                  @endif
                  @error('category_image')
                  <li class='error_message'>{{ $message }}</li>
                @enderror

               </div>


               <div class="form-group">
                  <label for="show_in_home_page" class="control-label mb-1">Show in Home Page</label>
                  <input type="checkbox" id="is_home" name="is_home" {{ $is_home_selected }}>
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