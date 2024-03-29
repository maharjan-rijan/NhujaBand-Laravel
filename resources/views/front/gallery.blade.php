@extends('front.layouts.app')
@section('title')- Gallery @endsection
@section('content')
 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Gallery</h2>
        <ol>
          <li><a href="{{ route('front.home') }}">Home</a></li>
          <li>Gallery</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="gallery-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-home">Home</li>
            {{-- <li data-filter=".filter-beach">Beach</li>
            <li data-filter=".filter-vacation">Vacation</li> --}}
          </ul>
        </div>
      </div>
      <div class="row gallery-container">
        @if (getGalleries()->isNotEmpty())
      @foreach (getGalleries() as $gallery)
        <div class="col-lg-4 col-md-6 gallery-item filter-home">
          <div class="gallery-wrap">
            <img src="{{ asset('uploads/Gallery/'.$gallery->image) }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>{{ $gallery->title }}</h4>
              <p>{{$gallery->date}}, {{ date('m:i A',strtotime($gallery->time)) }}</p>
              <div class="gallery-links">
                <a href="{{ asset('uploads/Gallery/'.$gallery->image) }}" class="glightbox" title="<h4>{{ $gallery->title }}</h4>
                    <p>{{$gallery->date}}, {{ date('m:i A',strtotime($gallery->time)) }},By: {{ $gallery->photographer }}</p>"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-lg-4 col-md-6 gallery-item filter-vacation">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/gallery2.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Vacation 2</h4>
              <p>Vacation</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/gallery2.jpg') }}" class="glightbox" title="Vacation 2"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-home">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/gallery3.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Home 2</h4>
              <p>Home</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/gallery3.jpg') }}" class="glightbox" title="Home 2"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-beach">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/gallery4.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Beach 2</h4>
              <p>Beach</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/gallery4.jpg') }}" class="glightbox" title="Beach 2"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-vacation">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/gallery3.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Vacation 1</h4>
              <p>Vacation</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/gallery3.jpg') }}" class="glightbox" title="Vacation 1"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-home">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/gallery1.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Home 3</h4>
              <p>Home</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/gallery1.jpg') }}" class="glightbox" title="Home 3"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-beach">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/beach-1.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Beach 1</h4>
              <p>Beach</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/beach-1.jpg') }}" class="glightbox" title="Beach 1"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-beach">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/beach-3.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Beach 3</h4>
              <p>Beach</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/beach-3.jpg') }}" class="glightbox" title="Beach 3"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 gallery-item filter-vacation">
          <div class="gallery-wrap">
            <img src="{{ asset('front-assets/assets/img/gallery/vacation-3.jpg') }}" class="img-fluid" alt="">
            <div class="gallery-info">
              <h4>Vacation 3</h4>
              <p>Vacation</p>
              <div class="gallery-links">
                <a href="{{ asset('front-assets/assets/img/gallery/vacation-3.jpg') }}" class="glightbox" title="Vacation 3"><i class="bx bx-plus"></i></a>
              </div>
            </div>
          </div>
        </div> --}}
        @endforeach
      @endif
      </div>
    </div>
  </section><!-- End Gallery Section -->

@endsection
