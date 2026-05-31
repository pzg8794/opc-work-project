CHASE.TagManager.xpoActivity=function(E,B,G,D,C){var A={xpo:{}};
if(D&&D!=null){A.xpo.productId=D
}if(B&&B!=null){A.xpo.AppID=B
}if(G&&G!=null){A.xpo.TagMap=G
}if(E&&E!=null){A.xpo.OrgID=E
}if(C&&C!=null){A.xpo.sourceCode=C
}var D=D||"{xpo.productId}";
var C=C||"";
var F="stg";
if(CHASE.TagManager.clientVars.env=="prod"){F="s"
}var H="https://"+F+".xp1.ru4.com/meta?_o={xpo.OrgID}";
H=H+"&_t={xpo.AppID}";
H=H+"&ssv_tmc={xpo.TagMap}";
H=H+"&ssv_v1st={v1st}";
H=H+"&ssv_pfid={persona.pfid}";
H=H+"&ssv_productid={xpo.productId}";
H=H+"&ssv_src={xpo.sourceCode}";
H=H+"&ssv_eci={persona.ECI}";
H=H+"&_eid={xpo.TagMap}_{xpo.productId}_{xpo.sourceCode}";
CHASE.TagManager.invokePixelTag(H,A)
};
CHASE.TagManager.bluekai=function(){var A={bluekai:{}};
var C="https://stags.bluekai.com/site/5473?limit=10&ret=html&";
C=C+"phint=v1st%3D{v1st}";
C=C+"&phint=ECI%3D{persona.ECI}";
C=CHASE.TagManager.replacePlaceholder(C,A);
if(CHASE.TagManager.testMode){CHASE.TagManager.requestPixel(C)
}else{var B=document.createElement("iframe");
B.style.display="none";
B.src=C;
document.body.appendChild(B)
}};
CHASE.TagManager.insightAdImpression=function(B,D,F){if(CHASE&&CHASE.analytics){CHASE.analytics.setPageDotUrl(window.location.href)
}var C=CHASE.analytics.config.PageDotDomain||"",A=CHASE.analytics.config.PageDotImagePath||"",G=C+A+"&wa_cb={random}",E=D?"&jp_aid_p="+D+"/"+F:"";
G+="&wa_aid_i="+B+E+"&wa_tp=13&wa_uri="+document.location;
G=CHASE.TagManager.invokePixelTag(G)
};
CHASE.TagManager.ExtensionsLoaded=true;
CHASE.TagManager.insightAdClick=function(B,D,F){if(CHASE&&CHASE.analytics){CHASE.analytics.setPageDotUrl(window.location.href)
}var C=CHASE.analytics.config.PageDotDomain||"",A=CHASE.analytics.config.PageDotImagePath||"",G=C+A+"&wa_cb={random}",E=D?"&jp_aid_p="+D+"/"+F:"";
G+="&wa_aid_lnk="+B+E+"&wa_tp=13&wa_uri="+document.location;
G=CHASE.TagManager.invokePixelTag(G)
};
CHASE.TagManager.insightLinkTrack=function(A){if(CHASE&&CHASE.analytics){CHASE.analytics.trackCustomLink(A)
}};
CHASE.TagManager.insightFormTrack=function(A){if(A){A=document.forms[A];
if(CHASE&&CHASE.analytics){CHASE.analytics.initLinkFormTracking(A)
}}};
CHASE.TagManager.audienceSyndication=function(){var C=function(F,H){var D="_"+(+new Date()),E=document.createElement("script"),G=document.getElementsByTagName("head")[0]||document.documentElement;
window[D]=function(I){G.removeChild(E);
H&&H(I.Nodes)
};
E.src=F.replace("callback=?","callback="+D);
G.appendChild(E)
},A=function(){var F,E,I;
var H="stg";
if(CHASE.TagManager.clientVars.env=="prod"){H="s"
}I="https://"+H+".xp1.ru4.com/wsb/15629/poe/59242226?_u=[ECI]&Debug=false&Test=false&ContentType=application/json&TransactionID=eee-444";
var F=CHASE.TagManager.replacePlaceholder("{persona.ECI}")||"null";
if(F=="null"){E="?_u="
}else{E="?_u="+F
}I=I.replace("?_u=[ECI]",E);
var D=CHASE.TagManager.replacePlaceholder("{persona.pfid}")||"null";
var J='"ssv_zip":"{persona.zip}", "ssv_product":"", "ssv_locale":"{persona.locale}", "ssv_cigseg":"{persona.segment}"';
J=CHASE.TagManager.replacePlaceholder(J);
if(I){var G="{";
G+='"UserAgent":"",';
G+='"GUID":"'+D+'",';
G+='"IPAddress":"",';
G+='"XP_UID":"",';
G+='"URL":"'+encodeURIComponent(location.href)+'",';
G+='"Referrer":"'+encodeURIComponent(encodeURIComponent(document.referrer))+'",';
G+='"ForceUIDMatch":false,';
G+='"CreateXPUID":true,';
G+='"Data":{';
G+='"ssv_pfid":"'+D+'",';
G+=J;
G+="}";
G+="}";
I=I+"&RequestObject="+G+"&callback=?";
C(I,B)
}},B=function(D){var E="https://googleads.g.doubleclick.net/pagead/viewthroughconversion/123456789/?value=0&label=pybDCLndxgIQp5yP5gg&guid=ON&script=0&URL="+document.domain;
E=E+"/audiences/"+D;
E=CHASE.TagManager.invokePixelTag(E)
};
A()
};