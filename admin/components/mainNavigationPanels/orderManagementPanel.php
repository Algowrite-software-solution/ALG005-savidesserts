<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button data-tooltip-holder="View Order" onclick="toggleOrderSection('ongoingOrderView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Orders</span><i class="bi bi-cart d-block d-lg-none"></i></button>
            <button data-tooltip-holder="View Reviews" onclick="toggleOrderSection('reviewView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">View Review</span><i class="bi bi-cart d-block d-lg-none"></i></button>
        </div>
    </div>
    <div class="p-2 col-9 flex-grow-1 text-dark" id="orderSectionsContainer">
        <div class="p-2 h-100 d-block alg-bg-light alg-rounded-small overflow-auto flex-grow-1" id="ongoingOrderViewOrderSection">
            👈 Please Select a section...
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small overflow-auto flex-grow-1" id="reviewViewOrderSection">
            👈 Please Select a section...
        </div>
    </div>
</section>