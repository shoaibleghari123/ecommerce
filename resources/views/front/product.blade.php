
@extends('front.layout')
@section('page_title', $product[0]->name)
@section('container')

  <!-- catg header banner section -->
<!---
  <section id="aa-catg-head-banner">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>T-Shirt</h2>
         <ol class="breadcrumb">
           <li><a href="index.html">Home</a></li>
           <li><a href="#">Product</a></li>
           <li class="active">T-shirt</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
--->
   <!-- / catg header banner section -->

   <!-- product category -->
   <section id="aa-product-details">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="aa-product-details-area">
             <div class="aa-product-details-content">
               <div class="row">
                 <!-- Modal view slider -->
                 <div class="col-md-5 col-sm-5 col-xs-12">
                   <div class="aa-product-view-slider">
                     <div id="demo-1" class="simpleLens-gallery-container">
                       <div class="simpleLens-container">
                         <div class="simpleLens-big-image-container"><a data-lens-image="{{ asset('storage/media/'.$product[0]->image) }}" class="simpleLens-lens-image"><img src="{{ asset('storage/media/'.$product[0]->image) }}" class="simpleLens-big-image"></a></div>
                       </div>
                       <div class="simpleLens-thumbnails-container">

                         @if($product_images[0]->images !='')
                        @foreach($product_images as $productAttr)
                           <a data-big-image="{{asset('storage/media/'.$productAttr->images)}}" data-lens-image="{{asset('storage/media/'.$productAttr->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
                             <img src="{{asset('storage/media/'.$productAttr->images)}}" width="50px">
                           </a>
                        @endforeach
                        @endif
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- Modal view content -->
                 <div class="col-md-7 col-sm-7 col-xs-12">
                   <div class="aa-product-view-content">

                     <h3>{{ $product[0]->name }}</h3>
                     <div class="aa-price-block">
                       <span class="aa-product-view-price">RS: {{ $product_attr[$product[0]->id][0]->price }}</span>&nbsp;&nbsp;
                       <span class="aa-product-view-price">RS: <del>{{ $product_attr[$product[0]->id][0]->mrp }}</del></span>
                       <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                       @if($product[0]->lead_time != '')
                        <p class="lead_time">{{ $product[0]->lead_time }}</p>
                       @endif
                     </div>
                     <p>{!! $product[0]->short_desc !!}</p>

                       @if($product_attr[$product[0]->id][0]->size_id > 0)
                     <h4>Size</h4>
                     <div class="aa-prod-view-size">
                         @php
                             $arrSize=[];
                            foreach($product_attr[$product[0]->id] as $size)
                            {
                                $arrSize[]=$size->size;
                            }
                            $arrSize = array_unique($arrSize);

                         @endphp
                        @foreach($arrSize as $size)
                        @if($size!='')
                            <a href="javascript:void(0)" id="size_{{$size}}" class="size_link" onclick=showColor('{{ $size }}')>{{ $size }}</a>
                        @endif
                        @endforeach
                     </div>
                       @endif

                       @if($product_attr[$product[0]->id][0]->color_id > 0)
                     <h4>Color</h4>

                     <div class="aa-color-tag">
                        @foreach($product_attr[$product[0]->id] as $color)
                        @if($color->color!='')
                        <a href="javascript:void(0)" class="aa-color-{{ strtolower($color->color) }} product_color size_{{$color->size}}" onclick=change_product_color_image("{{asset('storage/media/'.$color->attr_image)}}","{{$color->color}}")></a>
                        @endif
                        @endforeach
                     </div>
                       @endif
                     <div class="aa-prod-quantity">
                       <form action="">
                         <select id="qty" name="qty">
                             @for($i=1; $i<11; $i++)
                                 <option value="{{$i}}">{{$i}}</option>
                             @endfor
                         </select>
                       </form>
                       <p class="aa-prod-category">
                         Model: <a href="#">{{ $product[0]->model }}</a>
                       </p>
                     </div>
                     <div class="aa-prod-view-bottom">
                       <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}', '{{$product_attr[$product[0]->id][0]->size_id}}', '{{$product_attr[$product[0]->id][0]->color_id}}')">Add To Cart</a>
                     </div>
                       <div id="add_to_cart_msg"></div>

                   </div>
                 </div>
               </div>
             </div>
             <div class="aa-product-details-bottom">
               <ul class="nav nav-tabs" id="myTab2">
                 <li><a href="#description" data-toggle="tab">Description</a></li>
                 <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                 <li><a href="#uses" data-toggle="tab">Uses</a></li>
                 <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                 <li><a href="#review" data-toggle="tab">Reviews</a></li>
               </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                 <div class="tab-pane fade in active" id="description">
                    {!! $product[0]->desc !!}
                 </div>
                 <div class="tab-pane fade" id="technical_specification">
                    {!! $product[0]->technical_specification !!}
                 </div>
                 <div class="tab-pane fade" id="uses">
                    {!! $product[0]->uses !!}
                 </div>
                 <div class="tab-pane fade" id="warranty">
                    {!! $product[0]->warranty !!}
                 </div>
                 <div class="tab-pane fade " id="review">
                  <div class="aa-product-review-area">
                    <h4>2 Reviews for T-Shirt</h4>
                    <ul class="aa-review-nav">
                      <li>
                         <div class="media">
                           <div class="media-left">
                             <a href="#">
                               <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                             </a>
                           </div>
                           <div class="media-body">
                             <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                             <div class="aa-product-rating">
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star-o"></span>
                             </div>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                           </div>
                         </div>
                       </li>
                       <li>
                         <div class="media">
                           <div class="media-left">
                             <a href="#">
                               <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                             </a>
                           </div>
                           <div class="media-body">
                             <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                             <div class="aa-product-rating">
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star"></span>
                               <span class="fa fa-star-o"></span>
                             </div>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                           </div>
                         </div>
                       </li>
                    </ul>
                    <h4>Add a review</h4>
                    <div class="aa-your-rating">
                      <p>Your Rating</p>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                      <a href="#"><span class="fa fa-star-o"></span></a>
                    </div>
                    <!-- review form -->
                    <form action="" class="aa-review-form">
                       <div class="form-group">
                         <label for="message">Your Review</label>
                         <textarea class="form-control" rows="3" id="message"></textarea>
                       </div>
                       <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text" class="form-control" id="name" placeholder="Name">
                       </div>
                       <div class="form-group">
                         <label for="email">Email</label>
                         <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                       </div>

                       <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                    </form>
                  </div>
                 </div>
               </div>
             </div>
             <!-- Related product -->
             <div class="aa-product-related-item">
               <h3>Related Products</h3>
               <ul class="aa-product-catg aa-related-item-slider">
                 <!-- start single product item -->

                 @if(isset($related_product[0]))
                  @foreach($related_product as $productArr)
                  <li>
                    <figure>
                      <a class="aa-product-img" href="{{ url('product/'.$productArr->slug) }}"><img src="{{ asset('storage/media/'.$productArr->image) }}" alt="{{ $productArr->name }}"></a>
                      <a class="aa-add-card-btn"href="{{ url('product/'.$productArr->slug) }}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                       <figcaption>
                        <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">Polo T-Shirt</a></h4>
                        <span class="aa-product-price">RS {{ $related_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>{{ $related_product_attr[$productArr->id][0]->mrp }}</del></span>
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
     </div>
       <form id="frmAddToCart">
       <input type="hidden" id="size_id" name="size_id" />
       <input type="hidden" id="color_id" name="color_id" />
       <input type="hidden" id="product_id" name="product_id"/>
       <input type="hidden" id="pqty" name="pqty"/>
       @csrf
       </form>
   </section>
   <!-- / product category -->
@endsection

