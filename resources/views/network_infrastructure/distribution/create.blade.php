@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Распредиление</h1>
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
          <small class="float-right"><a href="{{ route('distribution.index') }}"
              class="btn btn-block btn-outline-dark">Назад
            </a></small>
        </div>
        <!-- /.card-header -->
        <form method="post" action="{{ route('distribution.store') }}">
          @csrf
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <h4>Выберите начальную точку *</h4>
                </div>
              </div>
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
                  <label>Этаж</label>
                  <select id="floors" class="form-control select2" name="floor_id" style="width: 100%;" disabled>
                    <option value="" selected>Нужно выбрать здание</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Комната</label>
                  <select id="rooms" class="form-control select2" name="room_id" style="width: 100%;" disabled>
                    <option value="" selected>Нужно выбрать этаж</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Патч панель</label>
                  <select id="patchPanels" class="form-control select2" name="patch_panel_id" style="width: 100%;">
                    <option value="" selected>Выберите патч панель</option>
                    @foreach ($patchPanels as $panel)
                    <option value="{{ $panel->id }}">{{ $panel->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Выберите порты</label>
                  <select id="patchPanelPorts" class="duallistbox" name="patch_panel_port" multiple="multiple">
                    <option value="">Выберите патч панель</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <h4>Выберите конечное точку *</h4>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Здание *</label>
                  <select id="finalBuildings" class="form-control select2" name="final_building_id" style="width: 100%;">
                    <option value="" selected>Выберите здания</option>
                    @foreach ($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Этаж</label>
                  <select id="finalFloors" class="form-control select2" name="final_floor_id" style="width: 100%;" disabled>
                    <option value="" selected>Нужно выбрать здание</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Комната</label>
                  <select id="finalRooms" class="form-control select2" name="final_room_id" style="width: 100%;" disabled>
                    <option value="" selected>Нужно выбрать этаж</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Телеком шкаф</label>
                  <select id="finalTelecomCabinets" class="form-control select2" name="final_telecommunication_cabinet_id"
                    style="width: 100%;">
                    <option value="" selected>Выберите шкаф</option>
                    @foreach ($telecomCabinets as $cabinet)
                    <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Патч панель</label>
                  <select id="finalPatchPanels" class="form-control select2" name="final_patch_panel_id" style="width: 100%;">
                    <option value="" selected>Выберите патч панель</option>
                    @foreach ($patchPanels as $panel)
                    <option value="{{ $panel->id }}">{{ $panel->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Выберите порты</label>
                  <select id="finalPatchPanelPorts" class="duallistbox" name="final_patch_panel_port" multiple="multiple">
                    <option value="">Выберите патч панель</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
          </div>
        </form>
      </div>
      <input type="hidden" id="route" value="{{ route ('distribution.create') }}" />
      <!-- /.card-body -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- filter_building -->
<script src="{{ asset('app/filters/network_infrastructure/filter_building.js') }}"></script>
<!-- filter_building -->
<script src="{{ asset('app/filters/network_infrastructure/filter_floor.js') }}"></script>
<!-- filterTelecomCabinet -->
<script src="{{ asset('app/filters/network_infrastructure/filterTelecomCabinet.js') }}"></script>
<!-- filterPatchPanel -->
<script src="{{ asset('app/filters/network_infrastructure/filterPatchPanel.js') }}"></script> 
<!-- filterRoom -->
<script src="{{ asset('app/filters/network_infrastructure/filterRoom.js') }}"></script>
<!-- filterPatchPanelPort.js -->
<script src="{{ asset('app/filters/network_infrastructure/filterPatchPanelPort.js') }}"></script>
<!-- optionAdd -->
<script src="{{ asset('app/filters/optionAdd.js') }}"></script> 
<!-- selectUpdate -->
<script src="{{ asset('app/filters/selectUpdate.js') }}"></script> 
<!-- filter_network_infrastructure
<script src="{{ asset('app/filters/network_infrastructure/filter_network_infrastructure.js') }}"></script>
filter_final_network_infrastructure -->
<!-- <script src="{{ asset('app/filters/network_infrastructure/filter_final_network_infrastructure.js') }}"></script> -->
<script>

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

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