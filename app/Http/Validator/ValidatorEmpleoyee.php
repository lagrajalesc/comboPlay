<?php

namespace App\Http\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidatorEmpleoyee{

    public function validateInfo(Request $request){

        if(empty($request->name)){
            return response()->json([
                'message' => 'El nombre es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->document_type)){
            return response()->json([
                'message' => 'el tipo de documento de identificación es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->document_number)){
            return response()->json([
                'message' => 'el número de identificación es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->position)){
            return response()->json([
                'message' => 'el cargo es obligatorio',
                'state' => '400',
            ]);
        }

        if(empty($request->department)){
            return response()->json([
                'message' => 'el área es obligatoria',
                'state' => '400',
            ]);
        }

        return response()->json([
            'message' => 'Validación exitosa',
            'state' => '200',
        ]);
    }

    public function getByDocument_Number(Request $request){

        $getByNumberId = DB::table('empleoyee')
            ->where('document_number', '=', $request->document_number)
            ->get();

        if(count($getByNumberId) != 0){
            return response()->json([
                'message' => 'Ya existe un empleado con el número de identificación indicado',
                'state' => '400',
            ]);
        }

        return response()->json([
            'message' => 'Validación exitosa',
            'state' => '200',
        ]);
    }
}