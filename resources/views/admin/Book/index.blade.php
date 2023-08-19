@extends('AdminLayout.main')
@section('text')
    <div class="row m-0">
        <div class="col-12" style="margin-top:2%; ">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <h3 class=" mt-0 mb-3 text-center"><b>All Books </b> </h3>
                </div>
                <hr>

                <div class="mt-3 text-center mb-3">
                    <a class="text-danger" href="{{ route('book.create') }}">Add Book</a>
                </div>
            </div>

            <table class="table table-bordered mt-0" id="brandtbl">
                <thead>
                    <tr class="textcol2 ">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Author Name</th>
                        <th>Category Name</th>
                        <th>Quantity</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @foreach ($books as $book)
                        <tr data-id="1">
                            <td class="text-center">{{ $book->id }}</td>
                            <td class="text-center">{{ $book->name }}</td>
                            <td class="text-center">{{ $book->Author->name }}</td>
                            <td class="text-center">{{ $book->BookCategory->name }}</td>
                            <td class="text-center">{{ $book->quantity }}</td>
                            <td class="text-center">
                                <a class="button button-small text-dark" href="{{ route('book.edit', $book) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('book.destroy', $book->id) }}" method="post" class="form-hidden">
                                    <button class="btn btn-danger delete-author">Delete</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
