<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button onclick="toggleProductSection('view')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">View Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('add')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Add Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
        </div>
    </div>
    <div class="p-2 col-9 flex-grow-1 text-dark" id="productSectionsContainer">
        <div class="p-2 h-100 d-block alg-bg-light alg-rounded-small overflow-auto" style="max-height: 800px;" id="viewProductSection">

        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="addProductSection">
            2
        </div>
    </div>
</section>