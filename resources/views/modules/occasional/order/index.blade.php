@extends('modules.comercialOccasionalcontracts')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>ORDEN DE SERVICIO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newOrder-link">NUEVO</button>
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
        <th>CODIGO DOCUMENTO</th>
        <th>CLIENTE</th>
        <th>FECHA DE INICIO</th>
        <th>FECHA DE VENCIMIENTO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($orders as $order)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $order->oroDocumentcode }}</td>
        <td>{{ $order->proposal->cprClient }}</td>
        <td>{{ $order->oroDatestart }}</td>
        <td>{{ $order->oroDateend }}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editOrder-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $order->oroId }}</span>
            <span hidden>{{ $order->oroDocument_id }}</span>
            <span hidden>{{ $order->oroDocumentcode }}</span>
            <span hidden>{{ $order->document->docVersion }}</span>
            <span hidden>{{ $order->oroDatestart }}</span>
            <span hidden>{{ $order->oroDateend }}</span>
            <span hidden>{{ $order->oroConfigdocument_id }}</span>
            <span hidden>{{ $order->oroContentfinal }}</span>
            <span hidden>{{ $order->oroAllproposal }}</span>
            <span hidden>{{ $order->oroWrited }}</span>
            <span hidden>{{ $order->oroState }}</span>
            <span hidden>{{ $order->oroStatus }}</span>
            <span hidden>{{ $order->proposal->cprClient }}</span>
            <span hidden>{{ $order->proposal->cprNumberdocument }}</span>
            <span hidden>{{ $order->proposal->cprEmail }}</span>
            <span hidden>{{ $order->proposal->cprContact }}</span>
            <span hidden>{{ $order->proposal->cprPhone }}</span>
            <span hidden>{{ $order->proposal->municipality->munName }}</span>
          </a>
          <a href="#" title="ANULAR" class="btn btn-outline-tertiary rounded-circle form-control-sm cancelOrder-link">
            <i class="fas fa-times"></i>
            <span hidden>{{ $order->oroId }}</span>
            <span hidden>{{ $order->document->docName }}</span>
            <span hidden>{{ $order->oroDocumentcode }}</span>
            <span hidden>{{ $order->document->docVersion }}</span>
            <span hidden>{{ $order->oroDatestart }}</span>
            <span hidden>{{ $order->oroDateend }}</span>
            <span hidden>{{ $order->oroContentfinal }}</span>
            <span hidden>{{ $order->oroAllproposal }}</span>
            <span hidden>{{ $order->proposal->cprClient }}</span>
            <span hidden>{{ $order->proposal->cprNumberdocument }}</span>
            <span hidden>{{ $order->proposal->cprEmail }}</span>
            <span hidden>{{ $order->proposal->cprContact }}</span>
            <span hidden>{{ $order->proposal->cprPhone }}</span>
            <span hidden>{{ $order->proposal->municipality->munName }}</span>
          </a>
          <a href="#" title="APROBAR" class="btn btn-outline-success rounded-circle form-control-sm aprovedOrder-link">
            <i class="fas fa-check-square"></i>
            <span hidden>{{ $order->oroId }}</span>
            <span hidden>{{ $order->document->docName }}</span>
            <span hidden>{{ $order->oroDocumentcode }}</span>
            <span hidden>{{ $order->document->docVersion }}</span>
            <span hidden>{{ $order->oroDatestart }}</span>
            <span hidden>{{ $order->oroDateend }}</span>
            <span hidden>{{ $order->oroContentfinal }}</span>
            <span hidden>{{ $order->oroAllproposal }}</span>
            <span hidden>{{ $order->proposal->cprClient }}</span>
            <span hidden>{{ $order->proposal->cprNumberdocument }}</span>
            <span hidden>{{ $order->proposal->cprEmail }}</span>
            <span hidden>{{ $order->proposal->cprContact }}</span>
            <span hidden>{{ $order->proposal->cprPhone }}</span>
            <span hidden>{{ $order->proposal->municipality->munName }}</span>
          </a>
          <form action="{{ route('occasional.order.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="oroId" value="{{ $order->oroId }}" class="form-control form-control-sm" required>
            <input type="hidden" name="clientPdf" value="{{ $order->proposal->cprClient }}" class="form-control form-control-sm" required>
            <button type="submit" title="DESCARGAR PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
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
        <h6>NUEVA ORDEN DE SERVICIO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('occasional.order.save') }}" method="POST" autocomplete="off">
          @csrf
          <div class="row p-3">
            <div class="col-md-12">
              <!-- Documento -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="oroDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">
                        {{ $document->docName }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="docVersion" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="docCode" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
              </div>
              <!-- Fechas -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE INICIO:</small>
                    <input type="text" name="oroDatestart" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE VENCIMIENTO:</small>
                    <input type="text" name="oroDateend" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
              </div>
              <!-- Cliente -->
              <div class="row m-3 pb-3 border-bottom">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CLIENTE:</small>
                    <select name="oroClientproposal_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($clients as $client)
                      <option value="{{ $client->cprId }}" data-client="{{ $client->cprClient }}" data-document="{{ $client->cprNumberdocument }}" data-mail="{{ $client->cprEmail }}" data-contact="{{ $client->cprContact }}" data-phone="{{ $client->cprPhone }}" data-city="{{ $client->municipality->munName }}" data-briefcases="{{ $client->cprBriefcase }}">
                        {{ $client->cprClient }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <small class="text-muted">IDENTIFICACION DE CLIENTE: </small>
                  <b class="documentClient-save"></b><br>
                  <small class="text-muted">CORREO ELECTRONICO: </small>
                  <b class="mailClient-save"></b><br>
                  <small class="text-muted">PERSONA CONTACTO: </small>
                  <b class="contactClient-save"></b><br>
                  <small class="text-muted">TELEFONO/CELULAR: </small>
                  <b class="phoneClient-save"></b><br>
                  <small class="text-muted">CIUDAD: </small>
                  <b class="cityClient-save"></b><br>
                </div>
              </div>
              <!-- producto/servicio -->
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="form-group select_proposal" style="display: none;">
											<small class="text-muted" style="color: red;">El cliente seleccionado tiene mas de una cotización/propuesta aprobada, seleccione una:</small>
											<select name="countProposal" class="form-control form-control-sm" disabled>
												<option value="">Seleccione ...</option>
												Aqui se llena el select con las propuestas aprobadas de acuerdo al cliente seleccionado
											</select>
										</div> -->
                  <table class="table table-hover text-center tbl-proposalsOrder-save" width="100%" style="margin-bottom: 100px;">
                    <thead>
                      <tr>
                        <th>PORTAFOLIO</th>
                        <th>TIPO DE SERVICIO</th>
                        <th>TIPO DE VEHICULO</th>
                        <th>TARIFA BASE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--
													tr dinámicos con los portafolios relacionados con la propuesta del cliente seleccionado con formato:
													typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase<=|=>typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase
												-->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Content final -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTENIDOS:</small>
                        <select name="oroConfigdocument_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                        </select>
                        <input type="hidden" name="oroTemplate" class="form-control form-control-sm" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-12 p-2 border text-justify oroContentfinal" style="font-size: 12px;">

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="oroAllproposal" class="form-control form-control-sm" required>
            <input type="hidden" name="oroVariables" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
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
        <h6>MODIFICACION DE ORDEN DE SERVICIO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('occasional.order.update') }}" method="POST">
          @csrf
          <div class="row p-3">
            <div class="col-md-12">
              <!-- Documento -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="oroDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">
                        {{ $document->docName }}
                      </option>
                      @endforeach
                    </select>
                    <input type="hidden" name="oroDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="docVersion_Edit" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="docCode_Edit" class="form-control form-control-sm text-center" readonly>
                    <input type="hidden" name="docCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <!-- Fechas -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE INICIO:</small>
                    <input type="text" name="oroDatestart_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE VENCIMIENTO:</small>
                    <input type="text" name="oroDateend_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
              </div>
              <!-- Cliente -->
              <div class="row m-3 pb-3 border-bottom">
                <div class="col-md-12 px-4">
                  <b class="text-muted">DATOS DE CLIENTE: </b><b class="nameClient-update"></b>
                  <hr>
                  <small class="text-muted">IDENTIFICACION DE CLIENTE: </small>
                  <b class="documentClient-update"></b><br>
                  <small class="text-muted">CORREO ELECTRONICO: </small>
                  <b class="mailClient-update"></b><br>
                  <small class="text-muted">PERSONA CONTACTO: </small>
                  <b class="contactClient-update"></b><br>
                  <small class="text-muted">TELEFONO/CELULAR: </small>
                  <b class="phoneClient-update"></b><br>
                  <small class="text-muted">CIUDAD: </small>
                  <b class="cityClient-update"></b><br>
                </div>
              </div>
              <!-- producto/servicio -->
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover text-center tbl-proposalsOrder-update" width="100%" style="margin-bottom: 100px;">
                    <thead>
                      <tr>
                        <th>PORTAFOLIO</th>
                        <th>TIPO DE SERVICIO</th>
                        <th>TIPO DE VEHICULO</th>
                        <th>TARIFA BASE</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!--
													tr dinámicos con los portafolios relacionados con la propuesta del cliente seleccionado con formato:
													typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase<=|=>typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase
												-->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Content final -->
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTENIDOS:</small>
                        <select name="oroConfigdocument_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                        </select>
                        <input type="hidden" name="oroTemplate_Edit" class="form-control form-control-sm" readonly required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-12 p-2 border text-justify oroContentfinal_Edit" style="font-size: 12px;">

                            </div>
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
              <input type="hidden" name="oroAllproposal_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" name="oroVariables_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" name="oroId_Edit" class="form-control form-control-sm" readonly required>
              <button type="submit" class="btn btn-outline-primary form-control-sm my-3 btn-updateDefinitive">GUARDAR CAMBIOS</button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cancelOrder-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ANULACION DE ORDEN DE SERVICIO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <b class="text-muted">DATOS DE ORDEN: </b>
            <hr>
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small>
            <b class="docName-cancel"></b><br>
            <small class="text-muted">VERSION DE DOCUMENTO: </small>
            <b class="docVersion-cancel"></b><br>
            <small class="text-muted">CODIGO DOCUMENTO: </small>
            <b class="docCode-cancel"></b><br>
            <small class="text-muted">FECHA DE INICIO: </small>
            <b class="oroDatestart-cancel"></b><br>
            <small class="text-muted">FECHA DE VENCIMIENTO: </small>
            <b class="oroDateend-cancel"></b><br>
          </div>
          <div class="col-md-6">
            <b class="text-muted">DATOS DE CLIENTE: </b>
            <hr>
            <small class="text-muted">NOMBRE DE CLIENTE: </small>
            <b class="nameClient-cancel"></b><br>
            <small class="text-muted">IDENTIFICACION DE CLIENTE: </small>
            <b class="documentClient-cancel"></b><br>
            <small class="text-muted">CORREO ELECTRONICO: </small>
            <b class="mailClient-cancel"></b><br>
            <small class="text-muted">PERSONA CONTACTO: </small>
            <b class="contactClient-cancel"></b><br>
            <small class="text-muted">TELEFONO/CELULAR: </small>
            <b class="phoneClient-cancel"></b><br>
            <small class="text-muted">CIUDAD: </small>
            <b class="cityClient-cancel"></b><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <b class="text-muted">PRODUCTOS/SERVICIOS RELACIONADOS: </b>
            <hr>
            <table class="table table-hover text-center tbl-proposalsOrder-cancel" width="100%">
              <thead>
                <tr>
                  <th>PORTAFOLIO</th>
                  <th>TIPO DE SERVICIO</th>
                  <th>TIPO DE VEHICULO</th>
                  <th>TARIFA BASE</th>
                </tr>
              </thead>
              <tbody>
                <!--
										tr dinámicos con los portafolios relacionados con la propuesta del cliente seleccionado con formato:
										typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase<=|=>typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase
									-->
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-justify">
            <b class="text-muted">CONTENIDO: </b>
            <hr>
            <small class="contentOrder-cancel" style="text-align: justify;"></small><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('occasional.order.cancel') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="oroId_Cancel" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="nameClient_Cancel" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">ANULAR</button>
          </form>
          <div class="col-md-6">
            <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="aprovedOrder-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>APROBACION DE ORDEN DE SERVICIO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <b class="text-muted">DATOS DE ORDEN: </b>
            <hr>
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small>
            <b class="docName-aproved"></b><br>
            <small class="text-muted">VERSION DE DOCUMENTO: </small>
            <b class="docVersion-aproved"></b><br>
            <small class="text-muted">CODIGO DOCUMENTO: </small>
            <b class="docCode-aproved"></b><br>
            <small class="text-muted">FECHA DE INICIO: </small>
            <b class="oroDatestart-aproved"></b><br>
            <small class="text-muted">FECHA DE VENCIMIENTO: </small>
            <b class="oroDateend-aproved"></b><br>
          </div>
          <div class="col-md-6">
            <b class="text-muted">DATOS DE CLIENTE: </b>
            <hr>
            <small class="text-muted">NOMBRE DE CLIENTE: </small>
            <b class="nameClient-aproved"></b><br>
            <small class="text-muted">IDENTIFICACION DE CLIENTE: </small>
            <b class="documentClient-aproved"></b><br>
            <small class="text-muted">CORREO ELECTRONICO: </small>
            <b class="mailClient-aproved"></b><br>
            <small class="text-muted">PERSONA CONTACTO: </small>
            <b class="contactClient-aproved"></b><br>
            <small class="text-muted">TELEFONO/CELULAR: </small>
            <b class="phoneClient-aproved"></b><br>
            <small class="text-muted">CIUDAD: </small>
            <b class="cityClient-aproved"></b><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <b class="text-muted">PRODUCTOS/SERVICIOS RELACIONADOS: </b>
            <hr>
            <table class="table table-hover text-center tbl-proposalsOrder-aproved" width="100%">
              <thead>
                <tr>
                  <th>PORTAFOLIO</th>
                  <th>TIPO DE SERVICIO</th>
                  <th>TIPO DE VEHICULO</th>
                  <th>TARIFA BASE</th>
                </tr>
              </thead>
              <tbody>
                <!--
										tr dinámicos con los portafolios relacionados con la propuesta del cliente seleccionado con formato:
										typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase<=|=>typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase
									-->
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-justify">
            <b class="text-muted">CONTENIDO: </b>
            <hr>
            <small class="contentOrder-aproved" style="text-align: justify;"></small><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('occasional.order.aproved') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="oroId_Aproved" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="nameClient_Aproved" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">APROBAR</button>
          </form>
          <div class="col-md-6">
            <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });

  $('select[name=oroClientproposal_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.documentClient-save').text('');
    $('.mailClient-save').text('');
    $('.contactClient-save').text('');
    $('.phoneClient-save').text('');
    $('.cityClient-save').text('');
    $('input[name=oroAllproposal]').val('');
    $('.tbl-proposalsOrder-save tbody').empty();
    $('.tbl-proposalsOrder-save').css('margin-bottom', '100px');
    if (selected != '') {
      var doc = $('select[name=oroClientproposal_id] option:selected').attr('data-document');
      var mail = $('select[name=oroClientproposal_id] option:selected').attr('data-mail');
      var contact = $('select[name=oroClientproposal_id] option:selected').attr('data-contact');
      var phone = $('select[name=oroClientproposal_id] option:selected').attr('data-phone');
      var city = $('select[name=oroClientproposal_id] option:selected').attr('data-city');
      var briefcases = $('select[name=oroClientproposal_id] option:selected').attr('data-briefcases');
      $('.documentClient-save').text(doc);
      $('.mailClient-save').text(mail);
      $('.contactClient-save').text(contact);
      $('.phoneClient-save').text(phone);
      $('.cityClient-save').text(city);
      // Consultar los productos/servicios de la propuesta seleccionada
      $.get("{{ route('getProposalFromOrderservice') }}", {
        briefcases: briefcases
      }, function(object) {
        var count = Object.keys(object).length;
        if (count > 0) {
          let allproposal = '';
          for (var i = 0; i < count; i++) {
            // FORMATO DE CADENA DE ALLPROPOSAL:
            // id_briefcase===>type_briefcase===>id_service===>name_service===>vehicle===>value
            allproposal += object[i][0] + '===>' + object[i][1] + '===>' + object[i][2] + '===>' + object[i][3] + '===>' + object[i][4] + '===>' + object[i][5] + '<=|=>';
            $('.tbl-proposalsOrder-save tbody').append(
              "<tr class='" + object[i][0] + "' data-typeBriefcase='" + object[i][1] + "' data-idBriefcase='" + object[i][0] + "' data-idService='" + object[i][2] + "'>" +
              "<td>" + object[i][1] + "</td>" +
              "<td>" + object[i][3] + "</td>" +
              "<td>" + object[i][4] + "</td>" +
              "<td>" +
              "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center valueOrder' value='" + object[i][5] + "' title='Tarifa base ($)' required>" +
              "</td>" +
              "</tr>"
            );
          }
          $('.tbl-proposalsOrder-save').css('margin-bottom', '5px');
          $('input[name=oroAllproposal]').val(allproposal);
        } else {
          $('.tbl-proposalsOrder-save tbody').append(
            "<tr>" +
            "<td colspan='4' style='text-aling:center; color: red; font-weight: bold;'>No hay propuestas aprobadas para el cliente selecionado</td>" +
            "</tr>"
          );
        }
      });
    }
  });

  $('select[name=oroDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=docVersion]').val('');
    $('input[name=docCode]').val('');
    $('input[name=oroVariables]').val('');
    $('select[name=oroConfigdocument_id]').empty();
    $('select[name=oroConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.oroContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=oroDocument_id] option:selected').attr('data-version');
      var code = $('select[name=oroDocument_id] option:selected').attr('data-code');
      $('input[name=docVersion]').val(version);
      $.get("{{ route('getNextcodeForOrderoccasional') }}", {
        docId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=docCode]').val(objectsNext);
        } else {
          $('input[name=docCode]').val('');
        }
      });
      $.get("{{ route('getContentFromDocumentComercial') }}", {
        docId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdoContent'].length > 100) {
              var chain = objectsConfig[i]['cdoContent'].substring(0, 100) + ' ...';
              $('select[name=oroConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=oroConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=oroConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=oroVariables]').val('');
    $('input[name=oroTemplate]').val('');
    $('div.oroContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=oroConfigdocument_id] option:selected').attr('data-content');
      $('input[name=oroTemplate]').val(content);
      $('div.oroContentfinal').append(showContent(content));
    }
  });

  $('div.oroContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=oroVariables]').val('');
    $('div.oroContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=oroVariables]').val(all);
  });

  $('.tbl-proposalsOrder-save').on('change keyup', 'input.valueOrder', function() {
    let allproposal = '';
    $('input[name=oroAllproposal]').val('');
    $('.tbl-proposalsOrder-update tbody tr').each(function() {
      let id_briefcase = $(this).attr('class');
      let type_briefcase = $(this).attr('data-typeBriefcase');
      let id_service = $(this).attr('data-idService');
      let name_service = $(this).find('td:nth-child(2)').text();
      let vehicle = $(this).find('td:nth-child(3)').text();
      let value = $(this).find('td:nth-child(4)').find('input.valueOrder').val();
      // id_briefcase===>type_briefcase===>id_service===>name_service===>vehicle===>value
      allproposal += id_briefcase +
        '===>' + type_briefcase +
        '===>' + id_service +
        '===>' + name_service +
        '===>' + vehicle +
        '===>' + value +
        '<=|=>';
    });
    $('input[name=oroAllproposal]').val(allproposal);
  });

  $('.newOrder-link').on('click', function() {
    $('#newOrder-modal').modal();
  });

  $('select[name=oroDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=docVersion_Edit]').val('');
    $('input[name=docCode_Edit]').val('');
    $('input[name=oroVariables_Edit]').val('');
    $('select[name=oroConfigdocument_id_Edit]').empty();
    $('select[name=oroConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.oroContentfinal_Edit').empty();
    if (selected != '') {
      var version = $('select[name=oroDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=oroDocument_id_Edit] option:selected').attr('data-code');
      var docId = $('input[name=oroDocument_id_hidden_Edit]').val();
      $('input[name=docVersion_Edit]').val(version);
      if (selected == docId) {
        $('input[name=docCode_Edit]').val($('input[name=docCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForOrderoccasional') }}", {
          docId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=docCode_Edit]').val(objectsNext);
          } else {
            $('input[name=docCode_Edit]').val('');
          }
        });
      }
      $.get("{{ route('getContentFromDocumentComercial') }}", {
        docId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdoContent'].length > 50) {
              var chain = objectsConfig[i]['cdoContent'].substring(0, 50) + ' ...';
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=oroConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=oroVariables_Edit]').val('');
    $('input[name=oroTemplate_Edit]').val('');
    $('div.oroContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=oroConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=oroTemplate_Edit]').val(content);
      $('div.oroContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.oroContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=oroVariables_Edit]').val('');
    $('div.oroContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=oroVariables_Edit]').val(all);
  });

  $('.tbl-proposalsOrder-update').on('change keyup', 'input.valueOrder', function() {
    let allproposal = '';
    $('input[name=oroAllproposal_Edit]').val('');
    $('.tbl-proposalsOrder-update tbody tr').each(function() {
      let id_briefcase = $(this).attr('class');
      let type_briefcase = $(this).attr('data-typeBriefcase');
      let id_service = $(this).attr('data-idService');
      let name_service = $(this).find('td:nth-child(2)').text();
      let vehicle = $(this).find('td:nth-child(3)').text();
      let value = $(this).find('td:nth-child(4)').find('input.valueOrder').val();
      // id_briefcase===>type_briefcase===>id_service===>name_service===>vehicle===>value
      allproposal += id_briefcase +
        '===>' + type_briefcase +
        '===>' + id_service +
        '===>' + name_service +
        '===>' + vehicle +
        '===>' + value +
        '<=|=>';
    });
    $('input[name=oroAllproposal_Edit]').val(allproposal);
  });

  $('.editOrder-link').on('click', function(e) {
    e.preventDefault();
    var oroId = $(this).find('span:nth-child(2)').text();
    var oroDocument_id = $(this).find('span:nth-child(3)').text();
    var docCode = $(this).find('span:nth-child(4)').text();
    var docVersion = $(this).find('span:nth-child(5)').text();
    var oroDatestart = $(this).find('span:nth-child(6)').text();
    var oroDateend = $(this).find('span:nth-child(7)').text();
    var oroConfigdocument_id = $(this).find('span:nth-child(8)').text();
    var oroContentfinal = $(this).find('span:nth-child(9)').text();
    var oroAllproposal = $(this).find('span:nth-child(10)').text();
    var oroWrited = $(this).find('span:nth-child(11)').text();
    var oroState = $(this).find('span:nth-child(12)').text();
    var oroStatus = $(this).find('span:nth-child(13)').text();
    var client = $(this).find('span:nth-child(14)').text();
    var doc = $(this).find('span:nth-child(15)').text();
    var mail = $(this).find('span:nth-child(16)').text();
    var contact = $(this).find('span:nth-child(17)').text();
    var phone = $(this).find('span:nth-child(18)').text();
    var city = $(this).find('span:nth-child(19)').text();
    $('input[name=oroId_Edit]').val(oroId);
    $('input[name=oroAllproposal_Edit]').val(oroAllproposal + '<=|=>');
    $('input[name=oroVariables_Edit]').val(oroWrited + '!!==¡¡');
    $('.nameClient-update').text(client);
    $('.documentClient-update').text(doc);
    $('.mailClient-update').text(mail);
    $('.contactClient-update').text(contact);
    $('.phoneClient-update').text(phone);
    $('.cityClient-update').text(city);
    $('select[name=oroDocument_id_Edit]').val(oroDocument_id);
    $('input[name=oroDocument_id_hidden_Edit]').val(oroDocument_id);
    $('input[name=docCode_Edit]').val(docCode);
    $('input[name=docCode_hidden_Edit]').val(docCode)
    $('input[name=docVersion_Edit]').val(docVersion);
    $('input[name=oroDatestart_Edit]').val(oroDatestart);
    $('input[name=oroDateend_Edit]').val(oroDateend);
    $('.tbl-proposalsOrder-update tbody').empty();
    let find = oroAllproposal.indexOf('<=|=>');
    if (find > -1) {
      // id_briefcase===>type_briefcase===>id_service===>name_service===>vehicle===>value<=|=>
      var separatedProposals = oroAllproposal.split('<=|=>');
      for (var i = 0; i < separatedProposals.length; i++) {
        var separated = separatedProposals[i].split('===>');
        $('.tbl-proposalsOrder-update tbody').append(
          "<tr class='" + separated[0] + "' data-typeBriefcase='" + separated[1] + "' data-idBriefcase='" + separated[0] + "' data-idService='" + separated[2] + "'>" +
          "<td>" + separated[1] + "</td>" +
          "<td>" + separated[3] + "</td>" +
          "<td>" + separated[4] + "</td>" +
          "<td>" +
          "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center valueOrder' value='" + separated[5] + "' title='Tarifa base ($)' required>" +
          "</td>" +
          "</tr>"
        );
      }
    } else {
      var separated = oroAllproposal.split('===>');
      $('.tbl-proposalsOrder-update tbody').append(
        "<tr class='" + separated[0] + "' data-typeBriefcase='" + separated[1] + "' data-idBriefcase='" + separated[0] + "' data-idService='" + separated[2] + "'>" +
        "<td>" + separated[1] + "</td>" +
        "<td>" + separated[3] + "</td>" +
        "<td>" + separated[4] + "</td>" +
        "<td>" +
        "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center valueOrder' value='" + separated[5] + "' title='Tarifa base ($)' required>" +
        "</td>" +
        "</tr>"
      );
    }
    $('.tbl-proposalsOrder-update').css('margin-bottom', '5px');
    $('select[name=oroConfigdocument_id_Edit]').empty();
    $('select[name=oroConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $.get("{{ route('getContentFromDocumentComercial') }}", {
      docId: oroDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdoContent'].length > 100) {
            var chain = objectsConfig[i]['cdoContent'].substring(0, 100) + ' ...';
            if (oroConfigdocument_id == objectsConfig[i]['cdoId']) {
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=oroTemplate_Edit]').val(objectsConfig[i]['cdoContent']);
              $('div.oroContentfinal_Edit').html(showContent(objectsConfig[i]['cdoContent']));
            } else {
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (oroConfigdocument_id == objectsConfig[i]['cdoId']) {
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "' selected>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
              $('input[name=oroTemplate_Edit]').val(objectsConfig[i]['cdoContent']);
              $('div.oroContentfinal_Edit').html(showContent(objectsConfig[i]['cdoContent']));
            } else {
              $('select[name=oroConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = oroWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.oroContentfinal_Edit > .field-dinamic').each(function() {
            var value = $(this).val();
            if (value == '') {
              $(this).val(item[0]);
              return false;
            }
          });
        }
        $('#editOrder-modal').modal();
      }
    });
    $('#editOrder-modal').modal();
  });

  $('.cancelOrder-link').on('click', function(e) {
    e.preventDefault();
    var oroId = $(this).find('span:nth-child(2)').text();
    var docName = $(this).find('span:nth-child(3)').text();
    var docCode = $(this).find('span:nth-child(4)').text();
    var docVersion = $(this).find('span:nth-child(5)').text();
    var oroDatestart = $(this).find('span:nth-child(6)').text();
    var oroDateend = $(this).find('span:nth-child(7)').text();
    var oroContentfinal = $(this).find('span:nth-child(8)').text();
    var oroAllproposal = $(this).find('span:nth-child(9)').text();
    var client = $(this).find('span:nth-child(10)').text();
    var doc = $(this).find('span:nth-child(11)').text();
    var mail = $(this).find('span:nth-child(12)').text();
    var contact = $(this).find('span:nth-child(13)').text();
    var phone = $(this).find('span:nth-child(14)').text();
    var city = $(this).find('span:nth-child(15)').text();

    // ID DE ORDEN
    $('input[name=oroId_Cancel]').val(oroId);
    $('input[name=nameClient_Cancel]').val(client);

    // DATOS DE ORDEN
    $('.docName-cancel').text(docName);
    $('.docVersion-cancel').text(docVersion);
    $('.docCode-cancel').text(docCode);
    $('.oroDatestart-cancel').text(oroDatestart);
    $('.oroDateend-cancel').text(oroDateend);

    // DATOS DE CLIENTE
    $('.nameClient-cancel').text(client);
    $('.documentClient-cancel').text(doc);
    $('.mailClient-cancel').text(mail);
    $('.contactClient-cancel').text(contact);
    $('.phoneClient-cancel').text(phone);
    $('.cityClient-cancel').text(city);

    // CONTENIDO
    $('.contentOrder-cancel').text(oroContentfinal);

    // TABLA DE PRODUCTOS/SERVICIOS RELACIONADOS A LA ORDEN
    $('.tbl-proposalsOrder-cancel tbody').empty();
    var find = oroAllproposal.indexOf('<=|=>');
    if (find > -1) {
      var separatedBriefcases = oroAllproposal.split('<=|=>');
      for (var i = 0; i < separatedBriefcases.length; i++) {
        var separated = separatedBriefcases[i].split('===>');
        $('.tbl-proposalsOrder-cancel').find('tbody').append(
          "<tr>" +
          "<td>" + separated[1] + "</td>" +
          "<td>" + separated[3] + "</td>" +
          "<td>" + separated[4] + "</td>" +
          "<td>$" + separated[5] + "</td>" +
          "</tr>"
        );
      }
    } else {
      var separated = oroAllproposal.split('===>');
      $('.tbl-proposalsOrder-cancel').find('tbody').append(
        "<tr>" +
        "<td>" + separated[1] + "</td>" +
        "<td>" + separated[3] + "</td>" +
        "<td>" + separated[4] + "</td>" +
        "<td>$" + separated[5] + "</td>" +
        "</tr>"
      );
    }
    $('#cancelOrder-modal').modal();
  });

  $('.aprovedOrder-link').on('click', function(e) {
    e.preventDefault();
    var oroId = $(this).find('span:nth-child(2)').text();
    var docName = $(this).find('span:nth-child(3)').text();
    var docCode = $(this).find('span:nth-child(4)').text();
    var docVersion = $(this).find('span:nth-child(5)').text();
    var oroDatestart = $(this).find('span:nth-child(6)').text();
    var oroDateend = $(this).find('span:nth-child(7)').text();
    var oroContentfinal = $(this).find('span:nth-child(8)').text();
    var oroAllproposal = $(this).find('span:nth-child(9)').text();
    var client = $(this).find('span:nth-child(10)').text();
    var doc = $(this).find('span:nth-child(11)').text();
    var mail = $(this).find('span:nth-child(12)').text();
    var contact = $(this).find('span:nth-child(13)').text();
    var phone = $(this).find('span:nth-child(14)').text();
    var city = $(this).find('span:nth-child(15)').text();

    // ID DE ORDEN
    $('input[name=oroId_Aproved]').val(oroId);
    $('input[name=nameClient_Aproved]').val(client);

    // DATOS DE ORDEN
    $('.docName-aproved').text(docName);
    $('.docVersion-aproved').text(docVersion);
    $('.docCode-aproved').text(docCode);
    $('.oroDatestart-aproved').text(oroDatestart);
    $('.oroDateend-aproved').text(oroDateend);

    // DATOS DE CLIENTE
    $('.nameClient-aproved').text(client);
    $('.documentClient-aproved').text(doc);
    $('.mailClient-aproved').text(mail);
    $('.contactClient-aproved').text(contact);
    $('.phoneClient-aproved').text(phone);
    $('.cityClient-aproved').text(city);

    // CONTENIDO
    $('.contentOrder-aproved').text(oroContentfinal);

    // TABLA DE PRODUCTOS/SERVICIOS RELACIONADOS A LA ORDEN
    $('.tbl-proposalsOrder-aproved tbody').empty();
    var find = oroAllproposal.indexOf('<=|=>');
    if (find > -1) {
      var separatedBriefcases = oroAllproposal.split('<=|=>');
      for (var i = 0; i < separatedBriefcases.length; i++) {
        var separated = separatedBriefcases[i].split('===>');
        $('.tbl-proposalsOrder-aproved').find('tbody').append(
          "<tr>" +
          "<td>" + separated[1] + "</td>" +
          "<td>" + separated[3] + "</td>" +
          "<td>" + separated[4] + "</td>" +
          "<td>$" + separated[5] + "</td>" +
          "</tr>"
        );
      }
    } else {
      var separated = oroAllproposal.split('===>');
      $('.tbl-proposalsOrder-aproved').find('tbody').append(
        "<tr>" +
        "<td>" + separated[1] + "</td>" +
        "<td>" + separated[3] + "</td>" +
        "<td>" + separated[4] + "</td>" +
        "<td>$" + separated[5] + "</td>" +
        "</tr>"
      );
    }
    $('#aprovedOrder-modal').modal();
  });


  function showContent(content) {
    const text = /¡¡¡texto dinámico!!!/g;
    const number = /¡¡¡número dinámico!!!/g;
    const money = /¡¡¡moneda dinámica!!!/g;
    const calendar = /¡¡¡calendario dinámico!!!/g;
    var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
    var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='20' pattern='[0-9]{1,20}' placeholder='Campo de número' required>");
    var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
    var element = newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
    return element;
  }
</script>
@endsection