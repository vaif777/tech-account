selects.selectTelecomCabinets = $('#telecomCabinets');
selects.selectFinalTelecomCabinets = $('#finalTelecomCabinets');
selects.firstOptionTitleTelecomCabinets = 'Выберите шкаф';
selects.firstOptionTitleDisabledTelecomCabinets = 'Выберите шкаф';

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
    selects.selectTelecomCabinets.add(selects.selectFinalTelecomCabinets).on('change', function () {
      
        const isFinal = $(this).is(selects.selectFinalTelecomCabinets);
        selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change');
        const url = route('filter.location');
        const params = { 
  
        isFinal: isFinal,
        telecommunication_cabinet_id: this.value,
      };
  
      fetchData(url, params, function (data) {

        console.log(data);
        console.log(params);

        selectUpdate (data, params.isFinal, data.locations); 

        if (params.telecommunication_cabinet_id === '') {

            $(selects[params.isFinal ? 'selectFinalBuildings' : 'selectBuildings']).val('');
            $(selects[params.isFinal ? 'selectFinalBuildings' : 'selectBuildings']).select2('destroy').select2();
            selects[params.isFinal ? 'selectFinalFloors' : 'selectFloors'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledFloors'], selected: true })).prop('disabled', true);  
            selects[params.isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledRooms'], selected: true })).prop('disabled', true);
        } 
      });
    });
  });