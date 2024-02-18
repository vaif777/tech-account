let selectBuildings = document.getElementById('buildings');
let selectTelecomCabinets = document.getElementById('telecomCabinets');
let selectFloors = document.getElementById('floors');
let selectRooms = document.getElementById('rooms');
let selectPatchPanels = document.getElementById('patchPanels');
let selectPorts = document.getElementById('patchPanelPorts');
let route = document.getElementById('route').value;


function optionAdd(disabled, optionsDelete, selected, select, title, id = '') {

  select.disabled = disabled;
  optionsDelete ? select.options.length = 0 : '';
  let opt = document.createElement('option');
  selected ? opt.selected = "selected" : '';

  opt.value = id;
  opt.innerHTML = title;
  select.appendChild(opt);
}

$(document).ready(function () {
  $(selectBuildings).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: { 
        building_id: selectBuildings.value,
        filter: true
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let floors = data['floors'];
        let telecomCabinets = data['telecomCabinets'];
        let patchPanels = data['patchPanels'];

        optionAdd(false, true, true, selectFloors, 'Выберите этаж')

        for (let key in floors) {

          optionAdd(false, false, false, selectFloors, floors[key]['name'], floors[key]['id'])
        }

        if (telecomCabinets) {

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectBuildings.value) {

          optionAdd(true, true, true, selectFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectRooms, 'Нужно выбрать этаж');
          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (selectPatchPanels && !selectPatchPanels.value) {

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectFloors.value) {

          optionAdd(true, true, true, selectRooms, 'Нужно выбрать этаж');
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
        floor_id: selectFloors.value,
        filter: true
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let rooms = data['rooms'];
        let telecomCabinets = data['telecomCabinets'];
        let patchPanels = data['patchPanels'];

        optionAdd(false, true, true, selectRooms, 'Выберите комнату');

        for (let key in rooms) {

          optionAdd(false, false, false, selectRooms, rooms[key]['name'], rooms[key]['id']);
        }

        if (telecomCabinets) {

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectFloors.value) {

          optionAdd(true, true, true, selectRooms, 'Нужно выбрать этаж');
          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
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
        room_id: selectRooms.value,
        filter: true
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let telecomCabinets = data['telecomCabinets'];
        let patchPanels = data['patchPanels'];

        if (telecomCabinets) {

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectRooms.value) {

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }
      });
  }))

})

$(document).ready(function () {
  $(selectTelecomCabinets).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: {
        building_id: selectBuildings.value,
        floor_id: selectFloors.value,
        room_id: selectRooms.value,
        telecommunication_cabinet_id: selectTelecomCabinets.value,
        cabinetPatch: true
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let patchPanels = data['patchPanels'];
        let locations = data['locations'];
        let floors = data['floors'];
        let rooms = data['rooms'];
        let patchPanelsAll = data['patchPanelsAll'];
        let telecomCabinetsAll = data['telecomCabinetsAll'];

        if (patchPanels) {

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

      if (locations) {

        let serchOption = selectBuildings.querySelector("option[value='" + locations['building_id'] + "']");
        serchOption.selected = "selected";
        selectBuildings.appendChild(serchOption);

        if (locations['floor_id'] ) {

          optionAdd(false, true, false, selectFloors, 'Выберите этаж');

          for (let key in floors) {

            if (floors[key]['id'] == locations['floor_id']) {

              optionAdd(false, false, true, selectFloors, floors[key]['name'], floors[key]['id']);
              continue;
            }

            optionAdd(false, false, false, selectFloors, floors[key]['name'], floors[key]['id']);
          }
        } else {

          optionAdd(true, true, true, selectFloors, 'Этаж не задан');
        }

        if (locations['room_id']) {

          optionAdd(false, true, false, selectRooms, 'Выберите комнату');

          for (let key in rooms) {

            if (rooms[key]['id'] == locations['room_id']) {

              optionAdd(false, false, true, selectRooms, rooms[key]['name'], rooms[key]['id']);
              continue;
            }

            optionAdd(false, false, false, selectRooms, rooms[key]['name'], rooms[key]['id']);
          }
        } else {

          optionAdd(true, true, true, selectRooms, 'Комната не задана');
        }

      }

        if (!selectTelecomCabinets.value) {

          optionAdd(true, true, true, selectFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectRooms, 'Нужно выбрать этаж');

          let serchOption = selectBuildings.querySelector("option[value='" +''+ "']");
          serchOption.selected = "selected";
          selectBuildings.insertBefore(serchOption, selectBuildings.firstChild);

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanelsAll) {

            optionAdd(false, false, false, selectPatchPanels, patchPanelsAll[key]['name'], patchPanelsAll[key]['id']);
          }

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinetsAll) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinetsAll[key]['name'], telecomCabinetsAll[key]['id']);
          }

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (selectPatchPanels && !selectPatchPanels.value) {

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})

$(document).ready(function () {
  $(selectPatchPanels).on('change', (function () {

    $.ajax({
      method: "GET",
      url: route,
      data: {
        patch_panel_id: selectPatchPanels.value
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let locations = data['locations'];
        let floors = data['floors'];
        let rooms = data['rooms'];
        let ports = data['ports'];
        let telecomCabinet = data['telecomCabinet'];
        let telecomCabinetsAll = data['telecomCabinetsAll'];
        let patchPanelsAll = data['patchPanelsAll'];
        selectPorts.options.length = 0

        if (locations) {

          let serchOption = selectBuildings.querySelector("option[value='" + locations['building_id'] + "']");
          serchOption.selected = "selected";
          selectBuildings.appendChild(serchOption);
  
          if (locations['floor_id']) {
  
            optionAdd(false, true, false, selectFloors, 'Выберите этаж');
  
            for (let key in floors) {
  
              if (floors[key]['id'] == locations['floor_id']) {
  
                optionAdd(false, false, true, selectFloors, floors[key]['name'], floors[key]['id']);
                continue;
              }
  
              optionAdd(false, false, false, selectFloors, floors[key]['name'], floors[key]['id']);
            }
          } else {
  
            optionAdd(true, true, true, selectFloors, 'Этаж не задан');
          }
  
          if (locations['room_id']) {
  
            optionAdd(false, true, false, selectRooms, 'Выберите комнату');
  
            for (let key in rooms) {
  
              if (rooms[key]['id'] == locations['room_id']) {
  
                optionAdd(false, false, true, selectRooms, rooms[key]['name'], rooms[key]['id']);
                continue;
              }
  
              optionAdd(false, false, false, selectRooms, rooms[key]['name'], rooms[key]['id']);
            }
          } else {
  
            optionAdd(true, true, true, selectRooms, 'Комната не задана');
          }

          if (locations['telecommunication_cabinet_id']) {
  
            optionAdd(false, true, false, selectTelecomCabinets, 'Выберите шкаф');
            optionAdd(false, false, true, selectTelecomCabinets, telecomCabinet['name'], telecomCabinet['id']);     
          } else {
  
            optionAdd(true, true, true, selectTelecomCabinets, 'Шкаф не задана');
          }

        }

        for (let key in ports) {

          optionAdd(false, false, false, selectPorts, ports[key], ports[key]);
        }

        $(selectPorts).bootstrapDualListbox('refresh', true);

        if (!selectPatchPanels.value) {

          optionAdd(true, true, true, selectFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectRooms, 'Нужно выбрать этаж');

          let serchOption = selectBuildings.querySelector("option[value='" +''+ "']");
          serchOption.selected = "selected";
          selectBuildings.insertBefore(serchOption, selectBuildings.firstChild);

          optionAdd(false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinetsAll) {

            optionAdd(false, false, false, selectTelecomCabinets, telecomCabinetsAll[key]['name'], telecomCabinetsAll[key]['id']);
          }

          optionAdd(false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanelsAll) {

            optionAdd(false, false, false, selectPatchPanels, patchPanelsAll[key]['name'], patchPanelsAll[key]['id']);
          }

          optionAdd(false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})
