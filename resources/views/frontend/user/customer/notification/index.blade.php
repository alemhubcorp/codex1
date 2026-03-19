@extends('frontend.layouts.user_panel')

@section('panel_content')

<div class="card rounded-0 shadow-none border">
    <div class="card-header row gutters-5">
        <div class="col">
            <h5 class="mb-0 fs-20 fw-700 text-dark">{{translate('Customer Notifications')}}</h5>
            <p class="fs-13 text-secondary mb-0">{{ translate('Customer-facing alerts for orders, preorders, and system updates.') }}</p>
        </div>
        <div class="col-md-3 text-right">
            <div class="btn-group mb-2">
                <button type="button" class="btn py-0" data-toggle="dropdown" aria-expanded="false">
                    <i class="las la-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button onclick="bulk_notification_delete()" class="dropdown-item">{{ translate('Delete Customer Notifications') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="fs-14 text-secondary">{{ translate('Review, select, and remove customer notifications from one inbox.') }}</div>
        </div>
        <div class="form-group">
            <div class="aiz-checkbox-inline">
                <label class="aiz-checkbox">
                    <input type="checkbox" class="check-all">
                    <span class="aiz-square-check"></span>{{ translate('Select All Customer Notifications') }}
                </label>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            @forelse($notifications as $notification)
                @php
                    $showNotification = true;
                    if (in_array($notification->type, ['App\\Notifications\\PreorderNotification', 'App\\Notifications\\preorderNotification']) && !addon_is_activated('preorder'))
                    {
                        $showNotification = false;
                    }
                @endphp
                @if($showNotification)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-0">
                        <div class="media text-inherit">
                            <div class="media-body">
                                @include('frontend.user.partials.notification_entry_inner', [
                                    'notificationRole' => 'customer',
                                    'showCheckbox' => true,
                                    'showTimestamp' => true,
                                    'linkClass' => 'text-reset',
                                ])
                            </div>
                        </div>
                    </li>
                @endif
            @empty
                <li class="list-group-item">
                        <div class="py-4 text-center fs-16">{{ translate('No customer notifications found') }}</div>
                </li>
            @endforelse
        </ul>
        <!-- Pagination -->
        <div class="aiz-pagination mt-3">
            {{ $notifications->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')

    <!-- Rrder details modal -->
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <!-- Payment modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            $('.check-one:checkbox').prop('checked', this.checked);
        });

        function bulk_notification_delete() {
            let notificationIds = [];
            $(".check-one[name='id[]']:checked").each(function() {
                notificationIds.push($(this).val());
            });
            $.post('{{ route('notifications.bulk_delete') }}', {_token:'{{ csrf_token() }}', notification_ids:notificationIds}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Customer notifications deleted successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
                location.reload();
            });
        }
    </script>
@endsection
