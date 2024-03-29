@extends('admin.layouts.app')
@section('title') - Dashboard @endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $date }}</h3>
                            <p>Date</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $day }}</h3>
                            <p>Day</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box card">
                        <div class="inner">
                            <h3>{{ $time }}</h3>
                            <p>Time</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class=" card col-6 ">
        <h3 style="text-align: center!important;">Team Members</h3>
        <table class="table table-hover text-wrap">
            <thead style="text-align: center!important">
                <tr>
                    <th width="60">ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody style="text-align: center!important">
                @if (getTeamMembers()->isNotEmpty())
                @foreach (getTeamMembers() as $members)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td> @if (!empty($members->image))
                        <img src="{{ asset('uploads/Member/').'/'.$members->image }}" class="img-thumbnail" width="40" >
                        @else
                        <img src="{{ asset('assets/admin-assets/img/default-150x150.png') }}" class="img-thumbnail" width="50">
                        @endif</td>
                    <td>{{ $members->name }}</td>
                    <td>{{ $members->email }}</td>
                    <td>{{ $members->phone }}</td>
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
    <div class="card col-6">

    </div>
</div>
        <!-- /.card -->
    </section>
@endsection

@section('customJs')
<script>
    console.log('Hello');
</script>
@endsection
