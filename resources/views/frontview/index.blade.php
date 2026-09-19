@extends('layouts.front')

@section('content')
<style>
    html,
    body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        /*font-size: 14px;*/
        color: #000;
        margin: 0;
        padding: 0;
    }

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: flex-start;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        /* height: 450px; */
        object-fit: cover;
    }

    .swiper {
        margin-left: auto;
        margin-right: auto;
    }

    p .fa-phone-alt::before {}

    /*.fa-envelope::before{*/
    /*  background-color: transparent !important;*/
    /*  color: black !important;*/
    /*  margin-right: 0px !important;*/
    /*  padding: 0px 5px;*/
    /*}*/

    .s-icon {
        margin-bottom: 0px;
    }

    .s-icon li {
        display: inline;
        margin: 0px 5px;
    }

    /*.s-icon li a{*/
    /*  color: black;*/
    /*  font-size: 25px;*/
    /*}*/

    .soical-icon {
        background-color: white;
    }

    .venu-img1 {
        width: 200px;
        height:115px;
        margin: 0 20px;
        border:2px solid #f37820;
       align-items: center;
       justify-content:center;
    display: flex;
border-radius: 4px;
    }
     .venu-img1 img{border:none;align-self:center;}
     
     .home-hero-slider .third-slide-link {
    display: block;
    width: 100%;
    height: 100%;
    cursor: pointer;
    text-decoration: none;
}

.home-hero-slider .third-slide-link img {
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
}
</style>

<style>
    .memories-section{
    background:#f8f9fb;
}

.section-title span{
    color:#f37820;
    font-weight:700;
    letter-spacing:2px;
    text-transform:uppercase;
}

.section-title h2{
    font-size:42px;
    font-weight:800;
    color:#123a7b;
    margin:10px 0;
}

.section-title p{
    color:#666;
    max-width:650px;
    margin:auto;
}

.memoriesSwiper{
    padding-bottom:10px;
}

.memoriesSwiper .swiper-slide{
    border-radius:15px;
    overflow:hidden;
    cursor:pointer;
}

.memoriesSwiper img{
    width:100%;
    height:280px;
    object-fit:cover;
    transition:.5s;
    border-radius:15px;
}

.memoriesSwiper .swiper-slide:hover img{
    transform:scale(1.08);
}
</style>

<style>
    /* ==================================================
   CO-SPONSOR RESPONSIVE SECTION
================================================== */

.co-sponsor-section .co-sponsor-list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.co-sponsor-section .venu-img1 {
    display: flex;
    flex: 0 0 200px;
    align-items: center;
    justify-content: center;
    width: 200px;
    height: 115px;
    margin: 0;
    padding: 12px;
    overflow: hidden;
    border: 2px solid #f37820;
    border-radius: 8px;
    background: #ffffff;
}

.co-sponsor-section .venu-img1 img,
.co-sponsor-section .venu-img1 img[style] {
    display: block;
    width: 100% !important;
    max-width: 170px;
    height: 85px !important;
    margin: 0 auto;
    border: none;
    object-fit: contain;
}

/* Tablet */

@media (max-width: 991px) {
    .co-sponsor-section .co-sponsor-list {
        gap: 16px;
    }

    .co-sponsor-section .venu-img1 {
        flex: 0 0 calc(33.333% - 16px);
        width: calc(33.333% - 16px);
        max-width: 200px;
    }
}

/* Mobile */

@media (max-width: 767px) {
    .co-sponsor-section {
        margin-top: 35px !important;
        margin-bottom: 35px !important;
    }

    .co-sponsor-section .main-head {
        margin-bottom: 25px;
        font-size: 26px;
        line-height: 1.3;
    }

    .co-sponsor-section .co-sponsor-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        padding-right: 12px;
        padding-left: 12px;
    }

    .co-sponsor-section .venu-img1 {
        width: 100%;
        max-width: none;
        height: 105px;
        margin: 0;
        padding: 10px;
    }

    .co-sponsor-section .venu-img1 img,
    .co-sponsor-section .venu-img1 img[style] {
        width: 100% !important;
        max-width: 135px;
        height: 76px !important;
        object-fit: contain;
    }

    /* Center the last sponsor when total cards are odd */

    .co-sponsor-section .venu-img1:last-child:nth-child(odd) {
        grid-column: 1 / -1;
        width: calc(50% - 7px);
        justify-self: center;
    }
}

/* Small mobile */

@media (max-width: 420px) {
    .co-sponsor-section .co-sponsor-list {
        gap: 10px;
        padding-right: 5px;
        padding-left: 5px;
    }

    .co-sponsor-section .venu-img1 {
        height: 95px;
        padding: 8px;
        border-radius: 7px;
    }

    .co-sponsor-section .venu-img1 img,
    .co-sponsor-section .venu-img1 img[style] {
        max-width: 120px;
        height: 68px !important;
    }
}
</style>

<!-- slider start  -->
<section>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="posi-rel">
                    <img src="{{ asset('assets/front/img/banner1.jpeg') }}" alt="">
                    <!--<img src="{{ asset('assets/postponed_banner/1.jpeg') }}" alt="" style="height: auto;width:80%;max-height:700px;margin:0 auto">-->
                </div>
            </div>
            <div class="swiper-slide">
                <div class="posi-rel">
                    <img src="{{ asset('assets/front/img/slider2.jpg') }}" alt="">
                </div>
            </div>
            
            <!-- Slide 3: Fully clickable -->
            <div class="swiper-slide">
                <a
                    href="https://opticexhibition.com/Jaipur/visitor_registration"
                    class="third-slide-link"
                    aria-label="Visitor Registration"
                    target="_blank"
                >
                    <img
                        src="{{ asset('assets/front/img/slider-3.png') }}"
                        alt="Visitor Registration"
                    >
                </a>
            </div>

        </div>
        <!-- <div class="swiper-button-next"></div><div class="swiper-button-prev"></div> -->
        <div class="swiper-pagination"></div>
    </div>
</section>
<marquee width="100%" direction="left" height="30px"
    style="background: red; color: white; font-size: 22px; font-weight: 600;margin-top: 15px;">
    - CHILDREN UNDER 12 YEARS NOT ALLOWED.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -Entry ONLY FOR OPTICIANS.
</marquee>
<!-- slider end  -->
<!-- About section start  -->
<section class="mt-40">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div data-aos="flip-right">
                    <div class="abt-img">
                        <img src="{{ asset('assets/front/img/ab-img.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="">
                    <h3 class="main-head">ABOUT OPTIC EXPO</h3>
                    <p class="about-sbu-txt">We are pleased to inform you OPTIC EXPO – A business platform and
                        networking
                        forum is scheduled to take place on 3-4-5th October 2026. It has proven its value to be one
                        of the biggest
                        and unique platform for optical products , manufactures, distributors for displaying and
                        demonstrating their latest products.
                        19th OPTIC EXPO will yet again prove to be a fruitful experience for participants & visitors.
                        The Event will provide a platform for the whole of Optics industry and has proven its mark for
                        more than a decade.</p>
                    <a class="btn-1" href="{{ route('FrontAbout') }}">
                        <button>Read more</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section class="mb-40 mt-5">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <h3 class="main-head text-center">Title Sponser</h3>-->
<!--            <div class=" col-lg-12 d-flex justify-content-center">-->
<!--                <div class="venu-img1 venu-img text-center">-->
<!--                    <img src="{{ asset('assets/front/img/Scvin.png') }}" data-aos="fade-up" class="img-fluid" alt="">-->
<!--                </div>-->
                <!--<div class="venu-img1 venu-img text-center">-->
                <!--    <img src="{{ asset('assets/front/img/Optic-scoope.png') }}" data-aos="fade-up" class="img-fluid" alt="">-->
                <!--</div>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!--<section class="mb-40 mt-5">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <h3 class="main-head text-center">Sponsored by</h3>-->
<!--            <div class=" col-lg-12 d-flex justify-content-center">-->
<!--                <div class="venu-img1 venu-img text-center">-->
<!--                    <img src="{{ asset('assets/front/img/Killerx.png') }}" data-aos="fade-up" class="img-fluid" alt="">-->
<!--                </div>-->
<!--                <div class="venu-img1 venu-img text-center">-->
<!--                    <img src="{{ asset('assets/front/img/Optic-scoope.png') }}" data-aos="fade-up" class="img-fluid" alt="">-->
<!--                </div>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<section class="mb-40 mt-5 co-sponsor-section">
    <div class="container">
        <div class="row">
            <h3 class="main-head text-center">Co-Sponsored by</h3>

            <div class="col-lg-12 co-sponsor-list">

                <div class="venu-img1 venu-img text-center">
                    <img src="{{ asset('assets/front/img/RAW7.png') }}"
                        data-aos="fade-up"
                        class="img-fluid"
                        alt="">
                </div>

                <div class="venu-img1 venu-img text-center">
                    <img src="{{ asset('assets/front/img/Omega.png') }}"
                        data-aos="fade-up"
                        class="img-fluid"
                        alt="">
                </div>

                <div class="venu-img1 venu-img text-center">
                    <img src="{{ asset('assets/front/img/Wolf-eyes.png') }}"
                        data-aos="fade-up"
                        class="img-fluid"
                        alt="">
                </div>

                <div class="venu-img1 venu-img text-center">
                    <img src="{{ asset('assets/front/img/SKECHERS.png') }}"
                        data-aos="fade-up"
                        class="img-fluid"
                        alt="">
                </div>

                <div class="venu-img1 venu-img text-center">
                    <img src="{{ asset('assets/front/img/Rio.png') }}"
                        data-aos="fade-up"
                        class="img-fluid"
                        alt="">
                </div>

            </div>
        </div>
    </div>
</section>

<!-- memories section-->
<section class="memories-section py-5">
    <div class="container">

        <div class="section-title text-center mb-5">
            <span>OUR JOURNEY</span>
            <h2>Our Memories</h2>
            <p>Capturing the unforgettable moments from previous Optic Expo exhibitions.</p>
        </div>

        <div class="swiper memoriesSwiper">

            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-1.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-2.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-3.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-4.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-5.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-6.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-7.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-8.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-9.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-10.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-11.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-12.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-13.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-14.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-15.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-16.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-17.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-18.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-19.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-20.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-21.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-22.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-23.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-24.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-25.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-26.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-27.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-28.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-29.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-30.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-31.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-32.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-33.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-34.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-35.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-36.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-37.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-38.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-39.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-40.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-41.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-42.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-43.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-44.jpeg') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-45.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-46.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-47.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-48.jpeg') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/front/img/memories-49.jpeg') }}" alt="">
                </div>


            </div>

        </div>

    </div>
</section>
<!--memories end-->

<!-- Venue Start  -->

<section class="mb-40 mt-5">
    
    <div class="container">
            <div class="row mt-40">
                <h3 class="main-head text-center">Venue</h3>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="border-o" data-aos="fade-right">
                        <img src="{{ asset('assets/front/img/drone-image-2.jpeg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 onea-txt col-md-6 col-sm-12">
                    <div class="onea-txt" data-aos="fade-left">
                        <p class="venm-head">Location</p>
                        
                        <div class="ven-add">
                        <p>
            <a href="https://maps.app.goo.gl/ypF9qMT3WsSx9hHb8"
               target="_blank"
               style="text-decoration: none; color: inherit;">
              {{ config('app.site_venue') }}
            </a>
          </p>
                </div>
                        
                        <p class="venm-head">EXHIBITION DATE</p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 3rd October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 4th October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 5th October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>


                    </div>
                </div>
            </div>
        </div>
    
    <!--<div class="container">-->
    <!--    <div class="row">-->
    <!--        <h3 class="main-head text-center">Venue</h3>-->
    <!--        <div class="col-lg-12">-->
    <!--            <div class="venu-img">-->
    <!--                <img src="{{ asset('assets/front/img/drone-image-2.jpeg') }}" data-aos="fade-up" class="img-fluid"-->
    <!--                    alt="">-->
    <!--            </div>-->
    <!--            <div class="ven-add">-->
    <!--                <p>{{ config('app.site_venue') }}</p>-->
    <!--                <p>-->
    <!--        <a href="https://maps.app.goo.gl/ypF9qMT3WsSx9hHb8"-->
    <!--           target="_blank"-->
    <!--           style="text-decoration: none; color: inherit;">-->
    <!--          {{ config('app.site_venue') }}-->
    <!--        </a>-->
    <!--      </p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
</section>
<!-- Venue Start  -->


@endsection

@section('scripts')
<script>
    const year = new Date().getFullYear();
    const fourthOfJuly = new Date(year, 8, 27).getTime();
    const fourthOfJulyNextYear = new Date(year + 1, 6, 4).getTime();
    const month = new Date().getMonth();

    // countdown
    let timer = setInterval(function () {

        // get today's date
        const today = new Date().getTime();

        // get the difference
        let diff;
        if (month > 6) {
            diff = fourthOfJulyNextYear - today;
        } else {
            diff = fourthOfJuly - today;
        }




        // math
        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
        let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

        // display
        document.getElementById("timer").innerHTML =
            "<div class=\"days\"> \
                                                                                                        <div class=\"numbers\">" +
            days +
            "</div>days</div> \
                                                                                                        <div class=\"hours\"> \
                                                                                                        <div class=\"numbers\">" +
            hours +
            "</div>hours</div> \
                                                                                                        <div class=\"minutes\"> \
                                                                                                        <div class=\"numbers\">" +
            minutes +
            "</div>minutes</div> \
                                                                                                        <div class=\"seconds\"> \
                                                                                                        <div class=\"numbers\">" +
            seconds + "</div>seconds</div> \
                                                                                                        </div>";

    }, 1000);
</script>
@endsection
