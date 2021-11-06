@extends('modules.settingPlaces')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>DEPARTAMENTOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar un departamento" class="btn btn-outline-success form-control-sm newDepartment-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessDepartments'))
      <div class="alert alert-success">
        {{ session('SuccessDepartments') }}
      </div>
      @endif
      @if(session('PrimaryDepartments'))
      <div class="alert alert-primary">
        {{ session('PrimaryDepartments') }}
      </div>
      @endif
      @if(session('WarningDepartments'))
      <div class="alert alert-warning">
        {{ session('WarningDepartments') }}
      </div>
      @endif
      @if(session('SecondaryDepartments'))
      <div class="alert alert-secondary">
        {{ session('SecondaryDepartments') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($departments as $department)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $department->depName }}</td>
        <td>
          <a href="#" title="Editar departamento {{ $department->depName }}" class="btn btn-outline-primary rounded-circle form-control-sm editDepartment-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $department->depId }}</span>
            <span hidden>{{ $department->depName }}</span>
          </a>
          <a href="#" title="Eliminar departamento {{ $department->depName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteDepartment-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $department->depId }}</span>
            <span hidden>{{ $department->depName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newDepartment-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO DEPARTAMENTO:</h4>
      </div>
      <div class="modal-body">
        <form id="formNewCreation" action="{{ route('departments.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE:</small>
                <input type="text" name="depName" maxlength="50" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editDepartment-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR DEPARTAMENTO:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('departments.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE:</small>
                <input type="text" name="depName_Edit" maxlength="50" class="form-control form-control-sm" title="De 50 carácteres máximo" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="depId_Edit" value="" required>
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

<div class="modal fade" id="deleteDepartment-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE DEPARTAMENTO:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">NOMBRE: </small><br>
            <span class="text-muted"><b class="depName_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('departments.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="depId_Delete" value="" required>
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

  $('.newDepartment-link').on('click', function() {
    $('#newDepartment-modal').modal();
  });

  $('.editDepartment-link').on('click', function(e) {
    e.preventDefault();
    var depId = $(this).find('span:nth-child(2)').text();
    var depName = $(this).find('span:nth-child(3)').text();
    $('input[name=depId_Edit]').val(depId);
    $('input[name=depName_Edit]').val(depName);
    $('#editDepartment-modal').modal();
  });

  $('.deleteDepartment-link').on('click', function(e) {
    e.preventDefault();
    var depId = $(this).find('span:nth-child(2)').text();
    var depName = $(this).find('span:nth-child(3)').text();
    $('input[name=depId_Delete]').val(depId);
    $('.depName_Delete').text(depName);
    $('#deleteDepartment-modal').modal();
  });
</script>
@endsection