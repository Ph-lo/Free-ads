@extends('layout')
@section('content')

<main class="login-form">
    <div class="cotainer">
        @if (\Session::has('errorMessage'))
        <div class="alert alert-danger">
            <p>{!! \Session::get('errorMessage') !!}</p>
        </div>
        @elseif (\Session::has('message'))
        <div class="alert alert-success">
            <p>{!! \Session::get('message') !!}</p>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="adTitre card-header">{{ $data->title }}</div>
                    <div id="ad-view" class="card-body">

                        <div class="slider">

                            <a href="#" class="next control">&rsaquo;</a>
                            <a href="#" class="prev control">&lsaquo;</a>


                            <ol>
                                @foreach(explode(',', $data->images) as $image)
                                <li id="{{ (count(explode(',', $data->images)) == 1) ? 'single-pic-slider' : '' }}"><img src="{{ asset('files/'.$image) }}" alt="image"></li>
                                @endforeach
                            </ol>

                        </div>
                        <h6>{{ $data->type }}</h6>
                        <div class="card">
                            <div class="card-body">
                                <div id="ad-desc">
                                    <p>{{ $data->description }}</p>
                                    <div id="price-div">
                                        <p>$ {{ $data->price }}</p>
                                        <button class="btn btn-primary">
                                            <a href="{{ route('message.new', $data->user_id) }}">Contact seller</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection