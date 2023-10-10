@extends('adminlte::page')

@section('title', 'ListarTareas')

@section('content_header')
    <h1 class="m-0 text-dark">REPORTE ACTIVIDADES DEL CURSO</h1>
@stop

@section('content')

<link href="{{ asset('css/micss.css') }}" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">

                      <x-table>

                      @if(isset($mensaje))
                      <p>{{ $mensaje }}</p>
                      @else

                      <table id="product" class="display" style="width:100%">
                                    
                        <thead>
                          <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            courseid</th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            id</th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            due_at</th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            unlock_at
                            </th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            name
                            </th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            workflow_state
                            </th>

                            <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                            rubric_settings
                            </th>

                          </tr>
                        </thead>

                        <tbody id="bodyReporte">
                        
                          @foreach ($resultados as $resultado)
                            <tr>
                              <td>{{ $resultado['courseid'] }}</td>
                              <td>{{ $resultado['tareaid'] }}</td>
                              <td>{{ $resultado['tareadue_at'] }}</td>
                              <td>{{ $resultado['tareaunlock_at'] }}</td>
                              <td><a href="{{ route('outcomes.detalle', ['courseId' => $resultado['courseid'], 'assigmentId' => $resultado['tareaid']]) }}">
                                  {{ $resultado['tareaname'] }}
                              </a></td>
                              <td>{{ $resultado['tareaworkflow_state'] }}</td>
                              <td>
                                  @if ($resultado['rubricSettings'])
                                    si hay rubrica
                                  @else
                                      Sin configuración de rúbrica
                                  @endif
                              </td>
                            </tr>
                          @endforeach                               

                        </tbody>

                      </table>
                     
                      @endif


                      </x-table>
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

<script>
new DataTable('#product', {
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
});
</script>
@endsection