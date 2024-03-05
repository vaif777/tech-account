selects.selectPatchPanels = $('#patchPanels');
selects.selectFinalPatchPanels = $('#finalPatchPanels');
selects.firstOptionTitlePatchPanels = 'Выберите патч панель';
selects.firstOptionTitleDisabledPatchPanels = 'Выберите патч панель';

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
    selects.selectPatchPanels.add(selects.selectFinalPatchPanels).on('change', function () {

        const isFinal = $(this).is(selects.selectFinalPatchPanels);
        selects[isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts'].empty().append($('<option>', { value: '', text: selects['firstOptionTitlePatchPanelPorts']})).trigger('change');
        const url = route('filter.location');
        const params = { 
  
            isFinal: isFinal,
            patch_panel_id: this.value,
        };
  
      fetchData(url, params, function (data) {
    
        console.log(params);
        console.log(data);
        selectUpdate (data, params.isFinal, data.locations); 

        if (params.patch_panel_id === '') {

            $(selects[params.isFinal ? 'selectFinalBuildings' : 'selectBuildings']).val('');
            $(selects[params.isFinal ? 'selectFinalBuildings' : 'selectBuildings']).select2('destroy').select2();
            selects[params.isFinal ? 'selectFinalFloors' : 'selectFloors'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledFloors'], selected: true })).prop('disabled', true);  
            selects[params.isFinal ? 'selectFinalRooms' : 'selectRooms'].empty().append($('<option>', { value: '', text: selects['firstOptionTitleDisabledRooms'], selected: true })).prop('disabled', true);
        } 
      });
    });
  });