<?php

namespace App\Http\Validator;

use Illuminate\Http\Request;

class AssignmentValidator {

    public function validateInfo(Request $request){

        if(empty($request->empleoyee_id)){
            return response()->json([
                'message' => 'El empleado es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->company_assets_id)){
            return response()->json([
                'message' => 'El activo es obligatorio',
                'state' => '400',
            ]);
        }

        return response()->json([
            'message' => 'Validación exitosa',
            'state' => '200',
        ]);
    }
}