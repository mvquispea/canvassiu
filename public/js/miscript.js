
function getTimeNow(){

    let now = new Date();
    let day = ("0" + now.getDate()).slice(-2);
    let month = ("0" + (now.getMonth() + 1)).slice(-2);
    let h = (now.getHours().toString().length < 2) ? '0'+now.getHours() : now.getHours();
    let m = (now.getMinutes().toString().length < 2) ? '0'+now.getMinutes() : now.getMinutes();
    let s = (now.getSeconds().toString().length < 2) ? '0'+now.getSeconds() : now.getSeconds();
  return day+"-"+month+"-"+now.getFullYear()+" _ "+h+"_"+m;

}

function drawReport(data) {
    let html = '';
    data.forEach(function (e) {
        html += '<tr>';
        html += '<td>' + e.workflow_state + '</td>';
        html += '<td><a href="/outcomes/assigmentxcourse/' + e.id + '">' + e.name + '</a></td>';
        html += '<td>' + e.term['name'] + '</td>';
        html += '<td>' + e.total_students + '</td>';
        html += '</tr>';
    });

    // inicializar el dataTable

    if ($.fn.DataTable.isDataTable("#data-table")) {
        $('#data-table').DataTable().clear().destroy();
        $('#bodyReporte').html(html);

        $('#data-table').DataTable({
            autoWidth: true,
            responsive: false,
            lengthMenu: [[15, 30, 45, -1], ["15 Rows", "30 Rows", "45 Rows", "Everything"]],
            language: { searchPlaceholder: "Buscar..." },
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


        });

    }

    
    $('#loaderData').remove();
    $('#filter').removeAttr('disabled');
}

const SELECTOR_SELECT_PERIODO = '#selectPeriodo';
const SELECTOR_LOADER_DATA = '#loaderData';
const SELECTOR_FILTER = '#filter';
const URL_FILTRO = '/outcomes/filtro';

function filtrarTabla() {
    let selectPeriodo = $(SELECTOR_SELECT_PERIODO).val();

    if (selectPeriodo) {
        // Bloquear el botón y mostrar el mensaje de carga
        $(SELECTOR_FILTER).attr('disabled', true);
        $(SELECTOR_FILTER).after('<p id="loaderData">Cargando...</p>');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: URL_FILTRO,
            data: {
                selectPeriodo: selectPeriodo,
            },
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
                $(SELECTOR_FILTER).removeAttr('disabled');
                $(SELECTOR_LOADER_DATA).remove();
            }
        });

       
    } else {
        alert('Por favor, seleccione un período.');
    }
}

