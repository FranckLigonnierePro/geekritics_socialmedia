@extends('layouts.app')
@section('content')

<!---------------------------Publication solo------------------------------->

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 my-3">
            <div class="card text-center">
                <div class="card-header">
                    <div class="header-category d-flex justify-content-between align-items-center">
                        <img src="https://i.pravatar.cc/100" alt="">
                        <h1>
                    </div>
                    <div class="card-body">
                        <img src="{{$publication->image}}" alt="">
                        <h1>{{ $category->category}}</h1>
                        <p class="card-text">{{$publication->content}}</p>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-start align-items-center">
                        <p>publié par {{$user->pseudo}}</p>
                        <img src="https://i.pravatar.cc/100" alt="" width="50">
                        <p>le: {{$publication->created_at}}</p>
                    </div>

                </div>
                <a href="{{route('editPublication', $publication->id)}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModa{{ $publication->id }}"> >Editer</a>
                <form action="/newsfeed/destroy/{{ $publication->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</a>
                </form>
            </div>


            <!---------------------------- commentaires ------------------------------------------->

            <div class="card">
                <div class="card-body">
                    <h5>Commentaires</h5>
                    <h1></h1>
                    <hr />
                </div>
                <div class="card-body">
                    <h5>Ajouter un commentaire</h5>
                    <form method="POST" action="{{route('commentAdd')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Votre commentaire</label>
                            <input type="text" name="content" class="form-control" placeholder="Lachez votre plus beau com'">
                        </div>
                       
                        <input type="hidden" value="{{$publication->id}}" name="publication_id">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!---------------------------- Modal edit ------------------------------------------->
    <div class="modal fade" id="exampleModa{{$publication->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class='card p-2'>
                        <form method="POST" action="{{ route('updatePublication', $publication->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Quoi de neuf, ?" id="content" class="form-control" name="content" required autofocus>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="id_category">
                                    <option selected disabled="disabled">Choisir une categorie</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="d-grid mx-auto">
                                <input type="hidden" value="{{auth()->id()}}" name="id_user">
                                <button type="submit" class="btn btn-dark btn-block">Publier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection