var winArray = new Array();

function bolPopupURLClose(aURL){
winArray[winArray.length] = window.open(aURL,"bol","directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes");
var agt=navigator.userAgent.toLowerCase(); 
}
function bolCloseChildren()
{
	for(i=0;i<winArray.length;i++)
	{
		// check if window wasn't already closed 
		if (winArray[i] && !winArray[i].closed) 
		{	
		  winArray[i].close();
		}		
	}
	winArray.length = 0;
}


function bolInfoIconPopup(aURL){
var newWin = winArray[winArray.length] = window.open(aURL,"bol","scrollbars=yes,screenX=0,screenY=0,directories=0,height=300,width=500,location=no,menubar=no,resizable=yes,status=no,toolbar=no");
var agt=navigator.userAgent.toLowerCase(); 
newWin.focus();
}

function bolInfoIconClose(){
	for(i=0;i<winArray.length;i++)
	{
		  winArray[i].close();
	}
	winArray.length = 0;
}

function openClose(valuePassed) {
	closeAll();
	getItem = "linkBox" + valuePassed + "closed";
	if(document.getElementById)
	{
		thisName = document.getElementById(getItem).style;
		thisName.display = "none";
		thisName.visibility = "hidden";
		getItem = "linkBox" + valuePassed + "open";
		thisName = document.getElementById(getItem).style;
		thisName.display = "block";
		thisName.visibility = "visible";
	}
}

function openClose2(valuePassed) {
	closeAll4();
	getItem = "linkBox" + valuePassed + "closed";
	if(document.getElementById)
	{
		thisName = document.getElementById(getItem).style;
		thisName.display = "none";
		thisName.visibility = "hidden";
		getItem = "linkBox" + valuePassed + "open";
		thisName = document.getElementById(getItem).style;
		thisName.display = "block";
		thisName.visibility = "visible";
	}
}

function closeAll () {
for (x=1; x<2; x++)
	{
		if(document.getElementById)
		{
		getItem = "linkBox" + x + "closed";
		thisName = document.getElementById(getItem).style;
		thisName.display = "block";
		thisName.visibility = "visible";
		getItem = "linkBox" + x + "open";
		thisName = document.getElementById(getItem).style;
		thisName.display = "none";
		thisName.visibility = "hidden";
		
		}
	}
}

function closeAll4 () {
for (x=1; x<4; x++)
	{
		if(document.getElementById)
		{
		getItem = "linkBox" + x + "closed";
		thisName = document.getElementById(getItem).style;
		thisName.display = "block";
		thisName.visibility = "visible";
		getItem = "linkBox" + x + "open";
		thisName = document.getElementById(getItem).style;
		thisName.display = "none";
		thisName.visibility = "hidden";
		
		}
	}
}

function PopupHC(aURL)
{
	var newWin=window.open(aURL,"bol","directories=0,height=400,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no");
	var agt=navigator.userAgent.toLowerCase(); 
	if(!(agt.indexOf("msie")!=-1 && (parseInt(agt.substr(agt.indexOf("msie")+5,1))==4))){
	newWin.focus();
	}
}

function ImportDialogBoxOpen(boxVal)
{
	browser = (((navigator.appName == "Microsoft Internet Explorer") && 
	(parseInt(navigator.appVersion) >= 4 )))
	if (browser)
	{
		document.all[boxVal].style.visibility='visible';
	}
	if(document.getElementById)
	{
	document.getElementById(boxVal).style.visibility="visible";
	}
	else
	{
	document.boxVal.visibility="show";
	}
}

function ImportDialogBoxClose(boxVal)
{
	browser = (((navigator.appName == "Microsoft Internet Explorer") && 
	(parseInt(navigator.appVersion) >= 4 )))
	if (browser)
	{
		document.all[boxVal].style.visibility='hidden';
	}
	if(document.getElementById)
	{
	document.getElementById(boxVal).style.visibility="hidden";
	}
	else
	{
		document.boxVal.visibility="hide";
	}
}

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

isValid = true;
var isNN = (navigator.appName.indexOf("Netscape")!=-1);
if(isNN)
  document.captureEvents(Event.KEYPRESS);
function bolAutoTab(input,len, e){
  var keyCode = (isNN)?e.which:e.keyCode; 
  var filter = (isNN)?[0,8,9]:[0,8,9,16,17,18,37,38,39,40,46];
  if(input.value.length >= len && !containsElement(filter,keyCode)){
    input.value = input.value.slice(0,len);
    input.form[(getIndex(input)+1)%input.form.length].focus();
    input.form[(getIndex(input)+1)%input.form.length].select();
  }
  function containsElement(arr, ele){
    var found = false, index = 0;
    while(!found && index < arr.length)
      if(arr[index]==ele)
        found = true;
      else
        index++;
    return found;
  }
  function getIndex(input){
    var index = -1, i = 0, found = false;
    while (i < input.form.length && index==-1)
      if (input.form[i] == input)index = i;
      else i++;
    return index;
  }
  return true;
}



