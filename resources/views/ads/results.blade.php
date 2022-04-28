@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div id="search-bar-div" class="card-header">

                    <div class="dropdown">
                        <button id="banner-menu2" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                            filters
                        </button>
                        <div id="banner-menu-content2" class="dropdown-menu" aria-label="dropdownMenuButton">

                            <form action="{{ route('search.ads') }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="sort" class="col-md-4 col-form-label text-md-right">Sort</label>
                                    <div class="col-md-6">
                                        <select name="sort" class="form-select form-select-sm" aria-label=".form-select-lg example">
                                            <option value="updated_at-desc">Newest</option>
                                            <option value="updated_at-asc">Oldest</option>
                                            <option value="price-asc">Price : low to high</option>
                                            <option value="price-desc">Price : high to low</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">Price max</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input name="price" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" value="{{ $priceMax ?? '' }}">

                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="searched" value="{{ $keyword ?? '' }}">
                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                                    <div class="col-md-6">
                                        <select name="type" class="form-select form-select-sm" aria-label=".form-select-lg example">
                                            <option value=""></option>
                                            <option value="Antiques / Art">Antiques / Art</option>
                                            <option value="Cars / Vehicles">Cars / Vehicles</option>
                                            <option value="Books">Books</option>
                                            <option value="Music">Music</option>
                                            <option value="Games">Games</option>
                                            <option value="Women's clothing">Women's clothing</option>
                                            <option value="Men's clothing">Men's clothing</option>
                                            <option value="Electronics / Computer">Electronics / Computer</option>
                                            <option value="Furniture">Furniture</option>
                                            <option value="Pets">Pets</option>
                                            <option value="Jobs">Jobs</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">

                                    <button type="submit" class="btn btn-primary">Apply</button>

                                </div>
                            </form>
                        </div>
                    </div>

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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection