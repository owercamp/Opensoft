@extends('modules.administrativeHumans')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>COLABORADORES</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar colaborador" class="bj-btn-table-add form-control-sm newCollaborator-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessCollaborator'))
				    <div class="alert alert-success">
				        {{ session('SuccessCollaborator') }}
				    </div>
				@endif
				@if(session('PrimaryCollaborator'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryCollaborator') }}
				    </div>
				@endif
				@if(session('WarningCollaborator'))
				    <div class="alert alert-warning">
				        {{ session('WarningCollaborator') }}
				    </div>
				@endif
				@if(session('SecondaryCollaborator'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryCollaborator') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRES</th>
					<th>NUMERO DE DOCUMENTO</th>
					<th>CARGO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($collaborators as $collaborator)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $collaborator->coNames }}</td>
					<td>{{ $collaborator->coNumberdocument }}</td>
					<td>{{ $collaborator->coPosition }}</td>
					<td>
						<a href="#" title="Editar colaborador {{ $collaborator->coNames }}" class="bj-btn-table-edit form-control-sm editCollaborator-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $collaborator->coId }}</span>
							<span hidden>{{ $collaborator->coNames }}</span>
							<span hidden>{{ $collaborator->coPersonal_id }}</span>
							<span hidden>{{ $collaborator->coNumberdocument }}</span>
							<span hidden>{{ $collaborator->coPosition }}</span>
							<span hidden>{{ $collaborator->depId }}</span>
							<span hidden>{{ $collaborator->munId }}</span>
							<span hidden>{{ $collaborator->zonId }}</span>
							<span hidden>{{ $collaborator->neId }}</span>
							<span hidden>{{ $collaborator->coAddress }}</span>
							<span hidden>{{ $collaborator->coBloodtype }}</span>
							<span hidden>{{ $collaborator->coHealths_id }}</span>
							<span hidden>{{ $collaborator->coRisk_id }}</span>
							<span hidden>{{ $collaborator->coPension_id }}</span>
							<span hidden>{{ $collaborator->coLayoff_id }}</span>
							<span hidden>{{ $collaborator->coCompensation_id }}</span>
							<span hidden>{{ $collaborator->coEmail }}</span>
							<span hidden>{{ $collaborator->coMovil }}</span>
							<span hidden>{{ $collaborator->coWhatsapp }}</span>
							<img src="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" hidden>
							@if($collaborator->coFirm != null)
								<img src="{{ asset('storage/collaboratorsFirms/'.$collaborator->coFirm) }}" hidden>
							@else
								<img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
							@endif
						</a>
						<a href="#" title="Eliminar colaborador {{ $collaborator->coNames }}" class="bj-btn-table-delete form-control-sm deleteCollaborator-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $collaborator->coId }}</span>
							<span hidden>{{ $collaborator->coNames }}</span>
							<span hidden>{{ $collaborator->perName }}</span>
							<span hidden>{{ $collaborator->coNumberdocument }}</span>
							<span hidden>{{ $collaborator->coPosition }}</span>
							<span hidden>{{ $collaborator->depName }}</span>
							<span hidden>{{ $collaborator->munName }}</span>
							<span hidden>{{ $collaborator->zonName }}</span>
							<span hidden>{{ $collaborator->neName }}</span>
							<span hidden>{{ $collaborator->neCode }}</span>
							<span hidden>{{ $collaborator->coAddress }}</span>
							<span hidden>{{ $collaborator->coBloodtype }}</span>
							<span hidden>{{ $collaborator->heaName }}</span>
							<span hidden>{{ $collaborator->risName }}</span>
							<span hidden>{{ $collaborator->penName }}</span>
							<span hidden>{{ $collaborator->layName }}</span>
							<span hidden>{{ $collaborator->comName }}</span>
							<span hidden>{{ $collaborator->coEmail }}</span>
							<span hidden>{{ $collaborator->coMovil }}</span>
							<span hidden>{{ $collaborator->coWhatsapp }}</span>
							<img src="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" hidden>
							@if($collaborator->coFirm != null)
								<img src="{{ asset('storage/collaboratorsFirms/'.$collaborator->coFirm) }}" hidden>
							@else
								<img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
							@endif
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newCollaborator-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO COLABORADOR:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborator.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTOGRAFIA:</small>
											<div class="custom-file">
										        <input type="file" name="coPhoto" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FIRMA DIGITAL:</small>
											<div class="custom-file">
										        <input type="file" name="coFirm" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">NOMBRES COMPLETOS:</small>
											<input type="text" name="coNames" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="coPersonal_id" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="coNumberdocument" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CARGO:</small>
											<input type="text" name="coPosition" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Mensajero/Secretaria/Conductor" required>
										</div>
									</div>
								</div>
								<div class="row py-4">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="coDeparment_id" class="form-control form-control-sm" required>
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
													<select name="coMunicipality_id" class="form-control form-control-sm" required>
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
													<select name="coZoning_id" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="coNeighborhood_id" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="coCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">DIRECCION:</small>
													<input type="text" name="coAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="coEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="coMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="coWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-4">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">TIPO SANGUINEO:</small>
													<select name="coBloodtype" class="form-control form-control-sm" required>
														<option value="">Seleccione tipo de sangre ...</option>
														<option value="A POSITIVO">A POSITIVO</option>
														<option value="A NEGATIVO">A NEGATIVO</option>
														<option value="B POSITIVO">B POSITIVO</option>
														<option value="B NEGATIVO">B NEGATIVO</option>
														<option value="O POSITIVO">O POSITIVO</option>
														<option value="O NEGATIVO">O NEGATIVO</option>												
														<option value="AB POSITIVO">AB POSITIVO</option>
														<option value="AB NEGATIVO">AB NEGATIVO</option>												
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
													<select name="coHealths_id" class="form-control form-control-sm" required>
														<option value="">Seleccione entidad de salud ...</option>
														@foreach($healths as $health)
															<option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES:</small>
													<select name="coRisk_id" class="form-control form-control-sm" required>
														<option value="">Seleccione entidad de riesgos ...</option>
														@foreach($risks as $risk)
															<option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CAJA DE COMPENSACION:</small>
													<select name="coCompensation_id" class="form-control form-control-sm" required>
														<option value="">Seleccione caja ...</option>
														@foreach($compensations as $compensation)
															<option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FONDO DE PENSION:</small>
													<select name="coPension_id" class="form-control form-control-sm" required>
														<option value="">Seleccione fondo de pensión ...</option>
														@foreach($pensions as $pension)
															<option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FONDE CESANTIAS:</small>
													<select name="coLayoff_id" class="form-control form-control-sm" required>
														<option value="">Seleccione fondo de cesantías ...</option>
														@foreach($layoffs as $layoff)
															<option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
														@endforeach
													</select>
												</div>
											</div>
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

	<div class="modal fade" id="editCollaborator-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR COLABORADOR:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborator.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FOTOGRAFIA:</small>
											<div class="custom-file">
										        <input type="file" name="coPhoto_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										    <small class="text-muted">FOTO ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center coPhotonow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted coPhotonot_Edit">
												<input type="checkbox" name="coPhotonot_Edit" value="SIN FOTO">
												Dejar sin fotografia
											</small>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FIRMA DIGITAL:</small>
											<div class="custom-file">
										        <input type="file" name="coFirm_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
										    </div>
										    <small class="text-muted">FIRMA ACTUAL:</small><br>
										    <img src="" class="img-responsive img-thumbnail text-center coFirmnow_Edit" style="width: 150px; height: auto;"><br>
										    <small class="text-muted coFirmnot_Edit">
												<input type="checkbox" name="coFirmnot_Edit" value="SIN FIRMA">
												Dejar sin firma
											</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">NOMBRES COMPLETOS:</small>
											<input type="text" name="coNames_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Transportes Operalo" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TIPO DE IDENTIFICACION:</small>
											<select name="coPersonal_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione identificación ...</option>
												@foreach($personals as $personal)
													<option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE DOCUMENTO:</small>
											<input type="text" name="coNumberdocument_Edit" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CARGO:</small>
											<input type="text" name="coPosition_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Mensajero/Secretaria/Conductor" required>
										</div>
									</div>
								</div>
								<div class="row py-4">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">DEPARTAMENTO:</small>
													<select name="coDeparment_id_Edit" class="form-control form-control-sm" required>
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
													<select name="coMunicipality_id_Edit" class="form-control form-control-sm" required>
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
													<select name="coZoning_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione localidad/zona ...</option>
														<!-- zonId - zonName - zonMunicipality_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">BARRIO:</small>
													<select name="coNeighborhood_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione barrio ...</option>
														<!-- neId - neName - neZoning_id -->
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">CODIGO POSTAL:</small>
													<input type="text" name="coCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
												</div>
											</div>
										</div>
									</div>		
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="coAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
										</div>
									</div>
								</div>
								<div class="row py-2 border-top border-bottom">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CORREO ELECTRONICO:</small>
													<input type="email" name="coEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">TELEFONO CELULAR:</small>
													<input type="text" name="coMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">LINEA WHATSAPP:</small>
													<input type="text" name="coWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
												</div>
											</div>
										</div>	
									</div>
								</div>
								<div class="row py-4">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">TIPO SANGUINEO:</small>
													<select name="coBloodtype_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione tipo de sangre ...</option>
														<option value="A POSITIVO">A POSITIVO</option>
														<option value="A NEGATIVO">A NEGATIVO</option>
														<option value="B POSITIVO">B POSITIVO</option>
														<option value="B NEGATIVO">B NEGATIVO</option>
														<option value="O POSITIVO">O POSITIVO</option>
														<option value="O NEGATIVO">O NEGATIVO</option>												
														<option value="AB POSITIVO">AB POSITIVO</option>
														<option value="AB NEGATIVO">AB NEGATIVO</option>												
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
													<select name="coHealths_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione entidad de salud ...</option>
														@foreach($healths as $health)
															<option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES:</small>
													<select name="coRisk_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione entidad de riesgos ...</option>
														@foreach($risks as $risk)
															<option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CAJA DE COMPENSACION:</small>
													<select name="coCompensation_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione caja ...</option>
														@foreach($compensations as $compensation)
															<option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FONDO DE PENSION:</small>
													<select name="coPension_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione fondo de pensión ...</option>
														@foreach($pensions as $pension)
															<option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FONDE CESANTIAS:</small>
													<select name="coLayoff_id_Edit" class="form-control form-control-sm" required>
														<option value="">Seleccione fondo de cesantías ...</option>
														@foreach($layoffs as $layoff)
															<option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="coId_Edit" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteCollaborator-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>DETALLES/ELIMINACION DE COLABORADOR:</h5>
				</div>
				<div class="modal-body">
					<div class="row text-center">
						<div class="col-md-12">
							<span class="text-muted"><b class="coNames_Delete"></b></span><br>
							<span class="text-muted"><b class="coPersonal_id_Delete"></b>: <b class="coNumberdocument_Delete"></b></span><br>
							<span class="text-muted"><b class="coPosition_Delete"></b></span><br>
						</div>
					</div>
					<div class="row text-center py-2">
						<div class="col-md-6">
							<img src="" class="img-responsive img-thumbnail coPhotonow_Delete" style="width: 150px; height: 150px;">
						</div>
						<div class="col-md-6">
							<img src="" class="img-responsive img-thumbnail coFirmnow_Delete" style="width: 150px; height: 150px;">
						</div>
					</div>
					<div class="row text-center">
						<div class="col-md-12">
							<small class="text-muted">DEPARTAMENTO/CIUDAD: </small><br>
							<span class="text-muted"><b class="coDeparment_id_Delete"></b>/<b class="coMunicipality_id_Delete"></b></span><br>
							<small class="text-muted">LOCALIDAD/BARRIO/CODIGO POSTAL: </small><br>
							<span class="text-muted"><b class="coZoning_id_Delete"></b>/<b class="coNeighborhood_id_Delete"></b>/<b class="coCode_Delete"></b></span><br>
							<small class="text-muted">DIRECCION: </small><br>
							<span class="text-muted"><b class="coAddress_Delete"></b></span><br>
							<small class="text-muted">CORREO ELECTRONICO: </small><br>
							<span class="text-muted"><b class="coEmail_Delete"></b></span><br>
							<small class="text-muted">TELEFONO CELULAR: </small><br>
							<span class="text-muted"><b class="coMovil_Delete"></b></span><br>
							<small class="text-muted">LINEA WHATSAPP: </small><br>
							<span class="text-muted"><b class="coWhatsapp_Delete"></b></span><br>
							<hr>
							<small class="text-muted">TIPO DE SANGRE: </small><br>
							<span class="text-muted"><b class="coBloodtype_Delete"></b></span><br>
							<small class="text-muted">ENTIDAD PROMOTORA DE SALUD: </small><br>
							<span class="text-muted"><b class="coHealths_id_Delete"></b></span><br>
							<small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES: </small><br>
							<span class="text-muted"><b class="coRisk_id_Delete"></b></span><br>
							<small class="text-muted">CAJA DE COMPENSACION: </small><br>
							<span class="text-muted"><b class="coCompensation_id_Delete"></b></span><br>
							<small class="text-muted">FONDO DE PENSION: </small><br>
							<span class="text-muted"><b class="coPension_id_Delete"></b></span><br>
							<small class="text-muted">FONDO DE CESANTIAS: </small><br>
							<span class="text-muted"><b class="coLayoff_id_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('collaborator.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="coId_Delete" value="" required>
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

		$('.newCollaborator-link').on('click',function(){
			$('#newCollaborator-modal').modal();
		});

		$('.editCollaborator-link').on('click',function(e){
			e.preventDefault();
			var coPhoto = $(this).find('img:first').attr('src');
			var coFirm = $(this).find('img:last').attr('src');
			var coId = $(this).find('span:nth-child(2)').text();
			var coNames = $(this).find('span:nth-child(3)').text();
			var coPersonal_id = $(this).find('span:nth-child(4)').text();
			var coNumberdocument = $(this).find('span:nth-child(5)').text();
			var coPosition = $(this).find('span:nth-child(6)').text();
			var depId = $(this).find('span:nth-child(7)').text();
			var munId = $(this).find('span:nth-child(8)').text();
			var zonId = $(this).find('span:nth-child(9)').text();
			var neId = $(this).find('span:nth-child(10)').text();
			var coAddress = $(this).find('span:nth-child(11)').text();
			var coBloodtype = $(this).find('span:nth-child(12)').text();
			var coHealths_id = $(this).find('span:nth-child(13)').text();
			var coRisk_id = $(this).find('span:nth-child(14)').text();
			var coPension_id = $(this).find('span:nth-child(15)').text();
			var coLayoff_id = $(this).find('span:nth-child(16)').text();
			var coCompensation_id = $(this).find('span:nth-child(17)').text();
			var coEmail = $(this).find('span:nth-child(18)').text();
			var coMovil = $(this).find('span:nth-child(19)').text();
			var coWhatsapp = $(this).find('span:nth-child(20)').text();
			$('input[name=coId_Edit]').val(coId);
			$('.coPhotonow_Edit').attr("src",coPhoto);
			$('.coFirmnow_Edit').attr("src",coFirm);
			var findFirmDefault = coFirm.indexOf('firmCollaboratorDefault.png');
			if(findFirmDefault > -1){
				$('.coFirmnot_Edit').css("display","none");
			}else{
				$('.coFirmnot_Edit').css("display","block");
			}
			var findPhotoDefault = coPhoto.indexOf('photoCollaboratorDefault.png');
			if(findPhotoDefault > -1){
				$('.coPhotonot_Edit').css("display","none");
			}else{
				$('.coPhotonot_Edit').css("display","block");
			}
			$('input[name=coNames_Edit]').val(coNames);
			$('select[name=coPersonal_id_Edit]').val(coPersonal_id);
			$('input[name=coNumberdocument_Edit]').val(coNumberdocument);
			$('input[name=coPosition_Edit]').val(coPosition);
			$('select[name=coDeparment_id_Edit]').val(depId);

			$('select[name=coMunicipality_id_Edit]').empty();
			$('select[name=coMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$.get("{{ route('getMunicipalities') }}",{ depId: depId },function(objectMunicipalities){
				var count = Object.keys(objectMunicipalities).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectMunicipalities[i]['munId'] == munId){
							$('select[name=coMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}else{
							$('select[name=coMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('select[name=coZoning_id_Edit]').empty();
			$('select[name=coZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$.get("{{ route('getZonings') }}",{ munId: munId },function(objectZonings){
				var count = Object.keys(objectZonings).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectZonings[i]['zonId'] == zonId){
							$('select[name=coZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "' selected>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}else{
							$('select[name=coZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('select[name=coNeighborhood_id_Edit]').empty();
			$('select[name=coNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$.get("{{ route('getNeighborhoods') }}",{ zonId: zonId },function(objectNeighborhoods){
				var count = Object.keys(objectNeighborhoods).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectNeighborhoods[i]['neId'] == neId){
							$('input[name=coCode_Edit]').val(objectNeighborhoods[i]['neCode']);
							$('select[name=coNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}else{
							$('select[name=coNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" + 
									objectNeighborhoods[i]['neName'] + 
								"</option>"
							);
						}							
					}
				}
			});

			$('input[name=coAddress_Edit]').val(coAddress);
			$('select[name=coBloodtype_Edit]').val(coBloodtype);
			$('select[name=coHealths_id_Edit]').val(coHealths_id);
			$('select[name=coRisk_id_Edit]').val(coRisk_id);
			$('select[name=coPension_id_Edit]').val(coPension_id);
			$('select[name=coLayoff_id_Edit]').val(coLayoff_id);
			$('select[name=coCompensation_id_Edit]').val(coCompensation_id);
			$('input[name=coEmail_Edit]').val(coEmail);
			$('input[name=coMovil_Edit]').val(coMovil);
			$('input[name=coWhatsapp_Edit]').val(coWhatsapp);

			$('#editCollaborator-modal').modal();
		});

		$('.deleteCollaborator-link').on('click',function(e){
			e.preventDefault();
			var coPhoto = $(this).find('img:first').attr('src');
			var coFirm = $(this).find('img:last').attr('src');
			var coId = $(this).find('span:nth-child(2)').text();
			var coNames = $(this).find('span:nth-child(3)').text();
			var perName = $(this).find('span:nth-child(4)').text();
			var coNumberdocument = $(this).find('span:nth-child(5)').text();
			var coPosition = $(this).find('span:nth-child(6)').text();
			var depName = $(this).find('span:nth-child(7)').text();
			var munName = $(this).find('span:nth-child(8)').text();
			var zonName = $(this).find('span:nth-child(9)').text();
			var neName = $(this).find('span:nth-child(10)').text();
			var neCode = $(this).find('span:nth-child(11)').text();
			var coAddress = $(this).find('span:nth-child(12)').text();
			var coBloodtype = $(this).find('span:nth-child(13)').text();
			var coHealths_id = $(this).find('span:nth-child(14)').text();
			var coRisk_id = $(this).find('span:nth-child(15)').text();
			var coPension_id = $(this).find('span:nth-child(16)').text();
			var coLayoff_id = $(this).find('span:nth-child(17)').text();
			var coCompensation_id = $(this).find('span:nth-child(18)').text();
			var coEmail = $(this).find('span:nth-child(19)').text();
			var coMovil = $(this).find('span:nth-child(20)').text();
			var coWhatsapp = $(this).find('span:nth-child(21)').text();
			$('input[name=coId_Delete]').val(coId);
			$('.coNames_Delete').text(coNames);
			$('.coPersonal_id_Delete').text(perName);
			$('.coNumberdocument_Delete').text(coNumberdocument);
			$('.coPosition_Delete').text(coPosition);
			$('.coPhotonow_Delete').attr('src',coPhoto)
			$('.coFirmnow_Delete').attr('src',coFirm)
			$('.coDeparment_id_Delete').text(depName);
			$('.coMunicipality_id_Delete').text(munName);
			$('.coZoning_id_Delete').text(zonName);
			$('.coNeighborhood_id_Delete').text(neName);
			$('.coCode_Delete').text(neCode);
			$('.coAddress_Delete').text(coAddress);
			$('.coEmail_Delete').text(coEmail);
			$('.coMovil_Delete').text(coMovil);
			$('.coWhatsapp_Delete').text(coWhatsapp);
			$('.coBloodtype_Delete').text(coBloodtype);
			$('.coHealths_id_Delete').text(coHealths_id);
			$('.coRisk_id_Delete').text(coRisk_id);
			$('.coPension_id_Delete').text(coPension_id);
			$('.coLayoff_id_Delete').text(coLayoff_id);
			$('.coCompensation_id_Delete').text(coCompensation_id);
			$('#deleteCollaborator-modal').modal();
		});

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO SELECCIONADO EN EL MODAL DE NUEVA INFORMACION
		$('select[name=coDeparment_id]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=coMunicipality_id]').empty();
			$('select[name=coMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=coZoning_id]').empty();
			$('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=coNeighborhood_id]').empty();
			$('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coMunicipality_id]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=coMunicipality_id]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=coZoning_id]').empty();
			$('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=coNeighborhood_id]').empty();
			$('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coZoning_id]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=coZoning_id]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=coNeighborhood_id]').empty();
			$('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coNeighborhood_id]').append(
								"<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" + 
									objectNeighborhood[i]['neName'] +
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=coNeighborhood_id]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=coCode]').val('');
			if(neSelected != ''){
				var text = $('select[name=coNeighborhood_id] option:selected').attr('data-code');
				$('input[name=coCode]').val(text);
			}
		});

		// CONSULTAR MUNICIPIO POR DEPARTAMENTO SELECCIONADO EN EL MODAL DE EDICION DE INFORMACION
		$('select[name=coDeparment_id_Edit]').on('change',function(e){
			var deparmentSelected = e.target.value;
			$('select[name=coMunicipality_id_Edit]').empty();
			$('select[name=coMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
			$('select[name=coZoning_id_Edit]').empty();
			$('select[name=coZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=coNeighborhood_id_Edit]').empty();
			$('select[name=coNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode_Edit]').val('');
			if(deparmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: deparmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA EN EL MODAL DE EDICION DE INFORMACION
		$('select[name=coMunicipality_id_Edit]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=coZoning_id_Edit]').empty();
			$('select[name=coZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
			$('select[name=coNeighborhood_id_Edit]').empty();
			$('select[name=coNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode_Edit]').val('');
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE EDICION DE INFORMACION
		$('select[name=coZoning_id_Edit]').on('change',function(e){
			var zoneSelected = e.target.value;
			$('select[name=coNeighborhood_id_Edit]').empty();
			$('select[name=coNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
			$('input[name=coCode_Edit]').val('');
			if(zoneSelected != ''){
				$.get("{{ route('getNeighborhoods') }}",{ zonId: zoneSelected },function(objectNeighborhood){
					var count = Object.keys(objectNeighborhood).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=coNeighborhood_id_Edit]').append(
								"<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" + 
									objectNeighborhood[i]['neName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
		$('select[name=coNeighborhood_id_Edit]').on('change',function(e){
			var neSelected = e.target.value;
			$('input[name=coCode_Edit]').val('');
			if(neSelected != ''){
				var text = $('select[name=coNeighborhood_id_Edit] option:selected').attr('data-code');
				$('input[name=coCode_Edit]').val(text);
			}
		});
	</script>
@endsection