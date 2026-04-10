@extends('layouts.master')

@section('title', '')

@section('content')
<div class="col-lg-7 col-md-6 order-2 order-md-2">
   <h4 class="mb-3">
        Search Results for:
        <span class="text-primary">"{{ $search }}"</span>
        <small>({{ $articles->total() }} Found)</small>
    </h4>

    @if($articles->count())

        @foreach($articles as $article)

            @php
                $vurl = "vol".$article->volumeInfo->alias."no".$article->issue->alias;

                $title = str_ireplace(
                    $search,
                    '<mark>'.$search.'</mark>',
                    $article->title
                );
            @endphp

            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    <h5>
                        <a href="{{ url($vurl.'/'.$article->url) }}"
                           class="text-decoration-none">
                            {!! $title !!}
                        </a>
                    </h5>

                    <p class="text-muted mb-2">
                        {!! Str::limit(strip_tags($article->abstract), 150) !!}
                    </p>

                    <small class="text-secondary">
                        Volume:
                        {{ $article->volumeInfo->name ?? '-' }}
                        |
                        Issue:
                        {{ $article->issue->name ?? '-' }}
                    </small>

                </div>
            </div>

        @endforeach

        <div class="mt-4">
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>

    @else

        <div class="alert alert-warning">
            No articles found for
            <strong>"{{ $search }}"</strong>.
        </div>

    @endif
</div>

<div class="col-lg-3 sidebar-right sticky-sidebar order-3 order-md-3">
    <div class="sidebar-widget p-20 border-radius-15 bg-white widget-text wow fadeIn animated">
        <div class="widget-header mb-30">
            <h5 class="widget-title">Search <span>tips</span></h5>
        </div>
        <div>
            <h6>1. Minimum Search Length</h6>
            <p class="font-small text-muted">
                Please enter at least 3 characters to perform a search. This helps improve search accuracy and ensures better matching results.
            </p>

            <h6>2. Search by Multiple Fields</h6>
            <p class="font-small text-muted">
                You can search articles using Title, Abstract, Keywords, or DOI. Our search engine checks across multiple fields to find the most relevant articles.
            </p>

            <h6>3. Use Specific Keywords</h6>
            <p class="font-small text-muted">
                For better results, use precise and relevant keywords related to your topic. Avoid generic words to get more accurate article matches.
            </p>
        </div>
    </div>
</div>

@endsection