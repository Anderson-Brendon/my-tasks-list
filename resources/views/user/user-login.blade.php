@extends('layout.main-layout')
@section('title', 'Login')
@section('content')
<main class="vh-100 d-flex flex-column justify-content-center">
    @if($errors->any())
@foreach ($errors->all() as $error)
<p class="text-danger text-center fw-bold">{{$error}}</p>
@endforeach
@endif
    <header><h1 class="text-center mb-5">Login de usuário</h1></header>
<form class="d-flex flex-column align-items-center" action="{{route('user.auth')}}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="name" id="name" maxlength="30" placeholder="name@example.com" autocomplete="off">
           <label for="name" >Seu nome de usuário</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" type="text" name="password" id="password" minlength="8" placeholder="Password" autocomplete="off">
            <label for="password">Sua senha</label>
        </div>
        <div>
            <label  class="form-check-label" for="keep_logged">Manter login</label>
            <input class="form-check-input" value="" type="checkbox" id="keep_logged" name="keep_logged">
        </div>
        <div class="d-flex justify-content-around col-9 col-lg-6 mt-3">
            <button class="btn btn-success" type="submit">Login</button>
            <a href="{{route('site.home')}}" class="btn btn-warning text-dark">Retornar a página inicial
            </a>
        </div>
    </form>
</main>
@endsection


