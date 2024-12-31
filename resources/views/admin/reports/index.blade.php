@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Reported Ads</h4>
                </div>
                <p class="card-description">List of all Reported Ads</p>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="staticDataTables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>Reported By</th>
                                    <th>Reason</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->ad->title }}</td>
                                        <td>{{ $report->user->first_name }} {{ $report->user->last_name }}</td>
                                        <td>{{ $report->reason }}</td>
                                        <td>{{ Str::limit($report->description, 50) }}</td>
                                        <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('ad.show', $report->ad->id) }}"
                                                class="btn btn-info btn-rounded btn-sm">
                                                View Ad
                                            </a>
                                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-rounded btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this report?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No reports found.</td>
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
