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
        <div class="card-header">
          <h3 class="card-title">Форма добовление</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <form method="post" action="{{ route('floor.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Здание *</label>
                  <select class="form-control select2" name="building_id" id="buildings" class="form-control @error('building_id') is-invalid @enderror" style="width: 100%;">
                    @foreach($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                    @endforeach
                  </select>
                  @error('building_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Название Этажа *</label>
                  <input type="input" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="Название Этажа">
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Комноты</label>
                  <div class="row">
                    <div class="col-6">
                      <input type="text" name="from" value="{{ old('from') }}"
                        class="form-control @error('from') is-invalid @enderror" placeholder="от">
                      @error('from')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                      <input type="text" name="before" value="{{ old('before') }}"
                        class="form-control @error('before') is-invalid @enderror" placeholder="до">
                      @error('before')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Комноты не входящие в диапазон (писать через запятую
                    обязательно)</label>
                  <textarea class="form-control" name="homemade" rows="3"
                    placeholder="Этажи писать через запятую.">{{ old('homemade') }}</textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Комнаты</label>
                    <div class="row">
                      <div class="col-5">
                        <input type="text" class="form-control" placeholder="от">
                      </div>
                      <div class="col-5">
                        <input type="text" class="form-control" placeholder="до">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Комноты не входящие в диапазон (писать через пробел
                      обязательно)</label>
                    <textarea class="form-control" rows="3" placeholder="Кмноты писать через пробел."></textarea>
                  </div> -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
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