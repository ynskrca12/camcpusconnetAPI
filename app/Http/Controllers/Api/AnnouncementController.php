<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Http\Requests\EditAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Exception;

class AnnouncementController extends Controller
{

    public function index(){

        return response()->json([
            'status_code' => 200,
            'status_message' => 'announcements başarıyla listelendi.',
            'data' =>Announcement::all()
        ]);
    }


    public function store(CreateAnnouncementRequest $request){

        
        try{
          $file = $request->file('file');
          $fileName = $file->getClientOriginalName();
          $file->move(public_path('uploads'), $fileName);
  
          $announcement = new Announcement();
  
          $announcement->description=$request->description;
          $announcement->category=$request->category;
          $announcement->images=$fileName;
          $announcement->title=$request->title;
          $announcement->university=$request->university;
          $announcement->date=$request->date;
          $announcement->save();
  
          return response()->json([
              'status_code' => 200,
              'status_message' => 'Duyurular başarıyla kaydedildi.',
              'data' =>$announcement
          ]);
        }
        catch (Exception $e){
          return response()->json($e);
        }
  
      } //End Method


      public function update(EditAnnouncementRequest $request, Announcement $announcement){

        try{        
         
            $announcement->description=$request->description;
            $announcement->category=$request->category;
            $announcement->title=$request->title;
            $announcement->university=$request->university;
            $announcement->date=$request->date;
        
            $announcement->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Duyurular başarıyla güncellendi.',
                'data' =>$announcement
            ]);
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    
        }//End Method
        
        public function delete(Announcement $announcement){
            try {
                if($announcement){
                    $announcement->delete();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Duyurular başarıyla silindi.',
                    'data' =>$announcement
                ]);
                }else{
    
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Duyurular bulunamadı.',
                ]);
                }
    
            } catch (Exception $e) {
                return response()->json($e);
            }
        }//End Method    
}
