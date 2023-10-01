// add a product
function addProduct() {
  const name = document.getElementById("productNameInputField").value;
  const description = document.getElementById(
    "productDescriptionInputField"
  ).value;
  const category = document.getElementById("productCategoryInputField").value;

  const form = new FormData();
  form.append("product_name", name);
  form.append("description", description);
  form.append("category_id", category);

  fetch("api/productAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(ALG.getCurrentTime());
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product adding was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );
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
