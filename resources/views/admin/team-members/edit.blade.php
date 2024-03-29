@extends('admin.layouts.app')
@section('title')- Team Member Edit @endsection
@section('content')
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Members</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('team-members.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form action="" method="post" id="memberForm" name="memberForm">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="md-3">
                                        <input type="hidden" id="image_id" name="image_id" value="">
                                        <label for="image">Image</label>
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop files here or click to upload.<br>600 &times; 600 px<br>
                                            </div>
                                        </div>
                                    </div>
                                        @if (!empty($members->image))
                                        <div>
                                            <img width="250" src="{{ asset('uploads/Member/').'/'.$members->image }}" alt="" srcset="">
                                        </div>
                                        @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $members->name }}">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $members->slug }}">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="band_role">Position</label>
                                            <input type="text" name="band_role" id="band_role" class="form-control" placeholder="Position" value="{{ $members->band_role }}">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $members->email }}">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebookUrl">Facebook</label>
                                            <input type="url"  name="facebookUrl" id="facebookUrl" class="form-control" placeholder="Facebook Url" value="{{ $members->facebookUrl }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagramUrl">Instagram</label>
                                            <input type="url"  name="instagramUrl" id="instagramUrl" class="form-control" placeholder="Instagram Url" value="{{ $members->instagramUrl }}" >
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone">Contact</label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Contact No." value="{{ $members->phone }}">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 pt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('team-members.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                        </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection

@section('customJs')
<script>
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

$('#memberForm').submit(function(event){
    event.preventDefault();

    var formArray = $(this).serializeArray();
    $("button[type=submit]").prop('disabled',true);

    $.ajax({
        url:'{{ route("team-members.update",$members->id) }}',
        type: 'put',
        data: formArray,
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true) {
                $(".error").removeClass('invalid-feedback').html("");
                $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                window.location.href="{{ route('team-members.index') }}";
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
