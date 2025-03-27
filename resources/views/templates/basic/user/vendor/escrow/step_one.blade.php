@extends($activeTemplate . 'layouts.app')
@section('panel')

 <!-- content @s
-->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">


                <!--begin::Form-->
                  
                @include($activeTemplate . 'partials.escrow_form')

                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->

     
@endsection

@push('style')
    <style>
        .btn--base {
            width: 100%;
        }

        @media(max-width:480px) {
            .custom--card .card-body {
                padding: .8rem;
            }
        }

        @media(max-width:360px) {
            .custom--card .card-body {
                padding: .5rem;
            }

            .input-group-text {
                font-size: 12px;
            }
        }
    </style>
@endpush
