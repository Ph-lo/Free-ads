@extends('layout')
@section('content')

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        <p>{{{ Auth::user()->name }}}</p>
                        <p>{{{ Auth::user()->email }}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modify-profile-card" class="container">
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
            <div class="col-md-10">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-header">Modify profile</div>
                    <div class="card-body">
                        <form action="{{ route('modifyProfile.post') }}" method="POST">

                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" value="{{Auth::user()->name}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" value="{{Auth::user()->email}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">Modify</button>

                            </div>
                            <a href="{{ route('modify.pass') }}">modify password</a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection