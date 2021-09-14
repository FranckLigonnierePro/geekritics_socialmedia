<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(){
        $publications = Publication::join('categories','categories.id','=','publications.id_category')
        ->get(['publications.id','publications.content', 'categories.category',]);
        $categories = Categorie::all();
        return view('publications.index', compact('publications','categories'));
        
        
    }

    public function store(Request $request){
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
}
