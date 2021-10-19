@extends('modules.administrativeProviders')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>SERVICIOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar un servicio" class="bj-btn-table-add form-control-sm newService-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessServices'))
				    <div class="alert alert-success">
				        {{ session('SuccessServices') }}
				    </div>
				@endif
				@if(session('PrimaryServices'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryServices') }}
				    </div>
				@endif
				@if(session('WarningServices'))
				    <div class="alert alert-warning">
				        {{ session('WarningServices') }}
				    </div>
				@endif
				@if(session('SecondaryServices'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryServices') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($services as $service)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $service->psName }}</td>
					<td>{{ $service->psDescription }}</td>
					<td>
						<a href="#" title="Editar servicio {{ $service->psName }}" class="bj-btn-table-edit form-control-sm editService-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $service->psId }}</span>
							<span hidden>{{ $service->psName }}</span>
							<span hidden>{{ $service->psDescription }}</span>
						</a>
						<a href="#" title="Eliminar servicio {{ $service->psName }}" class="bj-btn-table-delete form-control-sm deleteService-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $service->psId }}</span>
							<span hidden>{{ $service->psName }}</span>
							<span hidden>{{ $service->psDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newService-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO SERVICIO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.services.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL SERVICIO:</small>
									<input type="text" name="psName" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 0000000000" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="psDescription" rows="2" maxlength="200" class="form-control form-control-sm" required></textarea>
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

	<div class="modal fade" id="editService-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR SERVICIO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.services.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL SERVICIO:</small>
									<input type="text" name="psName_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 0000000000" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="psDescription_Edit" rows="2" maxlength="200" class="form-control form-control-sm" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="psId_Edit" value="" required>
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

	<div class="modal fade" id="deleteService-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE SERVICIO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE DEL SERVICIO: </small><br>
							<span class="text-muted"><b class="psName_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="psDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('providers.services.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="psId_Delete" value="" required>
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

		$('.newService-link').on('click',function(){
			$('#newService-modal').modal();
		});

		$('.editService-link').on('click',function(e){
			e.preventDefault();
			var psId = $(this).find('span:nth-child(2)').text();
			var psName = $(this).find('span:nth-child(3)').text();
			var psDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=psId_Edit]').val(psId);
			$('input[name=psName_Edit]').val(psName);
			$('textarea[name=psDescription_Edit]').val(psDescription);
			$('#editService-modal').modal();
		});

		$('.deleteService-link').on('click',function(e){
			e.preventDefault();
			var psId = $(this).find('span:nth-child(2)').text();
			var psName = $(this).find('span:nth-child(3)').text();
			var psDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=psId_Delete]').val(psId);
			$('.psName_Delete').text(psName);
			$('.psDescription_Delete').text(psDescription);
			$('#deleteService-modal').modal();
		});
	</script>
@endsection