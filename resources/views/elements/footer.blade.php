<footer>
    <div class="footer-area pt-50 bg-white">
        <div class="container">
            <div class="row pb-30">

                <div class="col">
                    <h5>ADDRESS</h5>
                    <p><span class="mr-5">
                            <ion-icon name="location-outline"></ion-icon>
                        </span><strong>Address</strong>: {{$setting->foo_address}}</p>
                    <p><span class="mr-5">
                            <ion-icon name="call-outline"></ion-icon>
                        </span><strong>Mobile</strong>: {{$setting->foo_mobile}}</p>
                    <p><span class="mr-5">
                            <ion-icon name="mail-outline"></ion-icon>
                        </span><strong>Email</strong>: {{$setting->foo_email}}</p>
                </div>

                <div class="col">
                    <h5>LINKS</h5>
                    <ul class="float-left mr-30 font-medium">
                        @foreach($fooNavItems as $item)
                        <li class="cat-item cat-item-2"><a href="{{ url($item->slug) }}" target="{{ $item->target }}">{{ $item->title }}</a></li>

                        @endforeach

                    </ul>
                </div>



                <div class="col">
                    <h5>Contact Us</h5>
                    <ul class="">

                        <div class="footer-contact-form">

                            @if (session('success'))
                            <div class=" alert-success">
                                <p class="msg"> {{ session('success') }}</p>
                            </div>
                            @endif
                            <form action="{{ url('/')}}/contact/saveContact" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label>Your Name (required)</label>
                                    <input type="text" name="yname" class="form-control" placeholder="Your Name" style="height: 36px;">
                                </div>

                                <div class="mb-1">
                                    <label>Your Email (required)</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" style="height: 36px;">
                                </div>

                                <div class="mb-1">
                                    <label>Phone Number</label>
                                    <input type="text" name="pnumber" class="form-control" placeholder="Phone Number" style="height: 36px;">
                                </div>

                                <div class="mb-1">
                                    <label>Message (required)</label>
                                    <textarea name="comment" rows="4" class="form-control" placeholder="Comment" ></textarea>
                                </div>

                                <div class="mb-1">
                                    <label>What is {{ $captcha }}</label>
                                    <input type="text" name="captcha_answer" class="form-control" style="height: 36px;">
                                </div>

                                <button type="submit" class="footer-btn">
                                    Send
                                </button>

                            </form>
                        </div>
                    </ul>
                </div>

                <div class="col">
                    <h5>Google Page Rank</h5>

                    <img src="{{url('/')}}/assets/imgs/footer/footer_img.gif" class="img-responsive" />
                    <div class="clearfix"></div>

                    <div style="height:10px;"></div>

                    <div id="footer_h">LICENSE:</div>
                    <div class="border_heading"></div>
                    <div style="height:10px;"></div>
                    <img src="{{url('/')}}/assets/imgs/footer/fooimg.png" class="img-responsive" />
                    <div id="footer_sec">This work is licensed under a <a href="https://creativecommons.org/licenses/by/4.0/" target="_bank">Creative Commons Attribution 4.0 International License.</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area bg-white text-muted">
        <div class="container">
            <div class="footer-border pt-20 pb-20">
                <div class="row d-flex mb-15">
                    <div class="col">
                        <ul class="list-inline font-small">
                            <li class="list-inline-item"><a href="category.html">Disclaimer</a></li>
                            <li class="list-inline-item"><a href="category.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="category.html">Term and Condition</a></li>

                        </ul>
                    </div>

                    <div class="col">
                        <div class="footer-copy-right">
                            <p class="font-small text-muted">© <?php echo date("Y"); ?>, Current World Environment | All rights reserved </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>