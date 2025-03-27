@extends(checkTemplate() . 'layouts.' . $layout)

@if ($layout == 'frontend')
    @section('content')
    @elseif($layout == 'app')
    @section('panel')
    @endif

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body ">

                    <!--begin::Messenger-->
                    <div class="card w-100 border-0 rounded-0" id="kt_drawer_chat_messenger">
                        <!--begin::Card header-->
                        <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                            <!--begin::Title-->
                            <div class="card-title">
                                <!--begin::User-->
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <a href="#"
                                        class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">[@lang('Ticket ID:')#{{ $myTicket->ticket }}] </a>
                                        {{ $myTicket->subject }}
                                    <!--begin::Info-->
                                    <div class="mb-0 lh-1">
                                        @php echo $myTicket->statusBadge; @endphp
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->

                                <!--begin::Menu-->
                                @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                                    <button data-question="@lang('Are you sure to close this ticket?')" data-action="{{ route('ticket.close', $myTicket->id) }}" class="confirmationBtn btn btn-sm btn-icon btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ti ti-trash fs-2"></i>                </button>
                                @endif

                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body" id="kt_drawer_chat_messenger_body">
                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true"
                                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                                data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer"
                                data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">


                                @forelse ($messages as $message)
                                @if ($message->admin_id == 1)
                                <!--begin::Message(in)-->
                                <div class="d-flex justify-content-start mb-10 ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-start">
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Avatar-->
                                            <div class="symbol  symbol-35px symbol-circle "><img alt="Pic"
                                                    src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" /></div><!--end::Avatar-->
                                            <!--begin::Details-->
                                            <div class="ms-3">
                                                <a href="#"
                                                    class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">@lang('Admin')</a>
                                                <span class="text-muted fs-7 mb-1">{{ getImage(getFilePath('logoIcon') . '/logo.png') }}</span>
                                            </div>
                                            <!--end::Details-->

                                        </div>
                                        <!--end::User-->

                                        <!--begin::Text-->
                                        <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start"
                                            data-kt-element="message-text">
                                            {{ $message->message }} </div>
                                        <!--end::Text-->
                                        @if ($message->attachments->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}"
                                                    class="me-2"><i class="fa fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Message(in)-->
                                @else
                                <!--begin::Message(out)-->
                                <div class="d-flex justify-content-end mb-10 ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column align-items-end">
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Details-->
                                            <div class="me-3">
                                                <span class="text-muted fs-7 mb-1">{{ diffForHumans($message->created_at) }}</span>
                                            </div>
                                            <!--end::Details-->

                                            <!--begin::Avatar-->
                                            <div class="symbol  symbol-35px symbol-circle "><img alt="Pic"
                                                    src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}" /></div><!--end::Avatar-->
                                        </div>
                                        <!--end::User-->

                                        <!--begin::Text-->
                                        <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end"
                                            data-kt-element="message-text">
                                            {{ $message->message }} </div>
                                        <!--end::Text-->
                                        @if ($message->attachments->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                                    class="me-2"><i class="fa fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Message(out)-->
                                @endif
                                @empty
                                {!!emptyData()!!}
                                @endforelse

                                <!--begin::Message(in)-->

                            </div>
                            <!--end::Messages-->
                            @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                            <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                            <!--begin::Card footer-->
                            <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                                <!--begin::Input-->
                                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"  name="message" placeholder="Type a message">

                                </textarea>
                                <!--end::Input-->

                                <div class="col-12 mb-2">
                                    <div id="fileUploadsContainer"></div>
                                </div>
                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        <button class="addFile btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Upload File">
                                            <i class="ti ti-upload fs-3"></i>
                                        </button>

                                    </div>
                                    <!--end::Actions-->

                                    <!--begin::Send-->
                                    <button class="btn btn-primary"  type="submit" name="replayTicket" value="1" data-kt-element="send">@lang('Send')</button>
                                    <!--end::Send-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card footer-->
                            </form>
                            @endif

                            <x-confirmation-modal />
                        @endsection

                        @push('script')
                            <script>
                                (function($) {
                                    "use strict";
                                    var fileAdded = 0;
                                    $('.addFile').on('click', function() {
                                        if (fileAdded >= 4) {
                                            notify('error', 'You\'ve added maximum number of file');
                                            return false;
                                        }
                                        fileAdded++;
                                        $("#fileUploadsContainer").append(`
                    <div class="input-group flex-nowrap my-3">
                        <input type="file" name="attachments[]" class="{{ auth()->user() ? 'form-control form--control' : 'form--control' }}" required />
                        <button type="submit" class="input-group-text btn btn--danger remove-btn"><i class="ti ti-trash"></i></button>
                    </div>
                `)
                                    });
                                    $(document).on('click', '.remove-btn', function() {
                                        fileAdded--;
                                        $(this).closest('.input-group').remove();
                                    });
                                })(jQuery);
                            </script>
                        @endpush

                        @push('style')
                            <style>
                                .card-body-color {
                                    background-color: #f7f7f7 !important;

                                }
                            </style>
                        @endpush
