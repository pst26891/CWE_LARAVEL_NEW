<div class="col-md-12 quick-submission">
	<p><strong>For queries related to submission kindly whatsapp at +919826093932</strong></p>
</div>


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
	<form method="POST" action="{{ url('/')}}/submission/saveSubmission" class="form-contact comment_form" id="commentForm" enctype="multipart/form-data">

		@csrf
		<div class="form-group">
			<label>Correspond Author Name <span color="gray">(required)</span></label>
			<input type="text" name="corr_author_name" class="form-control" placeholder="Your Name" value="{{ old('corr_author_name') }}" required>
		</div>

		<div class="form-group">
			<label>Correspond Email <span color="gray">(required)</span></label>
			<input type="email" name="corr_email" class="form-control" placeholder="Your Email" value="{{ old('corr_email') }}" required>
		</div>

		<div class="form-group">
			<label>Correspond Contact Number</label>
			<input type="number" name="corr_number" class="form-control" placeholder="Your Number" value="{{ old('corr_number') }}" required>
		</div>

		<div class="form-group">
			<label>Manuscript <br> <span style="color:#308fad;font-size: 12px;"><i>Allowed file type & size pdf|docx|png|5MB. </i></span></label>
			<input type="file" name="manuscript" class="form-control" required>
		</div>


		<div class="form-group">
			<label>Copyright <br><span style="color:#308fad;font-size: 12px;"><i>Allowed file type & size PDF|jpeg|jpg|png|5MB. </i></span></label>
			<input type="file" name="copyright" class="form-control"required>

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



<div class="clearfix"></div>

<div class="submission"> </div>