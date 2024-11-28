@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Add Locality</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('localities.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">Locality Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter locality name" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control" required>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Locality</button>
                        <a href="{{ route('localities.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
