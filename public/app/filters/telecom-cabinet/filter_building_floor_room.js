let selectBuildings = document.getElementById('buildings');
let selectTelecomCabinets = document.getElementById('telecomCabinets');
let selectFloors = document.getElementById('floors');
let selectRooms = document.getElementById('rooms');
let selectPatchPanels = document.getElementById('patchPanels');
let selectFinalBuildings = document.getElementById('final_buildings'); 
let selectPorts = document.getElementById('patchPanelPorts'); 
let route = document.getElementById('route').value;

function optionAdd (disabled, optionsDelete, selected, select, title, id = '') {

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
      data: { building_id: selectBuildings.value },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let floors = data['floors'];
        let telecomCabinets = data['telecomCabinets'];
        let patchPanels = data['patchPanels'];

        optionAdd (false, true, true, selectFloors, 'Выберите этаж')

        for (let key in floors) {

          optionAdd (false, false, false, selectFloors, floors[key]['name'], floors[key]['id'])
        }

        if (telecomCabinets) {
          
          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {
          
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectBuildings.value) {

          optionAdd (true, true, true, selectFloors, 'Нужно выбрать здание');
          optionAdd (true, true, true, selectRooms, 'Нужно выбрать этаж');
          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }
          
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');
  
          for (let key in patchPanels) {
  
            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }
  
          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectFloors.value) {

          optionAdd (true, true, true, selectRooms, 'Нужно выбрать этаж');
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
        let patchPanels = data['patchPanels'];
        
        optionAdd (false, true, true, selectRooms, 'Выберите комнату');

        for (let key in rooms) {

          optionAdd (false, false, false, selectRooms, rooms[key]['name'], rooms[key]['id']);
        }

        if (telecomCabinets) {

          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {
          
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectFloors.value) {

          optionAdd (true, true, true, selectRooms, 'Нужно выбрать этаж');
          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }
          
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');
    
          for (let key in patchPanels) {
    
            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
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
        room_id: selectRooms.value 
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let telecomCabinets = data['telecomCabinets'];
        let patchPanels = data['patchPanels'];

        if (telecomCabinets) {

          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

        }

        if (patchPanels) {
          
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');

          for (let key in patchPanels) {

            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

        }

        if (!selectRooms.value) {

          optionAdd (false, true, true, selectTelecomCabinets, 'Выберите шкаф');

          for (let key in telecomCabinets) {

            optionAdd (false, false, false, selectTelecomCabinets, telecomCabinets[key]['name'], telecomCabinets[key]['id']);
          }

          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');
  
          for (let key in patchPanels) {
  
            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
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
        telecommunication_cabinet_id: selectTelecomCabinets.value 
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
      .done(function (data) {

        let patchPanels = data['patchPanels'];
        let facilityId = data['facilityId'];
        let buildings = data['buildings'];
        let floors = data['floors'];
        let rooms = data['rooms'];

        if (patchPanels) {
        
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');
  
          for (let key in patchPanels) {
  
            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }
  
        }

        optionAdd (false, true, false, selectBuildings, 'Выберите здание');
  
        for (let key in buildings) {

          if (buildings[key]['id'] == facilityId['building_id']){

            optionAdd (false, false, true, selectBuildings, buildings[key]['name'], buildings[key]['id']);
            continue;
          } 
  
          optionAdd (false, false, false, selectBuildings, buildings[key]['name'], buildings[key]['id']);
        }

        if (facilityId['floor_id']) {

          optionAdd (false, true, false, selectFloors, 'Выберите этаж');
  
        for (let key in floors) {

          if (floors[key]['id'] == facilityId['floor_id']){

            optionAdd (false, false, true, selectFloors, floors[key]['name'], floors[key]['id']);
            continue;
          } 
  
          optionAdd (false, false, false, selectFloors, floors[key]['name'], floors[key]['id']);
        }
        } else {

          optionAdd (true, true, true, selectFloors, 'Этаж не задан');
        }

        if (facilityId['room_id']) {

          optionAdd (false, true, false, selectRooms, 'Выберите комнату');
  
        for (let key in rooms) {

          if (rooms[key]['id'] == facilityId['room_id']){

            optionAdd (false, false, true, selectRooms, rooms[key]['name'], rooms[key]['id']);
            continue;
          } 
  
          optionAdd (false, false, false, selectRooms, rooms[key]['name'], rooms[key]['id']);
        }
        } else {

          optionAdd (true, true, true, selectRooms, 'Комната не задана');
        }



        if (!selectTelecomCabinets.value) {
 
          optionAdd (false, true, true, selectPatchPanels, 'Выберите патч панель');
                  
          for (let key in patchPanels) {
          
            optionAdd (false, false, false, selectPatchPanels, patchPanels[key]['name'], patchPanels[key]['id']);
          }
        
          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

        if (!selectPatchPanels.value) {

          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
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

        let ports = data['ports'];
        selectPorts.options.length = 0

        for (let key in ports) {

          optionAdd (false, false, false, selectPorts, ports[key]['number'], ports[key]['id']);
        }

        $(selectPorts).bootstrapDualListbox('refresh', true);

        if (!selectPatchPanels.value) {
          
          optionAdd (false, true, false, selectPorts, 'Выберите патч панель');
          $(selectPorts).bootstrapDualListbox('refresh', true);
        }

      });
  }))

})