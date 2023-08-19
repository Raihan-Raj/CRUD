@extends('AdminLayout.main')
@section('text')
    <div id="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="admin-heading">Update Categories</h2>
                </div>
            </div>

            <form action="{{ route('category.update', $category->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="row p-0">
                    <div class="col-12 mt-5">
                        <div class="mt-3 ms-5">
                            <h3>Category Name:</h3>
                        </div>
                    </div>
                    <div class="col-6 m-0">
                        <input type="text" class="form-control @error('name') isinvalid @enderror" name="name"
                            value="{{ $category->name }}" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-danger mb-5" style="margin-bottom: 5%" value="Update"
                    required>
            </form>
        </div>
    </div>
@endsection
