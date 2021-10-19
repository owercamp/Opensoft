<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Term;
use App\Models\Client;
use App\Models\Document;
use App\Models\Configdocument;
use App\Models\Settingtechnical;
use App\Models\Settingdepartment;
use App\Models\Legalizationcontractual;

class PermanentcontractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CLIENTES DE (CONTRATOS PERMANENTES)
    =============================================================================================== */
    
    function clientsTo(){
        $clients = Client::all();
        $departments = Settingdepartment::all();
        return view('modules.permanent.clients.index',compact('clients','departments'));
    }

    function saveClient(Request $request){
        // dd($request->all());
        switch ($this::upper($request->cliType)) {
            case 'PERSONA NATURAL':
                $validate = Client::where('cliNumberdocument',trim($request->cliNumberdocument_natural))->first();
                if($validate == null){
                    $namerut = null;
                    $namephotocopy = null;
                    if($request->hasFile('cliPdfrut_natural')){
                        $rut = $request->file('cliPdfrut_natural');
                        // $name = $rut->getClientOriginalName();
                        $extension = $rut->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/naturales/',$rut,trim($request->cliNumberdocument_natural) . '_rut.' . $extension);
                        $namerut = trim($request->cliNumberdocument_natural) . '_rut.' . $extension;
                    }
                    if($request->hasFile('cliPdfphotocopy_natural')){
                        $photocopy = $request->file('cliPdfphotocopy_natural');
                        // $name = $photocopy->getClientOriginalName();
                        $extension = $photocopy->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/naturales/',$photocopy,trim($request->cliNumberdocument_natural) . '_photocopy.' . $extension);
                        $namephotocopy = trim($request->cliNumberdocument_natural) . '_photocopy.' . $extension;
                    }
                    Client::create([
                        'cliType' => 'Natural',
                        'cliNumberdocument' => trim($request->cliNumberdocument_natural),
                        'cliNamereason' => $this::upper($request->cliNamereason_natural),
                        'cliNamerepresentative' => null,
                        'cliNumberrepresentative' => null,
                        'cliMunicipality_id' => trim($request->cliMunicipality_id_natural),
                        'cliAddress' => $this::upper($request->cliAddress_natural),
                        'cliPhone' => trim($request->cliPhone_natural),
                        'cliMovil' => trim($request->cliMovil_natural),
                        'cliWhatsapp' => trim($request->cliWhatsapp_natural),
                        'cliEmail' => $this::lower($request->cliEmail_natural),
                        'cliPdfrut' => $namerut,
                        'cliPdfphotocopy' => $namephotocopy,
                        'cliPdfexistence' => null,
                        'cliPdflegal' => null
                    ]);
                    return redirect()->route('permanent.clients')->with('SuccessClient', 'Cliente natural con documento ' . $this::upper($request->cliNumberdocument_natural) . ', registrado');
                }else{
                    return redirect()->route('permanent.clients')->with('SecondaryClient', 'Ya existe el cliente con documento (' . $validate->cliNumberdocument . ')');
                }
                break;
            case 'PERSONA JURIDICA':
                $validate = Client::where('cliNumberdocument',trim($request->cliNumberdocument_juridica))->first();
                if($validate == null){
                    $namerut = null;
                    $namephotocopy = null;
                    $nameexitence = null;
                    $namelegal = null;
                    if($request->hasFile('cliPdfrut_juridica')){
                        $rut = $request->file('cliPdfrut_juridica');
                        // $name = $rut->getClientOriginalName();
                        $extension = $rut->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$rut,trim($request->cliNumberdocument_juridica) . '_rut.' . $extension);
                        $namerut = trim($request->cliNumberdocument_juridica) . '_rut.' . $extension;
                    }
                    if($request->hasFile('cliPdfphotocopy_juridica')){
                        $photocopy = $request->file('cliPdfphotocopy_juridica');
                        // $name = $photocopy->getClientOriginalName();
                        $extension = $photocopy->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$photocopy,trim($request->cliNumberdocument_juridica) . '_photocopy.' . $extension);
                        $namephotocopy = trim($request->cliNumberdocument_juridica) . '_photocopy.' . $extension;
                    }
                    if($request->hasFile('cliPdfexistence_juridica')){
                        $existence = $request->file('cliPdfexistence_juridica');
                        // $name = $existence->getClientOriginalName();
                        $extension = $existence->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$existence,trim($request->cliNumberdocument_juridica) . '_existence.' . $extension);
                        $nameexitence = trim($request->cliNumberdocument_juridica) . '_existence.' . $extension;
                    }
                    if($request->hasFile('cliPdflegal_juridica')){
                        $legal = $request->file('cliPdflegal_juridica');
                        // $name = $legal->getClientOriginalName();
                        $extension = $legal->extension();
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$legal,trim($request->cliNumberdocument_juridica) . '_legal.' . $extension);
                        $namelegal = trim($request->cliNumberdocument_juridica) . '_legal.' . $extension;
                    }
                    Client::create([
                        'cliType' => 'Jurídica',
                        'cliNumberdocument' => trim($request->cliNumberdocument_juridica),
                        'cliNamereason' => $this::upper($request->cliNamereason_juridica),
                        'cliNamerepresentative' => $this::upper($request->cliNamerepresentative_juridica),
                        'cliNumberrepresentative' => trim($request->cliNumberrepresentative_juridica),
                        'cliMunicipality_id' => trim($request->cliMunicipality_id_juridica),
                        'cliAddress' => $this::upper($request->cliAddress_juridica),
                        'cliPhone' => trim($request->cliPhone_juridica),
                        'cliMovil' => trim($request->cliMovil_juridica),
                        'cliWhatsapp' => trim($request->cliWhatsapp_juridica),
                        'cliEmail' => $this::lower($request->cliEmail_juridica),
                        'cliPdfrut' => $namerut,
                        'cliPdfphotocopy' => $namephotocopy,
                        'cliPdfexistence' => $nameexitence,
                        'cliPdflegal' => $namelegal
                    ]);
                    return redirect()->route('permanent.clients')->with('SuccessClient', 'Cliente jurídico con documento ' . $this::upper($request->cliNumberdocument_natural) . ', registrado');
                }else{
                    return redirect()->route('permanent.clients')->with('SecondaryClient', 'Ya existe el cliente con documento (' . $validate->cliNumberdocument . ')');
                }
                break;
            
            default:
                return redirect()->route('permanent.clients')->with('SecondaryClient', 'El tipo de cliente no esta definido');
                break;
        }
    }

    function updateClientnatural(Request $request){
        // dd($request->all());
        /*
            $request->cliNumberdocument_natural_Edit
            $request->cliNamereason_natural_Edit
            $request->cliDepartment_natural_Edit
            $request->cliMunicipality_id_natural_Edit
            $request->cliAddress_natural_Edit
            $request->cliEmail_natural_Edit
            $request->cliPhone_natural_Edit
            $request->cliMovil_natural_Edit
            $request->cliWhatsapp_natural_Edit
            $request->cliPdfrut_natural_Edit
            $request->cliPdfphotocopy_natural_Edit
            $request->cliId_Edit
            $request->cliType_Edit
        */
        $validateOther = Client::where('cliNumberdocument',trim($request->cliNumberdocument_natural_Edit))
                                        ->where('cliId','!=',trim($request->cliId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Client::find(trim($request->cliId_Edit));
            if($validate != null){
                // VALIDACION DE RUT
                if(!isset($request->rutnot_Edit)){
                    if($request->hasFile('cliPdfrut_natural_Edit')){
                        $rut = $request->file('cliPdfrut_natural_Edit');
                        // $name = $rut->getClientOriginalName();
                        $extension = $rut->extension();
                        if($validate->cliPdfrut != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfrut);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/naturales/',$rut,trim($request->cliNumberdocument_natural_Edit) . '_rut.' . $extension);
                        $namerutfinal = trim($request->cliNumberdocument_natural_Edit) . '_rut.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_natural_Edit) && $validate->cliPdfrut != null){
                            $namerutfinal = trim($request->cliNumberdocument_natural_Edit) . '_rut.pdf';
                            if($validate->cliPdfrut != $namerutfinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/naturales/'.$validate->cliPdfrut,'permanentcontractsClients/naturales/'.$namerutfinal);
                            }
                        }else{
                            $namerutfinal = $validate->cliPdfrut;
                        }
                    }
                }else{
                    if($validate->cliPdfrut != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfrut);
                    }
                    $namerutfinal = null;
                }
                // VALIDACION DE FOTOCOPIA DE CEDULA
                if(!isset($request->copynot_Edit)){
                    if($request->hasFile('cliPdfphotocopy_natural_Edit')){
                        $photocopy = $request->file('cliPdfphotocopy_natural_Edit');
                        // $name = $photocopy->getClientOriginalName();
                        $extension = $photocopy->extension();
                        if($validate->cliPdfphotocopy != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfphotocopy);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/naturales/',$photocopy,trim($request->cliNumberdocument_natural_Edit) . '_photocopy.' . $extension);
                        $namecopyfinal = trim($request->cliNumberdocument_natural_Edit) . '_photocopy.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_natural_Edit) && $validate->cliPdfphotocopy != null){
                            $namecopyfinal = trim($request->cliNumberdocument_natural_Edit) . '_photocopy.pdf';
                            if($validate->cliPdfphotocopy != $namecopyfinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/naturales/'.$validate->cliPdfphotocopy,'permanentcontractsClients/naturales/'.$namecopyfinal);
                            }
                        }else{
                            $namecopyfinal = $validate->cliPdfphotocopy;
                        }
                    }
                }else{
                    if($validate->cliPdfphotocopy != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfphotocopy);
                    }
                    $namecopyfinal = null;
                }
                $validate->cliNumberdocument = trim($request->cliNumberdocument_natural_Edit);
                $validate->cliNamereason = $this::upper($request->cliNamereason_natural_Edit);
                $validate->cliMunicipality_id = trim($request->cliMunicipality_id_natural_Edit);
                $validate->cliAddress = $this::upper($request->cliAddress_natural_Edit);
                $validate->cliPhone = trim($request->cliPhone_natural_Edit);
                $validate->cliMovil = trim($request->cliMovil_natural_Edit);
                $validate->cliWhatsapp = trim($request->cliWhatsapp_natural_Edit);
                $validate->cliEmail = $this::lower($request->cliEmail_natural_Edit);
                $validate->cliPdfrut = $namerutfinal;
                $validate->cliPdfphotocopy = $namecopyfinal;
                $validate->save();
                return redirect()->route('permanent.clients')->with('PrimaryClient', 'Cliente con documento ' . trim($request->cliNumberdocument_natural_Edit) . ', actualizado');
            }else{
                return redirect()->route('permanent.clients')->with('SecondaryClient', 'No se encuentra el cliente');
            }
        }else{
            return redirect()->route('permanent.clients')->with('SecondaryClient', 'Ya existe el cliente con documento ' . $validateOther->cliNumberdocument);
        }
    }

    function updateClientjuridica(Request $request){
        // dd($request->all());
        /*
            $request->cliNumberdocument_juridica_Edit
            $request->cliNamereason_juridica_Edit
            $request->cliNamerepresentative_juridica_Edit
            $request->cliNumberrepresentative_juridica_Edit
            $request->cliDepartment_juridica_Edit
            $request->cliMunicipality_id_juridica_Edit
            $request->cliAddress_juridica_Edit
            $request->cliEmail_juridica_Edit
            $request->cliPhone_juridica_Edit
            $request->cliMovil_juridica_Edit
            $request->cliWhatsapp_juridica_Edit
            $request->cliPdfrut_juridica_Edit
            $request->cliPdfphotocopy_juridica_Edit
            $request->cliPdfexistence_juridica_Edit
            $request->cliPdflegal_juridica_Edit
            $request->cliId_juridica_Edit
            $request->cliType_juridica_Edit
            $request->rutnot_juridica_Edit
            $request->copynot_juridica_Edit
            $request->existencenot_juridica_Edit
            $request->legalnot_juridica_Edit
        */
        $validateOther = Client::where('cliNumberdocument',trim($request->cliNumberdocument_juridica_Edit))
                                        ->where('cliId','!=',trim($request->cliId_juridica_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Client::find(trim($request->cliId_juridica_Edit));
            if($validate != null){
                // VALIDACION DE RUT
                if(!isset($request->rutnot_juridica_Edit)){
                    if($request->hasFile('cliPdfrut_juridica_Edit')){
                        $rut = $request->file('cliPdfrut_juridica_Edit');
                        // $name = $rut->getClientOriginalName();
                        $extension = $rut->extension();
                        if($validate->cliPdfrut != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfrut);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$rut,trim($request->cliNumberdocument_juridica_Edit) . '_rut.' . $extension);
                        $namerutfinal = trim($request->cliNumberdocument_juridica_Edit) . '_rut.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_juridica_Edit) && $validate->cliPdfrut != null){
                            $namerutfinal = trim($request->cliNumberdocument_juridica_Edit) . '_rut.pdf';
                            if($validate->cliPdfrut != $namerutfinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/juridicas/'.$validate->cliPdfrut,'permanentcontractsClients/juridicas/'.$namerutfinal);
                            }
                        }else{
                            $namerutfinal = $validate->cliPdfrut;
                        }
                    }
                }else{
                    if($validate->cliPdfrut != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfrut);
                    }
                    $namerutfinal = null;
                }
                // VALIDACION DE FOTOCOPIA DE CEDULA
                if(!isset($request->copynot_juridica_Edit)){
                    if($request->hasFile('cliPdfphotocopy_juridica_Edit')){
                        $photocopy = $request->file('cliPdfphotocopy_juridica_Edit');
                        // $name = $photocopy->getClientOriginalName();
                        $extension = $photocopy->extension();
                        if($validate->cliPdfphotocopy != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfphotocopy);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$photocopy,trim($request->cliNumberdocument_juridica_Edit) . '_photocopy.' . $extension);
                        $namecopyfinal = trim($request->cliNumberdocument_juridica_Edit) . '_photocopy.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_juridica_Edit) && $validate->cliPdfphotocopy != null){
                            $namecopyfinal = trim($request->cliNumberdocument_juridica_Edit) . '_photocopy.pdf';
                            if($validate->cliPdfphotocopy != $namecopyfinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/juridicas/'.$validate->cliPdfphotocopy,'permanentcontractsClients/juridicas/'.$namecopyfinal);
                            }
                        }else{
                            $namecopyfinal = $validate->cliPdfphotocopy;
                        }
                    }
                }else{
                    if($validate->cliPdfphotocopy != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfphotocopy);
                    }
                    $namecopyfinal = null;
                }
                // VALIDACION DE CERTIFICADO DE EXISTENCIA
                if(!isset($request->existencenot_juridica_Edit)){
                    if($request->hasFile('cliPdfexistence_juridica_Edit')){
                        $existence = $request->file('cliPdfexistence_juridica_Edit');
                        // $name = $existence->getClientOriginalName();
                        $extension = $existence->extension();
                        if($validate->cliPdfexistence != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfexistence);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$existence,trim($request->cliNumberdocument_juridica_Edit) . '_existence.' . $extension);
                        $nameexistencefinal = trim($request->cliNumberdocument_juridica_Edit) . '_existence.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_juridica_Edit) && $validate->cliPdfexistence != null){
                            $nameexistencefinal = trim($request->cliNumberdocument_juridica_Edit) . '_existence.pdf';
                            if($validate->cliPdfexistence != $nameexistencefinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/juridicas/'.$validate->cliPdfexistence,'permanentcontractsClients/juridicas/'.$nameexistencefinal);
                            }
                        }else{
                            $nameexistencefinal = $validate->cliPdfexistence;
                        }
                    }
                }else{
                    if($validate->cliPdfexistence != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfexistence);
                    }
                    $nameexistencefinal = null;
                }
                // VALIDACION DE REPRESENTACION LEGAL
                if(!isset($request->legalnot_juridica_Edit)){
                    if($request->hasFile('cliPdflegal_juridica_Edit')){
                        $legal = $request->file('cliPdflegal_juridica_Edit');
                        // $name = $legal->getClientOriginalName();
                        $extension = $legal->extension();
                        if($validate->cliPdflegal != null){
                            Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdflegal);
                        }
                        Storage::disk('opensoft')->putFileAs('permanentcontractsClients/juridicas/',$legal,trim($request->cliNumberdocument_juridica_Edit) . '_legal.' . $extension);
                        $namelegalfinal = trim($request->cliNumberdocument_juridica_Edit) . '_legal.' . $extension;
                    }else{
                        if($validate->cliNumberdocument != trim($request->cliNumberdocument_juridica_Edit) && $validate->cliPdflegal != null){
                            $namelegalfinal = trim($request->cliNumberdocument_juridica_Edit) . '_legal.pdf';
                            if($validate->cliPdflegal != $namelegalfinal){
                                Storage::disk('opensoft')->move('permanentcontractsClients/juridicas/'.$validate->cliPdflegal,'permanentcontractsClients/juridicas/'.$namelegalfinal);
                            }
                        }else{
                            $namelegalfinal = $validate->cliPdflegal;
                        }
                    }
                }else{
                    if($validate->cliPdfexistence != null){
                        Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdflegal);
                    }
                    $namelegalfinal = null;
                }
                $validate->cliNumberdocument = trim($request->cliNumberdocument_juridica_Edit);
                $validate->cliNamereason = $this::upper($request->cliNamereason_juridica_Edit);
                $validate->cliNamerepresentative = $this::upper($request->cliNamerepresentative_juridica_Edit);
                $validate->cliNumberrepresentative = trim($request->cliNumberrepresentative_juridica_Edit);
                $validate->cliMunicipality_id = trim($request->cliMunicipality_id_juridica_Edit);
                $validate->cliAddress = $this::upper($request->cliAddress_juridica_Edit);
                $validate->cliPhone = trim($request->cliPhone_juridica_Edit);
                $validate->cliMovil = trim($request->cliMovil_juridica_Edit);
                $validate->cliWhatsapp = trim($request->cliWhatsapp_juridica_Edit);
                $validate->cliEmail = $this::lower($request->cliEmail_juridica_Edit);
                $validate->cliPdfrut = $namerutfinal;
                $validate->cliPdfphotocopy = $namecopyfinal;
                $validate->cliPdfexistence = $nameexistencefinal;
                $validate->cliPdflegal = $namelegalfinal;
                $validate->save();
                return redirect()->route('permanent.clients')->with('PrimaryClient', 'Cliente con documento ' . trim($request->cliNumberdocument_juridica_Edit) . ', actualizado');
            }else{
                return redirect()->route('permanent.clients')->with('SecondaryClient', 'No se encuentra el cliente');
            }
        }else{
            return redirect()->route('permanent.clients')->with('SecondaryClient', 'Ya existe el cliente con documento ' . $validateOther->cliNumberdocument);
        }
    }

    function deleteClientnatural(Request $request){
        // dd($request->all());
        $foreign = Legalizationcontractual::where('lcoClient_id',trim($request->cliId_Delete))->first();
        if($foreign == null){
            $validate = Client::find(trim($request->cliId_Delete));
            if($validate != null){
                $name = $validate->cliNamereason;
                if($validate->cliPdfrut != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfrut);
                }
                if($validate->cliPdfphotocopy != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/naturales/'.$validate->cliPdfphotocopy);
                }
                $validate->delete();
                return redirect()->route('permanent.clients')->with('WarningClient', 'Cliente ' . $name . ', eliminado');
            }else{
                return redirect()->route('permanent.clients')->with('SecondaryClient', 'No se encuentra el cliente');
            }
        }else{
            return redirect()->route('permanent.clients')->with('SecondaryClient', 'Cliente ' . $foreign->client->cliNamereason . ' tiene una legalización, no es posible eliminarlo');
        }
    }

    function deleteClientjuridica(Request $request){
        // dd($request->all());
        $foreign = Legalizationcontractual::where('lcoClient_id',trim($request->cliId_juridica_Delete))->first();
        if($foreign == null){
            $validate = Client::find(trim($request->cliId_juridica_Delete));
            if($validate != null){
                $name = $validate->cliNamereason;
                if($validate->cliPdfrut != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfrut);
                }
                if($validate->cliPdfphotocopy != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfphotocopy);
                }
                if($validate->cliPdfexistence != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdfexistence);
                }
                if($validate->cliPdflegal != null){
                    Storage::disk('opensoft')->delete('permanentcontractsClients/juridicas/'.$validate->cliPdflegal);
                }
                $validate->delete();
                return redirect()->route('permanent.clients')->with('WarningClient', 'Cliente ' . $name . ', eliminado');
            }else{
                return redirect()->route('permanent.clients')->with('SecondaryClient', 'No se encuentra el cliente');
            }
        }else{
            return redirect()->route('permanent.clients')->with('SecondaryClient', 'Cliente ' . $foreign->client->cliNamereason . ' tiene una legalización, no es posible eliminarlo');
        }
    }

    /* ===============================================================================================
			MODULO DE LEGALIZACION CONTRACTUAL DE (CONTRATOS PERMANENTES)
    =============================================================================================== */

    function legalizationsTo(){
        $clients = Client::all();
        $documents = Document::all();
        $configurations = Configdocument::all();
        $legalizations = Legalizationcontractual::all();
        return view('modules.permanent.legalizations.index',compact('legalizations','configurations','clients','documents'));
    }

    function saveLegalizations(Request $request){
        // dd($request->all());
        /*
            $request->lcoDocument_id
            $request->lcoClient_id
            $request->lcoConfigdocument_id
            $request->lcoTemplate
            $request->lcoVariables
        */
        $validate = Legalizationcontractual::where('lcoClient_id',trim($request->lcoClient_id))->first();
        if($validate == null){
            $content = '';
            $variables = substr(trim($request->lcoVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                    $content = preg_replace($search, $var[0], trim($request->lcoTemplate),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            Legalizationcontractual::create([
                'lcoDocument_id' => trim($request->lcoDocument_id),
                'lcoClient_id' => trim($request->lcoClient_id),
                'lcoConfigdocument_id' => trim($request->lcoConfigdocument_id),
                'lcoContentfinal' => $content,
                'lcoWrited' => $variables
            ]);
            $client = Client::find(trim($request->lcoClient_id));
            return redirect()->route('permanent.legalizations')->with('SuccessLegalization', 'Legalizacion contractual de ' . $client->cliNamereason . ', registrada');
        }else{
            return redirect()->route('permanent.legalizations')->with('SecondaryLegalization', 'Ya existe una legalización para ' . $validate->client->cliNamereason);
        }
    }

    function updateLegalizations(Request $request){
        // dd($request->all());
        /*
            $request->lcoDocument_id_Edit
            $request->lcoClient_id_Edit
            $request->lcoConfigdocument_id_Edit
            $request->lcoTemplate_Edit
            $request->lcoVariables_Edit
            $request->lcoId_Edit
        */
        $validate = Legalizationcontractual::find(trim($request->lcoId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->lcoVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                    $content = preg_replace($search, $var[0], trim($request->lcoTemplate_Edit),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            $validate->lcoDocument_id = trim($request->lcoDocument_id_Edit);
            $validate->lcoConfigdocument_id = trim($request->lcoConfigdocument_id_Edit);
            $validate->lcoContentfinal = $content;
            $validate->lcoWrited = $variables;
            $validate->save();
            return redirect()->route('permanent.legalizations')->with('SuccessLegalization', 'Legalizacion contractual de ' . trim($request->lcoClient_id_Edit) . ', actualizada');
        }else{
            return redirect()->route('permanent.legalizations')->with('SecondaryLegalization', 'No se encuentra la legalización para ' . trim($request->lcoClient_id_Edit));
        }
    }

    function deleteLegalizations(Request $request){
        // dd($request->all());
        $validate = Legalizationcontractual::find(trim($request->lcoId_Delete));
        if($validate != null){
            $reason = $validate->client->cliNamereason;
            $validate->lcoStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('permanent.legalizations')->with('WarningLegalization', 'Legalización contractual de (' . $reason . '), Finalizada');
        }else{
            return redirect()->route('permanent.legalizations')->with('SecondaryLegalization', 'No se encuentra la legalización contractual');
        }
    }

    function pdfLegalizations(Request $request){
        // dd($request->all());
        $legalization = Legalizationcontractual::find($request->lcoId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Legalización contractual de ' . $legalization->client->cliNamereason . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.permanent.legalizations.legalizationPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('permanent.legalizations')->with('SecondaryLegalization', 'No se encuentran la legalización contractual');
        }
    }

    /* ===============================================================================================
			MODULO DE CONDICIONES ECONOMICAS DE (CONTRATOS PERMANENTES)
    =============================================================================================== */

    function conditionsTo(){
        $terms = Term::all();
        $legalizations = Legalizationcontractual::all();
        return view('modules.permanent.conditions.index',compact('terms','legalizations'));
    }

    function saveConditions(Request $request){
        // dd($request->all());
        /*
            $request->terLegalization_id
            $request->terDateinitial
            $request->terDatefinal
            $request->client_name
            $request->all_briefcase // typeBriefcase=>idBriefcase=>idservice=>service=>idVehicle=>vehicle=>valuebase
        */
        $briefcases = substr(trim($request->all_briefcase),0,-5); // QUITAR LOS ULTIMOS CARACTERES  
        $validate = Term::where('terLegalization_id',trim($request->terLegalization_id))->first();
        if($validate == null){
            Term::create([
                'terLegalization_id' => trim($request->terLegalization_id),
                'terDateinitial' => trim($request->terDateinitial),
                'terDatefinal' => trim($request->terDatefinal),
                'terBriefcase' => $briefcases
            ]);
            return redirect()->route('permanent.conditions')->with('SuccessTerm', 'Condiciones económicas de ' . trim($request->client_name) . ', registrada/s');
        }else{
            return redirect()->route('permanent.conditions')->with('SecondaryTerm', 'Ya existen condiciónes económicas para ' . trim($request->client_name));
        }   
    }

    function updateConditions(Request $request){
        // dd($request->all());
        /*
            $request->terDateinitial_Edit
            $request->terDatefinal_Edit
            $request->briefcases_select_Edit
            $request->typeService_id_Edit
            $request->all_briefcase_Edit
            $request->lcoId_Edit
            $request->cliNamereason_Edit
            $request->terId_Edit
        */
        $validate = Term::find(trim($request->terId_Edit));
        if($validate != null){
            $briefcases = substr(trim($request->all_briefcase_Edit),0,-5); // QUITAR LOS ULTIMOS CARACTERES
            $validate->terDateinitial = trim($request->terDateinitial_Edit);
            $validate->terDatefinal = trim($request->terDatefinal_Edit);
            $validate->terBriefcase = $briefcases;
            $validate->save();
            return redirect()->route('permanent.conditions')->with('PrimaryTerm', 'Condiciones económicas para  ' . trim($request->cliNamereason_Edit) . ', actualizada/s');
        }else{
            return redirect()->route('permanent.conditions')->with('SecondaryTerm', 'No se encuentran condiciones económicas');
        }
    }

    function deleteConditions(Request $request){
        // dd($request->all());
        $validate = Term::find(trim($request->terId_Delete));
        if($validate != null){
            $client = $validate->legalization->client->cliNamereason;
            $validate->terStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('permanent.conditions')->with('WarningTerm', 'Condiciones económicas para  ' . $client . ', eliminadas/s');
        }else{
            return redirect()->route('permanent.conditions')->with('SecondaryTerm', 'No se encuentra las condiciones económicas');
        }
    }

    function pdfConditions(Request $request){
        // dd($request->all());
        $term = Term::select('terms.*','terms.created_at as dateCreated','legalizationscontractual.*','clients.*','documents.*','settingmunicipalities.munName','settingdepartments.depName')
                    ->join('legalizationscontractual','legalizationscontractual.lcoId','terms.terLegalization_id')
                    ->join('clients','clients.cliId','legalizationscontractual.lcoClient_id')
                    ->join('documents','documents.docId','legalizationscontractual.lcoDocument_id')
                    ->join('settingmunicipalities','settingmunicipalities.munId','clients.cliMunicipality_id')
                    ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                    ->where('legalizationscontractual.lcoId',trim($request->terLegalization_id))
                    ->first();
        if($term != null){
            // typeBriefcase=>idBriefcase=>idservice=>service=>idVehicle=>vehicle=>valuebase
            $briefcase = array();
            $find = strpos($term->terBriefcase,'<=|=>');
            if($find === false){
                $separatedBriefcase =  explode('=>', $term->terBriefcase);
                array_push($briefcase,[
                    $separatedBriefcase[0],
                    $separatedBriefcase[3],
                    $separatedBriefcase[5],
                    $separatedBriefcase[6]
                ]);
            }else{
                $separated =  explode('<=|=>', $term->terBriefcase);
                for ($i=0; $i < count($separated); $i++) {
                    $separatedBriefcase =  explode('=>', $separated[$i]);
                    array_push($briefcase,[
                        $separatedBriefcase[0],
                        $separatedBriefcase[3],
                        $separatedBriefcase[5],
                        $separatedBriefcase[6]
                    ]);
                }
                    
            }


            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Condiciones económicas de ' . $term->cliNamereason . ' descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.permanent.conditions.conditionPdf',compact('technical','term','briefcase'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('permanent.conditions')->with('SecondaryTerm', 'No se encuentran las condiciones ecómonicas');
        }
    }

    /* ===============================================================================================
			MODULO DE ARCHIVO DE CONTRATOS DE (CONTRATOS PERMANENTES)
    =============================================================================================== */

    function recordsTo(){
        $legalizations = Legalizationcontractual::all();
        return view('modules.permanent.records.index',compact('legalizations'));
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICA DE (CONTRATOS PERMANENTES)
    =============================================================================================== */

    function statisticTo(){
        $year = date('Y');
        $datesAll = $this->getLegalizations($year);
        return view('modules.permanent.statistic.index',compact('datesAll'));
    }

    function getLegalizations($year){
        $result = array();
        for ($i=1; $i <= 12; $i++) {
            $termnow = Legalizationcontractual::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('lcoStatus','VIGENTE')->count();
            $termnot = Legalizationcontractual::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('lcoStatus','TERMINADO')->count();
            $result[$i][0] = $termnow;
            $result[$i][1] = $termnot;
        }
        return $result;
    }

    function getLegalizationsnow(Request $request){
        $now = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $termnow = Legalizationcontractual::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('lcoStatus','VIGENTE')->count();
            array_push($now, $termnow);
        }
        return $now;
    }

    function getLegalizationsnot(Request $request){
        $not = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $termnot = Legalizationcontractual::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('lcoStatus','TERMINADO')->count();
            array_push($not, $termnot);
        }
        return $not;
    }

    function getMount($numberMount){
        return ($numberMount<10 ? '0' : '') . $numberMount;
    }

    function numberDays($mount,$year){
        $days = date("t", strtotime($year . '-' . $mount . '-15'));
        return $days;
        //dd(cal_days_in_month(CAL_GREGORIAN,$mount,$year));
        //return cal_days_in_month(CAL_GREGORIAN,$mount,$year);
    }
}
