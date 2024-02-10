@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Комнаты</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE card card-default collapsed-card-->
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Фильтер</h3>

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
                <label>Здание</label>
                <select class="form-control select2" id="buildings" style="width: 100%;">
                  
                  @foreach($buildings as $building)

                 
                  <option value="{{ $building->id }}">{{ $building->name }}</option>
           

                  @endforeach
                </select>
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
              <a href="{{ route('floor.create') }}" class="btn btn-success mb-3">+ Добавить</a>
              @endif
              <div class="table-responsive">
                @if (count($rooms))
                <table id="floorTbl" class="table table-bordered table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Название этажа</th>
                      <th>Этаж</th>
                      <th>Здание</th>
                      @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <th id="action">Дествие</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rooms as $room)
                    <tr>
                      <td><a href="{{ route('room.show', ['room' => $room->id]) }}">{{ $room->name }}</a></td>
                      <td><a href="{{ route('floor.show', ['floor' => $room->floor->id]) }}">{{
                          $room->floor->name }}</a></td>
                      <td><a href="{{ route('building.show', ['building' => $room->floor->building_id]) }}">{{
                          $room->floor->building->name }}</a></td>
                          @if (Auth()->user()->permissions->edit or
                      Auth()->user()->permissions->delete)
                      <td>
                      @if (Auth()->user()->permissions->edit)
                        <a href="" class="btn btn-info btn-sm float-left mr-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endif

                        @if (Auth()->user()->permissions->delete)
                        <form action="" method="post" class="float-left">
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
@section('script')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- floor_filter --> 
<script src="{{ asset('public/app/filters/floor/floor_filter.js') }}"></script>
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