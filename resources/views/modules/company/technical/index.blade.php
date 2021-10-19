@extends('modules.administrativeCompany')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h5>INFORMACION TECNICA</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessTechnical'))
				    <div class="alert alert-success">
				        {{ session('SuccessTechnical') }}
				    </div>
				@endif
				@if(session('PrimaryTechnical'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryTechnical') }}
				    </div>
				@endif
				@if(session('WarningTechnical'))
				    <div class="alert alert-warning">
				        {{ session('WarningTechnical') }}
				    </div>
				@endif
				@if(session('SecondaryTechnical'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryTechnical') }}
				    </div>
				@endif
			</div>
		</div>
		@if(isset($technical))
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<table class="table" width="100%" style="font-size: 12px;">
								<tbody>
									<tr>
										<th colspan="2" class="text-right">RESOLUCION DE HABILITACION MINISTERIO DE TRANSPORTE</th>
										<td class="text-left">{{ $technical->teResolutiontransport }}</td>
									</tr>
									<tr>
										<th colspan="2" class="text-right">FECHA DE RESOLUCION</th>
										<td class="text-left">{{ $technical->teDateresolutiontransport }}</td>
									</tr>
									<tr>
										<th colspan="2" class="text-right">RESOLUCION DE CAPACIDAD TRANSPORTADORA DEL MINISTERIO DE TRANSPORTE:</th>
										<td class="text-left">{{ $technical->teResolutioncapacity }}</td>
									</tr>
									<tr>
										<th colspan="2" class="text-right">FECHA DE RESOLUCION:</th>
										<td class="text-left">{{ $technical->teDateresolutioncapacity }}</td>
									</tr>
									<tr>
										<td colspan="3">
											<table class="table border text-center" width="100%">
												<thead>
													<tr>
														<th>CERTIFICACIONES OBTENIDAS</th>
													</tr>
												</thead>
												<tbody>
													@for($c = 0; $c < count($certifications); $c++)
														<tr>
															<td>{{ $certifications[$c] }}</td>
														</tr>
													@endfor
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<th class="text-right">CERTIFICACIONES OBTENIDAS 1</th>
										<td colspan="2" class="text-left">{{ $technical->teNoteonecertificate }}</td>
									</tr>
									<tr>
										<th class="text-right">CERTIFICACIONES OBTENIDAS 2</th>
										<td colspan="2" class="text-left">{{ $technical->teNotetwocertificate }}</td>
									</tr>
									<tr>
										<td class="text-center">
											<small class="text-muted">CODIGO QR</small>
											<br>
											<img style="width: 200px; height: auto;" src="{{ asset('storage/infoCompany/technical/code/'.$technical->teCodeqr) }}" alt="">
										</td>
										<td class="text-center">
											<small class="text-muted">LOGO DE SUPERTRANSPORTE</small>
											<br>
											<img style="width: 200px; height: auto;" src="{{ asset('storage/infoCompany/technical/transport/'.$technical->teLogotransport) }}" alt="">
										</td>
										<td class="text-center">
											<small class="text-muted">LOGO DE LA EMPRESA</small>
											<br>
											<img style="width: 200px; height: auto;" src="{{ asset('storage/infoCompany/technical/company/'.$technical->teLogocompany) }}" alt="">
										</td>
									</tr>
									<tr>
								</tbody>
							</table>
							<div class="row p-4">
								<div class="col-md-6">
									<a href="#" title="Eliminar información" class="bj-btn-table-delete form-control-sm deleteTechnical-link">
										ELIMINAR INFORMACION 
										<i class="fas fa-trash-alt"></i>
										<span hidden>{{ $technical->teId }}</span>
									</a>
								</div>
								<div class="col-md-6">
									<a href="#" title="Editar información" class="bj-btn-table-edit form-control-sm editTechnical-link">
										MODIFICAR INFORMACION <i class="fas fa-edit"></i>
										<span hidden>{{ $technical->teId }}</span>
										<span hidden>{{ $technical->teResolutiontransport }}</span>
										<span hidden>{{ $technical->teDateresolutiontransport }}</span>
										<span hidden>{{ $technical->teResolutioncapacity }}</span>
										<span hidden>{{ $technical->teDateresolutioncapacity }}</span>
										<span hidden>{{ $technical->teCertificate }}</span>
										<span hidden>{{ $technical->teNoteonecertificate }}</span>
										<span hidden>{{ $technical->teNotetwocertificate }}</span>
										<img src="{{ asset('storage/infoCompany/technical/code/'.$technical->teCodeqr) }}" class="img-hidden-code" hidden>
										<img src="{{ asset('storage/infoCompany/technical/transport/'.$technical->teLogotransport) }}" class="img-hidden-logotransport" hidden>
										<img src="{{ asset('storage/infoCompany/technical/company/'.$technical->teLogocompany) }}" class="img-hidden-logocompany" hidden>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@else
			<div class="row">
				<div class="col-md-12 text-center">
					<h6>NO EXISTE INFORMACION TECNICA</h6>
					<br>
					<button type="button" title="Registrar información técnica" class="bj-btn-table-add form-control-sm newTechnical-link">REGISTRAR INFORMACION</button>
				</div>
			</div>
		@endif
	</div>

	<div class="modal fade" id="newTechnical-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA INFORMACION TECNICA:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('technical.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">RESOLUCION DE HABILITACION MINISTERIO DE TRANSPORTE:</small>
											<input type="text" name="teResolutiontransport" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FECHA DE RESOLUCION:</small>
											<input type="text" name="teDateresolutiontransport" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">RESOLUCION DE CAPACIDAD TRANSPORTADORA DEL MINISTERIO DE TRANSPORTE:</small>
											<input type="text" name="teResolutioncapacity" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FECHA DE RESOLUCION:</small>
											<input type="text" name="teDateresolutioncapacity" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row m-3 p-3 border">
									<div class="col-md-12">
										<div class="row text-center">
											<div class="col-md-12">
												<h6>CERTIFICACIONES OBTENIDAS</h6>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CERTIFICADO:</small>
													<input type="text" name="certificated-newTechnical" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addCertificated-newTechnical" title='AGREGUE CERTIFICADOS'>Agregar certificado</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeatCertificated_new" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-certificated-newTechnical" width="100%" style="font-size: 10px;">
													<thead>
														<th colspan="2">CERTIFICADOS ESCRITOS</th>
													</thead>
													<tbody>
														<!-- Dinamics row -->
														<!-- certificated -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CERTIFICACIONES OBTENIDAS 1:</small>
											<input type="text" name="teNoteonecertificate" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CERTIFICACIONES OBTENIDAS 2:</small>
											<input type="text" name="teNotetwocertificate" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CODIGO QR:</small>
											<div class="custom-file">
										        <input type="file" name="teCodeqr" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">LOGO DE SUPERTRANSPORTE:</small>
											<div class="custom-file">
										        <input type="file" name="teLogotransport" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">LOGO DE LA EMPRESA:</small>
											<div class="custom-file">
										        <input type="file" name="teLogocompany" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div> -->
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="teCertificate" class="form-control form-control-sm" readonly>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-newDefinitiveTechnical">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editTechnical-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR INFORMACION TECNICA:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('technical.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">RESOLUCION DE HABILITACION MINISTERIO DE TRANSPORTE:</small>
											<input type="text" name="teResolutiontransport_Edit" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FECHA DE RESOLUCION:</small>
											<input type="text" name="teDateresolutiontransport_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">RESOLUCION DE CAPACIDAD TRANSPORTADORA DEL MINISTERIO DE TRANSPORTE:</small>
											<input type="text" name="teResolutioncapacity_Edit" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FECHA DE RESOLUCION:</small>
											<input type="text" name="teDateresolutioncapacity_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
								</div>
								<div class="row m-3 p-3 border">
									<div class="col-md-12">
										<div class="row text-center">
											<div class="col-md-12">
												<h6>CERTIFICACIONES OBTENIDAS</h6>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CERTIFICADO:</small>
													<input type="text" name="certificated-editTechnical" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-4 text-center">
												<button type="button" class="bj-btn-table-add form-control-sm mt-3 btn-addCertificated-editTechnical" title='AGREGUE CERTIFICADOS'>Agregar certificado</button>
											</div>
											<div class="col-md-4 p-3 text-center">
	    										<small class="infoRepeatCertificated_edit" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table class="table text-center tbl-certificated-editTechnical" width="100%" style="font-size: 12px;">
													<thead>
														<th>CERTIFICADOS ACTUALES</th>
													</thead>
													<tbody>
														<!-- Dinamics row -->
														<!-- certificated -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CERTIFICACIONES OBTENIDAS 1:</small>
											<input type="text" name="teNoteonecertificate_Edit" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CERTIFICACIONES OBTENIDAS 2:</small>
											<input type="text" name="teNotetwocertificate_Edit" maxlength="50" class="form-control form-control-sm" pattern="[0-9]{1,50}" placeholder="Ej. 00000000000000000000000000000000000000000000000000">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CAMBIAR CODIGO QR:</small>
											<div class="custom-file">
										        <input type="file" name="teCodeqr_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6 pt-3">
										<small class="text-muted teCodeqrnot_Edit">
											<input type="checkbox" name="teCodeqrnot_Edit" value="SIN FOTO">
											Quitar código QR actual
										</small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CAMBIAR LOGO DE SUPERTRANSPORTE:</small>
											<div class="custom-file">
										        <input type="file" name="teLogotransport_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6 pt-3">
										<small class="text-muted teLogotransportnot_Edit">
											<input type="checkbox" name="teLogotransportnot_Edit" value="SIN FOTO">
											Quitar logo de supertransporte actual
										</small>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CAMBIAR LOGO DE LA EMPRESA:</small>
											<div class="custom-file">
										        <input type="file" name="teLogocompany_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6 pt-3">
										<small class="text-muted teLogocompanynot_Edit">
											<input type="checkbox" name="teLogocompanynot_Edit" value="SIN FOTO">
											Quitar logo de la empresa actual
										</small>
									</div>
								</div> -->
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="teCertificate_Edit" class="form-control form-control-sm" readonly>
							<input type="hidden" class="form-control form-control-sm" name="teId_Edit" required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-updateDefinitiveTechnical">GUARDAR CAMBIOS</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteTechnical-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h6 class="text-muted">CONFIRME ELIMINACION DE LA INFORMACION TECNICA</h6>
				</div>
				<div class="modal-body">
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('technical.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="teId_Delete" value="" required>
							<button type="submit" class="bj-btn-table-add form-control-sm my-3">CONFIRMAR</button>
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

		$('.btn-newDefinitiveTechnical').on('click',function(e){
			// e.preventDefault();
			var allCertificated = '';
			$('input[name=teCertificate]').val('');
			$('.tbl-certificated-newTechnical').find('tbody').find('tr').each(function(){
				var certificated = $(this).find('td:first').text();
				allCertificated += certificated + '<=>';
			});
			$('input[name=teCertificate]').val(allCertificated);
			$(this).submit();
		});

		$('.newTechnical-link').on('click',function(){
			$('#newTechnical-modal').modal();
		});

		// BOTON PARA AGREGAR CERTIFICADOS A NUEVA INFORMACION TECNICA
		$('.btn-addCertificated-newTechnical').on('click',function(){
			var newCertificated = $('input[name=certificated-newTechnical]').val();
			var validateRepet = false;
			$('.tbl-certificated-newTechnical').find('tbody').find('tr').each(function(){
				var certificated = $(this).find('td').text();
				if(certificated == newCertificated){
					validateRepet = true;
				}
			});
			if(newCertificated != ''){
				if(validateRepet == false){
					$('.tbl-certificated-newTechnical').find('tbody').append(
						"<tr>" +
							"<td>" + newCertificated + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteCertificated-newTechnical'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeatCertificated_new').css('display','block');
					$('.infoRepeatCertificated_new').text('Certificado repetido');
					setTimeout(function(){
						$('.infoRepeatCertificated_new').css('display','none');
						$('.infoRepeatCertificated_new').text('');
					},3000);
				}
			}else{
				$('.infoRepeatCertificated_new').css('display','block');
				$('.infoRepeatCertificated_new').text('Escriba un titulo certificado');
				setTimeout(function(){
					$('.infoRepeatCertificated_new').css('display','none');
					$('.infoRepeatCertificated_new').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-certificated-newTechnical').on('click','.btn-deleteCertificated-newTechnical',function(){
			$(this).parents('tr').remove();
		});

		$('.editTechnical-link').on('click',function(e){
			e.preventDefault();
			$('.tbl-certificated-editTechnical').find('tbody').empty();
			var teId = $(this).find('span:nth-child(2)').text();
			var teResolutiontransport = $(this).find('span:nth-child(3)').text();
			var teDateresolutiontransport = $(this).find('span:nth-child(4)').text();
			var teResolutioncapacity = $(this).find('span:nth-child(5)').text();
			var teDateresolutioncapacity = $(this).find('span:nth-child(6)').text();
			var teCertificate = $(this).find('span:nth-child(7)').text();
			var teNoteonecertificate = $(this).find('span:nth-child(8)').text();
			var teNotetwocertificate = $(this).find('span:nth-child(9)').text();
			var teCodeqr = String($(this).find('.img-hidden-code').attr('src'));
			var teLogotransport = String($(this).find('.img-hidden-logotransport').attr('src'));
			var teLogocompany = String($(this).find('.img-hidden-logocompany').attr('src'));
			$('input[name=teId_Edit]').val(teId);
			$('input[name=teResolutiontransport_Edit]').val(teResolutiontransport);
			$('input[name=teDateresolutiontransport_Edit]').val(teDateresolutiontransport);
			$('input[name=teResolutioncapacity_Edit]').val(teResolutioncapacity);
			$('input[name=teDateresolutioncapacity_Edit]').val(teDateresolutioncapacity);
			$('input[name=teNoteonecertificate_Edit]').val(teNoteonecertificate);
			$('input[name=teNotetwocertificate_Edit]').val(teNotetwocertificate);
			var find = teCertificate.indexOf('<=>');
			if(find > -1){
				var separatedCertifications = teCertificate.split('<=>');
				for (var i = 0; i < separatedCertifications.length; i++) {
					$('.tbl-certificated-editTechnical').find('tbody').append(
						"<tr>" +
							"<td>" + separatedCertifications[i] + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteCertificated-editTechnical'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}
			}else{
				if(teCertificate.length > 0){
					$('.tbl-certificated-editTechnical').find('tbody').append(
						"<tr>" +
							"<td>" + teCertificate + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteCertificated-editTechnical'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}
			}
			var findCode = teCodeqr.indexOf('Default');
			if(findCode > -1){
				$('.teCodeqrnot_Edit').css('display','none');
			}else{
				$('.teCodeqrnot_Edit').css('display','block');
			}
			var findLogotransport = teLogotransport.indexOf('Default');
			if(findLogotransport > -1){
				$('.teLogotransportnot_Edit').css('display','none');
			}else{
				$('.teLogotransportnot_Edit').css('display','block');
			}
			var findLogocompany = teLogocompany.indexOf('Default');
			if(findLogocompany > -1){
				$('.teLogocompanynot_Edit').css('display','none');
			}else{
				$('.teLogocompanynot_Edit').css('display','block');
			}
			$('#editTechnical-modal').modal();
		});

		// BOTON PARA AGREGAR CERTIFICADOS A NUEVA INFORMACION TECNICA
		$('.btn-addCertificated-editTechnical').on('click',function(){
			var newCertificated = $('input[name=certificated-editTechnical]').val();
			var validateRepet = false;
			$('.tbl-certificated-editTechnical').find('tbody').find('tr').each(function(){
				var certificated = $(this).find('td').text();
				if(certificated == newCertificated){
					validateRepet = true;
				}
			});
			if(newCertificated != ''){
				if(validateRepet == false){
					$('.tbl-certificated-editTechnical').find('tbody').append(
						"<tr>" +
							"<td>" + newCertificated + "</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteCertificated-editTechnical'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.infoRepeatCertificated_edit').css('display','block');
					$('.infoRepeatCertificated_edit').text('Certificado repetido');
					setTimeout(function(){
						$('.infoRepeatCertificated_edit').css('display','none');
						$('.infoRepeatCertificated_edit').text('');
					},3000);
				}
			}else{
				$('.infoRepeatCertificated_edit').css('display','block');
				$('.infoRepeatCertificated_edit').text('Escriba un titulo certificado');
				setTimeout(function(){
					$('.infoRepeatCertificated_edit').css('display','none');
					$('.infoRepeatCertificated_edit').text('');
				},3000);
			}
		});

		// BOTON DE TABLA DE CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
		$('.tbl-certificated-editTechnical').on('click','.btn-deleteCertificated-editTechnical',function(){
			$(this).parents('tr').remove();
		});

		$('.deleteTechnical-link').on('click',function(e){
			e.preventDefault();
			var teId = $(this).find('span:nth-child(2)').text();
			$('input[name=teId_Delete]').val(teId);
			$('#deleteTechnical-modal').modal();
		});

		$('.btn-updateDefinitiveTechnical').on('click',function(e){
			// e.preventDefault();
			var allCertificated = '';
			$('input[name=teCertificate_Edit]').val('');
			$('.tbl-certificated-editTechnical').find('tbody').find('tr').each(function(){
				var certificated = $(this).find('td:first').text();
				allCertificated += certificated + '<=>';
			});
			$('input[name=teCertificate_Edit]').val(allCertificated);
			$(this).submit();
		});

		function getMount($numberMount){
			return ($numberMount<10 ? '0' : '') + $numberMount;
		}
		function getDay($numberDay){
			return ($numberDay<10 ? '0' : '') + $numberDay;
		}
	</script>
@endsection