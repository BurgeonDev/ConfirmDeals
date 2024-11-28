@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between">
                <h2 class="text-xl font-semibold text-gray-800">Coins</h2>
                <a href="{{ route('coins.create') }}" class="btn btn-primary">Add Coin</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Coins</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Count</th>
                                <th>From Price</th>
                                <th>To Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coins as $coin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $coin->count }}</td>
                                    <td>{{ $coin->from_price }}</td>
                                    <td>{{ $coin->to_price }}</td>
                                    <td>
                                        <a href="{{ route('coins.edit', $coin->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('coins.destroy', $coin->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
