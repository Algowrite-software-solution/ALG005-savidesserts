<section>
    <div class="mt-1 d-flex justify-content-center pb-4">
        <div class="col-10 alg-bg-dark rounded-4 pb-3" id="detailsContainer">

            <div class=" text-center mt-3">
                <span class="alg-text-h2 alg-text-light fw-semibold">History</span>
            </div>
            <div class="d-flex justify-content-around pt-2 pointer-event">
                <span class="alg-text-h5 alg-text-light d-none d-lg-block  fw-semibold">Order Id</span>
                <span class="alg-text-h5 alg-text-light d-none d-lg-block fw-semibold">Order Date</span>
                <span class="alg-text-h5 alg-text-light d-none d-lg-block fw-semibold">Estimate Delivery Date</span>
                <span class="alg-text-h5 alg-text-light d-none d-lg-block fw-semibold">Delivery Price</span>
                <span class="alg-text-h5 alg-text-light d-none d-lg-block fw-semibold">Total Cost</span>
                <span class="alg-text-h5 alg-text-light d-none d-lg-block fw-semibold">Status</span>
            </div>

            <!-- details goes here userDataLoad.js line 59 -->
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
                    <div class="alg-model-body  d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-around  fw-bold text-black alg-text-h3 ">
                            <span>Product</span>
                            <span>Toppings</span>
                            <span>Topping Price</span>
                            <span>Qty</span>
                            <span>Weight</span>
                            <span>Per Item Price</span>
                            <span>Sub Total</span>
                        </div>
                        <div class="col-12 p-3 alg-bg-dark rounded-4" id="invoiceItemContainer">

                            <!-- details goes here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>