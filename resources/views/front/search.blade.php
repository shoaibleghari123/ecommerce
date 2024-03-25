@extends('front.layout')
@section('page_title', 'Search')
@section('container')

    <!-- catg header banner section
    <section id="aa-catg-head-banner">
        <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Fashion</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Women</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    -->
    <!-- / catg header banner section -->

    
    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-8">
                    <div class="aa-product-catg-content">
                
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                                <!-- start single product item -->

                                @if(isset($products[0]))
                                    @foreach($products as $productArr)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                                                <a class="aa-add-card-btn"href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->pid}}', '{{$product_attr[$productArr->pid][0]->size}}', '{{$product_attr[$productArr->pid][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{ $productArr->name }}</a></h4>
                                                    <span class="aa-product-price">RS {{ $product_attr[$productArr->pid][0]->price }}</span><span class="aa-product-price"><del>{{  $product_attr[$productArr->pid][0]->mrp }}</del></span>
                                                </figcaption>
                                            </figure>
                                        </li>

                                    @endforeach
                                @else
                                    <li>
                                        <figure>
                                            No Data Found
                                        </figure>
                                    </li>
                                @endif


                            </ul>
                       
                        </div>
       
                    </div>
                </div>
      
        </div>


    </section>
    <input type="hidden" id="qty" name="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="size_id" name="size_id" />
        <input type="hidden" id="color_id" name="color_id" />
        <input type="hidden" id="product_id" name="product_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        @csrf
    </form>

@endsection

