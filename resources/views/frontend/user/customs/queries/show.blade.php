@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Product Query') }} #{{ $query->id }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Question detail and reply state for customs workflow.') }}</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('customs.product_queries.index') }}" class="btn btn-soft-danger mr-2">{{ translate('Back to Queue') }}</a>
                <a href="{{ route('customs.dashboard') }}" class="btn btn-outline-danger">{{ translate('Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-lg-8 mb-4">
            <div class="card rounded-0 shadow-none border h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Question') }}</h5>
                </div>
                <div class="card-body">
                    <p class="fs-14 text-secondary mb-3">{{ date('d.m.Y H:i', strtotime($query->created_at)) }}</p>
                    <div class="p-4 rounded bg-light">
                        {!! nl2br(e($query->question)) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card rounded-0 shadow-none border h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Product') }}</p>
                        <div class="fw-600">{{ $query->preorderProduct?->getTranslation('product_name') ?? '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Customer') }}</p>
                        <div class="fw-600">{{ $query->user?->name ?? '-' }}</div>
                        <div class="fs-12 text-muted">{{ $query->user?->email ?? $query->user?->phone ?? '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Status') }}</p>
                        @if ($query->reply == null)
                            <span class="badge badge-warning badge-inline">{{ translate('Unanswered') }}</span>
                        @else
                            <span class="badge badge-success badge-inline">{{ translate('Answered') }}</span>
                        @endif
                    </div>
                    <a href="{{ route('customs.product_queries.index', ['status' => 'unanswered']) }}" class="btn btn-soft-danger btn-block mb-2">{{ translate('Open Unanswered') }}</a>
                    <a href="{{ route('customs.product_queries.index', ['status' => 'answered']) }}" class="btn btn-soft-secondary btn-block">{{ translate('Open Answered') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Reply') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('customs.product_queries.reply', encrypt($query->id)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <textarea name="reply" rows="5" class="form-control" placeholder="{{ translate('Type your reply') }}" required>{{ old('reply', $query->reply) }}</textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-danger px-4">{{ $query->reply == null ? translate('Send Reply') : translate('Update Reply') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
