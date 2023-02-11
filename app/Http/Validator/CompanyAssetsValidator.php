<?php

namespace App\Http\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyAssetsValidator{

    public function validateInfo(Request $request){
        if(empty($request->serial_code)){
            return response()->json([
                'message' => 'El código es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->trademark)){
            return response()->json([
                'message' => 'La marca es obligatoria',
                'state' => '400',
            ]);
        }

        if(empty($request->reference)){
            return response()->json([
                'message' => 'La referencia es obligatoria',
                'state' => '400',
            ]);
        }

        if(empty($request->description)){
            return response()->json([
                'message' => 'La descripcion es obligatoria',
                'state' => '400',
            ]);
        }

        return response()->json([
            'message' => 'Validación exitosa',
            'state' => '200',
        ]);
    }

    public function validateCode(Request $request){

        $getByCode = DB::table('company_assets')
        ->where('serial_code', '=', $request->serial_code)
        ->get();

    if(count($getByCode) != 0){
        return response()->json([
            'message' => 'Ya existe un elemento con el número código indicado',
            'state' => '400',
        ]);
    }

    return response()->json([
        'message' => 'Validación exitosa',
        'state' => '200',
    ]);
    }
}