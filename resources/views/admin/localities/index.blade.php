@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Localities</h4>
                    <a href="{{ route('localities.create') }}" class="btn btn-success btn-rounded btn-fw">Add Locality</a>
                </div>
                 <p class="card-description">List of all Localities</p>
                <div class="card">

                    <div class="card-body">
                        <table class="table table-hover" id="staticDataTables">
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
                                                class="btn btn-info btn-rounded">Edit</a>
                                            <form action="{{ route('localities.destroy', $locality->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded"
                                                    onclick="return confirm('Are you sure you want to delete this locality?');">Delete</button>
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
