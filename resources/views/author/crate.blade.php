@extends('AdminLayout.main')
@section('text')
    <div id="admin-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-3">
                    <h2 class="admin-heading">Add Author</h2>
                </div>
                <div class="offset-md-7 col-md-2">
                    <a class="add-new" href="{{ route('authors') }}">All Authors</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <form action="{{ route('author.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group mt-0">
                            <label>Author Name</label>
                            <input type="text" class="form-control @error('name') isinvalid @enderror"
                                placeholder="Author Name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" name="save" class="btn btn-danger mb-5" value="save" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
