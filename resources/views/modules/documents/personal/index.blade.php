@extends('modules.settingDocuments')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>IDENTIFICACION PERSONAL</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar una identificación personal" class="bj-btn-table-add form-control-sm newPersonal-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessPersonals'))
				    <div class="alert alert-success">
				        {{ session('SuccessPersonals') }}
				    </div>
				@endif
				@if(session('PrimaryPersonals'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryPersonals') }}
				    </div>
				@endif
				@if(session('WarningPersonals'))
				    <div class="alert alert-warning">
				        {{ session('WarningPersonals') }}
				    </div>
				@endif
				@if(session('SecondaryPersonals'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryPersonals') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($personals as $personal)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $personal->perName }}</td>
					<td>
						<a href="#" title="Editar departamento {{ $personal->perName }}" class="bj-btn-table-edit form-control-sm editPersonal-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $personal->perId }}</span>
							<span hidden>{{ $personal->perName }}</span>
						</a>
						<a href="#" title="Eliminar departamento {{ $personal->perName }}" class="bj-btn-table-delete form-control-sm deletePersonal-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $personal->perId }}</span>
							<span hidden>{{ $personal->perName }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newPersonal-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA IDENTIFICACION:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('personals.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="perName" maxlength="50" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editPersonal-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR IDENTIFICACION:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('personals.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="perName_Edit" maxlength="50" class="form-control form-control-sm" title="De 50 carácteres máximo" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="perId_Edit" value="" required>
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

	<div class="modal fade" id="deletePersonal-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE IDENTIFICACION:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE: </small><br>
							<span class="text-muted"><b class="perName_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('personals.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="perId_Delete" value="" required>
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

		$('.newPersonal-link').on('click',function(){
			$('#newPersonal-modal').modal();
		});

		$('.editPersonal-link').on('click',function(e){
			e.preventDefault();
			var perId = $(this).find('span:nth-child(2)').text();
			var perName = $(this).find('span:nth-child(3)').text();
			$('input[name=perId_Edit]').val(perId);
			$('input[name=perName_Edit]').val(perName);
			$('#editPersonal-modal').modal();
		});

		$('.deletePersonal-link').on('click',function(e){
			e.preventDefault();
			var perId = $(this).find('span:nth-child(2)').text();
			var perName = $(this).find('span:nth-child(3)').text();
			$('input[name=perId_Delete]').val(perId);
			$('.perName_Delete').text(perName);
			$('#deletePersonal-modal').modal();
		});
	</script>
@endsection