<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex align-items-center">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->username }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</p>
                            </div>

                            <div class="user-img d-flex align-items-center">
                                @if(auth()->user()->photo) 
                                    <div class="avatar avatar-md">
                                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar User" style="object-fit: cover;">
                                    </div>
                                @else
                                    <div class="avatar avatar-md bg-primary rounded-circle shadow-sm" style="width: 40px; height: 40px; min-width: 40px;">
                                        <span class="text-white fw-bold fs-5 w-100 h-100 text-center" style="line-height: 40px; display: inline-block;">
                                            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ auth()->user()->username }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>