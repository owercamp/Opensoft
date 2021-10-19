<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Collaborator;
use App\Models\Positioncollaborator;
use App\Models\Documentlogistic;
use App\Models\Variablelogistic;
use App\Models\Configdocumentlogistic;
use App\Models\Handbookcollaborator;
use App\Models\Billcollaborator;
use App\Models\Affiliationcollaborator;
use App\Models\Endowmentcollaborator;
use App\Models\Settingtechnical;
use App\Models\Settingrisk;
use App\Models\Settinghealth;
use App\Models\Settinglayoff;
use App\Models\Settingpension;
use App\Models\Settingcompensation;

use App\Models\Binnacletrainingcollaborator;
use App\Models\Notificationcollaborator;
use App\Models\Entranceexamcollaborator;
use App\Models\Assistancecollaborator;
use App\Models\Examperiodcollaborator;
use App\Models\Trainingcollaborator;
use App\Models\Exitexamcollaborator;
use App\Models\Toolcollaborator;


class CollaboratorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /* ===============================================================================================
			MODULO DE CREACION DE CARGOS DE (COLABORADORES)
    =============================================================================================== */

    function positionTo(){
        $positions = Positioncollaborator::all();
        return view('modules.collaborators.position.index',compact('positions'));
    }

    function savePosition(Request $request){
        // dd($request->all());
        $validate = Positioncollaborator::where('pcoName',$this::upper($request->pcoName))->first();
        if($validate == null){
            Positioncollaborator::create([
                'pcoName' => $this::upper($request->pcoName),
                'pcoObservation' => $this::fu($request->pcoObservation)
            ]);
            return redirect()->route('collaborators.position')->with('SuccessPosition', 'Cargo de colaborador ' . $this::upper($request->pcoName) . ', registrado');
        }else{
            return redirect()->route('collaborators.position')->with('SecondaryPosition', 'Ya existe el cargo escrito ' . $validate->pcoName);
        }
    }

    function updatePosition(Request $request){
        // dd($request->all());
        $validateOther = Positioncollaborator::where('pcoName',$this::upper($request->pcoName_Edit))
                                        ->where('pcoId','!=',trim($request->pcoId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Positioncollaborator::find(trim($request->pcoId_Edit));
            if($validate != null){
                $validate->pcoName = $this::upper($request->pcoName_Edit);
                $validate->pcoObservation = $this::fu($request->pcoObservation_Edit);
                $validate->save();
                return redirect()->route('collaborators.position')->with('PrimaryPosition', 'Cargo de colaborador ' . $this::upper($request->pcoName_Edit) . ', actualizado');
            }else{
                return redirect()->route('collaborators.position')->with('SecondaryPosition', 'No se encuentra cargo');
            }
        }else{
            return redirect()->route('collaborators.position')->with('SecondaryPosition', 'Ya existe el cargo escrito ' . $validateOther->pcoName);
        }
    }

    function deletePosition(Request $request){
        // dd($request->all());
        $foreign = Handbookcollaborator::where('hcoPosition_id',trim($request->pcoId_Delete))->where('hcoStatus','VIGENTE')->first();
        if($foreign == null){
            $validate = Positioncollaborator::find(trim($request->pcoId_Delete));
            if($validate != null){
                $name = $validate->pcoName;
                $validate->delete();
                return redirect()->route('collaborators.position')->with('WarningPosition', 'Cargo de colaborador ' . $name . ', eliminado');
            }else{
                return redirect()->route('collaborators.position')->with('SecondaryPosition', 'No se encuentra el cargo');
            }
        }else{
            return redirect()->route('collaborators.position')->with('SecondaryPosition', 'No es posible eliminar un cargo relacionado');
        }
    }

    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (COLABORADORES)
    =============================================================================================== */

    function hankbookTo(){
        $handbooks = Handbookcollaborator::where('hcoStatus','VIGENTE')->get();
        $positions = Positioncollaborator::all();
        $documents = Documentlogistic::all();
        return view('modules.collaborators.hankbook.index',compact('handbooks','positions','documents'));
    }

    function saveHankbook(Request $request){
        // dd($request->all());
        /*
            $request->hcoPosition_id
            $request->hcoDocument_id
            $request->dolCode
            $request->hcoConfigdocument_id
            $request->hcoTemplate
            $request->hcoVariables
        */
        $validate = Handbookcollaborator::where('hcoPosition_id',trim($request->hcoPosition_id))->where('hcoStatus','VIGENTE')->first();
        if($validate == null){
            $content = '';
            $variables = substr(trim($request->hcoVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
            $variablesSeparated = explode('!!==¡¡',$variables);
            for ($i=0; $i < count($variablesSeparated); $i++) { 
                $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
                $search = '';
                switch ($var[1]) {
                    case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                    case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                    case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                    case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                }
                if($i == 0){
                    $content = preg_replace($search, $var[0], trim($request->hcoTemplate),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            Handbookcollaborator::create([
                'hcoPosition_id' => trim($request->hcoPosition_id),
                'hcoDocument_id' => trim($request->hcoDocument_id),
                'hcoDocumentcode' => $this::upper($request->dolCode),
                'hcoConfigdocument_id' => trim($request->hcoConfigdocument_id),
                'hcoContentfinal' => $content,
                'hcoWrited' => $variables
            ]);
            $position = Positioncollaborator::find(trim($request->hcoPosition_id));
            return redirect()->route('collaborators.hankbook')->with('SuccessHandbook', 'Manual de funciones de ' . $position->pcoName . ', registrado');
        }else{
            return redirect()->route('collaborators.hankbook')->with('SecondaryHandbook', 'Ya existe un manual de funciones para ' . $validate->position->pcoName);
        }
    }

    function updateHankbook(Request $request){
        // dd($request->all());
        /*
            $request->pcoName_Edit
            $request->hcoDocument_id_Edit
            $request->hcoConfigdocument_id_Edit
            $request->hcoTemplate_Edit
            $request->hcoVariables_Edit
            $request->hcoId_Edit
        */
        $validate = Handbookcollaborator::find(trim($request->hcoId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->hcoVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
            $variablesSeparated = explode('!!==¡¡',$variables);
            for ($i=0; $i < count($variablesSeparated); $i++) { 
                $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
                $search = '';
                switch ($var[1]) {
                    case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                    case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                    case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                    case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                }
                if($i == 0){
                    $content = preg_replace($search, $var[0], trim($request->hcoTemplate_Edit),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            $validate->hcoDocument_id = trim($request->hcoDocument_id_Edit);
            $validate->hcoDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->hcoConfigdocument_id = trim($request->hcoConfigdocument_id_Edit);
            $validate->hcoContentfinal = $content;
            $validate->hcoWrited = $variables;
            $validate->save();
            return redirect()->route('collaborators.hankbook')->with('PrimaryHandbook', 'Manual de funciones para el cargo ' . trim($request->pcoName_Edit) . ', actualizado');
        }else{
            return redirect()->route('collaborators.hankbook')->with('SecondaryHandbook', 'No se encuentra el manual de funciones para ' . trim($request->pcoName_Edit));
        }
    }

    function deleteHankbook(Request $request){
        // dd($request->all());
        $validate = Handbookcollaborator::find(trim($request->hcoId_Delete));
        if($validate != null){
            $position = $validate->position->pcoName;
            $validate->hcoStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('collaborators.hankbook')->with('WarningHandbook', 'Manual de funciones para el cargo (' . $position . '), Finalizado');
        }else{
            return redirect()->route('collaborators.hankbook')->with('SecondaryHandbook', 'No se encuentra el manual de funciones');
        }
    }

    function pdfHandbook(Request $request){
        // dd($request->all());
        $handbook = Handbookcollaborator::find($request->hcoId);
        if($handbook != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Manual de función del cargo ' . $handbook->position->pcoName . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.hankbook.handbookPdf',compact('technical','handbook'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.hankbook')->with('SecondaryLegalization', 'No se encuentran el manual de funciones');
        }
    }

    /* ===============================================================================================
			MODULO DE MINUTA DE CONTRATO DE (COLABORADORES)
    =============================================================================================== */

    function billTo(){
        $bills = Billcollaborator::where('bcoStatus','VIGENTE')->where('bcoState','PENDIENTE')->get();
        $documents = Documentlogistic::all();
        $collaborators = Collaborator::all();
        return view('modules.collaborators.bill.index',compact('bills','documents','collaborators'));
    }

    function saveBill(Request $request){
        // dd($request->all());
        /*
            $request->bcoCollaborator_id
            $request->bcoDocument_id
            $request->dolCode
            $request->bcoConfigdocument_id
            $request->bcoTemplate
            $request->bcoVariables
        */
        // $validate = Billcollaborator::where('bcoCollaborator_id',trim($request->bcoCollaborator_id))->where('bcoDocument_id',trim($request->bcoDocument_id))->where('bcoStatus','VIGENTE')->first();
        $validate = Billcollaborator::where('bcoCollaborator_id',trim($request->bcoCollaborator_id))->where('bcoStatus','VIGENTE')->first();
        if($validate == null){
            $content = '';
            $variables = substr(trim($request->bcoVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
            $variablesSeparated = explode('!!==¡¡',$variables);
            for ($i=0; $i < count($variablesSeparated); $i++) { 
                $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
                $search = '';
                switch ($var[1]) {
                    case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                    case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                    case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                    case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                }
                if($i == 0){
                    $content = preg_replace($search, $var[0], trim($request->bcoTemplate),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            Billcollaborator::create([
                'bcoDocument_id' => trim($request->bcoDocument_id),
                'bcoDocumentcode' => $this::upper($request->dolCode),
                'bcoCollaborator_id' => trim($request->bcoCollaborator_id),
                'bcoConfigdocument_id' => trim($request->bcoConfigdocument_id),
                'bcoContentfinal' => $content,
                'bcoWrited' => $variables
            ]);
            $collaborator = Collaborator::find(trim($request->bcoCollaborator_id));
            return redirect()->route('collaborators.bill')->with('SuccessBill', 'Minuta de contrato de ' . $collaborator->coNames . ', registrada');
        }else{
            return redirect()->route('collaborators.bill')->with('SecondaryBill', 'Ya existe una minuta de contrato para ' . $validate->collaborator->coNames);
        }
    }

    function updateBill(Request $request){
        // dd($request->all());
        /*
            $request->coNames_Edit
            $request->bcoDocument_id_Edit
            $request->dolCode_Edit
            $request->bcoConfigdocument_id_Edit
            $request->bcoTemplate_Edit
            $request->bcoVariables_Edit
            $request->bcoId_Edit
        */
        $validate = Billcollaborator::find(trim($request->bcoId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->bcoVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
            $find = strpos($variables,'!!==¡¡');
            if($find === false){
                $var = explode('=>', $variables); // $var[0] = writed; $var[1] = type;
                $search = '';
                switch ($var[1]) {
                    case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                    case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                    case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                    case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                }
                $content = preg_replace($search, $var[0], trim($request->bcoTemplate_Edit),1);
            }else{
                $variablesSeparated = explode('!!==¡¡',$variables);
                for ($i=0; $i < count($variablesSeparated); $i++) { 
                    $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
                    $search = '';
                    switch ($var[1]) {
                        case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                        case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                        case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                        case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                    }
                    if($i == 0){
                        $content = preg_replace($search, $var[0], trim($request->bcoTemplate_Edit),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
            }
            $validate->bcoDocument_id = trim($request->bcoDocument_id_Edit);
            $validate->bcoDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->bcoConfigdocument_id = trim($request->bcoConfigdocument_id_Edit);
            $validate->bcoContentfinal = $content;
            $validate->bcoWrited = $variables;
            $validate->save();
            return redirect()->route('collaborators.bill')->with('PrimaryBill', 'Minuta de contrato para ' . trim($request->coNames_Edit) . ', actualizada');
        }else{
            return redirect()->route('collaborators.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato para ' . trim($request->coNames_Edit));
        }
    }

    function deleteBill(Request $request){
        // dd($request->all());
        $validate = Billcollaborator::find(trim($request->bcoId_Delete));
        if($validate != null){
            $collaborator = $validate->collaborator->coNames;
            $validate->bcoState = 'RECHAZADO';
            $validate->bcoStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('collaborators.bill')->with('WarningBill', 'Minuta de contrato para (' . $collaborator . '), Finalizada');
        }else{
            return redirect()->route('collaborators.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato');
        }
    }

    function aprovedBill(Request $request){
        // dd($request->all());
        $validate = Billcollaborator::find(trim($request->bcoId));
        if($validate != null){
            $collaborator = $validate->collaborator->coNames;
            $validate->bcoState = 'APROBADO';
            $validate->save();
            return redirect()->route('collaborators.bill')->with('SuccessBill', 'Minuta de contrato de (' . $collaborator . '), ¡APROBADA!');
        }else{
            return redirect()->route('collaborators.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato');
        }
    }

    function pdfBill(Request $request){
        // dd($request->all());
        $legalization = Billcollaborator::find($request->bcoId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Minuta de contrato de ' . $legalization->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.bill.billPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.bill')->with('SecondaryBill', 'No se encuentran la minuta de contrato');
        }
    }

    /* ===============================================================================================
			MODULO DE LEGALIZACION DE CONTRATO DE (COLABORADORES)
    =============================================================================================== */

    function legalizationTo(){
        $documents = Documentlogistic::all();
        $bills = Billcollaborator::whereIn('bcoStatus',['VIGENTE','TERMINADO'])->where('bcoState','APROBADO')->get();
        $collaborators = Billcollaborator::select('billcollaborators.bcoId','collaborators.coId','collaborators.coNames','collaborators.coNumberdocument')->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')->where('billcollaborators.bcoStatus','VIGENTE')->where('bcoState','APROBADO')->get();
        return view('modules.collaborators.legalization.index',compact('bills','documents','collaborators'));
    }

    function finishLegalization(Request $request){
        // dd($request->all());
        $validate = Billcollaborator::find(trim($request->bcoId_Finish));
        if($validate != null){
            $collaborator = $validate->collaborator->coNames;
            $validate->bcoStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('collaborators.legalization')->with('WarningLegalization', 'Legalización de contrato de (' . $collaborator . '), ¡FINALIZADO!');
        }else{
            return redirect()->route('collaborators.legalization')->with('SecondaryLegalization', 'No se encuentra la legalización de contrato');
        }
    }

    function pdfLegalization(Request $request){
        // dd($request->all());
        $legalization = Billcollaborator::find($request->bcoId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Legalización de contrato de ' . $legalization->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.legalization.legalizationPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.legalization')->with('SecondaryLegalization', 'No se encuentran la minuta de contrato');
        }
    }

    /* ===============================================================================================
			MODULO DE AFILIACIONES SEGURIDAD SOCIAL DE (COLABORADORES)
    =============================================================================================== */

    function affiliationsTo(){
        $affiliations = Affiliationcollaborator::all();
        $collaborators = Billcollaborator::select('billcollaborators.bcoId','collaborators.*')
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')->get();
        $healths = Settinghealth::all();
        $pensions = Settingpension::all();
        $layoffs = Settinglayoff::all();
        $risks = Settingrisk::all();
        $compensations = Settingcompensation::all();
        return view(
            'modules.collaborators.affiliations.index',
            compact(
                'affiliations',
                'collaborators',
                'healths',
                'pensions',
                'layoffs',
                'risks',
                'compensations'
            )
        );
    }

    function saveAffiliation(Request $request){
        // dd($request->all());
        /*
            $request->afcLegalization_id
            $request->afcHealth_id
            $request->afcPension_id
            $request->afcLayoff_id
            $request->afcRisk_id
            $request->afcCompensation_id
        */
        $validate = Affiliationcollaborator::where('afcLegalization_id',trim($request->afcLegalization_id))->first();
        if($validate == null){
            $new = Affiliationcollaborator::create([
                'afcLegalization_id' => trim($request->afcLegalization_id),
                'afcHealth_id' => trim($request->afcHealth_id),
                'afcPension_id' => trim($request->afcPension_id),
                'afcLayoff_id' => trim($request->afcLayoff_id),
                'afcRisk_id' => trim($request->afcRisk_id),
                'afcCompensation_id' => trim($request->afcCompensation_id)
            ]);
            // dd($new);
            return redirect()->route('collaborators.affiliations')->with('SuccessAffiliation', 'Afiliaciones del contrato de ' . $new->bill->collaborator->coNames . ', registradas');
        }else{
            return redirect()->route('collaborators.affiliations')->with('SecondaryAffiliation', 'Ya existe un registro de afiliaciones de ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateAffiliation(Request $request){
        // dd($request->all());
        /*
            $request->coNames_Edit
            $request->afcHealth_id_Edit
            $request->afcPension_id_Edit
            $request->afcLayoff_id_Edit
            $request->afcRisk_id_Edit
            $request->afcCompensation_id_Edit
            $request->afcId_Edit
        */
        $validate = Affiliationcollaborator::find(trim($request->afcId_Edit));
        if($validate != null){
            $validate->afcHealth_id = trim($request->afcHealth_id_Edit);
            $validate->afcPension_id = trim($request->afcPension_id_Edit);
            $validate->afcLayoff_id = trim($request->afcLayoff_id_Edit);
            $validate->afcRisk_id = trim($request->afcRisk_id_Edit);
            $validate->afcCompensation_id = trim($request->afcCompensation_id_Edit);
            $validate->save();
            return redirect()->route('collaborators.affiliations')->with('PrimaryAffiliation', 'Afiliaciones del contrato de ' . trim($request->coNames_Edit) . ', actualizadas');
        }else{
            return redirect()->route('collaborators.affiliations')->with('SecondaryAffiliation', 'No se encuentra las afiliaciones del contrato de ' . trim($request->coNames_Edit));
        }
    }

    function deleteAffiliation(Request $request){
        // dd($request->all());
        $validate = Affiliationcollaborator::find(trim($request->afcId_Delete));
        if($validate != null){
            $collaborator = $validate->bill->collaborator->coNames;
            $validate->delete();
            return redirect()->route('collaborators.affiliations')->with('WarningAffiliation', 'Afiliaciones del contrato de (' . $collaborator . '), Eliminadas');
        }else{
            return redirect()->route('collaborators.affiliations')->with('SecondaryAffiliation', 'No se encuentran las afiliaciones del contrato');
        }
    }

    /* ===============================================================================================
			MODULO DE DOTACIONES DE (COLABORADORES)
    =============================================================================================== */

    function endowmentsTo(){
        $endowments = Endowmentcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.bcoId',
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.endowments.index',compact('endowments','documents','legalizations'));
    }

    function saveEndowment(Request $request){
        // dd($request->all());
        /*
            $request->ecoDocument_id
            $request->ecoDocumentcode
            $request->dolCode
            $request->ecoLegalization_id
            $request->ecoDelivery
        */
        $validate = Endowmentcollaborator::where('ecoLegalization_id',trim($request->ecoLegalization_id))->where('ecoDocument_id',trim($request->ecoDocument_id))->first();
        if($validate == null){
            $new = Endowmentcollaborator::create([
                'ecoDocument_id' => trim($request->ecoDocument_id),
                'ecoDocumentcode' => $this::upper($request->dolCode),
                'ecoLegalization_id' => trim($request->ecoLegalization_id),
                'ecoDelivery' => $this::fu($request->ecoDelivery)
            ]);
            return redirect()->route('collaborators.endowments')->with('SuccessEndowment', 'Entrega de dotación de ' . $new->bill->collaborator->coNames . ', registrada');
        }else{
            return redirect()->route('collaborators.endowments')->with('SecondaryEndowment', 'Ya existe una entrega de dotación para ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateEndowment(Request $request){
        // dd($request->all());
        /*
            $request->coNames_Edit
            $request->ecoDelivery_Edit
            $request->ecoId_Edit
        */
        $validate = Endowmentcollaborator::find(trim($request->ecoId_Edit));
        if($validate != null){
            $validate->ecoDelivery = $this::fu($request->ecoDelivery_Edit);
            $validate->save();
            return redirect()->route('collaborators.endowments')->with('PrimaryEndowment', 'Entrega de dotación de ' . trim($request->coNames_Edit) . ', actualizada');
        }else{
            return redirect()->route('collaborators.endowments')->with('SecondaryEndowment', 'No se encuentra la entrega de dotación de ' . trim($request->coNames_Edit));
        }
    }

    function deleteEndowment(Request $request){
        $validate = Endowmentcollaborator::find(trim($request->ecoId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.endowments')->with('WarningEndowment', 'Entrega de dotación de (' . trim($request->coNames_Delete) . '), Eliminada');
        }else{
            return redirect()->route('collaborators.endowments')->with('SecondaryEndowment', 'No se encuentran la entrega de dotación de ' . trim($request->coNames_Delete));
        }
    }

    function pdfEndowment(Request $request){
        // dd($request->all());
        $endowment = Endowmentcollaborator::find($request->ecoId);
        if($endowment != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Entrega de dotación de ' . $endowment->bill->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.endowments.endowmentPdf',compact('technical','endowment'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.endowments')->with('SecondaryEndowment', 'No se encuentran la entrega de dotación');
        }
    }

    /* ===============================================================================================
			MODULO DE ENTREGA DE EQUIPOS Y HERRAMIENTA DE (COLABORADORES)
    =============================================================================================== */

    function toolsTo(){
        $tools = Toolcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.tools.index',compact('tools','documents','legalizations'));
    }

    function saveTool(Request $request){
        // dd($request->all());
        /*
            $request->tcoDocument_id
            $request->dolCode
            $request->tcoLegalization_id
            $request->tcoDelivery
        */
        // $validate = Toolcollaborator::where('tcoLegalization_id',trim($request->tcoLegalization_id))->where('tcoDocument_id',trim($request->tcoDocument_id))->first();
        // if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->tcoDate)));
            $new = Toolcollaborator::create([
                'tcoDate' => $date,
                'tcoDocument_id' => trim($request->tcoDocument_id),
                'tcoDocumentcode' => $this::upper($request->dolCode),
                'tcoLegalization_id' => trim($request->tcoLegalization_id),
                'tcoDelivery' => $this::fu($request->tcoDelivery)
            ]);
            return redirect()->route('collaborators.tools')->with('SuccessTool', 'Entrega de equipos y herramientas de ' . $new->bill->collaborator->coNames . ', registrada');
        // }else{
            // return redirect()->route('collaborators.tools')->with('SecondaryTool', 'Ya existe una entrega de equipos y herramientas para ' . $validate->bill->collaborator->coNames);
        // }
    }

    function updateTool(Request $request){
        // dd($request->all());
        /*
            $request->coNames_Edit
            $request->tcoDelivery_Edit
            $request->tcoDate_Edit
            $request->tcoId_Edit
        */
        $validate = Toolcollaborator::find(trim($request->tcoId_Edit));
        if($validate != null){
            $validate->tcoDelivery = $this::fu($request->tcoDelivery_Edit);
            $validate->tcoDate = trim($request->tcoDate_Edit);
            $validate->save();
            return redirect()->route('collaborators.tools')->with('PrimaryTool', 'Entrega de equipos y herramientas de ' . trim($request->coNames_Edit) . ', actualizada');
        }else{
            return redirect()->route('collaborators.tools')->with('SecondaryTool', 'No se encuentra la entrega de equipos y herramientas de ' . trim($request->coNames_Edit));
        }
    }

    function deleteTool(Request $request){
        // dd($request->all());
        $validate = Toolcollaborator::find(trim($request->tcoId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.tools')->with('WarningTool', 'Entrega de equipos y herramientas de (' . trim($request->coNames_Delete) . '), Eliminada');
        }else{
            return redirect()->route('collaborators.tools')->with('SecondaryTool', 'No se encuentran la entrega de equipos y herramientas de ' . trim($request->coNames_Delete));
        }
    }

    function pdfTool(Request $request){
        // dd($request->all());
        $tool = Toolcollaborator::find($request->tcoId);
        if($tool != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Entrega de equipos y herramientas de ' . $tool->bill->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.tools.toolPdf',compact('technical','tool'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.tools')->with('SecondaryTool', 'No se encuentran la entrega de equipos y herramientas');
        }
    }

    /* ===============================================================================================
			MODULO DE NOTIFICACIONES DE (COLABORADORES)
    =============================================================================================== */

    function notificationsTo(){
        $notifications = Notificationcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.notifications.index',compact('notifications','documents','legalizations'));
    }

    function saveNotification(Request $request){
        // dd($request->all());
        /*
            $request->ncoDocument_id
            $request->dolCode
            $request->ncoLegalization_id
            $request->ncoDate
            $request->ncoNotification
        */
        // $validate = Notificationcollaborator::where('ncoLegalization_id',trim($request->ncoLegalization_id))->where('ncoDocument_id',trim($request->ncoDocument_id))->first();
        // if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->ncoDate)));
            $new = Notificationcollaborator::create([
                'ncoDate' => $date,
                'ncoDocument_id' => trim($request->ncoDocument_id),
                'ncoDocumentcode' => $this::upper($request->dolCode),
                'ncoLegalization_id' => trim($request->ncoLegalization_id),
                'ncoNotification' => $this::fu($request->ncoNotification)
            ]);
            return redirect()->route('collaborators.notifications')->with('SuccessNotification', 'Registro de notificación de ' . $new->bill->collaborator->coNames . ', registrada');
        // }else{
            // return redirect()->route('collaborators.notifications')->with('SecondaryNotification', 'Ya existe una notificación para ' . $validate->bill->collaborator->coNames);
        // }
    }

    function updateNotification(Request $request){
        // dd($request->all());
        /*
            $request->coNames_Edit
            $request->ncoNotification_Edit
            $request->ncoDate_Edit
            $request->ncoId_Edit
        */
        $validate = Notificationcollaborator::find(trim($request->ncoId_Edit));
        if($validate != null){
            $validate->ncoNotification = $this::fu($request->ncoNotification_Edit);
            $validate->ncoDate = trim($request->ncoDate_Edit);
            $validate->save();
            return redirect()->route('collaborators.notifications')->with('PrimaryNotification', 'Registro de notificación de ' . trim($request->coNames_Edit) . ', actualizado');
        }else{
            return redirect()->route('collaborators.notifications')->with('SecondaryNotification', 'No se encuentra la notificación de ' . trim($request->coNames_Edit));
        }
    }

    function deleteNotification(Request $request){
        // dd($request->all());
        $validate = Notificationcollaborator::find(trim($request->ncoId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.notifications')->with('WarningNotification', 'Registro de notificación de (' . trim($request->coNames_Delete) . '), Eliminada');
        }else{
            return redirect()->route('collaborators.notifications')->with('SecondaryNotification', 'No se encuentran la notificación de ' . trim($request->coNames_Delete));
        }
    }

    function pdfNotification(Request $request){
        // dd($request->all());
        $notification = Notificationcollaborator::find($request->ncoId);
        if($notification != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Notificación de ' . $notification->bill->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.notifications.notificationPdf',compact('technical','notification'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.notifications')->with('SecondaryNotification', 'No se encuentran el registro de notificación');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTROL DE AUSENCIAS Y AUSENTISMOS DE (COLABORADORES)
    =============================================================================================== */

    function controlTo(){
        $controls = Assistancecollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.control.index',compact('controls','documents','legalizations'));
    }

    function saveControl(Request $request){
        // dd($request->all());
        /*
            $request->acoDocument_id
            $request->dolCode
            $request->acoLegalization_id
            $request->acoDate
            $request->acoAbsenteeism

            $request->acoHourentry
            $request->acoDescription_come

            $request->acoHourexit
            $request->acoDescription_out

            $request->acoDescription_not
        */
        $date = Date('Y-m-d',strtotime(trim($request->acoDate)));
        $validate = Assistancecollaborator::where('acoLegalization_id',trim($request->acoLegalization_id))->where('acoDate',$date)->first();
        if($validate == null){
            $hourentry = null;
            $hourexit = null;
            $description = null;
            switch ($this::upper($request->acoAbsenteeism)) {
                case 'NO ASISTIÓ':
                    $description = $this::fu($request->acoDescription_not);
                break;
                case 'LLEGÓ TARDE':
                    $hourentry = Date('h:i:s',strtotime(trim($request->acoHourentry)));
                    $description = $this::fu($request->acoDescription_come);
                break;
                case 'SALIÓ TEMPRANO':
                    $hourexit = Date('h:i:s',strtotime(trim($request->acoHourexit)));
                    $description = $this::fu($request->acoDescription_out);
                break;
            }
            $new = Assistancecollaborator::create([
                'acoDate' => $date,
                'acoDocument_id' => trim($request->acoDocument_id),
                'acoDocumentcode' => $this::upper($request->dolCode),
                'acoLegalization_id' => trim($request->acoLegalization_id),
                'acoAbsenteeism' => $this::upper($request->acoAbsenteeism),
                'acoHourentry' => $hourentry,
                'acoHourexit' => $hourexit,
                'acoDescription' => $description
            ]);
            return redirect()->route('collaborators.control')->with('SuccessControl', 'Registro de control de ' . $new->bill->collaborator->coNames . ', registrado');
        }else{
            return redirect()->route('collaborators.control')->with('SecondaryControl', 'Ya existe una reporte de asistencia en la fecha ' . $date . ' para ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateControl(Request $request){
        // dd($request->all());
        /*
            $request->acoDate_Edit
            $request->acoAbsenteeism_Edit
            $request->coNames_Edit
            $request->acoId_Edit

            $request->acoHourentry_Edit
            $request->acoDescription_come_Edit

            $request->acoHourexit_Edit
            $request->acoDescription_out_Edit

            $request->acoDescription_not_Edit
        */
        $validate = Assistancecollaborator::find(trim($request->acoId_Edit));
        if($validate != null){
            $hourentry = null;
            $hourexit = null;
            $description = null;
            switch ($this::upper($request->acoAbsenteeism_Edit)) {
                case 'NO ASISTIÓ':
                    $description = $this::fu($request->acoDescription_not_Edit);
                break;
                case 'LLEGÓ TARDE':
                    $hourentry = trim($request->acoHourentry_Edit) . ':00';
                    $description = $this::fu($request->acoDescription_come_Edit);
                break;
                case 'SALIÓ TEMPRANO':
                    $hourexit = trim($request->acoHourexit_Edit) . ':00';
                    $description = $this::fu($request->acoDescription_out_Edit);
                break;
                default:
                    $description = $this::fu($request->acoDescription_not_Edit);
                break;
            }
            $date = Date('Y-m-d',strtotime(trim($request->acoDate_Edit)));
            $validate->acoDate = $date;
            $validate->acoAbsenteeism = $this::upper($request->acoAbsenteeism_Edit);
            $validate->acoHourentry = $hourentry;
            $validate->acoHourexit = $hourexit;
            $validate->acoDescription = $description;
            $validate->save();
            return redirect()->route('collaborators.control')->with('PrimaryControl', 'Registro de control de ' . trim($request->coNames_Edit) . ', actualizado');
        }else{
            return redirect()->route('collaborators.control')->with('SecondaryControl', 'No se encuentra el control de ' . trim($request->coNames_Edit));
        }
    }

    function deleteControl(Request $request){
        // dd($request->all());
        $validate = Assistancecollaborator::find(trim($request->acoId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.control')->with('WarningControl', 'Registro de control de (' . trim($request->coNames_Delete) . '), Eliminado');
        }else{
            return redirect()->route('collaborators.control')->with('SecondaryControl', 'No se encuentran el control de ' . trim($request->coNames_Delete));
        }
    }

    function pdfControl(Request $request){
        // dd($request->all());
        $control = Assistancecollaborator::find($request->acoId);
        if($control != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Registro de ausentismo de ' . $control->bill->collaborator->coNames . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.control.controlPdf',compact('technical','control'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.control')->with('SecondaryControl', 'No se encuentran el registro de control');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTROL DE ASISTENCIA A CAPACITACIONES DE (COLABORADORES)
    =============================================================================================== */

    function trainingsTo(){
        $trainings = Trainingcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.*',
                                'collaborators.*'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.trainings.index',compact('trainings','documents','legalizations'));
    }

    function saveTraining(Request $request){
        // dd($request->all());
        /*
            $request->tcoDate
            $request->tcoDocument_id
            $request->dolCode
            $request->tcoNametraining
            $request->tcoNametrainer
            $request->allLegalizations
        */
        $validate = Trainingcollaborator::where('tcoNametraining',$this::upper($request->tcoNametraining))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->tcoDate)));
            $legalizations = substr(trim($request->allLegalizations),0,-1); // QUITAR EL ULTIMO CARACTER (=)
            $new = Trainingcollaborator::create([
                'tcoDate' => $date,
                'tcoDocument_id' => trim($request->tcoDocument_id),
                'tcoDocumentcode' => $this::upper($request->dolCode),
                'tcoNametraining' => $this::upper($request->tcoNametraining),
                'tcoNametrainer' => $this::upper($request->tcoNametrainer),
                'tcoLegalizations' => $legalizations
            ]);
            $find = strpos($legalizations,'=');
            if($find === false){
                Binnacletrainingcollaborator::create([
                    'btcTraining_id' => $new->tcoId,
                    'btcLegalization_id' => $legalizations
                ]);
            }else{
                $separatedLegalizations = explode('=',$legalizations);
                for ($i=0; $i < count($separatedLegalizations); $i++) { 
                    Binnacletrainingcollaborator::create([
                        'btcTraining_id' => $new->tcoId,
                        'btcLegalization_id' => $separatedLegalizations[$i]
                    ]);      
                }
            }
            return redirect()->route('collaborators.trainings')->with('SuccessTraining', 'Registro de capacitación (' . $this::upper($request->tcoNametraining) . '), registrada');
        }else{
            return redirect()->route('collaborators.trainings')->with('SecondaryTraining', 'Ya existe una capacitación con nombre ' . $this::upper($request->tcoNametraining));
        }
    }

    function updateTraining(Request $request){
        // dd($request->all());
        /*
            $request->tcoDate_Edit
            $request->tcoNametraining_Edit
            $request->tcoNametrainer_Edit
            $request->tcoDocument_id_Edit
            $request->dolCode_Edit
            $request->allLegalizations_Edit
            $request->tcoId_Edit
        */
        $validate = Trainingcollaborator::find(trim($request->tcoId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->tcoDate_Edit)));
            $legalizations = substr(trim($request->allLegalizations_Edit),0,-1); // QUITAR EL ULTIMO CARACTER (=)
            $validate->tcoDate = $date;
            $validate->tcoDocument_id = trim($request->tcoDocument_id_Edit);
            $validate->tcoDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->tcoNametraining = $this::upper($request->tcoNametraining_Edit);
            $validate->tcoNametrainer = $this::upper($request->tcoNametrainer_Edit);
            $validate->tcoLegalizations = $legalizations;
            $newLegalizations = array();
            $find = strpos($legalizations,'=');
            if($find === false){
                $validateRegister = Binnacletrainingcollaborator::where('btcTraining_id',$validate->tcoId)
                                        ->where('btcLegalization_id',$legalizations)
                                        ->first();
                if($validateRegister == null){
                    Binnacletrainingcollaborator::create([
                        'btcTraining_id' => $validate->tcoId,
                        'btcLegalization_id' => $legalizations
                    ]);
                }
                array_push($newLegalizations,$legalizations);
            }else{
                $separatedLegalizations = explode('=',$legalizations);
                for ($i=0; $i < count($separatedLegalizations); $i++) { 
                    $validateRegister = Binnacletrainingcollaborator::where('btcTraining_id',$validate->tcoId)
                                            ->where('btcLegalization_id',$separatedLegalizations[$i])
                                            ->first();
                    if($validateRegister == null){
                        Binnacletrainingcollaborator::create([
                            'btcTraining_id' => $validate->tcoId,
                            'btcLegalization_id' => $separatedLegalizations[$i]
                        ]);
                    }
                    array_push($newLegalizations,$separatedLegalizations[$i]);
                }
            }
            // SE ELIMINAN LOS COLABORADORES ASISTIDOS QUE NO ESTEN EN LA LISTA DE ASISTENTES ACTUALIZADA
            $validateDelete = Binnacletrainingcollaborator::where('btcTraining_id',$validate->tcoId)
                                        ->whereNotIn('btcLegalization_id',$newLegalizations)
                                        ->get();
            foreach ($validateDelete as $not) {
                $not->delete();
            }
            // SE GUARDAN CAMBIOS DE CAPACITACION
            $validate->save();
            return redirect()->route('collaborators.trainings')->with('PrimaryTraining', 'Registro de capacitación (' . $this::upper($request->tcoNametraining_Edit) . '), actualizado');
        }else{
            return redirect()->route('collaborators.trainings')->with('SecondaryTraining', 'No se encuentra la capacitación (' . $this::upper($request->tcoNametraining_Edit) . ')');
        }
    }

    function deleteTraining(Request $request){
        // dd($request->all());
        $validate = Trainingcollaborator::find(trim($request->tcoId_Delete));
        if($validate != null){
            // SE ELIMINAN LOS COLABORADORES ASISTIDOS QUE NO ESTEN EN LA LISTA DE ASISTENTES ACTUALIZADA
            $validateDelete = Binnacletrainingcollaborator::where('btcTraining_id',$validate->tcoId)->get();
            foreach ($validateDelete as $not) {
                $not->delete();
            }
            $trainingName = $validate->tcoNametraining;
            $validate->delete();
            return redirect()->route('collaborators.trainings')->with('WarningTraining', 'Registro de capacitación (' . $trainingName . '), Eliminado');
        }else{
            return redirect()->route('collaborators.trainings')->with('SecondaryTraining', 'No se encuentran la capacitación');
        }
    }

    function pdfTraining(Request $request){
        // dd($request->all());
        $training = Trainingcollaborator::find($request->tcoId);
        if($training != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $binnacles = Binnacletrainingcollaborator::where('btcTraining_id',$training->tcoId)->get();
            $namefile = 'Registro de asistencia capacitación (' . $training->tcoNametraining . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.trainings.trainingPdf',compact('technical','training','binnacles'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.trainings')->with('SecondaryTraining', 'No se encuentran el registro de capacitación');
        }
    }

    /* ===============================================================================================
			MODULO DE EXAMENES DE INGRESO DE (COLABORADORES)
    =============================================================================================== */

    function entranceexamsTo(){
        $entranceexams = Entranceexamcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.bcoId',
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.entranceexams.index',compact('entranceexams','documents','legalizations'));
    }

    function saveEntranceexam(Request $request){
        // dd($request->all());
        /*
            $request->eecDate
            $request->eecDocument_id
            $request->dolCode
            $request->eecLegalization_id
            $request->eecCenter
            $request->eecObservation
        */
        $validate = Entranceexamcollaborator::where('eecLegalization_id',trim($request->eecLegalization_id))->where('eecDocument_id',trim($request->eecDocument_id))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->eecDate)));
            $new = Entranceexamcollaborator::create([
                'eecDate' => $date,
                'eecDocument_id' => trim($request->eecDocument_id),
                'eecDocumentcode' => $this::upper($request->dolCode),
                'eecLegalization_id' => trim($request->eecLegalization_id),
                'eecCenter' => $this::upper($request->eecCenter),
                'eecObservation' => $this::fu($request->eecObservation)
            ]);
            return redirect()->route('collaborators.entranceexams')->with('SuccessEntrance', 'Examen de ingreso de (' . $new->bill->collaborator->coNames . '), registrado');
        }else{
            return redirect()->route('collaborators.entranceexams')->with('SecondaryEntrance', 'Ya existe un examen de ingreso para ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateEntranceexam(Request $request){
        // dd($request->all());
        /*
            $request->eecDate_Edit
            $request->eecCenter_Edit
            $request->eecObservation_Edit
            $request->coNames_Edit
            $request->eecId_Edit
        */
        $validate = Entranceexamcollaborator::find(trim($request->eecId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->eecDate_Edit)));
            $validate->eecDate = $date;
            $validate->eecCenter = $this::upper($request->eecCenter_Edit);
            $validate->eecObservation = $this::fu($request->eecObservation_Edit);
            $validate->save();
            return redirect()->route('collaborators.entranceexams')->with('PrimaryEntrance', 'Examen de ingreso de (' . trim($request->coNames_Edit) . '), actualizado');
        }else{
            return redirect()->route('collaborators.entranceexams')->with('SecondaryEntrance', 'No se encuentra el examen de ingreso de ' . trim($request->coNames_Edit));
        }
    }

    function deleteEntranceexam(Request $request){
        // dd($request->all());
        $validate = Entranceexamcollaborator::find(trim($request->eecId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.entranceexams')->with('WarningEntrance', 'Examen de ingreso de (' . trim($request->coNames_Delete) . '), Eliminado');
        }else{
            return redirect()->route('collaborators.entranceexams')->with('SecondaryEntrance', 'No se encuentran el examen de ingreso de (' . trim($request->coNames_Delete) . ')');
        }
    }

    function pdfEntranceexam(Request $request){
        // dd($request->all());
        $entrance = Entranceexamcollaborator::find($request->eecId);
        if($entrance != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Examen de ingreso de (' . $entrance->bill->collaborator->coNames . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.entranceexams.entranceexamPdf',compact('technical','entrance'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.entranceexams')->with('SecondaryEntrance', 'No se encuentran el examen de ingreso');
        }
    }

    /* ===============================================================================================
			MODULO DE EXAMENES PERIODICOS DE (COLABORADORES)
    =============================================================================================== */

    function examsperiodsTo(){
        $examperiods = Examperiodcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.bcoId',
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.examsperiods.index',compact('examperiods','documents','legalizations'));
    }

    function saveExamsperiod(Request $request){
        // dd($request->all());
        /*
            $request->epcDate
            $request->epcDocument_id
            $request->dolCode
            $request->epcLegalization_id
            $request->epcCenter
            $request->epcObservation
        */
        $validate = Examperiodcollaborator::where('epcLegalization_id',trim($request->epcLegalization_id))->where('epcDocument_id',trim($request->epcDocument_id))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->epcDate)));
            $new = Examperiodcollaborator::create([
                'epcDate' => $date,
                'epcDocument_id' => trim($request->epcDocument_id),
                'epcDocumentcode' => $this::upper($request->dolCode),
                'epcLegalization_id' => trim($request->epcLegalization_id),
                'epcCenter' => $this::upper($request->epcCenter),
                'epcObservation' => $this::fu($request->epcObservation)
            ]);
            return redirect()->route('collaborators.examsperiods')->with('SuccessExamperiod', 'Examen periódico de (' . $new->bill->collaborator->coNames . '), registrado');
        }else{
            return redirect()->route('collaborators.examsperiods')->with('SecondaryExamperiod', 'Ya existe un examen periódico para ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateExamsperiod(Request $request){
        // dd($request->all());
        /*
            $request->eecDate_Edit
            $request->eecCenter_Edit
            $request->eecObservation_Edit
            $request->coNames_Edit
            $request->eecId_Edit
        */
        $validate = Examperiodcollaborator::find(trim($request->epcId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->epcDate_Edit)));
            $validate->epcDate = $date;
            $validate->epcCenter = $this::upper($request->epcCenter_Edit);
            $validate->epcObservation = $this::fu($request->epcObservation_Edit);
            $validate->save();
            return redirect()->route('collaborators.examsperiods')->with('PrimaryExamperiod', 'Examen periódico de (' . trim($request->coNames_Edit) . '), actualizado');
        }else{
            return redirect()->route('collaborators.examsperiods')->with('SecondaryExamperiod', 'No se encuentra el examen periódico de ' . trim($request->coNames_Edit));
        }
    }

    function deleteExamsperiod(Request $request){
        // dd($request->all());
        $validate = Examperiodcollaborator::find(trim($request->epcId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.examsperiods')->with('WarningExamperiod', 'Examen periódico de (' . trim($request->coNames_Delete) . '), Eliminado');
        }else{
            return redirect()->route('collaborators.examsperiods')->with('SecondaryExamperiod', 'No se encuentran el examen periódico de (' . trim($request->coNames_Delete) . ')');
        }
    }

    function pdfExamsperiod(Request $request){
        // dd($request->all());
        $examperiod = Examperiodcollaborator::find($request->epcId);
        if($examperiod != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Examen periódico de (' . $examperiod->bill->collaborator->coNames . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.examsperiods.examsperiodPdf',compact('technical','examperiod'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.examsperiods')->with('SecondaryExamperiod', 'No se encuentran el examen periódico');
        }
    }

    /* ===============================================================================================
			MODULO DE EXAMENES DE EGRESO DE (COLABORADORES)
    =============================================================================================== */

    function exitexamsTo(){
        $exitexams = Exitexamcollaborator::all();
        $documents = Documentlogistic::all();
        $legalizations = Billcollaborator::select(
                                'billcollaborators.bcoId',
                                'billcollaborators.*',
                                'collaborators.*',
                                'settingpersonals.perName'
                            )
                            ->join('collaborators','collaborators.coId','billcollaborators.bcoCollaborator_id')
                            ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                            ->where('bcoStatus','VIGENTE')->where('bcoState','APROBADO')
                            ->get();
        return view('modules.collaborators.exitexams.index',compact('exitexams','documents','legalizations'));
    }

    function saveExitexam(Request $request){
        // dd($request->all());
        /*
            $request->excDate
            $request->excDocument_id
            $request->dolCode
            $request->excLegalization_id
            $request->excCenter
            $request->excObservation
        */
        $validate = Exitexamcollaborator::where('excLegalization_id',trim($request->excLegalization_id))->where('excDocument_id',trim($request->excDocument_id))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->excDate)));
            $new = Exitexamcollaborator::create([
                'excDate' => $date,
                'excDocument_id' => trim($request->excDocument_id),
                'excDocumentcode' => $this::upper($request->dolCode),
                'excLegalization_id' => trim($request->excLegalization_id),
                'excCenter' => $this::upper($request->excCenter),
                'excObservation' => $this::fu($request->excObservation)
            ]);
            return redirect()->route('collaborators.exitexams')->with('SuccessExit', 'Examen de egreso de (' . $new->bill->collaborator->coNames . '), registrado');
        }else{
            return redirect()->route('collaborators.exitexams')->with('SecondaryExit', 'Ya existe un examen de egreso para ' . $validate->bill->collaborator->coNames);
        }
    }

    function updateExitexam(Request $request){
        // dd($request->all());
        /*
            $request->excDate_Edit
            $request->excCenter_Edit
            $request->excObservation_Edit
            $request->coNames_Edit
            $request->excId_Edit
        */
        $validate = Exitexamcollaborator::find(trim($request->excId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->excDate_Edit)));
            $validate->excDate = $date;
            $validate->excCenter = $this::upper($request->excCenter_Edit);
            $validate->excObservation = $this::fu($request->excObservation_Edit);
            $validate->save();
            return redirect()->route('collaborators.exitexams')->with('PrimaryExit', 'Examen de egreso de (' . trim($request->coNames_Edit) . '), actualizado');
        }else{
            return redirect()->route('collaborators.exitexams')->with('SecondaryExit', 'No se encuentra el examen de egreso de ' . trim($request->coNames_Edit));
        }
    }

    function deleteExitexam(Request $request){
        // dd($request->all());
        $validate = Exitexamcollaborator::find(trim($request->excId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('collaborators.exitexams')->with('WarningExit', 'Examen de egreso de (' . trim($request->coNames_Delete) . '), Eliminada');
        }else{
            return redirect()->route('collaborators.exitexams')->with('SecondaryExit', 'No se encuentran el examen de egreso de (' . trim($request->coNames_Delete) . ')');
        }
    }

    function pdfExitexam(Request $request){
        // dd($request->all());
        $exitexam = Exitexamcollaborator::find($request->excId);
        if($exitexam != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Examen de egreso de (' . $exitexam->bill->collaborator->coNames . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.collaborators.exitexams.exitexamPdf',compact('technical','exitexam'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.exitexams')->with('SecondaryExit', 'No se encuentran el examen de egrso');
        }
    }

    /* ===============================================================================================
            MODULO DE EVALUACION DE DESEMPEÑO DE (COLABORADORES)
    =============================================================================================== */

    function testsTo(){
        return view('modules.collaborators.tests.index');
    }
}
