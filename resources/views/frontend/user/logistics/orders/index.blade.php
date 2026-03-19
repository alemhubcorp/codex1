@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $filterBase = request()->except(['status', 'page']);
        $statusTabs = [
            'all' => ['label' => translate('All'), 'class' => 'badge-soft-dark'],
            'pending' => ['label' => translate('Pending'), 'class' => 'badge-warning'],
            'in_transit' => ['label' => translate('In Transit'), 'class' => 'badge-info'],
            'delivered' => ['label' => translate('Delivered'), 'class' => 'badge-success'],
            'cancelled' => ['label' => translate('Cancelled'), 'class' => 'badge-danger'],
        ];
        $deliveryStatusMap = [
            'pending' => ['label' => translate('Pending'), 'class' => 'badge-warning'],
            'confirmed' => ['label' => translate('Confirmed'), 'class' => 'badge-info'],
            'picked_up' => ['label' => translate('Picked Up'), 'class' => 'badge-primary'],
            'on_the_way' => ['label' => translate('On The Way'), 'class' => 'badge-info'],
            'delivered' => ['label' => translate('Delivered'), 'class' => 'badge-success'],
            'cancelled' => ['label' => translate('Cancelled'), 'class' => 'badge-danger'],
        ];
        $paymentMap = [
            'paid' => ['label' => translate('Paid'), 'class' => 'badge-success'],
            'unpaid' => ['label' => translate('Unpaid'), 'class' => 'badge-warning'],
        ];
    @endphp

    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Logistics Orders') }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Filter operational orders by delivery and payment status.') }}</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('logistics.dashboard') }}" class="btn btn-soft-primary">{{ translate('Back to Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap">
                @foreach ($statusTabs as $key => $tab)
                    <a href="{{ route('logistics.orders.index', array_merge($filterBase, ['status' => $key])) }}"
                       class="badge badge-inline {{ $status == $key ? 'bg-soft-dark text-white' : 'preorder-border-dashed text-muted' }} mr-2 mb-2 p-3">
                        {{ $tab['label'] }} ({{ $counts[$key] ?? 0 }})
                    </a>
                @endforeach
            </div>

            <form action="{{ route('logistics.orders.index') }}" method="GET" class="mt-4">
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="row align-items-end">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ translate('Order code, customer, email') }}">
                    </div>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Date') }}</label>
                        <input type="text" name="date" value="{{ request('date') }}" class="aiz-date-range form-control" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                    </div>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <label class="fs-12 text-secondary mb-1">{{ translate('Payment Status') }}</label>
                        <select name="payment_status" class="form-control aiz-selectpicker" data-live-search="false">
                            <option value="">{{ translate('All') }}</option>
                            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>{{ translate('Paid') }}</option>
                            <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>{{ translate('Unpaid') }}</option>
                        </select>
                    </div>
                    <div class="col-lg-2 text-lg-right">
                        <button type="submit" class="btn btn-primary btn-block">{{ translate('Apply') }}</button>
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
                                <th class="pl-0">{{ translate('Order') }}</th>
                                <th>{{ translate('Customer') }}</th>
                                <th>{{ translate('Seller') }}</th>
                                <th>{{ translate('Delivery') }}</th>
                                <th>{{ translate('Payment') }}</th>
                                <th>{{ translate('Date') }}</th>
                                <th class="text-right pr-0">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-14">
                            @foreach ($orders as $order)
                            @php
                                $deliveryBadge = $deliveryStatusMap[$order->delivery_status] ?? ['label' => translate(ucfirst(str_replace('_', ' ', $order->delivery_status))), 'class' => 'badge-secondary'];
                                $paymentBadge = $paymentMap[$order->payment_status] ?? ['label' => translate(ucfirst($order->payment_status)), 'class' => 'badge-secondary'];
                            @endphp
                            <tr>
                                <td class="pl-0 fw-700">
                                    <a href="{{ route('logistics.orders.show', encrypt($order->id)) }}" class="text-reset hov-text-primary">
                                        {{ $order->code }}
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $order->user?->name ?? translate('Guest') }}</div>
                                    <div class="fs-12 text-muted">{{ $order->user?->email ?? $order->user?->phone ?? '-' }}</div>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $order->seller?->name ?? translate('Seller') }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $deliveryBadge['class'] }} badge-inline">{{ $deliveryBadge['label'] }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $paymentBadge['class'] }} badge-inline">{{ $paymentBadge['label'] }}</span>
                                </td>
                                <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                                <td class="text-right pr-0">
                                    <a href="{{ route('logistics.orders.show', encrypt($order->id)) }}" class="btn btn-soft-primary btn-sm">
                                        {{ translate('View') }}
                                    </a>
                                    <a href="{{ route('purchase_history.details', encrypt($order->id)) }}" class="btn btn-soft-secondary btn-sm">
                                        {{ translate('Customer View') }}
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
                    'badgeText' => translate('Logistics Queue'),
                    'badgeClass' => 'badge-soft-primary',
                    'title' => translate('No logistics orders yet'),
                    'message' => translate('There are no orders matching the current filters. When new logistics jobs arrive, they will appear here as a working queue.'),
                    'primaryRoute' => route('logistics.dashboard'),
                    'primaryLabel' => translate('Back to Dashboard'),
                    'secondaryRoute' => route('logistics.orders.index'),
                    'secondaryLabel' => translate('Clear Filters'),
                ])
            @endif
        </div>
    </div>
@endsection
