@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-semibold text-gray-800">Coins Management</h2>
                <a href="{{ route('coins.create') }}" class="btn btn-primary">Add New Coin</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Coins</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped " id="staticDataTables">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Price (PKR)</th>
                                <th>Equivalence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coins as $coin)
                                <tr>
                                    <td>{{ $coin->id }}</td>
                                    <td>{{ $coin->price_in_pkr }}</td>
                                    <td>{{ $coin->equivalence }}</td>
                                    <td>

                                        <a href="{{ route('coins.edit', $coin->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('coins.destroy', $coin->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this coin?');">
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
