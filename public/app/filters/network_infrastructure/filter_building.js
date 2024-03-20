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
      $.hasOwnProperty.call(selects, 'selectDistributions') ? selects.selectDistributions.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributions, selected: true })).prop('disabled', true) : '';
      $.hasOwnProperty.call(selects, 'selectDistributionsTelecomCabinets') ? selects.selectDistributionsTelecomCabinets.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributions, selected: true })).prop('disabled', true) : '';
      $.hasOwnProperty.call(selects, 'selectDistributionsPatchPanels') ? selects.selectDistributionsPatchPanels.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributions, selected: true })).prop('disabled', true) : '';
      $.hasOwnProperty.call(selects, 'selectDistributionsNetworkEquipments') ? selects.selectDistributionsNetworkEquipments.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributions, selected: true })).prop('disabled', true) : '';
      $.hasOwnProperty.call(selects, 'selectSubscriberDevices') ? selects.selectSubscriberDevices.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledSubscriberDevices, selected: true })).prop('disabled', true) : '';

      if (typeof sections !== 'undefined') { 

        sections.sectionFilter.hide();
        sections.sectionReferenceDevice.hide();
        sections.sectionNetworkEquipment.hide();
        sections.sectionConnectionNetworkEquipment.hide();
      }
    }

    const isFinal = $(this).is(selects.selectFinalBuildings);
    selects[isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleFloors'], selected: true })).prop('disabled', true);
    
    if ($(selects.selectBuildings).data('port-refresh') != 'false') {

      $.hasOwnProperty.call(selects, isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts') ? selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change') : '';
    }
    const url = route('filter.location');
    const params = { 

      building_id: this.value,
      floorAndRoomGroupBy: $(selects.selectBuildings).data('floor-and-room-group-by'),
      isFinal: isFinal
    };

    fetchData(url, params, function (data) {
      
      console.log(data);
      selectUpdate(data, params.isFinal, [], $(selects.selectBuildings).data('port-refresh'));      
    });
  });
});