@php
    $comingId = $comingIssue ? $comingIssue->id : null;
    $currentId = $currentIssue ? $currentIssue->id : null;
@endphp

@foreach($volumes as $volume)
    @php
	
        // Filter issues for this volume, excluding coming/current
        $filteredIssues = $volume->issues->whereNotIn('id', [$comingId, $currentId]);
		         

    @endphp

    @if($filteredIssues->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>{{ $volume->name }}</th>
                    @foreach($filteredIssues as $iss)
                        <td>
                            <strong>{{ $iss->name }}</strong>
                            <span id="archives_h"> {{ $iss->edition }} Page No.{{ $iss->pages }}</span>
                            <hr>
                            <table>
                                <tr>
                                    <td>
                                        <div id="archives_p">
                                            <i class="fa fa-list-alt" id="archives_icons"></i>
                                            <a href="{{ url('/') }}/toc/{{ $volume->alias }}/{{ $iss->alias }}" id="archives_a">&nbsp;&nbsp; Table of Contents</a>
                                        </div>
                                        <div id="archives_p2">
                                            <i class="fa fa-book" id="archives_icons"></i>
                                            <a href="{{ url('/') }}/ebook/{{ $volume->alias }}/{{ $iss->alias }}" id="archives_a">&nbsp;&nbsp; View issue as Ebook</a>
                                        </div>
                                        <div id="archives_p2">
                                            <i class="fa fa-rss" id="archives_icons"></i>
                                            <a href="{{ url('/') }}/feed/{{ $volume->alias }}/{{ $iss->alias }}" id="archives_a" target="_blank">&nbsp;&nbsp; rss</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @endforeach
                </tr>
            </table>
        </div>
    @endif
@endforeach
