@extends('admin.layout')

@section('page_title', 'Manage Tax')
@section('tax_select', 'active')
<style>

    .error_message{
        color: #df0f24;

    }

    .success_message{
        color: #044919;

    }
</style>

@section('container')


<h1 class="mb10">Tax</h1>
    <a href="{{ url('admin/tax') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

<div class="row m-t-30">
    <div class="col-md-12">

                <div class="card">
                
                    <div class="card-body">
                       
                    
                        <form action="{{ route('tax.manage_tax_process') }}" method="post">
                            @csrf
                            <input type="hidden" name="tax_id" value="{{ $tax_id }}">
                            <div class="form-group">
                                <label for="tax_desc" class="control-label mb-1"> Tax Description</label>
                                <input id="tax_desc" name="tax_desc" type="text" class="form-control" value="{{ $tax_desc }}" placeholder="tax desc" required>
                                @error('tax_desc')
                                <li class='error_message'>{{ $message }}
                                </li>
                                @enderror
                            </div>    
                            
                            
                            <div class="form-group">
                                <label for="tax_value" class="control-label mb-1"> Tax Value</label>
                                <input id="tax_value" name="tax_value" type="text" class="form-control" value="{{ $tax_value }}" placeholder="tax value" required>
                                @error('tax_value')
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