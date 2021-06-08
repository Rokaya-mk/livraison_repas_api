<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Categorie;
use Auth;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategorieController extends BaseController
{
    public function categories()
    {
        $categories=Categorie::all();
        if($categories->isEmpty())
            return $this->SendError(trans_choice('messages.categories_msg',2));//categories list is empty!
        return $this->SendResponse($categories,trans_choice('messages.categories_msg',1));//Categories list retrieved Successfully!
    }
//add new category
    public function addNewCategory(Request $request)
    {
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //validate data
        $validator=Validator::make($request->all(),[
            'nom_fr'=> 'required|unique:categories',
            'nom_en'=> 'nullable',
            'nom_ar'=> 'nullable',
            'description_fr' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image_c' =>'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($validator->fails())
            return $this->SendError(trans('messages.error_validator'), $validator->errors());

        //try to add category into database
        try {
            $category = new Categorie();
            $category->nom_fr=$request->nom_fr;
            $category->nom_en=$request->nom_en;
            $category->nom_ar=$request->nom_ar;
            $category->description_fr=$request->description_fr;
            $category->description_en=$request->description_en;
            $category->description_ar=$request->description_ar;
            $image = $request->file('image_c');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/categories',$image,$filename);
            $category->image_c=$filename;
            $category->save();
            return $this->SendResponse($category,trans('messages.add_category'));//category added Successfully!

        } catch (\Throwable $th) {
            return $this->SendError(trans('messages.try_error'),$th->getMessage());
        }
    }
    //show category content
    public function showCategory(Request $request,$idCategory)
    {
        $category=Categorie::find($idCategory);

        //dd($category);
        if(is_null($category))
            return $this->SendError(trans('messages.found_category'));
        return $this->SendResponse($category,200);

    }
    //show products of specified category
    public function showCategoryProducts(Request $request,$idCategory)
    {
        $category=Categorie::find($idCategory);
        //dd($category);
        if(is_null($category)){
            return $this->SendError(trans('messages.found_category'));
        }else{

            $products=$category->repas;
            //dd($products);
            if(is_null($products))
                return $this->SendError(trans_choice('messages.show_msg_cat',2));//there is no product in this category
            return $this->SendResponse($products,trans_choice('messages.show_msg_cat',1));
        }
    }

    //update category informations
    public function updateCategory(Request $request,$id)
    {
        //verify if user is admin
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //find category
        $category=Categorie::find($id);
        if(is_null($category)){
            return $this->SendError(trans('messages.found_category'));
        }
        //validate data
        $validator=Validator::make($request->all(),[
            'nom_fr'=> 'required|unique:categories',
            'nom_en'=> 'nullable',
            'nom_ar'=> 'nullable',
            'description_fr' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image_c' =>'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails())
            return $this->SendError(trans('messages.error_validator'), $validator->errors());
        //try to add category into database
        try {
            $category->nom_fr=$request->nom_fr;
            $category->nom_en=$request->nom_en;
            $category->nom_ar=$request->nom_ar;
            $category->description_fr=$request->description_fr;
            $category->description_en=$request->description_en;
            $category->description_ar=$request->description_ar;
            $image = $request->file('image_c');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            //dd($filename);
            $oldImage=Categorie::findOrFail($category->id);
            //dd($oldImage->photos);
            if($oldImage->image_c){
                //dd(Storage::exists('images/categories/'.$oldImage->image_c));
                try{
                    if((Storage::exists('images/categories/'.$oldImage->image_c))){
                       Storage::delete('images/categories/'.$oldImage->image_c);
                    }else{
                        //File does not exists.;
                        return $this->SendError(trans('messages.file_exist'),$validator->errors());
                    }
                }catch(\Throwable $th){
                    return $this->SendError($th->getMessage(), 400);
                }
            }
            Storage::putFileAs('images/categories',$image,$filename);
            $category->image_c=$filename;
            $category->save();
            return $this->SendResponse($category,trans_choice('messages.update_cat',1));//category updated Successfully!
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.update_cat',2),$th->getMessage());
        }
    }

    //delete category
    public function destroyCategory(Request $request,$id)
    {
        //verify if user is admin
        if(Gate::denies('isAdmin')){
            return $this->SendError(trans('messages.admin_permession'));
        }
        //find category
        $category=Categorie::find($id);
        if(is_null($category)){
            return $this->SendError(trans('messages.found_category'));
        }
        try {
            $category->delete();
            return $this->SendResponse($category,trans_choice('messages.delete_cat',1));//category deleted successfully
        } catch (\Throwable $th) {
            return $this->SendError(trans_choice('messages.delete_cat',2),$th->getMessage());
        }
    }
}
