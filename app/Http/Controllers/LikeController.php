<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function index(Request $request)
    {
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(2);
        $lastPage = $likes->lastPage();
        if ($request->ajax()) {
            $view = view('image.favorite', compact('likes'))->render();
            return response()->json(['html' => $view, 'lastPage' => $lastPage]);
        }
        return view('likes.index', [
            'likes' => $likes,
            'lastPageUs' => $lastPage
        ]);
    }

    //Comprobar si existe like
    public function like($image_id)
    {
        $user = \Auth::user();

        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;
            // Guardar
            $like->save();

            return response()->json([
                'like' => $like,
                'count' => count($like->image->likes),
            ]);
        } else {
            return response()->json([
                'like' => 'like no existe'
            ]);
        }
    }

    //Comprobar si existe dislike
    public function dislike($image_id)
    {
        $user = \Auth::user();


        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();
        if ($like) {
            $like->delete();
            return response()->json([
                'like' => $like,
                'messege' => 'Has dado dislike',
                'count' => count($like->image->likes),
            ]);
        } else {
            return response()->json([
                'messege' => 'no se pudo dar dislike'
            ]);
        }
    }
}
