@extends('AdminLayout.main')
@section('text')
    <div class="row">
        <div class="col-12">
            <h4>Basic Information Fill all information below</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('book.update', $book->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3 select2">
                            <label>Book Name</label>
                            <input type="text" class="@error('name') isinvalid @enderror" placeholder="Book Name"
                                name="name" value="{{ $book->name }}">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 select2">
                            <label>Quantity</label>
                            <input type="text" class="@error('name') isinvalid @enderror" placeholder="Book Name"
                                name="quantity" value="{{ $book->quantity }}">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Author</label>
                            <select class="form-control select2 @error('author_id') isinvalid @enderror " name="author_id">
                                <option value="">Select Author</option>
                                @foreach ($authors as $author)
                                    @if ($author->id == $book->author_id)
                                        <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                                    @else
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Category</label>
                            <select class="form-control select2 @error('category_id') isinvalid @enderror "
                                name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $book->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class=" flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
