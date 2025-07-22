@if (!empty($isArticlePage))
    @php $lg = 2;
         $md = 3; 
   @endphp
@endif   
<div class="col-lg-{{ $lg ?? 2 }} col-md-{{ $md ?? 3 }} primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1">
    <!-- Widget Weather -->
    <div class="sidebar-widget widget-weather border-radius-10 bg-white mb-30 ">
        <div class="d-flex">

            <div class="font-medium ml-10 pt-20">
                <div id="datetime" class="d-inline-block">
                    <ul>
                        <li><span class="font-small">
                                <a class="text-primary" href="#" style="color:#3fa9f5 !important">ISSN</a><br>
                            </span>
                            <p>0973-4929</p>
                        </li>

                        <li><span class="font-small">
                                <a class="text-primary" href="#" style="color:#3fa9f5 !important">Online ISSN</a><br>
                            </span>
                            <p>2320-8031</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
   
    @if (!empty($isArticlePage))
    <div class="sidebar-widget border-radius-10 bg-white mb-30">
        <ul class="font-small text-muted">
            <li class="cat-item" ><a href="#abstract">Abstract</a></li>
            <li class="cat-item" ><a href="#introduction">Introduction</a></li>
            <li class="cat-item" ><a href="#materials-methods">Materials and Methods</a></li>
            <li class="cat-item" ><a href="#results-discussion">Results and Discussion</a></li>
            <li class="cat-item" ><a href="#conclusions">Conclusions</a></li>
            <li class="cat-item" ><a href="#funding-sources">Funding Sources</a></li>
            <li class="cat-item" ><a href="#conflicts-interest">Conflicts of Interest</a></li>
            <li class="cat-item" ><a href="#authors-contribution">Authors’ Contribution</a></li>
            <li class="cat-item" ><a href="#data-availability">Data Availability</a></li>
            <li class="cat-item" ><a href="#ethics-statement">Ethics Statement</a></li>
            <li class="cat-item" ><a href="#informed-consent">Informed Consent Statement</a></li>
            <li class="cat-item" ><a href="#references">References</a></li>
        </ul>
    </div>
     
@endif


    <!-- Widget Categories -->
    @foreach($leftWidgets as $item)
    <div class="sidebar-widget widget_categories__{{ $loop->iteration }} border-radius-10 bg-white mb-30">        
        {!! $item->description !!}
    </div>
    @endforeach
</div>