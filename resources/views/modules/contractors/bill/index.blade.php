@extends('modules.logisticContractors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>MINUTA DE CONTRATO</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="REGISTRAR NUEVO CONTRATO" class="bj-btn-table-add form-control-sm newBill-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
				@if(session('SuccessBill'))
				    <div class="alert alert-success">
				        {{ session('SuccessBill') }}
				    </div>
				@endif
				@if(session('PrimaryBill'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryBill') }}
				    </div>
				@endif
				@if(session('WarningBill'))
				    <div class="alert alert-warning">
				        {{ session('WarningBill') }}
				    </div>
				@endif
				@if(session('SecondaryBill'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryBill') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>TIPO</th>
					<th>CONTRATISTA</th>
					<th>CODIGO DE MINUTA</th>
					<th>CONTENIDO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($bills as $bill)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $bill->bcTypecontractor }}</td>
					<td>
						@if($bill->bcTypecontractor == 'MENSAJERIA')
							{{ $bill->messenger->cmNames }}
						@elseif($bill->bcTypecontractor == 'CARGA EXPRESS')
							{{ $bill->charge->ccNames }}
						@elseif($bill->bcTypecontractor == 'SERVICIO ESPECIAL')
							{{ $bill->especial->ceNames }}
						@endif
					</td>
					<td>{{ $bill->bcDocumentcode }}</td>
					<td>
						@if(strlen($bill->bcContentfinal) > 20)
							{{ substr($bill->bcContentfinal,0,20) . ' ...' }}
						@else
							{{ $bill->bcContentfinal }}
						@endif
					</td>
					<td class="d-flex justofy-content-center">
						@if($bill->bcStatus != 'TERMINADO')
							<a href="#" title="EDITAR CONTRATO" class="bj-btn-table-edit form-control-sm editBill-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $bill->bcId }}</span>
								<span hidden>{{ $bill->bcDocument_id }}</span>
								<span hidden>{{ $bill->bcDocumentcode }}</span>
								<span hidden>{{ $bill->document->dolVersion }}</span>
								<span hidden>{{ $bill->bcTypecontractor }}</span>
								@if($bill->bcTypecontractor == 'MENSAJERIA')
									<span hidden>{{ $bill->messenger->cmNames }}</span>
									<span hidden>{{ $bill->messenger->cmNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'CARGA EXPRESS')
									<span hidden>{{ $bill->charge->ccNames }}</span>
									<span hidden>{{ $bill->charge->ccNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'SERVICIO ESPECIAL')
									<span hidden>{{ $bill->especial->ceNames }}</span>
									<span hidden>{{ $bill->especial->ceNumberdocument }}</span>
								@endif
								<span hidden>{{ $bill->bcConfigdocument_id }}</span>
								<span hidden>{{ $bill->bcContentfinal }}</span>
								<span hidden>{{ $bill->bcWrited }}</span>
							</a>
							<a href="#" title="RECHAZAR CONTRATO" class="bj-btn-table-delete form-control-sm deleteBill-link">
								<i class="fas fa-times"></i>
								<span hidden>{{ $bill->bcId }}</span>
								<span hidden>{{ $bill->bcDocumentcode }}</span>
								<span hidden>{{ $bill->document->dolVersion }}</span>
								<span hidden>{{ $bill->bcTypecontractor }}</span>
								@if($bill->bcTypecontractor == 'MENSAJERIA')
									<span hidden>{{ $bill->messenger->cmNames }}</span>
									<span hidden>{{ $bill->messenger->cmNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'CARGA EXPRESS')
									<span hidden>{{ $bill->charge->ccNames }}</span>
									<span hidden>{{ $bill->charge->ccNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'SERVICIO ESPECIAL')
									<span hidden>{{ $bill->especial->ceNames }}</span>
									<span hidden>{{ $bill->especial->ceNumberdocument }}</span>
								@endif
								<span hidden>{{ $bill->bcContentfinal }}</span>
							</a>
							<form action="{{ route('contractors.bill.aproved') }}" method="POST" style="display: inline-block;">
								@csrf
								<input type="hidden" name="bcId" value="{{ $bill->bcId }}" class="form-control form-control-sm" required>
								<button type="submit" title="APROBAR CONTRATO" class="bj-btn-table-add form-control-sm">
									<i class="fas fa-plus"></i>
								</button>
							</form>
							<form action="{{ route('contractors.bill.pdf') }}" method="GET" style="display: inline-block;">
								@csrf
								<input type="hidden" name="bcId" value="{{ $bill->bcId }}" class="form-control form-control-sm" required>
								<button type="submit" title="DESCARGAR PDF" class="bj-btn-table-pdf form-control-sm">
									<i class="fas fa-file-pdf"></i>
								</button>
							</form>
						@endif
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

	<div class="modal fade" id="newBill-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA MINUTA DE CONTRATO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.bill.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE CONTRATISTA:</small>
											<select name="bcTypecontractor" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="MENSAJERIA">MENSAJERIA</option>
												<option value="CARGA EXPRESS">CARGA EXPRESS</option>
												<option value="SERVICIO ESPECIAL">SERVICIO ESPECIAL</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 sectionAll-selects">
										<div class="row section-messenger" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE MENSAJERIA:</small>
													<select name="bcContractormessenger_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractormessengers as $contractormessenger)
															<option value="{{ $contractormessenger->cmId }}">{{ $contractormessenger->cmNames }}</option>
														@endforeach
													</select>
												</div>	
											</div>
										</div>
										<div class="row section-charge" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE CARGA EXPRESS:</small>
													<select name="bcContractorcharge_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractorcharges as $contractorcharge)
															<option value="{{ $contractorcharge->ccId }}">{{ $contractorcharge->ccNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row section-especial" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE SERVICIO ESPECIAL:</small>
													<select name="bcContractorespecial_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractorespecials as $contractorespecial)
															<option value="{{ $contractorespecial->ceId }}">{{ $contractorespecial->ceNames }}</option>
														@endforeach
													</select>
												</div>	
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="bcDocument_id" class="form-control form-control-sm" required>
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
											<input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONTENIDOS:</small>
											<select name="bcConfigdocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="bcTemplate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border bcContentfinal" style="font-size: 12px;">
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="bcVariables" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editBill-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE MINUTA:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.bill.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE CONTRATISTA:</small>
											<input type="text" name="bcTypecontractor_Edit" class="form-control form-control-sm" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CONTRATISTA:</small>
											<input type="text" name="contractorname_Edit" class="form-control form-control-sm" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="numbercontractor_Edit" class="form-control form-control-sm" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="bcDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
											<input type="hidden" name="bcDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
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
											<select name="bcConfigdocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
											<input type="hidden" name="bcTemplate_Edit" class="form-control form-control-sm" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-12 p-2 border bcContentfinal_Edit" style="font-size: 12px;">
														
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
								<input type="hidden" name="bcVariables_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="bcId_Edit" readonly required>
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

	<div class="modal fade" id="deleteBill-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE MINUTA:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">TIPO DE CONTRATISTA: </small><br>
							<span class="text-muted"><b class="bcTypecontractor_Delete"></b></span><br>
							<small class="text-muted">CONTRATISTA: </small><br>
							<span class="text-muted"><b class="contractorname_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE IDENTIFICACION: </small><br>
							<span class="text-muted"><b class="numbercontractor_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE MINUTA: </small><br>
							<span class="text-muted"><b class="bcDocumentcode_Delete"></b></span><br>
							<small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
							<small class="text-muted">CONTENIDO: </small><br>
							<span class="text-muted"><b class="bcContentfinal_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('contractors.bill.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="bcId_Delete" readonly required>
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

		$('.newBill-link').on('click',function(){
			$('#newBill-modal').modal();
		});

		$('select[name=bcTypecontractor]').on('change',function(e){
			var selected = e.target.value;
			if(selected != ''){
				if(selected == 'MENSAJERIA'){
					$('div.section-messenger').css('display','flex');
					$('div.section-messenger select').attr('disabled',false);
					$('div.section-messenger select').attr('required',true);
					$('div.section-messenger select').val('');
					$('div.section-charge').css('display','none');
					$('div.section-charge select').attr('disabled',true);
					$('div.section-charge select').attr('required',false);
					$('div.section-charge select').val('');
					$('div.section-especial').css('display','none');
					$('div.section-especial select').attr('disabled',true);
					$('div.section-especial select').attr('required',false);
					$('div.section-especial select').val('');
				}else if(selected == 'CARGA EXPRESS'){
					$('div.section-messenger').css('display','none');
					$('div.section-messenger select').attr('disabled',true);
					$('div.section-messenger select').attr('required',false);
					$('div.section-messenger select').val('');
					$('div.section-charge').css('display','flex');
					$('div.section-charge select').attr('disabled',false);
					$('div.section-charge select').attr('required',true);
					$('div.section-charge select').val('');
					$('div.section-especial').css('display','none');
					$('div.section-especial select').attr('disabled',true);
					$('div.section-especial select').attr('required',false);
					$('div.section-especial select').val('');
				}else if(selected == 'SERVICIO ESPECIAL'){
					$('div.section-messenger').css('display','none');
					$('div.section-messenger select').attr('disabled',true);
					$('div.section-messenger select').attr('required',false);
					$('div.section-messenger select').val('');
					$('div.section-charge').css('display','none');
					$('div.section-charge select').attr('disabled',true);
					$('div.section-charge select').attr('required',false);
					$('div.section-charge select').val('');
					$('div.section-especial').css('display','flex');
					$('div.section-especial select').attr('disabled',false);
					$('div.section-especial select').attr('required',true);
					$('div.section-especial select').val('');
				}
			}
		});

		$('select[name=bcDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion]').val('');
			$('input[name=dolCode]').val('');
			$('select[name=bcConfigdocument_id]').empty();
			$('select[name=bcConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
			$('div.bcoContentfinal').empty();
			if(selected != ''){
				var version = $('select[name=bcDocument_id] option:selected').attr('data-version');
				var code = $('select[name=bcDocument_id] option:selected').attr('data-code');
				$('input[name=dolVersion]').val(version);
				$.get("{{ route('getNextcodeForBillContractor') }}",{dolId: selected},function(objectsNext){
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
								$('select[name=bcConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=bcConfigdocument_id]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=bcConfigdocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=bcTemplate]').val('');
			$('div.bcContentfinal').empty();
			if(selected != ''){
				var content = $('select[name=bcConfigdocument_id] option:selected').attr('data-content');
				$('input[name=bcTemplate]').val(content);
				$('div.bcContentfinal').append(showContent(content));
			}
		});

		$('div.bcContentfinal').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=bcVariables]').val('');
			$('div.bcContentfinal > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=bcVariables]').val(all);
		});

		$('.editBill-link').on('click',function(e){
			e.preventDefault();
			var bcId = $(this).find('span:nth-child(2)').text();
			var bcDocument_id = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var bcTypecontractor = $(this).find('span:nth-child(6)').text();
			var contractor = $(this).find('span:nth-child(7)').text();
			var numbercontractor = $(this).find('span:nth-child(8)').text();
			var bcConfigdocument_id = $(this).find('span:nth-child(9)').text();
			var bcContentfinal = $(this).find('span:nth-child(10)').text();
			var bcWrited = $(this).find('span:nth-child(11)').text();
			$('input[name=bcId_Edit]').val(bcId);
			$('select[name=bcDocument_id_Edit]').val(bcDocument_id);
			$('input[name=dolCode_Edit]').val(dolCode);
			$('input[name=dolCode_hidden_Edit]').val(dolCode);
			$('input[name=dolVersion_Edit]').val(dolVersion);
			$('input[name=bcTypecontractor_Edit]').val(bcTypecontractor);
			$('input[name=contractorname_Edit]').val(contractor);
			$('input[name=numbercontractor_Edit]').val(numbercontractor);
			$('input[name=bcVariables_Edit]').val(bcWrited + '!!==¡¡');
			var contentAll = '';
			$('select[name=bcConfigdocument_id_Edit]').empty();
			$('select[name=bcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('input[name=bcDocument_id_hidden_Edit]').val(bcDocument_id);
			$.get("{{ route('getContentFromDocumentLogistic') }}",{dolId: bcDocument_id},function(objectsConfig){
				var count = Object.keys(objectsConfig).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectsConfig[i]['cdlContent'].length > 100){
							var chain = objectsConfig[i]['cdlContent'].substring(0,100) + ' ...';
							if(bcConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
								);
								$('input[name=bcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.bcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}	
						}else{
							if(bcConfigdocument_id == objectsConfig[i]['cdlId']){
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
								$('input[name=bcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
								$('div.bcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
							}else{
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}	
						}
					}
					var separatedVariables = bcWrited.split("!!==¡¡");
					var item;
					for (var i = 0; i < separatedVariables.length; i++) {
						item = separatedVariables[i].split('=>');
						$('div.bcContentfinal_Edit > .field-dinamic').each(function(){
							var value = $(this).val();
							if(value == ''){
								$(this).val(item[0]);
								return false;
							}
						});
					}
					$('#editBill-modal').modal();
				}
			});	
		});

		$('select[name=bcDocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion_Edit]').val('');
			$('input[name=dolCode_Edit]').val('');
			$('select[name=bcConfigdocument_id_Edit]').empty();
			$('select[name=bcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
			$('div.bcContentfinal_Edit').empty();
			if(selected != ''){
				var version = $('select[name=bcDocument_id_Edit] option:selected').attr('data-version');
				var code = $('select[name=bcDocument_id_Edit] option:selected').attr('data-code');
				var dolId = $('input[name=bcDocument_id_hidden_Edit]').val();
				$('input[name=dolVersion_Edit]').val(version);
				if(selected == dolId){
					$('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
				}else{
					$.get("{{ route('getNextcodeForBillContractor') }}",{dolId: selected},function(objectsNext){
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
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
								);
							}else{
								$('select[name=bcConfigdocument_id_Edit]').append(
									"<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
								);
							}
						}
					}
				});
			}
		});

		$('select[name=bcConfigdocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=bcTemplate_Edit]').val('');
			$('div.bcContentfinal_Edit').empty();
			if(selected != ''){
				var content = $('select[name=bcConfigdocument_id_Edit] option:selected').attr('data-content');
				$('input[name=bcTemplate_Edit]').val(content);
				$('div.bcContentfinal_Edit').append(showContent(content));
			}
		});

		$('div.bcContentfinal_Edit').on('keyup change','.field-dinamic',function(){
			var value = $(this).val();
			var element = $(this);
			var type = $(this).attr('data-type');
			var all = '';
			$('input[name=bcVariables_Edit]').val('');
			$('div.bcContentfinal_Edit > .field-dinamic').each(function(){
				var value = $(this).val();
				var type = $(this).attr('data-type');
				if(value != ''){
					all += value + '=>' + type + '!!==¡¡';
				}else{
					all += 'NOT!!==¡¡';
				}
			});
			$('input[name=bcVariables_Edit]').val(all);
		});

		$('.deleteBill-link').on('click',function(e){
			e.preventDefault();
			var bcId = $(this).find('span:nth-child(2)').text();
			var bcDocumentcode = $(this).find('span:nth-child(3)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var bcTypecontractor = $(this).find('span:nth-child(5)').text();
			var contractor = $(this).find('span:nth-child(6)').text();
			var numbercontractor = $(this).find('span:nth-child(7)').text();
			var bcContentfinal = $(this).find('span:nth-child(8)').text();
			$('input[name=bcId_Delete]').val(bcId);
			$('b.bcTypecontractor_Delete').text(bcTypecontractor);
			$('b.contractorname_Delete').text(contractor);
			$('b.numbercontractor_Delete').text(numbercontractor);
			$('b.bcDocumentcode_Delete').text(bcDocumentcode);
			$('b.dolVersion_Delete').text(dolVersion);
			$('b.bcContentfinal_Delete').text(bcContentfinal);
			$('#deleteBill-modal').modal();
		});

		function showContent(content){
			const text = /¡¡¡texto dinámico!!!/g;
			const number = /¡¡¡número dinámico!!!/g;
			const money = /¡¡¡moneda dinámica!!!/g;
			const calendar = /¡¡¡calendario dinámico!!!/g;
			var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
			var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='20' pattern='[0-9]{1,20}' placeholder='Campo de número' required>");
			var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
			var element =  newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
			return element;
		}
	</script>
@endsection