var Children = new Array();

function OpenWindow(url, name, width, height)
{
  if( url == null || url == "" ||url == "undefined")
  { return false; }
  else
  {
    var handle =   window.open(url, name,"scrollbars=yes,screenX=25,screenY=25,directories=0,height=" + height + ",width=" + width + ",location=no,menubar=no,resizable=yes,status=no,toolbar=no"); +
    Children.push(handle);
    handle.focus();
    return handle;
  }
}

function OpenWindowStandard(url)
{ OpenWindow(url, "popup", 775, 525);}

function OpenWindowFull(url)
{ OpenWindow(url, "popup", screen.width, screen.height);}

function OpenWindowHelp(url)
{ OpenWindow(url, "help", 578, 400);}

function OpenWindowDisclosure(url)
{ OpenWindow(url, "SecureMessagingWindow", 700, 800);}

function OpenCalendar(url)
{ return OpenWindow(url, "calendar", 250, 200); }

function openPfmWin(url)
{ OpenWindow(url, "popup", 1024, 1240); }

//Should be deprecated.
var SecureWinHandle;
//Should be deprecated.
function openNewWindow( secureWinURL )
{
  if(document.layers)
  { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", 650, 500);  }
  else
  { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", 636, 500);  }
}

//Should be deprecated.
function openNewWindow990X600Size(secureWinURL) {
    if (document.layers)
    { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", 990, 600); }
    else
    { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", 976, 600); }
}

//Should be deprecated.
function openFullWindow( secureWinURL )
{
  if(document.layers)
  { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", screen.width, screen.height); }
  else
  { SecureWinHandle = OpenWindow(secureWinURL, "SecureMessagingWindow", screen.width, screen.height);  }
}

//Should be deprecated.
function openSecureWin(secureWinURL) { SecureWinHandle = openNewWindow(secureWinURL); }

//Should be deprecated.
function openSecureWin990X600Size(secureWinURL) { SecureWinHandle = openNewWindow990X600Size(secureWinURL); }

//created for backwards compatability
//Should be deprecated.
function Popup(url, name, width, height){OpenWindow(url, name, width, height);}

//created for backwards compatability
//Should be deprecated.
function StandardPopup(url){OpenWindowStandard(url);}

function ShowHelp(URL){OpenWindowHelp(URL);}

function ToggleActivityList(openDiv, closeDiv)
{
  document.getElementById(openDiv).style.display=''; 
  document.getElementById(closeDiv).style.display='none';
} 

var cal,target;
function HandleFocus()
{
  if (cal)
  {
    if(!cal.closed){cal.focus();}
    else{window.top.onfocus = "";}
  }
  return false;
}

function ShowCalendar(url, destId)
{
  target = document.forms[0].elements[destId];
  var query = url + target.value;
  cal = OpenCalendar(query);
}

function SetDate(date)
{
  target.value = date;
  target.focus();
  cal.close();
  if (target.onchange){target.onchange();}
}

function CheckSearch(e)
{
  var key, keychar;
  if(window.event){key = e.keyCode;}
  else if(e.which){key = e.which;}
  if(key == 13){Search();return false;}
  return true;
}

function Search()
{
  var field = document.getElementById('searchText');
  var url = searchUrl + "?Q=" + field.value;
  location.replace(url);
}

function FireEvent(obj, name)
{
  if(document.createEvent)
  {var ev = document.createEvent("MouseEvents");ev.initEvent(name, true, true);obj.dispatchEvent(ev);}
  else{obj.fireEvent("on" + name);}
}

var isNN = (navigator.appName.indexOf('Netscape')!=-1);
if(isNN) document.captureEvents(Event.KEYPRESS);
function TabNext(obj, len, e, next)
{
  var keyCode = (isNN)?e.which:e.keyCode;
  var filter = [0,8,9,16,17,18,37,38,39,40,46];
  if(obj.value.length >= len && !containsElement(filter,keyCode)) 
  {
    obj.value = obj.value.slice(0,len);
    FireEvent(obj, "change");    
    if(next == null)
    {
			var form = obj.form;
			for(var index=0;index < form.length; index++)
			{	if(form[index] == obj)	{break;}  }
			next = obj.form[index+1];
		}
		if( next == null)	{return;}
    next.focus();
    next.select();
   }
 }

function containsElement(filter, keyCode)
{
  var found = false, index = 0;
  while(!found && index < filter.length)
  {
    if(filter[index]==keyCode)
    {found = true;}
    else{index++;}
  }
   return found;
}

var isSubmited = false;
function DoSubmit()
{
  if(isSubmited == true){return false;}
  else if(window.PreSubmit){return PreSubmit();}
  isSubmited=true;
}
function openFullScreen(url)
{
 window.open (url,'','status=1');  
}
function fullScreen(url)
{
 window.open(url,'','fullscreen=yes, scrollbars=auto');
}

function OpenWin(url, name, width, height)
{ OpenWindow(url, name, width, height); }

function winopen(url,warn)
{ 
  var action = true;
  var handle = "";
  var msg = "You may already have an open online investment session. Click 'Cancel' to continue working in your current session or 'OK' if you still want to open a new window.";
  if(warn == "true")
    action = window.confirm(msg);
 
  if (action)
  {
    handle = window.open(url,'popup_window');
    if(handle != null || handle != "")
      handle.focus();
  }
}