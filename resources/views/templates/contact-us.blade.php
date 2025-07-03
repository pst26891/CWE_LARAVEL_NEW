<main class="position-relative">
    <div class="container">

        <div class="row mb-50">
            <div class="col-lg-2 d-none d-lg-block"></div>
            <div class="col-lg-8 col-md-12">
                <div class="single-social-share single-sidebar-share mt-30">
                    <ul>
                        <li><a class="social-icon facebook-icon" href="{!! $setting->facebook !!}" target="_blank"><i class="ti-facebook"></i></a></li>
                        <li><a class="social-icon twitter-icon" href="{!! $setting->twitter !!}" target="_blank"><i class="ti-twitter-alt"></i></a></li>
                        <li><a class="social-icon pinterest-icon" href="{!! $setting->mendeley !!}" target="_blank"><i class="ti-pinterest"></i></a></li>
                        <li><a class="social-icon linkedin-icon" href="{!! $setting->linkden !!}" target="_blank"><i class="ti-linkedin"></i></a></li>
                    </ul>
                </div>

                <div class="single-excerpt">

                    <p><ion-icon name="location-outline"></ion-icon><strong> Address</strong>: {!! $setting->con_address !!}</p>
                    <p><ion-icon name="home-outline"></ion-icon><strong> Our website</strong>: www.cwejournal.org</p>
                    <p><ion-icon name="planet-outline"></ion-icon><strong> Support center</strong>: {!! $setting->con_email !!}</p>
                    <p><ion-icon name="person-circle-outline"></ion-icon><strong> Editor in Chief </strong>: Dr. Umesh Chandra Kulshrestha - <a href="mailto:umeshkulshrestha@gmail.com">umeshkulshrestha@gmail.com</a></p>
                    <p><ion-icon name="person-circle-outline"></ion-icon><strong> Co- Editor in Chief </strong>: Dr. Gopal Krishan - <a href="mailto:drgopal.krishan@gmail.com">drgopal.krishan@gmail.com</a> </p>
                    <p><ion-icon name="planet-outline"></ion-icon><strong> Publisher </strong>: <a href="mailto:publisher@enviropublishers.com">publisher@enviropublishers.com</a> </p>

                </div>

                <div class="entry-main-content mt-50">
                    <h4>For comments and suggestions please email :</h4>
                    <hr class="wp-block-separator is-style-wide">
                    <p>Please contact us for any complaints <a href="mailto:complaints@enviropublishers.com">complaints@enviropublishers.com</a>. For manuscript submission and inquiries, email <a href="mailto:info@cwejournal.org">info@cwejournal.org</a>.</p>

                    <h1 class="mt-30">Get in touch</h1>
                    <hr class="wp-block-separator is-style-wide">
                    <div class="message">
                        <div class="row">
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

                        </div>

                    </div>
                    <form method="POST" action="{{ url('/')}}/contact/saveContact" class="form-contact comment_form" id="commentForm">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="yname" id="name" type="text" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="pnumber" id="pnumber" type="text" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Message" required></textarea>
                                </div>
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
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm">Send message</button>
                        </div>
                    </form>
                </div>

                <div class="entry-bottom mt-50 mb-30">
                    <div class="single-social-share float-left">
                        <ul class="list-inline">
                        <li class="list-inline-item"><a class="social-icon facebook-icon" href="{!! $setting->facebook !!}" target="_blank"><i class="ti-facebook"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon twitter-icon" href="{!! $setting->twitter !!}" target="_blank"><i class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon pinterest-icon" href="{!! $setting->mendeley !!}" target="_blank"><i class="ti-pinterest"></i></a></li>
                        <li class="list-inline-item"><a class="social-icon linkedin-icon" href="{!! $setting->linkden !!}" target="_blank"><i class="ti-linkedin"></i></a></li>
                  
                        </ul> 
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>