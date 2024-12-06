@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4 d-flex justify-content-between">
                <h2 class="text-xl font-semibold text-gray-800">Reported Ads</h2>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Reported Ads</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="staticDataTables">
                        <thead>
                            <tr>
                                <th style="text-align: left">ID</th>
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
                                    <td style="text-align: left">{{ $report->id }}</td>
                                    <td>{{ $report->ad->title }}</td>
                                    <td>{{ $report->user->first_name }} {{ $report->user->last_name }}</td>
                                    <td>{{ $report->reason }}</td>
                                    <td>{{ Str::limit($report->description, 50) }}</td>
                                    <td>{{ $report->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('ad.show', $report->ad->id) }}" class="btn btn-info btn-sm">
                                            View Ad
                                        </a>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
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
@endsection
