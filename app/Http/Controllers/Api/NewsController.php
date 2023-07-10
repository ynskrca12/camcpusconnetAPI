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
           $file = $request->file('file');
          $fileName = $file->getClientOriginalName();
           $file->move(public_path('uploads'), $fileName);
  
          $news = new News();
  
          $news->description=$request->description;
          $news->images=$fileName;
          $news->university=$request->university;
          $news->date=$request->date;
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


      public function update(EditNewsRequest $request, News $news){

        try{        
         
          $news->description=$request->description;        
          $news->university=$request->university;
          $news->date=$request->date;
        
            $news->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Haberler başarıyla güncellendi.',
                'data' =>$news
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
