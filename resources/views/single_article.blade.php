@extends('layouts.master')

@section('title', '')

@section('content')
@php $vurl = "vol".$article->volumeInfo->alias."no".$article->issue->alias; @endphp
<div class="col-lg-9 col-md-8 order-2 order-md-2" style="text-align: justify;">

    <div class="entry-header entry-header-1 mb-30 mt-50">
        <div class="entry-meta meta-0 font-small mb-30"><a href="category.html"><span class="post-cat bg-success color-white">{{$article->volumeInfo->name}} & {{$article->issue->name}}</span></a></div>
        <h3 class="post-title mb-30">
            {!! str_replace(['<p>', '</p>'], '', $article->title) !!}
        </h3>
        <div class="entry-meta meta-1 font-x-small color-black text-uppercase">
            <div style="float: right;">
                <span class="post-on"><i class="ti-calendar mr-5"></i> {{$article->pub_date_o}}</span>
                <span class="views-count"><i class="ti-eye mr-5"></i>{{ $article->view }}</span>
                <span class="download-count"><i class="ti-download mr-5"></i>{{ $article->download }}</span>
                @if($article->page_no)<span class="download-count">Pages: {{ $article->page_no }}</span>@endif
            </div>
            <br><br>

            <span class="post-by" style="font-size: 12px;">By
                @foreach($article->author as $author)
                <a href="#">{{ $author->f_name }} {{ $author->l_name }} <sup>{{ $author->affiliation }}</sup>
                    @if(is_numeric($author->correspond_author) || $author->correspond_author == 'Yes')
                    <sup style="color:green">*</sup>
                    @endif

                    @if(ltrim($author->orcid_id) != '')
                    <a href="https://orcid.org/{{$author->orcid_id}}" target="_blank"><img src="{{url('uploads/orcid_16x16.png')}}" /></a>
                    @endif

                </a>@if(!$loop->last), @endif
                @endforeach
            </span>

            <div class="clearfix"></div><br>
            <span class="post-by">
                <div class="myrow">
                    @if(count($article->affiliation) > 0)

                    @foreach($article->affiliation as $index => $aff)
                    <sup>{{ $index + 1 }}</sup>
                    @php
                    $fields = [];

                    if ($aff->department) $fields[] = $aff->department;
                    if ($aff->inst_address) $fields[] = $aff->inst_address;
                    if ($aff->inst_name) $fields[] = $aff->inst_name;
                    if ($aff->inst_city) $fields[] = $aff->inst_city;
                    if ($aff->pincode) $fields[] = $aff->pincode;
                    if ($aff->state) $fields[] = $aff->state;
                    if ($aff->country) $fields[] = $aff->country;
                    if ($aff->fax) $fields[] = "Fax: " . $aff->fax;
                    if ($aff->mobile) $fields[] = "Mobile: " . $aff->mobile;
                    @endphp

                    {{ implode(', ', $fields) }}
                    <br><br>
                    @endforeach
                    @endif
                </div><!-- End Affiliation -->

            </span>

            <div class="myrow">
                @php $correspond = $article->author->firstWhere('correspond_author', 'Yes'); @endphp
                @if (!empty($correspond))
                <span><strong>Corresponding Author:</strong> {{ $correspond->name }} - <a href="mailto:{{ $correspond->email }}" style="color:#dc3545">{{ $correspond->email }}</a></span>
                @endif
            </div> <!-- End correspond -->

        </div>

        <hr />
        <div class="myrow">
            @if($article->doi)
            <p><span id="footer_h" class="myheading2"><strong>DOI:</strong> </span> <a href="http://dx.doi.org/{{$article->doi}}" style="color:#dc3545" target="_blank">http://dx.doi.org/{{$article->doi}}</a></p>
            @endif

            @if($article->abstract)
            <p><span><strong>Abstract</strong> {!! $article->abstract !!}</span></p>
            @endif

            @if($article->keyword)
            <p><span><strong>Keywords</strong> {{$article->keyword}}</span></p>
            @endif

            <blockquote class="wp-block-quote is-style-large">
                <p style="font-size: 14px;"><strong>Copy the following to cite this article:</strong><br>{!! $article->article_citation !!}</p>
                @if ($article->doi != '')
                <span> DOI:<a href="http://dx.doi.org/{{$article->doi}}" target="_blank">http://dx.doi.org/{{$article->doi}}</a>
                </span> @endif
            </blockquote>

            <blockquote class="wp-block-quote is-style-large">
                <p style="font-size: 14px;"><strong>Copy the following to cite this URL:</strong><br>{!! $article->url_citation !!}</p>
            </blockquote>
        </div>
        <hr />
        <div class="article-section">
            <!-- Tabs -->
            <div class="tabs">
                <div class="tab " onclick="showTab('download')">Pdf Download</div>
                <div class="tab" onclick="showTab('citation')">Citation Manager</div>
                <div class="tab active" onclick="showTab('history')">Publishing History</div>
            </div>

            <!-- Download Tab -->
            <div id="download" class="tab-content ">
                <p><strong>Copy the following to cite this URL:</strong></p>
                <p>https://yourjournal.com/article/xyz123</p>

                <a class="btn-download" href="#" target="_blank" onclick="alert('Download counter called')">
                    Download Article (PDF)<br>
                    <i class="fa fa-file-pdf-o fa-lg red-icon"></i>
                </a>
            </div>

            <!-- Citation Tab -->
            <div id="citation" class="tab-content">
                <p>Select type of program for download</p>
                <table class="table-citation">
                    <tr>
                        <td>Endnote<br><small>EndNote format (Mac & Win)</small></td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td>Reference Manager<br><small>Ris format (Win only)</small></td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td>Procite<br><small>Ris format (Win only)</small></td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td>Medlars Format</td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td>RefWorks Format<br><small>RefWorks format (Mac & Win)</small></td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                    <tr>
                        <td>BibTex Format<br><small>BibTex format (Mac & Win)</small></td>
                        <td><a href="#"><i class="fa fa-download red-icon"></i></a></td>
                    </tr>
                </table>
            </div>

            <!-- History Tab -->
            <div id="history" class="tab-content active">
                <p><strong>Article Publishing History</strong></p>
                <table class="table-history">
                    <tr>
                        <th>Received:</th>
                        <td>2024-12-01</td>
                    </tr>
                    <tr>
                        <th>Accepted:</th>
                        <td>2025-01-10</td>
                    </tr>
                    <tr>
                        <th>Plagiarism Check:</th>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <th>Reviewed by:</th>
                        <td>
                            <a href="mailto:reviewer1@example.com">Dr. Reviewer One</a><br>
                            <a href="https://orcid.org/0000-0001-2345-6789" target="_blank">
                                <img src="images/orcid_16x16.png" alt="Orcid" />
                            </a>
                            <a href="https://publons.com/author/123456" target="_blank">
                                <img src="images/publons.png" style="width:16px;" alt="Publons" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Second Review by:</th>
                        <td>
                            <a href="mailto:reviewer2@example.com">Prof. Reviewer Two</a><br>
                            <a href="https://orcid.org/0000-0009-8765-4321" target="_blank">
                                <img src="images/orcid_16x16.png" alt="Orcid" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Final Approval by:</th>
                        <td>
                            <a href="https://yourjournal.com/editor-in-chief" target="_blank">Editor-in-Chief</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div> <!-- End Other -->

    <!-- Introduction -->
    <div class="myrow">
        <h2>Introduction: </h2>
        <div class="introduction">{!! $article->description !!}</div>

    </div>
    <!-- End introduction -->

    <div class="myrow">
        <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank">Creative Commons Attribution 4.0 International License</a>.

    </div>
</div>
<div class="col-lg-1 col-md-1 order-3 order-md-3 sticky-sidebar">
    <div class="sidebar-icons">

        <div class="icon-box" onclick="openSharePopup('Share')">
            <i class="fas fa-share-alt"></i>
            <div class="icon-label">Share</div>
        </div>

        <div class="icon-box" onclick="openSharePopup('View')">
            <i class="fas fa-eye"></i>
            <div class="icon-label">View</div>
        </div>

        <div class="icon-box" onclick="openSharePopup('Download')">
            <i class="fas fa-download"></i>
            <div class="icon-label">Download</div>
        </div>

        <div class="icon-box" onclick="openSharePopup('Help')">
            <i class="fas fa-exclamation"></i>
            <div class="icon-label">Help</div>
        </div>
        <div class="icon-box" onclick="openSharePopup('Cite')">
            <i class="fas fa-quote-right"></i>
            <div class="icon-label">Cite</div>
        </div>

    </div>

</div>

<!-- Share Modal -->
<div id="shareModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeSharePopup()">&times;</span>
        <div id="modalContentArea"></div>
    </div>
</div>

<script>
    function showTab(tabId) {
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => tab.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        document.querySelector(`.tab[onclick="showTab('${tabId}')"]`).classList.add('active');
    }

    function openSharePopup(type) {
        const contentArea = document.getElementById("modalContentArea");
        let html = "";
        switch (type) {
            case "Share":
                html = `
                <h2>Share Link</h2>
                <div class="social-icons">
                    <a href="#"><i class="fas fa-envelope"></i></a>
                    <a href="#"><i class="fas fa-times-circle"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-weixin"></i></a>
                    <a href="#"><i class="fab fa-reddit-alien"></i></a>
                    <a href="#"><i class="fas fa-user"></i></a>
                </div>
                <div style="margin-top:15px;">
                    <input type="text" value="{{url('/').'/'.$vurl.'/'.$article->url}}" id="shareLink" readonly style="width:70%; padding:8px;">
                    <button onclick="copyShareLink()">Copy</button>
                </div>
            `;
                break;
            case "View":
                html = `<h2>View Content</h2><p>Total View: <strong>{{$article->view}}</strong></p>`;
                break;
            case "Download":
                html = `<h2>Download File</h2><a href="/path/to/file.pdf" download class="btn">Click here to download</a><br>
                Total Download: <strong>{{$article->view}}</strong>`;
                break;
            case "Help":
                html = `
        <div class="help-popup">
            <h2>Need Help?</h2>
            <div class="help-sections">
                <div class="help-block">
                    <h4>Support</h4>
                    <p>Find support for a specific problem in the support section of our website.</p>
                    <button class="help-btn">Get Support</button>
                </div>
                <div class="help-block">
                    <h4>Feedback</h4>
                    <p>Please let us know what you think of our products and services.</p>
                    <button class="help-btn">Give Feedback</button>
                </div>
                <div class="help-block">
                    <h4>Information</h4>
                    <p>Visit our dedicated information section to learn more about MDPI.</p>
                    <button class="help-btn">Get Information</button>
                </div>
            </div>
        </div>
    `;
                break;
            case "Cite":
                html = `<h2>How to Cite</h2><p>Author, Title, Journal, Year. DOI: <strong>10.xxxx/xxxx</strong></p>`;
                break;
            default:
                html = `<p>Unknown action.</p>`;
        }

        contentArea.innerHTML = html;
        document.getElementById("shareModal").style.display = "block";
    }

    function closeSharePopup() {
        document.getElementById("shareModal").style.display = "none";
    }

    function copyShareLink() {
        var copyText = document.getElementById("shareLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile
        document.execCommand("copy");
        alert("Copied the link: " + copyText.value);
    }
</script>

@endsection