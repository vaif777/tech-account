function tableUpdate (data) {

  for (const [key, elements] of Object.entries(data)) {

    const tableName = key.charAt(0).toUpperCase() + key.slice(1);
    
    if (!$.hasOwnProperty.call(tables, 'table' + tableName)) continue;

    var dataTable = $(tables['table' + tableName]).DataTable();
    dataTable.clear().draw();
    var newData = [];
    columns = tables['column' + tableName];

    for (const element of elements) {

      const ports = element.ports;

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
                      <input type="radio" id="radioPrimary${element.id}${numberPort}" name="choice${element.id}" value="${element.id}">
                      <label for="radioPrimary${element.id}${numberPort}"></label>
                    </div>
                  </div>
                <input type="hidden" name="port" value="${numberPort}">
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