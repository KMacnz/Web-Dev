/*
    Name: Keanna Mackereth
    Email: hvm1158@autuni.ac.nz
    ID: 20119705
*/

// create a new XMLHttpRequest object
const xhr = createRequest();

function getBooking(dataSource, divID, cName, phone, uNumber, sNumber, stName, sbName, dsbName, date, time) {

	// check if the XMLHttpRequest object has been successfully created
	if (xhr) {
		// get the element with the specified ID
		const obj = document.getElementById(divID);

        // create a name/value pair for each form field
        const requestbody = "cName=" + encodeURIComponent(cName) + "&phone=" + encodeURIComponent(phone) + "&uNumber=" + encodeURIComponent(uNumber) + "&sNumber=" + encodeURIComponent(sNumber) + "&stName=" + encodeURIComponent(stName) + "&sbName=" + encodeURIComponent(sbName) + "&dsbName=" + encodeURIComponent(dsbName) + "&date=" + encodeURIComponent(date) + "&time=" + encodeURIComponent(time);

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

		const form = document.getElementById("bookDiv");
		// hide the form
		form.style.display = "none";

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

// Validate the form
function validateForm(cName, phone, sNumber, stName, date, time) {

	// check if the date is valid and not in the past
	const currentDate = new Date().toISOString().substr(0, 10)
	const currentTime = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

	// check if the elements are empty
	if (cName == "" || phone == "" || sNumber == "" || stName == ""|| date == "" || time == "") {
		alert("Please ensure all fields are filled in");
		return false;
	}

	// check if the phone number is valid (10 to 12 numbers only)
	if (!phone.match(/^\d{10,12}$/)) {
		alert("Phone Number must be between 10 to 12 Numbers\nPlease try again");
		return false;
	}

	// validate the date and time (must not be in the past)
	if (new Date(date + ' ' + time) < new Date(currentDate + ' ' + currentTime)) {
		alert("Please select a date and time in the Present or Future");
		return false;
	}
	return true;
}
