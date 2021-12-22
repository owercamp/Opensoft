@extends('home')

@section('modules')
<div class="container-fluid">
  <div class="d-flex justify-content-between my-1 mx-4">
    <h5>BITACORA</h5>
    @if ($edit == "Editable")
    <button class="btn btn-sm btn-primary binnacle-link">Añadir Registro
      <span hidden>{{ $id }}</span>
      <span hidden>{{ $type }}</span>
      <span hidden>{{ $col }}</span>
    </button>
    @endif
    <a href="{{ route('tracking.start') }}" class="btn btn-sm btn-warning" title="Regresar" style="z-index: 1000;"><i class="fas fa-undo-alt"></i></a>
  </div>
  <div class="col-lg-12">
    @include('partials.alerts')
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

<!-- Modal Bitacora Añadir -->
<div class="modal fade" id="Binnacle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal" aria-label="Close">&circledast;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tracking.binnacle.save') }}" method="post">
          @csrf @method('PATCH')
          <div class="form group">
            <small class="text-muted">{{ ucwords('observaciones de la novedad') }}</small>
            <textarea name="bs_observations" class="form-control form-control-sm" cols="30" rows="10"></textarea>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="bs_type">
            <input type="hidden" name="bs_oldCollaborator">
            <input type="hidden" name="bs_request">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $('.binnacle-link').click(function() {
    let id = $(this).find('span:nth-child(1)').text(),
      type = $(this).find('span:nth-child(2)').text(),
      col = $(this).find('span:nth-child(3)').text();

    $('.modal-title').text(`novedad servicio ${type}`).addClass('text-capitalize');
    $('input[name=bs_type]').val(type);
    $('input[name=bs_request]').val(id);
    $('input[name=bs_oldCollaborator]').val(col);

    $('#Binnacle').modal();
  });
</script>
@endsection