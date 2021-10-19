@extends('modules.settingSecurity')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>ADMINISTRADORA DE RIESGOS LABORALES</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar una entidad de riesgos laborales" class="bj-btn-table-add form-control-sm newRisk-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessRisks'))
				    <div class="alert alert-success">
				        {{ session('SuccessRisks') }}
				    </div>
				@endif
				@if(session('PrimaryRisks'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryRisks') }}
				    </div>
				@endif
				@if(session('WarningRisks'))
				    <div class="alert alert-warning">
				        {{ session('WarningRisks') }}
				    </div>
				@endif
				@if(session('SecondaryRisks'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryRisks') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE ENTIDAD</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($risks as $risk)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $risk->risName }}</td>
					<td>
						<a href="#" title="Editar entidad {{ $risk->risName }}" class="bj-btn-table-edit form-control-sm editRisk-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $risk->risId }}</span>
							<span hidden>{{ $risk->risName }}</span>
						</a>
						<a href="#" title="Eliminar entidad {{ $risk->risName }}" class="bj-btn-table-delete form-control-sm deleteRisk-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $risk->risId }}</span>
							<span hidden>{{ $risk->risName }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newRisk-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA ADMINISTRADORA DE RIESGOS:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('risks.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE ADMINISTRADORA DE RIESGOS:</small>
									<input type="text" name="risName" maxlength="50" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editRisk-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR ADMINISTRADORA DE RIESGOS:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('risks.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE ADMINISTRADORA DE RIESGOS:</small>
									<input type="text" name="risName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="risId_Edit" value="" required>
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

	<div class="modal fade" id="deleteRisk-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINAR ADMINISTRADORA DE RIESGOS:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE DE ADMINISTRADORA DE RIESGOS: </small><br>
							<span class="text-muted"><b class="risName_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('risks.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="risId_Delete" value="" required>
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

		$('.newRisk-link').on('click',function(){
			$('#newRisk-modal').modal();
		});

		$('.editRisk-link').on('click',function(e){
			e.preventDefault();
			var risId = $(this).find('span:nth-child(2)').text();
			var risName = $(this).find('span:nth-child(3)').text();
			$('input[name=risId_Edit]').val(risId);
			$('input[name=risName_Edit]').val(risName);
			$('#editRisk-modal').modal();
		});

		$('.deleteRisk-link').on('click',function(e){
			e.preventDefault();
			var risId = $(this).find('span:nth-child(2)').text();
			var risName = $(this).find('span:nth-child(3)').text();
			$('input[name=risId_Delete]').val(risId);
			$('.risName_Delete').text(risName);
			$('#deleteRisk-modal').modal();
		});
	</script>
@endsection