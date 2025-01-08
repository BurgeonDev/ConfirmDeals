@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Coin Value</h4>
                </div>
                <p class="card-description">Details of Coins</p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">Price (PKR)</th>
                                    <th style="text-align: left;">Equivalence</th>
                                    <th style="text-align: left;">Free Coins</th>
                                    <th style="text-align: left;">Featured ad Coins</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coins as $coin)
                                    <tr>
                                        <td style="text-align: left;">{{ $coin->price_in_pkr }}</td>
                                        <td style="text-align: left;">{{ $coin->equivalence }} coin</td>
                                        <td style="text-align: left;">{{ $coin->free_coins }}</td>
                                        <td style="text-align: left;">{{ $coin->featured_ad_rate }}</td>
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
@endsection
