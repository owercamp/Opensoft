@extends('modules.integralCommercial')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CONFIGURACION DE DOCUMENTOS</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newDocument-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessDocument'))
				    <div class="alert alert-success">
				        {{ session('SuccessDocument') }}
				    </div>
				@endif
				@if(session('PrimaryDocument'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryDocument') }}
				    </div>
				@endif
				@if(session('WarningDocument'))
				    <div class="alert alert-warning">
				        {{ session('WarningDocument') }}
				    </div>
				@endif
				@if(session('SecondaryDocument'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryDocument') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>DOCUMENTO</th>
					<th>CONTENIDO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($configurations as $configuration)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $configuration->document->docName }}</td>
					<td>
						@if(strlen($configuration->cdoContent) > 50)
							{{ substr($configuration->cdoContent,0,50) . ' ... ' }}
						@else
							{{ $configuration->cdoContent }}
						@endif
					</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editDocument-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $configuration->cdoId }}</span>
							<span hidden>{{ $configuration->cdoDocument_id }}</span>
							<span hidden>{{ $configuration->cdoContent }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteDocument-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $configuration->cdoId }}</span>
							<span hidden>{{ $configuration->document->docName }}</span>
							<span hidden>{{ $configuration->cdoContent }}</span>
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

	<div class="modal fade" id="newDocument-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CONFIGURACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.configuration.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="cdoDocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione un documento ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">{{ $document->docName }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="docCode" class="form-control form-control-sm" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion" class="form-control form-control-sm" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-9">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="varId" class="form-control form-control-sm">
												<option value="">Seleccione ...</option>
												<!-- dinamics -->
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<br>
										<a href="#" class="bj-btn-table-add form-control-sm addVariable_new" title="Agregar Variable"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO:</small>
											<input type="text" name="varType" class="form-control form-control-sm" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="varLongitud" class="form-control form-control-sm" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
											<textarea name="cdoContent_example" rows="10" class="form-control form-control-sm text-justify" required></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTENIDO FINAL:</small>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 p-2 border cdoContent_final" style="font-size: 12px; text-align: justify;">
												
											</div>
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

	<div class="modal fade" id="editDocument-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE CONFIGURACION:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('commercial.configuration.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="cdoDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione un documento ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">{{ $document->docName }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="docCode_Edit" class="form-control form-control-sm" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion_Edit" class="form-control form-control-sm" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-9">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="varId_Edit" class="form-control form-control-sm">
												<option value="">Seleccione ...</option>
												<!-- dinamics -->
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<br>
										<a href="#" class="bj-btn-table-add form-control-sm addVariable_edit" title="Agregar Variable"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO:</small>
											<input type="text" name="varType_Edit" class="form-control form-control-sm" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="varLongitud_Edit" class="form-control form-control-sm" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
											<textarea name="cdoContent_example_Edit" rows="10" class="form-control form-control-sm text-justify" required></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTENIDO FINAL:</small>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 p-2 border cdoContent_final_Edit" style="font-size: 12px; text-align: justify;">
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="cdoId_Edit" readonly required>
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

	<div class="modal fade" id="deleteDocument-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CONFIGURACION:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="cdoDocument_Delete"></b></span><br>
							<small class="text-muted">CONTENIDO: </small><br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 p-2 border cdoContent_final_Delete" style="font-size: 12px; text-align: justify;">
							
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('commercial.configuration.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="cdoId_Delete" readonly required>
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

		$('.newDocument-link').on('click',function(){
			$('#newDocument-modal').modal();
		});

		$('textarea[name=cdoContent_example]').on('keyup',function(e){
			var writed = e.target.value;
			var contentFinal = showContent(writed);
			$('div.cdoContent_final').html(contentFinal);
		});

		$('select[name=cdoDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=docCode]').val('');
			$('input[name=docVersion]').val('');
			$('select[name=varId]').empty();
			$('select[name=varId]').append("<option value=''>Seleccione ...</option>");
			$('input[name=varType]').val('');
			$('input[name=varLongitud]').val('');
			if(selected != ''){
				var code = $('select[name=cdoDocument_id] option:selected').attr('data-code');
				var version = $('select[name=cdoDocument_id] option:selected').attr('data-version');
				$('input[name=docCode]').val(code);
				$('input[name=docVersion]').val(version);
				$.get("{{ route('getVariablesFromDocument') }}",{docId: selected},function(objectVariables){
					var count = Object.keys(objectVariables).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=varId]').append(
								"<option value='" + objectVariables[i]['varId'] + "' data-type='" + objectVariables[i]['varType'] + "' data-longitud='" + objectVariables[i]['varLongitud'] + "'>" +
									objectVariables[i]['varName'] +
								"</option>"
							);
						}
					}
				});
			}
		});

		$('select[name=varId]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=varType]').val('');
			$('input[name=varLongitud]').val('');
			if(selected != ''){
				var type = $('select[name=varId] option:selected').attr('data-type');
				var longitud = $('select[name=varId] option:selected').attr('data-longitud');
				$('input[name=varType]').val(type);
				$('input[name=varLongitud]').val(longitud);
			}
		});

		$('.addVariable_new').on('click',function(e){
			e.preventDefault();
			var selected = $('select[name=varId]').val();
			if(selected != ''){
				var type = $('select[name=varId] option:selected').attr('data-type');
				switch(type){
					case 'Texto':
						var add = "<input type='text' placeholder='Campo de texto' disabled>";
						var content_example = $('textarea[name=cdoContent_example]').val();
						$('textarea[name=cdoContent_example]').val(content_example + '¡¡¡Texto dinámico!!!');
						$('div.cdoContent_final').append(add);
					break;
					case 'Numérico':
						var add = "<input type='text' maxlength='2' pattern='[0-9]{1,2}' placeholder='Campo de número' disabled>";
						var content_example = $('textarea[name=cdoContent_example]').val();
						$('textarea[name=cdoContent_example]').val(content_example + '¡¡¡Número dinámico!!!');
						$('div.cdoContent_final').append(add);
					break;
					case 'Moneda':
						var add = "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' disabled>";
						var content_example = $('textarea[name=cdoContent_example]').val();
						$('textarea[name=cdoContent_example]').val(content_example + '¡¡¡Moneda dinámica!!!');
						$('div.cdoContent_final').append(add);
					break;
					case 'Calendario':
						var add = "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' disabled>";
						var content_example = $('textarea[name=cdoContent_example]').val();
						$('textarea[name=cdoContent_example]').val(content_example + '¡¡¡Calendario dinámico!!!');
						$('div.cdoContent_final').append(add);
					break;
				}
			}
		});

		$('.editDocument-link').on('click',function(e){
			e.preventDefault();
			var cdoId = $(this).find('span:nth-child(2)').text();
			var cdoDocument_id = $(this).find('span:nth-child(3)').text();
			var cdoContent = $(this).find('span:nth-child(4)').text();
			$('input[name=cdoId_Edit]').val(cdoId);
			$('select[name=cdoDocument_id_Edit]').val(cdoDocument_id);
			var code = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-code');
			var version = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-version');
			$('input[name=docCode_Edit]').val(code);
			$('input[name=docVersion_Edit]').val(version);
			$('select[name=varId_Edit]').empty();
			$('select[name=varId_Edit]').append("<option value=''>Seleccione ...</option>");
			$.get("{{ route('getVariablesFromDocument') }}",{docId: cdoDocument_id},function(objectVariables){
				var count = Object.keys(objectVariables).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						$('select[name=varId_Edit]').append(
							"<option value='" + objectVariables[i]['varId'] + "' data-type='" + objectVariables[i]['varType'] + "' data-longitud='" + objectVariables[i]['varLongitud'] + "'>" +
								objectVariables[i]['varName'] +
							"</option>"
						);
					}
				}
			});
			$('textarea[name=cdoContent_example_Edit]').val(cdoContent);
			var contentFinal = showContent(cdoContent);
			$('div.cdoContent_final_Edit').html(contentFinal);
			$('#editDocument-modal').modal();
		});

		$('textarea[name=cdoContent_example_Edit]').on('keyup',function(e){
			var writed = e.target.value;
			var contentFinal = showContent(writed);
			$('div.cdoContent_final_Edit').html(contentFinal);
		});

		$('select[name=cdoDocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=docCode_Edit]').val('');
			$('input[name=docVersion_Edit]').val('');
			$('select[name=varId_Edit]').empty();
			$('select[name=varId_Edit]').append("<option value=''>Seleccione ...</option>");
			$('input[name=varType_Edit]').val('');
			$('input[name=varLongitud_Edit]').val('');
			if(selected != ''){
				var code = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-code');
				var version = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-version');
				$('input[name=docCode_Edit]').val(code);
				$('input[name=docVersion_Edit]').val(version);
				$.get("{{ route('getVariablesFromDocument') }}",{docId: selected},function(objectVariables){
					var count = Object.keys(objectVariables).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=varId_Edit]').append(
								"<option value='" + objectVariables[i]['varId'] + "' data-type='" + objectVariables[i]['varType'] + "' data-longitud='" + objectVariables[i]['varLongitud'] + "'>" +
									objectVariables[i]['varName'] +
								"</option>"
							);
						}
					}
				});
			}
		});

		$('select[name=varId_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=varType_Edit]').val('');
			$('input[name=varLongitud_Edit]').val('');
			if(selected != ''){
				var type = $('select[name=varId_Edit] option:selected').attr('data-type');
				var longitud = $('select[name=varId_Edit] option:selected').attr('data-longitud');
				$('input[name=varType_Edit]').val(type);
				$('input[name=varLongitud_Edit]').val(longitud);
			}
		});

		$('.addVariable_edit').on('click',function(e){
			e.preventDefault();
			var selected = $('select[name=varId_Edit]').val();
			if(selected != ''){
				var type = $('select[name=varId_Edit] option:selected').attr('data-type');
				console.log(type);
				switch(type){
					case 'Texto':
						var add = "<input type='text' placeholder='Campo de texto' disabled>";
						var content_example = $('textarea[name=cdoContent_example_Edit]').val();
						$('textarea[name=cdoContent_example_Edit]').val(content_example + '¡¡¡Texto dinámico!!!');
						$('div.cdoContent_final_Edit').append(add);
					break;
					case 'Numérico':
						var add = "<input type='text' maxlength='2' pattern='[0-9]{1,2}' placeholder='Campo de número' disabled>";
						var content_example = $('textarea[name=cdoContent_example_Edit]').val();
						$('textarea[name=cdoContent_example_Edit]').val(content_example + '¡¡¡Número dinámico!!!');
						$('div.cdoContent_final_Edit').append(add);
					break;
					case 'Moneda':
						var add = "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' disabled>";
						var content_example = $('textarea[name=cdoContent_example_Edit]').val();
						$('textarea[name=cdoContent_example_Edit]').val(content_example + '¡¡¡Moneda dinámica!!!');
						$('div.cdoContent_final_Edit').append(add);
					break;
					case 'Calendario':
						var add = "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' disabled>";
						var content_example = $('textarea[name=cdoContent_example_Edit]').val();
						$('textarea[name=cdoContent_example_Edit]').val(content_example + '¡¡¡Calendario dinámico!!!');
						$('div.cdoContent_final_Edit').append(add);
					break;
				}
			}
		});

		function showContent(writed){
			const text = /¡¡¡Texto dinámico!!!/gi;
			const number = /¡¡¡Número dinámico!!!/gi;
			const money = /¡¡¡Moneda dinámica!!!/gi;
			const calendar = /¡¡¡Calendario dinámico!!!/gi;
			var newTexto = writed.replace(text, "<input type='text' placeholder='Campo de texto' disabled>");
			var newNumber = newTexto.replace(number, "<input type='text' maxlength='2' pattern='[0-9]{1,2}' placeholder='Campo de número' disabled>");
			var newMoney = newNumber.replace(money, "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' disabled>");
			var element =  newMoney.replace(calendar, "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' disabled>");
			return element;
		}

		$('.deleteDocument-link').on('click',function(e){
			e.preventDefault();
			var cdoId = $(this).find('span:nth-child(2)').text();
			var cdoDocument = $(this).find('span:nth-child(3)').text();
			var cdoContent = $(this).find('span:nth-child(4)').text();
			$('input[name=cdoId_Delete]').val(cdoId);
			$('b.cdoDocument_Delete').text(cdoDocument);
			var contentFinal = showContent(cdoContent);
			$('div.cdoContent_final_Delete').html(contentFinal);
			$('#deleteDocument-modal').modal();
		});
	</script>
@endsection