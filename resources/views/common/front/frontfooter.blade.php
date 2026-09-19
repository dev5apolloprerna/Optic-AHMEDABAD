<!-- footer start  -->
<style>

.footer-bottom-bar {
    width: 100%;
    padding: 10px 0;
    background: #ff4b0b;
}

.footer-bottom-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.footer-copyright {
    margin: 0;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.5;
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-bottom-links a {
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
}

.footer-bottom-links span {
    color: rgba(255, 255, 255, 0.7);
}

.footer-bottom-links a:hover {
    color: #082f63;
}

/* Mobile */

@media (max-width: 767px) {
    .footer-bottom-bar {
        padding: 12px 0;
    }

    .footer-bottom-inner {
        flex-direction: column;
        justify-content: center;
        gap: 5px;
        text-align: center;
    }

    .footer-copyright {
        font-size: 13px;
    }

    .footer-bottom-links {
        justify-content: center;
        gap: 7px;
    }

    .footer-bottom-links a {
        font-size: 13px;
    }
}
</style> 

<section class="f-clr">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div>
                    <ul class="footer-txt">
                        <p class="fo-txt logo">
                            <a href="https://opticexhibition.com/jaipur/index.php">
                                <img src="{{ asset('assets/front/img/optic-2024.png') }}" alt=""></a>
                        </p>
                        <div class="text-white"> We are pleased to inform you OPTIC EXPO –
                            A business platform and networking forum is scheduled to take place on 3-4-5th October 2026. It has proven its value to be one of the biggest... </div>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <ul class="footer-txt">
                        <p class="fo-txt">QUICK LINKS</p>
                        <li>
                            <a href="{{ route('FrontIndex') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Home </a>
                        </li>
                        <li>
                            <a href="{{ route('FrontAbout') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> About Optic Expo </a>
                        </li>
                        <li>
                            <a href="{{ route('FrontExhibitor_Profile') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Exhibitor Profile </a>
                        </li>
                        <li>
                            <a href="{{ route('visitors_profile') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Visitor Profile </a>
                        </li>
                        <li>
                            <a href="{{ route('FrontFloor_Plan') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Floor Plan </a>
                        </li>
                        <li>
                            <a href="{{ route('FrontVenue') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Venue </a>
                        </li>

                        <li>
                            <a href="{{ route('FrontContact') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Contact Us </a>
                        </li>
                        <li>
                            <a href="{{ route('FrontVisitor_Registration') }}">
                                <i style="color:#f37820 ;" class="fas fa-angle-right"></i> Register Now </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <ul class="footer-txt">
                        <p class="fo-txt">CONTACT</p>
                        <li style="color: white;font-size: 16px;">
                            <i style="color:#f37820 ;text-align: justify;" class="fas fa-map-pin"></i>
                            Aries Events Pvt. Ltd. <br />
                            Block-B, 403, Dev Aurum, <br />
                            Anandnagar Cross Road, <br />
                            Prahlad Nagar Road, <br />
                            Ahmedabad-380015.
                        </li>
                        <li>
                            <a href="tel:+919898121818">
                                <i style="color:#f37820 ;" class="fas fa-phone-alt"></i> +91 9898121818 </a>
                        </li>
                        <li>
                            <a href="mailto:opticexpoahmedabad@gmail.com">
                                <i style="color:#f37820 !important;" class="fas fa-envelope"></i>
                                opticexpoahmedabad@gmail.com </a>
                        </li>
                        <!--<a href="mailto:"></a>-->
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <p class="fo-txt">Venue Map</p>
                <div>
                    
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7684.6973364543255!2d72.5981481965733!3d23.00780766550168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e85cedfe1ecbb%3A0xe70b832deddbed49!2sEKA%20Club!5e0!3m2!1sen!2sin!4v1763801297484!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    

                </div>
            </div>
        </div>
    </div>
    
<div class="footer-bottom-bar">
    <div class="container">
        <div class="footer-bottom-inner">

            <p class="footer-copyright">
                © <span id="currentYear"></span> Optic Expo | All Rights Reserved
            </p>

            <div class="footer-bottom-links">
                <a href="{{ route('terms_condition') }}">
                    Terms & Conditions
                </a>

                <span>|</span>

                <a href="{{ route('privacy_policy') }}">
                    Privacy Policy
                </a>
            </div>

        </div>
    </div>
</div>

    
    
</section>

<script>
    var currentYear = new Date().getFullYear();

    // Update the footer content with the current year
    document.getElementById('currentYear').textContent = currentYear;
</script>
<!-- footer End  -->
@if (!request()->routeIs('FrontVisitor_Registration', 'FrontExhibitor_Login'))
<a href="{{ route('FrontBook_My_Stall') }}" class="floating-book button-4" >
   <i class="fa fa-book "></i> Book Stall
   </a>
@endif