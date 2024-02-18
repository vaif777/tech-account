let selectFinalBuildings = document.getElementById('finalBuildings');
let selectFinalTelecomCabinets = document.getElementById('finalTelecomCabinets');
let selectFinalFloors = document.getElementById('finalFloors');
let selectFinalRooms = document.getElementById('finalRooms');
let selectFinalPatchPanels = document.getElementById('finalPatchPanels');
let selectFinalPorts = document.getElementById('finalPatchPanelPorts');
let FinalRoute = document.getElementById('route').value;


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
  $(selectFinalBuildings).on('change', (function () {

    $.ajax({
      method: "GET",
      url: FinalRoute,
      data: { 
        building_id: selectFinalBuildings.value,
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

        optionAdd(false, true, true, selectFinalFloors, 'Выберите этаж')

        for (let key in floors) {

          optionAdd(false, false, false, selectFinalFloors, floors[key]['name'], floors[key]['id'])
        }

        if (telecomCabinets) {

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectFinalBuildings.value) {

          optionAdd(true, true, true, selectFinalFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectFinalRooms, 'Нужно выбрать этаж');
          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

        if (selectFinalPatchPanels && !selectFinalPatchPanels.value) {

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectFinalFloors.value) {

          optionAdd(true, true, true, selectFinalRooms, 'Нужно выбрать этаж');
        }

      });
  }))

})

$(document).ready(function () {
  $(selectFinalFloors).on('change', (function () {

    $.ajax({
      method: "GET",
      url: FinalRoute,
      data: {
        building_id: selectFinalBuildings.value,
        floor_id: selectFinalFloors.value,
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

        optionAdd(false, true, true, selectFinalRooms, 'Выберите комнату');

        for (let key in rooms) {

          optionAdd(false, false, false, selectFinalRooms, rooms[key]['name'], rooms[key]['id']);
        }

        if (telecomCabinets) {

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectFinalFloors.value) {

          optionAdd(true, true, true, selectFinalRooms, 'Нужно выбрать этаж');
          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectFinalPatchPanels.value) {

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})

$(document).ready(function () {
  $(selectFinalRooms).on('change', (function () {

    $.ajax({
      method: "GET",
      url: FinalRoute,
      data: {
        building_id: selectFinalBuildings.value,
        floor_id: selectFinalFloors.value,
        room_id: selectFinalRooms.value,
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

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectFinalRooms.value) {

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectFinalPatchPanels.value) {

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }
      });
  }))

})

$(document).ready(function () {
  $(selectFinalTelecomCabinets).on('change', (function () {

    $.ajax({
      method: "GET",
      url: FinalRoute,
      data: {
        building_id: selectFinalBuildings.value,
        floor_id: selectFinalFloors.value,
        room_id: selectFinalRooms.value,
        telecommunication_cabinet_id: selectFinalTelecomCabinets.value,
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

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

      if (locations) {

        let serchOption = selectFinalBuildings.querySelector("option[value='" + locations['building_id'] + "']");
        serchOption.selected = "selected";
        selectFinalBuildings.appendChild(serchOption);

        if (locations['floor_id'] ) {

          optionAdd(false, true, false, selectFinalFloors, 'Выберите этаж');

          for (let key in floors) {

            if (floors[key]['id'] == locations['floor_id']) {

              optionAdd(false, false, true, selectFinalFloors, floors[key]['name'], floors[key]['id']);
              continue;
            }

            optionAdd(false, false, false, selectFinalFloors, floors[key]['name'], floors[key]['id']);
          }
        } else {

          optionAdd(true, true, true, selectFinalFloors, 'Этаж не задан');
        }

        if (locations['room_id']) {

          optionAdd(false, true, false, selectFinalRooms, 'Выберите комнату');

          for (let key in rooms) {

            if (rooms[key]['id'] == locations['room_id']) {

              optionAdd(false, false, true, selectFinalRooms, rooms[key]['name'], rooms[key]['id']);
              continue;
            }

            optionAdd(false, false, false, selectFinalRooms, rooms[key]['name'], rooms[key]['id']);
          }
        } else {

          optionAdd(true, true, true, selectFinalRooms, 'Комната не задана');
        }

      }

        if (!selectFinalTelecomCabinets.value) {

          optionAdd(true, true, true, selectFinalFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectFinalRooms, 'Нужно выбрать этаж');

          let serchOption = selectFinalBuildings.querySelector("option[value='" +''+ "']");
          serchOption.selected = "selected";
          selectFinalBuildings.insertBefore(serchOption, selectFinalBuildings.firstChild);

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanelsAll) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanelsAll[key]['name'], patchPanelsAll[key]['id']);
          }

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinetsAll) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinetsAll[key]['name'], telecomCabinetsAll[key]['id']);
          }

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

        if (selectFinalPatchPanels && !selectFinalPatchPanels.value) {

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})

$(document).ready(function () {
  $(selectFinalPatchPanels).on('change', (function () {

    $.ajax({
      method: "GET",
      url: FinalRoute,
      data: {
        patch_panel_id: selectFinalPatchPanels.value
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
        selectFinalPorts.options.length = 0

        if (locations) {

          let serchOption = selectFinalBuildings.querySelector("option[value='" + locations['building_id'] + "']");
          serchOption.selected = "selected";
          selectFinalBuildings.appendChild(serchOption);
  
          if (locations['floor_id']) {
  
            optionAdd(false, true, false, selectFinalFloors, 'Выберите этаж');
  
            for (let key in floors) {
  
              if (floors[key]['id'] == locations['floor_id']) {
  
                optionAdd(false, false, true, selectFinalFloors, floors[key]['name'], floors[key]['id']);
                continue;
              }
  
              optionAdd(false, false, false, selectFinalFloors, floors[key]['name'], floors[key]['id']);
            }
          } else {
  
            optionAdd(true, true, true, selectFinalFloors, 'Этаж не задан');
          }
  
          if (locations['room_id']) {
  
            optionAdd(false, true, false, selectFinalRooms, 'Выберите комнату');
  
            for (let key in rooms) {
  
              if (rooms[key]['id'] == locations['room_id']) {
  
                optionAdd(false, false, true, selectFinalRooms, rooms[key]['name'], rooms[key]['id']);
                continue;
              }
  
              optionAdd(false, false, false, selectFinalRooms, rooms[key]['name'], rooms[key]['id']);
            }
          } else {
  
            optionAdd(true, true, true, selectFinalRooms, 'Комната не задана');
          }

          if (locations['telecommunication_cabinet_id']) {
  
            optionAdd(false, true, false, selectFinalTelecomCabinets, 'Выберите шкаф');
            optionAdd(false, false, true, selectFinalTelecomCabinets, telecomCabinet['name'], telecomCabinet['id']);     
          } else {
  
            optionAdd(true, true, true, selectFinalTelecomCabinets, 'Шкаф не задана');
          }

        }

        for (let key in ports) {

          optionAdd(false, false, false, selectFinalPorts, ports[key], ports[key]);
        }

        $(selectFinalPorts).bootstrapDualListbox('refresh', true);

        if (!selectFinalPatchPanels.value) {

          optionAdd(true, true, true, selectFinalFloors, 'Нужно выбрать здание');
          optionAdd(true, true, true, selectFinalRooms, 'Нужно выбрать этаж');

          let serchOption = selectFinalBuildings.querySelector("option[value='" +''+ "']");
          serchOption.selected = "selected";
          selectFinalBuildings.insertBefore(serchOption, selectFinalBuildings.firstChild);

          optionAdd(false, true, true, selectFinalTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinetsAll) {

            optionAdd(false, false, false, selectFinalTelecomCabinets, telecomCabinetsAll[key]['name'], telecomCabinetsAll[key]['id']);
          }

          optionAdd(false, true, true, selectFinalPatchPanels, 'Выберите патч панель');

          for (let key in patchPanelsAll) {

            optionAdd(false, false, false, selectFinalPatchPanels, patchPanelsAll[key]['name'], patchPanelsAll[key]['id']);
          }

          optionAdd(false, true, false, selectFinalPorts, 'Выберите патч панель');
          $(selectFinalPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})
