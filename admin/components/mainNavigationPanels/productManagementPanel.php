<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button data-tooltip-holder="View Product" onclick="toggleProductSection('productView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('productAdd')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Add Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('weight')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Weight</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('categoryAdd')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Add Category</span><i class="bi bi-box d-block d-lg-none"></i></button>
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
            <div class="w-100">
                <label class="form-label" for="productDescriptionInputField">Product Description</label>
                <textarea type="text" id="productDescriptionInputField" class="form-control" rows="5"></textarea>
            </div>
            <div class="w-100">
                <label class="form-label" for="productCategoryInputField">Product Description</label>
                <select id="productCategoryInputField" class="form-select">
                    Something Went Wrong..!!
                </select>
            </div>
            <div class="w-100">
                <button onclick="addProduct()" class="my-4 w-100 alg-btn-pill">Add Product</button>
            </div>

        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="categoryViewProductSection">
            <div class="w-100">
                something is here...
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="weightProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-mid alg-bg-dark p-2 d-flex gap-3">
                    <input class="alg-rounded-mid form-control w-75" placeholder="add a new weight" type="text" id="addWeightInput"><button class="w-25 alg-btn-pill" onclick="addWeight()">Add Weight</button>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid" id="weightViewContainer">
                    Loading....
                </div>
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="categoryAddProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-mid alg-bg-dark p-2 d-flex flex-column gap-3">
                    <div class="w-100 m-0 d-flex">
                        <input class="alg-rounded-mid form-control w-75" placeholder="add a new category" type="text" id="addCategoryInput"><button class="w-25 alg-btn-pill" onclick="addCategory()">Add Category</button>
                    </div>
                    <div class="w-100 m-0 d-flex flex-column">
                        <div class="w-100 d-flex">
                            <input class="alg-rounded-mid form-control w-75" placeholder="Select a category image" type="file" accept="image" id="addCategoryInput"><button class="w-25 alg-btn-pill" onclick="addCategoryImage()">Add Image</button>
                        </div>
                        <div class="alg-text-dark d-flex justify-content-center align-items-center align-self-center p-3 alg-bg-light my-2 alg-rounded-small" style="width: 200px; height: 200px;">image preview</div>
                    </div>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid overflow-auto" id="categoryViewContainer">
                    Loading....
                </div>
            </div>
        </div>
    </div>
</section>