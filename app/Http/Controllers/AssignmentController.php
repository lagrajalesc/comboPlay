<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use App\Http\Validator\AssignmentValidator;

class AssignmentController extends Controller
{
    public function getAssignment(){

        if(count(Assignment::all()) == 0){
            return response()->json([
                'message' => "No se encontraron activos asignados a empleados",
                'state' => '204',
            ]);
        }

        return response()->json([
            'message' => "Estos son los activos asignados",
            'activos' =>Assignment::all(),
            'state' => '200',
        ]);

    }

    public function createAssignment(Request $request){

        $validator = new AssignmentValidator();
        $validateAssignment= collect($validator->validateInfo($request));
        if($validateAssignment['original']['state'] == 400){
            return response()->json([
                'message' => $validateAssignment['original']['message'],
                'state' => '400',
            ]);
        }

        $assigner = $request->assigner;
        $payload = $request->payload;

        $request = request()->all();
        Assignment::create($request);

        $logId = DB::table('assignment')
            ->select('id')
            ->orderby('created_at', 'desc')
            ->take(1)
            ->get();

        $addLog = DB::table('log_assignment')
            ->insert([
                'assignment_id' => $logId[0]->id,
                'assigner' =>  $assigner,
                'payload' => json_decode($payload)  
            ]);


        return response()->json([
            'message' => 'Se ha realizado la asignación del activo correctamente',
            'state' => '200',
        ]);
    }

    public function deleteAssignment(Request $request){
        $assignment = Assignment::find($request->id);
        if(empty($assignment)){
            return response()->json([
                'message' => 'no se enocontró ninguna asignación',
                'state' => '400',
            ]);
        }

        $assignment->delete();
        return response()->json([
            'message' => 'La asignación ha sido eliminada',
            'state' => '200',
        ]);
    }

    public function updateAssignment(Request $request){

        $validator = new AssignmentValidator();
        $validateAssignment= collect($validator->validateInfo($request));
        if($validateAssignment['original']['state'] == 400){
            return response()->json([
                'message' => $validateAssignment['original']['message'],
                'state' => '400',
            ]);
        }

        $assignment = Assignment::find($request->id);
        if(empty($assignment)){
            return response()->json([
                'message' => 'no se enocontró ninguna asignación',
                'state' => '400',
            ]);
        }
        
        $getByNumberId = DB::table('assignment')
        ->where('id', '=', $request->id)
        ->update([
            'company_assets_id' => $request->company_assets_id,
            'empleoyee_id' => $request->empleoyee_id,
        ]);

        return response()->json([
            'message' => 'La asignación se ha actualizado exitosamente',
            'state' => '200',
        ]);
    }
}
