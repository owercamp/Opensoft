@extends('modules.operativeTracking')

@section('space')
<div class="col-md-12">
  <h5>SERVICIO EN EJECUCION</h5>
  @include('partials.alerts')
  <div class="container-fluid">
    <table id="tableServices" class="table table-hover text-center" width="100%">
      <thead>
        <tr>
          <th>FECHA SERVICIO</th>
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
          <td>{{ $dates[$i][0] }} {{ $dates[$i][1] }}</td>
          <td>{{ $dates[$i][3] }} - {{ $dates[$i][4] }}</td>
          <td>{{ $dates[$i][13] }}</td>
          <td>{{ $dates[$i][2] }}</td>
          <td>{{ $dates[$i][5] }}</td>
          <td>{{ $dates[$i][9] }}</td>
          <td class="align-middle d-flex justify-content-around">
            <form action="{{ route('tracking.finish') }}" method="post">
              @csrf @method('PATCH')
              <button class="btn btn-outline-secondary rounded-circle" title="Finalización Servicio">
                <i class="fas fa-ban"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}">
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}">
                <input type="hidden" name="col" value="{{ $dates[$i][13] }}">
              </button>
            </form>
            <form action="{{ route('tracking.binnacle') }}" method="post">
              @csrf
              <button class="btn btn-outline-dark rounded-circle" title="Novedades Servicio">
                <i class="fas fa-info-circle"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}">
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}">
                <input type="hidden" name="col" value="{{ $dates[$i][13] }}">
                <input type="hidden" name="view" value="Editable">
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