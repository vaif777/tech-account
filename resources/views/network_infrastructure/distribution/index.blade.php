@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Расприделение</h1>
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
          <div class="row">
            <div class="card-body">
              @if (Auth()->user()->permissions->add)
              <a href="{{ route('distribution.create') }}" class="btn btn-success mb-3">+ Добавить</a>
              @endif
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Номер распредиления</th>
                      <th>Телекомикоционный шкаф</th>
                      <th>Расположение</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <th>дествие</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($distributions as $distribution)
                    <tr>
                      <td><a href="{{ route('distribution.show', ['distribution' => $distribution->id]) }}">
                          @if($distribution->patch_panel_id || $distribution->final_patch_panel_id)
                          @if($distribution->patch_panel_id)
                          {{ $distribution->patchPanel->name }}.{{ $distribution->patch_panel_port }}
                          @endif
                          @if($distribution->final_patch_panel_id)
                          {{ ' <--> '.$distribution->finalPatchPanel->name }}.{{ $distribution->final_patch_panel_port
                            }}
                            @endif
                            @else
                            Пачкорд № {{ $distribution->patch_cord_number }}
                            @endif
                        </a></td>
                      <td>
                        @if($distribution->location->telecommunication_cabinet_id ||
                        $distribution->finalLocation->final_telecommunication_cabinet_id)
                        {{ $distribution->location->telecommunication_cabinet_id ?
                        $distribution->location->telecommunicationCabinet->name : '' }}{{ isset
                        ($distribution->finalLocation->final_telecommunication_cabinet_id) ? ' <-->
                          '.$distribution->finalLocation->telecommunicationCabinet->name : '' }}
                          @else
                          Отсутствует
                          @endif
                      </td>
                      <td>
                        {{ $distribution->location->building->name }}{{ $distribution->location->floor_id ?
                        '_'.$distribution->location->floor->name : '' }}{{ $distribution->location->room_id ?
                        '_'.$distribution->location->room->name : '' }}{{ isset
                        ($distribution->finalLocation->final_building_id) ? ' <-->
                          '.$distribution->finalLocation->building->name : '' }}{{ isset
                          ($distribution->finalLocation->final_floor_id) ? '_'.
                          $distribution->finalLocation->floor->name : ''}}{{ isset
                          ($distribution->finalLocation->final_room_id) ? '_'.$distribution->finalLocation->room->name :
                          '' }}
                      </td>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <td>
                        @if (Auth()->user()->permissions->edit)
                        <a href="{{ route('distribution.edit', ['distribution' => $distribution->id]) }}"
                          class="btn btn-info btn-sm float-left mr-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endif

                        @if (Auth()->user()->permissions->delete)
                        <form action="{{ route('distribution.destroy', ['distribution' => $distribution->id]) }}"
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
                      <th>Телекомикоционный шкаф</th>
                      <th>Расположение</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <th>дествие</th>
                      @endif
                    </tr>
                  </tfoot>
                </table>
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