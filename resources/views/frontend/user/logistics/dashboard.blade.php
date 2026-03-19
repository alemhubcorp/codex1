@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $statusMap = [
            'pending' => ['label' => translate('Pending'), 'class' => 'badge-warning'],
            'in_transit' => ['label' => translate('In Transit'), 'class' => 'badge-info'],
            'delivered' => ['label' => translate('Delivered'), 'class' => 'badge-success'],
            'cancelled' => ['label' => translate('Cancelled'), 'class' => 'badge-danger'],
        ];
    @endphp

    <div class="mb-4 p-4 p-lg-5 rounded overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 55%, #38bdf8 100%); color: #fff;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <p class="text-uppercase fs-12 fw-700 mb-2 opacity-75">{{ translate('Logistics Company Workspace') }}</p>
                <h1 class="fs-28 fw-800 mb-2">{{ translate('Welcome back,') }} {{ $authUser->name }}</h1>
                <p class="mb-0 fs-15 opacity-85">
                    {{ translate('This workspace shows live platform movement, message volume and the latest operational orders.') }}
                </p>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 text-lg-right">
                <a href="{{ route('profile') }}" class="btn btn-light text-primary fw-700 px-4 py-2 mr-2">{{ translate('Profile') }}</a>
                <a href="{{ route('logistics.conversations.index') }}" class="btn btn-outline-light fw-700 px-4 py-2">{{ translate('Messages') }}</a>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-md-3 mb-4">
            <a href="{{ route('logistics.orders.index', ['status' => 'pending']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="size-44px rounded-circle bg-soft-warning d-flex align-items-center justify-content-center mr-3">
                            <i class="las la-clock fs-20 text-warning"></i>
                        </div>
                        <div>
                            <p class="fs-13 text-secondary mb-1">{{ translate('Pending Orders') }}</p>
                            <h2 class="fs-34 fw-800 mb-0">{{ sprintf('%02d', $orderCounts['pending']) }}</h2>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">{{ translate('Orders waiting for confirmation or dispatch.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('logistics.orders.index', ['status' => 'in_transit']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="size-44px rounded-circle bg-soft-info d-flex align-items-center justify-content-center mr-3">
                            <i class="las la-truck fs-20 text-info"></i>
                        </div>
                        <div>
                            <p class="fs-13 text-secondary mb-1">{{ translate('In Transit') }}</p>
                            <h2 class="fs-34 fw-800 mb-0">{{ sprintf('%02d', $orderCounts['in_transit']) }}</h2>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">{{ translate('Picked up and on-the-way orders in live circulation.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('logistics.orders.index', ['status' => 'delivered']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="size-44px rounded-circle bg-soft-success d-flex align-items-center justify-content-center mr-3">
                            <i class="las la-check-circle fs-20 text-success"></i>
                        </div>
                        <div>
                            <p class="fs-13 text-secondary mb-1">{{ translate('Delivered') }}</p>
                            <h2 class="fs-34 fw-800 mb-0">{{ sprintf('%02d', $orderCounts['delivered']) }}</h2>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">{{ translate('Completed deliveries already closed in the system.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('logistics.conversations.index') }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="size-44px rounded-circle bg-soft-primary d-flex align-items-center justify-content-center mr-3">
                            <i class="las la-bell fs-20 text-primary"></i>
                        </div>
                        <div>
                            <p class="fs-13 text-secondary mb-1">{{ translate('Unread Messages') }}</p>
                            <h2 class="fs-34 fw-800 mb-0">{{ sprintf('%02d', $unreadConversations) }}</h2>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">{{ translate('Unread conversation threads in your workspace.') }}</p>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="row gutters-16 mt-1">
        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-18 fw-700 mb-0">{{ translate('Recent Orders') }}</h3>
                        <span class="badge badge-soft-primary">{{ translate('Live data') }}</span>
                    </div>
                    @if ($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="text-secondary fs-12">
                                    <tr>
                                        <th class="pl-0">{{ translate('Order') }}</th>
                                        <th>{{ translate('Customer') }}</th>
                                        <th>{{ translate('Status') }}</th>
                                        <th class="text-right pr-0">{{ translate('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                    <tr>
                                        <td class="pl-0 fw-700">{{ $order->code }}</td>
                                        <td>
                                            {{ $order->user?->name ?? translate('Guest') }}
                                            @if($order->seller)
                                                <div class="fs-12 text-muted">{{ translate('Seller') }}: {{ $order->seller->name }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $status = $statusMap[$order->delivery_status] ?? ['label' => ucfirst(str_replace('_', ' ', $order->delivery_status)), 'class' => 'badge-secondary'];
                                            @endphp
                                            <span class="badge {{ $status['class'] }} badge-inline">{{ $status['label'] }}</span>
                                        </td>
                                        <td class="text-right pr-0 text-muted">{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('frontend.user.partials.queue_empty_state', [
                            'badgeText' => translate('Logistics Dashboard'),
                            'badgeClass' => 'badge-soft-primary',
                            'title' => translate('No recent logistics orders'),
                            'message' => translate('There are no recent operational orders to show here yet. New live orders will appear in this panel once the queue starts moving.'),
                            'primaryRoute' => route('logistics.orders.index'),
                            'primaryLabel' => translate('Open Orders Queue'),
                            'secondaryRoute' => route('logistics.dashboard'),
                            'secondaryLabel' => translate('Refresh View'),
                        ])
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h3 class="fs-18 fw-700 mb-3">{{ translate('Quick Actions') }}</h3>
                        @include('frontend.user.partials.workspace_actions', [
                            'hasActions' => (($orderCounts['pending'] + $orderCounts['in_transit'] + $orderCounts['delivered'] + $orderCounts['cancelled'] + $unreadConversations) > 0 || $recentOrders->count() > 0 || $recentConversations->count() > 0),
                            'buttons' => [
                                [
                                    'route' => route('logistics.orders.index'),
                                    'label' => translate('Open Orders'),
                                    'class' => 'btn btn-soft-primary btn-block mb-2',
                                ],
                                [
                                    'route' => route('logistics.conversations.index'),
                                    'label' => translate('Open Messages'),
                                    'class' => 'btn btn-soft-secondary btn-block mb-2',
                                ],
                                [
                                    'route' => route('customer.all-notifications'),
                                    'label' => translate('Customer Notifications'),
                                    'class' => 'btn btn-soft-secondary btn-block mb-2',
                                ],
                                [
                                    'route' => route('profile'),
                                    'label' => translate('Profile'),
                                    'class' => 'btn btn-soft-dark btn-block mb-2',
                                ],
                                [
                                    'route' => route('home'),
                                    'label' => translate('Back to Website'),
                                    'class' => 'btn btn-soft-success btn-block',
                                ],
                            ],
                            'metrics' => [
                                [
                                    'label' => translate('Unread conversations:'),
                                    'value' => $unreadConversations,
                                ],
                            ],
                            'note' => translate('This view is wired to live order and message data, so it can be expanded later into dispatch tooling without changing the entry point.'),
                            'emptyState' => [
                                'badgeText' => translate('Quick Actions'),
                                'badgeClass' => 'badge-soft-primary',
                                'title' => translate('No active logistics workload'),
                                'message' => translate('There are no open orders or conversation threads in this workspace right now. The main operational links will appear here again once work arrives.'),
                                'primaryRoute' => route('logistics.orders.index'),
                                'primaryLabel' => translate('Open Orders Queue'),
                                'secondaryRoute' => route('logistics.conversations.index'),
                                'secondaryLabel' => translate('Open Messages'),
                            ],
                        ])
                    </div>
                </div>
            </div>
    </div>

    <div class="row gutters-16">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h3 class="fs-18 fw-700 mb-3">{{ translate('Operational Snapshot') }}</h3>
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="p-3 rounded bg-light h-100">
                                <p class="fs-12 text-secondary mb-1">{{ translate('Pending') }}</p>
                                <div class="fs-22 fw-800">{{ sprintf('%02d', $orderCounts['pending']) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="p-3 rounded bg-light h-100">
                                <p class="fs-12 text-secondary mb-1">{{ translate('In Transit') }}</p>
                                <div class="fs-22 fw-800">{{ sprintf('%02d', $orderCounts['in_transit']) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="p-3 rounded bg-light h-100">
                                <p class="fs-12 text-secondary mb-1">{{ translate('Delivered') }}</p>
                                <div class="fs-22 fw-800">{{ sprintf('%02d', $orderCounts['delivered']) }}</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="p-3 rounded bg-light h-100">
                                <p class="fs-12 text-secondary mb-1">{{ translate('Cancelled') }}</p>
                                <div class="fs-22 fw-800">{{ sprintf('%02d', $orderCounts['cancelled']) }}</div>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 text-muted">{{ translate('These are live counters from the order table and can later be wired to company-specific filters if needed.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-18 fw-700 mb-0">{{ translate('Recent Conversations') }}</h3>
                        <span class="badge badge-soft-secondary">{{ translate('Live messages') }}</span>
                    </div>
                    @if ($recentConversations->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="text-secondary fs-12">
                                    <tr>
                                        <th class="pl-0">{{ translate('Thread') }}</th>
                                        <th>{{ translate('Participants') }}</th>
                                        <th>{{ translate('Last Updated') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentConversations as $conversation)
                                    @php
                                        $otherParty = $conversation->sender_id == $authUser->id ? $conversation->receiver : $conversation->sender;
                                    @endphp
                                    <tr>
                                            <td class="pl-0 fw-700">
                                                <a href="{{ route('logistics.conversations.show', encrypt($conversation->id)) }}" class="text-reset hov-text-primary">
                                                    {{ $conversation->title ?? translate('Conversation') }}
                                                </a>
                                            </td>
                                        <td>{{ $otherParty?->name ?? translate('Participant') }}</td>
                                        <td class="text-muted">{{ date('d.m.Y', strtotime($conversation->updated_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('frontend.user.partials.queue_empty_state', [
                            'badgeText' => translate('Logistics Messages'),
                            'badgeClass' => 'badge-soft-secondary',
                            'title' => translate('No recent logistics conversations'),
                            'message' => translate('There are no recent message threads in this workspace yet. When a shipment discussion starts, it will appear here.'),
                            'primaryRoute' => route('logistics.conversations.index'),
                            'primaryLabel' => translate('Open Messages'),
                            'secondaryRoute' => route('logistics.dashboard'),
                            'secondaryLabel' => translate('Refresh View'),
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
