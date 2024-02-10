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
                <a href="{{ route('material-reference.create') }}" class="btn btn-success mb-3">+ Добавить</a>
                @endif
                <div class="table-responsive">
                  @if (count($materials))
                  <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Наименование</th>
                        @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                        <th>дествие</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($materials as $material)
                      <tr>
                        <td><a href="{{ route('material-reference.show', ['material_reference' => $material->id]) }}">{{ $material->name }}</a></td>
                        @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                        <td>
                        @if (Auth()->user()->permissions->edit)
                          <a href="{{ route('material-reference.edit', ['material_reference' => $material->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          @endif

                          @if (Auth()->user()->permissions->delete)
                          <form action="{{ route('material-reference.destroy', ['material_reference' => $material->id]) }}" method="post" class="float-left">
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