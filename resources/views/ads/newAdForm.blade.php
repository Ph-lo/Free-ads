@extends('layout')
@section('content')


<main class="login-form">
    <div class="container">
        <a href="{{ route('my.ads') }}">back</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>New ad</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ad.post') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" id="ad-title" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>
                                <div class="col-md-6">
                                    <select name="type" class="form-select form-select-sm" aria-label=".form-select-lg example">
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
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea name="description" id="description" cols="30" rows="10" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-6">
                                    <input type="number" id="ad-price" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="images" class="col-md-4 col-form-label text-md-right">Pictures</label>
                                <div class="col-md-6">
                                    <input type="file" name="images[]" multiple>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{{ Auth::user()->id }}}">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">Create</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection