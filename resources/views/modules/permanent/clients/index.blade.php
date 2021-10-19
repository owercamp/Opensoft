@extends('modules.comercialPermanentcontracts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CLIENTES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newClient-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessClient'))
				    <div class="alert alert-success">
				        {{ session('SuccessClient') }}
				    </div>
				@endif
				@if(session('PrimaryClient'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryClient') }}
				    </div>
				@endif
				@if(session('WarningClient'))
				    <div class="alert alert-warning">
				        {{ session('WarningClient') }}
				    </div>
				@endif
				@if(session('SecondaryClient'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryClient') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>TIPO DE CLIENTE</th>
					<th>NOMBRE/RAZON</th>
					<th>DOCUMENTO</th>
					<th>CIUDAD</th>
					<th>CORREO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($clients as $client)
				<tr>
					<td>{{ $row++ }}</td>
					<td>
						@if($client->cliType == 'Natural')
							{{ __('PERSONA NATURAL') }}
						@else
							{{ __('PERSONA JURIDICA') }}
						@endif
					</td>
					<td>{{ $client->cliNamereason }}</td>
					<td>{{ $client->cliNumberdocument }}</td>
					<td>{{ $client->municipality->munName }}</td>
					<td>{{ $client->cliEmail }}</td>
					<td>
						@if($client->cliType == 'Natural')
							<a href="#" title="Editar persona natural" class="bj-btn-table-edit form-control-sm editClientnatural-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $client->cliId }}</span>
								<span hidden>{{ $client->cliNamereason }}</span>
								<span hidden>{{ $client->cliNumberdocument }}</span>
								<span hidden>{{ $client->cliMunicipality_id }}</span>
								<span hidden>{{ $client->municipality->munDepartment_id }}</span>
								<span hidden>{{ $client->cliAddress }}</span>
								<span hidden>{{ $client->cliPhone }}</span>
								<span hidden>{{ $client->cliMovil }}</span>
								<span hidden>{{ $client->cliWhatsapp }}</span>
								<span hidden>{{ $client->cliEmail }}</span>
								@if($client->cliPdfrut != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/naturales/'.$client->cliPdfrut) }}</span>
									<span hidden>{{ __('VER RUT') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfphotocopy != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/naturales/'.$client->cliPdfphotocopy) }}</span>
									<span hidden>{{ __('VER FOTOCOPIA DE CEDULA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
							</a>
							<a href="#" title="Eliminar persona natural" class="bj-btn-table-delete form-control-sm deleteClientnatural-link">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $client->cliId }}</span>
								<span hidden>{{ $client->cliNamereason }}</span>
								<span hidden>{{ $client->cliNumberdocument }}</span>
								<span hidden>{{ $client->municipality->munName }}</span>
								<span hidden>{{ $client->cliAddress }}</span>
								<span hidden>{{ $client->cliPhone }}</span>
								<span hidden>{{ $client->cliMovil }}</span>
								<span hidden>{{ $client->cliWhatsapp }}</span>
								<span hidden>{{ $client->cliEmail }}</span>
								@if($client->cliPdfrut != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/naturales/'.$client->cliPdfrut) }}</span>
									<span hidden>{{ __('VER RUT') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfphotocopy != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/naturales/'.$client->cliPdfphotocopy) }}</span>
									<span hidden>{{ __('VER FOTOCOPIA DE CEDULA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
							</a>
						@else
							<a href="#" title="Editar persona jurídica" class="bj-btn-table-edit form-control-sm editClientjuridica-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $client->cliId }}</span>
								<span hidden>{{ $client->cliNamereason }}</span>
								<span hidden>{{ $client->cliNumberdocument }}</span>
								<span hidden>{{ $client->cliNamerepresentative }}</span>
								<span hidden>{{ $client->cliNumberrepresentative }}</span>
								<span hidden>{{ $client->cliMunicipality_id }}</span>
								<span hidden>{{ $client->municipality->munDepartment_id }}</span>
								<span hidden>{{ $client->cliAddress }}</span>
								<span hidden>{{ $client->cliPhone }}</span>
								<span hidden>{{ $client->cliMovil }}</span>
								<span hidden>{{ $client->cliWhatsapp }}</span>
								<span hidden>{{ $client->cliEmail }}</span>
								@if($client->cliPdfrut != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfrut) }}</span>
									<span hidden>{{ __('VER RUT') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfphotocopy != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfphotocopy) }}</span>
									<span hidden>{{ __('VER FOTOCOPIA DE CEDULA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfexistence != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfexistence) }}</span>
									<span hidden>{{ __('VER CERTIFICADO DE EXISTENCIA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdflegal != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdflegal) }}</span>
									<span hidden>{{ __('VER REPRESENTACION LEGAL') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
							</a>
							<a href="#" title="Eliminar persona jurídica" class="bj-btn-table-delete form-control-sm deleteClientjuridica-link">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $client->cliId }}</span>
								<span hidden>{{ $client->cliNamereason }}</span>
								<span hidden>{{ $client->cliNumberdocument }}</span>
								<span hidden>{{ $client->cliNamerepresentative }}</span>
								<span hidden>{{ $client->cliNumberrepresentative }}</span>
								<span hidden>{{ $client->municipality->munName }}</span>
								<span hidden>{{ $client->cliAddress }}</span>
								<span hidden>{{ $client->cliPhone }}</span>
								<span hidden>{{ $client->cliMovil }}</span>
								<span hidden>{{ $client->cliWhatsapp }}</span>
								<span hidden>{{ $client->cliEmail }}</span>
								@if($client->cliPdfrut != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfrut) }}</span>
									<span hidden>{{ __('VER RUT') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfphotocopy != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfphotocopy) }}</span>
									<span hidden>{{ __('VER FOTOCOPIA DE CEDULA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdfexistence != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdfexistence) }}</span>
									<span hidden>{{ __('VER CERTIFICADO DE EXISTENCIA') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
								@if($client->cliPdflegal != null)
									<span hidden>{{ asset('storage/permanentcontractsClients/juridicas/'.$client->cliPdflegal) }}</span>
									<span hidden>{{ __('VER REPRESENTACION LEGAL') }}</span>
								@else
									<span hidden>{{ __('N/A') }}</span>
									<span hidden>{{ __('N/A') }}</span>
								@endif
							</a>
						@endif
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

	<div class="modal fade" id="newClient-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVO CLIENTE:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('permanent.clients.save') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPO DE CLIENTE:</small>
											<select name="cliType" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="PERSONA NATURAL">PERSONA NATURAL</option>
												<option value="PERSONA JURIDICA">PERSONA JURIDICA</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row p-4 text-center bj-spinner-new">
									<div class="col-md-12">
										<div class="spinner-border" align="center" role="status">
										  	<span class="sr-only" align="center">Procesando...</span>
										</div>
									</div>
								</div>
								<div class="row section-form">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-12">
												<!-- SECCION DE PERSONA NATURAL -->
												<div class="row section-natural" style="display: none;">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">NUMERO DE CEDULA:</small>
																	<input type="text" name="cliNumberdocument_natural" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-8">
																<div class="form-group">
																	<small class="text-muted">NOMBRES Y APELLIDOS:</small>
																	<input type="text" name="cliNamereason_natural" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">DEPARTAMENTO:</small>
																	<select name="cliDepartment_natural" class="form-control form-control-sm" required>
																		<option value="">Seleccione ...</option>
																		@foreach($departments as $department)
																			<option value="{{ $department->depId }}">
																				{{ $department->depName }}
																			</option>
																		@endforeach()
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">MUNICIPIO:</small>
																	<select name="cliMunicipality_id_natural" class="form-control form-control-sm" required>
																		<option value="">Seleccione ...</option>
																	</select>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">DIRECCION:</small>
																	<input type="text" name="cliAddress_natural" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">CORREO ELECTRONICO:</small>
																	<input type="email" name="cliEmail_natural" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">TELEFONO:</small>
																	<input type="text" name="cliPhone_natural" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">CELULAR:</small>
																	<input type="text" name="cliMovil_natural" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">WHATSAPP:</small>
																	<input type="text" name="cliWhatsapp_natural" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">RUT:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdfrut_natural" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">FOTOCOPIA DE CEDULA:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdfphotocopy_natural" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- SECCION DE PERSONA JURIDICA -->
												<div class="row section-juridica" style="display: none;">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">NUMERO DE NIT:</small>
																	<input type="text" name="cliNumberdocument_juridica" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" title="Solo números" required>
																</div>
															</div>
															<div class="col-md-8">
																<div class="form-group">
																	<small class="text-muted">RAZON SOCIAL:</small>
																	<input type="text" name="cliNamereason_juridica" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-8">
																<div class="form-group">
																	<small class="text-muted">REPRESENTANTE LEGAL:</small>
																	<input type="text" name="cliNamerepresentative_juridica" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">NUMERO DE CEDULA:</small>
																	<input type="text" name="cliNumberrepresentative_juridica" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">DEPARTAMENTO:</small>
																	<select name="cliDepartment_juridica" class="form-control form-control-sm" required>
																		<option value="">Seleccione ...</option>
																		@foreach($departments as $department)
																			<option value="{{ $department->depId }}">
																				{{ $department->depName }}
																			</option>
																		@endforeach()
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">MUNICIPIO:</small>
																	<select name="cliMunicipality_id_juridica" class="form-control form-control-sm" required>
																		<option value="">Seleccione ...</option>
																	</select>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">DIRECCION:</small>
																	<input type="text" name="cliAddress_juridica" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">CORREO ELECTRONICO:</small>
																	<input type="email" name="cliEmail_juridica" maxlength="50" class="form-control form-control-sm" required>
																</div>
															</div>	
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">TELEFONO:</small>
																	<input type="text" name="cliPhone_juridica" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">CELULAR:</small>
																	<input type="text" name="cliMovil_juridica" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<small class="text-muted">WHATSAPP:</small>
																	<input type="text" name="cliWhatsapp_juridica" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">RUT:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdfrut_juridica" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">FOTOCOPIA DE CEDULA:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdfphotocopy_juridica" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">CERTIFICADO DE EXISTENCIA:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdfexistence_juridica" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<small class="text-muted">REPRESENTACION LEGAL:</small>
																	<div class="custom-file">
																        <input type="file" name="cliPdflegal_juridica" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
																    </div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center">
												<div class="form-group text-center mt-3">
													<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
												</div>
											</div>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editClientnatural-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE CLIENTE (PERSONA NATURAL):</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('permanent.clients.natural.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE CEDULA:</small>
											<input type="text" name="cliNumberdocument_natural_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRES Y APELLIDOS:</small>
											<input type="text" name="cliNamereason_natural_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select name="cliDepartment_natural_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($departments as $department)
													<option value="{{ $department->depId }}">
														{{ $department->depName }}
													</option>
												@endforeach()
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO:</small>
											<select name="cliMunicipality_id_natural_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="cliAddress_natural_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CORREO ELECTRONICO:</small>
											<input type="email" name="cliEmail_natural_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TELEFONO:</small>
											<input type="text" name="cliPhone_natural_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CELULAR:</small>
											<input type="text" name="cliMovil_natural_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">WHATSAPP:</small>
											<input type="text" name="cliWhatsapp_natural_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">RUT ACTUAL:</small><br>
										    <a href="#" target="_blank" class="namerut_now_Edit"></a><br>
										    <small class="text-muted rutnot_Edit">
												<input type="checkbox" name="rutnot_Edit" value="SIN RUT">
												Quitar rut
											</small>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">FOTOCOPIA DE CEDULA ACTUAL:</small><br>
										    <a href="#" target="_blank" class="namecopy_now_Edit"></a><br>
										    <small class="text-muted copynot_Edit">
												<input type="checkbox" name="copynot_Edit" value="SIN FOTOCOPIA">
												Quitar fotocopia de cédula
											</small>
										</div>
									</div>
								</div>
								<div class="row p-2 border">
									<div class="col-md-12">
										<h6>SELECCIONE LOS NUEVOS ARCHIVOS PDF (Los actuales seran remplazados por los que seleccione)</h6>
										<div class="row text-center">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">RUT:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdfrut_natural_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTOCOPIA DE CEDULA:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdfphotocopy_natural_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
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
								<input type="hidden" class="form-control form-control-sm" name="cliId_Edit" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="cliType_Edit" value="PERSONA NATURAL" readonly required>
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

	<div class="modal fade" id="editClientjuridica-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE CLIENTE (PERSONA JURIDICA):</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('permanent.clients.juridica.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE NIT:</small>
											<input type="text" name="cliNumberdocument_juridica_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">RAZON SOCIAL:</small>
											<input type="text" name="cliNamereason_juridica_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">REPRESENTANTE LEGAL:</small>
											<input type="text" name="cliNamerepresentative_juridica_Edit" maxlength="50" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">NUMERO DE CEDULA:</small>
											<input type="text" name="cliNumberrepresentative_juridica_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DEPARTAMENTO:</small>
											<select name="cliDepartment_juridica_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($departments as $department)
													<option value="{{ $department->depId }}">
														{{ $department->depName }}
													</option>
												@endforeach()
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">MUNICIPIO:</small>
											<select name="cliMunicipality_id_juridica_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
											</select>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">DIRECCION:</small>
											<input type="text" name="cliAddress_juridica_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">CORREO ELECTRONICO:</small>
											<input type="email" name="cliEmail_juridica_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>	
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">TELEFONO:</small>
											<input type="text" name="cliPhone_juridica_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CELULAR:</small>
											<input type="text" name="cliMovil_juridica_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">WHATSAPP:</small>
											<input type="text" name="cliWhatsapp_juridica_Edit" maxlength="10" pattern="[0-9]{1,10}" title="Solo números" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">RUT ACTUAL:</small><br>
										    <a href="#" target="_blank" class="namerut_juridica_now_Edit"></a><br>
										    <small class="text-muted rutnot_juridica_Edit">
												<input type="checkbox" name="rutnot_juridica_Edit" value="SIN RUT">
												Quitar rut
											</small>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">FOTOCOPIA DE CEDULA ACTUAL:</small><br>
										    <a href="#" target="_blank" class="namecopy_juridica_now_Edit"></a><br>
										    <small class="text-muted copynot_juridica_Edit">
												<input type="checkbox" name="copynot_juridica_Edit" value="SIN FOTO">
												Quitar fotocopia de cédula
											</small>
										</div>
									</div>
								</div>
								<div class="row text-center">
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">EXISTENCIA ACTUAL:</small><br>
										    <a href="#" target="_blank" class="nameexistence_juridica_now_Edit"></a><br>
										    <small class="text-muted existencenot_juridica_Edit">
												<input type="checkbox" name="existencenot_juridica_Edit" value="SIN RUT">
												Quitar certificado de existencia
											</small>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										    <small class="text-muted">REPRESENTACION LEGAL ACTUAL:</small><br>
										    <a href="#" target="_blank" class="namelegal_juridica_now_Edit"></a><br>
										    <small class="text-muted legalnot_juridica_Edit">
												<input type="checkbox" name="legalnot_juridica_Edit" value="SIN FOTO">
												Quitar representacion legal
											</small>
										</div>
									</div>
								</div>
								<div class="row p-2 border">
									<div class="col-md-12">
										<h6>SELECCIONE LOS NUEVOS ARCHIVOS PDF (Los actuales seran remplazados por los que seleccione)</h6>
										<div class="row text-center">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">RUT:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdfrut_juridica_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">FOTOCOPIA DE CEDULA:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdfphotocopy_juridica_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
												    </div>
												</div>
											</div>
										</div>
										<div class="row text-center">
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">CERTIFICADO DE EXISTENCIA:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdfexistence_juridica_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
												    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<small class="text-muted">REPRESENTACION LEGAL:</small>
													<div class="custom-file">
												        <input type="file" name="cliPdflegal_juridica_Edit" lang="es" placeholder="Unicamente con extensión .pdf" accept="application/pdf">
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
								<input type="hidden" class="form-control form-control-sm" name="cliId_juridica_Edit" readonly required>
								<input type="hidden" class="form-control form-control-sm" name="cliType_juridica_Edit" value="PERSONA JURIDICA" readonly required>
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

	<div class="modal fade" id="deleteClientnatural-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CLIENTE (PERSONA NATURAL):</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">RAZON SOCIAL: </small><br>
							<span class="text-muted"><b class="cliNamereason_natural_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="cliNumberdocument_natural_Delete"></b></span><br>
							<small class="text-muted">MUNICIPIO: </small><br>
							<span class="text-muted"><b class="cliMunicipality_id_natural_Delete"></b></span><br>
							<small class="text-muted">DIRECCION: </small><br>
							<span class="text-muted"><b class="cliAddress_natural_Delete"></b></span><br>
							<small class="text-muted">TELEFONO: </small><br>
							<span class="text-muted"><b class="cliPhone_natural_Delete"></b></span><br>
							<small class="text-muted">CELULAR: </small><br>
							<span class="text-muted"><b class="cliMovil_natural_Delete"></b></span><br>
							<small class="text-muted">WHATSAPP: </small><br>
							<span class="text-muted"><b class="cliWhatsapp_natural_Delete"></b></span><br>
							<small class="text-muted">CORREO ELECTRONICO: </small><br>
							<span class="text-muted"><b class="cliEmail_natural_Delete"></b></span><br>
							<small class="text-muted">RUT: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdfrut_natural_Delete"></a></span><br>
							<small class="text-muted">FOTOCOPIA DE CEDULA: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdfphotocopy_natural_Delete"></a></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('permanent.clients.natural.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="cliId_Delete" readonly required>
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

	<div class="modal fade" id="deleteClientjuridica-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CLIENTE (PERSONA JURIDICA):</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">RAZON SOCIAL: </small><br>
							<span class="text-muted"><b class="cliNamereason_juridica_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="cliNumberdocument_juridica_Delete"></b></span><br>
							<small class="text-muted">REPRESENTANTE LEGAL: </small><br>
							<span class="text-muted"><b class="cliNamerepresentative_juridica_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO REPRESENTANTE: </small><br>
							<span class="text-muted"><b class="cliNumberrepresentative_juridica_Delete"></b></span><br>
							<small class="text-muted">MUNICIPIO: </small><br>
							<span class="text-muted"><b class="cliMunicipality_id_juridica_Delete"></b></span><br>
							<small class="text-muted">DIRECCION: </small><br>
							<span class="text-muted"><b class="cliAddress_juridica_Delete"></b></span><br>
							<small class="text-muted">TELEFONO: </small><br>
							<span class="text-muted"><b class="cliPhone_juridica_Delete"></b></span><br>
							<small class="text-muted">CELULAR: </small><br>
							<span class="text-muted"><b class="cliMovil_juridica_Delete"></b></span><br>
							<small class="text-muted">WHATSAPP: </small><br>
							<span class="text-muted"><b class="cliWhatsapp_juridica_Delete"></b></span><br>
							<small class="text-muted">CORREO ELECTRONICO: </small><br>
							<span class="text-muted"><b class="cliEmail_juridica_Delete"></b></span><br>
							<small class="text-muted">RUT: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdfrut_juridica_Delete"></a></span><br>
							<small class="text-muted">FOTOCOPIA DE CEDULA: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdfphotocopy_juridica_Delete"></a></span><br>
							<small class="text-muted">CERTIFICADO DE EXISTENCIA: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdfexistence_juridica_Delete"></a></span><br>
							<small class="text-muted">REPRESENTACION LEGAL: </small><br>
							<span class="text-muted"><a href="#" target="_blank" class="cliPdflegal_juridica_Delete"></a></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('permanent.clients.juridica.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="cliId_juridica_Delete" readonly required>
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
			$('.bj-spinner-new').css('display','none');
		});

		$('.newClient-link').on('click',function(){
			$('#newClient-modal').modal();
		});

		$('select[name=cliType]').on('change',function(e){
			var selected = e.target.value;
			$('div.section-form').css('display','none');
			$('div.section-natural').css('display','none');
			$('div.section-juridica').css('display','none');
			$('.bj-spinner-new').css('display','flex');
			if(selected != ''){
				if(selected == 'PERSONA NATURAL'){
					// NATURAL
					$('input[name=cliNumberdocument_natural]').attr('required',true);
					$('input[name=cliNumberdocument_natural]').attr('disabled',false);
					$('input[name=cliNamereason_natural]').attr('required',true);
					$('input[name=cliNamereason_natural]').attr('disabled',false);
					$('select[name=cliDepartment_natural]').attr('required',true);
					$('select[name=cliDepartment_natural]').attr('disabled',false);
					$('select[name=cliMunicipality_id_natural]').attr('required',true);
					$('select[name=cliMunicipality_id_natural]').attr('disabled',false);
					$('input[name=cliAddress_natural]').attr('required',true);
					$('input[name=cliAddress_natural]').attr('disabled',false);
					$('input[name=cliPhone_natural]').attr('required',true);
					$('input[name=cliPhone_natural]').attr('disabled',false);
					$('input[name=cliMovil_natural]').attr('required',true);
					$('input[name=cliMovil_natural]').attr('disabled',false);
					$('input[name=cliWhatsapp_natural]').attr('required',true);
					$('input[name=cliWhatsapp_natural]').attr('disabled',false);
					$('input[name=cliEmail_natural]').attr('required',true);
					$('input[name=cliEmail_natural]').attr('disabled',false);
					// JURIDICO
					$('input[name=cliNumberdocument_juridica]').attr('required',false);
					$('input[name=cliNumberdocument_juridica]').attr('disabled',true);
					$('input[name=cliNamereason_juridica]').attr('required',false);
					$('input[name=cliNamereason_juridica]').attr('disabled',true);
					$('input[name=cliNamerepresentative_juridica]').attr('required',false);
					$('input[name=cliNamerepresentative_juridica]').attr('disabled',true);
					$('input[name=cliNumberrepresentative_juridica]').attr('required',false);
					$('input[name=cliNumberrepresentative_juridica]').attr('disabled',true);
					$('select[name=cliDepartment_juridica]').attr('required',false);
					$('select[name=cliDepartment_juridica]').attr('disabled',true);
					$('select[name=cliMunicipality_id_juridica]').attr('required',false);
					$('select[name=cliMunicipality_id_juridica]').attr('disabled',true);
					$('input[name=cliAddress_juridica]').attr('required',false);
					$('input[name=cliAddress_juridica]').attr('disabled',true);
					$('input[name=cliPhone_juridica]').attr('required',false);
					$('input[name=cliPhone_juridica]').attr('disabled',true);
					$('input[name=cliMovil_juridica]').attr('required',false);
					$('input[name=cliMovil_juridica]').attr('disabled',true);
					$('input[name=cliWhatsapp_juridica]').attr('required',false);
					$('input[name=cliWhatsapp_juridica]').attr('disabled',true);
					$('input[name=cliEmail_juridica]').attr('required',false);
					$('input[name=cliEmail_juridica]').attr('disabled',true);
					setTimeout(function(){
						$('.bj-spinner-new').css('display','none');
						$('div.section-natural').css('display','flex');
					},500);
				}else if(selected == 'PERSONA JURIDICA'){
					// NATURAL
					$('input[name=cliNumberdocument_natural]').attr('required',false);
					$('input[name=cliNumberdocument_natural]').attr('disabled',true);
					$('input[name=cliNamereason_natural]').attr('required',false);
					$('input[name=cliNamereason_natural]').attr('disabled',true);
					$('select[name=cliDepartment_natural]').attr('required',false);
					$('select[name=cliDepartment_natural]').attr('disabled',true);
					$('select[name=cliMunicipality_id_natural]').attr('required',false);
					$('select[name=cliMunicipality_id_natural]').attr('disabled',true);
					$('input[name=cliAddress_natural]').attr('required',false);
					$('input[name=cliAddress_natural]').attr('disabled',true);
					$('input[name=cliPhone_natural]').attr('required',false);
					$('input[name=cliPhone_natural]').attr('disabled',true);
					$('input[name=cliMovil_natural]').attr('required',false);
					$('input[name=cliMovil_natural]').attr('disabled',true);
					$('input[name=cliWhatsapp_natural]').attr('required',false);
					$('input[name=cliWhatsapp_natural]').attr('disabled',true);
					$('input[name=cliEmail_natural]').attr('required',false);
					$('input[name=cliEmail_natural]').attr('disabled',true);
					// JURIDICO
					$('input[name=cliNumberdocument_juridica]').attr('required',true);
					$('input[name=cliNumberdocument_juridica]').attr('disabled',false);
					$('input[name=cliNamereason_juridica]').attr('required',true);
					$('input[name=cliNamereason_juridica]').attr('disabled',false);
					$('input[name=cliNamerepresentative_juridica]').attr('required',true);
					$('input[name=cliNamerepresentative_juridica]').attr('disabled',false);
					$('input[name=cliNumberrepresentative_juridica]').attr('required',true);
					$('input[name=cliNumberrepresentative_juridica]').attr('disabled',false);
					$('select[name=cliDepartment_juridica]').attr('required',true);
					$('select[name=cliDepartment_juridica]').attr('disabled',false);
					$('select[name=cliMunicipality_id_juridica]').attr('required',true);
					$('select[name=cliMunicipality_id_juridica]').attr('disabled',false);
					$('input[name=cliAddress_juridica]').attr('required',true);
					$('input[name=cliAddress_juridica]').attr('disabled',false);
					$('input[name=cliPhone_juridica]').attr('required',true);
					$('input[name=cliPhone_juridica]').attr('disabled',false);
					$('input[name=cliMovil_juridica]').attr('required',true);
					$('input[name=cliMovil_juridica]').attr('disabled',false);
					$('input[name=cliWhatsapp_juridica]').attr('required',true);
					$('input[name=cliWhatsapp_juridica]').attr('disabled',false);
					$('input[name=cliEmail_juridica]').attr('required',true);
					$('input[name=cliEmail_juridica]').attr('disabled',false);
					setTimeout(function(){
						$('.bj-spinner-new').css('display','none');
						$('div.section-juridica').css('display','flex');
					},500);
				}
				$('div.section-form').css('display','flex');
			}
		});

		$('select[name=cliDepartment_juridica]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=cliMunicipality_id_juridica]').empty();
			$('select[name=cliMunicipality_id_juridica]').append("<option value=''>Seleccione ...</option>");
			if(selected != ''){
				$.get("{{ route('getMunicipalities') }}",{depId: selected},function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=cliMunicipality_id_juridica]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
					}
				});
			}
		});

		$('select[name=cliDepartment_natural]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=cliMunicipality_id_natural]').empty();
			$('select[name=cliMunicipality_id_natural]').append("<option value=''>Seleccione ...</option>");
			if(selected != ''){
				$.get("{{ route('getMunicipalities') }}",{depId: selected},function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=cliMunicipality_id_natural]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
					}
				});
			}
		});

		$('.editClientnatural-link').on('click',function(e){
			e.preventDefault();
			var cliId = $(this).find('span:nth-child(2)').text();
			var cliNamereason = $(this).find('span:nth-child(3)').text();
			var cliNumberdocument = $(this).find('span:nth-child(4)').text();
			var cliMunicipality_id = $(this).find('span:nth-child(5)').text();
			var depId = $(this).find('span:nth-child(6)').text();
			var cliAddress = $(this).find('span:nth-child(7)').text();
			var cliPhone = $(this).find('span:nth-child(8)').text();
			var cliMovil = $(this).find('span:nth-child(9)').text();
			var cliWhatsapp = $(this).find('span:nth-child(10)').text();
			var cliEmail = $(this).find('span:nth-child(11)').text();
			var cliPdfrut = $(this).find('span:nth-child(12)').text();
			var namerut = $(this).find('span:nth-child(13)').text();
			var cliPdfphotocopy = $(this).find('span:nth-child(14)').text();
			var namephotocopy = $(this).find('span:nth-child(15)').text();
			$('input[name=cliId_Edit]').val(cliId);
			$('input[name=cliNamereason_natural_Edit]').val(cliNamereason);
			$('input[name=cliNumberdocument_natural_Edit]').val(cliNumberdocument);
			$('select[name=cliDepartment_natural_Edit]').val(depId);

			$.get("{{ route('getMunicipalities') }}",{depId: depId},function(objectMunicipalities){
				var count = Object.keys(objectMunicipalities).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectMunicipalities[i]['munId'] == cliMunicipality_id){
							municipalitySelected = objectMunicipalities[i]['munId'];
							$('select[name=cliMunicipality_id_natural_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}else{
							$('select[name=cliMunicipality_id_natural_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
							
					}
				}
			});

			$('input[name=cliAddress_natural_Edit]').val(cliAddress);
			$('input[name=cliPhone_natural_Edit]').val(cliPhone);
			$('input[name=cliMovil_natural_Edit]').val(cliMovil);
			$('input[name=cliWhatsapp_natural_Edit]').val(cliWhatsapp);
			$('input[name=cliEmail_natural_Edit]').val(cliEmail);

			if(cliPdfrut != 'N/A'){
				$('.rutnot_Edit').css('display','inline-block');
				$('a.namerut_now_Edit').css('display','inline-block');
				$('a.namerut_now_Edit').attr('href',cliPdfrut);
				$('a.namerut_now_Edit').text(namerut);
			}else{
				$('.rutnot_Edit').css('display','none');
				$('a.namerut_now_Edit').css('display','none');
			}
			if(cliPdfphotocopy != 'N/A'){
				$('.copynot_Edit').css('display','inline-block');
				$('a.namecopy_now_Edit').css('display','inline-block');
				$('a.namecopy_now_Edit').attr('href',cliPdfphotocopy);
				$('a.namecopy_now_Edit').text(namephotocopy);
			}else{
				$('.copynot_Edit').css('display','none');
				$('a.namecopy_now_Edit').css('display','none');
			}
			$('#editClientnatural-modal').modal();
		});

		$('select[name=cliDepartment_natural_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=cliMunicipality_id_natural_Edit]').empty();
			$('select[name=cliMunicipality_id_natural_Edit]').append("<option value=''>Seleccione ...</option>");
			if(selected != ''){
				$.get("{{ route('getMunicipalities') }}",{depId: selected},function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=cliMunicipality_id_natural_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
					}
				});
			}
		});

		$('.deleteClientnatural-link').on('click',function(e){
			e.preventDefault();
			var cliId = $(this).find('span:nth-child(2)').text();
			var cliNamereason = $(this).find('span:nth-child(3)').text();
			var cliNumberdocument = $(this).find('span:nth-child(4)').text();
			var munName = $(this).find('span:nth-child(5)').text();
			var cliAddress = $(this).find('span:nth-child(6)').text();
			var cliPhone = $(this).find('span:nth-child(7)').text();
			var cliMovil = $(this).find('span:nth-child(8)').text();
			var cliWhatsapp = $(this).find('span:nth-child(9)').text();
			var cliEmail = $(this).find('span:nth-child(10)').text();
			var cliPdfrut = $(this).find('span:nth-child(11)').text();
			var namerut = $(this).find('span:nth-child(12)').text();
			var cliPdfphotocopy = $(this).find('span:nth-child(13)').text();
			var namephotocopy = $(this).find('span:nth-child(14)').text();
			$('input[name=cliId_Delete]').val(cliId);
			$('.cliNamereason_natural_Delete').text(cliNamereason);
			$('.cliNumberdocument_natural_Delete').text(cliNumberdocument);
			$('.cliMunicipality_id_natural_Delete').text(munName);
			$('.cliAddress_natural_Delete').text(cliAddress);
			$('.cliPhone_natural_Delete').text(cliPhone);
			$('.cliMovil_natural_Delete').text(cliMovil);
			$('.cliWhatsapp_natural_Delete').text(cliWhatsapp);
			$('.cliEmail_natural_Delete').text(cliEmail);

			if(cliPdfrut != 'N/A'){
				$('a.cliPdfrut_natural_Delete').css('display','inline-block');
				$('a.cliPdfrut_natural_Delete').attr('href',cliPdfrut);
				$('a.cliPdfrut_natural_Delete').text(namerut);
			}else{
				$('a.cliPdfrut_natural_Delete').css('display','none');
				$('a.cliPdfrut_natural_Delete').attr('href','#');
				$('a.cliPdfrut_natural_Delete').text('');
			}
			if(cliPdfphotocopy != 'N/A'){
				$('a.cliPdfphotocopy_natural_Delete').css('display','inline-block');
				$('a.cliPdfphotocopy_natural_Delete').attr('href',cliPdfphotocopy);
				$('a.cliPdfphotocopy_natural_Delete').text(namephotocopy);
			}else{
				$('a.cliPdfphotocopy_natural_Delete').css('display','none');
				$('a.cliPdfphotocopy_natural_Delete').attr('href','#');
				$('a.cliPdfphotocopy_natural_Delete').text('');
			}
			$('#deleteClientnatural-modal').modal();
		});

		$('.editClientjuridica-link').on('click',function(e){
			e.preventDefault();
			var cliId = $(this).find('span:nth-child(2)').text();
			var cliNamereason = $(this).find('span:nth-child(3)').text();
			var cliNumberdocument = $(this).find('span:nth-child(4)').text();
			var cliNamerepresentative = $(this).find('span:nth-child(5)').text();
			var cliNumberrepresentative = $(this).find('span:nth-child(6)').text();
			var cliMunicipality_id = $(this).find('span:nth-child(7)').text();
			var depId = $(this).find('span:nth-child(8)').text();
			var cliAddress = $(this).find('span:nth-child(9)').text();
			var cliPhone = $(this).find('span:nth-child(10)').text();
			var cliMovil = $(this).find('span:nth-child(11)').text();
			var cliWhatsapp = $(this).find('span:nth-child(12)').text();
			var cliEmail = $(this).find('span:nth-child(13)').text();
			var cliPdfrut = $(this).find('span:nth-child(14)').text();
			var namerut = $(this).find('span:nth-child(15)').text();
			var cliPdfphotocopy = $(this).find('span:nth-child(16)').text();
			var namephotocopy = $(this).find('span:nth-child(17)').text();
			var cliPdfexistence = $(this).find('span:nth-child(18)').text();
			var nameexistence = $(this).find('span:nth-child(19)').text();
			var cliPdflegal = $(this).find('span:nth-child(20)').text();
			var namelegal = $(this).find('span:nth-child(21)').text();
			$('input[name=cliId_juridica_Edit]').val(cliId);
			$('input[name=cliNamereason_juridica_Edit]').val(cliNamereason);
			$('input[name=cliNumberdocument_juridica_Edit]').val(cliNumberdocument);
			$('input[name=cliNamerepresentative_juridica_Edit]').val(cliNamerepresentative);
			$('input[name=cliNumberrepresentative_juridica_Edit]').val(cliNumberrepresentative);
			$('select[name=cliDepartment_juridica_Edit]').val(depId);

			$.get("{{ route('getMunicipalities') }}",{depId: depId},function(objectMunicipalities){
				var count = Object.keys(objectMunicipalities).length;
				if(count > 0){
					for (var i = 0; i < count; i++) {
						if(objectMunicipalities[i]['munId'] == cliMunicipality_id){
							municipalitySelected = objectMunicipalities[i]['munId'];
							$('select[name=cliMunicipality_id_juridica_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}else{
							$('select[name=cliMunicipality_id_juridica_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
							
					}
				}
			});

			$('input[name=cliAddress_juridica_Edit]').val(cliAddress);
			$('input[name=cliPhone_juridica_Edit]').val(cliPhone);
			$('input[name=cliMovil_juridica_Edit]').val(cliMovil);
			$('input[name=cliWhatsapp_juridica_Edit]').val(cliWhatsapp);
			$('input[name=cliEmail_juridica_Edit]').val(cliEmail);

			if(cliPdfrut != 'N/A'){
				$('.rutnot_juridica_Edit').css('display','inline-block');
				$('a.namerut_juridica_now_Edit').css('display','inline-block');
				$('a.namerut_juridica_now_Edit').attr('href',cliPdfrut);
				$('a.namerut_juridica_now_Edit').text(namerut);
			}else{
				$('.rutnot_juridica_Edit').css('display','none');
				$('a.namerut_juridica_now_Edit').css('display','none');
			}
			if(cliPdfphotocopy != 'N/A'){
				$('.copynot_juridica_Edit').css('display','inline-block');
				$('a.namecopy_juridica_now_Edit').css('display','inline-block');
				$('a.namecopy_juridica_now_Edit').attr('href',cliPdfphotocopy);
				$('a.namecopy_juridica_now_Edit').text(namephotocopy);
			}else{
				$('.copynot_juridica_Edit').css('display','none');
				$('a.namecopy_juridica_now_Edit').css('display','none');
			}
			if(cliPdfexistence != 'N/A'){
				$('.existencenot_juridica_Edit').css('display','inline-block');
				$('a.nameexistence_juridica_now_Edit').css('display','inline-block');
				$('a.nameexistence_juridica_now_Edit').attr('href',cliPdfexistence);
				$('a.nameexistence_juridica_now_Edit').text(nameexistence);
			}else{
				$('.existencenot_juridica_Edit').css('display','none');
				$('a.nameexistence_juridica_now_Edit').css('display','none');
			}
			if(cliPdflegal != 'N/A'){
				$('.legalnot_juridica_Edit').css('display','inline-block');
				$('a.namelegal_juridica_now_Edit').css('display','inline-block');
				$('a.namelegal_juridica_now_Edit').attr('href',cliPdflegal);
				$('a.namelegal_juridica_now_Edit').text(namelegal);
			}else{
				$('.legalnot_juridica_Edit').css('display','none');
				$('a.namelegal_juridica_now_Edit').css('display','none');
			}
			$('#editClientjuridica-modal').modal();
		});

		$('select[name=cliDepartment_juridica_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('select[name=cliMunicipality_id_juridica_Edit]').empty();
			$('select[name=cliMunicipality_id_juridica_Edit]').append("<option value=''>Seleccione ...</option>");
			if(selected != ''){
				$.get("{{ route('getMunicipalities') }}",{depId: selected},function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=cliMunicipality_id_juridica_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + objectMunicipalities[i]['munName'] + "</option>"
							);
						}
					}
				});
			}
		});

		$('.deleteClientjuridica-link').on('click',function(e){
			e.preventDefault();
			var cliId = $(this).find('span:nth-child(2)').text();
			var cliNamereason = $(this).find('span:nth-child(3)').text();
			var cliNumberdocument = $(this).find('span:nth-child(4)').text();
			var cliNamerepresentative = $(this).find('span:nth-child(5)').text();
			var cliNumberrepresentative = $(this).find('span:nth-child(6)').text();
			var cliMunicipality_id = $(this).find('span:nth-child(7)').text();
			var cliAddress = $(this).find('span:nth-child(8)').text();
			var cliPhone = $(this).find('span:nth-child(9)').text();
			var cliMovil = $(this).find('span:nth-child(10)').text();
			var cliWhatsapp = $(this).find('span:nth-child(11)').text();
			var cliEmail = $(this).find('span:nth-child(12)').text();
			var cliPdfrut = $(this).find('span:nth-child(13)').text();
			var namerut = $(this).find('span:nth-child(14)').text();
			var cliPdfphotocopy = $(this).find('span:nth-child(15)').text();
			var namephotocopy = $(this).find('span:nth-child(16)').text();
			var cliPdfexistence = $(this).find('span:nth-child(17)').text();
			var nameexistence = $(this).find('span:nth-child(18)').text();
			var cliPdflegal = $(this).find('span:nth-child(19)').text();
			var namelegal = $(this).find('span:nth-child(20)').text();
			$('input[name=cliId_juridica_Delete]').val(cliId);
			$('.cliNamereason_juridica_Delete').text(cliNamereason);
			$('.cliNumberdocument_juridica_Delete').text(cliNumberdocument);
			$('.cliNamerepresentative_juridica_Delete').text(cliNamerepresentative);
			$('.cliNumberrepresentative_juridica_Delete').text(cliNumberrepresentative);
			$('.cliMunicipality_id_juridica_Delete').text(cliMunicipality_id);
			$('.cliAddress_juridica_Delete').text(cliAddress);
			$('.cliPhone_juridica_Delete').text(cliPhone);
			$('.cliMovil_juridica_Delete').text(cliMovil);
			$('.cliWhatsapp_juridica_Delete').text(cliWhatsapp);
			$('.cliEmail_juridica_Delete').text(cliEmail);

			if(cliPdfrut != 'N/A'){
				$('a.cliPdfrut_juridica_Delete').css('display','inline-block');
				$('a.cliPdfrut_juridica_Delete').attr('href',cliPdfrut);
				$('a.cliPdfrut_juridica_Delete').text(namerut);
			}else{
				$('a.cliPdfrut_juridica_Delete').css('display','none');
				$('a.cliPdfrut_juridica_Delete').attr('href','#');
				$('a.cliPdfrut_juridica_Delete').text('');
			}
			if(cliPdfphotocopy != 'N/A'){
				$('a.cliPdfphotocopy_juridica_Delete').css('display','inline-block');
				$('a.cliPdfphotocopy_juridica_Delete').attr('href',cliPdfphotocopy);
				$('a.cliPdfphotocopy_juridica_Delete').text(namephotocopy);
			}else{
				$('a.cliPdfphotocopy_juridica_Delete').css('display','none');
				$('a.cliPdfphotocopy_juridica_Delete').attr('href','#');
				$('a.cliPdfphotocopy_juridica_Delete').text('');
			}
			if(cliPdfexistence != 'N/A'){
				$('a.cliPdfexistence_juridica_Delete').css('display','inline-block');
				$('a.cliPdfexistence_juridica_Delete').attr('href',cliPdfexistence);
				$('a.cliPdfexistence_juridica_Delete').text(nameexistence);
			}else{
				$('a.cliPdfexistence_juridica_Delete').css('display','none');
				$('a.cliPdfexistence_juridica_Delete').attr('href','#');
				$('a.cliPdfexistence_juridica_Delete').text('');
			}
			if(cliPdflegal != 'N/A'){
				$('a.cliPdflegal_juridica_Delete').css('display','inline-block');
				$('a.cliPdflegal_juridica_Delete').attr('href',cliPdflegal);
				$('a.cliPdflegal_juridica_Delete').text(namelegal);
			}else{
				$('a.cliPdflegal_juridica_Delete').css('display','none');
				$('a.cliPdflegal_juridica_Delete').attr('href','#');
				$('a.cliPdflegal_juridica_Delete').text('');
			}
			$('#deleteClientjuridica-modal').modal();
		});
	</script>
@endsection