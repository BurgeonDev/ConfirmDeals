@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Send Newsletter</h4>
                </div>
                <p class="card-description">Mail Newsletter to all Subscribed Users</p>
                <!-- Newsletter Form -->
                <div class="mb-3 card">

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
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <!-- Subscribers Table -->
            <div class="mb-4 card">

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Manage Subscribers</h4>
                    </div>
                    <p class="card-description">List of all Subscribers</p>
                    <table class="table table-hover" id="staticDataTables">
                        <thead>
                            <tr>
                                <th style="text-align: left;">ID</th>
                                <th style="text-align: left;">Email</th>
                                <th style="text-align: left;">Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td style="text-align: left;">{{ $subscriber->id }}</td>
                                    <td style="text-align: left;">{{ $subscriber->email }}</td>
                                    <td style="text-align: left;">
                                        {{ $subscriber->is_subscribed ? 'Subscribed' : 'Unsubscribed' }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.newsletters.destroy', $subscriber->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded btn-sm">Delete</button>
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
