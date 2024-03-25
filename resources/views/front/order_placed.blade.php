@extends('front.layout')
@section('page_title', 'Order Placed')
@section('container')

    
    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
               
               <div class="col-md-12" style="text-center">
                   <h2>You Orderd has been placed</h2>
                   <h3>Order id:-{{session()->get('ORDER_ID')}}</h3>
               </div>
               

            </div>
        </div>


    </section>
   
@endsection

