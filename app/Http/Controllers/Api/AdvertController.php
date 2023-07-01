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

        try {
            $query = Advert::query();
            $perPage =1;
            $page = $request->input('page',1);
            $search = $request->input('search');
    
    
            if($request){
                $query->whereRaw("title LIKE '%" . $search . "%'");
            }
            
            $total = $query->count();
            $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'İlanlar başarıyla listelendi.',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'items' => $result
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }



    }//End Method

    public function store(CreateAdvertRequest $request){

        
      try{
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        $advert = new Advert();

        $advert->title=$request->title;
        $advert->advertDesc=$request->descripadvertDescion;
        $advert->category=$request->category;
        $advert->imageUrl=$fileName;
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
        $advert->advertDesc=$request->advertDesc;
        $advert->category=$request->category;
    
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
