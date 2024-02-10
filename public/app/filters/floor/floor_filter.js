let selectBuildings = document.getElementById('buildings');

$(document).ready(function () {
  $(selectBuildings).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route('floor.index', 'all'),
      data: { building_id: selectBuildings.value },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (floors) {

        let floorTbl = document.getElementById('floorTbl');
        floorTbl.removeChild(floorTbl.getElementsByTagName("tbody")[0]);
        let floorBody = document.createElement("tbody");
        let trAction = document.getElementById('action');


        for (let i = 0; i < floors.length; i++) {

          let row = document.createElement("tr");

          let cell = document.createElement("td");
          cell.insertAdjacentHTML('beforeend', `<a href="${route('floor.show', floors[i]['id'])}">${floors[i]['name']}</a>`);
          row.appendChild(cell);

          cell = document.createElement("td");
          cell.insertAdjacentHTML('beforeend', `<a href="${route('building.show', floors[i]['building_id'])}">${floors[i]['building_name']}</a>`);
          row.appendChild(cell);

          if (trAction) {

            cell = document.createElement("td");
            cell.insertAdjacentHTML(
              'beforeend',
              `<a href="${route('floor.edit', floors[i]['id'])}" class="btn btn-info btn-sm float-left mr-1">
                <i class="fas fa-pencil-alt"></i>
            </a> 

            <a href="${route('floor.destroy', floors[i]['id'])}" class="btn btn-danger btn-sm">
              <i class="fas fa-trash-alt"></i>
            </a>`
            );
            row.appendChild(cell);
          }

          floorBody.appendChild(row);
        }

        floorTbl.appendChild(floorBody);
        history.pushState({}, '', route('floor.index', selectBuildings.value));

      });
  }))

})