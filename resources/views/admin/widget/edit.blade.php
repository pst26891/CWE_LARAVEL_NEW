<!-- PLUGINS STYLES-->

<link rel="stylesheet" href="{{ asset('admin_assets/ckeditor/ckeditor5.css') }}">

<script type="importmap">{
                "imports": {
                    "ckeditor5": "{{ asset('admin_assets/ckeditor/ckeditor5.js') }}",
                    "ckeditor5/": "{{ asset('admin_assets/ckeditor/') }}"
                }
            }
</script>

<script src="{{ url('/')}}/admin_assets/ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<div class="row">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item"><a href="{{url('/')}}/admin/widget/">Widget List</a></li>
        <li class="breadcrumb-item"><a href="#">Edit Widget</a></li>

        <li class="breadcrumb-menu">
            <ul style="list-style-type: none;">
                <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/widget/"><i class="fa fa-undo"></i> Back</a></li>
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
                    <div class="ibox-title">Widget Page</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                </div>
                <div class="ibox-body">

                  <form action="{{ route('admin.widget.update', $widget->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation form-horizontal" id="create_widget" novalidate>
						@csrf
						@method('PATCH')

						@include('admin.widget.form')

						<div class="form-group row">
							<div class="col-sm-2"></div>
							<div class="col-sm-1">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
							<div class="col-sm-2">
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</div>
					</form>

                   

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#create_widget").validate({
        rules: {
            name: {
                minlength: 5,
                required: true,
                maxlength: 300
            },
			layout_type: {
                required: true
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

</script>

<script type="module">
import {
		CKFinder,
		CKFinderUploadAdapter,
		ClassicEditor,
		AccessibilityHelp,
		AutoImage,
		Autosave,
		Bold,
		CloudServices,
		Essentials,
		FullPage,
		GeneralHtmlSupport,

		HtmlComment,
		HtmlEmbed,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsert,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		ImageUpload,
		Italic,
		Link,
		LinkImage,
		List,
		ListProperties,
		Paragraph,
		SimpleUploadAdapter,
		SourceEditing,
		Table,
		Subscript,
		Superscript,

		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		TodoList,
		Underline,
		SpecialCharacters,
		SpecialCharactersArrows,
		SpecialCharactersCurrency,
		SpecialCharactersEssentials,
		SpecialCharactersLatin,
		SpecialCharactersMathematical,
		SpecialCharactersText,
		Strikethrough,
		Undo,
		Heading,
		FontBackgroundColor,
		FontColor,
		FontFamily,
		FontSize
	} from 'ckeditor5';

	const editorConfig = {
		toolbar: {

			items: [
				'ckfinder',
				'undo',
				'redo',
				'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'underline', '|',
				'|',
				'sourceEditing',
				'showBlocks',
				'selectAll',
				'|',
				'heading',
				'|',
				'bold',
				'italic',
				'strikethrough', 'subscript', 'superscript',
				'|',
				'link',
				'insertImage',
				'insertTable',
				'htmlEmbed',
				'|',
				'bulletedList',
				'numberedList',
				'todoList',
				'|',
				'accessibilityHelp'
			],
			shouldNotGroupWhenFull: false
		},
		ckfinder: {
			// Upload the images to the server using the CKFinder QuickUpload command.
			uploadUrl: 'https://cwejournal.org/admin_assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

			// Define the CKFinder configuration (if necessary).
			options: {
				resourceType: 'Images'
			}
		},
		plugins: [
			CKFinder, CKFinderUploadAdapter,
			AccessibilityHelp,
			AutoImage,
			Autosave,
			Bold,
			CloudServices,
			Essentials,
			FullPage,
			GeneralHtmlSupport,

			HtmlComment,
			HtmlEmbed,
			ImageBlock,
			ImageCaption,
			ImageInline,
			ImageInsert,
			ImageInsertViaUrl,
			ImageResize,
			ImageStyle,
			ImageTextAlternative,
			ImageToolbar,
			ImageUpload,
			Italic,
			Link,
			LinkImage,
			List,
			ListProperties,
			Paragraph,
			Subscript,
			Superscript,
			SimpleUploadAdapter,
			SourceEditing,
			Table,
			TableCaption,
			TableCellProperties,
			TableColumnResize,
			TableProperties,
			TableToolbar,
			TodoList,
			Underline,
			SpecialCharacters,
			SpecialCharactersArrows,
			SpecialCharactersCurrency,
			SpecialCharactersEssentials,
			SpecialCharactersLatin,
			SpecialCharactersMathematical,
			SpecialCharactersText,
			Undo,
			Heading,
			FontBackgroundColor,
			FontColor,
			FontFamily,
			FontSize
		],
		heading: {
			options: [{
					model: 'paragraph',
					title: 'Paragraph',
					class: 'ck-heading_paragraph'
				},
				{
					model: 'heading1',
					view: 'h1',
					title: 'Heading 1',
					class: 'ck-heading_heading1'
				},
				{
					model: 'heading2',
					view: 'h2',
					title: 'Heading 2',
					class: 'ck-heading_heading2'
				},
				{
					model: 'heading3',
					view: 'h3',
					title: 'Heading 3',
					class: 'ck-heading_heading3'
				},
				{
					model: 'heading4',
					view: 'h4',
					title: 'Heading 4',
					class: 'ck-heading_heading4'
				},
				{
					model: 'heading5',
					view: 'h5',
					title: 'Heading 5',
					class: 'ck-heading_heading5'
				},
				{
					model: 'heading6',
					view: 'h6',
					title: 'Heading 6',
					class: 'ck-heading_heading6'
				}
			]
		},
		htmlSupport: {
			allow: [{
				name: /^.*$/,
				styles: true,
				attributes: true,
				classes: true
			}]
		},
		image: {
			toolbar: [
				'toggleImageCaption',
				'imageTextAlternative',
				'|',
				'imageStyle:inline',
				'imageStyle:wrapText',
				'imageStyle:breakText',
				'|',
				'resizeImage'
			]
		},

		link: {
			addTargetToExternalLinks: true,
			defaultProtocol: 'https://',
			decorators: {
				toggleDownloadable: {
					mode: 'manual',
					label: 'Downloadable',
					attributes: {
						download: 'file'
					}
				}
			}
		},
		list: {
			properties: {
				styles: true,
				startIndex: true,
				reversed: true
			}
		},
		placeholder: 'Type or paste your content here!',
		table: {
			contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
		}
	};

	ClassicEditor.create(document.querySelector('#editorId'), editorConfig);
    </script>