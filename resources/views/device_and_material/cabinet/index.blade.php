@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Телекомуникационный щкаф</h1>
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
              <a href="{{ route('telecom-cabinet.create') }}" class="btn btn-success mb-3">+ Добавить</a>
              @endif
              <div class="table-responsive">
                @if (count($telecommCabinets))
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Наименование</th>
                      <th>Расположение</th>
                      <th>Размеры</th>
                      <th>Патч панели</th>
                      <th>Элементы (доп)</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <th>дествие</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($telecommCabinets as $сabinet)
                    <tr>
                      <td><a href="{{ route('telecom-cabinet.show', ['telecom_cabinet' => $сabinet->id]) }}">{{
                          $сabinet->name }}</a></td>
                      <td>{{ $сabinet->location->building->name }} {{ $сabinet->location->floor_id ? 'этаж '.
                        $сabinet->location->floor->name : '' }} {{ $сabinet->location->room_id ? 'комната '.
                        $сabinet->location->room->name : '' }}</td>
                      <td>{{ $сabinet->width ? $сabinet->width : '' }}{{ $сabinet->height ? 'x'. $сabinet->height : ''
                        }}{{ $сabinet->depth ? 'x'. $сabinet->depth : '' }} {{ $сabinet->unit ? ' '.$сabinet->unit .'U'
                        : '' }}</td>
                      <td>{{ $сabinet->patchPanelsName() ? $сabinet->patchPanelsName() : 'Отсутствует' }}</td>
                      <td></td>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <td>
                        @if (Auth()->user()->permissions->edit)
                        <a href="{{ route('telecom-cabinet.edit', ['telecom_cabinet' =>  $сabinet->id]) }}"
                          class="btn btn-info btn-sm float-left mr-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endif

                        @if (Auth()->user()->permissions->delete)
                        <form action="{{ route('telecom-cabinet.destroy', ['telecom_cabinet' =>  $сabinet->id]) }}"
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
                      <th>Расположение</th>
                      <th>Размеры</th>
                      <th>Патч панели</th>
                      <th>Элементы (доп)</th>
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

</script>
@endsection