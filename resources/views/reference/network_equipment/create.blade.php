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
<form method="post" action="{{ route('reference-network-equipment.store') }}">
  @csrf
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Форма добовление</h3>
            <small class="float-right"><a href="{{ route('reference-network-equipment.index') }}"
                class="btn btn-block btn-outline-dark">Назад
              </a></small>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="form-group">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Тип устройства</label>
                      <select class="form-control select2" name="device_type" style="width: 100%;">
                        <option value="" selected>Выберите параметр</option>     
                        <option value="switch">Коммутатор (switch)</option>
                        <option value="router">Маршрутизатор (router)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Параметры</label>
                      <select class="form-control select2" name="parameter" style="width: 100%;">
                      <option value="" selected>Выберите параметр</option>                      
                      <option value="Не управляймый">Не управляймый</option>  
                      <option value="L2">L2</option>
                        <option value="L2 +">L2 +</option>
                        <option value="L3">L3</option>
                        <option value="WI-FI">WI-FI</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Количество портов</label>
                      <input type="input" name="count_port" value="" class="form-control" placeholder="Количество портов">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Количество юнитов U</label>
                      <input type="input" name="unit" value="" class="form-control" placeholder="U">
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Произвадитель</label>
                    <input maxlength="17" type="input" name="manufacturer" value="" class="form-control" placeholder="Логин">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Модель</label>
                    <input maxlength="17" type="input" name="model" value="" class="form-control"
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
                  <input type="text" id="from" name="port[1][from]" value="" class="form-control" placeholder="от">
                  @error('from')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input id="before" type="text" name="port[1][before]" value="" class="form-control" placeholder="до">
                  @error('before')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Пропускной способности</label>
                  <select id="bandwidth" class="form-control select2" name="port[1][bandwidth]" style="width: 100%;">
                    <option value="" selected>Выберите параметр</option>
                    <option value="Стандарты Ethernet (10)">Стандарты Ethernet (10)</option>
                    <option value="Fast Ethernet (10/100)">Fast Ethernet (10/100)</option>
                    <option value="Gigabit Ethernet (10/100/1000)">Gigabit Ethernet (10/100/1000)</option>
                    <option value="2.5G Ethernet (2.5GBase-T)">2.5G Ethernet (2.5GBase-T)</option>
                    <option value="10G Ethernet (10G Base-T)">10G Ethernet (10G Base-T)</option>
                    <option value="25G Ethernet (25G Base-X)">25G Ethernet (25G Base-X)</option>
                    <option value="40G Ethernet (40G BASE-T)">40G Ethernet (40G BASE-T)</option>
                    <option value="100G Ethernet (100GbE)">100G Ethernet (100 GbE)</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Интерфейс подключения порта</label>
                  <select id="connectionInterfaces" class="form-control select2" name="port[1][connection_interfaces]"
                    style="width: 100%;">
                    <option value="" selected>Выберите параметр</option>
                    <option value="Порт RJ-45">Порт RJ-45</option>
                    <option value="Порт SFP">Порт SFP</option>
                    <option value="Порт SFP Plus">Порт SFP Plus</option>
                    <option value="Порт SFP28">Порт SFP28</option>
                    <option value="Порт QSFP+">Порт QSFP+</option>
                    <option value="Порт QSFP28">Порт QSFP28</option>
                    <option value="USB-порт">USB-порт</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Функционал порта</label>
                  <select id="portFunctionality" class="form-control select2" name="port[1][port_functionality]"
                    style="width: 100%;">
                    <option value="" selected>Выберите параметр</option>
                    <option value="Combo-порт">Combo-порт</option>
                    <option value="Combo SFP">Combo SFP</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Сетевая архитектура порта</label>
                  <select id="networkArchitecturePort" class="form-control select2" name="port[1][network_architecture_port]"
                    style="width: 100%;">
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
                  <select id="power" class="form-control select2" name="port[1][power]" style="width: 100%;">
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

</form>
@endsection
@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>

  let sectionPort = document.getElementById('port');
  let buttomAddPort = document.getElementById('addPort');
  let click = 1;


  buttomAddPort.addEventListener('click', function () {

    ++click;

    let sectionNext = document.createElement("section");
    sectionNext.id = 'port'.click;

    sectionNext.insertAdjacentHTML(
      'beforeend',
      `<div class="container-fluid">
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
        <input type="text" name="port[${click}][from]" class="form-control" placeholder="от">
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        <input type="text" name="port[${click}][before]" class="form-control" placeholder="до">
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
          <option value="2.5G Ethernet (2.5GBase-T)">2.5G Ethernet (2.5GBase-T)</option>
          <option value="10G Ethernet (10G Base-T)">10G Ethernet (10G Base-T)</option>
          <option value="25G Ethernet (25G Base-X)">25G Ethernet (25G Base-X)</option>
          <option value="40G Ethernet (40G BASE-T)">40G Ethernet (40G BASE-T)</option>
          <option value="100G Ethernet (100GbE)">100G Ethernet (100 GbE)</option>
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
          <option value="USB-порт">USB-порт</option>
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
  </div> `);

    sectionPort.appendChild(sectionNext);
  })
</script>
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