@extends('modules.comercialMarketing')

@section('space')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<h5>OPORTUNIDAD DE NEGOCIO</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessOpportunity'))
				    <div class="alert alert-success">
				        {{ session('SuccessOpportunity') }}
				    </div>
				@endif
				@if(session('SecondaryOpportunity'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryOpportunity') }}
				    </div>
				@endif
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h6>Registro de oportunidades de negocio</h6>
			</div>
			<form action="{{ route('marketing.opportunity.save') }}" method="POST">
				<div class="card-body p-3 border">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">FECHA:</small>
										<input type="text" name="marDate" class="form-control form-control-sm datepicker" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<small class="text-muted">RAZON SOCIAL:</small>
										<input type="text" name="marReason" maxlength="50" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">CIUDAD:</small>
										<select name="marMunicipility_id" class="form-control form-control-sm" required>
											<option value="">Seleccione ...</option>
											@foreach($municipalities as $municipality)
												<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<small class="text-muted">DIRECCION:</small>
										<input type="text" name="marAddress" maxlength="50" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">CONTACTO:</small>
										<input type="text" name="marContact" maxlength="50" class="form-control form-control-sm" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<small class="text-muted">TELEFONO:</small>
										<input type="text" name="marPhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<small class="text-muted">CORREO ELECTRONICO:</small>
										<input type="email" name="marEmail" maxlength="50" class="form-control form-control-sm" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<small class="text-muted">OBSERVACIONES:</small>
										<textarea type="text" name="marObservation" maxlength="500" rows="1" class="form-control form-control-sm" required></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="form-group text-center">
						<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
					</div>
				</div>
			</form>	
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});
	</script>
@endsection