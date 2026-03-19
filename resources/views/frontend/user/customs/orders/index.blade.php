@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $filterBase = request()->except(['status', 'page']);
        $statusTabs = [
            'all' => ['label' => translate('All'), 'class' => 'badge-soft-dark'],
            'requested' => ['label' => translate('Requested'), 'class' => 'badge-secondary'],
            'accepted_requests' => ['label' => translate('Accepted Requests'), 'class' => 'badge-success'],
            'prepayment_requests' => ['label' => translate('Prepayment Requests'), 'class' => 'badge-primary'],
            'confirmed_prepayments' => ['label' => translate('Confirmed Prepayments'), 'class' => 'badge-info'],
            'final_preorders' => ['label' => translate('Final Preorders'), 'class' => 'badge-warning'],
            'in_shipping' => ['label' => translate('In Shipping'), 'class' => 'badge-info'],
            'delivered' => ['label' => translate('Delivered'), 'class' => 'badge-success'],
            'refund' => ['label' => translate('Refund'), 'class' => 'badge-danger'],
        ];
    @endphp

    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Customs Preorders') }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Open and filter preorder workload by stage.') }}</p>
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
                    <a href="{{ route('customs.preorders.index', array_merge($filterBase, ['status' => $key])) }}"
                       class="badge badge-inline {{ $status == $key ? 'bg-soft-dark text-white' : 'preorder-border-dashed text-muted' }} mr-2 mb-2 p-3">
                        {{ $tab['label'] }} ({{ $counts[$key] ?? 0 }})
                    </a>
                @endforeach
            </div>

            <form action="{{ route('customs.preorders.index') }}" method="GET" class="mt-4">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="row align-items-end">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ translate('Preorder code, customer, product') }}">
                    </div>
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Date') }}</label>
                        <input type="text" name="date" value="{{ request('date') }}" class="aiz-date-range form-control" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                    </div>
                    <div class="col-lg-3 text-lg-right">
                        <button type="submit" class="btn btn-danger btn-block">{{ translate('Apply') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border">
        <div class="card-body py-0">
            @if ($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table aiz-table mb-0">
                        <thead class="text-gray fs-12">
                            <tr>
                                <th class="pl-0">{{ translate('Preorder') }}</th>
                                <th>{{ translate('Product / Qty') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Date') }}</th>
                                <th class="text-right pr-0">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-14">
                            @foreach ($orders as $order)
                            @php
                                if ($order->refund_status == 2) {
                                    $statusBadge = ['label' => translate('Refunded'), 'class' => 'badge-success'];
                                } elseif ($order->delivery_status == 2) {
                                    $statusBadge = ['label' => translate('Delivered'), 'class' => 'badge-success'];
                                } elseif ($order->shipping_status == 2) {
                                    $statusBadge = ['label' => translate('In Shipping'), 'class' => 'badge-info'];
                                } elseif ($order->final_order_status == 1) {
                                    $statusBadge = ['label' => translate('Final Order Requested'), 'class' => 'badge-warning'];
                                } elseif ($order->final_order_status == 2) {
                                    $statusBadge = ['label' => translate('Final Order Accepted'), 'class' => 'badge-success'];
                                } elseif ($order->final_order_status == 3) {
                                    $statusBadge = ['label' => translate('Final Order Cancelled'), 'class' => 'badge-danger'];
                                } elseif ($order->prepayment_confirm_status == 1) {
                                    $statusBadge = ['label' => translate('Prepayment Requested'), 'class' => 'badge-primary'];
                                } elseif ($order->prepayment_confirm_status == 2) {
                                    $statusBadge = ['label' => translate('Prepayment Accepted'), 'class' => 'badge-info'];
                                } elseif ($order->prepayment_confirm_status == 3) {
                                    $statusBadge = ['label' => translate('Prepayment Cancelled'), 'class' => 'badge-danger'];
                                } elseif ($order->request_preorder_status == 1) {
                                    $statusBadge = ['label' => translate('Preorder Requested'), 'class' => 'badge-secondary'];
                                } elseif ($order->request_preorder_status == 2) {
                                    $statusBadge = ['label' => translate('Preorder Request Accepted'), 'class' => 'badge-gray'];
                                } else {
                                    $statusBadge = ['label' => translate('Draft'), 'class' => 'badge-light'];
                                }
                            @endphp
                            <tr>
                                <td class="pl-0 fw-700">
                                    <a href="{{ route('customs.preorders.show', encrypt($order->id)) }}" class="text-reset hov-text-primary">
                                        {{ $order->order_code }}
                                    </a>
                                    @if ($order->is_viewed == 0)
                                        <span class="badge badge-inline badge-primary">{{ translate('New') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded overflow-hidden mr-2" style="width: 44px; height: 44px;">
                                            <img src="{{ uploaded_asset($order->preorder_product?->thumbnail) }}" class="w-100 h-100 img-fit" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        </div>
                                        <div>
                                            <div class="fw-600">{{ $order->preorder_product?->getTranslation('product_name') ?? translate('Preorder item') }}</div>
                                            <div class="fs-12 text-muted">{{ translate('Qty') }}: {{ $order->quantity }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $order->user?->name ?? translate('Customer not found') }}</div>
                                    <div class="fs-12 text-muted">{{ $order->user?->email ?? $order->user?->phone ?? '-' }}</div>
                                </td>
                                <td><span class="badge {{ $statusBadge['class'] }} badge-inline">{{ $statusBadge['label'] }}</span></td>
                                <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                                <td class="text-right pr-0">
                                    <a href="{{ route('customs.preorders.show', encrypt($order->id)) }}" class="btn btn-soft-danger btn-sm mb-1">
                                        {{ translate('View') }}
                                    </a>
                                    <a href="{{ route('customs.order_details', encrypt($order->id)) }}" class="btn btn-soft-secondary btn-sm">
                                        {{ translate('Original Flow') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="aiz-pagination py-3">
                    {{ $orders->links() }}
                </div>
            @else
                @include('frontend.user.partials.queue_empty_state', [
                    'badgeText' => translate('Customs Queue'),
                    'badgeClass' => 'badge-soft-danger',
                    'title' => translate('No customs preorders yet'),
                    'message' => translate('There are no preorders matching the current filters. New customs work will appear here when requests are created.'),
                    'primaryRoute' => route('customs.dashboard'),
                    'primaryLabel' => translate('Back to Dashboard'),
                    'secondaryRoute' => route('customs.preorders.index'),
                    'secondaryLabel' => translate('Clear Filters'),
                ])
            @endif
        </div>
    </div>
@endsection
