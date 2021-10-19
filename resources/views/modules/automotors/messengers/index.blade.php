@extends('modules.administrativeAutomotors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>MENSAJERIA AUTOMOTOR</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar mensajeria automotor" class="bj-btn-table-add form-control-sm newMessenger-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessMessengers'))
				    <div class="alert alert-success">
				        {{ session('SuccessMessengers') }}
				    </div>
				@endif
				@if(session('PrimaryMessengers'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryMessengers') }}
				    </div>
				@endif
				@if(session('WarningMessengers'))
				    <div class="alert alert-warning">
				        {{ session('WarningMessengers') }}
				    </div>
				@endif
				@if(session('SecondaryMessengers'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryMessengers') }}
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
				@foreach($automotorsmessengers as $messenger)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $messenger->aumPlate }}</td>
					<td>{{ $messenger->cmNames }}</td>
					<td>{{ $messenger->aumPhone }}</td>
					<td>
						<a href="#" title="Editar mensajería automotor" class="bj-btn-table-edit form-control-sm editMessenger-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $messenger->aumId }}</span>
							<span hidden>{{ $messenger->aumPhone }}</span>
							<span hidden>{{ $messenger->aumMotorcycle_id }}</span>
							<span hidden>{{ $messenger->aumPlate }}</span>
							<span hidden>{{ $messenger->aumBrand }}</span>
							<span hidden>{{ $messenger->aumModel }}</span>
							<span hidden>{{ $messenger->aumContractormessenger_id }}</span>
							<span hidden>{{ $messenger->aumContractormessengers }}</span>
							<img src="{{ asset('storage/automotorsMessenger/front/'.$messenger->aumPhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsMessenger/side/'.$messenger->aumPhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsMessenger/back/'.$messenger->aumPhotoback) }}" class="img-hidden-back" hidden>
						</a>
						<a href="#" title="Eliminar mensajería automotor" class="bj-btn-table-delete form-control-sm deleteMessenger-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $messenger->aumId }}</span>
							<span hidden>{{ $messenger->aumPhone }}</span>
							<span hidden>{{ $messenger->motTypology }}</span>
							<span hidden>{{ $messenger->motDisplacement }}</span>
							<span hidden>{{ $messenger->motTimes }}</span>
							<span hidden>{{ $messenger->motDescription }}</span>
							<span hidden>{{ $messenger->aumPlate }}</span>
							<span hidden>{{ $messenger->aumBrand }}</span>
							<span hidden>{{ $messenger->aumModel }}</span>
							<span hidden>{{ $messenger->cmNames }}</span>
							<span hidden>{{ $messenger->cmNumberdocument }}</span>
							<span hidden>{{ $messenger->cmNumberdriving }}</span>
							<span hidden>{{ $messenger->cmMovil }}</span>
							<span hidden>{{ $messenger->aumContractormessengers }}</span>
							<img src="{{ asset('storage/automotorsMessenger/front/'.$messenger->aumPhotofront) }}" class="img-hidden-front" hidden>
							<img src="{{ asset('storage/automotorsMessenger/side/'.$messenger->aumPhotoside) }}" class="img-hidden-side" hidden>
							<img src="{{ asset('storage/automotorsMessenger/back/'.$messenger->aumPhotoback) }}" class="img-hidden-back" hidden>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newMessenger-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA MENSAJERIA AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.messengers.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE MOTOCICLETA:</small>
											<select name="aumMotorcycle_id" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de motocicleta ...</option>
												@foreach($motorcycles as $motorcycle)
													<option value="{{ $motorcycle->motId }}" data-displacement="{{ $motorcycle->motDisplacement }}" data-times="{{ $motorcycle->motTimes }}" data-description="{{ $motorcycle->motDescription }}">
														{{ $motorcycle->motTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="motDisplacement" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIEMPOS:</small>
											<input type="text" name="motTimes" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="aumPlate" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aumBrand" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aumModel" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aumContractormessenger_id" class="form-control form-control-sm" required>
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
											<input type="text" name="aumPhone" maxlength="10" class="form-control form-control-sm" required>
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
													<select name="aumContractormessengers_new" class="form-control form-control-sm">
														<option value="">Seleccione conductor ...</option>
														@foreach($contractorsmessengers as $contractorsmessenger)
															<option value="{{ $contractorsmessenger->cmId }}" data-numberdocument="{{ $contractorsmessenger->cmNumberdocument }}" data-numberdriving="{{ $contractorsmessenger->cmNumberdriving }}">{{ $contractorsmessenger->cmNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-newMessenger" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-newMessenger" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-newMessenger" width="100%" style="font-size: 12px;">
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
										        <input type="file" name="aumPhotoback" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTO DE LADO:</small>
											<div class="custom-file">
										        <input type="file" name="aumPhotoside" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FOTO DE FRENTE:</small>
											<div class="custom-file">
										        <input type="file" name="aumPhotofront" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="aumContractormessengers" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-newDefinitiveMessenger">REGISTRAR AUTOMOTOR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editMessenger-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>EDITAR MENSAJERIA DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('automotors.messengers.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE MOTOCICLETA:</small>
											<select name="aumMotorcycle_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de motocicleta ...</option>
												@foreach($motorcycles as $motorcycle)
													<option value="{{ $motorcycle->motId }}"
														data-displacement="{{ $motorcycle->motDisplacement }}"
														data-times="{{ $motorcycle->motTimes }}"
														data-description="{{ $motorcycle->motDescription }}"
													>
														{{ $motorcycle->motTypology }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CILINDRAJE:</small>
											<input type="text" name="motDisplacement_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIEMPOS:</small>
											<input type="text" name="motTimes_Edit" class="form-control form-control-sm" disabled required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">PLACA:</small>
											<input type="text" name="aumPlate_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MARCA:</small>
											<input type="text" name="aumBrand_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">MODELO:</small>
											<input type="text" name="aumModel_Edit" maxlength="10" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PROPIETARIO:</small>
											<select name="aumContractormessenger_id_Edit" class="form-control form-control-sm" required>
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
											<input type="text" name="aumPhone_Edit" maxlength="10" class="form-control form-control-sm" required>
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
													<select name="aumContractormessengers_Edit" class="form-control form-control-sm">
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
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDriver-editMessenger" title='AGREGUE CONDUCTOR OPERADOR'>Agregar conductor</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeat-editMessenger" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-drivers-editMessenger" width="100%" style="font-size: 12px;">
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
										    <img src="" class="img-responsive img-thumbnail text-center aumPhotobacknow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aumPhotobacknot_Edit">
												<input type="checkbox" name="aumPhotobacknot_Edit" value="SIN FOTO">
												Quitar foto de atras
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO DE LADO ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center aumPhotosidenow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aumPhotosidenot_Edit">
												<input type="checkbox" name="aumPhotosidenot_Edit" value="SIN FOTO">
												Quitar foto de lado
											</small>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										    <small class="text-muted">FOTO FRENTE ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center aumPhotofrontnow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted aumPhotofrontnot_Edit">
												<input type="checkbox" name="aumPhotofrontnot_Edit" value="SIN FOTO">
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
												        <input type="file" name="aumPhotoback_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTO DE LADO:</small>
													<div class="custom-file">
												        <input type="file" name="aumPhotoside_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
												    </div>
												</div>
											</div>
										</div>
										<div class="row text-center">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">FOTO DE FRENTE:</small>
													<div class="custom-file">
												        <input type="file" name="aumPhotofront_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
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
								<input type="hidden" name="aumContractormessengers_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="aumId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3 btn-editDefinitiveMessenger">GUARDAR CAMBIOS</button>
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

	<div class="modal fade" id="deleteMessenger-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION/DETALLES DE MENSAJERIA DE AUTOMOTOR:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">TIPO DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="motTypology_Delete"></b></span><br>
							<small class="text-muted">CILINDRAJE: </small><br>
							<span class="text-muted"><b class="motDisplacement_Delete"></b></span><br>
							<small class="text-muted">TIEMPOS: </small><br>
							<span class="text-muted"><b class="motTimes_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE PLACA: </small><br>
							<span class="text-muted"><b class="aumPlate_Delete"></b></span><br>
							<small class="text-muted">MARCA DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="aumBrand_Delete"></b></span><br>
							<small class="text-muted">MODELO DE MOTOCICLETA: </small><br>
							<span class="text-muted"><b class="aumModel_Delete"></b></span><br>
							<small class="text-muted">PROPIETARIO: </small><br>
							<span class="text-muted"><b class="cmNames_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE CONTACTO: </small><br>
							<span class="text-muted"><b class="aumPhone_Delete"></b></span><br>
							<hr>
							<small class="text-muted">CONDUCTORES OPERADORES: </small><br>
							<ul class="list-group aumContractormessengers_Delete">
								<!-- Li dinamics -->
							</ul>
						</div>
						<div class="col-md-6">
							<small class="text-muted">FOTO FRENTE: </small><br>
							<img src="" class="img-responsive img-thumbnail aumPhotofront_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO LADO: </small><br>
							<img src="" class="img-responsive img-thumbnail aumPhotoside_Delete" style="width: 100%; height: auto;">
							<small class="text-muted">FOTO ATRAS: </small><br>
							<img src="" class="img-responsive img-thumbnail aumPhotoback_Delete" style="width: 100%; height: auto;">
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('automotors.messengers.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="aumId_Delete" value="" required>
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

		$('.newMessenger-link').on('click',function(){
			$('#newMessenger-modal').modal();
		});

		$('select[name=aumMotorcycle_id]').on('change',function(e){
			var motorcycleSelected = e.target.value;
			$('input[name=motDisplacement]').val('');
			$('input[name=motTImes]').val('');
			if(motorcycleSelected != ''){
				var displacement = $('select[name=aumMotorcycle_id] option:Selected').attr('data-displacement');
				var times = $('select[name=aumMotorcycle_id] option:Selected').attr('data-times');
				$('input[name=motDisplacement]').val(displacement);
				$('input[name=motTimes]').val(times);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-newMessenger').on('click',function(){
			var cmId = $('select[name=aumContractormessengers_new]').val();
			var cmNames = $('select[name=aumContractormessengers_new] option:selected').text();
			var cmNumberdocument = $('select[name=aumContractormessengers_new] option:selected').attr('data-numberdocument');
			var cmNumberdriving = $('select[name=aumContractormessengers_new] option:selected').attr('data-numberdriving');
			if(cmId != ''){
				var validateRepet = false;
				$('.tbl-drivers-newMessenger').find('tbody').find('tr').each(function(){
					var idCm = $(this).attr('class');
					if(idCm == cmId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-newMessenger').find('tbody').append(
						"<tr class='" + cmId + "'>" +
							"<td>" + cmNames + "</td>" +
							"<td>" + cmNumberdocument + "</td>" +
							"<td>" + cmNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-newMessenger'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-newMessenger').css('display','block');
					$('.infoRepeat-newMessenger').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-newMessenger').css('display','none');
						$('.infoRepeat-newMessenger').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-newMessenger').css('display','block');
				$('.infoRepeat-newMessenger').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-newMessenger').css('display','none');
					$('.infoRepeat-newMessenger').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-newMessenger').on('click','.btn-deleteDriver-newMessenger',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-newDefinitiveMessenger').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aumContractormessengers]').val('');
			$('.tbl-drivers-newMessenger').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aumContractormessengers]').val(allDrivers);
			$(this).submit();
		});

		$('.editMessenger-link').on('click',function(e){
			e.preventDefault();
			var aumId = $(this).find('span:nth-child(2)').text();
			var aumPhone = $(this).find('span:nth-child(3)').text();
			var aumMotorcycle_id = $(this).find('span:nth-child(4)').text();
			var aumPlate = $(this).find('span:nth-child(5)').text();
			var aumBrand = $(this).find('span:nth-child(6)').text();
			var aumModel = $(this).find('span:nth-child(7)').text();
			var aumContractormessenger_id = $(this).find('span:nth-child(8)').text();
			var aumContractormessengers = $(this).find('span:nth-child(9)').text();
			var aumFront = String($(this).find('.img-hidden-front').attr('src'));
			var aumSide = String($(this).find('.img-hidden-side').attr('src'));
			var aumBack = String($(this).find('.img-hidden-back').attr('src'));
			$('input[name=aumId_Edit]').val(aumId);
			$('input[name=aumPhone_Edit]').val(aumPhone);
			$('select[name=aumMotorcycle_id_Edit]').val(aumMotorcycle_id);
			var displacement = $('select[name=aumMotorcycle_id_Edit] option:selected').attr('data-displacement');
			var times = $('select[name=aumMotorcycle_id_Edit] option:selected').attr('data-times');
			$('input[name=motDisplacement_Edit]').val(displacement);
			$('input[name=motTimes_Edit]').val(times);
			$('input[name=aumPlate_Edit]').val(aumPlate);
			$('input[name=aumBrand_Edit]').val(aumBrand);
			$('input[name=aumModel_Edit]').val(aumModel);
			$('select[name=aumContractormessenger_id_Edit]').val(aumContractormessenger_id);
			// CONDUCTORES DE AUTOMOTOR ACTUALES
			var find = aumContractormessengers.indexOf(',');
			if(find > -1){
				var separated = aumContractormessengers.split(',');
				$.get("{{ route('getContractormessenger') }}",{ cmId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.tbl-drivers-editMessenger').find('tbody').append(
								"<tr class='" + objectDrivers[i][0] + "'>" +
									"<td>" + objectDrivers[i][1] + "</td>" +
									"<td>" + objectDrivers[i][2] + "</td>" +
									"<td>" + objectDrivers[i][3] + "</td>" +
									"<td>" +
										"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editMessenger'><i class='fas fa-trash-alt'></i></button>" +
									"</td>" +
								"</tr>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractormessenger') }}",{ cmId: aumContractormessengers, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.tbl-drivers-editMessenger').find('tbody').append(
							"<tr class='" + objectDriver['cmId'] + "'>" +
								"<td>" + objectDriver['cmNames'] + "</td>" +
								"<td>" + objectDriver['cmNumberdocument'] + "</td>" +
								"<td>" + objectDriver['cmNumberdriving'] + "</td>" +
								"<td>" +
									"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editMessenger'><i class='fas fa-trash-alt'></i></button>" +
								"</td>" +
							"</tr>"
						);
					}
				});
			}
			// IMAGENES DE AUTOMOTOR ACTUALES
			$('img.aumPhotofrontnow_Edit').attr('src',aumFront);
			var findFront = aumFront.indexOf('Default');
			if(findFront > -1){
				$('.aumPhotofrontnot_Edit').css('display','none');
			}else{
				$('.aumPhotofrontnot_Edit').css('display','block');
			}
			$('img.aumPhotosidenow_Edit').attr('src',aumSide);
			var findSide = aumSide.indexOf('Default');
			if(findSide > -1){
				$('.aumPhotosidenot_Edit').css('display','none');
			}else{
				$('.aumPhotosidenot_Edit').css('display','block');
			}
			$('img.aumPhotobacknow_Edit').attr('src',aumBack);
			var findBack = aumBack.indexOf('Default');
			if(findBack > -1){
				$('.aumPhotobacknot_Edit').css('display','none');
			}else{
				$('.aumPhotobacknot_Edit').css('display','block');
			}
			$('#editMessenger-modal').modal();
		});

		$('select[name=aumMotorcycle_id_Edit]').on('change',function(e){
			var motorcycleSelected = e.target.value;
			$('input[name=motDisplacement_Edit]').val('');
			$('input[name=motTimes_Edit]').val('');
			if(motorcycleSelected != ''){
				var displacement = $('select[name=aumMotorcycle_id_Edit] option:Selected').attr('data-displacement');
				var times = $('select[name=aumMotorcycle_id_Edit] option:Selected').attr('data-times');
				$('input[name=motDisplacement_Edit]').val(displacement);
				$('input[name=motTimes_Edit]').val(times);
			}
		});

		// BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
		$('.btn-addDriver-editMessenger').on('click',function(){
			var cmId = $('select[name=aumContractormessengers_Edit]').val();
			var cmNames = $('select[name=aumContractormessengers_Edit] option:selected').text();
			var cmNumberdocument = $('select[name=aumContractormessengers_Edit] option:selected').attr('data-numberdocument');
			var cmNumberdriving = $('select[name=aumContractormessengers_Edit] option:selected').attr('data-numberdriving');
			if(cmId != ''){
				var validateRepet = false;
				$('.tbl-drivers-editMessenger').find('tbody').find('tr').each(function(){
					var idCm = $(this).attr('class');
					if(idCm == cmId){
						validateRepet = true;
					}
				});
				if(validateRepet == false){
					$('.tbl-drivers-editMessenger').find('tbody').append(
						"<tr class='" + cmId + "'>" +
							"<td>" + cmNames + "</td>" +
							"<td>" + cmNumberdocument + "</td>" +
							"<td>" + cmNumberdriving + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDriver-editMessenger'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat-editMessenger').css('display','block');
					$('.infoRepeat-editMessenger').text('Conductor repetido');
					setTimeout(function(){
						$('.infoRepeat-editMessenger').css('display','none');
						$('.infoRepeat-editMessenger').text('');
					},3000);
				}
			}else{
				$('.infoRepeat-editMessenger').css('display','block');
				$('.infoRepeat-editMessenger').text('Seleccione un conductor');
				setTimeout(function(){
					$('.infoRepeat-editMessenger').css('display','none');
					$('.infoRepeat-editMessenger').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-drivers-editMessenger').on('click','.btn-deleteDriver-editMessenger',function(){
			$(this).parents('tr').remove();
		});

		$('.btn-editDefinitiveMessenger').on('click',function(e){
			// e.preventDefault();
			var allDrivers = '';
			$('input[name=aumContractormessengers_Edit]').val('');
			$('.tbl-drivers-editMessenger').find('tbody').find('tr').each(function(){
				var driver = $(this).attr('class');
				allDrivers += driver + ',';
			});
			$('input[name=aumContractormessengers_Edit]').val(allDrivers);
			$(this).submit();
		});

		$('.deleteMessenger-link').on('click',function(e){
			e.preventDefault();
			var aumId = $(this).find('span:nth-child(2)').text();
			var aumPhone = $(this).find('span:nth-child(3)').text();
			var motTypology = $(this).find('span:nth-child(4)').text();
			var motDisplacement = $(this).find('span:nth-child(5)').text();
			var motTimes = $(this).find('span:nth-child(6)').text();
			var motDescription = $(this).find('span:nth-child(7)').text();
			var aumPlate = $(this).find('span:nth-child(8)').text();
			var aumBrand = $(this).find('span:nth-child(9)').text();
			var aumModel = $(this).find('span:nth-child(10)').text();
			var cmNames = $(this).find('span:nth-child(11)').text();
			var cmNumberdocument = $(this).find('span:nth-child(12)').text();
			var cmNumberdriving = $(this).find('span:nth-child(13)').text();
			var cmMovil = $(this).find('span:nth-child(14)').text();
			var aumContractormessengers = $(this).find('span:nth-child(15)').text();
			var aumFront = String($(this).find('.img-hidden-front').attr('src'));
			var aumSide = String($(this).find('.img-hidden-side').attr('src'));
			var aumBack = String($(this).find('.img-hidden-back').attr('src'));

			$('input[name=aumId_Delete]').val(aumId);
			$('.aumPhone_Delete').text(aumPhone);
			$('.motTypology_Delete').text(motTypology);
			$('.motDisplacement_Delete').text(motDisplacement);
			$('.motTimes_Delete').text(motTimes);
			$('.motDescription_Delete').text(motDescription);
			$('.aumPlate_Delete').text(aumPlate);
			$('.aumBrand_Delete').text(aumBrand);
			$('.aumModel_Delete').text(aumModel);
			$('.cmNames_Delete').text(cmNames);
			$('.aumContractormessengers_Delete').empty();
			var find = aumContractormessengers.indexOf(',');
			if(find > -1){
				var separated = aumContractormessengers.split(',');
				$.get("{{ route('getContractormessenger') }}",{ cmId: separated, unique: false },function(objectDrivers){
					var count = Object.keys(objectDrivers).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.aumContractormessengers_Delete').append(
								"<li class='list-group-item d-flex justify-content-between align-items-center'>" +
									"<b>NOMBRE:</b>" + objectDrivers[i][1] +
								"</li>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getContractormessenger') }}",{ cmId: aumContractormessengers, unique: true },function(objectDriver){
					if(objectDriver != null && objectDriver != 'N/A'){
						$('.aumContractormessengers_Delete').append(
							"<li class='list-group-item d-flex flex-column justify-content-between align-items-center'>" +
								"<b><small class='text-muted'>NOMBRE: </small>" + objectDriver['cmNames'] + "</b>" +
								"<b><small class='text-muted'>DOCUMENTO: </small>" + objectDriver['cmNumberdocument'] + "</b>" +
								"<b><small class='text-muted'>LICENCIA: </small>" + objectDriver['cmNumberdriving'] + "</b>" +
							"</li>"
						);
					}
				});
			}
			$('img.aumPhotofront_Delete').attr('src',aumFront);
			$('img.aumPhotoside_Delete').attr('src',aumSide);
			$('img.aumPhotoback_Delete').attr('src',aumBack);
			$('#deleteMessenger-modal').modal();
		});
	</script>
@endsection