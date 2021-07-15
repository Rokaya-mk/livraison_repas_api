<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Promotion;
use App\Models\Repas;
use Illuminate\Http\Request;

use Redirect;
use Session;
use Storage;


class FoodController extends Controller
{

    public function foods()
    {
       $foods = Repas::all();
       $categories= Categorie::all();
        return view('repas.foodItems', compact(['foods','categories']));
    }

    public function create()
    {
        $categories=Categorie::all(['id','nom']);
        return view('repas.create',compact('categories'));
    }

    public function store(Request $request)
    {
        //dd($request);
        //validation des données
       $request->validate([
            'nom'                =>'required',
            'description'           => 'required',
            'prix'                  =>'required',
            'image'                 =>'required|mimes:jpg,jpeg,png|max:2048',
            'stock'                 =>'required',
            //  'categorie_id'          =>'required',

            ]);
            // dd($validator);
            // if (isset($validator) && $validator->fails()) {
            //     return redirect()->Redirect::back()
            //         ->withErrors($validator)
            //         ->withInput();
            // }

        $food = new Repas();
        $food->nom=$request->input('nom') ;
        //dd($food->nom);
        $food->description=$request->input('description') ;
        $food->prix=$request->input('prix');
        //$food->category_id=$request->category_id;
        //dd($food);
        $image = $request->file('image');

        // $image = Input::file('image');
		// 	$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
		// 	Image::make($image->getRealPath())->resize(468, 249)->save('public/img/products/'.$filename);
		// 	$product->image = 'img/products/'.$filename;
       // $fileName = time().'.'.$request->file->extension();
        $filename = time() .'.'.$image->getClientOriginalName();
        Storage::putFileAs('images/foods',$image,$filename);
        $food->image=$filename;
        $food->stock=$request->input('stock');
        //find categorie
        //dd($request->input('categories'));
        $category=Categorie::find($request->input('categories'));
        //dd($category);
        // if(is_null($category))
        // return redirect()->with('errors', 'Cet categories n\'existe pas!');
        // if($request->promotion_id){
        //     $promotion=Promotion::find($request->promotion_id);
        //     if(is_null($promotion))
        //         return redirect()->with('error', 'la promotion a été récupérée avec succès!|Cet repas n\'existe pas!');
        //         //return $this->SendError(trans_choice('messages.promo_show',2));
        // $food->promotion_id=$request->promotion_id;
        // }
        $food->categorie()->associate($category);
        // $food->promotion()->associate($promotion);
        $food->save();
        Session::flash('status','post was created!!');

        // return redirect()->route('posts.show',['post'=>$post->id]);
        //return redirect()->route('repas.foodItems');
        return redirect()->route('foods');


    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $food=Repas::findOrFail($id);
        $categories=Categorie::all(['id','nom']);
        return view('repas.edit',[
            'food'=>$food,
            'categories' =>$categories
        ]);
    }


    public function update(Request $request, $id)
    {
        //dd($request,$id);
        $this->validate($request,[
            'nom'                =>'required',
            'description'           => 'required',
            'prix'                  =>'required',
            'stock'                 =>'required',
            // 'categorie_id'          =>'required',

            ]);
            // if (isset($validator) && $validator->fails()) {
            //     return Redirect::back()
            //         ->withErrors($validator)
            //         ->withInput();
            // }
        $food = Repas::findOrFail($id);
        $food->nom=$request->input('nom') ;
        //dd($food->nom);
        $food->description=$request->input('description') ;
        $food->prix=$request->input('prix');
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() .'.'.$image->getClientOriginalName();
                if($food->image) {
                  Storage::delete('images/foods/'.$food->image);
                }
            Storage::putFileAs('images/foods',$image,$filename);
            $food->image=$filename;

      }
      $food->stock=$request->input('stock');
      $category=Categorie::find($request->input('categories'));
      $food->categorie()->associate($category);
      $food->save();
      request()->session()->flash('success','repas a été modifier avec succès');
      //$request->session()->flash('status', 'repas a été modifier avec succès');

      return redirect()->route('foods');



    }

    public function destroy(Request $request ,$id)
    {
        $food=Repas::findOrFail($id);
        $food->delete();

        $request->session()->flash('status','Post Deleted!!');
        return redirect()->route('foods');
    }
}
