@extends('admin.layout.layout')

@section('title', 'Dashboard :: News CMS V1')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">    
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$data['count_category']}}</h3>

            <p>Category</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('admin.category.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
            <h3>{{$data['count_sub_category']}}</h3>

            <p>Sub Category</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('admin.sub.category.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$data['count_news']}}</h3>

            <p>News Artical</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->        
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-4">        
        <div class="card widget-user-2 shadow-sm">          
          <div class="bg-warning">                   
            <h3 class="widget-user-username">Category</h3>
            <h5 class="widget-user-desc"></h5>
          </div>
          <div class="card-footer p-0">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  Projects <span class="float-right badge bg-primary">31</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  Tasks <span class="float-right badge bg-info">5</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  Completed Projects <span class="float-right badge bg-success">12</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  Followers <span class="float-right badge bg-danger">842</span>
                </a>
              </li>
            </ul>
          </div>
        </div>        
      </div>
  </div>
</div>
@endsection