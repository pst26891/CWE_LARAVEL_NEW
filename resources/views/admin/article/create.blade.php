
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

         <li class="breadcrumb-item"><a href="{{url('/')}}/admin/articles/">Article List</a></li>
         <li class="breadcrumb-item"><a href="#">Add Article</a></li>

         <li class="breadcrumb-menu">
             <ul style="list-style-type: none;">
                 <li> <a class="btn btn-outline-primary" href="{{url('/')}}/admin/articles/"><i class="fa fa-undo"></i> Back</a></li>
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
                     <div class="ibox-title">Add Article</div>
                     <div class="ibox-tools">
                         <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                     </div>
                 </div>
                 <div class="ibox-body">
                     <form action="{{ url('/')}}/admin/articles/store" method="post" id="create_article" role="form" class="" enctype="multipart/form-data">
                         @csrf
                         @include('admin.article.form')


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

     ClassicEditor.create(document.querySelector('#description_id'), editorConfig);
     ClassicEditor.create(document.querySelector('#title_id'), editorConfig);
 </script>

 <script type="text/javascript">
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     function getNumber() {
         var volume_id = $('#volumeId').val();
         $.ajax({
             url: "{{ url('/') }}/admin/articles/issue-by-volume",
             type: "POST",
             data: {
                 volume_id: volume_id
             },
             success: function(data) {
                 $('#issue_id').empty();
                 $('#issue_id').append('<option value="">Select Issue</option>');

                 $.each(data.issues, function(index, issue) {
                     $('#issue_id').append('<option value="' + issue.id + '">' + issue.name + '</option>');
                 })
             }
         })
     }

     $('#received').datepicker({
         format: 'yyyy-mm-dd',
     });

     $('#accepted').datepicker({
         format: 'yyyy-mm-dd',
     });

     $('#pub_date_o').datepicker({
         format: 'yyyy-mm-dd',
     });

     $('#pub_date_p').datepicker({
         format: 'yyyy-mm-dd',
     });

     $('#plagrism_check_date').datepicker({
         format: 'yyyy-mm-dd',
     });
     $('#final_approval_date').datepicker({
         format: 'yyyy-mm-dd',
     });

     jQuery(function() {

         jQuery.validator.addMethod("alphaComma", function(value, element) {
             return this.optional(element) || /^[a-zA-Z,_;\-]+$/.test(value);
         }, "Please enter character,dash,hyphan,semicolan and comma only.");

         jQuery.validator.addMethod("numberdash", function(value, element) {
             return this.optional(element) || /^[0-9\-]+$/.test(value);
         }, "Please enter Number and Dash only.");

         $.validator.addMethod('filesize', function(value, element, param) {
             return this.optional(element) || (element.files[0].size <= param)
         }, $.validator.format("Uploaded file size should be less than or equal to 50 MB)."));


         $("#create_article").validate({
             rules: {
                 title: {
                     minlength: 5,
                     required: true
                 },
                 article_type_id: {
                     required: true,
                     digits: true
                 },
                 description: {
                     minlength: 5
                 },
                 doi: {
                     maxlength: 200
                 },
                 volume: {
                     required: true,
                 },
                 number: {
                     required: true,
                 },
                 abstract: {
                     required: true,
                     minlength: 5,
                 },
                 keyword: {
                     required: true,

                 },
                 article_citation: {
                     maxlength: 300
                 },
                 url_citation: {
                     maxlength: 300
                 },
                 mla: {
                     maxlength: 300
                 },
                 apa: {
                     maxlength: 300
                 },
                 ama: {
                     maxlength: 300
                 },
                 chicago: {
                     maxlength: 300
                 },
                 page_no: {
                     numberdash: true
                 },
                 meta_title: {
                     required: true,
                 },
                 status: {
                     required: true,
                 },
                 sec_rev_publons: {
                     maxlength: 300,
                 },
                 sec_rev_orcid_id: {
                     maxlength: 300,
                 },
                 sec_rev_email: {
                     email: true
                 },
                 second_reviewer: {
                     maxlength: 200
                 },
                 first_rev_publons: {
                     maxlength: 300,
                 },
                 first_rev_orcid_id: {
                     maxlength: 300,
                 },
                 first_rev_email: {
                     email: true
                 },
                 first_reviewer: {
                     maxlength: 200,
                 },
                 upload_pdf: {
                     extension: 'PDF|pdf',
                     filesize: 52428800

                 },
                 'f_name[]': {
                     required: true,
                     maxlength: 50
                 },
                 'm_name[]': {
                     required: false,
                     maxlength: 50
                 },
                 'l_name[]': {
                     required: false,
                     maxlength: 50
                 },
                 'email[]': {
                     email: true,
                     maxlength: 200
                 },
                 'affiliation[]': {
                     required: false,
                     digits: true
                 },
                 'orcid_id[]': {
                     required: false,
                     maxlength: 300
                 },
                 'mobile[]': {
                     required: false,
                     maxlength: 10,
                     minlength: 10,
                     digits: true
                 },
                 'tel[]': {
                     required: false,
                     maxlength: 16,
                     minlength: 5,
                     digits: true
                 },
                 'fax[]': {
                     required: false,
                     maxlength: 16,
                     minlength: 2,
                 },
                 'state[]': {
                     required: false,
                     maxlength: 200,
                 },
                 'country[]': {
                     required: false,
                     maxlength: 300,
                 },
                 'pincode[]': {
                     required: false,
                     maxlength: 10,
                     digits: true
                 },
                 'instname[]': {
                     required: false,
                     maxlength: 400,
                 },
                 'aid[]': {
                     required: false,
                     maxlength: 10,
                     digits: true
                 },
                 'address[]': {
                     required: false,
                     maxlength: 400,
                 },
                 'department[]': {
                     required: false,
                     maxlength: 400,
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

     });


     $(document).ready(function() {
         var count = 1;
         dynamic_field(count);

         function dynamic_field(number) {
             var html = "<tr>";
             html += '<td><input type="checkbox" name="correspond_author[' + count + ']" value="Yes" placeholder="" class="form-control" /></td>';
             html += '<td><input type="text" name="f_name[]" placeholder="Fname" class="form-control" /></td>';
             html += '<td><input type="text" name="m_name[]" placeholder="Mname" class="form-control" /></td>';
             html += '<td><input type="text" name="l_name[]" placeholder="Lname" class="form-control" /></td>';
             html += '<td><input type="text" name="email[]" placeholder="Email" class="form-control" /></td>';
             html += '<td><input type="text" name="affiliation[]" placeholder="Affiliation" class="form-control" /></td>';
             html += '<td><input type="text" name="orcid_id[]" placeholder="Orcid Id" class="form-control" /></td>';
             if (number > 1) {
                 html += '<td><a  href="javascript:void(0)" id="remover" class="btn btn-danger">-</a></td>';
                 html += '</tr>';
                 $('#ddrow').append(html);
             } else {
                 html += '<td><a  href="javascript:void(0)" id="addr" class="btn btn-success">+</a></td>';
                 html += '</tr>';
                 $('#ddrow').append(html);
             }
         }

         $('#addr').click(function() {
             count++;
             dynamic_field(count);
         });

         $('#ddrow').on('click', '#remover', function() {
             count--;
             //  dynamic_field(count);
             $(this).parent().parent().remove();
         });

         getNumber();

     });

     $(document).ready(function() {
         var fcount = 1;
         dynamic_aff(fcount);


         function dynamic_aff(numb) {
             var html = "<tr>";
             html += '<td> <input type = "text" name = "department[]" placeholder = "Department" class = "form-control" style="margin-bottom:4px">';
             html += '<input type = "text" name = "aid[]" value="' + fcount + '" placeholder = "No" class = "form-control" readonly> </td>';
             html += '<td><input type="text" name="address[]" placeholder="Instaddress" class="form-control" style="margin-bottom:4px">';
             html += '<input type = "text" name = "instname[]" placeholder = "Instname" class = "form-control"></td>';
             html += '<td><input type="text" name="city[]" placeholder="instcity" class="form-control" style="margin-bottom:4px">';
             html += '<input type = "text" name = "pincode[]" placeholder = "Pincode" class = "form-control"> </td>';
             html += ' <td> <input type="text" name="state[]" placeholder="State" class="form-control" style="margin-bottom:4px">';
             html += ' <input type = "text"  name = "country[]" placeholder = "Country" class = "form-control"> </td>';
             html += ' <td><input type="text" name="fax[]" placeholder="Fax" class="form-control" style="margin-bottom:4px"> </td>';
             html += ' <td><input type="text" name="mobile[]" placeholder="Mobileno" class="form-control" style="margin-bottom:4px">';
             html += ' <input type = "text" name = "tel[]" placeholder = "Telno" class = "form-control"> </td>';

             if (numb > 1) {
                 html += '<td><a  href="javascript:void(0)" id="femover" class="btn btn-danger">-</a></td>';
                 html += '</tr>';
                 $('#ffrow').append(html);
             } else {
                 html += '<td><a  href="javascript:void(0)" id="fddr" class="btn btn-success">+</a></td>';
                 html += '</tr>';
                 $('#ffrow').append(html);
             }
         }

         $('#fddr').click(function() {
             fcount++;
             dynamic_aff(fcount);
         });

         $('#ffrow').on('click', '#femover', function() {
             fcount--;
             //  dynamic_field(count);
             $(this).parent().parent().remove();
         });


     });
 </script>