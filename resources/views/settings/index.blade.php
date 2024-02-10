@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0"></h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="invoice p-3 mb-3">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h3>
            Настройки
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->

      <div class="card-body">
        <h5>Открытая регистрация:</h5>
        <input id="settings" type="checkbox" name="open_registration" data-title="открытая регистрация" {{
          $settings->open_registration ? 'checked' : '' }} >
      </div>

      <div class="card-body">
        <h5>Массовое добавление по почте:</h5>
        <input id="settings" type="checkbox" name="mass_addition_by_mail" data-title="массовое добавление по почте" {{
          $settings->mass_addition_by_mail ? 'checked' : '' }} >
      </div>

      <div class="card-body">
        <h5>Подтверждать каждого нового зарегистрированного пользователя:</h5>
        <input id="settings" type="checkbox" name="confirm_each_new_registered_user"
          data-title="подтверждать каждого нового зарегистрированного пользователя" {{
          $settings->confirm_each_new_registered_user ? 'checked' : '' }} >
      </div>

    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<!-- Bootstrap Switch -->
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- setting -->
<script src="{{ asset('public/app/setting/setting.js') }}"></script>
<script>

  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })

</script>
@endsection