@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">


            <div class="fq-header-wrapper mt-3  card">
                <div class="container">
                    <div class="row">


                        <div class="nk-content nk-content-fluid">
                            <div class="container-xl wide-lg">
                                <div class="card-body">

                                    @if (count($type) < 1)
                                        <div class="alert alert-danger">
                                            <strong>Hello Boss!</strong> We currently dont accept {{ $card->name }} at the
                                            moment. Please
                                            check back later or try selling other type of card to us. Thank you for choosing
                                            {{ $general->site_name }}.
                                        </div>
                                    @else
                                        <div class="alert alert-success">
                                            <strong>Hello Boss!</strong> Please select the type of {{ $card->name }} You
                                            want to sell to us
                                            and select the card type <b>"Physical Card or Digital Card"</b> and upload the
                                            front and back image
                                            if it is a physical gift card or enter the card details if it is a digital gift
                                            card, then click on
                                            the confirm button to push your card to us.
                                            You account will be credited once card has been confirmed on our server. Thank
                                            you for choosing
                                            {{ $general->site_name }}.
                                        </div>
                                    @endif
                                    <div class="buysell  ">
                                        <div class="buysell-nav text-center">
                                            <div class="coin-icon" id="image"><img
                                                    src="{{ asset('assets/images/giftcards') }}/{{ $card->image }}"
                                                    width="50"></div>
                                        </div>
                                        <div class="buysell-title text-center">
                                            <h4 class="title">{{ $pageTitle }}</h4>
                                        </div>
                                        <div class="buysell-block">

                                            <form role="form" method="POST" action=""
                                                enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div class="buysell-field form-group">
                                                    <div class="form-label-group"><label class="form-label">Select Giftcard
                                                            Type</label></div>

                                                    <select @if (count($type) < 1) disabled @endif required
                                                        class="form-control form-control-lg" id="singles"
                                                        onchange="myFunction()" name="type">
                                                        <option data-cur="0" selected> Select Giftcard Type</option>
                                                        @foreach ($type as $data)
                                                            <option @if ($tradetype == 'sell') data-exrate="{{ $data->sell_rate }}" @else data-exrate="{{ $data->buy_rate }}" @endif
                                                                data-name="{{ $data->name }}"
                                                                data-type="{{ $data->id }}"
                                                                data-cur="{{ $data->currency }}"
                                                                value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="dropdown buysell-cc-dropdown">
                                                    <a href="#" class="buysell-cc-choosen dropdown-indicato">
                                                        <div class="coin-item coin-btc">
                                                            <div class="coin-info"><span class="coin-name"
                                                                    id="name">Please Select Card
                                                                    Type</span><br>
                                                                <span id="rate" class="coin-text"> No Card Type
                                                                    Selected</span>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>
                                        </div>


                                        <br>
                                        <div class="buysell-field form-group mb-4">
                                            <div class="form-label-group"><label class="form-label"
                                                    for="buysell-amount">Amount Of Card</label>
                                            </div>
                                            <div class="form-control-group ">
                                                <input type="number" @if (count($type) < 1) disabled @endif
                                                    id="usd" onkeyup="myFunction()"
                                                    class="form-control form-control-lg form-control-number" name="amount"
                                                    placeholder=" 0.00" />

                                            </div>
                                            <div class="form-note-group"><span class="buysell-min form-note-alt"><a
                                                        id="exrate"></a></span><span
                                                    class="buysell-rate form-note-alt"></span></div>
                                            <br>


                                            <div class="form-group mb-4">
                                                <div class="form-label-group"><label class="form-label">Select Type</label>
                                                </div>
                                                <select name="typeofcard" id="cardtype" class="form-control">
                                                    <option selected disabled>Select Option</option>
                                                    <option value="digital">Digital</option>
                                                    <option value="physical">Physical</option>
                                                </select>
                                                <input name="typerate" hidden id="typerate">
                                                <input name="typeid" hidden id="typeid">
                                                <input name="typecurrency" hidden id="typecur">
                                                <input name="card" hidden value="{{ $card->id }}">
                                            </div>

                                            @if ($tradetype == 'sell')
                                            <div id="physical">
                                                <div class="form-group mb-4">
                                                    <label class="form-label" for="default-06">Giftcard Front View
                                                        <small>(Physical)
                                                        </small></label></label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input name='front'
                                                                @if (count($type) < 1) disabled @endif
                                                                accept='image/*' type="file" multiple
                                                                class="form-control" id="customFile">
                                                         </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label class="form-label" for="default-067">Giftcard Back View
                                                        <small>(Physical)
                                                        </small></label>
                                                    <div class="form-control-wrap">
                                                        <div class="custom-file">
                                                            <input type="file"
                                                                @if (count($type) < 1) disabled @endif
                                                                name='back' accept='image/*' class="form-control"
                                                                id="customFile1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class='form-label-group' id="digital">
                                                    <label class='form-label' for='buysell-amount'>Enter Gift Card Code <small>(Digital)</small></label>
                                                    <input type='text'
                                                    @if (count($type) < 1) disabled @endif
                                                    placeholder='QWERTY*******'
                                                    class='form-control form-control-lg form-control-number'
                                                    name='code'>
                                                </div>
                                        <br>
                                        @endif


                                        <div class="buysell-field form-action"><button
                                                @if (count($type) < 1) disabled @endif type="submit"
                                                class="btn btn-lg  btn-outline btn-primary">Confirm</button></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>








    @push('script')
        <script>
            function myFunction() {
                var usd = $('#usd').val();
                var name = $("#singles option:selected").attr('data-name');
                var rate = $("#singles option:selected").attr('data-exrate');
                var cur = $("#singles option:selected").attr('data-cur');
                var type = $("#singles option:selected").attr('data-type');
                var rate2 = usd * rate;

                document.getElementById("exrate").innerHTML = "{{ $general->cur_sym }}" + rate2;
                document.getElementById("rate").innerHTML = "Rate: 1" + cur + " = {{ $general->cur_sym }}" + rate;
                document.getElementById("name").innerHTML = name;
                document.getElementById("typerate").value = rate;
                document.getElementById("typecur").value = cur;
                document.getElementById("typeid").value = type;

            };
        </script>
        <script>
            $(document).ready(function(){
                $("#digital").hide();
                $("#physical").hide();

                $('#cardtype').on('change', function() {
                  if ( this.value == 'physical')
                  {
                    $("#digital").hide();
                    $("#physical").show();
                  }
                  else
                  {
                    $("#physical").hide();
                    $("#digital").show();
                  }
                });
            });
        </script>


    @endpush




@stop

@push('breadcrumb-plugins')
    @if ($tradetype == 'sell')
        <a class="btn btn-sm btn-primary" href="{{ route('user.sellcardlog') }}"> <i class="ti ti-printer"></i>
            @lang('Giftcard Log')</a>
    @else
        <a class="btn btn-sm btn-primary" href="{{ route('user.buycardlog') }}"> <i class="ti ti-printer"></i>
            @lang('Giftcard Log')</a>
    @endif
@endpush
