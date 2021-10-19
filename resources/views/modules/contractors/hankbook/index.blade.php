@extends('modules.logisticContractors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>MANUAL DE FUNCIONES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newHandbook-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
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
					<td>{{ $handbook->document->dolName }}</td>
					<td>{{ $handbook->hcDocumentcode }}</td>
					<td>
						@if(strlen($handbook->hcContentfinal) > 20)
							{{ substr($handbook->hcContentfinal,0,20) . ' ...' }}
						@else
							{{ $handbook->hcContentfinal }}
						@endif
					</td>
					<td class="d-flex justofy-content-center">
						@if($handbook->hcStatus != 'TERMINADO')
							<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editHandbook-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $handbook->hcId }}</span>
								<span hidden>{{ $handbook->hcDocument_id }}</span>
								<span hidden>{{ $handbook->hcDocumentcode }}</span>
								<span hidden>{{ $handbook->document->dolVersion }}</span>
								<span hidden>{{ $handbook->hcConfigdocument_id }}</span>
								<span hidden>{{ $handbook->hcContentfinal }}</span>
								<span hidden>{{ $handbook->hcWrited }}</span>
							</a>
							<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteHandbook-link">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $handbook->hcId }}</span>
								<span hidden>{{ $handbook->document->dolName }}</span>
								<span hidden>{{ $handbook->hcDocumentcode }}</span>
								<span hidden>{{ $handbook->document->dolVersion }}</span>
								<span hidden>{{ $handbook->hcContentfinal }}</span>
							</a>
						@endif
						<form action="{{ route('contractors.handbook.pdf') }}" method="GET" style="display: inline-block;">
							@csrf
							<input type="hidden" name="hcId" value="{{ $handbook->hcId }}" class="form-control form-control-sm" required>
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
					<form action="{{ route('contractors.handbook.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="hcDocument_id" class="form-control form-control-sm" required>
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
											<select name="hcConfigdocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="hcTemplate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border hcContentfinal" style="font-size: 12px;">
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="hcVariables" class="form-control form-control-sm" readonly required>
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
					<form action="{{ route('contractors.handbook.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="hcDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
											<input type="hidden" name="hcDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
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
											<select name="hcConfigdocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="hcTemplate_Edit" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border hcContentfinal_Edit" style="font-size: 12px;">
														
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
								<input type="hidden" name="hcVariables_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="hcId_Edit" readonly required>
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
							<small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolName_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolCode_Delete"></b></span><br>
							<small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
							<small class="text-muted">CONTENIDO: </small><br>
							<span class="text-muted"><b class="hcContentfinal_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('contractors.handbook.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="hcId_Delete" readonly required>
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

		$('select[name=hcDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion]').val('');
			$('input[name=dolCode]').val('');
			$('select[name=hcConfigdocument_id]').empty();
			$('select[name=hcConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
			$('div.hcContentfinal').empty();
			if(selected != ''){
				var version = $('select[name=hcDocument_id] option:selected').attr('data-version');
				var code = $('select[name=hcDocument_id] option:selected').attr('data-code');
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
								$('select[name=hcConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=hcConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=hcConfigdocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=hcoTemplate]').val('');
			$('div.hcContentfinal').empty();
			if(selected != ''){
				var content = $('select[name=hcConfigdocument_id] option:selected').attr('data-content');
				$('input[name=hcTemplate]').val(content);
				$('div.hcContentfinal').append(showContent(content));
			}
		});

		$('div.hcContentfinal').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=hcVariables]').val('');
			$('div.hcContentfinal > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=hcVariables]').val(all);
		});

		$('.editHandbook-link').on('click',function(e){
			e.preventDefault();
			var hcId = $(this).find('span:nth-child(2)').text();
			var hcDocument_id = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var hcConfigdocument_id = $(this).find('span:nth-child(6)').text();
			var hcContentfinal = $(this).find('span:nth-child(7)').text();
			var hcWrited = $(this).find('span:nth-child(8)').text();
			$('input[name=hcId_Edit]').val(hcId);
			$('select[name=hcDocument_id_Edit]').val(hcDocument_id);
			$('input[name=dolCode_Edit]').val(dolCode);
			$('input[name=dolCode_hidden_Edit]').val(dolCode);
			$('input[name=dolVersion_Edit]').val(dolVersion);
			$('input[name=hcVariables_Edit]').val(hcWrited + '!!==¡¡');
			var contentAll = '';
			$('select[name=hcConfigdocument_id_Edit]').empty();
			$('select[name=hcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('input[name=hcDocument_id_hidden_Edit]').val(hcDocument_id);
			$.get("{{ route('getContentFromDocumentLogistic') }}",{dolId: hcDocument_id},function(objectsConfig){
				var count = Object.keys(objectsConfig).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectsConfig[i]['cdlContent'].length > 100){
							var chain = objectsConfig[i]['cdlContent'].substring(0,100) + ' ...';
							if(hcConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
								);
								$('input[name=hcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.hcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}	
						}else{
							if(hcConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
								$('input[name=hcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.hcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}	
						}
					}
					var separatedVariables = hcWrited.split("!!==¡¡");
					var item;
					for (var i = 0; i < separatedVariables.length; i++) {
						item = separatedVariables[i].split('=>');
						$('div.hcContentfinal_Edit > .field-dinamic').each(function(){
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

		$('select[name=hcDocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion_Edit]').val('');
			$('input[name=dolCode_Edit]').val('');
			$('select[name=hcConfigdocument_id_Edit]').empty();
			$('select[name=hcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('div.hcContentfinal_Edit').empty();
			if(selected != ''){
				var version = $('select[name=hcDocument_id_Edit] option:selected').attr('data-version');
				var code = $('select[name=hcDocument_id_Edit] option:selected').attr('data-code');
				var dolId = $('input[name=hcDocument_id_hidden_Edit]').val();
				$('input[name=dolVersion_Edit]').val(version);
				if(selected == dolId){
					$('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
				}else{
					$.get("{{ route('getNextcodeFromDocumentContractor') }}",{dolId: selected},function(objectsNext){
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
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=hcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=hcConfigdocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=hcTemplate_Edit]').val('');
			$('div.hcContentfinal_Edit').empty();
			if(selected != ''){
				var content = $('select[name=hcConfigdocument_id_Edit] option:selected').attr('data-content');
				$('input[name=hcTemplate_Edit]').val(content);
				$('div.hcContentfinal_Edit').append(showContent(content));
			}
		});

		$('div.hcContentfinal_Edit').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=hcVariables_Edit]').val('');
			$('div.hcContentfinal_Edit > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=hcVariables_Edit]').val(all);
		});

		$('.deleteHandbook-link').on('click',function(e){
			e.preventDefault();
			var hcId = $(this).find('span:nth-child(2)').text();
			var dolName = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var hcContentfinal = $(this).find('span:nth-child(6)').text();
			$('input[name=hcId_Delete]').val(hcId);
			$('b.dolName_Delete').text(dolName);
			$('b.dolCode_Delete').text(dolCode);
			$('b.dolVersion_Delete').text(dolVersion);
			$('b.hcContentfinal_Delete').text(hcContentfinal);
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