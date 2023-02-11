<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleoyee;
use Illuminate\Support\Facades\DB;
use App\Http\Validator\ValidatorEmpleoyee;

class EmpleoyeeController extends Controller
{
    public function getEmpleoyee(){
        
        if(count(Empleoyee::all()) == 0){
            return response()->json([
                'message' => "No se encontraron activos registrados",
                'state' => '204',
            ]);
        }

        return response()->json([
            'message' => "Estos son los activos encontrados",
            'activos' =>Empleoyee::all(),
            'state' => '200',
        ]);

    }

    public function createEmpleoyee(Request $request){

        $validator = new ValidatorEmpleoyee();
        $validateEmpleoyee = collect($validator->validateInfo($request));
        $validateIdNumber = collect($validator->getByDocument_Number($request));
        if($validateEmpleoyee['original']['state'] == 400){
            return response()->json([
                'message' => $validateEmpleoyee['original']['message'],
                'state' => '400',
            ]);
        }
        if($validateIdNumber['original']['state'] == 400){
            return response()->json([
                'message' => $validateIdNumber['original']['message'],
                'state' => '400',
            ]);
        }

        $request = request()->all();
        Empleoyee::create($request);
        return response()->json([
            'message' => 'El empleado se ha creado exitosamente',
            'state' => '200',
        ]);
    }

    public function deleteEmpleoyee(Request $request){
        $empleoyee = Empleoyee::find($request->id);
        if(empty($empleoyee)){
            return response()->json([
                'message' => 'no se enocontró ningún empleado',
                'state' => '204',
            ]);
        }

        $empleoyee->delete();
        return response()->json([
            'message' => 'El empleado ha sido eliminado',
            'state' => '200',
        ]);
    }

    public function updateEmpleoyee(Request $request){
        $validator = new ValidatorEmpleoyee();
        $validateEmpleoyee = collect($validator->validateInfo($request));
        if($validateEmpleoyee['original']['state'] != 200){
            return $validateEmpleoyee['original']['message'];
        }

        $empleoyee = Empleoyee::find($request->id);
        if(empty($empleoyee)){
            return response()->json([
                'message' => 'no se enocontró ningún empleado',
                'state' => '204',
            ]);
        }
        
        $getByNumberId = DB::table('empleoyee')
        ->where('id', '=', $request->id)
        ->update([
            'name' => $request->name,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'position' => $request->position,
            'department' => $request->department
        ]);

        return response()->json([
            'message' => 'El empleado se ha actualizado exitosamente',
            'state' => '200',
        ]);
    }

}

