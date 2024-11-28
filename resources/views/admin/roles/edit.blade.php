@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Role: {{ $role->name }}</h4>

                <form class="forms-sample" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="roleName">Role Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="roleName" value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Permissions</label><br>
                        <div class="container">
                            <!-- Add the "Check All" checkbox -->
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                        <label class="form-check-label" for="checkAll">
                                            Check All <i class="input-helper"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Chunk permissions into groups of 3 -->
                            @foreach ($permissions->chunk(3) as $permissionChunk)
                                <div class="row">
                                    @foreach ($permissionChunk as $permission)
                                        <div class="mb-3 col-md-4"> <!-- Each permission will take one-third of the row -->
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input permission-checkbox"
                                                    name="permissions[]" value="{{ $permission->id }}"
                                                    id="permission{{ $permission->id }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                                    {{ $permission->name }} <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update Role</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle "Check All" functionality -->
    <script>
        document.getElementById('checkAll').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
