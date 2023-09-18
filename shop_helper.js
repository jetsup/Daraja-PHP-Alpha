function addToCart(productID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  };
  xhttp.open(
    "GET",
    "helpers/shop/checkout.php?queryType=addToCart&productID=" + productID,
    true
  );
  xhttp.send();
}
function checkout() {
  // get all the checked items
  const checkedItems = document.querySelectorAll(
    "input[class='checkout-box']:checked"
  );
  // get the productID and quantity of each checked item
  var productIDs = [];
  var quantities = [];
  checkedItems.forEach((item) => {
    const productID = item.parentElement.id.replace("cart-item", "");
    const quantity = item.parentElement.querySelector(".quantity").innerText;
    productIDs.push(productID);
    quantities.push(quantity);
  });
  // send the productIDs and quantities to the server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("Checkout done!");
      console.log(this.responseText);
    }
  };
  var productIDsJSON = JSON.stringify(productIDs);
  var quantitiesJSON = JSON.stringify(quantities);
  xhttp.open(
    "GET",
    "helpers/shop/checkout.php?queryType=checkout&productIDs=" +
      productIDsJSON +
      "&quantities=" +
      quantitiesJSON,
    true
  );
  xhttp.send();
}
function buyProduct(productID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open(
      "GET",
      "helpers/shop/checkout.php?queryType=buyProduct&productID=" + productID,
      true
    );
    xhttp.send();
}