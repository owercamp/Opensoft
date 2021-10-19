@extends('modules.administrativeAutomotors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>SERVICIOS ESPECIALES</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar servicio especial automotor" class="bj-btn-table-add form-control-sm newEspecial-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessEspecials'))
				    <div class="alert alert-success">
				        {{ session('SuccessEspecials') }}
				    </div>
				@endif
				@if(session('PrimaryEspecials'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryEspecials') }}
				    </div>
				@endif
				@if(session('WarningEspecials'))
				    <div class="alert alert-warning">
				        {{ session('WarningEspecials') }}
				    </div>
				@endif
				@if(session('SecondaryEspecials'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryEspecials') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NUMERO DE PLACA</th>
					<th>PROPIETARIO</th>
					<th>NUMERO DE CONTACTO</th>
					<th>EMPRESA ALIADA</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($automotorsespecials as $especial)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $especial->auePlate }}</td>
					<td>{{ $especial->ceNames }}</td>
					<td>{{ $especial->auePhone }}</td>
					<td>{{ $especial->aeReasonsocial }}</td>
					<td>
						<a href="#" title="Editar servicio automotor" class="bj-btn-table-edit form-control-sm editEspecial-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $especial->aueId }}</span>
							<span hidden>{{ $especial->auePhone }}</span>
							<span hidden>{{ $especial->aueTypevehicle_id }}</span>
							<span hidden>{{ $especial->auePlate }}</span>
							<span hidden>{{ $especial->aueBrand }}</span>
							<span hidden>{{ $especial->aueModel }}</span>
							<span hidden>{{ $especial->aueAlliesespecial_id }}</span>
							<span hidden>{{ $especial->aueContractorespecial_id }}</span>
							<span hidden>{{ $especial->aueContractorespecials }}</span>
							<img src="{{ asset('storage/automotorsEspecial/front/'.$especial->auePhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsEspecial/side/'.$especial->auePhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsEspecial/back/'.$especial->auePhotoback) }}" class="img-hidden-back" hidden>
						</a>
						<a href="#" title="Eliminar servicio automotor" class="bj-btn-table-delete form-control-sm deleteEspecial-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $especial->aueId }}</span>
							<span hidden>{{ $especial->auePhone }}</span>
							<span hidden>{{ $especial->espTypology }}</span>
							<span hidden>{{ $especial->espPassengers }}</span>
							<span hidden>{{ $especial->espDisplacement }}</span>
							<span hidden>{{ $especial->espTransmission }}</span>
							<span hidden>{{ $especial->espDescription }}</span>
							<span hidden>{{ $especial->auePlate }}</span>
							<span hidden>{{ $especial->aueBrand }}</span>
							<span hidden>{{ $especial->aueModel }}</span>
							<span hidden>{{ $especial->ceNames }}</span>
							<span hidden>{{ $especial->aeReasonsocial }}</span>
							<span hidden>{{ $especial->ceNumberdocument }}</span>
							<span hidden>{{ $especial->ceNumberdriving }}</span>
							<span hidden>{{ $especial->ceMovil }}</span>
							<span hidden>{{ $especial->aueContractorespecials }}</span>
							<img src="{{ asset('storage/automotorsEspecial/front/'.$especial->auePhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsEspecial/side/'.$especial->auePhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsEspecial/back/'.$especial->auePhotoback) }}" class="img-hidden-back" hidden>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newEspecial-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVO SERVICIO ESPECIAL AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.services.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">TIPO DE VEHICULO:</small>
											<select name="aueTypevehicle_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($settingsespecials as $sespecial)
													<option value="{{ $sespecial->espId }}" data-passenger="{{ $sespecial->espPassengers }}" data-displacement="{{ $sespecial->espDisplacement }}" data-trasmission="{{ $sespecial->espTransmission }}" data-description="{{ $sespecial->espDescription }}">
														{{ $sespecial->espTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="espDisplacement" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CAPACIDAD DE PASAJEROS:</small>
											<input type="text" name="espPassengers" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">TRASMISION:</small>
											<input type="text" name="espTransmission" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="auePlate" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aueBrand" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aueModel" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">EMPRESA AFILIADORA:</small>
											<select name="aueAlliesespecial_id" class="form-control form-control-sm" required>
												<option value="">Seleccione empresa afiliadora ...</option>
												@foreach($alliesespecials as $allieespecial)
													<option value="{{ $allieespecial->aeId }}">
														{{ $allieespecial->aeReasonsocial }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aueContractorespecial_id" class="form-control form-control-sm" required>
												<option value="">Seleccione contratista propietario ...</option>
												@foreach($contractorsespecials as $contractorsespecial)
													<option value="{{ $contractorsespecial->ceId }}">
														{{ $contractorsespecial->ceNames . ' - N° ' . $contractorsespecial->ceNumberdocument }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MOVIL:</small>
											<input type="text" name="auePhone" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row m-2 p-2 border">
									<div class="col-md-12">
										<div class="row text-center">
											<div class="col-md-12">
												<h6>CONDUCTOR OPERADOR</h6>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CONDUCTOR:</small>
													<select name="aueContractorespecials_new" class="form-control form-control-sm">
														<option value="">Seleccione conductor ...</option>
														@foreach($contractorsespecials as $contractorsespecial)
															<option value="{{ $contractorsespecial->ceId }}" data-numberdocument="{{ $contractorsespecial->ceNumberdocument }}" data-numberdriving="{{ $contractorsespecial->ceNumberdriving }}">{{ $contractorsespecial->ceNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-newEspecial" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-newEspecial" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-newEspecial" width="100%" style="font-size: 12px;">
													<thead>
														<th>NOMBRE</th>
														<th>DOCUMENTO</th>
														<th>LICENCIA</th>
														<th></th>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FOTO DE FRENTE:</small>
											<div class="custom-file">
										        <input type="file" name="auePhotofront" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTO DE ATRAS:</small>
											<div class="custom-file">
										        <input type="file" name="auePhotoback" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTO DE LADO:</small>
											<div class="custom-file">
										        <input type="file" name="auePhotoside" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="aueContractorespecials" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-newDefinitiveEspecial">REGISTRAR SERVICIO ESPECIAL</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editEspecial-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>EDITAR SERVICIO ESPECIAL DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.services.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">TIPO DE VEHICULO:</small>
											<select name="aueTypevehicle_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de vehículo ...</option>
												@foreach($settingsespecials as $sespecial)
													<option value="{{ $sespecial->espId }}" data-passenger="{{ $sespecial->espPassengers }}" data-displacement="{{ $sespecial->espDisplacement }}" data-trasmission="{{ $sespecial->espTransmission }}" data-description="{{ $sespecial->espDescription }}">
														{{ $sespecial->espTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="espDisplacement_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CAPACIDAD DE PASAJEROS:</small>
											<input type="text" name="espPassengers_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">TRASMISION:</small>
											<input type="text" name="espTransmission_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="auePlate_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aueBrand_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aueModel_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">EMPRESA AFILIADORA:</small>
											<select name="aueAlliesespecial_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione empresa afiliadora ...</option>
												@foreach($alliesespecials as $allieespecial)
													<option value="{{ $allieespecial->aeId }}">
														{{ $allieespecial->aeReasonsocial }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aueContractorespecial_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione contratista propietario ...</option>
												@foreach($contractorsespecials as $contractorsespecial)
													<option value="{{ $contractorsespecial->ceId }}">
														{{ $contractorsespecial->ceNames . ' - N° ' . $contractorsespecial->ceNumberdocument }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MOVIL:</small>
											<input type="text" name="auePhone_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row m-2 p-2 border">
									<div class="col-md-12">
										<div class="row text-center">
											<div class="col-md-12">
												<h6>CONDUCTOR OPERADOR</h6>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CONDUCTOR:</small>
													<select name="aueContractorespecials_new_Edit" class="form-control form-control-sm">
														<option value="">Seleccione conductor ...</option>
														@foreach($contractorsespecials as $contractorsespecial)
															<option value="{{ $contractorsespecial->ceId }}" data-numberdocument="{{ $contractorsespecial->ceNumberdocument }}" data-numberdriving="{{ $contractorsespecial->ceNumberdriving }}">{{ $contractorsespecial->ceNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-editEspecial" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-editEspecial" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-editEspecial" width="100%" style="font-size: 12px;">
													<thead>
														<th>NOMBRE</th>
														<th>DOCUMENTO</th>
														<th>LICENCIA</th>
														<th></th>
													</thead>
													<tbody>
														
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO DE ATRAS ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center auePhotobacknow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted auePhotobacknot_Edit">
												<input type="checkbox" name="auePhotobacknot_Edit" value="SIN FOTO">
												Quitar foto de atras
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO DE LADO ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center auePhotosidenow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted auePhotosidenot_Edit">
												<input type="checkbox" name="auePhotosidenot_Edit" value="SIN FOTO">
												Quitar foto de lado
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO FRENTE ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center auePhotofrontnow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted auePhotofrontnot_Edit">
												<input type="checkbox" name="auePhotofrontnot_Edit" value="SIN FOTO">
												Quitar foto de frente
											</small>
										</div>
									</div>
								</div>
								<div class="row p-2 border">
									<div class="col-md-12">
										<h6>SELECCIONE NUEVAS IMAGENES (Las actuales seran remplazadas por las que seleccione)</h6>
										<div class="row text-center">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">FOTO DE FRENTE:</small>
													<div class="custom-file">
												        <input type="file" name="auePhotofront_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
										</div>
										<div class="row text-center">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTO DE ATRAS:</small>
													<div class="custom-file">
												        <input type="file" name="auePhotoback_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTO DE LADO:</small>
													<div class="custom-file">
												        <input type="file" name="auePhotoside_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
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
								<input type="hidden" name="aueContractorespecials_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="aueId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3 btn-editDefinitiveEspecial">GUARDAR CAMBIOS</button>
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

	<div class="modal fade" id="deleteEspecial-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION/DETALLES DE SERVICIO ESPECIAL DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">TIPO DE VEHICULO: </small><br>
							<span class="text-muted"><b class="espTypology_Delete"></b></span><br>
							<small class="text-muted">CILINDRAJE: </small><br>
							<span class="text-muted"><b class="espDisplacement_Delete"></b></span><br>
							<small class="text-muted">CAPACIDAD DE PASAJEROS: </small><br>
							<span class="text-muted"><b class="espPassengers_Delete"></b></span><br>
							<small class="text-muted">TRASMISION: </small><br>
							<span class="text-muted"><b class="espTransmission_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE PLACA: </small><br>
							<span class="text-muted"><b class="auePlate_Delete"></b></span><br>
							<small class="text-muted">MARCA: </small><br>
							<span class="text-muted"><b class="aueBrand_Delete"></b></span><br>
							<small class="text-muted">MODELO: </small><br>
							<span class="text-muted"><b class="aueModel_Delete"></b></span><br>
							<small class="text-muted">PROPIETARIO: </small><br>
							<span class="text-muted"><b class="ceNames_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE CONTACTO: </small><br>
							<span class="text-muted"><b class="auePhone_Delete"></b></span><br>
							<hr>
							<small class="text-muted">CONDUCTORES OPERADORES: </small><br>
							<ul class="list-group aueContractorespecials_Delete">
								
							</ul>
						</div>
						<div class="col-md-6">
							<small class="text-muted">FOTO FRENTE: </small><br>
							<img src="" class="img-responsive img-thumbnail auePhotofront_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO LADO: </small><br>
							<img src="" class="img-responsive img-thumbnail auePhotoside_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO ATRAS: </small><br>
							<img src="" class="img-responsive img-thumbnail auePhotoback_Delete" style="width: 100%; height: auto;">
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('automotors.services.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="aueId_Delete" value="" required>
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

		$('.newEspecial-link').on('click',function(){
			$('#newEspecial-modal').modal();
		});

		$('select[name=aueTypevehicle_id]').on('change',function(e){
			var motorcycleSelected = e.target.value;
			$('input[name=espDisplacement]').val('');
			$('input[name=espPassengers]').val('');
			$('input[name=espTransmission]').val('');
			if(motorcycleSelected != ''){
				var displacement = $('select[name=aueTypevehicle_id] option:Selected').attr('data-displacement');
				var passenger = $('select[name=aueTypevehicle_id] option:Selected').attr('data-passenger');
				var trasmission = $('select[name=aueTypevehicle_id] option:Selected').attr('data-trasmission');
				$('input[name=espDisplacement]').val(displacement);
				$('input[name=espPassengers]').val(passenger);
				$('input[name=espTransmission]').val(trasmission);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-newEspecial').on('click',function(){
			var ceId = $('select[name=aueContractorespecials_new]').val();
			var ceNames = $('select[name=aueContractorespecials_new] option:selected').text();
			var ceNumberdocument = $('select[name=aueContractorespecials_new] option:selected').attr('data-numberdocument');
			var ceNumberdriving = $('select[name=aueContractorespecials_new] option:selected').attr('data-numberdriving');
			if(ceId != ''){
				var validateRepet = false;
				$('.tbl-drivers-newEspecial').find('tbody').find('tr').each(function(){
					var idCe = $(this).attr('class');
					if(idCe == ceId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-newEspecial').find('tbody').append(
						"<tr class='" + ceId + "'>" +
							"<td>" + ceNames + "</td>" +
							"<td>" + ceNumberdocument + "</td>" +
							"<td>" + ceNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-newEspecial'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-newEspecial').css('display','block');
					$('.infoRepeat-newEspecial').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-newEspecial').css('display','none');
						$('.infoRepeat-newEspecial').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-newEspecial').css('display','block');
				$('.infoRepeat-newEspecial').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-newEspecial').css('display','none');
					$('.infoRepeat-newEspecial').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-newEspecial').on('click','.btn-deleteDriver-newEspecial',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-newDefinitiveEspecial').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aueContractorespecials]').val('');
			$('.tbl-drivers-newEspecial').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aueContractorespecials]').val(allDrivers);
			$(this).submit();
		});

		$('.editEspecial-link').on('click',function(e){
			e.preventDefault();
			var aueId = $(this).find('span:nth-child(2)').text();
			var auePhone = $(this).find('span:nth-child(3)').text();
			var aueTypevehicle_id = $(this).find('span:nth-child(4)').text();
			var auePlate = $(this).find('span:nth-child(5)').text();
			var aueBrand = $(this).find('span:nth-child(6)').text();
			var aueModel = $(this).find('span:nth-child(7)').text();
			var aueAlliesespecial_id = $(this).find('span:nth-child(8)').text();
			var aueContractorespecial_id = $(this).find('span:nth-child(9)').text();
			var aueContractorespecials = $(this).find('span:nth-child(10)').text();
			var aueFront = String($(this).find('.img-hidden-front').attr('src'));
			var aueSide = String($(this).find('.img-hidden-side').attr('src'));
			var aueBack = String($(this).find('.img-hidden-back').attr('src'));
			$('input[name=aueId_Edit]').val(aueId);
			$('input[name=auePhone_Edit]').val(auePhone);
			$('select[name=aueTypevehicle_id_Edit]').val(aueTypevehicle_id);
			var displacement = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-displacement');
			var passenger = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-passenger');
			var trasmission = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-trasmission');
			$('input[name=espDisplacement_Edit]').val(displacement);
			$('input[name=espPassengers_Edit]').val(passenger);
			$('input[name=espTransmission_Edit]').val(trasmission);
			$('input[name=auePlate_Edit]').val(auePlate);
			$('input[name=aueBrand_Edit]').val(aueBrand);
			$('input[name=aueModel_Edit]').val(aueModel);
			$('select[name=aueAlliesespecial_id_Edit]').val(aueAlliesespecial_id);
			$('select[name=aueContractorespecial_id_Edit]').val(aueContractorespecial_id);
			// CONDUCTORES DE AUTOMOTOR ACTUALES
			$('.aueContractorespecials_Edit').val('');
			$('.tbl-drivers-editEspecial tbody').empty();
			var find = aueContractorespecials.indexOf(',');
			if(find > -1){
				var separated = aueContractorespecials.split(',');
				$.get("{{ route('getContractorespecial') }}",{ ceId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.tbl-drivers-editEspecial').find('tbody').append(
								"<tr class='" + objectDrivers[i][0] + "'>" +
									"<td>" + objectDrivers[i][1] + "</td>" +
									"<td>" + objectDrivers[i][2] + "</td>" +
									"<td>" + objectDrivers[i][3] + "</td>" +
									"<td>" +
										"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editEspecial'><i class='fas fa-trash-alt'></i></button>" +
									"</td>" +
								"</tr>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractorespecial') }}",{ ceId: aueContractorespecials, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.tbl-drivers-editEspecial').find('tbody').append(
							"<tr class='" + objectDriver['ceId'] + "'>" +
								"<td>" + objectDriver['ceNames'] + "</td>" +
								"<td>" + objectDriver['ceNumberdocument'] + "</td>" +
								"<td>" + objectDriver['ceNumberdriving'] + "</td>" +
								"<td>" +
									"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editEspecial'><i class='fas fa-trash-alt'></i></button>" +
								"</td>" +
							"</tr>"
						);
					}
				});
			}
			// IMAGENES DE AUTOMOTOR ACTUALES
			$('img.auePhotofrontnow_Edit').attr('src',aueFront);
			var findFront = aueFront.indexOf('Default');
			if(findFront > -1){
				$('.auePhotofrontnot_Edit').css('display','none');
			}else{
				$('.auePhotofrontnot_Edit').css('display','block');
			}
			$('img.auePhotosidenow_Edit').attr('src',aueSide);
			var findSide = aueSide.indexOf('Default');
			if(findSide > -1){
				$('.auePhotosidenot_Edit').css('display','none');
			}else{
				$('.auePhotosidenot_Edit').css('display','block');
			}
			$('img.auePhotobacknow_Edit').attr('src',aueBack);
			var findBack = aueBack.indexOf('Default');
			if(findBack > -1){
				$('.auePhotobacknot_Edit').css('display','none');
			}else{
				$('.auePhotobacknot_Edit').css('display','block');
			}
			$('#editEspecial-modal').modal();
		});

		$('select[name=aueTypevehicle_id_Edit]').on('change',function(e){
			var motorcycleSelected = e.target.value;
			$('input[name=espDisplacement_Edit]').val('');
			$('input[name=espPassengers_Edit]').val('');
			$('input[name=espTransmission_Edit]').val('');
			if(motorcycleSelected != ''){
				var displacement = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-displacement');
				var passenger = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-passenger');
				var trasmission = $('select[name=aueTypevehicle_id_Edit] option:Selected').attr('data-trasmission');
				$('input[name=espDisplacement_Edit]').val(displacement);
				$('input[name=espPassengers_Edit]').val(passenger);
				$('input[name=espTransmission_Edit]').val(trasmission);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-editEspecial').on('click',function(){
			var ceId = $('select[name=aueContractorespecials_new_Edit]').val();
			var ceNames = $('select[name=aueContractorespecials_new_Edit] option:selected').text();
			var ceNumberdocument = $('select[name=aueContractorespecials_new_Edit] option:selected').attr('data-numberdocument');
			var ceNumberdriving = $('select[name=aueContractorespecials_new_Edit] option:selected').attr('data-numberdriving');
			if(ceId != ''){
				var validateRepet = false;
				$('.tbl-drivers-editEspecial').find('tbody').find('tr').each(function(){
					var idCe = $(this).attr('class');
					if(idCe == ceId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-editEspecial').find('tbody').append(
						"<tr class='" + ceId + "'>" +
							"<td>" + ceNames + "</td>" +
							"<td>" + ceNumberdocument + "</td>" +
							"<td>" + ceNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editEspecial'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-editEspecial').css('display','block');
					$('.infoRepeat-editEspecial').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-editEspecial').css('display','none');
						$('.infoRepeat-editEspecial').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-editEspecial').css('display','block');
				$('.infoRepeat-editEspecial').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-editEspecial').css('display','none');
					$('.infoRepeat-editEspecial').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-editEspecial').on('click','.btn-deleteDriver-editEspecial',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-editDefinitiveEspecial').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aueContractorespecials_Edit]').val('');
			$('.tbl-drivers-editEspecial').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aueContractorespecials_Edit]').val(allDrivers);
			$(this).submit();
		});

		$('.deleteEspecial-link').on('click',function(e){
			e.preventDefault();
			var aueId = $(this).find('span:nth-child(2)').text();
			var auePhone = $(this).find('span:nth-child(3)').text();
			var espTypology = $(this).find('span:nth-child(4)').text();
			var espPassengers = $(this).find('span:nth-child(5)').text();
			var espDisplacement = $(this).find('span:nth-child(6)').text();
			var espTransmission = $(this).find('span:nth-child(7)').text();
			var espDescription = $(this).find('span:nth-child(8)').text();
			var auePlate = $(this).find('span:nth-child(9)').text();
			var aueBrand = $(this).find('span:nth-child(10)').text();
			var aueModel = $(this).find('span:nth-child(11)').text();
			var ceNames = $(this).find('span:nth-child(12)').text();
			var aeReasonsocial = $(this).find('span:nth-child(13)').text();
			var ceNumberdocument = $(this).find('span:nth-child(14)').text();
			var ceNumberdriving = $(this).find('span:nth-child(15)').text();
			var ceMovil = $(this).find('span:nth-child(16)').text();
			var aueContractorespecials = $(this).find('span:nth-child(17)').text();
			var aueFront = String($(this).find('.img-hidden-front').attr('src'));
			var aueSide = String($(this).find('.img-hidden-side').attr('src'));
			var aueBack = String($(this).find('.img-hidden-back').attr('src'));
			$('input[name=aueId_Delete]').val(aueId);
			$('.auePhone_Delete').text(auePhone);
			$('.espTypology_Delete').text(espTypology);
			$('.espPassengers_Delete').text(espPassengers);
			$('.espDisplacement_Delete').text(espDisplacement);
			$('.espTransmission_Delete').text(espTransmission);
			$('.auePlate_Delete').text(auePlate);
			$('.aueBrand_Delete').text(aueBrand);
			$('.aueModel_Delete').text(aueModel);
			$('.ceNames_Delete').text(ceNames);
			$('.aueContractorespecials_Delete').empty();
			var find = aueContractorespecials.indexOf(',');
			if(find > -1){
				var separated = aueContractorespecials.split(',');
				$.get("{{ route('getContractorespecial') }}",{ ceId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.aueContractorespecials_Delete').append(
								"<li class='list-group-item d-flex justify-content-between align-items-center'>" +
									"<b>NOMBRE:</b>" + objectDrivers[i][1] +
								"</li>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractorespecial') }}",{ ceId: aueContractorespecials, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.aueContractorespecials_Delete').append(
							"<li class='list-group-item d-flex flex-column justify-content-between align-items-center'>" +
								"<b><small class='text-muted'>NOMBRE: </small>" + objectDriver['ceNames'] + "</b>" +
								"<b><small class='text-muted'>DOCUMENTO: </small>" + objectDriver['ceNumberdocument'] + "</b>" +
								"<b><small class='text-muted'>LICENCIA: </small>" + objectDriver['ceNumberdriving'] + "</b>" +
							"</li>"
						);
					}
				});
			}
			$('img.auePhotofront_Delete').attr('src',aueFront);
			$('img.auePhotoside_Delete').attr('src',aueSide);
			$('img.auePhotoback_Delete').attr('src',aueBack);
			$('#deleteEspecial-modal').modal();
		});
	</script>
@endsection