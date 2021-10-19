@extends('modules.integralCommercial')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CREACION DE VARIABLES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newVariable-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessVariable'))
				    <div class="alert alert-success">
				        {{ session('SuccessVariable') }}
				    </div>
				@endif
				@if(session('PrimaryVariable'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryVariable') }}
				    </div>
				@endif
				@if(session('WarningVariable'))
				    <div class="alert alert-warning">
				        {{ session('WarningVariable') }}
				    </div>
				@endif
				@if(session('SecondaryVariable'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryVariable') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE VARIABLE</th>
					<th>TIPO DE VARIABLE</th>
					<th>LONGITUD DE VARIABLE</th>
					<th>DOCUMENTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($variables as $variable)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $variable->varName }}</td>
					<td>{{ $variable->varType }}</td>
					<td>{{ $variable->varLongitud }}</td>
					<td>{{ $variable->document->docName }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editVariable-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $variable->varId }}</span>
							<span hidden>{{ $variable->varName }}</span>
							<span hidden>{{ $variable->varType }}</span>
							<span hidden>{{ $variable->varLongitud }}</span>
							<span hidden>{{ $variable->varDocument_id }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteVariable-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $variable->varId }}</span>
							<span hidden>{{ $variable->varName }}</span>
							<span hidden>{{ $variable->varType }}</span>
							<span hidden>{{ $variable->varLongitud }}</span>
							<span hidden>{{ $variable->document->docName }}</span>
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

	<div class="modal fade" id="newVariable-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CREACION DE VARIABLE:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.variable.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="varDocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->docId }}">{{ $document->docName }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">NOMBRE DE VARIABLE:</small>
											<input type="text" name="varName" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="varType" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="Texto">Texto</option>
												<option value="Numérico">Numérico</option>
												<option value="Moneda">Moneda</option>
												<option value="Calendario">Calendario</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="varLongitud" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
										</div>
									</div>
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

	<div class="modal fade" id="editVariable-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE VARIABLE:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.variable.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="varDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->docId }}">{{ $document->docName }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">NOMBRE DE VARIABLE:</small>
											<input type="text" name="varName_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="varType_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="Texto">Texto</option>
												<option value="Numérico">Numérico</option>
												<option value="Moneda">Moneda</option>
												<option value="Calendario">Calendario</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="varLongitud_Edit" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="varId_Edit" readonly required>
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

	<div class="modal fade" id="deleteVariable-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE VARIABLE:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE VARIABLE: </small><br>
							<span class="text-muted"><b class="varName_Delete"></b></span><br>
							<small class="text-muted">TIPO DE VARIABLE: </small><br>
							<span class="text-muted"><b class="varType_Delete"></b></span><br>
							<small class="text-muted">LONGITUD DE VARIABLE: </small><br>
							<span class="text-muted"><b class="varLongitud_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="varDocument_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('commercial.variable.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="varId_Delete" readonly required>
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

		$('.newVariable-link').on('click',function(){
			$('#newVariable-modal').modal();
		});

		$('.editVariable-link').on('click',function(e){
			e.preventDefault();
			var varId = $(this).find('span:nth-child(2)').text();
			var varName = $(this).find('span:nth-child(3)').text();
			var varType = $(this).find('span:nth-child(4)').text();
			var varLongitud = $(this).find('span:nth-child(5)').text();
			var varDocument_id = $(this).find('span:nth-child(6)').text();
			$('input[name=varId_Edit]').val(varId);
			$('input[name=varName_Edit]').val(varName);
			$('select[name=varType_Edit]').val(varType);
			$('input[name=varLongitud_Edit]').val(varLongitud);
			$('select[name=varDocument_id_Edit]').val(varDocument_id);
			$('#editVariable-modal').modal();
		});

		$('.deleteVariable-link').on('click',function(e){
			e.preventDefault();
			var varId = $(this).find('span:nth-child(2)').text();
			var varName = $(this).find('span:nth-child(3)').text();
			var varType = $(this).find('span:nth-child(4)').text();
			var varLongitud = $(this).find('span:nth-child(5)').text();
			var varDocument_id = $(this).find('span:nth-child(6)').text();
			$('input[name=varId_Delete]').val(varId);
			$('b.varName_Delete').text(varName);
			$('b.varType_Delete').text(varType);
			$('b.varLongitud_Delete').text(varLongitud);
			$('b.varDocument_Delete').text(varDocument_id);
			$('#deleteVariable-modal').modal();
		});
	</script>
@endsection