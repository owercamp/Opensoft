@extends('modules.integralLogistic')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>CREACION DE VARIABLES</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newVariable-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessVariable'))
      <div class="alert alert-success">
        {{ session('SuccessVariable') }}
      </div>
      @endif
      @if(session('PrimaryVariable'))
      <div class="alert alert-primary">
        {{ session('PrimaryVariable') }}
      </div>
      @endif
      @if(session('WarningVariable'))
      <div class="alert alert-warning">
        {{ session('WarningVariable') }}
      </div>
      @endif
      @if(session('SecondaryVariable'))
      <div class="alert alert-secondary">
        {{ session('SecondaryVariable') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE DE VARIABLE</th>
        <th>TIPO DE VARIABLE</th>
        <th>LONGITUD DE VARIABLE</th>
        <th>DOCUMENTO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($variables as $variable)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $variable->valName }}</td>
        <td>{{ $variable->valType }}</td>
        <td>{{ $variable->valLongitud }}</td>
        <td>{{ $variable->document->dolName }}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editVariable-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $variable->valId }}</span>
            <span hidden>{{ $variable->valName }}</span>
            <span hidden>{{ $variable->valType }}</span>
            <span hidden>{{ $variable->valLongitud }}</span>
            <span hidden>{{ $variable->valDocument_id }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteVariable-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $variable->valId }}</span>
            <span hidden>{{ $variable->valName }}</span>
            <span hidden>{{ $variable->valType }}</span>
            <span hidden>{{ $variable->valLongitud }}</span>
            <span hidden>{{ $variable->document->dolName }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@php
$yearnow = date('Y');
$mountnow = date('m');
$yearfutureOne = date('Y') + 1;
$yearfutureTwo = date('Y') + 2;
$yearfutureThree = date('Y') + 3;
$yearfutureFour = date('Y') + 4;
$yearfutureFive = date('Y') + 5;
$yearfutureSix = date('Y') + 6;
$yearfutureSeven = date('Y') + 7;
@endphp

<div class="modal fade" id="newVariable-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <!-- modal-lg -->
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA CREACION DE VARIABLE:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('logistic.variable.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="valDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE VARIABLE:</small>
                    <input type="text" name="valName" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valType" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="Texto">Texto</option>
                      <option value="Numérico">Numérico</option>
                      <option value="Moneda">Moneda</option>
                      <option value="Calendario">Calendario</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valLongitud" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editVariable-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE VARIABLE:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('logistic.variable.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="valDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE VARIABLE:</small>
                    <input type="text" name="valName_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valType_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="Texto">Texto</option>
                      <option value="Numérico">Numérico</option>
                      <option value="Moneda">Moneda</option>
                      <option value="Calendario">Calendario</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valLongitud_Edit" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="valId_Edit" readonly required>
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

<div class="modal fade" id="deleteVariable-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE VARIABLE:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">NOMBRE DE VARIABLE: </small><br>
            <span class="text-muted"><b class="valName_Delete"></b></span><br>
            <small class="text-muted">TIPO DE VARIABLE: </small><br>
            <span class="text-muted"><b class="valType_Delete"></b></span><br>
            <small class="text-muted">LONGITUD DE VARIABLE: </small><br>
            <span class="text-muted"><b class="valLongitud_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="valDocument_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('logistic.variable.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="valId_Delete" readonly required>
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

  $('.newVariable-link').on('click', function() {
    $('#newVariable-modal').modal();
  });

  $('.editVariable-link').on('click', function(e) {
    e.preventDefault();
    var valId = $(this).find('span:nth-child(2)').text();
    var valName = $(this).find('span:nth-child(3)').text();
    var valType = $(this).find('span:nth-child(4)').text();
    var valLongitud = $(this).find('span:nth-child(5)').text();
    var valDocument_id = $(this).find('span:nth-child(6)').text();
    $('input[name=valId_Edit]').val(valId);
    $('input[name=valName_Edit]').val(valName);
    $('select[name=valType_Edit]').val(valType);
    $('input[name=valLongitud_Edit]').val(valLongitud);
    $('select[name=valDocument_id_Edit]').val(valDocument_id);
    $('#editVariable-modal').modal();
  });

  $('.deleteVariable-link').on('click', function(e) {
    e.preventDefault();
    var valId = $(this).find('span:nth-child(2)').text();
    var valName = $(this).find('span:nth-child(3)').text();
    var valType = $(this).find('span:nth-child(4)').text();
    var valLongitud = $(this).find('span:nth-child(5)').text();
    var valDocument_id = $(this).find('span:nth-child(6)').text();
    $('input[name=valId_Delete]').val(valId);
    $('b.valName_Delete').text(valName);
    $('b.valType_Delete').text(valType);
    $('b.valLongitud_Delete').text(valLongitud);
    $('b.valDocument_Delete').text(valDocument_id);
    $('#deleteVariable-modal').modal();
  });
</script>
@endsection