<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button onclick="toggleProductSection('productView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('productAdd')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Add Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('categoryView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Categories</span><i class="bi bi-box d-block d-lg-none"></i></button>
        </div>
    </div>
    <div class="p-2 col-9 flex-grow-1 text-dark" id="productSectionsContainer">
        <div class="p-2 h-100 d-block alg-bg-light alg-rounded-small overflow-auto flex-grow-1" id="productViewProductSection">

        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="productAddProductSection">
            <div class="w-100">
                <label class="form-label" for="productNameInputField">Product Name</label>
                <input type="text" id="productNameInputField" class="form-control">
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="categoryViewProductSection">
            <div class="w-100">
                something is here...
            </div>
        </div>
    </div>
</section>