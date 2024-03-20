@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Подключения</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<section class="content" id="sectionFilter">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Фильтры</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Здание *</label>
                  <select id="buildings" class="form-control select2"  data-floor-and-room-group-by="true" data-port-refresh="false" name="building_id" style="width: 100%;">
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
                  <select id="floors" class="form-control select2" name="floor_id" style="width: 100%;">
                    <option value="" selected>Выбрать этаж</option>
                    @foreach ($floorsName as $floorName)
                    <option value="{{ $floorName->name }}">{{ $floorName->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Комната</label>
                  <select id="rooms" class="form-control select2" name="room_id" style="width: 100%;">
                    <option value="" selected>Выбрать коинату</option>
                    @foreach ($roomsName as $roomName)
                    <option value="{{ $roomName->name }}">{{ $roomName->name }}</option>
                    @endforeach
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Сетивое оборудование</label>
                  <select id="networkEquipment" class="form-control select2" name="patch_panel_id" style="width: 100%;">
                    <option value="" selected>Выберите сетивое оборудование</option>
                    @foreach ($networkEquipments as $networkEquipment)
                    <option value="{{ $networkEquipment->id }}">{{ $networkEquipment->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Выберите порты</label>
                  <div class="select2-purple">
                    <select id="patchPanelPorts" class="select2" multiple="multiple" data-placeholder="Выберите порты патч панели" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    @for ($i = 1; $i <= $maxPortPatchPanel; ++$i)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Выберите порты</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Выберите порты сетивого оборудованиея" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    @for ($i = 1; $i <= $maxPortNetworkEquipment; ++$i)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>IP адресс сетивого оборудованиея</label>
                  <div class="input-group">
                    <input type="text" name="ip_address" class="form-control" data-inputmask="'alias': 'ip'"
                      data-mask placeholder="IP">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>MAC адресс сетивого оборудованиея</label>
                  <div class="input-group">
                    <input id="MAC" name="mac_address" maxlength="17" type="text" class="form-control"
                      placeholder="MAC">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Производитель сетивого оборудованиея</label>
                  <select id="" class="form-control select2" name="patch_panel_id" style="width: 100%;">
                    <option value="" selected>Выберите производителя</option>
                    @foreach ($metworkEquipmentManufactures as $metworkEquipmentManufacturer)
                    <option value="{{ $metworkEquipmentManufacturer->manufacturer }}">{{ $metworkEquipmentManufacturer->manufacturer  }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Модель сетивого оборудованиея</label>
                  <select id="" class="form-control select2" name="patch_panel_id" style="width: 100%;">
                    <option value="" selected>Выберите модель</option>
                    @foreach ($metworkEquipmentModels as $metworkEquipmentModel)
                    <option value="{{ $metworkEquipmentModel->model }}">{{ $metworkEquipmentModel->model }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
        </div>
      </div>
      <div class="row">
      </div>
    </div>
  </section>

  <div class="card-body">
    <small class="float-right"><button id="buttonFilter" type="submit" class="btn btn-primary btn-lg">Показать</button></small>
  </div>
  

<section class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true">Абоненты</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false">Сетевое оборудование</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            @if (Auth()->user()->permissions->add)
              <a href="{{ route('connection.create') }}" class="btn btn-success mb-3">+ Добавить</a>
            @endif
          <div class="tab-content" id="custom-tabs-five-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
            <table id="tableSubscriber" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Номер распредиления</th>
                <th>Наименование устройства</th>
                <th>ip адресс</th>
                <th>Порт</th>
                <th>Устройство</th>
                <th>mac адресс</th>
                <th>ip адресс сети</th>
                <th>ip адрес</th>
                <th>vlan</th>
                <th>Расположение</th>
                @if (
  Auth()->user()->permissions->edit or
  Auth()->user()->permissions->delete or Auth()->user()->permissions->add
)
                <th>дествие</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($connections as $connection)
              @if(isset ($connection->secondaryNetworkEquipment->name))
                @continue
              @endif
              <tr>
                <td>
                @if($connection->distribution->patch_panel_id || $connection->distribution->final_patch_panel_id)
                    @if($connection->distribution->patch_panel_id)
                    {{ $connection->distribution->patchPanel->name }}.{{ $connection->distribution->patch_panel_port }}
                    @endif
                    @if($connection->distribution->final_patch_panel_id)
                    {{ ' <--> ' . $connection->distribution->finalPatchPanel->name }}.{{ $connection->distribution->final_patch_panel_port
                      }}
                      @endif
                      @else
                      Пачкорд № {{ $connection->distribution->patch_cord_number }}
                      @endif
                </td>
                <td>
                {{ $connection->networkEquipment->name }} "{{ $connection->networkEquipment->referenceNetworkEquipment->device_type }}"
                </td>  
                <td>
                {{ $connection->networkEquipment->ip_address }}
                </td>  
                <td>
                {{ $connection->port }}
                </td> 
                <td>
                {{ $connection->device->referenceDevice->device_type ?? '' }}
                </td> 
                <td>
                {{ $connection->device->mac_address ?? '' }}
                </td>  
                <td>
                {{ $connection->ip_address_network ?? '' }}
                </td>  
                <td>
                {{ $connection->ip_address_device ?? '' }}
                </td>  
                <td>
                {{ $connection->vlan ?? '' }}
                </td>    
                <td>
                  {{ $connection->distribution->location->building->name }}{{ $connection->distribution->location->floor_id ?
    '_' . $connection->distribution->location->floor->name : '' }}{{ $connection->distribution->location->room_id ?
    '_' . $connection->distribution->location->room->name : '' }}{{ isset
  ($connection->distribution->finalLocation->final_building_id) ? ' <-->
                    ' . $connection->distribution->finalLocation->building->name : '' }}{{ isset
  ($connection->distribution->finalLocation->final_floor_id) ? '_' .
    $connection->distribution->finalLocation->floor->name : ''}}{{ isset
  ($connection->distribution->finalLocation->final_room_id) ? '_' . $connection->distribution->finalLocation->room->name :
    '' }}
                </td>
                @if (
    Auth()->user()->permissions->edit or
    Auth()->user()->permissions->delete or Auth()->user()->permissions->add
  )
                <td id="action">
                  @if (Auth()->user()->permissions->edit)
                  <a href="{{ route('connection.edit', ['connection' => $connection->id]) }}"
                    class="btn btn-info btn-sm float-left mr-1">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  @endif

                  @if (Auth()->user()->permissions->delete)
                  <form
                    action="{{ route('connection.destroy', ['connection' => $connection->id]) }}"
                    method="post" class="float-left">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('Подтвердите удаление')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                  @endif
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Номер распредиления</th>
                <th>Наименование устройства</th>
                <th>ip адресс</th>
                <th>Порт</th>
                <th>Устройство</th>
                <th>mac адресс</th>
                <th>ip адресс сети</th>
                <th>ip адрес</th>
                <th>vlan</th>
                <th>Расположение</th>
                @if (Auth()->user()->permissions->edit or Auth()->user()->permissions->delete)
                <th>дествие</th>
                @endif
              </tr>
            </tfoot>
          </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
            <table id="tableNetworkEquipment" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Номер распредиления</th>
                <th>Наименование устройства</th>
                <th>ip адресс</th>
                <th>Порт</th>
                <th>Наименование устройства 2</th>
                <th>ip адресс 2</th>
                <th>Порт 2</th>
                <th>Расположение</th>
                @if ( Auth()->user()->permissions->edit or Auth()->user()->permissions->delete or Auth()->user()->permissions->add )
                <th>дествие</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($connections as $connection)
              @if(!isset ($connection->secondaryNetworkEquipment->name))
                @continue
              @endif
              <tr>
                <td>
                  @if($connection->distribution->patch_panel_id || $connection->distribution->final_patch_panel_id)
                    @if($connection->distribution->patch_panel_id)
                    {{ $connection->distribution->patchPanel->name }}.{{ $connection->distribution->patch_panel_port }}
                    @endif
                    @if($connection->distribution->final_patch_panel_id)
                    {{ ' <--> ' . $connection->distribution->finalPatchPanel->name }}.{{ $connection->distribution->final_patch_panel_port
                      }}
                      @endif
                      @else
                      Пачкорд № {{ $connection->distribution->patch_cord_number }}
                      @endif
                </td>
                <td>
                  {{ $connection->networkEquipment->name }} "{{ $connection->networkEquipment->referenceNetworkEquipment->device_type }}"
                </td>  
                <td>
                  {{ $connection->networkEquipment->ip_address }}
                </td>  
                <td>
                  {{ $connection->port }}
                </td> 
                <td>
                  {{ $connection->secondaryNetworkEquipment->name ?? ''}} "{{ $connection->secondaryNetworkEquipment->referenceNetworkEquipment->device_type ?? ''}}"
                </td>  
                <td>
                  {{ $connection->secondaryNetworkEquipment->ip_address ?? ''}}
                </td>  
                <td>
                  {{ $connection->secondary_port ?? ''}}
                </td>
                <td>
                    {{ $connection->distribution->location->building->name }}{{ $connection->distribution->location->floor_id ?
                  '_' . $connection->distribution->location->floor->name : '' }}{{ $connection->distribution->location->room_id ?
                  '_' . $connection->distribution->location->room->name : '' }}{{ isset
                ($connection->distribution->finalLocation->final_building_id) ? ' <--> ' . $connection->distribution->finalLocation->building->name : '' }}{{ isset
                ($connection->distribution->finalLocation->final_floor_id) ? '_' .$connection->distribution->finalLocation->floor->name : ''}}{{ isset ($connection->distribution->finalLocation->final_room_id) ? '_' .$connection->distribution->finalLocation->room->name : '' }}
                </td>
                @if ( Auth()->user()->permissions->edit or Auth()->user()->permissions->delete or Auth()->user()->permissions->add )
                <td id="action">
                  @if (Auth()->user()->permissions->edit)
                  <a href="{{ route('connection.edit', ['connection' => $connection->id]) }}"
                    class="btn btn-info btn-sm float-left mr-1">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  @endif

                  @if (Auth()->user()->permissions->delete)
                  <form
                    action="{{ route('connection.destroy', ['connection' => $connection->id]) }}"
                    method="post" class="float-left">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                      onclick="return confirm('Подтвердите удаление')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                  @endif
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Номер распредиления</th>
                <th>Наименование устройства</th>
                <th>ip адресс</th>
                <th>Порт</th>
                <th>Наименование устройства 2</th>
                <th>ip адресс 2</th>
                <th>Порт 2</th>
                <th>Расположение</th>
                @if ( Auth()->user()->permissions->edit or Auth()->user()->permissions->delete)
                <th>дествие</th>
                @endif
              </tr>
            </tfoot>
          </table>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
  </div>
</div>
</section>

@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- filter_building -->
<script src="{{ asset('app/filters/network_infrastructure/filter_building.js') }}"></script>
<!-- filter_floor -->
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
<script>

$(function () {
    
  $('#tableNetworkEquipment, #tableSubscriber').each(function() {
    $(this).DataTable({

      "language": {
        "buttons": {
          "copy": "Копировать",
          "csv": "CSV",
          "excel": "Excel",
          "pdf": "PDF",
          "print": "Печать",
          "colvis": "Столбцы"
        },
        "emptyTable": "Нет данных для отображения",
        "info": "Отображение записей с _START_ по _END_ из _TOTAL_",
        "infoEmpty": "Показано 0 из 0 записей",
        "infoFiltered": "(отфильтровано из _MAX_ записей)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Отображать _MENU_ записей на странице",
        "loadingRecords": "Загрузка...",
        "processing": "Обработка...",
        "search": "Поиск:",
        "zeroRecords": "Ничего не найдено",
        "paginate": {
          "first": "Первая",
          "last": "Последняя",
          "next": "Следующая",
          "previous": "Предыдущая"
        },
        "aria": {
          "sortAscending": ": активировать для сортировки столбца по возрастанию",
          "sortDescending": ": активировать для сортировки столбца по убыванию"
        },
      },

      "paging": true,
      "searching": true,
      "scrollX": true,
      "scrollCollapse": true, 
      "scrollXInner": '150%',
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      //"lengthChange": false,
      //"responsive": true, 
      //"ordering": true,
      //"info": true,
      // "responsive": true,
      //"scrollY": '500px',

    }).buttons().container().appendTo('#' + $(this).attr('id') + '_wrapper .col-md-6:eq(0)');
  });
});

  

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