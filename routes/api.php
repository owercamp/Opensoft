<?php

use App\Models\AccidentControlAndAnalysis;
use App\Models\AnalysisMatrix;
use App\Models\AutoMotiveFleet;
use App\Models\BidirectionalCommunicationSystem;
use App\Models\Collaborator;
use App\Models\Commitee;
use App\Models\Configdocumentlogistic;
use App\Models\Configdocumentmanagerial;
use App\Models\LegalParent;
use App\Models\MatrixEPP;
use App\Models\PreventiveMaintenanceReview;
use App\Models\Procedure;
use App\Models\TrafficRegulationsViolation;
use App\Models\UserServiceProcedures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('route', 'Controller@function')->name('name');


// CONFIGURACION >> LUGARES >> CREACION DE NUEVAS ZONAS
// ADMINISTRATIVA >> CONFIGURACION DE EMPRESA >> INFORMACION JURIDICA

// Obtener los municipios a partir de un departamento seleccionado
Route::get('getMunicipalities', function (Request $request) {
  $municipalities = App\Models\Settingmunicipality::where('munDepartment_id', trim($request->depId))->orderBy('munName', 'asc')->get();
  return response()->json($municipalities);
})->name('getMunicipalities');

// Obtener las zonas a partir de un municipio seleccionado
Route::get('getZonings', function (Request $request) {
  $zonings = App\Models\Settingzoning::where('zonMunicipality_id', trim($request->munId))->get();
  return response()->json($zonings);
})->name('getZonings');

// Obtener las zonas a partir de un municipio seleccionado
Route::get('getNeighborhoods', function (Request $request) {
  $neighborhoods = App\Models\Settingneighborhood::where('neZoning_id', trim($request->zonId))->get();
  return response()->json($neighborhoods);
})->name('getNeighborhoods');

// Obtener los cursos por los ids recibidos
Route::get('getCourses', function (Request $request) {
  $separated = explode(',', trim($request->ids));
  $courses = array();
  for ($i = 0; $i < count($separated); $i++) {
    $separatedId = explode('>', $separated[$i]);
    $query = App\Models\Settingcourse::find($separatedId[0]);
    if ($query != null) {
      array_push($courses, [
        $query->couId,
        $query->couName,
        $query->couIntensity,
        $separatedId[1]
      ]);
    }
  }
  return response()->json($courses);
})->name('getCourses');

// Obtener los contratistas de mensajeria con un array o un id
Route::get('getContractormessenger', function (Request $request) {
  if ($request->unique == false) {
    $drivers = array();
    $query = App\Models\Contractormessenger::whereIn('cmId', $request->cmId)->get();
    foreach ($query as $q) {
      array_push($drivers, [
        $d->cmId,
        $d->cmNames,
        $d->cmNumberdocument,
        $d->cmNumberdriving
      ]);
    }
    return response()->json($drivers);
  } else {
    $driver = App\Models\Contractormessenger::find(trim($request->cmId));
    if ($driver != null) {
      return response()->json($driver);
    } else {
      return response()->json('N/A');
    }
  }
})->name('getContractormessenger');

// Obtener los contratistas de carga express con un array o un id
Route::get('getContractorcharge', function (Request $request) {
  if ($request->unique == false) {
    $drivers = array();
    $query = App\Models\Contractorcharge::whereIn('ccId', $request->ccId)->get();
    foreach ($query as $q) {
      array_push($drivers, [
        $d->ccId,
        $d->ccNames,
        $d->ccNumberdocument,
        $d->ccNumberdriving
      ]);
    }
    return response()->json($drivers);
  } else {
    $driver = App\Models\Contractorcharge::find(trim($request->ccId));
    if ($driver != null) {
      return response()->json($driver);
    } else {
      return response()->json('N/A');
    }
  }
})->name('getContractorcharge');

// Obtener los contratistas de servicios especiales con un array o un id
Route::get('getContractorespecial', function (Request $request) {
  if ($request->unique == false) {
    $drivers = array();
    $query = App\Models\Contractorespecial::whereIn('ceId', $request->ceId)->get();
    foreach ($query as $q) {
      array_push($drivers, [
        $d->ceId,
        $d->ceNames,
        $d->ceNumberdocument,
        $d->ceNumberdriving
      ]);
    }
    return response()->json($drivers);
  } else {
    $driver = App\Models\Contractorespecial::find(trim($request->ceId));
    if ($driver != null) {
      return response()->json($driver);
    } else {
      return response()->json('N/A');
    }
  }
})->name('getContractorespecial');

// Obtener los municipios con un array de ids o un id
Route::get('getMunicipalitiesFromTransfer', function (Request $request) {
  if ($request->unique == false) {
    $municipalities = array();
    $query = App\Models\Settingmunicipality::whereIn('munId', $request->munId)->get();
    foreach ($query as $q) {
      array_push($municipalities, [
        $d->munId,
        $d->munName
      ]);
    }
    return response()->json($municipalities);
  } else {
    $municipality = App\Models\Settingmunicipality::find(trim($request->munId));
    if ($municipality != null) {
      return response()->json($municipality);
    } else {
      return response()->json('N/A');
    }
  }
})->name('getMunicipalitiesFromTransfer');

// Obtener los seguimiento de cada oportunidad de negocio
Route::get('getBinnacles', function (Request $request) {
  $query = App\Models\Binnaclemarketing::where('bmMarketing_id', trim($request->marId))->get();
  return response()->json($query);
})->name('getBinnacles');

// Obtener los seguimiento de cada Licitación publica
Route::get('getBinnaclebiddings', function (Request $request) {
  $query = App\Models\Binnaclebidding::where('bbClientbidding_id', trim($request->cbiId))->get();
  return response()->json($query);
})->name('getBinnaclebiddings');

// Obtener los seguimiento de cada propuesta comercial
Route::get('getBinnacleproposals', function (Request $request) {
  $query = App\Models\Binnacleproposal::where('bpClientproposal_id', trim($request->cprId))->get();
  return response()->json($query);
})->name('getBinnacleproposals');

// Obtener los tipos de servicios de acuerdo al tipo de portafolio seleccionado en REGISTRO DE PROPUESTAS COMERCIALES
Route::get('getTypeservice', function (Request $request) {
  switch (trim($request->type)) {
    case 'Mensajería Express':
      // $query = App\Models\Settingservicemessenger::select('settingservicesmessenger.smId','settingservicesmessenger.smService')->get(); // Return => smId, smService
      $query = App\Models\Briefcasemessengerexpress::select(
        'briefcasemessengerexpress.*',
        'settingservicesmessenger.smId',
        'settingservicesmessenger.smService'
      )
        ->join('settingservicesmessenger', 'settingservicesmessenger.smId', 'briefcasemessengerexpress.bmeTypeservice_id')
        ->get(); // Return => bmeId, smId, smService, bmeValueratebase
      return response()->json($query);
      break;
    case 'Logística Express':
      $query = App\Models\Briefcaselogisticexpress::select(
        'briefcaselogisticexpress.*',
        'settingserviceslogistic.slId',
        'settingserviceslogistic.slService'
      )
        ->join('settingserviceslogistic', 'settingserviceslogistic.slId', 'briefcaselogisticexpress.bleTypeservice_id')
        ->get(); // Return => bleId, slId, slService, bleValueratebase
      return response()->json($query);
      break;
    case 'Carga Express':
      $query = App\Models\Briefcasechargeexpress::select(
        'briefcasechargeexpress.*',
        'settingservicescharge.scId',
        'settingservicescharge.scService',
        'settingheavys.heaId',
        'settingheavys.heaTypology'
      )
        ->join('settingheavys', 'settingheavys.heaId', 'briefcasechargeexpress.bceTypevehicle_id')
        ->join('settingservicescharge', 'settingservicescharge.scId', 'briefcasechargeexpress.bceTypeservice_id')
        ->get(); // Return => bceId, scId, scService, heaId, heaTypology, bceValueratebase
      return response()->json($query);
      break;
    case 'Turismo Pasajeros':
      $query = App\Models\Briefcaseturismexpress::select(
        'briefcaseturismexpress.*',
        'settingservicesturism.stId',
        'settingservicesturism.stService',
        'settingespecials.espId',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcaseturismexpress.bteTypevehicle_id')
        ->join('settingservicesturism', 'settingservicesturism.stId', 'briefcaseturismexpress.bteTypeservice_id')
        ->get(); // Return => bteId, stId, stService, espId, espTypology, bteValueratebase
      return response()->json($query);
      break;
    case 'Traslado Urbano':
      $query = App\Models\Briefcasetransferexpress::select(
        'briefcasetransferexpress.*',
        'settingservicestransfer.strId',
        'settingservicestransfer.strService',
        'settingespecials.espId',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcasetransferexpress.btreTypevehicle_id')
        ->join('settingservicestransfer', 'settingservicestransfer.strId', 'briefcasetransferexpress.btreTypeservice_id')
        ->get(); // Return => btreId, strId, strService, espId, espTypology, btreValueratebase
      return response()->json($query);
      break;
    case 'Traslado Intermunicipal':
      $query = App\Models\Briefcasetransferintermunicipality::select(
        'briefcasetransferintermunicipalities.*',
        'settingservicestransfermunicipals.stmId',
        'settingservicestransfermunicipals.stmService',
        'settingespecials.espId',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcasetransferintermunicipalities.btriTypevehicle_id')
        ->join('settingservicestransfermunicipals', 'settingservicestransfermunicipals.stmId', 'briefcasetransferintermunicipalities.btriTypeservice_id')
        ->get(); // Return => btriId, stmId, stmService, espId, espTypology, btriValuebase
      return response()->json($query);
      break;
  }
})->name('getTypeservice');

// Obtener los seguimiento de cada propuesta comercial
Route::get('getServiceproposal', function (Request $request) {
  switch (trim($request->type)) {
    case 'Mensajería Express':
      $query = App\Models\Briefcasemessengerexpress::select(
        'briefcasemessengerexpress.bmeValueratebase',
        'settingservicesmessenger.smService'
      )
        ->join('settingservicesmessenger', 'settingservicesmessenger.smId', 'briefcasemessengerexpress.bmeTypeservice_id')
        ->where('bmeId', trim($request->briefcase))
        ->where('bmeTypeservice_id', trim($request->service))
        ->first(); // Return => smService, bmeValueratebase
      return response()->json($query);
      break;
    case 'Logística Express':
      $query = App\Models\Briefcaselogisticexpress::select(
        'briefcaselogisticexpress.bleValueratebase',
        'settingserviceslogistic.slService'
      )
        ->join('settingserviceslogistic', 'settingserviceslogistic.slId', 'briefcaselogisticexpress.bleTypeservice_id')
        ->where('bleId', trim($request->briefcase))
        ->where('bleTypeservice_id', trim($request->service))
        ->first(); // Return => slService, bleValueratebase
      return response()->json($query);
      break;
    case 'Carga Express':
      $query = App\Models\Briefcasechargeexpress::select(
        'briefcasechargeexpress.bceValueratebase',
        'settingservicescharge.scService',
        'settingheavys.heaTypology'
      )
        ->join('settingheavys', 'settingheavys.heaId', 'briefcasechargeexpress.bceTypevehicle_id')
        ->join('settingservicescharge', 'settingservicescharge.scId', 'briefcasechargeexpress.bceTypeservice_id')
        ->where('bceId', trim($request->briefcase))
        ->where('bceTypeservice_id', trim($request->service))
        ->first(); // Return => scService, heaTypology, bceValueratebase
      return response()->json($query);
      break;
    case 'Turismo Pasajeros':
      $query = App\Models\Briefcaseturismexpress::select(
        'briefcaseturismexpress.bteValueratebase',
        'settingservicesturism.stService',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcaseturismexpress.bteTypevehicle_id')
        ->join('settingservicesturism', 'settingservicesturism.stId', 'briefcaseturismexpress.bteTypeservice_id')
        ->where('bteId', trim($request->briefcase))
        ->where('bteTypeservice_id', trim($request->service))
        ->first(); // Return => stService, espTypology, bteValueratebase
      return response()->json($query);
      break;
    case 'Traslado Urbano':
      $query = App\Models\Briefcasetransferexpress::select(
        'briefcasetransferexpress.btreValueratebase',
        'settingservicestransfer.strService',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcasetransferexpress.btreTypevehicle_id')
        ->join('settingservicestransfer', 'settingservicestransfer.strId', 'briefcasetransferexpress.btreTypeservice_id')
        ->where('btreId', trim($request->briefcase))
        ->where('btreTypeservice_id', trim($request->service))
        ->first(); // Return => strService, espTypology, btreValueratebase
      return response()->json($query);
      break;
    case 'Traslado Intermunicipal':
      $query = App\Models\Briefcasetransferintermunicipality::select(
        'briefcasetransferintermunicipalities.*',
        'settingservicestransfermunicipals.stmService',
        'settingespecials.espTypology'
      )
        ->join('settingespecials', 'settingespecials.espId', 'briefcasetransferintermunicipalities.btriTypevehicle_id')
        ->join('settingservicestransfermunicipals', 'settingservicestransfermunicipals.stmId', 'briefcasetransferintermunicipalities.btriTypeservice_id')
        ->where('btriId', trim($request->briefcase))
        ->where('btriTypeservice_id', trim($request->service))
        ->first(); // Return => stmService, espTypology, btriValuebase
      return response()->json($query);
      break;
  }
})->name('getServiceproposal');

// Obtener las variables del tipo de documento en SG-COMERCIAL
Route::get('getVariablesFromDocument', function (Request $request) {
  $query = App\Models\Variable::where('varDocument_id', trim($request->docId))->get();
  return response()->json($query);
})->name('getVariablesFromDocument');

// Obtener el contenido configurado de un documento a partir del id del documento en COMERCIAL >> CONTRATOS PERMANENTES >> LEGALIZACION
Route::get('getContentFromDocument', function (Request $request) {
  $query = App\Models\Configdocument::where('cdoDocument_id', trim($request->docId))->get();
  return response()->json($query);
})->name('getContentFromDocument');

// Obtener las variables del tipo de documento en SG-LOGISTICA
Route::get('getVariablesFromDocumentLogistic', function (Request $request) {
  $query = App\Models\Variablelogistic::where('valDocument_id', trim($request->dolId))->get();
  return response()->json($query);
})->name('getVariablesFromDocumentLogistic');

// Obtener las variables del tipo de documento en SG-GERENCIAL
Route::get('getVariablesFromDocumentManagerial', function (Request $request) {
  $query = App\Models\Variablemanagerial::where('valmDocument_id', trim($request->domId))->get();
  return response()->json($query);
})->name('getVariablesFromDocumentManagerial');

// Obtener las variables del tipo de documento en SG-OPERATIVA
Route::get('getVariablesFromDocumentOperative', function (Request $request) {
  $query = App\Models\Variableoperative::where('valODocument_id', trim($request->doOId))->get();
  return response()->json($query);
})->name('getVariablesFromDocumentOperative');

// Obtener las variables del tipo de documento en SG-MEJORA CONTINUA
Route::get('getVariablesFromDocumentImprovement', function (Request $request) {
  $query = App\Models\Variablesimprovement::where('valIDocument_id', trim($request->doIId))->get();
  return response()->json($query);
})->name('getVariablesFromDocumentImprovement');

// Obtener las variables del tipo de documento en SG-DOCUMENTAL
Route::get('getVariablesFromDocumentDocumentary', function (Request $request) {
  $query = App\Models\Variablesdocumentary::where('valdDocument_id', trim($request->dodId))->get();
  return response()->json($query);
})->name('getVariablesFromDocumentDocumentary');

// Obtener el contenido configurado de un documento a partir del id del documento en LOGISTICA >> COLABORADORES >> LEGALIZACION
Route::get('getContentFromDocumentLogistic', function (Request $request) {
  $query = App\Models\Configdocumentlogistic::where('cdlDocument_id', trim($request->dolId))->get();
  return response()->json($query);
})->name('getContentFromDocumentLogistic');

// Obtener la legalizacion de los colaboradores a partir del id del documento en LOGISTICA >> COLABORADORES >> ENTREGA DE DOTACIONES
Route::get('getLegalizationFromDocument', function (Request $request) {
  $query = App\Models\Legalizationcollaborator::select(
    'legalizationcollaborators.lccId',
    'billcollaborators.*',
    'collaborators.*',
    'settingpersonals.perName'
  )
    ->join('billcollaborators', 'billcollaborators.bcoId', 'legalizationcollaborators.lccBillcollaborator_id')
    ->join('collaborators', 'collaborators.coId', 'billcollaborators.bcoCollaborator_id')
    ->join('settingpersonals', 'settingpersonals.perId', 'collaborators.coPersonal_id')
    ->where('lccDocument_id', trim($request->dolId))
    ->where('lccStatus', 'VIGENTE')
    ->get();
  return response()->json($query);
})->name('getLegalizationFromDocument');

// Obtener el siguiente codigo de documento a guardar
Route::get('getNextcodeFromDocument', function (Request $request) {
  $validateLast = App\Models\Handbookcollaborator::select('handbookcollaborators.hcoDocumentcode')
    ->where('hcoDocument_id', trim($request->dolId))
    ->where('hcoStatus', 'VIGENTE')
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->hcoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeFromDocument');

function getFormatNumberNext($number)
{
  if ($number == 0) {
    $number++;
  }
  $long = strlen($number);
  if ($long >= 4) {
    return $number;
  } else if ($long == 3) {
    return '0' . $number;
  } else if ($long == 2) {
    return '00' . $number;
  } else if ($long == 1) {
    return '000' . $number;
  } else {
    return '0001';
  }
}

// Obtener el siguiente codigo de documento para las minutas
Route::get('getNextcodeForBill', function (Request $request) {
  $validateLast = App\Models\Billcollaborator::select('billcollaborators.bcoDocumentcode')
    ->where('bcoDocument_id', trim($request->dolId))
    ->where('bcoStatus', 'VIGENTE')
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->bcoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForBill');

// Obtener el siguiente codigo de documento para las entregas de dotaciones
Route::get('getNextcodeForEndowment', function (Request $request) {
  $validateLast = App\Models\Endowmentcollaborator::select('endowmentcollaborators.ecoDocumentcode')
    ->where('ecoDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->ecoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForEndowment');

// Obtener el siguiente codigo de documento para las entregas de dotaciones
Route::get('getNextcodeForTool', function (Request $request) {
  $validateLast = App\Models\Toolcollaborator::select('toolcollaborators.tcoDocumentcode')
    ->where('tcoDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->tcoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForTool');

// Obtener el siguiente codigo de documento para las notificaciones
Route::get('getNextcodeForNotification', function (Request $request) {
  $validateLast = App\Models\Notificationcollaborator::select('notificationcollaborators.ncoDocumentcode')
    ->where('ncoDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->ncoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForNotification');

// Obtener el siguiente codigo de documento para las asistencias y ausentismos del colaborador
Route::get('getNextcodeForControl', function (Request $request) {
  $validateLast = App\Models\Assistancecollaborator::select('assistancecollaborators.acoDocumentcode')
    ->where('acoDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->acoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForControl');

// Obtener el siguiente codigo de documento para las asistencias y ausentismos del colaborador
Route::get('getNextcodeForTraining', function (Request $request) {
  $validateLast = App\Models\Trainingcollaborator::select('trainingcollaborators.tcoDocumentcode')
    ->where('tcoDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->tcoDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForTraining');

// Obtener los colaboradores asistentes de una capacitación determinada
Route::get('getLegalizationFromTraining', function (Request $request) {
  $collaborators = App\Models\Binnacletrainingcollaborator::select('binnacletrainingcollaborators.btcTraining_id', 'billcollaborators.bcoId', 'collaborators.*')
    ->join('billcollaborators', 'billcollaborators.bcoId', 'binnacletrainingcollaborators.btcLegalization_id')
    ->join('collaborators', 'collaborators.coId', 'billcollaborators.bcoCollaborator_id')
    ->where('btcTraining_id', trim($request->tcoId))->get();
  return response()->json($collaborators);
})->name('getLegalizationFromTraining');

// Obtener el siguiente codigo de documento para los examenes de ingreso
Route::get('getNextcodeForEntrance', function (Request $request) {
  $validateLast = App\Models\Entranceexamcollaborator::select('entranceexamscollaborators.eecDocumentcode')
    ->where('eecDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->eecDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForEntrance');

// Obtener el siguiente codigo de documento para los examenes periódicos
Route::get('getNextcodeForExamperiod', function (Request $request) {
  $validateLast = App\Models\Examperiodcollaborator::select('examsperiodcollaborators.epcDocumentcode')
    ->where('epcDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->epcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForExamperiod');

// Obtener el siguiente codigo de documento para los examenes de egreso
Route::get('getNextcodeForExitexam', function (Request $request) {
  $validateLast = App\Models\Exitexamcollaborator::select('exitexamscollaborators.excDocumentcode')
    ->where('excDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->excDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForExitexam');

// Obtener el siguiente codigo de documento a guardar de contratistas
Route::get('getNextcodeFromDocumentContractor', function (Request $request) {
  $validateLast = App\Models\Handbookcontractor::select('handbookcontractors.hcDocumentcode')
    ->where('hcDocument_id', trim($request->dolId))
    ->where('hcStatus', 'VIGENTE')
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->hcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeFromDocumentContractor');

// Obtener el siguiente codigo de documento para las minutas de contratistas
Route::get('getNextcodeForBillContractor', function (Request $request) {
  $validateLast = App\Models\Billcontractor::select('billcontractors.bcDocumentcode')
    ->where('bcDocument_id', trim($request->dolId))
    ->where('bcStatus', 'VIGENTE')
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->bcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForBillContractor');

// Obtener el siguiente codigo de documento a guardar en CONTRATISTAS - CONVENIO DE COLABORACION EMPRESARIAL
Route::get('getNextcodeForAgreementcontractor', function (Request $request) {
  $validateLast = App\Models\Agreementcontractor::select('agreementcontractors.agcDocumentcode')
    ->where('agcDocument_id', trim($request->dolId))
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->agcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForAgreementcontractor');

// Obtener el siguiente codigo de documento a guardar en CONTRATISTAS - SEGUIMIENTO SEGURIDAD SOCIAL
Route::get('getNextcodeForTrackingcontractor', function (Request $request) {
  $validateLast = App\Models\Trackingsocialcontractor::select('trackingsocialcontractors.tcDocumentcode')
    ->where('tcDocument_id', trim($request->dolId))
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->tcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForTrackingcontractor');

// Obtener el siguiente codigo de documento a guardar en CONTRATISTAS - NOTIFICACIONES
Route::get('getNextcodeForNotificationcontractor', function (Request $request) {
  $validateLast = App\Models\Notificationcontractor::select('notificationcontractors.ncDocumentcode')
    ->where('ncDocument_id', trim($request->dolId))
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->ncDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForNotificationcontractor');

// Obtener el siguiente codigo de documento para las asistencias y ausentismos en CONTRATISTAS
Route::get('getNextcodeForControlcontractor', function (Request $request) {
  $validateLast = App\Models\Assistancecontractor::select('assistancecontractors.ascDocumentcode')
    ->where('ascDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->ascDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForControlcontractor');

// Obtener el siguiente codigo de documento para las asistencias y ausentismos EN CONTRATISTAS
Route::get('getNextcodeForTrainingcontractor', function (Request $request) {
  $validateLast = App\Models\Trainingcontractor::select('trainingcontractors.trcDocumentcode')
    ->where('trcDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->trcDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForTrainingcontractor');

// Obtener los colaboradores asistentes de una capacitación determinada
Route::get('getLegalizationFromTrainingcontractor', function (Request $request) {
  $binnacles = App\Models\Binnacletrainingcontractor::select('binnacletrainingcontractors.bicTraining_id', 'billcontractors.*')
    ->join('billcontractors', 'billcontractors.bcId', 'binnacletrainingcontractors.bicBillcontractor_id')
    ->where('bicTraining_id', trim($request->trcId))->get();
  $contractors = array();
  foreach ($binnacles as $binnacles) {
    if ($binnacles->bcTypecontractor == 'MENSAJERIA') {
      $contractormessenger = App\Models\Contractormessenger::find($binnacles->bcContractormessenger_id);
      if ($contractormessenger != null) {
        array_push($contractors, [
          $binnacles->bcId,
          $binnacles->bcTypecontractor,
          $contractormessenger->cmNames,
          $contractormessenger->cmNumberdocument
        ]);
      }
    } else if ($binnacles->bcTypecontractor == 'CARGA EXPRESS') {
      $contractorcharge = App\Models\Contractorcharge::find($binnacles->bcContractorcharge_id);
      if ($contractorcharge != null) {
        array_push($contractors, [
          $binnacles->bcId,
          $binnacles->bcTypecontractor,
          $contractorcharge->ccNames,
          $contractorcharge->ccNumberdocument
        ]);
      }
    } else if ($binnacles->bcTypecontractor == 'SERVICIO ESPECIAL') {
      $contractorespecial = App\Models\Contractorespecial::find($binnacles->bcContractorespecial_id);
      if ($contractorespecial != null) {
        array_push($contractors, [
          $binnacles->bcId,
          $binnacles->bcTypecontractor,
          $contractorespecial->ceNames,
          $contractorespecial->ceNumberdocument
        ]);
      }
    }
  }
  return response()->json($contractors);
})->name('getLegalizationFromTrainingcontractor');

// Obtener el siguiente codigo de documento para las minutas de PROVEEDORES
Route::get('getNextcodeForBillprovider', function (Request $request) {
  $validateLast = App\Models\Billprovider::select('billproviders.bpDocumentcode')
    ->where('bpDocument_id', trim($request->dolId))
    ->where('bpStatus', 'VIGENTE')
    ->get()->last();

  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->bpDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForBillprovider');

// Obtener el siguiente codigo de documento para las notificaciones
Route::get('getNextcodeForNotificationprovider', function (Request $request) {
  $validateLast = App\Models\Notificationprovider::select('notificationproviders.npDocumentcode')
    ->where('npDocument_id', trim($request->dolId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->npDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $documentlogistic = App\Models\Documentlogistic::find(trim($request->dolId));
    $codeSeparated = explode('-', $documentlogistic->dolCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForNotificationprovider');

// Obtener el siguiente codigo de documento para las ordenes de servicio de (COntratos ocasionales)
Route::get('getNextcodeForOrderoccasional', function (Request $request) {
  $validateLast = App\Models\Orderoccasional::select('orderoccasionals.oroDocumentcode')
    ->where('oroDocument_id', trim($request->docId))->get()->last();
  if ($validateLast != null) {
    $codeSeparated = explode('-', $validateLast->oroDocumentcode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  } else {
    $document = App\Models\Document::find(trim($request->docId));
    $codeSeparated = explode('-', $document->docCode);
    $number = (int)$codeSeparated[2] + 1;
    $next =  $codeSeparated[0] . '-' . $codeSeparated[1] . '-' . getFormatNumberNext($number);
  }
  return response()->json($next);
})->name('getNextcodeForOrderoccasional');

// Obtener los productos y servicios de los portafolios de acuerdo al cliente seleccionado
// en COMERIAL >> CONTRATOS OCASIONALES >> ORDEN DE SERVICIO
Route::get('getProposalFromOrderservice', function (Request $request) {
  $rows = array();
  $pos = strpos($request->briefcases, '<=|=>');
  if ($pos !== false) {
    $separated = explode('<=|=>', $request->briefcases);
    for ($i = 0; $i < count($separated); $i++) {
      $separatedItems = explode('=>', $separated[$i]);
      $result = getBriefcase($separatedItems[0], $separatedItems[1], $separatedItems[3]);
      if ($result !== false) {
        array_push($rows, $result);
      }
    }
  } else {
    $separatedItems = explode('=>', $request->briefcases);
    $result = getBriefcase($separatedItems[0], $separatedItems[1], $separatedItems[3]);
    if ($result !== false) {
      array_push($rows, $result);
    }
  }
  return response()->json($rows);
})->name('getProposalFromOrderservice');

function getBriefcase($type, $id, $veh)
{
  switch ($type) {
    case 'Mensajería Express':
      $query = App\Models\Briefcasemessengerexpress::where('bmeId', $id)->first();
      if ($query != null) {
        return [
          $query->bmeId,
          $type,
          $query->service->smId,
          $query->service->smService,
          $veh,
          $query->bmeValueratebase
        ];
      } else {
        return false;
      }
      break;
    case 'Logística Express':
      $query = App\Models\Briefcaselogisticexpress::where('bleId', $id)->first();
      if ($query != null) {
        return [
          $query->bleId,
          $type,
          $query->service->slId,
          $query->service->slService,
          $veh,
          $query->bleValueratebase
        ];
      } else {
        return false;
      }
      break;
    case 'Carga Express':
      $query = App\Models\Briefcasechargeexpress::where('bceId', $id)->first();
      if ($query != null) {
        if ($veh !== 'N/A') {
          $vehicle = App\Models\Settingheavy::find($veh);
          if ($vehicle !== null) {
            return [
              $query->bceId,
              $type,
              $query->service->scId,
              $query->service->scService,
              $vehicle->heaId . '-' . $vehicle->heaTypology,
              $query->bceValueratebase
            ];
          } else {
            return [
              $query->bceId,
              $type,
              $query->service->scId,
              $query->service->scService,
              $veh,
              $query->bceValueratebase
            ];
          }
        } else {
          return [
            $query->bceId,
            $type,
            $query->service->scId,
            $query->service->scService,
            $veh,
            $query->bceValueratebase
          ];
        }
      } else {
        return false;
      }
      break;
    case 'Turismo Pasajeros':
      $query = App\Models\Briefcaseturismexpress::where('bteId', $id)->first();
      if ($query != null) {
        if ($veh !== 'N/A') {
          $vehicle = App\Models\Settingespecial::find($veh);
          if ($vehicle !== null) {
            return [
              $query->bteId,
              $type,
              $query->service->stId,
              $query->service->stService,
              $vehicle->espId . '-' . $vehicle->espTypology,
              $query->bteValueratebase
            ];
          } else {
            return [
              $query->bteId,
              $type,
              $query->service->stId,
              $query->service->stService,
              $veh,
              $query->bteValueratebase
            ];
          }
        } else {
          return [
            $query->bteId,
            $type,
            $query->service->stId,
            $query->service->stService,
            $veh,
            $query->bteValueratebase
          ];
        }
      } else {
        return false;
      }
      break;
    case 'Traslado Urbano':
      $query = App\Models\Briefcasetransferexpress::where('btreId', $id)->first();
      if ($query != null) {
        if ($veh !== 'N/A') {
          $vehicle = App\Models\Settingespecial::find($veh);
          if ($vehicle !== null) {
            return [
              $query->btreId,
              $type,
              $query->service->strId,
              $query->service->strService,
              $vehicle->espId . '-' . $vehicle->espTypology,
              $query->btreValueratebase
            ];
          } else {
            return [
              $query->btreId,
              $type,
              $query->service->strId,
              $query->service->strService,
              $veh,
              $query->btreValueratebase
            ];
          }
        } else {
          return [
            $query->btreId,
            $type,
            $query->service->strId,
            $query->service->strService,
            $veh,
            $query->btreValueratebase
          ];
        }
      } else {
        return false;
      }
      break;
    case 'Traslado Intermunicipal':
      $query = App\Models\Briefcasetransferintermunicipality::where('btriId', $id)->first();
      if ($query != null) {
        if ($veh !== 'N/A') {
          $vehicle = App\Models\Settingespecial::find($veh);
          if ($vehicle !== null) {
            return [
              $query->btriId,
              $type,
              $query->service->stmId,
              $query->service->stmService,
              $vehicle->espId . '-' . $vehicle->espTypology,
              $query->btriValuebase
            ];
          } else {
            return [
              $query->btriId,
              $type,
              $query->service->stmId,
              $query->service->stmService,
              $veh,
              $query->btriValuebase
            ];
          }
        } else {
          return [
            $query->btriId,
            $type,
            $query->service->stmId,
            $query->service->stmService,
            $veh,
            $query->btriValuebase
          ];
        }
      } else {
        return false;
      }
      break;
    default:
      return false;
      break;
  }
}

// Obtener el contenido configurado de un documento a partir del id del documento en LOGISTICA >> COLABORADORES >> LEGALIZACION
Route::get('getContentFromDocumentComercial', function (Request $request) {
  $query = App\Models\Configdocument::where('cdoDocument_id', trim($request->docId))->get();
  return response()->json($query);
})->name('getContentFromDocumentComercial');

Route::post("getConfig", function (Request $request) {
  $query = Configdocumentmanagerial::where('cdmId', $request->id)->get();
  return response()->json($query);
})->name("getConfig");

Route::post("MinutesCommitee", function (Request $request) {
  $query = Commitee::where("comid", $request->id)->get();
  return response()->json($query);
})->name("MinutesCommitee");

Route::post("getRegister", function (Request $request) {
  $query = Procedure::where('pro_id', $request->data)->get();
  return response()->json($query);
})->name("getRegister");

Route::post("getSelect", function (Request $request) {
  $query = Configdocumentlogistic::where("cdlId", $request->data)
    ->join("documentslogistic", "documentslogistic.dolId", "configdocumentslogistic.cdlDocument_id")->get();
  return response()->json($query);
})->name("getSelect");

Route::post("getAutoMotor", function (Request $request) {
  $query = AutoMotiveFleet::where("amf_id", $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'auto_motive_fleets.amf_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getAutoMotor");

Route::post("getTraffic", function (Request $request) {
  $query = TrafficRegulationsViolation::where("trv_id", $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'traffic_regulations_violations.trv_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getTraffic");

Route::post("getReport", function (Request $request) {
  $query = AccidentControlAndAnalysis::where("aca_id", $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'accident_control_and_analyses.aca_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getReport");

Route::post("getProcedures", function (Request $request) {
  $query = UserServiceProcedures::where('usp_id', $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'user_service_procedures.usp_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getProcedures");

Route::post("getComunications", function (Request $request) {
  $query = BidirectionalCommunicationSystem::where('bcs_id', $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'bidirectional_communication_systems.bcs_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getComunications");

Route::post("getMaintenance", function (Request $request) {
  $query = PreventiveMaintenanceReview::where('pmr_id', $request->data)
    ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'preventive_maintenance_reviews.pmr_config')
    ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
  return response()->json($query);
})->name("getMaintenance");

// ?consulta para edita y eliminar la matriz legal
Route::post("apiLegal", function (Request $request) {
  $query = LegalParent::where("lp_id", $request->data)
    ->join('collaborators', 'collaborators.coId', "lp_collaborator")->get();
  return response()->json($query);
})->name("apiLegal");

// ?consulta para editar y eliminar analisis de matriz
Route::post('apiAnalysis', function (Request $request) {
  $query = AnalysisMatrix::where('am_id', $request->data)
    ->join('documentsmanagerial', 'documentsmanagerial.domId', 'analysis_matrices.amDoc')->get();
  return response()->json($query);
})->name('apiAnalysis');

// ?consulta para editar y eliminar matriz EPP
Route::post("apiMatrix", function (Request $request) {
  $query = MatrixEPP::where('me_id', $request->id)
    ->join('documentsmanagerial', 'documentsmanagerial.domId', 'matrix_e_p_p_s.meDoc')
    ->get();
  return response()->json($query);
})->name("apiMatrix");

// *consulta al usuario en la tabla de colaboradores
// *para motrarlo las referencias personales y labores 
// *anexadas
Route::post('apiCollaborator', function(Request $request){
  $query = Collaborator::where('coId',$request->data)->first();
  return response()->json($query);
})->name('apiCollaborator');
