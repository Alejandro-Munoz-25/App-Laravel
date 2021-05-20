<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function save(Request $request, $id)
    {

        // Validacion
        $request->validate([
            'image_id' => 'required',
            'comment_' . $id  => 'required|string|max:255',
        ]);
        // Recoger
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('comment_' . $id);

        //Asignar datos a nuevo comentario
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar nuevo Comentario
        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with([
            'message' => 'Comment posted successfully'
        ]);
    }

    public function delete($id)
    {

        //Conseguir datos del usuario logueadp
        $user = \Auth::user();

        //Conseguir objeto del comentario
        $comment = $id && is_numeric($id) ? Comment::find($id) : null;

        //Comprobar Si es dueño del comentario de la publicación
        if ($user && $comment->user_id == $user->id || $comment->image->user_id == $user->id) {
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image->id])->with([
                'message' => 'Comment Deleted'
            ]);
        } else {
            return redirect()->route('image.detail', ['id' => $comment->image->id])->with([
                'message' => 'Comment not deleted'
            ]);
        }
    }
}
