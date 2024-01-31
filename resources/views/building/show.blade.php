@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0"></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
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
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>
            <p>Количество телеком. шкафов в здании</p>
          </div>
          <div class="icon">
            <i class="ion-cube"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
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
    <!-- Main row -->
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h4>
            <i class="fas fa-building"></i> {{ $building->name }}
            <small class="float-right"><button type="button" class="btn btn-block btn-primary btn-sm">Редактировать</button>
              </a></small>
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <strong>Адрес</strong>
          <address>
            {{ $building->address }}
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <button type="button" class="btn btn-block btn-secondary col-3">Перийти в раздел с этажами</button>
    </div><!-- /.container-fluid -->
    <div class="col-12" id="accordion">
      @foreach($foolrs as $foolr)
      <div class="card card-primary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#floor-{{ $foolr->id }}">
          <div class="card-header">
            <h4 class="card-title w-100">
              Номер этожа: {{ $foolr->name }}
            </h4>
          </div>
        </a>
        <div id="floor-{{ $foolr->id }}" class="collapse" data-parent="#accordion">
          <div class="card-body">
            Номера комнат: {{ implode(', ', $foolr->rooms->pluck('name')->toArray()) }}
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-block btn-secondary col-3">Перийти в раздел с этажами</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</section>
@endsection