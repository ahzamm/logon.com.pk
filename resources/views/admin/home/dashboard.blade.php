@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <a href="{{ route('jobpost.index') }}" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$jobpost}}</h3>

                <p>Current Job Openings</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$jobAplication}}</h3>
                <p>Job Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="{{ route('contact.index') }}" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$contactRequest}}</h3>

                <p>Contact Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="{{ route('front-faqs.index') }}" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$faqs}}</h3>

                <p>Active Faqs</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="{{ route('front-pages.index') }}" class="small-box-footer">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$frontPages}}</h3>

                <p>No. of Pages</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </a>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$employees}}</h3>

                <p>No. of Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$modalContent}}</h3>
                <p>Pop Up</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$requestCount}}</h3>

                <p>No. of Covrage Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-phone mr-1"></i>
                  Today's Contact Requests
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contacts as $item)
                        <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->message}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
<!-- Custom tabs (Charts with tabs)-->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-user mr-1"></i>
      Today's Consumer Requests
    </h3>
    <div class="card-tools">
      <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Member Requests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#sales-chart" data-toggle="tab">Consumer Requests</a>
        </li>
      </ul>
    </div>
  </div><!-- /.card-header -->
  <div class="card-body">
    <div class="tab-content p-0">
      <!-- Morris chart - Sales -->
      <div class="chart tab-pane active" id="revenue-chart"
           style="position: relative; height: 300px;">
           <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($coverageMembers as $item)
                  <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile_no}}</td>
                    <td>{{$item->address}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>                         
       </div>
      <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($coverageUsers as $item)
                <tr>
                  <td>{{$item->name}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->mobile_no}}</td>
                  <td>{{$item->address}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>                         
      </div>  
    </div>
  </div><!-- /.card-body -->
</div>
<!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection