<nav class="flex-none navbar navbar-vertical navbar-expand-lg navbar-light bg-transparent show vh-lg-100 px-0 py-2"
    id="sidebar">
    <div class="container-fluid px-3 px-md-4 px-lg-6">
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <a class="navbar-brand d-inline-block py-lg-1 mb-lg-5" href="{{route('user.home')}}"><img
                src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="logo-dark h-rem-8 h-rem-md-10" alt="...">
            <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="logo-light h-rem-8 h-rem-md-10" alt="..."></a>
        <div class="navbar-user d-lg-none">
            <div class="dropdown"><a class="d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                
                
                
                
                    <div>
    <div id="avatar" class="avatar avatar-sm text-bg-secondary rounded-circle"></div>
</div>
<div class="d-none d-sm-block ms-3">
    <span class="h6">{{ Auth::user()->fullname }}</span>
</div>
<div class="d-none d-md-block ms-md-2">
    <i class="bi bi-chevron-down text-muted text-xs"></i>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let userName = "{{ Auth::user()->fullname }}"; // Get Laravel user full name
        function getInitials(name) {
            let initials = name.split(" ").map(n => n[0].toUpperCase()).join("");
            return initials.substring(0, 2); // Ensure only two letters
        }
        document.getElementById("avatar").textContent = getInitials(userName);
    });
</script>

               
               
               
               
               
               
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <div class="dropdown-header">
                        <span class="d-block text-sm text-muted mb-1">Signed in as</span>
                        <span class="d-block text-heading fw-semibold">{{Auth::user()->fullname}}</span>
                    </div>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('user.home')}}"><i
                            class="bi bi-house me-3"></i>Home </a><a class="dropdown-item" href="{{ route('user.profile.setting') }}"><i
                            class="bi bi-pencil me-3"></i>Edit profile</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('user.kyc.index') }}"><i
                            class="bi bi-image me-3"></i>KYC </a><a class="dropdown-item" href="{{ route('ticket.index') }}"><i
                            class="bi bi-box-arrow-up me-3"></i>Help</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('user.logout')}}"><i
                            class="bi bi-person me-3"></i>Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse overflow-x-hidden" id="sidebarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.home') ? 'active' : '' }}"
                        href="{{ route('user.home') }}" role="button"
                        aria-controls="sidebar-dashboards"><i class="bi bi-house"></i>
                        <span>Dashboard</span>
                        <span class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span></a>
                </li> 
            </ul>



            <hr class="navbar-divider my-5 opacity-70">
            <ul class="navbar-nav">
                <li><span class="nav-link text-xs fw-semibold text-uppercase text-muted ls-wide">Bills Payment</span>
                </li>
                
                
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.airtime.tocash.request') ? 'active' : '' }}"
                        href="{{ route('user.airtime.tocash.request') }}"><i class="bi bi-phone-flip"></i> <span>Airtime To Cash</span>
                        </a>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.buy.airtime') ? 'active' : '' }}"
                        href="{{ route('user.buy.airtime') }}"><i class="bi bi-phone"></i> <span>Airtime Topup</span>
                        </a>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.buy.internet_sme') ? 'active' : '' }}"
                        href="{{ route('user.buy.internet_sme') }}"><i class="bi bi-wifi"></i> <span>Internet Plan</span>
                        </a>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.buy.local.utility') ? 'active' : '' }}"
                        href="{{route('user.buy.local.utility')}}"><i class="bi bi-lightning"></i> <span>Utility Bills</span>
                        </a>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.fund.betting.wallet') ? 'active' : '' }}"
                        href="{{route('user.fund.betting.wallet')}}"><i class="bi bi-balloon"></i> <span>Sport Betting</span>
                        </a>
                </li>
                 
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.buy.cabletv') ? 'active' : '' }}"
                        href="{{route('user.buy.cabletv')}}" ><i class="bi bi-tv"></i>
                        <span>Cable TV</span> </a> 
                </li>
                 
                 
            </ul>

            <hr class="navbar-divider my-5 opacity-70">
            <ul class="navbar-nav">
                <li><span class="nav-link text-xs fw-semibold text-uppercase text-muted ls-wide">Digital Assets</span>
                </li>
                  
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.buygift') ? 'active' : '' }}"
                        href="{{ route('user.buygift') }}"><i class="bi bi-gift"></i> <span>Buy Giftcard</span>
                        </a>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.tradegift') ? 'active' : '' }}"
                        href="{{ route('user.tradegift') }}"><i class="bi bi-credit-card"></i> <span>Sell Giftcard</span>
                        </a>
                </li> 
                @if ($general->crypto > 0)
                    <li class="nav-item my-1">
                        <a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.crypto.index') ? 'active' : '' }}"
                           href="{{ route('user.crypto.index') }}" ><i class="bi bi-wallet"></i>
                            <span>@lang('Crypto Wallet')</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.crypto.trade.index') ? 'active' : '' }}"
                        href="{{ route('user.crypto.trade.index') }}"><i class="bi bi-wallet"></i> <span>Trade Assests</span>
                        </a>
                </li> 
                 
                 
            </ul>

             @if($general->virtualcard > 0 && Auth::user()->vendor == 1)
             <hr class="navbar-divider my-5 opacity-70">
            <ul class="navbar-nav">
                
                <li><span class="nav-link text-xs fw-semibold text-uppercase text-muted ls-wide">Virtual Card</span>
                </li>
                 <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.virtualcard.index') ? 'active' : '' }}"
                        href="{{ route('user.virtualcard.index') }}"><i class="bi bi-key"></i> <span>(Verve NGN)</span>
                         </a>
                </li>  
                 <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.list.card') ? 'active' : '' }}"
                        href="{{ route('user.list.card') }}"><i class="bi bi-key"></i> <span>(Visa USD)</span>
                         </a>
                </li>                 
            </ul> 
            @endif


            @if(Auth::user()->api_access == 1 || Auth::user()->vendor == 1)
            <hr class="navbar-divider my-5 opacity-70">
            <ul class="navbar-nav">
                
                @if(Auth::user()->api_access == 1 || Auth::user()->vendor == 1)
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.api.key') ? 'active' : '' }}"
                        href="{{ route('user.api.key') }}"><i class="bi bi-key"></i> <span>API Key</span>
                         </a>
                </li>
                 
                @endif
                 
            </ul>
            @endif
 

            <hr class="navbar-divider my-5 opacity-70">
            <ul class="navbar-nav">
                <li><span class="nav-link text-xs fw-semibold text-uppercase text-muted ls-wide">My Wallet</span>
                </li>
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.bank.tranfer.start') ? 'active' : '' }}"
                        href="{{ route('user.bank.transfer.start') }}"><i class="bi bi-bank"></i> <span>Bank Transfer</span>
                        <span class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto">Auto</span></a>
                </li>
                @if ($general->p2p > 0)
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.p2p') ? 'active' : '' }}"
                        href="{{ route('user.p2p') }}" role="button"
                        aria-controls="sidebar-components"><i class="bi bi-send-check"></i>
                        <span>Wallet Transfer</span>
                        <span
                            class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span></a>
                     
                </li>
                @endif
                @if ($general->swap_fiat > 0)
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.swapcurrency') ? 'active' : '' }}"
                        href="{{ route('user.swapcurrency') }}"><i class="bi bi-currency-exchange"></i> <span>Currency Swap</span>
                        <span class="badge badge-sm rounded-pill me-n2 bg-warning-subtle text-warning ms-auto">🔥
                            Hot</span></a>
                </li>
                @endif
                
                <li class="nav-item my-1"><a class="nav-link d-flex align-items-center rounded-pill {{ Request::routeIs('user.transactions') ? 'active' : '' }}"
                        href="{{ route('user.transactions') }}" role="button"
                        aria-controls="sidebar-components"><i class="bi bi-cash-stack"></i>
                        <span>Transactions</span>
                        <span
                            class="badge badge-sm rounded-pill me-n2 bg-success-subtle text-success ms-auto"></span></a>
                     
                </li>
            </ul> 
            <div class="mt-auto"></div>
            <div class="card bg-dark border-0 mt-5 mb-3">
                <div class="card-body">
                    <div class="vstack gap-4"><i class="bi bi-rocket-takeoff-fill text-white text-2xl"></i>
                        <p class="text-sm text-white text-opacity-70">Upgrade your account to Pro for even more
                            juicy rate.</p><a href="{{ route('user.kyc.index') }}"
                            class="btn btn-sm btn-primary w-100">Upgade
                            now<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
