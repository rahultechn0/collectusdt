
<footer class="footer-section">
        <div class="container">
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo mb-20">
                                <a href="index.html"><img src="{{asset('bitsair/img/logo.png')}}" class="img-fluid" alt="bits-air-logo"></a>
                            </div>
                            <div class="footer-text">
                                <p>&nbsp;</p>
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a target="_blank" href="https://www.facebook.com/bitsair/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://twitter.com/bitsairofficial"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://www.instagram.com/invites/contact/?i=4b5tu7100uf0&utm_content=lp7bf6w"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget" style="display: none;">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">about</a></li>
                                <li><a href="#">services</a></li>
                                <li><a href="#">portfolio</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Our Services</a></li>
                                <li><a href="#">Expert Team</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Latest News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Subscribe</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                            </div>
                            @if(Session::has('message_1'))
                                <p class="alert {{ Session::get('alert-class_1', 'alert-info') }}">{{ Session::get('message_1') }}</p>
                            @endif
                            <div class="subscribe-form">
                                

                                {!! Form:: open(["url"=>"saveNewslatter","autocomplete"=>"off","method"=>"POST" ]) !!}
                                    <input type="email" placeholder="Email Address" name="news_email" required="required">
                                    @error('news_email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <button type="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 text-center">
                        <div class="copyright-text">
                            <p>Copyright &copy; @php echo date('Y'); @endphp, All Right Reserved <a href="{{ route('index') }}">BitsAir</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>

<script src="{{asset('bitsair/js/jquery.min.js')}}"></script>
<script src="{{asset('bitsair/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('bitsair/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bitsair/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('bitsair/js/script.js')}}"></script>
<script src="{{asset('bitsair/js/jquery.min.js')}}"></script>
<script src="{{asset('bitsair/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('bitsair/js/chart.min.js')}}"></script>
<script src="{{asset('bitsair/js/chart-area-demo.js')}}"></script>
<script src="{{asset('bitsair/js/chart-pie-demo.js')}}"></script>




</body>
</html>