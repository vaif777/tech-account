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
            <form method="post" action="{{ route('user.store') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="input" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror" placeholder="ФИО">
                  @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="input" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
            
                <div class="form-group">
                  <label>Прова для пользователя:</label>
                </div>
                <div class="row">

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input value="1"  name="add" type="checkbox" {{ old('add') ? 'checked' : '' }} id="checkboxSuccess1">
                        <label for="checkboxSuccess1">
                          Добавление
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input value="1" name="edit" type="checkbox" {{ old('edit') ? 'checked' : '' }} id="checkboxPrimary1">
                        <label for="checkboxPrimary1">
                          Редактирование
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-danger d-inline">
                        <input value="1" name="delite" type="checkbox" {{ old('delite') ? 'checked' : '' }} id="checkboxDanger1">
                        <label for="checkboxDanger1">
                          Удаление
                        </label>
                      </div>
                    </div>
                  </div>

                  @if (Auth()->user()->permissions->activated)
                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="activated" type="checkbox" {{ old('activated') ? 'checked' : '' }} id="checkboxsecondary9">
                        <label for="checkboxsecondary9">
                          Потверждеие пользователей
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                
                <div class="form-group">
                  <label>Разделы которые может видеть пользователи:</label>
                </div>

                <div class="row">

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="SCS" type="checkbox" {{ old('SCS') ? 'checked' : '' }} id="checkboxsecondary2">
                        <label for="checkboxsecondary2">
                         СКС
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="telephony" type="checkbox" {{ old('telephony') ? 'checked' : '' }} id="checkboxsecondary3">
                        <label for="checkboxsecondary3">
                         Телефония
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="storage" type="checkbox" {{ old('storage') ? 'checked' : '' }} id="checkboxsecondary4">
                        <label for="checkboxsecondary4">
                         Склад
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="common_elements" type="checkbox" {{ old('common_elements') ? 'checked' : '' }} id="checkboxsecondary5">
                        <label for="checkboxsecondary5">
                        Общие элементы
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="user" type="checkbox" {{ old('user') ? 'checked' : '' }} id="checkboxsecondary6">
                        <label for="checkboxsecondary6">
                        Пользователи
                        </label>
                      </div>
                    </div>
                  </div>

                  
                  <div class="col-sm-2">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="settings" type="checkbox" {{ old('settings') ? 'checked' : '' }} id="checkboxsecondary7">
                        <label for="checkboxsecondary7">
                        Настройки
                        </label>
                      </div>
                    </div>
                  </div>
                  
                </div>

                @if ($confirmEachNewRegisteredUser and Auth()->user()->permissions->activated)
                <div class="form-group">
                  <label>Подтвердить учетную запись:</label>
                </div>

                <div class="row">

                  <div class="col-sm-6">
                    <div class="form-group clearfix">
                      <div class="icheck-secondary d-inline">
                        <input value="1" name="activated_user" type="checkbox" {{ old('activated_user') ? 'checked' : '' }} id="checkboxsecondary8">
                        <label for="checkboxsecondary8">
                         Активировать
                        </label>
                      </div>
                    </div>
                  </div>
                  
                </div>
                @endif




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
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.cssэ') }}">
</script>
@endsection