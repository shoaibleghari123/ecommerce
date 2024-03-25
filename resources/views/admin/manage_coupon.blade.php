@extends('admin.layout')
@section('page_title', 'Manage Coupon')
@section('coupon_select', 'active')
<style>
   .error_message{
   color: #df0f24;
   }
   .success_message{
   color: #044919;
   }
</style>
@section('container')
<h1 class="mb10">Coupon</h1>
<a href="{{ url('admin/coupon') }}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form action="{{ route('coupon.manage_coupon_process') }}" method="post">
               @csrf
               <input type="hidden" name="coupon_id" value="{{ $coupon_id }}">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="title" class="control-label mb-1"> Title</label>
                        <input id="title" name="title" type="text" class="form-control" value="{{ $title }}" placeholder="Title" required>
                        @error('title')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" name="value" type="text" class="form-control" value="{{ $value }}" placeholder="Value" required>
                        @error('value')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="min_order_amt" class="control-label mb-1">Min Order Amt</label>
                        <input id="min_order_amt" name="min_order_amt" type="text" class="form-control" value="{{ $min_order_amt }}" placeholder="Minimum Order">
                        @error('min_order_amt')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" name="code" type="text" class="form-control" value="{{ $code }}" placeholder="Code" required>
                        @error('code')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="type" class="control-label mb-1"> Type</label>
                        <select name="type" id="type" class="form-control" >
                           @if($type=="Value")
                            <option selected value="Value">Value</option>
                            <option value="Per">Per</option>
                           @elseif($type=="Per")
                            <option selected value="Per">Per</option>
                            <option value="Value">Value</option>
                           @else
                            <option value="">Select Type</option>
                            <option value="Value">Value</option>
                            <option value="Per">Per</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="is_one_time" class="control-label mb-1">IS One Time</label>
                        <select name="is_one_time" id="is_one_time" class="form-control">
                            @if($is_one_time=='1')
                            <option selected value="1">Yes</option>
                            <option value="0">No</option>
                            @else
                            <option value="1">Yes</option>
                            <option selected value="0">No</option>
                            @endif
                         </select>
                        @error('is_one_time')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                  </div>
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