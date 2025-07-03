<div class="form-group row">
    <label class="col-sm-2 col-form-label">Widget Name <span class="red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', isset($widget) ? $widget->name : '') }}" required>

    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Layout Type <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="layout_type" class="form-control" required>
        <option value="1" {{ old('layout_type', isset($widget) ? $widget->layout_type : '') == '1' ? 'selected' : '' }}>Left Sidebar</option>
        <option value="2" {{ old('layout_type', isset($widget) ? $widget->layout_type : '') == '2' ? 'selected' : '' }}>Right Sidebar</option>
        </select>
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Order <span class="red">*</span></label>
    <div class="col-sm-10">
       <input type="text" name="order" class="form-control" placeholder="Order" value="{{ old('order', isset($widget) ? $widget->order : '') }}" required>
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
        <textarea name="description" id="editorId" class="form-control" placeholder="Description">{{ old('description', isset($widget) ? $widget->description : '') }}</textarea>
    </div>
</div>



<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="status" class="form-control" required>
        <option value="0" {{ old('status', isset($widget) ? $widget->status : '') == '0' ? 'selected' : '' }}>Publish</option>
        <option value="1" {{ old('status', isset($widget) ? $widget->status : '') == '1' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</div>