<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        $images = Image::orderBy('id', 'desc')->paginate(4);
        $lastPage = $images->lastPage();
        if ($request->ajax()) {
            $view = view('image.posts', compact('images'))->render();
            return response()->json(['html' => $view, 'lastPage' => $lastPage]);
        }
        return view('dashboard', array(
            'images' => $images,
            'last' => $lastPage,
        ));
    }
}
