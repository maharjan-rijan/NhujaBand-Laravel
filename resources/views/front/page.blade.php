@extends('front.layouts.app')
@section('title')- Contact @endsection
@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $page->name }}</h2>
            <ol>
              <li><a href="{{ route('front.home') }}">Home</a></li>
              <li>{{ $page->name }}</li>
            </ol>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->

      @if ($page->slug == 'contact-us')
     <section id="contact-us" class="contact-us">
        <div class="container">
            <div class="col-md-12">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
            </div>
            <div class="col-lg-12 order-1 order-lg-4">
              <img src="{{ asset('uploads/Page/'.$page->image) }}" class="img-fluid" alt="">
          </div>
          <div class="row mt-5">

            <div class="col-lg-4">
              <div class="info">
                <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>{{ $page->location }}</p>
                </div>

                <div class="email">
                  <a href="mailto:{{ $page->email}}"><i class="bi bi-envelope"></i></a>
                  <h4>Email:</h4>
                  <p>{{ $page->email }}</p>
                </div>
                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+977 {{ $page->phone }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-8 mt-5 mt-lg-0">
                <form action="" class="shake" role="form" method="post" id="contactForm" name="contactForm">
                    <div class="mb-3">
                        <label class="mb-2" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name"  data-error="Please enter your name">
                        <p class="help-block with-errors"></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email"  data-error="Please enter your Email">
                        <p class="help-block with-errors"></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject"  data-error="Please enter your message subject">
                        <p class="help-block with-errors"></p>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="mb-2">Message</label>
                        <textarea class="form-control" rows="3" id="message" name="message"  data-error="Write your message"></textarea>
                        <p class="help-block with-errors"></p>
                    </div>
                    <div class="form-submit">
                        <button  class="btn btn-primary" type="submit" id="form-submit"><i class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

          </div>
        </div>
      </section>
      @else
      <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $page->name }}</h2>
            <ol>
              <li><a href="{{ route('front.home') }}">Home</a></li>
              <li>{{ $page->name }}</li>
            </ol>
          </div>
        </div>
      </section>
      @endif
      <!-- ======= Contact Us Section ======= -->

@endsection
@section('customJs')
<script>
    $("#contactForm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: '{{ route("front.sendContactEmail") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if (response.status == true) {
                window.location.href = '{{ route("front.page",$page->slug) }}';
                } else {
                    var errors = response.errors;
                    if (errors.name) {
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.email) {
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.subject) {
                        $("#subject").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.subject);
                    } else {
                        $("#subject").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                }
            }
        })
    });
</script>
@endsection

