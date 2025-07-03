<footer>
    <div class="footer-area pt-50 bg-white">
        <div class="container">
            <div class="row pb-30">

             <div class="col">
                <h5>Reach Us</h5>
                    <p><span class="mr-5">
                            <ion-icon name="location-outline"></ion-icon>
                        </span><strong>Address</strong>: {{$setting->foo_address}}</p>
                    <p><span class="mr-5">
                            <ion-icon name="call-outline"></ion-icon>
                        </span><strong>Mobile</strong>: {{$setting->foo_mobile}}</p>
                    <p><span class="mr-5">
                            <ion-icon name="mail-outline"></ion-icon>
                        </span><strong>Support center</strong>: {{$setting->foo_email}}</p>
                </div>

                <div class="col">
                    <h5>Information</h5>
                    <ul class="float-left mr-30 font-medium">
                        @foreach($fooNavItems as $item)
                        <li class="cat-item cat-item-2"><a href="{{ url($item->slug) }}" target="{{ $item->target }}">{{ $item->title }}</a></li>

                        @endforeach

                    </ul>
                </div>

                

                  <div class="col">
                    <h5>Follow CWE</h5>
                    <ul class="float-left mr-30 font-medium">
                        
                        <li class="cat-item cat-item-2"><a href="{{$setting->facebook}}" target="_blank">facebook</a></li>
                        <li class="cat-item cat-item-2"><a href="{{$setting->linkden}}" target="_blank">Linkedin</a></li>
                        <li class="cat-item cat-item-2"><a href="{{$setting->twitter}}" target="_blank">X</a></li>


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