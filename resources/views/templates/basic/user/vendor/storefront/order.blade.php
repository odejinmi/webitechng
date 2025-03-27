@extends($activeTemplate . 'layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endpush
            <!-- File export -->
                      <!-- Row -->
          <div class="row">
            <!-- Column -->
            <div class="col-sm-12 col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5">@lang('Approved Purchase')</h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0">{{ (@$approved) }} </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-sm-12 col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-warning">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5">@lang('Pending Purchase')</h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0">{{ (@$pending) }}</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-12 col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-danger">
                      <i class="ti ti-credit-card fs-6"></i>
                    </div>
                    <div class="ms-3 align-self-center">
                      <h4 class="mb-0 fs-5">@lang('Declined Purchase')</h4>
                      <span class="text-muted"></span>
                    </div>
                    <div class="ms-auto align-self-center">
                      <h2 class="fs-7 mb-0">{{ (@$declined) }}</h2>
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
                                <th>@lang('Product')</th>
                                <th class="text-center">@lang('Date')</th>
                                <th class="text-center">@lang('Amount')</th>   
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            @forelse(@$order as $data)
                            @php
                            $product = App\Models\Product::whereId($data->product_id)->first();
                            @endphp
                                    <tr>
                                      <td> 
                                          <span class="">{{ __($data->trx) }}</span> 
                                      </td>
                                      <td> 
                                       {{$product->name}}<br>
                                       <small>{{$data->quantity}} QTY</small>
                                      </td>

                                        <td class="text-center">
                                            {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}
                                        </td> 
                                        <td class="text-center"> 
                                            <strong>{{ showAmount($data->price) }} {{ __($general->cur_text) }}</strong>                                        
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
                      @if ($order->hasPages())
                    <div class="card-footer">
                        {{ $order->links() }}
                    </div>
                    @endif
                    </div>
                  </div>
                  <!-- ---------------------
                              end File export
                          ---------------- -->
  
@endsection

@push('breadcrumb-plugins')
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
  
@endpush
