@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $statusBadge = ['label' => translate('Draft'), 'class' => 'badge-light'];
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
        }
    @endphp

    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="fs-20 fw-700 text-dark mb-1">{{ translate('Preorder') }} #{{ $order->order_code }}</h1>
                <p class="fs-14 text-secondary mb-0">{{ translate('Detailed preorder view for customs workflow.') }}</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('customs.preorders.index') }}" class="btn btn-soft-danger mr-2">{{ translate('Back to Queue') }}</a>
                <a href="{{ route('customs.dashboard') }}" class="btn btn-outline-danger">{{ translate('Dashboard') }}</a>
            </div>
        </div>
    </div>

    <div class="row gutters-16">
        <div class="col-lg-8 mb-4">
            <div class="card rounded-0 shadow-none border h-100">
                <div class="card-header border-bottom-0">
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Preorder Summary') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Customer') }}:</td>
                                    <td>{{ $order->user?->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Email') }}:</td>
                                    <td>{{ $order->user?->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Product') }}:</td>
                                    <td>{{ $order->preorder_product?->getTranslation('product_name') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Status') }}:</td>
                                    <td><span class="badge {{ $statusBadge['class'] }} badge-inline">{{ $statusBadge['label'] }}</span></td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Quantity') }}:</td>
                                    <td>{{ $order->quantity }}</td>
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
                                    <td class="w-50 fw-600">{{ translate('Order Code') }}:</td>
                                    <td>{{ $order->order_code }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Price') }}:</td>
                                    <td>{{ single_price($order->grand_total) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Prepayment') }}:</td>
                                    <td>{{ single_price($order->preorder_product?->is_prepayment ? $order->preorder_product->preorder_prepayment?->prepayment_amount : 0) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Seller') }}:</td>
                                    <td>{{ $order->preorder_product?->user?->shop?->name ?? env('APP_NAME') }}</td>
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
                    <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Address / Shortcuts') }}</h5>
                </div>
                <div class="card-body">
                    <p class="fs-12 text-secondary mb-1">{{ translate('Shipping Address') }}</p>
                    <div class="mb-3 text-muted">
                        {{ $order->address?->address ?? '-' }}
                        @if($order->address?->city) , {{ $order->address->city->name }} @endif
                        @if($order->address?->state) , {{ $order->address->state->name }} @endif
                        @if($order->address?->country) , {{ $order->address->country->name }} @endif
                    </div>

                    <p class="fs-12 text-secondary mb-1">{{ translate('Product Owner') }}</p>
                    <div class="mb-3 text-muted">
                        {{ $order->preorder_product?->user?->shop?->name ?? $order->product_owner ?? '-' }}
                    </div>

                    <a href="{{ route('customs.preorders.index', ['status' => 'requested']) }}" class="btn btn-soft-secondary btn-block mb-2">{{ translate('Requested Queue') }}</a>
                    <a href="{{ route('customs.preorders.index', ['status' => 'final_preorders']) }}" class="btn btn-soft-secondary btn-block mb-2">{{ translate('Final Preorders') }}</a>
                    <a href="{{ route('customs.order_details', encrypt($order->id)) }}" class="btn btn-soft-secondary btn-block mb-2">{{ translate('Open Original Flow') }}</a>
                    <a href="{{ route('customs.product_queries.index', ['status' => 'unanswered']) }}" class="btn btn-soft-danger btn-block">{{ translate('Open Queries') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-0 shadow-none border mb-4">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Workflow Status') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Request') }}</p>
                        <div class="fw-700">
                            @if($order->request_preorder_status == 1)
                                {{ translate('Requested') }}
                            @elseif($order->request_preorder_status == 2)
                                {{ translate('Accepted') }}
                            @else
                                {{ translate('Draft') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Prepayment') }}</p>
                        <div class="fw-700">
                            @if($order->prepayment_confirm_status == 1)
                                {{ translate('Requested') }}
                            @elseif($order->prepayment_confirm_status == 2)
                                {{ translate('Accepted') }}
                            @elseif($order->prepayment_confirm_status == 3)
                                {{ translate('Rejected') }}
                            @else
                                {{ translate('Pending') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Final Order') }}</p>
                        <div class="fw-700">
                            @if($order->final_order_status == 1)
                                {{ translate('Requested') }}
                            @elseif($order->final_order_status == 2)
                                {{ translate('Accepted') }}
                            @elseif($order->final_order_status == 3)
                                {{ translate('Rejected') }}
                            @else
                                {{ translate('Pending') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="p-3 rounded bg-light h-100">
                        <p class="fs-12 text-secondary mb-1">{{ translate('Delivery') }}</p>
                        <div class="fw-700">
                            @if($order->refund_status == 2)
                                {{ translate('Refunded') }}
                            @elseif($order->delivery_status == 2)
                                {{ translate('Delivered') }}
                            @elseif($order->shipping_status == 2)
                                {{ translate('In Shipping') }}
                            @else
                                {{ translate('Processing') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
