@extends('layouts.app')

@section('content')
    <a href="https://github.com/anjaraeu/rcgp">
        <img style="position: absolute; top: 0; right: 0; border: 0;" src="/img/forkme.png" alt="Fork me on GitHub" data-canonical-src="/img/forkme2.png">
    </a>

    <div class="ui container">
        <div class="ui inverted secondary menu">
            <router-link class="item" to="/">Home</router-link>
            <router-link class="item" to="/src">Sources of images</router-link>
            <router-link class="item" to="/suggestion">Suggest an image</router-link>
            <div class="right menu">
                <router-link class="item" to="/about">What's that?</router-link>
            </div>
        </div>
        <router-view></router-view>
    </div>
@endsection
