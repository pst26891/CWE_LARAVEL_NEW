
<script src="{{ url('/')}}/admin_assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ url('/')}}/admin_assets/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>
<div class="row">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item"><a href="{{url('/')}}/admin/issue/">Issue List</a></li>
        <li class="breadcrumb-item"><a href="#">Add Issue</a></li>

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

        <div class="col-md-12" style="color:red;">
            @if (session('error'))
            <div class="alert alert-danger">
                <p class="msg"> {{ session('error') }}</p>
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
                    <div class="ibox-title">Add Issue</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                </div>
                <div class="ibox-body">
                    <form action="{{ url('/')}}/admin/issue/store" method="post" id="create_volume" role="form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        @include('admin.issue.form')

                        <div class="form-group row">

                            <div class="col-sm-2"></div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary">Create</button>

                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-danger">Reset</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(function() {
        jQuery.validator.addMethod("numberdash", function(value, element) {
            return this.optional(element) || /^[0-9\-]+$/.test(value);
        }, "Please enter Number and Dash only.");

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, $.validator.format("Uploaded file size should be less than or equal to 50 MB)."));



        $("#create_volume").validate({
            rules: {
                parent: {
                    required: true
                },
                name: {
                    minlength: 5,
                    required: true,
                    maxlength: 300
                },
                alias: {
                    required: true,
                    maxlength: 200
                },
                issue_topic: {
                    maxlength: 300
                },
                edition: {
                    maxlength: 200
                },
                pages: {
                    numberdash: true,
                    maxlength: 100
                },
                cover: {
                    extension: 'PDF|pdf|jpeg|jpg|png',
                    filesize: 52428800

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

    });
</script>