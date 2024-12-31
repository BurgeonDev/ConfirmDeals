@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-semibold text-gray-800">Coins Management</h2>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Coin Value</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th style="text-align: left;">Price (PKR)</th>
                                <th style="text-align: left;">Equivalence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coins as $coin)
                                <tr>

                                    <td style="text-align: left;">{{ $coin->price_in_pkr }}</td>
                                    <td style="text-align: left;">{{ $coin->equivalence }} coin</td>
                                    <td>

                                        <a href="{{ route('coins.edit', $coin->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">
                    <h4>Free Coins</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="free_coins">Free Coins to register Users</label>
                            <input type="number" id="free_coins" name="free_coins" class="form-control"
                                value="{{ $freeCoins }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
