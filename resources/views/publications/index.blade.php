@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">

            <form method="POST" action="{{ route('customPublication')}}">
                @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Quoi de neuf, user ?" id="content" class="form-control" name="content" required autofocus>
                    </div>
            
                    <div class="d-grid mx-auto">
                    <input type="hidden" value="{{auth()->id()}}" name="id_user">
                        <button type="submit" class="btn btn-dark btn-block">go</button>
                    </div>    
                    
                    <div class="mb-3">
                    <label class="form-label">Categorie</label>
                    <select class="form-select" aria-label="Default select example" name="id_category">
                        <option  selected disabled="disabled">Choisir une categorie</option>
                        @foreach($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->category}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
  
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($publications as $publication)
        <div class="col-md-6 offset-3">
            <p>{{ $publication->content}}</p>
            <img src="" alt="">
            <video src=""></video>
            <button>commenter</button>
        </div>
        @endforeach
    </div>
</div>

@endsection