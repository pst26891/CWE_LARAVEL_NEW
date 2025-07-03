<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @include('elements.head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/favicon.svg">
    <!-- NewsViral CSS  -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/widgets.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/color.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/responsive.css">
</head>

<body>
    <!-- Preloader Start -->
     <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img class="jump mb-50" src="assets/imgs/loading.svg" alt="">
                    <h6>Now Loading</h6>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="main-wrap">
         <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
            <button class="off-canvas-close"><i class="ti-close"></i></button>
            <div class="sidebar-inner">
                <!--Search-->
                <div class="siderbar-widget mb-50 mt-30">
                    <form method="GET" action="{{ url('/')}}/search/articles" class="search-form position-relative">
                        <input type="text" class="search_field" placeholder="Search" value="{{ request('search') }}" name="search">
                        <span class="search-icon"><i class="ti-search mr-5"></i></span>
                    </form>
                </div>
                <!--lastest post-->
                
               
               
            </div>
        </aside>
        @include('elements.navbar')
        <main class="position-relative">
            <div class="container">
                <div class="row">
                    <!-- sidebar-left -->
                    @include('elements.left_sidebar')


                    <!-- main content -->
                    @yield('content')
                </div>
            </div>
        </main>
        @include('elements.footer')
    </div> <!-- Main Wrap End-->
    <div class="dark-mark"></div>
    <!-- Vendor JS-->
    <script src="{{ url('/')}}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/popper.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/bootstrap.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.slicknav.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/owl.carousel.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/slick.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/wow.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/animated.headline.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.magnific-popup.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.ticker.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.vticker-min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.scrollUp.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.sticky.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/perfect-scrollbar.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/waypoints.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.counterup.min.js"></script>
    <script src="{{ url('/')}}/assets/js/vendor/jquery.theia.sticky.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- NewsViral JS -->
    <script src="{{ url('/')}}/assets/js/main.js"></script>
</body>

</html>