<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Alliesmessenger;
use App\Models\Alliescharge;
use App\Models\Alliesespecial;
use App\Models\Settingpersonal;
use App\Models\Settingdepartment;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CUENTAS POR COBRAR
    =============================================================================================== */
    
    function accountreceivableTo(){
        return view('modules.accounts.receivable.index');
    }

    /* ===============================================================================================
			MODULO DE CUENTAS POR PAGAR
    =============================================================================================== */
    
    function accountpayTo(){
        return view('modules.accounts.topay.index');
    }
}
