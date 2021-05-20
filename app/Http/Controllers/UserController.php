<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController
{

    public function index(Request $request, $search = null)
    {
        if (!empty($search)) {
            $users = User::where('nick', 'iLIKE', '%' . $search . '%')
                ->orWhere('name', 'iLIKE', '%' . $search . '%')
                ->orWhere('surname', 'iLIKE', '%' . $search . '%')->OrderBy('id', 'desc')->paginate(8);
        } else {
            $users = User::OrderBy('id', 'desc')->paginate(8);
        }
        if ($users->total() == 0) {
            $users = User::OrderBy('id', 'desc')->paginate(8);
        }
        $lastProfile = $users->lastPage();
        // !Se usa para obtener el último valor del input
        $request->flash();

        if ($request->ajax()) {
            $view = view('users.profiles', ['users' => $users])->render();
            return response()->json(['html' => $view, 'lastPage' => $lastProfile]);
        }
        return view('users.index', [
            'users' => $users,
            'lastProfile' => $lastProfile,
        ]);
    }

    public function config()
    {
        return view('users.config');
    }

    public function update(Request $request)
    {

        // *Obtener usuario autenticado
        $user = \Auth::user();

        $id = $user->id;


        // *Validar formulario

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id, // ! unique:tabla, columna, id de usuario a ignorar
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'image_path' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4048'
        ]);

        // *Recoger datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        // *Asignar nuevos valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        $image_path = $request->file('image_path');

        // *Borramos la imagen anterior si existe
        if (\Auth::user()->image && $image_path) {
            // Storage::disk('users')->delete(\Auth::user()->image);
            Storage::disk('gcs')->delete('users/' . \Auth::user()->image);
        }

        // *Subir la imagen
        if ($image_path) {

            // //Generación de nombre único para la imagen
            $image_random_name = uniqid('', true) . '_' . $image_path->getClientOriginalName();


            // //Guardar la imagen dentro de la carpeta de users
            // Storage::disk('users')->put($image_random_name, File::get($image_path));
            $disk = \Storage::disk('gcs');
            $disk->put('users/' . $image_random_name, File::get($image_path));
            $user->image = $image_random_name;
        }

        // *Actualizar usuario en la BD
        $user->update();

        return redirect(route('config'))->with(['message' => 'Profile Was Updated']);
    }


    public function getImage($filename)
    {
        // *Obtener imagen de usario
        // $file = Storage::disk('users')->get($filename);
        $file = Storage::disk('gcs')->get('users/' . $filename);

        return new Response($file, 200);
    }

    public function profile($id = null)
    {
        $user = $id && is_numeric($id) ? User::find($id) : null;
        if ($user) {
            return view('users.profile', compact('user'));
        } else {
            return redirect()->route('home');
        }
    }
    public function delete(Request $request)
    {
        // *Obtener usuario autenticado
        $user = Auth::user();
        $image_controller = new ImageController();
        $id = $user->id;
        $user_bd = User::find($id);
        // *Obtener imagenes
        $images = Image::where('user_id', $id)->get();
        // *Obtener comentarios y likes del usuario
        $comments_user = Comment::where('user_id', $id)->get();
        $likes_user =  Like::where('user_id', $id)->get();

        // *Comprobar si hay comentarios y eliminarlos
        if ($comments_user && count($comments_user) > 0) {
            foreach ($comments_user as $comment)
                $comment->delete();
        }
        // *Comprobar si hay likes y eliminarlos
        if ($likes_user && count($likes_user) > 0) {
            foreach ($likes_user as $like)
                $like->delete();
        }
        // *Eliminar imagenes del Usuario
        foreach ($images as $image) {
            $image_controller->delete($image->id, true);
        }

        if (\Auth::user()->image) {
            Storage::disk('gcs')->delete('users/' . \Auth::user()->image);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user_bd->delete();
        return redirect(route('login'))->with(['message' => 'User deleted successfully']);
    }
}
