<div class=" row">
    <div class="col-md-6 form-group">

        <label class="col-form-label">Title <span class="red">*</span></label>
        <div class="">
            <textarea name="title" id="title_id" class="form-control" placeholder="Title" required>{{ old('title', isset($article) ? $article->title : '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6 form-group">
        <label class="col-form-label">Page Slug </label>
        <div class="">
            <input type="text" id="url" name="url" class="form-control" value="{{ old('url', isset($article) ? $article->url : '') }}" required>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12 form-group">

        <label class="col-form-label">Description</label>
        <div class="">
            <textarea name="description" id="description_id" class="form-control" placeholder="Description">{{ old('description', isset($article) ? $article->description : '') }}</textarea>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <div class="col-form-label">Article Type <span class="red">*</span></div>
        <div class="">
            <select id="article_type_id" name="article_type_id" class="form-control" required>
                <option value="">Select Article Type</option>
                @foreach($articleTypes as $id => $name)
                <option value="{{ $id }}" {{ old('article_type_id', isset($article) ? $article->article_type_id : '') == $id ? 'selected' : '' }}>{{ $name }}</option>

                {{ $name }}
                </option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group col-md-6">
        <label class="col-form-label">DOI </label>
        <div class="">
            <input type="text" id="doi" name="doi" class="form-control" value="{{ old('doi', isset($article) ? $article->doi : '') }}">

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">
        <div class="col-form-label">Volume <span class="red">*</span></div>
        <div class="">
            <select id="volumeId" name="volume" class="form-control" onchange="getNumber()" required>
                <option value="">Select Volume</option>
                @foreach($volumes as $id => $name)
                <option value="{{ $id }}" {{ old('volume', isset($article) ? $article->volume : '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 form-group">
        <div class="col-form-label">Issue <span class="red">*</span></div>
        <div class="">
            <select id="issue_id" name="number" class="form-control" required>
                <option value="">Select Volume</option>
                @foreach($issues as $id => $name)

                <option value="{{ $id }}" {{ old('number', isset($article) ? $article->number : '') == $id ? 'selected' : '' }}>{{ $name }}</option>

                @endforeach
            </select>
        </div>
    </div>
</div>

<h1 class="heading-3">Affiliation's</h1>
<div class="divider-3"> <span></span></div>

<div class="row">
    <div class="col-md-12 form-group">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Inst. Addr Inst. Name</th>
                        <th>Inst. City Inst. Pincode</th>
                        <th>Inst. State Inst. Country</th>
                        <th>Inst. Faxno </th>
                        <th>Inst. Mobile Inst. Tel.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ffrow">
                   @if(isset($article->affiliation) and count($article->affiliation) > 0)
                     @php $i=1; @endphp
                      @foreach($article->affiliation as $aff)
                    <tr>
                    <td>
							<input type="text" name="department[]" class="form-control" placeholder="Department" style="margin-bottom:4px"
                                value="{{$aff->department}}">
								
							<input type="text" name="aid[]" class="form-control" placeholder="Affiliation ID" style="margin-bottom:4px"
                                value="{{$i}}">
                        </td>
                        <td>
						    <input type="text" name="inst_address[]" class="form-control" placeholder="Address" style="margin-bottom:4px"
                                value="{{$aff->inst_address}}">
								
							<input type="text" name="inst_name[]" class="form-control" placeholder="instname" style="margin-bottom:4px"
                                value="{{$aff->inst_name}}">
                            
                        </td>
                        <td>
						
						    <input type="text" name="inst_city[]" class="form-control" placeholder="City" style="margin-bottom:4px"
                                value="{{$aff->inst_city}}">
								
							<input type="text" name="pincode[]" class="form-control" placeholder="pincode" style="margin-bottom:4px"
                                value="{{$aff->pincode}}">
                          
                        </td>
                        <td>
						
						    <input type="text" name="state[]" class="form-control" placeholder="state" style="margin-bottom:4px"
                                value="{{$aff->state}}">
								
							<input type="text" name="country[]" class="form-control" placeholder="country" style="margin-bottom:4px"
                                value="{{$aff->country}}">
                            
                        </td>
                        <td>
						    <input type="text" name="fax[]" class="form-control" placeholder="fax" style="margin-bottom:4px"
                                value="{{$aff->fax}}">
								
							<input type="text" name="mobile[]" class="form-control" placeholder="mobile" style="margin-bottom:4px"
                                value="{{$aff->mobile}}">
                           
                        </td>
                        <td>
						
						   <input type="text" name="inst_tel[]" class="form-control" placeholder="tel" style="margin-bottom:4px"
                                value="{{$aff->inst_tel}}">
                        </td>
                          @if($i > 1)
                            <td><a  href="javascript:void(0)" id="femover" class="btn btn-danger">-</a></td>
                            </tr>
                            @else 
                            <td><a  href="javascript:void(0)" id="fddr" class="btn btn-success">+</a></td>
                                </tr>
                            @endif
                        
                        @php $i++; @endphp
                    @endforeach
                   @endif
                   
               </tbody>

            </table>
        </div>
    </div>
</div>

<h1 class="heading-3">Author's</h1>
<div class="divider-3"> <span></span></div>

<div class="row">
    <div class="col-md-12 form-group">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Correspond</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Affiliation</th>
                        <th>Email</th>
                        <th>Orcid Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ddrow">
                    @if(isset($article->author) and count($article->author) > 0)
                    @php $j=1; @endphp
                    @foreach($article->author as $ath)
                    <tr>
                        <td>
                            <input type="checkbox" name="correspond_author[{{$j}}]" value="Yes" {{ ($ath->correspond_author=="Yes")? "checked" : "" }}>
                        </td>


                        <td><input type="text" id="f_name" name="f_name" class="form-control" value="{{$ath->f_name}}"></td>
                        <td><input type="text" name="m_name[]" class="form-control" placeholder="Mname" value="{{$ath->m_name}}"></td>
                        <td><input type="text" name="l_name[]" class="form-control" placeholder="Lname" value="{{$ath->l_name}}"></td>
                        <td><input type="text" name="affiliation[]" class="form-control" placeholder="Affiliation" value="{{$ath->affiliation}}"></td>
                        <td><input type="email" name="email[]" class="form-control" placeholder="Email" value="{{$ath->email}}"></td>
                        <td><input type="text" name="orcid_id[]" class="form-control" placeholder="Orcid Id" value="{{$ath->orcid_id}}"></td>
                        @if($j > 1)
                        <td><a href="javascript:void(0)" id="remover" class="btn btn-danger">-</a></td>
                    </tr>
                    @else
                    <td><a href="javascript:void(0)" id="addr" class="btn btn-success">+</a></td>
                    </tr>
                    @endif
                    @php $j++; @endphp
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<h1 class="heading-3">Abstract, Citation and Keywords</h1>
<div class="divider-3"> <span></span></div>

<div class="form-group row">
    <div class="col-md-12 form-group">

        <label class="col-form-label">Abstract <span class="red">*</span></label>
        <div class="">
            <textarea id="abstract" name="abstract" class="form-control" required>{{ old('abstract', isset($article) ? $article->abstract : '') }}</textarea>

        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12 form-group">

        <label class="col-form-label">Keywords <span class="red">*</span></label>
        <div class="">
            <input type="text" id="keywords" name="keyword" class="form-control" value="{{ old('keyword', isset($article) ? $article->keyword : '') }}" required>

        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6 form-group">

        <label class="col-form-label">Article Citation</label>
        <div class="">
            <textarea id="article_citation" name="article_citation" class="form-control">{{ old('article_citation', isset($article) ? $article->article_citation : '') }}</textarea>

        </div>
    </div>

    <div class="col-md-6 form-group">

        <label class="col-form-label">URL Citation</label>
        <div class="">
            <textarea id="url_citation" name="url_citation" class="form-control">{{ old('url_citation', isset($article) ? $article->url_citation : '') }}</textarea>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">

        <label class="col-form-label">MLA</label>
        <div class="">
            <textarea id="mla" name="mla" class="form-control">{{ old('mla', isset($article) ? $article->mla : '') }}</textarea>

        </div>
    </div>

    <div class="col-md-6 form-group">

        <label class="col-form-label">APA</label>
        <div class="">
            <textarea id="apa" name="apa" class="form-control">{{ old('apa', isset($article) ? $article->apa : '') }}</textarea>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 form-group">

        <label class="col-form-label">AMA</label>
        <div class="">
            <textarea id="ama" name="ama" class="form-control">{{ old('ama', isset($article) ? $article->ama : '') }}</textarea>

        </div>
    </div>

    <div class="col-md-6 form-group">

        <label class="col-form-label">Chicago</label>
        <div class="">
            <textarea id="chicago" name="chicago" class="form-control">{{ old('chicago', isset($article) ? $article->chicago : '') }}</textarea>

        </div>
    </div>
</div>

<h1 class="heading-3">Page No. and Pdf</h1>
<div class="divider-3"> <span></span></div>

<div class="row">
    <div class="col-md-6 form-group">
        <div class="col-form-label">Page No</div>
        <div class="">
            <input type="text" id="page_no" name="page_no" class="form-control" value="{{ old('page_no', isset($article) ? $article->page_no : '') }}">

        </div>
    </div>

    <div class="form-group col-md-6">
        <label class="col-form-label">Upload PDF</label>
        <div class="">
            @if(isset($row->upload_pdf) && !empty($row->upload_pdf))

            <div class="col-lg-5">
                <input type="file" id="upload_pdf" name="upload_pdf" class="form-control-file">

            </div>
            <div class="col-lg-2">
                <a href="{{url('pdf').'/'.$article->pdf_locate.'/'.$article->upload_pdf }}" title="download Pdf"><i>Pdf<i class="fa fa-download"></i></a>
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="upload_pdf" name="upload_pdf" class="form-control-file">
            </div>
            @endif
        </div>
    </div>
</div>


<h1 class="heading-3">Dates</h1>
<div class="divider-3"> <span></span></div>

<div class="row">
    <div class="col-md-4 form-group">
        <div class="col-form-label">Received</div>
        <div class="">
            <input type="text" id="received" name="received" class="form-control" value="{{ old('received', isset($article) ? $article->received : '') }}">

        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Accepted</div>
        <div class="">
            <input type="text" id="accepted" name="accepted" class="form-control" value="{{ old('accepted', isset($article) ? $article->accepted : '') }}">
        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Pub Date O</div>
        <div class="">
            <input type="text" id="pub_date_o" name="pub_date_o" class="form-control" value="{{ old('pub_date_o', isset($article) ? $article->pub_date_o : '') }}">

        </div>
    </div>


</div>

<div class="row">

    <div class="col-md-4 form-group">
        <div class="col-form-label">Pub Date p</div>
        <input type="text" id="pub_date_p" name="pub_date_p" class="form-control" value="{{ old('pub_date_p', isset($article) ? $article->pub_date_p : '') }}">

    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Plagiarism Check Date</div>
        <div class="">
            <input type="text" id="plagrism_check_date" name="plagrism_check_date" class="form-control" value="{{ old('plagrism_check_date', isset($article) ? $article->plagrism_check_date : '') }}">

        </div>
    </div>
</div>

<h1 class="heading-3">Reviewer Info</h1>
<div class="divider-3"> <span></span></div>

<div class="row">

    <div class="col-md-3 form-group">
        <div class="col-form-label">First Reviewer Name</div>
        <div class="">
            <input type="text" id="first_reviewer" name="first_reviewer" class="form-control" value="{{ old('first_reviewer', isset($article) ? $article->first_reviewer : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">First Reviewer Email</div>
        <div class="">
            <input type="text" id="first_rev_email" name="first_rev_email" class="form-control" value="{{ old('first_rev_email', isset($article) ? $article->first_rev_email : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">First Reviewer Orcid</div>
        <div class="">
            <input type="text" id="first_rev_orcid_id" name="first_rev_orcid_id" class="form-control" value="{{ old('first_rev_orcid_id', isset($article) ? $article->first_rev_orcid_id : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">First Reviewer Publons</div>
        <div class="">
            <input type="text" id="first_rev_publons" name="first_rev_publons" class="form-control" value="{{ old('first_rev_publons', isset($article) ? $article->first_rev_publons : '') }}">

        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-3 form-group">
        <div class="col-form-label">Second Reviewer Name</div>
        <div class="">
            <input type="text" id="second_reviewer" name="second_reviewer" class="form-control" value="{{ old('second_reviewer', isset($article) ? $article->second_reviewer : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">Second Reviewer Email</div>
        <div class="">
            <input type="text" id="sec_rev_email" name="sec_rev_email" class="form-control" value="{{ old('sec_rev_email', isset($article) ? $article->sec_rev_email : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">Second Reviewer Orcid</div>
        <div class="">
            <input type="text" id="sec_rev_orcid_id" name="sec_rev_orcid_id" class="form-control" value="{{ old('sec_rev_orcid_id', isset($article) ? $article->sec_rev_orcid_id : '') }}">

        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="col-form-label">Second Reviewer Publons</div>
        <div class="">
            <input type="text" id="sec_rev_publons" name="sec_rev_publons" class="form-control" value="{{ old('sec_rev_publons', isset($article) ? $article->sec_rev_publons : '') }}">

        </div>
    </div>
</div>

<h1 class="heading-3">Approval Info</h1>
<div class="divider-3"> <span></span></div>


<div class="row">
    <div class="col-md-4 form-group">
        <div class="col-form-label">Final Approval Date</div>
        <div class="">
            <input type="text" id="final_approval_date" name="final_approval_date" class="form-control" value="{{ old('final_approval_date', isset($article) ? $article->final_approval_date : '') }}">

        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Final Approval By</div>
        <div class="">
            <input type="text" id="final_approval_by" name="final_approval_by" class="form-control" value="{{ old('final_approval_by', isset($article) ? $article->final_approval_by : '') }}">

        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Link</div>
        <div class="">
            <input type="text" id="final_link" name="final_link" class="form-control" value="{{ old('final_link', isset($article) ? $article->final_link : '') }}">

        </div>
    </div>


</div>

<h1 class="heading-3">Counts</h1>
<div class="divider-3"> <span></span></div>


<div class="row">
    <div class="col-md-4 form-group">
        <div class="col-form-label">Visit Count</div>
        <div class="">
            <input type="text" id="view" name="view" class="form-control" value="{{ old('view', isset($article) ? $article->view : '') }}">
        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Pdf Download Lik Count</div>
        <div class="">
            <input type="text" id="pdf_download_link" name="pdf_download_link" class="form-control" value="{{ old('pdf_download_link', isset($article) ? $article->pdf_download_link : '') }}">

        </div>
    </div>




</div>


<h1 class="heading-3">Meta Details</h1>
<div class="divider-3"> <span></span></div>

<div class="form-group row">
    <div class="form-group col-md-6">

        <label class="col-form-label">Meta Title <span class="red">*</span></label>
        <div class="">
            <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', isset($article) ? $article->meta_title : '') }}">

        </div>
    </div>

    <div class="form-group col-md-6">
        <label class="col-form-label">Meta Keyword</label>
        <div class="">
            <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{ old('meta_keyword', isset($article) ? $article->meta_keyword : '') }}">

        </div>
    </div>
</div>

<div class="form-group row">
    <div class="form-group col-md-12">

        <label class="col-form-label">Meta Description</label>
        <div class="">
            <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{ old('meta_description', isset($article) ? $article->meta_description : '') }}">

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 form-group">
        <div class="col-form-label">Category <span class="red">*</span></div>
        <div class="">

            @php
            $categories = [
            '1' => 'Chemistry And Pharmacy',
            '2' => 'Earth Science',
            '3' => 'Physics',
            '4' => 'Mathematics and Statistics'
            ]
            @endphp
            <select id="category" name="category" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)

                <option value="{{ $id }}" {{ old('category', isset($article) ? $article->category : '') == $id ? 'selected' : '' }}>{{ $name }}</option>

                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4 form-group">
        <div class="col-form-label">Publishers <span class="red">*</span></div>
        <div class="">
            @php
            $publishers = [
            '1' => 'Techno Research Publishers',
            '2' => 'Exclusive Research Publishers',
            '3' => 'Oriental Scientfic Publishing Company',
            '4' => 'Enviro Research Publishers',
            ]
            @endphp
            <select id="publisher" name="publisher_name" class="form-control" required>
                <option value="">Select Publisher</option>
                @foreach($publishers as $id => $name)

                <option value="{{ $id }}" {{ old('publisher_name', isset($article) ? $article->publisher_name : '') == $id ? 'selected' : '' }}>{{ $name }}</option>

                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">

        <label class="col-form-label">Status <span class="red">*</span></label>
        <div class="">
            @php
            $status = [
            '1' => 'Publish',
            '0' => 'Pending',
            ]
            @endphp

            <select id="status" name="status" class="form-control" required>
                <option value="">Select Publisher</option>
                @foreach($status as $id => $name)
                <option value="{{ $id }}" {{ old('status') == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</div>