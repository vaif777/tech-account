@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Патч панель</h1>
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
            <form method="post" action="{{ route('patch-panel.store') }}">
              @csrf
              <div class="card-body">
                <label for="exampleInputEmail1">Обезательные данные *</label>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="name" value="{{ old('name') }}" class="form-control"
                        placeholder="идентификационный маркер">
                      @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="count_port" value="{{ old('count_port') }}"
                        class="form-control" placeholder=" Количество портов">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="unit" value="{{ old('unit') }}" class="form-control"
                        placeholder=" Количество юнитов U">
                    </div>
                  </div>
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
          <h3 class="card-title">Выберите телекомуникационный шкаф или здание</h3>
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
                <label>Здание *</label>
                <select id="buildings" class="form-control select2" name="building_id" style="width: 100%;">
                  <option value="" selected>Выберите здания</option>
                  @foreach ($buildings as $building)
                  <option value="{{ $building->id }}">{{ $building->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Этаж (фильтер)</label>
                <select id="floors" class="form-control select2" name="floor_id" style="width: 100%;" disabled>
                  <option value="" selected>Нужно выбрать здание</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Комната (фильтер)</label>
                <select id="rooms" class="form-control select2" name="room_id" style="width: 100%;" disabled>
                  <option value="" selected>Нужно выбрать этаж</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Телеком шкаф</label>
                <select id="telecomCabinets" class="form-control select2" name="telecommunication_cabinet_id" style="width: 100%;">
                  <option value="" selected>Выберите шкаф</option>
                  @foreach ($telecomCabinets as $cabinet)
                  <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                  @endforeach
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
                <div class="col-sm-2">
                  <div class="form-group clearfix">
                    <div class="icheck-secondary d-inline">
                      <input value="1" name="setting" type="checkbox" {{ old('setting') ? 'checked' : '' }}
                        id="checkboxsecondary7">
                      <label for="checkboxsecondary7">
                        Да
                      </label>
                      <input type="hidden" id="route" value="{{ route ('patch-panel.create') }}" />
                    </div>
                  </div>
                </div>
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
<!-- filter_building_floor_room -->
<script src="{{ asset('app/filters/telecom-cabinet/filter_building_floor_room.js') }}"></script>
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