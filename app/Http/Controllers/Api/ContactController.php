<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\EditContactRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){       

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Contact başarıyla listelendi.',
                'data' =>Contact::all()
            ]); 

    }//End Method

    public function store(CreateContactRequest $request){

        
      try{

        $contact = new Contact();

        $contact->message=$request->title;
        $contact->email=$request->email;
     
        $contact->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'contact başarıyla kaydedildi.',
            'data' =>$contact
        ]);
      }
      catch (Exception $e){
        return response()->json($e);
      }

    } //End Method
    
    public function update(EditContactRequest $request, Contact $contact){

    try{        
        $contact->message=$request->title;
        $contact->email=$request->email;
    
        $contact->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'ilan başarıyla güncellendi.',
            'data' =>$contact
        ]);
    }
    catch (Exception $e) {
        return response()->json($e);
    }


    }//End Method

    public function delete(Contact $contact){
        try {
            if($contact){
                $contact->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'contact başarıyla silindi.',
                'data' =>$contact
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
