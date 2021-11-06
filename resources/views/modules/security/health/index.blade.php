@extends('modules.settingSecurity')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>ENTIDADES DE SALUD</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar una entidad" class="btn btn-outline-success form-control-sm newHealth-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessHealths'))
      <div class="alert alert-success">
        {{ session('SuccessHealths') }}
      </div>
      @endif
      @if(session('PrimaryHealths'))
      <div class="alert alert-primary">
        {{ session('PrimaryHealths') }}
      </div>
      @endif
      @if(session('WarningHealths'))
      <div class="alert alert-warning">
        {{ session('WarningHealths') }}
      </div>
      @endif
      @if(session('SecondaryHealths'))
      <div class="alert alert-secondary">
        {{ session('SecondaryHealths') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE DE ENTIDAD</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($healths as $health)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $health->heaName }}</td>
        <td>
          <a href="#" title="Editar entidad {{ $health->heaName }}" class="btn btn-outline-primary rounded-circle form-control-sm editHealth-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $health->heaId }}</span>
            <span hidden>{{ $health->heaName }}</span>
          </a>
          <a href="#" title="Eliminar entidad {{ $health->heaName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteHealth-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $health->heaId }}</span>
            <span hidden>{{ $health->heaName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newHealth-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA ENTIDAD PROMOTORA DE SALUD:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('healths.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE DE ENTIDAD:</small>
                <input type="text" name="heaName" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editHealth-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR ENTIDAD PROMOTORA DE SALUD:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('healths.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE:</small>
                <input type="text" name="heaName_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="heaId_Edit" value="" required>
              <button type="submit" class="btn btn-outline-success form-control-sm my-3">GUARDAR CAMBIOS</button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteHealth-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE ENTIDAD PROMOTORA DE SALUD:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">NOMBRE: </small><br>
            <span class="text-muted"><b class="heaName_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('healths.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="heaId_Delete" value="" required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">ELIMINAR</button>
          </form>
          <div class="col-md-6">
            <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });

  $('.newHealth-link').on('click', function() {
    $('#newHealth-modal').modal();
  });

  $('.editHealth-link').on('click', function(e) {
    e.preventDefault();
    var heaId = $(this).find('span:nth-child(2)').text();
    var heaName = $(this).find('span:nth-child(3)').text();
    $('input[name=heaId_Edit]').val(heaId);
    $('input[name=heaName_Edit]').val(heaName);
    $('#editHealth-modal').modal();
  });

  $('.deleteHealth-link').on('click', function(e) {
    e.preventDefault();
    var heaId = $(this).find('span:nth-child(2)').text();
    var heaName = $(this).find('span:nth-child(3)').text();
    $('input[name=heaId_Delete]').val(heaId);
    $('.heaName_Delete').text(heaName);
    $('#deleteHealth-modal').modal();
  });
</script>
@endsection