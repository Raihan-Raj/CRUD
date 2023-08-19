@extends('AdminLayout.main')
@section('text')
    <div class="row m-0">
        <div class="col-12" style="margin-top:2%; ">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <h3 class=" mt-0 mb-3 text-center"><b>All Authors </b> </h3>
                </div>
                <hr>

                <div class="mt-3 text-center mb-3">
                    <a class="text-danger" href="{{ route('author.create') }}">Add Author</a>
                </div>
            </div>

            <table class="table table-bordered mt-0" id="brandtbl">
                <thead>
                    <tr class="textcol2 ">
                        <th>S.No</th>
                        <Th>Author_id</Th>
                        <th>Author Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <?php
                    $count = 1;
                    ?>
                    @foreach ($authors as $auther)
                        <tr data-id="1">
                            <td class="text-center">{{ $count }}</td>
                            <td class="text-center">{{ $auther->id }}</td>
                            <td class="text-center">{{ $auther->name }}</td>
                            <td class="text-center">
                                <a class="button button-small text-dark" href="{{ route('author.edit', $auther) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('author.destroy', $auther->id) }}" method="post"
                                    class="form-hidden">
                                    <button class="btn btn-danger delete-author">Delete</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <?php
                        $count++;
                        ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
