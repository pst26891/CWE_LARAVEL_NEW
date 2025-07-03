<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Enviro Research Publishers | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ url('/')}}/admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ url('/')}}/admin_assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ url('/')}}/admin_assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" style="color:#09e605"><b>Enviro Admin</b></a>
        </div>
         <form action="{{ url('/')}}/manage/login/checkLogin" method="post" id="login-form">
            @csrf
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">

                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input type="password" name="password"  class="form-control" placeholder="Password">
                </div>
            </div>

                <div class="form-group" style="padding: 10px;">
                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                    <label for="password" class="">Captcha</label>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                        </div>
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" style="margin-top: 10px;">
                        @if ($errors->has('captcha'))
                            <span class="help-block">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                </div>
           
                @if(Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                @endif

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
          
           
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{ url('/')}}/admin_assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="{{ url('/')}}/admin_assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{ url('/')}}/admin_assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{ url('/')}}/admin_assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ url('/')}}/admin_assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    captcha:{
                    required: true,
                   },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });

        $(".btn-refresh").click(function(){
            $.ajax({
                type:'GET',
                url:"{{url('captch/mews/refresh_captcha')}}",
                success:function(data){
                    $(".captcha span").html(data.captcha);
                }
            });
            });
    </script>
</body>

</html>