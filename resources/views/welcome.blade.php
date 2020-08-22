@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 d-flex flex-column justify-content-center">
            <div class="py-3">
                <h1>Link building is one of the most important thing in <span class="textmaincolor">SEO</span></h1>
            </div>
            <div>
                <h4>Every little helps. Submit your domain and get dofollow backlink from our website</h4>
            </div>
            <div class="py-5"><a href="#" class="btn btn-primary">Submit your domain</a></div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-end align-items-center">
                <img class="w-100 py-5 pl-5" src="{{ asset('img/social-media.png')}}" alt="main image of mypage">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <h2 class="font-weight-bolder">Categories</h2>
    </div>
</div>
@endsection