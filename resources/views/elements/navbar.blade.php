<header class="main-header header-style-2 mb-40">
    <div class="header-bottom header-sticky background-white text-center">
        <div class="scroll-progress gradient-bg-1"></div>
        <div class="mobile_menu d-lg-none d-block"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="header-logo d-none d-lg-block">
                        <a href="{{ url('/') }}">
                            {{-- Display the logo if it exists, otherwise show a default image --}}
                            <img class="logo-img d-inline" src="{{url('uploads').'/'.$setting->logo}}" alt="">

                        </a>
                    </div>
                    <div class="logo-tablet d-md-inline d-lg-none d-none">
                        <a href="index.html">
                            <img class="logo-img d-inline" src="assets/imgs/logo.svg" alt="">
                        </a>
                    </div>
                    <div class="logo-mobile d-block d-md-none">
                        <a href="index.html">
                            <img class="logo-img d-inline" src="assets/imgs/favicon.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 main-header-navigation">
                    <!-- Main-menu -->
                    <div class="main-nav text-left float-lg-left float-md-right">
                        <ul class="mobi-menu d-none menu-3-columns" id="navigation">
                             @foreach($topNavFrontItems as $menu)
                            <li class="cat-item cat-item-2"><a href="{{ url($menu->slug) }}">{{ $menu->title }}</a></li>  
                            @endforeach
                        </ul>

                        <nav>
                            <ul class="main-menu d-none d-lg-inline">
                              <li >
                                    <a href="{{'/'}}"><span class="mr-15">
                                    <ion-icon name="home-outline"></ion-icon>
                                        </span>Home</a>
                                </li>
                                
                                {{-- Loop through the top navigation items --}}
                                @foreach($topNavFrontItems as $menu)
                                @php
                                $hasChildren = !empty($menu->children);
                                $hasGrandChildren = $hasChildren && collect($menu->children)->contains(function ($child) {
                                return !empty($child->children);
                                });
                                @endphp

                                @if($hasGrandChildren)
                                {{-- 3-level menu (Mega menu style) --}}
                                <li class="mega-menu-item">
                                    <a href="{{ url($menu->slug) }}" target="{{ $menu->target == 0 ? '' : $menu->target }}">
                                        <span class="mr-15">
                                            <ion-icon name="desktop-outline"></ion-icon>
                                        </span>{{ $menu->title }}
                                    </a>
                                    <div class="sub-mega-menu sub-menu-list row text-muted font-small">
                                        @foreach($menu->children as $child)
                                        <ul class="col-md-2">
                                            <li><strong>{{ $child->title }}</strong></li>
                                            @foreach($child->children as $grand)
                                            <li>
                                                <a href="{{url('page')}}/{{$menu->slug}}/{{$grand->slug}}" target="{{ $grand->target == 0 ? '' : $grand->target }}">
                                                    {{ $grand->title }}
                                                </a>
                                            </li> 
                                            @endforeach
                                        </ul>
                                        @endforeach
                                      
                                    </div>
                                </li>
                                @elseif($hasChildren)
                                {{-- 2-level menu --}}
                                <li class="menu-item-has-children">
                                    <a href="{{ url($menu->slug) }}" target="{{ $menu->target == 0 ? '' : $menu->target }}">
                                        <span class="mr-15">
                                            <ion-icon name="home-outline"></ion-icon>
                                        </span>{{ $menu->title }}
                                    </a>
                                    <ul class="sub-menu text-muted font-small">
                                        @foreach($menu->children as $child)
                                        <li>
                                            <a href="{{url('page')}}/{{$menu->slug}}/{{$child->slug}}" target="{{ $child->target == 0 ? '' : $child->target }}">
                                                {{ $child->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                {{-- Single level menu --}}
                                @if(!empty($menu->slug))
                                <li>
                                    <a href="{{ url($menu->slug) }}" target="{{ $menu->target == 0 ? '' : $menu->target }}">
                                        <span class="mr-15">
                                            <ion-icon name="link-outline"></ion-icon>
                                        </span>{{ $menu->title }}
                                    </a>
                                </li>
                                @endif
                                @endif
                                @endforeach

                                {{-- Static Contact item --}}
                                <li>
                                    <a href="{{ url('contact') }}">
                                        <span class="mr-15"><ion-icon name="mail-unread-outline"></ion-icon></span>
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </nav>


                    </div>
                    <!-- Search -->
                     
                    <form action="{{ url('/')}}/search/articles" method="get" class="search-form d-lg-inline float-right position-relative mr-30 d-none">
                        <input type="text" class="search_field" placeholder="Search" value="" name="search">
                        <span class="search-icon"><i class="ti-search mr-5"></i></span>
                    </form>
                    <!-- Off canvas -->
                    <div class="off-canvas-toggle-cover">
                        <div class="off-canvas-toggle hidden d-inline-block ml-15" id="off-canvas-toggle">
                            <ion-icon name="grid-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>