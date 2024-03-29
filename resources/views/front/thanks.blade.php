@extends('front.layouts.app')

@section('content')
<section class="container">
    <div class="col-md-12 text-center py-5">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
    </div>
    <h1>Thank You!</h1>
    <p>Your request Id is : {{ $id }}</p>

</section>
@endsection
