<div class="d-flex align-items-center justify-content-center py-5">
    <div class="text-center px-3" style="max-width: 520px;">
        <div class="mb-3">
            <span class="badge badge-inline badge-lg {{ $badgeClass ?? 'badge-soft-dark' }} px-4 py-2">
                {{ $badgeText ?? translate('Empty Queue') }}
            </span>
        </div>
        <h2 class="fs-22 fw-700 text-dark mb-2">{{ $title }}</h2>
        <p class="fs-14 text-secondary mb-4">{{ $message }}</p>
        <div class="d-flex flex-wrap justify-content-center">
            @if (!empty($primaryRoute) && !empty($primaryLabel))
                <a href="{{ $primaryRoute }}" class="btn btn-primary mr-2 mb-2">{{ $primaryLabel }}</a>
            @endif
            @if (!empty($secondaryRoute) && !empty($secondaryLabel))
                <a href="{{ $secondaryRoute }}" class="btn btn-soft-secondary mb-2">{{ $secondaryLabel }}</a>
            @endif
        </div>
    </div>
</div>
