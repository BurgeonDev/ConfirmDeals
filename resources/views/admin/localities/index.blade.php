@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between">
                <h2 class="text-xl font-semibold text-gray-800">Localities</h2>
                <a href="{{ route('localities.create') }}" class="btn btn-primary">Add Locality</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="staticDataTables">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($localities as $locality)
                                <tr>
                                    <td>{{ $locality->id }}</td>
                                    <td>{{ $locality->name }}</td>
                                    <td>{{ $locality->city->name }}</td>
                                    <td>
                                        <a href="{{ route('localities.edit', $locality->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('localities.destroy', $locality->id) }}" method="POST"
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
