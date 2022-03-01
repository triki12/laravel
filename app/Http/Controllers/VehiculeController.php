<?php

namespace App\Http\Controllers;

use App\vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{
    public function add(Request $request){
        $validator=Validator::make($request->all(),[
            'marque'=>'required|string|max:255',
            'matricule'=>'required|string|max:255|unique:vehicules',
            'modele'=>'required|string|max:255',           
        ]);

       
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>$validator->errors()->first()
            ]);
        }
       $v=new vehicule();
        $v->marque=$request->marque;
        $v->modele=$request->modele;
        $v->matricule=$request->matricule;
        $v->save();
}
public function delete(Request $req,$id){

    $vehicule=vehicule::find($id);
    if(is_null($vehicule)){
        return response()->json( ['message'=>"vehicule non trouvee"],404);
    }
    $vehicule->delete();
    return response(null,200);
}
public function getvehiculeById(Request $request){
    $result = vehicule::find($request->id);
    if(is_null($result)){
        
        return response()->json(['Result' => 'Chauffeur not found']);
       }
       else
       return Response()->json($result);
 }
 public function selectall(Request $request){

    $result = DB::table('vehicules')->get();
     if(count($result)){
      return Response()->json($result);
     }
     else
     return response()->json(['Result' => 'No Data not found']);
 }
 public function update(Request $request,$id) {
    $vehicule = vehicule::find($id);
     if(is_null($vehicule)){
         
         return response()->json(['Result' => 'Vehicule not found']);
        }
        else
       $vehicule->marque=$request->marque;
       $vehicule->modele=$request->modele;
       $vehicule->matricule=$request->matricule;
      $vehicule->save();
     return response()->json($vehicule);

 }

}
