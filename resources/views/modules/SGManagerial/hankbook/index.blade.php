@extends('modules.integralManagerial')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>CREACION DE DOCUMENTOS</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newCreation-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessCreation'))
      <div class="alert alert-success">
        {{ session('SuccessCreation') }}
      </div>
      @endif
      @if(session('PrimaryCreation'))
      <div class="alert alert-primary">
        {{ session('PrimaryCreation') }}
      </div>
      @endif
      @if(session('WarningCreation'))
      <div class="alert alert-warning">
        {{ session('WarningCreation') }}
      </div>
      @endif
      @if(session('SecondaryCreation'))
      <div class="alert alert-secondary">
        {{ session('SecondaryCreation') }}
      </div>
      @endif
    </div>
  </div>
  {{-- tabla en index muestra mis datos en la base de datos --}}
  <table id="tableDatatable" class="table table-hover table-bordered text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRE DEL DOCUMENTO</th>
        <th>CODIGO</th>
        <th>VERSION</th>
        <th>FECHA ACTUALIZACION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php
      $rows =1;
      @endphp
      @foreach ($DocumentMNG as $item)
      <tr>
        <td>{{$rows++}}</td>
        <td>{{$item->domName}}</td>
        <td>{{$item->domCode}}</td>
        <td>{{$item->domVersion}}</td>
        <td>{{$item->domDate}}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editCreation-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $item->domId }}</span>
            <span hidden>{{ $item->domName }}</span>
            <span hidden>{{ $item->domCode }}</span>
            <span hidden>{{ $item->domVersion }}</span>
            <span hidden>{{ $item->domDate }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteCreation-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $item->domId }}</span>
            <span hidden>{{ $item->domName }}</span>
            <span hidden>{{ $item->domCode }}</span>
            <span hidden>{{ $item->domVersion }}</span>
            <span hidden>{{ $item->domDate }}</span>
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

{{-- creación de mi formulario de creación documento --}}
<div class="modal fade" id="newCreationMNG-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <!-- modal-lg -->
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA CREACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('managerial.document.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <input type="text" style="text-transform: uppercase" name="domName" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" style="text-transform: uppercase" name="domVersion" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONFIGURACION CODIGO:</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_one" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_two" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_three" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE ACTUALIZACION:</small>
                    <input type="text" name="domDate" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- creación de mi formulario de modificación documento --}}
<div class="modal fade" id="editCreationMNG-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <!-- modal-lg -->
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('managerial.document.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <input type="text" name="domName_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="domVersion_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONFIGURACION CODIGO:</small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_one_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_two_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="domCode_three_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE ACTUALIZACION:</small>
                    <input type="text" name="domDate_Edit" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="domId_Edit" readonly required>
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

{{-- formulario de eliminación --}}
<div class="modal fade" id="deleteCreationMNG-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="domName_Delete"></b></span><br>
            <small class="text-muted">CODIGO: </small><br>
            <span class="text-muted"><b class="domCode_Delete"></b></span><br>
            <small class="text-muted">VERSION: </small><br>
            <span class="text-muted"><b class="domVersion_Delete"></b></span><br>
            <small class="text-muted">FECHA DE ACTUALIZACION: </small><br>
            <span class="text-muted"><b class="domDate_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('managerial.document.delete') }}" method="POST" class="col-md-6 DeleteSend">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="domId_Delete" readonly required>
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
  // Llama al formulario modal de creación
  $('.newCreation-link').on('click', function() {
    $('#newCreationMNG-modal').modal();
  });
  // Llama al formulario modal edit de edición
  $('.editCreation-link').on('click', function(e) {
    Swal.fire({
      title: 'Desea editar este registro?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#f58f4d',
      confirmButtonText: 'Si, editar',
      cancelButtonText: 'No',
      showClass: {
        popup: 'animate__animated animate__flipInX'
      },
      hideClass: {
        popup: 'animate__animated animate__flipOutX'
      },
    }).then((result) => {
      if (result.isConfirmed) {
        e.preventDefault();
        var domId, domName, domCode, domVersion, domDate;
        domId = $(this).find('span:nth-child(2)').text();
        domName = $(this).find('span:nth-child(3)').text();
        domCode = $(this).find('span:nth-child(4)').text();
        domVersion = $(this).find('span:nth-child(5)').text();
        domDate = $(this).find('span:nth-child(6)').text();
        $('input[name=domId_Edit]').val(domId);
        $('input[name=domName_Edit]').val(domName);
        var code_separate = domCode.split('-');
        $('input[name=domCode_one_Edit]').val(code_separate[0]);
        $('input[name=domCode_two_Edit]').val(code_separate[1]);
        $('input[name=domCode_three_Edit]').val(code_separate[2]);
        $('input[name=domVersion_Edit]').val(domVersion);
        $('input[name=domDate_Edit]').val(domDate);
        $('#editCreationMNG-modal').modal();
      }
    })
  });

  // Llama al formulario de eliminación
  $('.deleteCreation-link').on('click', function(e) {
    e.preventDefault();
    var domId, domName, domCode, domVersion, domDate;
    domId = $(this).find('span:nth-child(2)').text();
    domName = $(this).find('span:nth-child(3)').text();
    domCode = $(this).find('span:nth-child(4)').text();
    domVersion = $(this).find('span:nth-child(5)').text();
    domDate = $(this).find('span:nth-child(6)').text();
    $('input[name=domId_Delete]').val(domId);
    $('b.domName_Delete').text(domName);
    $('b.domCode_Delete').text(domCode);
    $('b.domVersion_Delete').text(domVersion);
    $('b.domDate_Delete').text(domDate);
    $('#deleteCreationMNG-modal').modal();
  })

  // envia el formulario de eliminación
  $('.DeleteSend').submit('click', function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¡¡Eliminación!!',
      text: "Desea continuar con la eliminación",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#f58f4d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'No',
      showClass: {
        popup: 'animate__animated animate__flipInX'
      },
      hideClass: {
        popup: 'animate__animated animate__flipOutX'
      },
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
  })
</script>
@if(session('SuccessCreation'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡creado con exito!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if(session('SecondaryCreation'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops..',
    text: '¡documento existente!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if (session('SecondCreation') == "NoEncontrado")
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops..',
    text: 'documento no encontrado',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if (session('PrimaryCreation'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡actualizado con exito!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if (session('WarningCreation'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡eliminado con exito!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@endsection