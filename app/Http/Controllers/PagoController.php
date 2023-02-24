<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $pago = new Pago();
            $pago->idpago = $request->idpago;
            $pago->email = $request->email;
            $pago->idaccount = $request->idaccount;
            $pago->value = $request->value;
            $pago->currencycode = $request->currencycode;
            $pago->save();
            return response()->json(['message' => 'All okay'], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Error while storing the payment'], 200);
        }
        
    }
    
    public function getCsrf(){
        return response()->json(['csrf' => csrf_token()], 200);
    }
}
