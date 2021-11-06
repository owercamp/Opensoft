@extends('modules.logisticContractors')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>CONTROL DE AUSENCIA Y AUSENTISMO</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newControl-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessControl'))
      <div class="alert alert-success">
        {{ session('SuccessControl') }}
      </div>
      @endif
      @if(session('PrimaryControl'))
      <div class="alert alert-primary">
        {{ session('PrimaryControl') }}
      </div>
      @endif
      @if(session('WarningControl'))
      <div class="alert alert-warning">
        {{ session('WarningControl') }}
      </div>
      @endif
      @if(session('SecondaryControl'))
      <div class="alert alert-secondary">
        {{ session('SecondaryControl') }}
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
        <th>CODIGO DE REGISTRO</th>
        <th>AUSENTISMO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($controls as $control)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $control->ascDate }}</td>
        <td>
          @if($control->bill->bcTypecontractor == 'MENSAJERIA')
          {{ $control->bill->messenger->cmNames }}
          @elseif($control->bill->bcTypecontractor == 'CARGA EXPRESS')
          {{ $control->bill->charge->ccNames }}
          @elseif($control->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
          {{ $control->bill->especial->ceNames }}
          @endif
        </td>
        <td>{{ $control->ascDocumentcode }}</td>
        <td>{{ $control->ascAbsenteeism }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editControl-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $control->ascId }}</span>
            <span hidden>{{ $control->ascDate }}</span>
            <span hidden>{{ $control->ascDocument_id }}</span>
            <span hidden>{{ $control->ascDocumentcode }}</span>
            <span hidden>{{ $control->document->dolVersion }}</span>
            <span hidden>{{ $control->ascAbsenteeism }}</span>
            <span hidden>{{ $control->ascHourentry }}</span>
            <span hidden>{{ $control->ascHourexit }}</span>
            <span hidden>{{ $control->ascDescription }}</span>
            @if($control->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $control->bill->messenger->cmNames }}</span>
            <span hidden>{{ $control->bill->messenger->cmNumberdocument }}</span>
            <span hidden>{{ $control->bill->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsMessengerPhotos/'.$control->bill->messenger->cmPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsMessengerFirms/'.$control->bill->messenger->cmFirm) }}" hidden>
            @elseif($control->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $control->bill->charge->ccNames }}</span>
            <span hidden>{{ $control->bill->charge->ccNumberdocument }}</span>
            <span hidden>{{ $control->bill->charge->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsChargePhotos/'.$control->bill->charge->ccPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsChargeFirms/'.$control->bill->charge->ccFirm) }}" hidden>
            @elseif($control->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $control->bill->especial->ceNames }}</span>
            <span hidden>{{ $control->bill->especial->ceNumberdocument }}</span>
            <span hidden>{{ $control->bill->especial->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$control->bill->especial->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$control->bill->especial->ceFirm) }}" hidden>
            @endif
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteControl-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $control->ascId }}</span>
            <span hidden>{{ $control->ascDate }}</span>
            <span hidden>{{ $control->ascDocumentcode }}</span>
            <span hidden>{{ $control->ascAbsenteeism }}</span>
            <span hidden>{{ $control->ascHourentry }}</span>
            <span hidden>{{ $control->ascHourexit }}</span>
            <span hidden>{{ $control->ascDescription }}</span>
            @if($control->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $control->bill->messenger->cmNames }}</span>
            <span hidden>{{ $control->bill->messenger->cmNumberdocument }}</span>
            <span hidden>{{ $control->bill->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsMessengerPhotos/'.$control->bill->messenger->cmPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsMessengerFirms/'.$control->bill->messenger->cmFirm) }}" hidden>
            @elseif($control->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $control->bill->charge->ccNames }}</span>
            <span hidden>{{ $control->bill->charge->ccNumberdocument }}</span>
            <span hidden>{{ $control->bill->charge->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsChargePhotos/'.$control->bill->charge->ccPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsChargeFirms/'.$control->bill->charge->ccFirm) }}" hidden>
            @elseif($control->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $control->bill->especial->ceNames }}</span>
            <span hidden>{{ $control->bill->especial->ceNumberdocument }}</span>
            <span hidden>{{ $control->bill->especial->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$control->bill->especial->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$control->bill->especial->ceFirm) }}" hidden>
            @endif
          </a>
          <form action="{{ route('contractors.control.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="ascId" value="{{ $control->ascId }}" class="form-control form-control-sm" required>
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

<div class="modal fade" id="newControl-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO REGISTRO DE CONTROL:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.control.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="ascDate" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="ascDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTRATO CONTRATISTA:</small>
                    <select name="ascBillcontractor_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @for($i = 0; $i < count($contractors); $i++) @if($contractors[$i][1]=='MENSAJERIA' ) <option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsMessengerPhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsMessengerFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
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
              <div class="row border m-3 p-3 section-selectedContractor" style="display: none;">
                <div class="col-md-6 text-center pt-4">
                  <span class="cNames"></span><br>
                  <span class="cNumberdocument"></span><br>
                  <span class="cCity"></span><br>
                  <div class="row p-4 mt-4">
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">AUSENTISMO:</small>
                        <select name="ascAbsenteeism" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          <option value="NO ASISTIO">NO ASISTIO</option>
                          <option value="LLEGO TARDE">LLEGO TARDE</option>
                          <option value="SALIO TEMPRANO">SALIO TEMPRANO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionNot" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_not" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionCome" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE LLEGADA:</small>
                        <input type="time" name="ascHourentry" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_come" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionOut" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE SALIDA:</small>
                        <input type="time" name="ascHourexit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_out" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editControl-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICACION DE CONTROL:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.control.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="ascDate_Edit" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="ascDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="ascDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly>
                    <input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row border m-3 p-3 section-selectedContractor_Edit">
                <div class="col-md-6 text-center pt-4">
                  <span class="cNames_Edit"></span><br>
                  <span class="cNumberdocument_Edit"></span><br>
                  <span class="cCity_Edit"></span><br>
                  <div class="row p-4 mt-4">
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">AUSENTISMO:</small>
                        <select name="ascAbsenteeism_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="NO ASISTIO">NO ASISTIO</option>
                          <option value="LLEGO TARDE">LLEGO TARDE</option>
                          <option value="SALIO TEMPRANO">SALIO TEMPRANO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionNot_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_not_Edit" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionCome_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE LLEGADA:</small>
                        <input type="time" name="ascHourentry_Edit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_come_Edit" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row ascAbsenteeism-sectionOut_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE SALIDA:</small>
                        <input type="time" name="ascHourexit_Edit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="ascDescription_out_Edit" class="form-control form-control-sm" maxlength="500" rows="8" disabled></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="cNames_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="ascId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteControl-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE CONTROL:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 border-right text-center">
            <span class="cNames_Delete"></span><br>
            <span class="cNumberdocument_Delete"></span><br>
            <span class="cCity_Delete"></span><br>
            <div class="row p-4 mt-4">
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
          <div class="col-md-6 border-left text-center">
            <small class="text-muted">FECHA DE CONTROL: </small><br>
            <span class="text-muted"><b class="ascDate_Delete"></b></span><br>
            <small class="text-muted">TIPO DE AUSENTISMO: </small><br>
            <span class="text-muted"><b class="ascAbsenteeism_Delete"></b></span><br>
            <small class="text-muted">HORA DE LLEGADA: </small><br>
            <span class="text-muted"><b class="ascHourentry_Delete"></b></span><br>
            <small class="text-muted">HORA DE SALIDA: </small><br>
            <span class="text-muted"><b class="ascHourexit_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="ascDescription_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('contractors.control.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="cNames_Delete" class="form-control form-control-sm" required>
            <input type="hidden" name="ascId_Delete" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-tertiary form-control-sm">ELIMINAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });

  $('.newControl-link').on('click', function(e) {
    e.preventDefault();
    $('#newControl-modal').modal();
  });

  $('select[name=ascDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    if (selected != '') {
      var code = $('select[name=ascDocument_id] option:selected').attr('data-code');
      var version = $('select[name=ascDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForControlcontractor') }}", {
        dolId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=dolCode]').val(objectsNext);
        } else {
          $('input[name=dolCode]').val('');
        }
      });
    }
  });

  $('select[name=ascBillcontractor_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.cCity').text('');
    $('.cNames').text('');
    $('.cNumberdocument').text('');
    $('img.cPhotonow').attr('src', '');
    $('img.cPhotonow').attr("hidden", true);
    $('img.cFirmnow').attr('src', '');
    $('img.cFirmnow').attr("hidden", true);
    $('select[name=ascAbsenteeism]').attr('disabled', true);
    $('select[name=ascAbsenteeism]').attr('required', false);
    $('.section-selectedContractor').css('display', 'none');
    if (selected != '') {
      var names = $('select[name=ascBillcontractor_id] option:selected').attr('data-names');
      var number = $('select[name=ascBillcontractor_id] option:selected').attr('data-document');
      var firm = $('select[name=ascBillcontractor_id] option:selected').attr('data-firm');
      var photo = $('select[name=ascBillcontractor_id] option:selected').attr('data-photo');
      var city = $('select[name=ascBillcontractor_id] option:selected').attr('data-city');
      $('.cNames').text(names);
      $('.cNumberdocument').text(number);
      $('img.cFirmnow').attr("src", firm);
      $('img.cFirmnow').attr("hidden", false);
      $('img.cPhotonow').attr("src", photo);
      $('img.cPhotonow').attr("hidden", false);
      $('.cCity').text(city);
      $('select[name=ascAbsenteeism]').attr('disabled', false);
      $('select[name=ascAbsenteeism]').attr('required', true);
      $('.section-selectedContractor').css('display', 'flex');
    }
  });

  $('select[name=ascAbsenteeism]').on('change', function(e) {
    var selected = e.target.value;
    if (selected != '') {
      switch (selected) {
        case 'NO ASISTIO':
          $('div.ascAbsenteeism-sectionCome').css('display', 'none');
          $('div.ascAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').css('display', 'none');
          $('div.ascAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionNot').css('display', 'flex');
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('required', true);
          break;
        case 'LLEGO TARDE':
          $('div.ascAbsenteeism-sectionCome').css('display', 'flex');
          $('div.ascAbsenteeism-sectionCome').find('input').attr('disabled', false);
          $('div.ascAbsenteeism-sectionCome').find('input').attr('required', true);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('required', true);
          $('div.ascAbsenteeism-sectionOut').css('display', 'none');
          $('div.ascAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionNot').css('display', 'none');
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
        case 'SALIO TEMPRANO':
          $('div.ascAbsenteeism-sectionCome').css('display', 'none');
          $('div.ascAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').css('display', 'flex');
          $('div.ascAbsenteeism-sectionOut').find('input').attr('disabled', false);
          $('div.ascAbsenteeism-sectionOut').find('input').attr('required', true);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('required', true);
          $('div.ascAbsenteeism-sectionNot').css('display', 'none');
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
        default:
          $('div.ascAbsenteeism-sectionCome').css('display', 'none');
          $('div.ascAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').css('display', 'none');
          $('div.ascAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionNot').css('display', 'none');
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
      }
    } else {
      $('div.ascAbsenteeism-sectionCome').css('display', 'none');
      $('div.ascAbsenteeism-sectionCome').find('input').attr('disabled', true);
      $('div.ascAbsenteeism-sectionCome').find('input').attr('required', false);
      $('div.ascAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
      $('div.ascAbsenteeism-sectionCome').find('textarea').attr('required', false);
      $('div.ascAbsenteeism-sectionOut').css('display', 'none');
      $('div.ascAbsenteeism-sectionOut').find('input').attr('disabled', true);
      $('div.ascAbsenteeism-sectionOut').find('input').attr('required', false);
      $('div.ascAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
      $('div.ascAbsenteeism-sectionOut').find('textarea').attr('required', false);
      $('div.ascAbsenteeism-sectionNot').css('display', 'none');
      $('div.ascAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
      $('div.ascAbsenteeism-sectionNot').find('textarea').attr('required', false);
    }
  });

  $('.editControl-link').on('click', function(e) {
    e.preventDefault();
    var cPhoto = $(this).find('img:first').attr('src');
    var cFirm = $(this).find('img:last').attr('src');
    var ascId = $(this).find('span:nth-child(2)').text();
    var ascDate = $(this).find('span:nth-child(3)').text();
    var ascDocument_id = $(this).find('span:nth-child(4)').text();
    var ascDocumentcode = $(this).find('span:nth-child(5)').text();
    var dolVersion = $(this).find('span:nth-child(6)').text();
    var ascAbsenteeism = $(this).find('span:nth-child(7)').text();
    var ascHourentry = $(this).find('span:nth-child(8)').text();
    var ascHourexit = $(this).find('span:nth-child(9)').text();
    var ascDescription = $(this).find('span:nth-child(10)').text();
    var namesContractor = $(this).find('span:nth-child(11)').text();
    var documentContractor = $(this).find('span:nth-child(12)').text();
    var cityContractor = $(this).find('span:nth-child(13)').text();
    $('input[name=ascId_Edit]').val(ascId);
    $('input[name=ascDate_Edit]').val(ascDate);
    $('select[name=ascDocument_id_Edit]').val(ascDocument_id);
    $('input[name=ascDocument_id_hidden_Edit]').val(ascDocument_id);
    $('input[name=dolCode_Edit]').val(ascDocumentcode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=dolCode_hidden_Edit]').val(ascDocumentcode);
    $('.cPhotonow_Edit').attr("src", cPhoto);
    $('.cPhotonow_Edit').attr("hidden", false);
    $('.cFirmnow_Edit').attr("src", cFirm);
    $('.cFirmnow_Edit').attr("hidden", false);
    $('.cNames_Edit').text(namesContractor);
    $('input[name=cNames_Edit]').val(namesContractor);
    $('.cNumberdocument_Edit').text(documentContractor);
    $('.cCity_Edit').text(cityContractor);
    $('select[name=ascAbsenteeism_Edit]').val(ascAbsenteeism);
    changeOptionsEdit(ascAbsenteeism, ascHourentry, ascHourexit, ascDescription);
    $('#editControl-modal').modal();
  });

  $('select[name=ascDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    if (selected != '') {
      var version = $('select[name=ascDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=ascDocument_id_Edit] option:selected').attr('data-code');
      var dolId = $('input[name=ascDocument_id_hidden_Edit]').val();
      $('input[name=dolVersion_Edit]').val(version);
      if (selected == dolId) {
        $('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForControlcontractor') }}", {
          dolId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=dolCode_Edit]').val(objectsNext);
          } else {
            $('input[name=dolCode_Edit]').val('');
          }
        });
      }
    }
  });

  $('select[name=ascAbsenteeism_Edit]').on('change', function(e) {
    var selected = e.target.value;
    changeOptionsEdit(selected);
  });

  function changeOptionsEdit(selected, entry = '', exit = '', description = '') {
    $('div.ascAbsenteeism-sectionCome_Edit').css('display', 'none');
    $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
    $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
    $('div.ascAbsenteeism-sectionCome_Edit').find('input').val('');
    $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
    $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
    $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').val('');
    $('div.ascAbsenteeism-sectionOut_Edit').css('display', 'none');
    $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
    $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
    $('div.ascAbsenteeism-sectionOut_Edit').find('input').val('');
    $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
    $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
    $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').val('');
    $('div.ascAbsenteeism-sectionNot_Edit').css('display', 'none');
    $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
    $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
    if (selected != '') {
      switch (selected) {
        case 'NO ASISTIO':
          $('div.ascAbsenteeism-sectionCome_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionOut_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionNot_Edit').css('display', 'flex');
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('required', true);
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').val(description);
          break;
        case 'LLEGO TARDE':
          $('div.ascAbsenteeism-sectionCome_Edit').css('display', 'flex');
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('disabled', false);
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('required', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').val(entry);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('required', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').val(description);
          $('div.ascAbsenteeism-sectionOut_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionNot_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
          break;
        case 'SALIO TEMPRANO':
          $('div.ascAbsenteeism-sectionCome_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
          $('div.ascAbsenteeism-sectionOut_Edit').css('display', 'flex');
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('disabled', false);
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').attr('required', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('input').val(exit);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', false);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').attr('required', true);
          $('div.ascAbsenteeism-sectionOut_Edit').find('textarea').val(description);
          $('div.ascAbsenteeism-sectionNot_Edit').css('display', 'none');
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
          $('div.ascAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
          break;
      }
    }
  }

  $('.deleteControl-link').on('click', function(e) {
    e.preventDefault();
    var cPhoto = $(this).find('img:first').attr('src');
    var cFirm = $(this).find('img:last').attr('src');
    var ascId = $(this).find('span:nth-child(2)').text();
    var ascDate = $(this).find('span:nth-child(3)').text();
    var ascDocumentcode = $(this).find('span:nth-child(4)').text();
    var ascAbsenteeism = $(this).find('span:nth-child(5)').text();
    var ascHourentry = $(this).find('span:nth-child(6)').text();
    var ascHourexit = $(this).find('span:nth-child(7)').text();
    var ascDescription = $(this).find('span:nth-child(8)').text();
    var namesContractor = $(this).find('span:nth-child(9)').text();
    var documentContractor = $(this).find('span:nth-child(10)').text();
    var cityContractor = $(this).find('span:nth-child(11)').text();
    $('input[name=ascId_Delete]').val(ascId);
    $('.ascDate_Delete').text(ascDate);
    $('.ascDocumentcode_Delete').text(ascDocumentcode);
    $('.cPhotonow_Delete').attr("src", cPhoto);
    $('.cPhotonow_Delete').attr("hidden", false);
    $('.cFirmnow_Delete').attr("src", cFirm);
    $('.cFirmnow_Delete').attr("hidden", false);
    $('.cNames_Delete').text(namesContractor);
    $('input[name=cNames_Delete]').val(namesContractor);
    $('.cNumberdocument_Delete').text(documentContractor);
    $('.cCity_Delete').text(cityContractor);
    $('.ascAbsenteeism_Delete').text(ascAbsenteeism);
    if (ascHourentry == '' || ascHourentry == null || ascHourentry == 'null') {
      ascHourentry = 'N/A';
    }
    if (ascHourexit == '' || ascHourexit == null || ascHourexit == 'null') {
      ascHourexit = 'N/A';
    }
    $('.ascHourentry_Delete').text(ascHourentry);
    $('.ascHourexit_Delete').text(ascHourexit);
    $('.ascDescription_Delete').text(ascDescription);
    $('#deleteControl-modal').modal();
  });
</script>
@endsection