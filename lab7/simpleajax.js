// file simpleajax.js

// create a new XMLHttpRequest object
var xhr = createRequest();

// define a function to get data from the server and update the HTML of a specified element
function getData(dataSource, divID, aName, aPwd) {
	// check if the XMLHttpRequest object has been successfully created
	if (xhr) {
		// get the element with the specified ID
		var obj = document.getElementById(divID);

		// encode the provided name and password values as part of the request body
		var requestbody = "name=" + encodeURIComponent(aName) + "&pwd=" + encodeURIComponent(aPwd);

		// open a new HTTP POST request to the specified data source
		xhr.open("POST", dataSource, true);

		// set the request header to indicate that we're sending form data
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// define a callback function to be executed whenever the readyState of the request changes
		xhr.onreadystatechange = function() {
			
			// if the request has completed and the server returned a success status code (200), update the specified HTML element with the response data
			if (xhr.readyState == 4 && xhr.status == 200) {
				obj.innerHTML = xhr.responseText;
			}
		}
		// send the request body to the server
		xhr.send(requestbody);
	}
}