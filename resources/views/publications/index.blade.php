@extends('layouts.app')
@section('content')

<!---------------------------formulaire creation de publications------------------------------->

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class='card p-2'>
                <form method="POST" action="{{ route('customPublication')}}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Quoi de neuf, ?" id="content" class="form-control" name="content" required autofocus>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="id_category">
                            <option selected disabled="disabled">Choisir une categorie</option>
                            @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}">{{$categorie->category}}</option>
                            @endforeach
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

<!---------------------------fil d'actualité------------------------------->

<div class="container">
    <div class="row">
        @foreach($publications as $publication)
        <div class="col-md-6 offset-3 my-3">
            <a href='' data-bs-toggle="modal" data-bs-target="#exampleModa{{$publication->id}}">
                <div class="card text-center">
                    <div class="card-header">
                        <div class="header-category d-flex justify-content-between align-items-center">
                            <img src="https://i.pravatar.cc/100" alt="">
                            <h1>{{ $publication->category}}</h1>
                        </div>
                    </div>
                    <div class="card-body">

                        <p class="card-text">{{ $publication->content}}</p>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-start align-items-center">
                        <p>publié par {{$publication->pseudo}}</p>
                        <img src="https://i.pravatar.cc/100" alt="" width="50">
                        <p>le: {{$publication->created_at}}</p>
                    </div>
                </div>
            </a>
        </div>

        <!---------------------------modal publication plus commentaires------------------------------->

        <div class="modal fade" id="exampleModa{{$publication->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body">
                    
                    <img src="https://i.pravatar.cc/100" alt="">
                    <h1>{{ $publication->category}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                    <p>{{ $publication->content}}</p>
              
                    <p>publié par {{$publication->pseudo}}</p>
                        <img src="https://i.pravatar.cc/100" alt="" width="50">
                        <p>le: {{$publication->created_at}}</p>
                        
                        
                        <div class="card">
                            <div class="card-body">
                                <h5>Commentaires</h5>
                                @foreach($comments as $comment)
                                <h1>{{$comment->content }}</h1>
                                @endforeach
                                <hr />
                            </div>
                            <div class="card-body">
                                <h5>Ajouter un commentaire</h5>
                                <form method="post" action='{{ route("comment.add") }}'>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="content" class="form-control" />
                                        <input type="hidden" name="id_publication" value="{{ $publication->id }}" />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-sm btn-outline-danger py-0" value="Publier" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>


                   
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection