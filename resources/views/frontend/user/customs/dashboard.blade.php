@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $statusMap = [
            1 => ['label' => translate('Requested'), 'class' => 'badge-secondary'],
            2 => ['label' => translate('Accepted'), 'class' => 'badge-success'],
            3 => ['label' => translate('Rejected'), 'class' => 'badge-danger'],
            0 => ['label' => translate('Draft'), 'class' => 'badge-light'],
        ];
    @endphp

    <div class="mb-4 p-4 p-lg-5 rounded overflow-hidden" style="background: linear-gradient(135deg, #3b0d0c 0%, #b91c1c 58%, #f59e0b 100%); color: #fff;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <p class="text-uppercase fs-12 fw-700 mb-2 opacity-75">{{ translate('Customs Broker Workspace') }}</p>
                <h1 class="fs-28 fw-800 mb-2">{{ translate('Welcome back,') }} {{ $authUser->name }}</h1>
                <p class="mb-0 fs-15 opacity-85">
                    {{ translate('This workspace surfaces preorder workload, active threads and status buckets that matter for clearance coordination.') }}
                </p>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 text-lg-right">
                <a href="{{ route('profile') }}" class="btn btn-light text-danger fw-700 px-4 py-2 mr-2">{{ translate('Profile') }}</a>
                <a href="{{ route('customs.preorders.index') }}" class="btn btn-outline-light fw-700 px-4 py-2">{{ translate('Work Queue') }}</a>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-lg-2 col-md-6 mb-4">
            <a href="{{ route('customs.preorders.index', ['status' => 'requested']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <p class="fs-13 text-secondary mb-2">{{ translate('Requested') }}</p>
                    <h2 class="fs-34 fw-800 mb-2">{{ sprintf('%02d', $preorderCounts['requested']) }}</h2>
                    <p class="mb-0 text-muted">{{ translate('Preorders waiting for first approval.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <a href="{{ route('customs.preorders.index', ['status' => 'prepayment_requests']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <p class="fs-13 text-secondary mb-2">{{ translate('Prepayment') }}</p>
                    <h2 class="fs-34 fw-800 mb-2">{{ sprintf('%02d', $preorderCounts['prepayment']) }}</h2>
                    <p class="mb-0 text-muted">{{ translate('Preorders waiting for payment confirmation.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <a href="{{ route('customs.preorders.index', ['status' => 'final_preorders']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <p class="fs-13 text-secondary mb-2">{{ translate('Final Order') }}</p>
                    <h2 class="fs-34 fw-800 mb-2">{{ sprintf('%02d', $preorderCounts['final_order']) }}</h2>
                    <p class="mb-0 text-muted">{{ translate('Orders that moved to the final confirmation step.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <a href="{{ route('customs.preorders.index', ['status' => 'delivered']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <p class="fs-13 text-secondary mb-2">{{ translate('Delivered') }}</p>
                    <h2 class="fs-34 fw-800 mb-2">{{ sprintf('%02d', $preorderCounts['delivered']) }}</h2>
                    <p class="mb-0 text-muted">{{ translate('Completed deliveries already closed.') }}</p>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <a href="{{ route('customs.preorders.index', ['status' => 'refund']) }}" class="text-reset d-block h-100">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <p class="fs-13 text-secondary mb-2">{{ translate('Refunds') }}</p>
                    <h2 class="fs-34 fw-800 mb-2">{{ sprintf('%02d', $preorderCounts['refunds']) }}</h2>
                    <p class="mb-0 text-muted">{{ translate('Refund requests waiting for review.') }}</p>
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
                        <h3 class="fs-18 fw-700 mb-0">{{ translate('Recent Preorders') }}</h3>
                        <span class="badge badge-soft-danger">{{ translate('Live data') }}</span>
                    </div>
                    @if ($recentPreorders->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="text-secondary fs-12">
                                    <tr>
                                        <th class="pl-0">{{ translate('Order') }}</th>
                                        <th>{{ translate('Product') }}</th>
                                        <th>{{ translate('Status') }}</th>
                                        <th class="text-right pr-0">{{ translate('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPreorders as $preorder)
                                    <tr>
                                        <td class="pl-0 fw-700">
                                            <a href="{{ route('customs.preorders.show', encrypt($preorder->id)) }}" class="text-reset hov-text-primary">
                                                {{ $preorder->order_code }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $preorder->preorder_product?->product_name ?? translate('Preorder item') }}
                                            <div class="fs-12 text-muted">
                                                {{ $preorder->user?->name ?? translate('Customer') }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                if ($preorder->refund_status == 2) {
                                                    $status = ['label' => translate('Refunded'), 'class' => 'badge-success'];
                                                } elseif ($preorder->delivery_status == 2) {
                                                    $status = ['label' => translate('Delivered'), 'class' => 'badge-success'];
                                                } elseif ($preorder->shipping_status == 2) {
                                                    $status = ['label' => translate('In Shipping'), 'class' => 'badge-info'];
                                                } elseif ($preorder->final_order_status == 1) {
                                                    $status = ['label' => translate('Final Order Requested'), 'class' => 'badge-warning'];
                                                } elseif ($preorder->final_order_status == 2) {
                                                    $status = ['label' => translate('Final Order Accepted'), 'class' => 'badge-success'];
                                                } elseif ($preorder->final_order_status == 3) {
                                                    $status = ['label' => translate('Final Order Rejected'), 'class' => 'badge-danger'];
                                                } elseif ($preorder->prepayment_confirm_status == 1) {
                                                    $status = ['label' => translate('Prepayment Requested'), 'class' => 'badge-primary'];
                                                } elseif ($preorder->prepayment_confirm_status == 2) {
                                                    $status = ['label' => translate('Prepayment Accepted'), 'class' => 'badge-success'];
                                                } elseif ($preorder->prepayment_confirm_status == 3) {
                                                    $status = ['label' => translate('Prepayment Rejected'), 'class' => 'badge-danger'];
                                                } elseif ($preorder->request_preorder_status == 1) {
                                                    $status = ['label' => translate('Preorder Requested'), 'class' => 'badge-secondary'];
                                                } elseif ($preorder->request_preorder_status == 2) {
                                                    $status = ['label' => translate('Request Accepted'), 'class' => 'badge-gray'];
                                                } else {
                                                    $status = ['label' => translate('Draft'), 'class' => 'badge-light'];
                                                }
                                            @endphp
                                            <span class="badge {{ $status['class'] }} badge-inline">{{ $status['label'] }}</span>
                                        </td>
                                        <td class="text-right pr-0 text-muted">{{ date('d.m.Y', strtotime($preorder->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('frontend.user.partials.queue_empty_state', [
                            'badgeText' => translate('Customs Dashboard'),
                            'badgeClass' => 'badge-soft-danger',
                            'title' => translate('No recent customs preorders'),
                            'message' => translate('There are no recent preorder requests to show here yet. Once new customs work is created, it will appear in this panel.'),
                            'primaryRoute' => route('customs.preorders.index'),
                            'primaryLabel' => translate('Open Work Queue'),
                            'secondaryRoute' => route('customs.dashboard'),
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
                            'hasActions' => (($preorderCounts['requested'] + $preorderCounts['prepayment'] + $preorderCounts['final_order'] + $preorderCounts['delivered'] + $preorderCounts['refunds'] + $activePreorderThreads + $pendingProductQueries) > 0 || $recentPreorders->count() > 0 || $recentPreorderThreads->count() > 0),
                            'buttons' => [
                                [
                                    'route' => route('customs.preorders.index'),
                                    'label' => translate('Open Work Queue'),
                                    'class' => 'btn btn-soft-danger btn-block mb-2',
                                ],
                                [
                                    'route' => route('customs.preorder-conversations.index'),
                                    'label' => translate('Open Preorder Chats'),
                                    'class' => 'btn btn-soft-danger btn-block mb-2',
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
                                    'label' => translate('Active preorder threads:'),
                                    'value' => $activePreorderThreads,
                                ],
                                [
                                    'label' => translate('Pending product questions:'),
                                    'value' => $pendingProductQueries,
                                ],
                            ],
                            'footerButtons' => [
                                [
                                    'route' => route('customs.product_queries.index', ['status' => 'unanswered']),
                                    'label' => translate('Open Product Queries'),
                                    'class' => 'btn btn-soft-secondary btn-block mb-3',
                                ],
                            ],
                            'note' => translate('This dashboard uses existing preorder tables, so the broker view can evolve with real status data instead of mock content.'),
                            'emptyState' => [
                                'badgeText' => translate('Quick Actions'),
                                'badgeClass' => 'badge-soft-danger',
                                'title' => translate('No active customs workload'),
                                'message' => translate('There are no open preorders, threads, or unanswered questions in this workspace right now. The main operational links will appear here again once work arrives.'),
                                'primaryRoute' => route('customs.preorders.index'),
                                'primaryLabel' => translate('Open Work Queue'),
                                'secondaryRoute' => route('customs.preorder-conversations.index'),
                                'secondaryLabel' => translate('Open Preorder Chats'),
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
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-18 fw-700 mb-0">{{ translate('Recent Threads') }}</h3>
                        <span class="badge badge-soft-primary">{{ translate('Workspace activity') }}</span>
                    </div>
                    @if ($recentPreorderThreads->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="text-secondary fs-12">
                                    <tr>
                                        <th class="pl-0">{{ translate('Thread') }}</th>
                                        <th>{{ translate('Product') }}</th>
                                        <th>{{ translate('Participants') }}</th>
                                        <th class="text-right pr-0">{{ translate('Updated') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPreorderThreads as $thread)
                                    <tr>
                                        <td class="pl-0 fw-700">
                                            <a href="{{ route('customs.preorder-conversations.show', encrypt($thread->id)) }}" class="text-reset hov-text-primary">
                                                {{ $thread->title ?? translate('Preorder thread') }}
                                            </a>
                                        </td>
                                        <td>{{ $thread->preorderProduct?->product_name ?? translate('Preorder product') }}</td>
                                        <td>
                                            {{ $thread->sender?->name ?? translate('Sender') }}
                                            <span class="text-muted">/</span>
                                            {{ $thread->receiver?->name ?? translate('Receiver') }}
                                        </td>
                                        <td class="text-right pr-0 text-muted">{{ date('d.m.Y', strtotime($thread->updated_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        @include('frontend.user.partials.queue_empty_state', [
                            'badgeText' => translate('Customs Chats'),
                            'badgeClass' => 'badge-soft-primary',
                            'title' => translate('No recent customs threads'),
                            'message' => translate('There are no recent preorder chat threads yet. When a discussion starts, it will appear here as workspace activity.'),
                            'primaryRoute' => route('customs.preorder-conversations.index'),
                            'primaryLabel' => translate('Open Preorder Chats'),
                            'secondaryRoute' => route('customs.dashboard'),
                            'secondaryLabel' => translate('Refresh View'),
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
