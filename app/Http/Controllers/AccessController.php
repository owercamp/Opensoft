<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE ROLES
    =============================================================================================== */
    
    function RolesTo(){
        return view('modules.access.roles.index');
    }

    /* ===============================================================================================
			MODULO DE PERMISOS
    =============================================================================================== */

    function permissionsTo(){
        return view('modules.access.permissions.index');
    }

    /* ===============================================================================================
			MODULO DE USUARIOS
    =============================================================================================== */

    function usersTo(){
        $users = User::all()
        ->where('id','!=', auth()->id())
        ->where('id','!=', '1024537577');
        return view('modules.access.users.index',compact('users'));
    }
}
