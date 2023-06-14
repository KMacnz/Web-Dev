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
} // end function createRequest()
