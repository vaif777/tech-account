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
            <form method="post" action="{{ route('network-equipment.store') }}">
              @csrf
              <div class="card-body">
                <label for="exampleInputEmail1">Сетивое оборудование *</label>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="name" value="" class="form-control"
                        placeholder="идентификационный маркер">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input maxlength="17" type="input" name="unit" value="" class="form-control"
                        placeholder=" Количество юнитов U">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>IP адресс:</label>
                      <div class="input-group">
                        <input type="text" name="IP_address" class="form-control" data-inputmask="'alias': 'ip'"
                          data-mask placeholder="IP">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>MAC адресс:</label>
                      <div class="input-group">
                        <input id="MAC" name="MAC_address" maxlength="17" type="text" class="form-control"
                          placeholder="MAC">
                      </div>
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

<section id="port" class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Порты</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <input type="text" id="from" name="from" value="" class="form-control" placeholder="от">
                @error('from')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input id="before" type="text" name="before" value="" class="form-control" placeholder="до">
                @error('before')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Пропускной способности</label>
                <select id="bandwidth" class="form-control select2" name="bandwidth" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Стандарты Ethernet (10)">Стандарты Ethernet (10)</option>
                  <option value="Fast Ethernet (10/100)">Fast Ethernet (10/100)</option>
                  <option value="Gigabit Ethernet (10/100/1000)">Gigabit Ethernet (10/100/1000)</option>
                  <option value="10G Ethernet (100/1000/10000)">10G Ethernet (100/1000/10000)</option>
                  <option value="40G Ethernet (40G BASE-T)">40G Ethernet (40G BASE-T)</option>
                  <option value="100G Ethernet (100GbE)">100G Ethernet (100GbE)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Интерфейс подключения порта</label>
                <select id="connectionInterfaces" class="form-control select2" name="connection_interfaces" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Порт RJ-45">Порт RJ-45</option>
                  <option value="Порт SFP">Порт SFP</option>
                  <option value="Порт SFP Plus">Порт SFP Plus</option>
                  <option value="Порт SFP28">Порт SFP28</option>
                  <option value="Порт QSFP+">Порт QSFP+</option>
                  <option value="Порт QSFP28">Порт QSFP28</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Функционал порта</label>
                <select id="portFunctionality" class="form-control select2" name="port_functionality" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Combo-порт">Combo-порт</option>
                  <option value="Combo SFP">Combo SFP</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Сетевая архитектура порта</label>
                <select id="networkArchitecturePort" class="form-control select2" name="network_architecture_port" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Порт доступа (Access port)">Порт доступа (Access port)</option>
                  <option value="Магистральный порт или Trunk port">Магистральный порт или Trunk port</option>
                  <option value="Гибридный порт (Hybrid port)">Гибридный порт (Hybrid port)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Питание</label>
                <select id="power" class="form-control select2" name="power" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="PoE">PoE</option>
                  <option value="PoE +">PoE +</option>
                  <option value="UPoE">UPoE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
                  <button id="addPort" type="button" class="btn btn-dark">Еще одна форма для добовления портов</button>
                </div>
          <div class="row">
          </div>
        </div>
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
  let sectionPort = document.getElementById('port');
  let buttomAddPort = document.getElementById('addPort');
  let inputFrom = document.getElementById('from');
  let inputBefore = document.getElementById('before');
  let inputDandwidth = document.getElementById('bandwidth');
  let inputConnectionInterfaces = document.getElementById('connectionInterfaces');
  let inputPortFunctionality = document.getElementById('portFunctionality');
  let inputNetworkArchitecturePort = document.getElementById('networkArchitecturePort');
  let inputPower = document.getElementById('power');
  let click = 1; 
  console.log(inputBefore);

$(document).ready(function () {
  $(buttomAddPort).on('click', (function () {

    ++click;

    if (inputFrom.name == 'from') {
     
      inputFrom.setAttribute("name", "port[1][from]");
      inputBefore.setAttribute("name", "port[1][before]");
      inputDandwidth.setAttribute("name", "port[1][dandwidth]");
      inputConnectionInterfaces.setAttribute("name", "port[1][connection_interfaces]");
      inputPortFunctionality.setAttribute("name", "port[1][port_functionality]");
      inputNetworkArchitecturePort.setAttribute("name", "port[1][network_architecture_port]");
      inputPower.setAttribute("name", "port[1][power]");
    }

    let sectionNext = document.createElement("section");
    sectionNext.id = 'port'.click;

    sectionNext.insertAdjacentHTML(
            'beforeend',
            ` <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Порты</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <input type="text" name="port[${click}][from]" value="" class="form-control" placeholder="от">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <input type="text" name="port[${click}][before]" value="" class="form-control" placeholder="до">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Пропускной способности</label>
                <select class="form-control select2" name="port[${click}][bandwidth]" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Стандарты Ethernet (10)">Стандарты Ethernet (10)</option>
                  <option value="Fast Ethernet (10/100)">Fast Ethernet (10/100)</option>
                  <option value="Gigabit Ethernet (10/100/1000)">Gigabit Ethernet (10/100/1000)</option>
                  <option value="10G Ethernet (100/1000/10000)">10G Ethernet (100/1000/10000)</option>
                  <option value="40G Ethernet (40G BASE-T)">40G Ethernet (40G BASE-T)</option>
                  <option value="100G Ethernet (100GbE)">100G Ethernet (100GbE)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Интерфейс подключения порта</label>
                <select class="form-control select2" name="port[${click}][connection_interfaces]" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Порт RJ-45">Порт RJ-45</option>
                  <option value="Порт SFP">Порт SFP</option>
                  <option value="Порт SFP Plus">Порт SFP Plus</option>
                  <option value="Порт SFP28">Порт SFP28</option>
                  <option value="Порт QSFP+">Порт QSFP+</option>
                  <option value="Порт QSFP28">Порт QSFP28</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Функционал порта</label>
                <select class="form-control select2" name="port[${click}][port_functionality]" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Combo-порт">Combo-порт</option>
                  <option value="Combo SFP">Combo SFP</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Сетевая архитектура порта</label>
                <select class="form-control select2" name="port[${click}][network_architecture_port]" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="Порт доступа (Access port)">Порт доступа (Access port)</option>
                  <option value="Магистральный порт или Trunk port">Магистральный порт или Trunk port</option>
                  <option value="Гибридный порт (Hybrid port)">Гибридный порт (Hybrid port)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Питание</label>
                <select class="form-control select2" name="port[${click}][power]" style="width: 100%;">
                  <option value="" selected>Выберите параметр</option>
                  <option value="PoE">PoE</option>
                  <option value="PoE +">PoE +</option>
                  <option value="UPoE">UPoE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
          </div>
        </div> `
    );
    
    sectionPort.appendChild(sectionNext);

})
</script>
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