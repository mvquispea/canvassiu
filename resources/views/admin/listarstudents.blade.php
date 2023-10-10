@extends('adminlte::page')

@section('title', 'ListarTareas')

@section('content_header')
    <h1 class="m-0 text-dark">LEARNING MASTERY GRADEBOOK</h1>
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

                                  <table id="productos" class="display" style="width:100%">
                                    
                                    <thead>
                                      <tr>
                                       
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                        username 
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          userlogin
                                        </th>
                  
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          tareaname
                                        </th>


                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          score
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Point
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Learning
                                        </th>


                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 1
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 2
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 3
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 4
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 5
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 6
                                        </th>


                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 7
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 8
                                        </th>
                                        
                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 9
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-xs font-medio text-gray-500 uppercase border-b border-gray-600">
                                          Outcomes 10
                                        </th>
                                      
                                      

                                      </tr>
                                    </thead>

                                    <tbody id="bodyReporte">
                                    
                                      @foreach ($resultados as $resultado)
                          
                                      <tr>
                                        
                                          <td>{{ $resultado['username'] }}</td>
                                          <td>{{ $resultado['userlogin'] }}</td>
                                  
                                          <td>{{ $resultado['assigmentname'] }}</td>

                                     
                                          <td>{{ $resultado['score'] }}</td>
                                          <td>{{ $resultado['sumaPuntos'] }}</td>
                                          <td>{{ $resultado['categoria'] }}</td>

                                          <td>{{ $resultado['elementot1d'] }}</td>

                                          <td>{{ $resultado['elementot2d'] }}</td>

                                          <td>{{ $resultado['elementot3d'] }}</td>

                                          <td>{{ $resultado['elementot4d'] }}</td>

                                          <td>{{ $resultado['elementot5d'] }}</td>

                                          <td>{{ $resultado['elementot6d'] }}</td>
                                          <td>{{ $resultado['elementot7d'] }}</td>
                                          <td>{{ $resultado['elementot8d'] }}</td>
                                          <td>{{ $resultado['elementot9d'] }}</td>
                                          <td>{{ $resultado['elementot10d'] }}</td>

                                      </tr>
                                  @endforeach                               

                                    </tbody>

                                  </table>
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
new DataTable('#productos', {
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
});
</script>
@endsection