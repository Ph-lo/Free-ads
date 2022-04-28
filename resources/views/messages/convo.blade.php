@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">

            <div class="card">
                <div id="search-bar-div" class="card-header">
                    {{ __('Messages') }}
                </div>
                <div class="card-body">

                    <div id="messages-cont">
                        @foreach($convo as $data)
                        <div class="{{ ($data->from_u == Auth::user()->name) ? 'convo-message-user' : 'convo-message' }}">
                            <div class="{{ ($data->from_u == Auth::user()->name) ? 'convo-message-cont-user' : 'convo-message-cont' }}">
                                <h6>{{ $data->from_u }}</h6>
                                <p>{{ $data->content }}</p>
                                <p class="message-date">{{ $data->created_at }}</p>
                            </div>
                        </div>

                        @endforeach
                    </div>

                    <div id="new-message-div-form">
                        <form action="{{ route('message.post', $id)}}" method="POST">

                            @csrf

                            <div class="form-group row">
                                    <textarea name="content" id="new-message-textarea" cols="30" rows="4" placeholder="New message..."></textarea>
                            </div>

                            <div id="send-message-bt" class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">Send</button>

                            </div>
                        </form>
                    </div>

                    <div class="links-div">
                        <div class="links">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/messages.js'),}}"></script>

@endsection