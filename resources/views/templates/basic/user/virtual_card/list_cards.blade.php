@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <!-- File export -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">{{ $pageTitle }}</h5>
                        </div>
                    </div>
<div class="col-sm-6" style="text-align: right;">
    <p style="margin-bottom: 5px;">Create a Card Holder first, then proceed to create a new card</p>
    <a href="{{url('/user/create/customer')}}" class="btn btn-info">Create CardHolder</a>
    <a href="{{url('/user/create/card')}}" class="btn btn-primary">Create New Card</a>
</div>

                </div>
                <div class="row" style="margin-top:10px">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th>@lang('Sr.No')</th>
                                        <th>@lang('Card Id')</th>
                                        <th>@lang('Card Type')</th>
                                        <th>@lang('Card Brand')</th>
                                        <th>@lang('Reference')</th>
                                        <th>@lang('View')</th>
                                        <th>@lang('Detail')</th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>

                                    @forelse($vcards as $key=>$row)
                                    <tr>
                                        <td>
                                            <strong>{{ $key+1 }}</strong>
                                        </td>
                                        <td>
                                            @isset($row->card_id){{$row->card_id}}@endisset
                                        </td>
                                        <td>
                                            @isset($row->card_type){{$row->card_type}}@endisset
                                        </td>
                                        <td>
                                            @isset($row->brand){{$row->brand}}@endisset
                                        </td>
                                        <td>
                                            @isset($row->reference){{$row->reference}}@endisset
                                        </td>
                                        <td>
                                            <a href="{{url('/user/view/card/'.$row->id)}}" class="btn btn-primary btn-sm btn-xs">View</a>
                                        </td>
                                        <td>
                                         <!--   <a href="{{url('/user/fund/card/'.$row->id)}}" class="btn btn-primary btn-sm btn-xs">Fund Card</a>-->
                                            <a href="{{url('/user/withdraw/card/'.$row->id)}}" class="btn btn-danger btn-sm btn-xs">Withdraw</a>

                                                <a href="{{url('/user/freez/card/'.$row->id)}}" class="btn btn-info btn-sm btn-xs">Freeze</a>

                                                <a href="{{url('/user/unfreez/card/'.$row->id)}}" class="btn btn-warning btn-sm btn-xs">UnFreeze</a>

                                        </td>
                                    </tr>
                                    @empty
                                        {!! emptyData2() !!}
                                    @endforelse
                                    <!-- end row -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($vcards->hasPages())
                        <div class="card-footer">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
