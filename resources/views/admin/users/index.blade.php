@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">User Management</h4>
                </div>
                <p class="card-description">List of all users and their roles</p>

                <div class="table-responsive">
                    <table id="staticDataTables" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>

                                <th>Email</th>
                                <th>Coins</th>
                                <th>Status</th>
                                <th>Current Role</th>

                                <th>Assign New Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
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
                                    <td>{{ $user->roles->pluck('name')->first() ?? 'No role assigned' }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.assignRole', $user->id) }}">
                                            @csrf

                                            <select name="role" class="form-control-sm">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-success btn-fw">Assign
                                                Role</button>
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
