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
<form method="post" action="{{ route('network-equipment.store') }}">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Форма добовление</h3>
            <small class="float-right"><a href="{{ route('network-equipment.index') }}"
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
                      <label>Сетивоео борудование</label>
                      <select class="form-control select2" name="reference_network_equipment_id" style="width: 100%;">
                        <option value="" selected>Выберите обарудование</option>
                        @foreach ($referencenetworkEquipments as $referencenetworkEquipment)
                        <option value="{{ $referencenetworkEquipment->id }}">{{ $referencenetworkEquipment->manufacturer }} {{ $referencenetworkEquipment->model }} ( {{ $referencenetworkEquipment->device_type }} )</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Придумайте идентификационный маркер*</label>
                      <input type="input" name="name" value="" class="form-control"
                        placeholder="идентификационный маркер">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>IP адресс:</label>
                      <div class="input-group">
                        <input type="text" name="ip_address" class="form-control" data-inputmask="'alias': 'ip'"
                          data-mask placeholder="IP">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>MAC адресс:</label>
                      <div class="input-group">
                        <input id="MAC" name="mac_address" maxlength="17" type="text" class="form-control"
                          placeholder="MAC">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Логин</label>
                      <input type="input" name="login" value="" class="form-control" placeholder="Логин">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Пароль</label>
                      <input type="input" name="password" value="" class="form-control"
                        placeholder="Пароль">
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
                  <select id="telecomCabinets" class="form-control select2" name="telecommunication_cabinet_id"
                    style="width: 100%;">
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
<script src="{{ asset('app/filters/network_infrastructure/filter_network_infrastructure.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script>

  document.getElementById("MAC").addEventListener('keyup', function () {
    // remove non digits, break it into chunks of 2 and join with a colon
    this.value = (this.value.toUpperCase()
      .replace(/[^\d|A-F]/g, '')
      .match(/.{1,2}/g) || [])
      .join(":")

    if (that.value.length > 17) {
      that.value.length = 0;
    }

  });

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Money Euro
    $('[data-mask]').inputmask()
  })
  
</script>
@endsection