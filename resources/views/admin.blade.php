@extends('layouts.app')

@section('content')
    <a href="https://github.com/anjaraeu/rcgp">
        <img style="position: absolute; top: 0; right: 0; border: 0;" src="/img/forkme.png" alt="Fork me on GitHub" data-canonical-src="/img/forkme2.png">
    </a>

    <div class="ui container">
        <div class="ui inverted secondary menu">
            <router-link class="item" to="/admin">Dashboard</router-link>
            <router-link class="item" to="/login">Login</router-link>
            <router-link class="item" to="/new/image">New image</router-link>
            <router-link class="item" to="/new/category">New category</router-link>
            <div class="right menu">
                <a href="/" class="item">Back to site</a>
            </div>
        </div>
        <router-view></router-view>
    </div>
@endsection
