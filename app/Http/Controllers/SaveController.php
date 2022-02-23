<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Star;

class SaveController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['invalid_file_format'], 422);
        $errors = [];
        if(!$request->hasFile('image')) {
            $errors["image"] = "Manquant";
        }
        if(!$request->has('nom')){
            $errors["nom"] = "Manquant";
        }
        if(!$request->has('prenom')){
            $errors["prenom"] = "Manquant";
        }
        if(!$request->has('description')){
            $errors["description"] = "Manquante";
        }
        if(count($errors) > 0){
            return response()->json(["error"=>true, "description" => $errors], 400);
        }
     
        $allowedfileExtension=['jpg','png'];
        $image = $request->file('image'); 
        $nom = $request->input('nom'); 
        $description = $request->input('description'); 
        $prenom = $request->input('prenom'); 
        $errors2 = [];

        $extension = $image->getClientOriginalExtension();
        $check = in_array($extension,$allowedfileExtension);

        if($check) {
            $path = $image->store('public/images');
            $file_nme = $image->getClientOriginalName();
  
            //store image file into directory and db
            $star = new Star();
            $star->name = $name;
            $star->description = $description;
            $star->image = $path."/".$file_nme;
            $star->save();

            return response()->json(['file_uploaded'], 200);
        } else {
            return response()->json(['invalid_file_format'], 422);
        }
    }
}
