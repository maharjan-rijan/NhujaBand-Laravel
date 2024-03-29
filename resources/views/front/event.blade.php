@extends('front.layouts.app')
@section('title')- Event @endsection
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Events</h2>
                <ol>
                    <li><a href="{{route('front.home') }}">Home</a></li>
                    <li>Events</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Event List Section ======= -->
    <section id="event-list" class="event-list">
        <div class="container">

            <div class="row">
                @if (getEvents()->isNotEmpty())
                    @foreach (getEvents() as $event)
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="card">
                                <div class="card-img">
                                    <img src="{{ asset('uploads/Event/'.$event->image) }}" class="img-fluid" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="fst text-center"> Organized By: {{ $event->organizer }}</p>
                                    <p class="fst-italic text-center">{{ $event->location }}</p>
                                    <p class="fst-italic text-center">{{ date('Y - M - d',strtotime($event->date)) }}, {{ date('h:i A',strtotime($event->time)) }}</p>
                                    <a href="{{ route('front.event-details',$event->slug) }}"><button type="button" class="btn btn-outline-secondary">Learn More</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section><!-- End Event List Section -->

@endsection
