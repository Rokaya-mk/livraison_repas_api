<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Storage;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $categories=Categorie::all();
      return view('categories.index',compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'nom'                =>'required|string',
            'description_c'           => 'required',
            'image_c'                 =>'required|mimes:jpg,jpeg,png|max:2048',

            ]);

        $categorie = new Categorie();
        $categorie->nom=$request->input('nom');
        $categorie->description_c=$request->input('description_c') ;
        $image_c = $request->file('image_c');
        $filename = time() .'.'.$image_c->getClientOriginalName();
        Storage::putFileAs('images/categories',$image_c,$filename);
        $categorie->image_c=$filename;

        $categorie->save();
        Session::flash('status','Categorie ajouter!!');

        return redirect()->route('categories');
//return redirect()->back() ;

    }


    public function showFoodsCategorie($id)
    {
        $categorie=Categorie::findOrFail($id);
        $foods=$categorie->repas;
        return view('categories.foodsCategorie',[
            'categorie'=>$categorie,
            'foods' =>$foods
        ]);
    }


    public function edit($id)
    {
        $categorie=Categorie::findOrFail($id);

        return view('Categories.edit',[
            'categorie' =>$categorie
        ]);
    }


    public function update(Request $request, $id)
    {
        //dd($request,$id);
        $validatedData=$request->validate([
            'nom'                =>'required',
            'description_c'           => 'required',
            ]);
            // if ($validatedData->fails()) {
            //     dd($validatedData);
            //     return Redirect::back()
            //         ->withErrors($validatedData)
            //         ->withInput();
            // }
        $categorie = Categorie::findOrFail($id);
        //dd($categorie);
        $categorie->nom=$request->input('nom') ;
        //dd($categorie->nom);
        $categorie->description_c=$request->input('description_c') ;

      if($request->hasFile('image_c')) {
        $image_c = $request->file('image_c');
        $filename = time() .'.'.$image_c->getClientOriginalName();
            if($categorie->image_c) {
              Storage::delete('images/categories/'.$categorie->image_c);
            }
        Storage::putFileAs('images/categories',$image_c,$filename);
        $categorie->image_c=$filename;

  }
      //dd($categorie);
      $categorie->save();

      $request->session()->flash('status', 'Categorie a été modifier avec succès');

      return redirect()->route('categories');



    }

    public function destroy(Request $request ,$id)
    {
        $categorie=Categorie::findOrFail($id);
        $categorie->delete();

        $request->session()->flash('status','   Categorie Supprimer!!');
        return redirect()->route('categories');
    }
}
