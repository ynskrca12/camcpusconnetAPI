<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\EditEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Exception;

class AnnouncementController extends Controller
{

    public function index(){

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Eventler başarıyla listelendi.',
            'data' =>Event::all()
        ]);
    }


    public function store(CreateEventRequest $request){

        
        try{
          $file = $request->file('file');
          $fileName = $file->getClientOriginalName();
          $file->move(public_path('uploads'), $fileName);
  
          $event = new Event();
  
          $event->description=$request->description;
          $event->date=$request->date;
          $event->images=$fileName;
          $event->title=$request->title;
          $event->email=$request->email;
          $event->university=$request->university;
          $event->save();
  
          return response()->json([
              'status_code' => 200,
              'status_message' => 'Olaylar başarıyla kaydedildi.',
              'data' =>$event
          ]);
        }
        catch (Exception $e){
          return response()->json($e);
        }
  
      } //End Method


      public function update(EditEventRequest $request, Event $event){

        try{        
         
            $event->description=$request->description;
            $event->date=$request->date;
            $event->title=$request->title;
            $event->email=$request->email;
            $event->university=$request->university;
        
            $event->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Olaylar başarıyla güncellendi.',
                'data' =>$event
            ]);
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    
        }//End Method
        
        public function delete(Event $event){
            try {
                if($event){
                    $event->delete();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Olaylar başarıyla silindi.',
                    'data' =>$event
                ]);
                }else{
    
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Olaylar bulunamadı.',
                ]);
                }
    
            } catch (Exception $e) {
                return response()->json($e);
            }
        }//End Method    
}
