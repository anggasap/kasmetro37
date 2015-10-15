// JavaScript Document
/*function numbersonly(e, decimal) {
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
}*/
/*ANG*/
function ToUpper(ctrl) {
	var t = ctrl.value;
	ctrl.value = t.toUpperCase();
}
function ajaxModal(){
    $(document).ajaxStart(function() {
        $('.modal_json').fadeIn('fast');
    }).ajaxStop(function() {
        $('.modal_json').fadeOut('fast');
    });
}
function validatedate(inputText,vbl) {  
	var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;  
	// Match the date format through regular expression  
	if(inputText.match(dateformat)){  
	   // document.form1.text1.focus();  
		//Test which seperator is used '/' or '-'  
		var opera1 = inputText.split('/');  
		var opera2 = inputText.split('-');  
		lopera1 = opera1.length;  
		lopera2 = opera2.length;  
		// Extract the string into month, date and year  
		if (lopera1>1) {  
			//var pdate = inputText.split('/');  
			alert('Format tanggal salah!');  
			$( vbl ).focus();
			return false;
		}else if (lopera2>1){  
			var pdate = inputText.split('-');  
			var dd = parseInt(pdate[0]);  
			var mm  = parseInt(pdate[1]);  
			var yy = parseInt(pdate[2]);  
			// Create list of days of a month [assume there is no leap year by default]  
			var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];  
			if (mm==1 || mm>2){  
			  if (dd>ListofDays[mm-1]){  
				  alert('Format tanggal salah!');  
				  $( vbl ).focus();
				  return false;  
			  }  
			}  
			if (mm==2){  
				var lyear = false;  
				if ( (!(yy % 4) && yy % 100) || !(yy % 400)){  
					lyear = true;  
				}  
				if ((lyear==false) && (dd>=29)){  
					alert('Format tanggal salah!'); 
					$( vbl ).focus();
					return false;  
				}  
				if ((lyear==true) && (dd>29)){  
					alert('Format tanggal salah!');  
					$( vbl ).focus();
					return false;  
				}  
		   }//if (mm==2){  
		}  
		
	}else{  
		alert("Format tanggal salah!");  
		$( vbl ).focus();
		return false;  
	}  
}  //function validatedate(inputText)
function CleanNumber(value) {
    newValue = value.replace(/\,/g, '');
    return newValue;
}
function capitalizeEachWord(str){
	   var words = str.split(" ");
	   var arr = Array();
	   for (i in words){
		  temp = words[i].toLowerCase();
		  temp = temp.charAt(0).toUpperCase() + temp.substring(1);
		  arr.push(temp);
	   }
	   return arr.join(" ");
	}
function pad2(number) {
	return (number < 10 ? '0' : '') + number
}