@extends('admin.layouts.app')
@section('title')- Gallery @endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gallery List</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('galleries.create') }}" class="btn btn-primary">Upload New Photos</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <form action="" method="get" name="" id="">
            <div class="card-header">
                <div class="card-title">
                    <button type="button" onclick="window.location.href='{{ route("galleries.create") }}'" class="btn btn-default btn-sm">Reset</button>
                </div>
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                    </div>
                </div>
                </form>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-wrap">
                    <thead style="text-align: center!important">
                        <tr>
                            <th width="60">ID</th>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Photo By</th>
                            <th width="100">Show Home</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center!important">
                        @if ($galleries->isNotEmpty())
                        @foreach ($galleries as $gallery)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td> @if (!empty($gallery->image))
                                <img src="{{ asset('uploads/Gallery/').'/'.$gallery->image }}" class="img-thumbnail" width="40" >
                                @else
                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="img-thumbnail" width="50">
                                @endif</td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->slug }}</td>
                            <td>{{ date('Y-M-d',strtotime($gallery->date)) }}</td>
                            <td>{{ date('m:i A',strtotime($gallery->time)) }}</td>
                            <td>{{ $gallery->photographer }}</td>
                            <td>
                                @if($gallery->showHome == 1)
                               <h6>Yes</h6>
                                @else
                                <h6>No</h6>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('galleries.edit',$gallery->id) }}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="#" onclick="deleteGallery({{ $gallery->id }})" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                      </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5"> Records Not Found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
    function deleteGallery(id){
        var url = '{{ route("galleries.delete","ID") }}';
        var newUrl = url.replace("ID",id)
        //alert(newUrl);
        //return false;
        if (confirm("Are you sure you want to delete?")){
        $.ajax({
        url: newUrl,
        type: 'delete',
        data: {},
        dataType: 'json',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        success: function(response){
            if(response["status"]) {
                window.location.href="{{ route('galleries.index') }}";
        }
    }
});
    }
}
</script>
@endsection

