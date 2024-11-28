@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Edit Coin</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('coins.update', $coin->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 form-group">
                            <label for="count">Coin Count</label>
                            <input type="number" class="form-control" id="count" name="count"
                                value="{{ $coin->count }}" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="from_price">From Price</label>
                            <input type="number" step="0.01" class="form-control" id="from_price" name="from_price"
                                value="{{ $coin->from_price }}" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="to_price">To Price</label>
                            <input type="number" step="0.01" class="form-control" id="to_price" name="to_price"
                                value="{{ $coin->to_price }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Coin</button>
                        <a href="{{ route('coins.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
