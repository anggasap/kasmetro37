// JavaScript Document
function numbersonly(e, decimal) {
	var key;
	var keychar;
	
	if (window.event) {
	   key = window.event.keyCode;
	}
	else if (e) {
	   key = e.which;
	}
	else {
	   return true;
	}
	keychar = String.fromCharCode(key);
	
	if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
	   return true;
	}
	else if ((("0123456789").indexOf(keychar) > -1)) {
	   return true;
	}
	else if (decimal && (keychar == ".")) { 
	  return true;
	}
	else
	   return false;
}

 function ToUpper(ctrl) {
	var t = ctrl.value;
	ctrl.value = t.toUpperCase();
}

function strrev(str) {
    if (!str) return '';
    var revstr = '';
    for (i = str.length - 1; i >= 0; i--)
        revstr += str.charAt(i)
    return revstr;
}


function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}
function AddAndRemoveSeparator(txtbox) {
    var i = 0, Odd = 0; rev = '', result = '';
    txtbox.value = ReplaceAll(txtbox.value, ',', ''); //remove prevoius separators;


    if (txtbox.value.length <= 3) return;


    rev = strrev(txtbox.value); //reverse string;
    while (i < rev.length) {
        result += rev.substr(i, 1);
        Odd++;
        if ((Odd == 3) && (i != rev.length - 1)) { //add separator after 3 digits;
            result += ',';
            Odd = 0;
        }
        i++;
    }
    result = strrev(result);
    //            if (result.charAt(1) == ',') {
    //                result = result.substr(2, result.length-1)
    //            }
    txtbox.value = result;
}