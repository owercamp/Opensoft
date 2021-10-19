@extends('modules.settingServices')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>TRASLADOS INTERMUNICIPALES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar traslado" class="bj-btn-table-add form-control-sm newTransfer-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessTransfer'))
				    <div class="alert alert-success">
				        {{ session('SuccessTransfer') }}
				    </div>
				@endif
				@if(session('PrimaryTransfer'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryTransfer') }}
				    </div>
				@endif
				@if(session('WarningTransfer'))
				    <div class="alert alert-warning">
				        {{ session('WarningTransfer') }}
				    </div>
				@endif
				@if(session('SecondaryTransfer'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryTransfer') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>SERVICIO</th>
					<th>ORIGEN</th>
					<th>RECORRIDO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($transfers as $transfer)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $transfer->stmService }}</td>
					<td>{{ $transfer->munName }}</td>
					<td>{{ $transfer->stmKilometres }} Kilometros</td>
					<td>
						<a href="#" title="Editar traslado {{ $transfer->stmService }}" class="bj-btn-table-edit form-control-sm editTransfer-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $transfer->stmId }}</span>
							<span hidden>{{ $transfer->stmTypeproduct_id }}</span>
							<span hidden>{{ $transfer->stmService }}</span>
							<span hidden>{{ $transfer->stmTimeavailability }}</span>
							<span hidden>{{ $transfer->stmMunstart_id }}</span>
							<span hidden>{{ $transfer->stmMunicipilityends }}</span>
							<span hidden>{{ $transfer->stmKilometres }}</span>
							<span hidden>{{ $transfer->stmDescription }}</span>
						</a>
						<a href="#" title="Eliminar traslado {{ $transfer->stmService }}" class="bj-btn-table-delete form-control-sm deleteTransfer-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $transfer->stmId }}</span>
							<span hidden>{{ $transfer->ptmProduct }}</span>
							<span hidden>{{ $transfer->stmService }}</span>
							<span hidden>{{ $transfer->stmTimeavailability }}</span>
							<span hidden>{{ $transfer->munName }}</span>
							<span hidden>{{ $transfer->stmMunicipilityends }}</span>
							<span hidden>{{ $transfer->stmKilometres }}</span>
							<span hidden>{{ $transfer->stmDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVO TRASLADO INTERMUNICIPAL DE SERVICIOS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.transfersmunicipals.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="stmTypeproduct_id" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($productstransfers as $productstransfer)
											<option value="{{ $productstransfer->ptmId }}">{{ $productstransfer->ptmProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="stmService" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="stmTimeavailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 50 Horas" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MUNICIPIO ORIGEN:</small>
									<select name="stmMunstart_id" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($municipalities as $municipality)
											<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
										@endforeach
									</select>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO DESTINO:</small>
											<select name="stmMunicipilityend_id_new" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($municipalities as $municipality)
													<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDestiny-newTransfermunicipality" title='AGREGUE DESTINOS'>Agregar destino</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-destiny-newTransfermunicipality" width="100%" style="font-size: 12px;">
											<thead>
												<th>#</th>
												<th>DESTINO</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- munId, munName -->
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group">
									<small class="text-muted">KILOMETROS DE RECORRIDO:</small>
									<input type="text" name="stmKilometres" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Ej. 125" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="stmDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de recorrido express" required></textarea>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<input type="hidden" name="stmMunicipilityends" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>EDITAR TRASLADO INTERMUNICIPAL DE SERVICIOS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.transfersmunicipals.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="stmTypeproduct_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($productstransfers as $productstransfer)
											<option value="{{ $productstransfer->ptmId }}">{{ $productstransfer->ptmProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="stmService_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="stmTimeavailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 50 Horas" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MUNICIPIO ORIGEN:</small>
									<select name="stmMunstart_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($municipalities as $municipality)
											<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
										@endforeach
									</select>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO DESTINO:</small>
											<select name="stmMunicipilityend_id_edit" class="form-control form-control-sm">
												<option value="">Seleccione ...</option>
												@foreach($municipalities as $municipality)
													<option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addDestiny-editTransfermunicipality" title='AGREGUE DESTINOS'>Agregar destino</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="infoRepeat_Edit" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table text-center border-bottom tbl-destiny-editTransfermunicipality" width="100%" style="font-size: 12px;">
											<thead>
												<th>#</th>
												<th>DESTINO</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- munId, munName -->
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group">
									<small class="text-muted">KILOMETROS DE RECORRIDO:</small>
									<input type="text" name="stmKilometres_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Ej. 125" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="stmDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de recorrido express" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" name="stmMunicipilityends_Edit" class="form-control form-control-sm" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="stmId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3 btn-editDefinitive">GUARDAR CAMBIOS</button>
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

	<div class="modal fade" id="deleteTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE TRASLADO INTERMUNICIPAL DE SERVICIOS:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">TIPO DE PRODUCTO: </small><br>
							<span class="text-muted"><b class="stmTypeproduct_id_Delete"></b></span><br>
							<small class="text-muted">SERVICIO: </small><br>
							<span class="text-muted"><b class="stmService_Delete"></b></span><br>
							<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
							<span class="text-muted"><b class="stmTimeavailability_Delete"></b></span><br>
							<small class="text-muted">ORIGEN: </small><br>
							<span class="text-muted"><b class="stmMunstart_id_Delete"></b></span><br>
							<small class="text-muted">DESTINOS: </small><br>
							<ul class="list-group stmMunicipilityends_Delete">
								
							</ul>
							<small class="text-muted">KILOMETROS DE RECORRIDO: </small><br>
							<span class="text-muted"><b class="stmKilometres_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="stmDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('services.transfersmunicipals.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="stmId_Delete" value="" required>
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

		$('.newTransfer-link').on('click',function(){
			$('.tbl-destiny-newTransfermunicipality').find('tbody').empty();
			$('#newTransfer-modal').modal();
		});

		// BOTON PARA AGREGAR DESTINOS A NUEVO REGISTRO DE TRASLADO INTERMUNICIPAL
		$('.btn-addDestiny-newTransfermunicipality').on('click',function(){
			var munId = $('select[name=stmMunicipilityend_id_new]').val();
			var munName = $('select[name=stmMunicipilityend_id_new] option:selected').text();
			var validateRepet = false;
			$('.tbl-destiny-newTransfermunicipality').find('tbody').find('tr').each(function(){
				var idMun = $(this).attr('class');
				if(idMun == munId){
					validateRepet = true;
				}
			});
			if(munId != ''){
				if(validateRepet == false){
					$('.tbl-destiny-newTransfermunicipality').find('tbody').append(
						"<tr class='" + munId + "' data-idDestiny='" + munId + "'>" +
							"<td>" + munName + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDestiny-newTransfermunicipality'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat').css('display','block');
					$('.infoRepeat').text('Destino repetido');
					setTimeout(function(){
						$('.infoRepeat').css('display','none');
						$('.infoRepeat').text('');
					},3000);
				}
			}else{
				$('.infoRepeat').css('display','block');
				$('.infoRepeat').text('Seleccione un destino');
				setTimeout(function(){
					$('.infoRepeat').css('display','none');
					$('.infoRepeat').text('');
				},3000);
			}
		});

		// EVENTO PARA CLICK EN MODAL, GUARDAR EL NUEVO REGISTRO DE TRASLADO INTERMUNICIPAL
		$('.btn-saveDefinitive').on('click',function(e){
			// e.preventDefault();
			var allMunicipalities = '';
			$('input[name=stmMunicipilityends]').val('');
			$('.tbl-destiny-newTransfermunicipality').find('tbody').find('tr').each(function(){
				var idMunicipality = $(this).attr('data-idDestiny');
				allMunicipalities += idMunicipality + '=';
			});
			$('input[name=stmMunicipilityends]').val(allMunicipalities);
			$(this).submit();
		});

		// BOTON DE TABLA DE DESTINOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-destiny-newTransfermunicipality').on('click','.btn-deleteDestiny-newTransfermunicipality',function(){
			$(this).parents('tr').remove();
		});

		$('.editTransfer-link').on('click',function(e){
			e.preventDefault();
			var stmId = $(this).find('span:nth-child(2)').text();
			var stmTypeproduct_id = $(this).find('span:nth-child(3)').text();
			var stmService = $(this).find('span:nth-child(4)').text();
			var stmTimeavailability = $(this).find('span:nth-child(5)').text();
			var stmMunstart_id = $(this).find('span:nth-child(6)').text();
			var stmMunicipilityends = $(this).find('span:nth-child(7)').text();
			var stmKilometres = $(this).find('span:nth-child(8)').text();
			var stmDescription = $(this).find('span:nth-child(9)').text();
			$('input[name=stmId_Edit]').val(stmId);
			$('select[name=stmTypeproduct_id_Edit]').val(stmTypeproduct_id);
			$('input[name=stmService_Edit]').val(stmService);
			$('input[name=stmTimeavailability_Edit]').val(stmTimeavailability);
			$('select[name=stmMunstart_id_Edit]').val(stmMunstart_id);
			$('.tbl-destiny-editTransfermunicipality').find('tbody').empty();
			var find = stmMunicipilityends.indexOf('=');
			if(find > -1){
				var separated = stmMunicipilityends.split('=');
				$.get("{{ route('getMunicipalitiesFromTransfer') }}",{ munId: separated, unique: false },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('.tbl-destiny-editTransfermunicipality').find('tbody').append(
								"<tr class='" + objectMunicipalities[i][0] + "'>" +
									"<td>" + objectMunicipalities[i][1] + "</td>" +
									"<td>" +
										"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDestiny-editTransfermunicipality'><i class='fas fa-trash-alt'></i></button>" +
									"</td>" +
								"</tr>"
							);
						}
					}
				});
			}else{
				$.get("{{ route('getMunicipalitiesFromTransfer') }}",{ munId: stmMunicipilityends, unique: true },function(objectMunicipality){
					if(objectMunicipality != null && objectMunicipality != 'N/A'){
						$('.tbl-destiny-editTransfermunicipality').find('tbody').append(
							"<tr class='" + objectMunicipality['munId'] + "'>" +
								"<td>" + objectMunicipality['munName'] + "</td>" +
								"<td>" +
									"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDestiny-editTransfermunicipality'><i class='fas fa-trash-alt'></i></button>" +
								"</td>" +
							"</tr>"
						);
					}
				});
			}
			$('input[name=stmKilometres_Edit]').val(stmKilometres);
			$('textarea[name=stmDescription_Edit]').val(stmDescription);
			$('#editTransfer-modal').modal();
		});

		// BOTON PARA AGREGAR DESTINOS A NUEVO REGISTRO DE TRASLADO INTERMUNICIPAL
		$('.btn-addDestiny-editTransfermunicipality').on('click',function(){
			var munId = $('select[name=stmMunicipilityend_id_edit]').val();
			var munName = $('select[name=stmMunicipilityend_id_edit] option:selected').text();
			var validateRepet = false;
			$('.tbl-destiny-editTransfermunicipality').find('tbody').find('tr').each(function(){
				var idMun = $(this).attr('class');
				if(idMun == munId){
					validateRepet = true;
				}
			});
			if(munId != ''){
				if(validateRepet == false){
					$('.tbl-destiny-editTransfermunicipality').find('tbody').append(
						"<tr class='" + munId + "' data-idDestiny='" + munId + "'>" +
							"<td>" + munName + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteDestiny-editTransfermunicipality'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeat_Edit').css('display','block');
					$('.infoRepeat_Edit').text('Destino repetido');
					setTimeout(function(){
						$('.infoRepeat_Edit').css('display','none');
						$('.infoRepeat_Edit').text('');
					},3000);
				}
			}else{
				$('.infoRepeat_Edit').css('display','block');
				$('.infoRepeat_Edit').text('Seleccione un destino');
				setTimeout(function(){
					$('.infoRepeat_Edit').css('display','none');
					$('.infoRepeat_Edit').text('');
				},3000);
			}
		});

		// EVENTO PARA CLICK EN MODAL, GUARDAR EL NUEVO REGISTRO DE TRASLADO INTERMUNICIPAL
		$('.btn-editDefinitive').on('click',function(e){
			// e.preventDefault();
			var allMunicipalities = '';
			$('input[name=stmMunicipilityends_Edit]').val('');
			$('.tbl-destiny-editTransfermunicipality').find('tbody').find('tr').each(function(){
				var idMunicipality = $(this).attr('class');
				allMunicipalities += idMunicipality + '=';
			});
			$('input[name=stmMunicipilityends_Edit]').val(allMunicipalities);
			$(this).submit();
		});

		// BOTON DE TABLA DE DESTINOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-destiny-editTransfermunicipality').on('click','.btn-deleteDestiny-editTransfermunicipality',function(){
			$(this).parents('tr').remove();
		});

		$('.deleteTransfer-link').on('click',function(e){
			e.preventDefault();
			var stmId = $(this).find('span:nth-child(2)').text();
			var stmTypeproduct_id = $(this).find('span:nth-child(3)').text();
			var stmService = $(this).find('span:nth-child(4)').text();
			var stmTimeavailability = $(this).find('span:nth-child(5)').text();
			var stmMunstart_id = $(this).find('span:nth-child(6)').text();
			var stmMunicipilityends = $(this).find('span:nth-child(7)').text();
			var stmKilometres = $(this).find('span:nth-child(8)').text();
			var stmDescription = $(this).find('span:nth-child(9)').text();
			$('input[name=stmId_Delete]').val(stmId);
			$('.stmTypeproduct_id_Delete').text(stmTypeproduct_id);
			$('.stmService_Delete').text(stmService);
			$('.stmTimeavailability_Delete').text(stmTimeavailability);
			$('.stmMunstart_id_Delete').text(stmMunstart_id);
			$('.stmMunicipilityends_Delete').empty();
			var len = stmMunicipilityends.length;
			if(stmMunicipilityends != null && stmMunicipilityends != 0 && len > 0){
				var find = stmMunicipilityends.indexOf('=');
				if(find > -1){
					var separated = stmMunicipilityends.split('=');
					$.get("{{ route('getMunicipalitiesFromTransfer') }}",{ munId: separated, unique: false },function(objectMunicipalities){
						var count = Object.keys(objectMunicipalities).length;
						if(count > 0){
							for (var i = 0; i < count; i++) {
								$('.stmMunicipilityends_Delete').append(
									"<li class='list-group-item d-flex justify-content-between align-items-center'>" +
										"<b>" + objectMunicipalities[i][1] + "</b>" +
									"</li>"
								);
							}
						}
					});
				}else{
					$.get("{{ route('getMunicipalitiesFromTransfer') }}",{ munId: stmMunicipilityends, unique: true },function(objectMunicipality){
						if(objectMunicipality != null && objectMunicipality != 'N/A'){
							$('.stmMunicipilityends_Delete').append(
								"<li class='list-group-item d-flex flex-column justify-content-between align-items-center'>" +
									"<b>" + objectMunicipality['munName'] + "</b>" +
								"</li>"
							);
						}
					});
				}
			}else{
				$('.stmMunicipilityends_Delete').append(
					"<li class='list-group-item d-flex justify-content-between align-items-center'>" +
						"<b class='text-muted text-center'>N/A</b>" +
					"</li>"
				);
			}
			$('.stmKilometres_Delete').text(stmKilometres + ' Kilometros');
			$('.stmDescription_Delete').text(stmDescription);
			$('#deleteTransfer-modal').modal();
		});
	</script>
@endsection