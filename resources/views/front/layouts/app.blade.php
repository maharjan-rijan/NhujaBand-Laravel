<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Nhuja Band @yield('title')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link type="image/x-icon" href="{{ asset('assets/front-assets/img/slide/logo.jpg') }}" rel="icon">
    <link href="{{ asset('assets/front-assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/front-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front-assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/front-assets/css/style.css') }}" rel="stylesheet">
    <!-- =======================================================
    * Template Name: MeFamily
    * Updated: Sep 18 2023 with Bootstrap v5.3.2
    * Template URL: https://bootstrapmade.com/family-multipurpose-html-bootstrap-template-free/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body>
@if($notice->isNotEmpty())
    @foreach ($notice as $events)
        <div class="modal" tabindex="-1" id="notice">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $events->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('uploads/Event/'.$events->image) }}" class="img-fluid" alt="" style="align-item: center!important">
                    </div> <hr>
                    <div class="modal-header">
                        <div class="card-body">
                            <h4 class="text-center bold"> Organized By: {{ $events->organizer }}</h4>
                            <h4 class="text-center">{{ $events->location }}</p>
                                <h4 class="font-monospace text-center">{{ date('Y - M - d',strtotime($events->date)) }}, {{ date('h:i A',strtotime($events->time)) }}</h4>
                            {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            @endif
        </div>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container d-flex justify-content-between align-items-center">


                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="{{ route('front.home') }}" class="logo me-auto me-lg-0"><img src="{{ asset('assets/front-assets/img/logo.png') }}" alt="" class="img-fluid"></a>
                <!-- <h1 class="logo"><a href="index.html">Nhuja Band</a></h1> -->
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li><a href="{{ route('front.our-members') }}">Our Members</a></li>
                        <li><a href="{{ route('front.events') }}">Events</a></li>
                        <li><a href="{{ route('front.gallery') }}">Gallery</a></li>
                        @if (staticPages()->isNotEmpty())
                            @foreach (staticPages() as $page)
                                @if ($page->slug == 'contact-us')
                                    <li><a href="{{ route('front.page',$page->slug) }}">Contact</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->
        <main id="main">
            @yield('content')
        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        @if (staticPages()->isNotEmpty())
            @foreach (staticPages() as $page)
                @if ($page->slug == 'contact-us')
                    <footer id="footer">
                        <div class="container">
                            <h3>Nhuja Band</h3>
                            <p>Shonitpur, Thankot</p>
                            <div class="social-links">
                                <a href="mailto:{{ $page->email }}" class="gmail"><i class="bx bxl-gmail"></i></a>
                                <a href="{{ $page->facebookUrl }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="{{ $page->instagramUrl }}" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="{{ $page->youtubeUrl }}" class="youtube"><i class="bx bxl-youtube"></i></a>
                            </div>
                            <div class="copyright">
                                &copy; Copyright <strong><span>NhujaBand</span></strong>. All Rights Reserved
                            </div>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/family-multipurpose-html-bootstrap-template-free/ -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>
                        </div>
                    </footer>
                @endif
            @endforeach
        @endif<!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="margin-bottom: 30px;"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/front-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/front-assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/front-assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/front-assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/front-assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('assets/front-assets/js/main.js')}}"></script>
        <script src="{{ asset('assets/front-assets/js/script.js')}}"></script>

        @yield('customJs')
</body>

</html>
