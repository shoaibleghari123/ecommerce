@extends('front.layout')
@section('page_title', 'Registration')
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


<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="aa-myaccount-area">         
             <div class="row">

               <div class="col-md-6">
                 <div class="aa-myaccount-register">                 
                  <h4>Register</h4>
                  <form action="" class="aa-login-form" id="frmRegistration">
                     <label for="">Name<span>*</span></label>
                     <input type="text" id="name" name="name" placeholder="Name" required>
                     <span id="name_error" class="span_error"></span>
                     <label for="email">Email<span>*</span></label>
                     <input type="email" id="email" name="email" placeholder="Eail" required>
                     <span id="email_error" class="span_error"></span>
                     <label for="mobile">Mobile<span>*</span></label>
                     <input type="text" id="mobile" name="mobile" placeholder="Mobile" required>
                     <span id="mobile_error" class="span_error"></span>
                     
                     <label for="">Password<span>*</span></label>
                     <input type="password" id="password" name="password" placeholder="Password" required>
                     <span id="password_error" class="span_error"></span>
                     <button type="submit" id="btnRegistration" class="aa-browse-btn">Register</button>                    
                     @csrf
                   </form>
                 </div>
                 <div id="thank_you_msg" class="span_error"></div>
               </div>
             </div>          
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->


@endsection

