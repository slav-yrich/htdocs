function addFormValidation(form) {
	form.controlsToValidateArr = new Array();
	for(var i = 0; i < form.elements.length; i++) {
		var ctrl = form.elements[i];
		if(
			ctrl.getAttribute("requiredErrorMessage") ||
			ctrl.getAttribute("emailErrorMessage") ||
			ctrl.getAttribute("dateErrorMessage") ||
			ctrl.getAttribute("numberErrorMessage") ||
			ctrl.getAttribute("lengthEqualErrorMessage") ||
			ctrl.getAttribute("lengthLessOrEqualErrorMessage")
		) {
			form.controlsToValidateArr[form.controlsToValidateArr.length] = ctrl;
			ctrl.valMsg = $("<span class=\"validationMessage\"></span>");
			
			if ($(ctrl).attr("type") == "radio") {
				//alert(ctrl.outerHTML);
				//$(ctrl).wrap("<span class=\"invalid\"></span>");
				$(ctrl.parentNode).append("<br>").append(ctrl.valMsg);
			} else
				ctrl.valMsg.insertAfter(ctrl);
		}
	}
	$(form).submit(function(){return validateForm(form)})
}

function validateForm(form) {
	var ctrl;
	form.firstNotValidControl = null;
	form.isValid = true;
	for(var i = 0; i < form.controlsToValidateArr.length; i++) {
		ctrl = form.controlsToValidateArr[i];

		if ($(ctrl).attr("type") == "radio")
			$(ctrl.parentNode).removeClass("invalid");
		else
			$(ctrl).removeClass("invalid");
		ctrl.valMsg.hide()
		if(!isCtrlEnabled(ctrl)) continue;
		
		if(ctrl.getAttribute("emailErrorMessage"))
			if(!isEMailAddr(ctrl))
				setInvalid(ctrl, "emailErrorMessage");

		if(ctrl.getAttribute("dateErrorMessage"))
			if(!isDate(ctrl))
				setInvalid(ctrl, "dateErrorMessage");

		if(ctrl.getAttribute("lengthLessOrEqualErrorMessage"))
			if(!isLengthLessOrEqual(ctrl))
				setInvalid(ctrl, "lengthLessOrEqualErrorMessage");

		if(ctrl.getAttribute("lengthEqualErrorMessage"))
			if(!isLengthEqual(ctrl))
				setInvalid(ctrl, "lengthEqualErrorMessage");

		if(ctrl.getAttribute("lengthExceedErrorMessage"))
			if(!isLengthExceed(ctrl))
				setInvalid(ctrl, "lengthExceedErrorMessage");

		if(ctrl.getAttribute("numberErrorMessage"))
			if(!isNumber(ctrl))
				setInvalid(ctrl, "numberErrorMessage");

		if(ctrl.getAttribute("requiredErrorMessage"))
			if(!isNotEmpty(ctrl))
				setInvalid(ctrl, "requiredErrorMessage");
	}

	function setInvalid(ctrl, attr) {
		if ($(ctrl).attr("type") == "radio")
			$(ctrl.parentNode).addClass("invalid");
		else
			$(ctrl).addClass("invalid");
		
		ctrl.valMsg.html(ctrl.getAttribute(attr));
		ctrl.valMsg.show();
		if(!form.firstNotValidControl) form.firstNotValidControl = form.controlsToValidateArr[i];
		form.isValid = false;
	}
	
	if(form.isValid)
		return true;
	else {
		form.firstNotValidControl.focus();
		return false;
	}
}

function isCtrlEnabled(elem) {
	var parent = elem.parentNode;
	var disp;
	if (elem.disabled) return false;

	while (parent.tagName != "BODY") {
		if(jQuery.browser.msie)
			disp = parent.currentStyle.display;
		else
			disp = getComputedStyle(parent, null).display;

		if (disp == "none")
			return false;

		parent = parent.parentNode;
	}
	return true;
}


// validates that the field value string has one or more characters in it
function isNotEmpty(elem) {
	var isValid = false;
	if ($(elem).attr("type") == "radio") {
		$("input[name=" + $(elem).attr("name") + "]").each(function(){
			if (this.checked)
				isValid = true;
		});
	} else {
		var str = $(elem).val();
		var re = /.+/;
		if(str.match(re))
			isValid = true;
	}
	return isValid;
}
//validates that the entry is a positive or negative number
function isNumber(elem) {
	var str = elem.value;
	var re = /^[-]?\d*\.?\d*$/;
	str = str.toString();
	if(!str) return true;
	if(!str.match(re)) return false;
	return true;
}
// validates that the entry is formatted as an e-mail address
function isEMailAddr(elem) {
	var str = elem.value;
    var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
	if(!str) return true;
    if(!str.match(re)) return false;
	else return true;
}
// validates that the entry is formatted as an date
// Date dd.mm.yyyy
// 01.01.1900 through 31.12.2099
// Matches invalid dates such as February 31st
function isDate(elem) {
	var str = elem.value;
    var re = /^(0[1-9]|[12][0-9]|3[01]).(0[1-9]|1[012]).(19|20)[0-9]{2}/;
	if(!str) return true;
    if(!str.match(re)) return false;
	else return true;
}
// validates that the entry has some length
function isLengthEqual(elem) {
	var str = elem.value;
	var valLength = parseInt(elem.getAttribute("lengthEqualErrorMessage").match(/\d+/));
	if(str.length == valLength) return true;
	else return false;
}
// validates that the entry has less or same length
function isLengthLessOrEqual(elem) {
	var str = elem.value;
	var valLength = parseInt(elem.getAttribute("lengthLessOrEqualErrorMessage").match(/\d+/));
	if(str.length <= valLength) return true;
	else return false;
}
// validates that the entry exceeds required length 
function isLengthExceed(elem) {
	var str = elem.value;
	var valLength = parseInt(elem.getAttribute("lengthExceedErrorMessage").match(/\d+/));
	if(str.length >= valLength) return true;
	else return false;
}
// validate that the user made a selection other than default
function isChosen(select) {
    if (select.selectedIndex == 0) {
        return false;
    } else {
        return true;
    }
}

// validate that the user has checked one of the radio buttons
function isValidRadio(radio) {
    var valid = false;
    for (var i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
            return true;
        }
    }
    return false;
}