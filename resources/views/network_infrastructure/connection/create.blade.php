@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Подключение</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<form method="post" action="{{ route('connection.store') }}">
  @csrf

  <section class="content">
    <div class="container-fluid">
      <div>
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Форма добовление</h3>
            <small class="float-right"><a href="{{ route('connection.index') }}"
                class="btn btn-block btn-outline-dark">Назад
              </a></small>
            <div class="card-tools">
            </div>
          </div>
        </div>
  </section>


  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Выберите локацию (расположение) подключения</h3>
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
                  <select id="telecomCabinets" class="form-control select2" style="width: 100%;">
                    <option value="" selected>Выберите шкаф</option>
                    @foreach ($telecomCabinets as $cabinet)
                    <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Статус подключения</label>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="form-group clearfix">
                    <div class="icheck-secondary d-inline">
                      <input type="radio" id="radioPrimary1" name="status"  value="Требует подключения" checked>
                      <label for="radioPrimary1">
                        Требует подключения
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="form-group clearfix">
                    <div class="icheck-secondary d-inline">
                      <input type="radio" id="radioPrimary2" value="Ремонт" name="status">
                      <label for="radioPrimary2">
                        Ремонт
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="form-group clearfix">
                    <div class="icheck-secondary d-inline">
                      <input type="radio" id="radioPrimary3" value="Не активный" name="status">
                      <label for="radioPrimary3">
                        Не активный
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="form-group clearfix">
                    <div class="icheck-secondary d-inline">
                      <input type="radio" id="radioPrimary4" value="Подключен" name="status">
                      <label for="radioPrimary4">
                        Подключен
                      </label>
                    </div>
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


  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Выбор абонента и его настройки</h3>
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
                  <label>Абонент</label>
                  <select id="selectSubscriber" class="form-control select2" name="subscriber_id" style="width: 100%;">
                    <option value="" selected>Выберите абонента</option>
                    @foreach ($subscribers as $subscriber)
                    <option value="{{ $subscriber->id }}">{{ $subscriber->surname ?? '' }} {{ $subscriber->name }} {{
    $subscriber->patronymic ?? '' }} ( {{ $subscriber->department->name }} )</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Логин и пароль для потключения</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="input" name="login" value="" class="form-control" placeholder="Логин">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="input" name="password" value="" class="form-control" placeholder="Пароль">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Данные о подключении</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Vlan</label>
                  <select class="form-control select2" name="vlan" style="width: 100%;">
                    <option value="" selected>Выберите Vlan</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>IP адресс сети:</label>
                  <div class="input-group">
                    <input type="text" name="ip_address_network" class="form-control" data-inputmask="'alias': 'ip'"
                      data-mask placeholder="IP">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>IP адресс устройства:</label>
                  <div class="input-group">
                    <input type="text" name="ip_address_device" class="form-control" data-inputmask="'alias': 'ip'" data-mask
                      placeholder="IP">
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

  <section class="content">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <small class="float-right"><button id="buttonFilter" type="button" class="btn btn-block btn-secondary">Показать устройства и
                распределение с сетевым оборудованием</button></small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content" id="sectionReferenceDevice" style="display: none;">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title">добовить устройство со справочника</h3>
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
                    <label>Устройство</label>
                    <select class="form-control select2" id="selectReferenceDevice" name="reference_device_id" style="width: 100%;">
                        <option value="" selected>Выберите устройство</option>     
                        @foreach ($referenceDevices as $referenceDevice)
                        <option value="{{ $referenceDevice->id }}"> {{ $referenceDevice->device_type }} ( {{ $referenceDevice->manufacturer ?? '' }} {{ $referenceDevice->model ?? '' }} )</option> 
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Придумайте идентификационный маркер*</label>
                    <div class="input-group">
                      <input name="name" type="text" class="form-control" placeholder="идентификационный маркер">
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
            <h3 class="card-title">Выбор устройство</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div id="subscriberDevicesDiv" class="col-md-12">
                <div class="form-group">
                  <label>Устойсва абонента</label>
                  <select id="selectSubscriberDevices" class="form-control select2" name="device_id"
                    style="width: 100%;" disabled>
                  <option value="" selected>Выберите локацию и абонента</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
  </section>

  <section class="content" id="sectionConnectionNetworkEquipment" style="display: none;">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Подключить сетивое оборудование</h3>
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
              <table id="tableConnectionNetworkEquipmentPorts" class="table table-bordered table-hover">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                <input type="hidden" id="secondaryNetworkEquipmentId">
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

  <section class="content" id="sectionFilter" style="display: none;">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title">Фильтры</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label>Фильтр по шкафу</label>
                  <select id="selectDistributionsTelecomCabinets" class="form-control select2" style="width: 100%;" disabled>
                  <option value="" selected>Выберите локацию</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Фильтр по патч панеле</label>
                  <select id="selectDistributionsPatchPanels" class="form-control select2" style="width: 100%;" disabled>
                  <option value="" selected>Выберите шкаф</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Фильтр по сетевому оборудованию</label>
                  <select id="selectDistributionsNetworkEquipments" class="form-control select2" style="width: 100%;" disabled>
                  <option value="" selected>Выберите шкаф</option>
                  </select>
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

  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Выбор распределение</h3>
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
                  <label>Pаспределение</label>
                  <select id="selectDistributions" class="form-control select2" name="distribution_id" style="width: 100%;" disabled>
                  <option value="" selected>Выберите локацию</option>
                  </select>
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

  <section class="content" id="sectionNetworkEquipment" style="display: none;">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Выберите порт сетевого оборудования</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tableDistributionsNetworkEquipmentPorts" class="table table-bordered table-hover">
              <thead>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
            <input type="hidden" id="networkEquipmentId">
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
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <small class="float-right"><button id="buttonFilter" type="submit"
                class="btn btn-block btn-success btn-lg">Подключить</button></small>
          </div>
        </div>
      </div>
    </div>
  </section>

</form>
@endsection
@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>

//   $(function () {
//     $("#tableDistributionsNetworkEquipmentPorts").DataTable();
  
// });

</script>
<!-- filter_building -->
<script src="{{ asset('app/filters/network_infrastructure/filter_building.js') }}"></script>
<!-- filter_floor -->
<script src="{{ asset('app/filters/network_infrastructure/filter_floor.js') }}"></script>
<!-- filterRoom -->
<script src="{{ asset('app/filters/network_infrastructure/filterRoom.js') }}"></script>
<!-- filterTelecomCabinet -->
<script src="{{ asset('app/filters/network_infrastructure/filterTelecomCabinet.js') }}"></script>
<!-- optionAdd -->
<script src="{{ asset('app/filters/optionAdd.js') }}"></script> 
<!-- selectUpdate -->
<script src="{{ asset('app/filters/selectUpdate.js') }}"></script> 
<!-- tableUpdate -->
<script src="{{ asset('app/filters/tableUpdate.js') }}"></script> 
<!-- filter_distribution_and_devices -->
<script src="{{ asset('app/filters/network_infrastructure/filter_distribution_and_devices.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script>

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

  document.getElementById("MAC").addEventListener('keyup', function () {
    // remove non digits, break it into chunks of 2 and join with a colon
    this.value = (this.value.toUpperCase()
      .replace(/[^\d|A-F]/g, '')
      .match(/.{1,2}/g) || [])
      .join(":")

    if (that.value.length > 17) {
      that.value.length  }  
 
});

</script>
@endsection