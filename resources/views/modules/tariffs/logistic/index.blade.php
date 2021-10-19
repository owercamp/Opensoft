@extends('modules.comercialTariffs')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>LOGISTICA EXPRESS</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newExpress-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessExpress'))
				    <div class="alert alert-success">
				        {{ session('SuccessExpress') }}
				    </div>
				@endif
				@if(session('PrimaryExpress'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryExpress') }}
				    </div>
				@endif
				@if(session('WarningExpress'))
				    <div class="alert alert-warning">
				        {{ session('WarningExpress') }}
				    </div>
				@endif
				@if(session('SecondaryExpress'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryExpress') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>AÑO</th>
					<th>CIUDAD</th>
					<th>TIPO DE SERVICIO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($briefcases as $express)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $express->bleYear }}</td>
					<td>{{ $express->munName }}</td>
					<td>{{ $express->slService }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $express->bleId }}</span>
							<span hidden>{{ $express->bleYear }}</span>
							<span hidden>{{ $express->munName }}</span>
							<span hidden>{{ $express->slId }}</span>
							<span hidden>{{ $express->slService }}</span>
							<span hidden>{{ $express->slAvailability }}</span>
							<span hidden>{{ $express->slDescription }}</span>
							<span hidden>{{ $express->bleValueratebase }}</span>
							<span hidden>{{ $express->bleValueminutewait }}</span>
							<span hidden>{{ $express->bleValuereturn }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteExpress-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $express->bleId }}</span>
							<span hidden>{{ $express->bleYear }}</span>
							<span hidden>{{ $express->munName }}</span>
							<span hidden>{{ $express->slService }}</span>
							<span hidden>{{ $express->slAvailability }}</span>
							<span hidden>{{ $express->slDescription }}</span>
							<span hidden>{{ $express->bleValueratebase }}</span>
							<span hidden>{{ $express->bleValueminutewait }}</span>
							<span hidden>{{ $express->bleValuereturn }}</span>
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

	<div class="modal fade" id="newExpress-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVOS REGISTROS DE LOGISTICA EXPRESS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('tariffs.logistic.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">AÑO:</small>
											<select name="bleYear" class="form-control form-control-sm" required>
												<option value="">Seleccione un año...</option>
												<option value="{{ $yearnow }}">{{ $yearnow }}</option>
												<option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
												<option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
												<option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
												<option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
												<option value="{{ $yearfutureFive }}">{{ $yearfutureFive }}</option>
												<option value="{{ $yearfutureSix }}">{{ $yearfutureSix }}</option>
												<option value="{{ $yearfutureSeven }}">{{ $yearfutureSeven }}</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CIUDAD:</small>
											<select name="bleMunicipility_id" class="form-control form-control-sm" required>
												<option value="">Seleccione un año...</option>
												@foreach($municipalities as $municipality)
													<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">SERVICIOS:</small>
											<select name="bleTypeservice_id_new" class="form-control form-control-sm">
												<option value="">Seleccione ...</option>
												@foreach($serviceslogistic as $service)
													<option value="{{ $service->slId }}">{{ $service->slService }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addService-newExpress" title='AGREGUE EL SERVICIO SELECCIONADO PARA ESPECIFICAR VALORES'>Agregar servicio</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-service-newExpress" width="100%" style="font-size: 12px;">
											<thead>
												<th>SERVICIO</th>
												<th>TARIFA BASE</th>
												<th>VALOR MINUTO DE ESPERA</th>
												<th>RECARGO IDA Y VUELTA</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- smId, smService -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="all_services" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editExpress-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE VALORES, PORTAFOLIO DE LOGISTICA:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('tariffs.logistic.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row text-center border p-3">
									<div class="col-md-3">
										<small class="text-muted">AÑO:</small>
										<h3 class="text-muted"><b class="bleYear_Edit"></b></h3><br>
										<input type="hidden" name="bleYear_Edit" class="form-control form-control-sm" readonly required>
									</div>
									<div class="col-md-4">
										<small class="text-muted">CIUDAD:</small>
										<h3 class="text-muted"><b class="bleCity_Edit"></b></h3><br>
										<input type="hidden" name="bleCity_Edit" class="form-control form-control-sm" readonly required>
									</div>
									<div class="col-md-5" style="font-size: 12px; text-align: left;">
										<small class="text-muted">SERVICIO: </small>
										<span class="text-muted"><b class="slService_Edit"></b></span><br>
										<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small>
										<span class="text-muted"><b class="slAvailability_Edit"></b></span><br>
										<small class="text-muted">DESCRIPCION: </small><br>
										<span class="text-muted"><b class="slDescription_Edit"></b></span><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-service-editExpress" width="100%" style="font-size: 12px;">
											<thead>
												<th>TARIFA BASE</th>
												<th>VALOR MINUTO DE ESPERA</th>
												<th>RECARGO IDA Y VUELTA</th>
											</thead>
											<tbody>
												<tr>
													<td>
														<div class='form-group'>
															<div class='input-group'>
																<div class='input-group-prepend'>
																    <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
																</div>
															    <input type='text' name='bleValueratebase' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Tarifa base ($)' required>
															</div>
														</div>
													</td>
													<td>
														<div class='form-group'>
															<div class='input-group'>
																<div class='input-group-prepend'>
																    <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
																</div>
															    <input type='text' name='bleValueminutewait' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Valor minuto de espera ($)' required>
															</div>
														</div>
													</td>
													<td>
														<div class='form-group'>
															<div class='input-group'>
																<div class='input-group-prepend'>
																    <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
																</div>
															    <input type='text' name='bleValuereturn' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Valor recargo ida y vuelta ($)' required>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="bleId_Edit" readonly required>
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

	<div class="modal fade" id="deleteExpress-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE REGISTRO, PORTAFOLIO DE LOGISTICA:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">AÑO: </small><br>
							<span class="text-muted"><b class="bleYear_Delete"></b></span><br>
							<small class="text-muted">CIUDAD: </small><br>
							<span class="text-muted"><b class="bleCity_Delete"></b></span><br>
							<small class="text-muted">SERVICIO: </small><br>
							<span class="text-muted"><b class="slService_Delete"></b></span><br>
							<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
							<span class="text-muted"><b class="slAvailability_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION DEL SERVICIO: </small><br>
							<span class="text-muted"><b class="slDescription_Delete"></b></span><br>
							<small class="text-muted">TARIFA BASE: </small><br>
							<span class="text-muted"><b class="bleValueratebase_Delete"></b></span><br>
							<small class="text-muted">VALOR MINUTO DE ESPERA: </small><br>
							<span class="text-muted"><b class="bleValueminutewait_Delete"></b></span><br>
							<small class="text-muted">RECARGO IDA Y VUELTA: </small><br>
							<span class="text-muted"><b class="bleValuereturn_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('tariffs.logistic.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="bleYear_Delete" readonly required>
							<input type="hidden" class="form-control form-control-sm" name="bleCity_Delete" readonly required>
							<input type="hidden" class="form-control form-control-sm" name="bleId_Delete" readonly required>
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

		$('.newExpress-link').on('click',function(){
			$('.tbl-service-newExpress').find('tbody').empty();
			$('#newExpress-modal').modal();
		});

		// BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
		$('.btn-addService-newExpress').on('click',function(){
			var slId = $('select[name=bleTypeservice_id_new]').val();
			var slService = $('select[name=bleTypeservice_id_new] option:selected').text();
			var validateRepet = false;
			$('.tbl-service-newExpress').find('tbody').find('tr').each(function(){
				var idService = $(this).attr('class');
				if(idService == slId){
					validateRepet = true;
				}
			});
			if(slId != ''){
				if(validateRepet == false){
					$('.tbl-service-newExpress').find('tbody').append(
						"<tr class='" + slId + "' data-idService='" + slId + "'>" +
							"<td>" + slService + "</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bleValueratebase' title='Tarifa base ($)' required>" +
									"</div>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bleValueminutewait' title='Valor minuto de espera ($)' required>" +
									"</div>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bleValuereturn' title='Valor recargo ida y vuelta ($)' required>" +
									"</div>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteService-newExpress' title='Eliminar servicio'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat').css('display','block');
					$('.infoRepeat').text('Servicio seleccionado ya está en la tabla');
					setTimeout(function(){
						$('.infoRepeat').css('display','none');
						$('.infoRepeat').text('');
					},3000);
				}
			}else{
				$('.infoRepeat').css('display','block');
				$('.infoRepeat').text('No hay seleccionado ningun servicio');
				setTimeout(function(){
					$('.infoRepeat').css('display','none');
					$('.infoRepeat').text('');
				},3000);
			}
		});

		// EVENTO PARA CLICK EN MODAL, GUARDAR EL NUEVO REGISTRO
		$('.btn-saveDefinitive').on('click',function(e){
			// e.preventDefault();
			var allServices = '';
			$('input[name=all_services]').val('');
			$('.tbl-service-newExpress').find('tbody').find('tr').each(function(){
				var idService = $(this).attr('data-idService');
				var valuebase = $(this).find('input.bleValueratebase').val();
				var valueminute = $(this).find('input.bleValueminutewait').val();
				var valuereturn = $(this).find('input.bleValuereturn').val();
				allServices += idService + '-' + valuebase + '-' + valueminute + '-' + valuereturn + '=';
			});
			$('input[name=all_services]').val(allServices);
			if(allServices != '' && allServices != null){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.infoRepeat').css('display','block');
				$('.infoRepeat').text('Seleccione al menos un servicio y defina sus valores antes de enviar la información');
				setTimeout(function(){
					$('.infoRepeat').css('display','none');
					$('.infoRepeat').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE DESTINOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-service-newExpress').on('click','.btn-deleteService-newExpress',function(){
			$(this).parents('tr').remove();
		});

		$('.editExpress-link').on('click',function(e){
			e.preventDefault();
			var bleId = $(this).find('span:nth-child(2)').text();
			var bleYear = $(this).find('span:nth-child(3)').text();
			var munName = $(this).find('span:nth-child(4)').text();
			var slId = $(this).find('span:nth-child(5)').text();
			var slService = $(this).find('span:nth-child(6)').text();
			var slAvailability = $(this).find('span:nth-child(7)').text();
			var slDescription = $(this).find('span:nth-child(8)').text();
			var bleValueratebase = $(this).find('span:nth-child(9)').text();
			var bleValueminutewait = $(this).find('span:nth-child(10)').text();
			var bleValuereturn = $(this).find('span:nth-child(11)').text();
			$('input[name=bleId_Edit]').val(bleId);
			$('b.bleYear_Edit').text(bleYear);
			$('input[name=bleYear_Edit]').val(bleYear);
			$('b.bleCity_Edit').text(munName);
			$('input[name=bleCity_Edit]').val(munName);
			$('.slService_Edit').text(slService);
			$('.slAvailability_Edit').text(slAvailability);
			$('.slDescription_Edit').text(slDescription);
			$('.tbl-service-editExpress').find('input[name=bleValueratebase]').val(bleValueratebase);
			$('.tbl-service-editExpress').find('input[name=bleValueminutewait]').val(bleValueminutewait);
			$('.tbl-service-editExpress').find('input[name=bleValuereturn]').val(bleValuereturn);
			$('#editExpress-modal').modal();
		});

		$('.deleteExpress-link').on('click',function(e){
			e.preventDefault();
			var bleId = $(this).find('span:nth-child(2)').text();
			var bleYear = $(this).find('span:nth-child(3)').text();
			var munName = $(this).find('span:nth-child(4)').text();
			var slService = $(this).find('span:nth-child(5)').text();
			var slAvailability = $(this).find('span:nth-child(6)').text();
			var slDescription = $(this).find('span:nth-child(7)').text();
			var bleValueratebase = $(this).find('span:nth-child(8)').text();
			var bleValueminutewait = $(this).find('span:nth-child(9)').text();
			var bleValuereturn = $(this).find('span:nth-child(10)').text();
			$('input[name=bleId_Delete]').val(bleId);
			$('b.bleYear_Delete').text(bleYear);
			$('input[name=bleYear_Delete]').val(bleYear);
			$('b.bleCity_Delete').text(munName);
			$('input[name=bleCity_Delete]').val(munName);
			$('.slService_Delete').text(slService);
			$('.slAvailability_Delete').text(slAvailability);
			$('.slDescription_Delete').text(slDescription);
			$('.bleValueratebase_Delete').text('$' + bleValueratebase);
			$('.bleValueminutewait_Delete').text('$' + bleValueminutewait);
			$('.bleValuereturn_Delete').text('$' + bleValuereturn);
			$('#deleteExpress-modal').modal();
		});
	</script>
@endsection