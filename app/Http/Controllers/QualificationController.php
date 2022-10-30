<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QualificationController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE CALIFICACION DEL USUARIO DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */

  function usersTo()
  {
    return view('modules.qualifications.users.index');
  }

  public function usersToServerSide(Request $request)
  {
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '-1');

    /** COLUMNAS DE LA TABLA **/
    $columns = array(
      0 => 'type_service',
      1 => 'origin',
      2 => 'collaborator',
      3 => 'star',
      4 => 'comment'
    );

    $consulta = DB::table('customer_ratings')
      ->join('settingmunicipalities', 'settingmunicipalities.munId', 'customer_ratings.origin')
      ->join('settingmunicipalities as mun', 'mun.munId', 'customer_ratings.destiny')
      ->select('customer_ratings.typeservices AS type_service', 'settingmunicipalities.munName AS origin', 'mun.munName AS destiny', 'customer_ratings.collaborator AS collaborator', 'customer_ratings.stars AS star', 'customer_ratings.comments AS comment');

    /** VALORES PARA DATATABLE **/
    $totalData = $consulta->count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $clausulas = $consulta;
      $totalFiltered = $clausulas->count();
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order, $dir)->get();
    } else {
      $search = $request->input('search.value');
      $clausulas = $consulta->where("customer_ratings.typeservices", "like", "%{$search}%");
      $clausulas = $consulta->orWhere("settingmunicipalities.munName", "like", "%{$search}%");
      $clausulas = $consulta->orWhere("customer_ratings.collaborator", "like", "%{$search}%");
      $clausulas = $consulta->orWhere("customer_ratings.stars", "like", "%{$search}%");
      $clausulas = $consulta->orWhere("customer_ratings.comments", "like", "%{$search}%");

      $totalFiltered = $clausulas->count();
      $posts = $clausulas->offset($start)->limit($limit)->orderBy($order, $dir)->get();
    }
    $data = array();
    if ($posts) {
      foreach ($posts as $service) {
        $nestedData['type_service'] = $service->type_service;
        $nestedData['origin'] = $service->origin . " - " . $service->destiny;
        $nestedData['collaborator'] = $service->collaborator;
        $nestedData['star'] = $service->star;
        $nestedData['comment'] = $service->comment;
        $data[] = $nestedData;
      }
    }

    $json_data = array(
      "draw"            => intval($request->input('draw')),
      "recordsTotal"    => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data"            => $data
    );
    return json_encode($json_data);
  }

  /* ===============================================================================================
			MODULO DE CALIFICACION DEL OPERADOR DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */

  function operatorsTo()
  {
    return view('modules.qualifications.operators.index');
  }

  /* ===============================================================================================
			MODULO DE ESTADISTICA DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */

  function statisticsTo()
  {
    return view('modules.qualifications.statistics.index');
  }

  /* ===========================================================================================================
            FUNCIONES PARA CONVERTIR CADENAS DE TEXTO (Mayusculas/Minusculas/Solo primera en Mayuscula)
    =========================================================================================================== */

  function upper($string)
  {
    return mb_strtoupper(trim($string), 'UTF-8');
  }

  function lower($string)
  {
    return mb_strtolower(trim($string), 'UTF-8');
  }

  function fu($string)
  {
    return ucfirst(mb_strtolower(trim($string), 'UTF-8'));
  }
}
