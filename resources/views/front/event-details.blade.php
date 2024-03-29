@extends('front.layouts.app')
@section('title')- Event @endsection
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Events Detail</h2>
        <ol>
          <li><a href="{{route('front.home') }}">Home</a></li>
          <li>Events Detail</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs -->
  <section id="about" class="about" style="padding-bottom: 10px!important;">
    <div class="container">
      <div class="section-title" >
      <div class="row content">
        <div class="col-lg-6">
          <img src="{{ asset('uploads/Event/'.$event->image) }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-6">
            <h2>{{ $event->title}}</h2>
            <ul style="text-align: start; font-weight:bold;">
                <li>Location : <span style="font-weight: 600; font-family: 'Arial', Times, serif;">{{ $event->location}}</span></li>
                <li>Date : <span style="font-weight: 600; font-family: 'Arial', Times, serif;">{{ date('Y-M-d',strtotime($event->date)) }}</span></li>
                <li>Time : <span style="font-weight: 600; font-family: 'Arial', Times, serif;">{{ date('m:i A',strtotime($event->time)) }}</span></li>
                <li>Organize By : <span style="font-weight: 600; font-family: 'Arial', Times, serif;">{{ $event->organizer}}</span></li>
            </ul>
            <h4>Sponsor By: </h4>
            {!! $event->content !!}
        </div>
      </div>
    </div>
    </div>
  </section>
@endsection
