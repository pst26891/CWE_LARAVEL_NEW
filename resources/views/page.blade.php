@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<!-- main content -->
        <div class="col-lg-8 col-md-7 mb-30 order-2 order-md-2" style="text-align: justify;background: #fff;  border-radius: 5px;">
            <!-- Featured posts -->
            <article class="p-10  border-radius-10 mb-30 wow fadeIn animated">

                <div class="post-content">
                    <h1 class="post-title mb-30">
                        {{$pageContent->title}}
                    </h1>

                    <div class="entry-main-content">
                        @if($pageContent->template=='default')
                        {!! $pageContent->description !!}
                        @else
                        @php $incl = $pageContent->template;  @endphp
                        @include("templates.$incl")
                        @endif
                    </div>
                </div>

            </article>
        </div>
        <div class="col-lg-2 col-md-2 order-3 order-md-3 sidebar-right">
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
 
@endsection