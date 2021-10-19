@extends('modules.comercialTariffs')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CARGA EXPRESS</h6>
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
					<th>VEHICULO</th>
					<th>TIPO DE SERVICIO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($briefcases as $express)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $express->bceYear }}</td>
					<td>{{ $express->munName }}</td>
					<td>{{ $express->heaTypology }}</td>
					<td>{{ $express->scService }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $express->bceId }}</span>
							<span hidden>{{ $express->bceYear }}</span>
							<span hidden>{{ $express->munName }}</span>
							<span hidden>{{ $express->heaTypology }}</span>
							<span hidden>{{ $express->scService }}</span>
							<span hidden>{{ $express->scUnit }}</span>
							<span hidden>{{ $express->scKilos }}</span>
							<span hidden>{{ $express->scDimensions }}</span>
							<span hidden>{{ $express->scDescription }}</span>
							<span hidden>{{ $express->bceValueratebase }}</span>
							<span hidden>{{ $express->bceValuekilometres }}</span>
							<span hidden>{{ $express->bceValuereturn }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteExpress-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $express->bceId }}</span>
							<span hidden>{{ $express->bceYear }}</span>
							<span hidden>{{ $express->munName }}</span>
							<span hidden>{{ $express->heaTypology }}</span>
							<span hidden>{{ $express->heaDisplacement }}</span>
							<span hidden>{{ $express->heaCapacity }}</span>
							<span hidden>{{ $express->heaDescription }}</span>
							<span hidden>{{ $express->scService }}</span>
							<span hidden>{{ $express->scUnit }}</span>
							<span hidden>{{ $express->scKilos }}</span>
							<span hidden>{{ $express->scDimensions }}</span>
							<span hidden>{{ $express->scDescription }}</span>
							<span hidden>{{ $express->bceValueratebase }}</span>
							<span hidden>{{ $express->bceValuekilometres }}</span>
							<span hidden>{{ $express->bceValuereturn }}</span>
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
					<h6>NUEVOS REGISTROS DE CARGA EXPRESS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('tariffs.charge.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">AÑO:</small>
											<select name="bceYear" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
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
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CIUDAD:</small>
											<select name="bceMunicipility_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($municipalities as $municipality)
													<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">VEHICULO DE CARGA:</small>
											<select name="bceTypevehicle_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($heavys as $heavy)
													<option value="{{ $heavy->heaId }}">{{ $heavy->heaTypology }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">SERVICIOS:</small>
											<select name="bceTypeservice_id_new" class="form-control form-control-sm">
												<option value="">Seleccione ...</option>
												@foreach($servicescharge as $service)
													<option value="{{ $service->scId }}">{{ $service->scService }}</option>
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
												<th>VALOR KILOMETRO</th>
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
					<h6>MODIFICACION DE VALORES, PORTAFOLIO DE CARGA:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('tariffs.charge.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row text-center border p-3">
									<div class="col-md-4">
										<small class="text-muted">AÑO:</small>
										<h3 class="text-muted"><b class="bceYear_Edit"></b></h3><br>
										<input type="hidden" name="bceYear_Edit" class="form-control form-control-sm" readonly required>
									</div>
									<div class="col-md-4">
										<small class="text-muted">CIUDAD:</small>
										<h3 class="text-muted"><b class="bceCity_Edit"></b></h3><br>
										<input type="hidden" name="bceCity_Edit" class="form-control form-control-sm" readonly required>
									</div>
									<div class="col-md-4" style="font-size: 12px; text-align: left;">
										<small class="text-muted">VEHICULO:</small>
										<h3 class="text-muted"><b class="bceVehicle_Edit"></b></h3><br>
										<input type="hidden" name="bceVehicle_Edit" class="form-control form-control-sm" readonly required>
										<!-- TIPOLOGIA, CILINDRAJE, CAPACIDAD, DESCRIPCION -->
									</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="font-size: 12px; text-align: center;">
										<small class="text-muted">SERVICIO: </small>
										<span class="text-muted"><b class="scService_Edit"></b></span><br>
										<small class="text-muted">MAXIMAS UNIDADES: </small>
										<span class="text-muted"><b class="scUnit_Edit"></b></span><br>
										<small class="text-muted">MAXIMO PESO/VOLUMEN (Kilos): </small>
										<span class="text-muted"><b class="scKilos_Edit"></b></span><br>
										<small class="text-muted">DIMENSIONES MAXIMAS: </small><br>
										<small class="text-muted">Alto: </small>
										<span class="text-muted"><b class="scDimensionHeight_Edit"></b></span><br>
										<small class="text-muted">Largo: </small>
										<span class="text-muted"><b class="scDimensionLong_Edit"></b></span><br>
										<small class="text-muted">Ancho: </small>
										<span class="text-muted"><b class="scDimensionWidth_Edit"></b></span><br>
										<small class="text-muted">DESCRIPCION: </small><br>
										<span class="text-muted"><b class="scDescription_Edit"></b></span><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-service-editExpress" width="100%" style="font-size: 12px;">
											<thead>
												<th>TARIFA BASE</th>
												<th>VALOR KILOMETRO</th>
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
															    <input type='text' name='bceValueratebase' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Tarifa base ($)' required>
															</div>
														</div>
													</td>
													<td>
														<div class='form-group'>
															<div class='input-group'>
																<div class='input-group-prepend'>
																    <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
																</div>
															    <input type='text' name='bceValuekilometres' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Valor kilometro ($)' required>
															</div>
														</div>
													</td>
													<td>
														<div class='form-group'>
															<div class='input-group'>
																<div class='input-group-prepend'>
																    <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
																</div>
															    <input type='text' name='bceValuereturn' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Valor recargo ida y vuelta ($)' required>
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
								<input type="hidden" class="form-control form-control-sm" name="bceId_Edit" readonly required>
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
					<h6>ELIMINACION DE REGISTRO, PORTAFOLIO DE CARGA:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">AÑO: </small><br>
							<span class="text-muted"><b class="bceYear_Delete"></b></span><br>
							<small class="text-muted">CIUDAD: </small><br>
							<span class="text-muted"><b class="bceCity_Delete"></b></span><br>
							<hr>
							<small class="text-muted">TIPO DE VEHICULO: </small><br>
							<small class="text-muted">Tipología: </small>
							<span class="text-muted"><b class="heaTypology_Delete"></b></span><br>
							<small class="text-muted">Cilindraje: </small>
							<span class="text-muted"><b class="heaDisplacement_Delete"></b></span><br>
							<small class="text-muted">Capacidad: </small>
							<span class="text-muted"><b class="heaCapacity_Delete"></b></span><br>
							<small class="text-muted">Descripción: </small>
							<span class="text-muted"><b class="heaDescription_Delete"></b></span><br>
							<hr>
							<small class="text-muted">SERVICIO: </small>
							<span class="text-muted"><b class="scService_Delete"></b></span><br>
							<small class="text-muted">MAXIMAS UNIDADES: </small>
							<span class="text-muted"><b class="scUnit_Delete"></b></span><br>
							<small class="text-muted">MAXIMO PESO/VOLUMEN (Kilos): </small>
							<span class="text-muted"><b class="scKilos_Delete"></b></span><br>
							<small class="text-muted">DIMENSIONES MAXIMAS: </small><br>
							<small class="text-muted">Alto: </small>
							<span class="text-muted"><b class="scDimensionHeight_Delete"></b></span><br>
							<small class="text-muted">Largo: </small>
							<span class="text-muted"><b class="scDimensionLong_Delete"></b></span><br>
							<small class="text-muted">Ancho: </small>
							<span class="text-muted"><b class="scDimensionWidth_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="scDescription_Delete"></b></span><br>
							<hr>
							<small class="text-muted">TARIFA BASE: </small><br>
							<span class="text-muted"><b class="bceValueratebase_Delete"></b></span><br>
							<small class="text-muted">VALOR KILOMETRO: </small><br>
							<span class="text-muted"><b class="bceValuekilometres_Delete"></b></span><br>
							<small class="text-muted">RECARGO IDA Y VUELTA: </small><br>
							<span class="text-muted"><b class="bceValuereturn_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('tariffs.charge.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="bceYear_Delete" readonly required>
							<input type="hidden" class="form-control form-control-sm" name="bceCity_Delete" readonly required>
							<input type="hidden" class="form-control form-control-sm" name="bceVehicle_Delete" readonly required>
							<input type="hidden" class="form-control form-control-sm" name="bceId_Delete" readonly required>
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
			var scId = $('select[name=bceTypeservice_id_new]').val();
			var scService = $('select[name=bceTypeservice_id_new] option:selected').text();
			var validateRepet = false;
			$('.tbl-service-newExpress').find('tbody').find('tr').each(function(){
				var idService = $(this).attr('class');
				if(idService == scId){
					validateRepet = true;
				}
			});
			if(scId != ''){
				if(validateRepet == false){
					$('.tbl-service-newExpress').find('tbody').append(
						"<tr class='" + scId + "' data-idService='" + scId + "'>" +
							"<td>" + scService + "</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bceValueratebase' title='Tarifa base ($)' required>" +
									"</div>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bceValuekilometres' title='Valor kilometro ($)' required>" +
									"</div>" +
								"</div>" +
							"</td>" +
							"<td>" +
								"<div class='form-group'>" +
									"<div class='input-group'>" +
										"<div class='input-group-prepend'>" +
										    "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
										"</div>" +
									    "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bceValuereturn' title='Valor recargo ida y vuelta ($)' required>" +
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
				var valuebase = $(this).find('input.bceValueratebase').val();
				var valuekilometres = $(this).find('input.bceValuekilometres').val();
				var valuereturn = $(this).find('input.bceValuereturn').val();
				allServices += idService + '-' + valuebase + '-' + valuekilometres + '-' + valuereturn + '=';
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
			var bceId = $(this).find('span:nth-child(2)').text();
			var bceYear = $(this).find('span:nth-child(3)').text();
			var munName = $(this).find('span:nth-child(4)').text();
			var heaTypology = $(this).find('span:nth-child(5)').text();
			var scService = $(this).find('span:nth-child(6)').text();
			var scUnit = $(this).find('span:nth-child(7)').text();
			var scKilos = $(this).find('span:nth-child(8)').text();
			var scDimensions = $(this).find('span:nth-child(9)').text();
			var scDescription = $(this).find('span:nth-child(10)').text();
			var bceValueratebase = $(this).find('span:nth-child(11)').text();
			var bceValuekilometres = $(this).find('span:nth-child(12)').text();
			var bceValuereturn = $(this).find('span:nth-child(13)').text();
			$('input[name=bceId_Edit]').val(bceId);
			$('b.bceYear_Edit').text(bceYear);
			$('input[name=bceYear_Edit]').val(bceYear);
			$('b.bceCity_Edit').text(munName);
			$('input[name=bceCity_Edit]').val(munName);
			$('b.bceVehicle_Edit').text(heaTypology);
			$('input[name=bceVehicle_Edit]').val(heaTypology);
			$('.heaTypology_E').text(scService);
			$('.scService_Edit').text(scService);
			$('.scUnit_Edit').text(scUnit);
			$('.scKilos_Edit').text(scKilos);
			var separatedDimensions = scDimensions.split('-');
			$('.scDimensionHeight_Edit').text(separatedDimensions[0]);
			$('.scDimensionLong_Edit').text(separatedDimensions[1]);
			$('.scDimensionWidth_Edit').text(separatedDimensions[2]);
			$('.scDescription_Edit').text(scDescription);
			$('.tbl-service-editExpress').find('input[name=bceValueratebase]').val(bceValueratebase);
			$('.tbl-service-editExpress').find('input[name=bceValuekilometres]').val(bceValuekilometres);
			$('.tbl-service-editExpress').find('input[name=bceValuereturn]').val(bceValuereturn);
			$('#editExpress-modal').modal();
		});

		$('.deleteExpress-link').on('click',function(e){
			e.preventDefault();
			var bceId = $(this).find('span:nth-child(2)').text();
			var bceYear = $(this).find('span:nth-child(3)').text();
			var munName = $(this).find('span:nth-child(4)').text();
			var heaTypology = $(this).find('span:nth-child(5)').text();
			var heaDisplacement = $(this).find('span:nth-child(6)').text();
			var heaCapacity = $(this).find('span:nth-child(7)').text();
			var heaDescription = $(this).find('span:nth-child(8)').text();
			var scService = $(this).find('span:nth-child(9)').text();
			var scUnit = $(this).find('span:nth-child(10)').text();
			var scKilos = $(this).find('span:nth-child(11)').text();
			var scDimensions = $(this).find('span:nth-child(12)').text();
			var scDescription = $(this).find('span:nth-child(13)').text();
			var bceValueratebase = $(this).find('span:nth-child(14)').text();
			var bceValuekilometres = $(this).find('span:nth-child(15)').text();
			var bceValuereturn = $(this).find('span:nth-child(16)').text();
			$('input[name=bceId_Delete]').val(bceId);
			$('b.bceYear_Delete').text(bceYear);
			$('input[name=bceYear_Delete]').val(bceYear);
			$('b.bceCity_Delete').text(munName);
			$('input[name=bceCity_Delete]').val(munName);
			$('input[name=bceVehicle_Delete]').val(heaTypology);
			$('.heaTypology_Delete').text(heaTypology);
			$('.heaDisplacement_Delete').text(heaDisplacement);
			$('.heaCapacity_Delete').text(heaCapacity);
			$('.heaDescription_Delete').text(heaDescription);
			$('.scService_Delete').text(scService);
			$('.scUnit_Delete').text(scUnit);
			$('.scKilos_Delete').text(scKilos);
			var separatedDimensions = scDimensions.split('-');
			$('.scDimensionHeight_Delete').text(separatedDimensions[0]);
			$('.scDimensionLong_Delete').text(separatedDimensions[1]);
			$('.scDimensionWidth_Delete').text(separatedDimensions[2]);
			$('.scDescription_Delete').text(scDescription);
			$('.bceValueratebase_Delete').text('$' + bceValueratebase);
			$('.bceValuekilometres_Delete').text('$' + bceValuekilometres);
			$('.bceValuereturn_Delete').text('$' + bceValuereturn);
			$('#deleteExpress-modal').modal();
		});
	</script>
@endsection