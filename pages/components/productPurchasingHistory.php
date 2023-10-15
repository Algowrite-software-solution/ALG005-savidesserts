<section>
    <div class="mt-1 d-flex justify-content-center pb-4">
        <div class="col-10 alg-bg-dark rounded-4 pb-3">

            <div class=" text-center mt-3">
                <span class="alg-text-h2 alg-text-light fw-semibold">History</span>
            </div>

            <div class="row alg-bg-light text-black d-flex justify-content-between text-center mx-4 rounded-4 mt-3 mb-2 p-2 alg-text-h3" onclick="productDetails();">
                <div class="col-9 col-lg-6 m-0 p-0 px-2 px-lg-0">
                    <div class="row">
                        <div class="col-3">
                            <span>#234</span>
                        </div>
                        <div class="col-4">
                            <span>01/02/2023</span>
                        </div>
                        <div class="col-5">
                            <span >08/02/2023</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 m-0 p-0">
                    <div class="row">
                        <div class="col-3 me-3">
                            <span>LKR 500</span>
                        </div>
                        <div class="col-6">
                            <span class="fw-bold">Status</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- product details model -->
<div class="modal fade modal-xl" id="productDetailsModel" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
    <div class="modal-dialog p-0">
        <div class="modal-content rounded-5">
            <div class="modal-body p-0">
                <div class="rounded-5">
                <div class="alg-model-head d-flex justify-content-end align-items-end p-3">
                        <button class="alg-btn-circle alg-text-dark alg-bg-light fs-5 fw-bold" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x text-dark"></i></button>
                    </div>
                    <div class="alg-model-body p-3 rounded-5 d-flex flex-column align-items-center">
                        <div class="col-12 p-3 alg-bg-dark rounded-4">
                            <div class="d-flex justify-content-around align-items-center fw-bold text-white alg-text-h3 p-2 px-0 px-lg-0">
                                <span>Product</span>
                                <span>Extra items</span>
                                <span>Qty</span>
                                <span>Weight</span>
                                <span>Price</span>

                            </div>
                            <?php
                            for ($x = 0; $x < 3; $x++) {
                            ?>
                                <div class="d-flex justify-content-around alg-bg-light align-items-center alg-text-h3 p-2 px-0 px-lg-0 mb-2 rounded-3">
                                    <span>Product 1</span>
                                    <span>Extra 1</span>
                                    <span>2</span>
                                    <span>3kg</span>
                                    <span>LKR 300</span>

                                </div>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>