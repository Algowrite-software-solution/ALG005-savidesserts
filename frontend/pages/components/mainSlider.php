<section>
    <div class="row">
        <div class="col-12 m-0 p-0 position-relative">
            <div class="position-absolute m-lg-5 pt-lg-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="row pb-lg-5">
                            <div class="col-10 m-5">
                                <span class="alg-text-h1 text-white fw-semibold lh-1">Experience the Joy of Irresistible Desserts</span><br />
                                <span class="alg-text-h2 text-white pt-3">Embark ona Flavorful journy of Irresistible Desserts discover the Delight of Authentic Sri Lankan Sweets, Crafted to Perfection.</span>
                            </div>
                        </div>
                        <div class="row mt-2 mt-lg-5">
                            <div class="col-5 col-lg-3 m-lg-5 mx-5 mx-lg-0 mt-0 d-grid">
                                <button class="btn alg-bg-gold p-2 rounded-4 text-white fw-bold">ORDER NOW</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">

                        <div class="swiper mainSlider mySwiperMain">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide mainSlider"><img src="resources/images/item1.png" class="rounded-5 mainSliderImg" alt="" ></div>
                                <div class="swiper-slide mainSlider"><img src="resources/images/mainSliderImg.png" class="rounded-5 mainSliderImg" alt=""></div>
                                <div class="swiper-slide mainSlider"><img src="resources/images/item1.png" class="rounded-5 mainSliderImg" alt=""></div>
                                <div class="swiper-slide mainSlider"><img src="resources/images/mainSliderImg.png" class="rounded-5 mainSliderImg" alt=""></div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <img src="resources/images/mainImg.png" alt="" class="p-0 m-0 alg-main-img">
            </div>
        </div>
    </div>
</section>
<script  src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    
  var swiper = new Swiper(".mySwiperMain", {
    direction: "vertical",
    spaceBetween: 30,
      grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });
</script>