@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Ads</h4>
                    <a href="{{ route('ad.create') }}" class="btn btn-success btn-rounded btn-fw">Add Ad</a>
                </div>
                <p class="card-description">List of all Ads to be Approved / DisApproved</p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="staticDataTables">
                            <thead>
                                <tr>
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
                                        <td>{{ $ad->price ? number_format($ad->price, 2) : 'N/A' }}</td>
                                        <td>{{ $ad->coins_needed }}</td>
                                        <td>
                                            <form action="{{ route('ads.toggleVerifiedStatus', $ad->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <label class="form-switch">
                                                    <input type="checkbox" class="form-check-input"
                                                        onchange="this.form.submit()"
                                                        {{ $ad->is_verified ? 'checked' : '' }}>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('ad.show', $ad->id) }}"
                                                class="btn btn-info btn-rounded btn-sm">
                                                Show
                                            </a>
                                            <form action="{{ route('ads.destroy', $ad->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded btn-sm"
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
    </div>
@endsection
