@extends('admin.layouts.app')
@section('title')- Gallery Create @endsection
@section('content')
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Add Images</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('galleries.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form action="" method="post" id="galleryForm" name="galleryForm">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="hidden" name="image_id" id="image_id" value="">
                                        <label for="image">Image</label>
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop files here or click to upload. <br>1800 &times; 1200 px<br>
                                            </div>
                                        </div>
                                        <p></p>
                                      </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="time">Time</label>
                                            <input type="time" name="time" id="time" class="form-control" placeholder="Time">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="photographer">PhotoGrapher</label>
                                            <input type="text" name="photographer" id="photographer" class="form-control" placeholder="Photo By">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="showHome">Show on home</label>
                                            <select name="showHome" id="showHome" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 pt-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('galleries.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                        </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection
@section('customJs')
<script>
    $("#title").change(function(){
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

$('#galleryForm').submit(function(event){
    event.preventDefault();
    var formArray = $(this).serializeArray();
    $("button[type=submit]").prop('disabled',true);
    $.ajax({
        url:'{{ route("galleries.store") }}',
        type: 'post',
        data: formArray,
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true) {
                $(".error").removeClass('invalid-feedback').html("");
                $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                window.location.href="{{ route('galleries.index') }}";
            } else {
                var errors = response['errors'];
                $(".error").removeClass('invalid-feedback').html("");
                $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                $.each(errors,function(key,value){
                    $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                });
             }

        }, error: function(jqXHR, exception){
            console.log("Something went wrong.");
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
