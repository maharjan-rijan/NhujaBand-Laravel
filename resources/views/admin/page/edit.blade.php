@extends('admin.layouts.app')
@section('title')- Page Edit @endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Page</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="pageForm" name="pageForm">
        <div class="card">
            <div class="card-body">
                <div class="col-md-6">
                    <div class="md-3">
                        <input type="hidden" id="image_id" name="image_id" value="">
                        <label for="image">Image</label>
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload.<br><br>
                            </div>
                        </div>
                    </div>
                        @if (!empty($page->image))
                        <div>
                            <img width="250" src="{{ asset('uploads/Page/').'/'.$page->image }}" alt="" srcset="">
                        </div>
                        @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input value="{{ $page->name }}" type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input value="{{ $page->slug }}" type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Location</label>
                            <input value="{{ $page->location }}" type="text" name="location" id="location" class="form-control" placeholder="Location">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input value="{{ $page->email }}" type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebookUrl">Facebook</label>
                            <input value="{{ $page->facebookUrl }}" type="url"  name="facebookUrl" id="facebookUrl" class="form-control" placeholder="Facebook Url">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="instagramUrl">Instagram</label>
                            <input value="{{ $page->instagramUrl }}" type="url"  name="instagramUrl" id="instagramUrl" class="form-control" placeholder="Instagram Url">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="youtubeUrl">Youtube</label>
                            <input value="{{ $page->youtubeUrl }}" type="url"  name="youtubeUrl" id="youtubeUrl" class="form-control" placeholder="Youtube Url">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone">Contact</label>
                            <input value="{{ $page->phone }}" type="text" name="phone" id="phone" class="form-control" placeholder="Contact">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="summernote" cols="30" rows="10">{!! $page->content !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
$('#pageForm').submit(function(event){
    event.preventDefault();

    var element = $(this);
    $("button[type=submit]").prop('disabled',true);

    $.ajax({
        url:'{{ route("pages.update",$page->id) }}',
        type: 'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true) {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                window.location.href="{{ route('pages.index') }}";
            } else {
                var errors = response['errors'];
            if(errors['name']){
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            if(errors['slug']){
                $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            }
            }

        }, error: function(jqXHR, exception){
            console.log("Something went wrong.");
        }
    });
});
$("#name").change(function(){
    element = $(this);
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{ route("getSlug") }}',
        type: 'get',
        data: { title: element.val()},
        dataType: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true){
                $("#slug").val(response["slug"]);
            }
        }
    });
});

Dropzone.autoDiscover = false;
const dropzone = $("#image").dropzone({
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        //console.log(response)
    }
});
</script>
@endsection

