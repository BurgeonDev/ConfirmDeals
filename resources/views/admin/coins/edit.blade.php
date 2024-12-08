@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Edit Coin</h2>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Update Coin Details</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('coins.update', $coin->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 form-group">
                            <label for="price_in_pkr" class="form-label">Price (PKR)</label>
                            <input type="number" step="0.01" class="form-control" id="price_in_pkr" name="price_in_pkr"
                                value="{{ old('price_in_pkr', $coin->price_in_pkr) }}" required>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="equivalence" class="form-label">Equivalence</label>
                            <input type="number" class="form-control" id="equivalence" name="equivalence"
                                value="{{ old('equivalence', $coin->equivalence) }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update Coin</button>
                            <a href="{{ route('coins.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
