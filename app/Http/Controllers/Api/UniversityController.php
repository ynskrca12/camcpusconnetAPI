<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUniversityRequest;
use App\Http\Requests\EditUniversityRequest;
use App\Models\University;
use Illuminate\Http\Request;
use Exception;

class UniversityController extends Controller
{

    public function index(){

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Üniversiteler başarıyla listelendi.',
            'data' =>University::all()
        ]);
    }


    public function store(CreateUniversityRequest $request){

        
        try{
        //   $file = $request->file('file');
        //   $fileName = $file->getClientOriginalName();
        //   $file->move(public_path('uploads'), $fileName);
  
          $university = new University();
  
          $university->name=$request->name;
          $university->description=$request->description;
          $university->university_city=$request->university_city;
          $university->save();
  
          return response()->json([
              'status_code' => 200,
              'status_message' => 'Üniversite başarıyla kaydedildi.',
              'data' =>$university
          ]);
        }
        catch (Exception $e){
          return response()->json($e);
        }
  
      } //End Method


      public function update(EditUniversityRequest $request, University $university){

        try{        
         
            $university->name=$request->name;
            $university->description=$request->description;
            $university->university_city=$request->university_city;
        
            $university->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Üniversite başarıyla güncellendi.',
                'data' =>$university
            ]);
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    
        }//End Method
        
        public function delete(University $university){
            try {
                if($university){
                    $university->delete();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Üniversite başarıyla silindi.',
                    'data' =>$university
                ]);
                }else{
    
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Üniversite bulunamadı.',
                ]);
                }
    
            } catch (Exception $e) {
                return response()->json($e);
            }
        }//End Method    
}
