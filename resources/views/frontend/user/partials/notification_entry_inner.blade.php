@php
    $showCheckbox = $showCheckbox ?? false;
    $showImage = $showImage ?? true;
    $showTimestamp = $showTimestamp ?? false;
    $messageClass = $messageClass ?? 'mb-1 text-truncate-2';
    $linkClass = $linkClass ?? '';
    $notificationRole = $notificationRole ?? 'customer';

    $notificationType = $notificationType ?? get_notification_type($notification->notification_type_id, 'id');
    $notifyContent = $notifyContent ?? $notificationType->getTranslation('default_text');
    $notificationShowDesign = $notificationShowDesign ?? get_setting('notification_show_type');
    $notifyImageDesign = $notifyImageDesign ?? '';

    if ($notifyImageDesign === '' && $notificationShowDesign == 'design_2') {
        $notifyImageDesign = 'rounded-1';
    } elseif ($notifyImageDesign === '' && $notificationShowDesign == 'design_3') {
        $notifyImageDesign = 'rounded-circle';
    }

    $isLinkable = $isLinkable ?? true;
    $notificationScopeLabel = $notificationScopeLabel ?? null;
    $timestamp = $timestamp ?? date('F j Y, g:i a', strtotime($notification->created_at));

    if ($notificationScopeLabel === null) {
        $rolePrefix = $notificationRole === 'logistics'
            ? 'Logistics'
            : ($notificationRole === 'customs' ? 'Customs' : 'Customer');

        if ($notification->type == 'App\\Notifications\\OrderNotification') {
            $notificationScopeLabel = translate($rolePrefix . ' Order Update');
        } elseif (in_array($notification->type, ['App\\Notifications\\PreorderNotification', 'App\\Notifications\\preorderNotification'])) {
            $notificationScopeLabel = translate($rolePrefix . ' Preorder Update');
        } else {
            $notificationScopeLabel = translate($rolePrefix . ' Notice');
        }
    }

    if (in_array($notification->type, ['App\\Notifications\\customNotification', 'App\\Notifications\\CustomNotification'])) {
        $externalLink = $notification->data['link'] ?? null;
        if ($externalLink != null) {
            $notifyContent = "<a href='" . $externalLink . "'>" . $notifyContent . "</a>";
            $isLinkable = false;
        }
    }

    if ($notification->type == 'App\\Notifications\\OrderNotification') {
        $orderCode = $notification->data['order_code'];
        $route = route('purchase_history.details', encrypt($notification->data['order_id']));
        $orderCode = "<a href='" . $route . "'>" . $orderCode . "</a>";
        $notifyContent = str_replace('[[order_code]]', $orderCode, $notifyContent);
    } elseif (in_array($notification->type, ['App\\Notifications\\PreorderNotification', 'App\\Notifications\\preorderNotification'])) {
        $orderCode = $notification->data['order_code'];
        $route = route('preorder.order_details', encrypt($notification->data['preorder_id']));
        $orderCode = "<a href='" . $route . "'>" . $orderCode . "</a>";
        $notifyContent = str_replace('[[order_code]]', $orderCode, $notifyContent);
    }
@endphp

@if ($showCheckbox)
    <div class="form-group d-inline-block">
        <label class="aiz-checkbox">
            <input type="checkbox" class="check-one" name="id[]" value="{{ $notification->id }}">
            <span class="aiz-square-check"></span>
        </label>
    </div>
@endif

@if ($showImage && $notificationShowDesign != 'only_text')
    <div class="size-35px mr-2">
        <img
            src="{{ uploaded_asset($notificationType->image) }}"
            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/notification.png') }}';"
            class="img-fit h-100 {{ $notifyImageDesign }}">
    </div>
@endif

<div>
    @if (!empty($notificationScopeLabel))
        <div class="fs-11 text-uppercase fw-700 text-muted mb-1">
            {{ $notificationScopeLabel }}
        </div>
    @endif

    <div class="{{ $messageClass }}">
        @if ($isLinkable)
            <a href="{{ route('notification.read-and-redirect', encrypt($notification->id)) }}" class="{{ $linkClass }}">
        @endif
        {!! $notifyContent !!}
        @if ($isLinkable)
            </a>
        @endif
    </div>

    @if ($showTimestamp)
        <small class="text-muted">{{ $timestamp }}</small>
    @endif
</div>
