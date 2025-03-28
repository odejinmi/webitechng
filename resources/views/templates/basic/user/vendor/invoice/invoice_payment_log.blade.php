@extends($activeTemplate . 'layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endpush
            <!-- File export -->
                      <!-- Row -->
          <div class="row">
            <!-- Column -->
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5">@lang('Invoice Amount')</h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0">{{ showAmount($invoice->amount) }} {{ __($general->cur_text) }}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-info">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5">@lang('Total Payment')</h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0">{{ showAmount($invoicetotal) }} {{ __($general->cur_text) }}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->



                <div class="col-12">

                  <!-- ---------------------
                              start File export
                          ---------------- -->
                  <div class="card">
                    <div class="card-body">
                      <div>
                        <label>@lang('Invoice Link')</label>
                        <div class="input-group">
                          <input type="text"id="referralURL"
                              value="{{ url('/') }}/user/invoice/pay/{{($invoice->trx)}}" readonly
                              class="form-control" placeholder="Right Side"
                              aria-describedby="basic-addon2">
                          <button onclick="myFunction()" class="btn btn-primary" type="button">
                            <a class="ti ti-link text-white"></a>
                          </button>
                      </div>
                      <hr>
                      <div class="mb-2">
                        <h5 class="mb-0">{{$pageTitle}}</h5>
                      </div>
                      <p class="card-subtitle mb-3">
                        @lang('A table showing all the ') {{$pageTitle}} @lang('on your account. You can export transaction record')
                      </p>
                      <div class="table-responsive">
                        <table
                          id="file_export"
                          class="table border table-striped table-bordered display text-nowrap"
                        >
                          <thead>
                            <!-- start row -->
                            <tr>
                                <th>@lang('TRX')</th>
                                <th>@lang('Payer')</th>
                                <th class="text-center">@lang('Date')</th>
                                <th class="text-center">@lang('Amount')</th>
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>

                            @forelse(@$log as $data)
                            @php
                            $deposit = App\Models\Deposit::whereTrx($data->trx)->first();
                            @endphp
                                    <tr>
                                      <td>
                                          <span class="">{{ __($data->trx) }}</span>
                                      </td>
                                      <td>
                                        <span class="text-primary">@lang('Name'): {{ __(explode("|", $deposit->val_1)[0]) }} {{ __(explode("|", $deposit->val_1)[1]) }}</span> <br>
                                        <span class="text-primary">@lang('Email'): {{ __(explode("|", $deposit->val_1)[2]) }}</span> <br>
                                        <span class="text-primary">@lang('Phone'): {{ __(explode("|", $deposit->val_1)[3]) }}</span>
                                      </td>

                                        <td class="text-center">
                                            {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}
                                        </td>
                                        <td class="text-center">
                                            <strong>{{ showAmount($data->amount) }} {{ __($general->cur_text) }}</strong>
                                        </td>
                                    </tr>
                                @empty
                                    {!!emptyData()!!}
                                @endforelse
                            <!-- end row -->
                            <!-- end row -->
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>@lang('TRX')</th>
                              <th>@lang('Payer')</th>
                              <th class="text-center">@lang('Date')</th>
                              <th class="text-center">@lang('Amount')</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      @if ($log->hasPages())
                    <div class="card-footer">
                        {{ $log->links() }}
                    </div>
                    @endif
                    </div>
                  </div>
                  <!-- ---------------------
                              end File export
                          ---------------- -->

@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('user.invoice.edit',$invoice->trx) }}" class="btn btn-primary btn-sm">@lang('Edit Invoice')</a>
@endpush
@push('script')
<script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')}}"></script>
 <script>
  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Invoice Link Copied');

        }
 </script>
@endpush
