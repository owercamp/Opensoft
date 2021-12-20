@extends('modules.operativeProgramming')

@section('space')
<div class="col-md-12">
  <h5>ACEPTACION OPERADOR</h5>
  @include('partials.alerts')
  <div class="container-fluid">
    <table id="tableDatatable" class="table text-center" width="100%">
      <thead>
        <tr>
          <th>N° SERVICIO</th>
          <th>TIPO DE SOLICITUD</th>
          <th>COLABORADOR</th>
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
          <td class="align-middle">{{ $dates[$i][3] }} - {{ $dates[$i][4] }}</td>
          <td class="align-middle">{{ ucwords($dates[$i][13]) }}</td>
          <td class="align-middle">{{ $dates[$i][2] }}</td>
          <td class="align-middle">{{ $dates[$i][5] }}</td>
          <td class="align-middle">{{ $dates[$i][9] }}</td>
          <td class="align-middle d-flex justify-content-center">
            <form action="{{ route('accepted.to') }}" method="post">
              @csrf
              <button class="btn btn-outline-primary rounded-circle" title="Aceptar">
                <i class="fas fa-check-circle"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}"> <!-- Identificador -->
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}"> <!-- Tipo de solicitud -->
              </button>
            </form>
            <form action="{{ route('rejected.to') }}" method="post">
              <button class="btn btn-outline-tertiary rounded-circle" title="Rechazar">
                @csrf
                <i class="fas fa-times-circle"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}"> <!-- Identificador -->
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}"> <!-- Tipo de solicitud -->
              </button>
            </form>
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