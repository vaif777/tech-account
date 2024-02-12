@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Справочник материалов</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Форма добовление</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <form method="post" action="{{ route('telecom-cabinet.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Придумайте идентификационный маркер *</label>
                  <input maxlength="17" type="input" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="идентификационный маркер">
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Произвадитель</label>
                      <select class="form-control select2" name="manufacturer_id" style="width: 100%;">
                        <option value="1">Произвадитель</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Модель</label>
                      <select class="form-control select2" name="model_id" style="width: 100%;">
                        <option value="1">Модель</option>
                      </select>
                    </div>
                  </div>
                </div>
               
                  <label>Размеры</label>
        
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="width" value="{{ old('width') }}"
                        class="form-control" placeholder="Ширена">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="height" value="{{ old('height') }}"
                        class="form-control" placeholder="Высота">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="depth" value="{{ old('depth') }}"
                        class="form-control" placeholder="Глубина">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="unit" value="{{ old('unit') }}"
                        class="form-control" placeholder=" Количество юнитов U">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Добавить</button>
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

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Место размещения для ведения в эксплуатацию</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Здание *</label>
                <select class="form-control select2" name="building_id" style="width: 100%;">
                  <option value="1">Этаж</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Этаж</label>
                <select class="form-control select2" name="floor_id" style="width: 100%;">
                  <option value="1">Комната</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Комната</label>
                <select class="form-control select2" name="room_id" style="width: 100%;">
                  <option value="1">тест</option>
                </select>
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

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Место хранения на складе</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

              </div>
            </div>
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
      theme: 'boot })
  })
</script>
@endsection