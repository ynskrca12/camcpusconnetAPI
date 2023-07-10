<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdvertRequest;
use App\Http\Requests\EditAdvertRequest;
use App\Models\Advert;
use Exception;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index(Request $request){       

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Advert başarıyla listelendi.',
                'data' =>Advert::all()
            ]);
    }//End Method

    public function store(CreateAdvertRequest $request){

        
      try{
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        $advert = new Advert();

        $advert->title=$request->title;
        $advert->email=$request->email;
        $advert->name=$request->name;
        $advert->description=$request->description;
        $advert->category=$request->category;
        $advert->university=$request->university;
        $advert->images=$fileName;
        $advert->address=$request->address;
        $advert->price=$request->price;
        $advert->date=$request->date;
        $advert->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'İlan başarıyla kaydedildi.',
            'data' =>$advert
        ]);
      }
      catch (Exception $e){
        return response()->json($e);
      }

    } //End Method
    
    public function update(EditAdvertRequest $request, Advert $advert){

    try{        
     
        $advert->title=$request->title;
        $advert->email=$request->email;
        $advert->name=$request->name;
        $advert->description=$request->description;
        $advert->category=$request->category;
        $advert->university=$request->university;
        $advert->address=$request->address;
        $advert->price=$request->price;
        $advert->date=$request->date;
    
        $advert->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'ilan başarıyla güncellendi.',
            'data' =>$advert
        ]);
    }
    catch (Exception $e) {
        return response()->json($e);
    }


    }//End Method

    public function delete(Advert $advert){
        try {
            if($advert){
                $advert->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'İlan başarıyla silindi.',
                'data' =>$advert
            ]);
            }else{

            return response()->json([
                'status_code' => 422,
                'status_message' => 'İlan bulunamadı.',
            ]);
            }

        } catch (Exception $e) {
            return response()->json($e);
        }
    }//End Method
}
