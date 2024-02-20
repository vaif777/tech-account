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
        <div class="card-body">
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="card-body">
              @if (Auth()->user()->permissions->add)
              <a href="{{ route('network-equipment.create') }}" class="btn btn-success mb-3">+ Добавить</a>
              <a href="{{ route('network-equipment.create') }}" class="btn btn-success mb-3">+ Добавить по шаблону</a>
              <a href="{{ route('network-equipment.create') }}" class="btn btn-success mb-3">+ Добавить со склада</a>
              @endif
              <div class="table-responsive">
                @if (count($networkEquipments))
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Наименование</th>
                      <th>Телеком шкаф</th>
                      <th>Расположение</th>
                      <th>Количество портов и U</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete or Auth()->user()->permissions->add)
                      <th>дествие</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($networkEquipments as $networkEquipment)
                    <tr>
                      <td><a
                          href="{{ route('network-equipment.show', ['network_equipment' => $networkEquipment->id]) }}">{{
                          $networkEquipment->name
                          }}</a>@if ($networkEquipment->pattern) <span class="float-right badge bg-success">Шаблон</span> @endif</td>
                      <td>{{ $networkEquipment->location->telecommunication_cabinet_id ?
                        $networkEquipment->location->telecommunicationCabinet->name : '' }}</td>
                      <td>{{ $networkEquipment->location->building->name }} {{ $networkEquipment->location->floor_id ?
                        'этаж '.$networkEquipment->location->floor->name : '' }} {{
                        $networkEquipment->location->room_id ? 'комната '.$networkEquipment->location->room->name : ''
                        }}</td>
                      <td>{{ $networkEquipment->count_port }} {{ $networkEquipment->unit ? ' '. $networkEquipment->unit
                        .'U' : '' }}</td>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete or Auth()->user()->permissions->add)
                      <td id="action">
                        @if ($networkEquipment->pattern)
                        @if (Auth()->user()->permissions->delete)
                        <button id="pattern" type="button" value="{{ $networkEquipment->id }}" class="btn btn-outline-danger btn-sm float-left mr-1">Удалить шаблон</button>
                        @endif
                        @else
                        @if (Auth()->user()->permissions->add)
                        <button id="pattern" type="button" value="{{ $networkEquipment->id }}"
                          class="btn btn-outline-success btn-sm float-left mr-1">Сохранить как шаблон</button>
                        @endif
                        @endif
                        @if (Auth()->user()->permissions->edit)
                        <a href="{{ route('network-equipment.edit', ['network_equipment' =>  $networkEquipment->id]) }}"
                          class="btn btn-info btn-sm float-left mr-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endif

                        @if (Auth()->user()->permissions->delete)
                        <form
                          action="{{ route('network-equipment.destroy', ['network_equipment' => $networkEquipment->id]) }}"
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
                      <th>Наименование</th>
                      <th>Телеком шкаф</th>
                      <th>Расположение</th>
                      <th>Количество портов и U</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <th>дествие</th>
                      @endif
                    </tr>
                  </tfoot>
                </table>
              </div>
              @else
              <p>Записей нет</p>
              @endif
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
<script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  let buttonPattern = document.getElementById('pattern');
  let tdAction = document.getElementById('action');

  $(document).ready(function () {
  $(buttonPattern).on('click', (function () {

    $.ajax({
      method: "GET",
      url: route('network-equipment.index'),
      data: { id: buttonPattern.value },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        buttonPattern.remove();

        let button = document.createElement("button");
        
        button.className = 'btn btn-outline-danger btn-sm float-left mr-1';
        button.id = 'pattern';
        button.innerHTML = 'Удалить шаблон';
        tdAction.insertBefore(button, tdAction.firstChild);

      });
  }))

})

</script>
@endsection