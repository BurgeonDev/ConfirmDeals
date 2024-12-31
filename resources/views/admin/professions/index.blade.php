@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Professions</h4>
                    <a href="{{ route('professions.create') }}" class="btn btn-success btn-rounded btn-fw">Add Profession</a>
                </div>
                <p class="card-description">List of all Professions</p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="staticDataTables">
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
                                                class="btn btn-info btn-rounded">Edit</a>
                                            <form action="{{ route('professions.destroy', $profession->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded"
                                                    onclick="return confirm('Are you sure you want to delete this profession?');">Delete</button>
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
