<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>مكتبة حسوب</title>

  @vite(['resources/css/app.css'])
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">


  <style>
    body {
      font-family: 'Cairo', sans-serif;
      background: #f0f0f0;
    }
  </style>
  @yield('head')
</head>
<body dir="rtl" style="text-align: right">

  <div>
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">مكتبة حسوب</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a href="#" class="nav-link">التصنيفات <i class="fas fa-list"></i></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">الناشرون <i class="fas fa-table"></i></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">المؤلفون <i class="fas fa-pen"></i></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">مشترياتي <i class="fas fa-basket-shopping"></i></a>
            </li>
          </ul>

          <ul class="navbar-nav mr-auto">
            @guest
              <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">{{__('تسجيل الدخول')}}</a>  
              </li>
              @if(Route::has('register'))
                <li class="nav-item">
                  <a href="{{ route('register') }}" class="nav-link">{{__('انشاء حساب')}}</a>  
                </li>
              @endif
            @else
                 <li class="nav-item dropdown justify-content-left">
                  <a id="navbarDropdown" class="nav-link" href="#" data-bs-toggle="dropdown">
                    <img src="{{Auth::user()->profile_photo_url}}" alt="{{Auth::user()->name}}" class="h-8 w-8 rounded-circle object-cover" />
                  </a>

                  <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2">
                    <div class="pt-4 pb-1 border-t border-gray-200">
                      <div class="flex items-center px-4">
          
                          <div>
                              <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                          </div>
                      </div>
          
                      <div class="mt-3 space-y-1">
                          <!-- Account Management -->
                          <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                              {{ __('الملف الشخصي') }}
                          </x-responsive-nav-link>
          
                          @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                              <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                  {{ __('API Tokens') }}
                              </x-responsive-nav-link>
                          @endif
          
                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}" x-data>
                              @csrf
                              <x-responsive-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();"
                              >
                                  {{ __('تسجيل الخروج') }}
                              </x-responsive-nav-link>
                          </form>
          
                          <!-- Team Management -->
                          @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                              <div class="border-t border-gray-200"></div>
          
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                  {{ __('Manage Team') }}
                              </div>
          
                              <!-- Team Settings -->
                              <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                  {{ __('Team Settings') }}
                              </x-responsive-nav-link>
          
                              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                  <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                      {{ __('Create New Team') }}
                                  </x-responsive-nav-link>
                              @endcan
          
                              <div class="border-t border-gray-200"></div>
          
                              <!-- Team Switcher -->
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                  {{ __('Switch Teams') }}
                              </div>
          
                              @foreach (Auth::user()->allTeams() as $team)
                                  <x-switchable-team :team="$team" component="responsive-nav-link" />
                              @endforeach
                          @endif
                      </div>
                  </div>
                  </div>
                  
                 </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8d6b3de788.js" crossorigin="anonymous"></script>
  @yield('script')
</body>
</html>