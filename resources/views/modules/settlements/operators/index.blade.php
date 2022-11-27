@extends('modules.operativeSettlement')

@section('space')
<div class="col-md-12">
  <h5>LIQUIDACION PARA OPERADORES</h5>
  @include('partials.alerts')
  <div class="container-fluid">
    <table id="tableOperative" class="table table-hover text-center" width="100%">
      <thead>
        <tr>
          <th>FECHA SERVICIO</th>
          <th>TIPO DE SOLICITUD</th>
          <th>COLABORADOR</th>
          <th>CLIENTE</th>
          <th>ORIGEN</th>
          <th>DESTINO</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
      <tbody>
        @for($i = 0; $i < count($dataArray); $i++) <tr>
          <td>{{ $dataArray[$i][0] }} {{ $dataArray[$i][1] }}</td>
          <td>{{ $dataArray[$i][3] }} - {{ $dataArray[$i][4] }}</td>
          <td>{{ $dataArray[$i][13] }}</td>
          <td>{{ $dataArray[$i][2] }}</td>
          <td>{{ $dataArray[$i][5] }}</td>
          <td>{{ $dataArray[$i][9] }}</td>
          <td class="align-middle d-flex justify-content-around">
            <form action="{{ route('tracking.binnacle') }}" method="post">
              @csrf
              <button class="btn btn-outline-dark rounded-circle" title="Informe de Novedades">
                <i class="fas fa-info-circle"></i>
                <input type="hidden" name="id" value="{{ $dataArray[$i][12] }}">
                <input type="hidden" name="type" value="{{ $dataArray[$i][3] }}">
                <input type="hidden" name="col" value="{{ $dataArray[$i][13] }}">
              </button>
            </form>
            <button class="btn btn-outline-secondary rounded-circle tickets" data-origin="{{ $dataArray[$i][5] }}" data-destiny="{{ $dataArray[$i][9] }}" data-id="{{ $dataArray[$i][12] }}" data-type="{{ $dataArray[$i][3] }}" data-col="{{ $dataArray[$i][13] }}" data-date="{{ $dataArray[$i][0] }}" title="Ticket Cliente">
              <i class="fas fa-ticket-alt"></i>
            </button>
            @if ($dataArray[$i][14] != 'FACTURADO')
            <button class="btn btn-outline-secondary rounded-circle liquidar" data-origin="{{ $dataArray[$i][5] }}" data-destiny="{{ $dataArray[$i][9] }}" data-id="{{ $dataArray[$i][12] }}" data-type="{{ $dataArray[$i][3] }}" data-col="{{ $dataArray[$i][13] }}" data-date="{{ $dataArray[$i][0] }}" title="Liquidar Servicio">
              <i class="far fa-check-circle"></i>
            </button>
            @endif
          </td>
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL DE LIQUIDACION SERVICIO -->
<div class="modal fade" id="liquidar-servicio" tabindex="-1" aria-labelledby="liquidar-servicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="liquidar-servicio">{{ ucwords('liquidación servicio') }}</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close">&Chi;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'liquidate.service.save', 'method' => 'POST', 'id' => 'liquidate']) !!}
        @include('modules.settlements.operators.patials.form')
        <div class="modal-footer">
          {!! Form::button('Cerrar',['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])!!}
        </div>
        {!! Form::Close()!!}
      </div>
    </div>
  </div>
</div>

<!-- MODAL DE APROBACION SERVICIO -->
<div class="modal fade" id="aprobar-servicio" tabindex="-1" aria-labelledby="aprobar-servicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aprobar-servicio">{{ ucwords('liquidación servicio') }}</h5>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close">&Chi;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'liquidate.service.approved', 'method' => 'PATCH', 'id' => 'liquidateApproved'])!!}
        @include('modules.settlements.operators.patials.form')
        <div class="modal-footer">
          {!! Form::button('Cerrar', ['class' => 'btn btn-secondary','data-dismiss' => 'modal'])!!}
          {!! Form::button('Guardar', ['class' => 'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  /**@description: ENVIO EL FORMULARIO */
  $('#aprobar-servicio #liquidateApproved .btn-primary').click(function() {
    $('input[name="typeservices"]').attr('disabled', false);
    $('input[name="origin"]').attr('disabled', false);
    $('input[name="destiny"]').attr('disabled', false);
    $('input[name="colaborator"]').attr('disabled', false);
    $('input[name="price"]').attr('disabled', false);
    $('input[name="date"]').attr('disabled', false);
    $("#liquidateApproved").submit();
    console.log('submit');
  })

  /** @description: CARGA EL TICKET **/
  $('.tickets').click(function() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      dataType: "JSON",
      data: {
        id: $(this).data('id'),
        type: $(this).data('type'),
        origin: $(this).data('origin'),
        destiny: $(this).data('destiny'),
        date: $(this).data('date')
      },
      url: "{{ route('liquidate.service') }}",
      success(res) {
        $('input[name="typeservices"]').val(res[0]['service'].toUpperCase());
        $('input[name="origin"]').val(res[0]['origin'].toUpperCase());
        $('input[name="destiny"]').val(res[0]['destiny'].toUpperCase());
        $('input[name="colaborator"]').val(res[0]['client'].toUpperCase());
        $('input[name="price"]').val(new Intl.NumberFormat('de-DE', {
          style: 'currency', // estilo de moneda
          currency: 'COP', // tipo de moneda
          maximumFractionDigits: 0, //Cantidad de decimales
        }).format(res[0]['price']));
        $('input[name="date"]').val(res[0]['date']);
        $('#factureSubmit').attr('data-id', (res[0]['id']));
      },
      complete() {
        $("#liquidar-servicio").modal();
        $('input[name="typeservices"]').attr('disabled', true);
        $('input[name="origin"]').attr('disabled', true);
        $('input[name="destiny"]').attr('disabled', true);
        $('input[name="colaborator"]').attr('disabled', true);
        $('input[name="price"]').attr('disabled', true);
        $('input[name="date"]').attr('disabled', true);
      }
    })
  });

  /** @description: CARGA EL FORMULARIO DE FACTURACION SERVICIO **/
  $('.liquidar').click(function() {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      dataType: "JSON",
      data: {
        id: $(this).data('id'),
        type: $(this).data('type'),
        origin: $(this).data('origin'),
        destiny: $(this).data('destiny'),
        date: $(this).data('date')
      },
      url: "{{ route('liquidate.service') }}",
      success(res) {
        $('input[name="typeservices"]').val(res[0]['service'].toUpperCase());
        $('input[name="origin"]').val(res[0]['origin'].toUpperCase());
        $('input[name="destiny"]').val(res[0]['destiny'].toUpperCase());
        $('input[name="colaborator"]').val(res[0]['client'].toUpperCase());
        $('input[name="price"]').val(new Intl.NumberFormat('de-DE', {
          style: 'currency', // estilo de moneda
          currency: 'COP', // tipo de moneda
          maximumFractionDigits: 0, //Cantidad de decimales
        }).format(res[0]['price']));
        $('input[name="date"]').val(res[0]['date']);
        $('#factureSubmit').attr('data-id', (res[0]['id']));
      },
      complete() {
        $("#aprobar-servicio").modal();
        $('input[name="typeservices"]').attr('disabled', true);
        $('input[name="origin"]').attr('disabled', true);
        $('input[name="destiny"]').attr('disabled', true);
        $('input[name="colaborator"]').attr('disabled', true);
        $('input[name="price"]').attr('disabled', true);
        $('input[name="date"]').attr('disabled', true);
      }
    })
  });
</script>
@endsection