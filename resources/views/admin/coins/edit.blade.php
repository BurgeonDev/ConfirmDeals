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

                        <!-- Price in PKR Field -->
                        <div class="mb-3 form-group">
                            <label for="price_in_pkr" class="form-label">Price (PKR)of 1 Coin</label>
                            <input type="number" step="0.01" class="form-control" id="price_in_pkr" name="price_in_pkr"
                                value="{{ old('price_in_pkr', $coin->price_in_pkr) }}" required>
                            @error('price_in_pkr')
                                <div class="mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <input type="number" class="form-control" id="equivalence" name="equivalence"
                            value="{{ old('equivalence', $coin->equivalence) }}" required readonly hidden>
                        @error('equivalence')
                            <div class="mt-1 text-danger">{{ $message }}</div>
                        @enderror


                        <!-- Free Coins Field -->
                        <div class="mb-3 form-group">
                            <label for="free_coins" class="form-label">Free Coins to Register Users</label>
                            <input type="number" class="form-control" id="free_coins" name="free_coins"
                                value="{{ old('free_coins', $coin->free_coins) }}" required>
                            @error('free_coins')
                                <div class="mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured Ad Rate Field -->
                        <div class="mb-3 form-group">
                            <label for="featured_ad_rate" class="form-label">Featured Ad Coins Per Day</label>
                            <input type="number" class="form-control" id="featured_ad_rate" name="featured_ad_rate"
                                value="{{ old('featured_ad_rate', $coin->featured_ad_rate) }}" required>
                            @error('featured_ad_rate')
                                <div class="mt-1 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit and Cancel Buttons -->
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
