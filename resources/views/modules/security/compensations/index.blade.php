@extends('modules.settingSecurity')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>CAJAS DE COMPENSACION</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar una caja de compensación" class="btn btn-outline-success form-control-sm newCompensation-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessCompensations'))
      <div class="alert alert-success">
        {{ session('SuccessCompensations') }}
      </div>
      @endif
      @if(session('PrimaryCompensations'))
      <div class="alert alert-primary">
        {{ session('PrimaryCompensations') }}
      </div>
      @endif
      @if(session('WarningCompensations'))
      <div class="alert alert-warning">
        {{ session('WarningCompensations') }}
      </div>
      @endif
      @if(session('SecondaryCompensations'))
      <div class="alert alert-secondary">
        {{ session('SecondaryCompensations') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE DE CAJA DE COMPENSACION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($compensations as $compensation)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $compensation->comName }}</td>
        <td>
          <a href="#" title="Editar caja de compensación {{ $compensation->comName }}" class="btn btn-outline-primary rounded-circle form-control-sm editCompensation-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $compensation->comId }}</span>
            <span hidden>{{ $compensation->comName }}</span>
          </a>
          <a href="#" title="Eliminar caja de compensación {{ $compensation->comName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteCompensation-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $compensation->comId }}</span>
            <span hidden>{{ $compensation->comName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newCompensation-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA CAJA DE COMPENSACION:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('compensations.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE DE CAJA DE COMPENSACION:</small>
                <input type="text" name="comName" maxlength="50" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editCompensation-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR CAJA DE COMPENSACION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('compensations.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">NOMBRE DE CAJA DE COMPENSACION:</small>
                <input type="text" name="comName_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="comId_Edit" value="" required>
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

<div class="modal fade" id="deleteCompensation-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINAR CAJA DE COMPENSACION:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">NOMBRE DE CAJA DE COMPENSACION: </small><br>
            <span class="text-muted"><b class="comName_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('compensations.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="comId_Delete" value="" required>
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

  $('.newCompensation-link').on('click', function() {
    $('#newCompensation-modal').modal();
  });

  $('.editCompensation-link').on('click', function(e) {
    e.preventDefault();
    var comId = $(this).find('span:nth-child(2)').text();
    var comName = $(this).find('span:nth-child(3)').text();
    $('input[name=comId_Edit]').val(comId);
    $('input[name=comName_Edit]').val(comName);
    $('#editCompensation-modal').modal();
  });

  $('.deleteCompensation-link').on('click', function(e) {
    e.preventDefault();
    var comId = $(this).find('span:nth-child(2)').text();
    var comName = $(this).find('span:nth-child(3)').text();
    $('input[name=comId_Delete]').val(comId);
    $('.comName_Delete').text(comName);
    $('#deleteCompensation-modal').modal();
  });
</script>
@endsection