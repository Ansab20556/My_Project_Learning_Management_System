<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - iPortfolio Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="theme/img/favicon.png" rel="icon">
  <link href="theme/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
<link href="{{ asset('theme/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('theme/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('theme/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('theme/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('theme/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ asset('theme/css/main.css') }}" rel="stylesheet">


  <!-- =======================================================
  * Template Name: iPortfolio
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    @yield('head')
</head>

<body class="index-page">

  @include('theme.header')

  <main class="main">


<div class="container-fluid">
          @if(Session::has('flash_message'))
              <div class="p-3 mb-2 bg-success text-white rounded text-center">
                  {{ session('flash_message') }}
              </div>
          @endif
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
          </div>

          @yield('content')

        </div>



  </main>

   @include('theme.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
<script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('theme/vendor/typed.js/typed.umd.js') }}"></script>
<script src="{{ asset('theme/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('theme/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('theme/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('theme/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('theme/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('theme/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('theme/js/main.js') }}"></script>

<!-- ✅ ضيف jQuery هنا -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   @yield('script')

</body>

</html>

