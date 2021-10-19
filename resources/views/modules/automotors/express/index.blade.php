@extends('modules.administrativeAutomotors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>CARGA EXPRESS DE AUTOMOTOR</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar carga express automotor" class="bj-btn-table-add form-control-sm newCharge-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessCharges'))
				    <div class="alert alert-success">
				        {{ session('SuccessCharges') }}
				    </div>
				@endif
				@if(session('PrimaryCharges'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryCharges') }}
				    </div>
				@endif
				@if(session('WarningCharges'))
				    <div class="alert alert-warning">
				        {{ session('WarningCharges') }}
				    </div>
				@endif
				@if(session('SecondaryCharges'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryCharges') }}
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
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($automotorscharges as $charge)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $charge->aucPlate }}</td>
					<td>{{ $charge->cmNames }}</td>
					<td>{{ $charge->aucPhone }}</td>
					<td>
						<a href="#" title="Editar carga express automotor" class="bj-btn-table-edit form-control-sm editCharge-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $charge->aucId }}</span>
							<span hidden>{{ $charge->aucPhone }}</span>
							<span hidden>{{ $charge->aucTypevehicle_id }}</span>
							<span hidden>{{ $charge->aucPlate }}</span>
							<span hidden>{{ $charge->aucBrand }}</span>
							<span hidden>{{ $charge->aucModel }}</span>
							<span hidden>{{ $charge->aucContractormessenger_id }}</span>
							<span hidden>{{ $charge->aucContractormessengers }}</span>
							<img src="{{ asset('storage/automotorsCharge/front/'.$charge->aucPhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsCharge/side/'.$charge->aucPhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsCharge/back/'.$charge->aucPhotoback) }}" class="img-hidden-back" hidden>
						</a>
						<a href="#" title="Eliminar carga express automotor" class="bj-btn-table-delete form-control-sm deleteCharge-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $charge->aucId }}</span>
							<span hidden>{{ $charge->aucPhone }}</span>
							<span hidden>{{ $charge->heaTypology }}</span>
							<span hidden>{{ $charge->heaDisplacement }}</span>
							<span hidden>{{ $charge->heaCapacity }}</span>
							<span hidden>{{ $charge->heaDescription }}</span>
							<span hidden>{{ $charge->aucPlate }}</span>
							<span hidden>{{ $charge->aucBrand }}</span>
							<span hidden>{{ $charge->aucModel }}</span>
							<span hidden>{{ $charge->cmNames }}</span>
							<span hidden>{{ $charge->cmNumberdocument }}</span>
							<span hidden>{{ $charge->cmNumberdriving }}</span>
							<span hidden>{{ $charge->cmMovil }}</span>
							<span hidden>{{ $charge->aucContractormessengers }}</span>
							<img src="{{ asset('storage/automotorsCharge/front/'.$charge->aucPhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsCharge/side/'.$charge->aucPhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsCharge/back/'.$charge->aucPhotoback) }}" class="img-hidden-back" hidden>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newCharge-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CARGA EXPRESS AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.express.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE MOTOCICLETA:</small>
											<select name="aucTypevehicle_id" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de vehículo ...</option>
												@foreach($heavys as $heavy)
													<option value="{{ $heavy->heaId }}" data-displacement="{{ $heavy->heaDisplacement }}" data-capacity="{{ $heavy->heaCapacity }}" data-description="{{ $heavy->heaDescription }}">
														{{ $heavy->heaTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="heaDisplacement" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAPACIDAD:</small>
											<input type="text" name="heaCapacity" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="aucPlate" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aucBrand" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aucModel" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aucContractormessenger_id" class="form-control form-control-sm" required>
												<option value="">Seleccione contratista propietario ...</option>
												@foreach($contractorsmessengers as $contractorsmessenger)
													<option value="{{ $contractorsmessenger->cmId }}">
														{{ $contractorsmessenger->cmNames . ' - N° ' . $contractorsmessenger->cmNumberdocument }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MOVIL:</small>
											<input type="text" name="aucPhone" maxlength="10" class="form-control form-control-sm" required>
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
													<select name="aucContractormessengers_new" class="form-control form-control-sm">
														<option value="">Seleccione conductor ...</option>
														@foreach($contractorsmessengers as $contractorsmessenger)
															<option value="{{ $contractorsmessenger->cmId }}" data-numberdocument="{{ $contractorsmessenger->cmNumberdocument }}" data-numberdriving="{{ $contractorsmessenger->cmNumberdriving }}">{{ $contractorsmessenger->cmNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-newCharge" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-newCharge" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-newCharge" width="100%" style="font-size: 12px;">
													<thead>
														<th>NOMBRE</th>
														<th>DOCUMENTO</th>
														<th>LICENCIA</th>
														<th></th>
													</thead>
													<tbody>
														<!-- Dinamics row -->
														<!-- cmId, cmNames, cmNumberdriving, cmNumberdocument -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTO DE ATRAS:</small>
											<div class="custom-file">
										        <input type="file" name="aucPhotoback" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTO DE LADO:</small>
											<div class="custom-file">
										        <input type="file" name="aucPhotoside" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FOTO DE FRENTE:</small>
											<div class="custom-file">
										        <input type="file" name="aucPhotofront" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="aucContractormessengers" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-newDefinitiveCharge">REGISTRAR AUTOMOTOR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editCharge-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>EDITAR CARGA EXPRESS DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.express.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE MOTOCICLETA:</small>
											<select name="aucTypevehicle_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de vehículo ...</option>
												@foreach($heavys as $heavy)
													<option value="{{ $heavy->heaId }}" data-displacement="{{ $heavy->heaDisplacement }}" data-capacity="{{ $heavy->heaCapacity }}" data-description="{{ $heavy->heaDescription }}">
														{{ $heavy->heaTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="heaDisplacement_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIEMPOS:</small>
											<input type="text" name="heaCapacity_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="aucPlate_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aucBrand_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aucModel_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aucContractormessenger_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione contratista propietario ...</option>
												@foreach($contractorsmessengers as $contractorsmessenger)
													<option value="{{ $contractorsmessenger->cmId }}">
														{{ $contractorsmessenger->cmNames . ' - N° ' . $contractorsmessenger->cmNumberdocument }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MOVIL:</small>
											<input type="text" name="aucPhone_Edit" maxlength="10" class="form-control form-control-sm" required>
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
													<select name="aucContractormessengers_Edit" class="form-control form-control-sm">
														<option value="">Seleccione conductor ...</option>
														@foreach($contractorsmessengers as $contractorsmessenger)
															<option value="{{ $contractorsmessenger->cmId }}" data-numberdriving="{{ $contractorsmessenger->cmNumberdriving }}" data-numberdocument="{{ $contractorsmessenger->cmNumberdocument }}">
																{{ $contractorsmessenger->cmNames }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-editCharge" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-editCharge" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-editCharge" width="100%" style="font-size: 12px;">
													<thead>
														<th>NOMBRE</th>
														<th>DOCUMENTO</th>
														<th>LICENCIA</th>
														<th></th>
													</thead>
													<tbody>
														<!-- Dinamics row -->
														<!-- cmId, cmNames, cmNumberdriving, cmNumberdocument -->
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
										    <img src="" class="img-responsive img-thumbnail text-center aucPhotobacknow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aucPhotobacknot_Edit">
												<input type="checkbox" name="aucPhotobacknot_Edit" value="SIN FOTO">
												Quitar foto de atras
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO DE LADO ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center aucPhotosidenow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aucPhotosidenot_Edit">
												<input type="checkbox" name="aucPhotosidenot_Edit" value="SIN FOTO">
												Quitar foto de lado
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO FRENTE ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center aucPhotofrontnow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aucPhotofrontnot_Edit">
												<input type="checkbox" name="aucPhotofrontnot_Edit" value="SIN FOTO">
												Quitar foto de frente
											</small>
										</div>
									</div>
								</div>
								<div class="row p-2 border">
									<div class="col-md-12">
										<h6>SELECCIONE NUEVAS IMAGENES (Las actuales seran remplazadas por las que seleccione)</h6>
										<div class="row text-center">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTO DE ATRAS:</small>
													<div class="custom-file">
												        <input type="file" name="aucPhotoback_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTO DE LADO:</small>
													<div class="custom-file">
												        <input type="file" name="aucPhotoside_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
										</div>
										<div class="row text-center">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">FOTO DE FRENTE:</small>
													<div class="custom-file">
												        <input type="file" name="aucPhotofront_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
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
								<input type="hidden" name="aucContractormessengers_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="aucId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3 btn-editDefinitiveCharge">GUARDAR CAMBIOS</button>
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

	<div class="modal fade" id="deleteCharge-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION/DETALLES DE CARGA EXPRESS DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">TIPO DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="heaTypology_Delete"></b></span><br>
							<small class="text-muted">CILINDRAJE: </small><br>
							<span class="text-muted"><b class="heaDisplacement_Delete"></b></span><br>
							<small class="text-muted">TIEMPOS: </small><br>
							<span class="text-muted"><b class="heaCapacity_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE PLACA: </small><br>
							<span class="text-muted"><b class="aucPlate_Delete"></b></span><br>
							<small class="text-muted">MARCA DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="aucBrand_Delete"></b></span><br>
							<small class="text-muted">MODELO DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="aucModel_Delete"></b></span><br>
							<small class="text-muted">PROPIETARIO: </small><br>
							<span class="text-muted"><b class="cmNames_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE CONTACTO: </small><br>
							<span class="text-muted"><b class="aucPhone_Delete"></b></span><br>
							<hr>
							<small class="text-muted">CONDUCTORES OPERADORES: </small><br>
							<ul class="list-group aucContractormessengers_Delete">
								<!-- Li dinamics -->
							</ul>
						</div>
						<div class="col-md-6">
							<small class="text-muted">FOTO FRENTE: </small><br>
							<img src="" class="img-responsive img-thumbnail aucPhotofront_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO LADO: </small><br>
							<img src="" class="img-responsive img-thumbnail aucPhotoside_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO ATRAS: </small><br>
							<img src="" class="img-responsive img-thumbnail aucPhotoback_Delete" style="width: 100%; height: auto;">
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('automotors.express.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="aucId_Delete" value="" required>
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

		$('.newCharge-link').on('click',function(){
			$('#newCharge-modal').modal();
		});

		$('select[name=aucTypevehicle_id]').on('change',function(e){
			var vehicleSelected = e.target.value;
			$('input[name=heaDisplacement]').val('');
			$('input[name=heaCapacity]').val('');
			if(vehicleSelected != ''){
				var displacement = $('select[name=aucTypevehicle_id] option:Selected').attr('data-displacement');
				var capacity = $('select[name=aucTypevehicle_id] option:Selected').attr('data-capacity');
				$('input[name=heaDisplacement]').val(displacement);
				$('input[name=heaCapacity]').val(capacity);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-newCharge').on('click',function(){
			var cmId = $('select[name=aucContractormessengers_new]').val();
			var cmNames = $('select[name=aucContractormessengers_new] option:selected').text();
			var cmNumberdocument = $('select[name=aucContractormessengers_new] option:selected').attr('data-numberdocument');
			var cmNumberdriving = $('select[name=aucContractormessengers_new] option:selected').attr('data-numberdriving');
			if(cmId != ''){
				var validateRepet = false;
				$('.tbl-drivers-newCharge').find('tbody').find('tr').each(function(){
					var idCm = $(this).attr('class');
					if(idCm == cmId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-newCharge').find('tbody').append(
						"<tr class='" + cmId + "'>" +
							"<td>" + cmNames + "</td>" +
							"<td>" + cmNumberdocument + "</td>" +
							"<td>" + cmNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-newCharge'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-newCharge').css('display','block');
					$('.infoRepeat-newCharge').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-newCharge').css('display','none');
						$('.infoRepeat-newCharge').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-newCharge').css('display','block');
				$('.infoRepeat-newCharge').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-newCharge').css('display','none');
					$('.infoRepeat-newCharge').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-newCharge').on('click','.btn-deleteDriver-newCharge',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-newDefinitiveCharge').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aucContractormessengers]').val('');
			$('.tbl-drivers-newCharge').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aucContractormessengers]').val(allDrivers);
			$(this).submit();
		});

		$('.editCharge-link').on('click',function(e){
			e.preventDefault();
			var aucId = $(this).find('span:nth-child(2)').text();
			var aucPhone = $(this).find('span:nth-child(3)').text();
			var aucTypevehicle_id = $(this).find('span:nth-child(4)').text();
			var aucPlate = $(this).find('span:nth-child(5)').text();
			var aucBrand = $(this).find('span:nth-child(6)').text();
			var aucModel = $(this).find('span:nth-child(7)').text();
			var aucContractormessenger_id = $(this).find('span:nth-child(8)').text();
			var aucContractormessengers = $(this).find('span:nth-child(9)').text();
			var aucFront = String($(this).find('.img-hidden-front').attr('src'));
			var aucSide = String($(this).find('.img-hidden-side').attr('src'));
			var aucBack = String($(this).find('.img-hidden-back').attr('src'));
			$('input[name=aucId_Edit]').val(aucId);
			$('input[name=aucPhone_Edit]').val(aucPhone);
			$('select[name=aucTypevehicle_id_Edit]').val(aucTypevehicle_id);
			var displacement = $('select[name=aucTypevehicle_id_Edit] option:selected').attr('data-displacement');
			var capacity = $('select[name=aucTypevehicle_id_Edit] option:selected').attr('data-capacity');
			$('input[name=heaDisplacement_Edit]').val(displacement);
			$('input[name=heaCapacity_Edit]').val(capacity);
			$('input[name=aucPlate_Edit]').val(aucPlate);
			$('input[name=aucBrand_Edit]').val(aucBrand);
			$('input[name=aucModel_Edit]').val(aucModel);
			$('select[name=aucContractormessenger_id_Edit]').val(aucContractormessenger_id);
			// CONDUCTORES DE AUTOMOTOR ACTUALES
			$('.tbl-drivers-editCharge').find('tbody').empty();
			var find = aucContractormessengers.indexOf(',');
			if(find > -1){
				var separated = aucContractormessengers.split(',');
				$.get("{{ route('getContractormessenger') }}",{ cmId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.tbl-drivers-editCharge').find('tbody').append(
								"<tr class='" + objectDrivers[i][0] + "'>" +
									"<td>" + objectDrivers[i][1] + "</td>" +
									"<td>" + objectDrivers[i][2] + "</td>" +
									"<td>" + objectDrivers[i][3] + "</td>" +
									"<td>" +
										"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editCharge'><i class='fas fa-trash-alt'></i></button>" +
									"</td>" +
								"</tr>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractormessenger') }}",{ cmId: aucContractormessengers, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.tbl-drivers-editCharge').find('tbody').append(
							"<tr class='" + objectDriver['cmId'] + "'>" +
								"<td>" + objectDriver['cmNames'] + "</td>" +
								"<td>" + objectDriver['cmNumberdocument'] + "</td>" +
								"<td>" + objectDriver['cmNumberdriving'] + "</td>" +
								"<td>" +
									"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editCharge'><i class='fas fa-trash-alt'></i></button>" +
								"</td>" +
							"</tr>"
						);
					}
				});
			}
			// IMAGENES DE AUTOMOTOR ACTUALES
			$('img.aucPhotofrontnow_Edit').attr('src',aucFront);
			var findFront = aucFront.indexOf('Default');
			if(findFront > -1){
				$('.aucPhotofrontnot_Edit').css('display','none');
			}else{
				$('.aucPhotofrontnot_Edit').css('display','block');
			}
			$('img.aucPhotosidenow_Edit').attr('src',aucSide);
			var findSide = aucSide.indexOf('Default');
			if(findSide > -1){
				$('.aucPhotosidenot_Edit').css('display','none');
			}else{
				$('.aucPhotosidenot_Edit').css('display','block');
			}
			$('img.aucPhotobacknow_Edit').attr('src',aucBack);
			var findBack = aucBack.indexOf('Default');
			if(findBack > -1){
				$('.aucPhotobacknot_Edit').css('display','none');
			}else{
				$('.aucPhotobacknot_Edit').css('display','block');
			}
			$('#editCharge-modal').modal();
		});

		$('select[name=aucTypevehicle_id_Edit]').on('change',function(e){
			var vehicleSelected = e.target.value;
			$('input[name=heaDisplacement_Edit]').val('');
			$('input[name=heaCapacity_Edit]').val('');
			if(vehicleSelected != ''){
				var displacement = $('select[name=aucTypevehicle_id_Edit] option:Selected').attr('data-displacement');
				var capacity = $('select[name=aucTypevehicle_id_Edit] option:Selected').attr('data-capacity');
				$('input[name=heaDisplacement_Edit]').val(displacement);
				$('input[name=heaCapacity_Edit]').val(capacity);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-editCharge').on('click',function(){
			var cmId = $('select[name=aucContractormessengers_Edit]').val();
			var cmNames = $('select[name=aucContractormessengers_Edit] option:selected').text();
			var cmNumberdocument = $('select[name=aucContractormessengers_Edit] option:selected').attr('data-numberdocument');
			var cmNumberdriving = $('select[name=aucContractormessengers_Edit] option:selected').attr('data-numberdriving');
			if(cmId != ''){
				var validateRepet = false;
				$('.tbl-drivers-editCharge').find('tbody').find('tr').each(function(){
					var idCm = $(this).attr('class');
					if(idCm == cmId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-editCharge').find('tbody').append(
						"<tr class='" + cmId + "'>" +
							"<td>" + cmNames + "</td>" +
							"<td>" + cmNumberdocument + "</td>" +
							"<td>" + cmNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editCharge'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-editCharge').css('display','block');
					$('.infoRepeat-editCharge').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-editCharge').css('display','none');
						$('.infoRepeat-editCharge').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-editCharge').css('display','block');
				$('.infoRepeat-editCharge').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-editCharge').css('display','none');
					$('.infoRepeat-editCharge').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-editCharge').on('click','.btn-deleteDriver-editCharge',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-editDefinitiveCharge').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aucContractormessengers_Edit]').val('');
			$('.tbl-drivers-editCharge').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aucContractormessengers_Edit]').val(allDrivers);
			$(this).submit();
		});

		$('.deleteCharge-link').on('click',function(e){
			e.preventDefault();
			var aucId = $(this).find('span:nth-child(2)').text();
			var aucPhone = $(this).find('span:nth-child(3)').text();
			var heaTypology = $(this).find('span:nth-child(4)').text();
			var heaDisplacement = $(this).find('span:nth-child(5)').text();
			var heaCapacity = $(this).find('span:nth-child(6)').text();
			var heaDescription = $(this).find('span:nth-child(7)').text();
			var aucPlate = $(this).find('span:nth-child(8)').text();
			var aucBrand = $(this).find('span:nth-child(9)').text();
			var aucModel = $(this).find('span:nth-child(10)').text();
			var cmNames = $(this).find('span:nth-child(11)').text();
			var cmNumberdocument = $(this).find('span:nth-child(12)').text();
			var cmNumberdriving = $(this).find('span:nth-child(13)').text();
			var cmMovil = $(this).find('span:nth-child(14)').text();
			var aucContractormessengers = $(this).find('span:nth-child(15)').text();
			var aucFront = String($(this).find('.img-hidden-front').attr('src'));
			var aucSide = String($(this).find('.img-hidden-side').attr('src'));
			var aucBack = String($(this).find('.img-hidden-back').attr('src'));

			$('input[name=aucId_Delete]').val(aucId);
			$('.aucPhone_Delete').text(aucPhone);
			$('.heaTypology_Delete').text(heaTypology);
			$('.heaDisplacement_Delete').text(heaDisplacement);
			$('.heaCapacity_Delete').text(heaCapacity);
			$('.heaDescription_Delete').text(heaDescription);
			$('.aucPlate_Delete').text(aucPlate);
			$('.aucBrand_Delete').text(aucBrand);
			$('.aucModel_Delete').text(aucModel);
			$('.cmNames_Delete').text(cmNames);
			$('.aucContractormessengers_Delete').empty();
			var find = aucContractormessengers.indexOf(',');
			if(find > -1){
				var separated = aucContractormessengers.split(',');
				$.get("{{ route('getContractormessenger') }}",{ cmId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.aucContractormessengers_Delete').append(
								"<li class='list-group-item d-flex flex-column justify-content-between align-items-center'>" +
									"<b><small class='text-muted'>NOMBRE: </small>" + objectDrivers[i][0] + "</b>" +
									"<b><small class='text-muted'>DOCUMENTO: </small>" + objectDrivers[i][1] + "</b>" +
									"<b><small class='text-muted'>LICENCIA: </small>" + objectDrivers[i][2] + "</b>" +
								"</li>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractormessenger') }}",{ cmId: aucContractormessengers, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.aucContractormessengers_Delete').append(
							"<li class='list-group-item d-flex flex-column justify-content-between align-items-center'>" +
								"<b><small class='text-muted'>NOMBRE: </small>" + objectDriver['cmNames'] + "</b>" +
								"<b><small class='text-muted'>DOCUMENTO: </small>" + objectDriver['cmNumberdocument'] + "</b>" +
								"<b><small class='text-muted'>LICENCIA: </small>" + objectDriver['cmNumberdriving'] + "</b>" +
							"</li>"
						);
					}
				});
			}
			$('img.aucPhotofront_Delete').attr('src',aucFront);
			$('img.aucPhotoside_Delete').attr('src',aucSide);
			$('img.aucPhotoback_Delete').attr('src',aucBack);
			$('#deleteCharge-modal').modal();
		});
	</script>
@endsection