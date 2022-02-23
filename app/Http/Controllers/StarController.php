<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Star;

class StarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(
        //     [
        //         "error" => false,
        //         "stars" => Star::all()
        //     ],  200
        // );

        return view('star/all', ['stars' => Star::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('star/add');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = [];
        $error = "";
        if($request->input('nom') == null){
            $error = "Nom manquant";
            array_push($errors, $error);
        }
        if($request->input('prenom') == null){
            $error = "prenom manquant";
            array_push($errors, $error);
        }
        if($request->input('description') == null){
            $error = "Description manquante";
            array_push($errors, $error);
        }
        if(!$request->hasFile('image')) {
            $error = "Image manquante";
            array_push($errors, $error);
        }
        if(count($errors) > 0){
            return response()->json(["error"=>true, "description" => $errors], 200);
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
            $star->nom = $nom;
            $star->prenom = $prenom;
            $star->description = $description;
            $star->image = explode("public/", $path)[1];
            $star->save();

            return response()->json(
                [
                    "error" => false,
                    "message" => "Nouvelle star correctement crée",
                    "star" => $star
                ],  200
            );
        } else {
            return response()->json([
                "error" => true,
                "message" => "Format de fichier invalid",
            ],  422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('star/edit', ['star' => Star::find( $id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $allowedfileExtension=['jpg','png'];
        $image = $request->file('image'); 
        $nom = $request->input('nom'); 
        $description = $request->input('description'); 
        $prenom = $request->input('prenom'); 
        $errors2 = [];

        $check = false;
        $path = null;
        if($request->hasFile('image')){
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            $path = $image->store('public/images');
            $file_nme = $image->getClientOriginalName();
        }

        if( !$request->hasFile('image') || $request->hasFile('image') && $check  ) {
            

            Star::where('id', $id)->update([
                'nom'=>$nom,
                'prenom'=>$prenom,
                'description'=>$description,
            ]);

            if($check){
                Star::where('id', $id)->update([
                    'image'=> explode("public/", $path)[1],
                ]);
                
            }

            return response()->json(
                [
                    "error" => false,
                    "message" => "Donnée mise a jour !",
                ],  200
            );
        } else {
            return response()->json([
                "error" => true,
                "message" => "Format de fichier invalid",
            ],  422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Star::destroy($id);
        return redirect('/star')->with('flash_message', 'Post deleted!');
        //
    }
}
