<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con DataTables</title>
    <!-- Agrega los archivos CSS y JavaScript de DataTables -->

    
    <!-- Configuración básica de DataTables -->
    <script>
    $(document).ready(function () {

        function drawReport(data) {
            let html = '';
            data.forEach(function (e) {
                html += '<tr>';
                html += '<td>' + e.id + '</td>';
                html += '<td>' + e.name + '</td>';
                html += '<td>' + e.account_id + '</td>';
                html += '<td>' + e.uuid + '</td>';
                html += '</tr>';
            });

        // inicializar el dataTable

        if ($.fn.DataTable.isDataTable("#data-table")) {
            $('#data-table').DataTable().clear().destroy();
            $('#bodyReporte').html(html);

            $('#data-table').DataTable({
                dom: "Blfrtip",
                
                buttons: [
                    {
                        extend: "excelHtml5",
                        title: "Reporte_exportado_" 
                    },
                    {
                        extend: "csvHtml5",
                        title: "Export Data"
                    },
                    {
                        extend: "print",
                        title: "Print"
                    }
                ],
                initComplete: function (a, b) {
                    $(this)
                        .closest(".dataTables_wrapper")
                        .prepend(
                            '<div class="dataTables_buttons hidden-sm-down actions"><span class="actions__item zmdi zmdi-print" data-table-action="print" /><span class="actions__item zmdi zmdi-fullscreen" data-table-action="fullscreen" /><div class="dropdown actions__item"><i data-toggle="dropdown" class="zmdi zmdi-download" /><ul class="dropdown-menu dropdown-menu-right"><a href="" class="dropdown-item" data-table-action="excel">Excel (.xlsx)</a><a href="" class="dropdown-item" data-table-action="csv">CSV (.csv)</a></ul></div></div>'
                        );
                }
            });

        }

    }

    $.ajax({
        
        type: 'GET',
        url:"http://127.0.0.1:8000/ajax.php",

        success: function (data) {
            try {
                data = JSON.parse(data);
                console.log('OK!', data);
                drawReport(data);
            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
                //alert('Error en la respuesta del servidor.');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud:', errorThrown);
            alert('Error al realizar la solicitud al servidor.');
        },
        complete: function () {
            // Desbloquear el botón y ocultar el mensaje de carga
            
        }
    });


   $('#data-table').DataTable();
    
});
    </script>
</head>
<body>
    <div class="container">
        <h1>Ejemplo de DataTables</h1>
        <table id="data-table" class="table table-bordered" style="width:100%;">
            <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                    ID
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                    Nombre
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600"">
                    Las
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600"">
                    Handle
                  </th>
                </tr>
              </thead>
            <tbody id="bodyReporte">
            </tbody>
        </table>
    </div>

    <link href="{{ asset('css/micss.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css">
    <script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>

    <!-- Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>



</body>
</html>
