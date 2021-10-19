@extends('modules.logisticCollaborators')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>MANUAL DE FUNCIONES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newHandbook-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessHandbook'))
				    <div class="alert alert-success">
				        {{ session('SuccessHandbook') }}
				    </div>
				@endif
				@if(session('PrimaryHandbook'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryHandbook') }}
				    </div>
				@endif
				@if(session('WarningHandbook'))
				    <div class="alert alert-warning">
				        {{ session('WarningHandbook') }}
				    </div>
				@endif
				@if(session('SecondaryHandbook'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryHandbook') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>CARGO</th>
					<th>NOMBRE DE DOCUMENTO</th>
					<th>CODIGO DE DOCUMENTO</th>
					<th>CONTENIDO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($handbooks as $handbook)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $handbook->position->pcoName }}</td>
					<td>{{ $handbook->document->dolName }}</td>
					<td>{{ $handbook->hcoDocumentcode }}</td>
					<td>
						@if(strlen($handbook->hcoContentfinal) > 20)
							{{ substr($handbook->hcoContentfinal,0,20) . ' ...' }}
						@else
							{{ $handbook->hcoContentfinal }}
						@endif
					</td>
					<td class="d-flex justofy-content-center">
						@if($handbook->hcoStatus != 'TERMINADO')
							<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editHandbook-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $handbook->hcoId }}</span>
								<span hidden>{{ $handbook->hcoDocument_id }}</span>
								<span hidden>{{ $handbook->hcoDocumentcode }}</span>
								<span hidden>{{ $handbook->document->dolVersion }}</span>
								<span hidden>{{ $handbook->position->pcoName }}</span>
								<span hidden>{{ $handbook->position->pcoObservation }}</span>
								<span hidden>{{ $handbook->hcoConfigdocument_id }}</span>
								<span hidden>{{ $handbook->hcoContentfinal }}</span>
								<span hidden>{{ $handbook->hcoWrited }}</span>
							</a>
							<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteHandbook-link">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $handbook->hcoId }}</span>
								<span hidden>{{ $handbook->document->dolName }}</span>
								<span hidden>{{ $handbook->hcoDocumentcode }}</span>
								<span hidden>{{ $handbook->document->dolVersion }}</span>
								<span hidden>{{ $handbook->position->pcoName }}</span>
								<span hidden>{{ $handbook->hcoContentfinal }}</span>
							</a>
						@endif
						<form action="{{ route('collaborators.hankbook.pdf') }}" method="GET" style="display: inline-block;">
							@csrf
							<input type="hidden" name="hcoId" value="{{ $handbook->hcoId }}" class="form-control form-control-sm" required>
							<button type="submit" title="Descargar PDF" class="bj-btn-table-pdf form-control-sm">
								<i class="fas fa-file-pdf"></i>
							</button>
						</form>
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

	<div class="modal fade" id="newHandbook-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVO MANUAL DE FUNCIONES:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.hankbook.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL CARGO:</small>
											<select name="hcoPosition_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($positions as $position)
													<option value="{{ $position->pcoId }}" data-observation="{{ $position->pcoObservation }}">{{ $position->pcoName }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">OBSERVACION DEL CARGO:</small>
											<textarea name="pcoObservation" class="form-control form-control-sm" rows="1" disabled></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="hcoDocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="dolVersion" class="form-control form-control-sm text-center" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONTENIDOS:</small>
											<select name="hcoConfigdocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="hcoTemplate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border hcoContentfinal" style="font-size: 12px;">
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="hcoVariables" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editHandbook-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE MANUAL DE FUNCIONES:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.hankbook.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL CARGO:</small>
											<input type="text" name="pcoName_Edit" class="form-control form-control-sm" readonly>
										</div>
										<div class="form-group">
											<small class="text-muted">OBSERVACION DEL CARGO:</small>
											<textarea name="pcoObservation_Edit" class="form-control form-control-sm" rows="1" disabled></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="hcoDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
											<input type="hidden" name="hcoDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly required>
											<input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONTENIDOS:</small>
											<select name="hcoConfigdocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="hcoTemplate_Edit" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border hcoContentfinal_Edit" style="font-size: 12px;">
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" name="hcoVariables_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="hcoId_Edit" readonly required>
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

	<div class="modal fade" id="deleteHandbook-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE MANUAL DE FUNCIONES:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">CARGO: </small><br>
							<span class="text-muted"><b class="pcoName_Delete"></b></span><br>
							<small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolName_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolCode_Delete"></b></span><br>
							<small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
							<small class="text-muted">CONTENIDO: </small><br>
							<span class="text-muted"><b class="hcoContentfinal_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('collaborators.hankbook.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="hcoId_Delete" readonly required>
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

		$('.newHandbook-link').on('click',function(){
			$('#newHandbook-modal').modal();
		});

		$('select[name=hcoPosition_id]').on('change',function(e){
			var selected = e.target.value;
			$('textarea[name=pcoObservation]').val('');
			if(selected != ''){
				var observation = $('select[name=hcoPosition_id] option:selected').attr('data-observation');
				$('textarea[name=pcoObservation]').val(observation);
			}
		});

		$('select[name=hcoDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion]').val('');
			$('input[name=dolCode]').val('');
			$('select[name=hcoConfigdocument_id]').empty();
			$('select[name=hcoConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
			$('div.hcoContentfinal').empty();
			if(selected != ''){
				var version = $('select[name=hcoDocument_id] option:selected').attr('data-version');
				var code = $('select[name=hcoDocument_id] option:selected').attr('data-code');
				$('input[name=dolVersion]').val(version);
				$.get("{{ route('getNextcodeFromDocument') }}",{dolId: selected},function(objectsNext){
					if(objectsNext != null){
						$('input[name=dolCode]').val(objectsNext);
					}else{
						$('input[name=dolCode]').val('');
					}
				});
				$.get("{{ route('getContentFromDocumentLogistic') }}",{dolId: selected},function(objectsConfig){
					var count = Object.keys(objectsConfig).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							if(objectsConfig[i]['cdlContent'].length > 100){
								var chain = objectsConfig[i]['cdlContent'].substring(0,100) + ' ...';
								$('select[name=hcoConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=hcoConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=hcoConfigdocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=hcoTemplate]').val('');
			$('div.hcoContentfinal').empty();
			if(selected != ''){
				var content = $('select[name=hcoConfigdocument_id] option:selected').attr('data-content');
				$('input[name=hcoTemplate]').val(content);
				$('div.hcoContentfinal').append(showContent(content));
			}
		});

		$('div.hcoContentfinal').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=hcoVariables]').val('');
			$('div.hcoContentfinal > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=hcoVariables]').val(all);
		});

		$('.editHandbook-link').on('click',function(e){
			e.preventDefault();
			var hcoId = $(this).find('span:nth-child(2)').text();
			var hcoDocument_id = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var pcoName = $(this).find('span:nth-child(6)').text();
			var pcoObservation = $(this).find('span:nth-child(7)').text();
			var hcoConfigdocument_id = $(this).find('span:nth-child(8)').text();
			var hcoContentfinal = $(this).find('span:nth-child(9)').text();
			var hcoWrited = $(this).find('span:nth-child(10)').text();
			$('input[name=hcoId_Edit]').val(hcoId);
			$('select[name=hcoDocument_id_Edit]').val(hcoDocument_id);
			$('input[name=dolCode_Edit]').val(dolCode);
			$('input[name=dolCode_hidden_Edit]').val(dolCode);
			$('input[name=dolVersion_Edit]').val(dolVersion);
			$('input[name=pcoName_Edit]').val(pcoName);
			$('textarea[name=pcoObservation_Edit]').val(pcoObservation);
			$('input[name=hcoVariables_Edit]').val(hcoWrited + '!!==¡¡');
			var contentAll = '';
			$('select[name=hcoConfigdocument_id_Edit]').empty();
			$('select[name=hcoConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('input[name=hcoDocument_id_hidden_Edit]').val(hcoDocument_id);
			$.get("{{ route('getContentFromDocumentLogistic') }}",{dolId: hcoDocument_id},function(objectsConfig){
				var count = Object.keys(objectsConfig).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectsConfig[i]['cdlContent'].length > 100){
							var chain = objectsConfig[i]['cdlContent'].substring(0,100) + ' ...';
							if(hcoConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
								);
								$('input[name=hcoTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.hcoContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}	
						}else{
							if(hcoConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
								$('input[name=hcoTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.hcoContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}	
						}
					}
					var separatedVariables = hcoWrited.split("!!==¡¡");
					var item;
					for (var i = 0; i < separatedVariables.length; i++) {
						item = separatedVariables[i].split('=>');
						$('div.hcoContentfinal_Edit > .field-dinamic').each(function(){
							var value = $(this).val();
							if(value == ''){
								$(this).val(item[0]);
								return false;
							}
						});
					}
					$('#editHandbook-modal').modal();
				}
			});	
		});

		$('select[name=hcoPosition_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('textarea[name=pcoObservation_Edit]').val('');
			if(selected != ''){
				var observation = $('select[name=hcoPosition_id_Edit] option:selected').attr('data-observation');
				$('textarea[name=pcoObservation_Edit]').val(observation);
			}
		});

		$('select[name=hcoDocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion_Edit]').val('');
			$('input[name=dolCode_Edit]').val('');
			$('select[name=hcoConfigdocument_id_Edit]').empty();
			$('select[name=hcoConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('div.hcoContentfinal_Edit').empty();
			if(selected != ''){
				var version = $('select[name=hcoDocument_id_Edit] option:selected').attr('data-version');
				var code = $('select[name=hcoDocument_id_Edit] option:selected').attr('data-code');
				var dolId = $('input[name=hcoDocument_id_hidden_Edit]').val();
				$('input[name=dolVersion_Edit]').val(version);
				if(selected == dolId){
					$('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
				}else{
					$.get("{{ route('getNextcodeFromDocument') }}",{dolId: selected},function(objectsNext){
						if(objectsNext != null){
							$('input[name=dolCode_Edit]').val(objectsNext);
						}else{
							$('input[name=dolCode_Edit]').val('');
						}
					});
				}
				$.get("{{ route('getContentFromDocumentLogistic') }}",{dolId: selected},function(objectsConfig){
					var count = Object.keys(objectsConfig).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							if(objectsConfig[i]['cdlContent'].length > 50){
								var chain = objectsConfig[i]['cdlContent'].substring(0,50) + ' ...';
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=hcoConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=hcoConfigdocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=hcoTemplate_Edit]').val('');
			$('div.hcoContentfinal_Edit').empty();
			if(selected != ''){
				var content = $('select[name=hcoConfigdocument_id_Edit] option:selected').attr('data-content');
				$('input[name=hcoTemplate_Edit]').val(content);
				$('div.hcoContentfinal_Edit').append(showContent(content));
			}
		});

		$('div.hcoContentfinal_Edit').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=hcoVariables_Edit]').val('');
			$('div.hcoContentfinal_Edit > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=hcoVariables_Edit]').val(all);
		});

		$('.deleteHandbook-link').on('click',function(e){
			e.preventDefault();
			var hcoId = $(this).find('span:nth-child(2)').text();
			var dolName = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var pcoName = $(this).find('span:nth-child(6)').text();
			var hcoContentfinal = $(this).find('span:nth-child(7)').text();
			$('input[name=hcoId_Delete]').val(hcoId);
			$('b.dolName_Delete').text(dolName);
			$('b.dolCode_Delete').text(dolCode);
			$('b.dolVersion_Delete').text(dolVersion);
			$('b.pcoName_Delete').text(pcoName);
			$('b.hcoContentfinal_Delete').text(hcoContentfinal);
			$('#deleteHandbook-modal').modal();
		});

		function showContent(content){
			const text = /¡¡¡texto dinámico!!!/g;
			const number = /¡¡¡número dinámico!!!/g;
			const money = /¡¡¡moneda dinámica!!!/g;
			const calendar = /¡¡¡calendario dinámico!!!/g;
			var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
			var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='20' pattern='[0-9]{1,10}' placeholder='Campo de número' required>");
			var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
			var element =  newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
			return element;
		}
	</script>
@endsection