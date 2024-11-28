@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Users Roles</h4>

                    <!-- Check if the user can create a role -->
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-rounded btn-fw">Create New Role</a>

                </div>
                <div class="table-responsive">
                    <table id="staticDataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>

                                        <!-- Check if the user can edit a role -->
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-info btn-rounded">Edit</a>

                                        <!-- Check if the user can delete a role -->
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded"
                                                onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
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
