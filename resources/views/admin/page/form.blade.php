<div class="form-group row">
    <label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" id="" name="title" class="form-control" placeholder="Title" value="{{ old('title', isset($page) ? $page->title : '') }}" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Page Slug </label>
    <div class="col-sm-10">
        <input type="text" name="url" class="form-control" placeholder="Page Slug" value="{{ old('url', isset($page) ? $page->url : '') }}" readonly required>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
        <textarea name="description" id="description_id" class="form-control" placeholder="Description">{{ old('description', isset($page) ? $page->description : '') }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Parent<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="parent" class="form-control" required>
            <option value="">Choose Parent</option>
            @foreach($pages as $id => $name) 
            <option value="{{ $id }}" {{ old('parent', isset($page) ? $page->parent : '') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Page Type<span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="template" class="form-control" required>
            <option value="">Choose Page Type</option>
            @foreach($templates as $key => $template)
            <option value="{{ $template }}" {{ old('template', isset($page) ? $page->template : '') == $template ? 'selected' : '' }}>{{ $template }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Meta Title <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ old('meta_title',isset($page) ? $page->meta_title : '') }}" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Meta Keyword</label>
    <div class="col-sm-10">
        <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{ old('meta_keyword', isset($page) ? $page->meta_keyword : '') }}">
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Meta Description</label>
    <div class="col-sm-10">
        <textarea name="meta_description"  class="form-control" placeholder="Meta Description">{{ old('meta_description', isset($page) ? $page->meta_description : '') }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="status" class="form-control" required>
        <option value="1" {{ old('status', isset($page) ? $page->status : '') == '1' ? 'selected' : '' }}>Publish</option>
        <option value="0" {{ old('status', isset($page) ? $page->status : '') == '0' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</div>

