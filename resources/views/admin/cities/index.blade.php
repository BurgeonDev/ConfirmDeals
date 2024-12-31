@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Cities</h4>
                    <a href="{{ route('cities.create') }}" class="btn btn-success btn-rounded btn-fw">Add City</a>
                </div>
                <p class="card-description">List of all Cities</p>
                <div class="table-responsive">
                    <table id="staticDataTables" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->country->name }}</td>
                                    <td>
                                        <a href="{{ route('cities.edit', $city->id) }}"
                                            class="btn btn-info btn-rounded">Edit</a>
                                        <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded"
                                                onclick="return confirm('Are you sure you want to delete this city?');">Delete</button>
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
