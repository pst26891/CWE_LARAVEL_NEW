<div class="col-lg-2 col-md-3 primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1">
    <!-- Widget Weather -->
    <div class="sidebar-widget widget-weather border-radius-10 bg-white mb-30 ">
        <div class="d-flex">

            <div class="font-medium ml-10 pt-20">
                <div id="datetime" class="d-inline-block">
                    <ul>
                        <li><span class="font-small">
                                <a class="text-primary" href="#">ISSN</a><br>
                            </span>
                            <p>0973-4929</p>
                        </li>

                        <li><span class="font-small">
                                <a class="text-primary" href="#">Online ISSN</a><br>
                            </span>
                            <p>2320-8031</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Widget Categories -->
    @foreach($leftWidgets as $item)
    <div class="sidebar-widget widget_categories__{{ $loop->iteration }} border-radius-10 bg-white mb-30">
        {!! $item->description !!}
    </div>
    @endforeach
</div>