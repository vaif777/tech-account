@extends('layouts.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
      <!-- Small boxes (Stat box) -->
      <div>
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Добовление телекоммуникационного шкафа</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Здание</label>
                  <select class="form-control select2" id="buildings" style="width: 100%;">
                    <option selected="selected">Выберите здание</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Этаж</label>
                  <select id="floors" class="form-control select2" disabled="disabled" style="width: 100%;">
                    <option selected="selected">Выберите этаж</option>
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
  <!-- /.content -->
</div>
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
<script>
  let buildings = <?php echo $buildings; ?>;
  let selectBuildings = document.getElementById('buildings');

  for (let i = 0; i < buildings.length; i++) {
    let opt = document.createElement('option');
    opt.value = buildings[i]['id'];
    opt.innerHTML = buildings[i]['name'];
    selectBuildings.appendChild(opt);
  }

  $(document).ready(function () {
    $(selectBuildings).on('change', (function () {

      $.ajax({
        method: "GET",
        url: "{{ route('telecom-cabinet.create') }}",
        data: { building_id: selectBuildings.value },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
        .done(function (floors) {
          let url = location.pathname;
          url += selectBuildings.value == 'Выберите здание' ? '' : '?building_id=' + selectBuildings.value;
          history.pushState({}, '', url);

          let selectFloors = document.getElementById('floors');
          let opt = document.createElement('option');
          selectFloors.disabled = false;
          selectFloors.options.length = 0;
          opt.selected = "selected";
          opt.innerHTML = 'Выберите этаж';
          selectFloors.appendChild(opt);

          for (let i = 0; i < floors.length; i++) {
            opt = document.createElement('option');
            opt.value = floors[i]['id'];
            opt.innerHTML = floors[i]['name'];
            selectFloors.appendChild(opt);
          }

          if (selectFloors.options.length <= 1) selectFloors.disabled = true;

        });
    }))

  })
</script>
@endsection