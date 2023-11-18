<!-- section -->
<section class="alg-bg-darker alg-rounded-small my-2 d-flex h-100">
    <div class="p-2 col-3 flex-grow-1">
        <div class="px-2 algbg alg-rounded-small">
            <button data-tooltip-holder="View Promotion" onclick="togglePromotionSection('promotionView')" class="alg-btn-pill my-2 w-100"><span class="d-none d-lg-block">Promotions</span><i class="bi bi-cart d-block d-lg-none"></i></button>
        </div>
    </div>
    <div class="p-2 col-9 flex-grow-1 text-dark" id="promotionSectionContainer">
        <div class="p-2 h-100 alg-bg-light alg-rounded-small overflow-auto flex-grow-1" id="promotionViewPromotionSection">
            <div class="alg-bg-dark  alg-text-light alg-rounded-small my-3 p-3 d-flex flex-column gap-2">
                <div class="d-flex flex-column">
                    <label for="promotionAddProductSelect">Product</label>
                    <select name="promotionAddProductSelect" id="promotionAddProductSelect" class="form-select">

                    </select>
                </div>

                <div class="d-flex flex-column">
                    <label for="promotionAddWeightSelect">Weight</label>
                    <select name="promotionAddWeightSelect" id="promotionAddWeightSelect" class="form-select">

                    </select>
                </div>

                <div class="d-flex flex-column">
                    <label for="promotionAddEndDate">End Date</label>
                    <input type="date" id="promotionAddEndDate" class="form-control">
                </div>

                <div class="d-flex flex-column">
                    <label for="promotionAddWeightSelect">Image</label>
                    <input type="file" id="promotionAddImage" class="form-control">
                </div>

                <button class="alg-btn-pill" onclick="savePromotion()">Add Promotion</button>
            </div>
            <div id="promotionViewContainer">
                <div class="p-2 h-100 d-block alg-bg-light alg-rounded-small overflow-auto flex-grow-1">
                    👈 Please Select a section...
                </div>
            </div>
        </div>
    </div>
</section>