let selectBuildings = document.getElementById('buildings');

$(document).ready(function () {
  $(selectBuildings).on('change', (function () {

    $.ajax({
      method: "GET",
      url: "{{ route('floor.index', ['building' => 'all']) }}",
      data: { building_id: selectBuildings.value },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (floors) {

        let floorTbl = document.getElementById('floorTbl');
        floorTbl.removeChild(floorTbl.getElementsByTagName("tbody")[0]);
        let floorBody = document.createElement("tbody");

        for (let i = 0; i < floors.length; i++) {

          let row = document.createElement("tr");

          let url = "";
          let cell = document.createElement("td");
          cell.insertAdjacentHTML('beforeend', `<a href="${url}/${floors[i]['id']}">${floors[i]['name']}</a>`);
          row.appendChild(cell);

          url = "";
          cell = document.createElement("td");
          cell.insertAdjacentHTML('beforeend', `<a href="${url}/${floors[i]['building_id']}">${floors[i]['building_name']}</a>`);
          row.appendChild(cell);

          url = "";
          cell = document.createElement("td");
          cell.insertAdjacentHTML(
            'beforeend',
            `<a href="${url}/${floors[i]['id']}/edit" class="btn btn-info btn-sm float-left mr-1">
              <i class="fas fa-pencil-alt"></i>
          </a>

          <form action="" method="post" class="float-left">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
              onclick="return confirm('Подтвердите удаление')">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>`
          );
          row.appendChild(cell);

          floorBody.appendChild(row);
        }

        floorTbl.appendChild(floorBody);

        let url = location.pathname;
        urlArr = url.split('/')
        index = urlArr.indexOf('index');
        urlArr[index - 1] = selectBuildings.value;
        url = urlArr.join('/');
        history.pushState({}, '', url);

      });
  }))

})