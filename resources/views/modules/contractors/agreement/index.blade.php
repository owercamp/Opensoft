@extends('modules.logisticContractors')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>COLABORACION EMPRESARIAL</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newAgreement-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessAgreement'))
      <div class="alert alert-success">
        {{ session('SuccessAgreement') }}
      </div>
      @endif
      @if(session('PrimaryAgreement'))
      <div class="alert alert-primary">
        {{ session('PrimaryAgreement') }}
      </div>
      @endif
      @if(session('WarningAgreement'))
      <div class="alert alert-warning">
        {{ session('WarningAgreement') }}
      </div>
      @endif
      @if(session('SecondaryAgreement'))
      <div class="alert alert-secondary">
        {{ session('SecondaryAgreement') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>CODIGO DE DOCUMENTO</th>
        <th>CONTRATISTA</th>
        <th>EMPRESA ALIADA</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($agreements as $agreement)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $agreement->agcDocumentcode }}</td>
        <td>
          @if($agreement->bill->bcTypecontractor == 'MENSAJERIA')
          {{ $agreement->bill->messenger->cmNames }}
          @elseif($agreement->bill->bcTypecontractor == 'CARGA EXPRESS')
          {{ $agreement->bill->charge->ccNames }}
          @elseif($agreement->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
          {{ $agreement->bill->especial->ceNames }}
          @endif
        </td>
        <td>
          @if($agreement->agcTypecontractor == 'MENSAJERIA')
          {{ $agreement->alliesmessenger->amReasonsocial }}
          @elseif($agreement->agcTypecontractor == 'CARGA EXPRESS')
          {{ $agreement->alliescharge->acReasonsocial }}
          @elseif($agreement->agcTypecontractor == 'SERVICIO ESPECIAL')
          {{ $agreement->alliesespecial->aeReasonsocial }}
          @endif
        </td>
        <td>
          @if(strlen($agreement->agcContentfinal) > 20)
          {{ substr($agreement->agcContentfinal,0,20) . ' ...' }}
          @else
          {{ $agreement->agcContentfinal }}
          @endif
        </td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editAgreement-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $agreement->agcId }}</span>
            <span hidden>{{ $agreement->agcDocument_id }}</span>
            <span hidden>{{ $agreement->agcDocumentcode }}</span>
            <span hidden>{{ $agreement->document->dolVersion }}</span>
            @if($agreement->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $agreement->bill->messenger->cmNames }}</span>
            @elseif($agreement->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $agreement->bill->charge->ccNames }}</span>
            @elseif($agreement->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $agreement->bill->especial->ceNames }}</span>
            @endif
            <span hidden>{{ $agreement->agcTypecontractor }}</span>
            @if($agreement->agcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $agreement->alliesmessenger->amReasonsocial }}</span>
            @elseif($agreement->agcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $agreement->alliescharge->acReasonsocial }}</span>
            @elseif($agreement->agcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $agreement->alliesespecial->aeReasonsocial }}</span>
            @endif
            <span hidden>{{ $agreement->agcConfigdocument_id }}</span>
            <span hidden>{{ $agreement->agcContentfinal }}</span>
            <span hidden>{{ $agreement->agcWrited }}</span>
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteAgreement-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $agreement->agcId }}</span>
            <span hidden>{{ $agreement->agcDocumentcode }}</span>
            @if($agreement->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $agreement->bill->messenger->cmNames }}</span>
            <span hidden>{{ $agreement->bill->messenger->cmNumberdocument }}</span>
            @elseif($agreement->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $agreement->bill->charge->ccNames }}</span>
            <span hidden>{{ $agreement->bill->charge->ccNumberdocument }}</span>
            @elseif($agreement->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $agreement->bill->especial->ceNames }}</span>
            <span hidden>{{ $agreement->bill->especial->ceNumberdocument }}</span>
            @endif
            <span hidden>{{ $agreement->agcTypecontractor }}</span>
            @if($agreement->agcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $agreement->alliesmessenger->amReasonsocial }}</span>
            <span hidden>{{ $agreement->alliesmessenger->amNumberdocument }}</span>
            @elseif($agreement->agcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $agreement->alliescharge->acReasonsocial }}</span>
            <span hidden>{{ $agreement->alliescharge->acNumberdocument }}</span>
            @elseif($agreement->agcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $agreement->alliesespecial->aeReasonsocial }}</span>
            <span hidden>{{ $agreement->alliesespecial->aeNumberdocument }}</span>
            @endif
            <span hidden>{{ $agreement->agcContentfinal }}</span>
          </a>
          <form action="{{ route('contractors.agreement.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="agcId" value="{{ $agreement->agcId }}" class="form-control form-control-sm" required>
            <button type="submit" title="Descargar PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
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

<div class="modal fade" id="newAgreement-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVO CONVENIO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.agreement.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="agcDocument_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="dolVersion" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE CONTRATISTA:</small>
                    <select name="agcTypecontractor" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="MENSAJERIA">MENSAJERIA</option>
                      <option value="CARGA EXPRESS">CARGA EXPRESS</option>
                      <option value="SERVICIO ESPECIAL">SERVICIO ESPECIAL</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 section-selectbill">
                  <div class="row section-contractormessenger" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTRATISTA DE MENSAJERIA:</small>
                        <select name="agcContractormessenger_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($contractormessengers as $contractormessenger)
                          <option value="{{ $contractormessenger->cmId }}" data-bill="{{ $contractormessenger->bcId }}">{{ $contractormessenger->cmNames }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row section-contractorcharge" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTRATISTA DE CARGA EXPRESS:</small>
                        <select name="agcContractorcharge_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($contractorcharges as $contractorcharge)
                          <option value="{{ $contractorcharge->ccId }}" data-bill="{{ $contractorcharge->bcId }}">{{ $contractorcharge->ccNames }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row section-contractorespecial" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTRATISTA DE SERVICIO ESPECIAL:</small>
                        <select name="agcContractorespecial_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($contractorespecials as $contractorespecial)
                          <option value="{{ $contractorespecial->ceId }}" data-bill="{{ $contractorespecial->bcId }}">{{ $contractorespecial->ceNames }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE EMPRESA ALIADA:</small>
                    <input type="text" name="agcTypeallies" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row section-alliesmessenger" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">EMPRESA ALIADA DE MENSAJERIA:</small>
                        <select name="agcAlliesmessenger_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($alliesmessengers as $alliesmessenger)
                          <option value="{{ $alliesmessenger->amId }}">{{ $alliesmessenger->amReasonsocial }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row section-alliescharge" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">EMPRESA ALIADA DE CARGA EXPRESS:</small>
                        <select name="agcAlliescharge_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($alliescharges as $alliescharge)
                          <option value="{{ $alliescharge->acId }}">{{ $alliescharge->acReasonsocial }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row section-alliesespecial" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">EMPRESA ALIADA DE SERVICIO ESPECIAL:</small>
                        <select name="agcAlliesespecial_id" class="form-control form-control-sm" disabled>
                          <option value="">Seleccione ...</option>
                          @foreach($alliesespecials as $alliesespecial)
                          <option value="{{ $alliesespecial->aeId }}">{{ $alliesespecial->aeReasonsocial }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="agcConfigdocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="agcTemplate" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border agcContentfinal" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="agcVariables" class="form-control form-control-sm" readonly required>
            <input type="hidden" name="agcBillcontractor_id" class="form-control form-control-sm" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editAgreement-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE CONVENIO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.agreement.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="agcDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="agcDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly required>
                    <input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE CONVENIO:</small>
                    <input type="text" name="agcTypecontractor_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CONTRATISTA:</small>
                    <input type="text" name="agcContractor_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">EMPRESA ALIADA:</small>
                    <input type="text" name="agcAllies_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="agcConfigdocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="agcTemplate_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border agcContentfinal_Edit" style="font-size: 12px;">

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
              <input type="hidden" name="agcVariables_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" class="form-control form-control-sm" name="agcId_Edit" readonly required>
              <button type="submit" class="btn btn-outline-success form-control-sm my-3">GUARDAR CAMBIOS</button>
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

<div class="modal fade" id="deleteAgreement-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE CONVENIO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="agcDocumentcode_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <small class="text-muted">TIPO DE CONVENIO: </small><br>
            <span class="text-muted"><b class="agcTypecontractor_Delete"></b></span><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">CONTRATISTA: </small><br>
            <span class="text-muted"><b class="agcNamecontractor_Delete"></b></span><br>
            <small class="text-muted">N° DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="agcNumbercontractor_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <small class="text-muted">EMPRESA ALIADA: </small><br>
            <span class="text-muted"><b class="agcNameallies_Delete"></b></span><br>
            <small class="text-muted">N° DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="agcNumberallies_Delete"></b></span><br>
          </div>
        </div>
        <div class="row m-2 p-1 border-top">
          <div class="col-md-12">
            <small class="text-muted">CONTENIDO: </small><br>
            <span class="text-muted"><b class="agcContentfinal_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('contractors.agreement.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="agcId_Delete" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">ELIMINAR</button>
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

  $('.newAgreement-link').on('click', function() {
    $('#newAgreement-modal').modal();
  });

  $('select[name=agcDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion]').val('');
    $('input[name=dolCode]').val('');
    $('select[name=agcConfigdocument_id]').empty();
    $('select[name=agcConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.hcContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=agcDocument_id] option:selected').attr('data-version');
      var code = $('select[name=agcDocument_id] option:selected').attr('data-code');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForAgreementcontractor') }}", {
        dolId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=dolCode]').val(objectsNext);
        } else {
          $('input[name=dolCode]').val('');
        }
      });
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 100) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
              $('select[name=agcConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=agcConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=agcTypecontractor]').on('change', function(e) {
    var selected = e.target.value;
    if (selected != '') {
      $('input[name=agcTypeallies]').val(selected);
      if (selected == 'MENSAJERIA') {
        $('div.section-contractormessenger').css('display', 'flex');
        $('div.section-contractormessenger select').attr('disabled', false);
        $('div.section-contractormessenger select').attr('required', true);
        $('div.section-contractormessenger select').val('');
        $('div.section-alliesmessenger').css('display', 'flex');
        $('div.section-alliesmessenger select').attr('disabled', false);
        $('div.section-alliesmessenger select').attr('required', true);
        $('div.section-alliesmessenger select').val('');
        $('div.section-contractorcharge').css('display', 'none');
        $('div.section-contractorcharge select').attr('disabled', true);
        $('div.section-contractorcharge select').attr('required', false);
        $('div.section-contractorcharge select').val('');
        $('div.section-alliescharge').css('display', 'none');
        $('div.section-alliescharge select').attr('disabled', true);
        $('div.section-alliescharge select').attr('required', false);
        $('div.section-alliescharge select').val('');
        $('div.section-contractorespecial').css('display', 'none');
        $('div.section-contractorespecial select').attr('disabled', true);
        $('div.section-contractorespecial select').attr('required', false);
        $('div.section-contractorespecial select').val('');
        $('div.section-alliesespecial').css('display', 'none');
        $('div.section-alliesespecial select').attr('disabled', true);
        $('div.section-alliesespecial select').attr('required', false);
        $('div.section-alliesespecial select').val('');
      } else if (selected == 'CARGA EXPRESS') {
        $('div.section-contractormessenger').css('display', 'none');
        $('div.section-contractormessenger select').attr('disabled', true);
        $('div.section-contractormessenger select').attr('required', false);
        $('div.section-contractormessenger select').val('');
        $('div.section-alliesmessenger').css('display', 'none');
        $('div.section-alliesmessenger select').attr('disabled', true);
        $('div.section-alliesmessenger select').attr('required', false);
        $('div.section-alliesmessenger select').val('');
        $('div.section-contractorcharge').css('display', 'flex');
        $('div.section-contractorcharge select').attr('disabled', false);
        $('div.section-contractorcharge select').attr('required', true);
        $('div.section-contractorcharge select').val('');
        $('div.section-alliescharge').css('display', 'flex');
        $('div.section-alliescharge select').attr('disabled', false);
        $('div.section-alliescharge select').attr('required', true);
        $('div.section-alliescharge select').val('');
        $('div.section-contractorespecial').css('display', 'none');
        $('div.section-contractorespecial select').attr('disabled', true);
        $('div.section-contractorespecial select').attr('required', false);
        $('div.section-contractorespecial select').val('');
        $('div.section-alliesespecial').css('display', 'none');
        $('div.section-alliesespecial select').attr('disabled', true);
        $('div.section-alliesespecial select').attr('required', false);
        $('div.section-alliesespecial select').val('');
      } else if (selected == 'SERVICIO ESPECIAL') {
        $('div.section-contractormessenger').css('display', 'none');
        $('div.section-contractormessenger select').attr('disabled', true);
        $('div.section-contractormessenger select').attr('required', false);
        $('div.section-contractormessenger select').val('');
        $('div.section-alliesmessenger').css('display', 'none');
        $('div.section-alliesmessenger select').attr('disabled', true);
        $('div.section-alliesmessenger select').attr('required', false);
        $('div.section-alliesmessenger select').val('');
        $('div.section-contractorcharge').css('display', 'none');
        $('div.section-contractorcharge select').attr('disabled', true);
        $('div.section-contractorcharge select').attr('required', false);
        $('div.section-contractorcharge select').val('');
        $('div.section-alliescharge').css('display', 'none');
        $('div.section-alliescharge select').attr('disabled', true);
        $('div.section-alliescharge select').attr('required', false);
        $('div.section-alliescharge select').val('');
        $('div.section-contractorespecial').css('display', 'flex');
        $('div.section-contractorespecial select').attr('disabled', false);
        $('div.section-contractorespecial select').attr('required', true);
        $('div.section-contractorespecial select').val('');
        $('div.section-alliesespecial').css('display', 'flex');
        $('div.section-alliesespecial select').attr('disabled', false);
        $('div.section-alliesespecial select').attr('required', true);
        $('div.section-alliesespecial select').val('');
      } else {
        $('div.section-contractormessenger').css('display', 'none');
        $('div.section-contractormessenger select').attr('disabled', true);
        $('div.section-contractormessenger select').attr('required', false);
        $('div.section-contractormessenger select').val('');
        $('div.section-alliesmessenger').css('display', 'none');
        $('div.section-alliesmessenger select').attr('disabled', true);
        $('div.section-alliesmessenger select').attr('required', false);
        $('div.section-alliesmessenger select').val('');
        $('div.section-contractorcharge').css('display', 'none');
        $('div.section-contractorcharge select').attr('disabled', true);
        $('div.section-contractorcharge select').attr('required', false);
        $('div.section-contractorcharge select').val('');
        $('div.section-alliescharge').css('display', 'none');
        $('div.section-alliescharge select').attr('disabled', true);
        $('div.section-alliescharge select').attr('required', false);
        $('div.section-alliescharge select').val('');
        $('div.section-contractorespecial').css('display', 'none');
        $('div.section-contractorespecial select').attr('disabled', true);
        $('div.section-contractorespecial select').attr('required', false);
        $('div.section-contractorespecial select').val('');
        $('div.section-alliesespecial').css('display', 'none');
        $('div.section-alliesespecial select').attr('disabled', true);
        $('div.section-alliesespecial select').attr('required', false);
        $('div.section-alliesespecial select').val('');
      }
    }
  });

  $('.section-selectbill').on('change', 'select', function(e) {
    var selected = e.target.value;
    if (selected != '') {
      var bill = $(this).find('option:selected').attr('data-bill');
      $('input[name=agcBillcontractor_id]').val(bill);
    } else {
      $('input[name=agcBillcontractor_id]').val('');
    }
  });

  $('select[name=agcConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=agcTemplate]').val('');
    $('div.agcContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=agcConfigdocument_id] option:selected').attr('data-content');
      $('input[name=agcTemplate]').val(content);
      $('div.agcContentfinal').append(showContent(content));
    }
  });

  $('div.agcContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=agcVariables]').val('');
    $('div.agcContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=agcVariables]').val(all);
  });

  $('.editAgreement-link').on('click', function(e) {
    e.preventDefault();
    var agcId = $(this).find('span:nth-child(2)').text();
    var agcDocument_id = $(this).find('span:nth-child(3)').text();
    var agcDocumentcode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var namecontractor = $(this).find('span:nth-child(6)').text();
    var agcType = $(this).find('span:nth-child(7)').text();
    var nameallies = $(this).find('span:nth-child(8)').text();
    var agcConfigdocument_id = $(this).find('span:nth-child(9)').text();
    var agcContentfinal = $(this).find('span:nth-child(10)').text();
    var agcWrited = $(this).find('span:nth-child(11)').text();
    $('input[name=agcId_Edit]').val(agcId);
    $('select[name=agcDocument_id_Edit]').val(agcDocument_id);
    $('input[name=dolCode_Edit]').val(agcDocumentcode);
    $('input[name=dolCode_hidden_Edit]').val(agcDocumentcode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=agcTypecontractor_Edit]').val(agcType);
    $('input[name=agcContractor_Edit]').val(namecontractor);
    $('input[name=agcAllies_Edit]').val(nameallies);
    $('input[name=agcVariables_Edit]').val(agcWrited + '!!==¡¡');
    var contentAll = '';
    $('select[name=agcConfigdocument_id_Edit]').empty();
    $('select[name=agcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('input[name=agcDocument_id_hidden_Edit]').val(agcDocument_id);
    $.get("{{ route('getContentFromDocumentLogistic') }}", {
      dolId: agcDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdlContent'].length > 100) {
            var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
            if (agcConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=agcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.agcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (agcConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
              $('input[name=agcTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.agcContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = agcWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.agcContentfinal_Edit > .field-dinamic').each(function() {
            var value = $(this).val();
            if (value == '') {
              $(this).val(item[0]);
              return false;
            }
          });
        }
        $('#editAgreement-modal').modal();
      }
    });
  });

  $('select[name=agcDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    $('select[name=agcConfigdocument_id_Edit]').empty();
    $('select[name=agcConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.agcContentfinal_Edit').empty();
    if (selected != '') {
      var version = $('select[name=agcDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=agcDocument_id_Edit] option:selected').attr('data-code');
      var dolId = $('input[name=agcDocument_id_hidden_Edit]').val();
      $('input[name=dolVersion_Edit]').val(version);
      if (selected == dolId) {
        $('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForAgreementcontractor') }}", {
          dolId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=dolCode_Edit]').val(objectsNext);
          } else {
            $('input[name=dolCode_Edit]').val('');
          }
        });
      }
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 50) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 50) + ' ...';
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=agcConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=agcConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=agcTemplate_Edit]').val('');
    $('div.agcContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=agcConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=agcTemplate_Edit]').val(content);
      $('div.agcContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.agcContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=agcVariables_Edit]').val('');
    $('div.agcContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=agcVariables_Edit]').val(all);
  });

  $('.deleteAgreement-link').on('click', function(e) {
    e.preventDefault();
    var agcId = $(this).find('span:nth-child(2)').text();
    var agcDocumentcode = $(this).find('span:nth-child(3)').text();
    var namecontractor = $(this).find('span:nth-child(4)').text();
    var numbercontractor = $(this).find('span:nth-child(5)').text();
    var agcType = $(this).find('span:nth-child(6)').text();
    var nameallies = $(this).find('span:nth-child(7)').text();
    var numberallies = $(this).find('span:nth-child(8)').text();
    var agcContentfinal = $(this).find('span:nth-child(9)').text();

    $('input[name=agcId_Delete]').val(agcId);
    $('b.agcDocumentcode_Delete').text(agcDocumentcode);
    $('b.agcNamecontractor_Delete').text(namecontractor);
    $('b.agcNumbercontractor_Delete').text(numbercontractor);
    $('b.agcTypecontractor_Delete').text(agcType);
    $('b.agcNameallies_Delete').text(nameallies);
    $('b.agcNumberallies_Delete').text(numberallies);
    $('b.agcContentfinal_Delete').text(agcContentfinal);
    $('#deleteAgreement-modal').modal();
  });

  function showContent(content) {
    const text = /¡¡¡texto dinámico!!!/g;
    const number = /¡¡¡número dinámico!!!/g;
    const money = /¡¡¡moneda dinámica!!!/g;
    const calendar = /¡¡¡calendario dinámico!!!/g;
    var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
    var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='20' pattern='[0-9]{1,10}' placeholder='Campo de número' required>");
    var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
    var element = newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
    return element;
  }
</script>
@endsection