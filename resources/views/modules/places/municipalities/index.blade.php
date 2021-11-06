@extends('modules.settingPlaces')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>MUNICIPIOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar un municipio" class="btn btn-outline-success form-control-sm newMunipality-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessMunicipalities'))
      <div class="alert alert-success">
        {{ session('SuccessMunicipalities') }}
      </div>
      @endif
      @if(session('PrimaryMunicipalities'))
      <div class="alert alert-primary">
        {{ session('PrimaryMunicipalities') }}
      </div>
      @endif
      @if(session('WarningMunicipalities'))
      <div class="alert alert-warning">
        {{ session('WarningMunicipalities') }}
      </div>
      @endif
      @if(session('SecondaryMunicipalities'))
      <div class="alert alert-secondary">
        {{ session('SecondaryMunicipalities') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE</th>
        <th>DEPARTAMENTO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($municipalities as $municipality)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $municipality->munName }}</td>
        <td>{{ $municipality->depName }}</td>
        <td>
          <a href="#" title="Editar municipio {{ $municipality->munName }}" class="btn btn-outline-primary rounded-circle form-control-sm editMunicipality-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $municipality->munId }}</span>
            <span hidden>{{ $municipality->munName }}</span>
            <span hidden>{{ $municipality->munDepartment_id }}</span>
          </a>
          <a href="#" title="Eliminar municipio {{ $municipality->munName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteMunicipality-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $municipality->munId }}</span>
            <span hidden>{{ $municipality->munName }}</span>
            <span hidden>{{ $municipality->depName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newMunipality-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO MUNICIPIO:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('municipalities.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <small class="text-muted">DEPARTAMENTO:</small>
                <select name="munDepartment_id" class="form-control form-control-sm" required>
                  <option value="">Seleccione un departamento...</option>
                  @foreach($departments as $department)
                  <option value="{{ $department->depId }}">{{ $department->depName }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <small class="text-muted">MUNICIPIO:</small>
                <input type="text" name="munName" maxlength="50" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editMunicipality-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR MUNICIPIO:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('municipalities.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <small class="text-muted">DEPARTAMENTO:</small>
                <select name="munDepartment_id_Edit" class="form-control form-control-sm" required>
                  <option value="">Seleccione un departamento...</option>
                  @foreach($departments as $department)
                  <option value="{{ $department->depId }}">{{ $department->depName }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <small class="text-muted">NOMBRE:</small>
                <input type="text" name="munName_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="munId_Edit" value="" required>
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

<div class="modal fade" id="deleteMunicipality-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE MUNICIPIO:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">NOMBRE: </small><br>
            <span class="text-muted"><b class="munName_Delete"></b></span><br>
            <small class="text-muted">DEL DEPARTAMENTO: </small><br>
            <span class="text-muted"><b class="munDepartment_Delete"></b></span>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('municipalities.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="munId_Delete" value="" required>
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

  $('.newMunipality-link').on('click', function() {
    $('#newMunipality-modal').modal();
  });

  $('.editMunicipality-link').on('click', function(e) {
    e.preventDefault();
    var munId = $(this).find('span:nth-child(2)').text();
    var munName = $(this).find('span:nth-child(3)').text();
    var munDepartment_id = $(this).find('span:nth-child(4)').text();
    $('input[name=munId_Edit]').val(munId);
    $('input[name=munName_Edit]').val(munName);
    $('select[name=munDepartment_id_Edit] option').each(function() {
      if ($(this).val() == munDepartment_id) {
        $(this).attr('select', true);
      }
    });
    $('select[name=munDepartment_id_Edit]').val(munDepartment_id);
    $('#editMunicipality-modal').modal();
  });

  $('.deleteMunicipality-link').on('click', function(e) {
    e.preventDefault();
    var munId = $(this).find('span:nth-child(2)').text();
    var munName = $(this).find('span:nth-child(3)').text();
    var department = $(this).find('span:nth-child(4)').text();
    $('input[name=munId_Delete]').val(munId);
    $('.munName_Delete').text(munName);
    $('.munDepartment_Delete').text(department);
    $('#deleteMunicipality-modal').modal();
  });
</script>
@endsection