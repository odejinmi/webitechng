<div class="d-none d-lg-flex py-3">
                <div class="flex-none">
                    <div class="input-group input-group-sm input-group-inline w-rem-64 rounded-pill">
                        <span class="input-group-text rounded-start-pill"><i class="bi bi-search me-2"></i> </span><input type="search" class="form-control ps-0 rounded-end-pill" placeholder="Search" aria-label="Search">
                    </div>
                </div>
                <div class="d-lg-none d-xxl-flex align-items-center gap-4 px-4 scrollable-x">
                    <div class="d-flex gap-2 text-xs"><span class="text-heading fw-semibold">Cryptos:</span>
                        <span class="text-muted">21,713</span></div>
                    <div class="d-flex gap-2 text-xs"><span class="text-heading fw-semibold">Market Cap:</span>
                        <span class="text-muted">$871,322,862,585</span></div>
                    <div class="d-flex gap-2 text-xs"><span class="text-heading fw-semibold">24h Vol:</span>
                        <span class="text-muted">$180,639,667,232</span></div>
                </div>
                <div class="hstack flex-fill justify-content-end flex-nowrap gap-6 ms-auto px-6 px-xxl-8">
                    <button type="button" class="btn btn-xs btn-primary rounded-pill text-nowrap" data-bs-target="#connectWalletModal" data-bs-toggle="modal">Connect</button>
                    <div class="dropdown d-none"><a href="#" class="nav-link" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bi bi-sun-fill"></i></a>
                        <div class="dropdown-menu">
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">Light</button>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">Dark</button>
                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">System</button>
                        </div>
                    </div>
                    <div class="dropdown"><a href="#" class="nav-link" id="dropdown-notifications"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-end px-2" aria-labelledby="dropdown-notifications">
                            <div class="dropdown-item d-flex align-items-center">
                                <h6 class="dropdown-header px-0">Notifications</h6><a href="#"
                                    class="text-sm fw-semibold ms-auto">Clear all</a>
                            </div>
                            @php
                                $notifications = App\Models\SupportTicket::whereUserId(Auth::user()->id)->whereStatus(1)->get();
                                @endphp
                                  
                                  @forelse($notifications as $support)

                            <div class="dropdown-item py-3 d-flex">
                                <div>
                                    <div class="avatar bg-primary text-white rounded-circle">RF</div>
                                </div>
                                <div class="flex-fill ms-3">
                                    <div class="text-sm lg-snug w-rem-64 text-wrap"><a href="#"
                                            class="fw-semibold text-heading text-primary-hover">Robert</a> sent a
                                        message to <a href="{{ route('ticket.view', $support->ticket) }}"
                                            class="fw-semibold text-heading text-primary-hover">{{ __($support->subject) }}</a></div>
                                    <span class="text-muted text-xs">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}</span>
                                </div>
                            </div>
                             @empty
                                  <div class="alert alert-info">
                                    No Unread Notification Found
                                  </div>
                            @endforelse
                             
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item py-2 text-center"><a href="{{ route('ticket.index') }}"
                                    class="fw-semibold text-muted text-primary-hover">View all</a></div>
                        </div>
                    </div>
                    <div class="dropdown"><a class="avatar avatar-sm text-bg-dark rounded-circle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="false"
                            aria-expanded="false"><img src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}"></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-header">
                                <span class="d-block text-sm text-muted mb-1">Signed in as</span>
                                <span class="d-block text-heading fw-semibold">{{Auth::user()->fullname}}</span></div>
                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                href="{{route('user.home')}}"><i class="bi bi-house me-3"></i>Home </a><a class="dropdown-item"
                                href="{{ route('user.profile.setting') }}"><i class="bi bi-pencil me-3"></i>Edit profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                                href="{{ route('user.kyc.index') }}"><i class="bi bi-image me-3"></i>KYC </a><a class="dropdown-item"
                                href="{{ route('ticket.index') }}"><i class="bi bi-box-arrow-up me-3"></i>Help</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item"
                                href="{{ route('user.logout') }}"><i class="bi bi-person me-3"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
          