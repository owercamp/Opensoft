@extends('modules.integralDocumentary')

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
      @foreach ($DocDocumentary as $item)
      <tr>
        <td>{{$rows++}}</td>
        <td>{{$item->dodName}}</td>
        <td>{{$item->dodCode}}</td>
        <td>{{$item->dodVersion}}</td>
        <td>{{$item->dodDate}}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editCreation-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $item->dodId }}</span>
            <span hidden>{{ $item->dodName }}</span>
            <span hidden>{{ $item->dodCode }}</span>
            <span hidden>{{ $item->dodVersion }}</span>
            <span hidden>{{ $item->dodDate }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteCreation-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $item->dodId }}</span>
            <span hidden>{{ $item->dodName }}</span>
            <span hidden>{{ $item->dodCode }}</span>
            <span hidden>{{ $item->dodVersion }}</span>
            <span hidden>{{ $item->dodDate }}</span>
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
<div class="modal fade" id="newCreationDoc-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <!-- modal-lg -->
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA CREACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('documentary.document.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <input type="text" style="text-transform: uppercase" name="dodName" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" style="text-transform: uppercase" name="dodVersion" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
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
                    <input type="text" name="dodCode_one" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="dodCode_two" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="dodCode_three" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE ACTUALIZACION:</small>
                    <input type="text" name="dodDate" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
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
<div class="modal fade" id="editCreationDoc-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <!-- modal-lg -->
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('documentary.document.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <input type="text" name="dodName_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dodVersion_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
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
                    <input type="text" name="dodCode_one_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="dodCode_two_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="dodCode_three_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE ACTUALIZACION:</small>
                    <input type="text" name="dodDate_Edit" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="dodId_Edit" readonly required>
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
<div class="modal fade" id="deleteCreationDoc-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dodName_Delete"></b></span><br>
            <small class="text-muted">CODIGO: </small><br>
            <span class="text-muted"><b class="dodCode_Delete"></b></span><br>
            <small class="text-muted">VERSION: </small><br>
            <span class="text-muted"><b class="dodVersion_Delete"></b></span><br>
            <small class="text-muted">FECHA DE ACTUALIZACION: </small><br>
            <span class="text-muted"><b class="dodDate_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('documentary.document.delete') }}" method="POST" class="col-md-6 DeleteSend">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="dodId_Delete" readonly required>
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
    $('#newCreationDoc-modal').modal();
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
        var dodId, dodName, dodCode, dodVersion, dodDate;
        dodId = $(this).find('span:nth-child(2)').text();
        dodName = $(this).find('span:nth-child(3)').text();
        dodCode = $(this).find('span:nth-child(4)').text();
        dodVersion = $(this).find('span:nth-child(5)').text();
        dodDate = $(this).find('span:nth-child(6)').text();
        $('input[name=dodId_Edit]').val(dodId);
        $('input[name=dodName_Edit]').val(dodName);
        var code_separate = dodCode.split('-');
        $('input[name=dodCode_one_Edit]').val(code_separate[0]);
        $('input[name=dodCode_two_Edit]').val(code_separate[1]);
        $('input[name=dodCode_three_Edit]').val(code_separate[2]);
        $('input[name=dodVersion_Edit]').val(dodVersion);
        $('input[name=dodDate_Edit]').val(dodDate);
        $('#editCreationDoc-modal').modal();
      }
    })
  });
  // Llama al formulario de eliminación
  $('.deleteCreation-link').on('click', function(e) {
    e.preventDefault();
    var dodId, dodName, dodCode, dodVersion, dodDate;
    dodId = $(this).find('span:nth-child(2)').text();
    dodName = $(this).find('span:nth-child(3)').text();
    dodCode = $(this).find('span:nth-child(4)').text();
    dodVersion = $(this).find('span:nth-child(5)').text();
    dodDate = $(this).find('span:nth-child(6)').text();
    $('input[name=dodId_Delete]').val(dodId);
    $('b.dodName_Delete').text(dodName);
    $('b.dodCode_Delete').text(dodCode);
    $('b.dodVersion_Delete').text(dodVersion);
    $('b.dodDate_Delete').text(dodDate);
    $('#deleteCreationDoc-modal').modal();
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