// add a product
function addProduct() {
  const name = document.getElementById("productNameInputField");
  const description = document.getElementById("productDescriptionInputField");
  const category = document.getElementById("productCategoryInputField");

  const form = new FormData();
  form.append("product_name", name.value);
  form.append("description", description.value);
  form.append("category_id", category.value);

  fetch("api/productAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product adding was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        name.value = "";
        description.value = "";
        category.value = 0;
      } else if (data.status == "failed") {
        ALG.openToast(
          "Alert",
          data.error,
          ALG.getCurrentTime(),
          "bi-x",
          "Error"
        );
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      console.error(error);
    });
}
