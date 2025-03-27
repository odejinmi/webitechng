@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row g-3 g-xl-6">
        <div class="col-xxl-12">
            <div class="vstack gap-3 gap-xl-6">

                <div class="card">
                    <div class="card-body pb-0">
                        <div class="mb-2 d-flex align-items-center">
                            <h5>Terminal List</h5>
                            <div class="ms-auto text-end">
                                <button class="btn btn-sm btn-neutral"  data-bs-toggle="modal" data-bs-target="#PosModal"><i
                                        class="bi bi-plus me-2 d-none d-sm-inline-block"></i>Request Terminal</button>
                            </div>
                        </div>
                        <div class="hstack gap-2 mt-4 mb-6">

                        </div>
                        <div class="surtitle mb-2">My POS Terminals</div>
                        <div class="vstack gap-2 mx-n3">
                            @forelse($terminals as $data)
                                <div
                                    class="position-relative d-flex align-items-center p-3 rounded-3 bg-body-secondary-hover">
                                    <div class="flex-none"><img src="{{ url('/') }}/assets/images/provider/pos.png"
                                            class="w-rem-16 w-md-20 rounded" alt="...">
                                    </div>
                                    <div class="ms-3 ms-md-4 flex-fill">
                                        <div class="stretched-link text-limit text-sm text-heading fw-semibold"
                                            role="button" data-bs-toggle="offcanvas" data-bs-target="#cardDetailsOffcanvas{{$data->id}}"
                                            aria-controls="cardDetailsOffcanvas{{$data->id}}">Serial Number: {{$data->terminal_id ?? 'N/A'}}</div>
                                        
                                    </div>
                                    <div class="d-none d-sm-block ms-auto text-end">
                                        <span class="badge bg-body-secondary @if($data->status == 1)text-success @else text-danger @endif"> @if($data->status == 1) Active @else Inactive @endif</span>
                                        <div class="d-none d-sm-block text-xs text-muted mt-2">{{ showDate($data->created_at) }}</div>
                                    </div>
                                </div>
                            @empty
                                {!! emptyData2() !!}
                            @endforelse

                        </div>
                         
                    </div>
                </div>
            </div>
        </div>


    </div>


<div class="modal fade" id="PosModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content overflow-hidden">
            <div class="modal-header pb-0 border-0">
                <h1 class="modal-title h4" id="topUpModalLabel">Request POS Terminal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body undefined">
                    
<form class="vstack gap-8" action="{{route('user.api.pos.request')}}" method="post" enctype="multipart/form-data">
              @csrf
                    <div class="alert alert-info">
                        Please note, a sum of {{$general->cur_sym}} {{number_format(env('POSREQUEST'),2)}} will be debited from  your NGN wallet to faciliate this request
                    </div>
                    <div><label class="form-label">Enter Transaction Pin</label>
                        <div class="d-flex justify-content-between p-4 bg-body-tertiary border rounded">
                            <input type="password" name="pin" class="form-control form-control-flush text-xl fw-bold w-rem-40"
                                placeholder="****">
                            <div class="dropdown">
                                <button
                                    class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2"
                                    data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ url('/') }}/assets/images/country/ngn.png"
                                        class="w-rem-6 h-rem-6 rounded-circle" alt="..."> <span>NGN</span> <i
                                        class="bi bi-chevron-down text-xs me-1"></i></button>
                                
                            </div>
                        </div>
                    </div>

                    <div><label class="form-label">Enter Delivery Address</label>
                        <div class="d-flex justify-content-between p-4 bg-body-tertiary border rounded">
                            <input type="text" name="address" class="form-control form-control-flush text-xl fw-bold w-rem-40"
                                placeholder="12, Lekki Phase 1, Lagos, Nigeria"> 
                        </div>
                    </div>

                    <div> 
                        <div class="vstack gap-2">
                             
                             
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Request</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




{{--CANVAS--}}
 @foreach($terminals as $data)
 @php
 $postrx = App\Models\Transaction::whereUserId(Auth::user()->id)->where('val_2','!=',null)->where('val_2',$data->terminal_id)->sum('amount');
 @endphp
<div class="offcanvas rounded-sm-4 offcanvas-end overflow-hidden m-sm-4" tabindex="-1"
                        id="cardDetailsOffcanvas{{$data->id}}" aria-labelledby="cardDetailsOffcanvasLabel{{$data->id}}">
                        <div class="offcanvas-header rounded-top-4 bg-light">
                            <h5 class="offcanvas-title" id="cardDetailsOffcanvasLabel{{$data->id}}">Your Terminal Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#cardDetailsOffcanvas{{$data->id}}" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-flex flex-column gap-6">
                            <div class="card border-0 gradient-bottom-right start-purple middle-yellow end-cyan">
                                <div class="position-relative p-6 overlap-10">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col"><img src="{{ url('/') }}/assets/images/provider/pos.png" class="h-rem-6" alt="...">
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-body-secondary @if($data->status == 1)text-success @else text-danger @endif"> @if($data->status == 1) Active @else Inactive @endif</span>
                                        </div>
                                    </div>
                                    <div class="mt-8 mb-6">
                                        <span class="surtitle text-dark text-opacity-60">Terminal ID</span>
                                        <div class="d-flex gap-4 h3 fw-bold">
                                            <div>{{$data->terminal_id}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><span class="surtitle text-dark text-opacity-60">Agent Name</span>
                                            <span class="d-block h6">{{@$data->user->fullname}}</span></div>
                                        <div class="col">
                                            <span class="surtitle text-dark text-opacity-60">Agent Address</span>
                                            <span class="d-block h6">{{$data->address}}</span></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">Total Transactions</h5>
                                    <div class="vstack gap-3">
                                        <div class="surtitle text-xs text-muted text-opacity-75">Total transaction Value
                                        </div>
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                aria-label="Basic example" style="width:20%" aria-valuenow="20"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between text-xs">
                                            <span>{{$general->cur_sym}}{{number_format($postrx,2)}}</span> <span></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="d-flex">
                                    <div class="flex-none w-rem-10"><i class="bi bi-folder-plus text-lg text-muted"></i>
                                    </div>
                                    <div class="me-10"><a href="#" class="d-block h5">Security</a>
                                        <p class="mt-1 text-sm text-muted">Select the permissions you want to add to all
                                            the projects in this account.</p>
                                    </div>
                                </div>
                                <div class="vstack gap-3 mt-4 ms-10">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-sm fw-semibold">Online transactions</h6>
                                        <div class="form-check form-switch ms-auto"><input class="form-check-input me-n2" type="checkbox" name="switch1" id="switchView1" checked="checked">
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-semibold">Swipe payments</h6>
                                        <div class="form-check form-switch ms-auto"><input class="form-check-input me-n2" type="checkbox" name="switch1" id="switchEdit1" checked="checked">
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="d-flex align-items-center">
                                        <h6 class="fw-semibold">Contactless payments</h6>
                                        <div class="form-check form-switch ms-auto"><input class="form-check-input me-n2" type="checkbox" name="switch1" id="switchPublish1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('user.api.pos.transactions',encrypt($data->terminal_id))}}" type="button" class="btn btn-primary bg-primary-hover w-100 mt-auto">View Transaction</a>
                        </div>
                    </div>
                    @endforeach
@endsection

@push('script')
@endpush
