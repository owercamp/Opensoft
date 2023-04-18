<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\BillsPay;
use Illuminate\Http\Request;
use App\Models\CustomerRating;
use App\Models\AccountsReceivable;
use App\Models\BouchersServices;
use App\Models\Settingmunicipality;
use Illuminate\Support\Facades\DB;

class BouchersServicesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function liquidateApproved(Request $request)
	{
		/** VALIDACION DE DATOS **/
		$this->validate($request, [
			'typeservices' => 'required',
			'origin' => 'required',
			'destiny' => 'required',
			'colaborator' => 'required',
			'price' => 'required',
		]);

		/** TRATAMIENTO DE VARIABLE **/
		$typeservices = trim($request->typeservices);
		$origin = Settingmunicipality::where('munName',trim($request->origin))->value('munId');
		$destiny =  Settingmunicipality::where('munName',trim($request->destiny))->value('munId');
		$collaborator = trim($request->colaborator);
		$price = explode('COP', $request->price);
		$priceSave = trim(str_replace(".","",$price[0]));

		DB::beginTransaction();
		try {
			$qualification = new CustomerRating();
			$qualification->typeservices = $typeservices;
			$qualification->origin = $origin;
			$qualification->destiny = $destiny;
			$qualification->collaborator = $collaborator;
			$qualification->date = $request->date;
			if ($qualification->save()) {
				$pay = new BillsPay();
				$pay->typeservices = $typeservices;
				$pay->origin = $origin;
				$pay->destiny = $destiny;
				$pay->collaborator = $collaborator;
				$pay->price = intval($priceSave);
				$pay->date = $request->date;
				if ($pay->save()) {
					$receivable = new AccountsReceivable();
					$receivable->typeservices = $typeservices;
					$receivable->origin = $origin;
					$receivable->destiny = $destiny;
					$receivable->collaborator = $collaborator;
					$receivable->price = intval($priceSave);
					$receivable->date = $request->date;
					if ($receivable->save()) {
						BouchersServices::where([
							['typeservices',$typeservices],
							['origin',$origin],
							['destiny',$destiny],
							['colaborator',$collaborator]
						])->update(['status' => 'FACTURADO']);
            DB::commit();
						return redirect()->route('settlement.operators')->with('Info','Liquidación de servicio realizado con exito !!');
					}
				}
			}
		}catch(Throwable $th) {
			$errors = $th->getMessage();
			DB::rollBack();
			return back()->with('Error', "Ha ocurrido un error al intentar realizar la LIQUIDACION DEL SERVICIO, contacte con el administrador");
		}
	}
}
