@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Coin Value</h4>
                </div>
                <p class="card-description">Value of Single Coin in PKR</p>
                <div class="card">

                    <div class="card-body">
                        <table class="table table-hover">
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
                                                class="btn btn-info btn-rounded">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <br><br>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Free Coins</h4>
                </div>
                <p class="card-description">Number Of free Coins Given to Register Users</p>
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="free_coins">Free Coins to register Users</label>
                                <input type="number" id="free_coins" name="free_coins" class="form-control"
                                    value="{{ $freeCoins }}" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-rounded btn-fw">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
