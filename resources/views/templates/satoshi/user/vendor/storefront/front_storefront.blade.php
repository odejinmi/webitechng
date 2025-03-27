@extends($activeTemplate . 'layouts.store')
@section('panel')
    <!-- content @s
        -->

        <div class="row">
            <div class="col-12"> 

        <!--begin::Container-->
        <div class="body-wrapper">
            <div class="container-fluid">
                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">{{$pageTitle}}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none" href="#">Home</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Shop</li>
                                    </ol>
                                    <img src="{{getImage(imagePath()['storefront_logo']['path'].'/'. $storefront->logo,imagePath()['storefront_logo']['size'])}}" alt="" class="img-fluid" width="40" />
                                </nav>
                            </div>
                            <div class="col-3">
                                <div class="text-center mb-n5">
                                    <img src="{{getImage(imagePath()['storefront_header']['path'].'/'. $storefront->header,imagePath()['storefront_header']['size'])}}" alt="" class="img-fluid mb-n4" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card position-relative overflow-hidden">
                    <div class="shop-part d-flex w-100">
                         
                        <div class="card-body p-4 pb-0">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                                <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Products</h5>
                                <x-search-form placeholder="Search by Name" />

                            </div>
                            <div class="row">
                                @forelse($products as $data)
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card hover-img overflow-hidden rounded-2">
                                        <div class="position-relative">
                                            <a href="{{route('storefront.product',$data->trx)}}"><img
                                                    src="{{getImage(imagePath()['storefront_product']['path'].'/'. $data->image,imagePath()['storefront_product']['size'])}}" class="card-img-top rounded-0"
                                                    alt="..."></a>
                                            <a href="{{route('storefront.product',$data->trx)}}"
                                                class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>
                                        </div>
                                        <div class="card-body pt-3 p-4">
                                            <h6 class="fw-semibold fs-4">{{$data->name}}</h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-semibold fs-4 mb-0">{{$general->cur_sym}}{{number_format($data->amount,2)}} 
                                                    <span class="ms-2 fw-normal text-muted fs-3"><del>{{$general->cur_sym}}{{number_format($data->amount + 10,2)}}</del></span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    {!!emptyData2()!!}
                                @endforelse 
                                 
                            </div>
                            @if ($products->hasPages())
                            <div class="card-footer">
                                {{ $products->links() }}
                            </div>
                            @endif
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <!--end::Container-->
    @endsection
