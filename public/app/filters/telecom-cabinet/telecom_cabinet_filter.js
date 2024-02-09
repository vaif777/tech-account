
  //let buildings = <?php echo $buildings; ?>;
  let selectBuildings = document.getElementById('buildings');

//   for (let i = 0; i < buildings.length; i++) {
//     let opt = document.createElement('option');
//     opt.value = buildings[i]['id'];
//     opt.innerHTML = buildings[i]['name'];
//     selectBuildings.appendChild(opt);
//   }

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