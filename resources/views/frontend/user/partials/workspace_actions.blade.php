@php
    $hasActions = $hasActions ?? false;
    $buttons = $buttons ?? [];
    $metrics = $metrics ?? [];
    $footerButtons = $footerButtons ?? [];
    $note = $note ?? null;
    $emptyState = $emptyState ?? [];
@endphp

@if ($hasActions)
    @foreach ($buttons as $button)
        <a href="{{ $button['route'] }}" class="{{ $button['class'] ?? 'btn btn-soft-secondary btn-block mb-2' }}">
            {{ $button['label'] }}
        </a>
    @endforeach

    @if (!empty($metrics) || !empty($footerButtons) || !empty($note))
        <div class="mt-4">
            @foreach ($metrics as $metric)
                <p class="fs-13 text-muted mb-2">{{ $metric['label'] }} <strong>{{ $metric['value'] }}</strong></p>
            @endforeach

            @foreach ($footerButtons as $button)
                <a href="{{ $button['route'] }}" class="{{ $button['class'] ?? 'btn btn-soft-secondary btn-block mb-3' }}">
                    {{ $button['label'] }}
                </a>
            @endforeach

            @if (!empty($note))
                <p class="fs-13 text-muted mb-0">{{ $note }}</p>
            @endif
        </div>
    @endif
@else
    @include('frontend.user.partials.queue_empty_state', $emptyState)
@endif
