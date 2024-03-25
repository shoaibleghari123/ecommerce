<!DOCTYPE html>
<html lang="en">

<head>

    <style>

        .error_message{
            color: #df0f24;
    
        }

        .success_message{
            color: #044919;
    
        }
    </style>



    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_assets/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            
                            <a href="#">
                                {{ Config::get('constants.SITE_NAME') }}
                            </a>
                        </div>
                        <div class="login-form">
                            <?php if(session()->get('error')){ ?>
                                <li class="error_message">{{ session()->get('error') }}</li>
                            <?php } ?>

                            <?php if(session()->get('success_message')){ ?>
                                <li class="success_message">{{ session()->get('success_message') }}</li>
                            <?php } ?>

                            <form action="{{ route('admin.auth') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="text" name="email" placeholder="Email">
                                    <?php echo ($errors->first('email', "<li class='error_message'>:message</li>")) ?>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" >
                                    <?php echo ($errors->first('password', "<li class='error_message'>:message</li>")) ?>
                                </div>
                          
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                             
                            </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin_assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin_assets/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin_assets/vendor/wow/wow.min.js') }}"></script>
    


    <!-- Main JS-->
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->