@extends('modules.settingVehicles')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>MOTOCICLETAS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar una motocicleta" class="bj-btn-table-add form-control-sm newMotorcycle-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessMotorcycles'))
				    <div class="alert alert-success">
				        {{ session('SuccessMotorcycles') }}
				    </div>
				@endif
				@if(session('PrimaryMotorcycles'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryMotorcycles') }}
				    </div>
				@endif
				@if(session('WarningMotorcycles'))
				    <div class="alert alert-warning">
				        {{ session('WarningMotorcycles') }}
				    </div>
				@endif
				@if(session('SecondaryMotorcycles'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryMotorcycles') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>TIPOLOGIA</th>
					<th>CILINDRAJE</th>
					<th>TIEMPOS</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($motorcycles as $motorcycle)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $motorcycle->motTypology }}</td>
					<td>{{ $motorcycle->motDisplacement }}</td>
					<td>{{ $motorcycle->motTimes }}</td>
					<td>{{ $motorcycle->motDescription }}</td>
					<td>
						<a href="#" title="Editar motocicleta {{ $motorcycle->motTypology }}" class="bj-btn-table-edit form-control-sm editMotorcycle-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $motorcycle->motId }}</span>
							<span hidden>{{ $motorcycle->motTypology }}</span>
							<span hidden>{{ $motorcycle->motDisplacement }}</span>
							<span hidden>{{ $motorcycle->motTimes }}</span>
							<span hidden>{{ $motorcycle->motDescription }}</span>
						</a>
						<a href="#" title="Eliminar motocicleta {{ $motorcycle->motTypology }}" class="bj-btn-table-delete form-control-sm deleteMotorcycle-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $motorcycle->motId }}</span>
							<span hidden>{{ $motorcycle->motTypology }}</span>
							<span hidden>{{ $motorcycle->motDisplacement }}</span>
							<span hidden>{{ $motorcycle->motTimes }}</span>
							<span hidden>{{ $motorcycle->motDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newMotorcycle-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA MOTOCICLETA:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('motorcycles.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPOLOGIA:</small>
											<input type="text" name="motTypology" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="number" name="motDisplacement" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIEMPOS:</small>
											<input type="number" name="motTimes" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DESCRIPCION:</small>
											<input type="text" name="motDescription" maxlength="100" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editMotorcycle-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR MOTOCICLETA:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('motorcycles.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPOLOGIA:</small>
											<input type="text" name="motTypology_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="number" name="motDisplacement_Edit" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIEMPOS:</small>
											<input type="number" name="motTimes_Edit" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DESCRIPCION:</small>
											<input type="text" name="motDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="motId_Edit" value="" required>
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

	<div class="modal fade" id="deleteMotorcycle-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE MOTOCICLETA:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">TIPOLOGIA: </small><br>
							<span class="text-muted"><b class="motTypology_Delete"></b></span><br>
							<small class="text-muted">CILINDRAJE: </small><br>
							<span class="text-muted"><b class="motDisplacement_Delete"></b></span><br>
							<small class="text-muted">TIEMPOS: </small><br>
							<span class="text-muted"><b class="motTimes_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="motDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('motorcycles.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="motId_Delete" value="" required>
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

		$('.newMotorcycle-link').on('click',function(){
			$('#newMotorcycle-modal').modal();
		});

		$('.editMotorcycle-link').on('click',function(e){
			e.preventDefault();
			var motId = $(this).find('span:nth-child(2)').text();
			var motTypology = $(this).find('span:nth-child(3)').text();
			var motDisplacement = $(this).find('span:nth-child(4)').text();
			var motTimes = $(this).find('span:nth-child(5)').text();
			var motDescription = $(this).find('span:nth-child(6)').text();
			$('input[name=motId_Edit]').val(motId);
			$('input[name=motTypology_Edit]').val(motTypology);
			$('input[name=motDisplacement_Edit]').val(motDisplacement);
			$('input[name=motTimes_Edit]').val(motTimes);
			$('input[name=motDescription_Edit]').val(motDescription);
			$('#editMotorcycle-modal').modal();
		});

		$('.deleteMotorcycle-link').on('click',function(e){
			e.preventDefault();
			var motId = $(this).find('span:nth-child(2)').text();
			var motTypology = $(this).find('span:nth-child(3)').text();
			var motDisplacement = $(this).find('span:nth-child(4)').text();
			var motTimes = $(this).find('span:nth-child(5)').text();
			var motDescription = $(this).find('span:nth-child(6)').text();
			$('input[name=motId_Delete]').val(motId);
			$('.motTypology_Delete').text(motTypology);
			$('.motDisplacement_Delete').text(motDisplacement);
			$('.motTimes_Delete').text(motTimes);
			$('.motDescription_Delete').text(motDescription);
			$('#deleteMotorcycle-modal').modal();
		});
	</script>
@endsection