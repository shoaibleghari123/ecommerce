@extends('front.layout')

@section('container')


<!-- Start slider -->
<section id="aa-slider">
  <div class="aa-slider-area">
    <div id="sequence" class="seq">
      <div class="seq-screen">
        <ul class="seq-canvas">
          <!-- single slide item -->

          @foreach($home_banners as $banner)
          <li>
            <div class="seq-model">
              <img data-seq src="{{ asset('storage/media/banner/'.$banner->image) }}" alt="Men slide img" />
            </div>
            @if($banner->btn_link != '')
            <div class="seq-title">
             <span data-seq>Save Up to 75% Off</span>
              <h2 data-seq>Men Collection</h2>
              <p data-seq>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, illum.</p>
              <a data-seq target="_blank" href="{{ $banner->btn_link }}" class="aa-shop-now-btn aa-secondary-btn">{{ $banner->btn_txt }}</a>
            </div>
            @endif
          </li>

          @endforeach

        </ul>
      </div>
      <!-- slider navigation btn -->
      <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
        <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
        <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
      </fieldset>
    </div>
  </div>
</section>
<!-- / slider -->
<!-- Start Promo section -->
<section id="aa-promo">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-promo-area">
          <div class="row">
            <div class="col-md-12 no-padding">
              <div class="aa-promo-right">
                @foreach($home_categories as $list)

                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="{{ asset('storage/media/category/'.$list->category_image) }}" alt="img">
                    <div class="aa-prom-content">
                      <h4><a href="{{ url('category/'.$list->category_slug) }}">{{ $list->category_name }}</a></h4>
                    </div>
                  </div>
                </div>
                @endforeach


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-product-area">
            <div class="aa-product-inner">
              <!-- start prduct navigation -->
               <ul class="nav nav-tabs aa-products-tab">
                @foreach($home_categories as $cat)
                <li class=""><a href="#cat{{ $cat->id }}" data-toggle="tab">{{ $cat->category_name }}</a></li>
                @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  @php $loop_counter = 1; @endphp
                  @foreach($home_categories as $cat)
                  @php
                    $cat_class = "";
                    if($loop_counter == 1)
                    {
                      $loop_counter++;
                      $cat_class = "in active";
                    }
                  @endphp
                  <div class="tab-pane fade {{ $cat_class }}" id="cat{{ $cat->id }}">
                    <ul class="aa-product-catg">
                      @if(isset($home_categories_product[$cat->id][0]))
                      @foreach($home_categories_product[$cat->id] as $productArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                          <a class="aa-add-card-btn"href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}', '{{$home_product_attr[$productArr->id][0]->size}}', '{{$home_product_attr[$productArr->id][0]->color}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{ $productArr->name }}</a></h4>
                            <span class="aa-product-price">RS {{ $home_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>{{ $home_product_attr[$productArr->id][0]->mrp }}</del></span>
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
                  @endforeach

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Products section -->
<!-- banner section -->
<section id="aa-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-banner-area">
          <a href="#"><img src="{{ asset('front_assets/img/fashion-banner.jpg') }}" alt="fashion banner img"></a>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- popular section -->
<section id="aa-popular-category">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="aa-popular-category-area">
            <!-- start prduct navigation -->
           <ul class="nav nav-tabs aa-products-tab">
              <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
              <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
              <li class=""><a href="#discounted" data-toggle="tab">Discounted</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

              <div class="tab-pane fade in active" id="featured">
               <ul class="aa-product-catg aa-featured-slider">
                  @if(isset($home_featured_product[$list->id][0]))
                  @foreach($home_featured_product[$list->id] as $productArr)
                  <li>
                    <figure>
                      <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                      <a class="aa-add-card-btn"href="{{ url('product/'.$productArr->slug) }}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                       <figcaption>
                        <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">Polo T-Shirt</a></h4>
                        <span class="aa-product-price">RS {{ $home_featured_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>{{ $home_featured_product_attr[$productArr->id][0]->mrp }}</del></span>
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

              <div class="tab-pane fade" id="tranding">
                <ul class="aa-product-catg aa-popular-slider">

                  @if(isset($home_tranding_product[$list->id][0]))
                      @foreach($home_tranding_product[$list->id] as $productArr)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                          <a class="aa-add-card-btn"href="{{ url('product/'.$productArr->slug) }}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                            <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{ $productArr->name }}</a></h4>
                            <span class="aa-product-price">RS {{ $home_tranding_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>{{ $home_tranding_product_attr[$productArr->id][0]->mrp }}</del></span>
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
              <!-- / featured product category -->

              <!-- start latest product category -->
              <div class="tab-pane fade" id="discounted">
                <ul class="aa-product-catg aa-discounted-slider">
                  <!-- start single product item -->


                  <div class="tab-pane fade in active" id="tranding">
                    <ul class="aa-product-catg aa-popular-slider">

                      @if(isset($home_discounted_product[$list->id][0]))
                          @foreach($home_discounted_product[$list->id] as $productArr)
                          <li>
                            <figure>
                              <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                              <a class="aa-add-card-btn"href="{{ url('product/'.$productArr->slug) }}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{ $productArr->name }}</a></h4>
                                <span class="aa-product-price">RS {{ $home_discounted_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>{{ $home_discounted_product_attr[$productArr->id][0]->mrp }}</del></span>
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

                </ul>
              </div>
              <!-- / latest product category -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / popular section -->
<!-- Support section -->
<section id="aa-support">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-support-area">
          <!-- single support -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-truck"></span>
              <h4>FREE SHIPPING</h4>
              <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
          </div>
          <!-- single support -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-clock-o"></span>
              <h4>30 DAYS MONEY BACK</h4>
              <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
          </div>
          <!-- single support -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="aa-support-single">
              <span class="fa fa-phone"></span>
              <h4>SUPPORT 24/7</h4>
              <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Support section -->

<!-- Client Brand -->
<section id="aa-client-brand">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-client-brand-area">
          <ul class="aa-client-brand-slider">
            @foreach($home_brand as $list)
            <li><a href="#">
              <img src="{{ asset('storage/media/brand/'.$list->image) }}" alt="{{ $list->name }}"></a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Client Brand -->

<!-- Subscribe section -->
<section id="aa-subscribe" style="display: none">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-subscribe-area">
          <h3>Subscribe our newsletter </h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
          <form action="" class="aa-subscribe-form">
            <input type="email" name="" id="" placeholder="Enter your Email">
            <input type="submit" value="Subscribe">
          </form>
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
<!-- / Subscribe section -->


@endsection
