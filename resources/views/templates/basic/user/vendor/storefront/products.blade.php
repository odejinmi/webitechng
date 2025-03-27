@extends(checkTemplate() . 'layouts.app')
@section('panel')
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="product-list">
                        <div class="card">
                          <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-9">
                                <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#create-modal" data-bs-whatever="@getbootstrap"> <i class="ti ti-printer"></i> @lang('Create Product')</a>

                            </div>
                            <div class="table-responsive border rounded">
                              <table class="table align-middle text-nowrap mb-0">
                                <thead>
                                  <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse(@$products as $data)
                                  <tr>
                                    <td>
                                      <div class="d-flex align-items-center">
                                        <img src="{{getImage(imagePath()['storefront_product']['path'].'/'. $data->image,imagePath()['storefront_product']['size'])}}" class="rounded-circle" alt="..." width="56"
                                          height="56">
                                        <div class="ms-3">
                                          <h6 class="fw-semibold mb-0 fs-4">{{$data->name}}</h6>
                                          <p class="mb-0">{{$data->trx}}</p>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <p class="mb-0">
                                        {{ showDateTime($data->created_at) }}
                                        <br>{{ diffForHumans($data->created_at) }}
                                      </p>
                                    </td>
                                    <td>
                                      <div class="d-flex align-items-center">
                                        <span class="@if($data->status == 1) text-bg-success @else text-bg-danger @endif p-1 rounded-circle"></span>
                                        <p class="mb-0 ms-2">@if($data->status == 1) Active @else Inactive @endif</p>
                                      </div>
                                    </td>
                                    <td>
                                      <h6 class="mb-0 fs-4">{{$general->cur_sym}} {{number_format($data->amount,2)}} {{$general->cur_text}} </h6>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#edit-modal{{$data->id}}" data-bs-whatever="@getbootstrap"> <i class="ti ti-edit"></i> @lang('Edit')</a>
                                    </td>
                                  </tr>
                                  <!-- /.EDIT MODAL -->
                                    <div class="modal fade" id="edit-modal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1">
                                               <b>{{$data->name}}</b>
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('user.storefront.product',$storefront->trx)}}" method="post"  enctype="multipart/form-data">
                                                @csrf
                                                <input name="product" value="{{$data->id}}" hidden />
                                                <div class="mb-3">
                                                <label for="name" class="control-label">Product Name:</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid  name @error('name') is-invalid @enderror" value="{{$data->name}}" name="name" />
                                                </div>
                                                <div class="mb-3">
                                                <label for="details" class="control-label">Product Description:</label>
                                                <textarea class="form-control form-control-lg form-control-solid  details @error('details') is-invalid @enderror" name="details">{{$data->details}}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                <label for="price" class="control-label">Product Price:</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid  price @error('price') is-invalid @enderror" value="{{$data->amount}}" class="form-control" id="price" name="price" />
                                                </div>
                                                <div class="mb-3">
                                                <label for="delivery" class="control-label">Product Delivery (Days):</label>
                                                <input type="number" class="form-control form-control-lg form-control-solid  delivery @error('delivery') is-invalid @enderror" value="{{$data->delivery}}" class="form-control" id="delivery" name="delivery" />
                                                </div>
                                                <div class="mb-3">
                                                <label for="logo" class="control-label">Product Image:</label>
                                                <input type="file" class="form-control form-control-lg form-control-solid  logo @error('logo') is-invalid @enderror" id="logo" name="logo" />
                                                </div>
                                                <div class="mb-3">
                                                <label for="image2" class="control-label">Product Image 2:</label>
                                                <input type="file" class="form-control form-control-lg form-control-solid  logo @error('image2') is-invalid @enderror" id="image2" name="image2" />
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="logo" class="control-label">Product Status:</label>
                                                    <div class="form-check form-switch form-check-success">
                                                        <input type="checkbox" class="form-check-input" @if ($data->status) checked @endif name="status" id="status" />
                                                    </div>
                                                    </div>
                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm bg-danger-subtle text-danger font-medium"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                    Update Product
                                                    </button>
                                                </div>

                                            </form>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                    <!-- /.EDIT MODAL -->
                                  @empty
                                    {!!emptyData2()!!}
                                  @endforelse

                                </tbody>
                              </table>

                            </div>
                            @if ($products->hasPages())
                            <div class="card-footer">
                                {{ $products->links() }}
                            </div>
                            @endif

                          </div>
                        </div>
                      </div>
                    <!--end::Heading-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>


        <!-- /.modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                  <h4 class="modal-title" id="exampleModalLabel1">
                    Add New Product
                  </h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  class="" novalidate="novalidate" action="{{route('user.storefront.products',$storefront->trx)}}" method="post"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="control-label">Product Name:</label>
                      <input type="text" class="form-control form-control-lg form-control-solid  name @error('name') is-invalid @enderror" id="name"  name="name" />
                    </div>
                    <div class="mb-3">
                      <label for="details" class="control-label">Product Description:</label>
                      <textarea class="form-control form-control-lg form-control-solid  details @error('details') is-invalid @enderror" id="details"  name="details"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="price" class="control-label">Product Price:</label>
                      <input type="text" class="form-control form-control-lg form-control-solid  price @error('name') is-invalid @enderror" class="form-control" id="price" name="price" />
                    </div>

                    <div class="mb-3">
                      <label for="delivery" class="control-label">Product Delivery (Days):</label>
                      <input type="number" class="form-control form-control-lg form-control-solid  delivery @error('delivery') is-invalid @enderror" value="{{old('delivery')}}" class="form-control" id="delivery" name="delivery" />
                      </div>
                    <div class="mb-3">
                      <label for="logo" class="control-label">Product Image:</label>
                      <input type="file" class="form-control form-control-lg form-control-solid  logo @error('logo') is-invalid @enderror" id="logo" name="logo" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm bg-danger-subtle text-danger font-medium"
                          data-bs-dismiss="modal">
                          Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                          Create Product
                        </button>
                      </div>

                  </form>
                </div>

              </div>
            </div>
          </div>
          <!-- /.modal -->
    @endsection

    @push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Name" />

    @endpush
    @push('script')
    @endpush
