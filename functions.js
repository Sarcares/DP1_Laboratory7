/* --- This file contains some javascript functions for the exercise 6 --- */

/**
 * This function split a string using the "&" as separator.
 * Tips: Give as parameter window.location.search for extracting the variables of a html get.
 *
 * @param str 
 * @returns {Array[*]}
 *
 * @data 12/06/15.
 */

function splitParams(str){
    params = decodeURIComponent(str).substring(1).split("&");

    for(var i=0; i<params.length; i++){
        params[i] = params[i].split("=")[1];
    }
    return params;
}

/** 
 * This function print a table with the square and the cube power of the number from 1 to n
 **/
function square_cube(n) {
	if( (isNaN(n))||(n==="")||(n===null) ) {
		document.write("<p>Input error!<BR>" +n+" is not a number!<BR></p>");
	}
	else if(n<1) {
		document.write("<p>Input error!<BR>The number have to be greater then zero!<BR>You digited "+n+"</p>");
	}
	else {
		document.write("<h4>Entered number = "+n);
		document.write("<TABLE id='tabella'><TR> <TH>Value</TH> <TH>Power of 2</TH> <TH>Power of 3</TH> </TR>");
		var quadrato, cubo;
		for(var i=1; i<=n; i++) {
			quadrato = Math.pow(i,2);
			cubo = Math.pow(i, 3);
			document.write("<TR><TD>"+i+"</TD><TD>"+quadrato+"</TD><TD>"+cubo+"</TD></TR>");
		}
		document.write("</TABLE><BR>");
	}
}

/**
 *  This function remove a cookie (or more cookies?)
 */
function deleteCookie( name ) {
	document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}