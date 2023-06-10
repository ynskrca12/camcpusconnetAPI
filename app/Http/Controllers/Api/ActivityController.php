<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\EditActivityRequest;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request){

        try {
            $query = Activity::query();
            $perPage =1;
            $page = $request->input('page',1);
            $search = $request->input('search');
    
    
            if($request){
                $query->whereRaw("name LIKE '%" . $search . "%'");
            }
            
            $total = $query->count();
            $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Aktiviteler başarıyla listelendi.',
                'current_page' => $page,
                'last_page' => ceil($total / $perPage),
                'items' => $result
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }



    }//End Method

    public function store(CreateActivityRequest $request){

        
      try{
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);

        $activity = new Activity();

        $activity->name=$request->name;
        $activity->description=$request->description;
        $activity->category=$request->category;
        $activity->imagePath=$fileName;
        $activity->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Aktivite başarıyla kaydedildi.',
            'data' =>$activity
        ]);
      }
      catch (Exception $e){
        return response()->json($e);
      }

    } //End Method
    
    public function update(EditActivityRequest $request, Activity $activity){

    try{        
     
        $activity->name=$request->name;
        $activity->description=$request->description;
        $activity->category=$request->category;
    
        $activity->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Aktivite başarıyla güncellendi.',
            'data' =>$activity
        ]);
    }
    catch (Exception $e) {
        return response()->json($e);
    }

    }//End Method

    public function delete(Activity $activity){
        try {
            if($activity){
                $activity->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Aktivite başarıyla silindi.',
                'data' =>$activity
            ]);
            }else{

            return response()->json([
                'status_code' => 422,
                'status_message' => 'Aktivite bulunamadı.',
            ]);
            }

        } catch (Exception $e) {
            return response()->json($e);
        }
    }//End Method
}
