@extends('layout.main-layout')
@section('title', 'Criar conta')
@section('content')
<main class="vh-100 d-flex flex-column justify-content-center">
    <header>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="text-center text-danger font-weight-bold">{{$error}}</p>
        @endforeach
        @endif
        @isset($success)
        <p class="text-center text-success font-weight-bold">{{$success}}</p>
        @endisset
        <h1 class="text-center">Criar conta</h1>
    </header>
    <form action="{{route('user.store')}}" method="POST" class="d-flex flex-column align-items-center form-group">
        @csrf
        <div class="form-floating mt-3">
            <input autocomplete="off" class="form-control" id="name" name="name" class="form-control-lg"  type="text" maxlength="30" placeholder="Choose a user name name here" required>
            <label for="name" class="form-label">Nome de usuário</label>
        </div>
        <div class="form-floating mt-3">
            <input autocomplete="off" class="form-control" id="password" name="password" class="form-control-lg" type="text" maxlength="30" placeholder="Type your password here"  required>
            <label for="password" class="form-label">Senha</label>
        </div>
        <div class="form-floating mt-3">
            <input autocomplete="off" class="form-control" id="email" name="email" class="form-control-lg" type="email" maxlength="90" placeholder="Insert a email" required>
            <label id="email" for="email" class="form-label">Email</label>
        </div>
        <div class="mt-3">
            <button class="btn btn-success" type="submit">Confirmar</button>
            <a class="btn btn-secondary" href="{{route('site.home')}}">Retornar</a>
        </div>
    </form>
</main>
@endsection
