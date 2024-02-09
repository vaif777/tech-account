@extends('layouts.layout')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 id=test class="m-0">Здания</h1>
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
                <a href="{{ route('building.create') }}" class="btn btn-success mb-3">+ Добавить</a>
                @endif
                <div class="table-responsive">
                  @if (count($buildings))
                  <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Здание</th>
                        <th>Адрес</th>
                        @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                        <th>дествие</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($buildings as $building)
                      <tr>
                        <td><a href="{{ route('building.show', ['building' => $building->id]) }}">{{ $building->name }}</a></td>
                        <td>{{ $building->address }}</td>
                        @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                        <td>
                        @if (Auth()->user()->permissions->edit)
                          <a href="{{ route('building.edit', ['building' => $building->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          @endif

                          @if (Auth()->user()->permissions->delete)
                          <form action="{{ route('building.destroy', ['building' => $building->id]) }}" method="post" class="float-left">
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
                <p>Нет созданых зданий</p>
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