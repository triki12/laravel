<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChauffeurController extends Controller
{
    public function add(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'tel'=>'required|string|max:255',
            'adress'=>'required|string|max:255',
            
           // 'image'=>'required|image',
           'password' =>'required|string|min:6',
           
        ]);

       
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>$validator->errors()->first()
            ]);
        }

       // $p=Product::find($request->id);
       $p=new User();
        $p->name=$request->name;
        $p->tel=$request->tel;
        $p->email=$request->email;
        $p->adress=$request->adress;
        $p->password=bcrypt($request->password);
       
        
       
        $p->save();

       //storing image
       $url="http://localhost:8000/storage/";
       if($request->hasFile('image')){
                 $file=$request->file('image');
                    $extension=$file->getClientOriginalExtension();
                 $path=$request->file('image')->storeAs('public',$p->id.'.'.$extension);
                 $p->image=$path;
                 $p->imagepath=$url.$path;
                 $p->save();
                 return response()->json([
            'success'=>true,
                     'message'=>"You have successfully created "
                 ]);
        }
    }
    public function delete(Request $req,$id){

        $user=User::find($id);
        if(is_null($user)){
            return response()->json( ['message'=>"produit non trouvee"],404);
        }
        $user->delete();
        return response(null,200);
    }
    
    public function show(Request $request){

        $result = User::where('usertype', 'LIKE', '%'. '0'. '%')->get();
         if(count($result)){
          return Response()->json($result);
         }
         else
         return response()->json(['Result' => 'No Data not found']);
     }
}
