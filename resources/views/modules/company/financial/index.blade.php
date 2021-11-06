@extends('modules.administrativeCompany')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h5>INFORMACION FINANCIERA</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessFinancial'))
      <div class="alert alert-success">
        {{ session('SuccessFinancial') }}
      </div>
      @endif
      @if(session('PrimaryFinancial'))
      <div class="alert alert-primary">
        {{ session('PrimaryFinancial') }}
      </div>
      @endif
      @if(session('WarningFinancial'))
      <div class="alert alert-warning">
        {{ session('WarningFinancial') }}
      </div>
      @endif
      @if(session('SecondaryFinancial'))
      <div class="alert alert-secondary">
        {{ session('SecondaryFinancial') }}
      </div>
      @endif
    </div>
  </div>
  @if(isset($financial))
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6 border p-3">
              <small class="text-muted">REGIMEN IVA: </small><br>
              <span class="text-muted">
                <b class="fiRegime_info">
                  {{ $financial->fiRegime }}
                </b>
              </span><br>
              <small class="text-muted">SOMOS GRANDES CONTRIBUYENTES: </small><br>
              <span class="text-muted">
                <b class="fiTaxpayer_info">
                  {{ $financial->fiTaxpayer }}
                </b>
              </span><br>
              <small class="text-muted">SOMOS AUTO-RETENEDORES: </small><br>
              <span class="text-muted">
                <b class="fiAutoretainer_info">
                  {{ $financial->fiAutoretainer }}
                </b>
              </span><br>
              <small class="text-muted">ACTIVIDADES ECONOMICAS: </small><br>
              <span class="text-muted">
                <b class="fiActivitys_info">
                  {{ $financial->fiActivitys }}
                </b>
              </span><br>
              <small class="text-muted">FECHA/RESOLUCION DE FACTURACION: </small><br>
              <span class="text-muted">
                <b class="fiDateresolutionfacturation_info">
                  {{ $financial->fiDateresolutionfacturation }}
                </b>
                /
                <b class="fiResolutionfacturation_info">
                  {{ $financial->fiResolutionfacturation }}
                </b>
              </span><br>
              <small class="text-muted">MESES DE VIGENCIA Y FECHA DE VENCIMIENTO: </small><br>
              <span class="text-muted">
                <b class="fiMountcountresolution_info">
                  {{ $financial->fiMountcountresolution }}
                </b>
                /
                <b class="fiDatefallresolution_info">
                  {{ $financial->fiDatefallresolution }}
                </b>
              </span><br>
              <small class="text-muted">PREFIJO Y NUMERACION AUTORIZADA: </small><br>
              <span class="text-muted">
                <b class="fiPrefix_info">
                  {{ $financial->fiPrefix }}
                </b>
                /
                <b class="fiNumeration_info">
                  {{ $financial->fiNumberinitial }} A {{ $financial->fiNumberfinal }}
                </b>
              </span><br>
            </div>
            <div class="col-md-6 border p-3">
              <small class="text-muted">ENTIDAD BANCARIA: </small><br>
              <span class="text-muted">
                <b class="fiBank_Info">
                  {{ $financial->fiBank }}
                </b>
                <br>
                <img class="img-responsive img-thumbnail coBanklogonow_Info" src="{{ asset('storage/infoCompany/bank/'.$financial->fiBanklogo) }}" style="width: 100px; height: auto;">
              </span><br>
              <small class="text-muted">TIPO Y NUMERO DE CUENTA: </small><br>
              <span class="text-muted">
                <b class="fiTypeaccount_Info">
                  {{ $financial->fiTypeaccount }}:
                </b>
                <b class="fiAccountnumber_Info">
                  {{ __(' ' . $financial->fiAccountnumber) }}
                </b>
              </span><br>
              <small class="text-muted">NOTAS ADICIONALES 1: </small><br>
              <span class="text-muted">
                <b class="fiNotesone_Info">
                  {{ $financial->fiNotesone }}
                </b>
              </span><br>
              <small class="text-muted">NOTAS ADICIONALES 2: </small><br>
              <span class="text-muted">
                <b class="fiNotestwo_Info">
                  {{ $financial->fiNotestwo }}
                </b>
              </span><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 border p-3">
              <small class="text-muted">N° INICIAL DE FACTURACION: </small><br>
              <span class="text-muted">
                <b class="fiNumberinitialfacturation_Info">
                  {{ $financial->fiNumberinitialfacturation }}
                </b>
              </span><br>
              <small class="text-muted">N° INICIAL DE COMPROBANTES DE INGRESOS: </small><br>
              <span class="text-muted">
                <b class="fiNumberinitialvoucherentry_Info">
                  {{ $financial->fiNumberinitialvoucherentry }}
                </b>
              </span><br>
              <small class="text-muted">N° INICIAL DE COMPROBANTES DE EGRESOS: </small><br>
              <span class="text-muted">
                <b class="fiNumberinitialvoucheregress_Info">
                  {{ $financial->fiNumberinitialvoucheregress }}
                </b>
              </span><br>
            </div>
            <div class="col-md-6 border p-3">
              <small class="text-muted">CAPITAL DE TRABAJO: </small><br>
              <span class="text-muted">
                <b class="fiCapitalwork_Info">
                  {{ $financial->fiCapitalwork }}
                </b>
              </span><br>
              <small class="text-muted">PATROMINIO: </small><br>
              <span class="text-muted">
                <b class="fiHeritage_Info">
                  {{ $financial->fiHeritage }}
                </b>
              </span><br>
              <small class="text-muted">INDICE DE LIQUIDEZ: </small><br>
              <span class="text-muted">
                <b class="fiIndexsettlement_Info">
                  {{ $financial->fiIndexsettlement }}
                </b>
              </span><br>
              <small class="text-muted">INDICE DE ENDEUDAMIENTO: </small><br>
              <span class="text-muted">
                <b class="fiIndexdebt_Info">
                  {{ $financial->fiIndexdebt }}
                </b>
              </span><br>
              <small class="text-muted">RAZON DE COBERTURA DE INTERESES: </small><br>
              <span class="text-muted">
                <b class="fiReasoncoverage_Info">
                  {{ $financial->fiReasoncoverage }}
                </b>
              </span><br>
              <small class="text-muted">RENTABILIDAD DEL PATRIMONIO: </small><br>
              <span class="text-muted">
                <b class="fiProfitabilityheritage_Info">
                  {{ $financial->fiProfitabilityheritage }}
                </b>
              </span><br>
              <small class="text-muted">RENTABILIDAD SOBRE ACTIVOS: </small><br>
              <span class="text-muted">
                <b class="fiProfitabilityactives_Info">
                  {{ $financial->fiProfitabilityactives }}
                </b>
              </span><br>
            </div>
          </div>
          <div class="row p-4">
            <div class="col-md-6">
              <a href="#" title="Eliminar información" class="btn btn-outline-tertiary form-control-sm deleteFinancial-link">
                ELIMINAR INFORMACION
                <i class="fas fa-trash-alt"></i>
                <span hidden>{{ $financial->fiId }}</span>
              </a>
            </div>
            <div class="col-md-6">
              <a href="#" title="Editar información" class="btn btn-outline-primary form-control-sm editFinancial-link">
                MODIFICAR INFORMACION <i class="fas fa-edit"></i>
                <span hidden>{{ $financial->fiId }}</span>
                <span hidden>{{ $financial->fiRegime }}</span>
                <span hidden>{{ $financial->fiTaxpayer }}</span>
                <span hidden>{{ $financial->fiAutoretainer }}</span>
                <span hidden>{{ $financial->fiActivitys }}</span>
                <span hidden>{{ $financial->fiResolutionfacturation }}</span>
                <span hidden>{{ $financial->fiDateresolutionfacturation }}</span>
                <span hidden>{{ $financial->fiMountcountresolution }}</span>
                <span hidden>{{ $financial->fiDatefallresolution }}</span>
                <span hidden>{{ $financial->fiPrefix }}</span>
                <span hidden>{{ $financial->fiNumberinitial }}</span>
                <span hidden>{{ $financial->fiNumberfinal }}</span>
                <span hidden>{{ $financial->fiBank }}</span>
                <span hidden>{{ $financial->fiTypeaccount }}</span>
                <span hidden>{{ $financial->fiAccountnumber }}</span>
                <span hidden>{{ $financial->fiNotesone }}</span>
                <span hidden>{{ $financial->fiNotestwo }}</span>
                <span hidden>{{ $financial->fiNumberinitialfacturation }}</span>
                <span hidden>{{ $financial->fiNumberinitialvoucherentry }}</span>
                <span hidden>{{ $financial->fiNumberinitialvoucheregress }}</span>
                <span hidden>{{ $financial->fiCapitalwork }}</span>
                <span hidden>{{ $financial->fiHeritage }}</span>
                <span hidden>{{ $financial->fiIndexsettlement }}</span>
                <span hidden>{{ $financial->fiIndexdebt }}</span>
                <span hidden>{{ $financial->fiReasoncoverage }}</span>
                <span hidden>{{ $financial->fiProfitabilityheritage }}</span>
                <span hidden>{{ $financial->fiProfitabilityactives }}</span>
                <img src="{{ asset('storage/infoCompany/bank/'.$financial->fiBanklogo) }}" hidden>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-md-12 text-center">
      <h6>NO EXISTE INFORMACION FINANCIERA</h6>
      <br>
      <button type="button" title="Registrar información financiera" class="btn btn-outline-success form-control-sm newfinancial-link">GUARDAR INFORMACION</button>
    </div>
  </div>
  @endif
</div>

<div class="modal fade" id="newFinancial-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA INFORMACION FINANCIERA:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('financial.save') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REGIMEN IVA:</small>
                    <select name="fiRegime" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="COMUN">COMUN</option>
                      <option value="SIMPLIFICADO">SIMPLIFICADO</option>
                      <option value="ESPECIAL">ESPECIAL</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">¿CONTRIBUYESTES?:</small>
                    <select name="fiTaxpayer" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">¿AUTORETENEDORES?:</small>
                    <select name="fiAutoretainer" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>ACTIVIDADES ECONOMICAS:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_one" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_two" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_three" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_four" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">RESOLUCION DE FACTURACION:</small>
                    <input type="text" name="fiResolutionfacturation" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE RESOLUCION:</small>
                    <input type="text" name="fiDateresolutionfacturation" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">MESES DE VIGENCIA:</small>
                    <input type="text" name="fiMountcountresolution" maxlength="2" pattern="[0-9]{1,2}" class="form-control form-control-sm" placeholder="Ej. 00" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE VENCIMIENTO:</small>
                    <input type="text" name="fiDatefallresolution" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">PREFIJO AUTORIZADO:</small>
                    <input type="text" name="fiPrefix" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" placeholder="Ej. 000000" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO AUTORIZADO INICIAL:</small>
                    <input type="text" name="fiNumberinitial" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO AUTORIZADO FINAL:</small>
                    <input type="text" name="fiNumberfinal" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ENTIDAD BANCARIA:</small>
                    <input type="text" name="fiBank" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LOGO DE ENTIDAD:</small>
                    <div class="custom-file">
                      <input type="file" name="fiBanklogo" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE CUENTA:</small>
                    <select name="fiTypeaccount" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="CORRIENTE">CORRIENTE</option>
                      <option value="AHORROS">AHORROS</option>
                      <option value="RECAUDO">RECAUDO</option>
                      <option value="FIDUCIA">FIDUCIA</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE CUENTA:</small>
                    <input type="text" name="fiAccountnumber" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOTAS ADICIONALES 1:</small>
                    <textarea name="fiNotesone" maxlength="500" class="form-control form-control-sm" required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOTAS ADICIONALES 2:</small>
                    <textarea name="fiNotestwo" maxlength="500" class="form-control form-control-sm" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>NUMERACION INICIAL:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">Factura de venta:</small>
                        <input type="text" name="fiNumberinitialfacturation" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">Comprobante de ingreso:</small>
                        <input type="text" name="fiNumberinitialvoucherentry" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">Comprobante de egreso:</small>
                        <input type="text" name="fiNumberinitialvoucheregress" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>INDICADORES FINANCIEROS:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CAPITAL DE TRABAJO:</small>
                        <input type="text" name="fiCapitalwork" maxlength="15" class="form-control form-control-sm" pattern="[0-9]{1,15}" placeholder="Ej. 000000000000000" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">PATRIMONIO:</small>
                        <input type="text" name="fiHeritage" maxlength="15" class="form-control form-control-sm" pattern="[0-9]{1,15}" placeholder="Ej. 000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">INDICE DE LIQUIDEZ:</small>
                        <input type="number" step="0.01" name="fiIndexsettlement" maxlength="7" class="form-control form-control-sm" pattern="[0-9,]{1,7}" placeholder="Ej. 0000,00" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">INDICE DE ENDEUDAMIENTO:</small>
                        <input type="number" step="0.01" name="fiIndexdebt" maxlength="7" class="form-control form-control-sm" pattern="[0-9,]{1,7}" placeholder="Ej. 0000,00" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">RAZON DE COBERTURA DE INTERESES:</small>
                        <input type="number" step="0.01" name="fiReasoncoverage" maxlength="7" class="form-control form-control-sm" pattern="[0-9,]{1,7}" placeholder="Ej. 0000,00" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">RENTABILIDAD DEL PATRIMONIO:</small>
                        <input type="number" step="0.01" name="fiProfitabilityheritage" maxlength="7" class="form-control form-control-sm" pattern="[0-9,]{1,7}" placeholder="Ej. 0000,00" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">RENTABILIDAD SOBRE ACTIVOS:</small>
                        <input type="number" step="0.01" name="fiProfitabilityactives" maxlength="7" class="form-control form-control-sm" pattern="[0-9,]{1,7}" placeholder="Ej. 0000,00" required>
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

<div class="modal fade" id="editFinancial-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR INFORMACION FINANCIERA:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('financial.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REGIMEN IVA:</small>
                    <select name="fiRegime_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="COMUN">COMUN</option>
                      <option value="SIMPLIFICADO">SIMPLIFICADO</option>
                      <option value="ESPECIAL">ESPECIAL</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">¿CONTRIBUYESTES?:</small>
                    <select name="fiTaxpayer_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">¿AUTORETENEDORES?:</small>
                    <select name="fiAutoretainer_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>ACTIVIDADES ECONOMICAS:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_one_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_two_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_three_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" name="fiActivitys_four_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">RESOLUCION DE FACTURACION:</small>
                    <input type="text" name="fiResolutionfacturation_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE RESOLUCION:</small>
                    <input type="text" name="fiDateresolutionfacturation_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">MESES DE VIGENCIA:</small>
                    <input type="text" name="fiMountcountresolution_Edit" maxlength="2" pattern="[0-9]{1,2}" class="form-control form-control-sm" placeholder="Ej. 00" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE VENCIMIENTO:</small>
                    <input type="text" name="fiDatefallresolution_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">PREFIJO AUTORIZADO:</small>
                    <input type="text" name="fiPrefix_Edit" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" placeholder="Ej. 000000" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO AUTORIZADO INICIAL:</small>
                    <input type="text" name="fiNumberinitial_Edit" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO AUTORIZADO FINAL:</small>
                    <input type="text" name="fiNumberfinal_Edit" maxlength="6" pattern="[0-9]{1,6}" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ENTIDAD BANCARIA:</small>
                    <input type="text" name="fiBank_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LOGO DE ENTIDAD:</small>
                    <div class="custom-file">
                      <input type="file" name="fiBanklogo_Edit" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" accept="image/jpg,image/jpeg,image/png">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE CUENTA:</small>
                    <select name="fiTypeaccount_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="CORRIENTE">CORRIENTE</option>
                      <option value="AHORROS">AHORROS</option>
                      <option value="RECAUDO">RECAUDO</option>
                      <option value="FIDUCIA">FIDUCIA</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE CUENTA:</small>
                    <input type="text" name="fiAccountnumber_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOTAS ADICIONALES 1:</small>
                    <textarea name="fiNotesone_Edit" maxlength="500" class="form-control form-control-sm" required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NOTAS ADICIONALES 2:</small>
                    <textarea name="fiNotestwo_Edit" maxlength="500" class="form-control form-control-sm" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>NUMERACION INICIAL:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">FACTURA DE VENTA:</small>
                        <input type="text" name="fiNumberinitialfacturation_Edit" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">COMPROBANTE DE INGRESO:</small>
                        <input type="text" name="fiNumberinitialvoucherentry_Edit" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">COMPROBANTE DE EGRESO:</small>
                        <input type="text" name="fiNumberinitialvoucheregress_Edit" maxlength="10" class="form-control form-control-sm" pattern="[0-9]{1,10}" placeholder="Ej. 0000000000" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small>INDICADORES FINANCIEROS:</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CAPITAL DE TRABAJO:</small>
                        <input type="number" step="0.01" name="fiCapitalwork_Edit" maxlength="15" class="form-control form-control-sm" pattern="[0-9]{1,15}" placeholder="Ej. 000000000000000" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">PATRIMONIO:</small>
                        <input type="number" step="0.01" name="fiHeritage_Edit" maxlength="15" class="form-control form-control-sm" pattern="[0-9]{1,15}" placeholder="Ej. 000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">INDICE DE LIQUIDEZ:</small>
                        <input type="number" step="0.01" name="fiIndexsettlement_Edit" maxlength="7" class="form-control form-control-sm" pattern="[0-9.]{1,7}" placeholder="Ej. 0000.00" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">INDICE DE ENDEUDAMIENTO:</small>
                        <input type="number" step="0.01" name="fiIndexdebt_Edit" maxlength="7" class="form-control form-control-sm" pattern="[0-9.]{1,7}" placeholder="Ej. 0000.00" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">RAZON DE COBERTURA DE INTERESES:</small>
                        <input type="number" step="0.01" name="fiReasoncoverage_Edit" maxlength="7" class="form-control form-control-sm" pattern="[0-9.]{1,7}" placeholder="Ej. 0000.00" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">RENTABILIDAD DEL PATRIMONIO:</small>
                        <input type="number" step="0.01" name="fiProfitabilityheritage_Edit" maxlength="7" class="form-control form-control-sm" pattern="[0-9.]{1,7}" placeholder="Ej. 0000.00" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">RENTABILIDAD SOBRE ACTIVOS:</small>
                        <input type="number" step="0.01" name="fiProfitabilityactives_Edit" maxlength="7" class="form-control form-control-sm" pattern="[0-9.]{1,7}" placeholder="Ej. 0000.00" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="fiId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteFinancial-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h6 class="text-muted">CONFIRME ELIMINACION DE LA INFORMACION FINANCIERA</h6>
      </div>
      <div class="modal-body">
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('financial.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="fiId_Delete" value="" required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">CONFIRMAR</button>
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

  $('.newfinancial-link').on('click', function() {
    $('#newFinancial-modal').modal();
  });

  $('input[name=fiDateresolutionfacturation]').on('change', function(e) {
    var date = e.target.value;
    var mount = parseInt($('input[name=fiMountcountresolution]').val());
    $('input[name=fiDatefallresolution]').val('');
    if (date != '' && mount > 0) {
      var dateResult = new Date(date);
      var totalDays = 31 * parseInt(mount);
      var timeAdd = totalDays * 86400;
      dateResult.setSeconds(timeAdd);
      var dateComplete = dateResult.getFullYear() + "-" + getMount(dateResult.getMonth() + 1) + "-" + getDay(dateResult.getDate());
      $('input[name=fiDatefallresolution]').val(dateComplete);
    }
  });

  $('input[name=fiMountcountresolution]').on('keyup', function(e) {
    var mount = e.target.value;
    var date = $('input[name=fiDateresolutionfacturation]').val();
    if (mount != '' && date != '') {
      var dateResult = new Date(date);
      var totalDays = 31 * parseInt(mount);
      var timeAdd = totalDays * 86400;
      dateResult.setSeconds(timeAdd);
      var dateComplete = dateResult.getFullYear() + "-" + getMount(dateResult.getMonth() + 1) + "-" + getDay(dateResult.getDate());
      $('input[name=fiDatefallresolution]').val('');
      $('input[name=fiDatefallresolution]').val(dateComplete);
    }
  });

  $('.editFinancial-link').on('click', function(e) {
    e.preventDefault();
    var fiId = $(this).find('span:nth-child(2)').text();
    var fiRegime = $(this).find('span:nth-child(3)').text();
    var fiTaxpayer = $(this).find('span:nth-child(4)').text();
    var fiAutoretainer = $(this).find('span:nth-child(5)').text();
    var fiActivitys = $(this).find('span:nth-child(6)').text();
    var fiResolutionfacturation = $(this).find('span:nth-child(7)').text();
    var fiDateresolutionfacturation = $(this).find('span:nth-child(8)').text();
    var fiMountcountresolution = $(this).find('span:nth-child(9)').text();
    var fiDatefallresolution = $(this).find('span:nth-child(10)').text();
    var fiPrefix = $(this).find('span:nth-child(11)').text();
    var fiNumberinitial = $(this).find('span:nth-child(12)').text();
    var fiNumberfinal = $(this).find('span:nth-child(13)').text();
    var fiBank = $(this).find('span:nth-child(14)').text();
    var fiTypeaccount = $(this).find('span:nth-child(15)').text();
    var fiAccountnumber = $(this).find('span:nth-child(16)').text();
    var fiNotesone = $(this).find('span:nth-child(17)').text();
    var fiNotestwo = $(this).find('span:nth-child(18)').text();
    var fiNumberinitialfacturation = $(this).find('span:nth-child(19)').text();
    var fiNumberinitialvoucherentry = $(this).find('span:nth-child(20)').text();
    var fiNumberinitialvoucheregress = $(this).find('span:nth-child(21)').text();
    var fiCapitalwork = $(this).find('span:nth-child(22)').text();
    var fiHeritage = $(this).find('span:nth-child(23)').text();
    var fiIndexsettlement = $(this).find('span:nth-child(24)').text().replace(',', '');
    var fiIndexdebt = $(this).find('span:nth-child(25)').text().replace(',', '');
    var fiReasoncoverage = $(this).find('span:nth-child(26)').text().replace(',', '');
    var fiProfitabilityheritage = $(this).find('span:nth-child(27)').text().replace(',', '');
    var fiProfitabilityactives = $(this).find('span:nth-child(28)').text().replace(',', '');

    $('input[name=fiId_Edit]').val(fiId);
    $('select[name=fiRegime_Edit]').val(fiRegime);
    $('select[name=fiTaxpayer_Edit]').val(fiTaxpayer);
    $('select[name=fiAutoretainer_Edit]').val(fiAutoretainer);
    var separatedActivitys = fiActivitys.split('-');
    if (separatedActivitys[0] != 'N/A') {
      $('input[name=fiActivitys_one_Edit]').val(separatedActivitys[0]);
    } else {
      $('input[name=fiActivitys_one_Edit]').val('');
    }
    if (separatedActivitys[1] != 'N/A') {
      $('input[name=fiActivitys_two_Edit]').val(separatedActivitys[1]);
    } else {
      $('input[name=fiActivitys_two_Edit]').val('');
    }
    if (separatedActivitys[2] != 'N/A') {
      $('input[name=fiActivitys_three_Edit]').val(separatedActivitys[2]);
    } else {
      $('input[name=fiActivitys_three_Edit]').val('');
    }
    if (separatedActivitys[3] != 'N/A') {
      $('input[name=fiActivitys_four_Edit]').val(separatedActivitys[3]);
    } else {
      $('input[name=fiActivitys_four_Edit]').val('');
    }
    $('input[name=fiResolutionfacturation_Edit]').val(fiResolutionfacturation);
    $('input[name=fiDateresolutionfacturation_Edit]').val(fiDateresolutionfacturation);
    $('input[name=fiMountcountresolution_Edit]').val(fiMountcountresolution);
    $('input[name=fiDatefallresolution_Edit]').val(fiDatefallresolution);
    $('input[name=fiPrefix_Edit]').val(fiPrefix);
    $('input[name=fiNumberinitial_Edit]').val(fiNumberinitial);
    $('input[name=fiNumberfinal_Edit]').val(fiNumberfinal);
    $('input[name=fiBank_Edit]').val(fiBank);
    $('select[name=fiTypeaccount_Edit]').val(fiTypeaccount);
    $('input[name=fiAccountnumber_Edit]').val(fiAccountnumber);
    $('textarea[name=fiNotesone_Edit]').val(fiNotesone);
    $('textarea[name=fiNotestwo_Edit]').val(fiNotestwo);
    $('input[name=fiNumberinitialfacturation_Edit]').val(fiNumberinitialfacturation);
    $('input[name=fiNumberinitialvoucherentry_Edit]').val(fiNumberinitialvoucherentry);
    $('input[name=fiNumberinitialvoucheregress_Edit]').val(fiNumberinitialvoucheregress);
    $('input[name=fiCapitalwork_Edit]').val(fiCapitalwork);
    $('input[name=fiHeritage_Edit]').val(fiHeritage);
    $('input[name=fiIndexsettlement_Edit]').val(fiIndexsettlement);
    $('input[name=fiIndexdebt_Edit]').val(fiIndexdebt);
    $('input[name=fiReasoncoverage_Edit]').val(fiReasoncoverage);
    $('input[name=fiProfitabilityheritage_Edit]').val(fiProfitabilityheritage);
    $('input[name=fiProfitabilityactives_Edit]').val(fiProfitabilityactives);
    $('#editFinancial-modal').modal();
  });

  $('input[name=fiDateresolutionfacturation_Edit]').on('change', function(e) {
    var date = e.target.value;
    var mount = $('input[name=fiMountcountresolution_Edit]').val();
    if (date != '' && mount != '') {
      var dateResult = new Date(date);
      var totalDays = 31 * parseInt(mount);
      var timeAdd = totalDays * 86400;
      dateResult.setSeconds(timeAdd);
      var dateComplete = dateResult.getFullYear() + "-" + getMount(dateResult.getMonth() + 1) + "-" + getDay(dateResult.getDate());
      $('input[name=fiDatefallresolution_Edit]').val('');
      $('input[name=fiDatefallresolution_Edit]').val(dateComplete);
    }
  });

  $('input[name=fiMountcountresolution_Edit]').on('keyup', function(e) {
    var mount = parseInt(e.target.value);
    var date = $('input[name=fiDateresolutionfacturation_Edit]').val();
    $('input[name=fiDatefallresolution_Edit]').val('');
    if (mount > 0 && date != '') {
      var dateResult = new Date(date);
      var totalDays = 31 * parseInt(mount);
      var timeAdd = totalDays * 86400;
      dateResult.setSeconds(timeAdd);
      var dateComplete = dateResult.getFullYear() + "-" + getMount(dateResult.getMonth() + 1) + "-" + getDay(dateResult.getDate());
      $('input[name=fiDatefallresolution_Edit]').val(dateComplete);
    }
  });

  $('.deleteFinancial-link').on('click', function(e) {
    e.preventDefault();
    var fiId = $(this).find('span:nth-child(2)').text();
    $('input[name=fiId_Delete]').val(fiId);
    $('#deleteFinancial-modal').modal();
  });

  function getMount($numberMount) {
    return ($numberMount < 10 ? '0' : '') + $numberMount;
  }

  function getDay($numberDay) {
    return ($numberDay < 10 ? '0' : '') + $numberDay;
  }
</script>
@endsection