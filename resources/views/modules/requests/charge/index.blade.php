@extends('modules.operativeRequest')

@section('space')
	<div class="col-md-12 p-3" style="font-size: 12px;">
		<div class="row border-bottom mb-2">
			<div class="col-md-6">
				<h5>CARGA EXPRESS</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessCharge'))
				    <div class="alert alert-success">
				        {{ session('SuccessCharge') }}
				    </div>
				@endif
				@if(session('SecondaryCharge'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryCharge') }}
				    </div>
				@endif
			</div>
		</div>
		<form action="{{ route('request.charge.save') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<small class="text-muted">Nombre de cliente: </small>
						<select name="recClient" class="form-control form-control-sm" required>
							<option value="">Seleccione ...</option>
							@for($i = 0; $i < count($clients); $i++)
								<option value="{{ $clients[$i][0] }}" data-name="{{ $clients[$i][1] }}" data-document="{{ $clients[$i][2] }}" data-datestart="{{ $clients[$i][3] }}" data-dateend="{{ $clients[$i][4] }}" data-type="{{ $clients[$i][5] }}">
									{{ $clients[$i][1] }}
								</option>
							@endfor
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<small class="text-muted">Tipo de servicio: </small>
						<select name="reccharge_id" class="form-control form-control-sm" required>
							<option value="">Seleccione ...</option>
							@foreach($servicecharges as $servicecharge)
								<option value="{{ $servicecharge->scId }}" data-service="{{ $servicecharge->scService }}" data-description="{{ $servicecharge->scDescription }}">
									{{ $servicecharge->scService }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<small class="text-muted">Fecha: </small>
						<input type="text" name="recDateservice" class="form-control form-control-sm text-center datepicker" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<small class="text-muted">Hora: </small>
						<input type="time" name="recHourstart" class="form-control form-control-sm" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 p-1 pr-3 border-right">
					<small style="color: blue; font-weight: bold;">ORIGEN: </small>
					<div class="row border-top">
						<div class="col-md-4">
							<!-- CIUDAD -->
							<div class="form-group">
								<small class="text-muted">Ciudad: </small>
								<select name="recMunicipalityorigin_id" class="form-control form-control-sm" required>
									<option value="">Seleccione ...</option>
									@foreach($municipalities as $municipality)
										<option value="{{ $municipality->munId }}" data-municipality="{{ $municipality->munName }}">
											{{ $municipality->munName }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<!-- DIRECCION -->
							<div class="form-group">
								<small class="text-muted">Dirección: </small>
								<input type="text" name="recAddressorigin" class="form-control form-control-sm" required>
							</div>
						</div>
					</div>	
				</div>
				<div class="col-md-6 p-1 pl-3 border-left">
					<small style="color: blue; font-weight: bold;">DESTINO: </small>
					<div class="row border-top">
						<div class="col-md-4">
							<!-- CIUDAD -->
							<div class="form-group">
								<small class="text-muted">Ciudad: </small>
								<select name="recMunicipalitydestiny_id" class="form-control form-control-sm" required>
									<option value="">Seleccione ...</option>
									@foreach($municipalities as $municipality)
										<option value="{{ $municipality->munId }}" data-municipality="{{ $municipality->munName }}">
											{{ $municipality->munName }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<!-- DIRECCION -->
							<div class="form-group">
								<small class="text-muted">Dirección: </small>
								<input type="text" name="recAddressdestiny" class="form-control form-control-sm" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<small class="text-muted">Contacto: </small>
						<input type="text" name="recContact" maxlength="50" title="De 1 a 50 carácteres NO numéricos" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<small class="text-muted">Teléfono: </small>
						<input type="text" name="recPhone" maxlength="10" pattern="[0-9]{1,10}" title="De 1 a 10 números" class="form-control form-control-sm" required>
					</div>
				</div>
			</div>
			<div class="form-group text-center m-3">
				<input type="hidden" name="recTypecliente" class="form-control form-control-sm" required>
				<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR REGISTRO</button>
			</div>
		</form>
	</div>
@endsection

@section('scripts')
	<script>
		$('select[name=recClient]').on('change',function(e){
			let selected = e.target.value;
			$('input[name=recTypecliente]').val('');
			if(selected !== ''){
				let type = $('select[name=recClient] option:selected').attr('data-type');
				$('input[name=recTypecliente]').val(type);
			}
		});
	</script>
@endsection