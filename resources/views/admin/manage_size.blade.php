@extends('admin.layout')

@section('page_title', 'Manage Size')
@section('size_select', 'active')
<style>

    .error_message{
        color: #df0f24;

    }

    .success_message{
        color: #044919;

    }
</style>

@section('container')


<h1 class="mb10">Size</h1>
    <a href="{{ url('admin/size') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

<div class="row m-t-30">
    <div class="col-md-12">

                <div class="card">
                
                    <div class="card-body">
                       
                    
                        <form action="{{ route('size.manage_size_process') }}" method="post">
                            @csrf
                            <input type="hidden" name="size_id" value="{{ $size_id }}">
                            <div class="form-group">
                                <label for="size" class="control-label mb-1"> Size</label>
                                <input id="size" name="size" type="text" class="form-control" value="{{ $size }}" placeholder="Size" required>
                                @error('size')
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