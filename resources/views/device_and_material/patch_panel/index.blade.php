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
                <a href="{{ route('patch-panel.create') }}" class="btn btn-success mb-3">+ Добавить</a>
                @endif
                <div class="table-responsive">
                  @if (count($patchPanels))
                  <table class="table table-bordered table-hover text-nowrap">
                    <thead>
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
                    </thead>
                    <tbody>
                    @foreach($patchPanels as $panel)
                      <tr>
                        <td><a href="{{ route('patch-panel.show', ['patch_panel' => $panel->id]) }}">{{ $panel->name }}</a></td>
                        <td>{{  $panel->telecommunication_cabinet->name }}</td>
                        <td>{{ $panel->building->name }} {{  $panel->floorName() ? 'этаж '.$panel->floorName() : '' }} {{  $panel->roomName() ? 'комната '.$panel->roomName() : '' }}</td>
                        <td>{{  $panel->count_port }} {{  $panel->unit ? ' '. $panel->unit .'U' : '' }}</td>
                        @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                        <td>
                        @if (Auth()->user()->permissions->edit)
                          <a href="{{ route('patch-panel.edit', ['patch_panel' =>  $panel->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          @endif

                          @if (Auth()->user()->permissions->delete)
                          <form action="{{ route('patch-panel.destroy', ['patch_panel' => $panel->id]) }}" method="post" class="float-left">
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


