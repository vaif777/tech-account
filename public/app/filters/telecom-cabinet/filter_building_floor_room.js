let selectBuildings = document.getElementById('buildings');
let selectFloors = document.getElementById('floors');
let selectRooms = document.getElementById('rooms');
let route = document.getElementById('route').value;

$(document).ready(function () {
  $(selectBuildings).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: { building_id: selectBuildings.value },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let floors = data['floors'];
        let telecomCabinets = data['telecomCabinets'];
        let selectFloors = document.getElementById('floors');
        let opt = document.createElement('option');

        selectFloors.disabled = false;
        selectFloors.options.length = 0;
        opt.value = '';
        opt.selected = "selected";
        opt.innerHTML = 'Выберите этаж';
        selectFloors.appendChild(opt);

        for (let key in floors) {

          opt = document.createElement('option');
          opt.value = floors[key]['id'];
          opt.innerHTML = floors[key]['name'];
          selectFloors.appendChild(opt);
        }

        if (telecomCabinets) {

          let selectTelecomCabinets = document.getElementById('telecomCabinets');
          opt = document.createElement('option');

          selectTelecomCabinets.options.length = 0;
          opt.value = '';
          opt.selected = "selected";
          opt.innerHTML = 'Выберите шкаф';
          selectTelecomCabinets.appendChild(opt);

          for (let key in telecomCabinets) {

            opt = document.createElement('option');
            opt.value = telecomCabinets[key]['id'];
            opt.innerHTML = telecomCabinets[key]['name'];
            selectTelecomCabinets.appendChild(opt);
          }

        }

        if (selectFloors.options.length <= 1 || !selectBuildings.value) {

          selectFloors.options.length = 0;
          opt = document.createElement('option');
          opt.value = '';
          opt.selected = "selected";
          opt.innerHTML = 'Нужно выбрать здание';
          selectFloors.appendChild(opt);
          selectFloors.disabled = true;

          let selectRooms = document.getElementById('rooms');
          selectRooms.options.length = 0;
          opt = document.createElement('option');
          opt.value = '';
          opt.selected = "selected";
          opt.innerHTML = 'Нужно выбрать этаж';
          selectRooms.appendChild(opt);
          selectRooms.disabled = true;

          if (telecomCabinets) {

            let selectTelecomCabinets = document.getElementById('telecomCabinets');
            opt = document.createElement('option');

            selectTelecomCabinets.options.length = 0;
            opt.value = '';
            opt.selected = "selected";
            opt.innerHTML = 'Выберите шкаф';
            selectTelecomCabinets.appendChild(opt);

            for (let key in telecomCabinets) {

              opt = document.createElement('option');
              opt.value = telecomCabinets[key]['id'];
              opt.innerHTML = telecomCabinets[key]['name'];
              selectTelecomCabinets.appendChild(opt);
            }

          }

        }

      });
  }))

})

$(document).ready(function () {
  $(selectFloors).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: { 
        building_id: selectBuildings.value,
        floor_id: selectFloors.value 
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let rooms = data['rooms'];
        let telecomCabinets = data['telecomCabinets'];
        let selectRooms = document.getElementById('rooms');
        let opt = document.createElement('option');

        selectRooms.disabled = false;
        selectRooms.options.length = 0;
        opt.value = '';
        opt.selected = "selected";
        opt.innerHTML = 'Выберите комнату';
        selectRooms.appendChild(opt);

        for (let key in rooms) {

          opt = document.createElement('option');
          opt.value = rooms[key]['id'];
          opt.innerHTML = rooms[key]['name'];
          selectRooms.appendChild(opt);
        }

        if (telecomCabinets) {

          let selectTelecomCabinets = document.getElementById('telecomCabinets');
          opt = document.createElement('option');

          selectTelecomCabinets.options.length = 0;
          opt.value = '';
          opt.selected = "selected";
          opt.innerHTML = 'Выберите шкаф';
          selectTelecomCabinets.appendChild(opt);

          for (let key in telecomCabinets) {

            opt = document.createElement('option');
            opt.value = telecomCabinets[key]['id'];
            opt.innerHTML = telecomCabinets[key]['name'];
            selectTelecomCabinets.appendChild(opt);
          }

        }

        if (selectRooms.options.length <= 1 || !selectFloors.value) {

          selectRooms.options.length = 0;
          opt = document.createElement('option');
          opt.selected = "selected";
          opt.innerHTML = 'Нужно выбрать этаж';
          selectRooms.appendChild(opt);
          selectRooms.disabled = true;

          if (telecomCabinets) {

            let selectTelecomCabinets = document.getElementById('telecomCabinets');
            opt = document.createElement('option');

            selectTelecomCabinets.options.length = 0;
            opt.value = '';
            opt.selected = "selected";
            opt.innerHTML = 'Выберите шкаф';
            selectTelecomCabinets.appendChild(opt);

            for (let key in telecomCabinets) {

              opt = document.createElement('option');
              opt.value = telecomCabinets[key]['id'];
              opt.innerHTML = telecomCabinets[key]['name'];
              selectTelecomCabinets.appendChild(opt);
            }

          }
        }

      });
  }))

})

$(document).ready(function () {
  $(selectRooms).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: { 
        building_id: selectBuildings.value,
        floor_id: selectFloors.value,
        room_id: selectRooms.value 
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let telecomCabinets = data['telecomCabinets'];

        if (telecomCabinets) {

          let selectTelecomCabinets = document.getElementById('telecomCabinets');
          let opt = document.createElement('option');

          selectTelecomCabinets.options.length = 0;
          opt.value = '';
          opt.selected = "selected";
          opt.innerHTML = 'Выберите шкаф';
          selectTelecomCabinets.appendChild(opt);

          for (let key in telecomCabinets) {

            opt = document.createElement('option');
            opt.value = telecomCabinets[key]['id'];
            opt.innerHTML = telecomCabinets[key]['name'];
            selectTelecomCabinets.appendChild(opt);
          }

        }

        if (selectRooms.value) {

          if (telecomCabinets) {

            let selectTelecomCabinets = document.getElementById('telecomCabinets');
            opt = document.createElement('option');

            selectTelecomCabinets.options.length = 0;
            opt.value = '';
            opt.selected = "selected";
            opt.innerHTML = 'Выберите шкаф';
            selectTelecomCabinets.appendChild(opt);

            for (let key in telecomCabinets) {

              opt = document.createElement('option');
              opt.value = telecomCabinets[key]['id'];
              opt.innerHTML = telecomCabinets[key]['name'];
              selectTelecomCabinets.appendChild(opt);
            }

          }
        }

      });
  }))

})