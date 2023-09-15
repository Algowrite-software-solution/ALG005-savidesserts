// single product QTY changer

const plus = document.getElementById("plusid"),
minus = document.getElementById("minusid"),
num = document.getElementById("numid");

let a = 1;

plus.addEventListener("click", ()=>{
  if (a < 20) {
    a++;
}
a = (a < 10) ? "0" + a : a;
num.innerText = a;
});

minus.addEventListener("click", ()=>{
    if (a > 1) {
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    }
});


var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 3,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});
