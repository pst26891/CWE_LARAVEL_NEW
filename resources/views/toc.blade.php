@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<!-- main content -->
<div class="col-lg-10 col-md-9 order-1 order-md-2">
    <div class="row">
        <div class="col-lg-10 col-md-12">
            <!-- Featured posts -->
            <article class="p-10  border-radius-10 mb-30 wow fadeIn animated">
                <div class="row">
                    <div class="">
                        <div class="post-content">
                            <div class="entry-main-content">
                                <div class="myblog">

                                    <section id="rahul_heading_main_border" class="widget">
                                        <h3 class="page-title" id="cwe_heading">
                                            TOC
                                            <a href="{{ url('feed/' . $volume->alias . '/' . $issue->alias) }}" title="RSS" target="_blank" class="pull-right">
                                                <img src="{{ url('assets/imgs/icon_rss.jpg') }}" alt="RSS" />
                                            </a>
                                        </h3>
                                    </section>

                                    <div id="coming_issues">
                                        <h4 id="cwe_heading">Table of Contents - {{ $volume->name }} {{ $issue->name }}</h4>
                                        <div class="widget">
                                            @foreach($articles as $article)
                                            @php
                                            $download = $article->download ?? 0;
                                            $view = $article->view ?? 0;
                                            $volumeUrl = "vol" . $volume->alias . "no" . $issue->alias;
                                            @endphp
                                            <article class="p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                                                <div class="d-flex">
                                                    <div class="post-content media-body">

                                                        <h5 class="post-title mb-15 text-limit-2-row">
                                                            <a href="">{{ strip_tags($article->title) }}</a>
                                                        </h5>

                                                        <p class="post-exerpt font-medium text-muted d-none d-lg-block mb-10">
                                                            [ <a href="{{ url("$volumeUrl/$article->url") }}">HTML Full Text</a> ]
                                                            [ <a href="{{ url('abstract/' . $article->id) }}">Abstract</a> ]
                                                            @if($article->upload_pdf)
                                                            [ <a href="{{ url("pdf/{$article->pdf_locate}/{$article->upload_pdf}") }}" target="_blank" onclick="count_download('{{ $article->manuscript_no }}')">PDF</a> ]
                                                            @endif
                                                            [ <a href="{{ url("xml/$volumeUrl/$article->url") }}" target="_blank">XML</a> ]
                                                        </p>

                                                        @if($article->doi)
                                                        <p class="post-exerpt font-medium d-none d-lg-block mb-10">
                                                            <a class="text-info" href="http://dx.doi.org/{{ $article->doi }}" target="_blank">{{ $article->doi }}</a>
                                                        </p>
                                                        @endif

                                                        <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase authors-area">
                                                            <span class="post-by"><i class="ti-user mr-5"></i>
                                                                @foreach($article->author as $author)
                                                                <a href="#">{{ $author->f_name }} {{ $author->l_name }}</a>@if(!$loop->last), @endif
                                                                @endforeach
                                                            </span> <br>
                                                            <span class="post-on"><i class="ti-calendar mr-5"></i>{{ \Carbon\Carbon::parse($article->pub_date_o)->format('d M Y') }}</span>
                                                            <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->view }}</span>
                                                            <span class="download-count"><i class="ti-download mr-5"></i>{{ $article->download }}</span>
                                                            <span class="download-count">Pages: {{ $article->page_no }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            <div class="clearfix"></div>
                                            <div style="border-top:1px solid #000"></div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

        </div>
        <div class="col-lg-2  col-md-2 sidebar-right">
            <!--Post aside style 1-->
            @foreach($rightWidgets as $widget)
            <div class="sidebar-widget widget_newsletter border-radius-10 p-20 bg-white mb-30" style="text-align:center">
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