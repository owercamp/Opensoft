@extends('modules.settingSecurity')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>FONDO DE PENSIONES</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar un fondo de pensión" class="btn btn-outline-success form-control-sm newPension-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessPensions'))
      <div class="alert alert-success">
        {{ session('SuccessPensions') }}
      </div>
      @endif
      @if(session('PrimaryPensions'))
      <div class="alert alert-primary">
        {{ session('PrimaryPensions') }}
      </div>
      @endif
      @if(session('WarningPensions'))
      <div class="alert alert-warning">
        {{ session('WarningPensions') }}
      </div>
      @endif
      @if(session('SecondaryPensions'))
      <div class="alert alert-secondary">
        {{ session('SecondaryPensions') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE DE FONDO DE PENSION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($pensions as $pension)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $pension->penName }}</td>
        <td>
          <a href="#" title="Editar fondo {{ $pension->heaName }}" class="btn btn-outline-primary rounded-circle form-control-sm editPension-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $pension->penId }}</span>
            <span hidden>{{ $pension->penName }}</span>
          </a>
          <a href="#" title="Eliminar fondo {{ $pension->heaName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deletePension-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $pension->penId }}</span>
            <span hidden>{{ $pension->penName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newPension-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO FONDO DE PENSION:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('pensions.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE DE FONDO:</small>
                <input type="text" name="penName" maxlength="50" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editPension-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR FONDO DE PENSION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('pensions.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE DE FONDO:</small>
                <input type="text" name="penName_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="penId_Edit" value="" required>
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

<div class="modal fade" id="deletePension-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINAR FONDO DE PENSION:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">NOMBRE DE FONDO: </small><br>
            <span class="text-muted"><b class="penName_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('pensions.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="penId_Delete" value="" required>
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

  $('.newPension-link').on('click', function() {
    $('#newPension-modal').modal();
  });

  $('.editPension-link').on('click', function(e) {
    e.preventDefault();
    var penId = $(this).find('span:nth-child(2)').text();
    var penName = $(this).find('span:nth-child(3)').text();
    $('input[name=penId_Edit]').val(penId);
    $('input[name=penName_Edit]').val(penName);
    $('#editPension-modal').modal();
  });

  $('.deletePension-link').on('click', function(e) {
    e.preventDefault();
    var penId = $(this).find('span:nth-child(2)').text();
    var penName = $(this).find('span:nth-child(3)').text();
    $('input[name=penId_Delete]').val(penId);
    $('.penName_Delete').text(penName);
    $('#deletePension-modal').modal();
  });
</script>
@endsection