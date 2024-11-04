<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $categories = Category::orderBy("created_at", "desc")->paginate(5);
         return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated();
        $request["slug"] = $this->createSlug($request["name"]);

        $newCategory = $request -> all();
        $category = Category::create(attributes: $newCategory);

        return response()->json([
          "message" => "Categoria creada con exito",
          "category" => new CategoryResource($category)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
    $category = Category::where("id", $term)
      ->orWhere("slug", $term)
      ->get();

      if(count($category) == 0){
      return response()->json([
            "message"=> "La categoria no existe",
      ],404);
      }
       return new CategoryResource($category[0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::find($id);
  
      if(!$category){
      return response()->json([
            "message"=> "La categoria no existe",
      ],404);
      }

      if($request["name"]){
         $request["slug"] = $this->createSlug($request["name"]);
      }

       $category->update($request->all());
      
       return response()->json([
          "message" => "Categoria fue actualizada con exito",
          "category" => new CategoryResource($category)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $category = Category::find($id);
  
      if(!$category){
      return response()->json([
            "message"=> "La categoria no existe",
      ],404);
      }

      $category->delete();

      return response()->json([
          "message" => "Categoria fue eliminada con exito",
          ],200);
    }

    private function createSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('/_+/', '-', $text);
        return $text;
    }
}
