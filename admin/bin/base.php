<?php
if (isset($_FILES['product_image']) && is_array($_FILES['product_image']['error'])) {
     $imageUrls = [];

     // Loop through each uploaded file
     foreach ($_FILES['product_image']['error'] as $key => $error) {
          if ($error === 0) {
               // files manage 
               $allowImageExtension = ['png', 'jpg', 'jpeg'];
               $fileExtension = strtolower(pathinfo($_FILES['product_image']['name'][$key], PATHINFO_EXTENSION));

               // file extension checks
               if (!in_array($fileExtension, $allowImageExtension)) {
                    $responseObject->error = 'Only png,jpg and jpeg file formats are allowed';
                    response_sender::sendJson($responseObject);
               }

               //file save path and file name create
               $savePath = "../../resources/images/singleProductImg/";
               $newImageName = "productId=" . $productId . "&&" . "weightId=" . $weightId . "." . $fileExtension;

               if (move_uploaded_file($_FILES['product_image']['tmp_name'], $savePath . $newImageName)) {
                    $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $newImgUrl = str_replace("api/productItemAdding.php", "", $currentURL) . "../../resources/images/singleProductImg/" . $newImageName;
                    // Add the image URL to the array
                    $imageUrls[] = $newImgUrl;
               } else {
                    $responseObject->error = "Image upload failed";
                    response_sender::sendJson($responseObject);
               }
          } else {
               $responseObject->error = "upload one or more images";
               response_sender::sendJson($responseObject);
          }
     }
} else {
     $responseObject->error = "no images upload";
     $responseObject->error = $_FILES['product_image'];

     response_sender::sendJson($responseObject);
}