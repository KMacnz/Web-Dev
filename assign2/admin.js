/*
    Name: Keanna Mackereth
    Email: hvm1158@autuni.ac.nz
    ID: 20119705
*/

// create a new XMLHttpRequest object
const xhr = createRequest();

function searchBooking(dataSource, divID, bSearch) {

	// check if the XMLHttpRequest object has been successfully created
	if (xhr) {
		// get the element with the specified ID
		const obj = document.getElementById(divID);

		// create a name/value pair for each form field
		const requestbody = "bSearch=" + encodeURIComponent(bSearch);

		// open a new HTTP POST request to the specified data source
		xhr.open("POST", dataSource, true);

		// set the request header to indicate that we're sending form data
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// define a callback function to be executed whenever the readyState of the request changes
		xhr.onreadystatechange = function () {

			// if the request has completed and the server returned a success status code (200), update the specified HTML element with the response data
			if (xhr.readyState == 4 && xhr.status == 200) {
				obj.innerHTML = xhr.responseText;
			}
		}
		// send the request body to the server
		xhr.send(requestbody);

		const form = document.getElementById("content");
		// show the form
		form.style.display = "block";
	}
}

// This function creates and returns a new XMLHttpRequest object
function createRequest() {
	var xhr = false;
	// Check if the browser supports the XMLHttpRequest object
	if (window.XMLHttpRequest) {
		// If the browser does support it, create a new XMLHttpRequest object
		xhr = new XMLHttpRequest();
	}
	// If the browser doesn't support the XMLHttpRequest object, try using an ActiveXObject
	else if (window.ActiveXObject) {
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	// Return the XMLHttpRequest object
	return xhr;
}

// function to check if the booking reference is in the correct format
function checkSearch(bSearch) {
	// check if the bSearch format is BRN followed by 5 digits
	if (bSearch.match(/^BRN\d{5}$/)) {
		return true;

		// check if null or empty
	} else if (bSearch == "") {
		return true;
	} else if (bSearch == " ") {
		return true;	
		// if not in the wanted format, alert the user and dont let the program continue. 
	} else {
		alert("Incorrect Booking Reference Format\neg: BRN12345");
		return false;
	}
}

// function when the button is clicked for assign
function assignBtn(dataSource, divID, number) {

	if (xhr) {
		// get the element with the specified ID
		const obj = document.getElementById(divID);

		// create a name/value pair for each form field
		const requestbody = "number=" + encodeURIComponent(number) + "&assignStat=" + encodeURIComponent("assignStat");

		// open a new HTTP PATCH request to the specified data source
		xhr.open("PATCH", dataSource, true);

		// set the request header to indicate that we're sending form data
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// define a callback function to be executed whenever the readyState of the request changes
		xhr.onreadystatechange = function () {
			if (xhr.readyState != 4) return;
			// if the request has completed and the server returned a success status code (200), update the specified HTML element with the response data
			if (xhr.status == 200) {
				obj.innerHTML = xhr.responseText;
				document.getElementById(`BRN${number}`).innerHTML = "assigned";
				document.getElementById(`assignBtn-${number}`).disabled = true;

			} else {
				alert("Error: " + xhr.responseText);
			}
		}
		// send the request body to the server
		xhr.send(requestbody);
	}
}