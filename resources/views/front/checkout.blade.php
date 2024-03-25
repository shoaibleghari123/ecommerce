@extends('front.layout')
@section('page_title', 'Cart')
@section('container')

    <!-- catg header banner section -->
{{--    <section id="aa-catg-head-banner">--}}
{{--        <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">--}}
{{--        <div class="aa-catg-head-banner-area">--}}
{{--            <div class="container">--}}
{{--                <div class="aa-catg-head-banner-content">--}}
{{--                    <h2>Cart Page</h2>--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li><a href="index.html">Home</a></li>--}}
{{--                        <li class="active">Cart</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- / catg header banner section -->

    <!-- Cart view section -->
 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="" id="frmPlaceOrder">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
        
            @php

            //var_dump(session()->has('FRONT_USER_ID'));die();

            @endphp

                @if(session()->has('FRONT_USER_ID')!=true)
                    <div>

                        <a href="" data-toggle="modal" data-target="#login-modal"><button type="button" class="btn btn-success">Login</button></a>
                    </div>

                    <br>
                    <br>
                @endif    
                    OR
                    <br>
                    <br>
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            User Detail Address
                          </a>
                        </h4>
                      </div>

                     

                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="name" placeholder="Name" value="{{$customers['name']}}">
                              </div>                             
                            </div>
                         
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="email" placeholder="Email" value="{{$customers['email']}}">
                              </div>                             
                            </div>                            
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" name="mobile" placeholder="Phone*" value="{{$customers['mobile']}}">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address">{{$customers['city']}}*</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                         
                          <div class="row">
                       
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city" placeholder="City / Town*" value="{{$customers['city']}}">
                              </div>
                            </div>
                       
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="state*" name="state" value="{{$customers['state']}}">
                              </div>                             
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*" name="zip" value="{{$customers['zip']}}">
                              </div>
                            </div>
                          </div> 
                          
                        </div>

                    

                    </div>
               
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $total_price = 0;
                       
                        @endphp
                        @if(isset($cart_data[0]))
                        @foreach($cart_data as $data)
                        @php 
                        
                        $product_total_price = 0;
                        $product_total_price = $data->qty*$data->price;
                        $total_price += $data->qty*$data->price;
                        @endphp
                         <tr>
                          <td>{{$data->name}} <strong> x  {{$data->qty}}</strong>
                            <br><span class="cart_color">{{$data->color}}</span>
                          </td>
                          <td>{{$product_total_price}}</td>
                        </tr>
                        @endforeach
                        @endif


                        

                      </tbody>

                      <tfoot>
                         <tr class="hide show_coupon_box">
                          <th>Coupon Code <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code_link">Remove</a></th>
                          <td id="coupon_code_str"> </td>
                        </tr>

                        <tr>
                          <th>Total</th>
                          <td id="coupon_total_price">{{$total_price}}</td>
                        </tr>
       
                 
                         
                      </tfoot>
                    </table>

                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Have a Coupon?
                          </a>
                        </h4>
                      </div>
                      
                        <div class="panel-body coupon_code">
                          <input type="text" placeholder="Coupon Code" name="couponCode" id="couponCode" class="aa-coupon-code apply_coupon_code_box">
                          <br>
                          <input type="button" onclick="apply_coupon_code()" value="Apply Coupon" class="aa-browse-btn apply_coupon_code_box">
                          <div id="coupon_code"></div>

                        </div>
                   
                    </div>                  
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="cod"><input type="radio" id="cashdelivery" name="payment_type" checked value="COD"> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" name="payment_type"  value="Paypal"> Via Paypal </label>
                   
                    <input type="submit" value="Place Order" class="aa-browse-btn" id="btnPlaceOrder">  
                    <div id="place_order_msg"></div>              
                  </div>

                </div>
              </div>
            </div>
            @csrf</form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
    <!-- / Cart view section -->



@endsection

