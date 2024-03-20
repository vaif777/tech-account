function tableUpdate (data) {

  for (const [key, elements] of Object.entries(data)) {

    const tableName = key.charAt(0).toUpperCase() + key.slice(1);
    
    if (!$.hasOwnProperty.call(tables, 'table' + tableName)) continue;

    var dataTable = $(tables['table' + tableName]).DataTable({

      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Russian.json'
      },
      columns: [
      { title: 'Номер порта' },
      { title: 'Имя' },
      { title: 'Выбор' },
      { title: 'ip адресс' },
      { title: 'Пропускная способность' },
      { title: 'Интерфейс подключения' },
      { title: 'Сетевая архитектура' },
      { title: 'Питание' },
    ],
      scrollX: true,
      scrollXInner: '100%',
      scrollY: '500px',
      scrollCollapse: true
    });

    dataTable.clear().draw();
    var newData = [];
    columns = tables['column' + tableName];

    for (const element of elements) {

      const ports = element.ports;
      const namePort =  'table' + tableName == 'tableConnectionNetworkEquipmentPorts' ? 'secondary_port' : 'port' ;
      const hiddenId =  'table' + tableName == 'tableConnectionNetworkEquipmentPorts' ? $('#secondaryNetworkEquipmentId').attr('name', 'secondary_network_equipment_id').val(element.id) : $('#networkEquipmentId').attr('name', 'network_equipment_id').val(element.id);

      for (const port of ports) {
        
        for (let numberPort = port.from; numberPort <= port.before; ++numberPort) {
          
          var record = [];

          for (const column of columns) {

            if (column == 'port') {
              
              record.push(numberPort);
              continue;
            }

            if (column == 'choice') {
              
              record.push(`
                  <div class="text-center">
                    <div class="icheck-secondary d-inline">
                      <input type="radio" id="radioPrimary${element.id}${numberPort}" name="${namePort}_${element.id}${numberPort}" value="${numberPort}">
                      <label for="radioPrimary${element.id}${numberPort}"></label>
                    </div>
                  </div>
              `);
              continue;
            }

            record.push(element[column] ? element[column] : port[column]);
          }

          newData.push(record);
        } 
      }
    }
  
    dataTable.rows.add(newData).draw();
  }
}