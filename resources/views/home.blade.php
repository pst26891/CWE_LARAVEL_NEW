@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<!-- main content -->
<div class="col-lg-10 col-md-9 order-1 order-md-2">
    <div class="row">
        <div class="col-lg-9 col-md-12 mb-30">
            <!-- Featured posts -->
            <article class="p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                <div class="row">
                    <div class="col-md-3">
                        <div class="post-thumb border-radius-15 img-hover-scale">
                            <a class="color-white" href="single.html">
                                <img class="border-radius-15 img-fluid" src="{{url('uploads').'/'.$setting->journal_pic}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="post-content">
                            <div class="entry-meta mb-15 mt-10">
                                <a class="entry-meta meta-2" href="category.html">
                                    <span class="post-in text-danger font-x-small">CURRENT ISSUE
                                    </span>
                                </a>
                            </div>

                            <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                {!! $setting->about_journal !!}
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <div class="tabs">
                <input type="radio" name="tabs" id="tab1" checked>
                <input type="radio" name="tabs" id="tab2">
                <input type="radio" name="tabs" id="tab3">
                <input type="radio" name="tabs" id="tab4">

                <div class="tab-labels">
                    <label for="tab1">Latest Articles</label>
                    <label for="tab2">Most Read Articles</label>
                    <label for="tab3">Most Downloaded Articles</label>
                    <label for="tab4">Most Cited Articles</label>
                </div>

                <div class="tab-content content1">
                    @foreach($mostLatest as $article)
                    @php $vurl = "vol".$article->volumeInfo->alias."no".$article->issue->alias; @endphp
                    <article class="p-10 background-white border-radius-10 mb-10 wow fadeIn animated">
                        <div class="d-flex">

                            <div class="post-content media-body">
                                @if($loop->first)
                                <div class="entry-meta mb-15 mt-10">
                                    <span class="post-in text-danger font-x-large">Latest Articles </span>
                                </div>
                                @endif
                                <h5 class="post-title mb-15 text-limit-2-row ">
                                    <a href="{{url('/').'/'.$vurl.'/'.$article->url}}">
                                        {!! strip_tags($article->title) !!}
                                    </a>
                                </h5>
                                <p class="post-exerpt font-medium text-muted d-none d-lg-block mb-10">
                                    Abstract: {!! \Illuminate\Support\Str::limit(strip_tags($article->abstract), 180, '...') !!}<a href="{{url('/').'/'.$vurl.'/'.$article->url}}">..More</a>
                                </p>
                                <p class="post-exerpt font-medium d-none d-lg-block mb-10">
                                    <a class="text-info" href="http://dx.doi.org/{{ $article->doi }}" class="text-info">http://dx.doi.org/{{ $article->doi }}</a>
                                </p>

                                <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                    <span class="post-by"><i class="ti-user mr-5"></i>
                                        <a href="#">
                                            @foreach($article->author as $index => $ath)
                                            <a href="#">{{ $ath->f_name . ' ' . $ath->l_name }}</a> <a href="https://orcid.org/{{$ath->orcid_id}}" target="_blank"> <img src="{{url('assets/imgs/orcid_16x16.png')}}" alt="Orcid" /></a>@if(!$loop->last) , @endif
                                            @endforeach
                                        </a></span>
                                    <span class="post-on"><i class="ti-calendar mr-5"></i>{{ \Carbon\Carbon::parse($article->pub_date_o)->format('d M Y') }}</span>
                                    <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->total_view }} </span>
                                    <span class="download-count"><i class="ti-download mr-5"></i>{{ $article->total_download }} </span>

                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-md-12 text-right">
                        <h6 class="font-medium pr-15">
                            <a class="text-muted font-small" href="{{url('/')}}/page/issues/current-issue-toc">Read More</a>
                        </h6>
                    </div>

                </div>

                <div class="tab-content content2">

                    @foreach($mostViewed as $article)
                    @php $vurl = "vol".$article->volumeInfo->alias."no".$article->issue->alias; @endphp

                    <article class="p-10 background-white border-radius-10 mb-10 wow fadeIn animated">
                        <div class="d-flex">

                            <div class="post-content media-body">
                                @if($loop->first)
                                <div class="entry-meta mb-15 mt-10">
                                    <span class="post-in text-danger font-x-large">Most Read Articles </span>
                                </div>
                                @endif
                                <h5 class="post-title mb-15 text-limit-2-row">
                                    <a href="{{url('/').'/'.$vurl.'/'.$article->url}}">
                                        {!! strip_tags($article->title) !!}
                                    </a>
                                </h5>
                                <p class="post-exerpt font-medium text-muted d-none d-lg-block mb-10">
                                    Abstract: {!! \Illuminate\Support\Str::limit(strip_tags($article->abstract), 180, '...') !!}<a href="{{url('/').'/'.$vurl.'/'.$article->url}}">..More</a>
                                </p>
                                <p class="post-exerpt font-medium text-info d-none d-lg-block mb-10">
                                    <a class="text-info" href="http://dx.doi.org/{{ $article->doi }}">http://dx.doi.org/{{ $article->doi }}</a>
                                </p>

                                <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                    <span class="post-by"><i class="ti-user mr-5"></i>
                                        <a href="#">
                                            @foreach($article->author as $index => $ath)
                                            <a href="#">{{ $ath->f_name . ' ' . $ath->l_name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </a></span>
                                    <span class="post-on"><i class="ti-calendar mr-5"></i>{{ \Carbon\Carbon::parse($article->pub_date_o)->format('d M Y') }}</span>
                                    <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->total_view }} </span>
                                    <span class="download-count"><i class="ti-download mr-5"></i>{{ $article->total_download }} </span>

                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-md-12 text-right">
                        <h6 class="font-medium pr-15">
                            <a class="text-muted font-small" href="{{url('/')}}/most-read">Read More</a>
                        </h6>
                    </div>
                </div>

                <div class="tab-content content3">
                    @foreach($mostDownloaded as $article)
                    @php $vurl = "vol".$article->volumeInfo->alias."no".$article->issue->alias; @endphp

                    <article class="p-10 background-white border-radius-10 mb-10 wow fadeIn animated">
                        <div class="d-flex">

                            <div class="post-content media-body">
                                @if($loop->first)
                                <div class="entry-meta mb-15 mt-10">
                                    <span class="post-in text-danger font-x-large">Most Downloaded Articles </span>
                                </div>
                                @endif
                                <h5 class="post-title mb-15 text-limit-2-row">
                                    <a href="{{url('/').'/'.$vurl.'/'.$article->url}}">
                                        {!! strip_tags($article->title) !!}
                                    </a>
                                </h5>
                                <p class="post-exerpt font-medium text-muted d-none d-lg-block mb-10">
                                    Abstract: {!! \Illuminate\Support\Str::limit(strip_tags($article->abstract), 180, '...') !!}<a href="{{url('/').'/'.$vurl.'/'.$article->url}}">..More</a>
                                </p>
                                <p class="post-exerpt font-medium text-info d-none d-lg-block mb-10">
                                    <a href="http://dx.doi.org/{{ $article->doi }}">http://dx.doi.org/{{ $article->doi }}</a>
                                </p>

                                <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                    <span class="post-by"><i class="ti-user mr-5"></i>
                                        <a href="#">
                                            @foreach($article->author as $index => $ath)
                                            <a href="#">{{ $ath->f_name . ' ' . $ath->l_name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </a></span>
                                    <span class="post-on"><i class="ti-calendar mr-5"></i>{{ \Carbon\Carbon::parse($article->pub_date_o)->format('d M Y') }}</span>
                                    <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->total_view }} </span>
                                    <span class="download-count"><i class="ti-download mr-5"></i>{{ $article->total_download }} </span>

                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    <div class="col-md-12 text-right">
                        <h6 class="font-medium pr-15">
                            <a class="text-muted font-small" href="{{url('/')}}/most-downloads">Read More</a>
                        </h6>
                    </div>
                </div>

                <div class="tab-content content4">
                    <h3>Most Cited Articles</h3>
                    <p>Your most cited articles will appear here.</p>
                </div>
            </div>




        </div>
        <div class="col-lg-3 col-md-12 sidebar-right">
            <!--Post aside style 1-->
            @foreach($rightWidgets as $widget)
            <div class="sidebar-widget widget_newsletter border-radius-10 bg-white mb-30" style="text-align:center">
                <div class="widget-header widget-header-style-1 position-relative mb-15">
                    <h5 class="widget-title">{{$widget->name}}</h5>
                </div>
                <div class="newsletter">
                    {!! $widget->description !!}
                </div>
            </div>
            @endforeach

        </div>
    </div>



</div>
@endsection