@extends('layout.main-layout')
@section('title', 'Sobre')
@section('content')
<main class="vh-100 d-flex flex-column justify-content-around">
    <section>
        <h1 class="text-center">Sobre o site</h1>
    <p class="text-center">Foi criado com o intuito de aprender laravel, um framework php, mas se for útil pra você sinta-se livre pra usar.</p>
    </section>
    <section class="d-flex flex-column align-items-center ">
        <header>
            <h2>Ferramentas usadas para criar essa aplicação:</h2>
        </header>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action list-group-item-secondary"><a class="text-dark" href="https://getcomposer.org/">Composer - Um gerenciador de pacotes do php</a></li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><a class="text-dark" href="https://laravel.com/">Laravel - Provavelmente o framework mais popular do php</a></li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><a class="text-dark" href="https://getbootstrap.com/">Bootstrap - Um framework do css</a></li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><a class="text-dark" href="https://icons.getbootstrap.com/">Bootstrapp_Icons - Uma biblioteca gratuita para ícones</a><i class="bi bi-hand-thumbs-up text-dark"></i></li>
            <li class="list-group-item list-group-item-action list-group-item-secondary"><a class="text-dark" href="https://alpinejs.dev/">Alpinejs - Um pequeno framework javascript</a></li>
        </ul>
    </section>
    <div class="mt-3 col-6 d-flex justify-content-around">
        <a href="{{route('site.home')}}" class="btn btn-warning text-dark">Página inicial</a>
    </div>
</main>
@endsection
