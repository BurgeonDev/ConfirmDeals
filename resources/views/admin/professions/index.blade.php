@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between">
                <h2 class="text-xl font-semibold text-gray-800">Professions</h2>
                <a href="{{ route('professions.create') }}" class="btn btn-primary">Add Profession</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Professions</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="staticDataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($professions as $profession)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $profession->name }}</td>
                                    <td>
                                        <a href="{{ route('professions.edit', $profession->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('professions.destroy', $profession->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
