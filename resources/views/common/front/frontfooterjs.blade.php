<!-- Bootstrap js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- Bootstrap js  -->
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 250,
        duration: 2500,
        once: true,
    });
</script>

<!--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>-->

<script>
new Swiper(".memoriesSwiper",{

    slidesPerView:4,
    spaceBetween:25,
    loop:true,

    speed:3000,

    autoplay:{
        delay:0,
        disableOnInteraction:false,
        pauseOnMouseEnter:true
    },

    breakpoints:{
        320:{
            slidesPerView:1
        },
        768:{
            slidesPerView:2
        },
        992:{
            slidesPerView:3
        },
        1200:{
            slidesPerView:4
        }
    }

});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
