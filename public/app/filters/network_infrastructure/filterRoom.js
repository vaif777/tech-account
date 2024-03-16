selects.selectRooms = $('#rooms');
selects.selectFinalRooms = $('#finalRooms');
selects.firstOptionTitleRooms = 'Выберите комнату';
selects.firstOptionTitleDisabledRooms = 'Выберите этаж';

function fetchData(url, params, callback) {
    $.ajax({
      method: "GET",
      url: url,
      data: params,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(callback);
  }
  
  $(document).ready(function () {
    selects.selectRooms.add(selects.selectFinalRooms).on('change', function () {

      const isFinal = $(this).is(selects.selectFinalRooms);
      $.hasOwnProperty.call(selects, isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts') ? selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change') : '';
      const url = route('filter.location');
      const params = { 
  
        isFinal: isFinal,
        room_id: this.value,
        floor_id: isFinal ? $(selects.selectFinalFloors).val() : $(selects.selectFloors).val(),
        building_id: isFinal ? $(selects.selectFinalBuildings).val() : $(selects.selectBuildings).val(),
      };
  
      fetchData(url, params, function (data) {

        selectUpdate (data, params.isFinal); 
      });
    });
  });