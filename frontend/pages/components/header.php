<header>
    <nav>
        <div class="row m-auto alg-bg-dark">
            <div class="col-12 d-flex justify-content-between align-items-center">

                <div>
                    <img src="resources/images/logo.png" alt="" class="alg-logo-img" />
                </div>

                <div class="d-none d-md-block d-lg-block">
                    <div class=" d-flex justify-content-betwee gap-4 cursor ">
                        <!-- <div class="col-12"> -->
                            <!-- <div class="row"> -->
                        
                                    <div class="alg-bg-light px-2 px-lg-4 py-1 rounded-4 position-absolut fw-semibold d-flex justify-content-center alg-text-h2"><span>Home</span></div>
                           
                                
                                    <div class="alg-bg-tan px-2 px-lg-4 py-1 rounded-4 position-absolut fw-semibold d-flex justify-content-center alg-text-h2"><span>Category</span></div>
                            
                                
                                    <div class="alg-bg-tan px-2 px-lg-4 py-1 rounded-4 position-absolut fw-semibold d-flex justify-content-center alg-text-h2"><span>Best Selling</span></div>
                               
                                
                                    <div class="alg-bg-tan px-2 px-lg-4 py-1 rounded-4 position-absolut fw-semibold d-flex justify-content-center alg-text-h2"><span>About us</span></div>
                                    <div class="alg-bg-tan px-2 px-lg-4 py-1 rounded-4 position-absolut fw-semibold d-flex justify-content-center alg-text-h2"><span>Contact us</span></div>
                         
                                
                                
                               
                            <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="alg-bg-tan px-5 py-1 rounded-4 position-absolute fw-semibold"><span>Home</span></div>
                        <div class="alg-bg-light px-5 py-1 rounded-4 alg-navmarginLeft fw-semibold"><span>Products</span></div>
                        <div class="alg-bg-tan px-5 py-1 rounded-4 position-absolute fw-semibold"><span>Home</span></div> -->
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-center">
                    <div class="d-none d-md-block d-lg-block mx-2 ">
                        <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-cart-fill alg-header-text fs-4 mx-3"></i></a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="bi bi-heart-fill alg-header-text fs-4"></i></a>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-3 cursor">
                            <span class="rounded-circle"><i class="bi bi-whatsapp text-success fs-4"></i></i></span>
                            <div class="alg-user-Word alg-bg-gold"><span class="d-flex justify-content-center align-items-center fw-semibold">ml</span></div>
                        </div>
                        <div class="alg-toggle-button d-md-none d-lg-none fs-2">
                            <i class="bx bx-menu alg-header-text alg-nav-hover"></i>
                            <!-- <span class="fs-2" id="close"><i class='bx bx-x'></i></span> -->
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center nav_box alg-bg-gold bg-opacity-50 mt-3">
                <div class="d-flex flex-column d-block d-md-none pb-3">
                    <span class="mt-3 alg-nav-hover"><a href="#home" class="text-decoration-none fw-semibold">Home</a></span>
                    <span class="mt-3 alg-nav-hover"><a href="#products" class="text-decoration-none fw-semibold">Products</a></span>
                    <span class="mt-3 alg-nav-hover" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><a href="#cart" class="text-decoration-none fw-semibold">Cart</a></span>
                    <span class="mt-3 alg-nav-hover" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><a href="#watchlist" class="text-decoration-none fw-semibold">Watchlist</a></span>
                </div>
            </div>
        </div>
    </nav>
    <script>
        const toggle = document.querySelector('.alg-toggle-button');
        const toggleIcon = document.querySelector('.bx-menu');
        const navBox = document.querySelector('.nav_box');

        toggle.onclick = () => {

            navBox.classList.toggle('alg-nav-box');
            toggleIcon.classList.toggle('bx-x');
        }
    </script>
</header>