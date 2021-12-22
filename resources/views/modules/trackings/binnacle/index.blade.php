@extends('home')

@section('modules')
<div class="container-fluid">
  <div class="d-flex justify-content-between my-1 mx-4">
    <h5>BITACORA</h5>
    <a href="{{ route('tracking.start') }}" class="btn btn-sm btn-warning" title="Regresar" style="z-index: 1000;"><i class="fas fa-undo-alt"></i></a>
  </div>
  <div class="col-lg-12">
    <table class="table table-bordered w-100 text-center" id="tableBinnacle" data-page-length='50'>
      <thead>
        <th>FECHA SERVICIO</th>
        <th>TIPO DE SOLICITUD</th>
        <th>ORIGEN - DESTINO</th>
        <th>CLIENTE</th>
        <th>COLABORADOR(ES)</th>
        <th>OBSERVACIONES</th>
      </thead>
      <tbody>
        @for ($i = 0; $i < count($data); $i++) <tr>
          <td>{{ $data[$i][0] }}</td>
          <td>{{ $data[$i][1] }}</td>
          <td>{{ $data[$i][2] }} - {{ $data[$i][3] }}</td>
          <td>{{ $data[$i][4] }}</td>
          <td>{{ ucwords($data[$i][5]) }}</td>
          <td>{{ ucfirst($data[$i][6]) }}</td>
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
</div>
@endsection