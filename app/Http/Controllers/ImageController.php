<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        // Validacion
        $request->validate([
            'description' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        // recoger datos

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asignar datos a nuevo objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->image_path = null;
        $image->description = $description;

        //Subir fichero
        if ($image_path) {

            // //Generación de nombre único para la imagen
            $image_random_name = uniqid('', true) . '_' . $image_path->getClientOriginalName();;
            // Storage::disk('images')->put($image_random_name, File::get($image_path));
            $disk = \Storage::disk('gcs');
            $disk->put('images/' . $image_random_name, File::get($image_path));
            $image->image_path = $image_random_name;
        }

        $image->save();
        return redirect()->route('home')->with([
            'message' => 'Photo uploaded successfully'

        ]);
    }

    // Obtiene de imagen
    public function getImage($filename)
    {
        // $file = Storage::disk('images')->get($filename);
        $file = Storage::disk('gcs')->get('images/' . $filename);
        return new Response($file, 200);
    }

    // Detalles de la imagen
    public function detail($id = null)
    {
        $image = $id && is_numeric($id) ? Image::find($id) : null;
        if ($image) {
            return view('image.detail', [
                'image' => $image
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function delete($id = null, $user_delete = false)
    {
        // *Obtener usuario autenticado
        $user = Auth::user();

        // *Obtener imagen
        $image = $id && is_numeric($id) ? Image::find($id) : null;

        // *Obtener comentarios y likes de la imagen
        $comments = $id && is_numeric($id) ? Comment::where('image_id', $id)->get() : null;
        $likes = $id && is_numeric($id) ? Like::where('image_id', $id)->get() : null;


        // *Comprobar si el usuario es dueño de la imagen
        if ($user && $image && $image->user->id == $user->id) {

            // *Comprobar si hay comentarios y eliminarlos
            if ($comments && count($comments) > 0) {
                foreach ($comments as $comment)
                    $comment->delete();
            }
            // *Comprobar si hay likes y eliminarlos
            if ($likes && count($likes) > 0) {
                foreach ($likes as $like)
                    $like->delete();
            }

            // *Eliminar fichero de la imagen
            // Storage::disk('images')->delete($image->image_path);
            Storage::disk('gcs')->delete('images/' . $image->image_path);

            // *Eliminar registro de la imagen
            $image->delete();
            $message = array('message' => 'La imagen se ha eliminado correctamente');
        } else {
            $message = array('message' => 'La imagen no se ha eliminado correctamente');
        }
        if ($user_delete) {
            return;
        } else {
            return redirect()->route('home')->with($message);
        }
    }

    public function edit($id = null)
    {
        $user = Auth::user();
        $image = $id && is_numeric($id) ?  Image::find($id) : null;

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', compact('image'));
        } else {
            return redirect()->route('home');
        }
    }

    public function updateImage(Request $request)
    {
        // *Validación
        $request->validate([
            'description' => 'required|string|max:255',
            'image_path' => 'image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        // *Recoger datos
        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_path = $request->file('image_path');


        // *Buscar Imagen
        $image = Image::find($image_id);

        if (!$image) {
            return redirect()->route('home');
        }
        // *Guardar Imagen
        if ($image_path && $image) {
            // Storage::disk('images')->delete($image->image_path);
            Storage::disk('gcs')->delete('images/' . $image->image_path);
            // //Generación de nombre único para la imagen
            $image_random_name = uniqid('', true) . '_' . $image_path->getClientOriginalName();;
            // Storage::disk('images')->put($image_random_name, File::get($image_path));
            $disk = \Storage::disk('gcs');
            $disk->put('images/' . $image_random_name, File::get($image_path));
            $image->image_path = $image_random_name;
        }
        // *Establecer nuevos valores a la imagen
        $image->description = $description;


        // *Actualizar registro de la imagen
        $image->update();
        return redirect()->route('image.detail', ['id' => $image_id])->with([
            'message' => 'Photo updated successfully'
        ]);
    }
}
