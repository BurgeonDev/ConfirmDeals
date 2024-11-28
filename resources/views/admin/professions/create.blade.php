@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Add Profession</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('professions.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">Profession Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter profession name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Profession</button>
                        <a href="{{ route('professions.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
