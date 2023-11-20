<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button data-tooltip-holder="View Product" onclick="toggleProductSection('productView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('productAdd')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Add Products</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('weight')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Weight</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('category')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Category</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('productItem')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Set Product Item</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('extraItem')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Extra Items</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('setExtraItem')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Set Extra Items</span><i class="bi bi-box d-block d-lg-none"></i></button>
            <button onclick="toggleProductSection('shipping')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Shipping Price</span><i class="bi bi-box d-block d-lg-none"></i></button>
        </div>
    </div>
    <div class="p-2 col-9 flex-grow-1 text-dark" id="productSectionsContainer">
        <div class="p-2 h-100 d-block alg-bg-light alg-rounded-small overflow-auto flex-grow-1">
            👈 Please Select a section...
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small overflow-auto flex-grow-1" id="productViewProductSection">

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
                    <input class="alg-rounded-mid form-control w-75" placeholder="add a new weight" type="text" id="addWeightInput"><button class="p-0 justify-content-center align-items-center w-25 alg-btn-pill" onclick="addWeight()"><span class="d-none d-md-block">Add Weight</span><i class="bi bi-plus d-block d-md-none"></i></button>
                </div>
                <div class="w-100 overflow-auto alg-bg-dark p-2 alg-rounded-mid" id="weightViewContainer">
                    Loading....
                </div>
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="categoryProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-mid alg-bg-dark p-2 d-flex flex-column gap-3">
                    <div class="w-100 m-0 py-2">
                        <label class="form-label" for="addCategoryInput">Add Category</label>
                        <input class="alg-rounded-mid form-control w-100" placeholder="add a new category" type="text" id="addCategoryInput">
                    </div>
                    <div class="w-100 m-0 d-flex flex-column overflow-auto">
                        <div class="w-100">
                            <label class="form-label" for="addCategoryImageInput">Add Category Image</label>
                            <input alt="Category Image Not Selected" onchange="previewCategoryInputImage()" class="alg-rounded-mid form-control w-100" placeholder="Select a category image" type="file" accept="image" id="addCategoryImageInput">
                        </div>
                        <img id="categoryImagePreviewBox" class="alg-text-dark d-flex justify-content-center align-items-center align-self-center alg-bg-light my-2 alg-rounded-small category-adding-preview" />
                    </div>
                    <button class="w-100 alg-btn-pill" onclick="addCategory()">Add Category</button>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid overflow-auto" id="categoryViewContainer">
                    Loading....
                </div>
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="productItemProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-small alg-bg-dark p-2 d-flex flex-column gap-3">
                    <div class="w-100 m-0 d-flex flex-column py-2">
                        <label class="fw-bold" for="productItemProductSelectInput">Product</label>
                        <select class="form-select" id="productItemProductSelectInput">
                        </select>
                    </div>
                    <div class="w-100 m-0 d-flex flex-column py-2">
                        <label class="fw-bold" for="productItemQuantitySelectInput">Quantity</label>
                        <input placeholder="Please add a quantity" class="form-control" type="number" min="0" id="productItemQuantitySelectInput">
                    </div>
                    <div class="w-100 m-0 d-flex flex-column py-2">
                        <label class="fw-bold" for="productItemProductPriceInput">Price (LKR)</label>
                        <input placeholder="Please add a price" class="form-control" type="number" min="0" id="productItemProductPriceInput">
                    </div>
                    <div class="w-100 m-0 d-flex flex-column py-2">
                        <label class="fw-bold" for="productItemWeightSelectInput">Weight</label>
                        <select class="form-select" id="productItemWeightSelectInput">
                        </select>
                    </div>
                    <div class="w-100 m-0 d-flex flex-column py-2 overflow-auto">
                        <label class="fw-bold" for="productItemImageInput">Images</label>
                        <input onchange="addProductItemImageToList()" multiple type="file" id="productItemImageInput" class="form-control">
                        <div class="my-2 p-1 rounded-1 product-items-images" id="productItemImagePreviewContainer">
                            <img class="product-items-image-slide" />
                        </div>
                    </div>
                    <button class="alg-btn-pill" onclick="productItemSave(event)">Save Product Item</button>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid overflow-auto" id="productItemViewContainer" style="max-height: 600px;">
                    Loading....
                </div>
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="extraItemProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-small alg-bg-dark p-2 d-flex flex-column gap-3">
                    <label class="fw-bold" for="extraItemInputField">Extra item</label>
                    <input type="text" class="form-control rounded-pill" id="extraItemInputField" placeholder="Enter the name of extra item">

                    <label class="fw-bold" for="extraItemPriceInputField">Add Price</label>
                    <input type="text" class="form-control rounded-pill" id="extraItemPriceInputField" placeholder="Enter the price of extra item">

                    <button class="alg-btn-pill" onclick="addExtraItem(event)">Add Extra Item</button>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid overflow-auto" id="extraItemViewContainer">
                    Loading extras....
                </div>
            </div>
        </div>
        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="setExtraItemProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-small alg-bg-dark p-2 d-flex flex-column gap-3">
                    <div class="d-flex flex-column">
                        <label for="setupProductSelector">Product</label>
                        <select class="form-select" id="setupProductSelector">
                        </select>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="setupExtraItemSelector">Extra Item</label>
                        <select class="form-select" id="setupExtraItemSelector">
                        </select>
                    </div>
                    <button class="btn alg-btn-pill" onclick="setupExtraItem()">SetUp</button>
                </div>
                <div class="w-100 alg-bg-dark p-2 alg-rounded-mid overflow-auto" id="setupExtraItemViewContainer">
                    Loading extras....
                </div>
            </div>
        </div>

        <div class="p-2 h-100 d-none alg-bg-light alg-rounded-small" id="shippingProductSection">
            <div class="w-100 d-flex flex-column gap-2 alg-text-white">
                <div class="w-100 alg-rounded-small alg-bg-dark p-2 d-flex flex-column gap-3">
                    <div class="d-flex flex-column">
                        <label for="shippingPriceInput">Shipping Item (LKR)</label>
                        <input type="text" class="form-control" id="shippingPriceInput">
                    </div>
                    <button class="btn alg-btn-pill" onclick="addShippingPrice()">Add</button>
                </div>
            </div>
        </div>
    </div>
</section>