@extends($activeTemplate . 'layouts.app')
@section('panel')
    <!-- crancy Dashboard -->
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row row__bscreen">
                <div class="col-xxl-12 col-12">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">

                            <div class="col-12 mg-top-40">
                                <div class="bg-white crancy-bradius">
                                    <div class="row g-0">
                                        <div class="col-lg-12 col-12">
                                            <div class="crancy-support-form pd-right-60 pd-btm-30">
                                                <form action="{{ route('ticket.store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row mg-top-5">

                                                        <input class="crancy__item-input" type="text"
                                                            value="{{ Auth::user()->firstname }}" hidden
                                                            required="required" />
                                                        <input class="crancy__item-input" type="text" name="name"
                                                            value="{{ Auth::user()->lastname }}" hidden
                                                            required="required" />
                                                        <input name="priority" value="3" hidden>
                                                        <input class="crancy__item-input" type="text"
                                                            value="{{ Auth::user()->lastname }}" hidden
                                                            required="required" />

                                                        <input class="crancy__item-input" type="text" name="email"
                                                            value="{{ Auth::user()->email }}" hidden required="required" />

                                                        <div class="col-12 mg-top-30">
                                                            <h4>Support issues</h4>
                                                        </div>
                                                        <div class="col-12 mg-top-25">
                                                            <div class="crancy__item-form--group">
                                                                <label
                                                                    class="crancy__item-label crancy__item-label-product">Title</label>
                                                                <input class="form-control" type="text"
                                                                    name="subject"
                                                                    placeholder="My previous transaction declined"
                                                                    required="required" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mg-top-25">
                                                            <div class="crancy__item-form--group">
                                                                <label
                                                                    class="crancy__item-label crancy__item-label-product">Descriptions</label>
                                                                <textarea placeholder="Description" id="ckdesc1" class="form-control" name="message" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="crancy-product-card__img mg-top-form-20">
                                                            <div
                                                                class="crancy-product-card__upload crancy-product-card__img--popup crancy-product-card__upload--border">
                                                                <input type="file" class="form-control" name="attachments[]" onchange="readURL(this);"
                                                                    id="inputAttachments" autocomplete="off" />
                                                                <label class="crancy-image-video-upload__label"
                                                                    for="inputAttachments">
                                                                    <img id="blah" width="50" src="{{asset( $activeTemplateTrue . 'dashboard/img/upload-file2.svg') }}" />
                                                                    <h4 class="crancy-image-video-upload__title">
                                                                        <span class="crancy-primary-color">Select a file to
                                                                            upload
                                                                        </span>
                                                                    </h4>
                                                                </label>
                                                            </div>




                                                        </div>
                                                        <div class="col-12 crancy-flex-end mg-top-40">
                                                            <button class="btn btn-primary" type="submit">
                                                                Submit Ticket
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @push('script')
                                        <script>
                                           function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                const reader = new FileReader();
                                                reader.onload = function (e) {
                                                document.querySelector('#blah').setAttribute('src',e.target.result )
                                                };
                                                reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        </script>
                                        @endpush

                                        <div class="col-lg-12 col-12 mt-4">
                                            <div class="support-ticket-sidebar mg-top-30">
                                                <div class="list-group list-group crancy-tab_inbox" id="list-tab"
                                                    role="tablist">
                                                    <a class="list-group-item active" data-bs-toggle="list"
                                                        href="#crancy-inbox-1" role="tab">Your inbox</a>

                                                </div>
                                                <div class="tab-content mg-top-20" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="crancy-inbox-1"
                                                        role="tabpanel" aria-labelledby="crancy-inbox-1">
                                                        <!-- Inbox Tab Single -->
                                                        <div style="overflow-y: auto; height: 500px;"
                                                            class="crancy-inbox-tab crancy-border-1px crancy-bradius">
                                                            <div class="crancy-sidebar__heading crancy-flex-wrap">
                                                                <h4 class="crancy-sidebar__title">
                                                                    Recent Support
                                                                </h4>
                                                                <a href="#" class="crancy-sidebar__toggles"><img
                                                                        src="{{asset( $activeTemplateTrue . 'dashboard/img/toggle-icon.svg') }}" /></a>
                                                            </div>
                                                            <div class="tab-pane fade show active" id="notify-one"
                                                                role="tabpanel">
                                                                <!-- End All Notification Heading -->
                                                                <ul
                                                                    class="crancy-paymentm__list crancy-paymentm__list--notify pt-0">
                                                                    @forelse($supports as $support)
                                                                        <li
                                                                            class="crancy-paymentm__single crancy-paymentm__single--notify">
                                                                            <div class="crancy-paymentm__name">
                                                                                <div
                                                                                    class="crancy-paymentm__icon crancy-paymentm__icon--notify ntfmax__bgc--1">
                                                                                    <img
                                                                                        src="{{asset( $activeTemplateTrue . 'dashboard/img/anotify1.svg') }}" />
                                                                                </div>
                                                                                <div class="crancy-paymentm__content">
                                                                                    <h4
                                                                                        class="crancy-paymentm__title crancy-paymentm__title--notify">
                                                                                        {{ __($support->subject) }}
                                                                                        <b>#{{ $support->ticket }}</b>
                                                                                    </h4>
                                                                                    <p
                                                                                        class="crancy-paymentm__text crancy-paymentm__text--notify">
                                                                                        {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="crancy-toggle-arrow">
                                                                                <a
                                                                                    href="{{ route('ticket.view', $support->ticket) }}"><img
                                                                                        src="{{asset( $activeTemplateTrue . 'dashboard/img/toggle-icon-4.svg') }}" /></a>
                                                                            </div>
                                                                        </li>
                                                                    @empty
                                                                        {!! emptyData2() !!}
                                                                    @endforelse

                                                                </ul>
                                                            </div>
                                                            @if ($supports->hasPages())
                                                                <div class="card-footer py-4">
                                                                    @php echo paginateLinks($supports) @endphp
                                                                </div>
                                                            @endif


                                                        </div>
                                                        <!-- End Inbox Tab Single -->
                                                    </div>
                                                </div>
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
@endsection

@push('script')
    <script>
        $('#load-more').click(function() {
            $.ajax({
                url: "{{ route('ticket.index') }}",
                method: 'GET',
                data: {
                    page: {{ $supports->currentPage() + 1 }}
                },
                success: function(data) {
                    $('#records').append(data);
                }
            });
        });
    </script>
@endpush
