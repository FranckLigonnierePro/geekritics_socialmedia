<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;

class PublicationController extends Controller
{

    public function index()
    {
        $publications = Publication::join('categories', 'categories.id', '=', 'publications.id_category')
            ->join('users', 'users.id', '=', 'publications.id_user')
            ->get(['publications.id', 'publications.content', 'publications.image', 'publications.created_at', 'categories.category', 'users.pseudo']);
        $categories = Categorie::all();
        $comments = Comment::all();
        return view('publications.index', compact('publications', 'categories', 'comments'));
    }

    public function store(Request $request)
    {

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

        return redirect()->route('newsfeed');
    }

    public function show($id)
    {
        $publication = Publication::findOrFail($id);
        $user = User::findOrFail($publication->id_user);
        $category = Categorie::findOrFail($publication->id_category);
        return view('publications.solo', compact('publication', 'user', 'category'));
    }
    //EDITER UNE RECETTE
    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        return back(compact('publication'));
    }

    public function update(Request $request, $id)
    {
        $updatePublication = $request->validate([
            'content' => 'required'
        ]);
        $updatePublication = $request->except(['_token', '_method']);

        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $$updatePublication['image'] = '/images/' . $imageName;
        }

        Publication::whereId($id)->update($updatePublication);
        return back();
    }


    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return redirect()->route('newsfeed');
    }
}
