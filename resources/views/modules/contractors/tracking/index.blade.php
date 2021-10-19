@extends('modules.logisticContractors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h6>SEGUIMIENTO SEGURIDAD SOCIAL</h6>
			</div>
			<div class="col-md-2">
				<button type="button" title="REGISTRAR" class="bj-btn-table-add form-control-sm newTracking-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
				@if(session('SuccessTracking'))
				    <div class="alert alert-success">
				        {{ session('SuccessTracking') }}
				    </div>
				@endif
				@if(session('PrimaryTracking'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryTracking') }}
				    </div>
				@endif
				@if(session('WarningTracking'))
				    <div class="alert alert-warning">
				        {{ session('WarningTracking') }}
				    </div>
				@endif
				@if(session('SecondaryTracking'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryTracking') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>FECHA</th>
					<th>CONTRATISTA</th>
					<th>CODIGO DE SEGUIMIENTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($trackings as $tracking)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $tracking->tcDate }}</td>
					<td>
						@if($tracking->bill->bcTypecontractor == 'MENSAJERIA')
							{{ $tracking->bill->messenger->cmNames }}
						@elseif($tracking->bill->bcTypecontractor == 'CARGA EXPRESS')
							{{ $tracking->bill->charge->ccNames }}
						@elseif($tracking->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
							{{ $tracking->bill->especial->ceNames }}
						@endif
					</td>
					<td>{{ $tracking->tcDocumentcode }}</td>
					<td class="d-flex justofy-content-center">
						<a href="#" title="EDITAR" class="bj-btn-table-edit form-control-sm editTracking-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $tracking->tcId }}</span>
							<span hidden>{{ $tracking->tcDate }}</span>
							<span hidden>{{ $tracking->tcDocument_id }}</span>
							<span hidden>{{ $tracking->tcDocumentcode }}</span>
							<span hidden>{{ $tracking->document->dolVersion }}</span>
							<span hidden>{{ $tracking->tcPeriodpay }}</span>
							@if($tracking->bill->bcTypecontractor == 'MENSAJERIA')
								<span hidden>{{ $tracking->bill->messenger->cmNames }}</span>
								<span hidden>{{ $tracking->bill->messenger->cmNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsMessengerPhotos/'.$tracking->bill->messenger->cmPhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsMessengerFirms/'.$tracking->bill->messenger->cmFirm) }}" hidden>
							@elseif($tracking->bill->bcTypecontractor == 'CARGA EXPRESS')
								<span hidden>{{ $tracking->bill->charge->ccNames }}</span>
								<span hidden>{{ $tracking->bill->charge->ccNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->charge->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsChargePhotos/'.$tracking->bill->charge->ccPhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsChargeFirms/'.$tracking->bill->charge->ccFirm) }}" hidden>
							@elseif($tracking->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
								<span hidden>{{ $tracking->bill->especial->ceNames }}</span>
								<span hidden>{{ $tracking->bill->especial->ceNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->especial->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsEspecialPhotos/'.$tracking->bill->especial->cePhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsEspecialFirms/'.$tracking->bill->especial->ceFirm) }}" hidden>
							@endif
						</a>
						<a href="#" title="ELIMINAR" class="bj-btn-table-delete form-control-sm deleteTracking-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $tracking->tcId }}</span>
							<span hidden>{{ $tracking->tcDate }}</span>
							<span hidden>{{ $tracking->tcDocument_id }}</span>
							<span hidden>{{ $tracking->tcDocumentcode }}</span>
							<span hidden>{{ $tracking->tcPeriodpay }}</span>
							@if($tracking->bill->bcTypecontractor == 'MENSAJERIA')
								<span hidden>{{ $tracking->bill->messenger->cmNames }}</span>
								<span hidden>{{ $tracking->bill->messenger->cmNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsMessengerPhotos/'.$tracking->bill->messenger->cmPhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsMessengerFirms/'.$tracking->bill->messenger->cmFirm) }}" hidden>
							@elseif($tracking->bill->bcTypecontractor == 'CARGA EXPRESS')
								<span hidden>{{ $tracking->bill->charge->ccNames }}</span>
								<span hidden>{{ $tracking->bill->charge->ccNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->charge->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsChargePhotos/'.$tracking->bill->charge->ccPhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsChargeFirms/'.$tracking->bill->charge->ccFirm) }}" hidden>
							@elseif($tracking->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
								<span hidden>{{ $tracking->bill->especial->ceNames }}</span>
								<span hidden>{{ $tracking->bill->especial->ceNumberdocument }}</span>
								<span hidden>{{ $tracking->bill->especial->neighborhood->neName }}</span>
								<img src="{{ asset('storage/contractorsEspecialPhotos/'.$tracking->bill->especial->cePhoto) }}" hidden>
								<img src="{{ asset('storage/contractorsEspecialFirms/'.$tracking->bill->especial->ceFirm) }}" hidden>
							@endif
						</a>
						<form action="{{ route('contractors.tracking.pdf') }}" method="GET" style="display: inline-block;">
							@csrf
							<input type="hidden" name="tcId" value="{{ $tracking->tcId }}" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="newTracking-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>NUEVO SEGUIMIENTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.tracking.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="tcDate" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="tcDocument_id" class="form-control form-control-sm" required>
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
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONTRATISTA:</small>
											<select name="tcBillcontractor_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@for($i = 0; $i < count($contractors); $i++)
													@if($contractors[$i][1] == 'MENSAJERIA')
														<option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsMessengerPhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsMessengerFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
													@elseif($contractors[$i][1] == 'CARGA EXPRESS')
														<option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsChargePhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsChargeFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
													@elseif($contractors[$i][1] == 'SERVICIO ESPECIAL')
														<option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsEspecialPhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsEspecialFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
													@endif
												@endfor
											</select>
										</div>
									</div>
								</div>
								<div class="row section-contratorSelected" style="display: none;">
									<div class="col-md-6 text-center pt-4">
										<span class="cNames"></span><br>
										<span class="cNumberdocument"></span><br>
										<span class="cCity"></span><br>
										<div class="row border p-4 mt-4">
											<div class="col-md-6">
												<small class="text-muted">FOTO DE PERFIL:</small><br>
												<img src="" class="img img-thumbnail cPhotonow" style="width: 150px; height: auto;" hidden><br>
											</div>
											<div class="col-md-6">
												<small class="text-muted">FIRMA DIGITAL:</small><br>
												<img src="" class="img img-thumbnail cFirmnow" style="width: 150px; height: auto;" hidden><br>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group border-bottom">
											<h6 class="text-muted">PERIODO PAGO:</h6>
										</div>
										<div class="form-group">
											<small class="text-muted">SELECCIONE FECHA:</small>
											<input type="text" name="tcPeriodpay" class="form-control form-control-sm datepicker text-center" placeholder="aaaa-mm-dd" required>	
										</div>
										<div class="form-group">
											<small class="text-muted">AÑO:</small>
											<input type="text" name="tcYear" class="form-control form-control-sm text-center" disabled>	
										</div>
										<div class="form-group">
											<small class="text-muted">MES:</small>
											<input type="text" name="tcMonth" class="form-control form-control-sm text-center" disabled>	
										</div>
										<div class="form-group">
											<small class="text-muted">DIA:</small>
											<input type="text" name="tcDay" class="form-control form-control-sm text-center" disabled>	
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

	<div class="modal fade" id="editTracking-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>MODIFICACION DE SEGUIMIENTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.tracking.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="tcDate_Edit" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="tcDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
												@endforeach
											</select>
											<input type="hidden" name="tcDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<small class="text-muted">CODIGO:</small>
											<input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly required>
											<input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 text-center pt-4">
										<span class="cNames_Edit"></span><br>
										<span class="cNumberdocument_Edit"></span><br>
										<span class="cCity_Edit"></span><br>
										<div class="row border p-4 mt-4">
											<div class="col-md-6">
												<small class="text-muted">FOTO DE PERFIL:</small><br>
												<img src="" class="img img-thumbnail cPhotonow_Edit" style="width: 150px; height: auto;" hidden><br>
											</div>
											<div class="col-md-6">
												<small class="text-muted">FIRMA DIGITAL:</small><br>
												<img src="" class="img img-thumbnail cFirmnow_Edit" style="width: 150px; height: auto;" hidden><br>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group border-bottom">
											<h6 class="text-muted">PERIODO PAGO:</h6>
										</div>
										<div class="form-group">
											<small class="text-muted">SELECCIONE FECHA:</small>
											<input type="text" name="tcPeriodpay_Edit" class="form-control form-control-sm datepicker text-center" placeholder="aaaa-mm-dd" required>	
										</div>
										<div class="form-group">
											<small class="text-muted">AÑO:</small>
											<input type="text" name="tcYear_Edit" class="form-control form-control-sm text-center" disabled>	
										</div>
										<div class="form-group">
											<small class="text-muted">MES:</small>
											<input type="text" name="tcMonth_Edit" class="form-control form-control-sm text-center" disabled>	
										</div>
										<div class="form-group">
											<small class="text-muted">DIA:</small>
											<input type="text" name="tcDay_Edit" class="form-control form-control-sm text-center" disabled>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="tcId_Edit" class="form-control form-control-sm" required>
							<input type="hidden" name="cNames_Edit" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteTracking-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE SEGUIMIENTO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 border-right text-center pt-4">
							<span class="cNames_Delete"></span><br>
							<span class="cNumberdocument_Delete"></span><br>
							<span class="cCity_Delete"></span><br>
							<div class="row border p-4 mt-4">
								<div class="col-md-6">
									<small class="text-muted">FOTO DE PERFIL:</small><br>
									<img src="" class="img img-thumbnail cPhotonow_Delete" style="width: 150px; height: auto;" hidden><br>
								</div>
								<div class="col-md-6">
									<small class="text-muted">FIRMA DIGITAL:</small><br>
									<img src="" class="img img-thumbnail cFirmnow_Delete" style="width: 150px; height: auto;" hidden><br>
								</div>
							</div>
						</div>
						<div class="col-md-6 border-left text-center pt-4">
							<small class="text-muted">FECHA: </small><br>
							<span class="text-muted"><b class="tcDate_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE SEGUIMIENTO: </small><br>
							<span class="text-muted"><b class="tcDocumentcode_Delete"></b></span><br>
							<hr>
							<small class="text-muted">PERIODO PAGO: </small><br>
							<small class="text-muted">AÑO: </small><br>
							<span class="text-muted"><b class="tcYear_Delete"></b></span><br>
							<small class="text-muted">MES: </small><br>
							<span class="text-muted"><b class="tcMonth_Delete"></b></span><br>
							<small class="text-muted">DIA: </small><br>
							<span class="text-muted"><b class="tcDay_Delete"></b></span><br>
						</div>
					</div>
					<form action="{{ route('contractors.tracking.delete') }}" method="POST">
						@csrf
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="tcId_Delete" class="form-control form-control-sm" required>
							<input type="hidden" name="cNames_Delete" class="form-control form-control-sm" required>
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

		$('.newTracking-link').on('click',function(e){
			e.preventDefault();
			$('#newTracking-modal').modal();
		});

		$('select[name=tcDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion]').val('');
			$('input[name=dolCode]').val('');
			if(selected != ''){
				var version = $('select[name=tcDocument_id] option:selected').attr('data-version');
				var code = $('select[name=tcDocument_id] option:selected').attr('data-code');
				$('input[name=dolVersion]').val(version);
				$.get("{{ route('getNextcodeForTrackingcontractor') }}",{dolId: selected},function(objectsNext){
					if(objectsNext != null){
						$('input[name=dolCode]').val(objectsNext);
					}else{
						$('input[name=dolCode]').val('');
					}
				});
			}
		});

		$('select[name=tcBillcontractor_id]').on('change',function(e){
			var selected = e.target.value;
			$('.cCity').text('');
			$('.cNames').text('');
			$('.cNumberdocument').text('');
			$('img.cPhotonow').attr('src','');
			$('img.cPhotonow').attr("hidden",true);
			$('img.cFirmnow').attr('src','');
			$('img.cFirmnow').attr("hidden",true);
			$('.section-contratorSelected').css('display','none');
			if(selected != ''){
				var names = $('select[name=tcBillcontractor_id] option:selected').attr('data-names');
				var number = $('select[name=tcBillcontractor_id] option:selected').attr('data-document');
				var firm = $('select[name=tcBillcontractor_id] option:selected').attr('data-firm');
				var photo = $('select[name=tcBillcontractor_id] option:selected').attr('data-photo');
				var city = $('select[name=tcBillcontractor_id] option:selected').attr('data-city');
				$('.cNames').text(names);
				$('.cNumberdocument').text(number);
				$('img.cFirmnow').attr("src",firm);
				$('img.cFirmnow').attr("hidden",false);
				$('img.cPhotonow').attr("src",photo);
				$('img.cPhotonow').attr("hidden",false);
				$('.cCity').text(city);
				$('.section-contratorSelected').css('display','flex');
			}
		});

		$('input[name=tcPeriodpay]').on('change',function(e){
			var date = e.target.value;
			$('input[name=tcYear]').val('');
			$('input[name=tcMonth]').val('');
			$('input[name=tcDay]').val('');
			if(date != ''){
				var separated = separatedDate(date);
				$('input[name=tcYear]').val(separated[0]);
				$('input[name=tcMonth]').val(separated[1]);
				$('input[name=tcDay]').val(separated[2]);
			}
		});

		$('.editTracking-link').on('click',function(e){
			e.preventDefault();
			var cPhoto = $(this).find('img:first').attr('src');
			var cFirm = $(this).find('img:last').attr('src');
			var tcId = $(this).find('span:nth-child(2)').text();
			var tcDate = $(this).find('span:nth-child(3)').text();
			var tcDocument_id = $(this).find('span:nth-child(4)').text();
			var tcDocumentcode = $(this).find('span:nth-child(5)').text();
			var dolVersion = $(this).find('span:nth-child(6)').text();
			var tcPeriodpay = $(this).find('span:nth-child(7)').text();
			var namesContractor = $(this).find('span:nth-child(8)').text();
			var documentContractor = $(this).find('span:nth-child(9)').text();
			var cityContractor = $(this).find('span:nth-child(10)').text();
			$('input[name=tcId_Edit]').val(tcId);
			$('input[name=tcDate_Edit]').val(tcDate);
			$('select[name=tcDocument_id_Edit]').val(tcDocument_id);
			$('input[name=tcDocument_id_hidden_Edit]').val(tcDocument_id);
			$('input[name=dolCode_Edit]').val(tcDocumentcode);
			$('input[name=dolVersion_Edit]').val(dolVersion);
			$('input[name=dolCode_hidden_Edit]').val(tcDocumentcode);
			$('.cPhotonow_Edit').attr("src",cPhoto);
			$('.cPhotonow_Edit').attr("hidden",false);
			$('.cFirmnow_Edit').attr("src",cFirm);
			$('.cFirmnow_Edit').attr("hidden",false);
			$('.cNames_Edit').text(namesContractor);
			$('input[name=cNames_Edit]').val(namesContractor);
			$('.cNumberdocument_Edit').text(documentContractor);
			$('.cCity_Edit').text(cityContractor);
			$('input[name=tcPeriodpay_Edit]').val(tcPeriodpay);
			var separated = separatedDate(tcPeriodpay);
			$('input[name=tcYear_Edit]').val(separated[0]);
			$('input[name=tcMonth_Edit]').val(separated[1]);
			$('input[name=tcDay_Edit]').val(separated[2]);
			$('#editTracking-modal').modal();
		});

		$('select[name=tcDocument_id_Edit]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolVersion_Edit]').val('');
			$('input[name=dolCode_Edit]').val('');
			if(selected != ''){
				var version = $('select[name=tcDocument_id_Edit] option:selected').attr('data-version');
				var code = $('select[name=tcDocument_id_Edit] option:selected').attr('data-code');
				var dolId = $('input[name=tcDocument_id_hidden_Edit]').val();
				$('input[name=dolVersion_Edit]').val(version);
				if(selected == dolId){
					$('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
				}else{
					$.get("{{ route('getNextcodeForTrackingcontractor') }}",{dolId: selected},function(objectsNext){
						if(objectsNext != null){
							$('input[name=dolCode_Edit]').val(objectsNext);
						}else{
							$('input[name=dolCode_Edit]').val('');
						}
					});
				}
			}
		});

		$('input[name=tcPeriodpay_Edit]').on('change',function(e){
			var date = e.target.value;
			$('input[name=tcYear_Edit]').val('');
			$('input[name=tcMonth_Edit]').val('');
			$('input[name=tcDay_Edit]').val('');
			if(date != ''){
				var separated = separatedDate(date);
				$('input[name=tcYear_Edit]').val(separated[0]);
				$('input[name=tcMonth_Edit]').val(separated[1]);
				$('input[name=tcDay_Edit]').val(separated[2]);
			}
		});

		$('.deleteTracking-link').on('click',function(e){
			e.preventDefault();
			var cPhoto = $(this).find('img:first').attr('src');
			var cFirm = $(this).find('img:last').attr('src');
			var tcId = $(this).find('span:nth-child(2)').text();
			var tcDate = $(this).find('span:nth-child(3)').text();
			var tcDocument_id = $(this).find('span:nth-child(4)').text();
			var tcDocumentcode = $(this).find('span:nth-child(5)').text();
			var tcPeriodpay = $(this).find('span:nth-child(6)').text();
			var namesContractor = $(this).find('span:nth-child(7)').text();
			var documentContractor = $(this).find('span:nth-child(8)').text();
			var cityContractor = $(this).find('span:nth-child(9)').text();
			$('input[name=tcId_Delete]').val(tcId);
			$('.tcDate_Delete').text(tcDate);
			$('.tcDocumentcode_Delete').text(tcDocumentcode);
			$('.cPhotonow_Delete').attr("src",cPhoto);
			$('.cPhotonow_Delete').attr("hidden",false);
			$('.cFirmnow_Delete').attr("src",cFirm);
			$('.cFirmnow_Delete').attr("hidden",false);
			$('.cNames_Delete').text(namesContractor);
			$('input[name=cNames_Delete]').val(namesContractor);
			$('.cNumberdocument_Delete').text(documentContractor);
			$('.cCity_Delete').text(cityContractor);
			var separated = separatedDate(tcPeriodpay);
			$('.tcYear_Delete').text(separated[0]);
			$('.tcMonth_Delete').text(separated[1]);
			$('.tcDay_Delete').text(separated[2]);
			$('#deleteTracking-modal').modal();
		});

		function separatedDate(date){
			if(date != ''){
				var year = date.substring(0,4);
				var month = date.substring(5,7);
				var day = date.substring(8,10);
				return [year,month,day];
			}
		}
	</script>
@endsection