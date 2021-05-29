<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    public function categories()
    {
        $categories=Category::all();
        if($categories->isEmpty())
            return $this->SendError('categories list is empty!');
        return $this->SendResponse($categories,'Categories list retrieved Successfully!');
    }

    public function addNewCategory(Request $request)
    {
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        //validate data
        $validator=Validator::make($request->all(),[
            'nom'=> 'required|unique:categories',
            'description' => 'required',
            'image_c' =>'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());

        //try to add category into database
        try {
            $category = new Category();
            $category->nom=$request->nom;
            $category->description=$request->description;
            $image = $request->file('image_c');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/categories',$image,$filename);
            $category->image_c=$filename;
            $category->save();
            return $this->SendResponse($category,'category added Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error ',$th->getMessage());
        }
    }

    //shoz products of specified category
    public function showCategoryProducts($idCategory)
    {
        $category=Category::findOrFail($idCategory);
        if(!$category){
            return $this->SendError('category not founded!');
        }else{
            //dd($category->foods);
            $products=$category->foods;

            if($products->isEmpty())
                return $this->SendError('there is no product in this category');
            return $this->SendResponse($products,'products category retrieved Successfully!');
        }
    }

    //update category informations
    public function updateCategory(Request $request,$id)
    {

        $user=Auth::user();

        //verify if user is admin
        $this->authorize('isAdmin',$user);

        //find category
        $category=Category::findOrFail($id);
        //validate data

        $validator=Validator::make($request->all(),[
            'nom'=> 'required|',
            'description' => 'required',
            'image_c' =>'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($validator->fails())
            return $this->SendError('Error Validator ', $validator->errors());
        //try to add category into database
        try {
            $category->nom=$request->nom;
            $category->description=$request->description;
            $image = $request->file('image_c');
            $filename = time() . random_int(1,100). '.' .$image->guessExtension();
            Storage::putFileAs('images/categories',$image,$filename);
            $category->image_c=$filename;
            $category->save();
            return $this->SendResponse($category,'category updated Successfully!');

        } catch (\Throwable $th) {
            return $this->SendError('Error to update this category',$th->getMessage());
        }
    }

    //delete category
    public function destroyCategory(Request $request,$id)
    {
        $user=Auth::user();
        //verify if user is admin
        $this->authorize('isAdmin',$user);
        //find category
        $category=Category::findOrFail($id);
        if(!$category)
            return $this->SendError('category not founded');
        try {
            $category->delete();
            return $this->SendResponse($category, 'category deleted successfully');
        } catch (\Throwable $th) {
            return $this->SendError('Error to delete category',$th->getMessage());
        }
    }
}
