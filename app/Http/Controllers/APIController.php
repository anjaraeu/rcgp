<?php

namespace App\Http\Controllers;

use Auth;
use App\Image;
use App\Category;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Retrieve a random image from repository
     *
     * @return Illuminate\Http\Response
     */
    public function getRandomImage() {
        $img = Image::all()->random();
        $img->load('category');
        return response()->json($img);
    }

    /**
     * Retrieve an image filtered by category
     *
     * @param string $category Category
     */
    public function getRandomImageFiltered($category) {
        $img = Category::where('slug', $category)->first()->images->random();
        return response()->json($img);
    }

    public function uploadImage(Request $request) {
        $file = $request->file('image');
        $img = Image::create([
            'name' => $file->getClientOriginalName(),
            'path' => substr($file->store('public/images'), 7),
            'uploader_id' => Auth::id(),
            'category_id' => $request->input('category'),
            'src' => $request->input('src')
        ]);
        return response()->json($img);
    }

    public function getCategories() {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function createCategory(Request $request) {
        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);
        return response()->json($category);
    }

    /**
     * Retrieve a raw random image
     *
     * @return Illuminate\Http\Response
     */
    public function getRawImage() {
        // TODO
    }
}
