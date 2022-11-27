<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE CUENTAS POR COBRAR
    =============================================================================================== */

  function accountreceivableTo()
  {
    return view('modules.accounts.receivable.index');
  }

  function accountServerSide(Request $request)
  {
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '-1');

    /**
     * columnas de la tabla
     */
    $columns = array(
      0 => 'services',
      1 => 'origin',
      2 => 'collaborator',
      3 => 'price',
      4 => 'action'
    );

    $consulta = DB::table('accounts_receivables')
      ->join('settingmunicipalities', 'settingmunicipalities.munId', 'accounts_receivables.origin')
      ->join('settingmunicipalities as mun', 'mun.munId', 'accounts_receivables.destiny')
      ->whereMonth('date',$request->month)
      ->select('accounts_receivables.typeservices AS services', 'settingmunicipalities.munName AS origin', 'mun.munName AS destiny', 'accounts_receivables.collaborator AS collaborator','accounts_receivables.price AS price',"accounts_receivables.id as id");

    $totalData = $consulta->count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $clausulas = $consulta;
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order,$dir)->get();
      $totalFiltered = $totalData;
    } else {
      $search = $request->input('search.value');
      $clausulas = $consulta->where("accounts_receivables.typeservices","%like%","{$search}");
      $clausulas = $consulta->orWhere("settingmunicipalities.munName","like","%{$search}%");
      $clausulas = $consulta->orWhere("mun.munName","like","%{$search}%");
      $clausulas = $consulta->orWhere("accounts_receivables.collaborator","like","%{$search}%");
      $clausulas = $consulta->orWhere("accounts_receivables.price","like","%{$search}%");
      $totalFiltered = $clausulas->count();
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order,$dir)->get();
    }
    
    $data = array();
    if ($posts) {
      foreach ($posts as $key => $receivable) {
        $nestedData['services'] = $receivable->services;
        $nestedData['origin'] = $receivable->origin." - ".$receivable->destiny;
        $nestedData['collaborator'] = $receivable->collaborator;
        $nestedData['price'] = number_format($receivable->price,0,",",".");
        $nestedData['action'] = $receivable;
        $data[] = $nestedData;
      }
    }
    $json_data = array(
      "draw"            =>intval($request->input('draw')),
      "recordsTotal"    =>intval($totalData),
      "recordsFilteres" =>intval($totalFiltered),
      "data"            =>$data
    );

    return json_encode($json_data);
  }

  /* ===============================================================================================
			MODULO DE CUENTAS POR PAGAR
    =============================================================================================== */

  function accountpayTo()
  {
    return view('modules.accounts.topay.index');
  }

  function accountpayToServer(Request $request)
  {
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '-1');

    /**
     * columnas de la tabla
     */
    $columns = array(
      0 => 'services',
      1 => 'origin',
      2 => 'collaborator',
      3 => 'price',
      4 => 'action'
    );

    $consulta = DB::table('bills_pays')
      ->join('settingmunicipalities', 'settingmunicipalities.munId', 'bills_pays.origin')
      ->join('settingmunicipalities as mun', 'mun.munId', 'bills_pays.destiny')
      ->whereMonth('date',$request->month)
      ->select('bills_pays.typeservices AS services', 'settingmunicipalities.munName AS origin', 'mun.munName AS destiny', 'bills_pays.collaborator AS collaborator','bills_pays.price AS price','bills_pays.id as id');

    // dd($consulta->get(), $request->month,$request->request);

    $totalData = $consulta->count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $clausulas = $consulta;
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order,$dir)->get();
      $totalFiltered = $totalData;
    } else {
      $search = $request->input('search.value');
      $clausulas = $consulta->where("bills_pays.typeservices","%like%","{$search}");
      $clausulas = $consulta->orWhere("settingmunicipalities.munName","like","%{$search}%");
      $clausulas = $consulta->orWhere("mun.munName","like","%{$search}%");
      $clausulas = $consulta->orWhere("bills_pays.collaborator","like","%{$search}%");
      $clausulas = $consulta->orWhere("bills_pays.price","like","%{$search}%");
      $totalFiltered = $clausulas->count();
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order,$dir)->get();
    }
    
    $data = array();
    if ($posts) {
      foreach ($posts as $key => $pay) {
        $nestedData['services'] = $pay->services;
        $nestedData['origin'] = $pay->origin." - ".$pay->destiny;
        $nestedData['collaborator'] = $pay->collaborator;
        $nestedData['price'] = number_format($pay->price,0,",",".");
        $nestedData['action'] = $pay;
        $data[] = $nestedData;
      }
    }
    $json_data = array(
      "draw"            =>intval($request->input('draw')),
      "recordsTotal"    =>intval($totalData),
      "recordsFilteres" =>intval($totalFiltered),
      "data"            =>$data
    );

    return json_encode($json_data);
  }
}
