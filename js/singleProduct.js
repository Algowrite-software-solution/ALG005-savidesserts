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


// single product QTY changer

let slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("demo");
      let captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }



    
    