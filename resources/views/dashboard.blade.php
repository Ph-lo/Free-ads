@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div id="search-bar-div" class="card-header">
                    {{ __('Dashboard') }}
                    <form action="{{ route('search.ads') }}" method="POST">
                        @csrf
                        <div class="input-group rounded">
                            <input name="searched" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                                <button id="search-bt">
                                <img src="{{ asset('assets/loupe.png') }}" alt="search icon">
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <div id="ads-cont">
                        @foreach($ads as $data)
                        <div class="col-md-5 adsCard">
                            <div class="card">
                                <div class="card-header ads-hdr-div">
                                    <a href="{{ route('ads.show', $data) }}">{{$data->title}}</a>
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
                    <!-- {{ $ads->links() }} -->

                </div>
            </div>
        </div>
    </div>
</div>

@endsection