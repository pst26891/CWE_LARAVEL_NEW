<script src="{{ url('/')}}/admin_assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ url('/')}}/admin_assets/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>
<div class="row">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item"><a href="{{url('/')}}/admin/issue/">Issue List</a></li>
        <li class="breadcrumb-item"><a href="#">Edit Issue</a></li>

        <li class="breadcrumb-menu">
            <ul style="list-style-type: none;">
                <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/issue/"><i class="fa fa-undo"></i> Back</a></li>
            </ul>
        </li>
    </ol>
</div>
<div class="message">
    <DIV class="row">
        <div class="col-md-12" style="color:red;">
            @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
        </div>

        <div class="col-md-12" style="color:green;">
            @if (session('success'))
            <div class="alert alert-success">
                <p class="msg"> {{ session('success') }}</p>
            </div>
            @endif
        </div>

    </DIV>

</div>

<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Issue Page</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ route('admin.issue.update', $issue->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation form-horizontal" id="issue" novalidate>

                        @csrf
                        @method('PUT') 
                        @include('admin.issue.form')

                        <div class="form-group row">

                            <div class="col-sm-2"></div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary">Update</button>

                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-danger">Reset</button>
                            </div>

                        </div>

                        <!-- </form> -->
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#create_page").validate({
        rules: {
            name: {
                minlength: 5,
                required: true,
                maxlength: 300
            },
            alias: {
                required: true,
                maxlength: 200
            },
            vstatus: {
                digits: true,
                required: true
            }
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });

    ClassicEditor.create(document.querySelector('#description_id'), {
        ckfinder: {
            uploadUrl: "{{ url('/')}}/admin_assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json",
        }
    }).catch(error => {
        console.error(error);
    });
</script>