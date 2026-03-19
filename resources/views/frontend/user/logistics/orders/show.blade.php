@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $deliveryMap = [
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
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Order') }} #{{ $order->code }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Operational detail view for logistics users.') }}</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('logistics.orders.index') }}" class="btn btn-soft-primary mr-2">{{ translate('Back to Queue') }}</a>
                <a href="{{ route('logistics.dashboard') }}" class="btn btn-outline-primary">{{ translate('Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-lg-8 mb-4">
            <div class="card rounded-0 shadow-none border h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Order Summary') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Customer') }}:</td>
                                    <td>{{ $order->user?->name ?? translate('Guest') }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Email') }}:</td>
                                    <td>{{ $order->user?->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Seller') }}:</td>
                                    <td>{{ $order->seller?->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Delivery Status') }}:</td>
                                    <td>
                                        @php $deliveryBadge = $deliveryMap[$order->delivery_status] ?? ['label' => translate(ucfirst(str_replace('_', ' ', $order->delivery_status))), 'class' => 'badge-secondary']; @endphp
                                        <span class="badge {{ $deliveryBadge['class'] }} badge-inline">{{ $deliveryBadge['label'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Payment Status') }}:</td>
                                    <td>
                                        @php $paymentBadge = $paymentMap[$order->payment_status] ?? ['label' => translate(ucfirst($order->payment_status)), 'class' => 'badge-secondary']; @endphp
                                        <span class="badge {{ $paymentBadge['class'] }} badge-inline">{{ $paymentBadge['label'] }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Date') }}:</td>
                                    <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping Type') }}:</td>
                                    <td>{{ translate(ucwords(str_replace('_', ' ', $order->shipping_type ?? 'home_delivery'))) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Tracking Code') }}:</td>
                                    <td>{{ $order->tracking_code ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Grand Total') }}:</td>
                                    <td class="fw-700">{{ single_price($order->grand_total) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Additional Info') }}:</td>
                                    <td>{{ $order->additional_info ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card rounded-0 shadow-none border h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Route Overview') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Shipping Address') }}</p>
                        @php $shipping = json_decode($order->shipping_address ?? '{}'); @endphp
                        <div class="fw-600">{{ $shipping->name ?? ($order->user?->name ?? '-') }}</div>
                        <div class="text-muted">
                            {{ $shipping->address ?? '-' }}
                            @if(!empty($shipping->city)) , {{ $shipping->city }} @endif
                            @if(!empty($shipping->state)) , {{ $shipping->state }} @endif
                            @if(!empty($shipping->country)) , {{ $shipping->country }} @endif
                        </div>
                    </div>
                    @if (json_decode($order->billing_address ?? '') != null)
                        @php $billing = json_decode($order->billing_address); @endphp
                        <div class="mb-3">
                            <p class="fs-12 text-secondary mb-1">{{ translate('Billing Address') }}</p>
                            <div class="text-muted">
                                {{ $billing->address ?? '-' }}
                                @if(!empty($billing->city)) , {{ $billing->city }} @endif
                                @if(!empty($billing->state)) , {{ $billing->state }} @endif
                                @if(!empty($billing->country)) , {{ $billing->country }} @endif
                            </div>
                        </div>
                    @endif
                    <a href="{{ route('logistics.conversations.index') }}" class="btn btn-soft-primary btn-block mb-2">{{ translate('Open Messages') }}</a>
                    <a href="{{ route('logistics.orders.index', ['status' => 'pending']) }}" class="btn btn-soft-warning btn-block mb-2">{{ translate('Pending Queue') }}</a>
                    <a href="{{ route('logistics.orders.index', ['status' => 'in_transit']) }}" class="btn btn-soft-info btn-block">{{ translate('In Transit Queue') }}</a>
                    <a href="{{ route('purchase_history.details', encrypt($order->id)) }}" class="btn btn-soft-secondary btn-block mt-2">{{ translate('Open Customer View') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border mb-4">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Order Items') }}</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table aiz-table mb-0">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">#</th>
                        <th>{{ translate('Product') }}</th>
                        <th>{{ translate('Variation') }}</th>
                        <th>{{ translate('Quantity') }}</th>
                        <th>{{ translate('Delivery Type') }}</th>
                        <th class="text-right pr-0">{{ translate('Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order->orderDetails as $key => $orderDetail)
                        <tr>
                            <td class="pl-0">{{ sprintf('%02d', $key + 1) }}</td>
                            <td>
                                @if ($orderDetail->product != null && $orderDetail->product->slug != null)
                                    <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset hov-text-primary">
                                        {{ $orderDetail->product->getTranslation('name') }}
                                    </a>
                                @else
                                    <strong>{{ translate('Product Unavailable') }}</strong>
                                @endif
                            </td>
                            <td>{{ $orderDetail->variation ?? '-' }}</td>
                            <td>{{ $orderDetail->quantity }}</td>
                            <td>
                                @if ($order->shipping_type == 'pickup_point' && $order->pickup_point != null)
                                    {{ $order->pickup_point->name }}
                                @elseif ($order->shipping_type == 'carrier' && $order->carrier != null)
                                    {{ $order->carrier->name }}
                                @else
                                    {{ translate('Home Delivery') }}
                                @endif
                            </td>
                            <td class="text-right pr-0 fw-700">{{ single_price($orderDetail->price) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">{{ translate('No order items found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Totals') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Subtotal') }}</p>
                        <div class="fs-18 fw-700">{{ single_price($order->orderDetails->sum('price')) }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Shipping') }}</p>
                        <div class="fs-18 fw-700">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Tax') }}</p>
                        <div class="fs-18 fw-700">{{ single_price($order->orderDetails->sum('tax')) }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Grand Total') }}</p>
                        <div class="fs-18 fw-700">{{ single_price($order->grand_total) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
