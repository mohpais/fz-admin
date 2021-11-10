<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <button id="closeSide" class="d-block d-md-none text-danger close" style="position: absolute; top: 7px; left: 10px">
        <i class="mdi mdi-close"></i>
    </button>
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    @if (auth()->user()->profile_photo_path)
                        <img src="{{ auth()->user()->profile_photo_path }}" alt="image">
                    @else
                        <img src="{{ asset('panel/images/faces/default.png') }}" alt="image">
                    @endif
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    @php
                        $result = null;
                        $fullname = auth()->user()->fullname;
                        $count = strlen($fullname);
                        if ($count > 10) {
                            $concat = explode(" ", $fullname);
                            if (sizeof($concat) > 1) {
                                [$first_name, $second_name] = $concat;
                                if (strlen($first_name) > 3) {
                                    $result = substr($first_name, 0, 3). ' ' . $second_name;
                                } else {
                                    $result = $first_name. ' ' . substr($second_name, 0, 1). '.';
                                }
                            } else {
                                $result = substr($fullname, 0, 10). '...';
                            };
                        } else {
                            $result = $fullname;
                        }
                    @endphp
                    <span class="font-weight-bold mb-2">{{$result}}</span>
                    @if (isset(auth()->user()->corporate))
                        <span class="text-secondary text-small">{{auth()->user()->corporate->position}}</span>
                    @else
                        <span class="text-secondary text-small">Non Set</span>
                    @endif
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'corporates.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('corporates.index') }}">
                <span class="menu-title">Corporate</span>
                <i class="mdi mdi-hospital-building menu-icon"></i>
            </a>
        </li>
        {{-- <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <span class="menu-title">Admin</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li> --}}
        <li class="nav-item {{ Route::currentRouteName() == 'list.skill' ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="{{ Route::currentRouteName() == 'list.skill' ? 'true' : 'false' }}"
                aria-controls="general-pages">
                <span class="menu-title">Other Menu</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse {{ Route::currentRouteName() == 'list.skill' ? 'show' : 'false' }}" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Route::currentRouteName() == 'list.skill' ? 'active' : '' }}"> 
                        <a class="nav-link" href="{{ route('list.skill') }}">
                            My Skill
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/samples/login.html">
                            Timeline
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <a id="createProject" type="button" href="{{ route('projects.create') }}" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</a>
            </span>
        </li>
    </ul>
</nav>
