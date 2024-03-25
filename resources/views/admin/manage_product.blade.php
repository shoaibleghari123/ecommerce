@extends('admin.layout')
@section('page_title', 'Manage Product')
@section('product_select', 'active')
<style>
   .error_message{
   color: #df0f24;
   }
   .success_message{
   color: #044919;
   }
</style>
@section('container')
@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{ session('sku_error') }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
@endif
@error('images.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{ $message }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
@enderror
@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{ $message }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">×</span>
   </button>
</div>
@enderror
<h1 class="mb10">Product</h1>
<a href="{{ url('admin/product') }}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <form action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     @csrf
                     <input type="hidden" name="product_id" value="{{ $product_id }}">
                     <div class="form-group">
                        <label for="name" class="control-label mb-1"> Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $name }}" placeholder="Name" required>
                        @error('name')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="slug" class="control-label mb-1"> Slug</label>
                        <input id="slug" name="slug" type="text" class="form-control" value="{{ $slug }}" placeholder="Slug" required>
                        @error('slug')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" value="{{ $image }}">
                        @if($image != '')
                         <a href="{{ asset('storage/media/'.$image) }}" target="_blank"><img src="{{ asset('storage/media/'.$image) }}" alt=""></a>
                        @endif
                        @error('image')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="category_id" class="control-label mb-1"> Category</label>
                                 <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $list)
                                    @if($list->id == $category_id) 
                                    <option selected value="{{ $list->id }}">
                                       @else
                                    <option value="{{ $list->id }}">
                                       @endif
                                       {{ $list->category_name }}
                                    </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="brand" class="control-label mb-1"> Brand</label>
                                 <select name="brand" id="brand" class="form-control" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $list)
                                    @if($brand==$list->id) 
                                    <option selected value="{{ $list->id }}">
                                       @else
                                    <option value="{{ $list->id }}">
                                       @endif
                                       {{ $list->name }}
                                    </option>
                                    @endforeach
                                 </select>
                                 @error('brand')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="model" class="control-label mb-1"> Model</label>
                                 <input id="model" name="model" type="text" class="form-control" value="{{ $model }}" placeholder="Model" required>
                                 @error('model')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="short_desc" class="control-label mb-1"> Short Description</label>
                        <textarea name="short_desc" id="short_desc" class="form-control">{{ $short_desc }}</textarea>
                   
                        @error('short_desc')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="description" class="control-label mb-1"> Description</label>
                        <textarea name="desc" id="desc" class="form-control">{{ $desc }}</textarea>
                        @error('desc')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="keywords" class="control-label mb-1"> Keywords</label>
                        <textarea name="keywords" id="keywords" class="form-control">{{ $keywords }}</textarea>
                        @error('keywords')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="technical_specification" class="control-label mb-1"> Technical Specification</label>
                        <textarea name="technical_specification" id="technical_specification" class="form-control">{{ $technical_specification }}</textarea>
                        @error('technical_specification')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="uses" class="control-label mb-1"> Uses</label>
                        <textarea name="uses" id="uses" class="form-control">{{ $uses }}</textarea>
                        @error('uses')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="warranty" class="control-label mb-1"> Warranty</label>
                        <textarea name="warranty" id="warranty" class="form-control">{{ $warranty }}</textarea>
                        @error('warranty')
                        <li class='error_message'>{{ $message }}
                        </li>
                        @enderror
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group">
                                 <label for="model" class="control-label mb-1"> Lead Time</label>
                                 <input id="lead_time" name="lead_time" type="text" class="form-control" value="{{ @$lead_time }}" placeholder="Lead Time">
                                 @error('lead_time')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="tax" class="control-label mb-1"> Tax</label>
                                 <select name="tax_id" id="tax_id" class="form-control">
                                 <option value="">Select Tax</option>
                                 @foreach($taxs as $tax)
                                    @if($tax->id==$tax_id)
                                       <option selected value="{{ $tax->id }}">
                                    @else
                                    <option value="{{ $tax->id }}">
                                    @endif
                                    {{ $tax->tax_desc }}</option>
                                 @endforeach
                              </select>

                                 @error('tax')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                           
                   

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="is_promo" class="control-label mb-1"> Promo</label>
                                 <select name="is_promo" id="is_promo" class="form-control" required>
                                    @if($is_promo==1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="brand" class="control-label mb-1"> Featured</label>
                                 <select name="is_featured" id="is_featured" class="form-control" required>
                                    @if($is_featured==1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                 </select>
                                 @error('is_featured')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="brand" class="control-label mb-1"> Disconnect</label>
                                 <select name="is_discounted" id="is_discounted" class="form-control" required>
                                    @if($is_discounted==1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                 </select>
                                 @error('is_discounted')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="brand" class="control-label mb-1"> Tranding</label>
                                 <select name="is_tranding" id="is_tranding" class="form-control" required>
                                    @if($is_tranding==1)
                                    <option selected value="1">Yes</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                    @endif
                                 </select>
                                 @error('is_tranding')
                                 <li class='error_message'>{{ $message }}
                                 </li>
                                 @enderror
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" id="more_product_images">
            <h2 style="margin-bottom: 10px">Product Images</h2>
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row" id="product_images_box">
                        @php
                        $product_images_num = 1;
                        @endphp
                        @foreach($product_atrri_images as $key=>$val)
                        @php 
                        $product_images_prev = $product_images_num;
                        $product_image_arr = (array)$val;
                        @endphp
                        <input type="hidden" name="piid[]" id="piid" value="{{ $product_image_arr['id'] }}">
                        <div class="col-md-4 product_images_{{ $product_images_num++  }}" id="product_img_count">
                           <div class="form-group">
                              <label for="image" class="control-label mb-1">  Image</label>
                              <input type="file" name="images[]" id="images" class="form-control">
                           </div>
                           @if($product_image_arr['images'] !='')
                           <a href="{{ asset('storage/media') }}/{{$product_image_arr['images']}}" target="_blank"><img src="{{ asset('storage/media') }}/{{$product_image_arr['images']}}" width="100" height="100" alt=""></a>
                           @endif
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="space" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                              @if($product_images_num==2)                       
                              <button id="more_product_image" type="button" class="btn btn-sm btn-info btn-block" onclick="add_images()">
                              <i class="fa fa-plus"> Add Image</i>
                              </button>
                              @else
                              <a href="{{ url('admin/product/product_image_delete/') }}/{{$product_image_arr['id']}}/{{$product_id }}"> <button id="more_product_id" type="button" class="btn btn-sm btn-danger btn-block" style="margin-top: 34px">
                              <i class = "fa fa-minus"> Remove</i></button></a>
                              @endif
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" id="more_product_attr">
            <h2 style="margin-bottom: 10px">
            Product Attribute</h3>
            @php
            $product_attri_num = 1;
            @endphp
            @foreach($product_atrri_data as $key=>$val)
            @php 
            $is_new=true;
            $product_attri_prev = $product_attri_num;
            $product_atrri_arr = (array)$val;
            @endphp
            <input type="hidden" name="update_product_atrri_id[]" id="update_product_atrri_id" value="{{ $product_atrri_arr['id'] }}"> 
            <div class="col-md-12" id="product_attri_{{ $product_attri_num++ }}">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input type="text" name="sku[]" id="sku" class="form-control" value="{{ $product_atrri_arr['sku'] }}" required>
                              @error('sku')
                              <li class='error_message'>{{ $message }}</li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input type="text" name="mrp[]" id="mrp" class="form-control" value="{{ $product_atrri_arr['mrp'] }}">
                              @error('mrp')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input type="text" name="price[]" id="price" class="form-control" value="{{ $product_atrri_arr['price'] }}">
                              @error('price')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="qty" class="control-label mb-1">  Quantity</label>
                              <input type="text" name="qty[]" id="qty" class="form-control" value="{{ $product_atrri_arr['qty'] }}">
                              @error('qty')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="image" class="control-label mb-1">  Image</label>
                              <input type="file" name="attr_image[]" id="attr_image" class="form-control" >
                              @if($product_atrri_arr['attr_image'] !='')
                              <a href="{{ asset('storage/media') }}/{{$product_atrri_arr['attr_image']}}" target="_blank"><img src="{{ asset('storage/media') }}/{{$product_atrri_arr['attr_image']}}" width="100" height="100" alt="">
                           </a>
                              @endif
                              @error('attr_image')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="size" class="control-label mb-1">  Size</label>
                              <select name="size_id[]" id="size_id" class="form-control">
                                 <option value="">Select Category</option>
                                 @foreach($sizes as $list)
                                 @if($product_atrri_arr['size_id']==$list->id)
                                 <option selected value="{{ $list->id }}">
                                    @else
                                 <option value="{{ $list->id }}">
                                    @endif      
                                    {{ $list->size }}
                                 </option>
                                 @endforeach
                              </select>
                              @error('size')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="color" class="control-label mb-1">  Color</label>
                              <select name="color_id[]" id="color_id" class="form-control">
                                 <option value="">Select Color</option>
                                 @foreach($colors as $list)
                                 @if($product_atrri_arr['color_id']==$list->id)
                                 <option selected value="{{ $list->id }}">
                                    @else
                                 <option value="{{ $list->id }}">
                                    @endif
                                    {{ $list->color }}
                                 </option>
                                 @endforeach
                              </select>
                              @error('color')
                              <li class='error_message'>{{ $message }}
                              </li>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="space" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>
                              @if($product_attri_num==2 )
                              <button id="more_product_attr" type="button" class="btn btn-sm btn-info btn-block" onclick="add_more()">
                              <i class = "fa fa-plus"> Add More</i>
                              </button>
                              @else
                              <a href="{{ url('admin/product/product_attri_delete/') }}/{{$product_atrri_arr['id']}}/{{$product_id }}"> <button id="more_product_id" type="button" class="btn btn-sm btn-danger btn-block" style="margin-top: 34px">
                              <i class = "fa fa-minus"> Remove</i></button></a>
                              @endif
                           </div>
                        </div>
                     </div>
                     {{-- 
                  </div>
                  --}}
               </div>
            </div>
         </div>
         @endforeach
   </div>
   <div>
   <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
   Submit
   </button>
   </div>
   </form>
</div>
</div>
@endsection
<script>
   var loop_counter=1;
   var product_attri_id='';
   var product_attri_count=0;
   function add_more()
   {
    product_attri_count = $(":input[id='update_product_atrri_id']").length;
   
    if(product_attri_count > 1)
       loop_counter = product_attri_count;
    
    loop_counter++;
     
      var html='<input type="hidden" name="update_product_atrri_id[]" id="update_product_atrri_id" value=""> <div class="col-md-12" id="product_attri_'+loop_counter+'"><div class="card"><div class="card-body"><div class="row">';
   
          html +='<div class="col-md-3"><div class="form-group">'
              +'<label for="sku" class="control-label mb-1"> SKU</label>'+
                                  '<input type="text" name="sku[]" id="sku" class="form-control" required>'+
                      '</div>'+
                  '</div>';
   
          html +='<div class="col-md-3"><div class="form-group">'
              +'<label for="mrp" class="control-label mb-1"> MRP</label>'+
                                  '<input type="text" name="mrp[]" id="mrp" class="form-control">'+
                      '</div>'+
                  '</div>';
   
          html +='<div class="col-md-3"><div class="form-group">'
              +'<label for="price" class="control-label mb-1"> Price</label>'+
                                  '<input type="text" name="price[]" id="price" class="form-control">'+
                      '</div>'+
                  '</div>'+
                  '<div class="col-md-3"><div class="form-group">'
              +'<label for="qty" class="control-label mb-1"> Quantity</label>'+
                                  '<input type="text" name="qty[]" id="qty" class="form-control">'+
                      '</div>'+
                  '</div>';
          html += '<div class="col-md-3"><div class="form-group">'+
                      '<label for="image" class="control-label mb-1">  Image</label>'+
                          '<input type="file" name="attr_image[]" id="attr_image" class="form-control">'+
                  '</div></div>';
          var size_select = jQuery('#size_id').html();
          size_select = size_select.replace("selected", "");
          html += '<div class="col-md-3"><div class="form-group">'+
                      '<label for="size" class="control-label mb-1">  Size</label>'+
                      '<select name="size_id[]" id="size_id" class="form-control">'+size_select+'</select></div></div>';
          var color_select = jQuery('#color_id').html();
          color_select = color_select.replace("selected", "");
          html += '<div class="col-md-3"><div class="form-group">'+
                      '<label for="image" class="control-label mb-1">  Color</label>'+
                      '<select name="color_id[]" id="color_id" class="form-control">'+color_select+'</select></div></div>';
          html += '<div class="col-md-2"><div class="form-group">'+
              '<label for="space" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>'+
                  '<button id="payment-button" type="button" class="btn btn-sm btn-danger btn-block" onclick=Remove("'+loop_counter+'")><i class="fa fa-minus"> Remove</i></button></div></div>';  
   
   
       html +='</div></div></div></div>';
   
       jQuery('#more_product_attr').append(html);
   
       
   }
   
   function Remove(loop_counter)
   {
      jQuery("#product_attri_"+loop_counter).remove();
   }
   
   
   var product_image_counter=1;
   
   function add_images()
   {
       product_image_counter++;
    var img_html = '<input type="hidden" name="piid[]" id="piid" value=""><div class="col-md-4 product_images_'+product_image_counter+'" ><div class="form-group">'+
                      '<label for="image" class="control-label mb-1">  Image</label>'+
                          '<input type="file" name="images[]" id="images" class="form-control">'+
                  '</div></div>';
    img_html += '<div class="col-md-2 product_images_'+product_image_counter+'"><div class="form-group">'+
              '<label for="space" class="control-label mb-1">&nbsp;&nbsp;&nbsp;</label>'+
                  '<button id="payment-button" type="button" class="btn btn-sm btn-danger btn-block" onclick=Remove_image("'+product_image_counter+'")><i class="fa fa-minus"> Remove</i></button></div></div>';  
   
                  jQuery('#product_images_box').append(img_html);
   }
   
   function Remove_image(product_image_counter)
   {
      jQuery(".product_images_"+product_image_counter).remove();
   }
   
</script>