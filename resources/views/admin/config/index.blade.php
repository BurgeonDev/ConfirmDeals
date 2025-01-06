@extends('admin.layouts.app')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">App Configurations</h4>
                </div>
                <p class="card-description">App Configurations</p>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.config.update') }}">
                            @csrf

                            <div class="form-group">
                                <label for="featured_ads">Featured Ads Count</label>
                                <input type="number" name="featured_ads" id="featured_ads" class="form-control"
                                    value="{{ $configurations->where('key', 'featured_ads')->first()->value ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="pagination_value">Pagination Value</label>
                                <input type="number" name="pagination_value" id="pagination_value" class="form-control"
                                    value="{{ $configurations->where('key', 'pagination_value')->first()->value ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="product_ads_commission">Commission for Product Ads (Enter commission rate
                                    between 0 and 100)</label>
                                <input type="number" name="product_ads_commission" id="product_ads_commission"
                                    class="form-control"
                                    value="{{ $configurations->where('key', 'product_ads_commission')->first()->value ?? '' }}"
                                    step="any">
                                <small class="form-text text-muted">Enter a value between 0 and 100 (e.g., 50 for
                                    50%)</small>
                            </div>

                            <div class="form-group">
                                <label for="service_ads_commission">Commission for Service Ads (Enter commission rate
                                    between 0 and 100)</label>
                                <input type="number" name="service_ads_commission" id="service_ads_commission"
                                    class="form-control"
                                    value="{{ $configurations->where('key', 'service_ads_commission')->first()->value ?? '' }}"
                                    step="any">
                                <small class="form-text text-muted">Enter a value between 0 and 100 (e.g., 20 for
                                    20%)</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Configurations</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
