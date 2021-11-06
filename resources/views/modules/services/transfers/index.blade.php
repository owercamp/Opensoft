@extends('modules.settingServices')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>TRASLADOS URBANOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar traslado" class="btn btn-outline-success form-control-sm newTransfer-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessTransfer'))
      <div class="alert alert-success">
        {{ session('SuccessTransfer') }}
      </div>
      @endif
      @if(session('PrimaryTransfer'))
      <div class="alert alert-primary">
        {{ session('PrimaryTransfer') }}
      </div>
      @endif
      @if(session('WarningTransfer'))
      <div class="alert alert-warning">
        {{ session('WarningTransfer') }}
      </div>
      @endif
      @if(session('SecondaryTransfer'))
      <div class="alert alert-secondary">
        {{ session('SecondaryTransfer') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>PRODUCTO</th>
        <th>SERVICIO</th>
        <th>TIEMPO DE DISPONIBILIDAD</th>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($transfers as $transfer)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $transfer->ptrProduct }}</td>
        <td>{{ $transfer->strService }}</td>
        <td>{{ $transfer->strAvailability }}</td>
        @if(strlen($transfer->strDescription) > 50)
        <td>{{ substr($transfer->strDescription,0,50) . ' ... ' }}</td>
        @else
        <td>{{ $transfer->strDescription }}</td>
        @endif
        <td>
          <a href="#" title="Editar traslado {{ $transfer->strService }}" class="btn btn-outline-primary rounded-circle form-control-sm editTransfer-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $transfer->strId }}</span>
            <span hidden>{{ $transfer->strProduct_id }}</span>
            <span hidden>{{ $transfer->strService }}</span>
            <span hidden>{{ $transfer->strAvailability }}</span>
            <span hidden>{{ $transfer->strDescription }}</span>
          </a>
          <a href="#" title="Eliminar traslado {{ $transfer->strService }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTransfer-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $transfer->strId }}</span>
            <span hidden>{{ $transfer->ptrProduct }}</span>
            <span hidden>{{ $transfer->strService }}</span>
            <span hidden>{{ $transfer->strAvailability }}</span>
            <span hidden>{{ $transfer->strDescription }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newTransfer-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO TRASLADO DE SERVICIOS:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.transfers.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="strProduct_id" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productstransfers as $productstransfer)
                  <option value="{{ $productstransfer->ptrId }}">{{ $productstransfer->ptrProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="strService" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="strAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="strDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
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

<div class="modal fade" id="editTransfer-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR TRASLADO DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.transfers.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="strProduct_id_Edit" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productstransfers as $productstransfer)
                  <option value="{{ $productstransfer->ptrId }}">{{ $productstransfer->ptrProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="strService_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="strAvailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="strDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="strId_Edit" value="" required>
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

<div class="modal fade" id="deleteTransfer-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE TRASLADO DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">TIPO DE PRODUCTO: </small><br>
            <span class="text-muted"><b class="strProduct_id_Delete"></b></span><br>
            <small class="text-muted">SERVICIO: </small><br>
            <span class="text-muted"><b class="strService_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="strAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="strDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('services.transfers.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="strId_Delete" value="" required>
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

  $('.newTransfer-link').on('click', function() {
    $('#newTransfer-modal').modal();
  });

  $('.editTransfer-link').on('click', function(e) {
    e.preventDefault();
    var strId = $(this).find('span:nth-child(2)').text();
    var strProduct_id = $(this).find('span:nth-child(3)').text();
    var strService = $(this).find('span:nth-child(4)').text();
    var strAvailability = $(this).find('span:nth-child(5)').text();
    var strDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=strId_Edit]').val(strId);
    $('select[name=strProduct_id_Edit]').val(strProduct_id);
    $('input[name=strService_Edit]').val(strService);
    $('input[name=strAvailability_Edit]').val(strAvailability);
    $('textarea[name=strDescription_Edit]').val(strDescription);
    $('#editTransfer-modal').modal();
  });

  $('.deleteTransfer-link').on('click', function(e) {
    e.preventDefault();
    var strId = $(this).find('span:nth-child(2)').text();
    var strProduct_id = $(this).find('span:nth-child(3)').text();
    var strService = $(this).find('span:nth-child(4)').text();
    var strAvailability = $(this).find('span:nth-child(5)').text();
    var strDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=strId_Delete]').val(strId);
    $('.strProduct_id_Delete').text(strProduct_id);
    $('.strService_Delete').text(strService);
    $('.strAvailability_Delete').text(strAvailability);
    $('.strDescription_Delete').text(strDescription);
    $('#deleteTransfer-modal').modal();
  });
</script>
@endsection