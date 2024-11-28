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
                    <h4>User Management</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="staticDataTables">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Coins</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Assign Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->coins }}</td>
                                    <td>
                                        <form action="{{ route('admin.toggleUserStatus', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label class="form-switch">
                                                <input type="checkbox" class="form-check-input"
                                                    onchange="this.form.submit()" {{ $user->is_active ? 'checked' : '' }}>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="btn badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.assignRole', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <select name="role" class="form-select" required>
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary ms-2">Assign</button>
                                            </div>
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
