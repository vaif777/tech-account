selects.selectFloors = $('#floors');
selects.selectFinalFloors = $('#finalFloors');
selects.firstOptionTitleFloors = 'Выберите этаж';
selects.firstOptionTitleDisabledFloors = 'Выберите здание';

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
  selects.selectFloors.add(selects.selectFinalFloors).on('change', function () {
    if ($(this).val() === '') {
 
      const isFinal = $(this).is(selects.selectFinalFloors);
      selects[isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledRooms'], selected: true })).prop('disabled', true);
    }

    const isFinal = $(this).is(selects.selectFinalFloors);
    $.hasOwnProperty.call(selects, isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts') ? selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change') : '';
    const url = route('filter.location');
    const params = { 

      isFinal: isFinal,
      floor_id: this.value,
      building_id: isFinal ? $(selects.selectFinalBuildings).val() : $(selects.selectBuildings).val(),
    };
    fetchData(url, params, function (data) {

      selectUpdate (data, params.isFinal); 
    });
  });
});