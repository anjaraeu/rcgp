@extends('layouts.app')

@section('content')
    <a href="https://github.com/anjaraeu/rcgp">
        <img style="position: absolute; top: 0; right: 0; border: 0;" src="/img/forkme.png" alt="Fork me on GitHub" data-canonical-src="/img/forkme2.png">
    </a>

    <ul>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/login">Login</router-link></li>
        <li><router-link to="/new/image">New image</router-link></li>
        <li><router-link to="/new/category">New category</router-link></li>
    </ul>

    <div class="ui container">
        <router-view></router-view>
    </div>
@endsection
