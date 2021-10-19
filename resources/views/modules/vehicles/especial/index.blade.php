@extends('modules.settingVehicles')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>ESPECIAL</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar un vehiculo especial" class="bj-btn-table-add form-control-sm newEspecial-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessEspecials'))
				    <div class="alert alert-success">
				        {{ session('SuccessEspecials') }}
				    </div>
				@endif
				@if(session('PrimaryEspecials'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryEspecials') }}
				    </div>
				@endif
				@if(session('WarningEspecials'))
				    <div class="alert alert-warning">
				        {{ session('WarningEspecials') }}
				    </div>
				@endif
				@if(session('SecondaryEspecials'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryEspecials') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>TIPOLOGIA</th>
					<th>CAPACIDAD DE PASAJEROS</th>
					<th>CILINDRAJE</th>
					<th>TRANSMISION</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($especials as $especial)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $especial->espTypology }}</td>
					<td>{{ $especial->espPassengers }}</td>
					<td>{{ $especial->espDisplacement }}</td>
					<td>{{ $especial->espTransmission }}</td>
					<td>{{ $especial->espDescription }}</td>
					<td>
						<a href="#" title="Editar especial {{ $especial->espTypology }}" class="bj-btn-table-edit form-control-sm editEspecial-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $especial->espId }}</span>
							<span hidden>{{ $especial->espTypology }}</span>
							<span hidden>{{ $especial->espPassengers }}</span>
							<span hidden>{{ $especial->espDisplacement }}</span>
							<span hidden>{{ $especial->espTransmission }}</span>
							<span hidden>{{ $especial->espDescription }}</span>
						</a>
						<a href="#" title="Eliminar especial {{ $especial->espTypology }}" class="bj-btn-table-delete form-control-sm deleteEspecial-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $especial->espId }}</span>
							<span hidden>{{ $especial->espTypology }}</span>
							<span hidden>{{ $especial->espPassengers }}</span>
							<span hidden>{{ $especial->espDisplacement }}</span>
							<span hidden>{{ $especial->espTransmission }}</span>
							<span hidden>{{ $especial->espDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newEspecial-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO VEHICULO ESPECIAL:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('especials.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPOLOGIA:</small>
											<input type="text" name="espTypology" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAPACIDAD:</small>
											<input type="text" name="espPassengers" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="espDisplacement" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TRANSMISION:</small>
											<input type="text" name="espTransmission" maxlength="5" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DESCRIPCION:</small>
											<input type="text" name="espDescription" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editEspecial-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR VEHICULO ESPECIAL:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('especials.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPOLOGIA:</small>
											<input type="text" name="espTypology_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAPACIDAD:</small>
											<input type="text" name="espPassengers_Edit" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="espDisplacement_Edit" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TRANSMISION:</small>
											<input type="text" name="espTransmission_Edit" maxlength="5" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DESCRIPCION:</small>
											<input type="text" name="espDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="espId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3">GUARDAR CAMBIOS</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteEspecial-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE VEHICULO ESPECIAL:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">TIPOLOGIA: </small><br>
							<span class="text-muted"><b class="espTypology_Delete"></b></span><br>
							<small class="text-muted">CAPACIDAD DE PASAJEROS: </small><br>
							<span class="text-muted"><b class="espPassengers_Delete"></b></span><br>
							<small class="text-muted">CILINDRAJE: </small><br>
							<span class="text-muted"><b class="espDisplacement_Delete"></b></span><br>
							<small class="text-muted">TRANSMISION: </small><br>
							<span class="text-muted"><b class="espTransmission_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="espDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('especials.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="espId_Delete" value="" required>
							<button type="submit" class="bj-btn-table-add form-control-sm my-3">ELIMINAR</button>
						</form>
						<div class="col-md-6">
							<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});

		$('.newEspecial-link').on('click',function(){
			$('#newEspecial-modal').modal();
		});

		$('.editEspecial-link').on('click',function(e){
			e.preventDefault();
			var espId = $(this).find('span:nth-child(2)').text();
			var espTypology = $(this).find('span:nth-child(3)').text();
			var espPassengers = $(this).find('span:nth-child(4)').text();
			var espDisplacement = $(this).find('span:nth-child(5)').text();
			var espTransmission = $(this).find('span:nth-child(6)').text();
			var espDescription = $(this).find('span:nth-child(7)').text();
			$('input[name=espId_Edit]').val(espId);
			$('input[name=espTypology_Edit]').val(espTypology);
			$('input[name=espPassengers_Edit]').val(espPassengers);
			$('input[name=espDisplacement_Edit]').val(espDisplacement);
			$('input[name=espTransmission_Edit]').val(espTransmission);
			$('input[name=espDescription_Edit]').val(espDescription);
			$('#editEspecial-modal').modal();
		});

		$('.deleteEspecial-link').on('click',function(e){
			e.preventDefault();
			var espId = $(this).find('span:nth-child(2)').text();
			var espTypology = $(this).find('span:nth-child(3)').text();
			var espPassengers = $(this).find('span:nth-child(4)').text();
			var espDisplacement = $(this).find('span:nth-child(5)').text();
			var espTransmission = $(this).find('span:nth-child(6)').text();
			var espDescription = $(this).find('span:nth-child(7)').text();
			$('input[name=espId_Delete]').val(espId);
			$('.espTypology_Delete').text(espTypology);
			$('.espPassengers_Delete').text(espPassengers);
			$('.espDisplacement_Delete').text(espDisplacement);
			$('.espTransmission_Delete').text(espTransmission);
			$('.espDescription_Delete').text(espDescription);
			$('#deleteEspecial-modal').modal();
		});
	</script>
@endsection