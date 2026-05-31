// Shuval START
// So old IE doesn't blow up
if (typeof console === 'undefined') {
	window.console = {};
	window.console["log"] = function() {};
	window.console["warn"] = function() {};
}

// Add the printHelper script into the body. Attach this func to the load event
function addScriptHandler() {
	console.log('adding script');
	var printHelperFile;
	if(typeof RESOURCES_ROOT === 'undefined') {
		printHelperFile = "/commonui/javascripts/nisi/ui/printHelper.js";
	} else {
		printHelperFile = RESOURCES_ROOT + '/javascripts/nisi/ui/printHelper.js';
		addRoot(RESOURCES_ROOT);
	}
	var script= document.createElement('script');
	script.type= 'text/javascript';
	script.src= printHelperFile;
	document.body.appendChild(script);
}

// Add RESOURCES_ROOT script to page
function addRoot(root) {
	console.log('adding Resource Root variable');
	var script= document.createElement('script');
	script.type= 'text/javascript';
	script.text = 'var RESOURCES_ROOT = \"' + root + '\";';
	document.getElementsByTagName('head')[0].appendChild(script);
}

// Instead of hooking into window.onload - set an event handler
function setLoadEventHandler(handler) {
	if (window.attachEvent) {
		window.attachEvent('onload', handler);
	}
	else if (window.addEventListener) {
		window.addEventListener('load', handler, false);
	}
	else {
		document.addEventListener('load', handler, false);
	} 
}

setLoadEventHandler(addScriptHandler);

// Just because it's called from multiple places
function loadHelper() {
	// If it's not loaded then just exit, user will click again
	if (typeof printHelper === "undefined") {
		console.warn('Script not loaded! Try again');
		return null;
	}

	console.log('Good to print');
	var h = printHelper();
	return h;
}
// END

var helper;		// Declare in global scope so that it can be used by all funcs

function ProcessImageRequest(imageDivid, action) 
{
    var anchorClass;
     if (imageDivid.indexOf('DepositDetailsList') != -1)
        anchorClass = 'bodytextc';
    else
        anchorClass = 'bodytext';

    var images = document.getElementById(imageDivid).getElementsByTagName("img");
    var divs = document.getElementById(imageDivid).getElementsByTagName("div");
    var anchors = document.getElementById(imageDivid).getElementsByTagName("a");
    var frontLink; var backLink; var enlargeLink; var printLink;
    var actionText;
    // There are 4 anchor tags i.e., Front, Back, enlarge, Print
    if (anchors.length > 0) {

        for (i = 0; i < anchors.length; i++) {
            var anchor = anchors[i];
            if (anchor != null && anchor.getAttribute("id") != null) {
                if (anchor.getAttribute("id").indexOf('Anchor_Front') != -1) {
                    frontLink = anchor.getAttribute("id");
                }
                else if (anchor.getAttribute("id").indexOf('Anchor_Back') != -1) {
                    backLink = anchor.getAttribute("id");
                }
                else if (anchor.getAttribute("id").indexOf('Anchor_Enlarge') != -1) {
                    enlargeLink = anchor.getAttribute("id");
                }
            }
        }
        if (images.length > 0) {
            document.getElementById(images[0].getAttribute("id")).style.height = "204px";
            document.getElementById(images[0].getAttribute("id")).style.width = "509px";
            document.getElementById(frontLink).className = anchorClass;
            if (images[1] != null) {
                document.getElementById(images[1].getAttribute("id")).style.height = "204px";
                document.getElementById(images[1].getAttribute("id")).style.width = "509px";
                document.getElementById(backLink).className = anchorClass;
            }
            if (imageDivid.indexOf('ImageControl') != -1) {
                document.getElementById(frontLink).setAttribute("href", "javascript:ProcessImageRequest('" + imageDivid + "','Front');");
                document.getElementById(backLink).setAttribute("href", "javascript:ProcessImageRequest('" + imageDivid + "','Back');");
            }
            else {
                document.getElementById(frontLink).setAttribute("href", "javascript:ProcessImageRequest('" + imageDivid + "','Front');");
                document.getElementById(backLink).setAttribute("href", "javascript:ProcessImageRequest('" + imageDivid + "','Back');");
            }
            if (action == 'Front') {
                document.getElementById(images[0].getAttribute("id")).style.display = 'block';
                if (images[1] != null) {
                    document.getElementById(images[1].getAttribute("id")).style.display = 'none';
                }

               // var newNode = document.createElement("a");
                //newNode.id = frontLink;
                //newNode.className = "bodytextboldcsm";
                //newNode.innerHTML = document.getElementById(frontLink).innerHTML;
                
                //document.getElementById(frontLink).replaceNode(newNode);
                document.getElementById(frontLink).removeAttribute('href');
                //document.getElementById(frontLink).removeAttribute('className');
                document.getElementById(frontLink).className = 'bodytextboldcsm';
                if (document.getElementById(enlargeLink).firstChild.nodeValue == 'Reduce') {
                    document.getElementById(enlargeLink).firstChild.nodeValue = 'Enlarge';
                }
            }
            else if (action == 'Back') {
                document.getElementById(images[0].getAttribute("id")).style.display = 'none';
                if (images[1] != null) {
                    document.getElementById(images[1].getAttribute("id")).style.display = 'block';
                    document.getElementById(backLink).className = "bodytextboldcsm";
                }

//                var newNode = document.createElement("a");
//                newNode.id = backLink;
//                newNode.className = "bodytextboldcsm";
//                newNode.innerHTML = document.getElementById(backLink).innerHTML;
                //                document.getElementById(backLink).replaceNode(newNode);
                document.getElementById(backLink).removeAttribute('href');
                //document.getElementById(backLink).removeAttribute('className');
                document.getElementById(backLink).className = 'bodytextboldcsm';
                if (document.getElementById(enlargeLink).firstChild.nodeValue == 'Reduce') {
                    document.getElementById(enlargeLink).firstChild.nodeValue = 'Enlarge';
                }
            }
            else if (action == 'Enlarge') {
                if (divs.length != 0) {
                    if (imageDivid.indexOf('ImageControl') != -1) {
                        if (document.getElementById(enlargeLink).firstChild.nodeValue == 'Enlarge') {
                            document.getElementById(enlargeLink).firstChild.nodeValue = 'Reduce';
                            if (document.getElementById(images[0].getAttribute("id")).style.display == 'block') {
                                document.getElementById(images[0].getAttribute("id")).style.height = "450px";
                                document.getElementById(images[0].getAttribute("id")).style.width = "1150px";
                                document.getElementById(frontLink).removeAttribute("href");
                                document.getElementById(frontLink).className = "bodytextboldcsm";
                            }
                            else {
                                if (images[1] != null) {
                                    document.getElementById(images[1].getAttribute("id")).style.height = "450px";
                                    document.getElementById(images[1].getAttribute("id")).style.width = "1150px";
                                    document.getElementById(backLink).removeAttribute("href");
                                    document.getElementById(backLink).className = "bodytextboldcsm";
                                }
                            }
                        }
                        else {
                            document.getElementById(enlargeLink).firstChild.nodeValue = 'Enlarge';
                            if (document.getElementById(images[0].getAttribute("id")).style.display == 'block') {
                                document.getElementById(images[0].getAttribute("id")).style.height = "204px";
                                document.getElementById(images[0].getAttribute("id")).style.width = "509px";
                                document.getElementById(frontLink).removeAttribute("href");
                                document.getElementById(frontLink).className = "bodytextboldcsm";
                            }
                            else {
                                if (images[1] != null) {
                                    document.getElementById(images[1].getAttribute("id")).style.height = "204px";
                                    document.getElementById(images[1].getAttribute("id")).style.width = "509px";
                                    document.getElementById(backLink).removeAttribute("href");
                                    document.getElementById(backLink).className = "bodytextboldcsm";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function ShowErrorImage(imageDivid, errorImageSrc, anchorClass) 
{
    if (document.getElementById('hidImageRendered') != null) 
    {
        document.getElementById('hidImageRendered').value = "error";
    }
    if (imageDivid.indexOf('ImageControl') != -1) {
        var images = document.getElementById(imageDivid).getElementsByTagName("img");
        for (i = 0; i < images.length; i++) {
            images[i].removeAttribute("onload");
            images[i].src = errorImageSrc;
        }
    }
    DisplayImageLinks(imageDivid, anchorClass, 'none');
}

function ShowLinks(imageFace, imageDivid, anchorClass) 
{
    if (imageFace == 'Front') 
    {
        if (document.getElementById('hidImageRendered') != null) 
        {
            if (document.getElementById('hidImageRendered').value == '' || document.getElementById('hidImageRendered').value == null) 
            {
                document.getElementById('hidImageRendered').value = 'front';
            }
            else if (document.getElementById('hidImageRendered').value == 'back') 
            {
                DisplayImageLinks(imageDivid, anchorClass, 'block');
            }
        }
    }
    else if (imageFace == 'Back') 
    {
        if (document.getElementById('hidImageRendered') != null)
        {
            if (document.getElementById('hidImageRendered').value == '' || document.getElementById('hidImageRendered').value == null) 
            {
                document.getElementById('hidImageRendered').value = 'back';
            }
            else if (document.getElementById('hidImageRendered').value == 'front') 
            {
                DisplayImageLinks(imageDivid, anchorClass, 'block');
            }
        }
    }
}

function DisplayImageLinks(imageDivid, anchorClass, displayStyle) 
{
    var anchors = document.getElementById(imageDivid).getElementsByTagName("a"),
		i;
    for (i = 0; i < anchors.length; i++) 
    {
        anchors[i].style.display = displayStyle;
    }
}
function PrintDepositSlip(printDivId, depositSlipNumber) 
{
	helper = loadHelper();
	if (helper === null) {
		return;
	}

    var HTMLContent = "";
    HTMLContent += SetPageTitleAndDate();
    HTMLContent += '<tr><td>&nbsp;</td><td align=left class=bodytextbold colspan=2>Deposit Slip for Deposit Number&nbsp;' + depositSlipNumber + '</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 align=center>';    
    HTMLContent += PrintImages(printDivId);
	/*
	 * Replaced due to cross domain issues
    var pWin = window.open('', 'DepositSlip', 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes');
    pWin.document.open();
    pWin.document.write(HTMLContent);
    pWin.document.close();
	*/

    // Store the content on the page: insert content into an element
	helper.storeContent(HTMLContent);
	
	// Store RESOURCES_ROOT in a hidden field: this will be used in Print.html
	helper.setResourceRoot(RESOURCES_ROOT);

	// Have to set our domain sadly
	document.domain = helper.getDomain();

    // Put the print page (and this file) in chase-resources. Can then be accessed by anyone - but means they're all cross domain.
    var name = RESOURCES_ROOT + '/javascripts/nisi/ui/html/Print.html';
    var options = 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes';
    var win = window.open(name, 'Print', options);
	win.focus();
}
function PrintDepositCheckImages(printDivId, acctNumber, chkAmount, chkNumber, rtngNumber, postDate) 
{
 	helper = loadHelper();
	if (helper === null) {
		return;
	}

    var HTMLContent = "";
    HTMLContent += SetPageTitleAndDate();
    HTMLContent += '<tr><td>&nbsp;</td><td align=left class=bodytextbold colspan=2>Check Details for Check Number&nbsp;' + chkNumber + '</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2><table width=100%><tr class=bodytextbold><td width=15%>Post Date</td><td width=18% align=right>Amount</td><td width=32% align=right>Account number</td><td width=30% align=right>Routing number</td><td  width=25%>&nbsp;</td></tr>';
    HTMLContent += '<tr class=bodytext5sm><td width=15%>' + postDate + '</td><td width=18% align=right>' + chkAmount + '</td><td width=32% align=right>' + acctNumber + '</td><td width=30% align=right>' + rtngNumber + '</td><td width=25%>&nbsp;</td></tr>';
    HTMLContent += '</table></td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td colspan=4 class=spacerh20></td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td align=left colspan=2 class=bodytextbold>&nbsp;&nbsp;Check Images (Front and Back)</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 align=center>';
    HTMLContent += PrintImages(printDivId);
	/*
	 * Replaced due to cross domain issues
    var pWin = window.open('', 'DepositDetails', 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes');
    pWin.document.open();
    pWin.document.write(HTMLContent);
    pWin.document.close();
	*/

    // Store the content on the page: insert content into an element
	helper.storeContent(HTMLContent);

	// Store RESOURCES_ROOT in a hidden field: this will be used in Print.html
	helper.setResourceRoot(RESOURCES_ROOT);
	
	// Have to set our domain sadly
	document.domain = helper.getDomain();

    // Put the print page (and this file) in chase-resources. Can then be accessed by anyone - but means they're all cross domain.
    var name = RESOURCES_ROOT + '/javascripts/nisi/ui/html/Print.html';
    var options = 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes';
    var win = window.open(name, 'Print', options);
	win.focus();
}

function PrintReturnedDepositCheckImages(printDivId, acctNumber, chkAmount, chkNumber, rtngNumber, postDate, reasonForReturn) 
{
	helper = loadHelper();
	if (helper === null) {
		return;
	}

    var HTMLContent = "";
    HTMLContent = SetPageTitleAndDate();
    HTMLContent += '<tr><td>&nbsp;</td><td align=left class=bodytextbold colspan=2>Check Details for Returned Check Number&nbsp;' + chkNumber + '</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    // HTMLContent += '<tr><td colspan=4 class=spacerh5></td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2><table width=100%><tr class=bodytextbold><td width=8%>Post Date</td><td width=10% align=right>Amount</td><td width=18% align=right>Account number</td><td width=13% align=right>Routing number</td><td width=5%>&nbsp;</td><td  width=15%>Reason for return</td></tr>';
    HTMLContent += '<tr class=bodytext5sm><td width=8%>' + postDate + '</td><td width=10% align=right>' + chkAmount + '</td><td width=18% align=right>' + acctNumber + '</td><td width=13% align=right>' + rtngNumber + '</td><td width=5%>' + '&nbsp;' + '</td><td width=15%>' + reasonForReturn.replace(/@/g, "'") + '</td></tr>';
    //HTMLContent += '<tr><td colspan=5><table><tr align=left><td class=bodytext5sm><strong>Explanation</strong></td></tr><tr><td>&nbsp;</td><td class=bodytext5sm>' + document.getElementById(longReasonDescId).innerHTML + '</td></tr></table></td></tr>';
    HTMLContent += '</table></td><td>&nbsp;</td></tr>';
    // HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td colspan=4 class=spacerh20></td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td align=left colspan=2 class=bodytextbold>&nbsp;Returned Check Images (Front and Back)</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr3>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 align=center>';
    HTMLContent += PrintImages(printDivId);
	/*
	 * Replaced due to cross domain issues
    var pWin = window.open('', 'ReturnedDeposits', 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes');
    pWin.document.open();
    pWin.document.write(HTMLContent);
    pWin.document.close();
	*/

    // Store the content on the page: insert content into an element
	helper.storeContent(HTMLContent);

	// Store RESOURCES_ROOT in a hidden field: this will be used in Print.html
	helper.setResourceRoot(RESOURCES_ROOT);
	
	// Have to set our domain sadly
	document.domain = helper.getDomain();

    // Put the print page (and this file) in chase-resources. Can then be accessed by anyone - but means they're all cross domain.
    var name = RESOURCES_ROOT + '/javascripts/nisi/ui/html/Print.html';
    var options = 'directories=0,height=480,width=578,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=yes';
    var win = window.open(name, 'Print', options);
	win.focus();
}

function SetPageTitleAndDate() 
{
	helper = loadHelper();
	if (helper === null) {
		return;
	}

    var HTMLContent = "";
    var HTMLHeadContent = document.getElementsByTagName("HEAD");
    var PageTitle = GetTitle();
    //var dateToday = TodayDate();
    HTMLContent = '<HTML>';
    var head = helper.analyzeHeadNode(HTMLHeadContent[0]);
	var style = '<style>.blackbdr5 {BORDER-TOP: black 5px solid; MARGIN-TOP: 2px }.blackbdr3 {BORDER-TOP: black 3px solid; MARGIN-TOP: 4px; ZOOM: 1 }</style>'; 
    HTMLContent += '<head>' + head.innerHTML + style + '</head>';
//    HTMLContent += '<head>' + HTMLHeadContent[0].innerHTML + '<style>.blackbdr5 {BORDER-TOP: black 5px solid; MARGIN-TOP: 2px }.blackbdr3 {BORDER-TOP: black 3px solid; MARGIN-TOP: 4px; ZOOM: 1 }</style></head>';
    HTMLContent += '<body class="printWidth" onload="PostProcess();">';
    HTMLContent += '<table cellspacing="0" cellpadding="0" border="0" width=100%><tr>';
    HTMLContent += '<td class=spacerH20 colspan=4></td></tr><tr>';
    HTMLContent += '<td class=spacerH20 colspan=4></td></tr><tr>';
    HTMLContent += '<td class=spacerH20 colspan=4></td></tr><tr><td width=20%>&nbsp;</td>';
    HTMLContent += '<td class=bodytextbold align=left>' + PageTitle + '</td><td class=bodytextbold align=right>' + TodayDate(); +'</td>';
    HTMLContent += '<td width=17%>&nbsp;</td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 class=blackbdr5>&nbsp;</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td colspan=4 class=spacerh10></td></tr>';
    return HTMLContent;
}
function PrintImages(printDivId) 
{
    var HTMLContent = "";
    var PrintDivs = document.getElementById(printDivId).getElementsByTagName("div"),
		i;
    for (i = 0; i < PrintDivs.length; i++) {
        var PrintDiv = PrintDivs[i];

        if (printDivId.indexOf('ImageControl') != -1) {
            if (PrintDiv != null && PrintDiv.getAttribute("id") != null && PrintDiv.getAttribute("id").indexOf('ImageDiv') != -1) {
                printDivId = PrintDiv.getAttribute("id");
                break;
            }
        }
        else {
            if (printDiv != null && PrintDiv.getAttribute("id") != null && PrintDiv.getAttribute("id").indexOf('InnerDiv') != -1) {
                printDivId = PrintDiv.getAttribute("id");
                break;
            }
        }
    }
    var images = document.getElementById(printDivId).getElementsByTagName("img");
    for (i = 0; i < images.length; i++) 
    {
        if (images[i] != null) 
        {
            if (images[i].src != null || images[i].src != "") 
            {
                images[i].removeAttribute("onload");
                images[i].removeAttribute("onerror");
                if (images[i].style.display == 'none') 
                {
                    images[i].style.display = 'block';
                    if (images[i].style.height == '450px') 
                    {
                        images[i].style.height = '204px';
                        images[i].style.width = '509px';
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += getOuterHTML(images[i]);
                        HTMLContent += '</td><td align=top valign=top>&nbsp;</td></tr></table>';
                        images[i].style.height = '450px';
                        images[i].style.width = '1150px';
                    }
                    else 
                    {
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += getOuterHTML(images[i]);
                        HTMLContent += '</td><td align=top valign=top>&nbsp;</td></tr></table>';
                        HTMLContent += '</td><td align=top></td></tr></table>';
                    }
                    images[i].style.display = 'none';
                }
                else 
                {
                    if (images[i].style.height == '450px') 
                    {
                        images[i].style.height = '204px';
                        images[i].style.width = '509px';
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += getOuterHTML(images[i]);
                        HTMLContent += '</td><td align=top valign=top>&nbsp;</td></tr></table>';
                        images[i].style.height = '450px';
                        images[i].style.width = '1150px';
                    }
                    else 
                    {
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += '<table width=100%><tr><td>';
                        HTMLContent += getOuterHTML(images[i]);
                        HTMLContent += '</td><td align=top valign=top>&nbsp;</td></tr></table>';
                        HTMLContent += '</td><td align=top></td></tr></table>';
                    }
                }
                HTMLContent += "<br><br>";
            }
        }
    }
    HTMLContent += '</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td class=spacerH20 colspan=4></td></tr>';
    HTMLContent += '<tr><td class=spacerH20 colspan=4></td></tr>';
    HTMLContent += '<tr><td>&nbsp;</td><td colspan=2 align=center class=footertext>This information is provided for your convenience and does not replace your monthly account statement(s), which are the official records of your accounts and does not replace any other notice we send you. JPMorgan chase Bank, N.A. Member FDIC</td><td>&nbsp;</td></tr>';
    HTMLContent += '<tr><td colspan=4 align=center class=footertext>';
    var footerDivs = document.getElementsByTagName("td");
    for (i = 0; i < footerDivs.length; i++) 
    {
        var footerDiv = footerDivs[i];
        if (footerDiv.className == "footertext") 
        {
            HTMLContent += footerDiv.innerHTML;
        }
    }
    HTMLContent += '\n</td></tr></table>';
	//TODO: this script reference may not work!!! It's relative and should be absolute
	// Making it absolute
	var defaultjs = window.location.protocol + '//' + window.location.hostname + '/js/default.js';
    HTMLContent += '<script src="' + defaultjs + '" type="text/javascript"></script>';
//    HTMLContent += '<script src="../js/default.js" type="text/javascript"></script>';
    HTMLContent += '\n<script TYPE="text/Javascript" LANGUAGE="JavaScript">';
    HTMLContent += '\nfunction PostProcess()';
    HTMLContent += '\n{';
    HTMLContent += '\n	var Images = document.getElementsByTagName("img");';
    HTMLContent += '\n	for(i=0; i < Images.length; i++)';
    HTMLContent += '\n	{';
    HTMLContent += '\n		var Image = Images[i];';
    HTMLContent += '\n		Image.removeAttribute("onload");';
    HTMLContent += '\n		Image.style.display = "block";';
    HTMLContent += '\n		Image.style.height = "204px";';
    HTMLContent += '\n		Image.style.width = "509px";';
    HTMLContent += '\n	}';
    HTMLContent += '\n	var Anchors = document.getElementsByTagName("a");';
    HTMLContent += '\n	for(i=0; i < Anchors.length; i++)';
    HTMLContent += '\n	{';
    HTMLContent += '\n		var Anchor = Anchors[i];';
    HTMLContent += '\n		Anchor.style.display = "none";';
    HTMLContent += '\n	}';
    HTMLContent += '\n	var agt=navigator.userAgent.toLowerCase();';
    HTMLContent += '\n	if( !( agt.indexOf("msie")!=-1 && (parseInt(agt.substr(agt.indexOf("msie")+5,1))==4)))';
    HTMLContent += '\n	{';
    HTMLContent += '\n	  window.print();';
    HTMLContent += '\n	}';
    HTMLContent += '\n}';
    HTMLContent += '\n</script></body></html>';
    return HTMLContent;
}

function GetTitle() 
{
    var tElement = document.getElementsByTagName("TITLE");
    var text = tElement[0].innerHTML;
    var retVal = "";
    var start = text.indexOf(" -");
    if (start >= 0) { retVal = text.substr(0, start); }
    return retVal;

}

function TodayDate() 
{
    var Today = new Date();
    var ThisDay = Today.getDay();
    var ThisDayName = new Array();
    ThisDayName[0] = "Sunday";
    ThisDayName[1] = "Monday";
    ThisDayName[2] = "Tuesday";
    ThisDayName[3] = "Wednesday";
    ThisDayName[4] = "Thursday";
    ThisDayName[5] = "Friday";
    ThisDayName[6] = "Saturday";
    var ThisDate = Today.getDate();
    var ThisMonth = Today.getMonth() + 1;

    if (navigator.appName.indexOf("Microsoft") != -1) {
        var ThisYear = Today.getYear();

    }
    if ((navigator.appName.indexOf("Netscape") != -1) || (navigator.appName.indexOf("Firefox") != -1)) {
        var ThisYear = Today.getYear();
        ThisYear = (ThisYear + 1900);

    }
    else {
        var ThisYear = Today.getYear();

    }

    function MonthText(ThisMonth) {
        var aMonth = [];
        aMonth[1] = "January";
        aMonth[2] = "February";
        aMonth[3] = "March";
        aMonth[4] = "April";
        aMonth[5] = "May";
        aMonth[6] = "June";
        aMonth[7] = "July";
        aMonth[8] = "August";
        aMonth[9] = "September";
        aMonth[10] = "October";
        aMonth[11] = "November";
        aMonth[12] = "December";
        return aMonth[ThisMonth];
    }
    var thisMonthName = MonthText(ThisMonth);
    function DayDisplay(ThisDate) {
        var Day = [];
        Day[1] = "01";
        Day[2] = "02";
        Day[3] = "03";
        Day[4] = "04";
        Day[5] = "05";
        Day[6] = "06";
        Day[7] = "07";
        Day[8] = "08";
        Day[9] = "09";
        Day[10] = "10";
        Day[11] = "11";
        Day[12] = "12";
        Day[13] = "13";
        Day[14] = "14";
        Day[15] = "15";
        Day[16] = "16";
        Day[17] = "17";
        Day[18] = "18";
        Day[19] = "19";
        Day[20] = "20";
        Day[21] = "21";
        Day[22] = "22";
        Day[23] = "23";
        Day[24] = "24";
        Day[25] = "25";
        Day[26] = "26";
        Day[27] = "27";
        Day[28] = "28";
        Day[29] = "29";
        Day[30] = "30";
        Day[31] = "31";
        return Day[ThisDate];
    }
    var DayValue = DayDisplay(ThisDate);
    var dateValue = ThisDayName[ThisDay] + ", " + thisMonthName + " " + DayValue + ", " + ThisYear;
    return dateValue;
}
function getOuterHTML(node) {
	// Make src attribute absolute (else we can't see the check images)
	try {	// just in case!
		if (node.attributes['src'] !== undefined) {
			node.attributes['src'].value = helper.normalize(node.attributes['src'].value);
		}
	} catch (e) {
		console.warn("Can't understand src att: " + e);
	}

    if (node.outerHTML) {
        return node.outerHTML;
    } else if (node.parentNode && node.parentNode.nodeType == 1) {
        var el = document.createElement(node.parentNode.nodeName);
        el.appendChild(node.cloneNode(true));
        return el.innerHTML;
    }
    return "";
}
