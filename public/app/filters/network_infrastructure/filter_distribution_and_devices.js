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