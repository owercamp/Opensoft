@extends('modules.integralCommercial')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CREACION DE DOCUMENTOS</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newCreation-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessCreation'))
				    <div class="alert alert-success">
				        {{ session('SuccessCreation') }}
				    </div>
				@endif
				@if(session('PrimaryCreation'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryCreation') }}
				    </div>
				@endif
				@if(session('WarningCreation'))
				    <div class="alert alert-warning">
				        {{ session('WarningCreation') }}
				    </div>
				@endif
				@if(session('SecondaryCreation'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryCreation') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE DOCUMENTO</th>
					<th>CODIGO</th>
					<th>VERSION</th>
					<th>FECHA DE ACTUALIZACION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($documents as $document)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $document->docName }}</td>
					<td>{{ $document->docCode }}</td>
					<td>{{ $document->docVersion }}</td>
					<td>{{ $document->docDate }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editCreation-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $document->docId }}</span>
							<span hidden>{{ $document->docName }}</span>
							<span hidden>{{ $document->docCode }}</span>
							<span hidden>{{ $document->docVersion }}</span>
							<span hidden>{{ $document->docDate }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteCreation-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $document->docId }}</span>
							<span hidden>{{ $document->docName }}</span>
							<span hidden>{{ $document->docCode }}</span>
							<span hidden>{{ $document->docVersion }}</span>
							<span hidden>{{ $document->docDate }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@php
		$yearnow = date('Y');
		$mountnow = date('m');
		$yearfutureOne = date('Y') + 1;
		$yearfutureTwo = date('Y') + 2;
		$yearfutureThree = date('Y') + 3;
		$yearfutureFour = date('Y') + 4;
		$yearfutureFive = date('Y') + 5;
		$yearfutureSix = date('Y') + 6;
		$yearfutureSeven = date('Y') + 7;
	@endphp

	<div class="modal fade" id="newCreation-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CREACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.document.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<input type="text" name="docName" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONFIGURACION CODIGO:</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_one" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_two" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_three" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FECHA DE ACTUALIZACION:</small>
											<input type="text" name="docDate" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editCreation-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.document.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<input type="text" name="docName_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONFIGURACION CODIGO:</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_one_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_two_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="docCode_three_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FECHA DE ACTUALIZACION:</small>
											<input type="text" name="docDate_Edit" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="docId_Edit" readonly required>
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

	<div class="modal fade" id="deleteCreation-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="docName_Delete"></b></span><br>
							<small class="text-muted">CODIGO: </small><br>
							<span class="text-muted"><b class="docCode_Delete"></b></span><br>
							<small class="text-muted">VERSION: </small><br>
							<span class="text-muted"><b class="docVersion_Delete"></b></span><br>
							<small class="text-muted">FECHA DE ACTUALIZACION: </small><br>
							<span class="text-muted"><b class="docDate_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('commercial.document.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="docId_Delete" readonly required>
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

		$('.newCreation-link').on('click',function(){
			$('#newCreation-modal').modal();
		});

		$('.editCreation-link').on('click',function(e){
			e.preventDefault();
			var docId = $(this).find('span:nth-child(2)').text();
			var docName = $(this).find('span:nth-child(3)').text();
			var docCode = $(this).find('span:nth-child(4)').text();
			var docVersion = $(this).find('span:nth-child(5)').text();
			var docDate = $(this).find('span:nth-child(6)').text();
			$('input[name=docId_Edit]').val(docId);
			$('input[name=docName_Edit]').val(docName);
			var separatedCode = docCode.split('-');
			$('input[name=docCode_one_Edit]').val(separatedCode[0]);
			$('input[name=docCode_two_Edit]').val(separatedCode[1]);
			$('input[name=docCode_three_Edit]').val(separatedCode[2]);
			$('input[name=docVersion_Edit]').val(docVersion);
			$('input[name=docDate_Edit]').val(docDate);
			$('#editCreation-modal').modal();
		});

		$('.deleteCreation-link').on('click',function(e){
			e.preventDefault();
			var docId = $(this).find('span:nth-child(2)').text();
			var docName = $(this).find('span:nth-child(3)').text();
			var docCode = $(this).find('span:nth-child(4)').text();
			var docVersion = $(this).find('span:nth-child(5)').text();
			var docDate = $(this).find('span:nth-child(6)').text();
			$('input[name=docId_Delete]').val(docId);
			$('b.docName_Delete').text(docName);
			$('b.docCode_Delete').text(docCode);
			$('b.docVersion_Delete').text(docVersion);
			$('b.docDate_Delete').text(docDate);
			$('#deleteCreation-modal').modal();
		});
	</script>
@endsection