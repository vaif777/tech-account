function selectUpdate (data, isFinal, locations = []) {

  for (const [key, elements] of Object.entries(data)) {

    if (key == 'locations') continue;

    const selectName = key.charAt(0).toUpperCase() + key.slice(1);
    let idName = key === 'telecomCabinets' || key === 'finalTelecomCabinets' ? 'telecommunication_cabinet_id' : key.slice(0, -1).replace('final', '')+'_id';
    idName = idName.charAt(0).toLowerCase() + idName.slice(1);
    const optionTitle =  $.isEmptyObject(elements) ? 'Записей нет' : selects[( 'firstOptionTitle' ) + ( isFinal ? selectName.replace('Final', '') : selectName )]
    
    if (!$.hasOwnProperty.call(selects, 'select' + selectName)) continue;
    
    if (('select' + selectName == 'selectBuildings' || 'select' + selectName == 'selectFinalBuildings') && !$.isEmptyObject(locations)) {

      $(selects['select' + selectName]).val(locations.building_id);
      $(selects['select' + selectName]).select2('destroy').select2();
    } else if (('select' + selectName == 'selectPatchPanelPorts' || 'select' + selectName == 'selectFinalPatchPanelPorts') && !$.isEmptyObject(elements)) {

      selects['select' + selectName].empty();
    } else {

      optionAdd(selects['select' + selectName], { 
        clear: true, 
        id: '', 
        title: optionTitle, 
        selected: true 
      });
    }
    
    if ($.isEmptyObject(elements))  continue;

    for (const [key, element] of Object.entries(elements)) {

      optionAdd(selects['select' + selectName], {
        
        id:'select' + selectName == 'selectPatchPanelPorts' || 'select' + selectName == 'selectFinalPatchPanelPorts' ? element : element.id, 
        title: 'select' + selectName == 'selectPatchPanelPorts' || 'select' + selectName == 'selectFinalPatchPanelPorts' ? element : element.name, 
        selected: $.hasOwnProperty.call(locations, idName) && locations[idName] == element.id ? true : false,
        data: element.data
      });
    }
  }

  $.hasOwnProperty.call(selects, isFinal ? 'selectFinalPatchPanelPorts' : 'selectPatchPanelPorts') ? $(isFinal ? selects.selectFinalPatchPanelPorts : selects.selectPatchPanelPorts).bootstrapDualListbox('refresh', true) : '';
}