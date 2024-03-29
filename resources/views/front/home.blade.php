@extends('front.layouts.app')
@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{ asset('assets/front-assets/img/slide/slide-1.jpg') }})">
        </div>
        <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url({{ asset('assets/front-assets/img/slide/slide-2.jpg') }})">
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url({{ asset('assets/front-assets/img/slide/slide-3.jpg') }})">
        </div>
      </div>
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
  </section>
  <!-- End Hero -->
<!-- ======= About Us Section ======= -->
@if (staticPages()->isNotEmpty())
        @foreach (staticPages() as $page)
        @if ($page->slug == 'about-us')
<section id="about" class="about" style="padding-bottom: 10px!important;">
    <div class="container">
      <div class="section-title" >
        <h2>{{ $page->name }}</h2>
      <div class="row content">
        <div class="col-lg-6 align-self-center">
            <img src="{{ asset('uploads/Page/').'/'.$page->image }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 align-self-center">
          {!! $page->content !!}
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- End about Section -->
  <!-- ======= Recent Photos Section ======= -->
  <section id="recent-photos" class="recent-photos" style="padding-top: 20px!important;">
    <div class="container">
      <div class="section-title">
        <h2>Recent Photos</h2>
        {!! $page->content !!}
      </div>
      <div class="recent-photos-slider swiper">
        <div class="swiper-wrapper align-items-center">
            @if (getGalleries()->isNotEmpty())
            @foreach (getGalleries() as $gallery)
          <div class="swiper-slide"><a href="{{ asset('uploads/Gallery/'.$gallery->image) }}" class="glightbox"><img src="{{ asset('uploads/Gallery/'.$gallery->image) }}" class="img-fluid" alt=""></a></div>
          @endforeach
          @endif
          {{-- <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-2.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-2.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-3.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-3.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-4.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-4.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-5.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-5.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-6.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-6.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-7.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-7.jpg') }}" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="{{ asset('front-assets/assets/img/recent-photos/recent-photos-8.jpg') }}" class="glightbox"><img src="{{ asset('front-assets/assets/img/recent-photos/recent-photos-8.jpg') }}" class="img-fluid" alt=""></a></div> --}}
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <div class="recent-photos-slider swiper">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="swiper-wrapper align-items-center">
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  @endif
  @endforeach
  @endif
  <!-- End Recent Photos Section -->

@endsection
