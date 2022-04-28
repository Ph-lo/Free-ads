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
                    <div id="user-ads-card-header" class="card-header">
                        <p>My ads</p>
                        <a href="{{ route('new.ad') }}">make a new ad</a>
                    </div>
                    <div id="ads-cont" class="card-body">
                        @foreach($ads as $data)
                        <div class="col-md-5 adsCard">
                            <div class="card">
                                <div class="card-header ads-hdr-div">
                                    <a href="{{ route('ads.show', $data) }}">{{$data->title}}</a>
                                    <div class="alter-butn">
                                        <a href="{{ route('ads.modify', $data) }}">
                                            <img class="modify-butn" src="{{ asset('assets/edit.png') }}" alt="edit icon">
                                        </a>
                                        <a href="{{ route('ads.delete', $data) }}">
                                            <img class="delete-butn" src="{{ asset('assets/delete.png') }}" alt="delete icon">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body card-bdy">
                                    <div class="ad">
                                        @php ($pictures = explode(',',$data->images) )
                                        @php ($date = substr($data->updated_at, 0, 10))
                                        <div class="ads-img-div">
                                            <img class="ads-img" src="{{ asset('files/'.$pictures[0]) }}" style="height: 270px;">
                                        </div>
                                        <div class="ads-infos">
                                            <h6 class="ads-type">{{$data->type}}</h6>
                                            <p class="ads-price">$ {{$data->price}}</p>
                                            <p class="ads-date">{{$date}}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="links-div">
                        <div class="links">
                            {{ $ads->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection