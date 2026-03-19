@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $filterBase = request()->except(['status', 'page']);
        $statusTabs = [
            'all' => ['label' => translate('All'), 'class' => 'badge-soft-dark'],
            'unanswered' => ['label' => translate('Unanswered'), 'class' => 'badge-warning'],
            'answered' => ['label' => translate('Answered'), 'class' => 'badge-success'],
        ];
    @endphp

    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Product Queries') }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Track and reply to preorder product questions.') }}</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('customs.dashboard') }}" class="btn btn-soft-danger">{{ translate('Back to Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap">
                @foreach ($statusTabs as $key => $tab)
                    <a href="{{ route('customs.product_queries.index', array_merge($filterBase, ['status' => $key])) }}"
                       class="badge badge-inline {{ $status == $key ? 'bg-soft-dark text-white' : 'preorder-border-dashed text-muted' }} mr-2 mb-2 p-3">
                        {{ $tab['label'] }} ({{ $counts[$key] ?? 0 }})
                    </a>
                @endforeach
            </div>

            <form action="{{ route('customs.product_queries.index') }}" method="GET" class="mt-4">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="row align-items-end">
                    <div class="col-lg-10 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ translate('Question, product, customer') }}">
                    </div>
                    <div class="col-lg-2 text-lg-right">
                        <button type="submit" class="btn btn-danger btn-block">{{ translate('Apply') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border">
        <div class="card-body py-0">
            @if ($queries->count() > 0)
                <div class="table-responsive">
                    <table class="table aiz-table mb-0">
                        <thead class="text-gray fs-12">
                            <tr>
                                <th class="pl-0">{{ translate('Question') }}</th>
                                <th>{{ translate('Product') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Reply Status') }}</th>
                                <th>{{ translate('Date') }}</th>
                                <th class="text-right pr-0">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-14">
                            @foreach ($queries as $query)
                            <tr>
                                <td class="pl-0">
                                    <div class="fw-600">{{ \Illuminate\Support\Str::limit($query->question, 80) }}</div>
                                    <div class="fs-12 text-muted">{{ translate('Query ID') }}: #{{ $query->id }}</div>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $query->preorderProduct?->getTranslation('product_name') ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $query->user?->name ?? '-' }}</div>
                                    <div class="fs-12 text-muted">{{ $query->user?->email ?? $query->user?->phone ?? '-' }}</div>
                                </td>
                                <td>
                                    @if ($query->reply == null)
                                        <span class="badge badge-warning badge-inline">{{ translate('Unanswered') }}</span>
                                    @else
                                        <span class="badge badge-success badge-inline">{{ translate('Answered') }}</span>
                                    @endif
                                </td>
                                <td>{{ date('d.m.Y H:i', strtotime($query->created_at)) }}</td>
                                <td class="text-right pr-0">
                                    <a href="{{ route('customs.product_queries.show', encrypt($query->id)) }}" class="btn btn-soft-danger btn-sm">
                                        {{ translate('View') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="aiz-pagination py-3">
                    {{ $queries->links() }}
                </div>
            @else
                @include('frontend.user.partials.queue_empty_state', [
                    'badgeText' => translate('Customs Chats'),
                    'badgeClass' => 'badge-soft-danger',
                    'title' => translate('No product queries yet'),
                    'message' => translate('There are no product questions matching the current filters. New questions will appear here for review and reply.'),
                    'primaryRoute' => route('customs.dashboard'),
                    'primaryLabel' => translate('Back to Dashboard'),
                    'secondaryRoute' => route('customs.product_queries.index'),
                    'secondaryLabel' => translate('Clear Filters'),
                ])
            @endif
        </div>
    </div>
@endsection
