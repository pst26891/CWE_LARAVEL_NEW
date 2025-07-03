<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name <span class="red">*</span></label>
    <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alias <span class="red">*</span></label>
    <div class="col-sm-10">
        {{ Form::text('alias', null, ['class' => 'form-control', 'placeholder' => 'Alias']) }}
        <span style="color:red">Note-(Exp: if Volume N than type only N)</span>
    </div>
</div>



<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="red">*</span></label>
    <div class="col-sm-10">
        @php
        $status = [
        '1' => 'Publish',
        '0' => 'Pending',
        ]
        @endphp
        {{ Form::select('vstatus', $status, null, ['class' => 'form-control  status box-size', 'placeholder' => 'Select Status']) }}
    </div>
</div>