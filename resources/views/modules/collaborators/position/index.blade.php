@extends('modules.logisticCollaborators')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CREACION DE CARGOS</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newPosition-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessPosition'))
				    <div class="alert alert-success">
				        {{ session('SuccessPosition') }}
				    </div>
				@endif
				@if(session('PrimaryPosition'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryPosition') }}
				    </div>
				@endif
				@if(session('WarningPosition'))
				    <div class="alert alert-warning">
				        {{ session('WarningPosition') }}
				    </div>
				@endif
				@if(session('SecondaryPosition'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryPosition') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>CARGO</th>
					<th>OBSERVACION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($positions as $position)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $position->pcoName }}</td>
					<td>{{ $position->pcoObservation }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editPosition-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $position->pcoId }}</span>
							<span hidden>{{ $position->pcoName }}</span>
							<span hidden>{{ $position->pcoObservation }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deletePosition-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $position->pcoId }}</span>
							<span hidden>{{ $position->pcoName }}</span>
							<span hidden>{{ $position->pcoObservation }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newPosition-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CREACION DE CARGO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.position.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL CARGO:</small>
									<input type="text" name="pcoName" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">OBSERVACION:</small>
									<textarea name="pcoObservation" rows="2" class="form-control form-control-sm"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editPosition-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE CARGO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.position.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL CARGO:</small>
									<input type="text" name="pcoName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">OBSERVACION:</small>
									<textarea name="pcoObservation_Edit" rows="2" class="form-control form-control-sm"></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="pcoId_Edit" readonly required>
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

	<div class="modal fade" id="deletePosition-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CARGO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE CARGO: </small><br>
							<span class="text-muted"><b class="pcoName_Delete"></b></span><br>
							<small class="text-muted">OBSERVACION: </small><br>
							<span class="text-muted"><b class="pcoObservation_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('collaborators.position.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="pcoId_Delete" readonly required>
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

		$('.newPosition-link').on('click',function(){
			$('#newPosition-modal').modal();
		});

		$('.editPosition-link').on('click',function(e){
			e.preventDefault();
			var pcoId = $(this).find('span:nth-child(2)').text();
			var pcoName = $(this).find('span:nth-child(3)').text();
			var pcoObservation = $(this).find('span:nth-child(4)').text();
			$('input[name=pcoId_Edit]').val(pcoId);
			$('input[name=pcoName_Edit]').val(pcoName);
			$('textarea[name=pcoObservation_Edit]').val(pcoObservation);
			$('#editPosition-modal').modal();
		});

		$('.deletePosition-link').on('click',function(e){
			e.preventDefault();
			var pcoId = $(this).find('span:nth-child(2)').text();
			var pcoName = $(this).find('span:nth-child(3)').text();
			var pcoObservation = $(this).find('span:nth-child(4)').text();
			$('input[name=pcoId_Delete]').val(pcoId);
			$('b.pcoName_Delete').text(pcoName);
			$('b.pcoObservation_Delete').text(pcoObservation);
			$('#deletePosition-modal').modal();
		});
	</script>
@endsection