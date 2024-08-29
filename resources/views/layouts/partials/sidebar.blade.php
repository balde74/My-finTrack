<div class="sidebar">
    <div class="brand-logo"><a class="full-logo" href="index.html"><img src="images/logoi.png" alt="" width="30"></a>
    </div>
    <div class="menu">
        <ul>
            {{-- <li>
                <a href="index.html">
                    <span>
                        <i class="fi fi-rr-dashboard"></i>
                    </span>
                    <span class="nav-text">Home</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('wallet.show')}}" >
                    <span>
                        <i class="fi fi-sr-wallet"></i>
                    </span>
                    <span class="nav-text">Portefeuilles</span>
                </a>
            </li>
            <li>
                <a href="{{ route('budget.show') }}">
                    <span>
                        <i class="fi fi-rr-donate"></i>
                    </span>
                    <span class="nav-text">Budgets</span>
                </a>
            </li>
            <li>
                <a href="{{ route('account.show')}}" >
                    <span>
                        <i class="fi fi-ss-coins"></i>
                    </span>
                    <span class="nav-text">Comptes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('settings.show') }}">
                    <span>
                        <i class="fi fi-rs-settings"></i>
                    </span>
                    <span class="nav-text" >Paramètres</span>
                </a>
            </li>
            {{-- <li>
                <a href="budgets.html">
                    <span>
                        <i class="fi fi-rr-donate"></i>
                    </span>
                    <span class="nav-text">Budgets</span>
                </a>
            </li>
            <li>
                <a href="goals.html">
                    <span>
                        <i class="fi fi-sr-bullseye-arrow"></i>
                    </span>
                    <span class="nav-text">Goals</span>
                </a>
            </li>
            <li>
                <a href="profile.html">
                    <span>
                        <i class="fi fi-rr-user"></i>
                    </span>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="analytics.html">
                    <span>
                        <i class="fi fi-rr-chart-histogram"></i>
                    </span>
                    <span class="nav-text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="support.html">
                    <span>
                        <i class="fi fi-rr-user-headset"></i>
                    </span>
                    <span class="nav-text">Support</span>
                </a>
            </li>
            <li>
                <a href="affiliates.html">
                    <span>
                        <i class="fi fi-rs-link-alt"></i>
                    </span>
                    <span class="nav-text">Affiliates</span>
                </a>
            </li> --}}
           
        </ul>
    </div>
</div>