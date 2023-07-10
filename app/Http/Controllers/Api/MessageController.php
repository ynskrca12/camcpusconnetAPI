<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Exception;

class PostController extends Controller
{

    public function index(){

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Mesajlar başarıyla listelendi.',
            'data' =>Message::all()
        ]);
    }


    public function store(Request $request){

        
        try{
       
  
          $message = new Message();

          $message->advertId=$request->advertId;
          $message->message=$request->message;
          $message->date=$request->date;
          $message->receiverEmail=$request->receiverEmail;
          $message->senderEmail=$request->senderEmail;

          $message->save();
  
          return response()->json([
              'status_code' => 200,
              'status_message' => 'Post başarıyla kaydedildi.',
              'data' =>$message
          ]);
        }
        catch (Exception $e){
          return response()->json($e);
        }
  
      } //End Method


      public function update(Request $request, Message $message){

        try{        
         
            $message->advertId=$request->advertId;
            $message->message=$request->message;
            $message->date=$request->date;
            $message->receiverEmail=$request->receiverEmail;
            $message->senderEmail=$request->senderEmail;
            
            $message->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Post başarıyla güncellendi.',
                'data' =>$message
            ]);
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    
        }//End Method
        
        public function delete(Message $message){
            try {
                if($message){
                    $message->delete();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Mesaj başarıyla silindi.',
                    'data' =>$message
                ]);
                }else{
    
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Post bulunamadı.',
                ]);
                }
    
            } catch (Exception $e) {
                return response()->json($e);
            }
        }//End Method    
}
