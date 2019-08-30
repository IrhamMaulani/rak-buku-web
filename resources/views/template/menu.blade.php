<!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                    @foreach (config('notika.menus')  as $item)
                                        @if (isset($item['target']))
                                    <li><a data-toggle="collapse" data-target="{{$item['target']}}" href="#">{{$item['text']}}</a>
                                    <ul class="collapse dropdown-header-top">

                                        @foreach($item['nested'] as $index=> $menu)
                                    <li><a href="{{ $item['url'][$index]}}">{{$menu['text']}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                            <li><a href="{{$item['url']}}">{{$item['text']}}</a>
                                    </li>
                                @endif
                                    @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->

<div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                        {{-- for nested menu --}}
                        @foreach (config('notika.menus')  as $item)

                        @if (isset($item['target']))
              
                        <li class="@if(in_array(basename(request()->path()), $item['url'])) 
                        {{'active'}}
                          @endif">
                            <a data-toggle="tab" href="{{'#'. $item['target']}}"><i class="notika-icon {{$item['icon']}} "></i> {{$item['text']}}</a>
                        </li>
      
                        @else

                        {{-- @dd(basename(request()->path())) --}}

                        @if (basename(request()->path()) == $item['url'])
                            {{-- @dd(Request::url()) --}}
                        @else
                            
                        @endif

                        {{-- @dd(basename(request()->path())) --}}
                        
                     
                        <li class="{{ basename(request()->path()) == '' ? '/' : basename(request()->path()) == $item['url'] ? 'active' : '' }}">
                        <a class="active-single" href="{{ $item['url'] == '' ? url('/') : $item['url'] }}">
                        <i class="notika-icon {{$item['icon']}}"> </i>{{$item['text']}}</a>
                        </li>
                        {{-- end single menu --}}
                        @endif
                        @endforeach
                    </ul>
                    <div class="tab-content custom-menu-content">

                        @foreach (config('notika.menus')  as $item)

                        @if (isset($item['target']))
                        <div id="{{$item['target']}}" class="tab-pane notika-tab-menu-bg animated flipInX 
                        @if(in_array(basename(request()->path()), $item['url'])) 
                        {{'active'}}
                        @endif"> 

                            <ul class="notika-main-menu-dropdown">
                                @foreach ($item['nested'] as $index => $menu)

                                @if (isset($menu['target']))
                                    
                                @endif           

                                @if (isset($item['target']) && isset($menu['text']) )
                            <li><a href="{{ $item['url'][$index] }}">{{$menu['text']}}</a>
                                </li>

                                @endif
                                    @endforeach 
                            </ul>
                        </div>
                    
                        @endif
                        @endforeach
     
                    </div>
                </div>
            </div>
        </div>
    </div>