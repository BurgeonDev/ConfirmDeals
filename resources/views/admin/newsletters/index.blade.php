{{-- @extends('layouts.admin')

@section('content')
    <h1>Manage Subscribers</h1>

    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->is_subscribed ? 'Subscribed' : 'Unsubscribed' }}</td>
                    <td>
                        <form action="{{ route('admin.newsletters.destroy', $subscriber->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Send Newsletter</h2>
    <form action="{{ route('admin.newsletters.send') }}" method="POST">
        @csrf
        <textarea name="content" rows="4" placeholder="Newsletter content" required></textarea>
        <button type="submit">Send</button>
    </form>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
@endsection --}}
@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-semibold text-gray-800">Manage Subscribers</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="mb-3  card">
                <div class="card-header">
                    <h4>Send Newsletter</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.newsletters.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" rows="4" class="form-control" placeholder="Newsletter content" required></textarea>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
            <div class="mb-4 card">
                <div class="card-header">
                    <h4>Subscribers</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="staticDataTables">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Email</th>
                                <th style="text-align: left;">Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td style="text-align: left;">{{ $subscriber->email }}</td>
                                    <td style="text-align: left;">
                                        {{ $subscriber->is_subscribed ? 'Subscribed' : 'Unsubscribed' }}</td>
                                    <td>
                                        <form action="{{ route('admin.newsletters.destroy', $subscriber->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
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
