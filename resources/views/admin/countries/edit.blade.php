@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Edit Country</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('countries.update', $country->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 form-group">
                            <label for="name">Country Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $country->name }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Country</button>
                        <a href="{{ route('countries.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
