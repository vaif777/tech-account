@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Сетивое оборудование</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<form method="post" action="{{ route('device.store') }}">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Форма добовление</h3>
            <small class="float-right"><a href="{{ route('device.index') }}"
                class="btn btn-block btn-outline-dark">Назад
              </a></small>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Абонент</label>
                      <select class="form-control select2" name="subscriber_id" style="width: 100%;">
                        <option value="" selected>Выберите абонента</option>     
                        @foreach ($subscribers as $subscriber)
                        <option value="{{ $subscriber->id }}" selected>{{ $subscriber->surname ?? '' }} {{ $subscriber->name }} {{ $subscriber->patronymic ?? '' }} ( {{ $subscriber->department->name }} )</option> 
                        @endforeach 
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Произвадитель</label>
                    <input type="input" name="manufacturer" value="" class="form-control" placeholder="Логин">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Модель</label>
                    <input type="input" name="model" value="" class="form-control"
                      placeholder="Пароль">
                  </div>
                </div>
                 
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Добавить</button>
              </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
</form>
@endsection
@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>
@endsection