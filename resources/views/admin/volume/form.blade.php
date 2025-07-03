<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name <span class="red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', isset($volume) ? $volume->name : '') }}" required>

    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alias <span class="red">*</span></label>
    <div class="col-sm-10">
       <input type="text" name="alias" class="form-control" placeholder="Alias" value="{{ old('alias', isset($volume) ? $volume->alias : '') }}" required>
        <span style="color:red">Note-(Exp: if Volume N than type only N)</span>
    </div>
</div>



<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
    <div class="col-sm-10">
        <select name="status" class="form-control" required>
        <option value="0" {{ old('status', isset($page) ? $volume->status : '') == '0' ? 'selected' : '' }}>Publish</option>
        <option value="1" {{ old('status', isset($page) ? $volume->status : '') == '1' ? 'selected' : '' }}>Pending</option>
        </select>
    </div>
</div>