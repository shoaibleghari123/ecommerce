@extends('admin.layout')

@section('page_title', 'Manage Color')
@section('color_select', 'active')
<style>

    .error_message{
        color: #df0f24;

    }

    .success_message{
        color: #044919;

    }
</style>

@section('container')


<h1 class="mb10">Color</h1>
    <a href="{{ url('admin/color') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

<div class="row m-t-30">
    <div class="col-md-12">

                <div class="card">
                
                    <div class="card-body">
                       
                    
                        <form action="{{ route('color.manage_color_process') }}" method="post">
                            @csrf
                            <input type="hidden" name="color_id" value="{{ $color_id }}">
                            <div class="form-group">
                                <label for="color" class="control-label mb-1"> Color</label>
                                <input id="color" name="color" type="text" class="form-control" value="{{ $color }}" placeholder="Color" required>
                                @error('color')
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