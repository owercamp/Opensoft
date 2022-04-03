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
							<button class="btn btn-outline-dark rounded-circle" title="Novedades Servicio">
								<i class="fas fa-info-circle"></i>
								<input type="hidden" name="id" value="{{ $dataArray[$i][12] }}">
								<input type="hidden" name="type" value="{{ $dataArray[$i][3] }}">
								<input type="hidden" name="col" value="{{ $dataArray[$i][13] }}">
							</button>
						</form>
						<button class="btn btn-outline-secondary rounded-circle tickets" data-origin="{{ $dataArray[$i][5] }}" data-destiny="{{ $dataArray[$i][9] }}" data-id="{{ $dataArray[$i][12] }}" data-type="{{ $dataArray[$i][3] }}" data-col="{{ $dataArray[$i][13] }}" title="ticket Cliente">
							<i class="fas fa-ticket-alt"></i>
						</button>
						<button class="btn btn-outline-secondary rounded-circle liquidar" data-origin="{{ $dataArray[$i][5] }}" data-destiny="{{ $dataArray[$i][9] }}" data-id="{{ $dataArray[$i][12] }}" data-type="{{ $dataArray[$i][3] }}" data-col="{{ $dataArray[$i][13] }}" title="liquidar Servicio">
							<i class="far fa-check-circle"></i>
						</button>
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
        <form action="{{ route('liquidate.service.save') }}" method="POST" id="liquidate">
          @csrf
          <div class="form-group">
            <label for="typeservices">{{ ucwords('tipo de servicio') }}</label>
            <input type="text" name="typeservices" class="form-control @error('typeservices') is-invalid @enderror" id="typeservices" value="{{ old('typeservices') }}">
            @error('typeservices')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            @enderror
          </div>
          <div class="form-group">
            <label for="origin">{{ ucwords('origen') }}</label>
            <input type="text" name="origin" class="form-control @error('origin') is-invalid @enderror" id="origin" value="{{ old('origin') }}">
            @error('origin')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            @enderror
          </div>
          <div class="form-group">
            <label for="destiny">{{ ucwords('destino') }}</label>
            <input type="text" name="destiny" class="form-control @error('destiny') is-invalid @enderror" id="destiny" value="{{ old('destiny') }}">
            @error('destiny')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            @enderror
          </div>
          <div class="form-group">
            <label for="colaborator">{{ ucwords('colaborador') }}</label>
            <input type="text" name="colaborator" class="form-control @error('colaborator') is-invalid @enderror" id="colaborator" value="{{ old('colaborator') }}">
            @error('colaborator')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            @enderror
          </div>
          <div class="form-group">
            <label for="price">{{ ucwords('precio') }}</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucwords("Cerrar") }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
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
        destiny: $(this).data('destiny')
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
        $('#factureSubmit').attr('data-id',(res[0]['id']));
      },
      complete() {
        $("#liquidar-servicio").modal();
          $('input[name="typeservices"]').attr('disabled', true);
          $('input[name="origin"]').attr('disabled', true);
          $('input[name="destiny"]').attr('disabled', true);
          $('input[name="colaborator"]').attr('disabled', true);
          $('input[name="price"]').attr('disabled', true);
      }
    })
  });
</script>
@endsection