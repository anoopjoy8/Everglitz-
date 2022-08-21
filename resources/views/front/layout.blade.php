<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{Config::get('constants.PROJECT_NAME')}}</title>
    <!-- Bootstrap -->
    <link href="{{env('ASSET_URL')}}/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{env('ASSET_URL')}}/Front/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/Front/css/owl.carousel.min.css">

    <!--ANIMATIONS-->
    <link href="{{env('ASSET_URL')}}/Front/css/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eab4296d49.js"></script>
    <link rel="shortcut icon" href="{{env('ASSET_URL')}}/front/images/favicon.jpg" />
    @yield('header-script')

</head>

<body>
    <!--mob header-->
    <header class="hidden-desk">
        <div class="container">

            <div class="top_area">
                <ul class="top_ph">
                    <li><i class="far fa-envelope" aria-hidden="true"></i>{{$email}}</li>
                    <li><i class="fas fa-phone-alt" aria-hidden="true"></i>{{$phone1}}</li>
                    <li class="wts"><i class="fab fa-whatsapp" aria-hidden="true"></i>{{$phone2}}</li>
                </ul>
            </div>

            <div class="row m-0">
                <div class="col-7 logo p-0">
                    <span class="col-md-3 logo p-0">
                        <a href="index.html"><img src="{{env('ASSET_URL')}}/Front/images/Eventtext.png"></a>
                    </span>
                </div>

                <div class="col-5 right-side p-0">
                    <span onclick="openNav()" class="fs5 text-end togl_btn">
                        <i class="fas fa-bars"></i>
                    </span>
                    <div id="mySidenav" class="sidenav" style="text-align: left; width: 0px;">

                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        <a href="#">Wedding Planner</a>
                        <a href="#">Portfolio</a>
                        <a href="#">Services</a>
                        <a href="#">Contact uS</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--mob header-->
    <header class="hidden-mob">
        <div class="container">
            <div class="row m-0">
                
                <div class="col-md-3 logo p-0">
                    <a href="index.html"><img src="{{env('ASSET_URL')}}/Front/images/Eventtext.png"></a>
                </div>
                <div class="col-md-9 right-side p-0">
                    <div class="flex">
                        <ul class="top_ph">
                            <li><i class="far fa-envelope"></i>{{$email}}</li>
                            <li><i class="fas fa-phone-alt"></i>{{$phone1}}</li>
                            <li class="wts"><i class="fab fa-whatsapp"></i>{{$phone2}}</li>
                        </ul>
                    </div>
                    <div class="col-md-12 hidden-mob">
                        <ul class="menu">
                            <li class="active_menu"><a href="index.html">Wedding Planner</a></li>
                            <li><a href="portfolio.html">Portfolio</a></li>
                            <li><a href="services.html">Services</a>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>USEFUL LINKS</h3>
                    <ul class="ftr_lnk">
                        <li><a href="index.html">Wedding Planner</a></li>
                        <li><a href="portfolio.html">Portfolio</a></li>
                        <li><a href="stories.html">Stories</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-5">
                    <h3>CONTACT DETAILS</h3>
                    <ul class="ftr_cnt">
                        <li><i class="fas fa-mobile-alt"></i><a>+91 123 456 7890</a></li>
                        <li><i class="far fa-envelope"></i><a>info@email.com</a></li>
                        <li><i class="fas fa-map-marker-alt"></i>Suite 100, 1st Floor
                            80 Hebron Way
                            Canada </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h3>FOLOW US</h3>

                    <ul class="ftr_scl">
                        <li><img src="{{env('ASSET_URL')}}/Front/images/social_01.jpg"></li>
                        <li><img src="{{env('ASSET_URL')}}/Front/images/social_02.jpg"></li>
                        <li><img src="{{env('ASSET_URL')}}/Front/images/social_03.jpg"></li>
                        <li><img src="{{env('ASSET_URL')}}/Front/images/social_04.jpg"></li>
                        <li><img src="{{env('ASSET_URL')}}/Front/images/social_05.jpg"></li>
                    </ul>

                </div>

            </div>
        </div>
    </footer>

    <div class="greY_ftr py-4 text-center">
        <p class="text-white-50 m-0">© 2021 Everglitz Event Management. All rights reserved.</p>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{env('ASSET_URL')}}/Front/js/bootstrap.min.js"></script>
    <script src="{{env('ASSET_URL')}}/Front/js/bootstrap.bundle.min.js"></script>

    <script src="{{env('ASSET_URL')}}/Front/js/owl.carousel.js"></script>
    <!-- Bootstrap Js -->

    <!--animation-->
    <script src="js/aos.js"></script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <script>
        $('#home .owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                900: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })

        $('#course .owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
            dots: false,
            autoplay: false,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })

        $('#why_slider .owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                900: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })
        $('#testi .owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                900: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        })

        $('#vdos .owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
            dots: false,
            autoplay: false,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        })
    </script>


    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(document).scrollTop() > 50) {
                    $(".header").addClass("fixed-top");
                    $("#scrollToTopBtn").addClass("scrollToTopBtn-opc");
                } else {
                    $(".header").removeClass("fixed-top");
                    $("#scrollToTopBtn").removeClass("scrollToTopBtn-opc");
                }
            });

        });
    </script>

    <script>
        AOS.init({
            once: true
        });
    </script>
    @yield('footer-script')
</body>
</html>