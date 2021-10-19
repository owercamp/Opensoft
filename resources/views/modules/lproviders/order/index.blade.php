@extends('modules.logisticProviders')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h6>ORDENES DE COMPRA</h6>
			</div>
			<div class="col-md-2">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newOrder-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
				@if(session('SuccessOrder'))
				    <div class="alert alert-success">
				        {{ session('SuccessOrder') }}
				    </div>
				@endif
				@if(session('PrimaryOrder'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryOrder') }}
				    </div>
				@endif
				@if(session('WarningOrder'))
				    <div class="alert alert-warning">
				        {{ session('WarningOrder') }}
				    </div>
				@endif
				@if(session('SecondaryOrder'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryOrder') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%" style="font-size: 12px;">
			<thead>
				<tr>
					<th>#</th>
					<th>FECHA DE CREACION</th>
					<th>PROVEEDOR</th>
					<th>DOCUMENTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($orders as $order)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $order->created_at }}</td>
					<td>{{ $order->bill->provider->proReasonsocial }}</td>
					<td>{{ $order->orpDocumentcode }}</td>
					<td class="d-flex justofy-content-center">
						@if($order->orpStatus == 'ACTIVA')
							<a href="#" title="EDITAR" class="bj-btn-table-edit form-control-sm editOrder-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $order->orpId }}</span>
								<span hidden>{{ $order->bill->provider->proReasonsocial }}</span>
								<span hidden>{{ $order->bill->provider->document->perName }}</span>
								<span hidden>{{ $order->bill->provider->proNumberdocument }}</span>
								<span hidden>{{ $order->orpDocumentcode }}</span>
								<span hidden>{{ $order->bill->provider->proAddress }}</span>
								<span hidden>{{ $order->bill->provider->proPhone }}</span>
								<span hidden>{{ $order->bill->provider->proWhatsapp }}</span>
								<span hidden>{{ $order->orpOrders }}</span>
								<span hidden>{{ $order->orpSubtotal }}</span>
								<span hidden>{{ $order->orpIva }}</span>
								<span hidden>{{ $order->orpTotal }}</span>
							</a>
							<a href="#" title="ANULAR" class="bj-btn-table-delete form-control-sm nullOrder-link">
								<i class="fas fa-times"></i>
								<span hidden>{{ $order->orpId }}</span>
								<span hidden>{{ $order->bill->provider->proReasonsocial }}</span>
								<span hidden>{{ $order->bill->provider->document->perName }}</span>
								<span hidden>{{ $order->bill->provider->proNumberdocument }}</span>
								<span hidden>{{ $order->orpDocumentcode }}</span>
								<span hidden>{{ $order->bill->provider->proAddress }}</span>
								<span hidden>{{ $order->bill->provider->proPhone }}</span>
								<span hidden>{{ $order->bill->provider->proWhatsapp }}</span>
								<span hidden>{{ $order->orpOrders }}</span>
								<span hidden>{{ $order->orpSubtotal }}</span>
								<span hidden>{{ $order->orpIva }}</span>
								<span hidden>{{ $order->orpTotal }}</span>
							</a>
							<a href="#" title="CALIFICACION" class="bj-btn-table-add form-control-sm qualifyOrder-link">
								<i class="fas fa-check-square"></i>
								<span hidden>{{ $order->orpId }}</span>
								<span hidden>{{ $order->bill->provider->proReasonsocial }}</span>
								<span hidden>{{ $order->bill->provider->document->perName }}</span>
								<span hidden>{{ $order->bill->provider->proNumberdocument }}</span>
								<span hidden>{{ $order->orpDocumentcode }}</span>
								<span hidden>{{ $order->bill->provider->proAddress }}</span>
								<span hidden>{{ $order->bill->provider->proPhone }}</span>
								<span hidden>{{ $order->bill->provider->proWhatsapp }}</span>
								<span hidden>{{ $order->orpOrders }}</span>
								<span hidden>{{ $order->orpSubtotal }}</span>
								<span hidden>{{ $order->orpIva }}</span>
								<span hidden>{{ $order->orpTotal }}</span>
								<span hidden>{{ $order->orpNote }}</span>
							</a>
							<form action="{{ route('providers.order.pdf') }}" method="GET" style="display: inline-block;">
								@csrf
								<input type="hidden" name="orpId" value="{{ $order->orpId }}" class="form-control form-control-sm" required>
								<button type="submit" title="DESCARGAR PDF" class="bj-btn-table-pdf form-control-sm">
									<i class="fas fa-file-pdf"></i>
								</button>
							</form>
						@else
							<span class="badge badge-warning">ANULADA</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newOrder-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA ORDEN DE COMPRA:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.order.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<select name="orpDocument_id" class="form-control form-control-sm" required>
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
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">PROVEEDOR:</small>
											<select name="orpBillprovider_id" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@foreach($providers as $provider)
													<option value="{{ $provider->proId }}"
														data-names='{{ $provider->proReasonsocial }}'
														data-document='{{ $provider->proNumberdocument }}'
														data-address='{{ $provider->proAddress }}'
														data-phone='{{ $provider->proPhone }}'
														data-whatsapp='{{ $provider->proWhatsapp }}'>
														{{ $provider->proReasonsocial }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table text-center tbl-newOrder-provider" width="100%">
										<thead>
											<tr>
												<th>RAZON SOCIAL</th>
												<th>DOCUMENTO</th>
												<th>DIRECCION</th>
												<th>TELEFONO</th>
												<th>WHATSAPP</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="tbl-newOrder-reason"></td>
												<td class="tbl-newOrder-document"></td>
												<td class="tbl-newOrder-address"></td>
												<td class="tbl-newOrder-phone"></td>
												<td class="tbl-newOrder-whatsapp"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PRODUCTO/SERVICIO:</small>
											<select name="orpProductservice" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												@for($i = 0; $i < count($proser); $i++)
													<option value='{{ $proser[$i][0] }}'
														data-name='{{ $proser[$i][1] }}'
														data-type='{{ $proser[$i][2] }}'>
														{{ $proser[$i][2] . ' - ' . $proser[$i][1] }}
													</option>
												@endfor
											</select>
										</div>
									</div>
									<div class="col-md-6 pt-3">
										<button type="button" class="bj-btn-table-add form-control-sm btn-add-newOrder">Agregar</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 p-3 text-center">
										<small class="info-tbl-neworder" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<small class="text-muted">PRODUCTOS/SERVICIOS AGREGADOS: </small><br>
										<table class="table text-center tbl-orpOrders-newOrder" width="100%">
											<thead>
												<th>TIPO</th>
												<th>NOMBRE</th>
												<th>Vr UNITARIO</th>
												<th>CANTIDAD</th>
												<th>$ SUBTOTAL</th>
												<th>% IVA</th>
												<th>$ IVA</th>
												<th>$ TOTAL</th>
												<th></th>
											</thead>
											<tbody>
												<!-- Dinamics row -->
												<!-- orpProductservice, type, name, valueUnity, count, subtotal, % iva, $iva, $total -->
											</tbody>
										</table>
										<div class="row">
											<div class="col-md-4">
												<small class="text-muted">SUBTOTAL:</small>
												<input type="text" name="subtotal_from_tbl" class="form-control form-control-sm text-center" readonly required>
											</div>
											<div class="col-md-4">
												<small class="text-muted">COSTO IVA:</small>
												<input type="text" name="precioiva_from_tbl" class="form-control form-control-sm text-center" readonly required>
											</div>
											<div class="col-md-4">
												<small class="text-muted">COSTO TOTAL:</small>
												<input type="text" name="total_from_tbl" class="form-control form-control-sm text-center" readonly required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="allorpOrders" value="" class="form-control form-control-sm" readonly required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-save-newOrder">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editOrder-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>MODIFICACION DE ORDEN DE COMPRA: <b class="orpDocumentcode_Edit" style="margin-left: 10px; padding: 10px; background: blue; color: white; border-radius: 20px;"></b></h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.order.update') }}" method="POST">
						@csrf
						<div class="row">
							<table class="table text-center tbl-editOrder-provider" width="100%" style="font-size: 12px;">
								<thead>
									<tr>
										<th>PROVEEDOR</th>
										<th>DOCUMENTO</th>
										<th>DIRECCION</th>
										<th>TELEFONO</th>
										<th>WHATSAPP</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="tbl-editOrder-reason"></td>
										<td class="tbl-editOrder-document"></td>
										<td class="tbl-editOrder-address"></td>
										<td class="tbl-editOrder-phone"></td>
										<td class="tbl-editOrder-whatsapp"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">PRODUCTO/SERVICIO:</small>
									<select name="orpProductservice_Edit" class="form-control form-control-sm">
										<option value="">Seleccione ...</option>
										@for($i = 0; $i < count($proser); $i++)
											<option value='{{ $proser[$i][0] }}'
												data-name='{{ $proser[$i][1] }}'
												data-type='{{ $proser[$i][2] }}'>
												{{ $proser[$i][2] . ' - ' . $proser[$i][1] }}
											</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-md-6 pt-3">
								<button type="button" class="bj-btn-table-add form-control-sm btn-add-editOrder">Agregar</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 p-3 text-center">
								<small class="info-tbl-editOrder" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<small class="text-muted">PRODUCTOS/SERVICIOS AGREGADOS: </small><br>
								<table class="table text-center tbl-orpOrders-editOrder" width="100%" style="font-size: 12px;">
									<thead>
										<th>TIPO</th>
										<th>NOMBRE</th>
										<th>Vr UNITARIO</th>
										<th>CANTIDAD</th>
										<th>$ SUBTOTAL</th>
										<th>% IVA</th>
										<th>$ IVA</th>
										<th>$ TOTAL</th>
										<th></th>
									</thead>
									<tbody>
										<!-- Dinamics row -->
										<!-- orpProductservice, type, name, valueUnity, count, subtotal, % iva, $iva, $total -->
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-4">
										<small class="text-muted">SUBTOTAL:</small>
										<input type="text" name="subtotal_from_tbl_Edit" class="form-control form-control-sm text-center" readonly required>
									</div>
									<div class="col-md-4">
										<small class="text-muted">COSTO IVA:</small>
										<input type="text" name="precioiva_from_tbl_Edit" class="form-control form-control-sm text-center" readonly required>
									</div>
									<div class="col-md-4">
										<small class="text-muted">COSTO TOTAL:</small>
										<input type="text" name="total_from_tbl_Edit" class="form-control form-control-sm text-center" readonly required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="proReasonsocial_Edit" class="form-control form-control-sm" required>
							<input type="hidden" name="allorpOrders_Edit" class="form-control form-control-sm" required>
							<input type="hidden" name="orpId_Edit" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-add form-control-sm btn-save-editOrder">GUARDAR CAMBIOS</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="nullOrder-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ANULACION DE ORDEN DE COMPRA: <b class="orpDocumentcode_Null" style="margin-left: 10px; padding: 10px; color: white; background: red; border-radius: 20px;"></b></h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<table class="table text-center tbl-nullOrder-provider" width="100%" style="font-size: 12px;">
							<thead>
								<tr>
									<th>PROVEEDOR</th>
									<th>DOCUMENTO</th>
									<th>DIRECCION</th>
									<th>TELEFONO</th>
									<th>WHATSAPP</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="tbl-nullOrder-reason"></td>
									<td class="tbl-nullOrder-document"></td>
									<td class="tbl-nullOrder-address"></td>
									<td class="tbl-nullOrder-phone"></td>
									<td class="tbl-nullOrder-whatsapp"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTOS/SERVICIOS DE LA ORDEN DE COMPRA: </small><br>
							<table class="table text-center tbl-orpOrders-nullOrder" width="100%" style="font-size: 12px;">
								<thead>
									<th>TIPO</th>
									<th>NOMBRE</th>
									<th>Vr UNITARIO</th>
									<th>CANTIDAD</th>
									<th>$ SUBTOTAL</th>
									<th>% IVA</th>
									<th>$ IVA</th>
									<th>$ TOTAL</th>
								</thead>
								<tbody>
									<!-- Dinamics row -->
									<!-- orpProductservice, type, name, valueUnity, count, subtotal, % iva, $iva, $total -->
								</tbody>
							</table>
							<div class="row text-center" style="font-size: 20px;">
								<div class="col-md-4">
									<small class="text-muted">SUBTOTAL:</small>
									<small><b class="subtotal_from_tbl_Null"></b></small>
								</div>
								<div class="col-md-4">
									<small class="text-muted">COSTO IVA:</small>
									<small><b class="precioiva_from_tbl_Null"></b></small>
								</div>
								<div class="col-md-4">
									<small class="text-muted">COSTO TOTAL:</small>
									<small><b class="total_from_tbl_Null"></b></small>
								</div>
							</div>
						</div>
					</div>
					<form action="{{ route('providers.order.cancel') }}" method="POST">
						@csrf
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="proReasonsocial_Null" class="form-control form-control-sm" required>
							<input type="hidden" name="orpId_Null" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-delete form-control-sm">ANULAR ORDEN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="qualifyOrder-modal">
		<div class="modal-dialog modal-lg" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>CALIFICACION DE ORDEN DE COMPRA: <b class="orpDocumentcode_Qualify" style="margin-left: 10px; padding: 10px; color: white; background: green; border-radius: 20px;"></b></h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<table class="table text-center tbl-qualifyOrder-provider" width="100%" style="font-size: 12px;">
							<thead>
								<tr>
									<th>PROVEEDOR</th>
									<th>DOCUMENTO</th>
									<th>DIRECCION</th>
									<th>TELEFONO</th>
									<th>WHATSAPP</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="tbl-qualifyOrder-reason"></td>
									<td class="tbl-qualifyOrder-document"></td>
									<td class="tbl-qualifyOrder-address"></td>
									<td class="tbl-qualifyOrder-phone"></td>
									<td class="tbl-qualifyOrder-whatsapp"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTOS/SERVICIOS DE LA ORDEN DE COMPRA: </small><br>
							<table class="table text-center tbl-orpOrders-qualifyOrder" width="100%" style="font-size: 12px;">
								<thead>
									<th>TIPO</th>
									<th>NOMBRE</th>
									<th>Vr UNITARIO</th>
									<th>CANTIDAD</th>
									<th>$ SUBTOTAL</th>
									<th>% IVA</th>
									<th>$ IVA</th>
									<th>$ TOTAL</th>
								</thead>
								<tbody>
									<!-- Dinamics row -->
									<!-- orpProductservice, type, name, valueUnity, count, subtotal, % iva, $iva, $total -->
								</tbody>
							</table>
							<div class="row text-center" style="font-size: 20px;">
								<div class="col-md-4">
									<small class="text-muted">SUBTOTAL:</small>
									<small><b class="subtotal_from_tbl_Qualify"></b></small>
								</div>
								<div class="col-md-4">
									<small class="text-muted">COSTO IVA:</small>
									<small><b class="precioiva_from_tbl_Qualify"></b></small>
								</div>
								<div class="col-md-4">
									<small class="text-muted">COSTO TOTAL:</small>
									<small><b class="total_from_tbl_Qualify"></b></small>
								</div>
							</div>
						</div>
					</div>
					<form action="{{ route('providers.order.qualify') }}" method="POST">
						@csrf
						<small class="text-muted">CALIFICACION: </small>
						<hr>
						<div class="row">
							<div class="col-md-9">
								<progress class="progressOrder" value="0" min="0" max="100" style="width: 100%;">0%</progress>
							</div>
							<div class="col-md-3">
								<input type="number" name="orpQualify" value="0" placeholder="0 - 100" class="form-control form-control-sm" required>
							</div>
						</div>
						<div class="form-group text-center pt-2 border-top">
							<input type="hidden" name="proReasonsocial_Qualify" class="form-control form-control-sm" required>
							<input type="hidden" name="orpId_Qualify" class="form-control form-control-sm" required>
							<button type="submit" class="bj-btn-table-delete form-control-sm">GUARDAR CALIFICACION</button>
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

		$('.newOrder-link').on('click',function(e){
			e.preventDefault();
			$('#newOrder-modal').modal();
		});

		$('select[name=orpDocument_id]').on('change',function(e){
			var selected = e.target.value;
			$('input[name=dolCode]').val('');
			$('input[name=dolVersion]').val('');
			if(selected != ''){
				var code = $('select[name=orpDocument_id] option:selected').attr('data-code');
				var version = $('select[name=orpDocument_id] option:selected').attr('data-version');
				$('input[name=dolVersion]').val(version);
				$.get("{{ route('getNextcodeForNotificationprovider') }}",{dolId: selected},function(objectsNext){
					if(objectsNext != null){
						$('input[name=dolCode]').val(objectsNext);
					}else{
						$('input[name=dolCode]').val('');
					}
				});
			}
		});

		$('select[name=orpBillprovider_id]').on('change',function(e){
			var selected = e.target.value;
			$('.tbl-newOrder-provider').find('td.tbl-newOrder-reason').text('');
			$('.tbl-newOrder-provider').find('td.tbl-newOrder-document').text('');
			$('.tbl-newOrder-provider').find('td.tbl-newOrder-address').text('');
			$('.tbl-newOrder-provider').find('td.tbl-newOrder-phone').text('');
			$('.tbl-newOrder-provider').find('td.tbl-newOrder-whatsapp').text('');
			if(selected != ''){
				var names = $('select[name=orpBillprovider_id] option:selected').attr('data-names');
				var number = $('select[name=orpBillprovider_id] option:selected').attr('data-document');
				var address = $('select[name=orpBillprovider_id] option:selected').attr('data-address');
				var phone = $('select[name=orpBillprovider_id] option:selected').attr('data-phone');
				var whatsapp = $('select[name=orpBillprovider_id] option:selected').attr('data-whatsapp');
				$('.tbl-newOrder-provider').find('td.tbl-newOrder-reason').text(names);
				$('.tbl-newOrder-provider').find('td.tbl-newOrder-document').text(number);
				$('.tbl-newOrder-provider').find('td.tbl-newOrder-address').text(address);
				$('.tbl-newOrder-provider').find('td.tbl-newOrder-phone').text(phone);
				$('.tbl-newOrder-provider').find('td.tbl-newOrder-whatsapp').text(whatsapp);
			}
		});

		// BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
		$('.btn-add-newOrder').on('click',function(){
			var psId = $('select[name=orpProductservice]').val();
			var t = $('select[name=orpProductservice] option:selected').attr('data-type');
			var n = $('select[name=orpProductservice] option:selected').attr('data-name');
			var validateRepeat = false;
			$('.tbl-orpOrders-newOrder tbody').find('tr').each(function(){
				var id = $(this).attr('class');
				var type = $(this).attr('data-type'); // Product/service/row
				var name = $(this).attr('data-name'); // Product/service/row
				if(psId == id && t == type){
					validateRepeat = true;
				}
			});
			if(psId != '' && n != '' && t != ''){
				if(validateRepeat == false){
					$('.tbl-orpOrders-newOrder tbody').append(
						"<tr class='" + psId + "' data-type='" + t + "' data-name='" + n + "'>" +
							"<td>" + t + "</td>" +
							"<td>" + n + "</td>" +
							// VALOR UNITARIO
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordValueunity' value='0' title='Valor unitario ($)' required>" +
							"</td>" +
							// CANTIDAD
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordCount' value='1' title='Cantidad (n)' required>" +
							"</td>" +
							// SUBTOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordSubtotal' value='0' title='Subtotal ($)' readonly required>" +
							"</td>" +
							// % IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPoriva' value='0' title='Porcentaje Iva (%)' required>" +
							"</td>" +
							// $ IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPreiva' value='0' title='Precio iva ($)' readonly required>" +
							"</td>" +
							// $ TOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordTotal' value='0' title='Precio total ($)' readonly required>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteOrder' value='0' title='Eliminar orden'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
					validateTotal();
				}else{
					$('.info-tbl-neworder').css('display','block');
					$('.info-tbl-neworder').text('Producto/Servicio seleccionado ya está en la tabla');
					setTimeout(function(){
						$('.info-tbl-neworder').css('display','none');
						$('.info-tbl-neworder').text('');
					},3000);
				}
			}else{
				$('.info-tbl-neworder').css('display','block');
				$('.info-tbl-neworder').text('No hay seleccionado ningún Producto/Servicio');
				setTimeout(function(){
					$('.info-tbl-neworder').css('display','none');
					$('.info-tbl-neworder').text('');
				},3000);
			}
		});

		$('.tbl-orpOrders-newOrder').on('click','.btn-deleteOrder',function(){
			$(this).parents('tr').remove();
			validateTotal();
		});

		$('.tbl-orpOrders-newOrder').on('keyup','.ordValueunity',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let count = (row.find('input.ordCount').val() !== '' ? parseInt(row.find('input.ordCount').val()) : 0);
			if(writed > 0 && count > 0){
				row.find('input.ordSubtotal').val(writed * count);
			}
			let priceiva = (row.find('input.ordPoriva').val() !== '' ? parseInt(row.find('input.ordPoriva').val()) : 0);
			let subtotal = (row.find('input.ordSubtotal').val() !== '' ? parseInt(row.find('input.ordSubtotal').val()) : 0);
			if(priceiva > 0 && subtotal > 0){
				let preiva = (priceiva * subtotal) / 100;
				row.find('input.ordPreiva').val(preiva);
				row.find('input.ordTotal').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva').val(0);
				row.find('input.ordTotal').val(subtotal);
			}
			validateTotal();
		});

		$('.tbl-orpOrders-newOrder').on('keyup','.ordCount',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let unity = (row.find('input.ordValueunity').val() !== '' ? parseInt(row.find('input.ordValueunity').val()) : 0);
			if(writed > 0 && unity > 0){
				row.find('input.ordSubtotal').val(unity * writed);
			}
			let priceiva = (row.find('input.ordPoriva').val() !== '' ? parseInt(row.find('input.ordPoriva').val()) : 0);
			let subtotal = (row.find('input.ordSubtotal').val() !== '' ? parseInt(row.find('input.ordSubtotal').val()) : 0);
			if(priceiva > 0 && subtotal > 0){
				let preiva = (priceiva * subtotal) / 100;
				row.find('input.ordPreiva').val(preiva);
				row.find('input.ordTotal').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva').val(0);
				row.find('input.ordTotal').val(subtotal);
			}
			validateTotal();
		});

		$('.tbl-orpOrders-newOrder').on('keyup','.ordPoriva',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let subtotal = (row.find('input.ordSubtotal').val() !== '' ? parseInt(row.find('input.ordSubtotal').val()) : 0);
			if(writed > 0 && subtotal > 0){
				let preiva = (writed * subtotal) / 100;
				row.find('input.ordPreiva').val(preiva);
				row.find('input.ordTotal').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva').val(0);
				row.find('input.ordTotal').val(subtotal);
			}
			validateTotal();
		});

		function validateTotal () {
			let subtotal_Total = 0;
			let precioiva_Total = 0;
			$('.tbl-orpOrders-newOrder tbody').find('tr').each(function(){
				subtotal_Total += ($(this).find('input.ordSubtotal').val() !== '' ? parseInt($(this).find('input.ordSubtotal').val()) : 0);
				precioiva_Total += ($(this).find('input.ordPreiva').val() !== '' ? parseInt($(this).find('input.ordPreiva').val()) : 0);
			});
			let preciototal_Total = subtotal_Total + precioiva_Total;
			$('input[name=subtotal_from_tbl]').val(subtotal_Total);
			$('input[name=precioiva_from_tbl]').val(precioiva_Total);
			$('input[name=total_from_tbl]').val(preciototal_Total);
		}

		$('.btn-save-newOrder').on('click',function(e){
			// e.preventDefault();
			var allOrders = '';
			$('input[name=allorpOrders]').val('');
			$('.tbl-orpOrders-newOrder tbody').find('tr').each(function(){
				var id = $(this).attr('class');
				var type = $(this).attr('data-type');
				var name = $(this).attr('data-name');
				var valueUnity = $(this).find('input.ordValueunity').val();
				var count = $(this).find('input.ordCount').val();
				var subtotal = $(this).find('input.ordSubtotal').val();
				var poriva = $(this).find('input.ordPoriva').val();
				var preiva = $(this).find('input.ordPreiva').val();
				var total = $(this).find('input.ordTotal').val();
				allOrders += id + '!==!' + type + '!==!' + name + '!==!' + valueUnity + '!==!' + count + '!==!' + subtotal + '!==!' + poriva + '!==!' + preiva + '!==!' + total + '!!==!!';
			});
			$('input[name=allorpOrders]').val(allOrders);
			if(allOrders != '' && allOrders != null){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.info-tbl-neworder').css('display','block');
				$('.info-tbl-neworder').text('Seleccione al menos un Producto/Servicio y defina sus valores antes de enviar la información');
				setTimeout(function(){
					$('.info-tbl-neworder').css('display','none');
					$('.info-tbl-neworder').text('');
				},3000);
			}
		});

		$('.editOrder-link').on('click',function(e){
			e.preventDefault();
			var orpId = $(this).find('span:nth-child(2)').text();
			var proReasonsocial = $(this).find('span:nth-child(3)').text();
			var perName = $(this).find('span:nth-child(4)').text();
			var proNumberdocument = $(this).find('span:nth-child(5)').text();
			var documentCode = $(this).find('span:nth-child(6)').text();
			var address = $(this).find('span:nth-child(7)').text();
			var phone = $(this).find('span:nth-child(8)').text();
			var whatsapp = $(this).find('span:nth-child(9)').text();
			var orders = $(this).find('span:nth-child(10)').text();
			var subtotal = $(this).find('span:nth-child(11)').text();
			var iva = $(this).find('span:nth-child(12)').text();
			var total = $(this).find('span:nth-child(13)').text();
			$('input[name=orpId_Edit]').val(orpId);
			$('input[name=proReasonsocial_Edit]').val(proReasonsocial);
			$('.orpDocumentcode_Edit').text(documentCode);
			$('.tbl-editOrder-reason').text(proReasonsocial);
			$('.tbl-editOrder-document').text(proNumberdocument);
			$('.tbl-editOrder-address').text(address);
			$('.tbl-editOrder-phone').text(phone);
			$('.tbl-editOrder-whatsapp').text(whatsapp);
			$('.tbl-orpOrders-editOrder tbody').empty();
			let find = orders.indexOf('!!==!!');
			if(find > -1){
				let separated = orders.split('!!==!!');
				for (var i = 0; i < separated.length; i++) {
					let separatedItems = separated[i].split('!==!');
					$('.tbl-orpOrders-editOrder tbody').append(
						"<tr class='" + separatedItems[0] + "' data-type='" + separatedItems[1] + "' data-name='" + separatedItems[2] + "'>" +
							"<td>" + separatedItems[1] + "</td>" +
							"<td>" + separatedItems[2] + "</td>" +
							// VALOR UNITARIO
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordValueunity_Edit' value='" + separatedItems[3] + "' title='Valor unitario ($)' required>" +
							"</td>" +
							// CANTIDAD
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordCount_Edit' value='" + separatedItems[4] + "' title='Cantidad (n)' required>" +
							"</td>" +
							// SUBTOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordSubtotal_Edit' value='" + separatedItems[5] + "' title='Subtotal ($)' readonly required>" +
							"</td>" +
							// % IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPoriva_Edit' value='" + separatedItems[6] + "' title='Porcentaje Iva (%)' required>" +
							"</td>" +
							// $ IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPreiva_Edit' value='" + separatedItems[7] + "' title='Precio iva ($)' readonly required>" +
							"</td>" +
							// $ TOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordTotal_Edit' value='" + separatedItems[8] + "' title='Precio total ($)' readonly required>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteOrder_Edit' title='Eliminar orden'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
				}
			}else{
				let separatedItems = orders.split('!==!');
				$('.tbl-orpOrders-editOrder tbody').append(
					"<tr class='" + separatedItems[0] + "' data-type='" + separatedItems[1] + "' data-name='" + separatedItems[2] + "'>" +
						"<td>" + separatedItems[1] + "</td>" +
						"<td>" + separatedItems[2] + "</td>" +
						// VALOR UNITARIO
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordValueunity_Edit' value='" + separatedItems[3] + "' title='Valor unitario ($)' required>" +
						"</td>" +
						// CANTIDAD
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordCount_Edit' value='" + separatedItems[4] + "' title='Cantidad (n)' required>" +
						"</td>" +
						// SUBTOTAL
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordSubtotal_Edit' value='" + separatedItems[5] + "' title='Subtotal ($)' readonly required>" +
						"</td>" +
						// % IVA
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPoriva_Edit' value='" + separatedItems[6] + "' title='Porcentaje Iva (%)' required>" +
						"</td>" +
						// $ IVA
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPreiva_Edit' value='" + separatedItems[7] + "' title='Precio iva ($)' readonly required>" +
						"</td>" +
						// $ TOTAL
						"<td>" +
							"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordTotal_Edit' value='" + separatedItems[8] + "' title='Precio total ($)' readonly required>" +
						"</td>" +
						"<td>" +
							"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteOrder_Edit' title='Eliminar orden'><i class='fas fa-trash-alt'></i></button>" +
						"</td>" +
					"</tr>"
				);
			}
			$('input[name=subtotal_from_tbl_Edit]').val(subtotal);
			$('input[name=precioiva_from_tbl_Edit]').val(iva);
			$('input[name=total_from_tbl_Edit]').val(total);
			$('#editOrder-modal').modal();
		});

		// BOTON PARA AGREGAR SERVICIOS A ORDEN DE COMPRA DE MODIFICACION
		$('.btn-add-editOrder').on('click',function(){
			var psId = $('select[name=orpProductservice_Edit]').val();
			var t = $('select[name=orpProductservice_Edit] option:selected').attr('data-type');
			var n = $('select[name=orpProductservice_Edit] option:selected').attr('data-name');
			var validateRepeat = false;
			$('.tbl-orpOrders-editOrder tbody').find('tr').each(function(){
				var id = $(this).attr('class');
				var type = $(this).attr('data-type'); // Product/service/row
				var name = $(this).attr('data-name'); // Product/service/row
				if(psId == id && t == type){
					validateRepeat = true;
				}
			});
			if(psId != '' && n != '' && t != ''){
				if(validateRepeat == false){
					$('.tbl-orpOrders-editOrder tbody').append(
						"<tr class='" + psId + "' data-type='" + t + "' data-name='" + n + "'>" +
							"<td>" + t + "</td>" +
							"<td>" + n + "</td>" +
							// VALOR UNITARIO
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordValueunity_Edit' value='0' title='Valor unitario ($)' required>" +
							"</td>" +
							// CANTIDAD
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordCount_Edit' value='1' title='Cantidad (n)' required>" +
							"</td>" +
							// SUBTOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordSubtotal_Edit' value='0' title='Subtotal ($)' readonly required>" +
							"</td>" +
							// % IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPoriva_Edit' value='0' title='Porcentaje Iva (%)' required>" +
							"</td>" +
							// $ IVA
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordPreiva_Edit' value='0' title='Precio iva ($)' readonly required>" +
							"</td>" +
							// $ TOTAL
							"<td>" +
								"<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center ordTotal_Edit' value='0' title='Precio total ($)' readonly required>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='bj-btn-table-delete form-control-sm btn-deleteOrder_Edit' title='Eliminar orden'><i class='fas fa-trash-alt'></i></button>" +
							"</td>" +
						"</tr>"
					);
					validateTotalEdit();
				}else{
					$('.info-tbl-editOrder').css('display','block');
					$('.info-tbl-editOrder').text('Producto/Servicio seleccionado ya está en la tabla');
					setTimeout(function(){
						$('.info-tbl-editOrder').css('display','none');
						$('.info-tbl-editOrder').text('');
					},3000);
				}
			}else{
				$('.info-tbl-editOrder').css('display','block');
				$('.info-tbl-editOrder').text('No hay seleccionado ningún Producto/Servicio');
				setTimeout(function(){
					$('.info-tbl-editOrder').css('display','none');
					$('.info-tbl-editOrder').text('');
				},3000);
			}
		});

		$('.tbl-orpOrders-editOrder').on('click','.btn-deleteOrder_Edit',function(){
			$(this).parents('tr').remove();
			validateTotalEdit();
		});

		$('.tbl-orpOrders-editOrder').on('keyup','.ordValueunity_Edit',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let count = (row.find('input.ordCount_Edit').val() !== '' ? parseInt(row.find('input.ordCount_Edit').val()) : 0);
			if(writed > 0 && count > 0){
				row.find('input.ordSubtotal_Edit').val(writed * count);
			}
			let priceiva = (row.find('input.ordPoriva_Edit').val() !== '' ? parseInt(row.find('input.ordPoriva_Edit').val()) : 0);
			let subtotal = (row.find('input.ordSubtotal_Edit').val() !== '' ? parseInt(row.find('input.ordSubtotal_Edit').val()) : 0);
			if(priceiva > 0 && subtotal > 0){
				let preiva = (priceiva * subtotal) / 100;
				row.find('input.ordPreiva_Edit').val(preiva);
				row.find('input.ordTotal_Edit').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva_Edit').val(0);
				row.find('input.ordTotal_Edit').val(subtotal);
			}
			validateTotalEdit();
		});

		$('.tbl-orpOrders-editOrder').on('keyup','.ordCount_Edit',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let unity = (row.find('input.ordValueunity_Edit').val() !== '' ? parseInt(row.find('input.ordValueunity_Edit').val()) : 0);
			if(writed > 0 && unity > 0){
				row.find('input.ordSubtotal_Edit').val(unity * writed);
			}
			let priceiva = (row.find('input.ordPoriva_Edit').val() !== '' ? parseInt(row.find('input.ordPoriva_Edit').val()) : 0);
			let subtotal = (row.find('input.ordSubtotal_Edit').val() !== '' ? parseInt(row.find('input.ordSubtotal_Edit').val()) : 0);
			if(priceiva > 0 && subtotal > 0){
				let preiva = (priceiva * subtotal) / 100;
				row.find('input.ordPreiva_Edit').val(preiva);
				row.find('input.ordTotal_Edit').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva_Edit').val(0);
				row.find('input.ordTotal_Edit').val(subtotal);
			}
			validateTotalEdit();
		});

		$('.tbl-orpOrders-editOrder').on('keyup','.ordPoriva_Edit',function(){
			let row = $(this).parents('tr');
			let writed = ($(this).val() !== '' ? parseInt($(this).val()) : 0);
			let subtotal = (row.find('input.ordSubtotal_Edit').val() !== '' ? parseInt(row.find('input.ordSubtotal_Edit').val()) : 0);
			if(writed > 0 && subtotal > 0){
				let preiva = (writed * subtotal) / 100;
				row.find('input.ordPreiva_Edit').val(preiva);
				row.find('input.ordTotal_Edit').val(subtotal + preiva);
			}else{
				row.find('input.ordPreiva_Edit').val(0);
				row.find('input.ordTotal_Edit').val(subtotal);
			}
			validateTotalEdit();
		});

		function validateTotalEdit () {
			let subtotal_Total = 0;
			let precioiva_Total = 0;
			$('.tbl-orpOrders-editOrder tbody').find('tr').each(function(){
				subtotal_Total += ($(this).find('input.ordSubtotal_Edit').val() !== '' ? parseInt($(this).find('input.ordSubtotal_Edit').val()) : 0);
				precioiva_Total += ($(this).find('input.ordPreiva_Edit').val() !== '' ? parseInt($(this).find('input.ordPreiva_Edit').val()) : 0);
			});
			let preciototal_Total = subtotal_Total + precioiva_Total;
			$('input[name=subtotal_from_tbl_Edit]').val(subtotal_Total);
			$('input[name=precioiva_from_tbl_Edit]').val(precioiva_Total);
			$('input[name=total_from_tbl_Edit]').val(preciototal_Total);
		}

		$('.btn-save-editOrder').on('click',function(e){
			// e.preventDefault();
			var allOrders = '';
			$('input[name=allorpOrders_Edit]').val('');
			$('.tbl-orpOrders-editOrder tbody').find('tr').each(function(){
				var id = $(this).attr('class');
				var type = $(this).attr('data-type');
				var name = $(this).attr('data-name');
				var valueUnity = $(this).find('input.ordValueunity_Edit').val();
				var count = $(this).find('input.ordCount_Edit').val();
				var subtotal = $(this).find('input.ordSubtotal_Edit').val();
				var poriva = $(this).find('input.ordPoriva_Edit').val();
				var preiva = $(this).find('input.ordPreiva_Edit').val();
				var total = $(this).find('input.ordTotal_Edit').val();
				allOrders += id + '!==!' + type + '!==!' + name + '!==!' + valueUnity + '!==!' + count + '!==!' + subtotal + '!==!' + poriva + '!==!' + preiva + '!==!' + total + '!!==!!';
			});
			$('input[name=allorpOrders_Edit]').val(allOrders);
			if(allOrders != '' && allOrders != null){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.info-tbl-editOrder').css('display','block');
				$('.info-tbl-editOrder').text('Seleccione al menos un Producto/Servicio y defina sus valores antes de enviar la información');
				setTimeout(function(){
					$('.info-tbl-editOrder').css('display','none');
					$('.info-tbl-editOrder').text('');
				},3000);
			}
		});

		$('.nullOrder-link').on('click',function(e){
			e.preventDefault();
			var orpId = $(this).find('span:nth-child(2)').text();
			var proReasonsocial = $(this).find('span:nth-child(3)').text();
			var perName = $(this).find('span:nth-child(4)').text();
			var proNumberdocument = $(this).find('span:nth-child(5)').text();
			var documentCode = $(this).find('span:nth-child(6)').text();
			var address = $(this).find('span:nth-child(7)').text();
			var phone = $(this).find('span:nth-child(8)').text();
			var whatsapp = $(this).find('span:nth-child(9)').text();
			var orders = $(this).find('span:nth-child(10)').text();
			var subtotal = $(this).find('span:nth-child(11)').text();
			var iva = $(this).find('span:nth-child(12)').text();
			var total = $(this).find('span:nth-child(13)').text();
			$('input[name=orpId_Null]').val(orpId);
			$('input[name=proReasonsocial_Null]').val(proReasonsocial);
			$('.orpDocumentcode_Null').text(documentCode);
			$('.tbl-nullOrder-reason').text(proReasonsocial);
			$('.tbl-nullOrder-document').text(proNumberdocument);
			$('.tbl-nullOrder-address').text(address);
			$('.tbl-nullOrder-phone').text(phone);
			$('.tbl-nullOrder-whatsapp').text(whatsapp);
			$('.tbl-orpOrders-nullOrder tbody').empty();
			let find = orders.indexOf('!!==!!');
			if(find > -1){
				let separated = orders.split('!!==!!');
				for (var i = 0; i < separated.length; i++) {
					let separatedItems = separated[i].split('!==!');
					$('.tbl-orpOrders-nullOrder tbody').append(
						"<tr>" +
							"<td>" + separatedItems[1] + "</td>" +
							"<td>" + separatedItems[2] + "</td>" +
							// VALOR UNITARIO
							"<td>" + separatedItems[3] + "</td>" +
							// CANTIDAD
							"<td>" + separatedItems[4] + "</td>" +
							// SUBTOTAL
							"<td>" + separatedItems[5] + "</td>" +
							// % IVA
							"<td>" + separatedItems[6] + "</td>" +
							// $ IVA
							"<td>" + separatedItems[7] + "</td>" +
							// $ TOTAL
							"<td>" + separatedItems[8] + "</td>" +
						"</tr>"
					);
				}
			}else{
				let separatedItems = orders.split('!==!');
				$('.tbl-orpOrders-nullOrder tbody').append(
					"<tr>" +
						"<td>" + separatedItems[1] + "</td>" +
						"<td>" + separatedItems[2] + "</td>" +
						// VALOR UNITARIO
						"<td>" + separatedItems[3] + "</td>" +
						// CANTIDAD
						"<td>" + separatedItems[4] + "</td>" +
						// SUBTOTAL
						"<td>" + separatedItems[5] + "</td>" +
						// % IVA
						"<td>" + separatedItems[6] + "</td>" +
						// $ IVA
						"<td>" + separatedItems[7] + "</td>" +
						// $ TOTAL
						"<td>" + separatedItems[8] + "</td>" +
					"</tr>"
				);
			}
			$('.subtotal_from_tbl_Null').text('$' + subtotal);
			$('.precioiva_from_tbl_Null').text('$' + iva);
			$('.total_from_tbl_Null').text('$' + total);
			$('#nullOrder-modal').modal();
		});

		$('.qualifyOrder-link').on('click',function(e){
			e.preventDefault();
			var orpId = $(this).find('span:nth-child(2)').text();
			var proReasonsocial = $(this).find('span:nth-child(3)').text();
			var perName = $(this).find('span:nth-child(4)').text();
			var proNumberdocument = $(this).find('span:nth-child(5)').text();
			var documentCode = $(this).find('span:nth-child(6)').text();
			var address = $(this).find('span:nth-child(7)').text();
			var phone = $(this).find('span:nth-child(8)').text();
			var whatsapp = $(this).find('span:nth-child(9)').text();
			var orders = $(this).find('span:nth-child(10)').text();
			var subtotal = $(this).find('span:nth-child(11)').text();
			var iva = $(this).find('span:nth-child(12)').text();
			var total = $(this).find('span:nth-child(13)').text();
			var note = $(this).find('span:nth-child(14)').text();
			$('input[name=orpId_Qualify]').val(orpId);
			$('input[name=proReasonsocial_Qualify]').val(proReasonsocial);
			$('.orpDocumentcode_Qualify').text(documentCode);
			$('.tbl-qualifyOrder-reason').text(proReasonsocial);
			$('.tbl-qualifyOrder-document').text(proNumberdocument);
			$('.tbl-qualifyOrder-address').text(address);
			$('.tbl-qualifyOrder-phone').text(phone);
			$('.tbl-qualifyOrder-whatsapp').text(whatsapp);
			$('.tbl-orpOrders-qualifyOrder tbody').empty();
			let find = orders.indexOf('!!==!!');
			if(find > -1){
				let separated = orders.split('!!==!!');
				for (var i = 0; i < separated.length; i++) {
					let separatedItems = separated[i].split('!==!');
					$('.tbl-orpOrders-qualifyOrder tbody').append(
						"<tr>" +
							"<td>" + separatedItems[1] + "</td>" +
							"<td>" + separatedItems[2] + "</td>" +
							// VALOR UNITARIO
							"<td>" + separatedItems[3] + "</td>" +
							// CANTIDAD
							"<td>" + separatedItems[4] + "</td>" +
							// SUBTOTAL
							"<td>" + separatedItems[5] + "</td>" +
							// % IVA
							"<td>" + separatedItems[6] + "</td>" +
							// $ IVA
							"<td>" + separatedItems[7] + "</td>" +
							// $ TOTAL
							"<td>" + separatedItems[8] + "</td>" +
						"</tr>"
					);
				}
			}else{
				let separatedItems = orders.split('!==!');
				$('.tbl-orpOrders-qualifyOrder tbody').append(
					"<tr>" +
						"<td>" + separatedItems[1] + "</td>" +
						"<td>" + separatedItems[2] + "</td>" +
						// VALOR UNITARIO
						"<td>" + separatedItems[3] + "</td>" +
						// CANTIDAD
						"<td>" + separatedItems[4] + "</td>" +
						// SUBTOTAL
						"<td>" + separatedItems[5] + "</td>" +
						// % IVA
						"<td>" + separatedItems[6] + "</td>" +
						// $ IVA
						"<td>" + separatedItems[7] + "</td>" +
						// $ TOTAL
						"<td>" + separatedItems[8] + "</td>" +
					"</tr>"
				);
			}
			$('.subtotal_from_tbl_Qualify').text('$' + subtotal);
			$('.precioiva_from_tbl_Qualify').text('$' + iva);
			$('.total_from_tbl_Qualify').text('$' + total);
			if(note != null){
				$('input[name=orpQualify]').val(note);
				$('.progressOrder').val(note);
			}else{
				$('input[name=orpQualify]').val(0);
				$('.progressOrder').val(0);
			}
			$('#qualifyOrder-modal').modal();
		});

		$('input[name=orpQualify]').on('change keyup',function(e){
			let value = e.target.value;
			$(this).val(parseInt(value));
			if(value != ''){
				if(value > 100){
					$(this).val(100);
					value = 100;
				}else if(value < 0){
					$(this).val(0);
					value = 0;
				}
				$('.progressOrder').val(value);
			}else{
				$(this).val(0);
				$('.progressOrder').val(0);
			}
		})
	</script>
@endsection
