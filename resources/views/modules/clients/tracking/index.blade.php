@extends('modules.comercialPotentialclient')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h5>SEGUIMIENTO COMERCIAL</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessBidding'))
				    <div class="alert alert-success">
				        {{ session('SuccessBidding') }}
				    </div>
				@endif
				@if(session('PrimaryBidding'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryBidding') }}
				    </div>
				@endif
				@if(session('WarningBidding'))
				    <div class="alert alert-warning">
				        {{ session('WarningBidding') }}
				    </div>
				@endif
				@if(session('SecondaryBidding'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryBidding') }}
				    </div>
				@endif
				@if(session('SuccessProposal'))
				    <div class="alert alert-success">
				        {{ session('SuccessProposal') }}
				    </div>
				@endif
				@if(session('PrimaryProposal'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryProposal') }}
				    </div>
				@endif
				@if(session('WarningProposal'))
				    <div class="alert alert-warning">
				        {{ session('WarningProposal') }}
				    </div>
				@endif
				@if(session('SecondaryProposal'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryProposal') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>TIPO DE COTIZACION</th>
					<th>N° COTIZACION</th>
					<th>CLIENTE/ENTIDAD</th>
					<th>CIUDAD</th>
					<th>MODALIDAD</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0; $i < count($dates); $i++)
					<tr>
						@if($dates[$i][0] == 'Licitación')
							<td><h4><span class="badge badge-dark">{{ $dates[$i][0] }}</span></h4></td>
							<td>{{ $dates[$i][1] }}</td>
							<td>{{ $dates[$i][6] }}</td>
							<td>{{ $dates[$i][7] }}</td>
							<td>{{ $dates[$i][8] }}</td>
							<td>
								<a href="#" title="Bitacora de seguimiento" class="bj-btn-table-edit form-control-sm binnacleBidding-link">
									<i class="fas fa-eye"></i>
									<span hidden>{{ $dates[$i][2] }}</span>
									<span hidden>{{ $dates[$i][3] }}</span>
									<span hidden>{{ $dates[$i][4] }}</span>
									<span hidden>{{ $dates[$i][5] }}</span>
									<span hidden>{{ $dates[$i][6] }}</span>
									<span hidden>{{ $dates[$i][7] }}</span>
									<span hidden>{{ $dates[$i][8] }}</span>
									<span hidden>{{ $dates[$i][9] }}</span>
									<span hidden>{{ $dates[$i][10] }}</span>
									<span hidden>{{ $dates[$i][11] }}</span>
								</a>
							</td>
						@else
							<td><h4><span class="badge badge-dark">{{ $dates[$i][0] }}</span></h4></td>
							<td>{{ $dates[$i][1] }}</td>
							<td>{{ $dates[$i][4] }}</td>
							<td>{{ $dates[$i][7] }}</td>
							<td>{{ $dates[$i][8] }}</td>
							<td>
								<a href="#" title="Bitacora de seguimiento" class="bj-btn-table-edit form-control-sm binnacleProposal-link">
									<i class="fas fa-eye"></i>
									<span hidden>{{ $dates[$i][2] }}</span>
									<span hidden>{{ $dates[$i][3] }}</span>
									<span hidden>{{ $dates[$i][4] }}</span>
									<span hidden>{{ $dates[$i][5] }}</span>
									<span hidden>{{ $dates[$i][6] }}</span>
									<span hidden>{{ $dates[$i][7] }}</span>
									<span hidden>{{ $dates[$i][8] }}</span>
									<span hidden>{{ $dates[$i][9] }}</span>
									<span hidden>{{ $dates[$i][10] }}</span>
									<span hidden>{{ $dates[$i][11] }}</span>
									<span hidden>{{ $dates[$i][12] }}</span>
									<span hidden>{{ $dates[$i][13] }}</span>
								</a>
							</td>
						@endif
					</tr>
				@endfor
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="binnacleBidding-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>BITACORA DE SEGUIMIENTO DE LICITACIONES:</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<small class="text-muted">NUMERO DE PROCESO: </small><br>
							<span class="text-muted"><b class="cbiNumberprocess_binnacle"></b></span><br>
							<small class="text-muted">FECHA DE APERTURA: </small><br>
							<span class="text-muted"><b class="cbiDateopen_binnacle"></b></span><br>
							<small class="text-muted">FECHA DE CIERRE: </small><br>
							<span class="text-muted"><b class="cbiDateclose_binnacle"></b></span><br>
							<small class="text-muted">ENTIDAD: </small><br>
							<span class="text-muted"><b class="cbiEntity_binnacle"></b></span><br>
							<small class="text-muted">CIUDAD: </small><br>	
							<span class="text-muted"><b class="munName_binnacle"></b></span><br>
							<small class="text-muted">MODALIDAD DE CONTRATACION: </small><br>
							<span class="text-muted"><b class="cbiModalitycontract_binnacle"></b></span><br>
							<small class="text-muted">CORREO: </small><br>
							<span class="text-muted"><b class="cbiEmail_binnacle"></b></span><br>
							<small class="text-muted">OBJETO DEL CONTRATO: </small><br>
							<span class="text-muted"><b class="cbiObjectcontract_binnacle"></b></span><br>
							<small class="text-muted">OBSERVACION: </small><br>
							<span class="text-muted"><b class="cbiObservation_binnacle"></b></span><br>
						</div>
						<div class="col-md-8 text-center">
							<small class="text-center" style="font-weight: bold;">SEGUIMIENTOS</small>
							<table class="table table-striped text-center tbl-binnacle" style="font-size: 12px;">
								<thead>
									<tr>
										<th>FECHA</th>
										<th>OBSERVACION</th>
									</tr>
								</thead>
								<tbody>
									<!-- dinamics row -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="row py-3 border-top border-bottom">
			      		<div class="col-md-6 text-center" title="Agregar seguimiento">
							<small class="text-muted">
								<input type="radio" name="optionBinnaclebidding" value="AGREGAR" checked>
								Agregar seguimiento
							</small>
						</div>
						<div class="col-md-6 text-center" title="Cambiar estado">
							<small class="text-muted">
								<input type="radio" name="optionBinnaclebidding" value="CAMBIAR">
								Cambiar estado
							</small>
						</div>
				   	</div>
				   	<div class="row my-3">
				   		<div class="col-md-12 addBinnacle">
				   			<form action="{{ route('clients.tracking.save') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="bbDate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">OBSERVACION:</small>
											<input type="text" name="bbObservation" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
										<input type="hidden" name="cbiId_binnacle" class="form-control form-control-sm cbiId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-add form-control-sm my-3">AGREGAR SEGUIMIENTO</button>	
									</div>
								</div>
							</form>
				   		</div>
				   		<div class="col-md-12 changeMarketing" style="display: none;">
				   			<div class="row">
				   				<div class="col-md-6">
				   					<form action="{{ route('clients.bidding.no') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="cbiId_no" class="form-control form-control-sm cbiId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-delete form-control-sm my-3">RECHAZADO</button>
									</form>
				   				</div>
				   				<div class="col-md-6">
				   					<form action="{{ route('clients.bidding.yes') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="cbiId_yes" class="form-control form-control-sm cbiId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-add form-control-sm my-3">ACEPTADO</button>
									</form>
				   				</div>
				   			</div>
				   		</div>
    				</div>
					<!-- <div class="row">
						<div class="col-md-12 text-center">
							<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CERRAR</button>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="binnacleProposal-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>BITACORA DE SEGUIMIENTO DE PROPUESTAS:</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<small class="text-muted">FECHA: </small><br>
							<span class="text-muted"><b class="cprDate_binnacle"></b></span><br>
							<small class="text-muted">CLIENTE: </small><br>
							<span class="text-muted"><b class="cprClient_binnacle"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="cprNumberdocument_binnacle"></b></span><br>
							<small class="text-muted">CIUDAD: </small><br>	
							<span class="text-muted"><b class="cprMunicipility_binnacle"></b></span><br>
							<small class="text-muted">MODALIDAD DE CONTRATACION: </small><br>
							<span class="text-muted"><b class="cprModalitycontract_binnacle"></b></span><br>
							<small class="text-muted">CONTACTO: </small><br>
							<span class="text-muted"><b class="cprContact_binnacle"></b></span><br>
							<small class="text-muted">CORREO: </small><br>
							<span class="text-muted"><b class="cprEmail_binnacle"></b></span><br>
							<small class="text-muted">TELEFONO: </small><br>
							<span class="text-muted"><b class="cprPhone_binnacle"></b></span><br>
							<small class="text-muted">OBSERVACION: </small><br>
							<span class="text-muted"><b class="cprObservation_binnacle"></b></span><br>
						</div>
						<div class="col-md-8 text-center">
							<h3 class="text-center" style="font-weight: bold;">SEGUIMIENTOS</h3>
							<table class="table table-striped text-center tbl-binnacle-proposal" style="font-size: 12px;">
								<thead>
									<tr>
										<th>FECHA</th>
										<th>OBSERVACION</th>
									</tr>
								</thead>
								<tbody>
									<!-- dinamics row -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="row p-3">
						<div class="col-md-12 p-3">
							<h3 class="text-center" style="font-weight: bold;">PORTAFOLIOS INCLUIDOS</h3>
							<table class="table table-striped text-center tbl-briefcase-proposal" style="font-size: 12px;">
								<thead>
									<tr>
										<th>PORTAFOLIO</th>
										<th>TIPO DE SERVICIO</th>
										<th>TIPO DE VEHICULO</th>
										<th>TARIFA BASE</th>
									</tr>
								</thead>
								<tbody>
									<!-- dinamics row -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="row py-3 border-top border-bottom">
			      		<div class="col-md-6 text-center" title="Agregar seguimiento">
							<small class="text-muted">
								<input type="radio" name="optionBinnacleproposal" value="AGREGAR" checked>
								Agregar seguimiento
							</small>
						</div>
						<div class="col-md-6 text-center" title="Cambiar estado">
							<small class="text-muted">
								<input type="radio" name="optionBinnacleproposal" value="CAMBIAR">
								Cambiar estado
							</small>
						</div>
				   	</div>
				   	<div class="row my-3">
				   		<div class="col-md-12 addBinnacleProposal">
				   			<form action="{{ route('clients.tracking.proposal.save') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="bpDate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">OBSERVACION:</small>
											<input type="text" name="bpObservation" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
										<input type="hidden" name="cprId_binnacle" class="form-control form-control-sm cprId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-add form-control-sm my-3">AGREGAR SEGUIMIENTO</button>	
									</div>
								</div>
							</form>
				   		</div>
				   		<div class="col-md-12 changeProposal" style="display: none;">
				   			<div class="row">
				   				<div class="col-md-6">
				   					<form action="{{ route('clients.proposal.no') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="cprId_no" class="form-control form-control-sm cprId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-delete form-control-sm my-3">RECHAZADO</button>
									</form>
				   				</div>
				   				<div class="col-md-6">
				   					<form action="{{ route('clients.proposal.yes') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="cprId_yes" class="form-control form-control-sm cprId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-add form-control-sm my-3">ACEPTADO</button>
									</form>
				   				</div>
				   			</div>
				   		</div>
    				</div>
					<!-- <div class="row">
						<div class="col-md-12 text-center">
							<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CERRAR</button>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});

		$('.binnacleBidding-link').on('click',function(e){
			e.preventDefault();
			var cbiId = $(this).find('span:nth-child(2)').text();
			var cbiNumberprocess = $(this).find('span:nth-child(3)').text();
			var cbiDateopen = $(this).find('span:nth-child(4)').text();
			var cbiDateclose = $(this).find('span:nth-child(5)').text();
			var cbiEntity = $(this).find('span:nth-child(6)').text();
			var munName = $(this).find('span:nth-child(7)').text();
			var cbiModalitycontract = $(this).find('span:nth-child(8)').text();
			var cbiObjectcontract = $(this).find('span:nth-child(9)').text();
			var cbiEmail = $(this).find('span:nth-child(10)').text();
			var cbiObservation = $(this).find('span:nth-child(11)').text();
			$('.tbl-binnacle tbody').empty();
			$.get("{{ route('getBinnaclebiddings') }}",{ cbiId: cbiId },function(objectBinnacles){
				var count = Object.keys(objectBinnacles).length;
				if(count > 0){
					for(var i = 0; i < count; i++){
						$('.tbl-binnacle tbody').append(
							"<tr>" +
								"<td>" + objectBinnacles[i]['bbDate'] + "</td>" +
								"<td>" + objectBinnacles[i]['bbObservation'] + "</td>" +
							"</tr>"
						);
					}
				}
			});
			$('input.cbiId_binnacle').val(cbiId);
			$('.cbiNumberprocess_binnacle').text(cbiNumberprocess);
			$('.cbiDateopen_binnacle').text(cbiDateopen);
			$('.cbiDateclose_binnacle').text(cbiDateclose);
			$('.cbiEntity_binnacle').text(cbiEntity);
			$('.munName_binnacle').text(munName);
			$('.cbiModalitycontract_binnacle').text(cbiModalitycontract);
			$('.cbiObjectcontract_binnacle').text(cbiObjectcontract);
			$('.cbiEmail_binnacle').text(cbiEmail);
			$('.cbiObservation_binnacle').text(cbiObservation);
			var date = new Date();
            var dateCompleted = date.getFullYear() + '-' + ((date.getMonth() +1)<10 ? '0' : '') + (date.getMonth() +1) + '-' + (date.getDate()<10 ? '0' : '') + date.getDate();
			$('input[name=bbDate]').val(dateCompleted);

			$('#binnacleBidding-modal').modal();
		});

		$('input[name=optionBinnaclebidding]').on('click',function(e){
			var value = e.target.value;
			if(value == 'AGREGAR'){
				$('.addBinnacle').css('display','block');
				$('.changeMarketing').css('display','none');
			}else if(value == 'CAMBIAR'){
				$('.addBinnacle').css('display','none');
				$('.changeMarketing').css('display','block');
			}
		});

		$('.binnacleProposal-link').on('click',function(e){
			e.preventDefault();
			var cprId = $(this).find('span:nth-child(2)').text();
			var cprDate = $(this).find('span:nth-child(3)').text();
			var cprClient = $(this).find('span:nth-child(4)').text();
			var cprTypedocument = $(this).find('span:nth-child(5)').text();
			var cprNumberdocument = $(this).find('span:nth-child(6)').text();
			var munName = $(this).find('span:nth-child(7)').text();
			var cprModalitycontract = $(this).find('span:nth-child(8)').text();
			var cprEmail = $(this).find('span:nth-child(9)').text();
			var cprPhone = $(this).find('span:nth-child(10)').text();
			var cprContact = $(this).find('span:nth-child(11)').text();
			var cprObservation = $(this).find('span:nth-child(12)').text();
			var cprBriefcase = $(this).find('span:nth-child(13)').text();

			// Mensajería Express=>2=>2=>N/A=>$1000<=|=>Carga Express=>2=>1=>1=>$28000
			$('.tbl-briefcase-proposal tbody').empty();
			var find = cprBriefcase.indexOf('<=|=>');
			if(find > -1){
				var separated = cprBriefcase.split('<=|=>');
				for (var i = 0; i < separated.length; i++) {
					var separatedItems = separated[i].split('=>');
					switch(separatedItems[0]){
						case 'Mensajería Express':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Mensajería Express</td>" +
												"<td>" + objectService['smService'] + "</td>" +
												"<td>N/A</td>" +
												"<td>" + objectService['bmeValueratebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
						case 'Logística Express':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Logística Express</td>" +
												"<td>" + objectService['slService'] + "</td>" +
												"<td>N/A</td>" +
												"<td>" + objectService['bleValueratebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
						case 'Carga Express':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Carga Express</td>" +
												"<td>" + objectService['scService'] + "</td>" +
												"<td>" + objectService['heaTypology'] + "</td>" +
												"<td>" + objectService['bceValueratebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
						case 'Turismo Pasajeros':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Turismo Pasajeros</td>" +
												"<td>" + objectService['stService'] + "</td>" +
												"<td>" + objectService['espTypology'] + "</td>" +
												"<td>" + objectService['bteValueratebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
						case 'Traslado Urbano':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Traslado Urbano</td>" +
												"<td>" + objectService['strService'] + "</td>" +
												"<td>" + objectService['espTypology'] + "</td>" +
												"<td>" + objectService['btreValueratebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
						case 'Traslado Intermunicipal':
							$.get(
								"{{ route('getServiceproposal') }}",
								{
									type: separatedItems[0],
									briefcase: separatedItems[1],
									service: separatedItems[2]
								},
								function(objectService){
									if(objectService != null){
										$('.tbl-briefcase-proposal tbody').append(
											"<tr>" +
												"<td>Traslado Intermunicipal</td>" +
												"<td>" + objectService['stmService'] + "</td>" +
												"<td>" + objectService['espTypology'] + "</td>" +
												"<td>" + objectService['btriValuebase'] + "</td>" +
											"</tr>"
										);
									}
								}
							);
						break;
					}
				}
			}else{
				var separatedItems = cprBriefcase.split('=>');
				switch(separatedItems[0]){
					case 'Mensajería Express':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Mensajería Express</td>" +
											"<td>" + objectService['smService'] + "</td>" +
											"<td>N/A</td>" +
											"<td>" + objectService['bmeValueratebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
					case 'Logística Express':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Logística Express</td>" +
											"<td>" + objectService['slService'] + "</td>" +
											"<td>N/A</td>" +
											"<td>" + objectService['bleValueratebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
					case 'Carga Express':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Carga Express</td>" +
											"<td>" + objectService['scService'] + "</td>" +
											"<td>" + objectService['heaTypology'] + "</td>" +
											"<td>" + objectService['bceValueratebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
					case 'Turismo Pasajeros':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Turismo Pasajeros</td>" +
											"<td>" + objectService['stService'] + "</td>" +
											"<td>" + objectService['espTypology'] + "</td>" +
											"<td>" + objectService['bteValueratebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
					case 'Traslado Urbano':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Traslado Urbano</td>" +
											"<td>" + objectService['strService'] + "</td>" +
											"<td>" + objectService['espTypology'] + "</td>" +
											"<td>" + objectService['btreValueratebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
					case 'Traslado Intermunicipal':
						$.get(
							"{{ route('getServiceproposal') }}",
							{
								type: separatedItems[0],
								briefcase: separatedItems[1],
								service: separatedItems[2]
							},
							function(objectService){
								if(objectService != null){
									$('.tbl-briefcase-proposal tbody').append(
										"<tr>" +
											"<td>Traslado Intermunicipal</td>" +
											"<td>" + objectService['stmService'] + "</td>" +
											"<td>" + objectService['espTypology'] + "</td>" +
											"<td>" + objectService['btriValuebase'] + "</td>" +
										"</tr>"
									);
								}
							}
						);
					break;
				}
			}
			$('.tbl-binnacle-proposal tbody').empty();
			$.get("{{ route('getBinnacleproposals') }}",{ cprId: cprId },function(objectBinnacles){
				var count = Object.keys(objectBinnacles).length;
				if(count > 0){
					for(var i = 0; i < count; i++){
						$('.tbl-binnacle-proposal tbody').append(
							"<tr>" +
								"<td>" + objectBinnacles[i]['bpDate'] + "</td>" +
								"<td>" + objectBinnacles[i]['bpObservation'] + "</td>" +
							"</tr>"
						);
					}
				}
			});
			$('input.cprId_binnacle').val(cprId);
			$('.cprDate_binnacle').text(cprDate);
			$('.cprClient_binnacle').text(cprClient);
			$('.cprNumberdocument_binnacle').text(cprTypedocument + ' N° ' + cprNumberdocument);
			$('.cprMunicipility_binnacle').text(munName);
			$('.cprModalitycontract_binnacle').text(cprModalitycontract);
			$('.cprEmail_binnacle').text(cprEmail);
			$('.cprPhone_binnacle').text(cprPhone);
			$('.cprContact_binnacle').text(cprContact);
			$('.cprObservation_binnacle').text(cprObservation);
			var date = new Date();
            var dateCompleted = date.getFullYear() + '-' + ((date.getMonth() +1)<10 ? '0' : '') + (date.getMonth() +1) + '-' + (date.getDate()<10 ? '0' : '') + date.getDate();
			$('input[name=bpDate]').val(dateCompleted);

			$('#binnacleProposal-modal').modal();
		});

		$('input[name=optionBinnacleproposal]').on('click',function(e){
			var value = e.target.value;
			if(value == 'AGREGAR'){
				$('.addBinnacleProposal').css('display','block');
				$('.changeProposal').css('display','none');
			}else if(value == 'CAMBIAR'){
				$('.addBinnacleProposal').css('display','none');
				$('.changeProposal').css('display','block');
			}
		});
	</script>
@endsection