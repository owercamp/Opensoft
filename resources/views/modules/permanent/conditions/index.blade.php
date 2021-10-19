@extends('modules.comercialPermanentcontracts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CONDICIONES ECONOMICAS</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newTerm-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessTerm'))
				    <div class="alert alert-success">
				        {{ session('SuccessTerm') }}
				    </div>
				@endif
				@if(session('PrimaryTerm'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryTerm') }}
				    </div>
				@endif
				@if(session('WarningTerm'))
				    <div class="alert alert-warning">
				        {{ session('WarningTerm') }}
				    </div>
				@endif
				@if(session('SecondaryTerm'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryTerm') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%" style="font-size: 12px;">
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO DOCUMENTO</th>
					<th>CLIENTE</th>
					<th>VIGENCIA DE TARIFAS</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($terms as $term)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $term->legalization->document->docCode }}</td>
					<td>{{ $term->legalization->client->cliNamereason }}</td>
					<td>{{ 'DESDE ' . $term->terDateinitial . ' HASTA ' . $term->terDatefinal }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editTerm-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $term->terId }}</span>
							<span hidden>{{ $term->terLegalization_id }}</span>
							<span hidden>{{ $term->legalization->client->cliNamereason }}</span>
							<span hidden>{{ $term->legalization->client->cliNumberdocument }}</span>
							<span hidden>{{ $term->legalization->document->docName }}</span>
							<span hidden>{{ $term->legalization->document->docCode }}</span>
							<span hidden>{{ $term->legalization->document->docVersion }}</span>
							<span hidden>{{ $term->terDateinitial }}</span>
							<span hidden>{{ $term->terDatefinal }}</span>
							<span hidden>{{ $term->terBriefcase }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteTerm-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $term->terId }}</span>
							<span hidden>{{ $term->legalization->client->cliNamereason }}</span>
							<span hidden>{{ $term->legalization->client->cliNumberdocument }}</span>
							<span hidden>{{ $term->legalization->document->docName }}</span>
							<span hidden>{{ $term->legalization->document->docCode }}</span>
							<span hidden>{{ $term->legalization->document->docVersion }}</span>
							<span hidden>{{ $term->terDateinitial }}</span>
							<span hidden>{{ $term->terDatefinal }}</span>
							<span hidden>{{ $term->terBriefcase }}</span>
						</a>
						<form action="{{ route('permanent.conditions.pdf') }}" style="display: inline;">
							@csrf
							<input type="hidden" name="terId" value="{{ $term->terId }}" class="form-control form-control-sm" required>
							<input type="hidden" name="terLegalization_id" value="{{ $term->terLegalization_id }}" class="form-control form-control-sm" required>
							<button type="submit" title="Descargar PDF" class="bj-btn-table-delete form-control-sm downloadTerm-link">
								<i class="fas fa-file-pdf"></i>
							</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newTerm-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CONDICION ECONOMICA:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('permanent.conditions.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CLIENTE:</small>
											<select name="terLegalization_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($legalizations as $legalization)
													<option value="{{ $legalization->lcoId }}" data-client="{{ $legalization->client->cliNumberdocument }}" data-document="{{ $legalization->document->docName }}" data-code="{{ $legalization->document->docCode }}" data-version="{{ $legalization->document->docVersion }}">{{ $legalization->client->cliNamereason }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">IDENTIFICACION DE CLIENTE:</small>
											<input type="text" name="cliNumberdocument" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<input type="text" name="docName" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="docCode" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-12 pb-2 border-bottom">
										<small class="text-muted">VIGENCIA DE TARIFAS</small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DESDE:</small>
											<input type="text" name="terDateinitial" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">HASTA:</small>
											<input type="text" name="terDatefinal" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row border mx-3 p-2">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">PORTAFOLIO DE SERVICIO:</small>
													<select name="briefcases_select" class="form-control form-control-sm" title="Seleccione el tipo de portafolio">
														<option value="">Seleccione ...</option>
														<option value="Mensajería Express">Mensajería Express</option>
														<option value="Logística Express">Logística Express</option>
														<option value="Carga Express">Carga Express</option>
														<option value="Turismo Pasajeros">Turismo Pasajeros</option>
														<option value="Traslado Urbano">Traslado Urbano</option>
														<option value="Traslado Intermunicipal">Traslado Intermunicipal</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE SERVICIO:</small>
													<select name="typeService_id" class="form-control form-control-sm" title="Seleccione tipo de servicio">
														<option value="">Seleccione servicio ...</option>
														<!-- dinamics row -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE VEHICULO:</small>
													<input type="text" name="typeVehicle" class="form-control form-control-sm" disabled>
													<!-- <select name="typeVehicle_id" class="form-control form-control-sm" title="Seleccione tipo de vehículo">
														<option value="">Seleccione vehículo ...</option>
													</select> -->
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm btn-briefcase-addTerm">Agregar</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="info" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-briefcase-terms" width="100%" style="font-size: 12px;">
											<thead>
												<th>PORTAFOLIO</th>
												<th>TIPO DE SERVICIO</th>
												<th>TIPO DE VEHICULO</th>
												<th>TARIFA BASE</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- briefcases_select, typeService, typeVehicle, valueBaserate -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="client_name" class="form-control form-control-sm" required>
							<input type="hidden" name="all_briefcase" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editTerm-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE CONDICIONES:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('permanent.conditions.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CLIENTE:</small>
											<input type="text" name="cliNamereason_Edit" class="form-control form-control-sm text-center" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">IDENTIFICACION DE CLIENTE:</small>
											<input type="text" name="cliNumberdocument_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<input type="text" name="docName_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="docVersion_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="docCode_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-12 pb-2 border-bottom">
										<small class="text-muted">VIGENCIA DE TARIFAS</small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DESDE:</small>
											<input type="text" name="terDateinitial_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">HASTA:</small>
											<input type="text" name="terDatefinal_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row border mx-3 p-2">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">PORTAFOLIO DE SERVICIO:</small>
													<select name="briefcases_select_Edit" class="form-control form-control-sm" title="Seleccione el tipo de portafolio">
														<option value="">Seleccione ...</option>
														<option value="Mensajería Express">Mensajería Express</option>
														<option value="Logística Express">Logística Express</option>
														<option value="Carga Express">Carga Express</option>
														<option value="Turismo Pasajeros">Turismo Pasajeros</option>
														<option value="Traslado Urbano">Traslado Urbano</option>
														<option value="Traslado Intermunicipal">Traslado Intermunicipal</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE SERVICIO:</small>
													<select name="typeService_id_Edit" class="form-control form-control-sm" title="Seleccione tipo de servicio">
														<option value="">Seleccione servicio ...</option>
														<!-- dinamics row -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE VEHICULO:</small>
													<input type="text" name="typeVehicle_Edit" class="form-control form-control-sm" disabled>
													<!-- <select name="typeVehicle_id" class="form-control form-control-sm" title="Seleccione tipo de vehículo">
														<option value="">Seleccione vehículo ...</option>
													</select> -->
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm btn-briefcase-addTerm-edit">Agregar</button>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="info_Edit" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-briefcase-terms-edit" width="100%" style="font-size: 12px;">
											<thead>
												<th>PORTAFOLIO</th>
												<th>TIPO DE SERVICIO</th>
												<th>TIPO DE VEHICULO</th>
												<th>TARIFA BASE</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- briefcases_select, typeService, typeVehicle, valueBaserate -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" name="all_briefcase_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="lcoId_Edit" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="terId_Edit" readonly required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3 btn-updateDefinitive">GUARDAR CAMBIOS</button>
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

	<div class="modal fade" id="deleteTerm-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CONDICIONES ECONOMICAS:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE CLIENTE: </small><br>
							<span class="text-muted"><b class="cliNamereason_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO DE CLIENTE: </small><br>
							<span class="text-muted"><b class="cliNumberdocument_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="docCode_Delete"></b></span><br>
							<small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
							<span class="text-muted"><b class="docVersion_Delete"></b></span><br>
							<small class="text-muted">VIGENCIA DE TARIFAS: </small><br>
							<span class="text-muted">DESDE: <b class="terDateinitial_Delete"></b> HASTA: <b class="terDatefinal_Delete"></b></span><br>
							<hr>
							<small class="text-muted">SERVICIOS: </small><br>
							<table class="table text-center terBriefcases_Delete" width="100%" style="font-size: 12px;">
								<thead>
									<tr>
										<td>PORTAFOLIO</td>
										<td>SERVICIO</td>
										<td>VEHICULO</td>
										<td>TARIFA</td>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('permanent.conditions.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="terId_Delete" readonly required>
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

		$('.newTerm-link').on('click',function(){
			$('#newTerm-modal').modal();
		});

		$('select[name=terLegalization_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=cliNumberdocument]').val('');
			$('input[name=docName]').val('');
			$('input[name=docVersion]').val('');
			$('input[name=docCode]').val('');
			if(selected != ''){
				var client = $('select[name=terLegalization_id] option:selected').attr('data-client');
				var doc = $('select[name=terLegalization_id] option:selected').attr('data-document');
				var version = $('select[name=terLegalization_id] option:selected').attr('data-version');
				var code = $('select[name=terLegalization_id] option:selected').attr('data-code');
				$('input[name=cliNumberdocument]').val(client);
				$('input[name=docName]').val(doc);
				$('input[name=docVersion]').val(version);
				$('input[name=docCode]').val(code);				
			}
		});

		$('select[name=briefcases_select]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=typeService_id]').empty();
			$('select[name=typeService_id]').append("<option value=''>Seleccione servicio ...</option>");
			$('input[name=typeVehicle]').val('');
			// $('select[name=typeVehicle_id]').empty();
			// $('select[name=typeVehicle_id]').append("<option value=''>Seleccione vehículo ...</option>");
			// $('select[name=typeVehicle_id]').attr('disabled',false);
			if(selected != ''){
				switch(selected){
					case 'Mensajería Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Mensajería Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									// $('select[name=typeService_id]').append(
									// 	"<option value='" + objectServices[i]['smId'] + "'>" +
									// 		objectServices[i]['smService'] +
									// 	"</option>"
									// );
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['bmeId'] + "'" +
												" data-service='" + objectServices[i]['smId'] + "' " +
												" data-base='" + objectServices[i]['bmeValueratebase'] + "' " +
												" data-vehicle='N/A' " +
											">" +
											objectServices[i]['smService'] + ' - $' +
											objectServices[i]['bmeValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Logística Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Logística Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['bleId'] + "'" +
												" data-service='" + objectServices[i]['slId'] + "' " +
												" data-base='" + objectServices[i]['bleValueratebase'] + "' " +
												" data-vehicle='N/A' " +
											">" +
											objectServices[i]['slService'] + ' - $' +
											objectServices[i]['bleValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Carga Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Carga Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['bceId'] + "'" +
												" data-service='" + objectServices[i]['scId'] + "' " +
												" data-base='" + objectServices[i]['bceValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['heaId'] + "-" + objectServices[i]['heaTypology'] + "' " +
											">" +
											objectServices[i]['scService'] + ' - $' +
											objectServices[i]['bceValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Turismo Pasajeros':
						$.get("{{ route('getTypeservice') }}",{ type: 'Turismo Pasajeros' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['bteId'] + "'" +
												" data-service='" + objectServices[i]['stId'] + "' " +
												" data-base='" + objectServices[i]['bteValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['stService'] + ' - $' +
											objectServices[i]['bteValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Traslado Urbano':
						$.get("{{ route('getTypeservice') }}",{ type: 'Traslado Urbano' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['btreId'] + "'" +
												" data-service='" + objectServices[i]['strId'] + "' " +
												" data-base='" + objectServices[i]['btreValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['strService'] + ' - $' +
											objectServices[i]['btreValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Traslado Intermunicipal':
						$.get("{{ route('getTypeservice') }}",{ type: 'Traslado Intermunicipal' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id]').append(
										"<option value='" + objectServices[i]['btriId'] + "'" +
												" data-service='" + objectServices[i]['stmId'] + "' " +
												" data-base='" + objectServices[i]['btriValuebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['stmService'] + ' - $' +
											objectServices[i]['btriValuebase'] +
										"</option>"
									);
								}
							}
						});
						break;
				}
			}
		});

		$('select[name=typeService_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=typeVehicle]').val('');
			if(selected != ''){
				var vehicle = $('select[name=typeService_id] option:selected').attr('data-vehicle');
				$('input[name=typeVehicle]').val(vehicle);
			}
		});

		// BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
		$('.btn-briefcase-addTerm').on('click',function(){
			var briefcase = $('select[name=briefcases_select]').val();
			var briefcase_id = $('select[name=typeService_id]').val();
			var idService = $('select[name=typeService_id] option:selected').attr('data-service');
			var serviceValueSeparated = $('select[name=typeService_id] option:selected').text().split(' - $');
			var service = serviceValueSeparated[0];
			var rate = serviceValueSeparated[1];
			var find = $('input[name=typeVehicle]').val().indexOf('-');
			if(find > -1){
				var vehicleSeparated = $('input[name=typeVehicle]').val().split('-');
				var idVehicle = vehicleSeparated[0];
				var vehicle = vehicleSeparated[1];
			}else{
				var idVehicle = $('input[name=typeVehicle]').val();
				var vehicle = $('input[name=typeVehicle]').val();
			}
				
			var validateRepet = false;
			$('.tbl-briefcase-terms').find('tbody').find('tr').each(function(){
				var idBriefcase = $(this).attr('class');
				var typeBriefcase = $(this).attr('data-typeBriefcase');
				if(idBriefcase == briefcase_id && typeBriefcase == briefcase){
					validateRepet = true;
				}
			});
			if(briefcase_id != '' && vehicle != ''){
				if(validateRepet == false){
					$('.tbl-briefcase-terms').find('tbody').append(
						"<tr class='" + briefcase_id + "' data-typeBriefcase='" + briefcase + "' data-idBriefcase='" + briefcase_id + "'>" +
							"<td>" + briefcase + "</td>" +
							"<td><span hidden>" + idService + "</span><span>" + service + "</span></td>" +
							"<td><span hidden>" + idVehicle + "</span><span>" + vehicle + "</span></td>" +
							"<td>" +
								"<div class='input-group'>" +
                                    "<div class='input-group-prepend'>" +
                                        "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
                                    "</div>" +
                                    "<input type='text' value='" + rate + "' maxlength='50' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center rate' title='Campo de texto de 50 carácteres máximo' required>" +
                                "</div>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteBriefcase' title='Eliminar portafolio'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.info').css('display','block');
					$('.info').text('Portafolio y/o tipo de servicio seleccionado ya está en la tabla');
					setTimeout(function(){
						$('.info').css('display','none');
						$('.info').text('');
					},3000);
				}
			}else{
				$('.info').css('display','block');
				$('.info').text('No hay seleccionado ningun portafolio y/o tipo de servicio');
				setTimeout(function(){
					$('.info').css('display','none');
					$('.info').text('');
				},3000);
			}
		});

		$('.tbl-briefcase-terms').on('click','.btn-deleteBriefcase',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-saveDefinitive').on('click',function(e){
			// e.preventDefault();
			var all = '';
			$('input[name=all_briefcase]').val('');
			$('.tbl-briefcase-terms').find('tbody').find('tr').each(function(){
				var typeBriefcase = $(this).attr('data-typeBriefcase');
				var idBriefcase = $(this).attr('data-idBriefcase');
				var idservice = $(this).find('td:nth-child(2)').find('span:nth-child(1)').text();
				var service = $(this).find('td:nth-child(2)').find('span:nth-child(2)').text();
				var idVehicle = $(this).find('td:nth-child(3)').find('span:nth-child(1)').text();
				var vehicle = $(this).find('td:nth-child(3)').find('span:nth-child(2)').text();
				var valuebase = $(this).find('input.rate').val();
				all += typeBriefcase + '=>' + idBriefcase + '=>' + idservice + '=>' + service + '=>' + idVehicle + '=>' + vehicle + '=>' + valuebase + '<=|=>';
			});
			$('input[name=all_briefcase]').val(all);
			var client = $('select[name=terLegalization_id] option:selected').text();
			$('input[name=client_name]').val(client);
			if(all != '' && all != null){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.info').css('display','block');
				$('.info').text('Seleccione al menos un portafolio y su tipo de servicio antes de enviar la información');
				setTimeout(function(){
					$('.info').css('display','none');
					$('.info').text('');
				},3000);
			}
		});

		$('.editTerm-link').on('click',function(e){
			e.preventDefault();
			var terId = $(this).find('span:nth-child(2)').text();
			var terLegalization_id = $(this).find('span:nth-child(3)').text();
			var cliNamereason = $(this).find('span:nth-child(4)').text();
			var cliNumberdocument = $(this).find('span:nth-child(5)').text();
			var docName = $(this).find('span:nth-child(6)').text();
			var docCode = $(this).find('span:nth-child(7)').text();
			var docVersion = $(this).find('span:nth-child(8)').text();
			var terDateinitial = $(this).find('span:nth-child(9)').text();
			var terDatefinal = $(this).find('span:nth-child(10)').text();
			var terBriefcase = $(this).find('span:nth-child(11)').text();
			$('input[name=terId_Edit]').val(terId);
			$('input[name=lcoId_Edit]').val(terLegalization_id);
			$('input[name=cliNamereason_Edit]').val(cliNamereason);
			$('input[name=cliNumberdocument_Edit]').val(cliNumberdocument);
			$('input[name=docName_Edit]').val(docName);
			$('input[name=docCode_Edit]').val(docCode);
			$('input[name=docVersion_Edit]').val(docVersion);
			$('input[name=terDateinitial_Edit]').val(terDateinitial);
			$('input[name=terDatefinal_Edit]').val(terDatefinal);
			$('input[name=all_briefcase_Edit]').val(terBriefcase + '<=|=>');
			$('.tbl-briefcase-terms-edit').find('tbody').empty();
			var find = terBriefcase.indexOf('<=|=>');
			if(find > -1){
				var separatedBriefcases = terBriefcase.split('<=|=>');
				for (var i = 0; i < separatedBriefcases.length; i++) {
					var separated = separatedBriefcases[i].split('=>');
					$('.tbl-briefcase-terms-edit').find('tbody').append(
						"<tr class='" + separated[1] + "' data-typeBriefcase='" + separated[0] + "' data-idBriefcase='" + separated[1] + "'>" +
							"<td>" + separated[0] + "</td>" +
							"<td><span hidden>" + separated[2] + "</span><span>" + separated[3] + "</span></td>" +
							"<td><span hidden>" + separated[4] + "</span><span>" + separated[5] + "</span></td>" +
							"<td>" +
								"<div class='input-group'>" +
		                            "<div class='input-group-prepend'>" +
		                                "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
		                            "</div>" +
		                            "<input type='text' value='" + separated[6] + "' maxlength='50' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center rate' title='Campo de texto de 50 carácteres máximo' required>" +
		                        "</div>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteBriefcase-edit' title='Eliminar portafolio'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				console.log(separated);
				}
			}else{
				var separated = terBriefcase.split('=>');
				console.log(separated);
				$('.tbl-briefcase-terms-edit').find('tbody').append(
					"<tr class='" + separated[1] + "' data-typeBriefcase='" + separated[0] + "' data-idBriefcase='" + separated[1] + "'>" +
						"<td>" + separated[0] + "</td>" +
						"<td><span hidden>" + separated[2] + "</span><span>" + separated[3] + "</span></td>" +
						"<td><span hidden>" + separated[4] + "</span><span>" + separated[5] + "</span></td>" +
						"<td>" +
							"<div class='input-group'>" +
	                            "<div class='input-group-prepend'>" +
	                                "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
	                            "</div>" +
	                            "<input type='text' value='" + separated[6] + "' maxlength='50' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center rate' title='Campo de texto de 50 carácteres máximo' required>" +
	                        "</div>" +
						"</td>" +
						"<td>" +
							"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteBriefcase-edit' title='Eliminar portafolio'><i class='fas fa-trash-alt'></i></button>" +
						"</td>" +
					"</tr>"
				);
			}
			$('#editTerm-modal').modal();
		});

		$('select[name=briefcases_select_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=typeService_id_Edit]').empty();
			$('select[name=typeService_id_Edit]').append("<option value=''>Seleccione servicio ...</option>");
			$('input[name=typeVehicle_Edit]').val('');
			if(selected != ''){
				switch(selected){
					case 'Mensajería Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Mensajería Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									// $('select[name=typeService_id]').append(
									// 	"<option value='" + objectServices[i]['smId'] + "'>" +
									// 		objectServices[i]['smService'] +
									// 	"</option>"
									// );
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['bmeId'] + "'" +
												" data-service='" + objectServices[i]['smId'] + "' " +
												" data-base='" + objectServices[i]['bmeValueratebase'] + "' " +
												" data-vehicle='N/A' " +
											">" +
											objectServices[i]['smService'] + ' - $' +
											objectServices[i]['bmeValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Logística Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Logística Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['bleId'] + "'" +
												" data-service='" + objectServices[i]['slId'] + "' " +
												" data-base='" + objectServices[i]['bleValueratebase'] + "' " +
												" data-vehicle='N/A' " +
											">" +
											objectServices[i]['slService'] + ' - $' +
											objectServices[i]['bleValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Carga Express':
						$.get("{{ route('getTypeservice') }}",{ type: 'Carga Express' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['bceId'] + "'" +
												" data-service='" + objectServices[i]['scId'] + "' " +
												" data-base='" + objectServices[i]['bceValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['heaId'] + "-" + objectServices[i]['heaTypology'] + "' " +
											">" +
											objectServices[i]['scService'] + ' - $' +
											objectServices[i]['bceValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Turismo Pasajeros':
						$.get("{{ route('getTypeservice') }}",{ type: 'Turismo Pasajeros' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['bteId'] + "'" +
												" data-service='" + objectServices[i]['stId'] + "' " +
												" data-base='" + objectServices[i]['bteValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['stService'] + ' - $' +
											objectServices[i]['bteValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Traslado Urbano':
						$.get("{{ route('getTypeservice') }}",{ type: 'Traslado Urbano' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['btreId'] + "'" +
												" data-service='" + objectServices[i]['strId'] + "' " +
												" data-base='" + objectServices[i]['btreValueratebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['strService'] + ' - $' +
											objectServices[i]['btreValueratebase'] +
										"</option>"
									);
								}
							}
						});
						break;
					case 'Traslado Intermunicipal':
						$.get("{{ route('getTypeservice') }}",{ type: 'Traslado Intermunicipal' },function(objectServices){
							var count = Object.keys(objectServices).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									$('select[name=typeService_id_Edit]').append(
										"<option value='" + objectServices[i]['btriId'] + "'" +
												" data-service='" + objectServices[i]['stmId'] + "' " +
												" data-base='" + objectServices[i]['btriValuebase'] + "' " +
												" data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
											">" +
											objectServices[i]['stmService'] + ' - $' +
											objectServices[i]['btriValuebase'] +
										"</option>"
									);
								}
							}
						});
						break;
				}
			}
		});

		$('select[name=typeService_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=typeVehicle_Edit]').val('');
			if(selected != ''){
				var vehicle = $('select[name=typeService_id_Edit] option:selected').attr('data-vehicle');
				$('input[name=typeVehicle_Edit]').val(vehicle);
			}
		});

		// BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
		$('.btn-briefcase-addTerm-edit').on('click',function(){
			var briefcase = $('select[name=briefcases_select_Edit]').val();
			var briefcase_id = $('select[name=typeService_id_Edit]').val();
			var idService = $('select[name=typeService_id_Edit] option:selected').attr('data-service');
			var serviceValueSeparated = $('select[name=typeService_id_Edit] option:selected').text().split(' - $');
			var service = serviceValueSeparated[0];
			var rate = serviceValueSeparated[1];
			var find = $('input[name=typeVehicle_Edit]').val().indexOf('-');
			if(find > -1){
				var vehicleSeparated = $('input[name=typeVehicle_Edit]').val().split('-');
				var idVehicle = vehicleSeparated[0];
				var vehicle = vehicleSeparated[1];
			}else{
				var idVehicle = $('input[name=typeVehicle_Edit]').val();
				var vehicle = $('input[name=typeVehicle_Edit]').val();
			}
				
			var validateRepet = false;
			$('.tbl-briefcase-terms-edit').find('tbody').find('tr').each(function(){
				var idBriefcase = $(this).attr('class');
				var typeBriefcase = $(this).attr('data-typeBriefcase');
				if(idBriefcase == briefcase_id && typeBriefcase == briefcase){
					validateRepet = true;
				}
			});
			if(briefcase_id != '' && vehicle != ''){
				if(validateRepet == false){
					$('.tbl-briefcase-terms-edit').find('tbody').append(
						"<tr class='" + briefcase_id + "' data-typeBriefcase='" + briefcase + "' data-idBriefcase='" + briefcase_id + "'>" +
							"<td>" + briefcase + "</td>" +
							"<td><span hidden>" + idService + "</span><span>" + service + "</span></td>" +
							"<td><span hidden>" + idVehicle + "</span><span>" + vehicle + "</span></td>" +
							"<td>" +
								"<div class='input-group'>" +
                                    "<div class='input-group-prepend'>" +
                                        "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
                                    "</div>" +
                                    "<input type='text' value='" + rate + "' maxlength='50' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center rate' title='Campo de texto de 50 carácteres máximo' required>" +
                                "</div>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteBriefcase-edit' title='Eliminar portafolio'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.info_Edit').css('display','block');
					$('.info_Edit').text('Portafolio y/o tipo de servicio seleccionado ya está en la tabla');
					setTimeout(function(){
						$('.info_Edit').css('display','none');
						$('.info_Edit').text('');
					},3000);
				}
			}else{
				$('.info_Edit').css('display','block');
				$('.info_Edit').text('No hay seleccionado ningun portafolio y/o tipo de servicio');
				setTimeout(function(){
					$('.info_Edit').css('display','none');
					$('.info_Edit').text('');
				},3000);
			}
		});

		$('.tbl-briefcase-terms-edit').on('click','.btn-deleteBriefcase-edit',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-updateDefinitive').on('click',function(e){
			// e.preventDefault();
			var all = '';
			$('input[name=all_briefcase_Edit]').val('');
			$('.tbl-briefcase-terms-edit').find('tbody').find('tr').each(function(){
				var typeBriefcase = $(this).attr('data-typeBriefcase');
				var idBriefcase = $(this).attr('data-idBriefcase');
				var idservice = $(this).find('td:nth-child(2)').find('span:nth-child(1)').text();
				var service = $(this).find('td:nth-child(2)').find('span:nth-child(2)').text();
				var idVehicle = $(this).find('td:nth-child(3)').find('span:nth-child(1)').text();
				var vehicle = $(this).find('td:nth-child(3)').find('span:nth-child(2)').text();
				var valuebase = $(this).find('input.rate').val();
				all += typeBriefcase + '=>' + idBriefcase + '=>' + idservice + '=>' + service + '=>' + idVehicle + '=>' + vehicle + '=>' + valuebase + '<=|=>';
			});
			$('input[name=all_briefcase_Edit]').val(all);
			if(all != '' && all != null){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.info_Edit').css('display','block');
				$('.info_Edit').text('Seleccione al menos un portafolio y su tipo de servicio antes de enviar la información');
				setTimeout(function(){
					$('.info_Edit').css('display','none');
					$('.info_Edit').text('');
				},3000);
			}
		});

		$('.deleteTerm-link').on('click',function(e){
			e.preventDefault();
			var terId = $(this).find('span:nth-child(2)').text();
			var cliNamereason = $(this).find('span:nth-child(3)').text();
			var cliNumberdocument = $(this).find('span:nth-child(4)').text();
			var docName = $(this).find('span:nth-child(5)').text();
			var docCode = $(this).find('span:nth-child(6)').text();
			var docVersion = $(this).find('span:nth-child(7)').text();
			var terDateinitial = $(this).find('span:nth-child(8)').text();
			var terDatefinal = $(this).find('span:nth-child(9)').text();
			var terBriefcase = $(this).find('span:nth-child(10)').text();
			$('input[name=terId_Delete]').val(terId);
			$('.cliNamereason_Delete').text(cliNamereason);
			$('.cliNumberdocument_Delete').text(cliNumberdocument);
			$('.docName_Delete').text(docName);
			$('.docCode_Delete').text(docCode);
			$('.docVersion_Delete').text(docVersion);
			$('.terDateinitial_Delete').text(terDateinitial);
			$('.terDatefinal_Delete').text(terDatefinal);
			$('.terBriefcases_Delete').find('tbody').empty();
			var find = terBriefcase.indexOf('<=|=>');
			if(find > -1){
				var separatedBriefcases = terBriefcase.split('<=|=>');
				for (var i = 0; i < separatedBriefcases.length; i++) {
					var separated = separatedBriefcases[i].split('=>');
					$('.terBriefcases_Delete').find('tbody').append(
						"<tr>" +
							"<td>" + separated[0] + "</td>" +
							"<td>" + separated[3] + "</td>" +
							"<td>" + separated[5] + "</td>" +
							"<td>$" + separated[6] + "</td>" +
						"</tr>"
					);
				console.log(separated);
				}
			}else{
				var separated = terBriefcase.split('=>');
				$('.terBriefcases_Delete').find('tbody').append(
					"<tr>" +
						"<td>" + separated[0] + "</td>" +
						"<td>" + separated[3] + "</td>" +
						"<td>" + separated[5] + "</td>" +
						"<td>$" + separated[6] + "</td>" +
					"</tr>"
				);
			}
			$('#deleteTerm-modal').modal();
		});
	</script>
@endsection