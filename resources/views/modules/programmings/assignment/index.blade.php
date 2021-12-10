@extends('modules.operativeProgramming')

@section('space')
<div class="col-md-12" style="font-size: 12px;">
  <div class="row border-bottom mb-2">
    <div class="col-md-6">
      <h5>PENDIENTE DE ASIGNACION</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessAssignment'))
      <div class="alert alert-success">
        {{ session('SuccessAssignment') }}
      </div>
      @endif
      @if(session('PrimaryAssignment'))
      <div class="alert alert-primary">
        {{ session('PrimaryAssignment') }}
      </div>
      @endif
      @if(session('WarningAssignment'))
      <div class="alert alert-warning">
        {{ session('WarningAssignment') }}
      </div>
      @endif
      @if(session('SecondaryAssignment'))
      <div class="alert alert-secondary">
        {{ session('SecondaryAssignment') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table text-center" width="100%">
    <thead>
      <tr>
        <th>N° SERVICIO</th>
        <th>TIPO DE SOLICITUD</th>
        <th>SERVICIO</th>
        <th>CLIENTE</th>
        <th>ORIGEN</th>
        <th>DESTINO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <!-- Función para retornar el consecutivo con ceros a la izquierda de acuerdo a cada iteracion -->
      @php
      function getStringSequence ($number){
      $len = strlen($number);
      switch ($len) {
      case 1: return '00000' . $number; break;
      case 2: return '0000' . $number; break;
      case 3: return '000' . $number; break;
      case 4: return '00' . $number; break;
      case 5: return '0' . $number; break;
      default: return (string)$number; break;
      }
      }
      @endphp
      @for($i = 0; $i < count($dates); $i++) <tr>
        <td>{{ getStringSequence($i + 1) }}</td>
        <td>{{ $dates[$i][3] }}</td>
        <td>{{ $dates[$i][4] }}</td>
        <td>{{ $dates[$i][2] }}</td>
        <td>{{ $dates[$i][5] }}</td>
        <td>{{ $dates[$i][9] }}</td>
        <td>
          <a href="#" title="Ver información completa" class="btn btn-outline-tertiary rounded-circle form-control-sm details-link">
            <i class="fas fa-eye"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
          </a>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm edit-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
          </a>
          <a href="#" title="Asignar" class="btn btn-outline-success rounded-circle form-control-sm assign-link">
            <i class="fas fa-exchange-alt"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-danger rounded-circle form-control-sm delete-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
          </a>
        </td>
        </tr>
        @endfor
    </tbody>
  </table>
</div>

!-- Modal -->
<div class="modal fade" id="ShowAsign" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Fecha:</p>
            <p id="date" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Hora:</p>
            <p id="hour" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Cliente:</p>
            <p id="customer" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Tipo de Solicitud:</p>
            <p id="typeRequest" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Servicio:</p>
            <p id="service" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Ciudad Origen:</p>
            <p id="origin" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Dirección Origen:</p>
            <p id="addressOrigin" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Contacto:</p>
            <p id="contact" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Telefono:</p>
            <p id="phone" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Ciudad Destino:</p>
            <p id="destiny" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Dirección Destino:</p>
            <p id="addressDestiny" class="m-0"></p>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <div class="form-group text-center">
            <p class="text-muted m-0">Observaciones:</p>
            <p id="obs" class="m-0"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $('.details-link').click(function() {
    let date = $(this).find('span:nth-child(2)').text(),
      hour = $(this).find('span:nth-child(3)').text(),
      customer = $(this).find('span:nth-child(4)').text(),
      typeRequest = $(this).find('span:nth-child(5)').text(),
      service = $(this).find('span:nth-child(6)').text(),
      origin = $(this).find('span:nth-child(7)').text(),
      addressOrigin = $(this).find('span:nth-child(8)').text(),
      contact = $(this).find('span:nth-child(9)').text(),
      phone = $(this).find('span:nth-child(10)').text(),
      destiny = $(this).find('span:nth-child(11)').text(),
      addressDestiny = $(this).find('span:nth-child(12)').text(),
      obs = $(this).find('span:nth-child(13)').text();
    $('#title').text(`Servicio ${typeRequest}`).addClass('text-uppercase');
    $('#date').text(date);
    $('#hour').text(hour);
    $('#customer').text(customer);
    $('#typeRequest').text(typeRequest);
    $('#service').text(service);
    $('#origin').text(origin);
    $('#addressOrigin').text(addressOrigin);
    $('#contact').text(contact);
    $('#phone').text(phone);
    $('#destiny').text(destiny);
    $('#addressDestiny').text(addressDestiny);
    $('#obs').text(obs);
    $('#ShowAsign').modal();
  });
</script>
@endsection