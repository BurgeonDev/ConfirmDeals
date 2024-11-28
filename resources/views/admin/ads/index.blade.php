@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between">
                <h2 class="text-xl font-semibold text-gray-800">Ads</h2>
                <a href="{{ route('ad.create') }}" class="btn btn-primary">Add Ad</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Ads</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Picture</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Coins</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ads as $ad)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (!empty($ad->pictures) && is_array($ad->pictures))
                                            <img src="{{ asset('storage/' . $ad->pictures[0]) }}" alt="Ad Picture"
                                                class="img-thumbnail" style="width: 75px; height: 75px;">
                                        @else
                                            <span>No Picture</span>
                                        @endif
                                    </td>
                                    <td>{{ $ad->title }}</td>
                                    <td>{{ Str::limit($ad->description, 50) }}</td>
                                    <td>{{ ucfirst($ad->type) }}</td>
                                    <td>{{ ucfirst($ad->category->name) }}</td>
                                    <td>{{ $ad->price ? '' . number_format($ad->price, 2) : 'N/A' }}</td>
                                    <td>{{ $ad->coins_needed }}</td>
                                    <td>
                                        <form action="{{ route('ads.toggleVerifiedStatus', $ad->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label class="form-switch">
                                                <input type="checkbox" class="form-check-input"
                                                    onchange="this.form.submit()" {{ $ad->is_verified ? 'checked' : '' }}>
                                            </label>
                                        </form>
                                    </td>

                                    <td>
                                        <a href="{{ route('ad.show', $ad->id) }}" class="btn btn-info btn-sm">
                                            Show
                                        </a>
                                        <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this ad?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No ads found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
