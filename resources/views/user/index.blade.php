@extends('layouts.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 id=test class="m-0">Пользователи</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div>
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default collapsed-card">
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
              <a href="{{ route('floor.create') }}" class="btn btn-success mb-3">+ Добавить</a>
              <a href="{{ route('floor.create') }}" class="btn btn-success mb-3">+ Добавление через почту</a>
              <div class="table-responsive">
                @if (count($users))
                <table id="floorTbl" class="table table-bordered table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ФИО</th>
                      <th>Email</th>
                      <th>дествие</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td><a href="{{ route('user.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                      <td>{{ $user->email }}</td>
                      <td>

                        <button id="confirmation{{$user->id}}" type="button" class="btn btn-secondary btn-sm float-left mr-1">
                          Подтвердите
                        </button>

                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                          class="btn btn-info btn-sm float-left mr-1">
                          <i class="fas fa-pencil-alt"></i>
                        </a>

                        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post"
                          class="float-left">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Подтвердите удаление')">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>

                      </td>
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

  let buttonsConfirmation = document.querySelectorAll("button.btn.btn-secondary.btn-sm.float-left.mr-1");

  for (let i = 0; i <= buttonsConfirmation.length; i++) {

    $(document).ready(function () {
      $(buttonsConfirmation[i]).on('click', (function () {

        $.ajax({
          method: "GET",
          url: "{{ route('user.index') }}",
          data: { building_id: true },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
          .done(function (floors) {
            
            let divSuccess = document.getElementById('success');
            divSuccess.insertAdjacentHTML('beforeend','<div class="alert alert-success">ok</div>');
            buttonsConfirmation[i].remove();

          });
      }))

    })

  }
  
  
</script>
@endsection