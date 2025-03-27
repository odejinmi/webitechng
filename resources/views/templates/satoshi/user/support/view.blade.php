@extends($activeTemplate . 'layouts.' . $layout)

@if ($layout == 'frontend')
    @section('content')
    @elseif($layout == 'app')
    @section('panel')
    @endif
    <br>
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row row__bscreen">
                <div class="col-12">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">
                            <div class="crancy-chatbox">
                                <div class="row g-0">


                                    <div class="col-lg-12 col-md-12 col-12 crancy-chatsbox__two">
                                        <div class="crancy-chatbox__explore">
                                            <div class="crancy-chatbox__explore-head">
                                                <div class="crancy-chatbox__author">
                                                    
                                                    <div class="crancy-chatbox__heading">
                                                        <h4 class="crancy-chatbox__heading--title">
                                                            [@lang('Ticket ID:')#{{ $myTicket->ticket }}]
                                                        </h4>
                                                        <p class="crancy-chatbox__heading--text">
                                                            @php echo $myTicket->statusBadge; @endphp
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="crancy-chatbox__toggle">
                                                    @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                                                        <a href="{{ route('ticket.close', $myTicket->id) }}"><img
                                                                src="{{ asset($activeTemplateTrue . 'dashboard/img/close-icon.svg') }}" /></a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="crancy-chatbox__explore-body">
                                                @forelse ($messages as $message)
                                                    <!-- Incomming List -->
                                                    @if ($message->admin_id == 1)
                                                        <div class="crancy-chatbox__incoming">
                                                            <ul class="crancy-chatbox__incoming-list">

                                                                <!-- Single Incoming -->
                                                                <li>
                                                                    <div class="crancy-chatbox__chat">
                                                                         
                                                                        <div class="crancy-chatbox__main-content">
                                                                            <div class="crancy-chatbox__incoming-chat">
                                                                                <p class="crancy-chatbox__incoming-text">
                                                                                    {{ $message->message }}
                                                                                </p>
                                                                            </div>
                                                                            <p
                                                                                class="crancy-chatbox__time crancy-chatbox__time-two">
                                                                                {{ diffForHumans($message->created_at) }}
                                                                            </p>
                                                                        </div>
                                                                        @if ($message->attachments->count() > 0)
                                                                            @foreach ($message->attachments as $k => $image)
                                                                                <div
                                                                                    class="crancy-chatbox__incoming-chat crancy-chatbox__incoming-chat__file">
                                                                                    <p
                                                                                        class="crancy-chatbox__incoming-text">
                                                                                        <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}"
                                                                                            class="text-white crancy-flex-between">Download
                                                                                            <i
                                                                                                class="fas fa-download"></i></a>
                                                                                    </p>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                                <!-- End Single Incoming -->
                                                            </ul>
                                                        </div>
                                                        <!-- End Incomming List -->
                                                    @else
                                                        <!-- Outgoing List -->
                                                        <div class="crancy-chatbox__incoming crancy-chatbox__outgoing">
                                                            <ul class="crancy-chatbox__incoming-list">
                                                                <!-- Single Incoming -->
                                                                <li>
                                                                    <div class="crancy-chatbox__chat">
                                                                        <div class="crancy-chatbox__main-content">
                                                                            <div class="crancy-chatbox__incoming-chat">
                                                                                <p class="crancy-chatbox__incoming-text">
                                                                                    {{ $message->message }}
                                                                                </p>
                                                                            </div>
                                                                            @if ($message->attachments->count() > 0)
                                                                                @foreach ($message->attachments as $k => $image)
                                                                                    <div
                                                                                        class="crancy-chatbox__incoming-chat crancy-chatbox__incoming-chat__file">
                                                                                        <p
                                                                                            class="crancy-chatbox__incoming-text">
                                                                                            <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}"
                                                                                                class="text-white crancy-flex-between">Download
                                                                                                <i
                                                                                                    class="fas fa-download"></i></a>
                                                                                        </p>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <p
                                                                                class="crancy-chatbox__time crancy-chatbox__time-two">
                                                                                {{ diffForHumans($message->created_at) }}
                                                                            </p>
                                                                        </div> 
                                                                    </div>
                                                                </li>
                                                                <!-- End Single Incoming -->
                                                            </ul>
                                                        </div>
                                                        <!-- End Outgoing List -->
                                                    @endif
                                                @empty
                                                    {!! emptyData() !!}
                                                @endforelse

                                                @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                                                    <!-- New Message -->
                                                    <div class="crancy-chatbox__new-message">
                                                        <div class="crancy-chatbox__form">
                                                            <form method="post" class="crancy-chatbox__form-inner"
                                                                action="{{ route('ticket.reply', $myTicket->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <textarea name="message" class="form-control" value="" type="text" placeholder="Type a message..."></textarea>
                                                                <div class="crancy-chatbox__button">
                                                                    <div class="crancy-chatbox__button-inline">

                                                                        <div
                                                                            class="crancy-chatbox__button-inline__single crancy-chatbox__button-inline__link">
                                                                            <a href="#"><img
                                                                                    src="{{ asset($activeTemplateTrue . 'dashboard/img/photo-icon.svg') }}" /></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="crancy-chatbox__submit">
                                                                        <button class="btn btn-primary"
                                                                            type="submit">
                                                                            <img
                                                                                src="{{ asset($activeTemplateTrue . 'dashboard/img/send-icon.svg') }}" />Send
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                                <!-- End New Message -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Dashboard Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End crancy Dashboard -->
@stop
