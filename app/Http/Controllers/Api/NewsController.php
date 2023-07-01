<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\EditNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Exception;

class NewsController extends Controller
{

    public function index(){

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Haberler başarıyla listelendi.',
            'data' =>News::all()
        ]);
    }


    public function store(CreateNewsRequest $request){

        
        try{
        //   $file = $request->file('file');
        //   $fileName = $file->getClientOriginalName();
        //   $file->move(public_path('uploads'), $fileName);
  
          $news = new News();
  
          $news->newsDesc=$request->newsDesc;
          //$news->imageUrl=$fileName;
          $news->title=$request->title;
          $news->category=$request->category;
          $news->save();
  
          return response()->json([
              'status_code' => 200,
              'status_message' => 'Haberler başarıyla kaydedildi.',
              'data' =>$news
          ]);
        }
        catch (Exception $e){
          return response()->json($e);
        }
  
      } //End Method


      public function update(EditNewsRequest $request, News $event){

        try{        
         
            $event->title=$request->title;
            $event->newsDesc=$request->newsDesc;
            $event->category=$request->category;
        
            $event->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Haberler başarıyla güncellendi.',
                'data' =>$event
            ]);
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    
        }//End Method
        
        public function delete(News $news){
            try {
                if($news){
                    $news->delete();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Haberler başarıyla silindi.',
                    'data' =>$news
                ]);
                }else{
    
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Haberler bulunamadı.',
                ]);
                }
    
            } catch (Exception $e) {
                return response()->json($e);
            }
        }//End Method    
}
