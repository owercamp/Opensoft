@extends('modules.logisticCollaborators')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h6>NOTIFICACIONES</h6>
			</div>
			<div class="col-md-2">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newNotification-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
				@if(session('SuccessNotification'))
				    <div class="alert alert-success">
				        {{ session('SuccessNotification') }}
				    </div>
				@endif
				@if(session('PrimaryNotification'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryNotification') }}
				    </div>
				@endif
				@if(session('WarningNotification'))
				    <div class="alert alert-warning">
				        {{ session('WarningNotification') }}
				    </div>
				@endif
				@if(session('SecondaryNotification'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryNotification') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>FECHA</th>
					<th>COLABORADOR</th>
					<th>CODIGO DE REGISTRO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($notifications as $notification)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $notification->ncoDate }}</td>
					<td>{{ $notification->bill->collaborator->coNames }}</td>
					<td>{{ $notification->ncoDocumentcode }}</td>
					<td class="d-flex justofy-content-center">
						<a href="#" title="EDITAR" class="bj-btn-table-edit form-control-sm editNotification-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $notification->ncoId }}</span>
							<span hidden>{{ $notification->bill->collaborator->coNames }}</span>
							<span hidden>{{ $notification->bill->collaborator->type->perName }}</span>
							<span hidden>{{ $notification->bill->collaborator->coNumberdocument }}</span>
							<span hidden>{{ $notification->bill->collaborator->coPosition }}</span>
							<span hidden>{{ $notification->ncoDocumentcode }}</span>
							<span hidden>{{ $notification->bill->collaborator->coAddress }}</span>
							<span hidden>{{ $notification->bill->collaborator->coBloodtype }}</span>
							<span hidden>{{ $notification->bill->collaborator->coEmail }}</span>
							<span hidden>{{ $notification->bill->collaborator->coMovil }}</span>
							<span hidden>{{ $notification->bill->collaborator->coWhatsapp }}</span>
							<span hidden>{{ $notification->ncoNotification }}</span>
							<span hidden>{{ $notification->ncoDate }}</span>
							<img src="{{ asset('storage/collaboratorsPhotos/'.$notification->bill->collaborator->coPhoto) }}" hidden>
							@if($notification->bill->collaborator->coFirm !== null)
								<img src="{{ asset('storage/collaboratorsFirms/'.$notification->bill->collaborator->coFirm) }}" hidden>
							@else
								<img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
							@endif
						</a>
						<a href="#" title="ELIMINAR" class="bj-btn-table-delete form-control-sm deleteNotification-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $notification->ncoId }}</span>
							<span hidden>{{ $notification->bill->collaborator->coNames }}</span>
							<span hidden>{{ $notification->bill->collaborator->type->perName }}</span>
							<span hidden>{{ $notification->bill->collaborator->coNumberdocument }}</span>
							<span hidden>{{ $notification->bill->collaborator->coPosition }}</span>
							<span hidden>{{ $notification->ncoDocumentcode }}</span>
							<span hidden>{{ $notification->bill->collaborator->coAddress }}</span>
							<span hidden>{{ $notification->bill->collaborator->coBloodtype }}</span>
							<span hidden>{{ $notification->bill->collaborator->coEmail }}</span>
							<span hidden>{{ $notification->bill->collaborator->coMovil }}</span>
							<span hidden>{{ $notification->bill->collaborator->coWhatsapp }}</span>
							<span hidden>{{ $notification->ncoNotification }}</span>
							<span hidden>{{ $notification->ncoDate }}</span>
							<img src="{{ asset('storage/collaboratorsPhotos/'.$notification->bill->collaborator->coPhoto) }}" hidden>
							@if($notification->bill->collaborator->coFirm !== null)
								<img src="{{ asset('storage/collaboratorsFirms/'.$notification->bill->collaborator->coFirm) }}" hidden>
							@else
								<img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
							@endif
						</a>
						<form action="{{ route('collaborators.notification.pdf') }}" method="GET" style="display: inline-block;">
							@csrf
							<input type="hidden" name="ncoId" value="{{ $notification->ncoId }}" class="form-control form-control-sm" required>
							<button type="submit" title="DESCARGAR PDF" class="bj-btn-table-pdf form-control-sm">
								<i class="fas fa-file-pdf"></i>
							</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newNotification-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO REGISTRO DE NOTIFICACIONES:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.notification.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="ncoDocument_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="dolVersion" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">CONTRATO COLABORADOR:</small>
											<select name="ncoLegalization_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($legalizations as $legalization)
													<option value="{{ $legalization->bcoId }}"
														data-names='{{ $legalization->coNames }}'
														data-type='{{ $legalization->perName }}'
														data-document='{{ $legalization->coNumberdocument }}'
														data-position='{{ $legalization->coPosition }}'
														data-photo='{{ $legalization->coPhoto }}'
														data-firm='{{ $legalization->coFirm }}'
														data-address='{{ $legalization->coAddress }}'
														data-bloodtype='{{ $legalization->coBloodtype }}'
														data-email='{{ $legalization->coEmail }}'
														data-movil='{{ $legalization->coMovil }}'
														data-whatsapp='{{ $legalization->coWhatsapp }}'>
														{{ $legalization->coNames }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="ncoDate" class="form-control form-control-sm text-center datepicker" required>
										</div>
									</div>
								</div>
								<div class="row border m-3 p-3">
									<div class="col-md-6 text-center">
										<span class="coPosition"></span><br>
										<img src="" class="img img-thumbnail coPhotonow" style="width: 150px; height: auto;" hidden><br>
										<input type="hidden" name="route_hidden_photo" value="{{ asset('storage/collaboratorsPhotos') }}" class="form-control form-control-sm" disabled>
										<span class="coNames"></span><br>
										<span class="coNumberdocument"></span><br>
										<img src="" class="img img-thumbnail coFirmnow" style="width: 150px; height: auto;" hidden><br>
										<input type="hidden" name="route_hidden_firm" value="{{ asset('storage/collaboratorsFirms') }}" class="form-control form-control-sm" disabled>
										<span class="text-muted">DIRECCION</span><br>
										<span class="coAddress"></span><br>
										<span class="text-muted">GRUPO SANGUINEO</span><br>
										<span class="coBloodtype"></span><br>
										<span class="text-muted">CORREO ELECTRONICO</span><br>
										<span class="coEmail"></span><br>
										<span class="text-muted">LINEA DE CELULAR</span><br>
										<span class="coMovil"></span><br>
										<span class="text-muted">NUMERO DE WHATSAPP</span><br>
										<span class="coWhatsapp"></span><br>
									</div>
									<div class="col-md-6">
										<small class="text-muted">ACTA DE ENTREGA DE EQUIPOS Y HERRAMIENTAS: </small><br>
										<textarea name="ncoNotification" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="20" required></textarea>
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

	<div class="modal fade" id="editNotification-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>MODIFICACION DE NOTIFICACIONES:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('collaborators.notification.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">	
								<div class="row border m-3 p-3">
									<div class="col-md-6 text-center">
										<span class="coPosition_Edit"></span><br>
										<img src="" class="img img-thumbnail coPhotonow_Edit" style="width: 150px; height: auto;" hidden><br>
										<input type="hidden" name="route_hidden_photo_Edit" value="{{ asset('storage/collaboratorsPhotos') }}" class="form-control form-control-sm" disabled>
										<span class="coNames_Edit"></span><br>
										<span class="coNumberdocument_Edit"></span><br>
										<img src="" class="img img-thumbnail coFirmnow_Edit" style="width: 150px; height: auto;" hidden><br>
										<input type="hidden" name="route_hidden_firm_Edit" value="{{ asset('storage/collaboratorsFirms') }}" class="form-control form-control-sm" disabled>
										<span class="text-muted">CODIGO DE NOTIFICACION</span><br>
										<span class="ncoDocumentcode_Edit"></span><br>
										<span class="text-muted">DIRECCION</span><br>
										<span class="coAddress_Edit"></span><br>
										<span class="text-muted">GRUPO SANGUINEO</span><br>
										<span class="coBloodtype_Edit"></span><br>
										<span class="text-muted">CORREO ELECTRONICO</span><br>
										<span class="coEmail_Edit"></span><br>
										<span class="text-muted">LINEA DE CELULAR</span><br>
										<span class="coMovil_Edit"></span><br>
										<span class="text-muted">NUMERO DE WHATSAPP</span><br>
										<span class="coWhatsapp_Edit"></span><br>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="ncoDate_Edit" class="form-control form-control-sm text-center datepicker" required>
										</div>
										<div class="form-group">
											<small class="text-muted">ACTA DE ENTREGA DE EQUIPOS Y HERRAMIENTAS: </small><br>
											<textarea name="ncoNotification_Edit" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="20" required></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="coNames_Edit" class="form-control form-control-sm" required>
							<input type="hidden" name="ncoId_Edit" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteNotification-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE NOTIFICACIONES:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 text-center">
							<span class="coPosition_Delete"></span><br>
							<img src="" class="img img-thumbnail coPhotonow_Delete" style="width: 150px; height: auto;" hidden><br>
							<span class="coNames_Delete"></span><br>
							<span class="coNumberdocument_Delete"></span><br>
							<img src="" class="img img-thumbnail coFirmnow_Delete" style="width: 150px; height: auto;" hidden><br>
							<span class="coAddress_Delete"></span><br>
							<span class="coBloodtype_Delete"></span><br>
							<span class="coEmail_Delete"></span><br>
							<span class="coMovil_Delete"></span><br>
							<span class="coWhatsapp_Delete"></span><br>
						</div>
						<div class="col-md-6 text-center pt-3">
							<small class="text-muted">FECHA DE ENTREGA: </small><br>
							<span class="text-muted"><b class="ncoDate_Delete"></b></span><br>
							<small class="text-muted">ACTA DE ENTREGA DE EQUIPOS Y HERRAMIENTAS: </small><br>
							<span class="text-muted"><b class="ncoNotification_Delete"></b></span><br>
						</div>
					</div>
					<form action="{{ route('collaborators.notification.delete') }}" method="POST">
						@csrf
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="coNames_Delete" class="form-control form-control-sm" required>
							<input type="hidden" name="ncoId_Delete" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-delete form-control-sm">ELIMINAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});

		$('.newNotification-link').on('click',function(e){
			e.preventDefault();
			$('#newNotification-modal').modal();
		});

		$('select[name=ncoDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolCode]').val('');
			$('input[name=dolVersion]').val('');
			if(selected != ''){
				var code = $('select[name=ncoDocument_id] option:selected').attr('data-code');
				var version = $('select[name=ncoDocument_id] option:selected').attr('data-version');
				$('input[name=dolVersion]').val(version);
				$.get("{{ route('getNextcodeForNotification') }}",{dolId: selected},function(objectsNext){
					if(objectsNext != null){
						$('input[name=dolCode]').val(objectsNext);
					}else{
						$('input[name=dolCode]').val('');
					}
				});
			}
		});

		$('select[name=ncoLegalization_id]').on('change