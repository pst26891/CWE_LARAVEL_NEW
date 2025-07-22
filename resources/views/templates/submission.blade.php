<div class="col-md-12 quick-submission">
    <p><strong>For queries related to submission kindly whatsapp at +919826093932</strong></p>
</div>
<!-- Include Dropzone CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<div class="col-md-12" style="border-top:2px solid #000;padding-top:15px">
    <p style="font-size: 18px; font-weight:bold;margin-left: -15px;">Submit Manuscript</p>
    <p style="margin-left: -15px; font-style: italic;">Note:please mention 3 reviewer in your manuscript document.</p>

    <div class="message">
        <DIV class="row">
            <div class="col-md-12" style="color:red; margin-bottom: 10px; font-size:16px">
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
    <div class="clearfix"></div>
    <form method="POST" action="{{ url('/')}}/submission/saveSubmission" class="form-contact comment_form" id="commentForm" enctype="multipart/form-data">

        @csrf
        <!-- Type of Article -->
        <div class="form-group form-section">
            <label class="form-label">Type of Article *</label>
            <select class="form-control" name="article_type" required>
                <option value="">Select</option>
                <option value="Research Article">Research Article</option>
                <option value="Review Article">Review Article</option>
            </select>
        </div>

        <!-- Article Title -->
        <div class="form-group form-section">
            <label class="form-label">Article Title *</label>
            <input type="text" name="article_title" class="form-control" required>
        </div>

        <!-- Corresponding Author Name -->
        <div class="form-group form-section">
            <label class="form-label">Name of Corresponding Author *</label>
            <div class="row g-2">
                <div class="col-md-4"><input type="text" name="corr_authur_fname" class="form-control" placeholder="First Name" required></div>
                <div class="col-md-4"><input type="text" name="corr_author_mname" class="form-control" placeholder="Middle Name"></div>
                <div class="col-md-4"><input type="text" name="corr_author_lname" class="form-control" placeholder="Last Name" required></div>
            </div>
        </div>

        <!-- Corresponding Author Email -->
        <div class="form-group form-section">
            <label class="form-label">Email of Corresponding Author *</label>
            <input type="email" name="corr_author_email" class="form-control" required>
        </div>

        <!-- Co-Authors -->
        <div class="form-group form-section">
            <label class="form-label">Name and Email of Co-Author(s)</label>
            <div id="co-author-list">
                <div class="row co-author-row g-2">
                    <div class="col-md-3"><input type="text" name="co_author_fname" class="form-control" placeholder="First Name"></div>
                    <div class="col-md-3"><input type="text" name="co_author_mname" class="form-control" placeholder="Middle Name"></div>
                    <div class="col-md-3"><input type="text" name="co_author_lname" class="form-control" placeholder="Last Name"></div>
                    <div class="col-md-3 d-flex">
                        <input type="email" name="co_author_email" class="form-control me-2" placeholder="Email">
                        <button type="button" class="remove_btn" onclick="removeCoAuthor(this)">−</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-2" onclick="addCoAuthor()">+ Add Co-Author</button>
        </div>

        <!-- Contact Number -->
        <div class="form-group form-section">
            <label class="form-label">Contact Number of Corresponding Author *</label>
            <input type="text" name="corr_author_contact" class="form-control" required>
        </div>

        <!-- Country -->
        <div class="form-group form-section">
            <label class="form-label">Country *</label>
            <select name="country" class="form-select form-control" required>
                <option value="">Select Your Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <!-- Add more countries as needed -->
            </select>
        </div>

        <!-- File Upload -->
        
        <!-- File Upload -->
        <div class="form-section">
            <label class="form-label">Upload Your Article in MS Word format and all Figures in JPEG/PNG format *</label>

            <div id="file-dropzone" class="dropzone"></div>

            <input type="hidden" name="uploaded_files" id="uploaded_files">
        </div>

        <!-- Message -->
        <div class="form-group form-section">
            <label class="form-label">Message *</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <!-- Declaration -->
        <div class="form-group form-section">
            <div class="form-check">
                <input type="checkbox" name="first_check" class="form-check-input" required>
                <label class="form-check-label">
                    Authors are aware that the figures cannot be reused from previously published material without permission from the copyright owner.
                </label>
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" name="second_check" class="form-check-input" required>
                <label class="form-check-label">
                    The authors confirm that the article including text, figures and tables, has neither been published before nor is under consideration elsewhere.
                </label>
            </div>

            
        </div>

        <div class="form-group mt-3">
            <label>
                What is {{ $captcha }}
                <input type="text" name="captcha_answer" required>
            </label>
            @if ($errors->has('captcha_answer'))
            <div class="text-danger">{{ $errors->first('captcha_answer') }}</div>
            @endif
        </div>

        <div class="col-xs-6"></div>
        <div class="col-xs-6">
            <div class="form-group">

                <button type="submit" class="button button-contactForm">Send </button>

            </div>
        </div>
    </form>
</div>



<div class="clearfix"></div>
<hr>

<ul class="submission-inline" style="padding-left:0; list-style:none;">
    <li class="list-group-item" style="display:inline-block; margin-right:10px;">
        <a href="{{ url('/').'/uploads/'.$setting->author_guide }}" target="_blank">
            <ion-icon name="cloud-download-outline"></ion-icon> Click here to download Authors Guidelines
        </a>
    </li>
    <li class="list-group-item" style="display:inline-block; margin-right:10px;">
        <a href="{{ url('/').'/uploads/'.$setting->copyright_form_doc }}" target="_blank">
            <ion-icon name="cloud-download-outline"></ion-icon> Click here to download copyright form
        </a>
    </li>
    <li class="list-group-item" style="display:inline-block;">
        <a href="{{ url('/').'/uploads/'.$setting->manuscript_guide }}" target="_blank">
            <ion-icon name="cloud-download-outline"></ion-icon> Click here to download Manuscript Guide
        </a>
    </li>
</ul>

<script>
    function addCoAuthor() {
        const row = document.createElement('div');
        row.className = 'row co-author-row g-2';
        row.innerHTML = `
      <div class="col-md-3"><input type="text" name="corr_author_fname" class="form-control" placeholder="First Name"></div>
      <div class="col-md-3"><input type="text" name="corr_author_mname" class="form-control" placeholder="Middle Name"></div>
      <div class="col-md-3"><input type="text" name="corr_author_lname" class="form-control" placeholder="Last Name"></div>
      <div class="col-md-3 d-flex">
        <input type="email" name="corr_author_email" class="form-control me-2" placeholder="Email">
        <button type="button" class="remove_btn" onclick="removeCoAuthor(this)">−</button>
      </div>`;
        document.getElementById('co-author-list').appendChild(row);
    }

    function removeCoAuthor(button) {
        const row = button.closest('.co-author-row');
        row.remove();
    }

    Dropzone.autoDiscover = false;

  const uploadedFiles = [];

  const myDropzone = new Dropzone("#file-dropzone", {
    url: "/upload-placeholder", // Replace with actual upload endpoint or dummy
    autoProcessQueue: false,    // Don't auto-upload
    addRemoveLinks: true,
    maxFilesize: 5, // MB
    acceptedFiles: ".doc,.docx,.jpeg,.jpg,.png",
    dictDefaultMessage: "Drop files here or click to select files",
    init: function () {
      this.on("addedfile", function (file) {
        uploadedFiles.push(file.name);
        document.getElementById('uploaded_files').value = uploadedFiles.join(',');
      });
      this.on("removedfile", function (file) {
        const index = uploadedFiles.indexOf(file.name);
        if (index > -1) {
          uploadedFiles.splice(index, 1);
          document.getElementById('uploaded_files').value = uploadedFiles.join(',');
        }
      });
    }
  });
</script>

<div class="clearfix"></div>

<div class="submission"> </div>