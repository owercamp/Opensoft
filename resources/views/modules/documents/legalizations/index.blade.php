@extends('modules.settingDocuments')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>LEGALIZACION DE VEHICULOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar una legalización" class="bj-btn-table-add form-control-sm newLegalization-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessLegalizations'))
				    <div class="alert alert-success">
				        {{ session('SuccessLegalizations') }}
				    </div>
				@endif
				@if(session('PrimaryLegalizations'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryLegalizations') }}
				    </div>
				@endif
				@if(session('WarningLegalizations'))
				    <div class="alert alert-warning">
				        {{ session('WarningLegalizations') }}
				    </div>
				@endif
				@if(session('SecondaryLegalizations'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryLegalizations') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>DOCUMENTO</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($legalizations as $legalization)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $legalization->legDocument }}</td>
					<td>{{ $legalization->legDescription }}</td>
					<td>
						<a href="#" title="Editar legalización {{ $legalization->legDocument }}" class="bj-btn-table-edit form-control-sm editLegalization-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $legalization->legId }}</span>
							<span hidden>{{ $legalization->legDocument }}</span>
							<span hidden>{{ $legalization->legDescription }}</span>
						</a>
						<a href="#" title="Eliminar legalización {{ $legalization->legDocument }}" class="bj-btn-table-delete form-control-sm deleteLegalization-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $legalization->legId }}</span>
							<span hidden>{{ $legalization->legDocument }}</span>
							<span hidden>{{ $legalization->legDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newLegalization-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA LEGALIZACION:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('legalization.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">DOCUMENTO:</small>
									<input type="text" name="legDocument" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<input type="text" name="legDescription" maxlength="100" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editLegalization-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR LEGALIZACION:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('legalization.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">DOCUMENTO:</small>
									<input type="text" name="legDocument_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<input type="text" name="legDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="legId_Edit" value="" required>
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

	<div class="modal fade" id="deleteLegalization-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE LEGALIZACION:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">DOCUENTO: </small><br>
							<span class="text-muted"><b class="legDocument_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="legDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('legalization.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="legId_Delete" value="" required>
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

		$('.newLegalization-link').on('click',function(){
			$('#newLegalization-modal').modal();
		});

		$('.editLegalization-link').on('click',function(e){
			e.preventDefault();
			var legId = $(this).find('span:nth-child(2)').text();
			var legDocument = $(this).find('span:nth-child(3)').text();
			var legDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=legId_Edit]').val(legId);
			$('input[name=legDocument_Edit]').val(legDocument);
			$('input[name=legDescription_Edit]').val(legDescription);
			$('#editLegalization-modal').modal();
		});

		$('.deleteLegalization-link').on('click',function(e){
			e.preventDefault();
			var legId = $(this).find('span:nth-child(2)').text();
			var legDocument = $(this).find('span:nth-child(3)').text();
			var legDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=legId_Delete]').val(legId);
			$('.legDocument_Delete').text(legDocument);
			$('.legDescription_Delete').text(legDescription);
			$('#deleteLegalization-modal').modal();
		});
	</script>
@endsection