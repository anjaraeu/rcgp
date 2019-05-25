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
        $img = Image::all();
        if ($img->count() > 0) {
            $img = $img->random();
        } else {
            return response()->json(['err' => 'So sad, no images!']);
        }
        $img->load('category');
        return response()->json($img);
    }

    /**
     * Retrieve an image filtered by category
     *
     * @param string $category Category
     */
    public function getRandomImageFiltered($category) {
        $img = Category::where('slug', $category)->first()->images;
        if ($img->count() > 0) {
            $img = $img->random();
        } else {
            return response()->json(['err' => 'So sad, no images in this category!']);
        }
        return response()->json($img);
    }

    /**
     * Retrieve a RAW random image from repository
     *
     * @return Illuminate\Http\Response
     */
    public function getRawImage() {
        $img = Image::all();
        if ($img->count() > 0) {
            $img = $img->random();
        } else {
            return response()->json(['err' => 'So sad, no images!']);
        }
        return response()->file(storage_path('app/public/'.$img->path));
    }

    /**
     * Retrieve a RAW random image from repository
     *
     * @return Illuminate\Http\Response
     */
    public function getRawImageFiltered($category) {
        $img = Category::where('slug', $category)->first()->images;
        if ($img->count() > 0) {
            $img = $img->random();
        } else {
            return response()->json(['err' => 'So sad, no images in this category!']);
        }
        return response()->file(storage_path('app/public/'.$img->path));
    }

    public function getImage($imgid) {
        $img = Image::findOrFail($imgid);
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

    public function getStats() {
        $arr = [
            'images' => Image::all()->count(),
            'categories' => Category::all()->count()
        ];
        return response()->json($arr);
    }

    public function getUser() {
        $arr = [
            'ok' => true,
            'name' => Auth::user()->name
        ];
        return response()->json($arr);
    }

    public function getCSRF() {
        return response()->json(['token' => csrf_token()]);
    }

    public function getImages(Request $request) {
        $imgs = Image::all();
        if ($request->input('page') && $request->input('epp')) {
            $res = $imgs->forPage($request->input('page'), $request->input('epp'));
            return response()->json(['results' => $res->all()]);
        } else {
            $res = $imgs->forPage(1, 5);
            return response()->json(['results' => $res->all()]);
        }
    }

    public function deleteImage(Request $request, $imgid) {
        $img = Image::findOrFail($imgid);
        $img->delete();
        return response()->json('ok');
    }
}
