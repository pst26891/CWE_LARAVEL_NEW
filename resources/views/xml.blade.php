<article>
  <front>
    <Journal-meta>
      <journal-id journal-id-type="publisher">{{ $article->manuscript_no }}</journal-id>
      <journal-title>{{ $setting->journal_name }}</journal-title>
      <issn pub-type="PPub">{{ $setting->journal_ppub }}</issn>
      <issn pub-type="ePub">{{ $setting->journal_epub }}</issn>
      <publisher>
        <publisher-name>{{ $article->publisher_name }}</publisher-name>
      </publisher>
    </Journal-meta>

    <article-meta>
      <article-id pub-id-type="other">{{ $setting->journal_short_name }}-{{ $article->volume_name }}-{{ $article->number }}-00{{ $article->article_id }}</article-id>

      <title-group>
        <article-title>{{ htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') }}</article-title>
      </title-group>

      <contrib-group>
        @foreach($article->author as $ath)
          @php $affs = explode(',', $ath->affliation); @endphp
          <contrib contrib-type="author">
            <name>
              <surname>{{ $ath->surname }}</surname>
              <given-names>{{ $ath->name }}</given-names>
            </name>
            @foreach($affs as $sup)
              <xref ref-type="aff" rid="aff00{{ $sup }}"><sup>{{ $sup }}</sup></xref>
            @endforeach
            @if(is_numeric($ath->correspond))
              <xref ref-type="corresp" rid="cor001">*</xref>
            @endif
          </contrib>
        @endforeach
      </contrib-group>

      @php $k = 1; @endphp
      @foreach($article->affiliation as $ath)
        <aff id="{{ $ath->author_no }}"><sup>{{ $k++ }}</sup>
          <instname>{{ trim(preg_replace("/\r|\n/", "", $ath->inst_name)) }}</instname>,
          @if($ath->department)<deptname>{{ $ath->department }}</deptname>, @endif
          @if($ath->inst_address)<instaddress>{{ $ath->inst_address }}</instaddress>, @endif
          @if($ath->inst_city)<instcity>{{ $ath->inst_city }}</instcity>, @endif
          @if($ath->pincode)<instpincode>{{ $ath->pincode }}</instpincode>, @endif
          @if($ath->country)<instcountry>{{ $ath->country }}</instcountry>@endif
        </aff>
      @endforeach

      <pub-date pub-type="ppub">
        <publicationDate>{{ $article->pub_date_p }}</publicationDate>
        @if($article->front_month)<month>{{ $article->front_month }}</month>@endif
        @if($article->front_year)<year>{{ $article->front_year }}</year>@endif
      </pub-date>

      @if($article->doi)<doi>{{ $article->doi }}</doi>@endif

      <volume>{{ $article->volumeInfo->name }}</volume>
      <issue>{{ $article->volumeInfo->name }}</issue>

      @if($article->page_no)<page>{{ $article->page_no }}</page>@endif

      <abstract>
        <title>Abstract</title>
        <p>{{ htmlspecialchars($article->abstract, ENT_QUOTES, 'UTF-8') }}</p>
      </abstract>

      <kwd-group>
        <title>Keywords</title>
        @foreach(explode(';', $article->keyword) as $key)
          <kwd>{{ $key }}</kwd>
        @endforeach
      </kwd-group>

      <counts>
        <ref-count count="{{ $article->ref_count }}" />
        <page-count count="{{ $article->page_count }}" />
      </counts>
    </article-meta>
  </front>
</article>
