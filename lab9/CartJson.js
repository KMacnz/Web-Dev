

var xHRObject = false;
if (window.XMLHttpRequest) {
  xHRObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
  xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getData() {
  if (xHRObject.readyState == 4 && xHRObject.status == 200) {
    var spantag = document.getElementById("cart");

    var serverResponse;
    if (xHRObject.responseText != "")
      serverResponse = JSON.parse(xHRObject.responseText);
    else serverResponse = null;

    if (serverResponse != null) {
      console.log(serverResponse);
      var keys = Object.keys(serverResponse);
      spantag.innerHTML = "<h2>Shopping Cart</h2>";

      for (const key of keys) {
        const title = document.getElementById(`book-${key}`).innerHTML;
        const priceString = document.getElementById(`price-${key}`).innerHTML.split('$')[1];
        const quantity = serverResponse[key];
        
        const price = (Number(priceString) * quantity).toFixed(2);

        spantag.innerHTML += `${title} x ${quantity} = $${price} <a href='#' onclick='AddRemoveItem(\"Remove\", \"${key}\");'>Remove</a><br><br>`;
        
      }

    } else {
      spantag.innerHTML = "<h2>Shopping Cart</h2>";
    }
  }
}

function AddRemoveItem(action, isbn) {
  var book = document.getElementById(`book-${isbn}`).innerHTML;

  
    xHRObject.open(
      "GET",
      "test.php?action=" +
        action +
        "&book=" +
        encodeURIComponent(book) +
        "&isbn=" +
        encodeURIComponent(isbn) +
        "&value=" +
        Number(new Date()),
      true
    );
  

  console.log("isbn: " + isbn + " book: " + book + " action: " + action);

  xHRObject.onreadystatechange = getData;
  xHRObject.send(null);
}