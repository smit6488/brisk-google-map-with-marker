$ = jQuery;
function copyText(element) {
	var copyTxt = document.getElementById("shortcode");
    console.log(copyTxt);
    copyTxt.select();
  	copyTxt.setSelectionRange(0, 99999);
  	navigator.clipboard.writeText(copyTxt.value);
}