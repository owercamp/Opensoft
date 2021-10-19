@extends('modules.comercialMarketing')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h5>SEGUIMIENTO DE NEGOCIO</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessOpportunity'))
				    <div class="alert alert-success">
				        {{ session('SuccessOpportunity') }}
				    </div>
				@endif
				@if(session('PrimaryOpportunity'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryOpportunity') }}
				    </div>
				@endif
				@if(session('WarningOpportunity'))
				    <div class="alert alert-warning">
				        {{ session('WarningOpportunity') }}
				    </div>
				@endif
				@if(session('SecondaryOpportunity'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryOpportunity') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>FECHA</th>
					<th>RAZON SOCIAL</th>
					<th>CIUDAD</th>
					<th>CONTACTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($marketings as $marketing)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $marketing->marDate }}</td>
					<td>{{ $marketing->marReason }}</td>
					<td>{{ $marketing->munName }}</td>
					<td>{{ $marketing->marContact }}</td>
					<td>
						<a href="#" title="Bitacora de seguimiento" class="bj-btn-table-edit form-control-sm binnacleOpportunity-link">
							<i class="fas fa-eye"></i>
							<span hidden>{{ $marketing->marId }}</span>
							<span hidden>{{ $marketing->marDate }}</span>
							<span hidden>{{ $marketing->marReason }}</span>
							<span hidden>{{ $marketing->munName }}</span>
							<span hidden>{{ $marketing->marAddress }}</span>
							<span hidden>{{ $marketing->marContact }}</span>
							<span hidden>{{ $marketing->marPhone }}</span>
							<span hidden>{{ $marketing->marEmail }}</span>
							<span hidden>{{ $marketing->marObservation }}</span>
						</a>
						<!-- <a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $marketing->marId }}</span>
							<span hidden>{{ $marketing->marDate }}</span>
							<span hidden>{{ $marketing->marReason }}</span>
							<span hidden>{{ $marketing->marMunicipility_id }}</span>
							<span hidden>{{ $marketing->marAddress }}</span>
							<span hidden>{{ $marketing->marContact }}</span>
							<span hidden>{{ $marketing->marPhone }}</span>
							<span hidden>{{ $marketing->marEmail }}</span>
							<span hidden>{{ $marketing->marObservation }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteExpress-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $marketing->marId }}</span>
							<span hidden>{{ $marketing->marDate }}</span>
							<span hidden>{{ $marketing->marReason }}</span>
							<span hidden>{{ $marketing->munName }}</span>
							<span hidden>{{ $marketing->marAddress }}</span>
							<span hidden>{{ $marketing->marContact }}</span>
							<span hidden>{{ $marketing->marPhone }}</span>
							<span hidden>{{ $marketing->marEmail }}</span>
							<span hidden>{{ $marketing->marObservation }}</span>
						</a> -->
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="binnacleOpportunity-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>BITACORA DE SEGUIMIENTO:</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        </button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<small class="text-muted">FECHA: </small><br>
							<span class="text-muted"><b class="marDate_binnacle"></b></span><br>
							<small class="text-muted">RAZON SOCIAL: </small><br>
							<span class="text-muted"><b class="marReason_binnacle"></b></span><br>
							<small class="text-muted">CIUDAD: </small><br>	
							<span class="text-muted"><b class="munName_binnacle"></b></span><br>
							<small class="text-muted">DIRECCION: </small><br>
							<span class="text-muted"><b class="marAddress_binnacle"></b></span><br>
							<small class="text-muted">CONTACTO: </small><br>
							<span class="text-muted"><b class="marContact_binnacle"></b></span><br>
							<small class="text-muted">TELEFONO: </small><br>
							<span class="text-muted"><b class="marPhone_binnacle"></b></span><br>
							<small class="text-muted">CORREO ELECTRONICO: </small><br>
							<span class="text-muted"><b class="marEmail_binnacle"></b></span><br>
							<small class="text-muted">OBSERVACION: </small><br>
							<span class="text-muted"><b class="marObservation_binnacle"></b></span><br>
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
								<input type="radio" name="optionForms" value="AGREGAR" checked>
								Agregar seguimiento
							</small>
						</div>
						<div class="col-md-6 text-center" title="Cambiar estado">
							<small class="text-muted">
								<input type="radio" name="optionForms" value="CAMBIAR">
								Cambiar estado
							</small>
						</div>
				   	</div>
				   	<div class="row my-3">
				   		<div class="col-md-12 addBinnacle">
				   			<form action="{{ route('marketing.tracking.save') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">FECHA:</small>
											<input type="text" name="bmDate" class="form-control form-control-sm" readonly required>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">OBSERVACION:</small>
											<input type="text" name="bmObservation" maxlength="100" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center">
										<input type="hidden" name="marId_binnacle" class="form-control form-control-sm marId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-add form-control-sm my-3">AGREGAR SEGUIMIENTO</button>	
									</div>
								</div>
							</form>
				   		</div>
				   		<div class="col-md-12 changeMarketing" style="display: none;">
				   			<div class="row">
				   				<div class="col-md-6">
				   					<form action="{{ route('marketing.opportunity.no') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="marId_no" class="form-control form-control-sm marId_binnacle" readonly required>
										<button type="submit" class="bj-btn-table-delete form-control-sm my-3">RECHAZADO</button>
									</form>
				   				</div>
				   				<div class="col-md-6">
				   					<form action="{{ route('marketing.opportunity.yes') }}" class="text-center" method="POST">
										@csrf
										<input type="hidden" name="marId_yes" class="form-control form-control-sm marId_binnacle" readonly required>
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

		$('.binnacleOpportunity-link').on('click',function(e){
			e.preventDefault();
			var marId = $(this).find('span:nth-child(2)').text();
			var marDate = $(this).find('span:nth-child(3)').text();
			var marReason = $(this).find('span:nth-child(4)').text();
			var munName = $(this).find('span:nth-child(5)').text();
			var marAddress = $(this).find('span:nth-child(6)').text();
			var marContact = $(this).find('span:nth-child(7)').text();
			var marPhone = $(this).find('span:nth-child(8)').text();
			var marEmail = $(this).find('span:nth-child(9)').text();
			var marObservation = $(this).find('span:nth-child(10)').text();
			$('.tbl-binnacle tbody').empty();
			$.get("{{ route('getBinnacles') }}",{ marId: marId },function(objectBinnacles){
				var count = Object.keys(objectBinnacles).length;
				if(count > 0){
					for(var i = 0; i < count; i++){
						$('.tbl-binnacle tbody').append(
							"<tr>" +
								"<td>" + objectBinnacles[i]['bmDate'] + "</td>" +
								"<td>" + objectBinnacles[i]['bmObservation'] + "</td>" +
							"</tr>"
						);
					}
				}
			});
			$('input.marId_binnacle').val(marId);
			$('.marDate_binnacle').text(marDate);
			$('.marReason_binnacle').text(marReason);
			$('.munName_binnacle').text(munName);
			$('.marAddress_binnacle').text(marAddress);
			$('.marContact_binnacle').text(marContact);
			$('.marPhone_binnacle').text(marPhone);
			$('.marEmail_binnacle').text(marEmail);
			$('.marObservation_binnacle').text(marObservation);
			var date = new Date();
            var dateCompleted = date.getFullYear() + '-' + ((date.getMonth() +1)<10 ? '0' : '') + (date.getMonth() +1) + '-' + (date.getDate()<10 ? '0' : '') + date.getDate();
			$('input[name=bmDate]').val(dateCompleted);

			$('#binnacleOpportunity-modal').modal();
		});

		$('input[name=optionForms]').on('click',function(e){
			var value = e.target.value;
			if(value == 'AGREGAR'){
				$('.addBinnacle').css('display','block');
				$('.changeMarketing').css('display','none');
			}else if(value == 'CAMBIAR'){
				$('.addBinnacle').css('display','none');
				$('.changeMarketing').css('display','block');
			}
		});
	</script>
@endsection