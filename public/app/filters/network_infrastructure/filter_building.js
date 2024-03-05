const selects = {

  selectBuildings: $('#buildings'),
  selectFinalBuildings: $('#finalBuildings'), 
};

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
  selects.selectBuildings.add(selects.selectFinalBuildings).on('change', function () {
    if ($(this).val() === '') {

      const isFinal = $(this).is(selects.selectFinalBuildings);
      selects[isFinal ? 'selectFinalFloors' : 'selectFloors'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledFloors'], selected: true })).prop('disabled', true);  
      selects[isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledRooms'], selected: true })).prop('disabled', true);
    }

    const isFinal = $(this).is(selects.selectFinalBuildings);
    selects[isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleFloors'], selected: true })).prop('disabled', true);
    selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change');
    const url = route('filter.location');
    const params = { 

      building_id: this.value,
      isFinal: isFinal
    };

    fetchData(url, params, function (data) {
      
      console.log(data);
      console.log(params);
      
      selectUpdate(data, params.isFinal);      
    });
  });
});