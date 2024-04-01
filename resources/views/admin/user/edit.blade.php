@extends('admin.layouts.app')
@section('title')- Page Edit @endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" id="userForm" name="userForm">
        <div class="card">
            <div class="card-body">
                <div class="col-md-3">
                    <div class="md-3">
                        <input type="hidden" id="image_id" name="image_id" value="">
                        <label for="image">Profile Picture</label>
                        <div id="image" class="dropzone dz-clickable" >
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload. <br>2400 &times; 1800 px<br>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->image != '')
                    <img src="{{ asset('/thumb/'.Auth::user()->image) }}" alt="avatar"  class="img-thumbnail" width="40">
                @else
                    <img src="{{ asset('assets/front-assets/img/slide/logo.jpg') }}" alt="avatar" class="img-thumbnail" width="150">
                @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input value="{{ $user->name }}" type="text" name="name" id="name" class="form-control" placeholder="Name">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input  value="{{ $user->email }}" type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input  value="{{ $user->phone }}" type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <span>To change password you have to enter a value, Otherwise leave blank.</span>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option {{ ($user->role == 2) ? 'selected' : ' ' }} value="2">Admin</option>
                                <option {{ ($user->role == 1) ? 'selected' : ' ' }} value="1">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{ ($user->status == 1) ? 'selected' : ' ' }} value="1">Active</option>
                                <option {{ ($user->status == 0) ? 'selected' : ' ' }} value="0">Block</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
$('#userForm').submit(function(event){
    event.preventDefault();

    var element = $(this);
    $("button[type=submit]").prop('disabled',true);

    $.ajax({
        url:'{{ route("users.update",$user->id) }}',
        type: 'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){
            $("button[type=submit]").prop('disabled',false);
            if(response["status"] == true) {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                window.location.href="{{ route('users.index') }}";
            } else {
                var errors = response['errors'];
            if(errors['name']){
                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            }
            if(errors['email']){
                $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
            }
            if(errors['phone']){
                $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
            }
            if(errors['password']){
                $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
            }
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
    url:  " ",
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

