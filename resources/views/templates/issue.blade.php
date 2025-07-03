@php
    use Illuminate\Support\Facades\Request;

    $slug = Request::is('page/issues/*') ? Request::segment(3) : Request::segment(1);
    $issue = null;
    $toc = null;

    if ($slug === 'current-issue-toc' && isset($currentIssue)) {
        $issue = $currentIssue;
    } elseif ($slug === 'coming-issue' && isset($comingIssue)) {
        $issue = $comingIssue;
        $toc = 'TOC';
    }
@endphp

@if($issue)
    @php
        $edition = $issue->edition ?? '';
        $numberName = $issue->name ?? '';
        $numberId = $issue->id ?? '';
        $numberAlias = $issue->alias ?? '';
        $volumeId = $issue->parent ?? '';
        $volumeName = $issue->volume->name ?? '';
        $volumeAlias = $issue->volume->alias ?? '';
        $pages = $issue->pages ?? '';
        $cover = $issue->cover ?? 'assets/imgs/journal_pic.jpg';
    @endphp

    <style>
        .issue_subs li a { font-size: 12px }
        #contact { border: none !important }
        .plumx-plum-print-popup { width: 50px; height: 50px; }
        .PlumX-Popup { float: right; }
    </style>

    <script src="{{ url('share42/share42.js') }}"></script>

    @if($numberId)
        <p>
            We are publishing the online coming issue to facilitate publication of reviewed articles
            for the benefit of authors and researchers. The articles are published ahead of the print issue.
            The PDF files for articles will be added with the print issue.
        </p>
    @endif

    <div id="coming_issues">
        <article class="p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
            <div class="d-md-flex d-block">
                <div class="post-thumb post-thumb-big d-flex mr-15 border-radius-15 img-hover-scale">
                    <a href="#">
                        <img style="max-width:100px" class="border-radius-15" src="{{ $cover ? url('uploads/' . $cover) : url('assets/imgs/journal_pic.jpg') }}" alt="Cover">
                    </a>
                </div>
                <div class="post-content media-body">
                    <div class="entry-meta mb-15 mt-10">
                        <span class="post-in text-danger font-x-large">{{ $volumeName }} | {{ $numberName }}</span>
                        <span class="post-by float-right">
                            <a href="{{ url("feed.php/$volumeAlias/$numberAlias") }}" target="_blank">
                                <img src="{{ url('assets/imgs/icon_rss.jpg') }}" /> RSS
                            </a>
                        </span>
                    </div>
                    <div class="entry-meta meta-1 color-grey float-left text-uppercase" style="font-size:14px">
                        @if($edition)
                            <span class="post-on">{{ $edition }}</span>
                        @endif
                        <br><br>
                        <span class="time-reading">Journal allows immediate open access to content in HTML + PDF</span>
                        <br><br>
                        @if($pages)
                            <span class="post-on">Page Number: {{ $pages }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </article>
        <div class="clearfix"></div>

        @if($numberId)
            <p>We thank our eminent editors and reviewers for maintaining the quality of the journal content.</p>
            <p><a href="{{ url('page/submission/reviewers-list/') }}">Visit Reviewers List</a></p>
        @endif

        <h2 class="myheading">Research Articles</h2>
        <div class="border_heading mb-3"></div>

            @php
                $articleTypes = \App\Models\Admin\ArticleType::where('status', 0)->orderBy('sorder')->get();
            @endphp

            @foreach($articleTypes as $articleType)
                @php
                    $articles = \App\Models\Admin\Article::with('author')
                        ->where('status', 1)
                        ->where('article_type_id', $articleType->id)
                        ->where('number', $numberId)
                        ->orderBy('order_no')
                        ->get();
                @endphp

                @if($articles->isNotEmpty())
                     <div class="entry-meta mb-15 mt-10">
                       <span class="post-in text-danger font-x-large">{{ $articleType->issue_name }}</span>
                     </div>

                    @foreach($articles as $article)
                        @php
                            $volumeUrl = "vol$volumeAlias" . "no$numberAlias";
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

                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                        <span class="post-by"><i class="ti-user mr-5"></i>
                                            @foreach($article->author as $author)
                                                <a href="#">{{ $author->f_name }} {{ $author->l_name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </span>
                                        <span class="post-on"><i class="ti-calendar mr-5"></i>{{ \Carbon\Carbon::parse($article->pub_date_o)->format('d M Y') }}</span>
                                        <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->view }}</span>
                                        <span class="download-count"><i class="ti-download mr-5"></i>{{  $article->download }}</span>
                                        <span class="download-count">Pages: {{ $article->page_no }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
            @endforeach

        <div class="clearfix"></div>
    </div>
@endif
