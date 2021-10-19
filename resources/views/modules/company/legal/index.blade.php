@extends('modules.administrativeCompany')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h5>INFORMACION JURIDICA</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessLegal'))
					<div class="alert alert-success">
						{{ session('SuccessLegal') }}
					</div>
				@endif
				@if(session('PrimaryLegal'))
					<div class="alert alert-primary">
						{{ session('PrimaryLegal') }}
					</div>
				@endif
				@if(session('WarningLegal'))
					<div class="alert alert-warning">
						{{ session('WarningLegal') }}
					</div>
				@endif
				@if(session('SecondaryLegal'))
					<div class="alert alert-secondary">
						{{ session('SecondaryLegal') }}
					</div>
				@endif
			</div>
		</div>
		@if(isset($legal))
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<small class="text-muted">RAZON SOCIAL: </small><br>
									<span class="text-muted">
										<b class="leReasonsocial_info">
											{{ $legal->leReasonsocial }}
										</b>
									</span><br>
									<small class="text-muted">TIPO DE IDENTIFICACION: </small><br>
									<span class="text-muted">
										<b class="lePersonal_id_info">
											{{ $legal->perName }}
										</b>
									</span><br>
									<small class="text-muted">NUMERO DE IDENTIFICACION: </small><br>
									<span class="text-muted">
										<b class="leNumberdocument_info">
											{{ $legal->leNumberdocument }}
										</b>
									</span><br>
									<small class="text-muted">FECHA/NUMERO DE MATRICULA: </small><br>
									<span class="text-muted">
										<b class="leDateregistration_info">
											{{ $legal->leDateregistration }}
										</b>
									/ 
										<b class="leNumberregistration_info">
											{{ $legal->leNumberregistration }}
										</b>
									</span><br>
									<small class="text-muted">CAMARA DE COMERCIO: </small><br>
									<span class="text-muted">
										<b class="leCommerce_info">
											{{ $legal->leCommerce }}
										</b>
									</span><br>
									<small class="text-muted">REPRESENTANTE LEGAL: </small><br>
									<span class="text-muted">
										<b class="leRepresentativename_info">
											{{ $legal->leRepresentativename }}
										</b>
									</span><br>
									<small class="text-muted">DOCUMENTO DE REPRESENTANTE: </small><br>
									<span class="text-muted">
										<b class="leRepresentativepersonal_id_info">
											N° <!-- {{ $legal->leRepresentativepersonal_id }} -->
										</b>
										<b class="leRepresentativenumberdocument_info">
											{{ $legal->leRepresentativenumberdocument }}											
										</b>
									</span><br>
								</div>
								<div class="col-md-6">
									<small class="text-muted">DEPARTAMENTO/CIUDAD: </small><br>
									<span class="text-muted">
										<b class="leDeparment_id_Info">
											{{ $legal->depName }}
										</b>
										/
										<b class="leMunicipality_id_Info">
											{{ $legal->munName }}
										</b>
									</span><br>
									<small class="text-muted">LOCALIDAD/BARRIO/CODIGO POSTAL: </small><br>
									<span class="text-muted">
										<b class="leZoning_id_Info">
											{{ $legal->zonName }}
										</b>
										/
										<b class="leNeighborhood_id_Info">
											{{ $legal->neName }}
										</b>
										/
										<b class="leCode_Info">
											{{ $legal->neCode }}
										</b>
									</span><br>
									<small class="text-muted">DIRECCION: </small><br>
									<span class="text-muted">
										<b class="leAddress_Info">
											{{ $legal->leAddress }}
										</b>
									</span><br>
									<small class="text-muted">CORREO ELECTRONICO: </small><br>
									<span class="text-muted">
										<b class="leEmail_Info">
											{{ $legal->leEmail }}
										</b>
									</span><br>
									<small class="text-muted">TELEFONO FIJO: </small><br>
									<span class="text-muted">
										<b class="lePhone_Info">
											{{ $legal->lePhone }}
										</b>
									</span><br>
									<small class="text-muted">TELEFONO CELULAR: </small><br>
									<span class="text-muted">
										<b class="leMovil_Info">
											{{ $legal->leMovil }}
										</b>
									</span><br>
									<small class="text-muted">LINEA WHATSAPP: </small><br>
									<span class="text-muted">
										<b class="leWhatsapp_Info">
											{{ $legal->leWhatsapp }}
										</b>
									</span><br>
								</div>
							</div>
							<div class="row p-4">
								<div class="col-md-6">
									<a href="#" title="Eliminar información" class="bj-btn-table-delete form-control-sm deleteLegal-link">
										ELIMINAR INFORMACION <i class="fas fa-trash-alt"></i>
										<span hidden>{{ $legal->leId }}</span>
										<span hidden>{{ $legal->leReasonsocial }}</span>
									</a>
								</div>
								<div class="col-md-6">
									<a href="#" title="Editar información" class="bj-btn-table-edit form-control-sm editLegal-link">
										MODIFICAR INFORMACION <i class="fas fa-edit"></i>
										<span hidden>{{ $legal->leId }}</span>
										<span hidden>{{ $legal->leReasonsocial }}</span>
										<span hidden>{{ $legal->lePersonal_id }}</span>
										<span hidden>{{ $legal->leNumberdocument }}</span>
										<span hidden>{{ $legal->leNumberregistration }}</span>
										<span hidden>{{ $legal->leDateregistration }}</span>
										<span hidden>{{ $legal->leCommerce }}</span>
										<span hidden>{{ $legal->depId }}</span>
										<span hidden>{{ $legal->munId }}</span>
										<span hidden>{{ $legal->zonId }}</span>
										<span hidden>{{ $legal->neId }}</span>
										<span hidden>{{ $legal->leAddress }}</span>
										<span hidden>{{ $legal->leEmail }}</span>
										<span hidden>{{ $legal->lePhone }}</span>
										<span hidden>{{ $legal->leMovil }}</span>
										<span hidden>{{ $legal->leWhatsapp }}</span>
										<span hidden>{{ $legal->leRepresentativename }}</span>
										<span hidden>{{ $legal->leRepresentativepersonal_id }}</span>
										<span hidden>{{ $legal->leRepresentativenumberdocument }}</span>
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
					<h6>NO EXISTE INFORMACION JURIDICA</h6>
					<br>
					<button type="button" title="Registrar información jurídica" class="bj-btn-table-add form-control-sm newLegal-link">GUARDAR INFORMACION</button>
				</div>
			</div>
		@endif
	</div>

	<div class="modal fade" id="newLegal-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA INFORMACION JURÍDICA:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('legal.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="leReasonsocial" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Transportes Operalo" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="lePersonal_id" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="leNumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MATRICULA:</small>
											<input type="text" name="leNumberregistration" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA DE MATRICULA:</small>
											<input type="text" name="leDateregistration" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAMARA DE COMERCIO:</small>
											<input type="text" name="leCommerce" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="leDeparment_id" class="form-control form-control-sm" required>
														<option value="">Seleccione departamento ...</option>
														@foreach($deparments as $deparment)
															<option value="{{ $deparment->depId }}">{{ $deparment->depName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CIUDAD/MUNICIPIO:</small>
													<select name="leMunicipality_id" class="form-control form-control-sm" required>
														<option value="">Seleccione ciudad/municipio ...</option>
														<!-- munId - munName - munDepartment_id -->
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LOCALIDAD/ZONA:</small>
													<select name="leZoning_id" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="leNeighborhood_id" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="leCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="leAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="leEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO FIJO:</small>
													<input type="text" name="lePhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="leMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="leWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">REPRESENTANTE LEGAL:</small>
											<input type="text" name="leRepresentativename" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
											<select name="leRepresentativepersonal_id" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO DE REPRESENTANTE:</small>
											<input type="text" name="leRepresentativenumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editLegal-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR INFORMACION JURIDICA:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('legal.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="leReasonsocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Transportes Operalo" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="lePersonal_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="leNumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MATRICULA:</small>
											<input type="text" name="leNumberregistration_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA DE MATRICULA:</small>
											<input type="text" name="leDateregistration_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAMARA DE COMERCIO:</small>
											<input type="text" name="leCommerce_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="leDeparment_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione departamento ...</option>
														@foreach($deparments as $deparment)
															<option value="{{ $deparment->depId }}">{{ $deparment->depName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CIUDAD/MUNICIPIO:</small>
													<select name="leMunicipality_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione ciudad/municipio ...</option>
														<!-- munId - munName - munDepartment_id -->
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LOCALIDAD/ZONA:</small>
													<select name="leZoning_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="leNeighborhood_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="leCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="leAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="leEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO FIJO:</small>
													<input type="text" name="lePhone_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="leMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="leWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">REPRESENTANTE LEGAL:</small>
											<input type="text" name="leRepresentativename_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
											<select name="leRepresentativepersonal_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO DE REPRESENTANTE:</small>
											<input type="text" name="leRepresentativenumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="leId_Edit" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteLegal-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h6 class="text-muted">CONFIRME ELIMINACION DE LA INFORMACION JURIDICA DE <b class="leReasonsocial_Delete"></b></h6>
				</div>
				<div class="modal-body">
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('legal.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="leId_Delete" value="" required>
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

		$('.newLegal-link').on('click',function(){
			$('#newLegal-modal').modal();
		});

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO
		$('select[name=leDeparment_id]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=leMunicipality_id]').empty();
			$('select[name=leMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=leZoning_id]').empty();
			$('select[name=leZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=leNeighborhood_id]').empty();
			$('select[name=leNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leMunicipality_id]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=leMunicipality_id]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=leZoning_id]').empty();
			$('select[name=leZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=leNeighborhood_id]').empty();
			$('select[name=leNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leZoning_id]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=leZoning_id]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=leNeighborhood_id]').empty();
			$('select[name=leNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leNeighborhood_id]').append(
								"<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" + 
									objectNeighborhood[i]['neName'] +
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=leNeighborhood_id]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=leCode]').val('');
			if(neSelected != ''){
				var text = $('select[name=leNeighborhood_id] option:selected').attr('data-code');
				$('input[name=leCode]').val(text);
			}
		});

		$('.editLegal-link').on('click',function(e){
			e.preventDefault();
			var leId = $(this).find('span:nth-child(2)').text();
			var leReasonsocial = $(this).find('span:nth-child(3)').text();
			var lePersonal_id = $(this).find('span:nth-child(4)').text();
			var leNumberdocument = $(this).find('span:nth-child(5)').text();
			var leNumberregistration = $(this).find('span:nth-child(6)').text();
			var leDateregistration = $(this).find('span:nth-child(7)').text();
			var leCommerce = $(this).find('span:nth-child(8)').text();
			var leDeparment_id = $(this).find('span:nth-child(9)').text();
			var leMunicipality_id = $(this).find('span:nth-child(10)').text();
			var leZoning_id = $(this).find('span:nth-child(11)').text();
			var leNeighborhood_id = $(this).find('span:nth-child(12)').text();
			var leAddress = $(this).find('span:nth-child(13)').text();
			var leEmail = $(this).find('span:nth-child(14)').text();
			var lePhone = $(this).find('span:nth-child(15)').text();
			var leMovil = $(this).find('span:nth-child(16)').text();
			var leWhatsapp = $(this).find('span:nth-child(17)').text();
			var leRepresentativename = $(this).find('span:nth-child(18)').text();
			var leRepresentativepersonal_id = $(this).find('span:nth-child(19)').text();
			var leRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
			$('input[name=leId_Edit]').val(leId);
			$('input[name=leReasonsocial_Edit]').val(leReasonsocial);
			$('select[name=lePersonal_id_Edit]').val(lePersonal_id);
			$('input[name=leNumberdocument_Edit]').val(leNumberdocument);
			$('input[name=leDateregistration_Edit]').val(leDateregistration);
			$('input[name=leNumberregistration_Edit]').val(leNumberregistration);
			$('input[name=leCommerce_Edit]').val(leCommerce);

			$('select[name=leDeparment_id_Edit]').val(leDeparment_id);

			$('select[name=leMunicipality_id_Edit]').empty();
			$('select[name=leMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$.get("{{ route('getMunicipalities') }}",{ depId: leDeparment_id },function(objectMunicipalities){
				var count = Object.keys(objectMunicipalities).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectMunicipalities[i]['munId'] == leMunicipality_id){
							$('select[name=leMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}else{
							$('select[name=leMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('select[name=leZoning_id_Edit]').empty();
			$('select[name=leZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$.get("{{ route('getZonings') }}",{ munId: leMunicipality_id },function(objectZonings){
				var count = Object.keys(objectZonings).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectZonings[i]['zonId'] == leZoning_id){
							$('select[name=leZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "' selected>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}else{
							$('select[name=leZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('select[name=leNeighborhood_id_Edit]').empty();
			$('select[name=leNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$.get("{{ route('getNeighborhoods') }}",{ zonId: leZoning_id },function(objectNeighborhoods){
				var count = Object.keys(objectNeighborhoods).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectNeighborhoods[i]['neId'] == leNeighborhood_id){
							$('input[name=leCode_Edit]').val(objectNeighborhoods[i]['neCode']);
							$('select[name=leNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}else{
							$('select[name=leNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('input[name=leAddress_Edit]').val(leAddress);
			$('input[name=leEmail_Edit]').val(leEmail);
			$('input[name=lePhone_Edit]').val(lePhone);
			$('input[name=leMovil_Edit]').val(leMovil);
			$('input[name=leWhatsapp_Edit]').val(leWhatsapp);

			$('input[name=leRepresentativename_Edit]').val(leRepresentativename);
			$('select[name=leRepresentativepersonal_id_Edit]').val(leRepresentativepersonal_id);
			$('input[name=leRepresentativenumberdocument_Edit]').val(leRepresentativenumberdocument);

			$('#editLegal-modal').modal();
		});

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO
		$('select[name=leDeparment_id_Edit]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=leMunicipality_id_Edit]').empty();
			$('select[name=leMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=leZoning_id_Edit]').empty();
			$('select[name=leZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=leNeighborhood_id_Edit]').empty();
			$('select[name=leNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode_Edit]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA
		$('select[name=leMunicipality_id_Edit]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=leZoning_id_Edit]').empty();
			$('select[name=leZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=leNeighborhood_id_Edit]').empty();
			$('select[name=leNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode_Edit]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELEceIONADA
		$('select[name=leZoning_id_Edit]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=leNeighborhood_id_Edit]').empty();
			$('select[name=leNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=leCode_Edit]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=leNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" + 
									objectNeighborhood[i]['neName'] +
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELEceIONADA
		$('select[name=leNeighborhood_id_Edit]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=leCode_Edit]').val('');
			if(neSelected != ''){
				var text = $('select[name=leNeighborhood_id_Edit] option:selected').attr('data-code');
				$('input[name=leCode_Edit]').val(text);
			}
		});

		$('.deleteLegal-link').on('click',function(e){
			e.preventDefault();
			var leId = $(this).find('span:nth-child(2)').text();
			var leReasonsocial = $(this).find('span:nth-child(3)').text();
			$('input[name=leId_Delete]').val(leId);
			$('.leReasonsocial_Delete').text(leReasonsocial);
			$('#deleteLegal-modal').modal();
		});

		
	</script>
@endsection