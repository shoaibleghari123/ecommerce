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
    <section id="cart-view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($carts[0]))
                                        @foreach($carts as $crt)
                                        <tr id="cart_box{{$crt->attr_id}}">
                                            <td><a class="remove" href="javascript:void(0)" onclick="deleteProductCart('{{$crt->pid}}','{{$crt->size}}', '{{$crt->color}}', '{{$crt->attr_id}}')"><fa class="fa fa-close"></fa></a></td>
                                            <td><a href="{{url('product/'.$crt->slug)}}"><img src="{{asset('storage/media/'.$crt->image)}}" alt="img"></a></td>
                                            <td><a class="aa-cart-title" href="{{url('product/'.$crt->slug)}}">{{$crt->name}}</a></td>
                                            <td>{{$crt->price}}</td>
                                            <td><input class="aa-cart-quantity" id="qty{{$crt->attr_id}}" type="number" value="{{$crt->qty}}" onclick="updateQty('{{$crt->pid}}','{{$crt->size}}', '{{$crt->color}}', '{{$crt->attr_id}}','{{$crt->price}}')" ></td>
                                            <td id="total_price_{{$crt->attr_id}}">{{$crt->price*$crt->qty}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="6">
 <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('checkout')}}"><input type="button" class="aa-cart-view-btn" value="Checkout"></td></a>


                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Cart Total view -->
                            <div class="cart-view-total">
                                <h4>Cart Totals</h4>
                                <table class="aa-totals-table">
                                    <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>$450</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>$450</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="javascript:void(0)" class="aa-cart-view-btn">Proced to Checkout</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="qty" name="qty" value="1"/>
        <form id="frmAddToCart">
            <input type="hidden" id="size_id" name="size_id" />
            <input type="hidden" id="color_id" name="color_id" />
            <input type="hidden" id="product_id" name="product_id"/>
            <input type="hidden" id="pqty" name="pqty"/>
            @csrf
        </form>
    </section>
    <!-- / Cart view section -->



@endsection

