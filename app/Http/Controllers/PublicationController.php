<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{

    public function index(){
        $publications = Publication::join('categories','categories.id','=','publications.id_category')
        ->join('users','users.id','=','publications.id_user')
        ->get(['publications.id','publications.content','publications.image','publications.created_at', 'categories.category', 'users.pseudo']);
        $categories = Categorie::all();
        $comments = Comment::all();
        return view('publications.index', compact('publications','categories','comments'));
        
    }

    public function store(Request $request){

        $this->middleware('auth');

        $imageName = "";
        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $newPublication = new Publication;
        $newPublication->content = $request->content;
        $newPublication->image = '/images/' . $imageName;
        $newPublication->id_category = $request->id_category;
        $newPublication->id_user = $request->id_user;
        $newPublication->save();

        return redirect()->route('newsfeed')
                         ->with('success', 'Recette enregistrée !')
                         ->with('image', $imageName);
    }

    public function show($id){
        
        $publications = Publication::find($id);
        return back(compact('publications'));
        
        
    }


}
