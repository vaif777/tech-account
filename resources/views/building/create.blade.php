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
              <form method="post" action="{{ route('building.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Название здания *</label>
                    <input type="input" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Название здания">
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Адрес *</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3" placeholder="Адрес">{{ old('address') }}</textarea>
                    @error('address')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Этаже</label>
                    <div class="row">
                      <div class="col-6">
                        <input type="text" name="from" value="{{ old('from') }}" class="form-control @error('from') is-invalid @enderror" placeholder="от">
                        @error('from')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      <div class="col-6">
                        <input type="text" name="before" value="{{ old('before') }}" class="form-control @error('before') is-invalid @enderror" placeholder="до">
                        @error('before')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Этажи не входящие в диапазон (писать через запятую
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