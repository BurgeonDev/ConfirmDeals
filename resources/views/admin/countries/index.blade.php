@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Countries</h4>
                    <a href="{{ route('countries.create') }}" class="btn btn-success btn-rounded btn-fw">Add Country</a>
                </div>
                 <p class="card-description">List of all Countries</p>
                <div class="card">

                    <div class="card-body">
                        <table class="table table-hover" id="staticDataTables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>
                                            <a href="{{ route('countries.edit', $country->id) }}"
                                                class="btn btn-info btn-rounded">Edit</a>
                                            <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded"
                                                    onclick="return confirm('Are you sure you want to delete this country?');">Delete</button>
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
    </div>
@endsection
