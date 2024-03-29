@extends('front.layouts.app')
@section('title')- Team Member @endsection
@section('content')
 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Our Members</h2>
        <ol>
          <li><a href="{{ route('front.home') }}">Home</a></li>
          <li>Our Members</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
  <!-- ======= Story Intro Section ======= -->
  <section id="story-intro" class="story-intro" style="padding: 0px!important; margin-top: 20px!important">
    <div class="container">

      <div class="row">
        @if (staticPages()->isNotEmpty())
        @foreach (staticPages() as $page)
        @if ($page->slug == 'about-us')
        <div class="col-lg-6 order-1 order-lg-2 align-self-center">
          <img src="{{ asset('uploads/Page/').'/'.$page->image }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <h1 style="text-align: center; font-family: 'Times New Roman', Times, serif; font-weight: bolder;">Nhuja Band</h1>
          {!! $page->content !!}
        </div>
        @endif
        @endforeach
        @endif
      </div>

    </div>
  </section>
  <!-- End Story Intro Section -->
  <!-- ======= Members Section ======= -->
 <section id="members" class="members">
    <div class="container">

      <div class="row">
        @if (getTeamMembers()->isNotEmpty())
        @foreach (getTeamMembers() as $members)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="member card border-dark">
            <div class="member-img">
                <img src="{{ asset('uploads/Member/').'/'.$members->image }}" class="img-fluid" alt="">
              <div class="social">
                <a href="mailto:{{ $members->email }}"><i class="bx bxl-gmail"></i></a>
                <a href="{{ $members->facebookUrl }}"><i class="bx bxl-facebook"></i></a>
                <a href="{{ $members->instagramUrl }}"><i class="bx bxl-instagram"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4 style="text-align: center;">{{ $members->name }}</h4>
              <h5 class="font-monospace" style="text-align: center;">+977 {{ $members->phone }}</h5>
              <h6 style="text-align: center; font-weight: 900;">{{ $members->band_role }}</h6>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </section>
  <!-- End Members Section -->

@endsection
