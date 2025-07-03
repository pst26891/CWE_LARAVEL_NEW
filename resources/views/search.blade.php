@extends('layouts.master')

@section('title', '')

@section('content')
<div class="col-lg-7 col-md-6 order-2 order-md-2">
    @if($articles->count())
    <ul>
        @foreach($articles as $article)
        @php
        $vurl = "vol" . $article->volumeInfo->alias . "no" . $article->issue->alias;
        @endphp
        <li>
            <a href="{{ url($vurl . '/' . $article->url) }}" class="search_result">
                {!! $article->title !!}
            </a>
        </li>
        @endforeach
    </ul>


    {{ $articles->withQueryString()->links() }}
    @else
    <p>No articles found.</p>
    @endif
</div>

<div class="col-lg-3  sidebar-right sticky-sidebar order-3 order-md-3">
    <div class="sidebar-widget p-20 border-radius-15 bg-white widget-text wow fadeIn animated">
        <div class="widget-header mb-30">
            <h5 class="widget-title">Search <span>tips</span></h5>
        </div>
        <div>
            <h6>1. Use the tabs</h6>
            <p class="font-small text-muted">The first tip is to use the tabs in Google search. On the top of every search are a number of tabs. Usually you’ll see Web, Image, News, and More. Using these tabs, you can help define what kind of search you need to do.</p>
            <h6>2. Use quotes</h6>
            <p class="font-small text-muted">When searching for something specific, try using quotes to minimize the guesswork for Google search. When you put your search parameters in quotes, it tells the search engine to search for the whole phrase.</p>
            <h6>3. Use a hyphen to exclude words</h6>
            <p class="font-small text-muted">Sometimes you may find yourself searching for a word with an ambiguous meaning. An example is Mustang. When you Google search for Mustang, you may get results for both the car made by Ford or the horse. If you want to cut one out, use the hyphen to tell the engine to ignore content with one of the other. </p>
        </div>
    </div>
</div>

@endsection