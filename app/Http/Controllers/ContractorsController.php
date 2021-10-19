<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Binnacletrainingcontractor;
use App\Models\Trackingsocialcontractor;
use App\Models\Notificationcontractor;
use App\Models\Assistancecontractor;
use App\Models\Activationcontractor;
use App\Models\Agreementcontractor;
use App\Models\Contractormessenger;
use App\Models\Contractorespecial;
use App\Models\Handbookcontractor;
use App\Models\Trainingcontractor;
use App\Models\Contractorcharge;
use App\Models\Settingtechnical;
use App\Models\Documentlogistic;
use App\Models\Billcontractor;
use App\Models\Alliesmessenger;
use App\Models\Alliesespecial;
use App\Models\Alliescharge;

class ContractorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (CONTRATISTAS)
    =============================================================================================== */

    function handbookTo(){
        $documents = Documentlogistic::all();
        $handbooks = Handbookcontractor::where('hcStatus','VIGENTE')->get();
        return view('modules.contractors.hankbook.index',compact('documents','handbooks'));
    }

    function saveHandbook(Request $request){
        // dd($request->all());
        /*
            $request->hcDocument_id
            $request->dolVersion
            $request->dolCode
            $request->hcConfigdocument_id
            $request->hcTemplate
            $request->hcVariables
        */
        $content = '';
        $variables = substr(trim($request->hcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                $content = preg_replace($search, $var[0], trim($request->hcTemplate),1);
            }else{
                $content = preg_replace($search, $var[0], $content,1);
            }
        }
        Handbookcontractor::create([
            'hcDocument_id' => trim($request->hcDocument_id),
            'hcDocumentcode' => $this::upper($request->dolCode),
            'hcConfigdocument_id' => trim($request->hcConfigdocument_id),
            'hcContentfinal' => $content,
            'hcWrited' => $variables
        ]);
        return redirect()->route('contractors.handbook')->with('SuccessHandbook', 'Manual de funciones de contratista, registrado');
    }

    function updateHandbook(Request $request){
        // dd($request->all());
        /*
            $request->hcDocument_id_Edit
            $request->dolCode_Edit
            $request->hcConfigdocument_id_Edit
            $request->hcTemplate_Edit
            $request->hcVariables_Edit
            $request->hcId_Edit
        */
        $validate = Handbookcontractor::find(trim($request->hcId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->hcVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                    $content = preg_replace($search, $var[0], trim($request->hcTemplate_Edit),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            $validate->hcDocument_id = trim($request->hcDocument_id_Edit);
            $validate->hcDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->hcConfigdocument_id = trim($request->hcConfigdocument_id_Edit);
            $validate->hcContentfinal = $content;
            $validate->hcWrited = $variables;
            $validate->save();
            return redirect()->route('contractors.handbook')->with('PrimaryHandbook', 'Manual de funciones, actualizado');
        }else{
            return redirect()->route('contractors.handbook')->with('SecondaryHandbook', 'No se encuentra el manual de funciones');
        }
    }

    function deleteHandbook(Request $request){
        // dd($request->all());
        $validate = Handbookcontractor::find(trim($request->hcId_Delete));
        if($validate != null){
            $validate->hcStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('contractors.handbook')->with('WarningHandbook', 'Manual de funciones, Finalizado');
        }else{
            return redirect()->route('contractors.handbook')->with('SecondaryHandbook', 'No se encuentra el manual de funciones');
        }
    }

    function pdfHandbook(Request $request){
        // dd($request->all());
        $handbook = Handbookcontractor::find($request->hcId);
        if($handbook != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Manual de funciónes de contratistas descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.hankbook.handbookPdf',compact('technical','handbook'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.handbook')->with('SecondaryHandbook', 'No se encuentran el manual de funciones');
        }
    }

    /* ===============================================================================================
			MODULO DE MINUTA DE CONTRATO DE (CONTRATISTAS)
    =============================================================================================== */

    function billTo(){
        $documents = Documentlogistic::all();
        $contractorcharges = Contractorcharge::all();
        $contractorespecials = Contractorespecial::all();
        $contractormessengers = Contractormessenger::all();
        $bills = Billcontractor::where('bcStatus','VIGENTE')->where('bcState','PENDIENTE')->get();
        return view('modules.contractors.bill.index',compact('bills','documents','contractormessengers','contractorcharges','contractorespecials'));
    }

    function saveBill(Request $request){
        // dd($request->all());
        /*
            $request->bcTypecontractor          // MENSAJERIA, CARGA EXPRESS, SERVICIO ESPECIAL
            $request->bcContractorcharge_id
            $request->bcContractorespecial_id
            $request->bcContractormessenger_id
            $request->bcDocument_id
            $request->dolVersion
            $request->dolCode
            $request->bcConfigdocument_id
            $request->bcTemplate
            $request->bcVariables
        */
        if(trim($request->bcTypecontractor) == 'MENSAJERIA'){
            $validate = Billcontractor::where('bcContractormessenger_id',trim($request->bcContractormessenger_id))->where('bcStatus','VIGENTE')->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->bcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->bcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Billcontractor::create([
                    'bcDocument_id' => trim($request->bcDocument_id),
                    'bcDocumentcode' => $this::upper($request->dolCode),
                    'bcTypecontractor' => trim($request->bcTypecontractor),
                    'bcContractormessenger_id' => trim($request->bcContractormessenger_id),
                    'bcContractorcharge_id' => null,
                    'bcContractorespecial_id' => null,
                    'bcConfigdocument_id' => trim($request->bcConfigdocument_id),
                    'bcContentfinal' => $content,
                    'bcWrited' => $variables
                ]);
                return redirect()->route('contractors.bill')->with('SuccessBill', 'Minuta de contrato de mensajería (' . $new->messenger->cmNames . '), registrada');
            }else{
                return redirect()->route('contractors.bill')->with('SecondaryBill', 'Ya existe una minuta de contrato para ' . $validate->messenger->cmNames);
            }
        }else if(trim($request->bcTypecontractor) == 'CARGA EXPRESS'){
            $validate = Billcontractor::where('bcContractorcharge_id',trim($request->bcContractorcharge_id))->where('bcStatus','VIGENTE')->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->bcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->bcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Billcontractor::create([
                    'bcDocument_id' => trim($request->bcDocument_id),
                    'bcDocumentcode' => $this::upper($request->dolCode),
                    'bcTypecontractor' => trim($request->bcTypecontractor),
                    'bcContractormessenger_id' => null,
                    'bcContractorcharge_id' => trim($request->bcContractorcharge_id),
                    'bcContractorespecial_id' => null,
                    'bcConfigdocument_id' => trim($request->bcConfigdocument_id),
                    'bcContentfinal' => $content,
                    'bcWrited' => $variables
                ]);
                return redirect()->route('contractors.bill')->with('SuccessBill', 'Minuta de contrato de carga express (' . $new->charge->ccNames . '), registrada');
            }else{
                return redirect()->route('contractors.bill')->with('SecondaryBill', 'Ya existe una minuta de contrato para ' . $validate->charge->ccNames);
            }
        }else if(trim($request->bcTypecontractor) == 'SERVICIO ESPECIAL'){
            $validate = Billcontractor::where('bcContractorespecial_id',trim($request->bcContractorespecial_id))->where('bcStatus','VIGENTE')->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->bcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->bcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Billcontractor::create([
                    'bcDocument_id' => trim($request->bcDocument_id),
                    'bcDocumentcode' => $this::upper($request->dolCode),
                    'bcTypecontractor' => trim($request->bcTypecontractor),
                    'bcContractormessenger_id' => null,
                    'bcContractorcharge_id' => null,
                    'bcContractorespecial_id' => trim($request->bcContractorespecial_id),
                    'bcConfigdocument_id' => trim($request->bcConfigdocument_id),
                    'bcContentfinal' => $content,
                    'bcWrited' => $variables
                ]);
                return redirect()->route('contractors.bill')->with('SuccessBill', 'Minuta de contrato de servicio especial (' . $new->especial->ceNames . '), registrada');
            }else{
                return redirect()->route('contractors.bill')->with('SecondaryBill', 'Ya existe una minuta de contrato para ' . $validate->especial->ceNames);
            }
        }
    }

    function updateBill(Request $request){
        // dd($request->all());
        /*
            $request->bcTypecontractor_Edit
            $request->contractorname_Edit
            $request->bcDocument_id_Edit
            $request->dolCode_Edit
            $request->bcConfigdocument_id_Edit
            $request->bcTemplate_Edit
            $request->bcVariables_Edit
            $request->bcId_Edit
        */
        $validate = Billcontractor::find(trim($request->bcId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->bcVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                $content = preg_replace($search, $var[0], trim($request->bcTemplate_Edit),1);
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
                        $content = preg_replace($search, $var[0], trim($request->bcTemplate_Edit),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
            }
            $validate->bcDocument_id = trim($request->bcDocument_id_Edit);
            $validate->bcDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->bcConfigdocument_id = trim($request->bcConfigdocument_id_Edit);
            $validate->bcContentfinal = $content;
            $validate->bcWrited = $variables;
            $validate->save();
            return redirect()->route('contractors.bill')->with('PrimaryBill', 'Minuta de contrato contratista (' . trim($request->contractorname_Edit) . '), actualizada');
        }else{
            return redirect()->route('contractors.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato para ' . trim($request->contractorname_Edit));
        }
    }

    function deleteBill(Request $request){
        // dd($request->all());
        $validate = Billcontractor::find(trim($request->bcId_Delete));
        if($validate != null){
            if($validate->bcTypecontractor == 'MENSAJERIA'){
                $collaborator = $validate->messenger->cmNames;
            }else if($validate->bcTypecontractor == 'CARGA EXPRESS'){
                $collaborator = $validate->charge->ccNames;
            }else if($validate->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $collaborator = $validate->especial->ceNames;
            }else{
                $collaborator = 'CONTRATISTA DE ' . $validate->bcTypecontractor;
            }
            $validate->bcState = 'RECHAZADO';
            $validate->bcStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('contractors.bill')->with('WarningBill', 'Minuta de contrato para (' . $collaborator . '), Finalizada');
        }else{
            return redirect()->route('contractors.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato');
        }
    }

    function aprovedBill(Request $request){
        // dd($request->all());
        $validate = Billcontractor::find(trim($request->bcId));
        if($validate != null){
            if($validate->bcTypecontractor == 'MENSAJERIA'){
                $collaborator = $validate->messenger->cmNames;
            }else if($validate->bcTypecontractor == 'CARGA EXPRESS'){
                $collaborator = $validate->charge->ccNames;
            }else if($validate->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $collaborator = $validate->especial->ceNames;
            }else{
                $collaborator = 'CONTRATISTA DE ' . $validate->bcTypecontractor;
            }
            $validate->bcState = 'APROBADO';
            $validate->save();
            return redirect()->route('contractors.bill')->with('SuccessBill', 'Minuta de contrato de (' . $collaborator . '), ¡APROBADA!');
        }else{
            return redirect()->route('contractors.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato');
        }
    }

    function pdfBill(Request $request){
        // dd($request->all());
        $legalization = Billcontractor::find($request->bcId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($legalization->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $legalization->messenger->cmNames;
            }else if($legalization->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $legalization->charge->ccNames;
            }else if($legalization->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $legalization->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $legalization->bcTypecontractor;
            }
            $namefile = 'Minuta de contrato - CONTRATISTA DE ' . $legalization->bcTypecontractor . ' (' . $contractor . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.bill.billPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.bill')->with('SecondaryBill', 'No se encuentran la minuta de contrato');
        }
    }

    /* ===============================================================================================
			MODULO DE LEGALIZACION DE CONTRATO DE (CONTRATISTAS)
    =============================================================================================== */

    function legalizationTo(){
        $bills = Billcontractor::whereIn('bcStatus',['VIGENTE','TERMINADO'])->where('bcState','APROBADO')->get();
        return view('modules.contractors.legalization.index',compact('bills'));
    }

    function finishLegalization(Request $request){
        // dd($request->all());
        $validate = Billcontractor::find(trim($request->bcId_Finish));
        if($validate != null){
            if($validate->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->messenger->cmNames;
            }else if($validate->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->charge->ccNames;
            }else if($validate->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->bcTypecontractor;
            }
            $validate->bcStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('contractors.legalization')->with('WarningLegalization', 'Legalización de contratista (' . $contractor . '), ¡FINALIZADA!');
        }else{
            return redirect()->route('contractors.legalization')->with('SecondaryLegalization', 'No se encuentra la legalización de contratista');
        }
    }

    function pdfLegalization(Request $request){
        // dd($request->all());
        $legalization = Billcontractor::find($request->bcId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($legalization->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $legalization->messenger->cmNames;
            }else if($legalization->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $legalization->charge->ccNames;
            }else if($legalization->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $legalization->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $legalization->bcTypecontractor;
            }
            $namefile = 'CONTRATO APROBADO - CONTRATISTA DE ' . $legalization->bcTypecontractor . ' (' . $contractor . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.legalization.legalizationPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.legalization')->with('SecondaryLegalization', 'No se encuentran la legalización de contrato');
        }
    }

    /* ===============================================================================================
			MODULO DE CONVENIO COLABORACION EMPRESARIAL DE (CONTRATISTAS)
    =============================================================================================== */

    function agreementTo(){
        $documents = Documentlogistic::all();
        $agreements = Agreementcontractor::all();

        // $contractorcharges = Contractorcharge::all();
        // $contractorespecials = Contractorespecial::all();
        // $contractormessengers = Contractormessenger::all();
        $contractorcharges = Billcontractor::select('billcontractors.bcId','contractorschargeexpress.ccNames','contractorschargeexpress.ccId')
                                ->join('contractorschargeexpress','contractorschargeexpress.ccId','billcontractors.bcContractorcharge_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        $contractormessengers = Billcontractor::select('billcontractors.bcId','contractorsmessenger.cmNames','contractorsmessenger.cmId')
                                ->join('contractorsmessenger','contractorsmessenger.cmId','billcontractors.bcContractormessenger_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        $contractorespecials = Billcontractor::select('billcontractors.bcId','contractorsserviceespecial.ceNames','contractorsserviceespecial.ceId')
                                ->join('contractorsserviceespecial','contractorsserviceespecial.ceId','billcontractors.bcContractorespecial_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        $alliescharges = Alliescharge::all();
        $alliesespecials = Alliesespecial::all();
        $alliesmessengers = Alliesmessenger::all();
        return view(
            'modules.contractors.agreement.index',
            compact(
                'agreements',
                'documents',
                'contractorcharges',
                'contractorespecials',
                'contractormessengers',
                'alliescharges',
                'alliesespecials',
                'alliesmessengers'
            )
        );
    }

    function saveAgreement(Request $request){
        // dd($request->all());
        /*
            $request->agcDocument_id
            $request->dolVersion
            $request->dolCode
            $request->agcTypecontractor
            $request->agcBillcontractor_id

            $request->agcContractormessenger_id
            $request->agcAlliesmessenger_id

            $request->agcContractorcharge_id
            $request->agcAlliescharge_id

            $request->agcContractorespecial_id
            $request->agcAlliesespecial_id

            $request->agcConfigdocument_id
            $request->agcTemplate
            $request->agcVariables
        */
        if(trim($request->agcTypecontractor) == 'MENSAJERIA'){
            $validate = Agreementcontractor::where('agcBillcontractor_id',trim($request->agcBillcontractor_id))->where('agcAlliesmessenger_id',trim($request->agcAlliesmessenger_id))->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->agcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->agcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Agreementcontractor::create([
                    'agcDocument_id' => trim($request->agcDocument_id),
                    'agcDocumentcode' => $this::upper($request->dolCode),
                    'agcTypecontractor' => $this::upper($request->agcTypecontractor),
                    'agcBillcontractor_id' => trim($request->agcBillcontractor_id),
                    'agcAlliesmessenger_id' => trim($request->agcAlliesmessenger_id),
                    'agcAlliescharge_id' => null,
                    'agcAlliesespecial_id' => null,
                    'agcConfigdocument_id' => trim($request->agcConfigdocument_id),
                    'agcContentfinal' => $content,
                    'agcWrited' => $variables
                ]);
                return redirect()->route('contractors.agreement')->with('SuccessAgreement', 'Convenio de mensajería (' . $new->bill->messenger->cmNames . '), registrado');
            }else{
                return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'Ya existe un convenio para ' . $validate->bill->messenger->cmNames . ' y empresa aliada ' . $validate->alliesmessenger->amReasonsocial);
            }
        }else if(trim($request->agcTypecontractor) == 'CARGA EXPRESS'){
            $validate = Agreementcontractor::where('agcBillcontractor_id',trim($request->agcBillcontractor_id))->where('agcAlliescharge_id',trim($request->agcAlliescharge_id))->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->agcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->agcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Agreementcontractor::create([
                    'agcDocument_id' => trim($request->agcDocument_id),
                    'agcDocumentcode' => $this::upper($request->dolCode),
                    'agcTypecontractor' => $this::upper($request->agcTypecontractor),
                    'agcBillcontractor_id' => trim($request->agcBillcontractor_id),
                    'agcAlliesmessenger_id' => null,
                    'agcAlliescharge_id' => trim($request->agcAlliescharge_id),
                    'agcAlliesespecial_id' => null,
                    'agcConfigdocument_id' => trim($request->agcConfigdocument_id),
                    'agcContentfinal' => $content,
                    'agcWrited' => $variables
                ]);
                return redirect()->route('contractors.agreement')->with('SuccessAgreement', 'Convenio de carga express (' . $new->bill->charge->ccNames . '), registrado');
            }else{
                return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'Ya existe un convenio para ' . $validate->bill->charge->ccNames . ' y empresa aliada ' . $validate->alliescharge->acReasonsocial);
            }
        }else if(trim($request->agcTypecontractor) == 'SERVICIO ESPECIAL'){
            $validate = Agreementcontractor::where('agcBillcontractor_id',trim($request->agcBillcontractor_id))->where('agcAlliesespecial_id',trim($request->agcAlliesespecial_id))->first();
            if($validate == null){
                $content = '';
                $variables = substr(trim($request->agcVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                        $content = preg_replace($search, $var[0], trim($request->agcTemplate),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
                $new = Agreementcontractor::create([
                    'agcDocument_id' => trim($request->agcDocument_id),
                    'agcDocumentcode' => $this::upper($request->dolCode),
                    'agcTypecontractor' => $this::upper($request->agcTypecontractor),
                    'agcBillcontractor_id' => trim($request->agcBillcontractor_id),
                    'agcAlliesmessenger_id' => null,
                    'agcAlliescharge_id' => null,
                    'agcAlliesespecial_id' => trim($request->agcAlliesespecial_id),
                    'agcConfigdocument_id' => trim($request->agcConfigdocument_id),
                    'agcContentfinal' => $content,
                    'agcWrited' => $variables
                ]);
                return redirect()->route('contractors.agreement')->with('SuccessAgreement', 'Convenio de servicio especial (' . $new->bill->especial->ceNames . '), registrado');
            }else{
                return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'Ya existe un convenio para ' . $validate->bill->especial->ceNames . ' y empresa aliada ' . $validate->alliesespecial->aeReasonsocial);
            }
        }
    }

    function updateAgreement(Request $request){
        // dd($request->all());
        /*
            $request->agcDocument_id_Edit
            $request->dolCode_Edit
            $request->agcTypecontractor_Edit
            $request->agcConfigdocument_id_Edit
            $request->agcTemplate_Edit
            $request->agcVariables_Edit
            $request->agcId_Edit
        */
        $validate = Agreementcontractor::find(trim($request->agcId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->agcVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                    $content = preg_replace($search, $var[0], trim($request->agcTemplate_Edit),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            $validate->agcDocument_id = trim($request->agcDocument_id_Edit);
            $validate->agcDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->agcConfigdocument_id = trim($request->agcConfigdocument_id_Edit);
            $validate->agcContentfinal = $content;
            $validate->agcWrited = $variables;
            if($validate->agcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->bill->messenger->cmNames;
                $allies = $validate->alliesmessenger->amReasonsocial;
            }else if($validate->agcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->bill->charge->ccNames;
                $allies = $validate->alliescharge->acReasonsocial;
            }else if($validate->agcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->bill->especial->ceNames;
                $allies = $validate->alliesespecial->aeReasonsocial;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->agcTypecontractor;
                $allies = 'EMPRESA ALIADA DE ' . $validate->agcTypecontractor;
            }
            $validate->save();
            return redirect()->route('contractors.agreement')->with('PrimaryAgreement', 'Convenio de contratista (' . $contractor . ') y empresa aliada (' . $allies . '), actualizado');
        }else{
            return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'No se encuentra el convenio colaboración empresarial');
        }
    }

    function deleteAgreement(Request $request){
        // dd($request->all());
        $validate = Agreementcontractor::find(trim($request->agcId_Delete));
        if($validate != null){
            if($validate->agcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->bill->messenger->cmNames;
                $allies = $validate->alliesmessenger->amReasonsocial;
            }else if($validate->agcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->bill->charge->ccNames;
                $allies = $validate->alliescharge->acReasonsocial;
            }else if($validate->agcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->bill->especial->ceNames;
                $allies = $validate->alliesespecial->aeReasonsocial;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->agcTypecontractor;
                $allies = 'EMPRESA ALIADA DE ' . $validate->agcTypecontractor;
            }
            $validate->delete();
            return redirect()->route('contractors.agreement')->with('WarningAgreement', 'Convenio de contratista (' . $contractor . ') y empresa aliada (' . $allies . '), Eliminado');
        }else{
            return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'No se encuentra el convenio colaboración empresarial');
        }
    }

    function pdfAgreement(Request $request){
        // dd($request->all());
        $agreement = Agreementcontractor::find($request->agcId);
        if($agreement != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($agreement->agcTypecontractor == 'MENSAJERIA'){
                $contractor = $agreement->bill->messenger->cmNames;
                $allies = $agreement->alliesmessenger->amReasonsocial;
            }else if($agreement->agcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $agreement->bill->charge->ccNames;
                $allies = $agreement->alliescharge->acReasonsocial;
            }else if($agreement->agcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $agreement->bill->especial->ceNames;
                $allies = $agreement->alliesespecial->aeReasonsocial;
            }else{
                $contractor = 'CONTRATISTA DE ' . $agreement->agcTypecontractor;
                $allies = 'EMPRESA ALIADA DE ' . $agreement->agcTypecontractor;
            }
            $namefile = 'Convenio colaboración empresarial de (' . $contractor . ') y empresa aliada (' . $allies . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.agreement.agreementPdf',compact('technical','agreement'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.agreement')->with('SecondaryAgreement', 'No se encuentra el convenio colaboración empresarial');
        }
    }

    /* ===============================================================================================
			MODULO DE SEGUIMIENTO SEGURIDAD SOCIAL DE (CONTRATISTAS)
    =============================================================================================== */

    function trackingTo(){
        $documents = Documentlogistic::all();
        $trackings = Trackingsocialcontractor::all();
        $aproveds = Billcontractor::where('billcontractors.bcState','APROBADO')->where('billcontractors.bcStatus','VIGENTE')->get();
        $contractors = array();
        foreach ($aproveds as $aproved) {
            if($aproved->bcTypecontractor == 'MENSAJERIA'){
                $contractormessenger = Contractormessenger::find($aproved->bcContractormessenger_id);
                if($contractormessenger != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractormessenger->cmNames,
                        $contractormessenger->cmNumberdocument,
                        $contractormessenger->neighborhood->neName,
                        $contractormessenger->cmPhoto,
                        $contractormessenger->cmFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'CARGA EXPRESS'){
                $contractorcharge = Contractorcharge::find($aproved->bcContractorcharge_id);
                if($contractorcharge != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorcharge->ccNames,
                        $contractorcharge->ccNumberdocument,
                        $contractorcharge->neighborhood->neName,
                        $contractorcharge->ccPhoto,
                        $contractorcharge->ccFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractorespecial = Contractorespecial::find($aproved->bcContractorespecial_id);
                if($contractorespecial != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorespecial->ceNames,
                        $contractorespecial->ceNumberdocument,
                        $contractorespecial->neighborhood->neName,
                        $contractorespecial->cePhoto,
                        $contractorespecial->ceFirm
                    ]);
                }
            }            
        }
        return view('modules.contractors.tracking.index',compact('trackings','contractors','documents'));
    }

    function saveTracking(Request $request){
        // dd($request->all());
        /*
            $request->tcDate
            $request->tcDocument_id
            $request->dolVersion
            $request->dolCode
            $request->tcBillcontractor_id
            $request->tcPeriodpay
            $request->tcYear
            $request->tcMonth
            $request->tcDay
        */
        $validate = Trackingsocialcontractor::where('tcBillcontractor_id',trim($request->tcBillcontractor_id))->first();
                    // ->where('tcDocument_id',trim($request->tcDocument_id))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->tcDate)));
            $datePeriod = Date('Y-m-d',strtotime(trim($request->tcPeriodpay)));
            $new = Trackingsocialcontractor::create([
                'tcDate' => $date,
                'tcDocument_id' => trim($request->tcDocument_id),
                'tcDocumentcode' => $this::upper($request->dolCode),
                'tcBillcontractor_id' => trim($request->tcBillcontractor_id),
                'tcPeriodpay' => $datePeriod
            ]);
            if($new->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $new->bill->messenger->cmNames;
            }else if($new->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $new->bill->charge->ccNames;
            }else if($new->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $new->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $new->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.tracking')->with('SuccessTracking', 'Seguimiento de (' . $contractor . '), registrado');
        }else{
            if($validate->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->bill->messenger->cmNames;
            }else if($validate->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->bill->charge->ccNames;
            }else if($validate->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.tracking')->with('SecondaryTracking', 'Ya existe un seguimiento para ' . $contractor);
        }
    }

    function updateTracking(Request $request){
        // dd($request->all());
        /*
            $request->tcDate_Edit
            $request->tcDocument_id_Edit
            $request->dolCode_Edit
            $request->tcPeriodpay_Edit
            $request->tcId_Edit
            $request->cNames_Edit
        */
        $validate = Trackingsocialcontractor::find(trim($request->tcId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->tcDate_Edit)));
            $datePeriod = Date('Y-m-d',strtotime(trim($request->tcPeriodpay_Edit)));
            $validate->tcDate = $date;
            $validate->tcDocument_id = trim($request->tcDocument_id_Edit);
            $validate->tcDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->tcPeriodpay = $datePeriod;
            $validate->save();
            return redirect()->route('contractors.tracking')->with('PrimaryTracking', 'Seguimiento de (' . trim($request->cNames_Edit) . '), actualizado');
        }else{
            return redirect()->route('contractors.tracking')->with('SecondaryTracking', 'No se encuentra el seguimiento de ' . trim($request->cNames_Edit));
        }
    }

    function deleteTracking(Request $request){
        // dd($request->all());
        $validate = Trackingsocialcontractor::find(trim($request->tcId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('contractors.tracking')->with('WarningTracking', 'Seguimiento de (' . trim($request->cNames_Delete) . '), Eliminado');
        }else{
            return redirect()->route('contractors.tracking')->with('SecondaryTracking', 'No se encuentran el seguimiento de ' . trim($request->cNames_Delete));
        }
    }

    function pdfTracking(Request $request){
        // dd($request->all());
        $tracking = Trackingsocialcontractor::find($request->tcId);
        if($tracking != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($tracking->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $tracking->bill->messenger->cmNames;
            }else if($tracking->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $tracking->bill->charge->ccNames;
            }else if($tracking->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $tracking->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $tracking->bill->bcTypecontractor;
            }
            $namefile = 'Seguimiento de seguridad social de ' . $contractor . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.tracking.trackingPdf',compact('technical','tracking'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.tracking')->with('SecondaryTracking', 'No se encuentran la entrega de dotación');
        }
    }

    /* ===============================================================================================
			MODULO DE NOTIFICACIONES DE (CONTRATISTAS)
    =============================================================================================== */

    function notificationsTo(){
        $documents = Documentlogistic::all();
        $notifications = Notificationcontractor::all();
        $aproveds = Billcontractor::where('billcontractors.bcState','APROBADO')->where('billcontractors.bcStatus','VIGENTE')->get();
        $contractors = array();
        foreach ($aproveds as $aproved) {
            if($aproved->bcTypecontractor == 'MENSAJERIA'){
                $contractormessenger = Contractormessenger::find($aproved->bcContractormessenger_id);
                if($contractormessenger != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractormessenger->cmNames,
                        $contractormessenger->cmNumberdocument,
                        $contractormessenger->neighborhood->neName,
                        $contractormessenger->cmPhoto,
                        $contractormessenger->cmFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'CARGA EXPRESS'){
                $contractorcharge = Contractorcharge::find($aproved->bcContractorcharge_id);
                if($contractorcharge != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorcharge->ccNames,
                        $contractorcharge->ccNumberdocument,
                        $contractorcharge->neighborhood->neName,
                        $contractorcharge->ccPhoto,
                        $contractorcharge->ccFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractorespecial = Contractorespecial::find($aproved->bcContractorespecial_id);
                if($contractorespecial != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorespecial->ceNames,
                        $contractorespecial->ceNumberdocument,
                        $contractorespecial->neighborhood->neName,
                        $contractorespecial->cePhoto,
                        $contractorespecial->ceFirm
                    ]);
                }
            }            
        }
        return view('modules.contractors.notifications.index',compact('notifications','contractors','documents'));
    }

    function saveNotification(Request $request){
        // dd($request->all());
        /*
            $request->ncDate
            $request->ncDocument_id
            $request->dolCode
            $request->ncBillcontractor_id
            $request->ncNotification
        */
        $date = Date('Y-m-d',strtotime(trim($request->ncDate)));
        $validate = Notificationcontractor::where('ncBillcontractor_id',trim($request->ncBillcontractor_id))->where('ncDate',$date)->first();
        if($validate == null){
            $new = Notificationcontractor::create([
                'ncDate' => $date,
                'ncDocument_id' => trim($request->ncDocument_id),
                'ncDocumentcode' => $this::upper($request->dolCode),
                'ncBillcontractor_id' => trim($request->ncBillcontractor_id),
                'ncNotification' => $this::fu($request->ncNotification)
            ]);
            if($new->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $new->bill->messenger->cmNames;
            }else if($new->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $new->bill->charge->ccNames;
            }else if($new->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $new->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $new->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.notifications')->with('SuccessNotification', 'Notificación de (' . $contractor . '), registrada');
        }else{
            if($validate->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->bill->messenger->cmNames;
            }else if($validate->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->bill->charge->ccNames;
            }else if($validate->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.notifications')->with('SecondaryNotification', 'Ya existe una notificación para ' . $contractor);
        }
    }

    function updateNotification(Request $request){
        // dd($request->all());
        /*
            $request->ncDate_Edit
            $request->ncDocument_id_Edit
            $request->dolCode_Edit
            $request->ncNotification_Edit
            $request->ncId_Edit
            $request->cNames_Edit
        */
        $validate = Notificationcontractor::find(trim($request->ncId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->ncDate_Edit)));
            $validate->ncDate = $date;
            $validate->ncDocument_id = trim($request->ncDocument_id_Edit);
            $validate->ncDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->ncNotification = $this::fu($request->ncNotification_Edit);
            $validate->save();
            return redirect()->route('contractors.notifications')->with('PrimaryNotification', 'Notificación de (' . trim($request->cNames_Edit) . '), actualizada');
        }else{
            return redirect()->route('contractors.notifications')->with('SecondaryNotification', 'No se encuentra la notificación de ' . trim($request->cNames_Edit));
        }
    }

    function deleteNotification(Request $request){
        // dd($request->all());
        $validate = Notificationcontractor::find(trim($request->ncId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('contractors.notifications')->with('WarningNotification', 'Notificación de (' . trim($request->cNames_Delete) . '), Eliminada');
        }else{
            return redirect()->route('contractors.notifications')->with('SecondaryNotification', 'No se encuentran la notificación de ' . trim($request->cNames_Delete));
        }
    }

    function pdfNotification(Request $request){
        // dd($request->all());
        $notification = Notificationcontractor::find($request->ncId);
        if($notification != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($notification->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $notification->bill->messenger->cmNames;
            }else if($notification->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $notification->bill->charge->ccNames;
            }else if($notification->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $notification->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $notification->bill->bcTypecontractor;
            }
            $namefile = 'Notificación de (' . $contractor . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.notifications.notificationPdf',compact('technical','notification'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.tracking')->with('SecondaryTracking', 'No se encuentran la entrega de dotación');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTROL DE AUSENCIAS Y AUSENTISMOS DE (CONTRATISTAS)
    =============================================================================================== */

    function controlTo(){
        $controls = Assistancecontractor::all();
        $documents = Documentlogistic::all();
        $aproveds = Billcontractor::where('billcontractors.bcState','APROBADO')->where('billcontractors.bcStatus','VIGENTE')->get();
        $contractors = array();
        foreach ($aproveds as $aproved) {
            if($aproved->bcTypecontractor == 'MENSAJERIA'){
                $contractormessenger = Contractormessenger::find($aproved->bcContractormessenger_id);
                if($contractormessenger != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractormessenger->cmNames,
                        $contractormessenger->cmNumberdocument,
                        $contractormessenger->neighborhood->neName,
                        $contractormessenger->cmPhoto,
                        $contractormessenger->cmFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'CARGA EXPRESS'){
                $contractorcharge = Contractorcharge::find($aproved->bcContractorcharge_id);
                if($contractorcharge != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorcharge->ccNames,
                        $contractorcharge->ccNumberdocument,
                        $contractorcharge->neighborhood->neName,
                        $contractorcharge->ccPhoto,
                        $contractorcharge->ccFirm
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractorespecial = Contractorespecial::find($aproved->bcContractorespecial_id);
                if($contractorespecial != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorespecial->ceNames,
                        $contractorespecial->ceNumberdocument,
                        $contractorespecial->neighborhood->neName,
                        $contractorespecial->cePhoto,
                        $contractorespecial->ceFirm
                    ]);
                }
            }            
        }
        return view('modules.contractors.control.index',compact('controls','documents','contractors'));
    }

    function saveControl(Request $request){
        // dd($request->all());
        /*
            $request->ascDocument_id
            $request->dolCode
            $request->ascBillcontractor_id
            $request->ascDate
            $request->ascAbsenteeism

            $request->ascHourentry
            $request->ascDescription_come

            $request->ascHourexit
            $request->ascDescription_out

            $request->ascDescription_not
        */
        $date = Date('Y-m-d',strtotime(trim($request->ascDate)));
        $validate = Assistancecontractor::where('ascBillcontractor_id',trim($request->ascBillcontractor_id))->where('ascDate',$date)->first();
        if($validate == null){
            $hourentry = null;
            $hourexit = null;
            $description = null;
            switch ($this::upper($request->ascAbsenteeism)) {
                case 'NO ASISTIO':
                    $description = $this::fu($request->ascDescription_not);
                break;
                case 'LLEGO TARDE':
                    $hourentry = Date('h:i:s',strtotime(trim($request->ascHourentry)));
                    $description = $this::fu($request->ascDescription_come);
                break;
                case 'SALIO TEMPRANO':
                    $hourexit = Date('h:i:s',strtotime(trim($request->ascHourexit)));
                    $description = $this::fu($request->ascDescription_out);
                break;
            }
            $new = Assistancecontractor::create([
                'ascDate' => $date,
                'ascDocument_id' => trim($request->ascDocument_id),
                'ascDocumentcode' => $this::upper($request->dolCode),
                'ascBillcontractor_id' => trim($request->ascBillcontractor_id),
                'ascAbsenteeism' => $this::upper($request->ascAbsenteeism),
                'ascHourentry' => $hourentry,
                'ascHourexit' => $hourexit,
                'ascDescription' => $description
            ]);
            if($new->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $new->bill->messenger->cmNames;
            }else if($new->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $new->bill->charge->ccNames;
            }else if($new->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $new->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $new->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.control')->with('SuccessControl', 'Registro de control de (' . $contractor . '), registrado');
        }else{
            if($validate->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->bill->messenger->cmNames;
            }else if($validate->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->bill->charge->ccNames;
            }else if($validate->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->bill->bcTypecontractor;
            }
            return redirect()->route('contractors.control')->with('SecondaryControl', 'Ya existe un registro de control en la fecha (' . $date . ') para contratista (' . $contractor . ')');
        }
    }

    function updateControl(Request $request){
        // dd($request->all());
        /*
            $request->ascDate_Edit
            $request->ascDocument_id_Edit
            $request->dolCode_Edit
            $request->ascAbsenteeism_Edit
            $request->cNames_Edit
            $request->ascId_Edit

            $request->ascHourentry_Edit
            $request->ascDescription_come_Edit

            $request->ascHourexit_Edit
            $request->ascDescription_out_Edit

            $request->ascDescription_not_Edit
        */
        $validate = Assistancecontractor::find(trim($request->ascId_Edit));
        if($validate != null){
            $hourentry = null;
            $hourexit = null;
            $description = null;
            switch ($this::upper($request->ascAbsenteeism_Edit)) {
                case 'NO ASISTIO':
                    $description = $this::fu($request->ascDescription_not_Edit);
                break;
                case 'LLEGO TARDE':
                    $hourentry = trim($request->ascHourentry_Edit) . ':00';
                    $description = $this::fu($request->ascDescription_come_Edit);
                break;
                case 'SALIO TEMPRANO':
                    $hourexit = trim($request->ascHourexit_Edit) . ':00';
                    $description = $this::fu($request->ascDescription_out_Edit);
                break;
                default:
                    $description = $this::fu($request->ascDescription_not_Edit);
                break;
            }
            $date = Date('Y-m-d',strtotime(trim($request->ascDate_Edit)));
            $validate->ascDate = $date;
            $validate->ascAbsenteeism = $this::upper($request->ascAbsenteeism_Edit);
            $validate->ascDocument_id = trim($request->ascDocument_id_Edit);
            $validate->ascDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->ascHourentry = $hourentry;
            $validate->ascHourexit = $hourexit;
            $validate->ascDescription = $description;
            $validate->save();
            return redirect()->route('contractors.control')->with('PrimaryControl', 'Registro de control de (' . trim($request->cNames_Edit) . '), actualizado');
        }else{
            return redirect()->route('contractors.control')->with('SecondaryControl', 'No se encuentra el control de (' . trim($request->cNames_Edit) . ')');
        }
    }

    function deleteControl(Request $request){
        // dd($request->all());
        $validate = Assistancecontractor::find(trim($request->ascId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('contractors.control')->with('WarningControl', 'Registro de control de (' . trim($request->cNames_Delete) . '), Eliminado');
        }else{
            return redirect()->route('contractors.control')->with('SecondaryControl', 'No se encuentran el control de (' . trim($request->cNames_Delete) . ')');
        }
    }

    function pdfControl(Request $request){
        // dd($request->all());
        $control = Assistancecontractor::find($request->ascId);
        if($control != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            if($control->bill->bcTypecontractor == 'MENSAJERIA'){
                $contractor = $control->bill->messenger->cmNames;
            }else if($control->bill->bcTypecontractor == 'CARGA EXPRESS'){
                $contractor = $control->bill->charge->ccNames;
            }else if($control->bill->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $control->bill->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $control->bill->bcTypecontractor;
            }
            $namefile = 'Registro de ausentismo de contratista (' . $contractor . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.control.controlPdf',compact('technical','control'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.control')->with('SecondaryControl', 'No se encuentran el registro de control');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTROL DE ASISTENCIA A CAPACITACIONES DE (CONTRATISTAS)
    =============================================================================================== */

    function trainingsTo(){
        $trainings = Trainingcontractor::all();
        $documents = Documentlogistic::all();
        $aproveds = Billcontractor::where('billcontractors.bcState','APROBADO')->where('billcontractors.bcStatus','VIGENTE')->get();
        $contractors = array();
        foreach ($aproveds as $aproved) {
            if($aproved->bcTypecontractor == 'MENSAJERIA'){
                $contractormessenger = Contractormessenger::find($aproved->bcContractormessenger_id);
                if($contractormessenger != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractormessenger->cmNames,
                        $contractormessenger->cmNumberdocument
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'CARGA EXPRESS'){
                $contractorcharge = Contractorcharge::find($aproved->bcContractorcharge_id);
                if($contractorcharge != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorcharge->ccNames,
                        $contractorcharge->ccNumberdocument
                    ]);
                }
            }else if($aproved->bcTypecontractor == 'SERVICIO ESPECIAL'){
                $contractorespecial = Contractorespecial::find($aproved->bcContractorespecial_id);
                if($contractorespecial != null){
                    array_push($contractors,[
                        $aproved->bcId,
                        $aproved->bcTypecontractor,
                        $contractorespecial->ceNames,
                        $contractorespecial->ceNumberdocument
                    ]);
                }
            }            
        }
        return view('modules.contractors.trainings.index',compact('trainings','documents','contractors'));
    }

    function saveTraining(Request $request){
        // dd($request->all());
        /*
            $request->trcDate
            $request->trcNametraining
            $request->trcNametrainer
            $request->trcDocument_id
            $request->dolCode
            $request->allLegalizations
        */
        $validate = Trainingcontractor::where('trcNametraining',$this::upper($request->trcNametraining))->first();
        if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->trcDate)));
            $legalizations = substr(trim($request->allLegalizations),0,-1); // QUITAR EL ULTIMO CARACTER (=)
            $new = Trainingcontractor::create([
                'trcDate' => $date,
                'trcDocument_id' => trim($request->trcDocument_id),
                'trcDocumentcode' => $this::upper($request->dolCode),
                'trcNametraining' => $this::upper($request->trcNametraining),
                'trcNametrainer' => $this::upper($request->trcNametrainer),
                'trcLegalizations' => $legalizations
            ]);
            $find = strpos($legalizations,'=');
            if($find === false){
                Binnacletrainingcontractor::create([
                    'bicTraining_id' => $new->trcId,
                    'bicBillcontractor_id' => $legalizations
                ]);
            }else{
                $separatedLegalizations = explode('=',$legalizations);
                for ($i=0; $i < count($separatedLegalizations); $i++) { 
                    Binnacletrainingcontractor::create([
                        'bicTraining_id' => $new->trcId,
                        'bicBillcontractor_id' => $separatedLegalizations[$i]
                    ]);      
                }
            }
            return redirect()->route('contractors.trainings')->with('SuccessTraining', 'Registro de capacitación (' . $this::upper($request->trcNametraining) . '), registrada');
        }else{
            return redirect()->route('contractors.trainings')->with('SecondaryTraining', 'Ya existe una capacitación con nombre ' . $this::upper($request->trcNametraining));
        }
    }

    function updateTraining(Request $request){
        // dd($request->all());
        /*
            $request->trcDate_Edit
            $request->trcNametraining_Edit
            $request->trcNametrainer_Edit
            $request->trcDocument_id_Edit
            $request->dolCode_Edit
            $request->allLegalizations_Edit
            $request->trcId_Edit
        */
        $validate = Trainingcontractor::find(trim($request->trcId_Edit));
        if($validate != null){
            $date = Date('Y-m-d',strtotime(trim($request->trcDate_Edit)));
            $legalizations = substr(trim($request->allLegalizations_Edit),0,-1); // QUITAR EL ULTIMO CARACTER (=)
            $validate->trcDate = $date;
            $validate->trcDocument_id = trim($request->trcDocument_id_Edit);
            $validate->trcDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->trcNametraining = $this::upper($request->trcNametraining_Edit);
            $validate->trcNametrainer = $this::upper($request->trcNametrainer_Edit);
            $validate->trcLegalizations = $legalizations;
            $newLegalizations = array();
            $find = strpos($legalizations,'=');
            if($find === false){
                $validateRegister = Binnacletrainingcontractor::where('bicTraining_id',$validate->trcId)
                                        ->where('bicBillcontractor_id',$legalizations)
                                        ->first();
                if($validateRegister == null){
                    Binnacletrainingcontractor::create([
                        'bicTraining_id' => $validate->trcId,
                        'bicBillcontractor_id' => $legalizations
                    ]);
                }
                array_push($newLegalizations,$legalizations);
            }else{
                $separatedLegalizations = explode('=',$legalizations);
                for ($i=0; $i < count($separatedLegalizations); $i++) { 
                    $validateRegister = Binnacletrainingcontractor::where('bicTraining_id',$validate->trcId)
                                            ->where('bicBillcontractor_id',$separatedLegalizations[$i])
                                            ->first();
                    if($validateRegister == null){
                        Binnacletrainingcontractor::create([
                            'bicTraining_id' => $validate->trcId,
                            'bicBillcontractor_id' => $separatedLegalizations[$i]
                        ]);
                    }
                    array_push($newLegalizations,$separatedLegalizations[$i]);
                }
            }
            // SE ELIMINAN LOS COLABORADORES ASISTIDOS QUE NO ESTEN EN LA LISTA DE ASISTENTES ACTUALIZADA
            $validateDelete = Binnacletrainingcontractor::where('bicTraining_id',$validate->trcId)
                                        ->whereNotIn('bicBillcontractor_id',$newLegalizations)
                                        ->get();
            foreach ($validateDelete as $not) {
                $not->delete();
            }
            // SE GUARDAN CAMBIOS DE CAPACITACION
            $validate->save();
            return redirect()->route('contractors.trainings')->with('PrimaryTraining', 'Registro de capacitación (' . $this::upper($request->trcNametraining_Edit) . '), actualizado');
        }else{
            return redirect()->route('contractors.trainings')->with('SecondaryTraining', 'No se encuentra la capacitación (' . $this::upper($request->trcNametraining_Edit) . ')');
        }
    }

    function deleteTraining(Request $request){
        // dd($request->all());
        $validate = Trainingcontractor::find(trim($request->trcId_Delete));
        if($validate != null){
            // SE ELIMINAN LOS COLABORADORES ASISTIDOS QUE NO ESTEN EN LA LISTA DE ASISTENTES ACTUALIZADA
            $validateDelete = Binnacletrainingcontractor::where('bicTraining_id',$validate->trcId)->get();
            foreach ($validateDelete as $not) {
                $not->delete();
            }
            $trainingName = $validate->trcNametraining;
            $validate->delete();
            return redirect()->route('contractors.trainings')->with('WarningTraining', 'Registro de capacitación (' . $trainingName . '), Eliminado');
        }else{
            return redirect()->route('contractors.trainings')->with('SecondaryTraining', 'No se encuentran la capacitación');
        }
    }

    function pdfTraining(Request $request){
        // dd($request->all());
        $training = Trainingcontractor::find($request->trcId);
        if($training != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $binnacles = Binnacletrainingcontractor::where('bicTraining_id',$training->trcId)->get();
            $namefile = 'Registro de asistencia a capacitación (' . $training->trcNametraining . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.contractors.trainings.trainingPdf',compact('technical','training','binnacles'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('contractors.trainings')->with('SecondaryTraining', 'No se encuentran el registro de capacitación');
        }
    }

    /* ===============================================================================================
			MODULO DE EVALUACION DE DESEMPEÑO DE (CONTRATISTAS)
    =============================================================================================== */

    function testsTo(){
        return view('modules.contractors.tests.index');
    }

    /* ===============================================================================================
            MODULO DE ACTIVACIONES DEL SISTEMA DE (CONTRATISTAS)
    =============================================================================================== */

    function activationsTo(){
        $activations = Activationcontractor::all();
        $contractorcharges = Billcontractor::select('billcontractors.bcId','contractorschargeexpress.ccNames','contractorschargeexpress.ccId')
                                ->join('contractorschargeexpress','contractorschargeexpress.ccId','billcontractors.bcContractorcharge_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        $contractormessengers = Billcontractor::select('billcontractors.bcId','contractorsmessenger.cmNames','contractorsmessenger.cmId')
                                ->join('contractorsmessenger','contractorsmessenger.cmId','billcontractors.bcContractormessenger_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        $contractorespecials = Billcontractor::select('billcontractors.bcId','contractorsserviceespecial.ceNames','contractorsserviceespecial.ceId')
                                ->join('contractorsserviceespecial','contractorsserviceespecial.ceId','billcontractors.bcContractorespecial_id')
                                ->where('billcontractors.bcState','APROBADO')
                                ->where('billcontractors.bcStatus','VIGENTE')
                                ->get();
        return view('modules.contractors.activations.index',compact('activations','contractorcharges','contractormessengers','contractorespecials'));
    }

    function saveActivation(Request $request){
        // dd($request->all());
        /*
            $request->accTypecontractor
            $request->accState
            $request->accDateend
            $request->accContractormessenger_id
            $request->accContractorcharge_id
            $request->accContractorespecial_id
        */
        $date = Date('Y-m-d',strtotime(trim($request->accDateend)));
        if($this::upper($request->accState) == 'ACTIVADO'){
            $dateend = $date;
        }else{
            $dateend = null;
        }
        if(trim($request->accTypecontractor) == 'MENSAJERIA'){
            $validate = Activationcontractor::where('accContractormessenger_id',trim($request->accContractormessenger_id))->first();
            if($validate == null){
                $new = Activationcontractor::create([
                    'accTypecontractor' => $this::upper($request->accTypecontractor),
                    'accContractormessenger_id' => trim($request->accContractormessenger_id),
                    'accContractorcharge_id' => null,
                    'accContractorespecial_id' => null,
                    'accState' => $this::upper($request->accState),
                    'accDateend' => $dateend
                ]);
                return redirect()->route('contractors.activations')->with('SuccessActivation', 'Activación de (' . $new->messenger->cmNames . '), registrada');
            }else{
                return redirect()->route('contractors.activations')->with('SecondaryActivation', 'Ya existe una activación para (' . $validate->messenger->cmNames . ')');
            }
        }else if(trim($request->accTypecontractor) == 'CARGA EXPRESS'){
            $validate = Activationcontractor::where('accContractorcharge_id',trim($request->accContractorcharge_id))->first();
            if($validate == null){
                $new = Activationcontractor::create([
                    'accTypecontractor' => $this::upper($request->accTypecontractor),
                    'accContractormessenger_id' => null,
                    'accContractorcharge_id' => trim($request->accContractorcharge_id),
                    'accContractorespecial_id' => null,
                    'accState' => $this::upper($request->accState),
                    'accDateend' => $dateend
                ]);
                return redirect()->route('contractors.activations')->with('SuccessActivation', 'Activación de (' . $new->charge->ccNames . '), registrada');
            }else{
                return redirect()->route('contractors.activations')->with('SecondaryActivation', 'Ya existe una activación para (' . $validate->charge->ccNames . ')');
            }
        }else if(trim($request->accTypecontractor) == 'SERVICIO ESPECIAL'){
            $validate = Activationcontractor::where('accContractorespecial_id',trim($request->accContractorespecial_id))->first();
            if($validate == null){
                $new = Activationcontractor::create([
                    'accTypecontractor' => $this::upper($request->accTypecontractor),
                    'accContractormessenger_id' => null,
                    'accContractorcharge_id' => null,
                    'accContractorespecial_id' => trim($request->accContractorespecial_id),
                    'accState' => $this::upper($request->accState),
                    'accDateend' => $dateend
                ]);
                return redirect()->route('contractors.activations')->with('SuccessActivation', 'Activación de (' . $new->especial->ecNames . '), registrada');
            }else{
                return redirect()->route('contractors.activations')->with('SecondaryActivation', 'Ya existe una activación para (' . $validate->especial->ecNames . ')');
            }
        }
    }

    function updateActivation(Request $request){
        // dd($request->all());
        /*
            $request->accState_Edit
            $request->accDateend_Edit
            $request->accId_Edit
        */
        $validate = Activationcontractor::find(trim($request->accId_Edit));
        if($validate != null){
            if(empty(trim($request->accDateend_Edit))){
                $date = null;
            }else{
                $date = Date('Y-m-d',strtotime(trim($request->accDateend_Edit)));
            }
            if($this::upper($request->accState_Edit) == 'ACTIVADO'){
                $dateend = $date;
            }else{
                $dateend = null;
            }
            $validate->accState = $this::upper($request->accState_Edit);
            $validate->accDateend = $dateend;
            if($validate->accTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->messenger->cmNames;
            }else if($validate->accTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->charge->ccNames;
            }else if($validate->accTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->accTypecontractor;
            }
            $validate->save();
            return redirect()->route('contractors.activations')->with('PrimaryActivation', 'Activación de contratista (' . $contractor . '), actualizada');
        }else{
            return redirect()->route('contractors.activations')->with('SecondaryActivation', 'No se encuentra la activación');
        }
    }

    function deleteActivation(Request $request){
        // dd($request->all());
        $validate = Activationcontractor::find(trim($request->accId_Delete));
        if($validate != null){
            if($validate->accTypecontractor == 'MENSAJERIA'){
                $contractor = $validate->messenger->cmNames;
            }else if($validate->accTypecontractor == 'CARGA EXPRESS'){
                $contractor = $validate->charge->ccNames;
            }else if($validate->accTypecontractor == 'SERVICIO ESPECIAL'){
                $contractor = $validate->especial->ceNames;
            }else{
                $contractor = 'CONTRATISTA DE ' . $validate->accTypecontractor;
            }
            $validate->delete();
            return redirect()->route('contractors.activations')->with('WarningActivation', 'Activación de contratista (' . $contractor . '), Eliminada');
        }else{
            return redirect()->route('contractors.activations')->with('SecondaryActivation', 'No se encuentra la activación');
        }
    }
}
