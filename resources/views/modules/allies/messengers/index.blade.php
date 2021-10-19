@extends('modules.administrativeAllies')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>MENSAJERIA ALIADA</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar mensajeria aliada" class="bj-btn-table-add form-control-sm newMessenger-link">NUEVO</button>
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
					<th>RAZON SOCIAL</th>
					<th>N° DE IDENTIFICACION</th>
					<th>REPRESENTANTE LEGAL</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($alliesmessengers as $messenger)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $messenger->amReasonsocial }}</td>
					<td>{{ $messenger->amNumberdocument }}</td>
					<td>{{ $messenger->amRepresentativename }}</td>
					<td>
						<a href="#" title="Editar mensajería aliada" class="bj-btn-table-edit form-control-sm editMessenger-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $messenger->amId }}</span>
							<span hidden>{{ $messenger->amReasonsocial }}</span>
							<span hidden>{{ $messenger->amPersonal_id }}</span>
							<span hidden>{{ $messenger->amNumberdocument }}</span>
							<span hidden>{{ $messenger->amNumberregistration }}</span>
							<span hidden>{{ $messenger->amDateregistration }}</span>
							<span hidden>{{ $messenger->amCommerce }}</span>
							<span hidden>{{ $messenger->depId }}</span>
							<span hidden>{{ $messenger->munId }}</span>
							<span hidden>{{ $messenger->zonId }}</span>
							<span hidden>{{ $messenger->amNeighborhood_id }}</span>
							<span hidden>{{ $messenger->amAddress }}</span>
							<span hidden>{{ $messenger->amEmail }}</span>
							<span hidden>{{ $messenger->amPhone }}</span>
							<span hidden>{{ $messenger->amMovil }}</span>
							<span hidden>{{ $messenger->amWhatsapp }}</span>
							<span hidden>{{ $messenger->amRepresentativename }}</span>
							<span hidden>{{ $messenger->amRepresentativepersonal_id }}</span>
							<span hidden>{{ $messenger->amRepresentativenumberdocument }}</span>
							<span hidden>{{ $messenger->amBank }}</span>
							<span hidden>{{ $messenger->amTypeaccount }}</span>
							<span hidden>{{ $messenger->amAccountnumber }}</span>
							<span hidden>{{ $messenger->amRegime }}</span>
							<span hidden>{{ $messenger->amTaxpayer }}</span>
							<span hidden>{{ $messenger->amAutoretainer }}</span>
							<span hidden>{{ $messenger->amActivitys }}</span>
						</a>
						<a href="#" title="Eliminar mensajería aliada" class="bj-btn-table-delete form-control-sm deleteMessenger-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $messenger->amId }}</span>
							<span hidden>{{ $messenger->amReasonsocial }}</span>
							<span hidden>{{ $messenger->perName }}</span>
							<span hidden>{{ $messenger->amNumberdocument }}</span>
							<span hidden>{{ $messenger->amNumberregistration }}</span>
							<span hidden>{{ $messenger->amDateregistration }}</span>
							<span hidden>{{ $messenger->amCommerce }}</span>
							<span hidden>{{ $messenger->depName }}</span>
							<span hidden>{{ $messenger->munName }}</span>
							<span hidden>{{ $messenger->zonName }}</span>
							<span hidden>{{ $messenger->neName }}</span>
							<span hidden>{{ $messenger->neCode }}</span>
							<span hidden>{{ $messenger->amAddress }}</span>
							<span hidden>{{ $messenger->amEmail }}</span>
							<span hidden>{{ $messenger->amPhone }}</span>
							<span hidden>{{ $messenger->amMovil }}</span>
							<span hidden>{{ $messenger->amWhatsapp }}</span>
							<span hidden>{{ $messenger->amRepresentativename }}</span>
							<span hidden>{{ $messenger->amRepresentativenumberdocument }}</span>
							<span hidden>{{ $messenger->amBank }}</span>
							<span hidden>{{ $messenger->amTypeaccount }}</span>
							<span hidden>{{ $messenger->amAccountnumber }}</span>
							<span hidden>{{ $messenger->amRegime }}</span>
							<span hidden>{{ $messenger->amTaxpayer }}</span>
							<span hidden>{{ $messenger->amAutoretainer }}</span>
							<span hidden>{{ $messenger->amActivitys }}</span>
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
					<h4>NUEVA MENSAJERIA ALIADA:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('allies.messengers.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="amReasonsocial" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="amPersonal_id" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="amNumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MATRICULA:</small>
											<input type="text" name="amNumberregistration" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA DE MATRICULA:</small>
											<input type="text" name="amDateregistration" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAMARA DE COMERCIO:</small>
											<input type="text" name="amCommerce" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="amDepartment_id" class="form-control form-control-sm" required>
														<option value="">Seleccione departamento ...</option>
														@foreach($departments as $department)
															<option value="{{ $department->depId }}">{{ $department->depName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CIUDAD/MUNICIPIO:</small>
													<select name="amMunicipality_id" class="form-control form-control-sm" required>
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
													<select name="amZoning_id" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="amNeighborhood_id" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="amCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="amAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="amEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO FIJO:</small>
													<input type="text" name="amPhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="amMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="amWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">REPRESENTANTE LEGAL:</small>
											<input type="text" name="amRepresentativename" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
											<select name="amRepresentativepersonal_id" class="form-control form-control-sm" required>
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
											<input type="text" name="amRepresentativenumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
								</div>
								<div class="row pt-4">
									<div class="col-md-12">
										<small>INFORMACION JURIDICA/FINANCIERA DE PROVEEDOR</small>
										<hr>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ENTIDAD BANCARIA:</small>
													<input type="text" name="amBank" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE CUENTA:</small>
													<select name="amTypeaccount" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="CORRIENTE">CORRIENTE</option>
														<option value="AHORROS">AHORROS</option>
														<option value="RECAUDO">RECAUDO</option>
														<option value="FIDUCIA">FIDUCIA</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">NUMERO DE CUENTA:</small>
													<input type="text" name="amAccountnumber" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">REGIMEN IVA:</small>
													<select name="amRegime" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="COMUN">COMUN</option>
														<option value="SIMPLIFICADO">SIMPLIFICADO</option>
														<option value="ESPECIAL">ESPECIAL</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">¿CONTRIBUYESTES?:</small>
													<select name="amTaxpayer" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="SI">SI</option>
														<option value="NO">NO</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">¿AUTORETENEDORES?:</small>
													<select name="amAutoretainer" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="SI">SI</option>
														<option value="NO">NO</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<small>ACTIVIDADES ECONOMICAS DE PROVEEDOR:</small>
												<hr>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_one" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_two" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_three" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_four" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="bj-btn-table-add form-control-sm">REGISTRAR MENSAJERIA ALIADA</button>
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
					<h5>EDITAR MENSAJERIA ALIADA:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('allies.messengers.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="amReasonsocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="amPersonal_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione tipo de identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="amNumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE MATRICULA:</small>
											<input type="text" name="amNumberregistration_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA DE MATRICULA:</small>
											<input type="text" name="amDateregistration_Edit" class="form-control form-control-sm datepicker" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CAMARA DE COMERCIO:</small>
											<input type="text" name="amCommerce_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="amDepartment_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione departamento ...</option>
														@foreach($departments as $department)
															<option value="{{ $department->depId }}">{{ $department->depName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CIUDAD/MUNICIPIO:</small>
													<select name="amMunicipality_id_Edit" class="form-control form-control-sm" required>
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
													<select name="amZoning_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="amNeighborhood_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="amCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="amAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="amEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO FIJO:</small>
													<input type="text" name="amPhone_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="amMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="amWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">REPRESENTANTE LEGAL:</small>
											<input type="text" name="amRepresentativename_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
											<select name="amRepresentativepersonal_id_Edit" class="form-control form-control-sm" required>
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
											<input type="text" name="amRepresentativenumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
								</div>
								<div class="row pt-4">
									<div class="col-md-12">
										<small>INFORMACION JURIDICA/FINANCIERA DE PROVEEDOR</small>
										<hr>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ENTIDAD BANCARIA:</small>
													<input type="text" name="amBank_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">TIPO DE CUENTA:</small>
													<select name="amTypeaccount_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="CORRIENTE">CORRIENTE</option>
														<option value="AHORROS">AHORROS</option>
														<option value="RECAUDO">RECAUDO</option>
														<option value="FIDUCIA">FIDUCIA</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">NUMERO DE CUENTA:</small>
													<input type="text" name="amAccountnumber_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">REGIMEN IVA:</small>
													<select name="amRegime_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="COMUN">COMUN</option>
														<option value="SIMPLIFICADO">SIMPLIFICADO</option>
														<option value="ESPECIAL">ESPECIAL</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">¿CONTRIBUYESTES?:</small>
													<select name="amTaxpayer_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="SI">SI</option>
														<option value="NO">NO</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">¿AUTORETENEDORES?:</small>
													<select name="amAutoretainer_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione ...</option>
														<option value="SI">SI</option>
														<option value="NO">NO</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<small>ACTIVIDADES ECONOMICAS DE PROVEEDOR:</small>
												<hr>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_one_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_two_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_three_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" name="amActivitys_four_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
														</div>
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
								<input type="hidden" class="form-control form-control-sm" name="amId_Edit" value="" required>
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

	<div class="modal fade" id="deleteMessenger-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION/DETALLES DE MENSAJERIA ALIADA:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">RAZON SOCIAL: </small><br>
							<span class="text-muted"><b class="amReasonsocial_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="amNumberdocument_Delete"></b></span><br>
							<small class="text-muted">DEPARTAMENTO/MUNICIPIO: </small><br>
							<span class="text-muted"><b class="depName_Delete"></b>/<b class="munName_Delete"></b></span><br>
							<small class="text-muted">ZONA/BARRIO/CODIGO POSTAL: </small><br>
							<span class="text-muted"><b class="zonName_Delete"></b>/<b class="neName_Delete"></b>/<b class="neCode_Delete"></b></span><br>
							<small class="text-muted">DIRECCION: </small><br>
							<span class="text-muted"><b class="amAddress_Delete"></b></span><br>
							<small class="text-muted">CORREO ELECTRONICO: </small><br>
							<span class="text-muted"><b class="amEmail_Delete"></b></span><br>
							<small class="text-muted">TELEFONO: </small><br>
							<span class="text-muted"><b class="amPhone_Delete"></b></span><br>
							<small class="text-muted">CELULAR: </small><br>
							<span class="text-muted"><b class="amMovil_Delete"></b></span><br>
							<small class="text-muted">WHATSAPP: </small><br>
							<span class="text-muted"><b class="amWhatsapp_Delete"></b></span><br>
						</div>
						<div class="col-md-6">
							<small class="text-muted">FECHA/NUMERO DE MATRICULA: </small><br>
							<span class="text-muted"><b class="amDateregistration_Delete"></b>/<b class="amNumberregistration_Delete"></b></span><br>
							<small class="text-muted">CAMARA DE COMERCIO: </small><br>
							<span class="text-muted"><b class="amCommerce_Delete"></b></span><br>
							<small class="text-muted">REPRESENTANTE LEGAL: </small><br>
							<span class="text-muted"><b class="amRepresentativename_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO DE REPRESENTANTE LEGAL: </small><br>
							<span class="text-muted"><b class="amRepresentativenumberdocument_Delete"></b></span><br>
							<small class="text-muted">ENTIDAD BANCARIA: </small><br>
							<span class="text-muted"><b class="amBank_Delete"></b></span><br>
							<small class="text-muted">TIPO Y NUMERO DE CUENTA: </small><br>
							<span class="text-muted"><b class="amTypeaccount_Delete"></b>/<b class="amAccountnumber_Delete"></b></span><br>
							<small class="text-muted">REGIMEN: </small><br>
							<span class="text-muted"><b class="amRegime_Delete"></b></span><br>
							<small class="text-muted">GRANDES CONTRIBUYESTES: </small><br>
							<span class="text-muted"><b class="amTaxpayer_Delete"></b></span><br>
							<small class="text-muted">AUTORETENEDORES: </small><br>
							<span class="text-muted"><b class="amAutoretainer_Delete"></b></span><br>
							<small class="text-muted">ACTIVIDADES ECONOMICAS: </small><br>
							<span class="text-muted"><b class="amActivitys_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('allies.messengers.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="amId_Delete" value="" required>
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

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO
		$('select[name=amDepartment_id]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=amMunicipality_id]').empty();
			$('select[name=amMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=amZoning_id]').empty();
			$('select[name=amZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=amNeighborhood_id]').empty();
			$('select[name=amNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amMunicipality_id]').append(
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
		$('select[name=amMunicipality_id]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=amZoning_id]').empty();
			$('select[name=amZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=amNeighborhood_id]').empty();
			$('select[name=amNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amZoning_id]').append(
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
		$('select[name=amZoning_id]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=amNeighborhood_id]').empty();
			$('select[name=amNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amNeighborhood_id]').append(
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
		$('select[name=amNeighborhood_id]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=amCode]').val('');
			if(neSelected != ''){
				var text = $('select[name=amNeighborhood_id] option:selected').attr('data-code');
				$('input[name=amCode]').val(text);
			}
		});

		$('.editMessenger-link').on('click',function(e){
			e.preventDefault();
			var amId = $(this).find('span:nth-child(2)').text();
			var amReasonsocial = $(this).find('span:nth-child(3)').text();
			var amPersonal_id = $(this).find('span:nth-child(4)').text();
			var amNumberdocument = $(this).find('span:nth-child(5)').text();
			var amNumberregistration = $(this).find('span:nth-child(6)').text();
			var amDateregistration = $(this).find('span:nth-child(7)').text();
			var amCommerce = $(this).find('span:nth-child(8)').text();
			var amDepartment_id = $(this).find('span:nth-child(9)').text();
			var amMunicipality_id = $(this).find('span:nth-child(10)').text();
			var amZoning_id = $(this).find('span:nth-child(11)').text();
			var amNeighborhood_id = $(this).find('span:nth-child(12)').text();
			var amAddress = $(this).find('span:nth-child(13)').text();
			var amEmail = $(this).find('span:nth-child(14)').text();
			var amPhone = $(this).find('span:nth-child(15)').text();
			var amMovil = $(this).find('span:nth-child(16)').text();
			var amWhatsapp = $(this).find('span:nth-child(17)').text();
			var amRepresentativename = $(this).find('span:nth-child(18)').text();
			var amRepresentativepersonal_id = $(this).find('span:nth-child(19)').text();
			var amRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
			var amBank = $(this).find('span:nth-child(21)').text();
			var amTypeaccount = $(this).find('span:nth-child(22)').text();
			var amAccountnumber = $(this).find('span:nth-child(23)').text();
			var amRegime = $(this).find('span:nth-child(24)').text();
			var amTaxpayer = $(this).find('span:nth-child(25)').text();
			var amAutoretainer = $(this).find('span:nth-child(26)').text();
			var amActivitys = $(this).find('span:nth-child(27)').text();
			$('input[name=amId_Edit]').val(amId);
			$('input[name=amReasonsocial_Edit]').val(amReasonsocial);
			$('select[name=amPersonal_id_Edit]').val(amPersonal_id);
			$('input[name=amNumberdocument_Edit]').val(amNumberdocument);
			$('input[name=amNumberregistration_Edit]').val(amNumberregistration);
			$('input[name=amDateregistration_Edit]').val(amDateregistration);
			$('input[name=amCommerce_Edit]').val(amCommerce);
			$('select[name=amDepartment_id_Edit]').val(amDepartment_id);
			$('select[name=amMunicipality_id_Edit]').empty();
			$('select[name=amMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$.get("{{ route('getMunicipalities') }}",{ depId: amDepartment_id },function(objectMunicipalities){
				var count = Object.keys(objectMunicipalities).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectMunicipalities[i]['munId'] == amMunicipality_id){
							$('select[name=amMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}else{
							$('select[name=amMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}							
					}
				}
			});
			$('select[name=amZoning_id_Edit]').empty();
			$('select[name=amZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$.get("{{ route('getZonings') }}",{ munId: amMunicipality_id },function(objectZonings){
				var count = Object.keys(objectZonings).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectZonings[i]['zonId'] == amZoning_id){
							$('select[name=amZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "' selected>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}else{
							$('select[name=amZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}							
					}
				}
			});
			$('select[name=amNeighborhood_id_Edit]').empty();
			$('select[name=amNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$.get("{{ route('getNeighborhoods') }}",{ zonId: amZoning_id },function(objectNeighborhoods){
				var count = Object.keys(objectNeighborhoods).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectNeighborhoods[i]['neId'] == amNeighborhood_id){
							$('input[name=amCode_Edit]').val(objectNeighborhoods[i]['neCode']);
							$('select[name=amNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}else{
							$('select[name=amNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}							
					}
				}
			});
			$('input[name=amAddress_Edit]').val(amAddress);
			$('input[name=amEmail_Edit]').val(amEmail);
			$('input[name=amPhone_Edit]').val(amPhone);
			$('input[name=amMovil_Edit]').val(amMovil);
			$('input[name=amWhatsapp_Edit]').val(amWhatsapp);
			$('input[name=amRepresentativename_Edit]').val(amRepresentativename);
			$('select[name=amRepresentativepersonal_id_Edit]').val(amRepresentativepersonal_id);
			$('input[name=amRepresentativenumberdocument_Edit]').val(amRepresentativenumberdocument);
			$('input[name=amBank_Edit]').val(amBank);
			$('select[name=amTypeaccount_Edit]').val(amTypeaccount);
			$('input[name=amAccountnumber_Edit]').val(amAccountnumber);
			$('select[name=amRegime_Edit]').val(amRegime);
			$('select[name=amTaxpayer_Edit]').val(amTaxpayer);
			$('select[name=amAutoretainer_Edit]').val(amAutoretainer);
			var separatedActivitys = amActivitys.split('-');
			$('input[name=amActivitys_one_Edit]').val(separatedActivitys[0]);
			$('input[name=amActivitys_two_Edit]').val(separatedActivitys[1]);
			$('input[name=amActivitys_three_Edit]').val(separatedActivitys[2]);
			$('input[name=amActivitys_four_Edit]').val(separatedActivitys[3]);
			$('#editMessenger-modal').modal();
		});

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO
		$('select[name=amDepartment_id_Edit]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=amMunicipality_id_Edit]').empty();
			$('select[name=amMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=amZoning_id_Edit]').empty();
			$('select[name=amZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=amNeighborhood_id_Edit]').empty();
			$('select[name=amNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode_Edit]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amMunicipality_id_Edit]').append(
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
		$('select[name=amMunicipality_id_Edit]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=amZoning_id_Edit]').empty();
			$('select[name=amZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=amNeighborhood_id_Edit]').empty();
			$('select[name=amNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode_Edit]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amZoning_id_Edit]').append(
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
		$('select[name=amZoning_id_Edit]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=amNeighborhood_id_Edit]').empty();
			$('select[name=amNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=amCode_Edit]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=amNeighborhood_id_Edit]').append(
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
		$('select[name=amNeighborhood_id_Edit]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=amCode_Edit]').val('');
			if(neSelected != ''){
				var text = $('select[name=amNeighborhood_id_Edit] option:selected').attr('data-code');
				$('input[name=amCode_Edit]').val(text);
			}
		});

		$('.deleteMessenger-link').on('click',function(e){
			e.preventDefault();
			var amId = $(this).find('span:nth-child(2)').text();
			var amReasonsocial = $(this).find('span:nth-child(3)').text();
			var perName = $(this).find('span:nth-child(4)').text();
			var amNumberdocument = $(this).find('span:nth-child(5)').text();
			var amNumberregistration = $(this).find('span:nth-child(6)').text();
			var amDateregistration = $(this).find('span:nth-child(7)').text();
			var amCommerce = $(this).find('span:nth-child(8)').text();
			var depName = $(this).find('span:nth-child(9)').text();
			var munName = $(this).find('span:nth-child(10)').text();
			var zonName = $(this).find('span:nth-child(11)').text();
			var neName = $(this).find('span:nth-child(12)').text();
			var neCode = $(this).find('span:nth-child(13)').text();
			var amAddress = $(this).find('span:nth-child(14)').text();
			var amEmail = $(this).find('span:nth-child(15)').text();
			var amPhone = $(this).find('span:nth-child(16)').text();
			var amMovil = $(this).find('span:nth-child(17)').text();
			var amWhatsapp = $(this).find('span:nth-child(18)').text();
			var amRepresentativename = $(this).find('span:nth-child(19)').text();
			var amRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
			var amBank = $(this).find('span:nth-child(21)').text();
			var amTypeaccount = $(this).find('span:nth-child(22)').text();
			var amAccountnumber = $(this).find('span:nth-child(23)').text();
			var amRegime = $(this).find('span:nth-child(24)').text();
			var amTaxpayer = $(this).find('span:nth-child(25)').text();
			var amAutoretainer = $(this).find('span:nth-child(26)').text();
			var amActivitys = $(this).find('span:nth-child(27)').text();
			$('input[name=amId_Delete]').val(amId);
			$('.amReasonsocial_Delete').text(amReasonsocial);
			$('.amNumberdocument_Delete').text(perName + ': ' + amNumberdocument);
			$('.amNumberregistration_Delete').text(amNumberregistration);
			$('.amDateregistration_Delete').text(amDateregistration);
			$('.amCommerce_Delete').text(amCommerce);
			$('.depName_Delete').text(depName);
			$('.munName_Delete').text(munName);
			$('.zonName_Delete').text(zonName);
			$('.neName_Delete').text(neName);
			$('.neCode_Delete').text(neCode);
			$('.amAddress_Delete').text(amAddress);
			$('.amEmail_Delete').text(amEmail);
			$('.amPhone_Delete').text(amPhone);
			$('.amMovil_Delete').text(amMovil);
			$('.amWhatsapp_Delete').text(amWhatsapp);
			$('.amRepresentativename_Delete').text(amRepresentativename);
			$('.amRepresentativenumberdocument_Delete').text(amRepresentativenumberdocument);
			$('.amBank_Delete').text(amBank);
			$('.amTypeaccount_Delete').text(amTypeaccount);
			$('.amAccountnumber_Delete').text(amAccountnumber);
			$('.amRegime_Delete').text(amRegime);
			$('.amTaxpayer_Delete').text(amTaxpayer);
			$('.amAutoretainer_Delete').text(amAutoretainer);
			$('.amActivitys_Delete').text(amActivitys);
			$('#deleteMessenger-modal').modal();
		});
	</script>
@endsection