@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Add Category</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Enter category name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                placeholder="Enter category description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Category</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
