<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyAssets;
use App\Http\Validator\CompanyAssetsValidator;
use Illuminate\Support\Facades\DB;

class CompanyAssetsController extends Controller
{

    public function getCompanyAssets(){
        if(count(CompanyAssets::all()) == 0){
            return response()->json([
                'message' => "No se encontraron activos registrados",
                'state' => '204',
            ]);
        }

        return response()->json([
            'message' => "Estos son los activos encontrados",
            'activos' =>CompanyAssets::all(),
            'state' => '200',
        ]);

    }

    public function createCompanyAssets(Request $request){

        $validator = new CompanyAssetsValidator();
        $validateCompanyAssets= collect($validator->validateInfo($request));
        $validateCode = collect($validator->validateCode($request));
        if($validateCompanyAssets['original']['state'] == 400){
            return response()->json([
                'message' => $validateCompanyAssets['original']['message'],
                'state' => '400',
            ]);
        }
        if($validateCode['original']['state'] == 400){
            return response()->json([
                'message' => $validateCode['original']['message'],
                'state' => '400',
            ]);
        }

        $request = request()->all();
        CompanyAssets::create($request);
        return response()->json([
            'message' => 'El activo se ha creado exitosamente',
            'state' => '200',
        ]);
    }

    public function deleteCompanyAssets(Request $request){
        $companyAsset = CompanyAssets::find($request->id);
        if(empty($companyAsset)){
            return response()->json([
                'message' => 'no se enocontró ningún activo',
                'state' => '400',
            ]);
        }

        $companyAsset->delete();
        return response()->json([
            'message' => 'El activo ha sido eliminado',
            'state' => '200',
        ]);
    }

    public function updateCompanyAssets(Request $request){

        $validator = new CompanyAssetsValidator();
        $validateCompanyAssets= collect($validator->validateInfo($request));
        if($validateCompanyAssets['original']['state'] == 400){
            return response()->json([
                'message' => $validateCompanyAssets['original']['message'],
                'state' => '400',
            ]);
        }

        $companyAsset = CompanyAssets::find($request->id);
        if(empty($companyAsset)){
            return response()->json([
                'message' => 'no se enocontró ningún activo',
                'state' => '204',
            ]);
        }
        
        $getByNumberId = DB::table('company_assets')
        ->where('id', '=', $request->id)
        ->update([
            'serial_code' => $request->serial_code,
            'trademark' => $request->trademark,
            'reference' => $request->reference,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'El activo se ha actualizado exitosamente',
            'state' => '200',
        ]);
    }
}
