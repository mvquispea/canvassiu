@extends('adminlte::page')

@section('title', 'SIU')

@section('content_header')
    <h1 class="m-0 text-dark">REPORTE DE OUTCOMES</h1>
@stop

@section('content')

<link href="{{ asset('css/siu.css') }}" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>

  
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">

                      <div class="card-header">

                        <div class="row custom-bg">
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group custom-border text-center">
                                  <label>Seleccione Periodo:</label>
                                  <select id="selectPeriodo" name="selectPeriodo" class="selectpicker">
                                      <?php $first = true; ?>
                                      <?php foreach ($todosperiodos as $item): ?>
                                          <?php foreach ($item->enrollment_terms as $term): ?>
                                              <?php if ($first): ?>
                                                  <?php $first = false; ?>
                                              <?php else: ?>
                                                  <option value="<?php echo $term->id; ?>">
                                                      <?php echo $term->name; ?>
                                                  </option>
                                              <?php endif; ?>
                                          <?php endforeach; ?>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                          </div>
                          <div id="contentFilter" class="col-sm-6 col-md-4 d-flex align-items-center justify-content-center">
                              <button id="filter" class="btn btn-custom" type="button">Lista cursos</button>
                          </div>
                        </div>

                     </div>

                    <div class="alert-message alert-message-info">
                      <h4>Seleccione un periodo para la busqueda de cursos</h4>
                    </div>

                    <div id="reporte" style="display: none; margin-top: 25px;">

                                <table id="data-table" class="display nowrap" style="width:100%;" >
                                  
                                  <thead class="bg-gray-50">
                                    <tr>
                                      <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                        ESTADO
                                      </th>
                                      <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                      COURSE
                                      </th>
                                      <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600"">
                                       Term
                                      </th>
                                      <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600"">
                                        #Student
                                      </th>
                                    </tr>
                                  </thead>

                                  <tbody id="bodyReporte">
                                  </tbody>

                                </table>
      
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
<link href="{{ asset('datatable/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('datatable/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('datatable/buttons.bootstrap5.min.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('datatable/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatable/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('datatable/jszip.min.js') }}"></script>
<script src="{{ asset('datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatable/buttons.colVis.min.js') }}"></script>>

<script src="{{ asset('js/miscript.js') }}"></script>
<script>

  $('#filter').on('click', function () {
    filtrarTabla();
    $(".alert-message").hide();
    $("#reporte").show();
  });

  

  new DataTable('#data-table', {
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
  });


</script>
@endsection