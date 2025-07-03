<div class="form-group row">
    <label class="col-sm-2 col-form-label">Volume</label>
    <div class="col-sm-10">
        <select name="volume_id" class="form-control" required>
            <option value="">Choose Volume</option>
            @foreach($volumes as $key => $volume)
            <option value="{{ $key }}" {{ old('volume_id', isset($issue) ? $issue->volume_id : '') == $key ? 'selected' : '' }}>{{ $volume }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Issue Name <span class="red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', isset($issue) ? $issue->name : '') }}"  required>

    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alias <span class="red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="alias" class="form-control" placeholder="Alias" value="{{ old('alias', isset($issue) ? $issue->alias : '') }}"  required>
        <span style="color:red">Note-(Exp: if Issue N than type only N. Exp2 - <b>Issue2</b> then type only <b>2</b>)</span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">If it is special Issue than define Issue Topic </label>
    <div class="col-sm-10">
        <input type="text" name="issue_topic" class="form-control" placeholder="issue topic" value="{{ old('issue_topic', isset($issue) ? $issue->issue_topic : '') }}"  >

    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Edition </label>
    <div class="col-sm-10">
        <input type="text" name="edition" class="form-control" placeholder="edition" value="{{ old('edition', isset($issue) ? $issue->edition : '') }}"  >

    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Pages </label>
    <div class="col-sm-10">
        <input type="text" name="pages" class="form-control" placeholder="pages" value="{{ old('pages', isset($issue) ? $issue->pages : '') }}"  >
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Ebook Iframe </label>
    <div class="col-sm-10">
        <textarea name="ebook" class="form-control" placeholder="Ebook">{{ old('ebook', isset($issue) ? $issue->ebook : '') }}</textarea>

    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Cover Later</label>
    <div class="col-sm-10">
        @if(isset($issue->cover) && $issue->cover!='')
        <div class=""><img src="{{ asset('storage/uploads/' . $issue->cover) }}" style="width:80px; height:80px" /></div>
        <input type="file" name="cover" class="" value="{{$issue->cover}}">
        @else
        <input type="file" name="cover" class="">
        @endif


    </div>

</div>



<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="red">*</span></label>
    <div class="col-sm-10">
        <select name="status" class="form-control" required>
            <option value="0" {{ old('status', isset($issue) ? $issue->status : '') == '0' ? 'selected' : '' }}>Publish</option>
            <option value="1" {{ old('status', isset($issue) ? $issue->status : '') == '1' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</div>