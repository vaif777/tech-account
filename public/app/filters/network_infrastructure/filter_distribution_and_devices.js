const buttonFilter = $('#buttonFilter');
selects.selectDistributions = $('#selectDistributions');
selects.selectDistributionsTelecomCabinets = $('#selectDistributionsTelecomCabinets');
selects.selectDistributionsPatchPanels = $('#selectDistributionsPatchPanels');
selects.selectDistributionsNetworkEquipments = $('#selectDistributionsNetworkEquipments');
selects.selectSubscriberDevices = $('#selectSubscriberDevices');
selects.selectSubscriber = $('#selectSubscriber');
selects.firstOptionTitleDistributionsNetworkEquipments = 'Выберите сетевое оборудование';
selects.firstOptionTitleDistributionsTelecomCabinets = 'Выберите шкаф';
selects.firstOptionTitleDistributionsPatchPanels = 'Выберите патч панель';
selects.firstOptionTitleSubscriberDevices = 'Выберите устройство';
selects.firstOptionTitleDistributions = 'Выберите распределение';
selects.firstOptionTitleDisabledDistributionsNetworkEquipments = 'Выберите шкаф';
selects.firstOptionTitleDisabledDistributions = 'Выберите локацию';
selects.firstOptionTitleDisabledSubscriberDevices = 'Выберите локацию и абонента';

const tables = {

  tableDistributionsNetworkEquipmentPorts: $('#tableDistributionsNetworkEquipmentPorts'),
  columnDistributionsNetworkEquipmentPorts: [

    'port',
    'name',
    'choice',
    'ipAddress',
    'bandwidth',
    'connectionInterfaces',
    'networkArchitecturePort',
    'power',
  ],
  tableConnectionNetworkEquipmentPorts: $('#tableConnectionNetworkEquipmentPorts'),
  columnConnectionNetworkEquipmentPorts: [

    'port',
    'name',
    'choice',
    'ipAddress',
    'bandwidth',
    'connectionInterfaces',
    'networkArchitecturePort',
    'power',
  ],
}

const sections = {

  sectionFilter : $('#sectionFilter'),
  sectionNetworkEquipment : $('#sectionNetworkEquipment'),
  sectionConnectionNetworkEquipment: $('#sectionConnectionNetworkEquipment'),
  sectionReferenceDevice: $('#sectionReferenceDevice')
}


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
  buttonFilter.add(selects.selectDistributionsTelecomCabinets).add(selects.selectDistributionsPatchPanels).add(selects.selectDistributionsNetworkEquipments).on('click change', function () {
    if ($(selects.selectDistributionsTelecomCabinets).val() === '' || $(this).is(buttonFilter)) {

      selects.selectDistributionsNetworkEquipments.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributionsNetworkEquipments, selected: true })).prop('disabled', true);
      selects.selectDistributionsPatchPanels.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributionsNetworkEquipments, selected: true })).prop('disabled', true);
    }

    // if ($(this).is(buttonFilter)) {

    //   selects.selectDistributionsNetworkEquipments.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributionsNetworkEquipments, selected: true })).prop('disabled', true);
    //   selects.selectDistributionsPatchPanels.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledDistributionsNetworkEquipments, selected: true })).prop('disabled', true);
    // }
    const url = route('filter.connection');
    const params = { 

      room_id: $(selects.selectRooms).val(),
      floor_id: $(selects.selectFloors).val(),
      building_id: $(selects.selectBuildings).val(),
      telecommunication_cabinet_id: $(selects.selectTelecomCabinets).val(),
      distributionsTelecomCabinetId: $(selects.selectDistributionsTelecomCabinets).val(),
      distributionsPatchPanelId: $(selects.selectDistributionsPatchPanels).val(),
      distributionsNetworkEquipmentId: $(selects.selectDistributionsNetworkEquipments).val(),
      subscriberId: $(selects.selectSubscriber).val(),
      subscriberDevicesId: $(selects.selectSubscriberDevices).val(),
      buttonClick: $(this).is(buttonFilter) ? true : '',
      
    };

    fetchData(url, params, function (data) {
      
      console.log(data);
      console.log(params);
      console.log($.isEmptyObject(sections.sectionConnectionNetworkEquipment));

      if (!$.isEmptyObject(data.connectionNetworkEquipmentPorts)){

        sections.sectionConnectionNetworkEquipment.show();
      } else {

        sections.sectionConnectionNetworkEquipment.hide();
      }

      if ($(selects.selectSubscriber).val() !== '' && $(selects.selectBuildings).val() !== ''){

        sections.sectionReferenceDevice.show();
      } else {

        sections.sectionReferenceDevice.hide();
      }

      tableUpdate (data);
      selectUpdate (data); 

      sections.sectionFilter.show();
      sections.sectionNetworkEquipment.show();
    });
  });
});

$('#selectSubscriber').add('#selectReferenceDevice').on('change', function() {
  
  if ($(this).is('#selectReferenceDevice') && $('#selectReferenceDevice').val() !== '') {

    selects.selectSubscriberDevices.val('');
    selects.selectSubscriberDevices.select2('destroy').select2();
    selects.selectSubscriberDevices.prop('disabled', true);
  } else {
    
    selects.selectSubscriberDevices.prop('disabled', false);
  }

  if ($(this).is('#selectSubscriber') && $('#selectSubscriber').val() === '') {

    selects.selectSubscriberDevices.empty().append($('<option>', { value: '', text: selects.firstOptionTitleDisabledSubscriberDevices, selected: true })).prop('disabled', true);
    sections.sectionReferenceDevice.hide();
  }
});

  // let buttonFilter = document.getElementById('buttonFilter');
  // let routeConnection = document.getElementById('routeConnection').value;
  // let distributionDiv = document.getElementById('distributionDiv');
  // let distributionSelect = document.getElementById('distributionSelect');
  // let equipmentDiv = document.getElementById('equipmentDiv');
  // let ReferenceDevicesDiv = document.getElementById('ReferenceDevicesDiv');
  // let referenceDeviceAddDiv = document.getElementById('referenceDeviceAddDiv');
  // let subscriberDevicesDiv = document.getElementById('subscriberDevicesDiv');
  // let equipmentSelect = document.getElementById('equipmentSelect'); 
  // let subscriberSelect = document.getElementById('subscriberSelect'); 
  // let buttonreferenceDeviceAdd = document.getElementById('referenceDeviceAdd');
  // let messageDiv = document.getElementById('message');
  // let referenceDeviceSelect = document.getElementById('referenceDeviceSelect');
  // let subscriberDevicesSelect = document.getElementById('subscriberDevicesSelect');
  // let finalEquipmentsDiv = document.getElementById('finalEquipmentsDiv');
  // let finalEquipmentsSelect = document.getElementById('finalEquipmentsSelect'); 

  // function optionAdd(disabled, optionsDelete, selected, select, title, id = '') {

  //   select.disabled = disabled;
  //   optionsDelete ? select.options.length = 0 : '';
  //   let opt = document.createElement('option');
  //   selected ? opt.selected = "selected" : '';

  //   opt.value = id;
  //   opt.innerHTML = title;
  //   select.appendChild(opt);
  // }

  // $(document).ready(function () {
  //   $(buttonreferenceDeviceAdd).on('click', (function () {

  //     $.ajax({
  //       method: "GET",
  //       url: routeConnection,
  //       data: {
  //         referenceDevice: true,
          
  //       },
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       }
  //     })
  //       .done(function (data) {
           
  //         if (buttonreferenceDeviceAdd.value == 'true'){
            
  //           buttonreferenceDeviceAdd.innerHTML = 'Скрыть';
  //           buttonreferenceDeviceAdd.value = 'false';

  //           ReferenceDevicesDiv.style.display = 'block';

  //           let referenceDevices = data['referenceDevices'];

  //           optionAdd(false, true, false, referenceDeviceSelect, 'Выберите устройство');

  //           for (let key in referenceDevices) {


  //             optionAdd(false, false, false, referenceDeviceSelect, referenceDevices[key]['manufacturer'] + ' ' + referenceDevices[key]['model'] + ' ( ' + referenceDevices[key]['device_type'] + ' ) ', referenceDevices[key]['id']);
  //           }
  //         } else {

  //           buttonreferenceDeviceAdd.innerHTML = 'Добавить устройство со справосника';
  //           buttonreferenceDeviceAdd.value = 'true';

  //           ReferenceDevicesDiv.style.display = 'none';
  //         }
         

  //       });
  //   }))

  // })

  // $(document).ready(function () {
  //   $(buttonFilter).on('click', (function () {

  //     $.ajax({
  //       method: "GET",
  //       url: routeConnection,
  //       data: {
  //         building_id: selectBuildings.value,
  //         floor_id: selectFloors.value,
  //         room_id: selectRooms.value,
  //         telecommunication_cabinet_id: selectTelecomCabinets.value,
  //         subscriber_id: subscriberSelect.value
  //       },
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       }
  //     })
  //       .done(function (data) {

  //         console.log(data);
          
  //         let distributions = data['distributions'];
  //         let equipments = data['equipments']
  //         let devices = data['devices']
  //         let finalEquipments = data['finalEquipments']
  //         let title = '';

  //         let textDevices = document.getElementById('textDevices'); 
  //         let textDistribution = document.getElementById('textDistribution');

  //         if (selectBuildings.value) textDistribution ? textDistribution.remove() : '' ;
  //         if (subscriberSelect.value){
            
  //           textDevices ? textDevices.remove() : '' ;
  //           referenceDeviceAddDiv.style.display = 'block';
  //         } 

  //         if (selectTelecomCabinets.value){
            
  //           subscriberDevicesDiv.style.display = 'none';
  //           referenceDeviceAddDiv.style.display = 'none';
  //         } else {

  //           finalEquipmentsDiv.style.display = 'none';
  //         }

  //         //console.log(data);

  //         if (finalEquipments) {

  //           finalEquipmentsDiv.style.display = 'block';
  //           textDevices ? textDevices.remove() : '' ;

  //           let ipAddress = '';
  //           let informationAboutPorter = '';

  //           optionAdd(false, true, false, finalEquipmentsSelect, 'Выберите порт подключения');

  //           for (let equipment in finalEquipments) {

  //             if ( ipAddress == finalEquipments[equipment]['ip_address'] ) {
                
  //               continue;
  //             } else {

  //               title += 'Номер коммутатора: ' + finalEquipments[equipment]['name'] + ' ip адрес: ' + finalEquipments[equipment]['ip_address'];  

  //               let ports = finalEquipments[equipment]['reference_network_equipment']['network_equipment_ports']

  //               for (let port in ports) {

  //                 for (let i = ports[port]['from']; i <= ports[port]['before']; ++i) {

  //                   informationAboutPorter += ' Номер порта: ' + i + ' ' + ports[port]['connection_interfaces'] + ' ' + ports[port]['bandwidth'] + ' ' + ports[port]['network_architecture_port'];

  //                   optionAdd(false, false, false, finalEquipmentsSelect, title + informationAboutPorter, finalEquipments[equipment]['id'] + ',' + i);

  //                   informationAboutPorter = '';
  //                 }
  //               }

  //               title = '';
  //             }

  //             ipAddress = finalEquipments[equipment]['ip_address'];
  //           }
  //         } else {
           
  //           finalEquipmentsDiv.style.display = 'none';
  //         }

  //         if (devices) {

  //           subscriberDevicesDiv.style.display = 'block';

  //           optionAdd(false, true, false, subscriberDevicesSelect, 'Выберите устройство');

  //           for (let key in devices) {

  //             optionAdd(false, false, false, subscriberDevicesSelect, devices[key]['reference_device']['manufacturer'] + ' ' + devices[key]['reference_device']['model'] + ' ( ' + devices[key]['reference_device']['device_type'] + ' ) ' + ' Индитификатор: ' +  devices[key]['name']  + ' MAС адрес: ' +  devices[key]['mac_address'] , devices[key]['id']);
  //           }
  //         }

  //         if (distributions) {

  //           distributionDiv.style.display = 'block';

  //           optionAdd(false, true, false, distributionSelect, 'Выберите распредиление');

  //           for (let key in distributions) {

  //             if ( !distributions[key]['final_patch_panel_id'] && !distributions[key]['patch_panel_id'] ) {

  //               title += 'Пачкорд № '+distributions[key]['patch_cord_number'];
  //               distributions[key]['location']['telecommunication_cabinet_id'] ? title += '  Номер телекомикоционный шкаф: ' + distributions[key]['location']['telecommunication_cabinet']['name'] : '';

  //             } else {

  //               title = 'Номер распредиление: '
  //               distributions[key]['patch_panel_id'] ? title += distributions[key]['patch_panel']['name'] +'.'+ distributions[key]['patch_panel_port'] : '';
  //               distributions[key]['final_patch_panel_id'] ? title += ' <--> ' + distributions[key]['final_patch_panel']['name'] +'.'+ distributions[key]['final_patch_panel_port'] : '';
  //               distributions[key]['location']['telecommunication_cabinet_id'] ? title += '  Номер телекомикоционный шкаф: ' + distributions[key]['location']['telecommunication_cabinet']['name'] : '';
  //             }

  //             optionAdd(false, false, false, distributionSelect, title, distributions[key]['id']);

  //             title = '';
  //           }
  //         } else {

  //           distributionDiv.style.display = 'none';

  //           let h = document.createElement('label');
          
  //           h.id = 'text'
  //           h.innerHTML = 'В данной локации нет распределения';
  //           messageDiv.appendChild(h);
  //         }


  //         if (equipments) {

  //           equipmentDiv.style.display = 'block';

  //           let ipAddress = '';
  //           let informationAboutPorter = '';

  //           optionAdd(false, true, false, equipmentSelect, 'Выберите порт подключения');

  //           for (let key in equipments) {

  //             if ( ipAddress == equipments[key]['ip_address'] ) {
  //               continue;
  //             } else {

  //               title += 'Номер коммутатора: ' + equipments[key]['name'] + ' ip адрес: ' + equipments[key]['ip_address'];  

  //               let ports = equipments[key]['reference_network_equipment']['network_equipment_ports']

  //               for (let port in ports) {

  //                 for (let i = ports[port]['from']; i <= ports[port]['before']; ++i) {

  //                   informationAboutPorter += ' Номер порта: ' + i + ' ' + ports[port]['connection_interfaces'] + ' ' + ports[port]['bandwidth'] + ' ' + ports[port]['network_architecture_port'];

  //                   optionAdd(false, false, false, equipmentSelect, title + informationAboutPorter, equipments[key]['id'] + ',' + i);

  //                   informationAboutPorter = '';
  //                 }
  //               }

  //               title = '';
  //             }

  //             ipAddress = equipments[key]['ip_address'];
  //           }
  //         } else {
  //           console.log('ok');
  //           equipmentDiv.style.display = 'none';
  //         }

  //       });
  //   }))

  // })