var myWindow;

function openWin(referrer) {
	console.log(referrer);
	myWindow = window.open(referrer, "new_window", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400" );
    myWindow.focus();
}

function closeWin() {
    myWindow.close();
}