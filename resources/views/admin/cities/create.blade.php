@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Add City</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('cities.store') }}">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">City Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter city name" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save City</button>
                        <a href="{{ route('cities.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
