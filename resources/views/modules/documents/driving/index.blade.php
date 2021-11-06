@extends('modules.settingDocuments')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>LICENCIAS DE CONDUCCION</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar una licencia de conducción" class="btn btn-outline-success form-control-sm newDriving-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessDrivings'))
      <div class="alert alert-success">
        {{ session('SuccessDrivings') }}
      </div>
      @endif
      @if(session('PrimaryDrivings'))
      <div class="alert alert-primary">
        {{ session('PrimaryDrivings') }}
      </div>
      @endif
      @if(session('WarningDrivings'))
      <div class="alert alert-warning">
        {{ session('WarningDrivings') }}
      </div>
      @endif
      @if(session('SecondaryDrivings'))
      <div class="alert alert-secondary">
        {{ session('SecondaryDrivings') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>CATEGORIA</th>
        <th>CLASE DE VEHICULO</th>
        <th>TIPO DE SERVICIO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($drivings as $driving)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $driving->driCategory }}</td>
        <td>{{ $driving->driClassvehicle }}</td>
        <td>{{ $driving->driTypeservice }}</td>
        <td>
          <a href="#" title="Editar licencia {{ $driving->perName }}" class="btn btn-outline-primary rounded-circle form-control-sm editDriving-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $driving->driId }}</span>
            <span hidden>{{ $driving->driCategory }}</span>
            <span hidden>{{ $driving->driClassvehicle }}</span>
            <span hidden>{{ $driving->driTypeservice }}</span>
          </a>
          <a href="#" title="Eliminar licencia {{ $driving->perName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteDriving-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $driving->driId }}</span>
            <span hidden>{{ $driving->driCategory }}</span>
            <span hidden>{{ $driving->driClassvehicle }}</span>
            <span hidden>{{ $driving->driTypeservice }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newDriving-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA LICENCIA DE CONDUCCION:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('driving.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">CATEGORIA:</small>
                <input type="text" name="driCategory" maxlength="5" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">CLASE DE VEHICULO:</small>
                <input type="text" name="driClassvehicle" maxlength="200" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIPO DE SERVICIO:</small>
                <input type="text" name="driTypeservice" maxlength="50" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editDriving-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR IDENTIFICACION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('driving.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">CATEGORIA:</small>
                <input type="text" name="driCategory_Edit" maxlength="5" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">CLASE DE VEHICULO:</small>
                <input type="text" name="driClassvehicle_Edit" maxlength="200" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIPO DE SERVICIO:</small>
                <input type="text" name="driTypeservice_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="driId_Edit" value="" required>
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

<div class="modal fade" id="deleteDriving-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE LICENCIA DE CONDUCCION:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">CATEGORIA: </small><br>
            <span class="text-muted"><b class="driCategory_Delete"></b></span><br>
            <small class="text-muted">CLASE DE VEHICULO: </small><br>
            <span class="text-muted"><b class="driClassvehicle_Delete"></b></span><br>
            <small class="text-muted">TIPO DE SERVICIO: </small><br>
            <span class="text-muted"><b class="driTypeservice_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('driving.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="driId_Delete" value="" required>
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

  $('.newDriving-link').on('click', function() {
    $('#newDriving-modal').modal();
  });

  $('.editDriving-link').on('click', function(e) {
    e.preventDefault();
    var driId = $(this).find('span:nth-child(2)').text();
    var driCategory = $(this).find('span:nth-child(3)').text();
    var driClassvehicle = $(this).find('span:nth-child(4)').text();
    var driTypeservice = $(this).find('span:nth-child(5)').text();
    $('input[name=driId_Edit]').val(driId);
    $('input[name=driCategory_Edit]').val(driCategory);
    $('input[name=driClassvehicle_Edit]').val(driClassvehicle);
    $('input[name=driTypeservice_Edit]').val(driTypeservice);
    $('#editDriving-modal').modal();
  });

  $('.deleteDriving-link').on('click', function(e) {
    e.preventDefault();
    var driId = $(this).find('span:nth-child(2)').text();
    var driCategory = $(this).find('span:nth-child(3)').text();
    var driClassvehicle = $(this).find('span:nth-child(4)').text();
    var driTypeservice = $(this).find('span:nth-child(5)').text();
    $('input[name=driId_Delete]').val(driId);
    $('.driCategory_Delete').text(driCategory);
    $('.driClassvehicle_Delete').text(driClassvehicle);
    $('.driTypeservice_Delete').text(driTypeservice);
    $('#deleteDriving-modal').modal();
  });
</script>
@endsection