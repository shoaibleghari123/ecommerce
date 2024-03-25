/**
  * Template Name: Daily Shop
  * Version: 1.0
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS


  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER
  13. RELATED ITEM SLIDER (SLICK SLIDER)


**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX
  /* ----------------------------------------------------------- */

     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );

  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER
  /* ----------------------------------------------------------- */

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });


  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */

    jQuery(function(){
      if($('body').is('.productPage')){
          var start_price_filter = jQuery('#lower_price_filter').val();
          var end_price_filter = jQuery('#end_price_filter').val();

          if(start_price_filter == '' || end_price_filter == '')
          {
              start_price_filter = 20;
              end_price_filter = 800;
          }
       var skipSlider = document.getElementById('skipstep');
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 10,
                '20%': 20,
                '30%': 30,
                '40%': 40,
                '50%': 50,
                '60%': 60,
                '70%': 70,
                '80%': 800,
                '90%': 900,
                'max': 1000
            },
            snap: true,
            connect: true,
            start: [start_price_filter, end_price_filter]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });



  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });

    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });

  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

});

function change_product_color_image(img, color)
{
    jQuery('#color_id').val(color);
    jQuery('.simpleLens-big-image-container').html('<a data-lens-image="'+img+'" class="simpleLens-lens-image"><img src="'+img+'" class="simpleLens-big-image"></a>')
}

function showColor(size)
{
    jQuery('#size_id').val(size);
    jQuery('.product_color').hide();
    jQuery('.size_'+size).show();
    jQuery('.size_link').css('border', '1px solid #ddd');
    jQuery('#size_'+size).css('border', '1px solid black');
}
function home_add_to_cart(product_id, size_str_id, color_str_id){
    jQuery('#size_id').val(size_str_id);
    jQuery('#color_id').val(color_str_id);
    add_to_cart(product_id, size_str_id, color_str_id);
}
function add_to_cart(product_id, size_str_id, color_str_id)
{
    jQuery('#add_to_cart_msg').html("");
    var size_id = jQuery('#size_id').val();
    var color_id = jQuery('#color_id').val();

    if(size_str_id==0 && color_str_id==0)
    {
        size_id='no';
        color_id='no';
    }

    if(size_id =='' && size_id!='no')
    {
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger alert-dismissible m10"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select size.</div>');
    }else if(color_id=='' && color_id!='no'){
        jQuery('#add_to_cart_msg').html('<div class="alert alert-danger alert-dismissible m10"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select color.</div>');
    }else{
        jQuery('#product_id').val(product_id);
        jQuery('#pqty').val(jQuery('#qty').val());

        jQuery.ajax({
            url:'/add_to_cart',
            data:jQuery('#frmAddToCart').serialize(),
            type:'post',
            success:function(result){
                alert('product '+result.msg);
               var totalPrice=0;
                if(result.total==0)
                {
                  jQuery('.aa-cart-notify').html('0');
                  jQuery('.aa-cartbox-summary').remove();
                }else{

                  jQuery('.aa-cart-notify').html(result.total);
                  var html='';
                  html +='<ul>';
                  jQuery.each(result.data, function(arrKey,arrVal){
                    totalPrice = parseInt(totalPrice)+parseInt(arrVal.qty)*parseInt(arrVal.price);
                      html +='<li><a class="aa-cartbox-img" href=""><img src="'+PRODUCT_IMAGE +'/'+arrVal.image+'" alt="img"></a>'+
                      '<div class="aa-cartbox-info">'+
                        '<h4><a href="#">'+arrVal.name+'</a></h4>'+
                        '<p>'+arrVal.qty+' x '+arrVal.price+'</p>'+
                      '</div>'+
                      '<a class="aa-remove-product" href="javascript:void(0)" onclick=""><span class="fa fa-times"></span></a>'+
                    '</li>';
                  });

                  html +='<li>'+
                  '<span class="aa-cartbox-total-title">Total</span>'+
                          '<span class="aa-cartbox-total-price">'+totalPrice+'</span>'+
                      '</li>';
                  html +='</ul>';
                  html += '<a class="aa-cartbox-checkout aa-primary-btn" href="">Cart</a>';
                  jQuery('.aa-cartbox-summary').html(html);
                }
            }
        });
    }
}

function updateQty(product_id, size_id, color_id, attr_id, price){
    jQuery('#size_id').val(size_id);
    jQuery('#color_id').val(color_id);
    var qty = jQuery('#qty'+attr_id).val();
    jQuery('#qty').val(qty);
    add_to_cart(product_id, size_id, color_id);
    jQuery('#total_price_'+attr_id).html(qty*price);
}

function deleteProductCart(product_id, size_id, color_id, attr_id){
    jQuery('#size_id').val(size_id);
    jQuery('#color_id').val(color_id);
    jQuery('#qty').val(0);
    add_to_cart(product_id, size_id, color_id);
    jQuery('#cart_box'+attr_id).remove();
}

function sort_by()
{
    var sort_val = jQuery('#sort_by_value').val();
    jQuery('#sort').val(sort_val);
    jQuery('#productSortBy').submit();
}

function sort_price_filter()
{
    jQuery('#lower_price_filter').val(jQuery('#skip-value-lower').html());
    jQuery('#end_price_filter').val(jQuery('#skip-value-upper').html());
    jQuery('#productSortBy').submit();
}

function change_color_filter(color, type)
{
  var color_id=jQuery('#color_filter').val();
  if(type==1)
  {
    var color_str = color_id.replace(color+':','');
    jQuery('#color_filter').val(color_str);
  }else{
    jQuery('#color_filter').val(color+':'+color_id);
  }
    jQuery('#productSortBy').submit();
}

function searchFun()
{
  var searchStr = jQuery('#search_str').val();
  if(searchStr !='' && searchStr.length > 3)
  {
    window.location.href = '/search/'+searchStr;
  }
}

jQuery('#frmRegistration').submit(function(e){
  e.preventDefault();
  jQuery('.span_error').html('');
  jQuery.ajax({
    type : 'post',
    url : '/register',
    data: $('#frmRegistration').serialize(),
    success:function(response){
      //console.log(response);
      if(response.status=='error')
      {
        jQuery.each(response.error,function(key, val){
          jQuery('#'+key+'_error').html(val[0]);
        });
      }else{
        jQuery('#frmRegistration')[0].reset();
        jQuery('#thank_you_msg').html(response.msg);
      }
    },
  });
});

jQuery("#frmLogin").submit(function(e) {
  e.preventDefault();
  jQuery('#str_login_msg').html('');
  jQuery.ajax({
    url : '/login_process',
    data : jQuery("#frmLogin").serialize(),
    type : 'post',
    success : function(response)
    {
      if(response.status=='success')
      {
        jQuery('#str_login_msg').html(response.msg);
        window.location.href=window.location.href;
        //console.log(response);
      }else{
        jQuery('#str_login_msg').html(response.msg);
      }
    }
  });
  
});


function forgot_password()
{
 jQuery('#popup_forgot').show();
 jQuery('#popup_login').hide();
}

function show_login_popup()
{
  jQuery('#popup_forgot').hide();
  jQuery('#popup_login').show();
}


jQuery("#frmForgot").submit(function(e) {
  e.preventDefault();
  jQuery('#forgot_msg').html('Please Wait....');
  jQuery('#str_forgot_msg').html('');
  jQuery.ajax({
    url : '/forgot_process',
    data : jQuery("#frmForgot").serialize(),
    type : 'post',
    success : function(response)
    {
        jQuery('#str_forgot_msg').html(response.msg);
    }
  });
  
});



jQuery("#frmbtnForgotPassword").submit(function(e) {
  e.preventDefault();
  jQuery('#str_forgot_msg').html('');
  jQuery.ajax({
    url : '/forgot_password_change',
    data : jQuery("#frmbtnForgotPassword").serialize(),
    type : 'post',
    success : function(response)
    {
        jQuery('#str_forgot_msg').html(response.msg);
    }
  });
  
});


function apply_coupon_code() {
  jQuery('#coupon_code').html("");
  jQuery('#place_order_msg').html('');
  var coupon_code = jQuery('#couponCode').val();
  var tkn = jQuery("[name='_token']").val();
  
  if(coupon_code !=''){
   jQuery.ajax({
    url : '/apply_coupon_code',
    data : 'coupon_code='+coupon_code+'&_token='+tkn,
    type : 'post',
    success : function(response)
    {
      //result = jQuery.parseJson(response);
      result = response;
      if(result.status=='success')
      {
        jQuery('.show_coupon_box').removeClass('hide');
        jQuery('#coupon_code_str').html(result.coupon_code);
        jQuery('#coupon_total_price').html(result.totalPrice);
        jQuery('.apply_coupon_code_box').hide();
      }else{
        jQuery('#coupon_code').html(result.msg);
      }
      jQuery('#coupon_code').html(result.msg);
      //console.log(response);
        //jQuery('#str_forgot_msg').html(response.msg);
    }
  });
 }else{
  jQuery('#coupon_code').html("please select coupon code");
 }
}

function remove_coupon_code()
{
  jQuery('#coupon_code').html("");
  var coupon_code = jQuery('#couponCode').val();
  var tkn = jQuery("[name='_token']").val();

   if(coupon_code !=''){
   jQuery.ajax({
    url : '/remove_coupon_code',
    data : 'coupon_code='+coupon_code+'&_token='+tkn,
    type : 'post',
    success : function(response)
    {
      //result = jQuery.parseJson(response);
      result = response;
      if(result.status=='success')
      {
        jQuery('.show_coupon_box').addClass('hide');
        jQuery('#coupon_code_str').html("");
        jQuery('#coupon_total_price').html(result.totalPrice);
        jQuery('.apply_coupon_code_box').show();
        jQuery('#couponCode').val("");
      }else{
        jQuery('#coupon_code').html(result.msg);
      }
      jQuery('#coupon_code').html(result.msg);
      //console.log(response);
        //jQuery('#str_forgot_msg').html(response.msg); 
    }
  });
 }else{
  jQuery('#coupon_code').html("please select coupon code");
 }
}


jQuery("#frmPlaceOrder").submit(function(e) {
  e.preventDefault();
  jQuery('#place_order_msg').html('Please Wait....');
  jQuery.ajax({
    url : '/place_order',
    data : jQuery("#frmPlaceOrder").serialize(),
    type : 'post',
    success : function(response)
    {
      if(response.status=='success')
      {
        window.location.href="/order_placed";
      }
      if(response.status=='error')
      {

      }
      jQuery('#place_order_msg').html(response.msg);
    }
  });
  
});