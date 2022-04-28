@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            @if (\Session::has('message'))
            <div class="alert alert-success">
                <p>{!! \Session::get('message') !!}</p>
            </div>
            @endif
            <div class="card">
                <div id="search-bar-div" class="card-header">
                    {{ __('Inbox') }}
                </div>
                <div class="card-body">

                    <div id="convos-div">
                        @foreach($convos as $data)
                        @if($data->from_id !== Auth::user()->id)
                        <div class="{{ ($data->status == 'U') ? 'convo-div-new' : 'convo-div' }}">
                            <h6>{{ $data->from_u }}</h6>
                            <div class="convo-div-sub">
                                <p>{{ ($data->status == 'U') ? 'new' : '' }}</p>
                                <a href="{{ route('convo', $data->from_id) }}">
                                    <img  src="{{ asset('assets/chat(1).png') }}">
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @if(!count($convos))
                    <p id="no-message">You have no message in your inbox</p>
                    @endif

                    <div class="links-div">
                        <div class="links">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection