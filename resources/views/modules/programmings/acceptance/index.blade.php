@extends('modules.operativeProgramming')

@section('space')
<div class="col-md-12">
  <h5>ACEPTACION OPERADOR</h5>
  <div class="container-fluid">
    <table id="tableDatatable" class="table text-center" width="100%">
      <thead>
        <tr>
          <th>N° SERVICIO</th>
          <th>TIPO DE SOLICITUD</th>
          <th>SERVICIO</th>
          <th>CLIENTE</th>
          <th>ORIGEN</th>
          <th>DESTINO</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
      <tbody>
        <!-- Función para retornar el consecutivo con ceros a la izquierda de acuerdo a cada iteracion -->
        @php
        function getStringSequence ($number){
        $len = strlen($number);
        switch ($len) {
        case 1: return '00000' . $number; break;
        case 2: return '0000' . $number; break;
        case 3: return '000' . $number; break;
        case 4: return '00' . $number; break;
        case 5: return '0' . $number; break;
        default: return (string)$number; break;
        }
        }
        @endphp
        @for($i = 0; $i < count($dates); $i++) <tr>
          <td class="align-middle">{{ getStringSequence($i + 1) }}</td>
          <td class="align-middle">{{ $dates[$i][3] }}</td>
          <td class="align-middle">{{ $dates[$i][4] }}</td>
          <td class="align-middle">{{ $dates[$i][2] }}</td>
          <td class="align-middle">{{ $dates[$i][5] }}</td>
          <td class="align-middle">{{ $dates[$i][9] }}</td>
          <td class="align-middle">
            <button class="btn btn-outline-primary rounded-circle"><i class="fas fa-check-circle"></i></button>
            <button class="btn btn-outline-tertiary rounded-circle"><i class="fas fa-times-circle"></i></button>
          </td>
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });
</script>
@endsection