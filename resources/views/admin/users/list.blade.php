@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="card card-body">
            <div class="table-responsive">
              <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Balance</th>
                  <th>Date Joined</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <!-- start row -->
                  @forelse($users as $user)
                  <tr class="search-items">
                    
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                        <div class="ms-3">
                          <div class="user-meta-info">
                            <h6 class="user-name mb-0" data-name="{{ $user->fullname }}"> {{ $user->fullname }}</h6>
                            <span class="user-work fs-3" data-occupation="{{ $user->username }}"> {{ $user->username }}</span>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="usr-email-addr" data-email="{{ $user->email }}">{{ $user->email }}</span>
                    </td>
                    <td>
                      <span class="usr-location" data-mobile="{{ $user->mobile }}">{{ $user->mobile }}</span>
                    </td>
                    <td>
                      <span class="usr-ph-no" data-balance="{{ showAmount($user->balance) }}"> {{ $general->cur_sym }}{{ showAmount($user->balance) }}</span>
                    </td>
                    <td>
                      <span class="usr-ph-no" data-date=""> 
                        {{ showDateTime($user->created_at) }} <br>
                        {{ diffForHumans($user->created_at) }}    
                    </span>
                    </td>
                    <td>
                      <div class="action-btn">
                        <a href="{{ route('admin.users.detail', $user->id) }}" class="text-info edit">
                          <i class="ti ti-eye fs-5"></i>
                        </a> 
                      </div>
                    </td>
                  </tr>
                  <!-- end row -->
                  @empty
                  {!!emptyData()!!}
                  @endforelse
                </tbody>
              </table>
            </div>
            @if ($users->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($users) }}
            </div>
           @endif
          </div>
        </div>

@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Username / Email" />
@endpush
