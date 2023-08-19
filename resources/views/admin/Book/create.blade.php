@extends('AdminLayout.main')
@section('text')
    <!-- start page title -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body cardcol">
                    <h2 class="text-center">Book Form</h2>
                    <p class="text-center card-title-desc">Fill all information below</p>
                    <div>
                        <a class="btn btn-danger" href="">All Books</a>
                    </div>
                    <hr class="hrz">

                    <form method="POST" action="{{ route('book.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="d-flex justify-content-start" for="bookname">Book Name</label>
                                    <input id="bookname" name="name" type="text" class="form-control"
                                        placeholder="Book Name">
                                    @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="d-flex justify-content-start" for="Quantity">Quantity</label>
                                    <input id="Quantity" name="quantity" type="text" class="form-control"
                                        placeholder="Quantity">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="d-flex justify-content-start control-label">Author
                                    </label>
                                    <span class="justify-content-end"><a class="btn btn-primary mb-2"
                                            onclick="catemodal()">Add
                                            New
                                            Author</a></span>
                                    <select class="form-control select2 @error('author_id') isinvalid @enderror"
                                        name="author_id" required>
                                        <option>Select Author</option>
                                        @foreach ($authors as $author)
                                            <option value='{{ $author->id }}'>{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('author_id')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="d-flex justify-content-start control-label">Category
                                    </label>
                                    <span class="justify-content-end"><a class="btn btn-primary mb-2" onclick="#">Add
                                            New
                                            Category</a></span>
                                    <select class="form-control select2" name="category_id">
                                        <option>Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="basicToastBtn">Book
                                Upload
                            </button>
                            <!-- <button type="button" class="btn btn-danger waves-effect waves-light">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
