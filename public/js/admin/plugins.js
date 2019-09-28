/**
 * Swiper 4.5.1
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * http://www.idangero.us/swiper/
 *
 * Copyright 2014-2019 Vladimir Kharlampidi
 *
 * Released under the MIT License
 *
 * Released on: September 13, 2019
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).Swiper=t()}(this,function(){"use strict";var f="undefined"==typeof document?{body:{},addEventListener:function(){},removeEventListener:function(){},activeElement:{blur:function(){},nodeName:""},querySelector:function(){return null},querySelectorAll:function(){return[]},getElementById:function(){return null},createEvent:function(){return{initEvent:function(){}}},createElement:function(){return{children:[],childNodes:[],style:{},setAttribute:function(){},getElementsByTagName:function(){return[]}}},location:{hash:""}}:document,ee="undefined"==typeof window?{document:f,navigator:{userAgent:""},location:{},history:{},CustomEvent:function(){return this},addEventListener:function(){},removeEventListener:function(){},getComputedStyle:function(){return{getPropertyValue:function(){return""}}},Image:function(){},Date:function(){},screen:{},setTimeout:function(){},clearTimeout:function(){}}:window,l=function(e){for(var t=0;t<e.length;t+=1)this[t]=e[t];return this.length=e.length,this};function I(e,t){var a=[],i=0;if(e&&!t&&e instanceof l)return e;if(e)if("string"==typeof e){var s,r,n=e.trim();if(0<=n.indexOf("<")&&0<=n.indexOf(">")){var o="div";for(0===n.indexOf("<li")&&(o="ul"),0===n.indexOf("<tr")&&(o="tbody"),0!==n.indexOf("<td")&&0!==n.indexOf("<th")||(o="tr"),0===n.indexOf("<tbody")&&(o="table"),0===n.indexOf("<option")&&(o="select"),(r=f.createElement(o)).innerHTML=n,i=0;i<r.childNodes.length;i+=1)a.push(r.childNodes[i])}else for(s=t||"#"!==e[0]||e.match(/[ .<>:~]/)?(t||f).querySelectorAll(e.trim()):[f.getElementById(e.trim().split("#")[1])],i=0;i<s.length;i+=1)s[i]&&a.push(s[i])}else if(e.nodeType||e===ee||e===f)a.push(e);else if(0<e.length&&e[0].nodeType)for(i=0;i<e.length;i+=1)a.push(e[i]);return new l(a)}function r(e){for(var t=[],a=0;a<e.length;a+=1)-1===t.indexOf(e[a])&&t.push(e[a]);return t}I.fn=l.prototype,I.Class=l,I.Dom7=l;var t={addClass:function(e){if(void 0===e)return this;for(var t=e.split(" "),a=0;a<t.length;a+=1)for(var i=0;i<this.length;i+=1)void 0!==this[i]&&void 0!==this[i].classList&&this[i].classList.add(t[a]);return this},removeClass:function(e){for(var t=e.split(" "),a=0;a<t.length;a+=1)for(var i=0;i<this.length;i+=1)void 0!==this[i]&&void 0!==this[i].classList&&this[i].classList.remove(t[a]);return this},hasClass:function(e){return!!this[0]&&this[0].classList.contains(e)},toggleClass:function(e){for(var t=e.split(" "),a=0;a<t.length;a+=1)for(var i=0;i<this.length;i+=1)void 0!==this[i]&&void 0!==this[i].classList&&this[i].classList.toggle(t[a]);return this},attr:function(e,t){var a=arguments;if(1===arguments.length&&"string"==typeof e)return this[0]?this[0].getAttribute(e):void 0;for(var i=0;i<this.length;i+=1)if(2===a.length)this[i].setAttribute(e,t);else for(var s in e)this[i][s]=e[s],this[i].setAttribute(s,e[s]);return this},removeAttr:function(e){for(var t=0;t<this.length;t+=1)this[t].removeAttribute(e);return this},data:function(e,t){var a;if(void 0!==t){for(var i=0;i<this.length;i+=1)(a=this[i]).dom7ElementDataStorage||(a.dom7ElementDataStorage={}),a.dom7ElementDataStorage[e]=t;return this}if(a=this[0]){if(a.dom7ElementDataStorage&&e in a.dom7ElementDataStorage)return a.dom7ElementDataStorage[e];var s=a.getAttribute("data-"+e);return s||void 0}},transform:function(e){for(var t=0;t<this.length;t+=1){var a=this[t].style;a.webkitTransform=e,a.transform=e}return this},transition:function(e){"string"!=typeof e&&(e+="ms");for(var t=0;t<this.length;t+=1){var a=this[t].style;a.webkitTransitionDuration=e,a.transitionDuration=e}return this},on:function(){for(var e,t=[],a=arguments.length;a--;)t[a]=arguments[a];var i=t[0],r=t[1],n=t[2],s=t[3];function o(e){var t=e.target;if(t){var a=e.target.dom7EventData||[];if(a.indexOf(e)<0&&a.unshift(e),I(t).is(r))n.apply(t,a);else for(var i=I(t).parents(),s=0;s<i.length;s+=1)I(i[s]).is(r)&&n.apply(i[s],a)}}function l(e){var t=e&&e.target&&e.target.dom7EventData||[];t.indexOf(e)<0&&t.unshift(e),n.apply(this,t)}"function"==typeof t[1]&&(i=(e=t)[0],n=e[1],s=e[2],r=void 0),s=s||!1;for(var d,p=i.split(" "),c=0;c<this.length;c+=1){var u=this[c];if(r)for(d=0;d<p.length;d+=1){var h=p[d];u.dom7LiveListeners||(u.dom7LiveListeners={}),u.dom7LiveListeners[h]||(u.dom7LiveListeners[h]=[]),u.dom7LiveListeners[h].push({listener:n,proxyListener:o}),u.addEventListener(h,o,s)}else for(d=0;d<p.length;d+=1){var v=p[d];u.dom7Listeners||(u.dom7Listeners={}),u.dom7Listeners[v]||(u.dom7Listeners[v]=[]),u.dom7Listeners[v].push({listener:n,proxyListener:l}),u.addEventListener(v,l,s)}}return this},off:function(){for(var e,t=[],a=arguments.length;a--;)t[a]=arguments[a];var i=t[0],s=t[1],r=t[2],n=t[3];"function"==typeof t[1]&&(i=(e=t)[0],r=e[1],n=e[2],s=void 0),n=n||!1;for(var o=i.split(" "),l=0;l<o.length;l+=1)for(var d=o[l],p=0;p<this.length;p+=1){var c=this[p],u=void 0;if(!s&&c.dom7Listeners?u=c.dom7Listeners[d]:s&&c.dom7LiveListeners&&(u=c.dom7LiveListeners[d]),u&&u.length)for(var h=u.length-1;0<=h;h-=1){var v=u[h];r&&v.listener===r?(c.removeEventListener(d,v.proxyListener,n),u.splice(h,1)):r&&v.listener&&v.listener.dom7proxy&&v.listener.dom7proxy===r?(c.removeEventListener(d,v.proxyListener,n),u.splice(h,1)):r||(c.removeEventListener(d,v.proxyListener,n),u.splice(h,1))}}return this},trigger:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];for(var a=e[0].split(" "),i=e[1],s=0;s<a.length;s+=1)for(var r=a[s],n=0;n<this.length;n+=1){var o=this[n],l=void 0;try{l=new ee.CustomEvent(r,{detail:i,bubbles:!0,cancelable:!0})}catch(e){(l=f.createEvent("Event")).initEvent(r,!0,!0),l.detail=i}o.dom7EventData=e.filter(function(e,t){return 0<t}),o.dispatchEvent(l),o.dom7EventData=[],delete o.dom7EventData}return this},transitionEnd:function(t){var a,i=["webkitTransitionEnd","transitionend"],s=this;function r(e){if(e.target===this)for(t.call(this,e),a=0;a<i.length;a+=1)s.off(i[a],r)}if(t)for(a=0;a<i.length;a+=1)s.on(i[a],r);return this},outerWidth:function(e){if(0<this.length){if(e){var t=this.styles();return this[0].offsetWidth+parseFloat(t.getPropertyValue("margin-right"))+parseFloat(t.getPropertyValue("margin-left"))}return this[0].offsetWidth}return null},outerHeight:function(e){if(0<this.length){if(e){var t=this.styles();return this[0].offsetHeight+parseFloat(t.getPropertyValue("margin-top"))+parseFloat(t.getPropertyValue("margin-bottom"))}return this[0].offsetHeight}return null},offset:function(){if(0<this.length){var e=this[0],t=e.getBoundingClientRect(),a=f.body,i=e.clientTop||a.clientTop||0,s=e.clientLeft||a.clientLeft||0,r=e===ee?ee.scrollY:e.scrollTop,n=e===ee?ee.scrollX:e.scrollLeft;return{top:t.top+r-i,left:t.left+n-s}}return null},css:function(e,t){var a;if(1===arguments.length){if("string"!=typeof e){for(a=0;a<this.length;a+=1)for(var i in e)this[a].style[i]=e[i];return this}if(this[0])return ee.getComputedStyle(this[0],null).getPropertyValue(e)}if(2!==arguments.length||"string"!=typeof e)return this;for(a=0;a<this.length;a+=1)this[a].style[e]=t;return this},each:function(e){if(!e)return this;for(var t=0;t<this.length;t+=1)if(!1===e.call(this[t],t,this[t]))return this;return this},html:function(e){if(void 0===e)return this[0]?this[0].innerHTML:void 0;for(var t=0;t<this.length;t+=1)this[t].innerHTML=e;return this},text:function(e){if(void 0===e)return this[0]?this[0].textContent.trim():null;for(var t=0;t<this.length;t+=1)this[t].textContent=e;return this},is:function(e){var t,a,i=this[0];if(!i||void 0===e)return!1;if("string"==typeof e){if(i.matches)return i.matches(e);if(i.webkitMatchesSelector)return i.webkitMatchesSelector(e);if(i.msMatchesSelector)return i.msMatchesSelector(e);for(t=I(e),a=0;a<t.length;a+=1)if(t[a]===i)return!0;return!1}if(e===f)return i===f;if(e===ee)return i===ee;if(e.nodeType||e instanceof l){for(t=e.nodeType?[e]:e,a=0;a<t.length;a+=1)if(t[a]===i)return!0;return!1}return!1},index:function(){var e,t=this[0];if(t){for(e=0;null!==(t=t.previousSibling);)1===t.nodeType&&(e+=1);return e}},eq:function(e){if(void 0===e)return this;var t,a=this.length;return new l(a-1<e?[]:e<0?(t=a+e)<0?[]:[this[t]]:[this[e]])},append:function(){for(var e,t=[],a=arguments.length;a--;)t[a]=arguments[a];for(var i=0;i<t.length;i+=1){e=t[i];for(var s=0;s<this.length;s+=1)if("string"==typeof e){var r=f.createElement("div");for(r.innerHTML=e;r.firstChild;)this[s].appendChild(r.firstChild)}else if(e instanceof l)for(var n=0;n<e.length;n+=1)this[s].appendChild(e[n]);else this[s].appendChild(e)}return this},prepend:function(e){var t,a;for(t=0;t<this.length;t+=1)if("string"==typeof e){var i=f.createElement("div");for(i.innerHTML=e,a=i.childNodes.length-1;0<=a;a-=1)this[t].insertBefore(i.childNodes[a],this[t].childNodes[0])}else if(e instanceof l)for(a=0;a<e.length;a+=1)this[t].insertBefore(e[a],this[t].childNodes[0]);else this[t].insertBefore(e,this[t].childNodes[0]);return this},next:function(e){return 0<this.length?e?this[0].nextElementSibling&&I(this[0].nextElementSibling).is(e)?new l([this[0].nextElementSibling]):new l([]):this[0].nextElementSibling?new l([this[0].nextElementSibling]):new l([]):new l([])},nextAll:function(e){var t=[],a=this[0];if(!a)return new l([]);for(;a.nextElementSibling;){var i=a.nextElementSibling;e?I(i).is(e)&&t.push(i):t.push(i),a=i}return new l(t)},prev:function(e){if(0<this.length){var t=this[0];return e?t.previousElementSibling&&I(t.previousElementSibling).is(e)?new l([t.previousElementSibling]):new l([]):t.previousElementSibling?new l([t.previousElementSibling]):new l([])}return new l([])},prevAll:function(e){var t=[],a=this[0];if(!a)return new l([]);for(;a.previousElementSibling;){var i=a.previousElementSibling;e?I(i).is(e)&&t.push(i):t.push(i),a=i}return new l(t)},parent:function(e){for(var t=[],a=0;a<this.length;a+=1)null!==this[a].parentNode&&(e?I(this[a].parentNode).is(e)&&t.push(this[a].parentNode):t.push(this[a].parentNode));return I(r(t))},parents:function(e){for(var t=[],a=0;a<this.length;a+=1)for(var i=this[a].parentNode;i;)e?I(i).is(e)&&t.push(i):t.push(i),i=i.parentNode;return I(r(t))},closest:function(e){var t=this;return void 0===e?new l([]):(t.is(e)||(t=t.parents(e).eq(0)),t)},find:function(e){for(var t=[],a=0;a<this.length;a+=1)for(var i=this[a].querySelectorAll(e),s=0;s<i.length;s+=1)t.push(i[s]);return new l(t)},children:function(e){for(var t=[],a=0;a<this.length;a+=1)for(var i=this[a].childNodes,s=0;s<i.length;s+=1)e?1===i[s].nodeType&&I(i[s]).is(e)&&t.push(i[s]):1===i[s].nodeType&&t.push(i[s]);return new l(r(t))},remove:function(){for(var e=0;e<this.length;e+=1)this[e].parentNode&&this[e].parentNode.removeChild(this[e]);return this},add:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var a,i;for(a=0;a<e.length;a+=1){var s=I(e[a]);for(i=0;i<s.length;i+=1)this[this.length]=s[i],this.length+=1}return this},styles:function(){return this[0]?ee.getComputedStyle(this[0],null):{}}};Object.keys(t).forEach(function(e){I.fn[e]=I.fn[e]||t[e]});function e(e){void 0===e&&(e={});var t=this;t.params=e,t.eventsListeners={},t.params&&t.params.on&&Object.keys(t.params.on).forEach(function(e){t.on(e,t.params.on[e])})}var a,i,s,n,te={deleteProps:function(e){var t=e;Object.keys(t).forEach(function(e){try{t[e]=null}catch(e){}try{delete t[e]}catch(e){}})},nextTick:function(e,t){return void 0===t&&(t=0),setTimeout(e,t)},now:function(){return Date.now()},getTranslate:function(e,t){var a,i,s;void 0===t&&(t="x");var r=ee.getComputedStyle(e,null);return ee.WebKitCSSMatrix?(6<(i=r.transform||r.webkitTransform).split(",").length&&(i=i.split(", ").map(function(e){return e.replace(",",".")}).join(", ")),s=new ee.WebKitCSSMatrix("none"===i?"":i)):a=(s=r.MozTransform||r.OTransform||r.MsTransform||r.msTransform||r.transform||r.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,")).toString().split(","),"x"===t&&(i=ee.WebKitCSSMatrix?s.m41:16===a.length?parseFloat(a[12]):parseFloat(a[4])),"y"===t&&(i=ee.WebKitCSSMatrix?s.m42:16===a.length?parseFloat(a[13]):parseFloat(a[5])),i||0},parseUrlQuery:function(e){var t,a,i,s,r={},n=e||ee.location.href;if("string"==typeof n&&n.length)for(s=(a=(n=-1<n.indexOf("?")?n.replace(/\S*\?/,""):"").split("&").filter(function(e){return""!==e})).length,t=0;t<s;t+=1)i=a[t].replace(/#\S+/g,"").split("="),r[decodeURIComponent(i[0])]=void 0===i[1]?void 0:decodeURIComponent(i[1])||"";return r},isObject:function(e){return"object"==typeof e&&null!==e&&e.constructor&&e.constructor===Object},extend:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];for(var a=Object(e[0]),i=1;i<e.length;i+=1){var s=e[i];if(null!=s)for(var r=Object.keys(Object(s)),n=0,o=r.length;n<o;n+=1){var l=r[n],d=Object.getOwnPropertyDescriptor(s,l);void 0!==d&&d.enumerable&&(te.isObject(a[l])&&te.isObject(s[l])?te.extend(a[l],s[l]):!te.isObject(a[l])&&te.isObject(s[l])?(a[l]={},te.extend(a[l],s[l])):a[l]=s[l])}}return a}},ae=(s=f.createElement("div"),{touch:ee.Modernizr&&!0===ee.Modernizr.touch||!!(0<ee.navigator.maxTouchPoints||"ontouchstart"in ee||ee.DocumentTouch&&f instanceof ee.DocumentTouch),pointerEvents:!!(ee.navigator.pointerEnabled||ee.PointerEvent||"maxTouchPoints"in ee.navigator&&0<ee.navigator.maxTouchPoints),prefixedPointerEvents:!!ee.navigator.msPointerEnabled,transition:(i=s.style,"transition"in i||"webkitTransition"in i||"MozTransition"in i),transforms3d:ee.Modernizr&&!0===ee.Modernizr.csstransforms3d||(a=s.style,"webkitPerspective"in a||"MozPerspective"in a||"OPerspective"in a||"MsPerspective"in a||"perspective"in a),flexbox:function(){for(var e=s.style,t="alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "),a=0;a<t.length;a+=1)if(t[a]in e)return!0;return!1}(),observer:"MutationObserver"in ee||"WebkitMutationObserver"in ee,passiveListener:function(){var e=!1;try{var t=Object.defineProperty({},"passive",{get:function(){e=!0}});ee.addEventListener("testPassiveListener",null,t)}catch(e){}return e}(),gestures:"ongesturestart"in ee}),ie={isIE:!!ee.navigator.userAgent.match(/Trident/g)||!!ee.navigator.userAgent.match(/MSIE/g),isEdge:!!ee.navigator.userAgent.match(/Edge/g),isSafari:(n=ee.navigator.userAgent.toLowerCase(),0<=n.indexOf("safari")&&n.indexOf("chrome")<0&&n.indexOf("android")<0),isUiWebView:/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(ee.navigator.userAgent)},o={components:{configurable:!0}};e.prototype.on=function(e,t,a){var i=this;if("function"!=typeof t)return i;var s=a?"unshift":"push";return e.split(" ").forEach(function(e){i.eventsListeners[e]||(i.eventsListeners[e]=[]),i.eventsListeners[e][s](t)}),i},e.prototype.once=function(a,i,e){var s=this;if("function"!=typeof i)return s;function r(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];i.apply(s,e),s.off(a,r),r.f7proxy&&delete r.f7proxy}return r.f7proxy=i,s.on(a,r,e)},e.prototype.off=function(e,i){var s=this;return s.eventsListeners&&e.split(" ").forEach(function(a){void 0===i?s.eventsListeners[a]=[]:s.eventsListeners[a]&&s.eventsListeners[a].length&&s.eventsListeners[a].forEach(function(e,t){(e===i||e.f7proxy&&e.f7proxy===i)&&s.eventsListeners[a].splice(t,1)})}),s},e.prototype.emit=function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var a,i,s,r=this;return r.eventsListeners&&(s="string"==typeof e[0]||Array.isArray(e[0])?(a=e[0],i=e.slice(1,e.length),r):(a=e[0].events,i=e[0].data,e[0].context||r),(Array.isArray(a)?a:a.split(" ")).forEach(function(e){if(r.eventsListeners&&r.eventsListeners[e]){var t=[];r.eventsListeners[e].forEach(function(e){t.push(e)}),t.forEach(function(e){e.apply(s,i)})}})),r},e.prototype.useModulesParams=function(a){var i=this;i.modules&&Object.keys(i.modules).forEach(function(e){var t=i.modules[e];t.params&&te.extend(a,t.params)})},e.prototype.useModules=function(i){void 0===i&&(i={});var s=this;s.modules&&Object.keys(s.modules).forEach(function(e){var a=s.modules[e],t=i[e]||{};a.instance&&Object.keys(a.instance).forEach(function(e){var t=a.instance[e];s[e]="function"==typeof t?t.bind(s):t}),a.on&&s.on&&Object.keys(a.on).forEach(function(e){s.on(e,a.on[e])}),a.create&&a.create.bind(s)(t)})},o.components.set=function(e){this.use&&this.use(e)},e.installModule=function(t){for(var e=[],a=arguments.length-1;0<a--;)e[a]=arguments[a+1];var i=this;i.prototype.modules||(i.prototype.modules={});var s=t.name||Object.keys(i.prototype.modules).length+"_"+te.now();return(i.prototype.modules[s]=t).proto&&Object.keys(t.proto).forEach(function(e){i.prototype[e]=t.proto[e]}),t.static&&Object.keys(t.static).forEach(function(e){i[e]=t.static[e]}),t.install&&t.install.apply(i,e),i},e.use=function(e){for(var t=[],a=arguments.length-1;0<a--;)t[a]=arguments[a+1];var i=this;return Array.isArray(e)?(e.forEach(function(e){return i.installModule(e)}),i):i.installModule.apply(i,[e].concat(t))},Object.defineProperties(e,o);var d={updateSize:function(){var e,t,a=this,i=a.$el;e=void 0!==a.params.width?a.params.width:i[0].clientWidth,t=void 0!==a.params.height?a.params.height:i[0].clientHeight,0===e&&a.isHorizontal()||0===t&&a.isVertical()||(e=e-parseInt(i.css("padding-left"),10)-parseInt(i.css("padding-right"),10),t=t-parseInt(i.css("padding-top"),10)-parseInt(i.css("padding-bottom"),10),te.extend(a,{width:e,height:t,size:a.isHorizontal()?e:t}))},updateSlides:function(){var e=this,t=e.params,a=e.$wrapperEl,i=e.size,s=e.rtlTranslate,r=e.wrongRTL,n=e.virtual&&t.virtual.enabled,o=n?e.virtual.slides.length:e.slides.length,l=a.children("."+e.params.slideClass),d=n?e.virtual.slides.length:l.length,p=[],c=[],u=[],h=t.slidesOffsetBefore;"function"==typeof h&&(h=t.slidesOffsetBefore.call(e));var v=t.slidesOffsetAfter;"function"==typeof v&&(v=t.slidesOffsetAfter.call(e));var f=e.snapGrid.length,m=e.snapGrid.length,g=t.spaceBetween,b=-h,w=0,y=0;if(void 0!==i){var x,T;"string"==typeof g&&0<=g.indexOf("%")&&(g=parseFloat(g.replace("%",""))/100*i),e.virtualSize=-g,s?l.css({marginLeft:"",marginTop:""}):l.css({marginRight:"",marginBottom:""}),1<t.slidesPerColumn&&(x=Math.floor(d/t.slidesPerColumn)===d/e.params.slidesPerColumn?d:Math.ceil(d/t.slidesPerColumn)*t.slidesPerColumn,"auto"!==t.slidesPerView&&"row"===t.slidesPerColumnFill&&(x=Math.max(x,t.slidesPerView*t.slidesPerColumn)));for(var E,S=t.slidesPerColumn,C=x/S,M=Math.floor(d/t.slidesPerColumn),P=0;P<d;P+=1){T=0;var k=l.eq(P);if(1<t.slidesPerColumn){var z=void 0,$=void 0,I=void 0;if("column"===t.slidesPerColumnFill||"row"===t.slidesPerColumnFill&&1<t.slidesPerGroup){if("column"===t.slidesPerColumnFill)I=P-($=Math.floor(P/S))*S,(M<$||$===M&&I===S-1)&&S<=(I+=1)&&(I=0,$+=1);else{var L=Math.floor(P/t.slidesPerGroup);$=P-(I=Math.floor(P/t.slidesPerView)-L*t.slidesPerColumn)*t.slidesPerView-L*t.slidesPerView}z=$+I*x/S,k.css({"-webkit-box-ordinal-group":z,"-moz-box-ordinal-group":z,"-ms-flex-order":z,"-webkit-order":z,order:z})}else $=P-(I=Math.floor(P/C))*C;k.css("margin-"+(e.isHorizontal()?"top":"left"),0!==I&&t.spaceBetween&&t.spaceBetween+"px").attr("data-swiper-column",$).attr("data-swiper-row",I)}if("none"!==k.css("display")){if("auto"===t.slidesPerView){var D=ee.getComputedStyle(k[0],null),O=k[0].style.transform,A=k[0].style.webkitTransform;if(O&&(k[0].style.transform="none"),A&&(k[0].style.webkitTransform="none"),t.roundLengths)T=e.isHorizontal()?k.outerWidth(!0):k.outerHeight(!0);else if(e.isHorizontal()){var H=parseFloat(D.getPropertyValue("width")),G=parseFloat(D.getPropertyValue("padding-left")),N=parseFloat(D.getPropertyValue("padding-right")),B=parseFloat(D.getPropertyValue("margin-left")),X=parseFloat(D.getPropertyValue("margin-right")),V=D.getPropertyValue("box-sizing");T=V&&"border-box"===V&&!ie.isIE?H+B+X:H+G+N+B+X}else{var Y=parseFloat(D.getPropertyValue("height")),F=parseFloat(D.getPropertyValue("padding-top")),R=parseFloat(D.getPropertyValue("padding-bottom")),q=parseFloat(D.getPropertyValue("margin-top")),W=parseFloat(D.getPropertyValue("margin-bottom")),j=D.getPropertyValue("box-sizing");T=j&&"border-box"===j&&!ie.isIE?Y+q+W:Y+F+R+q+W}O&&(k[0].style.transform=O),A&&(k[0].style.webkitTransform=A),t.roundLengths&&(T=Math.floor(T))}else T=(i-(t.slidesPerView-1)*g)/t.slidesPerView,t.roundLengths&&(T=Math.floor(T)),l[P]&&(e.isHorizontal()?l[P].style.width=T+"px":l[P].style.height=T+"px");l[P]&&(l[P].swiperSlideSize=T),u.push(T),t.centeredSlides?(b=b+T/2+w/2+g,0===w&&0!==P&&(b=b-i/2-g),0===P&&(b=b-i/2-g),Math.abs(b)<.001&&(b=0),t.roundLengths&&(b=Math.floor(b)),y%t.slidesPerGroup==0&&p.push(b),c.push(b)):(t.roundLengths&&(b=Math.floor(b)),y%t.slidesPerGroup==0&&p.push(b),c.push(b),b=b+T+g),e.virtualSize+=T+g,w=T,y+=1}}if(e.virtualSize=Math.max(e.virtualSize,i)+v,s&&r&&("slide"===t.effect||"coverflow"===t.effect)&&a.css({width:e.virtualSize+t.spaceBetween+"px"}),ae.flexbox&&!t.setWrapperSize||(e.isHorizontal()?a.css({width:e.virtualSize+t.spaceBetween+"px"}):a.css({height:e.virtualSize+t.spaceBetween+"px"})),1<t.slidesPerColumn&&(e.virtualSize=(T+t.spaceBetween)*x,e.virtualSize=Math.ceil(e.virtualSize/t.slidesPerColumn)-t.spaceBetween,e.isHorizontal()?a.css({width:e.virtualSize+t.spaceBetween+"px"}):a.css({height:e.virtualSize+t.spaceBetween+"px"}),t.centeredSlides)){E=[];for(var U=0;U<p.length;U+=1){var K=p[U];t.roundLengths&&(K=Math.floor(K)),p[U]<e.virtualSize+p[0]&&E.push(K)}p=E}if(!t.centeredSlides){E=[];for(var _=0;_<p.length;_+=1){var Z=p[_];t.roundLengths&&(Z=Math.floor(Z)),p[_]<=e.virtualSize-i&&E.push(Z)}p=E,1<Math.floor(e.virtualSize-i)-Math.floor(p[p.length-1])&&p.push(e.virtualSize-i)}if(0===p.length&&(p=[0]),0!==t.spaceBetween&&(e.isHorizontal()?s?l.css({marginLeft:g+"px"}):l.css({marginRight:g+"px"}):l.css({marginBottom:g+"px"})),t.centerInsufficientSlides){var Q=0;if(u.forEach(function(e){Q+=e+(t.spaceBetween?t.spaceBetween:0)}),(Q-=t.spaceBetween)<i){var J=(i-Q)/2;p.forEach(function(e,t){p[t]=e-J}),c.forEach(function(e,t){c[t]=e+J})}}te.extend(e,{slides:l,snapGrid:p,slidesGrid:c,slidesSizesGrid:u}),d!==o&&e.emit("slidesLengthChange"),p.length!==f&&(e.params.watchOverflow&&e.checkOverflow(),e.emit("snapGridLengthChange")),c.length!==m&&e.emit("slidesGridLengthChange"),(t.watchSlidesProgress||t.watchSlidesVisibility)&&e.updateSlidesOffset()}},updateAutoHeight:function(e){var t,a=this,i=[],s=0;if("number"==typeof e?a.setTransition(e):!0===e&&a.setTransition(a.params.speed),"auto"!==a.params.slidesPerView&&1<a.params.slidesPerView)for(t=0;t<Math.ceil(a.params.slidesPerView);t+=1){var r=a.activeIndex+t;if(r>a.slides.length)break;i.push(a.slides.eq(r)[0])}else i.push(a.slides.eq(a.activeIndex)[0]);for(t=0;t<i.length;t+=1)if(void 0!==i[t]){var n=i[t].offsetHeight;s=s<n?n:s}s&&a.$wrapperEl.css("height",s+"px")},updateSlidesOffset:function(){for(var e=this.slides,t=0;t<e.length;t+=1)e[t].swiperSlideOffset=this.isHorizontal()?e[t].offsetLeft:e[t].offsetTop},updateSlidesProgress:function(e){void 0===e&&(e=this&&this.translate||0);var t=this,a=t.params,i=t.slides,s=t.rtlTranslate;if(0!==i.length){void 0===i[0].swiperSlideOffset&&t.updateSlidesOffset();var r=-e;s&&(r=e),i.removeClass(a.slideVisibleClass),t.visibleSlidesIndexes=[],t.visibleSlides=[];for(var n=0;n<i.length;n+=1){var o=i[n],l=(r+(a.centeredSlides?t.minTranslate():0)-o.swiperSlideOffset)/(o.swiperSlideSize+a.spaceBetween);if(a.watchSlidesVisibility){var d=-(r-o.swiperSlideOffset),p=d+t.slidesSizesGrid[n];(0<=d&&d<t.size-1||1<p&&p<=t.size||d<=0&&p>=t.size)&&(t.visibleSlides.push(o),t.visibleSlidesIndexes.push(n),i.eq(n).addClass(a.slideVisibleClass))}o.progress=s?-l:l}t.visibleSlides=I(t.visibleSlides)}},updateProgress:function(e){void 0===e&&(e=this&&this.translate||0);var t=this,a=t.params,i=t.maxTranslate()-t.minTranslate(),s=t.progress,r=t.isBeginning,n=t.isEnd,o=r,l=n;n=0==i?r=!(s=0):(r=(s=(e-t.minTranslate())/i)<=0,1<=s),te.extend(t,{progress:s,isBeginning:r,isEnd:n}),(a.watchSlidesProgress||a.watchSlidesVisibility)&&t.updateSlidesProgress(e),r&&!o&&t.emit("reachBeginning toEdge"),n&&!l&&t.emit("reachEnd toEdge"),(o&&!r||l&&!n)&&t.emit("fromEdge"),t.emit("progress",s)},updateSlidesClasses:function(){var e,t=this,a=t.slides,i=t.params,s=t.$wrapperEl,r=t.activeIndex,n=t.realIndex,o=t.virtual&&i.virtual.enabled;a.removeClass(i.slideActiveClass+" "+i.slideNextClass+" "+i.slidePrevClass+" "+i.slideDuplicateActiveClass+" "+i.slideDuplicateNextClass+" "+i.slideDuplicatePrevClass),(e=o?t.$wrapperEl.find("."+i.slideClass+'[data-swiper-slide-index="'+r+'"]'):a.eq(r)).addClass(i.slideActiveClass),i.loop&&(e.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+n+'"]').addClass(i.slideDuplicateActiveClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+n+'"]').addClass(i.slideDuplicateActiveClass));var l=e.nextAll("."+i.slideClass).eq(0).addClass(i.slideNextClass);i.loop&&0===l.length&&(l=a.eq(0)).addClass(i.slideNextClass);var d=e.prevAll("."+i.slideClass).eq(0).addClass(i.slidePrevClass);i.loop&&0===d.length&&(d=a.eq(-1)).addClass(i.slidePrevClass),i.loop&&(l.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass),d.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+d.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+d.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass))},updateActiveIndex:function(e){var t,a=this,i=a.rtlTranslate?a.translate:-a.translate,s=a.slidesGrid,r=a.snapGrid,n=a.params,o=a.activeIndex,l=a.realIndex,d=a.snapIndex,p=e;if(void 0===p){for(var c=0;c<s.length;c+=1)void 0!==s[c+1]?i>=s[c]&&i<s[c+1]-(s[c+1]-s[c])/2?p=c:i>=s[c]&&i<s[c+1]&&(p=c+1):i>=s[c]&&(p=c);n.normalizeSlideIndex&&(p<0||void 0===p)&&(p=0)}if((t=0<=r.indexOf(i)?r.indexOf(i):Math.floor(p/n.slidesPerGroup))>=r.length&&(t=r.length-1),p!==o){var u=parseInt(a.slides.eq(p).attr("data-swiper-slide-index")||p,10);te.extend(a,{snapIndex:t,realIndex:u,previousIndex:o,activeIndex:p}),a.emit("activeIndexChange"),a.emit("snapIndexChange"),l!==u&&a.emit("realIndexChange"),(a.initialized||a.runCallbacksOnInit)&&a.emit("slideChange")}else t!==d&&(a.snapIndex=t,a.emit("snapIndexChange"))},updateClickedSlide:function(e){var t=this,a=t.params,i=I(e.target).closest("."+a.slideClass)[0],s=!1;if(i)for(var r=0;r<t.slides.length;r+=1)t.slides[r]===i&&(s=!0);if(!i||!s)return t.clickedSlide=void 0,void(t.clickedIndex=void 0);t.clickedSlide=i,t.virtual&&t.params.virtual.enabled?t.clickedIndex=parseInt(I(i).attr("data-swiper-slide-index"),10):t.clickedIndex=I(i).index(),a.slideToClickedSlide&&void 0!==t.clickedIndex&&t.clickedIndex!==t.activeIndex&&t.slideToClickedSlide()}};var p={getTranslate:function(e){void 0===e&&(e=this.isHorizontal()?"x":"y");var t=this.params,a=this.rtlTranslate,i=this.translate,s=this.$wrapperEl;if(t.virtualTranslate)return a?-i:i;var r=te.getTranslate(s[0],e);return a&&(r=-r),r||0},setTranslate:function(e,t){var a=this,i=a.rtlTranslate,s=a.params,r=a.$wrapperEl,n=a.progress,o=0,l=0;a.isHorizontal()?o=i?-e:e:l=e,s.roundLengths&&(o=Math.floor(o),l=Math.floor(l)),s.virtualTranslate||(ae.transforms3d?r.transform("translate3d("+o+"px, "+l+"px, 0px)"):r.transform("translate("+o+"px, "+l+"px)")),a.previousTranslate=a.translate,a.translate=a.isHorizontal()?o:l;var d=a.maxTranslate()-a.minTranslate();(0==d?0:(e-a.minTranslate())/d)!==n&&a.updateProgress(e),a.emit("setTranslate",a.translate,t)},minTranslate:function(){return-this.snapGrid[0]},maxTranslate:function(){return-this.snapGrid[this.snapGrid.length-1]}};var c={setTransition:function(e,t){this.$wrapperEl.transition(e),this.emit("setTransition",e,t)},transitionStart:function(e,t){void 0===e&&(e=!0);var a=this,i=a.activeIndex,s=a.params,r=a.previousIndex;s.autoHeight&&a.updateAutoHeight();var n=t;if(n=n||(r<i?"next":i<r?"prev":"reset"),a.emit("transitionStart"),e&&i!==r){if("reset"===n)return void a.emit("slideResetTransitionStart");a.emit("slideChangeTransitionStart"),"next"===n?a.emit("slideNextTransitionStart"):a.emit("slidePrevTransitionStart")}},transitionEnd:function(e,t){void 0===e&&(e=!0);var a=this,i=a.activeIndex,s=a.previousIndex;a.animating=!1,a.setTransition(0);var r=t;if(r=r||(s<i?"next":i<s?"prev":"reset"),a.emit("transitionEnd"),e&&i!==s){if("reset"===r)return void a.emit("slideResetTransitionEnd");a.emit("slideChangeTransitionEnd"),"next"===r?a.emit("slideNextTransitionEnd"):a.emit("slidePrevTransitionEnd")}}};var u={slideTo:function(e,t,a,i){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===a&&(a=!0);var s=this,r=e;r<0&&(r=0);var n=s.params,o=s.snapGrid,l=s.slidesGrid,d=s.previousIndex,p=s.activeIndex,c=s.rtlTranslate;if(s.animating&&n.preventInteractionOnTransition)return!1;var u=Math.floor(r/n.slidesPerGroup);u>=o.length&&(u=o.length-1),(p||n.initialSlide||0)===(d||0)&&a&&s.emit("beforeSlideChangeStart");var h,v=-o[u];if(s.updateProgress(v),n.normalizeSlideIndex)for(var f=0;f<l.length;f+=1)-Math.floor(100*v)>=Math.floor(100*l[f])&&(r=f);if(s.initialized&&r!==p){if(!s.allowSlideNext&&v<s.translate&&v<s.minTranslate())return!1;if(!s.allowSlidePrev&&v>s.translate&&v>s.maxTranslate()&&(p||0)!==r)return!1}return h=p<r?"next":r<p?"prev":"reset",c&&-v===s.translate||!c&&v===s.translate?(s.updateActiveIndex(r),n.autoHeight&&s.updateAutoHeight(),s.updateSlidesClasses(),"slide"!==n.effect&&s.setTranslate(v),"reset"!==h&&(s.transitionStart(a,h),s.transitionEnd(a,h)),!1):(0!==t&&ae.transition?(s.setTransition(t),s.setTranslate(v),s.updateActiveIndex(r),s.updateSlidesClasses(),s.emit("beforeTransitionStart",t,i),s.transitionStart(a,h),s.animating||(s.animating=!0,s.onSlideToWrapperTransitionEnd||(s.onSlideToWrapperTransitionEnd=function(e){s&&!s.destroyed&&e.target===this&&(s.$wrapperEl[0].removeEventListener("transitionend",s.onSlideToWrapperTransitionEnd),s.$wrapperEl[0].removeEventListener("webkitTransitionEnd",s.onSlideToWrapperTransitionEnd),s.onSlideToWrapperTransitionEnd=null,delete s.onSlideToWrapperTransitionEnd,s.transitionEnd(a,h))}),s.$wrapperEl[0].addEventListener("transitionend",s.onSlideToWrapperTransitionEnd),s.$wrapperEl[0].addEventListener("webkitTransitionEnd",s.onSlideToWrapperTransitionEnd))):(s.setTransition(0),s.setTranslate(v),s.updateActiveIndex(r),s.updateSlidesClasses(),s.emit("beforeTransitionStart",t,i),s.transitionStart(a,h),s.transitionEnd(a,h)),!0)},slideToLoop:function(e,t,a,i){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===a&&(a=!0);var s=e;return this.params.loop&&(s+=this.loopedSlides),this.slideTo(s,t,a,i)},slideNext:function(e,t,a){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var i=this,s=i.params,r=i.animating;return s.loop?!r&&(i.loopFix(),i._clientLeft=i.$wrapperEl[0].clientLeft,i.slideTo(i.activeIndex+s.slidesPerGroup,e,t,a)):i.slideTo(i.activeIndex+s.slidesPerGroup,e,t,a)},slidePrev:function(e,t,a){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var i=this,s=i.params,r=i.animating,n=i.snapGrid,o=i.slidesGrid,l=i.rtlTranslate;if(s.loop){if(r)return!1;i.loopFix(),i._clientLeft=i.$wrapperEl[0].clientLeft}function d(e){return e<0?-Math.floor(Math.abs(e)):Math.floor(e)}var p,c=d(l?i.translate:-i.translate),u=n.map(function(e){return d(e)}),h=(o.map(function(e){return d(e)}),n[u.indexOf(c)],n[u.indexOf(c)-1]);return void 0!==h&&(p=o.indexOf(h))<0&&(p=i.activeIndex-1),i.slideTo(p,e,t,a)},slideReset:function(e,t,a){return void 0===e&&(e=this.params.speed),void 0===t&&(t=!0),this.slideTo(this.activeIndex,e,t,a)},slideToClosest:function(e,t,a){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var i=this,s=i.activeIndex,r=Math.floor(s/i.params.slidesPerGroup);if(r<i.snapGrid.length-1){var n=i.rtlTranslate?i.translate:-i.translate,o=i.snapGrid[r];(i.snapGrid[r+1]-o)/2<n-o&&(s=i.params.slidesPerGroup)}return i.slideTo(s,e,t,a)},slideToClickedSlide:function(){var e,t=this,a=t.params,i=t.$wrapperEl,s="auto"===a.slidesPerView?t.slidesPerViewDynamic():a.slidesPerView,r=t.clickedIndex;if(a.loop){if(t.animating)return;e=parseInt(I(t.clickedSlide).attr("data-swiper-slide-index"),10),a.centeredSlides?r<t.loopedSlides-s/2||r>t.slides.length-t.loopedSlides+s/2?(t.loopFix(),r=i.children("."+a.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+a.slideDuplicateClass+")").eq(0).index(),te.nextTick(function(){t.slideTo(r)})):t.slideTo(r):r>t.slides.length-s?(t.loopFix(),r=i.children("."+a.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+a.slideDuplicateClass+")").eq(0).index(),te.nextTick(function(){t.slideTo(r)})):t.slideTo(r)}else t.slideTo(r)}};var h={loopCreate:function(){var i=this,e=i.params,t=i.$wrapperEl;t.children("."+e.slideClass+"."+e.slideDuplicateClass).remove();var s=t.children("."+e.slideClass);if(e.loopFillGroupWithBlank){var a=e.slidesPerGroup-s.length%e.slidesPerGroup;if(a!==e.slidesPerGroup){for(var r=0;r<a;r+=1){var n=I(f.createElement("div")).addClass(e.slideClass+" "+e.slideBlankClass);t.append(n)}s=t.children("."+e.slideClass)}}"auto"!==e.slidesPerView||e.loopedSlides||(e.loopedSlides=s.length),i.loopedSlides=parseInt(e.loopedSlides||e.slidesPerView,10),i.loopedSlides+=e.loopAdditionalSlides,i.loopedSlides>s.length&&(i.loopedSlides=s.length);var o=[],l=[];s.each(function(e,t){var a=I(t);e<i.loopedSlides&&l.push(t),e<s.length&&e>=s.length-i.loopedSlides&&o.push(t),a.attr("data-swiper-slide-index",e)});for(var d=0;d<l.length;d+=1)t.append(I(l[d].cloneNode(!0)).addClass(e.slideDuplicateClass));for(var p=o.length-1;0<=p;p-=1)t.prepend(I(o[p].cloneNode(!0)).addClass(e.slideDuplicateClass))},loopFix:function(){var e,t=this,a=t.params,i=t.activeIndex,s=t.slides,r=t.loopedSlides,n=t.allowSlidePrev,o=t.allowSlideNext,l=t.snapGrid,d=t.rtlTranslate;t.allowSlidePrev=!0,t.allowSlideNext=!0;var p=-l[i]-t.getTranslate();if(i<r)e=s.length-3*r+i,e+=r,t.slideTo(e,0,!1,!0)&&0!=p&&t.setTranslate((d?-t.translate:t.translate)-p);else if("auto"===a.slidesPerView&&2*r<=i||i>=s.length-r){e=-s.length+i+r,e+=r,t.slideTo(e,0,!1,!0)&&0!=p&&t.setTranslate((d?-t.translate:t.translate)-p)}t.allowSlidePrev=n,t.allowSlideNext=o},loopDestroy:function(){var e=this.$wrapperEl,t=this.params,a=this.slides;e.children("."+t.slideClass+"."+t.slideDuplicateClass+",."+t.slideClass+"."+t.slideBlankClass).remove(),a.removeAttr("data-swiper-slide-index")}};var v={setGrabCursor:function(e){if(!(ae.touch||!this.params.simulateTouch||this.params.watchOverflow&&this.isLocked)){var t=this.el;t.style.cursor="move",t.style.cursor=e?"-webkit-grabbing":"-webkit-grab",t.style.cursor=e?"-moz-grabbin":"-moz-grab",t.style.cursor=e?"grabbing":"grab"}},unsetGrabCursor:function(){ae.touch||this.params.watchOverflow&&this.isLocked||(this.el.style.cursor="")}};var m={appendSlide:function(e){var t=this,a=t.$wrapperEl,i=t.params;if(i.loop&&t.loopDestroy(),"object"==typeof e&&"length"in e)for(var s=0;s<e.length;s+=1)e[s]&&a.append(e[s]);else a.append(e);i.loop&&t.loopCreate(),i.observer&&ae.observer||t.update()},prependSlide:function(e){var t=this,a=t.params,i=t.$wrapperEl,s=t.activeIndex;a.loop&&t.loopDestroy();var r=s+1;if("object"==typeof e&&"length"in e){for(var n=0;n<e.length;n+=1)e[n]&&i.prepend(e[n]);r=s+e.length}else i.prepend(e);a.loop&&t.loopCreate(),a.observer&&ae.observer||t.update(),t.slideTo(r,0,!1)},addSlide:function(e,t){var a=this,i=a.$wrapperEl,s=a.params,r=a.activeIndex;s.loop&&(r-=a.loopedSlides,a.loopDestroy(),a.slides=i.children("."+s.slideClass));var n=a.slides.length;if(e<=0)a.prependSlide(t);else if(n<=e)a.appendSlide(t);else{for(var o=e<r?r+1:r,l=[],d=n-1;e<=d;d-=1){var p=a.slides.eq(d);p.remove(),l.unshift(p)}if("object"==typeof t&&"length"in t){for(var c=0;c<t.length;c+=1)t[c]&&i.append(t[c]);o=e<r?r+t.length:r}else i.append(t);for(var u=0;u<l.length;u+=1)i.append(l[u]);s.loop&&a.loopCreate(),s.observer&&ae.observer||a.update(),s.loop?a.slideTo(o+a.loopedSlides,0,!1):a.slideTo(o,0,!1)}},removeSlide:function(e){var t=this,a=t.params,i=t.$wrapperEl,s=t.activeIndex;a.loop&&(s-=t.loopedSlides,t.loopDestroy(),t.slides=i.children("."+a.slideClass));var r,n=s;if("object"==typeof e&&"length"in e){for(var o=0;o<e.length;o+=1)r=e[o],t.slides[r]&&t.slides.eq(r).remove(),r<n&&(n-=1);n=Math.max(n,0)}else r=e,t.slides[r]&&t.slides.eq(r).remove(),r<n&&(n-=1),n=Math.max(n,0);a.loop&&t.loopCreate(),a.observer&&ae.observer||t.update(),a.loop?t.slideTo(n+t.loopedSlides,0,!1):t.slideTo(n,0,!1)},removeAllSlides:function(){for(var e=[],t=0;t<this.slides.length;t+=1)e.push(t);this.removeSlide(e)}},g=function(){var e=ee.navigator.userAgent,t={ios:!1,android:!1,androidChrome:!1,desktop:!1,windows:!1,iphone:!1,ipod:!1,ipad:!1,cordova:ee.cordova||ee.phonegap,phonegap:ee.cordova||ee.phonegap},a=e.match(/(Windows Phone);?[\s\/]+([\d.]+)?/),i=e.match(/(Android);?[\s\/]+([\d.]+)?/),s=e.match(/(iPad).*OS\s([\d_]+)/),r=e.match(/(iPod)(.*OS\s([\d_]+))?/),n=!s&&e.match(/(iPhone\sOS|iOS)\s([\d_]+)/);if(a&&(t.os="windows",t.osVersion=a[2],t.windows=!0),i&&!a&&(t.os="android",t.osVersion=i[2],t.android=!0,t.androidChrome=0<=e.toLowerCase().indexOf("chrome")),(s||n||r)&&(t.os="ios",t.ios=!0),n&&!r&&(t.osVersion=n[2].replace(/_/g,"."),t.iphone=!0),s&&(t.osVersion=s[2].replace(/_/g,"."),t.ipad=!0),r&&(t.osVersion=r[3]?r[3].replace(/_/g,"."):null,t.iphone=!0),t.ios&&t.osVersion&&0<=e.indexOf("Version/")&&"10"===t.osVersion.split(".")[0]&&(t.osVersion=e.toLowerCase().split("version/")[1].split(" ")[0]),t.desktop=!(t.os||t.android||t.webView),t.webView=(n||s||r)&&e.match(/.*AppleWebKit(?!.*Safari)/i),t.os&&"ios"===t.os){var o=t.osVersion.split("."),l=f.querySelector('meta[name="viewport"]');t.minimalUi=!t.webView&&(r||n)&&(1*o[0]==7?1<=1*o[1]:7<1*o[0])&&l&&0<=l.getAttribute("content").indexOf("minimal-ui")}return t.pixelRatio=ee.devicePixelRatio||1,t}();function b(){var e=this,t=e.params,a=e.el;if(!a||0!==a.offsetWidth){t.breakpoints&&e.setBreakpoint();var i=e.allowSlideNext,s=e.allowSlidePrev,r=e.snapGrid;if(e.allowSlideNext=!0,e.allowSlidePrev=!0,e.updateSize(),e.updateSlides(),t.freeMode){var n=Math.min(Math.max(e.translate,e.maxTranslate()),e.minTranslate());e.setTranslate(n),e.updateActiveIndex(),e.updateSlidesClasses(),t.autoHeight&&e.updateAutoHeight()}else e.updateSlidesClasses(),("auto"===t.slidesPerView||1<t.slidesPerView)&&e.isEnd&&!e.params.centeredSlides?e.slideTo(e.slides.length-1,0,!1,!0):e.slideTo(e.activeIndex,0,!1,!0);e.autoplay&&e.autoplay.running&&e.autoplay.paused&&e.autoplay.run(),e.allowSlidePrev=s,e.allowSlideNext=i,e.params.watchOverflow&&r!==e.snapGrid&&e.checkOverflow()}}var w={init:!0,direction:"horizontal",touchEventsTarget:"container",initialSlide:0,speed:300,preventInteractionOnTransition:!1,edgeSwipeDetection:!1,edgeSwipeThreshold:20,freeMode:!1,freeModeMomentum:!0,freeModeMomentumRatio:1,freeModeMomentumBounce:!0,freeModeMomentumBounceRatio:1,freeModeMomentumVelocityRatio:1,freeModeSticky:!1,freeModeMinimumVelocity:.02,autoHeight:!1,setWrapperSize:!1,virtualTranslate:!1,effect:"slide",breakpoints:void 0,breakpointsInverse:!1,spaceBetween:0,slidesPerView:1,slidesPerColumn:1,slidesPerColumnFill:"column",slidesPerGroup:1,centeredSlides:!1,slidesOffsetBefore:0,slidesOffsetAfter:0,normalizeSlideIndex:!0,centerInsufficientSlides:!1,watchOverflow:!1,roundLengths:!1,touchRatio:1,touchAngle:45,simulateTouch:!0,shortSwipes:!0,longSwipes:!0,longSwipesRatio:.5,longSwipesMs:300,followFinger:!0,allowTouchMove:!0,threshold:0,touchMoveStopPropagation:!0,touchStartPreventDefault:!0,touchStartForcePreventDefault:!1,touchReleaseOnEdges:!1,uniqueNavElements:!0,resistance:!0,resistanceRatio:.85,watchSlidesProgress:!1,watchSlidesVisibility:!1,grabCursor:!1,preventClicks:!0,preventClicksPropagation:!0,slideToClickedSlide:!1,preloadImages:!0,updateOnImagesReady:!0,loop:!1,loopAdditionalSlides:0,loopedSlides:null,loopFillGroupWithBlank:!1,allowSlidePrev:!0,allowSlideNext:!0,swipeHandler:null,noSwiping:!0,noSwipingClass:"swiper-no-swiping",noSwipingSelector:null,passiveListeners:!0,containerModifierClass:"swiper-container-",slideClass:"swiper-slide",slideBlankClass:"swiper-slide-invisible-blank",slideActiveClass:"swiper-slide-active",slideDuplicateActiveClass:"swiper-slide-duplicate-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",slideNextClass:"swiper-slide-next",slideDuplicateNextClass:"swiper-slide-duplicate-next",slidePrevClass:"swiper-slide-prev",slideDuplicatePrevClass:"swiper-slide-duplicate-prev",wrapperClass:"swiper-wrapper",runCallbacksOnInit:!0},y={update:d,translate:p,transition:c,slide:u,loop:h,grabCursor:v,manipulation:m,events:{attachEvents:function(){var e=this,t=e.params,a=e.touchEvents,i=e.el,s=e.wrapperEl;e.onTouchStart=function(e){var t=this,a=t.touchEventsData,i=t.params,s=t.touches;if(!t.animating||!i.preventInteractionOnTransition){var r=e;if(r.originalEvent&&(r=r.originalEvent),a.isTouchEvent="touchstart"===r.type,(a.isTouchEvent||!("which"in r)||3!==r.which)&&!(!a.isTouchEvent&&"button"in r&&0<r.button||a.isTouched&&a.isMoved))if(i.noSwiping&&I(r.target).closest(i.noSwipingSelector?i.noSwipingSelector:"."+i.noSwipingClass)[0])t.allowClick=!0;else if(!i.swipeHandler||I(r).closest(i.swipeHandler)[0]){s.currentX="touchstart"===r.type?r.targetTouches[0].pageX:r.pageX,s.currentY="touchstart"===r.type?r.targetTouches[0].pageY:r.pageY;var n=s.currentX,o=s.currentY,l=i.edgeSwipeDetection||i.iOSEdgeSwipeDetection,d=i.edgeSwipeThreshold||i.iOSEdgeSwipeThreshold;if(!l||!(n<=d||n>=ee.screen.width-d)){if(te.extend(a,{isTouched:!0,isMoved:!1,allowTouchCallbacks:!0,isScrolling:void 0,startMoving:void 0}),s.startX=n,s.startY=o,a.touchStartTime=te.now(),t.allowClick=!0,t.updateSize(),t.swipeDirection=void 0,0<i.threshold&&(a.allowThresholdMove=!1),"touchstart"!==r.type){var p=!0;I(r.target).is(a.formElements)&&(p=!1),f.activeElement&&I(f.activeElement).is(a.formElements)&&f.activeElement!==r.target&&f.activeElement.blur();var c=p&&t.allowTouchMove&&i.touchStartPreventDefault;(i.touchStartForcePreventDefault||c)&&r.preventDefault()}t.emit("touchStart",r)}}}}.bind(e),e.onTouchMove=function(e){var t=this,a=t.touchEventsData,i=t.params,s=t.touches,r=t.rtlTranslate,n=e;if(n.originalEvent&&(n=n.originalEvent),a.isTouched){if(!a.isTouchEvent||"mousemove"!==n.type){var o="touchmove"===n.type?n.targetTouches[0].pageX:n.pageX,l="touchmove"===n.type?n.targetTouches[0].pageY:n.pageY;if(n.preventedByNestedSwiper)return s.startX=o,void(s.startY=l);if(!t.allowTouchMove)return t.allowClick=!1,void(a.isTouched&&(te.extend(s,{startX:o,startY:l,currentX:o,currentY:l}),a.touchStartTime=te.now()));if(a.isTouchEvent&&i.touchReleaseOnEdges&&!i.loop)if(t.isVertical()){if(l<s.startY&&t.translate<=t.maxTranslate()||l>s.startY&&t.translate>=t.minTranslate())return a.isTouched=!1,void(a.isMoved=!1)}else if(o<s.startX&&t.translate<=t.maxTranslate()||o>s.startX&&t.translate>=t.minTranslate())return;if(a.isTouchEvent&&f.activeElement&&n.target===f.activeElement&&I(n.target).is(a.formElements))return a.isMoved=!0,void(t.allowClick=!1);if(a.allowTouchCallbacks&&t.emit("touchMove",n),!(n.targetTouches&&1<n.targetTouches.length)){s.currentX=o,s.currentY=l;var d=s.currentX-s.startX,p=s.currentY-s.startY;if(!(t.params.threshold&&Math.sqrt(Math.pow(d,2)+Math.pow(p,2))<t.params.threshold)){var c;if(void 0===a.isScrolling)t.isHorizontal()&&s.currentY===s.startY||t.isVertical()&&s.currentX===s.startX?a.isScrolling=!1:25<=d*d+p*p&&(c=180*Math.atan2(Math.abs(p),Math.abs(d))/Math.PI,a.isScrolling=t.isHorizontal()?c>i.touchAngle:90-c>i.touchAngle);if(a.isScrolling&&t.emit("touchMoveOpposite",n),void 0===a.startMoving&&(s.currentX===s.startX&&s.currentY===s.startY||(a.startMoving=!0)),a.isScrolling)a.isTouched=!1;else if(a.startMoving){t.allowClick=!1,n.preventDefault(),i.touchMoveStopPropagation&&!i.nested&&n.stopPropagation(),a.isMoved||(i.loop&&t.loopFix(),a.startTranslate=t.getTranslate(),t.setTransition(0),t.animating&&t.$wrapperEl.trigger("webkitTransitionEnd transitionend"),a.allowMomentumBounce=!1,!i.grabCursor||!0!==t.allowSlideNext&&!0!==t.allowSlidePrev||t.setGrabCursor(!0),t.emit("sliderFirstMove",n)),t.emit("sliderMove",n),a.isMoved=!0;var u=t.isHorizontal()?d:p;s.diff=u,u*=i.touchRatio,r&&(u=-u),t.swipeDirection=0<u?"prev":"next",a.currentTranslate=u+a.startTranslate;var h=!0,v=i.resistanceRatio;if(i.touchReleaseOnEdges&&(v=0),0<u&&a.currentTranslate>t.minTranslate()?(h=!1,i.resistance&&(a.currentTranslate=t.minTranslate()-1+Math.pow(-t.minTranslate()+a.startTranslate+u,v))):u<0&&a.currentTranslate<t.maxTranslate()&&(h=!1,i.resistance&&(a.currentTranslate=t.maxTranslate()+1-Math.pow(t.maxTranslate()-a.startTranslate-u,v))),h&&(n.preventedByNestedSwiper=!0),!t.allowSlideNext&&"next"===t.swipeDirection&&a.currentTranslate<a.startTranslate&&(a.currentTranslate=a.startTranslate),!t.allowSlidePrev&&"prev"===t.swipeDirection&&a.currentTranslate>a.startTranslate&&(a.currentTranslate=a.startTranslate),0<i.threshold){if(!(Math.abs(u)>i.threshold||a.allowThresholdMove))return void(a.currentTranslate=a.startTranslate);if(!a.allowThresholdMove)return a.allowThresholdMove=!0,s.startX=s.currentX,s.startY=s.currentY,a.currentTranslate=a.startTranslate,void(s.diff=t.isHorizontal()?s.currentX-s.startX:s.currentY-s.startY)}i.followFinger&&((i.freeMode||i.watchSlidesProgress||i.watchSlidesVisibility)&&(t.updateActiveIndex(),t.updateSlidesClasses()),i.freeMode&&(0===a.velocities.length&&a.velocities.push({position:s[t.isHorizontal()?"startX":"startY"],time:a.touchStartTime}),a.velocities.push({position:s[t.isHorizontal()?"currentX":"currentY"],time:te.now()})),t.updateProgress(a.currentTranslate),t.setTranslate(a.currentTranslate))}}}}}else a.startMoving&&a.isScrolling&&t.emit("touchMoveOpposite",n)}.bind(e),e.onTouchEnd=function(e){var t=this,a=t.touchEventsData,i=t.params,s=t.touches,r=t.rtlTranslate,n=t.$wrapperEl,o=t.slidesGrid,l=t.snapGrid,d=e;if(d.originalEvent&&(d=d.originalEvent),a.allowTouchCallbacks&&t.emit("touchEnd",d),a.allowTouchCallbacks=!1,!a.isTouched)return a.isMoved&&i.grabCursor&&t.setGrabCursor(!1),a.isMoved=!1,void(a.startMoving=!1);i.grabCursor&&a.isMoved&&a.isTouched&&(!0===t.allowSlideNext||!0===t.allowSlidePrev)&&t.setGrabCursor(!1);var p,c=te.now(),u=c-a.touchStartTime;if(t.allowClick&&(t.updateClickedSlide(d),t.emit("tap",d),u<300&&300<c-a.lastClickTime&&(a.clickTimeout&&clearTimeout(a.clickTimeout),a.clickTimeout=te.nextTick(function(){t&&!t.destroyed&&t.emit("click",d)},300)),u<300&&c-a.lastClickTime<300&&(a.clickTimeout&&clearTimeout(a.clickTimeout),t.emit("doubleTap",d))),a.lastClickTime=te.now(),te.nextTick(function(){t.destroyed||(t.allowClick=!0)}),!a.isTouched||!a.isMoved||!t.swipeDirection||0===s.diff||a.currentTranslate===a.startTranslate)return a.isTouched=!1,a.isMoved=!1,void(a.startMoving=!1);if(a.isTouched=!1,a.isMoved=!1,a.startMoving=!1,p=i.followFinger?r?t.translate:-t.translate:-a.currentTranslate,i.freeMode){if(p<-t.minTranslate())return void t.slideTo(t.activeIndex);if(p>-t.maxTranslate())return void(t.slides.length<l.length?t.slideTo(l.length-1):t.slideTo(t.slides.length-1));if(i.freeModeMomentum){if(1<a.velocities.length){var h=a.velocities.pop(),v=a.velocities.pop(),f=h.position-v.position,m=h.time-v.time;t.velocity=f/m,t.velocity/=2,Math.abs(t.velocity)<i.freeModeMinimumVelocity&&(t.velocity=0),(150<m||300<te.now()-h.time)&&(t.velocity=0)}else t.velocity=0;t.velocity*=i.freeModeMomentumVelocityRatio,a.velocities.length=0;var g=1e3*i.freeModeMomentumRatio,b=t.velocity*g,w=t.translate+b;r&&(w=-w);var y,x,T=!1,E=20*Math.abs(t.velocity)*i.freeModeMomentumBounceRatio;if(w<t.maxTranslate())i.freeModeMomentumBounce?(w+t.maxTranslate()<-E&&(w=t.maxTranslate()-E),y=t.maxTranslate(),T=!0,a.allowMomentumBounce=!0):w=t.maxTranslate(),i.loop&&i.centeredSlides&&(x=!0);else if(w>t.minTranslate())i.freeModeMomentumBounce?(w-t.minTranslate()>E&&(w=t.minTranslate()+E),y=t.minTranslate(),T=!0,a.allowMomentumBounce=!0):w=t.minTranslate(),i.loop&&i.centeredSlides&&(x=!0);else if(i.freeModeSticky){for(var S,C=0;C<l.length;C+=1)if(l[C]>-w){S=C;break}w=-(w=Math.abs(l[S]-w)<Math.abs(l[S-1]-w)||"next"===t.swipeDirection?l[S]:l[S-1])}if(x&&t.once("transitionEnd",function(){t.loopFix()}),0!==t.velocity)g=r?Math.abs((-w-t.translate)/t.velocity):Math.abs((w-t.translate)/t.velocity);else if(i.freeModeSticky)return void t.slideToClosest();i.freeModeMomentumBounce&&T?(t.updateProgress(y),t.setTransition(g),t.setTranslate(w),t.transitionStart(!0,t.swipeDirection),t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&a.allowMomentumBounce&&(t.emit("momentumBounce"),t.setTransition(i.speed),t.setTranslate(y),n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))})):t.velocity?(t.updateProgress(w),t.setTransition(g),t.setTranslate(w),t.transitionStart(!0,t.swipeDirection),t.animating||(t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))):t.updateProgress(w),t.updateActiveIndex(),t.updateSlidesClasses()}else if(i.freeModeSticky)return void t.slideToClosest();(!i.freeModeMomentum||u>=i.longSwipesMs)&&(t.updateProgress(),t.updateActiveIndex(),t.updateSlidesClasses())}else{for(var M=0,P=t.slidesSizesGrid[0],k=0;k<o.length;k+=i.slidesPerGroup)void 0!==o[k+i.slidesPerGroup]?p>=o[k]&&p<o[k+i.slidesPerGroup]&&(P=o[(M=k)+i.slidesPerGroup]-o[k]):p>=o[k]&&(M=k,P=o[o.length-1]-o[o.length-2]);var z=(p-o[M])/P;if(u>i.longSwipesMs){if(!i.longSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&(z>=i.longSwipesRatio?t.slideTo(M+i.slidesPerGroup):t.slideTo(M)),"prev"===t.swipeDirection&&(z>1-i.longSwipesRatio?t.slideTo(M+i.slidesPerGroup):t.slideTo(M))}else{if(!i.shortSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&t.slideTo(M+i.slidesPerGroup),"prev"===t.swipeDirection&&t.slideTo(M)}}}.bind(e),e.onClick=function(e){this.allowClick||(this.params.preventClicks&&e.preventDefault(),this.params.preventClicksPropagation&&this.animating&&(e.stopPropagation(),e.stopImmediatePropagation()))}.bind(e);var r="container"===t.touchEventsTarget?i:s,n=!!t.nested;if(ae.touch||!ae.pointerEvents&&!ae.prefixedPointerEvents){if(ae.touch){var o=!("touchstart"!==a.start||!ae.passiveListener||!t.passiveListeners)&&{passive:!0,capture:!1};r.addEventListener(a.start,e.onTouchStart,o),r.addEventListener(a.move,e.onTouchMove,ae.passiveListener?{passive:!1,capture:n}:n),r.addEventListener(a.end,e.onTouchEnd,o)}(t.simulateTouch&&!g.ios&&!g.android||t.simulateTouch&&!ae.touch&&g.ios)&&(r.addEventListener("mousedown",e.onTouchStart,!1),f.addEventListener("mousemove",e.onTouchMove,n),f.addEventListener("mouseup",e.onTouchEnd,!1))}else r.addEventListener(a.start,e.onTouchStart,!1),f.addEventListener(a.move,e.onTouchMove,n),f.addEventListener(a.end,e.onTouchEnd,!1);(t.preventClicks||t.preventClicksPropagation)&&r.addEventListener("click",e.onClick,!0),e.on(g.ios||g.android?"resize orientationchange observerUpdate":"resize observerUpdate",b,!0)},detachEvents:function(){var e=this,t=e.params,a=e.touchEvents,i=e.el,s=e.wrapperEl,r="container"===t.touchEventsTarget?i:s,n=!!t.nested;if(ae.touch||!ae.pointerEvents&&!ae.prefixedPointerEvents){if(ae.touch){var o=!("onTouchStart"!==a.start||!ae.passiveListener||!t.passiveListeners)&&{passive:!0,capture:!1};r.removeEventListener(a.start,e.onTouchStart,o),r.removeEventListener(a.move,e.onTouchMove,n),r.removeEventListener(a.end,e.onTouchEnd,o)}(t.simulateTouch&&!g.ios&&!g.android||t.simulateTouch&&!ae.touch&&g.ios)&&(r.removeEventListener("mousedown",e.onTouchStart,!1),f.removeEventListener("mousemove",e.onTouchMove,n),f.removeEventListener("mouseup",e.onTouchEnd,!1))}else r.removeEventListener(a.start,e.onTouchStart,!1),f.removeEventListener(a.move,e.onTouchMove,n),f.removeEventListener(a.end,e.onTouchEnd,!1);(t.preventClicks||t.preventClicksPropagation)&&r.removeEventListener("click",e.onClick,!0),e.off(g.ios||g.android?"resize orientationchange observerUpdate":"resize observerUpdate",b)}},breakpoints:{setBreakpoint:function(){var e=this,t=e.activeIndex,a=e.initialized,i=e.loopedSlides;void 0===i&&(i=0);var s=e.params,r=s.breakpoints;if(r&&(!r||0!==Object.keys(r).length)){var n=e.getBreakpoint(r);if(n&&e.currentBreakpoint!==n){var o=n in r?r[n]:void 0;o&&["slidesPerView","spaceBetween","slidesPerGroup"].forEach(function(e){var t=o[e];void 0!==t&&(o[e]="slidesPerView"!==e||"AUTO"!==t&&"auto"!==t?"slidesPerView"===e?parseFloat(t):parseInt(t,10):"auto")});var l=o||e.originalParams,d=l.direction&&l.direction!==s.direction,p=s.loop&&(l.slidesPerView!==s.slidesPerView||d);d&&a&&e.changeDirection(),te.extend(e.params,l),te.extend(e,{allowTouchMove:e.params.allowTouchMove,allowSlideNext:e.params.allowSlideNext,allowSlidePrev:e.params.allowSlidePrev}),e.currentBreakpoint=n,p&&a&&(e.loopDestroy(),e.loopCreate(),e.updateSlides(),e.slideTo(t-i+e.loopedSlides,0,!1)),e.emit("breakpoint",l)}}},getBreakpoint:function(e){if(e){var t=!1,a=[];Object.keys(e).forEach(function(e){a.push(e)}),a.sort(function(e,t){return parseInt(e,10)-parseInt(t,10)});for(var i=0;i<a.length;i+=1){var s=a[i];this.params.breakpointsInverse?s<=ee.innerWidth&&(t=s):s>=ee.innerWidth&&!t&&(t=s)}return t||"max"}}},checkOverflow:{checkOverflow:function(){var e=this,t=e.isLocked;e.isLocked=1===e.snapGrid.length,e.allowSlideNext=!e.isLocked,e.allowSlidePrev=!e.isLocked,t!==e.isLocked&&e.emit(e.isLocked?"lock":"unlock"),t&&t!==e.isLocked&&(e.isEnd=!1,e.navigation.update())}},classes:{addClasses:function(){var t=this.classNames,a=this.params,e=this.rtl,i=this.$el,s=[];s.push("initialized"),s.push(a.direction),a.freeMode&&s.push("free-mode"),ae.flexbox||s.push("no-flexbox"),a.autoHeight&&s.push("autoheight"),e&&s.push("rtl"),1<a.slidesPerColumn&&s.push("multirow"),g.android&&s.push("android"),g.ios&&s.push("ios"),(ie.isIE||ie.isEdge)&&(ae.pointerEvents||ae.prefixedPointerEvents)&&s.push("wp8-"+a.direction),s.forEach(function(e){t.push(a.containerModifierClass+e)}),i.addClass(t.join(" "))},removeClasses:function(){var e=this.$el,t=this.classNames;e.removeClass(t.join(" "))}},images:{loadImage:function(e,t,a,i,s,r){var n;function o(){r&&r()}e.complete&&s?o():t?((n=new ee.Image).onload=o,n.onerror=o,i&&(n.sizes=i),a&&(n.srcset=a),t&&(n.src=t)):o()},preloadImages:function(){var e=this;function t(){null!=e&&e&&!e.destroyed&&(void 0!==e.imagesLoaded&&(e.imagesLoaded+=1),e.imagesLoaded===e.imagesToLoad.length&&(e.params.updateOnImagesReady&&e.update(),e.emit("imagesReady")))}e.imagesToLoad=e.$el.find("img");for(var a=0;a<e.imagesToLoad.length;a+=1){var i=e.imagesToLoad[a];e.loadImage(i,i.currentSrc||i.getAttribute("src"),i.srcset||i.getAttribute("srcset"),i.sizes||i.getAttribute("sizes"),!0,t)}}}},x={},T=function(u){function h(){for(var e,t,s,a=[],i=arguments.length;i--;)a[i]=arguments[i];s=(s=1===a.length&&a[0].constructor&&a[0].constructor===Object?a[0]:(t=(e=a)[0],e[1]))||{},s=te.extend({},s),t&&!s.el&&(s.el=t),u.call(this,s),Object.keys(y).forEach(function(t){Object.keys(y[t]).forEach(function(e){h.prototype[e]||(h.prototype[e]=y[t][e])})});var r=this;void 0===r.modules&&(r.modules={}),Object.keys(r.modules).forEach(function(e){var t=r.modules[e];if(t.params){var a=Object.keys(t.params)[0],i=t.params[a];if("object"!=typeof i||null===i)return;if(!(a in s&&"enabled"in i))return;!0===s[a]&&(s[a]={enabled:!0}),"object"!=typeof s[a]||"enabled"in s[a]||(s[a].enabled=!0),s[a]||(s[a]={enabled:!1})}});var n=te.extend({},w);r.useModulesParams(n),r.params=te.extend({},n,x,s),r.originalParams=te.extend({},r.params),r.passedParams=te.extend({},s);var o=(r.$=I)(r.params.el);if(t=o[0]){if(1<o.length){var l=[];return o.each(function(e,t){var a=te.extend({},s,{el:t});l.push(new h(a))}),l}t.swiper=r,o.data("swiper",r);var d,p,c=o.children("."+r.params.wrapperClass);return te.extend(r,{$el:o,el:t,$wrapperEl:c,wrapperEl:c[0],classNames:[],slides:I(),slidesGrid:[],snapGrid:[],slidesSizesGrid:[],isHorizontal:function(){return"horizontal"===r.params.direction},isVertical:function(){return"vertical"===r.params.direction},rtl:"rtl"===t.dir.toLowerCase()||"rtl"===o.css("direction"),rtlTranslate:"horizontal"===r.params.direction&&("rtl"===t.dir.toLowerCase()||"rtl"===o.css("direction")),wrongRTL:"-webkit-box"===c.css("display"),activeIndex:0,realIndex:0,isBeginning:!0,isEnd:!1,translate:0,previousTranslate:0,progress:0,velocity:0,animating:!1,allowSlideNext:r.params.allowSlideNext,allowSlidePrev:r.params.allowSlidePrev,touchEvents:(d=["touchstart","touchmove","touchend"],p=["mousedown","mousemove","mouseup"],ae.pointerEvents?p=["pointerdown","pointermove","pointerup"]:ae.prefixedPointerEvents&&(p=["MSPointerDown","MSPointerMove","MSPointerUp"]),r.touchEventsTouch={start:d[0],move:d[1],end:d[2]},r.touchEventsDesktop={start:p[0],move:p[1],end:p[2]},ae.touch||!r.params.simulateTouch?r.touchEventsTouch:r.touchEventsDesktop),touchEventsData:{isTouched:void 0,isMoved:void 0,allowTouchCallbacks:void 0,touchStartTime:void 0,isScrolling:void 0,currentTranslate:void 0,startTranslate:void 0,allowThresholdMove:void 0,formElements:"input, select, option, textarea, button, video",lastClickTime:te.now(),clickTimeout:void 0,velocities:[],allowMomentumBounce:void 0,isTouchEvent:void 0,startMoving:void 0},allowClick:!0,allowTouchMove:r.params.allowTouchMove,touches:{startX:0,startY:0,currentX:0,currentY:0,diff:0},imagesToLoad:[],imagesLoaded:0}),r.useModules(),r.params.init&&r.init(),r}}u&&(h.__proto__=u);var e={extendedDefaults:{configurable:!0},defaults:{configurable:!0},Class:{configurable:!0},$:{configurable:!0}};return((h.prototype=Object.create(u&&u.prototype)).constructor=h).prototype.slidesPerViewDynamic=function(){var e=this,t=e.params,a=e.slides,i=e.slidesGrid,s=e.size,r=e.activeIndex,n=1;if(t.centeredSlides){for(var o,l=a[r].swiperSlideSize,d=r+1;d<a.length;d+=1)a[d]&&!o&&(n+=1,s<(l+=a[d].swiperSlideSize)&&(o=!0));for(var p=r-1;0<=p;p-=1)a[p]&&!o&&(n+=1,s<(l+=a[p].swiperSlideSize)&&(o=!0))}else for(var c=r+1;c<a.length;c+=1)i[c]-i[r]<s&&(n+=1);return n},h.prototype.update=function(){var a=this;if(a&&!a.destroyed){var e=a.snapGrid,t=a.params;t.breakpoints&&a.setBreakpoint(),a.updateSize(),a.updateSlides(),a.updateProgress(),a.updateSlidesClasses(),a.params.freeMode?(i(),a.params.autoHeight&&a.updateAutoHeight()):(("auto"===a.params.slidesPerView||1<a.params.slidesPerView)&&a.isEnd&&!a.params.centeredSlides?a.slideTo(a.slides.length-1,0,!1,!0):a.slideTo(a.activeIndex,0,!1,!0))||i(),t.watchOverflow&&e!==a.snapGrid&&a.checkOverflow(),a.emit("update")}function i(){var e=a.rtlTranslate?-1*a.translate:a.translate,t=Math.min(Math.max(e,a.maxTranslate()),a.minTranslate());a.setTranslate(t),a.updateActiveIndex(),a.updateSlidesClasses()}},h.prototype.changeDirection=function(a,e){void 0===e&&(e=!0);var t=this,i=t.params.direction;return(a=a||("horizontal"===i?"vertical":"horizontal"))===i||"horizontal"!==a&&"vertical"!==a||(t.$el.removeClass(""+t.params.containerModifierClass+i+" wp8-"+i).addClass(""+t.params.containerModifierClass+a),(ie.isIE||ie.isEdge)&&(ae.pointerEvents||ae.prefixedPointerEvents)&&t.$el.addClass(t.params.containerModifierClass+"wp8-"+a),t.params.direction=a,t.slides.each(function(e,t){"vertical"===a?t.style.width="":t.style.height=""}),t.emit("changeDirection"),e&&t.update()),t},h.prototype.init=function(){var e=this;e.initialized||(e.emit("beforeInit"),e.params.breakpoints&&e.setBreakpoint(),e.addClasses(),e.params.loop&&e.loopCreate(),e.updateSize(),e.updateSlides(),e.params.watchOverflow&&e.checkOverflow(),e.params.grabCursor&&e.setGrabCursor(),e.params.preloadImages&&e.preloadImages(),e.params.loop?e.slideTo(e.params.initialSlide+e.loopedSlides,0,e.params.runCallbacksOnInit):e.slideTo(e.params.initialSlide,0,e.params.runCallbacksOnInit),e.attachEvents(),e.initialized=!0,e.emit("init"))},h.prototype.destroy=function(e,t){void 0===e&&(e=!0),void 0===t&&(t=!0);var a=this,i=a.params,s=a.$el,r=a.$wrapperEl,n=a.slides;return void 0===a.params||a.destroyed||(a.emit("beforeDestroy"),a.initialized=!1,a.detachEvents(),i.loop&&a.loopDestroy(),t&&(a.removeClasses(),s.removeAttr("style"),r.removeAttr("style"),n&&n.length&&n.removeClass([i.slideVisibleClass,i.slideActiveClass,i.slideNextClass,i.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index").removeAttr("data-swiper-column").removeAttr("data-swiper-row")),a.emit("destroy"),Object.keys(a.eventsListeners).forEach(function(e){a.off(e)}),!1!==e&&(a.$el[0].swiper=null,a.$el.data("swiper",null),te.deleteProps(a)),a.destroyed=!0),null},h.extendDefaults=function(e){te.extend(x,e)},e.extendedDefaults.get=function(){return x},e.defaults.get=function(){return w},e.Class.get=function(){return u},e.$.get=function(){return I},Object.defineProperties(h,e),h}(e),E={name:"device",proto:{device:g},static:{device:g}},S={name:"support",proto:{support:ae},static:{support:ae}},C={name:"browser",proto:{browser:ie},static:{browser:ie}},M={name:"resize",create:function(){var e=this;te.extend(e,{resize:{resizeHandler:function(){e&&!e.destroyed&&e.initialized&&(e.emit("beforeResize"),e.emit("resize"))},orientationChangeHandler:function(){e&&!e.destroyed&&e.initialized&&e.emit("orientationchange")}}})},on:{init:function(){ee.addEventListener("resize",this.resize.resizeHandler),ee.addEventListener("orientationchange",this.resize.orientationChangeHandler)},destroy:function(){ee.removeEventListener("resize",this.resize.resizeHandler),ee.removeEventListener("orientationchange",this.resize.orientationChangeHandler)}}},P={func:ee.MutationObserver||ee.WebkitMutationObserver,attach:function(e,t){void 0===t&&(t={});var a=this,i=new P.func(function(e){if(1!==e.length){var t=function(){a.emit("observerUpdate",e[0])};ee.requestAnimationFrame?ee.requestAnimationFrame(t):ee.setTimeout(t,0)}else a.emit("observerUpdate",e[0])});i.observe(e,{attributes:void 0===t.attributes||t.attributes,childList:void 0===t.childList||t.childList,characterData:void 0===t.characterData||t.characterData}),a.observer.observers.push(i)},init:function(){var e=this;if(ae.observer&&e.params.observer){if(e.params.observeParents)for(var t=e.$el.parents(),a=0;a<t.length;a+=1)e.observer.attach(t[a]);e.observer.attach(e.$el[0],{childList:e.params.observeSlideChildren}),e.observer.attach(e.$wrapperEl[0],{attributes:!1})}},destroy:function(){this.observer.observers.forEach(function(e){e.disconnect()}),this.observer.observers=[]}},k={name:"observer",params:{observer:!1,observeParents:!1,observeSlideChildren:!1},create:function(){te.extend(this,{observer:{init:P.init.bind(this),attach:P.attach.bind(this),destroy:P.destroy.bind(this),observers:[]}})},on:{init:function(){this.observer.init()},destroy:function(){this.observer.destroy()}}},z={update:function(e){var t=this,a=t.params,i=a.slidesPerView,s=a.slidesPerGroup,r=a.centeredSlides,n=t.params.virtual,o=n.addSlidesBefore,l=n.addSlidesAfter,d=t.virtual,p=d.from,c=d.to,u=d.slides,h=d.slidesGrid,v=d.renderSlide,f=d.offset;t.updateActiveIndex();var m,g,b,w=t.activeIndex||0;m=t.rtlTranslate?"right":t.isHorizontal()?"left":"top",b=r?(g=Math.floor(i/2)+s+o,Math.floor(i/2)+s+l):(g=i+(s-1)+o,s+l);var y=Math.max((w||0)-b,0),x=Math.min((w||0)+g,u.length-1),T=(t.slidesGrid[y]||0)-(t.slidesGrid[0]||0);function E(){t.updateSlides(),t.updateProgress(),t.updateSlidesClasses(),t.lazy&&t.params.lazy.enabled&&t.lazy.load()}if(te.extend(t.virtual,{from:y,to:x,offset:T,slidesGrid:t.slidesGrid}),p===y&&c===x&&!e)return t.slidesGrid!==h&&T!==f&&t.slides.css(m,T+"px"),void t.updateProgress();if(t.params.virtual.renderExternal)return t.params.virtual.renderExternal.call(t,{offset:T,from:y,to:x,slides:function(){for(var e=[],t=y;t<=x;t+=1)e.push(u[t]);return e}()}),void E();var S=[],C=[];if(e)t.$wrapperEl.find("."+t.params.slideClass).remove();else for(var M=p;M<=c;M+=1)(M<y||x<M)&&t.$wrapperEl.find("."+t.params.slideClass+'[data-swiper-slide-index="'+M+'"]').remove();for(var P=0;P<u.length;P+=1)y<=P&&P<=x&&(void 0===c||e?C.push(P):(c<P&&C.push(P),P<p&&S.push(P)));C.forEach(function(e){t.$wrapperEl.append(v(u[e],e))}),S.sort(function(e,t){return t-e}).forEach(function(e){t.$wrapperEl.prepend(v(u[e],e))}),t.$wrapperEl.children(".swiper-slide").css(m,T+"px"),E()},renderSlide:function(e,t){var a=this,i=a.params.virtual;if(i.cache&&a.virtual.cache[t])return a.virtual.cache[t];var s=i.renderSlide?I(i.renderSlide.call(a,e,t)):I('<div class="'+a.params.slideClass+'" data-swiper-slide-index="'+t+'">'+e+"</div>");return s.attr("data-swiper-slide-index")||s.attr("data-swiper-slide-index",t),i.cache&&(a.virtual.cache[t]=s),s},appendSlide:function(e){if("object"==typeof e&&"length"in e)for(var t=0;t<e.length;t+=1)e[t]&&this.virtual.slides.push(e[t]);else this.virtual.slides.push(e);this.virtual.update(!0)},prependSlide:function(e){var t=this,a=t.activeIndex,i=a+1,s=1;if(Array.isArray(e)){for(var r=0;r<e.length;r+=1)e[r]&&t.virtual.slides.unshift(e[r]);i=a+e.length,s=e.length}else t.virtual.slides.unshift(e);if(t.params.virtual.cache){var n=t.virtual.cache,o={};Object.keys(n).forEach(function(e){o[parseInt(e,10)+s]=n[e]}),t.virtual.cache=o}t.virtual.update(!0),t.slideTo(i,0)},removeSlide:function(e){var t=this;if(null!=e){var a=t.activeIndex;if(Array.isArray(e))for(var i=e.length-1;0<=i;i-=1)t.virtual.slides.splice(e[i],1),t.params.virtual.cache&&delete t.virtual.cache[e[i]],e[i]<a&&(a-=1),a=Math.max(a,0);else t.virtual.slides.splice(e,1),t.params.virtual.cache&&delete t.virtual.cache[e],e<a&&(a-=1),a=Math.max(a,0);t.virtual.update(!0),t.slideTo(a,0)}},removeAllSlides:function(){var e=this;e.virtual.slides=[],e.params.virtual.cache&&(e.virtual.cache={}),e.virtual.update(!0),e.slideTo(0,0)}},$={name:"virtual",params:{virtual:{enabled:!1,slides:[],cache:!0,renderSlide:null,renderExternal:null,addSlidesBefore:0,addSlidesAfter:0}},create:function(){var e=this;te.extend(e,{virtual:{update:z.update.bind(e),appendSlide:z.appendSlide.bind(e),prependSlide:z.prependSlide.bind(e),removeSlide:z.removeSlide.bind(e),removeAllSlides:z.removeAllSlides.bind(e),renderSlide:z.renderSlide.bind(e),slides:e.params.virtual.slides,cache:{}}})},on:{beforeInit:function(){var e=this;if(e.params.virtual.enabled){e.classNames.push(e.params.containerModifierClass+"virtual");var t={watchSlidesProgress:!0};te.extend(e.params,t),te.extend(e.originalParams,t),e.params.initialSlide||e.virtual.update()}},setTranslate:function(){this.params.virtual.enabled&&this.virtual.update()}}},L={handle:function(e){var t=this,a=t.rtlTranslate,i=e;i.originalEvent&&(i=i.originalEvent);var s=i.keyCode||i.charCode;if(!t.allowSlideNext&&(t.isHorizontal()&&39===s||t.isVertical()&&40===s||34===s))return!1;if(!t.allowSlidePrev&&(t.isHorizontal()&&37===s||t.isVertical()&&38===s||33===s))return!1;if(!(i.shiftKey||i.altKey||i.ctrlKey||i.metaKey||f.activeElement&&f.activeElement.nodeName&&("input"===f.activeElement.nodeName.toLowerCase()||"textarea"===f.activeElement.nodeName.toLowerCase()))){if(t.params.keyboard.onlyInViewport&&(33===s||34===s||37===s||39===s||38===s||40===s)){var r=!1;if(0<t.$el.parents("."+t.params.slideClass).length&&0===t.$el.parents("."+t.params.slideActiveClass).length)return;var n=ee.innerWidth,o=ee.innerHeight,l=t.$el.offset();a&&(l.left-=t.$el[0].scrollLeft);for(var d=[[l.left,l.top],[l.left+t.width,l.top],[l.left,l.top+t.height],[l.left+t.width,l.top+t.height]],p=0;p<d.length;p+=1){var c=d[p];0<=c[0]&&c[0]<=n&&0<=c[1]&&c[1]<=o&&(r=!0)}if(!r)return}t.isHorizontal()?(33!==s&&34!==s&&37!==s&&39!==s||(i.preventDefault?i.preventDefault():i.returnValue=!1),(34!==s&&39!==s||a)&&(33!==s&&37!==s||!a)||t.slideNext(),(33!==s&&37!==s||a)&&(34!==s&&39!==s||!a)||t.slidePrev()):(33!==s&&34!==s&&38!==s&&40!==s||(i.preventDefault?i.preventDefault():i.returnValue=!1),34!==s&&40!==s||t.slideNext(),33!==s&&38!==s||t.slidePrev()),t.emit("keyPress",s)}},enable:function(){this.keyboard.enabled||(I(f).on("keydown",this.keyboard.handle),this.keyboard.enabled=!0)},disable:function(){this.keyboard.enabled&&(I(f).off("keydown",this.keyboard.handle),this.keyboard.enabled=!1)}},D={name:"keyboard",params:{keyboard:{enabled:!1,onlyInViewport:!0}},create:function(){te.extend(this,{keyboard:{enabled:!1,enable:L.enable.bind(this),disable:L.disable.bind(this),handle:L.handle.bind(this)}})},on:{init:function(){this.params.keyboard.enabled&&this.keyboard.enable()},destroy:function(){this.keyboard.enabled&&this.keyboard.disable()}}};var O={lastScrollTime:te.now(),event:-1<ee.navigator.userAgent.indexOf("firefox")?"DOMMouseScroll":function(){var e="onwheel",t=e in f;if(!t){var a=f.createElement("div");a.setAttribute(e,"return;"),t="function"==typeof a[e]}return!t&&f.implementation&&f.implementation.hasFeature&&!0!==f.implementation.hasFeature("","")&&(t=f.implementation.hasFeature("Events.wheel","3.0")),t}()?"wheel":"mousewheel",normalize:function(e){var t=0,a=0,i=0,s=0;return"detail"in e&&(a=e.detail),"wheelDelta"in e&&(a=-e.wheelDelta/120),"wheelDeltaY"in e&&(a=-e.wheelDeltaY/120),"wheelDeltaX"in e&&(t=-e.wheelDeltaX/120),"axis"in e&&e.axis===e.HORIZONTAL_AXIS&&(t=a,a=0),i=10*t,s=10*a,"deltaY"in e&&(s=e.deltaY),"deltaX"in e&&(i=e.deltaX),(i||s)&&e.deltaMode&&(1===e.deltaMode?(i*=40,s*=40):(i*=800,s*=800)),i&&!t&&(t=i<1?-1:1),s&&!a&&(a=s<1?-1:1),{spinX:t,spinY:a,pixelX:i,pixelY:s}},handleMouseEnter:function(){this.mouseEntered=!0},handleMouseLeave:function(){this.mouseEntered=!1},handle:function(e){var t=e,a=this,i=a.params.mousewheel;if(!a.mouseEntered&&!i.releaseOnEdges)return!0;t.originalEvent&&(t=t.originalEvent);var s=0,r=a.rtlTranslate?-1:1,n=O.normalize(t);if(i.forceToAxis)if(a.isHorizontal()){if(!(Math.abs(n.pixelX)>Math.abs(n.pixelY)))return!0;s=n.pixelX*r}else{if(!(Math.abs(n.pixelY)>Math.abs(n.pixelX)))return!0;s=n.pixelY}else s=Math.abs(n.pixelX)>Math.abs(n.pixelY)?-n.pixelX*r:-n.pixelY;if(0===s)return!0;if(i.invert&&(s=-s),a.params.freeMode){a.params.loop&&a.loopFix();var o=a.getTranslate()+s*i.sensitivity,l=a.isBeginning,d=a.isEnd;if(o>=a.minTranslate()&&(o=a.minTranslate()),o<=a.maxTranslate()&&(o=a.maxTranslate()),a.setTransition(0),a.setTranslate(o),a.updateProgress(),a.updateActiveIndex(),a.updateSlidesClasses(),(!l&&a.isBeginning||!d&&a.isEnd)&&a.updateSlidesClasses(),a.params.freeModeSticky&&(clearTimeout(a.mousewheel.timeout),a.mousewheel.timeout=te.nextTick(function(){a.slideToClosest()},300)),a.emit("scroll",t),a.params.autoplay&&a.params.autoplayDisableOnInteraction&&a.autoplay.stop(),o===a.minTranslate()||o===a.maxTranslate())return!0}else{if(60<te.now()-a.mousewheel.lastScrollTime)if(s<0)if(a.isEnd&&!a.params.loop||a.animating){if(i.releaseOnEdges)return!0}else a.slideNext(),a.emit("scroll",t);else if(a.isBeginning&&!a.params.loop||a.animating){if(i.releaseOnEdges)return!0}else a.slidePrev(),a.emit("scroll",t);a.mousewheel.lastScrollTime=(new ee.Date).getTime()}return t.preventDefault?t.preventDefault():t.returnValue=!1,!1},enable:function(){var e=this;if(!O.event)return!1;if(e.mousewheel.enabled)return!1;var t=e.$el;return"container"!==e.params.mousewheel.eventsTarged&&(t=I(e.params.mousewheel.eventsTarged)),t.on("mouseenter",e.mousewheel.handleMouseEnter),t.on("mouseleave",e.mousewheel.handleMouseLeave),t.on(O.event,e.mousewheel.handle),e.mousewheel.enabled=!0},disable:function(){var e=this;if(!O.event)return!1;if(!e.mousewheel.enabled)return!1;var t=e.$el;return"container"!==e.params.mousewheel.eventsTarged&&(t=I(e.params.mousewheel.eventsTarged)),t.off(O.event,e.mousewheel.handle),!(e.mousewheel.enabled=!1)}},A={update:function(){var e=this,t=e.params.navigation;if(!e.params.loop){var a=e.navigation,i=a.$nextEl,s=a.$prevEl;s&&0<s.length&&(e.isBeginning?s.addClass(t.disabledClass):s.removeClass(t.disabledClass),s[e.params.watchOverflow&&e.isLocked?"addClass":"removeClass"](t.lockClass)),i&&0<i.length&&(e.isEnd?i.addClass(t.disabledClass):i.removeClass(t.disabledClass),i[e.params.watchOverflow&&e.isLocked?"addClass":"removeClass"](t.lockClass))}},onPrevClick:function(e){e.preventDefault(),this.isBeginning&&!this.params.loop||this.slidePrev()},onNextClick:function(e){e.preventDefault(),this.isEnd&&!this.params.loop||this.slideNext()},init:function(){var e,t,a=this,i=a.params.navigation;(i.nextEl||i.prevEl)&&(i.nextEl&&(e=I(i.nextEl),a.params.uniqueNavElements&&"string"==typeof i.nextEl&&1<e.length&&1===a.$el.find(i.nextEl).length&&(e=a.$el.find(i.nextEl))),i.prevEl&&(t=I(i.prevEl),a.params.uniqueNavElements&&"string"==typeof i.prevEl&&1<t.length&&1===a.$el.find(i.prevEl).length&&(t=a.$el.find(i.prevEl))),e&&0<e.length&&e.on("click",a.navigation.onNextClick),t&&0<t.length&&t.on("click",a.navigation.onPrevClick),te.extend(a.navigation,{$nextEl:e,nextEl:e&&e[0],$prevEl:t,prevEl:t&&t[0]}))},destroy:function(){var e=this,t=e.navigation,a=t.$nextEl,i=t.$prevEl;a&&a.length&&(a.off("click",e.navigation.onNextClick),a.removeClass(e.params.navigation.disabledClass)),i&&i.length&&(i.off("click",e.navigation.onPrevClick),i.removeClass(e.params.navigation.disabledClass))}},H={update:function(){var e=this,t=e.rtl,s=e.params.pagination;if(s.el&&e.pagination.el&&e.pagination.$el&&0!==e.pagination.$el.length){var r,a=e.virtual&&e.params.virtual.enabled?e.virtual.slides.length:e.slides.length,i=e.pagination.$el,n=e.params.loop?Math.ceil((a-2*e.loopedSlides)/e.params.slidesPerGroup):e.snapGrid.length;if(e.params.loop?((r=Math.ceil((e.activeIndex-e.loopedSlides)/e.params.slidesPerGroup))>a-1-2*e.loopedSlides&&(r-=a-2*e.loopedSlides),n-1<r&&(r-=n),r<0&&"bullets"!==e.params.paginationType&&(r=n+r)):r=void 0!==e.snapIndex?e.snapIndex:e.activeIndex||0,"bullets"===s.type&&e.pagination.bullets&&0<e.pagination.bullets.length){var o,l,d,p=e.pagination.bullets;if(s.dynamicBullets&&(e.pagination.bulletSize=p.eq(0)[e.isHorizontal()?"outerWidth":"outerHeight"](!0),i.css(e.isHorizontal()?"width":"height",e.pagination.bulletSize*(s.dynamicMainBullets+4)+"px"),1<s.dynamicMainBullets&&void 0!==e.previousIndex&&(e.pagination.dynamicBulletIndex+=r-e.previousIndex,e.pagination.dynamicBulletIndex>s.dynamicMainBullets-1?e.pagination.dynamicBulletIndex=s.dynamicMainBullets-1:e.pagination.dynamicBulletIndex<0&&(e.pagination.dynamicBulletIndex=0)),o=r-e.pagination.dynamicBulletIndex,d=((l=o+(Math.min(p.length,s.dynamicMainBullets)-1))+o)/2),p.removeClass(s.bulletActiveClass+" "+s.bulletActiveClass+"-next "+s.bulletActiveClass+"-next-next "+s.bulletActiveClass+"-prev "+s.bulletActiveClass+"-prev-prev "+s.bulletActiveClass+"-main"),1<i.length)p.each(function(e,t){var a=I(t),i=a.index();i===r&&a.addClass(s.bulletActiveClass),s.dynamicBullets&&(o<=i&&i<=l&&a.addClass(s.bulletActiveClass+"-main"),i===o&&a.prev().addClass(s.bulletActiveClass+"-prev").prev().addClass(s.bulletActiveClass+"-prev-prev"),i===l&&a.next().addClass(s.bulletActiveClass+"-next").next().addClass(s.bulletActiveClass+"-next-next"))});else if(p.eq(r).addClass(s.bulletActiveClass),s.dynamicBullets){for(var c=p.eq(o),u=p.eq(l),h=o;h<=l;h+=1)p.eq(h).addClass(s.bulletActiveClass+"-main");c.prev().addClass(s.bulletActiveClass+"-prev").prev().addClass(s.bulletActiveClass+"-prev-prev"),u.next().addClass(s.bulletActiveClass+"-next").next().addClass(s.bulletActiveClass+"-next-next")}if(s.dynamicBullets){var v=Math.min(p.length,s.dynamicMainBullets+4),f=(e.pagination.bulletSize*v-e.pagination.bulletSize)/2-d*e.pagination.bulletSize,m=t?"right":"left";p.css(e.isHorizontal()?m:"top",f+"px")}}if("fraction"===s.type&&(i.find("."+s.currentClass).text(s.formatFractionCurrent(r+1)),i.find("."+s.totalClass).text(s.formatFractionTotal(n))),"progressbar"===s.type){var g;g=s.progressbarOpposite?e.isHorizontal()?"vertical":"horizontal":e.isHorizontal()?"horizontal":"vertical";var b=(r+1)/n,w=1,y=1;"horizontal"===g?w=b:y=b,i.find("."+s.progressbarFillClass).transform("translate3d(0,0,0) scaleX("+w+") scaleY("+y+")").transition(e.params.speed)}"custom"===s.type&&s.renderCustom?(i.html(s.renderCustom(e,r+1,n)),e.emit("paginationRender",e,i[0])):e.emit("paginationUpdate",e,i[0]),i[e.params.watchOverflow&&e.isLocked?"addClass":"removeClass"](s.lockClass)}},render:function(){var e=this,t=e.params.pagination;if(t.el&&e.pagination.el&&e.pagination.$el&&0!==e.pagination.$el.length){var a=e.virtual&&e.params.virtual.enabled?e.virtual.slides.length:e.slides.length,i=e.pagination.$el,s="";if("bullets"===t.type){for(var r=e.params.loop?Math.ceil((a-2*e.loopedSlides)/e.params.slidesPerGroup):e.snapGrid.length,n=0;n<r;n+=1)t.renderBullet?s+=t.renderBullet.call(e,n,t.bulletClass):s+="<"+t.bulletElement+' class="'+t.bulletClass+'"></'+t.bulletElement+">";i.html(s),e.pagination.bullets=i.find("."+t.bulletClass)}"fraction"===t.type&&(s=t.renderFraction?t.renderFraction.call(e,t.currentClass,t.totalClass):'<span class="'+t.currentClass+'"></span> / <span class="'+t.totalClass+'"></span>',i.html(s)),"progressbar"===t.type&&(s=t.renderProgressbar?t.renderProgressbar.call(e,t.progressbarFillClass):'<span class="'+t.progressbarFillClass+'"></span>',i.html(s)),"custom"!==t.type&&e.emit("paginationRender",e.pagination.$el[0])}},init:function(){var a=this,e=a.params.pagination;if(e.el){var t=I(e.el);0!==t.length&&(a.params.uniqueNavElements&&"string"==typeof e.el&&1<t.length&&1===a.$el.find(e.el).length&&(t=a.$el.find(e.el)),"bullets"===e.type&&e.clickable&&t.addClass(e.clickableClass),t.addClass(e.modifierClass+e.type),"bullets"===e.type&&e.dynamicBullets&&(t.addClass(""+e.modifierClass+e.type+"-dynamic"),a.pagination.dynamicBulletIndex=0,e.dynamicMainBullets<1&&(e.dynamicMainBullets=1)),"progressbar"===e.type&&e.progressbarOpposite&&t.addClass(e.progressbarOppositeClass),e.clickable&&t.on("click","."+e.bulletClass,function(e){e.preventDefault();var t=I(this).index()*a.params.slidesPerGroup;a.params.loop&&(t+=a.loopedSlides),a.slideTo(t)}),te.extend(a.pagination,{$el:t,el:t[0]}))}},destroy:function(){var e=this,t=e.params.pagination;if(t.el&&e.pagination.el&&e.pagination.$el&&0!==e.pagination.$el.length){var a=e.pagination.$el;a.removeClass(t.hiddenClass),a.removeClass(t.modifierClass+t.type),e.pagination.bullets&&e.pagination.bullets.removeClass(t.bulletActiveClass),t.clickable&&a.off("click","."+t.bulletClass)}}},G={setTranslate:function(){var e=this;if(e.params.scrollbar.el&&e.scrollbar.el){var t=e.scrollbar,a=e.rtlTranslate,i=e.progress,s=t.dragSize,r=t.trackSize,n=t.$dragEl,o=t.$el,l=e.params.scrollbar,d=s,p=(r-s)*i;a?0<(p=-p)?(d=s-p,p=0):r<-p+s&&(d=r+p):p<0?(d=s+p,p=0):r<p+s&&(d=r-p),e.isHorizontal()?(ae.transforms3d?n.transform("translate3d("+p+"px, 0, 0)"):n.transform("translateX("+p+"px)"),n[0].style.width=d+"px"):(ae.transforms3d?n.transform("translate3d(0px, "+p+"px, 0)"):n.transform("translateY("+p+"px)"),n[0].style.height=d+"px"),l.hide&&(clearTimeout(e.scrollbar.timeout),o[0].style.opacity=1,e.scrollbar.timeout=setTimeout(function(){o[0].style.opacity=0,o.transition(400)},1e3))}},setTransition:function(e){this.params.scrollbar.el&&this.scrollbar.el&&this.scrollbar.$dragEl.transition(e)},updateSize:function(){var e=this;if(e.params.scrollbar.el&&e.scrollbar.el){var t=e.scrollbar,a=t.$dragEl,i=t.$el;a[0].style.width="",a[0].style.height="";var s,r=e.isHorizontal()?i[0].offsetWidth:i[0].offsetHeight,n=e.size/e.virtualSize,o=n*(r/e.size);s="auto"===e.params.scrollbar.dragSize?r*n:parseInt(e.params.scrollbar.dragSize,10),e.isHorizontal()?a[0].style.width=s+"px":a[0].style.height=s+"px",i[0].style.display=1<=n?"none":"",e.params.scrollbar.hide&&(i[0].style.opacity=0),te.extend(t,{trackSize:r,divider:n,moveDivider:o,dragSize:s}),t.$el[e.params.watchOverflow&&e.isLocked?"addClass":"removeClass"](e.params.scrollbar.lockClass)}},getPointerPosition:function(e){return this.isHorizontal()?"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageX:e.pageX||e.clientX:"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageY:e.pageY||e.clientY},setDragPosition:function(e){var t,a=this,i=a.scrollbar,s=a.rtlTranslate,r=i.$el,n=i.dragSize,o=i.trackSize,l=i.dragStartPos;t=(i.getPointerPosition(e)-r.offset()[a.isHorizontal()?"left":"top"]-(null!==l?l:n/2))/(o-n),t=Math.max(Math.min(t,1),0),s&&(t=1-t);var d=a.minTranslate()+(a.maxTranslate()-a.minTranslate())*t;a.updateProgress(d),a.setTranslate(d),a.updateActiveIndex(),a.updateSlidesClasses()},onDragStart:function(e){var t=this,a=t.params.scrollbar,i=t.scrollbar,s=t.$wrapperEl,r=i.$el,n=i.$dragEl;t.scrollbar.isTouched=!0,t.scrollbar.dragStartPos=e.target===n[0]||e.target===n?i.getPointerPosition(e)-e.target.getBoundingClientRect()[t.isHorizontal()?"left":"top"]:null,e.preventDefault(),e.stopPropagation(),s.transition(100),n.transition(100),i.setDragPosition(e),clearTimeout(t.scrollbar.dragTimeout),r.transition(0),a.hide&&r.css("opacity",1),t.emit("scrollbarDragStart",e)},onDragMove:function(e){var t=this.scrollbar,a=this.$wrapperEl,i=t.$el,s=t.$dragEl;this.scrollbar.isTouched&&(e.preventDefault?e.preventDefault():e.returnValue=!1,t.setDragPosition(e),a.transition(0),i.transition(0),s.transition(0),this.emit("scrollbarDragMove",e))},onDragEnd:function(e){var t=this,a=t.params.scrollbar,i=t.scrollbar.$el;t.scrollbar.isTouched&&(t.scrollbar.isTouched=!1,a.hide&&(clearTimeout(t.scrollbar.dragTimeout),t.scrollbar.dragTimeout=te.nextTick(function(){i.css("opacity",0),i.transition(400)},1e3)),t.emit("scrollbarDragEnd",e),a.snapOnRelease&&t.slideToClosest())},enableDraggable:function(){var e=this;if(e.params.scrollbar.el){var t=e.scrollbar,a=e.touchEventsTouch,i=e.touchEventsDesktop,s=e.params,r=t.$el[0],n=!(!ae.passiveListener||!s.passiveListeners)&&{passive:!1,capture:!1},o=!(!ae.passiveListener||!s.passiveListeners)&&{passive:!0,capture:!1};ae.touch?(r.addEventListener(a.start,e.scrollbar.onDragStart,n),r.addEventListener(a.move,e.scrollbar.onDragMove,n),r.addEventListener(a.end,e.scrollbar.onDragEnd,o)):(r.addEventListener(i.start,e.scrollbar.onDragStart,n),f.addEventListener(i.move,e.scrollbar.onDragMove,n),f.addEventListener(i.end,e.scrollbar.onDragEnd,o))}},disableDraggable:function(){var e=this;if(e.params.scrollbar.el){var t=e.scrollbar,a=e.touchEventsTouch,i=e.touchEventsDesktop,s=e.params,r=t.$el[0],n=!(!ae.passiveListener||!s.passiveListeners)&&{passive:!1,capture:!1},o=!(!ae.passiveListener||!s.passiveListeners)&&{passive:!0,capture:!1};ae.touch?(r.removeEventListener(a.start,e.scrollbar.onDragStart,n),r.removeEventListener(a.move,e.scrollbar.onDragMove,n),r.removeEventListener(a.end,e.scrollbar.onDragEnd,o)):(r.removeEventListener(i.start,e.scrollbar.onDragStart,n),f.removeEventListener(i.move,e.scrollbar.onDragMove,n),f.removeEventListener(i.end,e.scrollbar.onDragEnd,o))}},init:function(){var e=this;if(e.params.scrollbar.el){var t=e.scrollbar,a=e.$el,i=e.params.scrollbar,s=I(i.el);e.params.uniqueNavElements&&"string"==typeof i.el&&1<s.length&&1===a.find(i.el).length&&(s=a.find(i.el));var r=s.find("."+e.params.scrollbar.dragClass);0===r.length&&(r=I('<div class="'+e.params.scrollbar.dragClass+'"></div>'),s.append(r)),te.extend(t,{$el:s,el:s[0],$dragEl:r,dragEl:r[0]}),i.draggable&&t.enableDraggable()}},destroy:function(){this.scrollbar.disableDraggable()}},N={setTransform:function(e,t){var a=this.rtl,i=I(e),s=a?-1:1,r=i.attr("data-swiper-parallax")||"0",n=i.attr("data-swiper-parallax-x"),o=i.attr("data-swiper-parallax-y"),l=i.attr("data-swiper-parallax-scale"),d=i.attr("data-swiper-parallax-opacity");if(n||o?(n=n||"0",o=o||"0"):this.isHorizontal()?(n=r,o="0"):(o=r,n="0"),n=0<=n.indexOf("%")?parseInt(n,10)*t*s+"%":n*t*s+"px",o=0<=o.indexOf("%")?parseInt(o,10)*t+"%":o*t+"px",null!=d){var p=d-(d-1)*(1-Math.abs(t));i[0].style.opacity=p}if(null==l)i.transform("translate3d("+n+", "+o+", 0px)");else{var c=l-(l-1)*(1-Math.abs(t));i.transform("translate3d("+n+", "+o+", 0px) scale("+c+")")}},setTranslate:function(){var i=this,e=i.$el,t=i.slides,s=i.progress,r=i.snapGrid;e.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function(e,t){i.parallax.setTransform(t,s)}),t.each(function(e,t){var a=t.progress;1<i.params.slidesPerGroup&&"auto"!==i.params.slidesPerView&&(a+=Math.ceil(e/2)-s*(r.length-1)),a=Math.min(Math.max(a,-1),1),I(t).find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function(e,t){i.parallax.setTransform(t,a)})})},setTransition:function(s){void 0===s&&(s=this.params.speed);this.$el.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y], [data-swiper-parallax-opacity], [data-swiper-parallax-scale]").each(function(e,t){var a=I(t),i=parseInt(a.attr("data-swiper-parallax-duration"),10)||s;0===s&&(i=0),a.transition(i)})}},B={getDistanceBetweenTouches:function(e){if(e.targetTouches.length<2)return 1;var t=e.targetTouches[0].pageX,a=e.targetTouches[0].pageY,i=e.targetTouches[1].pageX,s=e.targetTouches[1].pageY;return Math.sqrt(Math.pow(i-t,2)+Math.pow(s-a,2))},onGestureStart:function(e){var t=this,a=t.params.zoom,i=t.zoom,s=i.gesture;if(i.fakeGestureTouched=!1,i.fakeGestureMoved=!1,!ae.gestures){if("touchstart"!==e.type||"touchstart"===e.type&&e.targetTouches.length<2)return;i.fakeGestureTouched=!0,s.scaleStart=B.getDistanceBetweenTouches(e)}s.$slideEl&&s.$slideEl.length||(s.$slideEl=I(e.target).closest(".swiper-slide"),0===s.$slideEl.length&&(s.$slideEl=t.slides.eq(t.activeIndex)),s.$imageEl=s.$slideEl.find("img, svg, canvas"),s.$imageWrapEl=s.$imageEl.parent("."+a.containerClass),s.maxRatio=s.$imageWrapEl.attr("data-swiper-zoom")||a.maxRatio,0!==s.$imageWrapEl.length)?(s.$imageEl.transition(0),t.zoom.isScaling=!0):s.$imageEl=void 0},onGestureChange:function(e){var t=this.params.zoom,a=this.zoom,i=a.gesture;if(!ae.gestures){if("touchmove"!==e.type||"touchmove"===e.type&&e.targetTouches.length<2)return;a.fakeGestureMoved=!0,i.scaleMove=B.getDistanceBetweenTouches(e)}i.$imageEl&&0!==i.$imageEl.length&&(a.scale=ae.gestures?e.scale*a.currentScale:i.scaleMove/i.scaleStart*a.currentScale,a.scale>i.maxRatio&&(a.scale=i.maxRatio-1+Math.pow(a.scale-i.maxRatio+1,.5)),a.scale<t.minRatio&&(a.scale=t.minRatio+1-Math.pow(t.minRatio-a.scale+1,.5)),i.$imageEl.transform("translate3d(0,0,0) scale("+a.scale+")"))},onGestureEnd:function(e){var t=this.params.zoom,a=this.zoom,i=a.gesture;if(!ae.gestures){if(!a.fakeGestureTouched||!a.fakeGestureMoved)return;if("touchend"!==e.type||"touchend"===e.type&&e.changedTouches.length<2&&!g.android)return;a.fakeGestureTouched=!1,a.fakeGestureMoved=!1}i.$imageEl&&0!==i.$imageEl.length&&(a.scale=Math.max(Math.min(a.scale,i.maxRatio),t.minRatio),i.$imageEl.transition(this.params.speed).transform("translate3d(0,0,0) scale("+a.scale+")"),a.currentScale=a.scale,a.isScaling=!1,1===a.scale&&(i.$slideEl=void 0))},onTouchStart:function(e){var t=this.zoom,a=t.gesture,i=t.image;a.$imageEl&&0!==a.$imageEl.length&&(i.isTouched||(g.android&&e.preventDefault(),i.isTouched=!0,i.touchesStart.x="touchstart"===e.type?e.targetTouches[0].pageX:e.pageX,i.touchesStart.y="touchstart"===e.type?e.targetTouches[0].pageY:e.pageY))},onTouchMove:function(e){var t=this,a=t.zoom,i=a.gesture,s=a.image,r=a.velocity;if(i.$imageEl&&0!==i.$imageEl.length&&(t.allowClick=!1,s.isTouched&&i.$slideEl)){s.isMoved||(s.width=i.$imageEl[0].offsetWidth,s.height=i.$imageEl[0].offsetHeight,s.startX=te.getTranslate(i.$imageWrapEl[0],"x")||0,s.startY=te.getTranslate(i.$imageWrapEl[0],"y")||0,i.slideWidth=i.$slideEl[0].offsetWidth,i.slideHeight=i.$slideEl[0].offsetHeight,i.$imageWrapEl.transition(0),t.rtl&&(s.startX=-s.startX,s.startY=-s.startY));var n=s.width*a.scale,o=s.height*a.scale;if(!(n<i.slideWidth&&o<i.slideHeight)){if(s.minX=Math.min(i.slideWidth/2-n/2,0),s.maxX=-s.minX,s.minY=Math.min(i.slideHeight/2-o/2,0),s.maxY=-s.minY,s.touchesCurrent.x="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,s.touchesCurrent.y="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,!s.isMoved&&!a.isScaling){if(t.isHorizontal()&&(Math.floor(s.minX)===Math.floor(s.startX)&&s.touchesCurrent.x<s.touchesStart.x||Math.floor(s.maxX)===Math.floor(s.startX)&&s.touchesCurrent.x>s.touchesStart.x))return void(s.isTouched=!1);if(!t.isHorizontal()&&(Math.floor(s.minY)===Math.floor(s.startY)&&s.touchesCurrent.y<s.touchesStart.y||Math.floor(s.maxY)===Math.floor(s.startY)&&s.touchesCurrent.y>s.touchesStart.y))return void(s.isTouched=!1)}e.preventDefault(),e.stopPropagation(),s.isMoved=!0,s.currentX=s.touchesCurrent.x-s.touchesStart.x+s.startX,s.currentY=s.touchesCurrent.y-s.touchesStart.y+s.startY,s.currentX<s.minX&&(s.currentX=s.minX+1-Math.pow(s.minX-s.currentX+1,.8)),s.currentX>s.maxX&&(s.currentX=s.maxX-1+Math.pow(s.currentX-s.maxX+1,.8)),s.currentY<s.minY&&(s.currentY=s.minY+1-Math.pow(s.minY-s.currentY+1,.8)),s.currentY>s.maxY&&(s.currentY=s.maxY-1+Math.pow(s.currentY-s.maxY+1,.8)),r.prevPositionX||(r.prevPositionX=s.touchesCurrent.x),r.prevPositionY||(r.prevPositionY=s.touchesCurrent.y),r.prevTime||(r.prevTime=Date.now()),r.x=(s.touchesCurrent.x-r.prevPositionX)/(Date.now()-r.prevTime)/2,r.y=(s.touchesCurrent.y-r.prevPositionY)/(Date.now()-r.prevTime)/2,Math.abs(s.touchesCurrent.x-r.prevPositionX)<2&&(r.x=0),Math.abs(s.touchesCurrent.y-r.prevPositionY)<2&&(r.y=0),r.prevPositionX=s.touchesCurrent.x,r.prevPositionY=s.touchesCurrent.y,r.prevTime=Date.now(),i.$imageWrapEl.transform("translate3d("+s.currentX+"px, "+s.currentY+"px,0)")}}},onTouchEnd:function(){var e=this.zoom,t=e.gesture,a=e.image,i=e.velocity;if(t.$imageEl&&0!==t.$imageEl.length){if(!a.isTouched||!a.isMoved)return a.isTouched=!1,void(a.isMoved=!1);a.isTouched=!1,a.isMoved=!1;var s=300,r=300,n=i.x*s,o=a.currentX+n,l=i.y*r,d=a.currentY+l;0!==i.x&&(s=Math.abs((o-a.currentX)/i.x)),0!==i.y&&(r=Math.abs((d-a.currentY)/i.y));var p=Math.max(s,r);a.currentX=o,a.currentY=d;var c=a.width*e.scale,u=a.height*e.scale;a.minX=Math.min(t.slideWidth/2-c/2,0),a.maxX=-a.minX,a.minY=Math.min(t.slideHeight/2-u/2,0),a.maxY=-a.minY,a.currentX=Math.max(Math.min(a.currentX,a.maxX),a.minX),a.currentY=Math.max(Math.min(a.currentY,a.maxY),a.minY),t.$imageWrapEl.transition(p).transform("translate3d("+a.currentX+"px, "+a.currentY+"px,0)")}},onTransitionEnd:function(){var e=this.zoom,t=e.gesture;t.$slideEl&&this.previousIndex!==this.activeIndex&&(t.$imageEl.transform("translate3d(0,0,0) scale(1)"),t.$imageWrapEl.transform("translate3d(0,0,0)"),e.scale=1,e.currentScale=1,t.$slideEl=void 0,t.$imageEl=void 0,t.$imageWrapEl=void 0)},toggle:function(e){var t=this.zoom;t.scale&&1!==t.scale?t.out():t.in(e)},in:function(e){var t,a,i,s,r,n,o,l,d,p,c,u,h,v,f,m,g=this,b=g.zoom,w=g.params.zoom,y=b.gesture,x=b.image;y.$slideEl||(y.$slideEl=g.clickedSlide?I(g.clickedSlide):g.slides.eq(g.activeIndex),y.$imageEl=y.$slideEl.find("img, svg, canvas"),y.$imageWrapEl=y.$imageEl.parent("."+w.containerClass)),y.$imageEl&&0!==y.$imageEl.length&&(y.$slideEl.addClass(""+w.zoomedSlideClass),a=void 0===x.touchesStart.x&&e?(t="touchend"===e.type?e.changedTouches[0].pageX:e.pageX,"touchend"===e.type?e.changedTouches[0].pageY:e.pageY):(t=x.touchesStart.x,x.touchesStart.y),b.scale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,b.currentScale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,e?(f=y.$slideEl[0].offsetWidth,m=y.$slideEl[0].offsetHeight,i=y.$slideEl.offset().left+f/2-t,s=y.$slideEl.offset().top+m/2-a,o=y.$imageEl[0].offsetWidth,l=y.$imageEl[0].offsetHeight,d=o*b.scale,p=l*b.scale,h=-(c=Math.min(f/2-d/2,0)),v=-(u=Math.min(m/2-p/2,0)),(r=i*b.scale)<c&&(r=c),h<r&&(r=h),(n=s*b.scale)<u&&(n=u),v<n&&(n=v)):n=r=0,y.$imageWrapEl.transition(300).transform("translate3d("+r+"px, "+n+"px,0)"),y.$imageEl.transition(300).transform("translate3d(0,0,0) scale("+b.scale+")"))},out:function(){var e=this,t=e.zoom,a=e.params.zoom,i=t.gesture;i.$slideEl||(i.$slideEl=e.clickedSlide?I(e.clickedSlide):e.slides.eq(e.activeIndex),i.$imageEl=i.$slideEl.find("img, svg, canvas"),i.$imageWrapEl=i.$imageEl.parent("."+a.containerClass)),i.$imageEl&&0!==i.$imageEl.length&&(t.scale=1,t.currentScale=1,i.$imageWrapEl.transition(300).transform("translate3d(0,0,0)"),i.$imageEl.transition(300).transform("translate3d(0,0,0) scale(1)"),i.$slideEl.removeClass(""+a.zoomedSlideClass),i.$slideEl=void 0)},enable:function(){var e=this,t=e.zoom;if(!t.enabled){t.enabled=!0;var a=!("touchstart"!==e.touchEvents.start||!ae.passiveListener||!e.params.passiveListeners)&&{passive:!0,capture:!1};ae.gestures?(e.$wrapperEl.on("gesturestart",".swiper-slide",t.onGestureStart,a),e.$wrapperEl.on("gesturechange",".swiper-slide",t.onGestureChange,a),e.$wrapperEl.on("gestureend",".swiper-slide",t.onGestureEnd,a)):"touchstart"===e.touchEvents.start&&(e.$wrapperEl.on(e.touchEvents.start,".swiper-slide",t.onGestureStart,a),e.$wrapperEl.on(e.touchEvents.move,".swiper-slide",t.onGestureChange,a),e.$wrapperEl.on(e.touchEvents.end,".swiper-slide",t.onGestureEnd,a)),e.$wrapperEl.on(e.touchEvents.move,"."+e.params.zoom.containerClass,t.onTouchMove)}},disable:function(){var e=this,t=e.zoom;if(t.enabled){e.zoom.enabled=!1;var a=!("touchstart"!==e.touchEvents.start||!ae.passiveListener||!e.params.passiveListeners)&&{passive:!0,capture:!1};ae.gestures?(e.$wrapperEl.off("gesturestart",".swiper-slide",t.onGestureStart,a),e.$wrapperEl.off("gesturechange",".swiper-slide",t.onGestureChange,a),e.$wrapperEl.off("gestureend",".swiper-slide",t.onGestureEnd,a)):"touchstart"===e.touchEvents.start&&(e.$wrapperEl.off(e.touchEvents.start,".swiper-slide",t.onGestureStart,a),e.$wrapperEl.off(e.touchEvents.move,".swiper-slide",t.onGestureChange,a),e.$wrapperEl.off(e.touchEvents.end,".swiper-slide",t.onGestureEnd,a)),e.$wrapperEl.off(e.touchEvents.move,"."+e.params.zoom.containerClass,t.onTouchMove)}}},X={loadInSlide:function(e,l){void 0===l&&(l=!0);var d=this,p=d.params.lazy;if(void 0!==e&&0!==d.slides.length){var c=d.virtual&&d.params.virtual.enabled?d.$wrapperEl.children("."+d.params.slideClass+'[data-swiper-slide-index="'+e+'"]'):d.slides.eq(e),t=c.find("."+p.elementClass+":not(."+p.loadedClass+"):not(."+p.loadingClass+")");!c.hasClass(p.elementClass)||c.hasClass(p.loadedClass)||c.hasClass(p.loadingClass)||(t=t.add(c[0])),0!==t.length&&t.each(function(e,t){var i=I(t);i.addClass(p.loadingClass);var s=i.attr("data-background"),r=i.attr("data-src"),n=i.attr("data-srcset"),o=i.attr("data-sizes");d.loadImage(i[0],r||s,n,o,!1,function(){if(null!=d&&d&&(!d||d.params)&&!d.destroyed){if(s?(i.css("background-image",'url("'+s+'")'),i.removeAttr("data-background")):(n&&(i.attr("srcset",n),i.removeAttr("data-srcset")),o&&(i.attr("sizes",o),i.removeAttr("data-sizes")),r&&(i.attr("src",r),i.removeAttr("data-src"))),i.addClass(p.loadedClass).removeClass(p.loadingClass),c.find("."+p.preloaderClass).remove(),d.params.loop&&l){var e=c.attr("data-swiper-slide-index");if(c.hasClass(d.params.slideDuplicateClass)){var t=d.$wrapperEl.children('[data-swiper-slide-index="'+e+'"]:not(.'+d.params.slideDuplicateClass+")");d.lazy.loadInSlide(t.index(),!1)}else{var a=d.$wrapperEl.children("."+d.params.slideDuplicateClass+'[data-swiper-slide-index="'+e+'"]');d.lazy.loadInSlide(a.index(),!1)}}d.emit("lazyImageReady",c[0],i[0])}}),d.emit("lazyImageLoad",c[0],i[0])})}},load:function(){var i=this,t=i.$wrapperEl,a=i.params,s=i.slides,e=i.activeIndex,r=i.virtual&&a.virtual.enabled,n=a.lazy,o=a.slidesPerView;function l(e){if(r){if(t.children("."+a.slideClass+'[data-swiper-slide-index="'+e+'"]').length)return!0}else if(s[e])return!0;return!1}function d(e){return r?I(e).attr("data-swiper-slide-index"):I(e).index()}if("auto"===o&&(o=0),i.lazy.initialImageLoaded||(i.lazy.initialImageLoaded=!0),i.params.watchSlidesVisibility)t.children("."+a.slideVisibleClass).each(function(e,t){var a=r?I(t).attr("data-swiper-slide-index"):I(t).index();i.lazy.loadInSlide(a)});else if(1<o)for(var p=e;p<e+o;p+=1)l(p)&&i.lazy.loadInSlide(p);else i.lazy.loadInSlide(e);if(n.loadPrevNext)if(1<o||n.loadPrevNextAmount&&1<n.loadPrevNextAmount){for(var c=n.loadPrevNextAmount,u=o,h=Math.min(e+u+Math.max(c,u),s.length),v=Math.max(e-Math.max(u,c),0),f=e+o;f<h;f+=1)l(f)&&i.lazy.loadInSlide(f);for(var m=v;m<e;m+=1)l(m)&&i.lazy.loadInSlide(m)}else{var g=t.children("."+a.slideNextClass);0<g.length&&i.lazy.loadInSlide(d(g));var b=t.children("."+a.slidePrevClass);0<b.length&&i.lazy.loadInSlide(d(b))}}},V={LinearSpline:function(e,t){var a,i,s,r,n,o=function(e,t){for(i=-1,a=e.length;1<a-i;)e[s=a+i>>1]<=t?i=s:a=s;return a};return this.x=e,this.y=t,this.lastIndex=e.length-1,this.interpolate=function(e){return e?(n=o(this.x,e),r=n-1,(e-this.x[r])*(this.y[n]-this.y[r])/(this.x[n]-this.x[r])+this.y[r]):0},this},getInterpolateFunction:function(e){var t=this;t.controller.spline||(t.controller.spline=t.params.loop?new V.LinearSpline(t.slidesGrid,e.slidesGrid):new V.LinearSpline(t.snapGrid,e.snapGrid))},setTranslate:function(e,t){var a,i,s=this,r=s.controller.control;function n(e){var t=s.rtlTranslate?-s.translate:s.translate;"slide"===s.params.controller.by&&(s.controller.getInterpolateFunction(e),i=-s.controller.spline.interpolate(-t)),i&&"container"!==s.params.controller.by||(a=(e.maxTranslate()-e.minTranslate())/(s.maxTranslate()-s.minTranslate()),i=(t-s.minTranslate())*a+e.minTranslate()),s.params.controller.inverse&&(i=e.maxTranslate()-i),e.updateProgress(i),e.setTranslate(i,s),e.updateActiveIndex(),e.updateSlidesClasses()}if(Array.isArray(r))for(var o=0;o<r.length;o+=1)r[o]!==t&&r[o]instanceof T&&n(r[o]);else r instanceof T&&t!==r&&n(r)},setTransition:function(t,e){var a,i=this,s=i.controller.control;function r(e){e.setTransition(t,i),0!==t&&(e.transitionStart(),e.params.autoHeight&&te.nextTick(function(){e.updateAutoHeight()}),e.$wrapperEl.transitionEnd(function(){s&&(e.params.loop&&"slide"===i.params.controller.by&&e.loopFix(),e.transitionEnd())}))}if(Array.isArray(s))for(a=0;a<s.length;a+=1)s[a]!==e&&s[a]instanceof T&&r(s[a]);else s instanceof T&&e!==s&&r(s)}},Y={makeElFocusable:function(e){return e.attr("tabIndex","0"),e},addElRole:function(e,t){return e.attr("role",t),e},addElLabel:function(e,t){return e.attr("aria-label",t),e},disableEl:function(e){return e.attr("aria-disabled",!0),e},enableEl:function(e){return e.attr("aria-disabled",!1),e},onEnterKey:function(e){var t=this,a=t.params.a11y;if(13===e.keyCode){var i=I(e.target);t.navigation&&t.navigation.$nextEl&&i.is(t.navigation.$nextEl)&&(t.isEnd&&!t.params.loop||t.slideNext(),t.isEnd?t.a11y.notify(a.lastSlideMessage):t.a11y.notify(a.nextSlideMessage)),t.navigation&&t.navigation.$prevEl&&i.is(t.navigation.$prevEl)&&(t.isBeginning&&!t.params.loop||t.slidePrev(),t.isBeginning?t.a11y.notify(a.firstSlideMessage):t.a11y.notify(a.prevSlideMessage)),t.pagination&&i.is("."+t.params.pagination.bulletClass)&&i[0].click()}},notify:function(e){var t=this.a11y.liveRegion;0!==t.length&&(t.html(""),t.html(e))},updateNavigation:function(){var e=this;if(!e.params.loop){var t=e.navigation,a=t.$nextEl,i=t.$prevEl;i&&0<i.length&&(e.isBeginning?e.a11y.disableEl(i):e.a11y.enableEl(i)),a&&0<a.length&&(e.isEnd?e.a11y.disableEl(a):e.a11y.enableEl(a))}},updatePagination:function(){var i=this,s=i.params.a11y;i.pagination&&i.params.pagination.clickable&&i.pagination.bullets&&i.pagination.bullets.length&&i.pagination.bullets.each(function(e,t){var a=I(t);i.a11y.makeElFocusable(a),i.a11y.addElRole(a,"button"),i.a11y.addElLabel(a,s.paginationBulletMessage.replace(/{{index}}/,a.index()+1))})},init:function(){var e=this;e.$el.append(e.a11y.liveRegion);var t,a,i=e.params.a11y;e.navigation&&e.navigation.$nextEl&&(t=e.navigation.$nextEl),e.navigation&&e.navigation.$prevEl&&(a=e.navigation.$prevEl),t&&(e.a11y.makeElFocusable(t),e.a11y.addElRole(t,"button"),e.a11y.addElLabel(t,i.nextSlideMessage),t.on("keydown",e.a11y.onEnterKey)),a&&(e.a11y.makeElFocusable(a),e.a11y.addElRole(a,"button"),e.a11y.addElLabel(a,i.prevSlideMessage),a.on("keydown",e.a11y.onEnterKey)),e.pagination&&e.params.pagination.clickable&&e.pagination.bullets&&e.pagination.bullets.length&&e.pagination.$el.on("keydown","."+e.params.pagination.bulletClass,e.a11y.onEnterKey)},destroy:function(){var e,t,a=this;a.a11y.liveRegion&&0<a.a11y.liveRegion.length&&a.a11y.liveRegion.remove(),a.navigation&&a.navigation.$nextEl&&(e=a.navigation.$nextEl),a.navigation&&a.navigation.$prevEl&&(t=a.navigation.$prevEl),e&&e.off("keydown",a.a11y.onEnterKey),t&&t.off("keydown",a.a11y.onEnterKey),a.pagination&&a.params.pagination.clickable&&a.pagination.bullets&&a.pagination.bullets.length&&a.pagination.$el.off("keydown","."+a.params.pagination.bulletClass,a.a11y.onEnterKey)}},F={init:function(){var e=this;if(e.params.history){if(!ee.history||!ee.history.pushState)return e.params.history.enabled=!1,void(e.params.hashNavigation.enabled=!0);var t=e.history;t.initialized=!0,t.paths=F.getPathValues(),(t.paths.key||t.paths.value)&&(t.scrollToSlide(0,t.paths.value,e.params.runCallbacksOnInit),e.params.history.replaceState||ee.addEventListener("popstate",e.history.setHistoryPopState))}},destroy:function(){this.params.history.replaceState||ee.removeEventListener("popstate",this.history.setHistoryPopState)},setHistoryPopState:function(){this.history.paths=F.getPathValues(),this.history.scrollToSlide(this.params.speed,this.history.paths.value,!1)},getPathValues:function(){var e=ee.location.pathname.slice(1).split("/").filter(function(e){return""!==e}),t=e.length;return{key:e[t-2],value:e[t-1]}},setHistory:function(e,t){if(this.history.initialized&&this.params.history.enabled){var a=this.slides.eq(t),i=F.slugify(a.attr("data-history"));ee.location.pathname.includes(e)||(i=e+"/"+i);var s=ee.history.state;s&&s.value===i||(this.params.history.replaceState?ee.history.replaceState({value:i},null,i):ee.history.pushState({value:i},null,i))}},slugify:function(e){return e.toString().replace(/\s+/g,"-").replace(/[^\w-]+/g,"").replace(/--+/g,"-").replace(/^-+/,"").replace(/-+$/,"")},scrollToSlide:function(e,t,a){var i=this;if(t)for(var s=0,r=i.slides.length;s<r;s+=1){var n=i.slides.eq(s);if(F.slugify(n.attr("data-history"))===t&&!n.hasClass(i.params.slideDuplicateClass)){var o=n.index();i.slideTo(o,e,a)}}else i.slideTo(0,e,a)}},R={onHashCange:function(){var e=this,t=f.location.hash.replace("#","");if(t!==e.slides.eq(e.activeIndex).attr("data-hash")){var a=e.$wrapperEl.children("."+e.params.slideClass+'[data-hash="'+t+'"]').index();if(void 0===a)return;e.slideTo(a)}},setHash:function(){var e=this;if(e.hashNavigation.initialized&&e.params.hashNavigation.enabled)if(e.params.hashNavigation.replaceState&&ee.history&&ee.history.replaceState)ee.history.replaceState(null,null,"#"+e.slides.eq(e.activeIndex).attr("data-hash")||"");else{var t=e.slides.eq(e.activeIndex),a=t.attr("data-hash")||t.attr("data-history");f.location.hash=a||""}},init:function(){var e=this;if(!(!e.params.hashNavigation.enabled||e.params.history&&e.params.history.enabled)){e.hashNavigation.initialized=!0;var t=f.location.hash.replace("#","");if(t)for(var a=0,i=e.slides.length;a<i;a+=1){var s=e.slides.eq(a);if((s.attr("data-hash")||s.attr("data-history"))===t&&!s.hasClass(e.params.slideDuplicateClass)){var r=s.index();e.slideTo(r,0,e.params.runCallbacksOnInit,!0)}}e.params.hashNavigation.watchState&&I(ee).on("hashchange",e.hashNavigation.onHashCange)}},destroy:function(){this.params.hashNavigation.watchState&&I(ee).off("hashchange",this.hashNavigation.onHashCange)}},q={run:function(){var e=this,t=e.slides.eq(e.activeIndex),a=e.params.autoplay.delay;t.attr("data-swiper-autoplay")&&(a=t.attr("data-swiper-autoplay")||e.params.autoplay.delay),clearTimeout(e.autoplay.timeout),e.autoplay.timeout=te.nextTick(function(){e.params.autoplay.reverseDirection?e.params.loop?(e.loopFix(),e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.isBeginning?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(e.slides.length-1,e.params.speed,!0,!0),e.emit("autoplay")):(e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.params.loop?(e.loopFix(),e.slideNext(e.params.speed,!0,!0),e.emit("autoplay")):e.isEnd?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(0,e.params.speed,!0,!0),e.emit("autoplay")):(e.slideNext(e.params.speed,!0,!0),e.emit("autoplay"))},a)},start:function(){var e=this;return void 0===e.autoplay.timeout&&(!e.autoplay.running&&(e.autoplay.running=!0,e.emit("autoplayStart"),e.autoplay.run(),!0))},stop:function(){var e=this;return!!e.autoplay.running&&(void 0!==e.autoplay.timeout&&(e.autoplay.timeout&&(clearTimeout(e.autoplay.timeout),e.autoplay.timeout=void 0),e.autoplay.running=!1,e.emit("autoplayStop"),!0))},pause:function(e){var t=this;t.autoplay.running&&(t.autoplay.paused||(t.autoplay.timeout&&clearTimeout(t.autoplay.timeout),t.autoplay.paused=!0,0!==e&&t.params.autoplay.waitForTransition?(t.$wrapperEl[0].addEventListener("transitionend",t.autoplay.onTransitionEnd),t.$wrapperEl[0].addEventListener("webkitTransitionEnd",t.autoplay.onTransitionEnd)):(t.autoplay.paused=!1,t.autoplay.run())))}},W={setTranslate:function(){for(var e=this,t=e.slides,a=0;a<t.length;a+=1){var i=e.slides.eq(a),s=-i[0].swiperSlideOffset;e.params.virtualTranslate||(s-=e.translate);var r=0;e.isHorizontal()||(r=s,s=0);var n=e.params.fadeEffect.crossFade?Math.max(1-Math.abs(i[0].progress),0):1+Math.min(Math.max(i[0].progress,-1),0);i.css({opacity:n}).transform("translate3d("+s+"px, "+r+"px, 0px)")}},setTransition:function(e){var a=this,t=a.slides,i=a.$wrapperEl;if(t.transition(e),a.params.virtualTranslate&&0!==e){var s=!1;t.transitionEnd(function(){if(!s&&a&&!a.destroyed){s=!0,a.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],t=0;t<e.length;t+=1)i.trigger(e[t])}})}}},j={setTranslate:function(){var e,t=this,a=t.$el,i=t.$wrapperEl,s=t.slides,r=t.width,n=t.height,o=t.rtlTranslate,l=t.size,d=t.params.cubeEffect,p=t.isHorizontal(),c=t.virtual&&t.params.virtual.enabled,u=0;d.shadow&&(p?(0===(e=i.find(".swiper-cube-shadow")).length&&(e=I('<div class="swiper-cube-shadow"></div>'),i.append(e)),e.css({height:r+"px"})):0===(e=a.find(".swiper-cube-shadow")).length&&(e=I('<div class="swiper-cube-shadow"></div>'),a.append(e)));for(var h=0;h<s.length;h+=1){var v=s.eq(h),f=h;c&&(f=parseInt(v.attr("data-swiper-slide-index"),10));var m=90*f,g=Math.floor(m/360);o&&(m=-m,g=Math.floor(-m/360));var b=Math.max(Math.min(v[0].progress,1),-1),w=0,y=0,x=0;f%4==0?(w=4*-g*l,x=0):(f-1)%4==0?(w=0,x=4*-g*l):(f-2)%4==0?(w=l+4*g*l,x=l):(f-3)%4==0&&(w=-l,x=3*l+4*l*g),o&&(w=-w),p||(y=w,w=0);var T="rotateX("+(p?0:-m)+"deg) rotateY("+(p?m:0)+"deg) translate3d("+w+"px, "+y+"px, "+x+"px)";if(b<=1&&-1<b&&(u=90*f+90*b,o&&(u=90*-f-90*b)),v.transform(T),d.slideShadows){var E=p?v.find(".swiper-slide-shadow-left"):v.find(".swiper-slide-shadow-top"),S=p?v.find(".swiper-slide-shadow-right"):v.find(".swiper-slide-shadow-bottom");0===E.length&&(E=I('<div class="swiper-slide-shadow-'+(p?"left":"top")+'"></div>'),v.append(E)),0===S.length&&(S=I('<div class="swiper-slide-shadow-'+(p?"right":"bottom")+'"></div>'),v.append(S)),E.length&&(E[0].style.opacity=Math.max(-b,0)),S.length&&(S[0].style.opacity=Math.max(b,0))}}if(i.css({"-webkit-transform-origin":"50% 50% -"+l/2+"px","-moz-transform-origin":"50% 50% -"+l/2+"px","-ms-transform-origin":"50% 50% -"+l/2+"px","transform-origin":"50% 50% -"+l/2+"px"}),d.shadow)if(p)e.transform("translate3d(0px, "+(r/2+d.shadowOffset)+"px, "+-r/2+"px) rotateX(90deg) rotateZ(0deg) scale("+d.shadowScale+")");else{var C=Math.abs(u)-90*Math.floor(Math.abs(u)/90),M=1.5-(Math.sin(2*C*Math.PI/360)/2+Math.cos(2*C*Math.PI/360)/2),P=d.shadowScale,k=d.shadowScale/M,z=d.shadowOffset;e.transform("scale3d("+P+", 1, "+k+") translate3d(0px, "+(n/2+z)+"px, "+-n/2/k+"px) rotateX(-90deg)")}var $=ie.isSafari||ie.isUiWebView?-l/2:0;i.transform("translate3d(0px,0,"+$+"px) rotateX("+(t.isHorizontal()?0:u)+"deg) rotateY("+(t.isHorizontal()?-u:0)+"deg)")},setTransition:function(e){var t=this.$el;this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),this.params.cubeEffect.shadow&&!this.isHorizontal()&&t.find(".swiper-cube-shadow").transition(e)}},U={setTranslate:function(){for(var e=this,t=e.slides,a=e.rtlTranslate,i=0;i<t.length;i+=1){var s=t.eq(i),r=s[0].progress;e.params.flipEffect.limitRotation&&(r=Math.max(Math.min(s[0].progress,1),-1));var n=-180*r,o=0,l=-s[0].swiperSlideOffset,d=0;if(e.isHorizontal()?a&&(n=-n):(d=l,o=-n,n=l=0),s[0].style.zIndex=-Math.abs(Math.round(r))+t.length,e.params.flipEffect.slideShadows){var p=e.isHorizontal()?s.find(".swiper-slide-shadow-left"):s.find(".swiper-slide-shadow-top"),c=e.isHorizontal()?s.find(".swiper-slide-shadow-right"):s.find(".swiper-slide-shadow-bottom");0===p.length&&(p=I('<div class="swiper-slide-shadow-'+(e.isHorizontal()?"left":"top")+'"></div>'),s.append(p)),0===c.length&&(c=I('<div class="swiper-slide-shadow-'+(e.isHorizontal()?"right":"bottom")+'"></div>'),s.append(c)),p.length&&(p[0].style.opacity=Math.max(-r,0)),c.length&&(c[0].style.opacity=Math.max(r,0))}s.transform("translate3d("+l+"px, "+d+"px, 0px) rotateX("+o+"deg) rotateY("+n+"deg)")}},setTransition:function(e){var a=this,t=a.slides,i=a.activeIndex,s=a.$wrapperEl;if(t.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),a.params.virtualTranslate&&0!==e){var r=!1;t.eq(i).transitionEnd(function(){if(!r&&a&&!a.destroyed){r=!0,a.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],t=0;t<e.length;t+=1)s.trigger(e[t])}})}}},K={setTranslate:function(){for(var e=this,t=e.width,a=e.height,i=e.slides,s=e.$wrapperEl,r=e.slidesSizesGrid,n=e.params.coverflowEffect,o=e.isHorizontal(),l=e.translate,d=o?t/2-l:a/2-l,p=o?n.rotate:-n.rotate,c=n.depth,u=0,h=i.length;u<h;u+=1){var v=i.eq(u),f=r[u],m=(d-v[0].swiperSlideOffset-f/2)/f*n.modifier,g=o?p*m:0,b=o?0:p*m,w=-c*Math.abs(m),y=o?0:n.stretch*m,x=o?n.stretch*m:0;Math.abs(x)<.001&&(x=0),Math.abs(y)<.001&&(y=0),Math.abs(w)<.001&&(w=0),Math.abs(g)<.001&&(g=0),Math.abs(b)<.001&&(b=0);var T="translate3d("+x+"px,"+y+"px,"+w+"px)  rotateX("+b+"deg) rotateY("+g+"deg)";if(v.transform(T),v[0].style.zIndex=1-Math.abs(Math.round(m)),n.slideShadows){var E=o?v.find(".swiper-slide-shadow-left"):v.find(".swiper-slide-shadow-top"),S=o?v.find(".swiper-slide-shadow-right"):v.find(".swiper-slide-shadow-bottom");0===E.length&&(E=I('<div class="swiper-slide-shadow-'+(o?"left":"top")+'"></div>'),v.append(E)),0===S.length&&(S=I('<div class="swiper-slide-shadow-'+(o?"right":"bottom")+'"></div>'),v.append(S)),E.length&&(E[0].style.opacity=0<m?m:0),S.length&&(S[0].style.opacity=0<-m?-m:0)}}(ae.pointerEvents||ae.prefixedPointerEvents)&&(s[0].style.perspectiveOrigin=d+"px 50%")},setTransition:function(e){this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)}},_={init:function(){var e=this,t=e.params.thumbs,a=e.constructor;t.swiper instanceof a?(e.thumbs.swiper=t.swiper,te.extend(e.thumbs.swiper.originalParams,{watchSlidesProgress:!0,slideToClickedSlide:!1}),te.extend(e.thumbs.swiper.params,{watchSlidesProgress:!0,slideToClickedSlide:!1})):te.isObject(t.swiper)&&(e.thumbs.swiper=new a(te.extend({},t.swiper,{watchSlidesVisibility:!0,watchSlidesProgress:!0,slideToClickedSlide:!1})),e.thumbs.swiperCreated=!0),e.thumbs.swiper.$el.addClass(e.params.thumbs.thumbsContainerClass),e.thumbs.swiper.on("tap",e.thumbs.onThumbClick)},onThumbClick:function(){var e=this,t=e.thumbs.swiper;if(t){var a=t.clickedIndex,i=t.clickedSlide;if(!(i&&I(i).hasClass(e.params.thumbs.slideThumbActiveClass)||null==a)){var s;if(s=t.params.loop?parseInt(I(t.clickedSlide).attr("data-swiper-slide-index"),10):a,e.params.loop){var r=e.activeIndex;e.slides.eq(r).hasClass(e.params.slideDuplicateClass)&&(e.loopFix(),e._clientLeft=e.$wrapperEl[0].clientLeft,r=e.activeIndex);var n=e.slides.eq(r).prevAll('[data-swiper-slide-index="'+s+'"]').eq(0).index(),o=e.slides.eq(r).nextAll('[data-swiper-slide-index="'+s+'"]').eq(0).index();s=void 0===n?o:void 0===o?n:o-r<r-n?o:n}e.slideTo(s)}}},update:function(e){var t=this,a=t.thumbs.swiper;if(a){var i="auto"===a.params.slidesPerView?a.slidesPerViewDynamic():a.params.slidesPerView;if(t.realIndex!==a.realIndex){var s,r=a.activeIndex;if(a.params.loop){a.slides.eq(r).hasClass(a.params.slideDuplicateClass)&&(a.loopFix(),a._clientLeft=a.$wrapperEl[0].clientLeft,r=a.activeIndex);var n=a.slides.eq(r).prevAll('[data-swiper-slide-index="'+t.realIndex+'"]').eq(0).index(),o=a.slides.eq(r).nextAll('[data-swiper-slide-index="'+t.realIndex+'"]').eq(0).index();s=void 0===n?o:void 0===o?n:o-r==r-n?r:o-r<r-n?o:n}else s=t.realIndex;a.visibleSlidesIndexes&&a.visibleSlidesIndexes.indexOf(s)<0&&(a.params.centeredSlides?s=r<s?s-Math.floor(i/2)+1:s+Math.floor(i/2)-1:r<s&&(s=s-i+1),a.slideTo(s,e?0:void 0))}var l=1,d=t.params.thumbs.slideThumbActiveClass;if(1<t.params.slidesPerView&&!t.params.centeredSlides&&(l=t.params.slidesPerView),a.slides.removeClass(d),a.params.loop||a.params.virtual)for(var p=0;p<l;p+=1)a.$wrapperEl.children('[data-swiper-slide-index="'+(t.realIndex+p)+'"]').addClass(d);else for(var c=0;c<l;c+=1)a.slides.eq(t.realIndex+c).addClass(d)}}},Z=[E,S,C,M,k,$,D,{name:"mousewheel",params:{mousewheel:{enabled:!1,releaseOnEdges:!1,invert:!1,forceToAxis:!1,sensitivity:1,eventsTarged:"container"}},create:function(){var e=this;te.extend(e,{mousewheel:{enabled:!1,enable:O.enable.bind(e),disable:O.disable.bind(e),handle:O.handle.bind(e),handleMouseEnter:O.handleMouseEnter.bind(e),handleMouseLeave:O.handleMouseLeave.bind(e),lastScrollTime:te.now()}})},on:{init:function(){this.params.mousewheel.enabled&&this.mousewheel.enable()},destroy:function(){this.mousewheel.enabled&&this.mousewheel.disable()}}},{name:"navigation",params:{navigation:{nextEl:null,prevEl:null,hideOnClick:!1,disabledClass:"swiper-button-disabled",hiddenClass:"swiper-button-hidden",lockClass:"swiper-button-lock"}},create:function(){var e=this;te.extend(e,{navigation:{init:A.init.bind(e),update:A.update.bind(e),destroy:A.destroy.bind(e),onNextClick:A.onNextClick.bind(e),onPrevClick:A.onPrevClick.bind(e)}})},on:{init:function(){this.navigation.init(),this.navigation.update()},toEdge:function(){this.navigation.update()},fromEdge:function(){this.navigation.update()},destroy:function(){this.navigation.destroy()},click:function(e){var t,a=this,i=a.navigation,s=i.$nextEl,r=i.$prevEl;!a.params.navigation.hideOnClick||I(e.target).is(r)||I(e.target).is(s)||(s?t=s.hasClass(a.params.navigation.hiddenClass):r&&(t=r.hasClass(a.params.navigation.hiddenClass)),!0===t?a.emit("navigationShow",a):a.emit("navigationHide",a),s&&s.toggleClass(a.params.navigation.hiddenClass),r&&r.toggleClass(a.params.navigation.hiddenClass))}}},{name:"pagination",params:{pagination:{el:null,bulletElement:"span",clickable:!1,hideOnClick:!1,renderBullet:null,renderProgressbar:null,renderFraction:null,renderCustom:null,progressbarOpposite:!1,type:"bullets",dynamicBullets:!1,dynamicMainBullets:1,formatFractionCurrent:function(e){return e},formatFractionTotal:function(e){return e},bulletClass:"swiper-pagination-bullet",bulletActiveClass:"swiper-pagination-bullet-active",modifierClass:"swiper-pagination-",currentClass:"swiper-pagination-current",totalClass:"swiper-pagination-total",hiddenClass:"swiper-pagination-hidden",progressbarFillClass:"swiper-pagination-progressbar-fill",progressbarOppositeClass:"swiper-pagination-progressbar-opposite",clickableClass:"swiper-pagination-clickable",lockClass:"swiper-pagination-lock"}},create:function(){var e=this;te.extend(e,{pagination:{init:H.init.bind(e),render:H.render.bind(e),update:H.update.bind(e),destroy:H.destroy.bind(e),dynamicBulletIndex:0}})},on:{init:function(){this.pagination.init(),this.pagination.render(),this.pagination.update()},activeIndexChange:function(){this.params.loop?this.pagination.update():void 0===this.snapIndex&&this.pagination.update()},snapIndexChange:function(){this.params.loop||this.pagination.update()},slidesLengthChange:function(){this.params.loop&&(this.pagination.render(),this.pagination.update())},snapGridLengthChange:function(){this.params.loop||(this.pagination.render(),this.pagination.update())},destroy:function(){this.pagination.destroy()},click:function(e){var t=this;t.params.pagination.el&&t.params.pagination.hideOnClick&&0<t.pagination.$el.length&&!I(e.target).hasClass(t.params.pagination.bulletClass)&&(!0===t.pagination.$el.hasClass(t.params.pagination.hiddenClass)?t.emit("paginationShow",t):t.emit("paginationHide",t),t.pagination.$el.toggleClass(t.params.pagination.hiddenClass))}}},{name:"scrollbar",params:{scrollbar:{el:null,dragSize:"auto",hide:!1,draggable:!1,snapOnRelease:!0,lockClass:"swiper-scrollbar-lock",dragClass:"swiper-scrollbar-drag"}},create:function(){var e=this;te.extend(e,{scrollbar:{init:G.init.bind(e),destroy:G.destroy.bind(e),updateSize:G.updateSize.bind(e),setTranslate:G.setTranslate.bind(e),setTransition:G.setTransition.bind(e),enableDraggable:G.enableDraggable.bind(e),disableDraggable:G.disableDraggable.bind(e),setDragPosition:G.setDragPosition.bind(e),getPointerPosition:G.getPointerPosition.bind(e),onDragStart:G.onDragStart.bind(e),onDragMove:G.onDragMove.bind(e),onDragEnd:G.onDragEnd.bind(e),isTouched:!1,timeout:null,dragTimeout:null}})},on:{init:function(){this.scrollbar.init(),this.scrollbar.updateSize(),this.scrollbar.setTranslate()},update:function(){this.scrollbar.updateSize()},resize:function(){this.scrollbar.updateSize()},observerUpdate:function(){this.scrollbar.updateSize()},setTranslate:function(){this.scrollbar.setTranslate()},setTransition:function(e){this.scrollbar.setTransition(e)},destroy:function(){this.scrollbar.destroy()}}},{name:"parallax",params:{parallax:{enabled:!1}},create:function(){te.extend(this,{parallax:{setTransform:N.setTransform.bind(this),setTranslate:N.setTranslate.bind(this),setTransition:N.setTransition.bind(this)}})},on:{beforeInit:function(){this.params.parallax.enabled&&(this.params.watchSlidesProgress=!0,this.originalParams.watchSlidesProgress=!0)},init:function(){this.params.parallax.enabled&&this.parallax.setTranslate()},setTranslate:function(){this.params.parallax.enabled&&this.parallax.setTranslate()},setTransition:function(e){this.params.parallax.enabled&&this.parallax.setTransition(e)}}},{name:"zoom",params:{zoom:{enabled:!1,maxRatio:3,minRatio:1,toggle:!0,containerClass:"swiper-zoom-container",zoomedSlideClass:"swiper-slide-zoomed"}},create:function(){var i=this,t={enabled:!1,scale:1,currentScale:1,isScaling:!1,gesture:{$slideEl:void 0,slideWidth:void 0,slideHeight:void 0,$imageEl:void 0,$imageWrapEl:void 0,maxRatio:3},image:{isTouched:void 0,isMoved:void 0,currentX:void 0,currentY:void 0,minX:void 0,minY:void 0,maxX:void 0,maxY:void 0,width:void 0,height:void 0,startX:void 0,startY:void 0,touchesStart:{},touchesCurrent:{}},velocity:{x:void 0,y:void 0,prevPositionX:void 0,prevPositionY:void 0,prevTime:void 0}};"onGestureStart onGestureChange onGestureEnd onTouchStart onTouchMove onTouchEnd onTransitionEnd toggle enable disable in out".split(" ").forEach(function(e){t[e]=B[e].bind(i)}),te.extend(i,{zoom:t});var s=1;Object.defineProperty(i.zoom,"scale",{get:function(){return s},set:function(e){if(s!==e){var t=i.zoom.gesture.$imageEl?i.zoom.gesture.$imageEl[0]:void 0,a=i.zoom.gesture.$slideEl?i.zoom.gesture.$slideEl[0]:void 0;i.emit("zoomChange",e,t,a)}s=e}})},on:{init:function(){this.params.zoom.enabled&&this.zoom.enable()},destroy:function(){this.zoom.disable()},touchStart:function(e){this.zoom.enabled&&this.zoom.onTouchStart(e)},touchEnd:function(e){this.zoom.enabled&&this.zoom.onTouchEnd(e)},doubleTap:function(e){this.params.zoom.enabled&&this.zoom.enabled&&this.params.zoom.toggle&&this.zoom.toggle(e)},transitionEnd:function(){this.zoom.enabled&&this.params.zoom.enabled&&this.zoom.onTransitionEnd()}}},{name:"lazy",params:{lazy:{enabled:!1,loadPrevNext:!1,loadPrevNextAmount:1,loadOnTransitionStart:!1,elementClass:"swiper-lazy",loadingClass:"swiper-lazy-loading",loadedClass:"swiper-lazy-loaded",preloaderClass:"swiper-lazy-preloader"}},create:function(){te.extend(this,{lazy:{initialImageLoaded:!1,load:X.load.bind(this),loadInSlide:X.loadInSlide.bind(this)}})},on:{beforeInit:function(){this.params.lazy.enabled&&this.params.preloadImages&&(this.params.preloadImages=!1)},init:function(){this.params.lazy.enabled&&!this.params.loop&&0===this.params.initialSlide&&this.lazy.load()},scroll:function(){this.params.freeMode&&!this.params.freeModeSticky&&this.lazy.load()},resize:function(){this.params.lazy.enabled&&this.lazy.load()},scrollbarDragMove:function(){this.params.lazy.enabled&&this.lazy.load()},transitionStart:function(){var e=this;e.params.lazy.enabled&&(!e.params.lazy.loadOnTransitionStart&&(e.params.lazy.loadOnTransitionStart||e.lazy.initialImageLoaded)||e.lazy.load())},transitionEnd:function(){this.params.lazy.enabled&&!this.params.lazy.loadOnTransitionStart&&this.lazy.load()}}},{name:"controller",params:{controller:{control:void 0,inverse:!1,by:"slide"}},create:function(){var e=this;te.extend(e,{controller:{control:e.params.controller.control,getInterpolateFunction:V.getInterpolateFunction.bind(e),setTranslate:V.setTranslate.bind(e),setTransition:V.setTransition.bind(e)}})},on:{update:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},resize:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},observerUpdate:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},setTranslate:function(e,t){this.controller.control&&this.controller.setTranslate(e,t)},setTransition:function(e,t){this.controller.control&&this.controller.setTransition(e,t)}}},{name:"a11y",params:{a11y:{enabled:!0,notificationClass:"swiper-notification",prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",paginationBulletMessage:"Go to slide {{index}}"}},create:function(){var t=this;te.extend(t,{a11y:{liveRegion:I('<span class="'+t.params.a11y.notificationClass+'" aria-live="assertive" aria-atomic="true"></span>')}}),Object.keys(Y).forEach(function(e){t.a11y[e]=Y[e].bind(t)})},on:{init:function(){this.params.a11y.enabled&&(this.a11y.init(),this.a11y.updateNavigation())},toEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},fromEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},paginationUpdate:function(){this.params.a11y.enabled&&this.a11y.updatePagination()},destroy:function(){this.params.a11y.enabled&&this.a11y.destroy()}}},{name:"history",params:{history:{enabled:!1,replaceState:!1,key:"slides"}},create:function(){var e=this;te.extend(e,{history:{init:F.init.bind(e),setHistory:F.setHistory.bind(e),setHistoryPopState:F.setHistoryPopState.bind(e),scrollToSlide:F.scrollToSlide.bind(e),destroy:F.destroy.bind(e)}})},on:{init:function(){this.params.history.enabled&&this.history.init()},destroy:function(){this.params.history.enabled&&this.history.destroy()},transitionEnd:function(){this.history.initialized&&this.history.setHistory(this.params.history.key,this.activeIndex)}}},{name:"hash-navigation",params:{hashNavigation:{enabled:!1,replaceState:!1,watchState:!1}},create:function(){var e=this;te.extend(e,{hashNavigation:{initialized:!1,init:R.init.bind(e),destroy:R.destroy.bind(e),setHash:R.setHash.bind(e),onHashCange:R.onHashCange.bind(e)}})},on:{init:function(){this.params.hashNavigation.enabled&&this.hashNavigation.init()},destroy:function(){this.params.hashNavigation.enabled&&this.hashNavigation.destroy()},transitionEnd:function(){this.hashNavigation.initialized&&this.hashNavigation.setHash()}}},{name:"autoplay",params:{autoplay:{enabled:!1,delay:3e3,waitForTransition:!0,disableOnInteraction:!0,stopOnLastSlide:!1,reverseDirection:!1}},create:function(){var t=this;te.extend(t,{autoplay:{running:!1,paused:!1,run:q.run.bind(t),start:q.start.bind(t),stop:q.stop.bind(t),pause:q.pause.bind(t),onTransitionEnd:function(e){t&&!t.destroyed&&t.$wrapperEl&&e.target===this&&(t.$wrapperEl[0].removeEventListener("transitionend",t.autoplay.onTransitionEnd),t.$wrapperEl[0].removeEventListener("webkitTransitionEnd",t.autoplay.onTransitionEnd),t.autoplay.paused=!1,t.autoplay.running?t.autoplay.run():t.autoplay.stop())}}})},on:{init:function(){this.params.autoplay.enabled&&this.autoplay.start()},beforeTransitionStart:function(e,t){this.autoplay.running&&(t||!this.params.autoplay.disableOnInteraction?this.autoplay.pause(e):this.autoplay.stop())},sliderFirstMove:function(){this.autoplay.running&&(this.params.autoplay.disableOnInteraction?this.autoplay.stop():this.autoplay.pause())},destroy:function(){this.autoplay.running&&this.autoplay.stop()}}},{name:"effect-fade",params:{fadeEffect:{crossFade:!1}},create:function(){te.extend(this,{fadeEffect:{setTranslate:W.setTranslate.bind(this),setTransition:W.setTransition.bind(this)}})},on:{beforeInit:function(){var e=this;if("fade"===e.params.effect){e.classNames.push(e.params.containerModifierClass+"fade");var t={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};te.extend(e.params,t),te.extend(e.originalParams,t)}},setTranslate:function(){"fade"===this.params.effect&&this.fadeEffect.setTranslate()},setTransition:function(e){"fade"===this.params.effect&&this.fadeEffect.setTransition(e)}}},{name:"effect-cube",params:{cubeEffect:{slideShadows:!0,shadow:!0,shadowOffset:20,shadowScale:.94}},create:function(){te.extend(this,{cubeEffect:{setTranslate:j.setTranslate.bind(this),setTransition:j.setTransition.bind(this)}})},on:{beforeInit:function(){var e=this;if("cube"===e.params.effect){e.classNames.push(e.params.containerModifierClass+"cube"),e.classNames.push(e.params.containerModifierClass+"3d");var t={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,resistanceRatio:0,spaceBetween:0,centeredSlides:!1,virtualTranslate:!0};te.extend(e.params,t),te.extend(e.originalParams,t)}},setTranslate:function(){"cube"===this.params.effect&&this.cubeEffect.setTranslate()},setTransition:function(e){"cube"===this.params.effect&&this.cubeEffect.setTransition(e)}}},{name:"effect-flip",params:{flipEffect:{slideShadows:!0,limitRotation:!0}},create:function(){te.extend(this,{flipEffect:{setTranslate:U.setTranslate.bind(this),setTransition:U.setTransition.bind(this)}})},on:{beforeInit:function(){var e=this;if("flip"===e.params.effect){e.classNames.push(e.params.containerModifierClass+"flip"),e.classNames.push(e.params.containerModifierClass+"3d");var t={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};te.extend(e.params,t),te.extend(e.originalParams,t)}},setTranslate:function(){"flip"===this.params.effect&&this.flipEffect.setTranslate()},setTransition:function(e){"flip"===this.params.effect&&this.flipEffect.setTransition(e)}}},{name:"effect-coverflow",params:{coverflowEffect:{rotate:50,stretch:0,depth:100,modifier:1,slideShadows:!0}},create:function(){te.extend(this,{coverflowEffect:{setTranslate:K.setTranslate.bind(this),setTransition:K.setTransition.bind(this)}})},on:{beforeInit:function(){var e=this;"coverflow"===e.params.effect&&(e.classNames.push(e.params.containerModifierClass+"coverflow"),e.classNames.push(e.params.containerModifierClass+"3d"),e.params.watchSlidesProgress=!0,e.originalParams.watchSlidesProgress=!0)},setTranslate:function(){"coverflow"===this.params.effect&&this.coverflowEffect.setTranslate()},setTransition:function(e){"coverflow"===this.params.effect&&this.coverflowEffect.setTransition(e)}}},{name:"thumbs",params:{thumbs:{swiper:null,slideThumbActiveClass:"swiper-slide-thumb-active",thumbsContainerClass:"swiper-container-thumbs"}},create:function(){te.extend(this,{thumbs:{swiper:null,init:_.init.bind(this),update:_.update.bind(this),onThumbClick:_.onThumbClick.bind(this)}})},on:{beforeInit:function(){var e=this.params.thumbs;e&&e.swiper&&(this.thumbs.init(),this.thumbs.update(!0))},slideChange:function(){this.thumbs.swiper&&this.thumbs.update()},update:function(){this.thumbs.swiper&&this.thumbs.update()},resize:function(){this.thumbs.swiper&&this.thumbs.update()},observerUpdate:function(){this.thumbs.swiper&&this.thumbs.update()},setTransition:function(e){var t=this.thumbs.swiper;t&&t.setTransition(e)},beforeDestroy:function(){var e=this.thumbs.swiper;e&&this.thumbs.swiperCreated&&e&&e.destroy()}}}];return void 0===T.use&&(T.use=T.Class.use,T.installModule=T.Class.installModule),T.use(Z),T});
//# sourceMappingURL=swiper.min.js.map

/**
 * Created by Sigma on 12/04/2017.
 */
//sortable itinerary
$(function () {
    $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'well placeholder',
        forceHelperSize: true
    });
});

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 3,
            nav: false,
            loop: false,
            margin: 20
        }
    }
})
/* ===================================================
 *  jquery-sortable.js v0.9.13
 *  http://johnny.github.com/jquery-sortable/
 * ===================================================
 *  Copyright (c) 2012 Jonas von Andrian
 *  All rights reserved.
 *
 *  Redistribution and use in source and binary forms, with or without
 *  modification, are permitted provided that the following conditions are met:
 *  * Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  * Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *  * The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 *  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 *  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 *  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 *  DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
 *  DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 *  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 *  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 *  ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 *  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 *  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * ========================================================== */

!function ( $, window, pluginName, undefined){
  var containerDefaults = {
    // If true, items can be dragged from this container
    drag: true,
    // If true, items can be droped onto this container
    drop: true,
    // Exclude items from being draggable, if the
    // selector matches the item
    exclude: "",
    // If true, search for nested containers within an item.If you nest containers,
    // either the original selector with which you call the plugin must only match the top containers,
    // or you need to specify a group (see the bootstrap nav example)
    nested: true,
    // If true, the items are assumed to be arranged vertically
    vertical: true
  }, // end container defaults
  groupDefaults = {
    // This is executed after the placeholder has been moved.
    // $closestItemOrContainer contains the closest item, the placeholder
    // has been put at or the closest empty Container, the placeholder has
    // been appended to.
    afterMove: function ($placeholder, container, $closestItemOrContainer) {
    },
    // The exact css path between the container and its items, e.g. "> tbody"
    containerPath: "",
    // The css selector of the containers
    containerSelector: "ol, ul",
    // Distance the mouse has to travel to start dragging
    distance: 0,
    // Time in milliseconds after mousedown until dragging should start.
    // This option can be used to prevent unwanted drags when clicking on an element.
    delay: 0,
    // The css selector of the drag handle
    handle: "",
    // The exact css path between the item and its subcontainers.
    // It should only match the immediate items of a container.
    // No item of a subcontainer should be matched. E.g. for ol>div>li the itemPath is "> div"
    itemPath: "",
    // The css selector of the items
    itemSelector: "li",
    // The class given to "body" while an item is being dragged
    bodyClass: "dragging",
    // The class giving to an item while being dragged
    draggedClass: "dragged",
    // Check if the dragged item may be inside the container.
    // Use with care, since the search for a valid container entails a depth first search
    // and may be quite expensive.
    isValidTarget: function ($item, container) {
      return true
    },
    // Executed before onDrop if placeholder is detached.
    // This happens if pullPlaceholder is set to false and the drop occurs outside a container.
    onCancel: function ($item, container, _super, event) {
    },
    // Executed at the beginning of a mouse move event.
    // The Placeholder has not been moved yet.
    onDrag: function ($item, position, _super, event) {
      $item.css(position)
    },
    // Called after the drag has been started,
    // that is the mouse button is being held down and
    // the mouse is moving.
    // The container is the closest initialized container.
    // Therefore it might not be the container, that actually contains the item.
    onDragStart: function ($item, container, _super, event) {
      $item.css({
        height: $item.outerHeight(),
        width: $item.outerWidth()
      })
      $item.addClass(container.group.options.draggedClass)
      $("body").addClass(container.group.options.bodyClass)
    },
    // Called when the mouse button is being released
    onDrop: function ($item, container, _super, event) {
      $item.removeClass(container.group.options.draggedClass).removeAttr("style")
      $("body").removeClass(container.group.options.bodyClass)
    },
    // Called on mousedown. If falsy value is returned, the dragging will not start.
    // Ignore if element clicked is input, select or textarea
    onMousedown: function ($item, _super, event) {
      if (!event.target.nodeName.match(/^(input|select|textarea)$/i)) {
        event.preventDefault()
        return true
      }
    },
    // The class of the placeholder (must match placeholder option markup)
    placeholderClass: "placeholder",
    // Template for the placeholder. Can be any valid jQuery input
    // e.g. a string, a DOM element.
    // The placeholder must have the class "placeholder"
    placeholder: '<li class="placeholder"></li>',
    // If true, the position of the placeholder is calculated on every mousemove.
    // If false, it is only calculated when the mouse is above a container.
    pullPlaceholder: true,
    // Specifies serialization of the container group.
    // The pair $parent/$children is either container/items or item/subcontainers.
    serialize: function ($parent, $children, parentIsContainer) {
      var result = $.extend({}, $parent.data())

      if(parentIsContainer)
        return [$children]
      else if ($children[0]){
        result.children = $children
      }

      delete result.subContainers
      delete result.sortable

      return result
    },
    // Set tolerance while dragging. Positive values decrease sensitivity,
    // negative values increase it.
    tolerance: 0
  }, // end group defaults
  containerGroups = {},
  groupCounter = 0,
  emptyBox = {
    left: 0,
    top: 0,
    bottom: 0,
    right:0
  },
  eventNames = {
    start: "touchstart.sortable mousedown.sortable",
    drop: "touchend.sortable touchcancel.sortable mouseup.sortable",
    drag: "touchmove.sortable mousemove.sortable",
    scroll: "scroll.sortable"
  },
  subContainerKey = "subContainers"

  /*
   * a is Array [left, right, top, bottom]
   * b is array [left, top]
   */
  function d(a,b) {
    var x = Math.max(0, a[0] - b[0], b[0] - a[1]),
    y = Math.max(0, a[2] - b[1], b[1] - a[3])
    return x+y;
  }

  function setDimensions(array, dimensions, tolerance, useOffset) {
    var i = array.length,
    offsetMethod = useOffset ? "offset" : "position"
    tolerance = tolerance || 0

    while(i--){
      var el = array[i].el ? array[i].el : $(array[i]),
      // use fitting method
      pos = el[offsetMethod]()
      pos.left += parseInt(el.css('margin-left'), 10)
      pos.top += parseInt(el.css('margin-top'),10)
      dimensions[i] = [
        pos.left - tolerance,
        pos.left + el.outerWidth() + tolerance,
        pos.top - tolerance,
        pos.top + el.outerHeight() + tolerance
      ]
    }
  }

  function getRelativePosition(pointer, element) {
    var offset = element.offset()
    return {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    }
  }

  function sortByDistanceDesc(dimensions, pointer, lastPointer) {
    pointer = [pointer.left, pointer.top]
    lastPointer = lastPointer && [lastPointer.left, lastPointer.top]

    var dim,
    i = dimensions.length,
    distances = []

    while(i--){
      dim = dimensions[i]
      distances[i] = [i,d(dim,pointer), lastPointer && d(dim, lastPointer)]
    }
    distances = distances.sort(function  (a,b) {
      return b[1] - a[1] || b[2] - a[2] || b[0] - a[0]
    })

    // last entry is the closest
    return distances
  }

  function ContainerGroup(options) {
    this.options = $.extend({}, groupDefaults, options)
    this.containers = []

    if(!this.options.rootGroup){
      this.scrollProxy = $.proxy(this.scroll, this)
      this.dragProxy = $.proxy(this.drag, this)
      this.dropProxy = $.proxy(this.drop, this)
      this.placeholder = $(this.options.placeholder)

      if(!options.isValidTarget)
        this.options.isValidTarget = undefined
    }
  }

  ContainerGroup.get = function  (options) {
    if(!containerGroups[options.group]) {
      if(options.group === undefined)
        options.group = groupCounter ++

      containerGroups[options.group] = new ContainerGroup(options)
    }

    return containerGroups[options.group]
  }

  ContainerGroup.prototype = {
    dragInit: function  (e, itemContainer) {
      this.$document = $(itemContainer.el[0].ownerDocument)

      // get item to drag
      var closestItem = $(e.target).closest(this.options.itemSelector);
      // using the length of this item, prevents the plugin from being started if there is no handle being clicked on.
      // this may also be helpful in instantiating multidrag.
      if (closestItem.length) {
        this.item = closestItem;
        this.itemContainer = itemContainer;
        if (this.item.is(this.options.exclude) || !this.options.onMousedown(this.item, groupDefaults.onMousedown, e)) {
            return;
        }
        this.setPointer(e);
        this.toggleListeners('on');
        this.setupDelayTimer();
        this.dragInitDone = true;
      }
    },
    drag: function  (e) {
      if(!this.dragging){
        if(!this.distanceMet(e) || !this.delayMet)
          return

        this.options.onDragStart(this.item, this.itemContainer, groupDefaults.onDragStart, e)
        this.item.before(this.placeholder)
        this.dragging = true
      }

      this.setPointer(e)
      // place item under the cursor
      this.options.onDrag(this.item,
                          getRelativePosition(this.pointer, this.item.offsetParent()),
                          groupDefaults.onDrag,
                          e)

      var p = this.getPointer(e),
      box = this.sameResultBox,
      t = this.options.tolerance

      if(!box || box.top - t > p.top || box.bottom + t < p.top || box.left - t > p.left || box.right + t < p.left)
        if(!this.searchValidTarget()){
          this.placeholder.detach()
          this.lastAppendedItem = undefined
        }
    },
    drop: function  (e) {
      this.toggleListeners('off')

      this.dragInitDone = false

      if(this.dragging){
        // processing Drop, check if placeholder is detached
        if(this.placeholder.closest("html")[0]){
          this.placeholder.before(this.item).detach()
        } else {
          this.options.onCancel(this.item, this.itemContainer, groupDefaults.onCancel, e)
        }
        this.options.onDrop(this.item, this.getContainer(this.item), groupDefaults.onDrop, e)

        // cleanup
        this.clearDimensions()
        this.clearOffsetParent()
        this.lastAppendedItem = this.sameResultBox = undefined
        this.dragging = false
      }
    },
    searchValidTarget: function  (pointer, lastPointer) {
      if(!pointer){
        pointer = this.relativePointer || this.pointer
        lastPointer = this.lastRelativePointer || this.lastPointer
      }

      var distances = sortByDistanceDesc(this.getContainerDimensions(),
                                         pointer,
                                         lastPointer),
      i = distances.length

      while(i--){
        var index = distances[i][0],
        distance = distances[i][1]

        if(!distance || this.options.pullPlaceholder){
          var container = this.containers[index]
          if(!container.disabled){
            if(!this.$getOffsetParent()){
              var offsetParent = container.getItemOffsetParent()
              pointer = getRelativePosition(pointer, offsetParent)
              lastPointer = getRelativePosition(lastPointer, offsetParent)
            }
            if(container.searchValidTarget(pointer, lastPointer))
              return true
          }
        }
      }
      if(this.sameResultBox)
        this.sameResultBox = undefined
    },
    movePlaceholder: function  (container, item, method, sameResultBox) {
      var lastAppendedItem = this.lastAppendedItem
      if(!sameResultBox && lastAppendedItem && lastAppendedItem[0] === item[0])
        return;

      item[method](this.placeholder)
      this.lastAppendedItem = item
      this.sameResultBox = sameResultBox
      this.options.afterMove(this.placeholder, container, item)
    },
    getContainerDimensions: function  () {
      if(!this.containerDimensions)
        setDimensions(this.containers, this.containerDimensions = [], this.options.tolerance, !this.$getOffsetParent())
      return this.containerDimensions
    },
    getContainer: function  (element) {
      return element.closest(this.options.containerSelector).data(pluginName)
    },
    $getOffsetParent: function  () {
      if(this.offsetParent === undefined){
        var i = this.containers.length - 1,
        offsetParent = this.containers[i].getItemOffsetParent()

        if(!this.options.rootGroup){
          while(i--){
            if(offsetParent[0] != this.containers[i].getItemOffsetParent()[0]){
              // If every container has the same offset parent,
              // use position() which is relative to this parent,
              // otherwise use offset()
              // compare #setDimensions
              offsetParent = false
              break;
            }
          }
        }

        this.offsetParent = offsetParent
      }
      return this.offsetParent
    },
    setPointer: function (e) {
      var pointer = this.getPointer(e)

      if(this.$getOffsetParent()){
        var relativePointer = getRelativePosition(pointer, this.$getOffsetParent())
        this.lastRelativePointer = this.relativePointer
        this.relativePointer = relativePointer
      }

      this.lastPointer = this.pointer
      this.pointer = pointer
    },
    distanceMet: function (e) {
      var currentPointer = this.getPointer(e)
      return (Math.max(
        Math.abs(this.pointer.left - currentPointer.left),
        Math.abs(this.pointer.top - currentPointer.top)
      ) >= this.options.distance)
    },
    getPointer: function(e) {
      var o = e.originalEvent || e.originalEvent.touches && e.originalEvent.touches[0]
      return {
        left: e.pageX || o.pageX,
        top: e.pageY || o.pageY
      }
    },
    setupDelayTimer: function () {
      var that = this
      this.delayMet = !this.options.delay

      // init delay timer if needed
      if (!this.delayMet) {
        clearTimeout(this._mouseDelayTimer);
        this._mouseDelayTimer = setTimeout(function() {
          that.delayMet = true
        }, this.options.delay)
      }
    },
    scroll: function  (e) {
      this.clearDimensions()
      this.clearOffsetParent() // TODO is this needed?
    },
    toggleListeners: function (method) {
      var that = this,
      events = ['drag','drop','scroll']

      $.each(events,function  (i,event) {
        that.$document[method](eventNames[event], that[event + 'Proxy'])
      })
    },
    clearOffsetParent: function () {
      this.offsetParent = undefined
    },
    // Recursively clear container and item dimensions
    clearDimensions: function  () {
      this.traverse(function(object){
        object._clearDimensions()
      })
    },
    traverse: function(callback) {
      callback(this)
      var i = this.containers.length
      while(i--){
        this.containers[i].traverse(callback)
      }
    },
    _clearDimensions: function(){
      this.containerDimensions = undefined
    },
    _destroy: function () {
      containerGroups[this.options.group] = undefined
    }
  }

  function Container(element, options) {
    this.el = element
    this.options = $.extend( {}, containerDefaults, options)

    this.group = ContainerGroup.get(this.options)
    this.rootGroup = this.options.rootGroup || this.group
    this.handle = this.rootGroup.options.handle || this.rootGroup.options.itemSelector

    var itemPath = this.rootGroup.options.itemPath
    this.target = itemPath ? this.el.find(itemPath) : this.el

    this.target.on(eventNames.start, this.handle, $.proxy(this.dragInit, this))

    if(this.options.drop)
      this.group.containers.push(this)
  }

  Container.prototype = {
    dragInit: function  (e) {
      var rootGroup = this.rootGroup

      if( !this.disabled &&
          !rootGroup.dragInitDone &&
          this.options.drag &&
          this.isValidDrag(e)) {
        rootGroup.dragInit(e, this)
      }
    },
    isValidDrag: function(e) {
      return e.which == 1 ||
        e.type == "touchstart" && e.originalEvent.touches.length == 1
    },
    searchValidTarget: function  (pointer, lastPointer) {
      var distances = sortByDistanceDesc(this.getItemDimensions(),
                                         pointer,
                                         lastPointer),
      i = distances.length,
      rootGroup = this.rootGroup,
      validTarget = !rootGroup.options.isValidTarget ||
        rootGroup.options.isValidTarget(rootGroup.item, this)

      if(!i && validTarget){
        rootGroup.movePlaceholder(this, this.target, "append")
        return true
      } else
        while(i--){
          var index = distances[i][0],
          distance = distances[i][1]
          if(!distance && this.hasChildGroup(index)){
            var found = this.getContainerGroup(index).searchValidTarget(pointer, lastPointer)
            if(found)
              return true
          }
          else if(validTarget){
            this.movePlaceholder(index, pointer)
            return true
          }
        }
    },
    movePlaceholder: function  (index, pointer) {
      var item = $(this.items[index]),
      dim = this.itemDimensions[index],
      method = "after",
      width = item.outerWidth(),
      height = item.outerHeight(),
      offset = item.offset(),
      sameResultBox = {
        left: offset.left,
        right: offset.left + width,
        top: offset.top,
        bottom: offset.top + height
      }
      if(this.options.vertical){
        var yCenter = (dim[2] + dim[3]) / 2,
        inUpperHalf = pointer.top <= yCenter
        if(inUpperHalf){
          method = "before"
          sameResultBox.bottom -= height / 2
        } else
          sameResultBox.top += height / 2
      } else {
        var xCenter = (dim[0] + dim[1]) / 2,
        inLeftHalf = pointer.left <= xCenter
        if(inLeftHalf){
          method = "before"
          sameResultBox.right -= width / 2
        } else
          sameResultBox.left += width / 2
      }
      if(this.hasChildGroup(index))
        sameResultBox = emptyBox
      this.rootGroup.movePlaceholder(this, item, method, sameResultBox)
    },
    getItemDimensions: function  () {
      if(!this.itemDimensions){
        this.items = this.$getChildren(this.el, "item").filter(
          ":not(." + this.group.options.placeholderClass + ", ." + this.group.options.draggedClass + ")"
        ).get()
        setDimensions(this.items, this.itemDimensions = [], this.options.tolerance)
      }
      return this.itemDimensions
    },
    getItemOffsetParent: function  () {
      var offsetParent,
      el = this.el
      // Since el might be empty we have to check el itself and
      // can not do something like el.children().first().offsetParent()
      if(el.css("position") === "relative" || el.css("position") === "absolute"  || el.css("position") === "fixed")
        offsetParent = el
      else
        offsetParent = el.offsetParent()
      return offsetParent
    },
    hasChildGroup: function (index) {
      return this.options.nested && this.getContainerGroup(index)
    },
    getContainerGroup: function  (index) {
      var childGroup = $.data(this.items[index], subContainerKey)
      if( childGroup === undefined){
        var childContainers = this.$getChildren(this.items[index], "container")
        childGroup = false

        if(childContainers[0]){
          var options = $.extend({}, this.options, {
            rootGroup: this.rootGroup,
            group: groupCounter ++
          })
          childGroup = childContainers[pluginName](options).data(pluginName).group
        }
        $.data(this.items[index], subContainerKey, childGroup)
      }
      return childGroup
    },
    $getChildren: function (parent, type) {
      var options = this.rootGroup.options,
      path = options[type + "Path"],
      selector = options[type + "Selector"]

      parent = $(parent)
      if(path)
        parent = parent.find(path)

      return parent.children(selector)
    },
    _serialize: function (parent, isContainer) {
      var that = this,
      childType = isContainer ? "item" : "container",

      children = this.$getChildren(parent, childType).not(this.options.exclude).map(function () {
        return that._serialize($(this), !isContainer)
      }).get()

      return this.rootGroup.options.serialize(parent, children, isContainer)
    },
    traverse: function(callback) {
      $.each(this.items || [], function(item){
        var group = $.data(this, subContainerKey)
        if(group)
          group.traverse(callback)
      });

      callback(this)
    },
    _clearDimensions: function  () {
      this.itemDimensions = undefined
    },
    _destroy: function() {
      var that = this;

      this.target.off(eventNames.start, this.handle);
      this.el.removeData(pluginName)

      if(this.options.drop)
        this.group.containers = $.grep(this.group.containers, function(val){
          return val != that
        })

      $.each(this.items || [], function(){
        $.removeData(this, subContainerKey)
      })
    }
  }

  var API = {
    enable: function() {
      this.traverse(function(object){
        object.disabled = false
      })
    },
    disable: function (){
      this.traverse(function(object){
        object.disabled = true
      })
    },
    serialize: function () {
      return this._serialize(this.el, true)
    },
    refresh: function() {
      this.traverse(function(object){
        object._clearDimensions()
      })
    },
    destroy: function () {
      this.traverse(function(object){
        object._destroy();
      })
    }
  }

  $.extend(Container.prototype, API)

  /**
   * jQuery API
   *
   * Parameters are
   *   either options on init
   *   or a method name followed by arguments to pass to the method
   */
  $.fn[pluginName] = function(methodOrOptions) {
    var args = Array.prototype.slice.call(arguments, 1)

    return this.map(function(){
      var $t = $(this),
      object = $t.data(pluginName)

      if(object && API[methodOrOptions])
        return API[methodOrOptions].apply(object, args) || this
      else if(!object && (methodOrOptions === undefined ||
                          typeof methodOrOptions === "object"))
        $t.data(pluginName, new Container($t, methodOrOptions))

      return this
    });
  };

}(jQuery, window, 'sortable');

/**
 * Created by Sigma on 12/04/2017.
 */
//sortable itinerary
$(function () {
    $(".grid .grid-lobo").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'placeholder',
        forceHelperSize: true
    });
});

//-- FREDDY

function mostrarItinerarios() {
    var destinos='';
    $("input[name=destinos]").each(function (index) {
        if($(this).is(':checked')){
            destinos+=$(this).val()+'_';
        }
    });

    destinos=destinos.substring(0,destinos.length-1);
    $("#lista_itinerarios").html('<div class="progress">'+
        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">'+
        '<span class="sr-only">45% Complete</span>'+
        '</div>'+
        '</div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/mostrar_itinerario', 'destinos='+destinos, function(data) {
        $("#lista_itinerarios").html(data);

    }).fail(function (data) {
        $("#lista_itinerarios").html('');
        console.log('error: '+data);
    });
}
var total_Itinerarios=0;
var Itis_precio=0;
var nroPasajeros=2;
function Pasar_datos(){
    Itis_precio=parseFloat($('#totalItinerario').val());
    total_Itinerarios=$('#nroItinerario').val();
    var itinerario='';
    $("input[class='itinerario']").each(function (index){
        if($(this).is(':checked')){
            itinerario=$(this).val().split('_');
            if(itinerario[6]==0){
                total_Itinerarios++;
                var precio_grupo=0;
                Itis_precio += parseFloat(itinerario[4]);
                console.log('Precios:'+Itis_precio);
                var servicios=itinerario[5].split('*');
                $.each(servicios, function( key, value ) {
                    var serv=value.split('//');
                    var val_p_g=parseFloat(serv[1]);
                });
                var iti_temp='';
                iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '">' +
                    '<div class="content-list-book-s">' +
                    '<a href="#!">' +
                    '<strong>' +
                    '<input type="hidden" class="servicios_new" name="servicios_new_'+itinerario[0]+'" value="' + itinerario[0] + '">' +
                    '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                    '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                    '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                    '<span class="itinerarios_1 d-none">' + itinerario[5] + '</span>' +
                    '<span class="txt_itinerarios d-none" name="itinerarios1">' + itinerario[0] + '</span>' +
                    '<b class="dias_iti_c2" id="dias_' + total_Itinerarios + '">Dia ' + total_Itinerarios + ':</b> ' + itinerario[2] +
                    '</strong>' +
                    '<small>' +
                    itinerario[4] + '$' +
                    '</small>' +
                    '</a>' +
                    '<div class="icon">' +
                    ' <a class="text-right" href="#!" onclick="eliminar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                '</div>' +
                '</div>' +
                '</li>';
                $('#Lista_itinerario_g').append(iti_temp);
            }
            else{
                if(!existe(itinerario[0])) {
                    total_Itinerarios++;
                    var precio_grupo=0;
                    Itis_precio += parseFloat(itinerario[4]);
                    console.log('Precios:'+Itis_precio);
                    var servicios=itinerario[5].split('*');
                $.each(servicios, function( key, value ) {
                    var serv=value.split('//');
                    var val_p_g=parseFloat(serv[1]);
                });
                var iti_temp='';
                        iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '">' +
                        '<div class="content-list-book-s">' +
                        '<a href="#!">' +
                        '<strong>' +
                        '<input type="hidden" class="servicios_new" name="servicios_new_'+itinerario[0]+'" value="' + itinerario[0] + '">' +
                        '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                        '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                        '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                        '<span class="itinerarios_1 d-none">' + itinerario[5] + '</span>' +
                        '<span class="txt_itinerarios d-none" name="itinerarios1">' + itinerario[0] + '</span>' +
                        '<b class="dias_iti_c2" id="dias_' + total_Itinerarios + '">Dia ' + total_Itinerarios + ':</b> ' + itinerario[2] +
                        '</strong>' +
                        '<small>' +
                        itinerario[4] + '$' +
                        '</small>' +
                        '</a>' +
                        '<div class="icon">' +
                        ' <a class="text-right" href="#!" onclick="eliminar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                    '</div>' +
                    '</div>' +
                    '</li>';
                $('#Lista_itinerario_g').append(iti_temp);
                }
            }
        }
    });
    $('#totalItinerario').val(Itis_precio);
    $('#totalItinerario_front').html(Itis_precio);
    $('#totalItinerario_venta').val(Itis_precio);
    $('#nroItinerario').val(total_Itinerarios);
    calcular_resumen();
}
function cambiar_profit(tipo){
    var totalItinerario=parseInt($('#totalItinerario').val());
    var nroDiasItinerario=parseInt($('#txt_day').val());
    nroDiasItinerario=nroDiasItinerario-1;

    var profit_0=$('#profit_0').val();
    var profit_2=$('#profit_2').val();
    var profit_3=$('#profit_3').val();
    var profit_4=$('#profit_4').val();
    var profit_5=$('#profit_5').val();

    if(tipo==2){
        var vt2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t2').val()));
        $('#amount_t2_c').val(vt2);
        vt2=Math.ceil(vt2+((vt2*profit_2)*0.01));
        $('#amount_t2_v').val(vt2);

        var vd2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d2').val()));
        $('#amount_d2_c').val(vd2);
        vd2=Math.ceil(vd2+((vd2*profit_2)*0.01));
        $('#amount_d2_v').val(vd2);

        var vs2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s2').val()));
        $('#amount_s2_c').val(vs2);
        vs2=Math.ceil(vs2+((vs2*profit_2)*0.01));
        $('#amount_s2_v').val(vs2);
    }
    if(tipo==3){
        var vt3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t3').val()));
        $('#amount_t3_c').val(vt3);
        vt3=Math.ceil(vt3+((vt3*profit_3)*0.01));
        $('#amount_t3_v').val(vt3);

        var vd3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d3').val()));
        $('#amount_d3_c').val(vd3);
        vd3=Math.ceil(vd3+((vd3*profit_3)*0.01));
        $('#amount_d3_v').val(vd3);

        var vs3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s3').val()));
        $('#amount_s3_c').val(vs3);
        vs3=Math.ceil(vs3+((vs3*profit_3)*0.01));
        $('#amount_s3_v').val(vs3);
    }
    if(tipo==4){
        var vt4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t4').val()));
        $('#amount_s4_c').val(vt4);
        vt4=Math.ceil(vt4+((vt4*profit_4)*0.01));
        $('#amount_t4_v').val(vt4);

        var vd4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d4').val()));
        $('#amount_d4_c').val(vd4);
        vd4=Math.ceil(vd4+((vd4*profit_4)*0.01));
        $('#amount_d4_v').val(vd4);

        var vs4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s4').val()));
        $('#amount_s4_c').val(vs4);
        vs4=Math.ceil(vs4+((vs4*profit_4)*0.01));
        $('#amount_s4_v').val(vs4);
    }
    if(tipo==5){
        var vt5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t5').val()));
        $('#amount_t5_c').val(vt5);
        vt5=Math.ceil(vt5+((vt5*profit_5)*0.01));
        $('#amount_t5_v').val(vt5);

        var vd5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d5').val()));
        $('#amount_d5_c').val(vd5);
        vd5=Math.ceil(vd5+((vd5*profit_5)*0.01));
        $('#amount_d5_v').val(vd5);

        var vs5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s5').val()));
        $('#amount_s5_c').val(vs5);
        vs5=Math.ceil(vs5+((vs5*profit_5)*0.01));
        $('#amount_s5_v').val(vs5);
    }
}
function cambiar_profit_total() {
    cambiar_profit(2);
    cambiar_profit(3);
    cambiar_profit(4);
    cambiar_profit(5);
}

/*== functions for destinations*/
function eliminar_destino(id,destino) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el destino "+destino+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/destination/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_destinos_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function escojerPos(pos,cate) {
    $("#posTipo").val(pos);
    mostrar_pivot(cate);

}
function mostrar_pivot(cate){
    $("#t_TOURS").addClass('d-none');
    $("#t_MOVILID").addClass('d-none');
    $("#t_REPRESENT").addClass('d-none');
    $("#t_ENTRANCES").addClass('d-none');
    $("#t_FOOD").addClass('d-none');
    $("#t_TRAINS").addClass('d-none');
    $("#t_FLIGHTS").addClass('d-none');
    $("#t_OTHERS").addClass('d-none');
    $("#t_"+cate).removeClass('d-none');

}

function eliminar_servicio(local,id,servicio) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el servicio "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/services/delete', 'id='+id, function(data) {
            var res=data.split('_');
            if(res[0]==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_"+id).fadeOut( "slow");
            }
            else if(res[0]==2){
                swal(
                    'Porque no puedo borar?',
                    res[1],
                    'warning'
                )
            }
        }).fail(function (data) {

        });

    })
}
function escojerPosEdit(pos,id) {
    $("#posTipoEdit_"+id).val(pos);
}
function eliminar_producto(id,servicio) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el producto "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/costs/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}

function escojerPosEdit_cost(id,pos){
    $("#posTipoEditcost_"+id).val(pos);
}
var desicion=0;
function mostrar_new_cost() {
    console.log('mostrando datos');
    if(desicion==0){
        desicion=1;
        $("#modal_new_cost").removeClass('d-none');
        $("#modal_new_cost").fadeIn( "slow");
        console.log('mostrando');
    }
    else if(desicion==1){
        desicion=0;
        $("#modal_new_cost").addClass('d-none');
        $("#modal_new_cost").fadeOut( "slow");
        console.log('ocultando');
    }
}
function pasar_pos_provider(pos) {
    $("#grupo_provider").val(pos);
}

function envia(){
        console.log('holaaaaaaaaaaaa');
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        });
        var txt_grupo=$('#txt_grupo').val();
        var txt_localizacion=$('#txt_localizacion').val();
        var txt_ruc=$('#txt_ruc').val();
        var txt_razon_social=$('#txt_razon_social').val();
        var txt_direccion=$('#txt_direccion').val();
        var txt_telefono=$('#txt_telefono').val();
        var txt_celular=$('#txt_celular').val();
        var txt_email=$('#txt_email').val();
        var txt_r_nombres=$('#txt_r_nombres').val();
        var txt_r_telefono=$('#txt_r_telefono').val();
        var txt_c_nombres=$('#txt_c_nombres').val();
        var txt_c_telefono=$('#txt_c_telefono').val();

        $.ajax({
            url: '/admin/provider',//$(this).attr("action"),//action del formulario, ej:
            //http://localhost/mi_proyecto/mi_controlador/mi_funcion
            type: 'post',//$(this).attr("method"),//el método post o get del formulario
            data: $('#service_save_id').serialize()+'&txt_grupo='+txt_grupo+'&txt_localizacion='+txt_localizacion+'&txt_ruc='+txt_ruc+'&txt_razon_social='+txt_razon_social+
            '&txt_direccion='+txt_direccion+'&txt_telefono='+txt_telefono+'&txt_celular='+txt_celular+'&txt_email='+txt_email+'&txt_r_nombres='+txt_r_nombres+
            '&txt_r_telefono='+txt_r_telefono+'&txt_c_nombres='+txt_c_nombres+'&txt_c_telefono='+txt_c_telefono,//obtenemos todos los datos del formulario
            success: function (data) {
                //hacemos algo cuando finalice
                var rpt = data.split('_');
                console.log(data);
                if (rpt[0] == 1) {
                    // $("#response").html(data[1]);
                    var $pos = $("#grupo_provider").val();

                    $("#txt_provider_" + $pos).val(rpt[1] + ' ' + rpt[2]);
                    $("#rpt").html('' +
                        '<div class="alert alert-success">' +
                        '<strong>Success!</strong> Datos guardados,puede seguir con el proceso por favor cierre el popup' +
                        '</div>');
                }
                else {
                    $("#rpt").html('' +
                        '<div class="alert alert-error">' +
                        '<strong>Error!</strong> error al guardar al proveedor' +
                        '</div>');
                    // $("#response").html(data);
                }

            },
            error: function () {
                //si hay un error mostramos un mensaje
                $("#rpt").html('' +
                    '<div class="alert alert-danger">' +
                    '<strong>Danger!</strong> Error al guardar los datos del proveedor,vuelva a intentarlo' +
                    '</div>');
            }
        });
}
function eliminar_provider(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar al proveedor "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/provider/delete', 'id='+id, function(data) {
            console.log('data:'+data);
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_provider_"+id).fadeOut( "slow");
            }
            else if(data==2){
                swal(
                    'Porque no puedo borar?',
                    'El proveedor tiene costos asociados, vaya al modulo "Costs" y borre todos los registros asociados al proveedor.',
                    'warning'
                )
            }
        }).fail(function (data) {

        });

    })
}
function eliminar_itinerario(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el itinerario "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/itinerary/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_itinerary_"+id).fadeOut( "slow");

            }
            else if(data==2){
                // swal(
                //     'Porque no puedo borar?',
                //     'El proveedor tiene costos asociados, vaya al modulo "Costs" y borre todos los registros asociados al proveedor.',
                //     'warning'
                // )
            }
        }).fail(function (data) {
        });
    })
}

function sumar_servicios(grupo){
    var total_ci=0;
    $("input[class='servicios']").each(function (index) {
        if($(this).is(':checked')){
            var dato=$(this).val();
            var dato1=dato.split('_');
            // console.log(dato1[1]);
            if(dato1[0]==grupo) {
                total_ci += parseFloat(dato1[1]);
            }
            // console.log($(this).val());
        }
    });
     // console.log('total:'+total_ci);
    $('#total_ci_'+grupo).html(total_ci);
    $('#precio_itinerario_'+grupo).val(total_ci);

}

function  filtrar_grupos(){

    $("input[class='servicios']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        var esta=0;
        $("input[class='grupo']").each(function (index) {
            if($(this).is(':checked')) {
                var dato = $(this).val();
                var destino1 = dato.split('_');
                if(destino1[1] == servicio3[3]) {
                    esta=1;
                }
            }
        });
        if(esta==1) {
            $('#service_'+servicio3[2]).removeClass("d-none");
            $('#service_'+servicio3[2]).fadeIn("slow");

        }
        else {
            $(this).prop("checked", "");
            $('#service_'+servicio3[2]).fadeOut("slow");
        }
    });

    $("input[class='servicios']").each(function (index2) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        sumar_servicios(servicio3[0]);
    });
}

function sumar_servicios_edit(grupo){
    var total_ci=0;
    $("input[class='servicios_edit']").each(function (index) {
        if($(this).is(':checked')){
            var dato=$(this).val();
            var dato1=dato.split('_');
            // console.log(dato1[1]);
            if(dato1[0]==grupo) {
                total_ci += parseFloat(dato1[1]);
            }
            // console.log($(this).val());
        }
    });
    // console.log('total:'+total_ci);
    $('#total_ci_'+grupo).html(total_ci);
    $('#precio_itinerario_'+grupo).val(total_ci);
}
function  filtrar_grupos_edit(itinerario){
    $("input[class='servicios']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        var esta=0;
        $("input[class='grupo']").each(function (index) {
            if($(this).is(':checked')) {
                var dato = $(this).val();
                var destino1 = dato.split('_');
                if(destino1[1] == servicio3[3]) {/*-- si el destino es igual al destino que tiene el servicio*/
                    esta=1;
                }
            }
        });
        if(esta==1) {

            $('#service_'+servicio3[2]).removeClass("d-none");

            $('#service_'+servicio3[2]).fadeIn("slow");

        }
        else {
            $(this).prop("checked", "");
            $('#service_'+servicio3[2]).fadeOut("slow");
        }
    });

    $("input[class='servicios']").each(function (index2) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        sumar_servicios(servicio3[0]);
    });



    $("input[class='servicios_edit']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        if(servicio3[0]==itinerario){
            var esta=0;
            $("input[class='grupo_edit']").each(function (index) {
                if($(this).is(':checked')) {
                    var dato = $(this).val();
                    var destino1 = dato.split('_');
                    if(destino1[2] == itinerario) {
                        if(destino1[1] == servicio3[3]) {
                            esta=1;
                            // console.log('si esta:'+destino1[1]+'=='+servicio3[3]);
                        }
                    }
                }
            });
            if(esta==1) {

                $('#service_edit_'+itinerario+'_'+servicio3[2]).removeClass("d-none");
                $('#service_edit_'+itinerario+'_'+servicio3[2]).fadeIn("slow");
                // console.log('no borrando:'+'#service_edit_'+itinerario+'_'+servicio3[2]);
            }
            else {
                $(this).prop("checked", "");

                $('#service_edit_'+itinerario+'_'+servicio3[2]).addClass("d-none");

                $('#service_edit_'+itinerario+'_'+servicio3[2]).fadeOut("slow");
                console.log('borrando:'+'#service_edit_'+itinerario+'_'+servicio3[2]);
            }
        }
    });

    $("input[class='servicios_edit']").each(function (index2) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        sumar_servicios_edit(servicio3[0]);
    });
}
function  filtrar_itinerarios(){
    var destino1 =$('#desti').val().split('/');
    //
    $.each(destino1,function (index1,value){

        $('#group_destino_'+value).addClass("d-none");

        $('#group_destino_'+value).fadeOut("slow");
    });
    var esta=0;
    destinos='';
    var valorci='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci=$(this).val().split('_');
            console.log('destino escojido:'+valorci[0]);
            destinos+=valorci[0]+'/';

            $('#group_destino_'+valorci[0]).removeClass("d-none");

            $('#group_destino_'+valorci[0]).fadeIn("slow");

        }
    });
    destinos=destinos.substr(0,destinos.length-1);
    $('#desti').val(destinos);


}

function eliminar_iti(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar este itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#content-list-'+id).fadeOut();
        $('#content-list-'+id).remove();
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        var valor_temp=parseFloat($('#totalItinerario').val());
        valor_temp=valor_temp-valor;
        $('#totalItinerario').val(valor_temp);
        $('#totalItinerario_front').html(valor_temp);

        var cont=0;
        $(".dias_iti_c2").each(function (index) {
            cont++;
            $(this).html('Dia '+cont+':');
        });
        console.log('cont:'+cont);
        $('#nroItinerario').val(cont);
        calcular_resumen();
    })
}

function calcular_utilidad(){
    var $totalItinerario=$('#totalItinerario').val();
    var $txt_day=Math.ceil($('#txt_day').val()-1);
    var $txt_utilidad=$('#txt_utilidad').val();
    var $preciox_n_dias=$totalItinerario*($txt_day-1);
    var $utilidad1=parseFloat($txt_utilidad)*parseFloat(0.01);
    var $preciox_n_dias_venta=$preciox_n_dias+Math.round($preciox_n_dias*$utilidad1);
    $('#totalItinerario_venta').val($preciox_n_dias_venta);
}
function eliminar_categoria1(id,categoria) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la categoria "+categoria+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/categories/delete', 'id='+id, function(data) {
            if(data==1){
                $("#lista_categoria_"+id).remove();
                $("#lista_categoria_"+id).fadeOut( "slow");
                swal(
                    'Mensaje del sistema',
                    'Se borro la categoria '+categoria,
                    'success'
                )
            }
            if(data==0){
                swal(
                    'Porque no puedo borrar?',
                    'Algo salio mal, vuelva a intentarlo mas tarde',
                    'warning'
                )
            }
        }).fail(function (data) {
        });
    })
}
function calcular_resumen_venta(dias,star,acom,precio_venta){
    var costo=parseFloat($('#amount_'+acom+star+'_a').html());
    var profit=parseFloat(precio_venta)-costo;
    $('#amount_'+acom+star+'_a_p').val(profit);
}
function calcular_resumen() {
    // var utilidad_2 = parseFloat($("#profitt_2").val());
    // var utilidad_3 = parseFloat($("#profitt_3").val());
    // var utilidad_4 = parseFloat($("#profitt_4").val());
    // var utilidad_5 = parseFloat($("#profitt_5").val());

    // var cost_por_2=parseFloat(1-utilidad_2.toFixed(2))*100;
    // var cost_por_3=parseFloat(1-utilidad_3.toFixed(2))*100;
    // var cost_por_4=parseFloat(1-utilidad_4.toFixed(2))*100;
    // var cost_por_5=parseFloat(1-utilidad_5.toFixed(2))*100;

    // $("#porc_cost_2").html(cost_por_2.toFixed(2));
    // $("#porc_cost_3").html(cost_por_3.toFixed(2));
    // $("#porc_cost_4").html(cost_por_4.toFixed(2));
    // $("#porc_cost_5").html(cost_por_5.toFixed(2));

    // var p_2_copi=$("#profitt_2").val();
    // var p_3_copi=$("#profitt_3").val();
    // var p_4_copi=$("#profitt_4").val();
    // var p_5_copi=$("#profitt_5").val();

    // $("#porc_cost_2_copi").html(p_2_copi);
    // $("#porc_cost_3_copi").html(p_3_copi);
    // $("#porc_cost_4_copi").html(p_4_copi);
    // $("#porc_cost_5_copi").html(p_5_copi);

    // console.log(utilidad_3);
    var costo_itinerario = $("#totalItinerario").val();
    var txt_day = Math.ceil($('#txt_day').val() - 1);

    var amount_s2 = $("#amount_s2").val();
    var amount_d2 = Math.round(Math.ceil($("#amount_d2").val()) / 2,2);
    var amount_m2 = Math.round(Math.ceil($("#amount_m2").val()) / 2,2);
    var amount_t2 = Math.round(Math.ceil($("#amount_t2").val()) / 3,2);

    var amount_s3 = $("#amount_s3").val();
    var amount_d3 = Math.round(Math.ceil($("#amount_d3").val()) / 2,2);
    var amount_m3 = Math.round(Math.ceil($("#amount_m3").val()) / 2,2);
    var amount_t3 = Math.round(Math.ceil($("#amount_t3").val()) / 3,2);

    var amount_s4 = $("#amount_s4").val();
    var amount_d4 = Math.round(Math.ceil($("#amount_d4").val()) / 2,2);
    var amount_m4 = Math.round(Math.ceil($("#amount_m4").val()) / 2,2);
    var amount_t4 = Math.round(Math.ceil($("#amount_t4").val()) / 3,2);

    var amount_s5 = $("#amount_s5").val();
    var amount_d5 = Math.round(Math.ceil($("#amount_d5").val()) / 2,2);
    var amount_m5 = Math.round(Math.ceil($("#amount_m5").val()) / 2,2);
    var amount_t5 = Math.round(Math.ceil($("#amount_t5").val()) / 3,2);

    // var amount_s2_u = Math.round(costo_itinerario,2) + Math.round(amount_s2,2);
    // var amount_d2_u = Math.round(costo_itinerario,2) + Math.round(amount_d2,2);
    // var amount_m2_u = Math.round(costo_itinerario,2) + Math.round(amount_m2,2);
    // var amount_t2_u = Math.round(costo_itinerario,2) + Math.round(amount_t2,2);
    // var amount_s3_u = Math.round(costo_itinerario,2) + Math.round(amount_s3,2);
    // var amount_d3_u = Math.round(costo_itinerario,2) + Math.round(amount_d3,2);
    // var amount_m3_u = Math.round(costo_itinerario,2) + Math.round(amount_m3,2);
    // var amount_t3_u = Math.round(costo_itinerario,2) + Math.round(amount_t3,2);
    // var amount_s4_u = Math.round(costo_itinerario,2) + Math.round(amount_s4,2);
    // var amount_d4_u = Math.round(costo_itinerario,2) + Math.round(amount_d4,2);
    // var amount_m4_u = Math.round(costo_itinerario,2) + Math.round(amount_m4,2);
    // var amount_t4_u = Math.round(costo_itinerario,2) + Math.round(amount_t4,2);
    // var amount_s5_u = Math.round(costo_itinerario,2) + Math.round(amount_s5,2);
    // var amount_d5_u = Math.round(costo_itinerario,2) + Math.round(amount_d5,2);
    // var amount_m5_u = Math.round(costo_itinerario,2) + Math.round(amount_m5,2);
    // var amount_t5_u = Math.round(costo_itinerario,2) + Math.round(amount_t5,2);

    //-- Para 2 estrellas
    var amount_s2_u = (Math.round(costo_itinerario,2) + (Math.round(amount_s2,2) * Math.round(txt_day,0)));
    var amount_s2_u_pro = Math.round($('#amount_s2_a_p').val(),2);
    var amount_s2_u_pri = Math.round(amount_s2_u + amount_s2_u_pro,2);

    console.log('amount_s2_u:'+amount_s2_u);
    console.log('amount_s2_u_pro:'+amount_s2_u_pro);
    console.log('amount_s2_u_pri:'+amount_s2_u_pri);

    var amount_d2_u = (Math.round(costo_itinerario,2) + (Math.round(amount_d2,2) * Math.round(txt_day,0)));
    var amount_d2_u_pro = Math.round($('#amount_d2_a_p').val(),2);
    var amount_d2_u_pri = Math.round(amount_d2_u + amount_d2_u_pro,2);


    var amount_m2_u = (Math.round(costo_itinerario,2) + (Math.round(amount_m2,2) * Math.round(txt_day,0)));
    var amount_m2_u_pro = Math.round($('#amount_m2_a_p').val(),2);
    var amount_m2_u_pri = Math.round(amount_m2_u + amount_m2_u_pro,2);

    var amount_t2_u = (Math.round(costo_itinerario,2) + (Math.round(amount_t2,2) * Math.round(txt_day,0)));
    var amount_t2_u_pro = Math.round($('#amount_t2_a_p').val(),2);
    var amount_t2_u_pri = Math.round(amount_t2_u + amount_t2_u_pro,2);

    //-- Para 3 estrellas
    var amount_s3_u = (Math.round(costo_itinerario,2) + (Math.round(amount_s3,2) * Math.round(txt_day,0)));
    var amount_s3_u_pro = Math.round($('#amount_s3_a_p').val(),2);
    var amount_s3_u_pri = Math.round(amount_s3_u + amount_s3_u_pro,2);

    var amount_d3_u = (Math.round(costo_itinerario,2) + (Math.round(amount_d3,2) * Math.round(txt_day,0)));
    var amount_d3_u_pro = Math.round($('#amount_d3_a_p').val(),2);
    var amount_d3_u_pri = Math.round(amount_d3_u + amount_d3_u_pro,2);

    var amount_m3_u = (Math.round(costo_itinerario,2) + (Math.round(amount_m3,2) * Math.round(txt_day,0)));
    var amount_m3_u_pro = Math.round($('#amount_m3_a_p').val(),2);
    var amount_m3_u_pri = Math.round(amount_m3_u + amount_m3_u_pro,2);

    var amount_t3_u = (Math.round(costo_itinerario,2) + (Math.round(amount_t3,2) * Math.round(txt_day,0)));
    var amount_t3_u_pro = Math.round($('#amount_t3_a_p').val(),2);
    var amount_t3_u_pri = Math.round(amount_t3_u + amount_t3_u_pro,2);

//-- Para 4 estrellas
    var amount_s4_u = (Math.round(costo_itinerario,2) + (Math.round(amount_s4,2) * Math.round(txt_day,0)));
    var amount_s4_u_pro = Math.round($('#amount_s4_a_p').val(),2);
    var amount_s4_u_pri = Math.round(amount_s4_u + amount_s4_u_pro,2);

    var amount_d4_u = (Math.round(costo_itinerario,2) + (Math.round(amount_d4,2) * Math.round(txt_day,0)));
    var amount_d4_u_pro = Math.round($('#amount_d4_a_p').val(),2);
    var amount_d4_u_pri = Math.round(amount_d4_u + amount_d4_u_pro,2);

    var amount_m4_u = (Math.round(costo_itinerario,2) + (Math.round(amount_m4,2) * Math.round(txt_day,0)));
    var amount_m4_u_pro = Math.round($('#amount_m4_a_p').val(),2);
    var amount_m4_u_pri = Math.round(amount_m4_u + amount_m4_u_pro,2);

    var amount_t4_u = (Math.round(costo_itinerario,2) + (Math.round(amount_t4,2) * Math.round(txt_day,0)));
    var amount_t4_u_pro = Math.round($('#amount_t4_a_p').val(),2);
    var amount_t4_u_pri = Math.round(amount_t4_u + amount_t4_u_pro,2);

//-- Para 4 estrellas
    var amount_s5_u = (Math.round(costo_itinerario,2) + (Math.round(amount_s5,2) * Math.round(txt_day,0)));
    var amount_s5_u_pro = Math.round($('#amount_s5_a_p').val(),2);
    var amount_s5_u_pri = Math.round(amount_s5_u + amount_s5_u_pro,2);

    var amount_d5_u = (Math.round(costo_itinerario,2) + (Math.round(amount_d5,2) * Math.round(txt_day,0)));
    var amount_d5_u_pro = Math.round($('#amount_d5_a_p').val(),2);
    var amount_d5_u_pri = Math.round(amount_d5_u + amount_d5_u_pro,2);

    var amount_m5_u = (Math.round(costo_itinerario,2) + (Math.round(amount_m5,2) * Math.round(txt_day,0)));
    var amount_m5_u_pro = Math.round($('#amount_m5_a_p').val(),2);
    var amount_m5_u_pri = Math.round(amount_m5_u + amount_m5_u_pro,2);

    var amount_t5_u = (Math.round(costo_itinerario,2) + (Math.round(amount_t5,2) * Math.round(txt_day,0)));
    var amount_t5_u_pro = Math.round($('#amount_t5_a_p').val(),2);
    var amount_t5_u_pri = Math.round(amount_t5_u + amount_t5_u_pro,2);

    console.log('amount_s2_u:' + amount_s2_u);
    $("#amount_s2_a").html(amount_s2_u);
    $("#amount_s2_a_p").val(amount_s2_u_pro);
    $("#amount_s2_a_v").val(amount_s2_u_pri);

    $("#amount_d2_a").html(amount_d2_u);
    $("#amount_d2_a_p").val(amount_d2_u_pro);
    $("#amount_d2_a_v").val(amount_d2_u_pri);

    $("#amount_m2_a").html(amount_m2_u);
    $("#amount_m2_a_p").val(amount_m2_u_pro);
    $("#amount_m2_a_v").val(amount_m2_u_pri);

    $("#amount_t2_a").html(amount_t2_u);
    $("#amount_t2_a_p").val(amount_t2_u_pro);
    $("#amount_t2_a_v").val(amount_t2_u_pri);

    console.log('amount_s3_u:' + amount_s3_u);
    $("#amount_s3_a").html(amount_s3_u);
    $("#amount_s3_a_p").val(amount_s3_u_pro);
    $("#amount_s3_a_v").val(amount_s3_u_pri);

    $("#amount_d3_a").html(amount_d3_u);
    $("#amount_d3_a_p").val(amount_d3_u_pro);
    $("#amount_d3_a_v").val(amount_d3_u_pri);

    $("#amount_m3_a").html(amount_m3_u);
    $("#amount_m3_a_p").val(amount_m3_u_pro);
    $("#amount_m3_a_v").val(amount_m3_u_pri);

    $("#amount_t3_a").html(amount_t3_u);
    $("#amount_t3_a_p").val(amount_t3_u_pro);
    $("#amount_t3_a_v").val(amount_t3_u_pri);

    console.log('amount_s4_u:'+amount_s4_u);
    $("#amount_s4_a").html(amount_s4_u);
    $("#amount_s4_a_p").val(amount_s4_u_pro);
    $("#amount_s4_a_v").val(amount_s4_u_pri);

    $("#amount_d4_a").html(amount_d4_u);
    $("#amount_d4_a_p").val(amount_d4_u_pro);
    $("#amount_d4_a_v").val(amount_d4_u_pri);

    $("#amount_m4_a").html(amount_m4_u);
    $("#amount_m4_a_p").val(amount_m4_u_pro);
    $("#amount_m4_a_v").val(amount_m4_u_pri);

    $("#amount_t4_a").html(amount_t4_u);
    $("#amount_t4_a_p").val(amount_t4_u_pro);
    $("#amount_t4_a_v").val(amount_t4_u_pri);

    console.log('amount_s5_u:'+amount_s5_u);
    $("#amount_s5_a").html(amount_s5_u);
    $("#amount_s5_a_p").val(amount_s5_u_pro);
    $("#amount_s5_a_v").val(amount_s5_u_pri);

    $("#amount_d5_a").html(amount_d5_u);
    $("#amount_d5_a_p").val(amount_d5_u_pro);
    $("#amount_d5_a_v").val(amount_d5_u_pri);

    $("#amount_m5_a").html(amount_m5_u);
    $("#amount_m5_a_p").val(amount_m5_u_pro);
    $("#amount_m5_a_v").val(amount_m5_u_pri);

    $("#amount_t5_a").html(amount_t5_u);
    $("#amount_t5_a_p").val(amount_t5_u_pro);
    $("#amount_t5_a_v").val(amount_t5_u_pri);
    var dias_1=$('#txt_day').val();
    if($('#tipo_plantilla').val()=='si') {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/package/gererar-codigo', 'duracion='+dias_1+'&tipo_plantilla=si&pagina='+$('#txt_pagina').val() , function (data) {
            if(data!='')
            $('#txt_codigo').val(data);
        }).fail(function (data) {
        });
    }
    console.log('dias_1:'+dias_1);
    if(dias_1==1){
        $('#resumen_2_dia').addClass('d-none');
        $('#resumen_1_dia').removeClass('d-none');
        calcular_total_1_dia();
    }
    else if(dias_1>1){
        $('#resumen_2_dia').removeClass('d-none');
        $('#resumen_1_dia').addClass('d-none');
    }
}
function round_2_d(num){
    return Math.round(num * 100) / 100;
}
function calcular_total_1_dia(){
    var costo=round_2_d($('#totalItinerario').val());
    var txt_utilidad=round_2_d($('#txt_utilidad').val());
    var total_venta=round_2_d(costo+txt_utilidad);
    $('#totalItinerario_venta').val(total_venta);
}
function calcular_total_1_dia_tventa(){
    var total=round_2_d($('#totalItinerario_venta').val());
    var iti=round_2_d($('#totalItinerario').val());
    $('#txt_utilidad').val(round_2_d(total-iti));
}
function filtrar_estrellas(){
    if( $('#strellas_2').prop('checked') ) {
        $('#precio_2').removeClass('d-none');
        $('#precio_2').fadeIn();
        $('#precio_2_t').removeClass('d-none');
        $('#precio_2_t').fadeIn();
        $('#precio_t_2').removeClass('d-none');
        $('#precio_t_2').fadeIn();
        $('#precio_d_2').removeClass('d-none');
        $('#precio_d_2').fadeIn();
        $('#precio_s_2').removeClass('d-none');
        $('#precio_s_2').fadeIn();
    }
    else{
        $('#precio_2').addClass('d-none');
        $('#precio_2').fadeOut();
        $('#precio_2_t').addClass('d-none');
        $('#precio_2_t').fadeOut();
        $('#precio_t_2').addClass('d-none');
        $('#precio_t_2').fadeOut();
        $('#precio_d_2').addClass('d-none');
        $('#precio_d_2').fadeOut();
        $('#precio_s_2').addClass('d-none');
        $('#precio_s_2').fadeOut();
    }

    if( $('#strellas_3').prop('checked') ) {
        $('#precio_3').removeClass('d-none');
        $('#precio_3').fadeIn();
        $('#precio_3_t').removeClass('d-none');
        $('#precio_3_t').fadeIn();
        $('#precio_t_3').removeClass('d-none');
        $('#precio_t_3').fadeIn();
        $('#precio_d_3').removeClass('d-none');
        $('#precio_d_3').fadeIn();
        $('#precio_s_3').removeClass('d-none');
        $('#precio_s_3').fadeIn();
    }
    else{
        $('#precio_3').addClass('d-none');
        $('#precio_3').fadeOut();
        $('#precio_3_t').addClass('d-none');
        $('#precio_3_t').fadeOut();
        $('#precio_t_3').addClass('d-none');
        $('#precio_t_3').fadeOut();
        $('#precio_d_3').addClass('d-none');
        $('#precio_d_3').fadeOut();
        $('#precio_s_3').addClass('d-none');
        $('#precio_s_3').fadeOut();
    }

    if( $('#strellas_4').prop('checked') ) {
        $('#precio_4').removeClass('d-none');
        $('#precio_4').fadeIn();
        $('#precio_4_t').removeClass('d-none');
        $('#precio_4_t').fadeIn();
        $('#precio_t_4').removeClass('d-none');
        $('#precio_t_4').fadeIn();
        $('#precio_d_4').removeClass('d-none');
        $('#precio_d_4').fadeIn();
        $('#precio_s_4').removeClass('d-none');
        $('#precio_s_4').fadeIn();
    }
    else{
        $('#precio_4').addClass('d-none');
        $('#precio_4').fadeOut();
        $('#precio_4_t').addClass('d-none');
        $('#precio_4_t').fadeOut();
        $('#precio_t_4').addClass('d-none');
        $('#precio_t_4').fadeOut();
        $('#precio_d_4').addClass('d-none');
        $('#precio_d_4').fadeOut();
        $('#precio_s_4').addClass('d-none');
        $('#precio_s_4').fadeOut();
    }

    if( $('#strellas_5').prop('checked') ) {
        $('#precio_5').removeClass('d-none');
        $('#precio_5').fadeIn();
        $('#precio_5_t').removeClass('d-none');
        $('#precio_5_t').fadeIn();
        $('#precio_t_5').removeClass('d-none');
        $('#precio_t_5').fadeIn();
        $('#precio_d_5').removeClass('d-none');
        $('#precio_d_5').fadeIn();
        $('#precio_s_5').removeClass('d-none');
        $('#precio_s_5').fadeIn();
    }
    else{
        $('#precio_5').addClass('d-none');
        $('#precio_5').fadeOut();
        $('#precio_5_t').addClass('d-none');
        $('#precio_5_t').fadeOut();
        $('#precio_t_5').addClass('d-none');
        $('#precio_t_5').fadeOut();
        $('#precio_d_5').addClass('d-none');
        $('#precio_d_5').fadeOut();
        $('#precio_s_5').addClass('d-none');
        $('#precio_s_5').fadeOut();
    }
}
function ordenar_itinerarios(){
    var nr=1;
    $( ".lista_dias" ).each(function( index ) {
        $( this ).html('Dia '+nr+':');
        nr++;
    });
}
function filtrar_mo_lista(cat){
    // var filtrotito=$('#filtro_localizacion_'+cat).val();
    //
    // $("#tb_"+cat+" tbody tr").each(function (index)
    // {
    //     $(this).children("td").each(function (index2)
    //     {
    //         // if(index2==1){
    //         //     var loca=$(this).text();
    //         //     if(loca!=filtrotito){
    //         //         $('#')
    //         //     }
    //         // }
    //         switch (index2)
    //         {
    //             case 0: console.log($(this).text());
    //                 break;
    //             case 1: console.log($(this).text());
    //                 break;
    //             case 2: console.log($(this).text());
    //                 break;
    //         }
    //         // $(this).css("background-color", "#ECF8E0");
    //     })
    // })
}
function activarPlan(paquete_precio_id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "Esta seguro de elejir este plan",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/activar-package', 'paquete_precio_id='+paquete_precio_id, function(data) {
            if(data==1){
                var $nro_planes=parseInt($('#nro_planes').val());
                for(var $d=0;$d<$nro_planes;$d++){
                    $('#plan_'+$d).prop('onclick',null);
                    $('#plan_'+$d).unbind( "click" );
                }

                $('#plan_'+plan).removeClass('btn-danger');
                $('#plan_'+plan).addClass('btn-success');

            }
            else if(data==2){

            }
        }).fail(function (data) {
        });

    }, function (dismiss) {
        // 'close', and 'timer'
        if (dismiss === 'cancel') {

        }
    })
}
function mostrar_categoria(plan_id){
    var $categoria=$('#categoria').val();
    var $travelers=$('#travelers').val();
    console.log($categoria+'_'+$travelers);

    $('#star_2').addClass('d-none');
    $('#star_3').addClass('d-none');
    $('#star_4').addClass('d-none');
    $('#star_5').addClass('d-none');
    $('#star_'+$categoria).removeClass('d-none');

    $('#pos').val($categoria);
    var s=0;
    var d=0;
    var m=0;
    var t=0;
    var nro=$travelers;
    var acomo_=$('#plan_'+plan_id+'_'+$categoria).val().split('_');
    console.log('acom:'+acomo_);
    if(existe_ar(3, acomo_ )) {
        t = parseInt(nro / 3);
        nro = nro - (3 * t);
        console.log('si hat 3');
    }
    if(existe_ar(2, acomo_ )) {
        d=parseInt(nro/2);
        nro=nro-(2*d);
        console.log('si hat 2');
    }
    if(existe_ar(1, acomo_ )) {
        s=nro;
        console.log('si hat 1');
    }
    console.log('s_:'+s);
    console.log('d_:'+d);
    console.log('m_:'+m);
    console.log('t_:'+t);

    $('#s_'+$categoria).val(s);
    $('#d_'+$categoria).val(d);
    $('#m_'+$categoria).val(m);
    $('#t_'+$categoria).val(t);
    cambios_acom_precios($categoria,plan_id);
}
function cambios_acom_precios($categoria,plan_id){
    var acomo_=$('#plan_'+plan_id+'_'+$categoria).val().split('_');
    var p_s=0;
    var p_d=0;
    var p_m=0;
    var p_t=0;

    var v_s=0;
    var v_d=0;
    var v_m=0;
    var v_t=0;


    if(existe_ar(1, acomo_ )) {
        p_s=$('#hp_s_'+$categoria).html();
        v_s=$('#s_'+$categoria).val();
    }
    if(existe_ar(2, acomo_ )) {
        p_d=$('#hp_d_'+$categoria).html();
        v_d=$('#d_'+$categoria).val();
    }
    if(existe_ar(4, acomo_ )) {
        p_m=$('#hp_m_'+$categoria).html();
        v_m=$('#m_'+$categoria).val();
    }
    if(existe_ar(3, acomo_ )) {
        p_t=$('#hp_t_'+$categoria).html();
        v_t=$('#t_'+$categoria).val();
    }

    console.log('s:'+v_s*p_s);
    console.log('d:'+v_d*p_d);
    console.log('m:'+v_m*p_m);
    console.log('t:'+v_t*p_t);

    $('#p_s_'+$categoria).html(v_s*p_s+'.00');
    $('#p_d_'+$categoria).html(v_d*p_d*2+'.00');
    $('#p_m_'+$categoria).html(v_m*p_m*2+'.00');
    $('#p_t_'+$categoria).html(v_t*p_t*3+'.00');
    $('#detalle_p_s_'+$categoria).html(v_s+' x $'+p_s+' x <i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_d_'+$categoria).html(v_d+' x $'+p_d+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_m_'+$categoria).html(v_m+' x $'+p_m+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_t_'+$categoria).html(v_t+' x $'+p_t+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#total_'+$categoria).html(((v_s*p_s)+(v_d*p_d*2)+(v_m*p_m*2)+(v_t*p_t*3))+'.00');

}
function eliminar_paquete(id,destino) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el paquete "+destino+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/package/delete', 'id='+id, function(data) {
            console.log('data.'+data);
            if(data==1){
                $("#lista_destinos_"+id).fadeOut( "slow");
            }
            else{

            }
        }).fail(function (data) {
        });

    })
}
function mostra_ventas(mes,cat){
    // if(cat=='c') {
        // var =$("#t_ene_c").html()
        $("#t_ene_c").addClass('d-none');
        $("#t_feb_c").addClass('d-none');
        $("#t_mar_c").addClass('d-none');
        $("#t_abr_c").addClass('d-none');
        $("#t_may_c").addClass('d-none');
        $("#t_jun_c").addClass('d-none');
        $("#t_jul_c").addClass('d-none');
        $("#t_ago_c").addClass('d-none');
        $("#t_set_c").addClass('d-none');
        $("#t_oct_c").addClass('d-none');
        $("#t_nov_c").addClass('d-none');
        $("#t_dic_c").addClass('d-none');
        $("#t_"+mes+"_c").removeClass('d-none');
        $("#n_mes_ene_c").removeClass('text-primary');
        $("#n_mes_ene_c").removeClass('text-uppercase');
        $("#n_mes_feb_c").removeClass('text-primary');
        $("#n_mes_feb_c").removeClass('text-uppercase');
        $("#n_mes_mar_c").removeClass('text-primary');
        $("#n_mes_mar_c").removeClass('text-uppercase');
        $("#n_mes_abr_c").removeClass('text-primary');
        $("#n_mes_abr_c").removeClass('text-uppercase');
        $("#n_mes_may_c").removeClass('text-primary');
        $("#n_mes_may_c").removeClass('text-uppercase');
        $("#n_mes_jun_c").removeClass('text-primary');
        $("#n_mes_jun_c").removeClass('text-uppercase');
        $("#n_mes_jul_c").removeClass('text-primary');
        $("#n_mes_jul_c").removeClass('text-uppercase');
        $("#n_mes_ago_c").removeClass('text-primary');
        $("#n_mes_ago_c").removeClass('text-uppercase');
        $("#n_mes_set_c").removeClass('text-primary');
        $("#n_mes_set_c").removeClass('text-uppercase');
        $("#n_mes_oct_c").removeClass('text-primary');
        $("#n_mes_oct_c").removeClass('text-uppercase');
        $("#n_mes_nov_c").removeClass('text-primary');
        $("#n_mes_nov_c").removeClass('text-uppercase');
        $("#n_mes_dic_c").removeClass('text-primary');
        $("#n_mes_dic_c").removeClass('text-uppercase');
        $("#n_mes_"+mes+"_c").addClass('text-primary');
        $("#n_mes_"+mes+"_c").addClass('text-uppercase');

        $("#t_ene_s").addClass('d-none');
        $("#t_feb_s").addClass('d-none');
        $("#t_mar_s").addClass('d-none');
        $("#t_abr_s").addClass('d-none');
        $("#t_may_s").addClass('d-none');
        $("#t_jun_s").addClass('d-none');
        $("#t_jul_s").addClass('d-none');
        $("#t_ago_s").addClass('d-none');
        $("#t_set_s").addClass('d-none');
        $("#t_oct_s").addClass('d-none');
        $("#t_nov_s").addClass('d-none');
        $("#t_dic_s").addClass('d-none');
        $("#t_"+mes+"_s").removeClass('d-none');
        $("#n_mes_ene_s").removeClass('text-primary');
        $("#n_mes_ene_s").removeClass('text-uppercase');
        $("#n_mes_feb_s").removeClass('text-primary');
        $("#n_mes_feb_s").removeClass('text-uppercase');
        $("#n_mes_mar_s").removeClass('text-primary');
        $("#n_mes_mar_s").removeClass('text-uppercase');
        $("#n_mes_abr_s").removeClass('text-primary');
        $("#n_mes_abr_s").removeClass('text-uppercase');
        $("#n_mes_may_s").removeClass('text-primary');
        $("#n_mes_may_s").removeClass('text-uppercase');
        $("#n_mes_jun_s").removeClass('text-primary');
        $("#n_mes_jun_s").removeClass('text-uppercase');
        $("#n_mes_jul_s").removeClass('text-primary');
        $("#n_mes_jul_s").removeClass('text-uppercase');
        $("#n_mes_ago_s").removeClass('text-primary');
        $("#n_mes_ago_s").removeClass('text-uppercase');
        $("#n_mes_set_s").removeClass('text-primary');
        $("#n_mes_set_s").removeClass('text-uppercase');
        $("#n_mes_oct_s").removeClass('text-primary');
        $("#n_mes_oct_s").removeClass('text-uppercase');
        $("#n_mes_nov_s").removeClass('text-primary');
        $("#n_mes_nov_s").removeClass('text-uppercase');
        $("#n_mes_dic_s").removeClass('text-primary');
        $("#n_mes_dic_s").removeClass('text-uppercase');
        $("#n_mes_"+mes+"_s").addClass('text-primary');
        $("#n_mes_"+mes+"_s").addClass('text-uppercase');
}
function existe_ar(valor,arreglo) {
    var o=0;
    var lon=arreglo.length;
    var existe=false;
    while(o<lon && !existe){
        if(arreglo[o]==valor)
            existe=true;
        o++;
    }
    return existe;
}
function categorizar(id,cate) {
    var anio=$('#anio_s').html();
    var texto='';
    if(cate=='C')
        texto='¿Esta seguro de asignar factura para esta venta?';
    else
        texto='¿Esta seguro de no asignar factura para esta venta?';

    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: texto,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/venta/categorizar', 'id='+id+'&&cate='+cate, function(data) {
            // console.log(data);
            if(data==1){
                window.location.href = anio;
            }
        }).fail(function (data) {

        });

    })
}
function confirmar_fecha(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: '¿Esta seguro de confirmar el monto y fecha?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var precio=$('#precio_c_'+id).val();
        var fecha=$('#fecha_pago_'+id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/conciliar-venta', 'id='+id+'&&precio='+precio+'&&fecha='+fecha, function(data) {
            var data1=data.split('_');
            if(data1[0]=='1'){
                $('#servicio_'+id).html('Confirmada');
                $('#servicio_'+id).removeClass('btn-danger');
                $('#servicio_'+id).addClass('btn-success');
                $('#servicio_'+id).off("click");
                $('#servicio_pago_'+id).val(data1[1]);
                pasar_price(id);
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}
function insertar_codigo(id){
    var $codigo=$('#code_'+id).val();
    // console.log($codigo);
}
function calcular_saldo(id){
    var $total=parseFloat($('#total_'+id).html());
    var $serv_acta=parseFloat($('#serv_acta_'+id).val());
    var $saldo=parseFloat($total-$serv_acta);
    console.log('total:'+$total+'_acta:'+$serv_acta+'_saldo:'+$saldo);
    $('#saldo_'+id).val($saldo);

    $('#ifecha_pago_'+id).removeClass('d-none');
    if($saldo==0)
        $('#ifecha_pago_'+id).addClass('d-none');
    else
        $('#ifecha_pago_'+id).removeClass('d-none');

}
function enviar_form(id){
    $('#fo_'+id).submit(function() {
        var prox_fecha=$('#prox_fecha_'+id).val();
        if(!prox_fecha){
            $('#prox_fecha_'+id).focusin();
        }
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#for_'+id).addClass('d-none');

                    $('#result_'+id).removeClass('text-danger');
                    $('#result_'+id).addClass('text-success');
                    $('#result_'+id).html('Pago guardado Correctamente!');
                }
                else{
                    $('#result_'+id).removeClass('text-success');
                    $('#result_'+id).addClass('text-danger');
                    $('#result_'+id).html('Error al pagar, intentelo de nuevo');
                }
            }
        })
        return false;
    });
}
function pasar_price(id){
    $("#serv_acta_"+id).attr({
        "max" : $('#precio_c_'+id).val(),        // substitute your own
    });
    $('#total_'+id).html($('#precio_c_'+id).val());
    $('#itotal_'+id).val($('#precio_c_'+id).val());

}
function mostrar_hoteles(pos) {
    var loca=$('#txt_localizacion_'+pos).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/ventas/hotel/traer-precios', 'loca='+loca, function(data) {
        var data1=data.split('_');
            $('#hotel_id_2').val(data1[0]);
            // $('#S_2').val(data1[1]);
            // $('#D_2').val(data1[2]);
            // $('#M_2').val(data1[3]);
            // $('#T_2').val(data1[4]);
            // $('#SS_2').val(data1[5]);
            // $('#SD_2').val(data1[6]);
            // $('#SU_2').val(data1[7]);
            // $('#JS_2').val(data1[8]);
            $('#hotel_id_3').val(data1[9]);
            // $('#S_3').val(data1[10]);
            // $('#D_3').val(data1[11]);
            // $('#M_3').val(data1[12]);
            // $('#T_3').val(data1[13]);
            // $('#SS_3').val(data1[14]);
            // $('#SD_3').val(data1[15]);
            // $('#SU_3').val(data1[16]);
            // $('#JS_3').val(data1[17]);
            $('#hotel_id_4').val(data1[18]);
            // $('#S_4').val(data1[19]);
            // $('#D_4').val(data1[20]);
            // $('#M_4').val(data1[21]);
            // $('#T_4').val(data1[22]);
            // $('#SS_4').val(data1[23]);
            // $('#SD_4').val(data1[24]);
            // $('#SU_4').val(data1[25]);
            // $('#JS_4').val(data1[26]);
            $('#hotel_id_5').val(data1[27]);
            // $('#S_5').val(data1[28]);
            // $('#D_5').val(data1[29]);
            // $('#M_5').val(data1[30]);
            // $('#T_5').val(data1[31]);
            // $('#SS_5').val(data1[32]);
            // $('#SD_5').val(data1[33]);
            // $('#SU_5').val(data1[34]);
            // $('#JS_5').val(data1[35]);
    }).fail(function (data) {
        console.log(data);
    });
}
function eliminar_servicio_h(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar los precios del hotel?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/hotel/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_h_"+id).fadeOut( "low");
            }
            else if(data==2){
                swal(
                    'Porque no puedo borar?',
                    'Este categoria de hotel esta en uso, solo podra desactivar.',
                    'warning'
                )
            }
        }).fail(function (data) {

        });

    })
}
function Eliminar_cotizacion(id,titulo) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la cotizacion "+titulo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/cotizacion/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#coti_new"+id).fadeOut( "slow");

                $('#content-list-'+id).addClass('d-none');

            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}

function confirmar_fecha_h(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: '¿Esta seguro de confirmar el monto y fecha?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var precio=$('#precio_h_c_'+id).val();
        var fecha=$('#fecha_pago_h_'+id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/conciliar-venta-h', 'id='+id+'&&precio='+precio+'&&fecha='+fecha, function(data) {
            var data1=data.split('_');
            if(data1[0]=='1'){
                $('#servicio_h_'+id).html('Confirmada');
                $('#servicio_h_'+id).removeClass('btn-danger');
                $('#servicio_h_'+id).addClass('btn-success');
                $('#servicio_h_'+id).off("click");
                $('#servicio_pago_h_'+id).val(data1[1]);
                pasar_price_h(id);
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}
function pasar_price_h(id){
    $("#serv_acta_h_"+id).attr({
        "max" : $('#precio_c_h_'+id).val(),        // substitute your own
    });
    $('#total_h_'+id).html($('#precio_c_h_'+id).val());
    $('#itotal_h_'+id).val($('#precio_c_h_'+id).val());

}
function marcar_anio_desde(signo,fecha) {
    fecha=parseInt($('#anio_desde').html());
    if(signo=='+') {
        fecha++;
        $('#anio_desde').html(fecha);
        $('#anio_desde_').val(fecha);
    }
    else{
        fecha--;
        $('#anio_desde').html(fecha);
        $('#anio_desde_').val(fecha);
    }
}
function marcar_mes_desde(mes){
    $('#mes_desde_').val(mes);
    $('#mes_desde_01').addClass('btn-primary');
    $('#mes_desde_01').removeClass('btn-warning');
    $('#mes_desde_02').removeClass('btn-warning');
    $('#mes_desde_03').removeClass('btn-warning');
    $('#mes_desde_04').removeClass('btn-warning');
    $('#mes_desde_05').removeClass('btn-warning');
    $('#mes_desde_06').removeClass('btn-warning');
    $('#mes_desde_07').removeClass('btn-warning');
    $('#mes_desde_08').removeClass('btn-warning');
    $('#mes_desde_09').removeClass('btn-warning');
    $('#mes_desde_10').removeClass('btn-warning');
    $('#mes_desde_11').removeClass('btn-warning');
    $('#mes_desde_12').removeClass('btn-warning');
    $('#mes_desde_'+mes).addClass('btn-warning');
}
function marcar_mes_hasta(mes){
    $('#mes_hasta_').val(mes);
    $('#mes_hasta_01').addClass('btn-primary');
    $('#mes_hasta_01').removeClass('btn-warning');
    $('#mes_hasta_02').removeClass('btn-warning');
    $('#mes_hasta_03').removeClass('btn-warning');
    $('#mes_hasta_04').removeClass('btn-warning');
    $('#mes_hasta_05').removeClass('btn-warning');
    $('#mes_hasta_06').removeClass('btn-warning');
    $('#mes_hasta_07').removeClass('btn-warning');
    $('#mes_hasta_08').removeClass('btn-warning');
    $('#mes_hasta_09').removeClass('btn-warning');
    $('#mes_hasta_10').removeClass('btn-warning');
    $('#mes_hasta_11').removeClass('btn-warning');
    $('#mes_hasta_12').removeClass('btn-warning');
    $('#mes_hasta_'+mes).addClass('btn-warning');
}
function marcar_anio_hasta(signo,fecha) {
    fecha=parseInt($('#anio_hasta').html());
    if(signo=='+') {
        fecha++;
        $('#anio_hasta').html(fecha);
        $('#anio_hasta_').val(fecha);
    }
    else{
        fecha--;
        $('#anio_hasta').html(fecha);
        $('#anio_hasta_').val(fecha);
    }
}
var escojer_consulta1=0;
function escojer_consulta() {
    if(escojer_consulta1==0) {
        $('#lista').fadeOut();

        $('#lista').addClass('d-none');

        $('#custon').fadeIn();
        $('#custon').removeClass('d-none');

        escojer_consulta1=1;
        $('#custon1').html('Lista');
        $('#opcion').val('Custon');
    }
    else{
        $('#custon').fadeOut();
        $('#custon').addClass('d-none');

        $('#lista').fadeIn();
        $('#lista').removeClass('d-none');
        escojer_consulta1=0;
        $('#custon1').html('Custon');
        $('#opcion').val('Lista');
    }
}
var destinos='';
function  filtrar_itinerarios1(){
    var destino1 =$('#desti').val().split('/');

    $.each(destino1,function (index1,value){
        $('#group_destino_'+value).addClass("d-none");
        $('#group_destino_'+value).fadeOut("slow");
    });
    var esta=0;
    destinos='';
    var valorci='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci=$(this).val().split('_');
            console.log('destino escojido:'+valorci[0]);
            destinos+=valorci[0]+'/';
            var destino = $(this).val();
            $('#group_destino_'+valorci[0]).removeClass("d-none");
            $('#group_destino_'+valorci[0]).fadeIn("slow");
        }
    });
    destinos=destinos.substr(0,destinos.length-1);
    filtrar_itinerarios_admin();
}
function existe(clave){
    var existe=false;
    $("input[class='servicios_new']").each(function (index1) {
        if(clave==$(this).val()){
            existe=true;
        }
    });
    return existe;
}
 var total_Itinerarios_camino2=0;
// var Itis_precio=0;
// var nroPasajeros=2;
var lista_itinerarios1='';
function Pasar_datos1(){
    Itis_precio=parseFloat($('#totalItinerario').val());
    total_Itinerarios_camino2=$('#nroItinerario').val();
    var itinerario='';
    $("input[class='itinerario']").each(function (index){
        if($(this).is(':checked')){
            itinerario=$(this).val().split('_');
            if(itinerario[6]==0){
                total_Itinerarios_camino2++;
                var precio_grupo = 0;
                Itis_precio += parseFloat(itinerario[4]);
                console.log('Precios:' + Itis_precio);
                var servicios=itinerario[5].split('*');
                $.each(servicios, function (key, value) {
                    var serv = value.split('//');
                    var val_p_g = parseFloat(serv[1]);
                });
                var servicios = itinerario[5].split('*');
                var iti_temp = '';
                iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '">' +
                    // iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '" value="' + itinerario[0] + '">' +
                    '<div class="content-list-book-s">' +
                    '<a href="#!">' +
                    '<strong>' +
                    // '<input type="hidden" class="servicios_new" name="servicios_new_'+itinerario[0]+'" value="' + itinerario[0] + '">' +
                    '<input type="hidden" class="servicios_new" name="servicios_new_" value="' + itinerario[0] + '">' +
                    '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                    '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                    '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                    '<span class="itinerarios_1 d-none">' + itinerario[5] + '</span>' +
                    '<span class="txt_itinerarios d-none" name="itinerarios1">' + itinerario[0] + '</span>' +
                    '<b class="dias_iti_c2" id="dias_' + total_Itinerarios_camino2 + '">Dia ' + total_Itinerarios_camino2 + ':</b> ' + itinerario[2] +
                    '</strong>' +
                    '<small>' +
                    itinerario[4] + '$' +
                    '</small>' +
                    '</a>' +
                    '<div class="icon">' +
                    ' <a class="text-right" href="#!" onclick="borrar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                '</div>' +
                '</div>' +
                '</li>';
                $('#Lista_itinerario_g').append(iti_temp);
            }
            else{
                if(!existe(itinerario[0])) {
                    total_Itinerarios_camino2++;
                    var precio_grupo = 0;
                    Itis_precio += parseFloat(itinerario[4]);
                    console.log('Precios:' + Itis_precio);
                    var servicios=itinerario[5].split('*');
                    $.each(servicios, function (key, value) {
                        var serv = value.split('//');
                        var val_p_g = parseFloat(serv[1]);
                    });
                    var servicios = itinerario[5].split('*');
                    var iti_temp = '';
                    iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '">' +
                    // iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '" value="' + itinerario[0] + '">' +
                        '<div class="content-list-book-s">' +
                        '<a href="#!">' +
                        '<strong>' +
                        // '<input type="hidden" class="servicios_new" name="servicios_new_'+itinerario[0]+'" value="' + itinerario[0] + '">' +
                        '<input type="hidden" class="servicios_new" name="servicios_new_" value="' + itinerario[0] + '">' +
                        '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                        '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                        '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                        '<span class="itinerarios_1 d-none">' + itinerario[5] + '</span>' +
                        '<span class="txt_itinerarios d-none" name="itinerarios1">' + itinerario[0] + '</span>' +
                        '<b class="dias_iti_c2" id="dias_' + total_Itinerarios_camino2 + '">Dia ' + total_Itinerarios_camino2 + ':</b> ' + itinerario[2] +
                        '</strong>' +
                        '<small>' +
                        itinerario[4] + '$' +
                        '</small>' +
                        '</a>' +
                        '<div class="icon">' +
                        ' <a class="text-right" href="#!" onclick="borrar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                    '</div>' +
                    '</div>' +
                    '</li>';
                    $('#Lista_itinerario_g').append(iti_temp);
                }
            }
        }
    });
    $('#totalItinerario').val(Itis_precio);
    $('#st_new').html(Itis_precio);
    $('#nroItinerario').val(total_Itinerarios_camino2);
    calcular_resumen();
}
function calcular_precio1(){
    var preci_Total=0;
    var total_Itinerarios=$('#nroItinerario').val();
    var servio='';
    var serv='';
    var val_p='';
    var val_p_g='';
        $(".itinerarios_1").each(function (index) {
        servio=$(this).html().split('*');
        console.log('servicio:'+servio);
        $.each(servio, function( key, value ) {
                serv=value.split('//');
                console.log('serr:'+serv[2]);
                val_p=parseFloat(serv[2]);
                // val_p_g=parseInt(serv[3]);

                preci_Total+=val_p;
            });
    });
    var estrel=$('#estrellas_from').val();
    var precio_hotel=0;
    var a_s1=parseInt($('#a_s').val());
    var a_d1=parseInt($('#a_d').val());
    var a_m1=parseInt($('#a_m').val());
    var a_t1=parseInt($('#a_t').val());

    if(estrel=='2'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h2_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h2_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h2_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h2_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='3'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h3_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h3_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h3_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h3_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='4'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h4_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h4_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h4_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h4_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='5'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h5_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h5_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h5_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h5_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    var total=0;
    total=preci_Total+precio_hotel;
    $('#st_new').html(total);
    console.log('precio itinerarios:'+preci_Total);
    console.log('precio hotel:'+precio_hotel);
    console.log('precio total:'+total);
}

function borrar_iti(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar este itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#content-list-'+id).fadeOut();
        $('#content-list-'+id).remove();
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        var valor_temp=parseFloat($('#totalItinerario').val());
        valor_temp=valor_temp-valor;
        $('#totalItinerario').val(valor_temp);
        $('#st_new').html(valor_temp);

        var cont=0;
        $(".dias_iti_c2").each(function (index) {
            cont++;
            $(this).html('Dia '+cont+':');
        });
        console.log('cont:'+cont);
        $('#nroItinerario').val(cont);
    })
}

function ordenar_itinerarios1(){
    var total_Iti=$('#nroItinerario').val();
    var i=1;
    for(i;i<=total_Iti;i++){
        $('#dias_'+i).html(i);
    }
}
function filtrar_estrellas1(estrella){
    $('#estrellas').html(estrella+' STARS');
    $('#estrellas_').html(estrella+' STARS');

    $('#estrellas_from').val(estrella);
    $('#estrellas_from_').val(estrella);

    calcular_precio1();
    filtrar_itinerarios_admin();
}
function comprobar_dist_acom(){
    var total_com=(parseInt($('#a_s_1').val())*1)+(parseInt($('#a_d_1').val())*2)+(parseInt($('#a_m_1').val())*2)+(parseInt($('#a_t_1').val())*3);
    var total_paxs=$('#txt_travellers').val();
    if(total_com>total_paxs){
        swal(
            'Oops...',
            'La configuracion de la acomodacion excede la cantidad de paxs!',
            'error'
        )
    }
    else if(total_com<total_paxs){
        swal(
            'Oops...',
            'La configuracion de la acomodacion es menor a la cantidad de paxs!',
            'error'
        )
    }
}
function aumentar_acom(tipo,signo){

    if(tipo=='s'){
            var valor=$('#a_s_1').val();

            $('#a_s').val(valor);
            $('#a_s_').val(valor);
        console.log('con cambio para s');
    }
    if(tipo=='d'){
            var valor=$('#a_d_1').val();

            $('#a_d').val(valor);
            $('#a_d_').val(valor);
        console.log('con cambio para d');
    }
    if(tipo=='m'){
            var valor=$('#a_m_1').val();
            $('#a_m').val(valor);
            $('#a_m_').val(valor);
        console.log('con cambio para m');
    }
    if(tipo=='t'){
            var valor=$('#a_t_1').val();
            $('#a_t').val(valor);
            $('#a_t_').val(valor);
        console.log('con cambio para t');
    }
    //calcular_precio1();
}
function enviar_form1(){
    $('#form_nuevo_pqt').submit(function() {
        tinymce.triggerSave();
        $('#txt_country1').val($('#txt_country').val());
        $('#txt_name1').val($('#txt_name').val());
        $('#txt_email1').val($('#txt_email').val());
        $('#txt_phone1').val($('#txt_phone').val());
        $('#txt_travelers1').val($('#txt_travellers').val());
        $('#txt_days1').val($('#txt_days').val());
        $('#txt_date1').val($('#txt_travel_date').val());
        $('#web1').val($('#web').val());
        $('#txt_destinos1').val(destinos);
        $('#txt_codigo1').val($('#txt_codigo').val());
        $('#notas1').val($('#txt_notas').val());
        $('#estrellas_from').val($('#hotel').val());
        $('#txt_movilid1').val($('#txt_movilid').val());

        if($('#notas1').val().trim()=='') {
            $('#notas1').focus();
            swal(
                'Oops...',
                'Ingrese alguna nota',
                'error'
            )
            return false;
        }
        if($('#txt_idioma_pasajeros').val()!='SIN IDIOMA') {
            $('#txt_idioma1').val($('#txt_idioma_pasajeros').val());
        }
        if($('#txt_idioma1').val()==''){
            $('#txt_idioma1').focus();
            swal(
                'Oops...',
                'Ingrese el idioma!',
                'error'
            )
            return false;
        }
        if($('#txt_name1').val()==''){
            $('#txt_name1').focus();
            swal(
                'Oops...',
                'Ingrese el nombre!',
                'error'
            )
            return false;
        }
        if($('#txt_country1').val()==''){
            $('#txt_country1').focus();
            swal(
                'Oops...',
                'Ingrese la nacionalidad!',
                'error'
            )
            return false;
        }
        if($('#txt_email1').val()==''){
            $('#txt_email1').focus();
            swal(
                'Oops...',
                'Ingrese el email!',
                'error'
            )
            return false;
        }
        if($('#txt_travelers1').val()==0){
            $('#txt_travelers1').focus();
            swal(
                'Oops...',
                'Ingrese el numero de pasajeros!',
                'error'
            )
            return false;
        }
        if($('#txt_days1').val()==0){
            $('#txt_days1').focus();
            swal(
                'Oops...',
                'Ingrese el umero de dias!',
                'error'
            )
            return false;
        }
        if($('#txt_date1').val()==''){
            $('#txt_date1').focus();
            swal(
                'Oops...',
                'Ingrese la fecha de viaje!',
                'error'
            )
            return false;
        }
        if($('#txt_destinos1').val()==''){
            $('#txt_destinos1').focus();
            swal(
                'Oops...',
                'Escoja los destinos!',
                'error'
            )
            return false;
        }

        var a_s=parseInt($('#a_s').val());
        var a_d=parseInt($('#a_d').val());
        var a_m=parseInt($('#a_m').val());
        var a_t=parseInt($('#a_t').val());
        var hotel=$('#hotel').val();
        var a_total_=a_s+a_d+a_m+a_t;
        if(hotel==0){
            $('#a_s').val(0);
            $('#a_d').val(0);
            $('#a_m').val(0);
            $('#a_t').val(0);
        }
        else{
            if(a_total_==0){
                swal(
                    'Oops...',
                    'Escoja la acomodacion!',
                    'error'
                )
                return false;
            }
        }

        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        if(lista_it==''){
            swal(
                'Oops...',
                'Escoja el itinerario!',
                'error'
            )
            return false;
        }
        // verificamos que las acomodacion y nro de pazx sea el correcto
        var total_com=(parseInt($('#a_s_1').val())*1)+(parseInt($('#a_d_1').val())*2)+(parseInt($('#a_m_1').val())*2)+(parseInt($('#a_t_1').val())*3);
        var total_paxs=$('#txt_travellers').val();
        if(total_com>total_paxs){
            swal(
                'Oops...',
                'La configuracion de la acomodacion excede la cantidad de paxs!',
                'error'
            )
            return false;
        }
        else if(total_com<total_paxs){
            swal(
                'Oops...',
                'La configuracion de la acomodacion es menor a la cantidad de paxs!',
                'error'
            )
            return false;
        }

    });
}

function pasar_dias(){
    var dias=$('#txt_days').val();
    $('#dias_html').html(dias+'d');
}
function poner_dias(web,dias) {
    $('#txt_days1').val($('#txt_days').val());
    $('#dias3').html($('#txt_days').val());
    $('#dias_html').html($('#txt_days').val()+'d');
    $('#dias_html_0').html($('#txt_days').val()+'d');

    //calcular_precio1();
    filtrar_itinerarios_admin();
    comprobar_dist_acom();
    buscar_pqts(web,dias);
}

function variar_profit(acom){
    var dias=$('#dias').val();
    console.log('pqt de :'+dias);
    var valor=parseFloat($('#cost_'+acom).html());
    var pro=parseFloat($('#pro_'+acom).val());
    var sale=valor+pro;
    sale=sale.toFixed(2);
    $('#sale_'+acom).val(sale);
    var profit_por=(pro/sale)*100;
    profit_por=profit_por.toFixed(2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    var sale_s=0;
    var sale_d=0;
    var sale_m=0;
    var sale_t=0;
    var sale_sh=0;

    if(dias>1) {
        sale_s=parseFloat($('#sale_s').val());
        sale_d=parseFloat($('#sale_d').val());
        sale_m=parseFloat($('#sale_m').val());
        sale_t=parseFloat($('#sale_t').val());
    }
    else if(dias==1){
        sale_sh=parseFloat($('#sale_sh').val());
    }

    if(dias>1) {
        $('#total_profit').html((sale_s+ sale_d + sale_m + sale_t).toFixed(2));
    }
    else if(dias==1){
        $('#total_profit').html(sale_sh.toFixed(2));
    }
    var pro_s=parseFloat($('#pro_s').val());
    var pro_d=parseFloat($('#pro_d').val());
    var pro_m=parseFloat($('#pro_m').val());
    var pro_t=parseFloat($('#pro_t').val());
    var pro_sh=parseFloat($('#pro_sh').val());

    var uti_por_s=0;
    var uti_por_d=0;
    var uti_por_m=0;
    var uti_por_t=0;
    var uti_por_sh=0;

    if(dias>1) {
        if (sale_s != 0)
            uti_por_d = Math.round((pro_s / sale_s) * 100, 2);
        if (sale_d != 0)
            uti_por_d = Math.round((pro_d / sale_d) * 100, 2);
        if (sale_m != 0)
            uti_por_m = Math.round((pro_m / sale_m) * 100, 2);
        if (sale_t != 0)
            uti_por_t = Math.round((pro_t / sale_t) * 100, 2);
    }
    else if(dias==1){
        uti_por_sh=Math.round((pro_sh/sale_sh)*100,2);
    }
    console.log('uti_por_s:'+uti_por_s);
    console.log('uti_por_d:'+uti_por_d);
    console.log('uti_por_m:'+uti_por_m);
    console.log('uti_por_t:'+uti_por_t);

    $('#profit_por_s').val(uti_por_s);
    $('#profit_por_d').val(uti_por_d);
    $('#profit_por_m').val(uti_por_m);
    $('#profit_por_t').val(uti_por_t);
    $('#profit_por_sh').val(uti_por_sh);
}
function variar_sales(acom){
    var dias=$('#dias').val();
    var valor=parseFloat($('#cost_'+acom).html());
    var sale=parseFloat($('#sale_'+acom).val());
    var pro=(sale-valor);
    $('#pro_'+acom).val(pro.toFixed(2));
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por.toFixed(2));
    $('#porc_'+acom).val(profit_por.toFixed(2));
    $('#sale_'+acom).val(sale.toFixed(2));

    var sale_s=0;
    var sale_d=0;
    var sale_m=0;
    var sale_t=0;
    var sale_sh=0;
    sale_s=parseFloat($('#sale_s').val());
    sale_d=parseFloat($('#sale_d').val());
    sale_m=parseFloat($('#sale_m').val());
    sale_t=parseFloat($('#sale_t').val());
    var todos_sales=sale_s+ sale_d + sale_m + sale_t;
    if(dias>1) {
        if(todos_sales==0){
            sale_sh=parseFloat($('#sale_sh').val());
        }
    }
    else if(dias==1){
        sale_sh=parseFloat($('#sale_sh').val());
    }

    console.log('dias:'+dias);
    console.log('sale_sh:'+sale_sh);
    console.log('todos_sales:'+todos_sales+':');

    if(dias>1) {
        if(todos_sales==0){
            $('#total_profit').html(sale_sh.toFixed(2));
        }
        else{
            $('#total_profit').html((sale_s+ sale_d + sale_m + sale_t).toFixed(2));
        }
    }
    else if(dias==1){
        $('#total_profit').html(sale_sh.toFixed(2));

    }
    var pro_s = parseFloat($('#pro_s').val());
    var pro_d = parseFloat($('#pro_d').val());
    var pro_m = parseFloat($('#pro_m').val());
    var pro_t = parseFloat($('#pro_t').val());
    var pro_sh = parseFloat($('#pro_sh').val());

    var uti_por_s=0;
    var uti_por_d=0;
    var uti_por_m=0;
    var uti_por_t=0;
    var uti_por_sh=0;

    if(dias>1){
        if(sale_s==0 && sale_d==0 && sale_m==0 && sale_t==0){
            uti_por_sh=Math.round((pro_sh/sale_sh)*100,2);
            $('#profit_por_sh').val(uti_por_sh);
        }
        else{
            if (sale_s != 0)
                uti_por_d = Math.round((pro_s / sale_s) * 100, 2);
            if (sale_d != 0)
                uti_por_d = Math.round((pro_d / sale_d) * 100, 2);
            if (sale_m != 0)
                uti_por_m = Math.round((pro_m / sale_m) * 100, 2);
            if (sale_t != 0)
                uti_por_t = Math.round((pro_t / sale_t) * 100, 2);

            $('#profit_por_s').val(uti_por_s);
            $('#profit_por_d').val(uti_por_d);
            $('#profit_por_m').val(uti_por_m);
            $('#profit_por_t').val(uti_por_t);
        }
    }
    else if(dias==1){
        uti_por_sh=Math.round((pro_sh/sale_sh)*100,2);
        $('#profit_por_sh').val(uti_por_sh);
    }
    // console.log('uti_por_s:'+uti_por_s);
    // console.log('uti_por_d:'+uti_por_d);
    // console.log('uti_por_m:'+uti_por_m);
    // console.log('uti_por_t:'+uti_por_t);


}

function filtrar_itinerarios_(){
    var dias_f=$('#txt_days').val();
    var estrellas=$('#estrellas_from').val();
    var desti_f='';
    var valorci1='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci1=$(this).val().split('_');
            desti_f+=valorci1[1]+'/';
        }
    });
    desti_f=desti_f.substr(0,desti_f.length-1);
    var pos=1;
    $("input[class='lista_itinerarios3']").each(function (index) {
        for(var i=2;i<=5;i++){
            $('#itinerario3_'+i+'_'+pos).addClass('d-none');
            pos++;
        }
    });
    var pqt='';
    var pos1=1;
    $("input[class='lista_itinerarios3']").each(function (index) {
        pqt='';
        pqt=$(this).val().split('_');
        if(dias_f==pqt[1]){
            if(coinciden(desti_f,pqt[2])){
                console.log('coinciden E:'+desti_f+' O:'+pqt[2]);
                $('#itinerario3_'+estrellas+'_'+pos1).removeClass("d-none");
            }
        }
        pos1++;
    });
}
function coinciden(escojidos,ofertados) {
    ofertados=ofertados.split('/');
    escojidos=escojidos.split('/');
    var p=0;
    for(var i=0;i<escojidos.length;i++) {
        if(ofertados.indexOf(escojidos[i])>=0)
            p++;
    }
    if(p==escojidos.length)
        return true;
    else
        return false;
}
function filtrar_itinerarios_admin(){
    $('#caja_load').removeClass("d-none");
    filtrar_itinerarios_();
    setTimeout(function(){
        $('#caja_load').addClass("d-none");
    }, 3000);
}
var paquete_id_21=0;
function mostrar_datos(cadena) {
    var datos_pqt=cadena.split('_');
    $('#pqt_id').val(datos_pqt[0]);
    paquete_id_21=datos_pqt[3];
    sumar_servicios_itinerario(datos_pqt[3]);
}
function calcular_sumar_servicios(paxs){
    var resto=paxs;
    var t=0;
    var m=0;
    var d=0;
    var s=0;
    if(paxs==6){
        t=0;
        m=0;
        d=3;
        s=0;
    }
    else if(paxs==8){
        t=0;
        m=0;
        d=4;
        s=0;
    }
    else {
        if (resto > 0) {
            t = parseInt(resto / 3);
            resto = resto % 3;
        }
        if (resto > 0) {
            d = parseInt(resto / 2);
            resto = resto % 2;
        }
        if (resto > 0) {
            s = parseInt(resto / 1);
            resto = resto % 1;
        }
    }
    $('#a_s_1').min = 0;
    $('#a_s_1').max = paxs/1;
    $('#a_s_1').val(s);

    $('#a_d_1').min = 0;
    $('#a_d_1').max = paxs/2;
    $('#a_d_1').val(d);

    $('#a_m_1').min = 0;
    $('#a_m_1').max = paxs/2;
    $('#a_m_1').val('0');

    $('#a_t_1').min = 0;
    $('#a_t_1').max = t;
    $('#a_t_1').val(t);
    sumar_servicios_itinerario(paquete_id_21);
    aumentar_acom('s');
    aumentar_acom('d');
    aumentar_acom('m');
    aumentar_acom('t');


}
function validar_envio(){
    console.log('hola ');
    $('#generar_plantilla').submit(function() {

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then(function () {
            if (true) {
            $('#generar_plantilla').submit(function() {
              return true;
            });

        } else if (resultado.dismiss === 'cancel') {
            return false;
        }
    })
        return false;
    });
}
function enviar_form2(){

    $('#form_nuevo_pqt_').submit(function() {
        tinymce.triggerSave();
        $('#txt_country1_').val($('#txt_country').val());
        $('#txt_name1_').val($('#txt_name').val());
        $('#txt_email1_').val($('#txt_email').val());
        $('#txt_phone1_').val($('#txt_phone').val());
        $('#txt_travelers1_').val($('#txt_travellers').val());
        $('#txt_days1_').val($('#txt_days').val());
        $('#txt_date1_').val($('#txt_travel_date').val());
        $('#web_').val($('#web').val());
        $('#txt_destinos1_').val(destinos);
        $('#codigo_').val($('#txt_codigo').val());
        $('#notas_').val($('#txt_notas').val());
        $('#estrellas_from_').val($('#hotel').val());
        $('#txt_movilid2').val($('#txt_movilid').val());

        if($('#notas_').val().trim()==''){
            $('#notas_').focus();
            swal(
                'Oops...',
                'Ingrese alguna nota',
                'error'
            )
            return false;
        }
        if($('#txt_idioma_pasajeros').val()!='SIN IDIOMA') {
            $('#txt_idioma2').val($('#txt_idioma_pasajeros').val());
        }
        if($('#txt_idioma2').val()==''){
            $('#txt_idioma2').focus();
            swal(
                'Oops...',
                'Ingrese el idioma!',
                'error'
            )
            return false;
        }
        if($('#txt_name1_').val()==''){
            $('#txt_name1_').focus();
            swal(
                'Oops...',
                'Ingrese el nombre!',
                'error'
            )
            return false;
        }
        if($('#txt_country1_').val()==''){
            $('#txt_country1_').focus();
            swal(
                'Oops...',
                'Ingrese la nacionalidad!',
                'error'
            )
            return false;
        }
        if($('#txt_email1_').val()==''){
            $('#txt_email1_').focus();
            swal(
                'Oops...',
                'Ingrese el email!',
                'error'
            )
            return false;
        }
        // if($('#txt_phone1_').val()==''){
        //     $('#txt_phone1_').focus();
        //     swal(
        //         'Oops...',
        //         'Ingrese el telefono!',
        //         'error'
        //     )
        //     return false;
        // }
        if($('#txt_travelers1_').val()==0){
            $('#txt_travelers1_').focus();
            swal(
                'Oops...',
                'Ingrese el numero de pasajeros!',
                'error'
            )
            return false;
        }
        if($('#txt_days1_').val()==0){
            $('#txt_days1_').focus();
            swal(
                'Oops...',
                'Ingrese el umero de dias!',
                'error'
            )
            return false;
        }
        if($('#txt_date1_').val()==''){
            $('#txt_date1_').focus();
            swal(
                'Oops...',
                'Ingrese la fecha de viaje!',
                'error'
            )
            return false;
        }
        if($('#txt_destinos1_').val()==''){
            $('#txt_destinos1_').focus();
            swal(
                'Oops...',
                'Escoja los destinos!',
                'error'
            )
            return false;
        }

        var a_s_=parseInt($('#a_s_').val());
        var a_d_=parseInt($('#a_d_').val());
        var a_m_=parseInt($('#a_m_').val());
        var a_t_=parseInt($('#a_t_').val());
        var hotel=$('#hotel').val();
        var a_total=a_s_+a_d_+a_m_+a_t_;
        if(hotel==0){
            $('#a_s_').val(0);
            $('#a_d_').val(0);
            $('#a_m_').val(0);
            $('#a_t_').val(0);
        }
        else{
            if(a_total==0){
                swal(
                    'Oops...',
                    'Escoja la acomodacion!',
                    'error'
                )
                return false;
            }
        }


        var pqt_id=parseInt($('#pqt_id').val());
        if(pqt_id==0) {
            swal(
                'Oops...',
                'Escoja el paquete!',
                'error'
            )
            return false;
        }

        // verificamos que las acomodacion y nro de pazx sea el correcto

        var total_com=(parseInt($('#a_s_1').val())*1)+(parseInt($('#a_d_1').val())*2)+(parseInt($('#a_m_1').val())*2)+(parseInt($('#a_t_1').val())*3);
        var total_paxs=$('#txt_travellers').val();
        if(total_com>total_paxs){
            swal(
                'Oops...',
                'La configuracion de la acomodacion excede la cantidad de paxs!',
                'error'
            )
            return false;
        }
        else if(total_com<total_paxs){
            swal(
                'Oops...',
                'La configuracion de la acomodacion es menor a la cantidad de paxs!',
                'error'
            )
            return false;
        }
    });
}

function borrar_serv_quot_paso1(id,servicio){
    var cost_s_serv_e_s=$('#cost_s_serv_e_s').val();
    var cost_d_serv_e_s=$('#cost_d_serv_e_s').val();
    var cost_m_serv_e_s=$('#cost_m_serv_e_s').val();
    var cost_t_serv_e_s=$('#cost_t_serv_e_s').val();
    var cost_sh_serv_e_s=$('#cost_sh_serv_e_s').val();

    var pv_s_serv_e_s=$('#pv_s_serv_e_s').val();
    var pv_d_serv_e_s=$('#pv_d_serv_e_s').val();
    var pv_m_serv_e_s=$('#pv_m_serv_e_s').val();
    var pv_t_serv_e_s=$('#pv_t_serv_e_s').val();
    var pv_sh_serv_e_s=$('#pv_sh_serv_e_s').val();

    var con_sin_hotel_e_s=$('#con_sin_hotel_e_s').val();
    var acomodacion_hotel_e_s=$('#acomodacion_hotel_e_s').val();
    var cotizacion_id=$('#cotizacion_id').val();

    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/quotes/servicio/delete', 'id='+id+'&cost_s_serv_e_s='+cost_s_serv_e_s+'&cost_d_serv_e_s='+cost_d_serv_e_s+'&cost_m_serv_e_s='+cost_m_serv_e_s+'&cost_t_serv_e_s='+cost_t_serv_e_s+'&cost_sh_serv_e_s='+cost_sh_serv_e_s+'&pv_s_serv_e_s='+pv_s_serv_e_s+'&pv_d_serv_e_s='+pv_d_serv_e_s+'&pv_m_serv_e_s='+pv_m_serv_e_s+'&pv_t_serv_e_s='+pv_t_serv_e_s+'&pv_sh_serv_e_s='+pv_sh_serv_e_s+'&con_sin_hotel_e_s='+con_sin_hotel_e_s+'&acomodacion_hotel_e_s='+acomodacion_hotel_e_s+'&cotizacion_id='+cotizacion_id, function(data) {

            console.log(data.mensaje);
            if(data.mensaje==1){
                // $("#lista_servicios_"+id).fadeOut( "slow");
                // $("#lista_servicios_"+id).remove();
                // calcularPrecio();
                window.location.reload();
            }
        }).fail(function (data) {

        });

    })

}

function borrar_hotel_quot_paso1(id,dia){
    // alert('hola');
    var cost_s_serv_e_s=$('#cost_s_serv_e_s').val();
    var cost_d_serv_e_s=$('#cost_d_serv_e_s').val();
    var cost_m_serv_e_s=$('#cost_m_serv_e_s').val();
    var cost_t_serv_e_s=$('#cost_t_serv_e_s').val();
    var cost_sh_serv_e_s=$('#cost_sh_serv_e_s').val();

    var pv_s_serv_e_s=$('#pv_s_serv_e_s').val();
    var pv_d_serv_e_s=$('#pv_d_serv_e_s').val();
    var pv_m_serv_e_s=$('#pv_m_serv_e_s').val();
    var pv_t_serv_e_s=$('#pv_t_serv_e_s').val();
    var pv_sh_serv_e_s=$('#pv_sh_serv_e_s').val();

    var con_sin_hotel_e_s=$('#con_sin_hotel_e_s').val();
    var acomodacion_hotel_e_s=$('#acomodacion_hotel_e_s').val();
    var cotizacion_id=$('#cotizacion_id').val();

    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el hotel para el "+dia+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/quotes/hotel/delete', 'id='+id+'&cost_s_serv_e_s='+cost_s_serv_e_s+'&cost_d_serv_e_s='+cost_d_serv_e_s+'&cost_m_serv_e_s='+cost_m_serv_e_s+'&cost_t_serv_e_s='+cost_t_serv_e_s+'&cost_sh_serv_e_s='+cost_sh_serv_e_s+'&pv_s_serv_e_s='+pv_s_serv_e_s+'&pv_d_serv_e_s='+pv_d_serv_e_s+'&pv_m_serv_e_s='+pv_m_serv_e_s+'&pv_t_serv_e_s='+pv_t_serv_e_s+'&pv_sh_serv_e_s='+pv_sh_serv_e_s+'&con_sin_hotel_e_s='+con_sin_hotel_e_s+'&acomodacion_hotel_e_s='+acomodacion_hotel_e_s+'&cotizacion_id='+cotizacion_id, function(data) {

            console.log(data.mensaje);
            if(data.mensaje==1){
                // $("#lista_servicios_"+id).fadeOut( "slow");
                // $("#lista_servicios_"+id).remove();
                // calcularPrecio();
                window.location.reload();
            }
        }).fail(function (data) {

        });

    })

}

function calcularPrecio(){
    var total_serv_s=0;
    var total_serv_d=0;
    var total_serv_t=0;
    var total_serv_sh=0;
    console.log('precio_servicio_s:');
    $("input[class='precio_servicio_s']").each(function (index) {
        total_serv_s+=parseFloat($(this).val());
        console.log('precio_servicio_s:'+$(this).val());
    });
    $("input[class='precio_servicio_s_h']").each(function (index) {
        total_serv_s+=parseFloat($(this).val());
        console.log('precio_servicio_s_h:'+$(this).val());
    });
    console.log('total_serv_s:'+total_serv_s);
    $("input[class='precio_servicio_d']").each(function (index) {
        total_serv_d+=parseFloat($(this).val());
        console.log('precio_servicio_d:'+$(this).val());
    });
    $("input[class='precio_servicio_d_h']").each(function (index) {
        total_serv_d+=parseFloat($(this).val());
        console.log('precio_servicio_d_h:'+$(this).val());
    });
    console.log('total_serv_d:'+total_serv_d);
    $("input[class='precio_servicio_t']").each(function (index) {
        total_serv_t+=parseFloat($(this).val());
        console.log('precio_servicio_t:'+$(this).val());
    });
    $("input[class='precio_servicio_t_h']").each(function (index) {
        total_serv_t+=parseFloat($(this).val());
        console.log('precio_servicio_t:'+$(this).val());
    });
    $("input[class='precio_servicio_sh']").each(function (index) {
        total_serv_sh+=parseFloat($(this).val());
        console.log('precio_servicio_t:'+$(this).val());
    });
    total_serv_s=total_serv_s.toFixed(2);
    total_serv_d=total_serv_d.toFixed(2);
    total_serv_t=total_serv_t.toFixed(2);
    total_serv_sh=total_serv_sh.toFixed(2);
    $("#cost_s").html(total_serv_s);
    $("#cost_d").html(total_serv_d);
    $("#cost_t").html(total_serv_t);
    $("#cost_sh").html(total_serv_sh);
}

function sumar_servicios_itinerario(pqt_pos){
    var traveles=0;
    traveles=$('#txt_travellers').val();
    if(traveles<=0){
        swal(
            'Upps!',
            'Ingrese el nro de pasajeros!',
            'danger'
        )
        $('#pqt_'+pqt_pos).prop('checked', false);
        return false;
    }
    var icon_human='';
    icon_human='<i class="fa fa-male fa-2x" aria-hidden="true"></i> x '+traveles;
    $('#human').html(icon_human);
    console.log('hola');
    var pqt=$('#pqt_id').val();
    var arreglo='';
    var valorcito=$('#lista_servicios_'+pqt_pos).val();
    console.log('valorcito:'+valorcito);
    if(valorcito){
        arreglo = valorcito.split('/');
    }
    var dat='';
    var suma=0;


    console.log('traveles:'+traveles);
    console.log('servicios:'+arreglo);

    $.each(arreglo, function( key, value ) {
        dat=value.split('_');

        if(dat[1]=='g'){
            suma+=Math.round((parseFloat(dat[0])/traveles)*10)/10;
            console.log('v:'+Math.round((parseFloat(dat[0])/traveles)*10)/10);
        }
        else if(dat[1]=='i'){
            suma+=Math.round(parseFloat(dat[0])*10)/10;
            console.log('v:'+Math.round(parseFloat(dat[0])*10)/10);
        }

    });
    console.log('suma:'+suma);
    suma=Math.ceil(suma);
    $('#precio_plantilla').html(suma);
}

function MostrarDatos(){
    var datos=$('#txt_name').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/cliente/mostrar', 'id='+datos, function(data) {
        console.log(data);
        var dat=data.split('_');
        console.log(dat);
        if(dat[0]==1){
            $("#txt_country").val(dat[1]);
            $("#txt_email").val(dat[2]);
            $("#txt_phone").val(dat[3]);
            $("#txt_travellers").val(dat[4]);
            $("#txt_days").val(dat[5]);
            $("#txt_travel_date").val(dat[6]);
            $("#cotizacion_id_").val(dat[7]);
            $("#cliente_id_").val(dat[8]);
            $("#plan").val('1');
        }
    }).fail(function (data) {
    });
}
function runScript(event) {
    if (event.which == 13 || event.keyCode == 13) {
        console.log('se presiono enter');
        MostrarDatos();
        // var tb = document.getElementById("scriptBox");
        // eval(tb.value);
        // return false;
    }
}

function escojer_pqt(id) {
    console.log(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/pqt/escojer', 'id='+id, function(data) {

    }).fail(function (data) {
    });
}

function mostrar_tabla_destino(grupo,id){
    var destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    console.log('hola freddy');
    $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&filtro=normal', function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
        console.log(data);
    });
}

function escojerPos_edit(daybyday,pos,cate) {
    $("#posTipo").val(pos);
    mostrar_pivot_edit(daybyday,cate);
}
function mostrar_pivot_edit(daybyday,cate){
    console.log('Escojiste:'+cate);
    $("#t_edit_"+daybyday+"_TOURS").addClass('d-none');
    $("#t_edit_"+daybyday+"_MOVILID").addClass('d-none');
    $("#t_edit_"+daybyday+"_REPRESENT").addClass('d-none');
    $("#t_edit_"+daybyday+"_ENTRANCES").addClass('d-none');
    $("#t_edit_"+daybyday+"_FOOD").addClass('d-none');
    $("#t_edit_"+daybyday+"_TRAINS").addClass('d-none');
    $("#t_edit_"+daybyday+"_FLIGHTS").addClass('d-none');
    $("#t_edit_"+daybyday+"_OTHERS").addClass('d-none');
    $("#t_edit_"+daybyday+"_"+cate).removeClass('d-none');
}

function guardar_obs_servicio(id){
    var obs_=$("#obs_"+id).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/operaciones/observacion', 'obs='+obs_+'&id='+id, function(data) {
        $("#rpt_"+id).html(data);
        if(data=='1'){
            $("#rpt_"+id).removeClass('text-danger');
            $("#rpt_"+id).removeClass('text-success');
            $("#rpt_"+id).addClass('text-success');
            $("#rpt_"+id).html('Observacion guardada correctamente!');
        }
        else{
            $("#rpt_"+id).removeClass('text-danger');
            $("#rpt_"+id).removeClass('text-success');
            $("#rpt_"+id).addClass('text-danger');
            $("#rpt_"+id).html('Error al guardar la observacion, intentelo de nuevo!');
        }

    }).fail(function (data) {
    });
}

function CierraPopup(id) {
    $("#myModal_serv"+id).modal('d-none');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove();//eliminamos el backdrop del modal
}
function segunda_confirmada(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de reconfirmar este servicio?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var confi2_v_=$("#confi2_v_"+id).val();
        console.log('hola:'+confi2_v_);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../admin/operaciones/segunda-confirmada', 'confi2='+confi2_v_+'&id='+id, function(data) {
            $("#rpt_"+id).html(data);
            if(data=='1'){
                if(confi2_v_=='1'){
                    $("#confi2_"+id).removeClass('text-grey-goto');
                    $("#confi2_"+id).removeClass('text-success');
                    $("#confi2_"+id).addClass('text-success');
                    $("#confi2_v_"+id).val('0');
                }
                else if(confi2_v_=='0') {
                    $("#confi2_" + id).removeClass('text-grey-goto');
                    $("#confi2_" + id).removeClass('text-success');
                    $("#confi2_" + id).addClass('text-grey-goto');
                    $("#confi2_v_" + id).val('1');
                }
            }

        }).fail(function (data) {
        });

    })


}
function segunda_confirmada_hotel(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar los cambios?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var confi2_v_=$("#confi2_v_h_"+id).val();
        console.log('hola:'+confi2_v_);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../admin/operaciones/segunda-confirmada-hotel', 'confi2='+confi2_v_+'&id='+id, function(data) {
            $("#rpt_"+id).html(data);
            if(data=='1'){
                if(confi2_v_=='1'){
                    $("#confi2_h_"+id).removeClass('text-grey-goto');
                    $("#confi2_h_"+id).removeClass('text-success');
                    $("#confi2_h_"+id).addClass('text-success');
                    $("#confi2_v_h_"+id).val('0');
                }
                else if(confi2_v_=='0') {
                    $("#confi2_h_" + id).removeClass('text-grey-goto');
                    $("#confi2_h_" + id).removeClass('text-success');
                    $("#confi2_h_" + id).addClass('text-grey-goto');
                    $("#confi2_v_h_" + id).val('1');
                }
            }

        }).fail(function (data) {
        });
    })
}

// function guardar_imagen_pago(){
//     $('#guardar_imagen_pago').submit(function() {
//
//         // Enviamos el formulario usando AJAX
//         $.ajax({
//             type: 'POST',
//             url: $(this).attr('action'),
//             data: $(this).serialize(),
//             // Mostramos un mensaje con la respuesta de PHP
//             success: function(data) {
//                 if(data==1){
//                     $('#result_'+id).removeClass('text-danger');
//                     $('#result_'+id).addClass('text-success');
//                     $('#result_'+id).html('imagen guardada Correctamente!');
//                 }
//                 else{
//                     $('#result_'+id).removeClass('text-success');
//                     $('#result_'+id).addClass('text-danger');
//                     $('#result_'+id).html('Error al guardar la imagen, intentelo de nuevo');
//                 }
//             }
//         })
//         // esto es para que no se reenvie el formulario
//         return false;
//     });
// }

function eliminar_hotel_pro(hotel,id) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar los precios para el hotel "+hotel+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/cost/hotel/proveedor/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#h_p_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function Enviar_codigo_reserva(id) {
    $('#add_cod_verif_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_'+id).removeClass('btn-primary');
                    $('#btn_'+id).addClass('btn-warning');
                    $('#btn_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    // swal(
                    //     'MENSAJE DEL SISTEMA',
                    //     'Codigo guardado correctamente',
                    //     'success'
                    // )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar el codigo',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_codigo_reserva_hotel(id) {
    $('#add_cod_verif_hotel_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_h_'+id).removeClass('btn-primary');
                    $('#btn_h_'+id).addClass('btn-warning');
                    $('#btn_h_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    // swal(
                    //     'MENSAJE DEL SISTEMA',
                    //     'Codigo guardada correctamente',
                    //     'success'
                    // )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar el codigo',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_hora_reserva(id) {
    $('#add_time_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_hora_'+id).removeClass('btn-primary');
                    $('#btn_hora_'+id).addClass('btn-warning');
                    $('#btn_hora_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    // swal(
                    //     'MENSAJE DEL SISTEMA',
                    //     'Hora guardada correctamente',
                    //     'success'
                    // )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error, la hora no tiene el formato correcto "hh:mm"',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_hora_reserva_hotel(id) {
    $('#add_hora_hotel_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_hora_h_'+id).removeClass('btn-primary');
                    $('#btn_hora_h_'+id).addClass('btn-warning');
                    $('#btn_hora_h_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    // swal(
                    //     'MENSAJE DEL SISTEMA',
                    //     'Hora guardado correctamente',
                    //     'success'
                    // )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error, la hora no tiene el formato correcto "hh:mm"',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function mostrar_barra_avance(){



    var $nro_servicios_reservados=$('#nro_servicios_reservados').val();
    var $nro_servicios_total=$('#nro_servicios_total').val();

    var $porc_avance=parseFloat(parseInt($nro_servicios_reservados)/parseInt($nro_servicios_total)).toFixed(2);
    var $porc_avance=$porc_avance*100;
    var $colo_progres='progress-bar-danger';
    if(25<$porc_avance&&$porc_avance<=50)
        $colo_progres='progress-bar-warning';

    if(50<$porc_avance&&$porc_avance<=75)
        $colo_progres='progress-bar-info';

    if(50<$porc_avance&&$porc_avance<=100)
        $colo_progres='progress-bar-success';

    $('#barra_porc').removeClass('progress-bar-danger');
    $('#barra_porc').removeClass('progress-bar-warning');
    $('#barra_porc').removeClass('progress-bar-info');
    $('#barra_porc').removeClass('progress-bar-success');

    console.log('nro_servicios_reservados:'+$nro_servicios_reservados+'-'+'nro_servicios_total:'+$nro_servicios_total);
    console.log('$colo_progres:'+$colo_progres+'-'+'porc_avance:'+$porc_avance);

    $('#barra_porc').addClass($colo_progres);
    $('#barra_porc').attr('aria-valuenow', $porc_avance).css('width',$porc_avance+'%');
    $('#barra_porc').html($porc_avance+'%');

}
var dato_producto_id=0;

function Guardar_proveedor_costo(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var justi=$('#txt_justificacion_'+id).val();
    if(justi.trim()==''){
        $('#rpt_book_proveedor_costo_'+id).html('Ingrese su justificacion');
        return false;
    }
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_costo_path_'+id).attr('action'),
        data: $('#asignar_proveedor_costo_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data){
            if(data==1){
                $('#rpt_book_proveedor_costo_'+id).html('Costo editado correctamente!');
                $('#costo_servicio_'+id).html('$'+$('#book_price_edit_'+id).val());

                // prove=$('#proveedor_servicio_'+dato_producto_id).val();
                // $('#boton_prove_'+id).html('<i class="fa fa-edit"></i>');
                // // $('#boton_prove_'+id).removeClass('btn-primary');
                // // $('#boton_prove_'+id).addClass('btn-warning');
                // $('#book_proveedor_'+id).html(prove);
                // $('#book_proveedor_'+id).fadeIn();
                // $('#estado_proveedor_serv_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                // $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                // mostrar_barra_avance();
            }
            else{
                $('#rpt_book_proveedor_'+id).removeClass('text-success');
                $('#rpt_book_proveedor_'+id).addClass('text-danger');
                $('#rpt_book_proveedor_'+id).html('Error al asignar al proveedor!');
            }
        }
    })
    return false;
    // });
}
function dato_producto(valor,proveedor_id,id,itinerario_id){
    dato_producto_id=valor;
    console.log('valor:'+valor);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../book/traer-fecha-pago',
        data: 'id='+proveedor_id+'&itinerario_id='+itinerario_id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#lista_servicios_asignados_'+id).html('');
            $('#rpt_book_proveedor_fecha_'+id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data) {
            $('#rpt_book_proveedor_fecha_'+id).html(data.fecha);
            $('#lista_servicios_asignados_'+id).html(data.asignados);
        }
    })
}
function Guardar_proveedor(id,url,csrf_field,id_pro) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    if(id_pro>0)
        dato_producto_id=id_pro;
    var csrf='<input type="hidden" name="_token" value="'+csrf_field+'">';
    var field_id='<input type="hidden" name="id" value="'+id+'">';
    var prove='';
    console.log('id_pro:'+id_pro+',dato_producto_id:'+dato_producto_id);
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_path_'+id).attr('action'),
        data: $('#asignar_proveedor_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function() {
            $('#rpt_book_proveedor_'+id).html('');
            $('#rpt_book_proveedor_'+id).html('<i class="fas fa-stroopwafel fa-spin fa-3x"></i>');
        },
        success: function(data) {
            console.log('data:'+data);
            if(data==1){
                var precio_pro=$('#book_price_'+dato_producto_id).val();
                console.log('precio:'+precio_pro+', dato_producto_id:'+dato_producto_id);
                $('#rpt_book_proveedor_'+id).html('Proveedor asignado correctamente!');
                var popup='<a href="#!" id="boton_prove_costo_'+id+'" data-toggle="modal" data-target="#myModal_costo_'+id+'">'+
                    '<i class="fa fa-edit"></i>'+
                    '</a>'+
                    '<div class="modal fade" id="myModal_costo_'+id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
                    '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<form id="asignar_proveedor_costo_path_'+id+'" action="'+url+'" method="post">'+
                '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h4 class="modal-title" id="myModalLabel">'+
                'Editar Costo</h4>'+
                '</div>'+
                '<div class="modal-body clearfix">'+
                '<div class="col-md-12">'+
                '<div class="form-group col-md-3">'+
                '<label for="txt_name">Costo actual</label>'+
                '<input type="number" class="form-control" id="book_price_edit_'+id+'" name="txt_costo_edit" value="'+precio_pro+'">'+
                '</div>'+
                '<div class="form-group col-md-9">'+
                '<label for="txt_name">Justificacion</label>'+
                '<input type="text" class="form-control" id="txt_justificacion_'+id+'" name="txt_justificacion" value="">'+
                '</div>'+

                '</div>'+
                '<div class="col-md-12">'+
                '<b id="rpt_book_proveedor_costo_'+id+'" class="text-success text-14"></b>'+
                '</div>'+
                '</div>'+
                '<div class="modal-footer">'+field_id+csrf+
                '<button type="button" class="btn btn-primary" onclick="Guardar_proveedor_costo('+id+')">Guardar cambios</button>'+
                '</div>'+
                '</form>'+
                '</div>'+
                '</div>'+
                '</div>';

                $('#book_precio_asig_'+id).html('<span id="costo_servicio_'+id+'">$'+precio_pro+'</span>');
                $('#book_precio_asig_'+id).append(popup);
                prove=$('#proveedor_servicio_'+dato_producto_id).val();
                $('#boton_prove_'+id).html('<i class="fa fa-edit"></i>');
                // $('#boton_prove_'+id).removeClass('btn-primary');
                // $('#boton_prove_'+id).addClass('btn-warning');
                $('#book_proveedor_'+id).html(prove);
                $('#book_proveedor_'+id).fadeIn();
                $('#estado_proveedor_serv_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                $('#boton_prove_borrar_'+id).removeClass('d-none');
                mostrar_barra_avance();
            }
            else{
                $('#rpt_book_proveedor_'+id).removeClass('text-success');
                $('#rpt_book_proveedor_'+id).addClass('text-danger');
                $('#rpt_book_proveedor_'+id).html('Error al asignar al proveedor!');
            }
        }
    })
    return false;
    // });
}

var dato_producto_hotel_id=0;
function Guardar_proveedor_hotel_costo(id,s,d,m,t) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_hotel_costo_path_'+id).attr('action'),
        data: $('#asignar_proveedor_hotel_costo_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                $('#rpt_precio_proveedor_hotel_'+id).html('Precio editado correctamente!');
                // if(parseInt(s)>0)
                //     $('book_price_edit_h_s_'+id).html('$'+$('book_price_edit_h_s_p_'+id).val());

                // var precio_pro_s=$('#book_price_s_'+dato_producto_hotel_id).html();
                // var precio_pro_d=$('#book_price_d_'+dato_producto_hotel_id).html();
                // var precio_pro_m=$('#book_price_m_'+dato_producto_hotel_id).html();
                // var precio_pro_t=$('#book_price_t_'+dato_producto_hotel_id).html();

                if(parseInt(s)>0)
                    $('#book_price_edit_h_s_'+id).html('$'+$('#book_price_edit_h_s_p_'+id).val());
                if(parseInt(d)>0)
                    $('#book_price_edit_h_d_'+id).html('$'+$('#book_price_edit_h_d_p_'+id).val());
                if(parseInt(m)>0)
                    $('#book_price_edit_h_m_'+id).html('$'+$('#book_price_edit_h_m_p_'+id).val());
                if(parseInt(t)>0)
                    $('#book_price_edit_h_t_'+id).html('$'+$('#book_price_edit_h_t_p_'+id).val());


                // $('#book_precio_asig_hotel_'+id).html($('#book_price_hotel_'+dato_producto_hotel_id).html());
                // prove=$('#proveedor_servicio_hotel_'+dato_producto_hotel_id).html();
                // $('#boton_prove_hotel_'+id).html('<i class="fa fa-edit"></i>');
                // $('#book_proveedor_hotel_'+id).html(prove);
                // $('#book_proveedor_hotel_'+id).fadeIn();
                // $('#estado_proveedor_serv_hotel_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                //
                // $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                mostrar_barra_avance();
            }
            else{
                $('#rpt_precio_proveedor_hotel_'+id).removeClass('text-success');
                $('#rpt_precio_proveedor_hotel_'+id).addClass('text-danger');
                $('#rpt_precio_proveedor_hotel_'+id).html('Error al editar el precio!');
            }
        }
    })
    return false;
    // });
}
function Guardar_proveedor_hotel(id,url,csrf_field,s,d,m,t) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var csrf='<input type="hidden" name="_token" value="'+csrf_field+'">';
    var field_id='<input type="hidden" name="id" value="'+id+'">';
    var prove='';
    var precio='';
    console.log('se guadara el proveedor');
    $.ajax({
        type: 'post',
        url: $('#asignar_proveedor_hotel_path_'+id).attr('action'),
        data: $('#asignar_proveedor_hotel_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log('data:'+data);
            if(data==1){
                $('#rpt_book_proveedor_hotel_'+id).removeClass('text-danger');
                $('#rpt_book_proveedor_hotel_'+id).addClass('text-success');
                $('#rpt_book_proveedor_hotel_'+id).html('Precio editado correctamente!');
                if(parseInt(s)>0)
                    precio+='<p id="book_price_edit_h_s_'+id+'">'+$('#book_price_s_'+dato_producto_hotel_id).html()+'</p>';
                if(parseInt(d)>0)
                    precio+='<p id="book_price_edit_h_d_'+id+'">'+$('#book_price_d_'+dato_producto_hotel_id).html()+'</p>';
                if(parseInt(m)>0)
                    precio+='<p id="book_price_edit_h_m_'+id+'">'+$('#book_price_m_'+dato_producto_hotel_id).html()+'</p>';
                if(parseInt(t)>0)
                    precio+='<p id="book_price_edit_h_t_'+id+'">'+$('#book_price_t_'+dato_producto_hotel_id).html()+'</p>';

                precio+='' +
                    '<a href="#!" id="boton_prove_hotel_edit_cost_'+id+'" data-toggle="modal" data-target="#myModal_edit_cost_h_'+id+'">'+
                    '<i class="fa fa-edit"></i>'+
                    '</a>'+
                    '<div class="modal fade" id="myModal_edit_cost_h_'+id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
                    '<div class="modal-dialog" role="document">'+
                    '<div class="modal-content">'+
                    '<form id="asignar_proveedor_hotel_costo_path_'+id+'" action="'+url+'" method="post">'+
                    '<div class="modal-header">'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h4 class="modal-title" id="myModalLabel"><i class="fa fa-building" aria-hidden="true"></i> Editar costo del hotel</h4>'+
                '</div>'+
                '<div class="modal-body clearfix">'+
                    '<table>';
                if(parseInt(s)>0) {
                    precio+='' +
                    '<tr class="text-left">' +
                    '<td width="100px">' +
                    '<span class="margin-bottom-5">' +
                    '<b>' + s + '</b>' +
                    '<span class="stick">' +
                    '<i class="fa fa-bed" aria-hidden="true"></i>'+
                    '</span>' +
                    '</span>' +
                    '</td>' +
                    '<td width="100px">' +
                    '<input type="number" class="form-control" id="book_price_edit_h_s_p_' + id + '" name="txt_costo_edit_s" value="' + $('#book_price_s_'+dato_producto_hotel_id).html() + '">' +
                    '</td>' +
                    '</tr>';
                }
                if(parseInt(d)>0) {
                    precio += '' +
                    '<tr class="text-left">' +
                    '<td width="100px">' +
                    '<span class="margin-bottom-5">' +
                    '<b>' + d + '</b>' +
                    '<span class="stick">' +
                    '<i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>' +
                    '</span>' +
                    '</span>' +
                    '</td>' +
                    '<td width="100px">' +
                    '<input type="number" class="form-control" id="book_price_edit_h_d_p_' + id + '" name="txt_costo_edit_d" value="' + $('#book_price_d_'+dato_producto_hotel_id).html() + '">' +
                    '</td>' +
                    '</tr>';
                }
                if(parseInt(m)>0) {
                    precio += '' +
                    '<tr class="text-left">' +
                    '<td width="100px">' +
                    '<span class="margin-bottom-5">' +
                    '<b>'+m+'</b>' +
                    '<span class="stick">' +
                    '<i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>' +
                    '</span>' +
                    '</span>' +
                    '</td>' +
                    '<td width="100px">' +
                    '<input type="number" class="form-control" id="book_price_edit_h_m_p_' + id + '" name="txt_costo_edit_m" value="' + $('#book_price_m_'+dato_producto_hotel_id).html() + '">' +
                    '</td>' +
                    '</tr>';
                }
                if(parseInt(t)>0) {
                    precio += '' +
                    '<tr class="text-left">' +
                    '<td width="100px">' +
                    '<span class="margin-bottom-5">' +
                    '<b>'+t+'</b>' +
                    '<span class="stick">' +
                    '<i class="fa fa-bed" aria-hidden="true"></i> <i class="fa fa-bed" aria-hidden="true"></i>' +
                    '</span>' +
                    '</span>' +
                    '</td>' +
                    '<td width="100px">' +
                    '<input type="number" class="form-control" id="book_price_edit_h_t_p_'+id+'" name="txt_costo_edit_t" value="'+$('#book_price_t_'+dato_producto_hotel_id).html()+'">' +
                    '</td>' +
                    '</tr>';
                }
                precio += '' +
                    '</table>'+
                    '<div class="col-md-12">'+
                        '<b id="rpt_precio_proveedor_hotel_'+id+'" class="text-success text-14"></b>'+
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+csrf+
                    '<input type="hidden" name="id" value="'+id+'">'+
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>'+
                    '<button type="button" class="btn btn-primary" onclick="Guardar_proveedor_hotel_costo('+id+','+s+','+d+','+m+','+t+')">Guardar cambios</button>'+
                '</div>'+
                '</form>'+
                '</div>'+
                '</div>'+
                '</div>';

                // $('#book_precio_asig_hotel_'+id).html($('#book_price_hotel_'+dato_producto_hotel_id).html());
                prove=$('#proveedor_servicio_hotel_'+dato_producto_hotel_id).html();
                // $('#boton_prove_hotel_'+id).html('<i class="fa fa-edit"></i>');
                $('#book_proveedor_hotel_'+id).html(prove);
                // $('#book_proveedor_hotel_'+id).fadeIn();
                // $('#estado_proveedor_serv_hotel_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');

                $('#book_precio_asig_hotel_'+id).html(precio);
                $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                mostrar_barra_avance();

            }
            else{
                $('#rpt_book_proveedor_hotel_'+id).removeClass('text-success');
                $('#rpt_book_proveedor_hotel_'+id).addClass('text-danger');
                $('#rpt_book_proveedor_hotel'+id).html('Error al editar el precio!');
            }
        }
    })
    return false;
    // });
}

function dato_producto_hotel(valor,hotel_proveedor_id,hotel_id,itinerario_id){
    dato_producto_hotel_id=valor;
    console.log('valor:'+valor);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../book/traer-fecha-pago-h',
        data: 'hotel_proveedor_id='+hotel_proveedor_id+'&hotel_id='+hotel_id+'&itinerario_id='+itinerario_id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#lista_servicios_asignados_h_'+hotel_id).html('');
            $('#rpt_book_proveedor_fecha_h_'+hotel_id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

        },
        success: function(data) {
            console.log('data de la consulta:'+data);
            $('#lista_servicios_asignados_h_'+hotel_id).html(data.asignados);
            $('#rpt_book_proveedor_fecha_h_'+hotel_id).html(data.fecha);
        }
    })
}
function guardar_reserva(){
    var nro_servicios_total=parseInt($('#nro_servicios_total').val());
    var nro_ser_reservado=parseInt($('#nro_servicios_reservados').val());
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar la reserva?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
// Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $('#form_guardar_reserva').attr('action'),
            data: $('#form_guardar_reserva').serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {

            }
        })
        swal(
            'Genial...',
            'Su reserva se acaba de enviar al area contable para gestionar los pagos!',
            'success'
        )
    })
}
function guardarPrecio(valor,id,fecha){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/servicios/guardar-total',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_save_'+id).addClass('d-none');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )
                    $('#btn_pagar_'+id).removeClass('d-none');
                }

            }
        })
    })
}
function guardarPrecio_h(valor,id,fecha){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/hotels/guardar-total',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_save_h_'+id).addClass('d-none');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )
                    $('#btn_pagar_h_'+id).removeClass('d-none');
                }

            }
        })
    })
}

function pagar_entrada(id,valor){
    if(valor=='' ||valor==0 ){
        swal(
            'Ups...',
            'No se reservo este servicio!',
            'warning'
        )
        return false;
    }
    console.log('valor:'+valor+',id:'+id);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de realizar el pago?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../../../../../../../contabilidad/entradas/pagar',
        data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
            console.log('data:'+data);
            if(data==1) {
                $('#btn_pagar_'+id).addClass('d-none');
                $('#btn_revertir_'+id).removeClass('d-none');
                swal(
                    'Genial...',
                    'El pago se guardo correctamente!',
                    'success'
                )

                $('#check_'+id).removeClass('d-none');

                $('#fecha_'+id).removeClass('bg-danger');
                $('#fecha_'+id).addClass('bg-success');

                $('#clase_'+id).removeClass('bg-danger');
                $('#clase_'+id).addClass('bg-success');

                $('#servicio_'+id).removeClass('bg-danger');
                $('#servicio_'+id).addClass('bg-success');

                $('#ad_'+id).removeClass('bg-danger');
                $('#ad_'+id).addClass('bg-success');

                $('#pax_'+id).removeClass('bg-danger');
                $('#pax_'+id).addClass('bg-success');

                $('#ads_'+id).removeClass('bg-danger');
                $('#ads_'+id).addClass('bg-success');

                $('#total_'+id).removeClass('bg-danger');
                $('#total_'+id).addClass('bg-success');

                $('#categoria_'+id).removeClass('bg-danger');
                $('#categoria_'+id).addClass('bg-success');

                $('#estado_'+id).removeClass('bg-danger');
                $('#estado_'+id).addClass('bg-success');
            }

        }
    })
    })
}
function pagar_entrada_pagos(id,valor){
    if(valor=='' ||valor==0 ){
        swal(
            'Ups...',
            'No se reservo este servicio!',
            'warning'
        )
        return false;
    }
    console.log('valor:'+valor+',id:'+id);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de realizar el pago?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../contabilidad/entradas/pagar',
            data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    var cvalor=parseFloat(valor);

                    $('#btn_pagar_ticket_'+id).addClass('d-none');
                    $('#a_cuenta_r_'+id).html('$'+cvalor);
                    $('#saldo_r_'+id).html('$0');
                    var total_a_cuenta = parseFloat($('#total_a_cuenta').html());
                    var total_saldo = parseFloat($('#total_saldo').html());
                    total_a_cuenta+=cvalor;
                    total_saldo+=cvalor;
                    $('#total_a_cuenta').html(total_a_cuenta);
                    $('#total_saldo').html(total_saldo);
                    swal(
                        'Genial...',
                        'El pago se guardo correctamente!',
                        'success'
                    )
                    $('#check_'+id).removeClass('d-none');

                }

            }
        })
    })
}

function Pasar_pro(id,grupo,idservicio){
    // $('#lista_costos_'+id).append('iti_temp');
    var pro='proveedores_'+idservicio;
    $("input[class="+pro+"]").each(function (index) {
        if ($(this).is(':checked')) {
            var proveedor = $(this).val().split('_');
            console.log('proveedor:'+proveedor[1]);
            if (!existe_proveedor(proveedor[1],grupo,idservicio)) {
                var iti_temp1='';
                console.log('no existe este proveedor');
                iti_temp1='<div id="fila_'+grupo+'_'+id+'_'+idservicio+'_'+proveedor[0]+'" class="row align-items-center">'+
                            '<div class="col-5 text-capitalize"><i class="fas fa-check text-success"></i><span class="fila_proveedores_'+idservicio+'_'+grupo+'">'+proveedor[1].toLowerCase()+'</span> </div>'+
                            '<div class="col">'+
                                '<input type="hidden" name="pro_id[]" value="'+proveedor[0]+'"></td>'+
                                '<input type="number" name="pro_val[]" class="form-control form-control-sm my-2" value="0.00" min="0" step="0.01"></td>'+
                            '</div>'+
                            '<div class="col-3">'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="eliminar_proveedor('+id+',\''+grupo+'\','+idservicio+','+proveedor[0]+',\''+proveedor[1]+'\')">'+
                                    '<i class="fas fa-trash"></i>'+

                                '</button>'+
                            '</div>'+
                          '</div>';
                $('#lista_costos_'+grupo+'_'+id+'_'+idservicio).append(iti_temp1);
                console.log('algo paso por aqui');
            }
            $(this).prop("checked","");
        }
    });
}

function eliminar_proveedor(id1,grupo,idservicio,id,nombre) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar a "+nombre+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#result_'+idservicio).removeClass('bg-danger');
        $('#result_'+idservicio).addClass('bg-success');
        $('#result_'+idservicio).html('Proveedor borrado correctamente');
        $('#fila_'+grupo+'_'+id1+'_'+idservicio+'_'+id).fadeOut( "slow");
        $('#fila_'+grupo+'_'+id1+'_'+idservicio+'_'+id).remove();

    })
}
function eliminar_proveedor_comprobando(id,costo_id,proveedor_id,nombre) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar a "+nombre+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#result_'+id).html('');
        $('#result_'+id).removeClass('bg-success');
        $('#result_'+id).removeClass('bg-danger');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../admin/ventas/service/eliminar-proveedor',
            data: 'costo_id='+costo_id+'&proveedor_id='+proveedor_id+'&id='+id+'&confirmacion=no-borrar',
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data=='1'){
                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).fadeOut("slow");
                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).remove();

                    // se elimino con exito
                }
                else if(data=='2'){
                    // este costo se esta usado en una cotizacion
                    $('#result_'+id).addClass('bg-danger');
                    $('#result_'+id).html('Este proveedor esta siendo usado en una cotizacion');

                    swal({
                        title: 'MENSAJE DEL SISTEMA',
                        text: "¿Este proveedor esta siendo usado en una cotizacion. Estas seguro de eliminar a "+nombre+"?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then(function () {
                        $('#result_'+id).html('');
                        $('#result_'+id).removeClass('bg-success');
                        $('#result_'+id).removeClass('bg-danger');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('[name="_token"]').val()
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '../admin/ventas/service/eliminar-proveedor',
                            data: 'costo_id='+costo_id+'&proveedor_id='+proveedor_id+'&id='+id+'&confirmacion=borrar',
                            // Mostramos un mensaje con la respuesta de PHP
                            success: function(data) {
                                if(data=='1'){
                                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).fadeOut("slow");
                                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).remove();

                                    // se elimino con exito
                                }
                                // else if(data=='2'){
                                //     // este costo se esta usado en una cotizacion
                                //     $('#result_'+id).addClass('bg-danger');
                                //     $('#result_'+id).html('Este proveedor esta siendo usado en una cotizacion');
                                // }
                                // console.log(data);

                            }
                        })

                        // $("#fila_"+id).fadeOut( "slow");
                    });
                }
                console.log(data);

            }
        })

        // $("#fila_"+id).fadeOut( "slow");
    })
}
function existe_proveedor(clave,grupo,servicio_id){
    var existe=false;
    var fila='.fila_proveedores_'+servicio_id+'_'+grupo;
    $(fila).each(function (index1) {
        console.log('recorremos->'+'clave:'+clave+'==$(this).html():'+$(this).html());
        if((clave.trim()).toLowerCase()==($(this).html().trim()).toLowerCase()){
            existe=true;
        }
    });
    return existe;
}

function nuevos_proveedores(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../admin/ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&pos='+pos+'&categoria='+categoria,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#lista_proveedores_'+pos+'_'+categoria).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
}
function nuevos_proveedores_new(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../admin/ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
}
function guardarPrecio_Ticket(valor,id,fecha,pax){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/servicios/guardar-total/ticket',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha+'&pax='+pax,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {

                    $('#btn_save_ticket_'+id).addClass('d-none');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )

                    $('#btn_pagar_ticket_'+id).removeClass('d-none');

                }

            }
        })
    })
}
function Enviar_precio_c(id,precio_c) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-precio-c', 'id='+id+'&precio_c='+precio_c, function (data) {
    if(data==1) {
        $('#btn_'+id).removeClass('btn-primary')
        $('#btn_'+id).addClass('btn-warning')
        swal(
            'MENSAJE DEL SISTEMA',
            'Costo confirmado',
            'success'
        )
    }
    else{
        swal(
            'MENSAJE DEL SISTEMA',
            'Error al confirmar el costo, intente de nuevo',
            'warning'
        )
    }
    }).fail(function (data) {
    });
}
function Enviar_precio_c_h(n_u,tipo,id,precio_c,paquete_cotizaciones_id){
    console.log('n_u:'+n_u+',tipo:'+tipo+',id:'+id+',precio_c:'+precio_c);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-precio-c-hotel', 'n_u='+n_u+'&tipo='+tipo+'&id='+id+'&precio_c='+precio_c+'&paquete_cotizaciones_id='+paquete_cotizaciones_id, function (data) {
        if(data==1) {
            $('#btn_h_'+tipo+'_'+id).removeClass('btn-primary')
            $('#btn_h_'+tipo+'_'+id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Costo confirmado',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar el costo, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}

function buscar_hoteles_pagos_pendientes(ini,fin){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/pagos/pendientes/filtrar', 'ini='+ini+'&fin='+fin, function (data) {
            $('#rpt_hotel').html(data);

    }).fail(function (data) {
    });
}
function eliminar_servicio_reservas(id,servicio,tipo) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar "+servicio+" ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        if(tipo=='S') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $.post('/admin/book/servicio/delete', 'id=' + id, function (data) {
                if (data == 1) {
                    // $("#lista_destinos_"+id).remove();
                    $("#servicio_" + id).fadeOut("low");
                    $("#servicio_" + id).remove();
                    swal(
                        'Mensaje del sistema',
                        'Se borro el servicio',
                        'success'
                    )
                }
            }).fail(function (data) {
            });
        }
        else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $.post('/admin/book/hotel/delete', 'id=' + id, function (data) {
                if(data == 1) {
                    // $("#lista_destinos_"+id).remove();
                    $("#hotel_" + id).fadeOut("low");
                    $("#hotel_" + id).remove();
                    swal(
                        'Mensaje del sistema',
                        'Se borro el hotel',
                        'success'
                    )
                }
            }).fail(function (data) {
            });
        }
    })
}
function Guardar_observacion_hoja(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var obs=$('#txt_observacion_hoja_ruta_'+id).val();
    if(obs.trim()==''){
        $('#rpt_book_hoja_costo_'+id).html('Ingrese su observacion');
        return false;
    }
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#ingresar_observaciones_hoja_path_'+id).attr('action'),
        data: $('#ingresar_observaciones_hoja_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                $('#rpt_book_hoja_costo_'+id).html('Observacion guardada correctamente!');
                $('#obs_'+id).html(obs);
            }
            else{
                $('#rpt_book_hoja_costo_'+id).removeClass('text-success');
                $('#rpt_book_hoja_costo_'+id).addClass('text-danger');
                $('#rpt_book_hoja_costo_'+id).html('Error al guardar las observaciones !');
            }
        }
    })
    return false;
    // });
}
function confirma_envio_servicio_reservas(id,estado1) {
    // alert('holaaa');
    var estado=$("#estado_send_"+id).val();
    var msj="¿Estas seguro que quiere confirmar el envio?";
    if(estado==0)
        msj="¿Estas seguro que quiere revertir el envio?";
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: msj,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/book/servicio/envio', 'id='+id+'&estado='+estado, function(data){
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#servicio_"+id).fadeOut( "low");
                if(estado==1){
                    // pintamos de verde
                    $("#estado_send_"+id).val('0');
                    $("#confirm_send_"+id).removeClass('btn-unset');
                    $("#confirm_send_"+id).addClass('btn-success');
                }
                else if(estado==0){
                    // pintamos de unset
                    $("#estado_send_"+id).val('1');
                    $("#confirm_send_"+id).removeClass('btn-success');
                    $("#confirm_send_"+id).addClass('btn-unset');
                }
                swal(
                    'Mensaje del sistema',
                    'Se realiazo la operacion con exito',
                    'success'
                )
            }
        }).fail(function (data) {

        });

    })
}
function verificar_reservados(no_rservados){

    $('#form_nuevo_pqt').submit(function(){


    });
}
function verificar_reservados(no_rservados){

        if (no_rservados > 0) {

            swal(
                'Mensaje del sistema',
                'Ups!. Hay ' + no_rservados + ' entradas no reservadas, reservas debe de realizar esta opracion para que se pueda pagar',
                'warning'
            )
            return false;
        }
        // swal({
        //     title: 'MENSAJE DEL SISTEMA',
        //     text: "¿Estas seguro de pagar todas las entradas?",
        //     type: 'question',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes'
        // }).then(function () {
        //     $('#form_pagar_entradas_full').submit(function() {});
        // })

}
function revertir_pago_entrada(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de revertir el pago?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: '../../../../../../../../contabilidad/entradas/revertir',
            data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {

                    $('#btn_pagar_'+id).removeClass('d-none');
                    $('#btn_revertir_'+id).addClass('d-none');


                    swal(
                        'Genial...',
                        'El pago se revirtio correctamente!',
                        'success'
                    )

                    $('#check_'+id).addClass('d-none');


                    $('#fecha_'+id).removeClass('bg-success');
                    $('#fecha_'+id).addClass('bg-danger');

                    $('#clase_'+id).removeClass('bg-success');
                    $('#clase_'+id).addClass('bg-danger');

                    $('#servicio_'+id).removeClass('bg-success');
                    $('#servicio_'+id).addClass('bg-danger');

                    $('#ad_'+id).removeClass('bg-success');
                    $('#ad_'+id).addClass('bg-danger');

                    $('#pax_'+id).removeClass('bg-success');
                    $('#pax_'+id).addClass('bg-danger');

                    $('#ads_'+id).removeClass('bg-success');
                    $('#ads_'+id).addClass('bg-danger');

                    $('#total_'+id).removeClass('bg-success');
                    $('#total_'+id).addClass('bg-danger');

                    $('#categoria_'+id).removeClass('bg-success');
                    $('#categoria_'+id).addClass('bg-danger');

                    $('#estado_'+id).removeClass('bg-success');
                    $('#estado_'+id).addClass('bg-danger');
                }

            }
        })
    })
}

function guardar_cta(){
    var id=$('#id').val();
    var nro_cheque=$('#nro_cheque_s').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/contabilidad/entradas/codigo',
        data: 'id='+id+'&nro_cheque='+nro_cheque+'&tipo=s',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                console.log('se guardo');
                swal(
                    'Genial...',
                    'El nro de operacion se guardo correctamente!',
                    'success'
                )
            }

        }
    })
}
function guardar_cta_c() {
    var id=$('#id').val();
    var nro_cheque=$('#nro_cheque_c').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/contabilidad/entradas/codigo',
        data: 'id='+id+'&nro_cheque='+nro_cheque+'&tipo=c',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                console.log('se guardo');
                swal(
                    'Genial...',
                    'El nro de operacion se guardo correctamente!',
                    'success'
                )
            }

        }
    })
    // var id=$('#id').val();
    // var nro_cheque_c=$('#nro_cheque_c').val();
    //
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('[name="_token"]').val()
    //     }
    // });
    // $.post('/admin/contabilidad/entradas/codigo', 'id='+id+'&nro_cheque_c='+nro_cheque_c+'&tipo=c', function(data) {
    //     if(data==1){
    //         swal(
    //             'Mensaje del sistema',
    //             'Se guardo el nro correctamente,
    //         'success'
    //     )
    //     }
    // }).fail(function (data) {
    //
    // });
}

function eliminar_liquidacion(id,fecha) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la liquidacion creada "+fecha+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/operaciones/pagos-pendientes/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_liquidaciones_"+id).remove();
            }
        }).fail(function (data) {

        });

    })
}

function llamar_servicios(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/ventas/call/servicios/grupo', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#list_servicios_grupo").html(data);
    }).fail(function (data) {
    });
}
var total_serv=0;
function escojer_servicio(){
    total_serv=$('#nroServicios').val();
    var destino_escoj=$('#destinos_escoj').html();
    var destino_escoj_titulo=$('#destinos_escoj_titulo').html();
    var itinerario='';
    var iti_temp='';
    $("input[class='servicios1']").each(function (index){
        if($(this).is(':checked')){
            itinerario='';
            itinerario=$(this).val().split('_');
            var $grupo=itinerario[5];
            if(!existe_servicio(itinerario[2]))
            {
                total_serv++;
                iti_temp = '<div id="elto_'+itinerario[2]+'" class="col-lg-11 elemento_sort">'+
                    '<div class="row">'+

                '<div class="col-lg-1 small puntero"><span class="text-unset"><i class="fas fa-arrows-alt" aria-hidden="true"></i></span></div>'+
                '<div class="col-lg-1 pos small">'+total_serv+'</div>'+
                '<div class="col-lg-9 small">';
                if($grupo=='TOURS')
                    iti_temp +='<i class="fas fa-map text-info" aria-hidden="true"></i> ';
                else if($grupo == 'MOVILID'){
                    var $clase=itinerario[6];
                    if ($clase == 'BOLETO')
                        iti_temp +='<i class= "fas fa-ticket-alt text-warning" aria-hidden="true"></i>';
                    else
                        iti_temp += '<i class= "fa fa-bus text-warning" aria-hidden="true"></i>';

                }
                else if($grupo == 'REPRESENT')
                    iti_temp += '<i class = "fa fa-users text-success" aria-hidden="true"></i>';
                else if($grupo == 'ENTRANCES')
                    iti_temp += '<i class= "fas fa-ticket-alt text-success" aria-hidden="true"></i>';

                else if($grupo == 'FOOD')
                    iti_temp += '<i class = "fas fa-utensils text-danger" aria-hidden="true"></i>';
                else if($grupo == 'TRAINS')
                    iti_temp += '<i class = "fa fa-train text-info" aria-hidden="true"></i>';
                else if($grupo == 'FLIGHTS')
                    iti_temp += '<i class = "fa fa-plane text-primary" aria-hidden="true"></i>';
                else if($grupo == 'OTHERS')
                    iti_temp += '<i class = "fa fa-question text-success" aria-hidden="true"></i>';

                iti_temp += itinerario[4]+'<span class="text-success"> | </span>'+itinerario[7]+'<span class="text-success"> | </span>'+destino_escoj_titulo+'<span class="text-success"> | <sup>$</sup></span>'+itinerario[8]+'<input type="hidden" name="servicios_esc[]" value="'+itinerario[2]+'"><input type="hidden" name="destinos_esc[]" value="'+destino_escoj+'"></div>'+
            '<div class="col-lg-1 small puntero"><span class="text-danger float-right text-right" onclick="borrar_servicios_esc(\''+itinerario[2]+'\',\''+itinerario[4]+'\')"><i class="fas fa-trash" aria-hidden="true"></i></span></div>'+
                '</div>'+
                '</div>';

                $('#caja_1').append(iti_temp);
            }
            $(this).prop("checked", "");
        }
    });
    $('#nroServicios').val(total_serv);
}
function existe_destino(cb,clave){
    var existe=false;
    $(cb).each(function(){
        if($(this).attr('value')==clave)
            existe=true;
            // alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'))
    });
    return existe;
}
function existe_servicio(clave){
    var existe=false;
    $(".elemento_sort").each(function (index1) {
        var valor_servicio1=$(this).attr('id');
        var valor_servicio=valor_servicio1.split('_');
        if(clave==valor_servicio[1]){
            existe=true;
        }
    });
    return existe;
}

function borrar_servicios_esc(id,titulo) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el servicio "+titulo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $("#elto_"+id).fadeOut("slow");
        $("#elto_"+id).remove();
        ordenar_servicios();
        total_serv=parseInt($('#nroServicios').val());
        total_serv--;
        $('#nroServicios').val(total_serv);
    })
}
function ordenar_servicios() {
    var titles =$('.caja_sort').children('.elemento_sort').children('.row').children('.pos');
    $(titles).each(function(index, element){
        var elto=$(element).html();
        var pos=(index+1);
        $(element).html(pos);
    });
}

function mostrar_hoteles_categoria(pos) {
    var cate = $('#txt_categoria_' + pos).val();
    for(var i=2;i<=5;i++) {

        $("#header_"+i).addClass("d-none");
        $("#dato_s_"+i).addClass("d-none");
        $("#dato_d_"+i).addClass("d-none");
        $("#dato_m_"+i).addClass("d-none");
        $("#dato_t_"+i).addClass("d-none");
        $("#dato_ss_"+i).addClass("d-none");
        $("#dato_sd_"+i).addClass("d-none");
        $("#dato_su_"+i).addClass("d-none");
        $("#dato_js_"+i).addClass("d-none");
    }
    $("#header_"+cate).removeClass("d-none");
    $("#dato_s_"+cate).removeClass("d-none");
    $("#dato_d_"+cate).removeClass("d-none");
    $("#dato_m_"+cate).removeClass("d-none");
    $("#dato_t_"+cate).removeClass("d-none");
    $("#dato_ss_"+cate).removeClass("d-none");
    $("#dato_sd_"+cate).removeClass("d-none");
    $("#dato_su_"+cate).removeClass("d-none");
    $("#dato_js_"+cate).removeClass("d-none");
}
function limpiar_caja_servicios() {
    $("#list_servicios_grupo").html('');
}

function mostrar_proveedores(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#caja_listado_proveedores_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.post('/admin/provider/filtro/localizacion', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#caja_listado_proveedores_"+grupo).html(data);
    }).fail(function (data) {

    });
}
function mostrar_proveedores_x_estrellas(destino,grupo,estrellas){
    console.log('destino:'+destino+',grupo:'+grupo);
    if(destino=='0_ninguno'){
        swal(
            'MENSAJE DEL SISTEMA',
            'Escoja la localizacion.',
            'warning'
        )
        return false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#caja_listado_proveedores_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.post('/admin/provider/filtro/localizacion/estrellas', 'destino='+destino+'&grupo='+grupo+'&estrellas='+estrellas, function(data) {
        $("#caja_listado_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}

function mostrar_proveedores_cost(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#caja_listado_cost_proveedores_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.post('/admin/cost-provider/filtro/localizacion', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#caja_listado_cost_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}
function mostrar_proveedores_x_estrellas_cost(destino,grupo,estrellas){
    console.log('destino:'+destino+',grupo:'+grupo);
    if(destino=='0_ninguno'){
        swal(
            'MENSAJE DEL SISTEMA',
            'Escoja la localizacion.',
            'warning'
        )
        return false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#caja_listado_cost_proveedores_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.post('/admin/cost-provider/filtro/localizacion/estrellas', 'destino='+destino+'&grupo='+grupo+'&estrellas='+estrellas, function(data) {
        $("#caja_listado_cost_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}

function mostrar_class(proveedor_id,array_pro,grupo,id,idservicio) {
    var array_prove_train = array_pro.split('_');
    var proveedor = proveedor_id.split('_');
    var pos=6;
    if (proveedor_id!='0'){
        $.each(array_prove_train, function (key, value){
            $("#proveedor_" + value+'_'+idservicio).addClass('d-none');
            $("#proveedor_" + value+'_'+idservicio).fadeOut("slow");
        });
        $("#proveedor_" + proveedor[0]+'_'+idservicio).removeClass('d-none');
        $("#proveedor_" + proveedor[0]+'_'+idservicio).fadeIn("slow");
        // $("#fila_"+proveedor_id).removeClass('d-none');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../../admin/productos/lista/empresa/mostrar-clases','proveedor_id='+proveedor_id+'&pos='+pos, function(data) {
            $("#mostrar_clase").html(data);
        }).fail(function (data) {
        });
        // $.each(array_prove_train, function (key, value) {
        //     $("#proveedor_" + value).addClass('hide');
        //     $("#proveedor_" + value).fadeOut("slow");
        // });
        // $("#proveedor_" + proveedor[0]).removeClass('hide');
        // $("#proveedor_" + proveedor[0]).fadeIn("slow");
        // $("#fila_"+proveedor_id).removeClass('hide');

        // $("#fila_"+proveedor_id).fadeIn("slow");
        var iti_temp1 = '';
        iti_temp1 = '<div id="fila_' + grupo + '_' + id + '_' + idservicio + '_' + proveedor[0] + '" class="row">' +
            '<div class="col-lg-8 fila_proveedores_' + id + '">' + proveedor[1] + '</div>' +
            '<div class="col-lg-2">' +
            '<input type="hidden" name="pro_id[]" value="' + proveedor[0] + '"></td>' +
            '<input type="number" name="pro_val[]" class="form-control" style="width: 80px" value="0.00" min="0" step="0.01"></td>' +
            '</div>' +
            // '<div class="col-lg-2">'+
            // '<button type="button" class="btn btn-danger" onclick="eliminar_proveedor('+id+','+grupo+','+idservicio+','+proveedor_id]+',\''+proveedor+'\')">'+
            // '<i class="fa fa-trash-o" aria-hidden="true"></i>'+
            // '</button>'+
            // '</div>'+
            '</div>';
        var proveedor_compro=$('#id_lista_costos_' + grupo + '_' + id + '_' + idservicio).val();
        // console.log('proveedor_compro:'+proveedor_compro);
        // console.log('lista_costos_:'+'#lista_costos_'+grupo+'_'+id+'_'+idservicio);
        // console.log('fila_p_:'+'#fila_p_'+idservicio+'_'+proveedor_compro+'_'+proveedor[0]);
        // var valors=$('#lista_costos_'+grupo+'_'+id+'_'+idservicio).find('#fila_p_'+idservicio+'_'+proveedor_compro+'_'+proveedor[0]);
        // console.log('valors:'+valors);
        var valors_costo=$('#fila_p_'+idservicio+'_'+proveedor_compro+'_'+proveedor[0]);
        var valors_nuevo=$('#fila_'+grupo+'_'+id+'_'+idservicio+'_'+proveedor[0]);
        console.log('valors:'+valors_costo.length);
        // console.log('childs:'+proveedor_compro);
        // var childs=$('#lista_costos_'+grupo+'_'+id+'_'+idservicio).find('#fila_p_'+idservicio+'_'+proveedor_compro+'_'+proveedor[0]).length;
        // console.log('childs:'+childs);
        // if(valors_costo.length==0){
        //     $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).append(iti_temp1);
        // }
        // if(valors_nuevo.length==0){
        //     $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).append(iti_temp1);
        // }

        $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html(iti_temp1);
    }
    // else {
    //     $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html('');
    // }
}
function eliminar_hotel_provider(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar al proveedor "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/hotel-provider/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_provider_"+id).fadeOut( "slow");
            }
            else if(data==2){
                swal(
                    'Porque no puedo borar?',
                    'El proveedor se esta usando en alguna cotizacion, no es posible borrar este proveedor.',
                    'warning'
                )
            }
        }).fail(function (data) {
        });
    })
}
function actualizar_fecha(servicio_id,fecha,proveedor_id,pqt_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-fecha', 'id='+servicio_id+'&fecha='+fecha+'&proveedor_id='+proveedor_id+'&pqt_id='+pqt_id, function (data) {
        if(data==1) {
            $('#btn_fecha_'+servicio_id).removeClass('btn-primary')
            $('#btn_fecha'+servicio_id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Fecha confirmada',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar la fecha, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}
function actualizar_titulo(itinerario_id,iti_nuevo_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/actualizar-titulo', 'itinerario_id='+itinerario_id+'&iti_nuevo_id='+iti_nuevo_id, function (data) {
        var dat=data.split('_');
        if(dat[0]==1){
            $('#titulo_'+itinerario_id).html(dat[1]);
            swal(
                'MENSAJE DEL SISTEMA',
                'titulo actualizado',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al actualizar el titulo, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}

function actualizar_fecha_h(servicio_id,fecha,proveedor_id,pqt_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-fecha-hotel', 'id='+servicio_id+'&fecha='+fecha+'&proveedor_id='+proveedor_id+'&pqt_id='+pqt_id, function (data) {
        if(data==1) {
            $('#btn_fecha_h_'+servicio_id).removeClass('btn-primary')
            $('#btn_fecha_h_'+servicio_id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Fecha confirmada',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar la fecha, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}
function buscar_servicios_pagos_pendientes(ini,fin,servicio) {
    console.log('ini:' + ini + ' - fin:' + fin + ' - servicio:' + servicio);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    $.post('/admin/contabilidad/pagos/servicios/pendientes/filtrar', 'ini=' + ini + '&fin=' + fin + '&grupo=' + servicio, function (data) {
        $('#rpt_' + servicio).html(data);

    }).fail(function (data) {
    });
}
function mostrar_tabla_empresa(grupo,id,empresa_id){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista/empresa','id='+id+'&empresa_id='+empresa_id, function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
    });
}
function nuevos_proveedores_movilidad_ruta(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-movilidad',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#rutas_'+pos).html(data);
        }
    })
}
function mostrar_tabla_destino_ruta(grupo,id,pos,xruta,xtipo,consulta){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    if(consulta=='normal'){
        $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&filtro=normal', function(data) {
                $("#tb_datos_"+grupo).html(data);

        }).fail(function (data) {
        });
        $.post('../../admin/productos/lista/rutas', 'destino='+destino+'&id='+id+'&grupo='+grupo+'&pos='+pos, function(data) {
            $("#mostra_rutas_movilid").html(data);
        }).fail(function (data) {
        });
    }
    else if(consulta=='normal'){
        $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        // $.post('../../admin/productos/lista/por-ruta', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&filtro=Movilidad-ruta', function(data) {
        $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&filtro=Movilidad-ruta', function(data) {
            $("#tb_datos_"+grupo).html(data);
        }).fail(function (data) {
        });
        $.post('../../admin/productos/lista/por-ruta/cargar-tipos', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&grupo='+grupo, function(data) {
            $("#mostra_tipo_"+grupo).html(data);
        }).fail(function (data) {
        });
    }
    else if(consulta=='tipo'){
        $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        // $.post('../../admin/productos/lista/por-ruta/tipo', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&tipo='+tipo+'&pos='+pos+'&filtro=Movilidad-ruta-tipo', function(data) {
        $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&tipo='+tipo+'&pos='+pos+'&filtro=Movilidad-ruta-tipo', function(data) {
            $("#tb_datos_"+grupo).html(data);
        }).fail(function (data) {
        });
    }
}
function mostrar_tabla_destino_ruta_datos(grupo,id,ruta,pos){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    // $.post('../../admin/productos/lista/por-ruta', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&filtro=Movilidad-ruta', function(data) {
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&filtro=Movilidad-ruta', function(data) {
            $("#tb_datos_"+grupo).html(data);
    }).fail(function (data) {
    });
    $.post('../../admin/productos/lista/por-ruta/cargar-tipos', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&grupo='+grupo, function(data) {
        $("#mostra_tipo_"+grupo).html(data);
    }).fail(function (data) {
    });
}
function mostrar_tabla_destino_ruta_tipo_datos(grupo,id,ruta,tipo,pos){
    console.log('tipo:'+tipo);
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    // $.post('../../admin/productos/lista/por-ruta/tipo', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&tipo='+tipo+'&pos='+pos+'&filtro=Movilidad-ruta-tipo', function(data) {
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&tipo='+tipo+'&pos='+pos+'&filtro=Movilidad-ruta-tipo', function(data) {
            $("#tb_datos_"+grupo).html(data);
    }).fail(function (data) {
    });
}
function nuevos_proveedores_movilidad_ruta_edit(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../admin/ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP,
        beforeSend: function(databf){
            $('#lista_proveedores_'+pos+'_'+categoria).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../admin/ventas/service/listar-movilidad',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#rutas_'+pos).html(data);
        }
    })
}

function nuevos_proveedores_trains_ruta(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-train/salida',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#ruta_salida_'+pos).html(data);
        }
    })
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-train/llegada',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#ruta_llegada_'+pos).html(data);
        }
    })
    // $.ajax({
    //     type: 'POST',
    //     url: '../../../admin/ventas/service/listar-proveedores',
    //     data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria,
    //     // Mostramos un mensaje con la respuesta de PHP
    //     success: function(data) {
    //         console.log(data);
    //         $('#lista_proveedores_'+pos+'_'+categoria).html(data);
    //     }
    // })
}
function traer_servicios(itinerario_id,servicios_id,localizacion,grupo) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../admin/book/listar-servicios',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
        if(grupo=='HOTELS'){
            $('#list_servicios_h_grupo_'+servicios_id).html(data);
        }
        else{
            $('#list_servicios_grupo_'+servicios_id).html(data);
        }
        }
    })
}
function mostrar_servicios_localizacion(itinerario_id,servicios_id,localizacion,grupo,proveedor_id) {
    console.log('itinerario_id:'+itinerario_id);
    console.log('servicios_id:'+servicios_id);
    console.log('localizacion:'+localizacion);
    console.log('grupo:'+grupo);
    console.log('proveedor_id:'+proveedor_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../admin/book/listar-servicios/localizacion',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id+'&proveedor_id='+proveedor_id,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#servicio_localizacion_'+servicios_id).html(data);
        }
    })
}

function buscar_day_by_day(destino) {
    console.log('destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../admin/package/buscar-day-by-day/ajax',
        data: 'destino='+destino,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#resultado_busqueda').html(data);
        }
    })
}
function buscar_day_by_day_edit(destino) {
    console.log('destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../../admin/package/buscar-day-by-day/ajax',
        data: 'destino='+destino,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#resultado_busqueda').html(data);
        }
    })
}
function traer_servicios_paso1(itinerario_id,servicios_id,localizacion,grupo,modo) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    if(modo=='nuevo'){
        $.ajax({
            type: 'POST',
            url: '../../../../../../book/listar-servicios-paso1',
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id+'&modo='+modo,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('se recojio datos');
                $('#list_servicios_grupo_'+servicios_id).html(data);
            }
        })
    }
    else if(modo=='nuevo_ajax'){
        $.ajax({
            type: 'POST',
            url: '../../../../../../../book/listar-servicios-paso1',
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id+'&modo='+modo,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('se recojio datos');
                $('#list_servicios_grupo_'+servicios_id).html(data);
            }
        })
    }
    else if(modo=='edit'){
        $.ajax({
            type: 'POST',
            url: '../../../../../../book/listar-servicios-paso1',
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id+'&modo='+modo,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#list_servicios_grupo_'+servicios_id).html(data);
            }
        })
    }
}
function mostrar_servicios_localizacion_paso1(itinerario_id,servicios_id,localizacion,grupo,proveedor_id,modo) {
    console.log('itinerario_id:'+itinerario_id);
    console.log('servicios_id:'+servicios_id);
    console.log('localizacion:'+localizacion);
    console.log('grupo:'+grupo);
    console.log('proveedor_id:'+proveedor_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    if(modo=='edit') {
        $.ajax({
            type: 'POST',
            url: '../../../../../../book/listar-servicios/localizacion-paso1',
            data: 'localizacion=' + localizacion + '&grupo=' + grupo + '&servicios_id=' + servicios_id + '&itinerario_id=' + itinerario_id + '&proveedor_id=' + proveedor_id,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function () {
                    $('#servicio_localizacion_' + servicios_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function (data) {
                $('#servicio_localizacion_' + servicios_id).html(data);
            }
        })
    }
    else{
        $.ajax({
            type: 'POST',
            url: '../../../../../../book/listar-servicios/localizacion-paso1',
            data: 'localizacion=' + localizacion + '&grupo=' + grupo + '&servicios_id=' + servicios_id + '&itinerario_id=' + itinerario_id + '&proveedor_id=' + proveedor_id,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function () {
                    $('#servicio_localizacion_' + servicios_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function (data) {
                $('#servicio_localizacion_' + servicios_id).html(data);
            }
        })
    }

}
function mostrar_pqts(pagina) {
    console.log('pagina:'+pagina);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../admin/itineraries/listar',
        data:'pagina='+pagina,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function() {
                $('#lista_pqts').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data) {
            $('#lista_pqts').html(data);
        }
    })
}

function confirmar_servicio_reservas(id,servicio,tipo) {
    // alert('holaaa');
    // swal({
    //     title: 'MENSAJE DEL SISTEMA',
    //     text: "¿Estas seguro de guardar los cambios para "+servicio+" ?",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes'
    // }).then(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        if(tipo=='S') {
            $.post('/admin/book/servicio/confirmar', 'id=' + id, function (data) {
                var confirm = data.split('_');
                if (confirm[1] == 1) {
                    // $("#lista_destinos_"+id).remove();
                    if (confirm[0] == '1')
                        $("#confim_" + id).html('<i class="fas fa-lock text-success"></i>');
                    else if (confirm[0] == '0')
                        $("#confim_" + id).html('<i class="fas fa-unlock"></i>');
                    // swal(
                    //     'Mensaje del sistema',
                    //     'Se confirmo el servicio ',
                    //     'success'
                    // )
                }
            }).fail(function (data) {

            });
        }
        else{
            $.post('/admin/book/hotel/confirmar', 'id=' + id, function (data) {
                var confirm = data.split('_');
                if (confirm[1] == 1) {
                    // $("#lista_destinos_"+id).remove();
                    if (confirm[0] == '1')
                        $("#confim_h_" + id).html('<i class="fas fa-lock text-success"></i>');
                    else if (confirm[0] == '0')
                        $("#confim_h_" + id).html('<i class="fas fa-unlock"></i>');
                    // swal(
                    //     'Mensaje del sistema',
                    //     'Se confirmo el hotel ',
                    //     'success'
                    // )
                }
            }).fail(function (data) {

            });
        }
    // })
}
function editar_producto(id){
    var grupo=$('#grupo_'+id).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: $('#frm_modal_edit_producto_'+id).attr('action'),
        data: $('#frm_modal_edit_producto_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success:  function (response) {
            // console.log('response:'+response);
            var datox=response.split('_');
            console.log(datox);
            $('#result_'+id).removeClass('bg-danger');
            $('#result_'+id).addClass('bg-success');
            $('#result_'+id).html('Producto guardado Correctamente!');
            swal(
                'Genial...',
                'Producto guardado Correctamente!',
                'success'
            )
            if(grupo=='MOVILID')
                $('#tipo_'+id).html(datox[0]+' ['+datox[1]+'-'+datox[2]+']');
            else
                $('#tipo_'+id).html(datox[0]);

            if(grupo=='TRAINS')
                $('#horario_'+id).html(datox[2]);
            $('#precio_'+id).html(datox[3]);
            $('#nombre_'+id).html(datox[4]);
        }
    });
    // esto es para que no se reenvie el formulario
    return false;
    // console.log('Se guardo los precios de los trenes');
}
function generar_codigo(web){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../generar-codigo',
        data: 'web='+web,
        // Mostramos un mensaje con la respuesta de PHP
        success:  function (response) {
            $('#txt_codigo').val(response);
        }
    });
}
function generar_codigo_pagina(web){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../generar-codigo',
        data: 'web='+web,
        // Mostramos un mensaje con la respuesta de PHP
        success:  function (response) {
            $('#txt_codigo').val(response);
        }
    });
}

function eliminar_archivo(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la imagen",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../book/eliminar-archivo', 'id='+id, function(data) {
            if(data==1){
                $("#arch_"+id).fadeOut( "slow");
                $("#arch_"+id).remove();
            }
        }).fail(function (data) {

        });

    })
}
function enviar_ask_request(pqt_id){
    // var pedir_datos=$('#pedir_datos_hidden'+pqt_id).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type:  'post',
        url:   $('#ask_request_'+pqt_id).attr('action'),
        data:  $('#ask_request_'+pqt_id).serialize(),
        beforeSend:function(res){
            $('#response_'+pqt_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Loading');
        }
        ,success:  function (response) {
            console.log('response:'+response);
            if(response=='1'){
                $('#response_'+pqt_id).removeClass('text-danger');
                $('#response_'+pqt_id).addClass('text-success');
                $('#response_'+pqt_id).html('E-mail send!');
                $('#pedir_datos_'+pqt_id).removeClass('text-primary');
                $('#pedir_datos_'+pqt_id).addClass('text-success');
                // if(pedir_datos>0)
                //     $('#pedir_datos_hidden_'+pqt_id).val('1');
                // else
                //     $('#pedir_datos_hidden_'+pqt_id).val('0');

            }
            else if(response=='0'){
                $('#response_'+pqt_id).removeClass('text-success');
                $('#response_'+pqt_id).addClass('text-danger');
                $('#response_'+pqt_id).html('Error sending email!');
            }
        }
    });
}
function ingresar_notas(pqt_id){
    tinymce.triggerSave();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type:  'post',
        url:   $('#ingresar_notas_'+pqt_id).attr('action'),
        data:  $('#ingresar_notas_'+pqt_id).serialize(),
        beforeSend:function(res){
            $('#response_notas_'+pqt_id).removeClass('text-danger');
            $('#response_notas_'+pqt_id).removeClass('text-success');
            $('#response_notas_'+pqt_id).html('<i class="fas fa-stroopwafel fa-spin fa-2x"></i>');
        }
        ,success:  function (response) {
            console.log('response:'+response);
            if(response=='1'){
                $('#response_notas_'+pqt_id).removeClass('text-danger');
                $('#response_notas_'+pqt_id).addClass('text-success');
                $('#response_notas_'+pqt_id).html('Notas guardadas');
            }
            else if(response=='0'){
                $('#response_notas_'+pqt_id).removeClass('text-success');
                $('#response_notas_'+pqt_id).addClass('text-danger');
                $('#response_notas_'+pqt_id).html('Error al guardar las notas!');
            }
        }
    });
}
function buscar_day_by_day_quotes(destino) {
    console.log('destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../package/buscar-day-by-day/ajax',
        data: 'destino='+destino,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#resultado_busqueda').html('');
            $('#resultado_busqueda').html(data);
        }
    })
}
function  modificar_fecha(titulo,fecha,iti_id,tipo,nombre_dia){
    console.log('fecha:'+fecha+',iti_id:'+iti_id);
    $('#rp_cambio_fecha_'+iti_id).removeClass('text-danger');
    $('#rp_cambio_fecha_'+iti_id).removeClass('text-success');
    $('#rp_cambio_fecha_'+iti_id).addClass('text-primary');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    if(tipo=='s') {
        $.ajax({
            type: 'POST',
            url: '../../../../../quotes/new/step1/cambiar-fecha/ajax',
            data: 'fecha=' + fecha + '&iti_id=' + iti_id+ '&titulo=' + titulo+'&nombre_dia='+nombre_dia,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function () {
                $('#rp_cambio_fecha_' + iti_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function (data) {
                if (data == '1') {
                    var fecha1 = fecha.split('-');
                    $('#iti_fecha_b_' + iti_id).html(fecha1[2] + '-' + fecha1[1] + '-' + fecha1[0]);
                    titulo = titulo.toLowerCase().replace(/\b[a-z]/g, function(letra) {
                        return letra.toUpperCase();
                    });
                    $('#iti_titulo_b_' + iti_id).html( titulo);
                    $('#iti_dia_nombre_' + iti_id).html( nombre_dia);
                    $('#rp_cambio_fecha_' + iti_id).addClass('text-success');
                    $('#rp_cambio_fecha_' + iti_id).html('Datos cambiados correctamente');
                }
                else {
                    $('#rp_cambio_fecha_' + iti_id).addClass('text-danger');
                    $('#rp_cambio_fecha_' + iti_id).html('Error al cambiar los datos');
                }
            }
        })
    }
    else{
        $.ajax({
            type: 'POST',
            url: '../../../../../../quotes/new/step1/cambiar-fecha/ajax',
            data: 'fecha='+fecha+'&iti_id='+iti_id+ '&titulo=' + titulo+'&nombre_dia='+nombre_dia,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function() {
                    $('#rp_cambio_fecha_'+iti_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function(data){
                if(data=='1'){
                    var fecha1=fecha.split('-');
                    $('#iti_fecha_b_'+iti_id).html(fecha1[2]+'-'+fecha1[1]+'-'+fecha1[0]);
                    titulo = titulo.toLowerCase().replace(/\b[a-z]/g, function(letra) {
                        return letra.toUpperCase();
                    });
                    $('#iti_titulo_b_' + iti_id).html(titulo);
                    $('#iti_dia_nombre_' + iti_id).html( nombre_dia);
                    $('#rp_cambio_fecha_'+iti_id).addClass('text-success');
                    $('#rp_cambio_fecha_'+iti_id).html('Datos cambiados correctamente');
                }
                else{
                    $('#rp_cambio_fecha_'+iti_id).addClass('text-danger');
                    $('#rp_cambio_fecha_' + iti_id).html('Error al cambiar los datos');
                }
            }
        })
    }
}
function  mostrar_banco_proveedor(cta_goto,paquete_cotizaciones_id,proveedor_id,grupo){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../listar/proveedores/ajax',
        data: 'cta_goto='+cta_goto+'&paquete_cotizaciones_id='+paquete_cotizaciones_id+'&proveedor_id='+proveedor_id+'&grupo='+grupo,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#cb_cci_'+paquete_cotizaciones_id+'_'+proveedor_id).html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#cb_cci_'+paquete_cotizaciones_id+'_'+proveedor_id).html(data);
        }
    })
}

function validarSiNumero(numero){
    let flat=true;
    // if (!/^[0-9]+([.][0-9]{1,2})?$/.test(numero))
    //     flat=false;
    return flat;
}
function guardar_nota(id) {
    console.log('nueva nota');
    tinymce.triggerSave();
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $('#guardar_notas_'+id).attr('action'),
            data: $('#guardar_notas_'+id).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function(data1){
                $('#rpt_nota_'+id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data){
                if(data==1){
                    $('#rpt_nota_'+id).removeClass('text-danger');
                    $('#rpt_nota_'+id).addClass('text-success');
                    $('#rpt_nota_'+id).html('Nota guardada correctamente');
                }
                else{
                    $('#rpt_nota_'+id).removeClass('text-success');
                    $('#rpt_nota_'+id).addClass('text-danger');
                    $('#rpt_nota_'+id).html('Error, no se pudo guardar la nota');
                }
            }
        });
}
function mostrarleads(page,mes,anio){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../current-quote/leads",
        data: 'page='+page+'&mes='+mes+'&anio='+anio,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#leads').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#leads').html(data);

        }
    });
}
function buscar_pqts(pagina,duracion){
    destinos='';
    var valorci='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci=$(this).val().split('_');
            destinos+=valorci[1]+'/';
        }
    });
    destinos=destinos.substr(0,destinos.length-1);
    if(destinos!=''){
        console.log('pagina:'+pagina+',duracion:'+duracion);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: "../../new/profile/list-paquetes",
            data: 'pagina='+pagina+'&duracion='+duracion+'&destinos='+destinos+'&estrellas='+$('#estrellas_from').val(),
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function(data1){
                $('#pqts').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data){
                $('#pqts').html(data);

            }
        });
    }
    else{
        swal(
            'MENSAJE DEL SISTEMA',
            'Escoja por lo menos un destino.',
            'warning'
        )
    }
}

function anular_servicio_reservas(id,servicio,tipo) {
    // alert('holaaa');
    var estado='';
    if(tipo=='S')
        estado=$("#serv_anulado_" + id).val();
    else if(tipo=='H')
        estado=$("#hotel_anulado_" + id).val();
    console.log('estado:'+estado);

    var msj='';
    var msj2='';
    if(estado==1) {
        msj = '<b class="badge badge-danger">Anular </b>';
        msj2='Anulado ';
    }else {
        msj = '<b class="badge badge-g-green">Activar </b>';
        msj2='Activado ';
    }
    swal({
        title: 'MENSAJE DEL SISTEMA',
        html: "¿Estas seguro de "+msj+servicio+" ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        if(tipo=='S') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $.post('/admin/book/servicio/anular', 'id=' + id+'&estado=' + estado, function (data) {
                if (data == 1) {
                    // $("#lista_destinos_"+id).remove();
                    if(estado==1) {
                        $("#servicio_" + id).addClass('alert alert-danger');
                        $("#serv_anulado_" + id).val('0');
                    }else if(estado==0) {
                        $("#servicio_" + id).removeClass('alert alert-danger');
                        $("#serv_anulado_" + id).val('1');
                    }
                    swal(
                        'Mensaje del sistema',
                        'Se '+msj2+' el servicio',
                        'success'
                    )
                }
            }).fail(function (data) {
            });
        }
        else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $.post('/admin/book/hotel/anular', 'id=' + id+'&estado=' + estado, function (data) {
                if(data == 1) {
                    // $("#lista_destinos_"+id).remove();
                    if(estado==1) {
                        $("#hotel_" + id).addClass('alert alert-danger');
                        $("#hotel_anulado_" + id).val('0');
                    }else if(estado==0) {
                        $("#hotel_" + id).removeClass('alert alert-danger');
                        $("#hotel_anulado_" + id).val('0');
                    }
                    swal(
                        'Mensaje del sistema',
                        'Se '+msj2+' el hotel',
                        'success'
                    )
                }
            }).fail(function (data) {
            });
        }
    })
}
function mostrarreservas(mes,anio){
    console.log('mes:'+mes+',anio:'+anio);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../admin/book/list-paquetes",
        data: 'mes='+mes+'&anio='+anio,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#reservas').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#reservas').html(data);
        }
    });
}

function buscar_reserva(valor1,valor2,columna,campo){
    console.log('valor1:'+valor1);
    console.log('valor2:'+valor2);
    console.log('columna:'+columna);
    console.log('campo:'+campo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../admin/book/list-paquetes",
        data: 'valor1='+valor1+'&valor2='+valor2+'&campo='+campo+'&columna='+columna,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#'+columna).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#'+columna).html(data);
        }
    });
}
function llamar_hoteles(loca,tipo,id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../../../list-localizacion-hoteles",
        data: 'loca='+loca+'&id='+id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#lista_hoteles_'+tipo+'_'+id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#lista_hoteles_'+tipo+'_'+id).html(data);
        }
    });
}
function mostrar_reporte(desde,hasta) {
    var filtro = $('input[name="filtro"]:checked').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "reportes/profit",
        data: 'desde='+desde+'&hasta='+hasta+'&filtro='+filtro,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data){
            $('#rpt_profit').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#rpt_profit').html(data);
        }
    });
}

function mostrar_ventas_expedia(anio,mes,page){
    $.ajax({
        data:"",
        url:   "../../../expedia/"+anio+"/"+mes+"/"+page,
        type:  'GET',
    });
}

function mostrar_opcion(opcion){
    if(opcion=='POR CODIGO'){
        $('#from').addClass('d-none');
        $('#to').addClass('d-none');
        $('#nombre').addClass('d-none');
        $('#codigo').removeClass('d-none');
        $('#bloque_filtros').removeClass('d-none');
    }
    else if(opcion=='POR NOMBRE'){
        $('#from').addClass('d-none');
        $('#to').addClass('d-none');
        $('#codigo').addClass('d-none');
        $('#nombre').removeClass('d-none');
        $('#bloque_filtros').removeClass('d-none');
    }
    else if(opcion=='TODOS LOS PENDIENTES' || opcion=='TODOS LOS URGENTES'){
        $('#from').addClass('d-none');
        $('#to').addClass('d-none');
        $('#codigo').addClass('d-none');
        $('#nombre').addClass('d-none');
        $('#bloque_filtros').removeClass('d-none');

    }
    else if(opcion=='ENTRE DOS FECHAS' || opcion=='ENTRE DOS FECHAS URGENTES'){
        $('#from').removeClass('d-none');
        $('#to').removeClass('d-none');
        $('#codigo').addClass('d-none');
        $('#nombre').addClass('d-none');
        $('#bloque_filtros').removeClass('d-none');
    }
}
function buscar_servicios_pagos_pendientes_entradas(opcion,nombre,codigo,ini,fin,servicio) {
    console.log('opcion:'+opcion+',nombre:' + nombre+',codigo:' + codigo  +',ini:' + ini + ' - fin:' + fin + ' - servicio:' + servicio);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $('#rpt_'+servicio).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');

    $.post('/admin/contabilidad/pagos/entradas/pendientes/filtrar', 'opcion=' + opcion +'&nombre=' + nombre+'&codigo=' + codigo+'&ini=' + ini + '&fin=' + fin + '&grupo=' + servicio, function (data) {
        $('#rpt_' + servicio).html(data);
    }).fail(function (data) {
    });
}
function mostrar_filtro_reservas(valor,tipo){
    $('#show-codigo-'+tipo).addClass('d-none');
    $('#show-nombre-'+tipo).addClass('d-none');
    $('#show-fechas-'+tipo).addClass('d-none');
    $('#show-anio-mes-'+tipo).addClass('d-none');

    $('#'+valor).removeClass('d-none');
}
function eliminar_servicio_consulta(id,servicio){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: '¿Estas seguro de eliminar el servicio <b class="text-primary">'+servicio+'</b> de la lista?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#item-entrada-'+id).fadeOut();
        $('#item-entrada-'+id).remove();
        calcular();
    })
}

function mostrar_filtros(opcion){
    $('#file').addClass('d-none');
    $('#fechas').addClass('d-none');
    if(opcion=='codigo'||opcion=='nombre')
        $('#file').removeClass('d-none');
    else
        $('#'+opcion).removeClass('d-none');

}
function mostrar_busqueda_situacion_servicios(opcion,dato1,dato2){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        data: 'opcion='+opcion+'&dato1='+dato1+'&dato2='+dato2,
        url: '../traer-situacion-servicios',
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#rpt_situacion_servicios').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data) {
            $('#rpt_situacion_servicios').html(data);
        }
    })
}
function mostrar_acomodacion(estrellas){
    filtrar_estrellas1(estrellas);
    if(estrellas==0) {
        $('#acomodacion').addClass('d-none');
        // $('#a_s_1').val('0');
        // $('#a_d_1').val('0');
        // $('#a_m_1').val('0');
        // $('#a_t_1').val('0');
    }
    else
        $('#acomodacion').removeClass('d-none');
}
function mostrar_acomodacion(estrellas){
    filtrar_estrellas1(estrellas);
    if(estrellas==0) {
        $('#acomodacion').addClass('d-none');
        // $('#a_s_1').val('0');
        // $('#a_d_1').val('0');
        // $('#a_m_1').val('0');
        // $('#a_t_1').val('0');
    }
    else
        $('#acomodacion').removeClass('d-none');
}
function cambiar_estado(servicio,parte,id){
    var estado=$('#'+parte+id).val();
    console.log('estado:'+estado);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../admin/servicio/cambiar-estado', 'id='+id+'&estado='+estado, function(data) {
        if(data==1){
            if(estado=='0'){
                $('#btn_'+id).html('<i class="fas fa-toggle-on text-success"></i>');
                $('#'+parte+id).val('1');
            }
            else if(estado=='1'){
                $('#btn_'+id).html('<i class="fas fa-toggle-off text-unset"></i>');
                $('#'+parte+id).val('0');
            }
        }
    }).fail(function (data) {

    });
}
function Anular_cotizacion(id,titulo) {
    var anular=$('#hanulado_'+id).val();
    var valor=0;
    var msj='anular';
    if(anular==0){
        valor=1;
        msj='activar';
    }
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de "+msj+" la cotizacion "+titulo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#anulado_'+id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/cotizacion/anular', 'id='+id+'&anular='+valor, function(data) {
            if(data==1){
                if(anular==1){
                    $('#anulado_'+id).html('<i class="fas fa-times-circle text-grey-goto"></i>');
                    $('#hanulado_'+id).val('0');
                }
                else if(anular==0){
                    $('#anulado_'+id).html('<i class="fas fa-check-circle text-success"></i>');
                    $('#hanulado_'+id).val('1');
                }
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}

function ingresar_datos(pqt_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type:  'post',
        url:   $('#ingresar_idatos_'+pqt_id).attr('action'),
        data:  $('#ingresar_idatos_'+pqt_id).serialize(),
        beforeSend:function(res){
            $('#response_idatos_'+pqt_id).removeClass('text-danger');
            $('#response_idatos_'+pqt_id).removeClass('text-success');
            $('#response_idatos_'+pqt_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Loading');
        }
        ,success:  function (response) {
            console.log('response:'+response);
            if(response=='1'){
                $('#response_idatos_'+pqt_id).removeClass('text-danger');
                $('#response_idatos_'+pqt_id).addClass('text-success');
                $('#response_idatos_'+pqt_id).html('Notas guardadas');
            }
            else if(response=='0'){
                $('#response_idatos_'+pqt_id).removeClass('text-success');
                $('#response_idatos_'+pqt_id).addClass('text-danger');
                $('#response_idatos_'+pqt_id).html('Error al guardar las notas!');
            }
        }
    });
}

function eliminar_profit(id,pagina) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar los profit para la pagina "+pagina+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/profit/delete', 'id='+id+'&pagina='+pagina, function(data) {
            console.log(data);
            if(data==1){
                $("#"+id).remove();
                $("#"+id).fadeOut( "slow");
                swal(
                    'Mensaje del sistema',
                    'Se borraron los profits de la pagina '+pagina,
                    'success'
                )
            }
            if(data==0){
                swal(
                    'Porque no puedo borrar?',
                    'Algo salio mal, vuelva a intentarlo mas tarde',
                    'warning'
                )
            }
        }).fail(function (data) {
        });
    })
}

function pintar(id){

    $('#in').parent().removeClass("btn-primary");
    $('#general').parent().removeClass("btn-primary");
    $('#out').parent().removeClass("btn-primary");
    $('#in').parent().addClass("btn-info");
    $('#general').parent().addClass("btn-info");
    $('#out').parent().addClass("btn-info");

    $('#'+id).parent().removeClass("btn-info");
    $('#'+id).parent().addClass("btn-primary");
}
// function doProgress(evt) {
//     if (evt.lengthComputable) {
//         var percentComplete = evt.loaded / evt.total;
//         console.log(percentComplete);
//         $('.progress').attr({
//             value: percentComplete * 100
//         });
//         if (percentComplete === 1) {
//             $('.progress').addClass('hide');
//         }
//     }
//   }
function buscar_pagos_pendientes(tipo_pago,opcion,nombre,codigo,ini,fin,servicio){
    console.log('opcion:'+opcion+',nombre:'+nombre+',codigo:'+codigo+',ini:'+ini+',fin:'+fin+',servicio:'+servicio);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: '/admin/contabilidad/pagos-en-genral/pendientes/filtrar',
        type: 'post',
        data: 'tipo_pago=' + tipo_pago +'&opcion=' + opcion +'&nombre=' + nombre+'&codigo=' + codigo+'&ini=' + ini + '&fin=' + fin + '&grupo=' + servicio,
        beforeSend:function() {
            $("#rpt_hotel").html('');
            $("#rpt_hotel").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
            $('#rpt_hotel').html(data);
        },
        error: function () {

        }
    });
}

function traer_datos(clave,grupo,clase,lista_items,nro_personas,estado_contabilidad){

    $('#'+grupo+'_'+clase+'_datos_'+clave).html('');
    $('#'+grupo+'_'+clase+'_datos_'+clave).addClass('text-center');
    $('#'+grupo+'_'+clase+'_datos_'+clave).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    $.ajax({
        url: '/admin/contabilidad/operaciones/traer-datos',
        type: 'post',
        data: 'clave='+clave+'&grupo='+grupo+'&clase='+clase+'&lista_items='+lista_items+'&nro_personas='+nro_personas+'&estado_contabilidad='+estado_contabilidad+'&operacion=ver',
        success: function (data) {
            $('#'+grupo+'_'+clase+'_datos_'+clave).removeClass('text-center');
            $('#'+grupo+'_'+clase+'_datos_'+clave).html('');
            $('#'+grupo+'_'+clase+'_datos_'+clave).html(data);
        },
        error: function () {

        }
    });
}

function contabilidad_hotel_store(grupo,clave){
    console.log('clave:'+clave);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    $.ajax({
        url: $('#form_'+grupo+'_'+clave).attr('action'),
        type: 'post',
        data: $('#form_'+grupo+'_'+clave).serialize(),
        // dataType:'json',
        // contentType:false,
        // cache:false,
        // processData: false,
        beforeSend:
        function() {
            $('#rpt_'+grupo+'_'+clave).html('');
            $('#rpt_'+grupo+'_'+clave).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
            $('#monto_'+grupo+'_c_'+clave).html($('#precio_total_'+clave).val());
            $('#rpt_'+grupo+'_'+clave).html('');
            $('#rpt_'+grupo+'_'+clave).html(data.mensaje);
            console.log('total obtenido:'+data.total);
            if(data.total>0){

            console.log('total>0:'+data.total);
                $("#chb_"+grupo+"_"+clave).prop('disabled', false);
                $("#warning_"+grupo+"_"+clave).addClass('d-none');
                $("#warning_"+grupo+"_"+clave).html('costo ingresado');

            }
            else{
                console.log('total<=0:'+data.total);
                $("#chb_"+grupo+"_"+clave).prop('disabled', true);

            }
        },
        error: function () {

        }
    });
}
function preparar_envio(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    var cost_s_serv=$('#cost_s_serv').val();
    var cost_d_serv=$('#cost_d_serv').val();
    var cost_m_serv=$('#cost_m_serv').val();
    var cost_t_serv=$('#cost_t_serv').val();
    var cost_sh_serv=$('#cost_sh_serv').val();

    var utilidad_s_serv=$('#utilidad_s_serv').val();
    var utilidad_d_serv=$('#utilidad_d_serv').val();
    var utilidad_m_serv=$('#utilidad_m_serv').val();
    var utilidad_t_serv=$('#utilidad_t_serv').val();
    var utilidad_sh_serv=$('#utilidad_sh_serv').val();

    var pv_s_serv=$('#pv_s_serv').val();
    var pv_d_serv=$('#pv_d_serv').val();
    var pv_m_serv=$('#pv_m_serv').val();
    var pv_t_serv=$('#pv_t_serv').val();
    var pv_sh_serv=$('#pv_sh_serv').val();

    var con_sin_hotel=$('#con_sin_hotel').val();
    var acomodacion_hotel=$('#acomodacion_hotel').val();
    $.ajax({
        url: $('#'+id).attr('action'),
        type: 'post',
        data: $('#'+id).serialize()
        +'&cost_s_serv='+cost_s_serv+'&cost_d_serv='+cost_d_serv+'&cost_m_serv='+cost_m_serv+'&cost_sh_serv='+cost_sh_serv+'&pv_s_serv='+pv_s_serv+'&pv_d_serv='+pv_d_serv+'&pv_m_serv='+pv_m_serv+'&pv_t_serv='+pv_t_serv+'&pv_sh_serv='+pv_sh_serv+'&con_sin_hotel='+con_sin_hotel+'&acomodacion_hotel='+acomodacion_hotel,
        success: function (data) {
            console.log('rpt:');
            console.log(data.mensaje);
            location.reload();
        },
        error: function () {

        }
    });
}
function buscar_day_by_day_quotes_step1(destino) {
    console.log('destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../../../../package/buscar-day-by-day/ajax/dia',
        data: 'destino='+destino,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#resultado_busqueda').html('');
            $('#resultado_busqueda').html(data);
        }
    });
}
// function cambiar_servicio_paso1(id){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('[name="_token"]').val()
//         }
//     });

//     var cost_s_serv=$('#cost_s_serv').val();
//     var cost_d_serv=$('#cost_d_serv').val();
//     var cost_m_serv=$('#cost_m_serv').val();
//     var cost_t_serv=$('#cost_t_serv').val();
//     var cost_sh_serv=$('#cost_sh_serv').val();

//     var utilidad_s_serv=$('#utilidad_s_serv').val();
//     var utilidad_d_serv=$('#utilidad_d_serv').val();
//     var utilidad_m_serv=$('#utilidad_m_serv').val();
//     var utilidad_t_serv=$('#utilidad_t_serv').val();
//     var utilidad_sh_serv=$('#utilidad_sh_serv').val();

//     var pv_s_serv=$('#pv_s_serv').val();
//     var pv_d_serv=$('#pv_d_serv').val();
//     var pv_m_serv=$('#pv_m_serv').val();
//     var pv_t_serv=$('#pv_t_serv').val();
//     var pv_sh_serv=$('#pv_sh_serv').val();

//     var con_sin_hotel=$('#con_sin_hotel').val();
//     var acomodacion_hotel=$('#acomodacion_hotel').val();

//     // $('#'+id).append();
//     $.ajax({
//         url: $('#'+id).attr('action'),
//         type: 'post',
//         data: $('#'+id).serialize()+'&cost_s_serv='+cost_s_serv+'&cost_d_serv='+cost_d_serv+'&cost_m_serv='+cost_m_serv+'&cost_sh_serv='+cost_sh_serv+'&pv_s_serv='+pv_s_serv+'&pv_d_serv='+pv_d_serv+'&pv_m_serv='+pv_m_serv+'&pv_t_serv='+pv_t_serv+'&pv_sh_serv='+pv_sh_serv+'&con_sin_hotel='+con_sin_hotel+'&acomodacion_hotel='+acomodacion_hotel,
//         // dataType:'json',
//         // contentType:false,
//         // cache:false,
//         // processData: false,
//         success: function (data) {
//             console.log(data.mensaje);
//             location.reload();
//         },
//         error: function () {

//         }
//     });
// }



function agregar_plan_pago(paquete_id){
    var nropagos=$('#nro_pagos_'+paquete_id).val();
    nropagos++;
    $('#nro_pagos_'+paquete_id).val(nropagos);
    var nro_hijos=$('#lista_pagos_'+paquete_id).children().length;
    var opctions=$('#opctions').html();
    var tipo_opctions=$('#tipo_opctions').html();
    var cadena=''+
            '<tr id="pago_'+paquete_id+'_'+nropagos+'">'+
            '<td style="width:50px" class="cuota_nro d-none">Cuota 0'+nropagos+'</td>'+
            '<td style="width:180px;"><input type="date" class="form-control" name="fecha_pago[]" id="fecha_pago_'+paquete_id+'_'+nropagos+'" style="width:180px"  required></td>'+
            '<td style="width:180px;"><select class="form-control" name="forma_pago[]" id="forma_pago_'+paquete_id+'_'+nropagos+'" required>'
            +opctions+'</select></td>'+
            '<td style="width:200px;"><select class="form-control" name="tipo_forma_pago[]" id="tipo_forma_pago_'+paquete_id+'_'+nropagos+'" required>'
            +tipo_opctions+'</select></td>'+
            '<td style="width:200px;"><input type="text" class="form-control" name="nota_pago[]" id="nota_pago_'+paquete_id+'_'+nropagos+'" required></td>'+
            '<td style="width:100px"><input type="text" class="form-control" name="monto_pago[]" id="monto_pago_'+paquete_id+'_'+nropagos+'" style="width:100px" onkeyup="sumar_pagos_monto(\''+paquete_id+'\')" required></td>'+
            '<td style="width:150px;"><input type="text" class="form-control" name="numero_operacion[]" id="numero_operacion_'+paquete_id+'_'+nropagos+'" required></td>'+
            '<td style="width:120px">'+
            '<input type="hidden" name="estado_pago[]" id="confirmar_pagos_'+paquete_id+'_'+nropagos+'" value="0"> '+
            '<button type="button"  class="btn btn-unset" id="btn_confirmar_'+paquete_id+'_'+nropagos+'" onclick="cambiar_estado_plan_pagos(\''+paquete_id+'\',\''+nropagos+'\')">'+
            '       <i class="fas fa-unlock"></i>   '+
            '   </button>'+
            '   <button type="button"  class="btn btn-danger" onclick="borrar_plan_pago(\''+paquete_id+'\',\''+nropagos+'\')">'+
            '       <i class="fas fa-trash-alt"></i>   '+
            '   </button>'+
            '</td>'+
            '</tr>';
            $('#lista_pagos_'+paquete_id).append(cadena);
}

function borrar_plan_pago(paquete_id,nropagos){
    $('#pago_'+paquete_id+'_'+nropagos).remove();
    var nropagos=$('#nro_pagos_'+paquete_id).val();
    nropagos--;
    $('#nro_pagos_'+paquete_id).val(nropagos);

// cuota_nro
    var i=1;
    $(".cuota_nro").each(function(){
        var divcito = $(this).html('Cuota 0'+i);
        i++;
    });
    sumar_pagos_monto(paquete_id);
}
//-- Revisar esta funcion porque ya se tiene otra con el mismo nombre, al parecer tiene que ver con los palnes de pagos de las cotizaciones
function cambiar_estado_plan_pagos(paquete_id,pos){
    console.log('paquete_id:'+paquete_id+',pos:'+pos);
    var estado=$('#confirmar_pagos_'+paquete_id+'_'+pos).val();
    if(estado==0){
        $('#btn_confirmar_'+paquete_id+'_'+pos).removeClass('btn-unset');
        $('#btn_confirmar_'+paquete_id+'_'+pos).addClass('btn-success');
        $('#btn_confirmar_'+paquete_id+'_'+pos).html('<i class="fas fa-lock"></i>');
        // $('#fecha_pago_'+paquete_id+'_'+pos).attr('readonly', true);
        // $('#monto_pago_'+paquete_id+'_'+pos).attr('readonly', true);
        // $('#nota_pago_'+paquete_id+'_'+pos).attr('readonly', true);
        $('#confirmar_pagos_'+paquete_id+'_'+pos).val('1');
    }
    else if(estado==1){
        $('#btn_confirmar_'+paquete_id+'_'+pos).removeClass('btn-success');
        $('#btn_confirmar_'+paquete_id+'_'+pos).addClass('btn-unset');
        $('#btn_confirmar_'+paquete_id+'_'+pos).html('<i class="fas fa-unlock"></i>');
        // $('#fecha_pago_'+paquete_id+'_'+pos).attr('readonly', false);
        // $('#monto_pago_'+paquete_id+'_'+pos).attr('readonly', false);
        // $('#nota_pago_'+paquete_id+'_'+pos).attr('readonly', false);
        $('#confirmar_pagos_'+paquete_id+'_'+pos).val('0');
    }
}

function preparar_envio_pagos(id,paquete_id){
    $('#'+id).submit(function() {
        console.log('total:'+$('#total_'+paquete_id).val()+',total_pago'+$('#total_pago_'+paquete_id).val());
        /*if(parseFloat($('#total_'+paquete_id).val())<parseFloat($('#total_pago_'+paquete_id).val())){
            swal(
                'MESANJE DEL SISTEMA',
                'La sumatoria es menor al total.',
                'warning'
            )
            return false;
        }
        else if(parseFloat($('#total_'+paquete_id).val())>parseFloat($('#total_pago_'+paquete_id).val())){
            swal(
                'MESANJE DEL SISTEMA',
                'La sumatoria es mayor al total.',
                'warning'
            )
            return false;
        }*/
        // Enviamos el formulario usando AJAX
        // $.ajax({
        //     type: 'POST',
        //     url: $(this).attr('action'),
        //     data: $(this).serialize(),
        //     // Mostramos un mensaje con la respuesta de PHP
        //     success: function(data) {
        //         if(data==1){
        //             $('#for_'+id).addClass('d-none');

        //             $('#result_'+id).removeClass('text-danger');
        //             $('#result_'+id).addClass('text-success');
        //             $('#result_'+id).html('Pago guardado Correctamente!');
        //         }
        //         else{
        //             $('#result_'+id).removeClass('text-success');
        //             $('#result_'+id).addClass('text-danger');
        //             $('#result_'+id).html('Error al pagar, intentelo de nuevo');
        //         }
        //     }
        // })
        // return false;
    });

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('[name="_token"]').val()
    //     }
    // });

    // $.ajax({
    //     url: $('#'+id).attr('action'),
    //     type: 'post',
    //     data: $('#'+id).serialize(),
    //     success: function (data) {
    //         console.log(data.mensaje);
    //         // location.reload();
    //         if(data.mensaje=='1'){
    //             swal(
    //                 'MESANJE DEL SISTEMA',
    //                 'Datos guardados correctamente.',
    //                 'success'
    //             )
    //         }
    //     },
    //     error: function () {

    //     }
    // });
}

function sumar_pagos_monto(paquete_id){
    console.log('sumar_pagos_monto');
    var suma=0;
    $("input[name='monto_pago[]']").each(function(indice, elemento) {
        if($.isNumeric($(elemento).val()))
            suma+=parseFloat($(elemento).val());
    });
    $("input[name='monto_pago_[]']").each(function(indice, elemento) {
        if($.isNumeric($(elemento).val()))
            suma+=parseFloat($(elemento).val());
    });
    suma=suma.toFixed(2);
    $('#total_'+paquete_id).val(suma);
    var total_pago=$('#total_pago_'+paquete_id).val();
    var falta=total_pago-suma;
    $('#falta_'+paquete_id).html(falta);
}

function buscar_pagos(valor1,valor2,columna,campo,pagina){
    console.log('valor1:'+valor1);
    console.log('valor2:'+valor2);
    console.log('columna:'+columna);
    console.log('campo:'+campo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../ingresos/lista-pagos",
        data: 'valor1='+valor1+'&valor2='+valor2+'&campo='+campo+'&columna='+columna+'&pagina='+pagina,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#'+columna).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#'+columna).html(data);
        }
    });
}

function filtrar_(valor,tipo){

    if(valor!='ENTRE FECHAS'){
        $('#fechas_'+tipo).addClass('d-none');
    }
    else if(valor=='ENTRE FECHAS'){
        $('#fechas_'+tipo).removeClass('d-none');

    }
}
function pagos_recientes(filtro,f1,f2,rpt){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../ingresos/buscar-pagos-recientes",
        data: 'filtro='+filtro+'&f1='+f1+'&f2='+f2,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#'+rpt).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#'+rpt).html(data);
        }
    });
}

function call_popup(estrellas,localizacion,rpt_id,hotel_id,itinerario_cotizaciones_id,cotizacion_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../book/hotel/traer-lista-proveedores",
        data: 'estrellas='+estrellas+'&localizacion='+localizacion+'&hotel_id='+hotel_id+'&itinerario_cotizaciones_id='+itinerario_cotizaciones_id+'&cotizacion_id='+cotizacion_id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#'+rpt_id).html(data);
        }
    });
}
function call_popup_servicios(rpt_id,servicio_id,arreglo,cotizacion_id,itinerario_id,action){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../book/servicios/traer-lista-proveedores",
        data: 'servicio_id='+servicio_id+'&arreglo='+arreglo+'&cotizacion_id='+cotizacion_id+'&itinerario_id='+itinerario_id+'&action='+action,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#'+rpt_id).html(data);
        }
    });
}


function sumar_hotel_subtotales(clave){
    var suma=0;
    // sumamos los single
    $("input[name='precio_s_c_"+clave+"[]']").each(function(index,value) {
        console.log('valor_s:'+$(value).val());
        if($.isNumeric($(value).val())){
            suma+=parseFloat($(value).val());
        }
    });
    // sumamos los double
    $("input[name='precio_d_c_"+clave+"[]']").each(function(index,value) {

        console.log('valor_d:'+$(value).val());
        if($.isNumeric($(value).val())){
            suma+=parseFloat($(value).val());
        }
    });
    // sumamos los double
    $("input[name='precio_m_c_"+clave+"[]']").each(function(index,value) {

        console.log('valor_m:'+$(value).val());
        if($.isNumeric($(value).val())){
            suma+=parseFloat($(value).val());
        }
    });
    // sumamos los double
    $("input[name='precio_t_c_"+clave+"[]']").each(function(index,value) {

        console.log('valor_t:'+$(value).val());
        if($.isNumeric($(value).val())){
            suma+=parseFloat($(value).val());
        }
    });
    console.log('suma:'+suma);
    $('#precio_total_'+clave).val(suma);

}
function contabilidad_guardar_notas_requerimiento(clave,grupo,servicio){
    tinymce.triggerSave();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: $('#form_notas_'+grupo+'_'+clave).attr('action'),
        type: 'post',
        data: $('#form_notas_'+grupo+'_'+clave).serialize(),
        beforeSend: function() {
            $('#rpt_notas_'+grupo+'_'+clave).html('');
            $('#rpt_notas_'+grupo+'_'+clave).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
            $('#rpt_notas_'+grupo+'_'+clave).html('');
            $('#rpt_notas_'+grupo+'_'+clave).html(data.mensaje);
        },
        error: function () {

        }
    });
}
function estado_contabilidad(id,proveedor,hoteles,grupo) {

    var solicitado=$('#s_total').html();
    var aprovado=parseFloat($('#s_total_aprovado').html());
    var suma_resta=parseFloat($('#monto_c_'+id).html());
    var anular=$('#hestado_contabilidad_'+id).val();
    var valor=4;
    var msj='Aprobar';
    if(anular==4){
        valor=3;
        msj='Descartar';
    }

    // alert('holaaa');
    // swal({
    //     title: 'MENSAJE DEL SISTEMA',
    //     text: "¿Estas seguro de "+msj+" el pago para el proveedor "+proveedor+"?",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes'
    // }).then(function () {
        // $('#estado_contabilidad_'+id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../estado-contabiliadad/cambiar/contabilidad', 'id='+id+'&valor='+valor+'&hoteles='+hoteles+'&grupo='+grupo, function(data) {
            if(data==1){
                if(anular==3){
                    $('#estado_view_'+id).html('<b class="badge badge-danger">Observado</b>');
                    $('#estado_contabilidad_'+id).html('<i class="fas fa-toggle-off fa-3x text-danger"></i>');
                    $('#hestado_contabilidad_'+id).val('4');
                    aprovado-=suma_resta;
                }
                else if(anular==4){
                    $('#estado_view_'+id).html('<b class="badge badge-primary">Aprovado</b>');
                    $('#estado_contabilidad_'+id).html('<i class="fas fa-toggle-on fa-3x text-success"></i>');
                    $('#hestado_contabilidad_'+id).val('3');
                    aprovado+=suma_resta;
                }
                $('#s_total_aprovado').html(aprovado);
            }
        }).fail(function (data) {
            console.log(data);
        });

    // })
}
function sr_programar_pagos_h(clave){

}
function traer_datos_detalle(clave,grupo,clase,lista_items,nro_personas,operacion,estado_contabilidad){

    // $('#'+grupo+'_'+clase+'_datos_'+clave).html('');
    $('#'+grupo+'_'+clase+'_datos_'+clave).html('');
    $('#'+grupo+'_'+clase+'_datos_'+clave).addClass('text-center');
    $('#'+grupo+'_'+clase+'_datos_'+clave).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    $.ajax({
        url: '/admin/contabilidad/operaciones/traer-datos',
        type: 'post',
        data: 'clave='+clave+'&grupo='+grupo+'&lista_items='+lista_items+'&nro_personas='+nro_personas+'&view=no-edit'+'&operacion='+operacion+'&estado_contabilidad='+estado_contabilidad,
        success: function (data) {
            $('#'+grupo+'_'+clase+'_datos_'+clave).html('');
            $('#'+grupo+'_'+clase+'_datos_'+clave).html(data);

            // if(data.estado=='1'){
            //     toastr.success('Datos modificados correctamente.','MENSAJE DEL SISTEMA');
            //     $('#fila_'+clave).remove();
            //     $('#datos_'+clave).removeClass('text-center');
            //     $('#datos_'+clave).html('');
            //     $('#datos_'+clave).html(data.mensaje);
            //     // $('#s_total').html(data.s_total);
            //     // $('#s_total_aprovado').html(data.s_total_aprovado);
            // }
            // else if(data.estado=='2'){
            //     $('#datos_'+clave).removeClass('text-center');
            //     $('#datos_'+clave).html('');
            //     $('#datos_'+clave).html(data.mensaje);
            //     // $('#s_total').html(data.s_total);
            //     // $('#s_total_aprovado').html(data.s_total_aprovado);
            // }
        },
        error: function () {

        }
    });
}
function contabilidad_hotel_store_notas(clave){
    console.log('clave:'+clave);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    $.ajax({
        url: $('#form_'+clave).attr('action'),
        type: 'post',
        data: $('#form_'+clave).serialize(),
        // dataType:'json',
        // contentType:false,
        // cache:false,
        // processData: false,
        beforeSend:
        function() {

            $('#rpt_'+clave).html('');
            $('#rpt_'+clave).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function (data) {
            // $('#monto_c_'+clave).html($('#precio_total_'+clave).val());
            $('#rpt_'+clave).html('');
            $('#rpt_'+clave).html(data.mensaje);
            // console.log('total obtenido:'+data.total);
            // if(data.total>0){

            // console.log('total>0:'+data.total);
            //     $("#chb_"+clave).prop('disabled', false);
            //     $("#warning_"+clave).addClass('d-none');
            //     $("#warning_"+clave).html('costo ingresado');

            // }
            // else{
            //     console.log('total<=0:'+data.total);
            //     $("#chb_"+clave).prop('disabled', true);

            // }
        },
        error: function () {

        }
    });
}
function requerimiento_revisado(){
    var operacion=$('#operacion').val();
    if(operacion=='aprobar'){

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
        });
        $.ajax({
            url: $('#form_').attr('action'),
            type: 'post',
            data: $('#form_').serialize(),
            beforeSend:
            function() {
                $('#rpt_').html('');
                $('#rpt_').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function (data) {
                $('#rpt_').html('');
                if(data.operacion=='pagar'){
                    window.location.reload();
                }
                else{
                    $('#rpt_').html(data.mensaje);
                }
            },
            error: function () {

            }
        });

    }
    else{
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "Nota: esta acción quitara los pagos (Observado y Pendiente), si esta de acuerdo proceda.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
        });
        $.ajax({
            url: $('#form_').attr('action'),
            type: 'post',
            data: $('#form_').serialize(),
            beforeSend:
            function() {
                $('#rpt_').html('');
                $('#rpt_').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function (data) {
                $('#rpt_').html('');
                if(data.operacion=='pagar'){
                    window.location.reload();
                }
                else{
                    $('#rpt_').html(data.mensaje);
                }
            },
            error: function () {

            }
        });
    });
    }

}

function pagar_proveedor(id,proveedor,hoteles,grupo) {

    var solicitado=$('#s_total').html();
    var aprovado=parseFloat($('#s_total_aprovado').html());
    var suma_resta=parseFloat($('#monto_c_'+id).html());


    var anular=$('#hestado_contabilidad_'+id).val();
    var valor=5;
    var msj='Aprobar';
    if(anular==5){
        valor=3;
        msj='Descartar';
    }

    // alert('holaaa');
    // swal({
    //     title: 'MENSAJE DEL SISTEMA',
    //     text: "¿Estas seguro de "+msj+" el pago para el proveedor "+proveedor+"?",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes'
    // }).then(function () {
        // $('#estado_contabilidad_'+id).html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../requerimientos/estado-contabiliadad/cambiar/contabilidad', 'id='+id+'&valor='+valor+'&hoteles='+hoteles+'&grupo='+grupo, function(data) {
            if(data==1){
                if(anular==3){
                    $('#estado_view_'+id).html('<b class="badge badge-success">Pagado</b>');
                    // $('#estado_contabilidad_'+id).html('<i class="fas fa-toggle-off fa-3x text-danger"></i>');
                    $('#hestado_contabilidad_'+id).val('5');
                    $('#btn_pagar_'+id).html('Pagado');
                    $('#btn_pagar_'+id).removeClass('btn-primary');
                    $('#btn_pagar_'+id).addClass('btn-success');
                    // aprovado-=suma_resta;
                }
                else if(anular==5){
                    $('#estado_view_'+id).html('<b class="badge badge-primary">Aprovado</b>');
                    // $('#estado_contabilidad_'+id).html('<i class="fas fa-toggle-on fa-3x text-success"></i>');
                    $('#hestado_contabilidad_'+id).val('3');
                    $('#btn_pagar_'+id).html('Pagar');
                    $('#btn_pagar_'+id).removeClass('btn-success');
                    $('#btn_pagar_'+id).addClass('btn-primary');
                    // aprovado+=suma_resta;
                }
                // $('#s_total_aprovado').html(aprovado);
            }
        }).fail(function (data) {
            console.log(data);
        });
    // })
}
// function enviar_consulta(form){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('[name="_token"]').val()
//         }
//     });
//     $.ajax({
//         url: $('#'+form).attr('action'),
//         type: 'post',
//         data: $('#'+form).serialize(),
//         beforeSend:
//         function() {
//             $('#rpt_').html('');
//             $('#rpt_').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
//         },
//         success: function (data) {
//             $('#rpt_').html('');
//             $('#rpt_').html(data.mensaje);
//             $("#btn_enviar").prop('disabled', true);
//         },
//         error: function () {
//         }
//     });
// }

function enviar_consulta(form){
    // swal({
    //     title: 'MENSAJE DEL SISTEMA',
    //     text: "Nota: Esta acción confirmara los costos ingresados por reservas. Si esta deacuerdo prosiga.",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes'
    // }).then(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
        });
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function() {
                    $('#rpt_').html('');
                    $('#rpt_').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function (data) {
                $('#rpt_').html('');
                $('#rpt_').html(data.mensaje);
                $("#btn_enviar").prop('disabled', true);
            },
            error: function () {
            }
        });
    // });

}
function borrar_item_pago(key,grupo,items){
var txt_ini=$('#txt_ini').val();
var txt_fin=$('#txt_fin').val();
// dd($request->all());
var arreglo_h=$('#arreglo_h').val();
var modo_busqueda=$('#modo_busqueda').val();
var chb_h_pagos=$('#chb_h_pagos').val();

    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Esta seguro de borrar de la lista el pago al proveedor",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var total=parseFloat($('#s_total').html());
        var monto_c=parseFloat($('#monto_c_'+key).html());
        $('#s_total').html(total-monto_c);
        $('#monto_solicitado').val(total-monto_c);
        $("#fila_"+grupo+"_"+key).remove();
    })
}
function borrar_items_pago(key,codigo,state){
    var pregunta=state;
    var mensa='Al borrar este registro todos los servicios volveran a mostrarse en la lista de requerimientos incluso los pagos guardados';
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "Nota: "+mensa+",¿Esta seguro de borrar el registro con codigo: "+codigo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/revisar/requerimientos/borrar-lista', 'key='+key, function(data) {
            if(data.estado==1){
                $("#fila_"+key).remove();
                toastr.success(data.mensaje_toastr,'MENSAJE DEL SISTEMA');
            }
            // else if(data.estado==0){
            //     $("#fila_"+key).remove();
            //     toastr.error(data.mensaje_toastr,'MENSAJE DEL SISTEMA');
            // }
        }).fail(function (data) {
        });
    })
}

function borrar_items_pago_uno(key,grupo,items,estado_contabilidad){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Esta seguro de borrar el grupo de pagos con codigo?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/revisar/requerimientos/borrar-lista/uno', 'key='+key+'&grupo='+grupo+'&estado_contabilidad='+estado_contabilidad+'&items='+items, function(data) {
            if(data.estado==1){
                $("#fila_"+key).remove();
                toastr.success(data.mensaje_toastr,'MENSAJE DEL SISTEMA');
            }
            // else if(data.estado==0){
            //     $("#fila_"+key).remove();
            //     toastr.error(data.mensaje_toastr,'MENSAJE DEL SISTEMA');
            // }
        }).fail(function (data) {
        });
    });
}

function calcular_venta_contabilidad(tipo,nropersonas){
    if(tipo=='profit'){
        console.log('holaaaaaa');
        var total_c_boleta=parseFloat($("#total_c_boleta").val());
        var total_c_profit=parseFloat($("#total_c_profit").val());
        if(!$.isNumeric(total_c_profit)){
            $("#total_c_profit").focus();
            toastr.success('Ingrese un numero','MENSAJE DEL SISTEMA');
        }
        console.log('total_c_profit:'+total_c_profit);
        var total_c_vendido=parseFloat($("#total_c_vendido").val());
        var total_c_boleta_=Number(total_c_boleta+total_c_profit*nropersonas).toFixed(2)
        var total_c_factura=Number(total_c_vendido-(total_c_boleta+total_c_profit*nropersonas)).toFixed(2);
        console.log('total_c_boleta:'+total_c_boleta+',total_c_profit+',total_c_profit+',total_c_vendido:'+total_c_vendido+',total_c_factura:'+total_c_factura);
        $("#total_c_boleta_").val(total_c_boleta_);
        $("#total_c_factura").val(total_c_factura);
    }
    else if(tipo=='venta'){
        console.log('holaaaaaa');
        var total_c_vendido=parseFloat($("#total_c_vendido").val());
        var total_c_boleta=parseFloat($("#total_c_boleta_").val());
        // var total_c_factura=parseFloat($("#total_c_factura_html").html());

        if(!$.isNumeric(total_c_vendido)){
            $("#total_c_vendido").focus();
            toastr.success('Ingrese un numero','MENSAJE DEL SISTEMA');
        }
        var total_c_factura=Number(total_c_vendido-total_c_boleta).toFixed(2);
        console.log('total_c_boleta:'+total_c_boleta+',total_c_profit+',total_c_profit+',total_c_vendido:'+total_c_vendido+',total_c_factura:'+total_c_factura);
        $("#total_c_factura").val(total_c_factura);
    }
}
function cambiar_a(para,itinerario_id,servicio_id){
    if(para=='f'){
        var sub_total_v=$("#sub_total_c_boleta_html").html();
        var profit_v=$("#total_c_profit_html").html();
        var total_venta_v=$("#total_c_boleta_html").html();
        var total_factura_v=$("#total_c_factura_html").html();
        var total_venvidido_v=$("#total_c_vendido_html").html();

        var icon=$("#icon_"+itinerario_id+"_"+servicio_id).html();
        var concepto=$("#concepto_"+itinerario_id+"_"+servicio_id).html();
        var calculado=$("#calculado_"+itinerario_id+"_"+servicio_id).html();
        var subtotal=$("#subtotal_"+itinerario_id+"_"+servicio_id).html();
        var proveedor=$("#proveedor_"+itinerario_id+"_"+servicio_id).html();


        var div_creado_copiado='<div id="b_'+itinerario_id+'_'+servicio_id+'" class="row border-0-5 mb-0-5">'+
        '<div class="col-1 pr-0">'+icon+
        '</div>'+
        '<div class="col-3 pr-0">'+concepto+
        '</div>'+
        '<div class="col-2 pr-0">'+calculado+
        '</div>'+
        '<div class="col-2 pr-0 bg-info">'+subtotal+
        '</div>'+
        '<div class="col-3 pr-0">'+proveedor+
        '</div>'+
        '<div class="col-1">'+
            '<button class="btn btn-dark btn-sm" onclick="cambiar_a(\'b\',\''+itinerario_id+'\',\''+servicio_id+'\')"><i class="fas fa-arrow-circle-left"></i></button>'+
        '</div>'+
        '</div>';

        $("#b_"+itinerario_id+"_"+servicio_id).remove();
        $("#f_"+itinerario_id).append(div_creado_copiado);
    }
}

function marcar_checked(clase){

    // if($("input[name="+clase+"]").is(':checked')){//-- si se marco el check
    //     // console.log('Esta marcado');
    //     $('.'+clase).each(function (index) {
    //         if(!$(this).attr('checked')){
    //             $(this).prop('checked', true);
    //             var valor=$(this).val();
    //             var precio_c=$('#monto_'+clase+'_c_'+valor).html();
    //             console.log('precio_c:'+precio_c);
    //         }
    //     });
    // }
    // else{//-- si se desmarco el check
    //     // console.log('No esta marcado');
    //     $('.'+clase).each(function (index) {
    //         if($(this).attr('checked')){
    //             $(this).prop('checked', false);
    //             var valor=$(this).val();
    //             var precio_c=$('#monto_'+clase+'_c_'+valor).html();
    //             console.log('precio_c:'+precio_c);
    //         }
    //     });
    // }
}

function buscar_pagos_pendinetes(form,valor,valor_estatico){
    // $('#'+form).submit(function() {

        // Enviamos el formulario usando AJAX

        if(valor_estatico=='0'){
            // $("#boton").val(0);
            $("#btn_pagados").removeClass('btn-outline-primary');
            $("#btn_pagados").addClass('btn-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='1'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-outline-primary');
            $("#btn_procesados").addClass('btn-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='2'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-outline-primary');
            $("#btn_cerrados").addClass('btn-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='3'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-outline-primary');
            $("#btn_pendientes").addClass('btn-primary');
        }
        $("#opcion").val(valor);
        $.ajax({
            type: 'POST',
            url: $("#"+form).attr('action'),
            data: $("#"+form).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function() {
                    $('#rpt_pr').html('');
                    $('#rpt_pr').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function (data) {
                $('#rpt_pr').html('');
                $('#rpt_pr').html(data);
                // $("#btn_enviar").prop('disabled', true);
            },
            error: function () {
            }
        })
    // });
}
function buscar_ingresos(form,valor,valor_estatico){
    // $('#'+form).submit(function() {
        // Enviamos el formulario usando AJAX
        if(valor_estatico=='0'){
            // $("#boton").val(0);
            $("#btn_pagados").removeClass('btn-outline-primary');
            $("#btn_pagados").addClass('btn-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='1'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-outline-primary');
            $("#btn_procesados").addClass('btn-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='2'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-outline-primary');
            $("#btn_cerrados").addClass('btn-primary');
            $("#btn_pendientes").removeClass('btn-primary');
            $("#btn_pendientes").addClass('btn-outline-primary');
        }
        else if(valor_estatico=='3'){
            // $("#boton").val(1);
            $("#btn_pagados").removeClass('btn-primary');
            $("#btn_pagados").addClass('btn-outline-primary');
            $("#btn_procesados").removeClass('btn-primary');
            $("#btn_procesados").addClass('btn-outline-primary');
            $("#btn_cerrados").removeClass('btn-primary');
            $("#btn_cerrados").addClass('btn-outline-primary');
            $("#btn_pendientes").removeClass('btn-outline-primary');
            $("#btn_pendientes").addClass('btn-primary');
        }
        $("#opcion").val(valor);
        $.ajax({
            type: 'POST',
            url: $("#"+form).attr('action'),
            data: $("#"+form).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function() {
                    $('#rpt_pr').html('');
                    $('#rpt_pr').html('<i class="fas fa-stroopwafel fa-spin fa-3x"></i><span class="sr-only">Loading...</span>');
                },
            success: function (data) {
                $('#rpt_pr').html('');
                $('#rpt_pr').html(data);
                // $("#btn_enviar").prop('disabled', true);
            },
            error: function () {
            }
        })
    // });
}
function call_popup_servicios_borrar(rpt_id,servicio_id,arreglo,cotizacion_id,itinerario_id,action){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Esta seguro de borrar la reserva escojida con este proveedor?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: "../book/servicios/traer-lista-proveedores/borrar",
            data: 'servicio_id='+servicio_id+'&arreglo='+arreglo+'&cotizacion_id='+cotizacion_id+'&itinerario_id='+itinerario_id+'&action='+action,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function(data1){
                // $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data){
                if(data.mensaje==1){

                    $('#book_proveedor_'+servicio_id).html('');
                    $('#boton_prove_hotel_'+servicio_id).removeClass('d-none');
                    $('#boton_prove_borrar_'+servicio_id).addClass('d-none');
                    $('#book_precio_asig_'+servicio_id).html('');
                    // $('#'+rpt_id).html(data.mensaje);
                }
            }
        });

    });


}
function call_popup_servicios_borrar_h(hotel_id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Esta seguro de borrar la reserva escojida con este proveedor?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            type: 'POST',
            url: "../book/servicios/traer-lista-proveedores/borrar/hotel",
            data: 'hotel_id='+hotel_id,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function(data1){
                // $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function(data){
                if(data.mensaje==1){
                    $('#book_proveedor_hotel_'+hotel_id).html('');
                    // $('#boton_prove_hotel_'+servicio_id).removeClass('d-none');
                    // $('#boton_prove_borrar_'+servicio_id).addClass('d-none');
                    $('#book_precio_asig_hotel_'+hotel_id).html('');
                }
            }
        });

    });


}
function buscar_destino_day_by_day(valor){
    var destino='0';
    destino=$('#destinos_busqueda').val();
    console.log('valor de la busqueda:'+destino+'_'+valor);

    $('#resultado_busqueda').html('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../buscar/day-by-day",
        data: 'destino='+destino+'&valor='+valor,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            // $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#resultado_busqueda').html('');
            $('#resultado_busqueda').html(data);
        }
    });
}
function buscar_destino_day_by_day_edit(valor){
    var destino='0';
    destino=$('#txt_destino').val();
    console.log('valor de la busqueda:'+destino+'_'+valor);

    $('#resultado_busqueda').html('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../../../../../package/buscar-day-by-day/ajax/dia-edit',
        // url: "../../../../buscar/day-by-day",
        data: 'destino='+destino+'&valor='+valor,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#resultado_busqueda').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            // $('#'+rpt_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#resultado_busqueda').html('');
            $('#resultado_busqueda').html(data);
        }
    });
}

function llamar_hoteles_reservas(loca,tipo,id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../quotes/editar/step1/list-localizacion-hoteles",
        data: 'loca='+loca+'&id='+id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#lista_hoteles_'+tipo+'_'+id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#lista_hoteles_'+tipo+'_'+id).html(data);
        }
    });
}

function preparar_envio_hotel(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });

    // var cost_s_serv=$('#cost_s_serv').val();
    // var cost_d_serv=$('#cost_d_serv').val();
    // var cost_m_serv=$('#cost_m_serv').val();
    // var cost_t_serv=$('#cost_t_serv').val();
    // var cost_sh_serv=$('#cost_sh_serv').val();

    // var utilidad_s_serv=$('#utilidad_s_serv').val();
    // var utilidad_d_serv=$('#utilidad_d_serv').val();
    // var utilidad_m_serv=$('#utilidad_m_serv').val();
    // var utilidad_t_serv=$('#utilidad_t_serv').val();
    // var utilidad_sh_serv=$('#utilidad_sh_serv').val();

    // var pv_s_serv=$('#pv_s_serv').val();
    // var pv_d_serv=$('#pv_d_serv').val();
    // var pv_m_serv=$('#pv_m_serv').val();
    // var pv_t_serv=$('#pv_t_serv').val();
    // var pv_sh_serv=$('#pv_sh_serv').val();

    // var con_sin_hotel=$('#con_sin_hotel').val();
    // var acomodacion_hotel=$('#acomodacion_hotel').val();
// alert('cost_d_serv:'+cost_d_serv);
    // $('#'+id).append();
    $.ajax({
        url: $('#'+id).attr('action'),
        type: 'post',
        data: $('#'+id).serialize()/*
        +'&cost_s_serv='+cost_s_serv+'&cost_d_serv='+cost_d_serv+'&cost_m_serv='+cost_m_serv+'&cost_sh_serv='+cost_sh_serv+'&pv_s_serv='+pv_s_serv+'&pv_d_serv='+pv_d_serv+'&pv_m_serv='+pv_m_serv+'&pv_t_serv='+pv_t_serv+'&pv_sh_serv='+pv_sh_serv+'&con_sin_hotel='+con_sin_hotel+'&acomodacion_hotel='+acomodacion_hotel*/,
        // dataType:'json',
        // contentType:false,
        // cache:false,
        // processData: false,
        success: function (data) {
            console.log('rpt:');
            console.log(data.mensaje);
            location.reload();
        },
        error: function () {

        }
    });
}
function mostrar_modal(objeto_id,grupo){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        url: '../../admin/provider/modal',
        type: 'post',
        data: 'id='+objeto_id+'&grupo='+grupo,
        success: function (data) {
            $('#caja_modal_'+objeto_id).html(data);
            $('#modal_edit_cost_'+objeto_id).modal({backdrop: 'static', keyboard: false});

        },
        error: function () {

        }
    });
}
