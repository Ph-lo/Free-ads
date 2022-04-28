@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div id="search-bar-div" class="card-header">
                    <p>Contact {{ $user_to }}</p>
                </div>
                <div id="new-message-form" class="card-body">
                    <form action="{{ route('message.post', $id) }}" method="POST">

                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6">
                                <textarea name="content" id="content" cols="45" rows="10" placeholder="New message..." required></textarea>
                            </div>
                        </div>


                        <div id="send-message-bt" class="col-md-6 offset-md-4">

                            <button type="submit" class="btn btn-primary">Send</button>

                        </div>

                        <div class="links-div">
                            <div class="links">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection