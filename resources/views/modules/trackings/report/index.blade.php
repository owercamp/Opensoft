@extends('modules.trainingMenu')

@section('space')
<div class="container-fluid">
  <div class="d-flex justify-content-between my-1 mx-4 ">
    <h5>INFORME DE NOVEDADES {{isset($data[0][4]) ? strtoupper($data[0][4]) : ''}}</h5>
    <button class="btn btn-secondary rounded-circle shadow back"><i class="fas fa-undo-alt"></i></button>
  </div>
  <div class="w-100 d-flex justify-content-around row">
    <form action="{{ route('tracking.novelty')}}" method="post"  class="w-100 d-flex justify-content-around row">
      @csrf
      <div class="col-md-6 row d-flex justify-content-around">
        <div class="form-group">
          <small class="text-muted">{{ ucwords('fecha inicial') }}</small>
          <input type="date" name="dateInitials" class="form-control form-control-sm" value="{{$initial}}">
        </div>
        <div class="form-group">
          <small class="text-muted">{{ ucwords('fecha final') }}</small>
          <input type="date" name="dateFinals" class="form-control form-control-sm" value="{{$final}}">
        </div>
      </div>
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <input type="hidden" name="id" value="{{ $identifier }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <button class="btn btn-success">{{ ucfirst('filtrar') }}</button>
      </div>
    </form>
  </div>
  <div class="w-100">
    <table id="tableDatatable" class="table table-hover text-center">
      <thead>
        <tr>
          <th>FECHA SERVICIO</th>
          <th>TIPO DE SOLICITUD</th>
          <th>COLABORADOR</th>
          <th>CLIENTE</th>
          <th>ORIGEN - DESTINO</th>
          <th>OBSERVACIONES</th>
        </tr>
      </thead>
      <tbody>
        @for ($i = 0; $i < count($data); $i++) <tr>
          <td>{{ $data[$i][0] }}</td>
          <td>{{ $data[$i][1] }}</td>
          <td>{{ $data[$i][5] }}</td>
          <td>{{ $data[$i][4] }}</td>
          <td>{{ ucwords($data[$i][2]) }} - {{ ucwords($data[$i][3]) }}</td>
          <td>{{ ucfirst($data[$i][6]) }}</td>
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    $('.back').click(function(){
      history.back();
    });

    $('#MenuforHidden').hide(0);
    $('#MenuforHidden').parent("div").addClass("d-flex justify-content-center");
  </script>
@endsection