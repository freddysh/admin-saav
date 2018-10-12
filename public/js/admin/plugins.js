/**
 * Swiper 4.3.3
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * http://www.idangero.us/swiper/
 *
 * Copyright 2014-2018 Vladimir Kharlampidi
 *
 * Released under the MIT License
 *
 * Released on: June 5, 2018
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.Swiper=t()}(this,function(){"use strict";var e="undefined"==typeof document?{body:{},addEventListener:function(){},removeEventListener:function(){},activeElement:{blur:function(){},nodeName:""},querySelector:function(){return null},querySelectorAll:function(){return[]},getElementById:function(){return null},createEvent:function(){return{initEvent:function(){}}},createElement:function(){return{children:[],childNodes:[],style:{},setAttribute:function(){},getElementsByTagName:function(){return[]}}},location:{hash:""}}:document,t="undefined"==typeof window?{document:e,navigator:{userAgent:""},location:{},history:{},CustomEvent:function(){return this},addEventListener:function(){},removeEventListener:function(){},getComputedStyle:function(){return{getPropertyValue:function(){return""}}},Image:function(){},Date:function(){},screen:{},setTimeout:function(){},clearTimeout:function(){}}:window,i=function(e){for(var t=0;t<e.length;t+=1)this[t]=e[t];return this.length=e.length,this};function s(s,a){var r=[],n=0;if(s&&!a&&s instanceof i)return s;if(s)if("string"==typeof s){var o,l,d=s.trim();if(d.indexOf("<")>=0&&d.indexOf(">")>=0){var h="div";for(0===d.indexOf("<li")&&(h="ul"),0===d.indexOf("<tr")&&(h="tbody"),0!==d.indexOf("<td")&&0!==d.indexOf("<th")||(h="tr"),0===d.indexOf("<tbody")&&(h="table"),0===d.indexOf("<option")&&(h="select"),(l=e.createElement(h)).innerHTML=d,n=0;n<l.childNodes.length;n+=1)r.push(l.childNodes[n])}else for(o=a||"#"!==s[0]||s.match(/[ .<>:~]/)?(a||e).querySelectorAll(s.trim()):[e.getElementById(s.trim().split("#")[1])],n=0;n<o.length;n+=1)o[n]&&r.push(o[n])}else if(s.nodeType||s===t||s===e)r.push(s);else if(s.length>0&&s[0].nodeType)for(n=0;n<s.length;n+=1)r.push(s[n]);return new i(r)}function a(e){for(var t=[],i=0;i<e.length;i+=1)-1===t.indexOf(e[i])&&t.push(e[i]);return t}s.fn=i.prototype,s.Class=i,s.Dom7=i;var r={addClass:function(e){if(void 0===e)return this;for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.add(t[i]);return this},removeClass:function(e){for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.remove(t[i]);return this},hasClass:function(e){return!!this[0]&&this[0].classList.contains(e)},toggleClass:function(e){for(var t=e.split(" "),i=0;i<t.length;i+=1)for(var s=0;s<this.length;s+=1)void 0!==this[s].classList&&this[s].classList.toggle(t[i]);return this},attr:function(e,t){var i=arguments;if(1===arguments.length&&"string"==typeof e)return this[0]?this[0].getAttribute(e):void 0;for(var s=0;s<this.length;s+=1)if(2===i.length)this[s].setAttribute(e,t);else for(var a in e)this[s][a]=e[a],this[s].setAttribute(a,e[a]);return this},removeAttr:function(e){for(var t=0;t<this.length;t+=1)this[t].removeAttribute(e);return this},data:function(e,t){var i;if(void 0!==t){for(var s=0;s<this.length;s+=1)(i=this[s]).dom7ElementDataStorage||(i.dom7ElementDataStorage={}),i.dom7ElementDataStorage[e]=t;return this}if(i=this[0]){if(i.dom7ElementDataStorage&&e in i.dom7ElementDataStorage)return i.dom7ElementDataStorage[e];var a=i.getAttribute("data-"+e);return a||void 0}},transform:function(e){for(var t=0;t<this.length;t+=1){var i=this[t].style;i.webkitTransform=e,i.transform=e}return this},transition:function(e){"string"!=typeof e&&(e+="ms");for(var t=0;t<this.length;t+=1){var i=this[t].style;i.webkitTransitionDuration=e,i.transitionDuration=e}return this},on:function(){for(var e,t=[],i=arguments.length;i--;)t[i]=arguments[i];var a=t[0],r=t[1],n=t[2],o=t[3];function l(e){var t=e.target;if(t){var i=e.target.dom7EventData||[];if(i.indexOf(e)<0&&i.unshift(e),s(t).is(r))n.apply(t,i);else for(var a=s(t).parents(),o=0;o<a.length;o+=1)s(a[o]).is(r)&&n.apply(a[o],i)}}function d(e){var t=e&&e.target?e.target.dom7EventData||[]:[];t.indexOf(e)<0&&t.unshift(e),n.apply(this,t)}"function"==typeof t[1]&&(a=(e=t)[0],n=e[1],o=e[2],r=void 0),o||(o=!1);for(var h,p=a.split(" "),c=0;c<this.length;c+=1){var u=this[c];if(r)for(h=0;h<p.length;h+=1){var v=p[h];u.dom7LiveListeners||(u.dom7LiveListeners={}),u.dom7LiveListeners[v]||(u.dom7LiveListeners[v]=[]),u.dom7LiveListeners[v].push({listener:n,proxyListener:l}),u.addEventListener(v,l,o)}else for(h=0;h<p.length;h+=1){var f=p[h];u.dom7Listeners||(u.dom7Listeners={}),u.dom7Listeners[f]||(u.dom7Listeners[f]=[]),u.dom7Listeners[f].push({listener:n,proxyListener:d}),u.addEventListener(f,d,o)}}return this},off:function(){for(var e,t=[],i=arguments.length;i--;)t[i]=arguments[i];var s=t[0],a=t[1],r=t[2],n=t[3];"function"==typeof t[1]&&(s=(e=t)[0],r=e[1],n=e[2],a=void 0),n||(n=!1);for(var o=s.split(" "),l=0;l<o.length;l+=1)for(var d=o[l],h=0;h<this.length;h+=1){var p=this[h],c=void 0;if(!a&&p.dom7Listeners?c=p.dom7Listeners[d]:a&&p.dom7LiveListeners&&(c=p.dom7LiveListeners[d]),c&&c.length)for(var u=c.length-1;u>=0;u-=1){var v=c[u];r&&v.listener===r?(p.removeEventListener(d,v.proxyListener,n),c.splice(u,1)):r||(p.removeEventListener(d,v.proxyListener,n),c.splice(u,1))}}return this},trigger:function(){for(var i=[],s=arguments.length;s--;)i[s]=arguments[s];for(var a=i[0].split(" "),r=i[1],n=0;n<a.length;n+=1)for(var o=a[n],l=0;l<this.length;l+=1){var d=this[l],h=void 0;try{h=new t.CustomEvent(o,{detail:r,bubbles:!0,cancelable:!0})}catch(t){(h=e.createEvent("Event")).initEvent(o,!0,!0),h.detail=r}d.dom7EventData=i.filter(function(e,t){return t>0}),d.dispatchEvent(h),d.dom7EventData=[],delete d.dom7EventData}return this},transitionEnd:function(e){var t,i=["webkitTransitionEnd","transitionend"],s=this;function a(r){if(r.target===this)for(e.call(this,r),t=0;t<i.length;t+=1)s.off(i[t],a)}if(e)for(t=0;t<i.length;t+=1)s.on(i[t],a);return this},outerWidth:function(e){if(this.length>0){if(e){var t=this.styles();return this[0].offsetWidth+parseFloat(t.getPropertyValue("margin-right"))+parseFloat(t.getPropertyValue("margin-left"))}return this[0].offsetWidth}return null},outerHeight:function(e){if(this.length>0){if(e){var t=this.styles();return this[0].offsetHeight+parseFloat(t.getPropertyValue("margin-top"))+parseFloat(t.getPropertyValue("margin-bottom"))}return this[0].offsetHeight}return null},offset:function(){if(this.length>0){var i=this[0],s=i.getBoundingClientRect(),a=e.body,r=i.clientTop||a.clientTop||0,n=i.clientLeft||a.clientLeft||0,o=i===t?t.scrollY:i.scrollTop,l=i===t?t.scrollX:i.scrollLeft;return{top:s.top+o-r,left:s.left+l-n}}return null},css:function(e,i){var s;if(1===arguments.length){if("string"!=typeof e){for(s=0;s<this.length;s+=1)for(var a in e)this[s].style[a]=e[a];return this}if(this[0])return t.getComputedStyle(this[0],null).getPropertyValue(e)}if(2===arguments.length&&"string"==typeof e){for(s=0;s<this.length;s+=1)this[s].style[e]=i;return this}return this},each:function(e){if(!e)return this;for(var t=0;t<this.length;t+=1)if(!1===e.call(this[t],t,this[t]))return this;return this},html:function(e){if(void 0===e)return this[0]?this[0].innerHTML:void 0;for(var t=0;t<this.length;t+=1)this[t].innerHTML=e;return this},text:function(e){if(void 0===e)return this[0]?this[0].textContent.trim():null;for(var t=0;t<this.length;t+=1)this[t].textContent=e;return this},is:function(a){var r,n,o=this[0];if(!o||void 0===a)return!1;if("string"==typeof a){if(o.matches)return o.matches(a);if(o.webkitMatchesSelector)return o.webkitMatchesSelector(a);if(o.msMatchesSelector)return o.msMatchesSelector(a);for(r=s(a),n=0;n<r.length;n+=1)if(r[n]===o)return!0;return!1}if(a===e)return o===e;if(a===t)return o===t;if(a.nodeType||a instanceof i){for(r=a.nodeType?[a]:a,n=0;n<r.length;n+=1)if(r[n]===o)return!0;return!1}return!1},index:function(){var e,t=this[0];if(t){for(e=0;null!==(t=t.previousSibling);)1===t.nodeType&&(e+=1);return e}},eq:function(e){if(void 0===e)return this;var t,s=this.length;return new i(e>s-1?[]:e<0?(t=s+e)<0?[]:[this[t]]:[this[e]])},append:function(){for(var t,s=[],a=arguments.length;a--;)s[a]=arguments[a];for(var r=0;r<s.length;r+=1){t=s[r];for(var n=0;n<this.length;n+=1)if("string"==typeof t){var o=e.createElement("div");for(o.innerHTML=t;o.firstChild;)this[n].appendChild(o.firstChild)}else if(t instanceof i)for(var l=0;l<t.length;l+=1)this[n].appendChild(t[l]);else this[n].appendChild(t)}return this},prepend:function(t){var s,a;for(s=0;s<this.length;s+=1)if("string"==typeof t){var r=e.createElement("div");for(r.innerHTML=t,a=r.childNodes.length-1;a>=0;a-=1)this[s].insertBefore(r.childNodes[a],this[s].childNodes[0])}else if(t instanceof i)for(a=0;a<t.length;a+=1)this[s].insertBefore(t[a],this[s].childNodes[0]);else this[s].insertBefore(t,this[s].childNodes[0]);return this},next:function(e){return this.length>0?e?this[0].nextElementSibling&&s(this[0].nextElementSibling).is(e)?new i([this[0].nextElementSibling]):new i([]):this[0].nextElementSibling?new i([this[0].nextElementSibling]):new i([]):new i([])},nextAll:function(e){var t=[],a=this[0];if(!a)return new i([]);for(;a.nextElementSibling;){var r=a.nextElementSibling;e?s(r).is(e)&&t.push(r):t.push(r),a=r}return new i(t)},prev:function(e){if(this.length>0){var t=this[0];return e?t.previousElementSibling&&s(t.previousElementSibling).is(e)?new i([t.previousElementSibling]):new i([]):t.previousElementSibling?new i([t.previousElementSibling]):new i([])}return new i([])},prevAll:function(e){var t=[],a=this[0];if(!a)return new i([]);for(;a.previousElementSibling;){var r=a.previousElementSibling;e?s(r).is(e)&&t.push(r):t.push(r),a=r}return new i(t)},parent:function(e){for(var t=[],i=0;i<this.length;i+=1)null!==this[i].parentNode&&(e?s(this[i].parentNode).is(e)&&t.push(this[i].parentNode):t.push(this[i].parentNode));return s(a(t))},parents:function(e){for(var t=[],i=0;i<this.length;i+=1)for(var r=this[i].parentNode;r;)e?s(r).is(e)&&t.push(r):t.push(r),r=r.parentNode;return s(a(t))},closest:function(e){var t=this;return void 0===e?new i([]):(t.is(e)||(t=t.parents(e).eq(0)),t)},find:function(e){for(var t=[],s=0;s<this.length;s+=1)for(var a=this[s].querySelectorAll(e),r=0;r<a.length;r+=1)t.push(a[r]);return new i(t)},children:function(e){for(var t=[],r=0;r<this.length;r+=1)for(var n=this[r].childNodes,o=0;o<n.length;o+=1)e?1===n[o].nodeType&&s(n[o]).is(e)&&t.push(n[o]):1===n[o].nodeType&&t.push(n[o]);return new i(a(t))},remove:function(){for(var e=0;e<this.length;e+=1)this[e].parentNode&&this[e].parentNode.removeChild(this[e]);return this},add:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var i,a;for(i=0;i<e.length;i+=1){var r=s(e[i]);for(a=0;a<r.length;a+=1)this[this.length]=r[a],this.length+=1}return this},styles:function(){return this[0]?t.getComputedStyle(this[0],null):{}}};Object.keys(r).forEach(function(e){s.fn[e]=r[e]});var n,o,l,d={deleteProps:function(e){var t=e;Object.keys(t).forEach(function(e){try{t[e]=null}catch(e){}try{delete t[e]}catch(e){}})},nextTick:function(e,t){return void 0===t&&(t=0),setTimeout(e,t)},now:function(){return Date.now()},getTranslate:function(e,i){var s,a,r;void 0===i&&(i="x");var n=t.getComputedStyle(e,null);return t.WebKitCSSMatrix?((a=n.transform||n.webkitTransform).split(",").length>6&&(a=a.split(", ").map(function(e){return e.replace(",",".")}).join(", ")),r=new t.WebKitCSSMatrix("none"===a?"":a)):s=(r=n.MozTransform||n.OTransform||n.MsTransform||n.msTransform||n.transform||n.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,")).toString().split(","),"x"===i&&(a=t.WebKitCSSMatrix?r.m41:16===s.length?parseFloat(s[12]):parseFloat(s[4])),"y"===i&&(a=t.WebKitCSSMatrix?r.m42:16===s.length?parseFloat(s[13]):parseFloat(s[5])),a||0},parseUrlQuery:function(e){var i,s,a,r,n={},o=e||t.location.href;if("string"==typeof o&&o.length)for(r=(s=(o=o.indexOf("?")>-1?o.replace(/\S*\?/,""):"").split("&").filter(function(e){return""!==e})).length,i=0;i<r;i+=1)a=s[i].replace(/#\S+/g,"").split("="),n[decodeURIComponent(a[0])]=void 0===a[1]?void 0:decodeURIComponent(a[1])||"";return n},isObject:function(e){return"object"==typeof e&&null!==e&&e.constructor&&e.constructor===Object},extend:function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];for(var i=Object(e[0]),s=1;s<e.length;s+=1){var a=e[s];if(void 0!==a&&null!==a)for(var r=Object.keys(Object(a)),n=0,o=r.length;n<o;n+=1){var l=r[n],h=Object.getOwnPropertyDescriptor(a,l);void 0!==h&&h.enumerable&&(d.isObject(i[l])&&d.isObject(a[l])?d.extend(i[l],a[l]):!d.isObject(i[l])&&d.isObject(a[l])?(i[l]={},d.extend(i[l],a[l])):i[l]=a[l])}}return i}},h=(l=e.createElement("div"),{touch:t.Modernizr&&!0===t.Modernizr.touch||!!("ontouchstart"in t||t.DocumentTouch&&e instanceof t.DocumentTouch),pointerEvents:!(!t.navigator.pointerEnabled&&!t.PointerEvent),prefixedPointerEvents:!!t.navigator.msPointerEnabled,transition:(o=l.style,"transition"in o||"webkitTransition"in o||"MozTransition"in o),transforms3d:t.Modernizr&&!0===t.Modernizr.csstransforms3d||(n=l.style,"webkitPerspective"in n||"MozPerspective"in n||"OPerspective"in n||"MsPerspective"in n||"perspective"in n),flexbox:function(){for(var e=l.style,t="alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "),i=0;i<t.length;i+=1)if(t[i]in e)return!0;return!1}(),observer:"MutationObserver"in t||"WebkitMutationObserver"in t,passiveListener:function(){var e=!1;try{var i=Object.defineProperty({},"passive",{get:function(){e=!0}});t.addEventListener("testPassiveListener",null,i)}catch(e){}return e}(),gestures:"ongesturestart"in t}),p=function(e){void 0===e&&(e={});var t=this;t.params=e,t.eventsListeners={},t.params&&t.params.on&&Object.keys(t.params.on).forEach(function(e){t.on(e,t.params.on[e])})},c={components:{configurable:!0}};p.prototype.on=function(e,t,i){var s=this;if("function"!=typeof t)return s;var a=i?"unshift":"push";return e.split(" ").forEach(function(e){s.eventsListeners[e]||(s.eventsListeners[e]=[]),s.eventsListeners[e][a](t)}),s},p.prototype.once=function(e,t,i){var s=this;if("function"!=typeof t)return s;return s.on(e,function i(){for(var a=[],r=arguments.length;r--;)a[r]=arguments[r];t.apply(s,a),s.off(e,i)},i)},p.prototype.off=function(e,t){var i=this;return i.eventsListeners?(e.split(" ").forEach(function(e){void 0===t?i.eventsListeners[e]=[]:i.eventsListeners[e].forEach(function(s,a){s===t&&i.eventsListeners[e].splice(a,1)})}),i):i},p.prototype.emit=function(){for(var e=[],t=arguments.length;t--;)e[t]=arguments[t];var i,s,a,r=this;return r.eventsListeners?("string"==typeof e[0]||Array.isArray(e[0])?(i=e[0],s=e.slice(1,e.length),a=r):(i=e[0].events,s=e[0].data,a=e[0].context||r),(Array.isArray(i)?i:i.split(" ")).forEach(function(e){if(r.eventsListeners&&r.eventsListeners[e]){var t=[];r.eventsListeners[e].forEach(function(e){t.push(e)}),t.forEach(function(e){e.apply(a,s)})}}),r):r},p.prototype.useModulesParams=function(e){var t=this;t.modules&&Object.keys(t.modules).forEach(function(i){var s=t.modules[i];s.params&&d.extend(e,s.params)})},p.prototype.useModules=function(e){void 0===e&&(e={});var t=this;t.modules&&Object.keys(t.modules).forEach(function(i){var s=t.modules[i],a=e[i]||{};s.instance&&Object.keys(s.instance).forEach(function(e){var i=s.instance[e];t[e]="function"==typeof i?i.bind(t):i}),s.on&&t.on&&Object.keys(s.on).forEach(function(e){t.on(e,s.on[e])}),s.create&&s.create.bind(t)(a)})},c.components.set=function(e){this.use&&this.use(e)},p.installModule=function(e){for(var t=[],i=arguments.length-1;i-- >0;)t[i]=arguments[i+1];var s=this;s.prototype.modules||(s.prototype.modules={});var a=e.name||Object.keys(s.prototype.modules).length+"_"+d.now();return s.prototype.modules[a]=e,e.proto&&Object.keys(e.proto).forEach(function(t){s.prototype[t]=e.proto[t]}),e.static&&Object.keys(e.static).forEach(function(t){s[t]=e.static[t]}),e.install&&e.install.apply(s,t),s},p.use=function(e){for(var t=[],i=arguments.length-1;i-- >0;)t[i]=arguments[i+1];var s=this;return Array.isArray(e)?(e.forEach(function(e){return s.installModule(e)}),s):s.installModule.apply(s,[e].concat(t))},Object.defineProperties(p,c);var u={updateSize:function(){var e,t,i=this.$el;e=void 0!==this.params.width?this.params.width:i[0].clientWidth,t=void 0!==this.params.height?this.params.height:i[0].clientHeight,0===e&&this.isHorizontal()||0===t&&this.isVertical()||(e=e-parseInt(i.css("padding-left"),10)-parseInt(i.css("padding-right"),10),t=t-parseInt(i.css("padding-top"),10)-parseInt(i.css("padding-bottom"),10),d.extend(this,{width:e,height:t,size:this.isHorizontal()?e:t}))},updateSlides:function(){var e=this.params,i=this.$wrapperEl,s=this.size,a=this.rtlTranslate,r=this.wrongRTL,n=this.virtual&&e.virtual.enabled,o=n?this.virtual.slides.length:this.slides.length,l=i.children("."+this.params.slideClass),p=n?this.virtual.slides.length:l.length,c=[],u=[],v=[],f=e.slidesOffsetBefore;"function"==typeof f&&(f=e.slidesOffsetBefore.call(this));var m=e.slidesOffsetAfter;"function"==typeof m&&(m=e.slidesOffsetAfter.call(this));var g=this.snapGrid.length,b=this.snapGrid.length,w=e.spaceBetween,y=-f,x=0,E=0;if(void 0!==s){var T,S;"string"==typeof w&&w.indexOf("%")>=0&&(w=parseFloat(w.replace("%",""))/100*s),this.virtualSize=-w,a?l.css({marginLeft:"",marginTop:""}):l.css({marginRight:"",marginBottom:""}),e.slidesPerColumn>1&&(T=Math.floor(p/e.slidesPerColumn)===p/this.params.slidesPerColumn?p:Math.ceil(p/e.slidesPerColumn)*e.slidesPerColumn,"auto"!==e.slidesPerView&&"row"===e.slidesPerColumnFill&&(T=Math.max(T,e.slidesPerView*e.slidesPerColumn)));for(var C,M=e.slidesPerColumn,z=T/M,k=z-(e.slidesPerColumn*z-p),P=0;P<p;P+=1){S=0;var $=l.eq(P);if(e.slidesPerColumn>1){var L=void 0,I=void 0,D=void 0;"column"===e.slidesPerColumnFill?(D=P-(I=Math.floor(P/M))*M,(I>k||I===k&&D===M-1)&&(D+=1)>=M&&(D=0,I+=1),L=I+D*T/M,$.css({"-webkit-box-ordinal-group":L,"-moz-box-ordinal-group":L,"-ms-flex-order":L,"-webkit-order":L,order:L})):I=P-(D=Math.floor(P/z))*z,$.css("margin-"+(this.isHorizontal()?"top":"left"),0!==D&&e.spaceBetween&&e.spaceBetween+"px").attr("data-swiper-column",I).attr("data-swiper-row",D)}if("none"!==$.css("display")){if("auto"===e.slidesPerView){var O=t.getComputedStyle($[0],null),A=$[0].style.transform,G=$[0].style.webkitTransform;A&&($[0].style.transform="none"),G&&($[0].style.webkitTransform="none"),S=this.isHorizontal()?$[0].getBoundingClientRect().width+parseFloat(O.getPropertyValue("margin-left"))+parseFloat(O.getPropertyValue("margin-right")):$[0].getBoundingClientRect().height+parseFloat(O.getPropertyValue("margin-top"))+parseFloat(O.getPropertyValue("margin-bottom")),A&&($[0].style.transform=A),G&&($[0].style.webkitTransform=G),e.roundLengths&&(S=Math.floor(S))}else S=(s-(e.slidesPerView-1)*w)/e.slidesPerView,e.roundLengths&&(S=Math.floor(S)),l[P]&&(this.isHorizontal()?l[P].style.width=S+"px":l[P].style.height=S+"px");l[P]&&(l[P].swiperSlideSize=S),v.push(S),e.centeredSlides?(y=y+S/2+x/2+w,0===x&&0!==P&&(y=y-s/2-w),0===P&&(y=y-s/2-w),Math.abs(y)<.001&&(y=0),e.roundLengths&&(y=Math.floor(y)),E%e.slidesPerGroup==0&&c.push(y),u.push(y)):(e.roundLengths&&(y=Math.floor(y)),E%e.slidesPerGroup==0&&c.push(y),u.push(y),y=y+S+w),this.virtualSize+=S+w,x=S,E+=1}}if(this.virtualSize=Math.max(this.virtualSize,s)+m,a&&r&&("slide"===e.effect||"coverflow"===e.effect)&&i.css({width:this.virtualSize+e.spaceBetween+"px"}),h.flexbox&&!e.setWrapperSize||(this.isHorizontal()?i.css({width:this.virtualSize+e.spaceBetween+"px"}):i.css({height:this.virtualSize+e.spaceBetween+"px"})),e.slidesPerColumn>1&&(this.virtualSize=(S+e.spaceBetween)*T,this.virtualSize=Math.ceil(this.virtualSize/e.slidesPerColumn)-e.spaceBetween,this.isHorizontal()?i.css({width:this.virtualSize+e.spaceBetween+"px"}):i.css({height:this.virtualSize+e.spaceBetween+"px"}),e.centeredSlides)){C=[];for(var H=0;H<c.length;H+=1){var N=c[H];e.roundLengths&&(N=Math.floor(N)),c[H]<this.virtualSize+c[0]&&C.push(N)}c=C}if(!e.centeredSlides){C=[];for(var B=0;B<c.length;B+=1){var X=c[B];e.roundLengths&&(X=Math.floor(X)),c[B]<=this.virtualSize-s&&C.push(X)}c=C,Math.floor(this.virtualSize-s)-Math.floor(c[c.length-1])>1&&c.push(this.virtualSize-s)}0===c.length&&(c=[0]),0!==e.spaceBetween&&(this.isHorizontal()?a?l.css({marginLeft:w+"px"}):l.css({marginRight:w+"px"}):l.css({marginBottom:w+"px"})),d.extend(this,{slides:l,snapGrid:c,slidesGrid:u,slidesSizesGrid:v}),p!==o&&this.emit("slidesLengthChange"),c.length!==g&&(this.params.watchOverflow&&this.checkOverflow(),this.emit("snapGridLengthChange")),u.length!==b&&this.emit("slidesGridLengthChange"),(e.watchSlidesProgress||e.watchSlidesVisibility)&&this.updateSlidesOffset()}},updateAutoHeight:function(e){var t,i=[],s=0;if("number"==typeof e?this.setTransition(e):!0===e&&this.setTransition(this.params.speed),"auto"!==this.params.slidesPerView&&this.params.slidesPerView>1)for(t=0;t<Math.ceil(this.params.slidesPerView);t+=1){var a=this.activeIndex+t;if(a>this.slides.length)break;i.push(this.slides.eq(a)[0])}else i.push(this.slides.eq(this.activeIndex)[0]);for(t=0;t<i.length;t+=1)if(void 0!==i[t]){var r=i[t].offsetHeight;s=r>s?r:s}s&&this.$wrapperEl.css("height",s+"px")},updateSlidesOffset:function(){for(var e=this.slides,t=0;t<e.length;t+=1)e[t].swiperSlideOffset=this.isHorizontal()?e[t].offsetLeft:e[t].offsetTop},updateSlidesProgress:function(e){void 0===e&&(e=this&&this.translate||0);var t=this.params,i=this.slides,s=this.rtlTranslate;if(0!==i.length){void 0===i[0].swiperSlideOffset&&this.updateSlidesOffset();var a=-e;s&&(a=e),i.removeClass(t.slideVisibleClass);for(var r=0;r<i.length;r+=1){var n=i[r],o=(a+(t.centeredSlides?this.minTranslate():0)-n.swiperSlideOffset)/(n.swiperSlideSize+t.spaceBetween);if(t.watchSlidesVisibility){var l=-(a-n.swiperSlideOffset),d=l+this.slidesSizesGrid[r];(l>=0&&l<this.size||d>0&&d<=this.size||l<=0&&d>=this.size)&&i.eq(r).addClass(t.slideVisibleClass)}n.progress=s?-o:o}}},updateProgress:function(e){void 0===e&&(e=this&&this.translate||0);var t=this.params,i=this.maxTranslate()-this.minTranslate(),s=this.progress,a=this.isBeginning,r=this.isEnd,n=a,o=r;0===i?(s=0,a=!0,r=!0):(a=(s=(e-this.minTranslate())/i)<=0,r=s>=1),d.extend(this,{progress:s,isBeginning:a,isEnd:r}),(t.watchSlidesProgress||t.watchSlidesVisibility)&&this.updateSlidesProgress(e),a&&!n&&this.emit("reachBeginning toEdge"),r&&!o&&this.emit("reachEnd toEdge"),(n&&!a||o&&!r)&&this.emit("fromEdge"),this.emit("progress",s)},updateSlidesClasses:function(){var e,t=this.slides,i=this.params,s=this.$wrapperEl,a=this.activeIndex,r=this.realIndex,n=this.virtual&&i.virtual.enabled;t.removeClass(i.slideActiveClass+" "+i.slideNextClass+" "+i.slidePrevClass+" "+i.slideDuplicateActiveClass+" "+i.slideDuplicateNextClass+" "+i.slideDuplicatePrevClass),(e=n?this.$wrapperEl.find("."+i.slideClass+'[data-swiper-slide-index="'+a+'"]'):t.eq(a)).addClass(i.slideActiveClass),i.loop&&(e.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+r+'"]').addClass(i.slideDuplicateActiveClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+r+'"]').addClass(i.slideDuplicateActiveClass));var o=e.nextAll("."+i.slideClass).eq(0).addClass(i.slideNextClass);i.loop&&0===o.length&&(o=t.eq(0)).addClass(i.slideNextClass);var l=e.prevAll("."+i.slideClass).eq(0).addClass(i.slidePrevClass);i.loop&&0===l.length&&(l=t.eq(-1)).addClass(i.slidePrevClass),i.loop&&(o.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+o.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+o.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicateNextClass),l.hasClass(i.slideDuplicateClass)?s.children("."+i.slideClass+":not(."+i.slideDuplicateClass+')[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass):s.children("."+i.slideClass+"."+i.slideDuplicateClass+'[data-swiper-slide-index="'+l.attr("data-swiper-slide-index")+'"]').addClass(i.slideDuplicatePrevClass))},updateActiveIndex:function(e){var t,i=this.rtlTranslate?this.translate:-this.translate,s=this.slidesGrid,a=this.snapGrid,r=this.params,n=this.activeIndex,o=this.realIndex,l=this.snapIndex,h=e;if(void 0===h){for(var p=0;p<s.length;p+=1)void 0!==s[p+1]?i>=s[p]&&i<s[p+1]-(s[p+1]-s[p])/2?h=p:i>=s[p]&&i<s[p+1]&&(h=p+1):i>=s[p]&&(h=p);r.normalizeSlideIndex&&(h<0||void 0===h)&&(h=0)}if((t=a.indexOf(i)>=0?a.indexOf(i):Math.floor(h/r.slidesPerGroup))>=a.length&&(t=a.length-1),h!==n){var c=parseInt(this.slides.eq(h).attr("data-swiper-slide-index")||h,10);d.extend(this,{snapIndex:t,realIndex:c,previousIndex:n,activeIndex:h}),this.emit("activeIndexChange"),this.emit("snapIndexChange"),o!==c&&this.emit("realIndexChange"),this.emit("slideChange")}else t!==l&&(this.snapIndex=t,this.emit("snapIndexChange"))},updateClickedSlide:function(e){var t=this.params,i=s(e.target).closest("."+t.slideClass)[0],a=!1;if(i)for(var r=0;r<this.slides.length;r+=1)this.slides[r]===i&&(a=!0);if(!i||!a)return this.clickedSlide=void 0,void(this.clickedIndex=void 0);this.clickedSlide=i,this.virtual&&this.params.virtual.enabled?this.clickedIndex=parseInt(s(i).attr("data-swiper-slide-index"),10):this.clickedIndex=s(i).index(),t.slideToClickedSlide&&void 0!==this.clickedIndex&&this.clickedIndex!==this.activeIndex&&this.slideToClickedSlide()}};var v={getTranslate:function(e){void 0===e&&(e=this.isHorizontal()?"x":"y");var t=this.params,i=this.rtlTranslate,s=this.translate,a=this.$wrapperEl;if(t.virtualTranslate)return i?-s:s;var r=d.getTranslate(a[0],e);return i&&(r=-r),r||0},setTranslate:function(e,t){var i=this.rtlTranslate,s=this.params,a=this.$wrapperEl,r=this.progress,n=0,o=0;this.isHorizontal()?n=i?-e:e:o=e,s.roundLengths&&(n=Math.floor(n),o=Math.floor(o)),s.virtualTranslate||(h.transforms3d?a.transform("translate3d("+n+"px, "+o+"px, 0px)"):a.transform("translate("+n+"px, "+o+"px)")),this.previousTranslate=this.translate,this.translate=this.isHorizontal()?n:o;var l=this.maxTranslate()-this.minTranslate();(0===l?0:(e-this.minTranslate())/l)!==r&&this.updateProgress(e),this.emit("setTranslate",this.translate,t)},minTranslate:function(){return-this.snapGrid[0]},maxTranslate:function(){return-this.snapGrid[this.snapGrid.length-1]}};var f={setTransition:function(e,t){this.$wrapperEl.transition(e),this.emit("setTransition",e,t)},transitionStart:function(e,t){void 0===e&&(e=!0);var i=this.activeIndex,s=this.params,a=this.previousIndex;s.autoHeight&&this.updateAutoHeight();var r=t;if(r||(r=i>a?"next":i<a?"prev":"reset"),this.emit("transitionStart"),e&&i!==a){if("reset"===r)return void this.emit("slideResetTransitionStart");this.emit("slideChangeTransitionStart"),"next"===r?this.emit("slideNextTransitionStart"):this.emit("slidePrevTransitionStart")}},transitionEnd:function(e,t){void 0===e&&(e=!0);var i=this.activeIndex,s=this.previousIndex;this.animating=!1,this.setTransition(0);var a=t;if(a||(a=i>s?"next":i<s?"prev":"reset"),this.emit("transitionEnd"),e&&i!==s){if("reset"===a)return void this.emit("slideResetTransitionEnd");this.emit("slideChangeTransitionEnd"),"next"===a?this.emit("slideNextTransitionEnd"):this.emit("slidePrevTransitionEnd")}}};var m={slideTo:function(e,t,i,s){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===i&&(i=!0);var a=this,r=e;r<0&&(r=0);var n=a.params,o=a.snapGrid,l=a.slidesGrid,d=a.previousIndex,p=a.activeIndex,c=a.rtlTranslate;if(a.animating&&n.preventIntercationOnTransition)return!1;var u=Math.floor(r/n.slidesPerGroup);u>=o.length&&(u=o.length-1),(p||n.initialSlide||0)===(d||0)&&i&&a.emit("beforeSlideChangeStart");var v,f=-o[u];if(a.updateProgress(f),n.normalizeSlideIndex)for(var m=0;m<l.length;m+=1)-Math.floor(100*f)>=Math.floor(100*l[m])&&(r=m);if(a.initialized&&r!==p){if(!a.allowSlideNext&&f<a.translate&&f<a.minTranslate())return!1;if(!a.allowSlidePrev&&f>a.translate&&f>a.maxTranslate()&&(p||0)!==r)return!1}return v=r>p?"next":r<p?"prev":"reset",c&&-f===a.translate||!c&&f===a.translate?(a.updateActiveIndex(r),n.autoHeight&&a.updateAutoHeight(),a.updateSlidesClasses(),"slide"!==n.effect&&a.setTranslate(f),"reset"!==v&&(a.transitionStart(i,v),a.transitionEnd(i,v)),!1):(0!==t&&h.transition?(a.setTransition(t),a.setTranslate(f),a.updateActiveIndex(r),a.updateSlidesClasses(),a.emit("beforeTransitionStart",t,s),a.transitionStart(i,v),a.animating||(a.animating=!0,a.onSlideToWrapperTransitionEnd||(a.onSlideToWrapperTransitionEnd=function(e){a&&!a.destroyed&&e.target===this&&(a.$wrapperEl[0].removeEventListener("transitionend",a.onSlideToWrapperTransitionEnd),a.$wrapperEl[0].removeEventListener("webkitTransitionEnd",a.onSlideToWrapperTransitionEnd),a.transitionEnd(i,v))}),a.$wrapperEl[0].addEventListener("transitionend",a.onSlideToWrapperTransitionEnd),a.$wrapperEl[0].addEventListener("webkitTransitionEnd",a.onSlideToWrapperTransitionEnd))):(a.setTransition(0),a.setTranslate(f),a.updateActiveIndex(r),a.updateSlidesClasses(),a.emit("beforeTransitionStart",t,s),a.transitionStart(i,v),a.transitionEnd(i,v)),!0)},slideToLoop:function(e,t,i,s){void 0===e&&(e=0),void 0===t&&(t=this.params.speed),void 0===i&&(i=!0);var a=e;return this.params.loop&&(a+=this.loopedSlides),this.slideTo(a,t,i,s)},slideNext:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.params,a=this.animating;return s.loop?!a&&(this.loopFix(),this._clientLeft=this.$wrapperEl[0].clientLeft,this.slideTo(this.activeIndex+s.slidesPerGroup,e,t,i)):this.slideTo(this.activeIndex+s.slidesPerGroup,e,t,i)},slidePrev:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.params,a=this.animating,r=this.snapGrid,n=this.slidesGrid,o=this.rtlTranslate;if(s.loop){if(a)return!1;this.loopFix(),this._clientLeft=this.$wrapperEl[0].clientLeft}function l(e){return e<0?-Math.floor(Math.abs(e)):Math.floor(e)}var d,h=l(o?this.translate:-this.translate),p=r.map(function(e){return l(e)}),c=(n.map(function(e){return l(e)}),r[p.indexOf(h)],r[p.indexOf(h)-1]);return void 0!==c&&(d=n.indexOf(c))<0&&(d=this.activeIndex-1),this.slideTo(d,e,t,i)},slideReset:function(e,t,i){return void 0===e&&(e=this.params.speed),void 0===t&&(t=!0),this.slideTo(this.activeIndex,e,t,i)},slideToClosest:function(e,t,i){void 0===e&&(e=this.params.speed),void 0===t&&(t=!0);var s=this.activeIndex,a=Math.floor(s/this.params.slidesPerGroup);if(a<this.snapGrid.length-1){var r=this.rtlTranslate?this.translate:-this.translate,n=this.snapGrid[a];r-n>(this.snapGrid[a+1]-n)/2&&(s=this.params.slidesPerGroup)}return this.slideTo(s,e,t,i)},slideToClickedSlide:function(){var e,t=this,i=t.params,a=t.$wrapperEl,r="auto"===i.slidesPerView?t.slidesPerViewDynamic():i.slidesPerView,n=t.clickedIndex;if(i.loop){if(t.animating)return;e=parseInt(s(t.clickedSlide).attr("data-swiper-slide-index"),10),i.centeredSlides?n<t.loopedSlides-r/2||n>t.slides.length-t.loopedSlides+r/2?(t.loopFix(),n=a.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+i.slideDuplicateClass+")").eq(0).index(),d.nextTick(function(){t.slideTo(n)})):t.slideTo(n):n>t.slides.length-r?(t.loopFix(),n=a.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]:not(.'+i.slideDuplicateClass+")").eq(0).index(),d.nextTick(function(){t.slideTo(n)})):t.slideTo(n)}else t.slideTo(n)}};var g={loopCreate:function(){var t=this,i=t.params,a=t.$wrapperEl;a.children("."+i.slideClass+"."+i.slideDuplicateClass).remove();var r=a.children("."+i.slideClass);if(i.loopFillGroupWithBlank){var n=i.slidesPerGroup-r.length%i.slidesPerGroup;if(n!==i.slidesPerGroup){for(var o=0;o<n;o+=1){var l=s(e.createElement("div")).addClass(i.slideClass+" "+i.slideBlankClass);a.append(l)}r=a.children("."+i.slideClass)}}"auto"!==i.slidesPerView||i.loopedSlides||(i.loopedSlides=r.length),t.loopedSlides=parseInt(i.loopedSlides||i.slidesPerView,10),t.loopedSlides+=i.loopAdditionalSlides,t.loopedSlides>r.length&&(t.loopedSlides=r.length);var d=[],h=[];r.each(function(e,i){var a=s(i);e<t.loopedSlides&&h.push(i),e<r.length&&e>=r.length-t.loopedSlides&&d.push(i),a.attr("data-swiper-slide-index",e)});for(var p=0;p<h.length;p+=1)a.append(s(h[p].cloneNode(!0)).addClass(i.slideDuplicateClass));for(var c=d.length-1;c>=0;c-=1)a.prepend(s(d[c].cloneNode(!0)).addClass(i.slideDuplicateClass))},loopFix:function(){var e,t=this.params,i=this.activeIndex,s=this.slides,a=this.loopedSlides,r=this.allowSlidePrev,n=this.allowSlideNext,o=this.snapGrid,l=this.rtlTranslate;this.allowSlidePrev=!0,this.allowSlideNext=!0;var d=-o[i]-this.getTranslate();i<a?(e=s.length-3*a+i,e+=a,this.slideTo(e,0,!1,!0)&&0!==d&&this.setTranslate((l?-this.translate:this.translate)-d)):("auto"===t.slidesPerView&&i>=2*a||i>=s.length-a)&&(e=-s.length+i+a,e+=a,this.slideTo(e,0,!1,!0)&&0!==d&&this.setTranslate((l?-this.translate:this.translate)-d));this.allowSlidePrev=r,this.allowSlideNext=n},loopDestroy:function(){var e=this.$wrapperEl,t=this.params,i=this.slides;e.children("."+t.slideClass+"."+t.slideDuplicateClass).remove(),i.removeAttr("data-swiper-slide-index")}};var b={setGrabCursor:function(e){if(!(h.touch||!this.params.simulateTouch||this.params.watchOverflow&&this.isLocked)){var t=this.el;t.style.cursor="move",t.style.cursor=e?"-webkit-grabbing":"-webkit-grab",t.style.cursor=e?"-moz-grabbin":"-moz-grab",t.style.cursor=e?"grabbing":"grab"}},unsetGrabCursor:function(){h.touch||this.params.watchOverflow&&this.isLocked||(this.el.style.cursor="")}};var w={appendSlide:function(e){var t=this.$wrapperEl,i=this.params;if(i.loop&&this.loopDestroy(),"object"==typeof e&&"length"in e)for(var s=0;s<e.length;s+=1)e[s]&&t.append(e[s]);else t.append(e);i.loop&&this.loopCreate(),i.observer&&h.observer||this.update()},prependSlide:function(e){var t=this.params,i=this.$wrapperEl,s=this.activeIndex;t.loop&&this.loopDestroy();var a=s+1;if("object"==typeof e&&"length"in e){for(var r=0;r<e.length;r+=1)e[r]&&i.prepend(e[r]);a=s+e.length}else i.prepend(e);t.loop&&this.loopCreate(),t.observer&&h.observer||this.update(),this.slideTo(a,0,!1)},addSlide:function(e,t){var i=this.$wrapperEl,s=this.params,a=this.activeIndex;s.loop&&(a-=this.loopedSlides,this.loopDestroy(),this.slides=i.children("."+s.slideClass));var r=this.slides.length;if(e<=0)this.prependSlide(t);else if(e>=r)this.appendSlide(t);else{for(var n=a>e?a+1:a,o=[],l=r-1;l>=e;l-=1){var d=this.slides.eq(l);d.remove(),o.unshift(d)}if("object"==typeof t&&"length"in t){for(var p=0;p<t.length;p+=1)t[p]&&i.append(t[p]);n=a>e?a+t.length:a}else i.append(t);for(var c=0;c<o.length;c+=1)i.append(o[c]);s.loop&&this.loopCreate(),s.observer&&h.observer||this.update(),s.loop?this.slideTo(n+this.loopedSlides,0,!1):this.slideTo(n,0,!1)}},removeSlide:function(e){var t=this.params,i=this.$wrapperEl,s=this.activeIndex;t.loop&&(s-=this.loopedSlides,this.loopDestroy(),this.slides=i.children("."+t.slideClass));var a,r=s;if("object"==typeof e&&"length"in e){for(var n=0;n<e.length;n+=1)a=e[n],this.slides[a]&&this.slides.eq(a).remove(),a<r&&(r-=1);r=Math.max(r,0)}else a=e,this.slides[a]&&this.slides.eq(a).remove(),a<r&&(r-=1),r=Math.max(r,0);t.loop&&this.loopCreate(),t.observer&&h.observer||this.update(),t.loop?this.slideTo(r+this.loopedSlides,0,!1):this.slideTo(r,0,!1)},removeAllSlides:function(){for(var e=[],t=0;t<this.slides.length;t+=1)e.push(t);this.removeSlide(e)}},y=function(){var i=t.navigator.userAgent,s={ios:!1,android:!1,androidChrome:!1,desktop:!1,windows:!1,iphone:!1,ipod:!1,ipad:!1,cordova:t.cordova||t.phonegap,phonegap:t.cordova||t.phonegap},a=i.match(/(Windows Phone);?[\s\/]+([\d.]+)?/),r=i.match(/(Android);?[\s\/]+([\d.]+)?/),n=i.match(/(iPad).*OS\s([\d_]+)/),o=i.match(/(iPod)(.*OS\s([\d_]+))?/),l=!n&&i.match(/(iPhone\sOS|iOS)\s([\d_]+)/);if(a&&(s.os="windows",s.osVersion=a[2],s.windows=!0),r&&!a&&(s.os="android",s.osVersion=r[2],s.android=!0,s.androidChrome=i.toLowerCase().indexOf("chrome")>=0),(n||l||o)&&(s.os="ios",s.ios=!0),l&&!o&&(s.osVersion=l[2].replace(/_/g,"."),s.iphone=!0),n&&(s.osVersion=n[2].replace(/_/g,"."),s.ipad=!0),o&&(s.osVersion=o[3]?o[3].replace(/_/g,"."):null,s.iphone=!0),s.ios&&s.osVersion&&i.indexOf("Version/")>=0&&"10"===s.osVersion.split(".")[0]&&(s.osVersion=i.toLowerCase().split("version/")[1].split(" ")[0]),s.desktop=!(s.os||s.android||s.webView),s.webView=(l||n||o)&&i.match(/.*AppleWebKit(?!.*Safari)/i),s.os&&"ios"===s.os){var d=s.osVersion.split("."),h=e.querySelector('meta[name="viewport"]');s.minimalUi=!s.webView&&(o||l)&&(1*d[0]==7?1*d[1]>=1:1*d[0]>7)&&h&&h.getAttribute("content").indexOf("minimal-ui")>=0}return s.pixelRatio=t.devicePixelRatio||1,s}();function x(){var e=this.params,t=this.el;if(!t||0!==t.offsetWidth){e.breakpoints&&this.setBreakpoint();var i=this.allowSlideNext,s=this.allowSlidePrev,a=this.snapGrid;if(this.allowSlideNext=!0,this.allowSlidePrev=!0,this.updateSize(),this.updateSlides(),e.freeMode){var r=Math.min(Math.max(this.translate,this.maxTranslate()),this.minTranslate());this.setTranslate(r),this.updateActiveIndex(),this.updateSlidesClasses(),e.autoHeight&&this.updateAutoHeight()}else this.updateSlidesClasses(),("auto"===e.slidesPerView||e.slidesPerView>1)&&this.isEnd&&!this.params.centeredSlides?this.slideTo(this.slides.length-1,0,!1,!0):this.slideTo(this.activeIndex,0,!1,!0);this.allowSlidePrev=s,this.allowSlideNext=i,this.params.watchOverflow&&a!==this.snapGrid&&this.checkOverflow()}}var E={attachEvents:function(){var i=this.params,a=this.touchEvents,r=this.el,n=this.wrapperEl;this.onTouchStart=function(i){var a=this.touchEventsData,r=this.params,n=this.touches;if(!this.animating||!r.preventIntercationOnTransition){var o=i;if(o.originalEvent&&(o=o.originalEvent),a.isTouchEvent="touchstart"===o.type,(a.isTouchEvent||!("which"in o)||3!==o.which)&&(!a.isTouched||!a.isMoved))if(r.noSwiping&&s(o.target).closest(r.noSwipingSelector?r.noSwipingSelector:"."+r.noSwipingClass)[0])this.allowClick=!0;else if(!r.swipeHandler||s(o).closest(r.swipeHandler)[0]){n.currentX="touchstart"===o.type?o.targetTouches[0].pageX:o.pageX,n.currentY="touchstart"===o.type?o.targetTouches[0].pageY:o.pageY;var l=n.currentX,h=n.currentY;if(!y.ios||y.cordova||!r.iOSEdgeSwipeDetection||!(l<=r.iOSEdgeSwipeThreshold||l>=t.screen.width-r.iOSEdgeSwipeThreshold)){if(d.extend(a,{isTouched:!0,isMoved:!1,allowTouchCallbacks:!0,isScrolling:void 0,startMoving:void 0}),n.startX=l,n.startY=h,a.touchStartTime=d.now(),this.allowClick=!0,this.updateSize(),this.swipeDirection=void 0,r.threshold>0&&(a.allowThresholdMove=!1),"touchstart"!==o.type){var p=!0;s(o.target).is(a.formElements)&&(p=!1),e.activeElement&&s(e.activeElement).is(a.formElements)&&e.activeElement!==o.target&&e.activeElement.blur(),p&&this.allowTouchMove&&o.preventDefault()}this.emit("touchStart",o)}}}}.bind(this),this.onTouchMove=function(t){var i=this.touchEventsData,a=this.params,r=this.touches,n=this.rtlTranslate,o=t;if(o.originalEvent&&(o=o.originalEvent),i.isTouched){if(!i.isTouchEvent||"mousemove"!==o.type){var l="touchmove"===o.type?o.targetTouches[0].pageX:o.pageX,h="touchmove"===o.type?o.targetTouches[0].pageY:o.pageY;if(o.preventedByNestedSwiper)return r.startX=l,void(r.startY=h);if(!this.allowTouchMove)return this.allowClick=!1,void(i.isTouched&&(d.extend(r,{startX:l,startY:h,currentX:l,currentY:h}),i.touchStartTime=d.now()));if(i.isTouchEvent&&a.touchReleaseOnEdges&&!a.loop)if(this.isVertical()){if(h<r.startY&&this.translate<=this.maxTranslate()||h>r.startY&&this.translate>=this.minTranslate())return i.isTouched=!1,void(i.isMoved=!1)}else if(l<r.startX&&this.translate<=this.maxTranslate()||l>r.startX&&this.translate>=this.minTranslate())return;if(i.isTouchEvent&&e.activeElement&&o.target===e.activeElement&&s(o.target).is(i.formElements))return i.isMoved=!0,void(this.allowClick=!1);if(i.allowTouchCallbacks&&this.emit("touchMove",o),!(o.targetTouches&&o.targetTouches.length>1)){r.currentX=l,r.currentY=h;var p,c=r.currentX-r.startX,u=r.currentY-r.startY;if(void 0===i.isScrolling&&(this.isHorizontal()&&r.currentY===r.startY||this.isVertical()&&r.currentX===r.startX?i.isScrolling=!1:c*c+u*u>=25&&(p=180*Math.atan2(Math.abs(u),Math.abs(c))/Math.PI,i.isScrolling=this.isHorizontal()?p>a.touchAngle:90-p>a.touchAngle)),i.isScrolling&&this.emit("touchMoveOpposite",o),"undefined"==typeof startMoving&&(r.currentX===r.startX&&r.currentY===r.startY||(i.startMoving=!0)),i.isScrolling)i.isTouched=!1;else if(i.startMoving){this.allowClick=!1,o.preventDefault(),a.touchMoveStopPropagation&&!a.nested&&o.stopPropagation(),i.isMoved||(a.loop&&this.loopFix(),i.startTranslate=this.getTranslate(),this.setTransition(0),this.animating&&this.$wrapperEl.trigger("webkitTransitionEnd transitionend"),i.allowMomentumBounce=!1,!a.grabCursor||!0!==this.allowSlideNext&&!0!==this.allowSlidePrev||this.setGrabCursor(!0),this.emit("sliderFirstMove",o)),this.emit("sliderMove",o),i.isMoved=!0;var v=this.isHorizontal()?c:u;r.diff=v,v*=a.touchRatio,n&&(v=-v),this.swipeDirection=v>0?"prev":"next",i.currentTranslate=v+i.startTranslate;var f=!0,m=a.resistanceRatio;if(a.touchReleaseOnEdges&&(m=0),v>0&&i.currentTranslate>this.minTranslate()?(f=!1,a.resistance&&(i.currentTranslate=this.minTranslate()-1+Math.pow(-this.minTranslate()+i.startTranslate+v,m))):v<0&&i.currentTranslate<this.maxTranslate()&&(f=!1,a.resistance&&(i.currentTranslate=this.maxTranslate()+1-Math.pow(this.maxTranslate()-i.startTranslate-v,m))),f&&(o.preventedByNestedSwiper=!0),!this.allowSlideNext&&"next"===this.swipeDirection&&i.currentTranslate<i.startTranslate&&(i.currentTranslate=i.startTranslate),!this.allowSlidePrev&&"prev"===this.swipeDirection&&i.currentTranslate>i.startTranslate&&(i.currentTranslate=i.startTranslate),a.threshold>0){if(!(Math.abs(v)>a.threshold||i.allowThresholdMove))return void(i.currentTranslate=i.startTranslate);if(!i.allowThresholdMove)return i.allowThresholdMove=!0,r.startX=r.currentX,r.startY=r.currentY,i.currentTranslate=i.startTranslate,void(r.diff=this.isHorizontal()?r.currentX-r.startX:r.currentY-r.startY)}a.followFinger&&((a.freeMode||a.watchSlidesProgress||a.watchSlidesVisibility)&&(this.updateActiveIndex(),this.updateSlidesClasses()),a.freeMode&&(0===i.velocities.length&&i.velocities.push({position:r[this.isHorizontal()?"startX":"startY"],time:i.touchStartTime}),i.velocities.push({position:r[this.isHorizontal()?"currentX":"currentY"],time:d.now()})),this.updateProgress(i.currentTranslate),this.setTranslate(i.currentTranslate))}}}}else i.startMoving&&i.isScrolling&&this.emit("touchMoveOpposite",o)}.bind(this),this.onTouchEnd=function(e){var t=this,i=t.touchEventsData,s=t.params,a=t.touches,r=t.rtlTranslate,n=t.$wrapperEl,o=t.slidesGrid,l=t.snapGrid,h=e;if(h.originalEvent&&(h=h.originalEvent),i.allowTouchCallbacks&&t.emit("touchEnd",h),i.allowTouchCallbacks=!1,!i.isTouched)return i.isMoved&&s.grabCursor&&t.setGrabCursor(!1),i.isMoved=!1,void(i.startMoving=!1);s.grabCursor&&i.isMoved&&i.isTouched&&(!0===t.allowSlideNext||!0===t.allowSlidePrev)&&t.setGrabCursor(!1);var p,c=d.now(),u=c-i.touchStartTime;if(t.allowClick&&(t.updateClickedSlide(h),t.emit("tap",h),u<300&&c-i.lastClickTime>300&&(i.clickTimeout&&clearTimeout(i.clickTimeout),i.clickTimeout=d.nextTick(function(){t&&!t.destroyed&&t.emit("click",h)},300)),u<300&&c-i.lastClickTime<300&&(i.clickTimeout&&clearTimeout(i.clickTimeout),t.emit("doubleTap",h))),i.lastClickTime=d.now(),d.nextTick(function(){t.destroyed||(t.allowClick=!0)}),!i.isTouched||!i.isMoved||!t.swipeDirection||0===a.diff||i.currentTranslate===i.startTranslate)return i.isTouched=!1,i.isMoved=!1,void(i.startMoving=!1);if(i.isTouched=!1,i.isMoved=!1,i.startMoving=!1,p=s.followFinger?r?t.translate:-t.translate:-i.currentTranslate,s.freeMode){if(p<-t.minTranslate())return void t.slideTo(t.activeIndex);if(p>-t.maxTranslate())return void(t.slides.length<l.length?t.slideTo(l.length-1):t.slideTo(t.slides.length-1));if(s.freeModeMomentum){if(i.velocities.length>1){var v=i.velocities.pop(),f=i.velocities.pop(),m=v.position-f.position,g=v.time-f.time;t.velocity=m/g,t.velocity/=2,Math.abs(t.velocity)<s.freeModeMinimumVelocity&&(t.velocity=0),(g>150||d.now()-v.time>300)&&(t.velocity=0)}else t.velocity=0;t.velocity*=s.freeModeMomentumVelocityRatio,i.velocities.length=0;var b=1e3*s.freeModeMomentumRatio,w=t.velocity*b,y=t.translate+w;r&&(y=-y);var x,E,T=!1,S=20*Math.abs(t.velocity)*s.freeModeMomentumBounceRatio;if(y<t.maxTranslate())s.freeModeMomentumBounce?(y+t.maxTranslate()<-S&&(y=t.maxTranslate()-S),x=t.maxTranslate(),T=!0,i.allowMomentumBounce=!0):y=t.maxTranslate(),s.loop&&s.centeredSlides&&(E=!0);else if(y>t.minTranslate())s.freeModeMomentumBounce?(y-t.minTranslate()>S&&(y=t.minTranslate()+S),x=t.minTranslate(),T=!0,i.allowMomentumBounce=!0):y=t.minTranslate(),s.loop&&s.centeredSlides&&(E=!0);else if(s.freeModeSticky){for(var C,M=0;M<l.length;M+=1)if(l[M]>-y){C=M;break}y=-(y=Math.abs(l[C]-y)<Math.abs(l[C-1]-y)||"next"===t.swipeDirection?l[C]:l[C-1])}if(E&&t.once("transitionEnd",function(){t.loopFix()}),0!==t.velocity)b=r?Math.abs((-y-t.translate)/t.velocity):Math.abs((y-t.translate)/t.velocity);else if(s.freeModeSticky)return void t.slideToClosest();s.freeModeMomentumBounce&&T?(t.updateProgress(x),t.setTransition(b),t.setTranslate(y),t.transitionStart(!0,t.swipeDirection),t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&i.allowMomentumBounce&&(t.emit("momentumBounce"),t.setTransition(s.speed),t.setTranslate(x),n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))})):t.velocity?(t.updateProgress(y),t.setTransition(b),t.setTranslate(y),t.transitionStart(!0,t.swipeDirection),t.animating||(t.animating=!0,n.transitionEnd(function(){t&&!t.destroyed&&t.transitionEnd()}))):t.updateProgress(y),t.updateActiveIndex(),t.updateSlidesClasses()}else if(s.freeModeSticky)return void t.slideToClosest();(!s.freeModeMomentum||u>=s.longSwipesMs)&&(t.updateProgress(),t.updateActiveIndex(),t.updateSlidesClasses())}else{for(var z=0,k=t.slidesSizesGrid[0],P=0;P<o.length;P+=s.slidesPerGroup)void 0!==o[P+s.slidesPerGroup]?p>=o[P]&&p<o[P+s.slidesPerGroup]&&(z=P,k=o[P+s.slidesPerGroup]-o[P]):p>=o[P]&&(z=P,k=o[o.length-1]-o[o.length-2]);var $=(p-o[z])/k;if(u>s.longSwipesMs){if(!s.longSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&($>=s.longSwipesRatio?t.slideTo(z+s.slidesPerGroup):t.slideTo(z)),"prev"===t.swipeDirection&&($>1-s.longSwipesRatio?t.slideTo(z+s.slidesPerGroup):t.slideTo(z))}else{if(!s.shortSwipes)return void t.slideTo(t.activeIndex);"next"===t.swipeDirection&&t.slideTo(z+s.slidesPerGroup),"prev"===t.swipeDirection&&t.slideTo(z)}}}.bind(this),this.onClick=function(e){this.allowClick||(this.params.preventClicks&&e.preventDefault(),this.params.preventClicksPropagation&&this.animating&&(e.stopPropagation(),e.stopImmediatePropagation()))}.bind(this);var o="container"===i.touchEventsTarget?r:n,l=!!i.nested;if(h.touch||!h.pointerEvents&&!h.prefixedPointerEvents){if(h.touch){var p=!("touchstart"!==a.start||!h.passiveListener||!i.passiveListeners)&&{passive:!0,capture:!1};o.addEventListener(a.start,this.onTouchStart,p),o.addEventListener(a.move,this.onTouchMove,h.passiveListener?{passive:!1,capture:l}:l),o.addEventListener(a.end,this.onTouchEnd,p)}(i.simulateTouch&&!y.ios&&!y.android||i.simulateTouch&&!h.touch&&y.ios)&&(o.addEventListener("mousedown",this.onTouchStart,!1),e.addEventListener("mousemove",this.onTouchMove,l),e.addEventListener("mouseup",this.onTouchEnd,!1))}else o.addEventListener(a.start,this.onTouchStart,!1),e.addEventListener(a.move,this.onTouchMove,l),e.addEventListener(a.end,this.onTouchEnd,!1);(i.preventClicks||i.preventClicksPropagation)&&o.addEventListener("click",this.onClick,!0),this.on(y.ios||y.android?"resize orientationchange observerUpdate":"resize observerUpdate",x,!0)},detachEvents:function(){var t=this.params,i=this.touchEvents,s=this.el,a=this.wrapperEl,r="container"===t.touchEventsTarget?s:a,n=!!t.nested;if(h.touch||!h.pointerEvents&&!h.prefixedPointerEvents){if(h.touch){var o=!("onTouchStart"!==i.start||!h.passiveListener||!t.passiveListeners)&&{passive:!0,capture:!1};r.removeEventListener(i.start,this.onTouchStart,o),r.removeEventListener(i.move,this.onTouchMove,n),r.removeEventListener(i.end,this.onTouchEnd,o)}(t.simulateTouch&&!y.ios&&!y.android||t.simulateTouch&&!h.touch&&y.ios)&&(r.removeEventListener("mousedown",this.onTouchStart,!1),e.removeEventListener("mousemove",this.onTouchMove,n),e.removeEventListener("mouseup",this.onTouchEnd,!1))}else r.removeEventListener(i.start,this.onTouchStart,!1),e.removeEventListener(i.move,this.onTouchMove,n),e.removeEventListener(i.end,this.onTouchEnd,!1);(t.preventClicks||t.preventClicksPropagation)&&r.removeEventListener("click",this.onClick,!0),this.off(y.ios||y.android?"resize orientationchange observerUpdate":"resize observerUpdate",x)}};var T={setBreakpoint:function(){var e=this.activeIndex,t=this.initialized,i=this.loopedSlides;void 0===i&&(i=0);var s=this.params,a=s.breakpoints;if(a&&(!a||0!==Object.keys(a).length)){var r=this.getBreakpoint(a);if(r&&this.currentBreakpoint!==r){var n=r in a?a[r]:this.originalParams,o=s.loop&&n.slidesPerView!==s.slidesPerView;d.extend(this.params,n),d.extend(this,{allowTouchMove:this.params.allowTouchMove,allowSlideNext:this.params.allowSlideNext,allowSlidePrev:this.params.allowSlidePrev}),this.currentBreakpoint=r,o&&t&&(this.loopDestroy(),this.loopCreate(),this.updateSlides(),this.slideTo(e-i+this.loopedSlides,0,!1)),this.emit("breakpoint",n)}}},getBreakpoint:function(e){if(e){var i=!1,s=[];Object.keys(e).forEach(function(e){s.push(e)}),s.sort(function(e,t){return parseInt(e,10)-parseInt(t,10)});for(var a=0;a<s.length;a+=1){var r=s[a];r>=t.innerWidth&&!i&&(i=r)}return i||"max"}}},S=function(){return{isIE:!!t.navigator.userAgent.match(/Trident/g)||!!t.navigator.userAgent.match(/MSIE/g),isSafari:(e=t.navigator.userAgent.toLowerCase(),e.indexOf("safari")>=0&&e.indexOf("chrome")<0&&e.indexOf("android")<0),isUiWebView:/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(t.navigator.userAgent)};var e}();var C={init:!0,direction:"horizontal",touchEventsTarget:"container",initialSlide:0,speed:300,preventIntercationOnTransition:!1,iOSEdgeSwipeDetection:!1,iOSEdgeSwipeThreshold:20,freeMode:!1,freeModeMomentum:!0,freeModeMomentumRatio:1,freeModeMomentumBounce:!0,freeModeMomentumBounceRatio:1,freeModeMomentumVelocityRatio:1,freeModeSticky:!1,freeModeMinimumVelocity:.02,autoHeight:!1,setWrapperSize:!1,virtualTranslate:!1,effect:"slide",breakpoints:void 0,spaceBetween:0,slidesPerView:1,slidesPerColumn:1,slidesPerColumnFill:"column",slidesPerGroup:1,centeredSlides:!1,slidesOffsetBefore:0,slidesOffsetAfter:0,normalizeSlideIndex:!0,watchOverflow:!1,roundLengths:!1,touchRatio:1,touchAngle:45,simulateTouch:!0,shortSwipes:!0,longSwipes:!0,longSwipesRatio:.5,longSwipesMs:300,followFinger:!0,allowTouchMove:!0,threshold:0,touchMoveStopPropagation:!0,touchReleaseOnEdges:!1,uniqueNavElements:!0,resistance:!0,resistanceRatio:.85,watchSlidesProgress:!1,watchSlidesVisibility:!1,grabCursor:!1,preventClicks:!0,preventClicksPropagation:!0,slideToClickedSlide:!1,preloadImages:!0,updateOnImagesReady:!0,loop:!1,loopAdditionalSlides:0,loopedSlides:null,loopFillGroupWithBlank:!1,allowSlidePrev:!0,allowSlideNext:!0,swipeHandler:null,noSwiping:!0,noSwipingClass:"swiper-no-swiping",noSwipingSelector:null,passiveListeners:!0,containerModifierClass:"swiper-container-",slideClass:"swiper-slide",slideBlankClass:"swiper-slide-invisible-blank",slideActiveClass:"swiper-slide-active",slideDuplicateActiveClass:"swiper-slide-duplicate-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",slideNextClass:"swiper-slide-next",slideDuplicateNextClass:"swiper-slide-duplicate-next",slidePrevClass:"swiper-slide-prev",slideDuplicatePrevClass:"swiper-slide-duplicate-prev",wrapperClass:"swiper-wrapper",runCallbacksOnInit:!0},M={update:u,translate:v,transition:f,slide:m,loop:g,grabCursor:b,manipulation:w,events:E,breakpoints:T,checkOverflow:{checkOverflow:function(){var e=this.isLocked;this.isLocked=1===this.snapGrid.length,this.allowSlideNext=!this.isLocked,this.allowSlidePrev=!this.isLocked,e!==this.isLocked&&this.emit(this.isLocked?"lock":"unlock"),e&&e!==this.isLocked&&(this.isEnd=!1,this.navigation.update())}},classes:{addClasses:function(){var e=this.classNames,t=this.params,i=this.rtl,s=this.$el,a=[];a.push(t.direction),t.freeMode&&a.push("free-mode"),h.flexbox||a.push("no-flexbox"),t.autoHeight&&a.push("autoheight"),i&&a.push("rtl"),t.slidesPerColumn>1&&a.push("multirow"),y.android&&a.push("android"),y.ios&&a.push("ios"),S.isIE&&(h.pointerEvents||h.prefixedPointerEvents)&&a.push("wp8-"+t.direction),a.forEach(function(i){e.push(t.containerModifierClass+i)}),s.addClass(e.join(" "))},removeClasses:function(){var e=this.$el,t=this.classNames;e.removeClass(t.join(" "))}},images:{loadImage:function(e,i,s,a,r,n){var o;function l(){n&&n()}e.complete&&r?l():i?((o=new t.Image).onload=l,o.onerror=l,a&&(o.sizes=a),s&&(o.srcset=s),i&&(o.src=i)):l()},preloadImages:function(){var e=this;function t(){void 0!==e&&null!==e&&e&&!e.destroyed&&(void 0!==e.imagesLoaded&&(e.imagesLoaded+=1),e.imagesLoaded===e.imagesToLoad.length&&(e.params.updateOnImagesReady&&e.update(),e.emit("imagesReady")))}e.imagesToLoad=e.$el.find("img");for(var i=0;i<e.imagesToLoad.length;i+=1){var s=e.imagesToLoad[i];e.loadImage(s,s.currentSrc||s.getAttribute("src"),s.srcset||s.getAttribute("srcset"),s.sizes||s.getAttribute("sizes"),!0,t)}}}},z={},k=function(e){function t(){for(var i,a,r,n=[],o=arguments.length;o--;)n[o]=arguments[o];1===n.length&&n[0].constructor&&n[0].constructor===Object?r=n[0]:(a=(i=n)[0],r=i[1]),r||(r={}),r=d.extend({},r),a&&!r.el&&(r.el=a),e.call(this,r),Object.keys(M).forEach(function(e){Object.keys(M[e]).forEach(function(i){t.prototype[i]||(t.prototype[i]=M[e][i])})});var l=this;void 0===l.modules&&(l.modules={}),Object.keys(l.modules).forEach(function(e){var t=l.modules[e];if(t.params){var i=Object.keys(t.params)[0],s=t.params[i];if("object"!=typeof s)return;if(!(i in r&&"enabled"in s))return;!0===r[i]&&(r[i]={enabled:!0}),"object"!=typeof r[i]||"enabled"in r[i]||(r[i].enabled=!0),r[i]||(r[i]={enabled:!1})}});var p=d.extend({},C);l.useModulesParams(p),l.params=d.extend({},p,z,r),l.originalParams=d.extend({},l.params),l.passedParams=d.extend({},r),l.$=s;var c=s(l.params.el);if(a=c[0]){if(c.length>1){var u=[];return c.each(function(e,i){var s=d.extend({},r,{el:i});u.push(new t(s))}),u}a.swiper=l,c.data("swiper",l);var v,f,m=c.children("."+l.params.wrapperClass);return d.extend(l,{$el:c,el:a,$wrapperEl:m,wrapperEl:m[0],classNames:[],slides:s(),slidesGrid:[],snapGrid:[],slidesSizesGrid:[],isHorizontal:function(){return"horizontal"===l.params.direction},isVertical:function(){return"vertical"===l.params.direction},rtl:"rtl"===a.dir.toLowerCase()||"rtl"===c.css("direction"),rtlTranslate:"horizontal"===l.params.direction&&("rtl"===a.dir.toLowerCase()||"rtl"===c.css("direction")),wrongRTL:"-webkit-box"===m.css("display"),activeIndex:0,realIndex:0,isBeginning:!0,isEnd:!1,translate:0,previousTranslate:0,progress:0,velocity:0,animating:!1,allowSlideNext:l.params.allowSlideNext,allowSlidePrev:l.params.allowSlidePrev,touchEvents:(v=["touchstart","touchmove","touchend"],f=["mousedown","mousemove","mouseup"],h.pointerEvents?f=["pointerdown","pointermove","pointerup"]:h.prefixedPointerEvents&&(f=["MSPointerDown","MSPointerMove","MSPointerUp"]),l.touchEventsTouch={start:v[0],move:v[1],end:v[2]},l.touchEventsDesktop={start:f[0],move:f[1],end:f[2]},h.touch||!l.params.simulateTouch?l.touchEventsTouch:l.touchEventsDesktop),touchEventsData:{isTouched:void 0,isMoved:void 0,allowTouchCallbacks:void 0,touchStartTime:void 0,isScrolling:void 0,currentTranslate:void 0,startTranslate:void 0,allowThresholdMove:void 0,formElements:"input, select, option, textarea, button, video",lastClickTime:d.now(),clickTimeout:void 0,velocities:[],allowMomentumBounce:void 0,isTouchEvent:void 0,startMoving:void 0},allowClick:!0,allowTouchMove:l.params.allowTouchMove,touches:{startX:0,startY:0,currentX:0,currentY:0,diff:0},imagesToLoad:[],imagesLoaded:0}),l.useModules(),l.params.init&&l.init(),l}}e&&(t.__proto__=e),t.prototype=Object.create(e&&e.prototype),t.prototype.constructor=t;var i={extendedDefaults:{configurable:!0},defaults:{configurable:!0},Class:{configurable:!0},$:{configurable:!0}};return t.prototype.slidesPerViewDynamic=function(){var e=this.params,t=this.slides,i=this.slidesGrid,s=this.size,a=this.activeIndex,r=1;if(e.centeredSlides){for(var n,o=t[a].swiperSlideSize,l=a+1;l<t.length;l+=1)t[l]&&!n&&(r+=1,(o+=t[l].swiperSlideSize)>s&&(n=!0));for(var d=a-1;d>=0;d-=1)t[d]&&!n&&(r+=1,(o+=t[d].swiperSlideSize)>s&&(n=!0))}else for(var h=a+1;h<t.length;h+=1)i[h]-i[a]<s&&(r+=1);return r},t.prototype.update=function(){var e=this;if(e&&!e.destroyed){var t=e.snapGrid,i=e.params;i.breakpoints&&e.setBreakpoint(),e.updateSize(),e.updateSlides(),e.updateProgress(),e.updateSlidesClasses(),e.params.freeMode?(s(),e.params.autoHeight&&e.updateAutoHeight()):(("auto"===e.params.slidesPerView||e.params.slidesPerView>1)&&e.isEnd&&!e.params.centeredSlides?e.slideTo(e.slides.length-1,0,!1,!0):e.slideTo(e.activeIndex,0,!1,!0))||s(),i.watchOverflow&&t!==e.snapGrid&&e.checkOverflow(),e.emit("update")}function s(){var t=e.rtlTranslate?-1*e.translate:e.translate,i=Math.min(Math.max(t,e.maxTranslate()),e.minTranslate());e.setTranslate(i),e.updateActiveIndex(),e.updateSlidesClasses()}},t.prototype.init=function(){this.initialized||(this.emit("beforeInit"),this.params.breakpoints&&this.setBreakpoint(),this.addClasses(),this.params.loop&&this.loopCreate(),this.updateSize(),this.updateSlides(),this.params.watchOverflow&&this.checkOverflow(),this.params.grabCursor&&this.setGrabCursor(),this.params.preloadImages&&this.preloadImages(),this.params.loop?this.slideTo(this.params.initialSlide+this.loopedSlides,0,this.params.runCallbacksOnInit):this.slideTo(this.params.initialSlide,0,this.params.runCallbacksOnInit),this.attachEvents(),this.initialized=!0,this.emit("init"))},t.prototype.destroy=function(e,t){void 0===e&&(e=!0),void 0===t&&(t=!0);var i=this,s=i.params,a=i.$el,r=i.$wrapperEl,n=i.slides;return void 0===i.params||i.destroyed?null:(i.emit("beforeDestroy"),i.initialized=!1,i.detachEvents(),s.loop&&i.loopDestroy(),t&&(i.removeClasses(),a.removeAttr("style"),r.removeAttr("style"),n&&n.length&&n.removeClass([s.slideVisibleClass,s.slideActiveClass,s.slideNextClass,s.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-slide-index").removeAttr("data-swiper-column").removeAttr("data-swiper-row")),i.emit("destroy"),Object.keys(i.eventsListeners).forEach(function(e){i.off(e)}),!1!==e&&(i.$el[0].swiper=null,i.$el.data("swiper",null),d.deleteProps(i)),i.destroyed=!0,null)},t.extendDefaults=function(e){d.extend(z,e)},i.extendedDefaults.get=function(){return z},i.defaults.get=function(){return C},i.Class.get=function(){return e},i.$.get=function(){return s},Object.defineProperties(t,i),t}(p),P={name:"device",proto:{device:y},static:{device:y}},$={name:"support",proto:{support:h},static:{support:h}},L={name:"browser",proto:{browser:S},static:{browser:S}},I={name:"resize",create:function(){var e=this;d.extend(e,{resize:{resizeHandler:function(){e&&!e.destroyed&&e.initialized&&(e.emit("beforeResize"),e.emit("resize"))},orientationChangeHandler:function(){e&&!e.destroyed&&e.initialized&&e.emit("orientationchange")}}})},on:{init:function(){t.addEventListener("resize",this.resize.resizeHandler),t.addEventListener("orientationchange",this.resize.orientationChangeHandler)},destroy:function(){t.removeEventListener("resize",this.resize.resizeHandler),t.removeEventListener("orientationchange",this.resize.orientationChangeHandler)}}},D={func:t.MutationObserver||t.WebkitMutationObserver,attach:function(e,t){void 0===t&&(t={});var i=this,s=new(0,D.func)(function(e){e.forEach(function(e){i.emit("observerUpdate",e)})});s.observe(e,{attributes:void 0===t.attributes||t.attributes,childList:void 0===t.childList||t.childList,characterData:void 0===t.characterData||t.characterData}),i.observer.observers.push(s)},init:function(){if(h.observer&&this.params.observer){if(this.params.observeParents)for(var e=this.$el.parents(),t=0;t<e.length;t+=1)this.observer.attach(e[t]);this.observer.attach(this.$el[0],{childList:!1}),this.observer.attach(this.$wrapperEl[0],{attributes:!1})}},destroy:function(){this.observer.observers.forEach(function(e){e.disconnect()}),this.observer.observers=[]}},O={name:"observer",params:{observer:!1,observeParents:!1},create:function(){d.extend(this,{observer:{init:D.init.bind(this),attach:D.attach.bind(this),destroy:D.destroy.bind(this),observers:[]}})},on:{init:function(){this.observer.init()},destroy:function(){this.observer.destroy()}}},A={update:function(e){var t=this,i=t.params,s=i.slidesPerView,a=i.slidesPerGroup,r=i.centeredSlides,n=t.virtual,o=n.from,l=n.to,h=n.slides,p=n.slidesGrid,c=n.renderSlide,u=n.offset;t.updateActiveIndex();var v,f,m,g=t.activeIndex||0;v=t.rtlTranslate?"right":t.isHorizontal()?"left":"top",r?(f=Math.floor(s/2)+a,m=Math.floor(s/2)+a):(f=s+(a-1),m=a);var b=Math.max((g||0)-m,0),w=Math.min((g||0)+f,h.length-1),y=(t.slidesGrid[b]||0)-(t.slidesGrid[0]||0);function x(){t.updateSlides(),t.updateProgress(),t.updateSlidesClasses(),t.lazy&&t.params.lazy.enabled&&t.lazy.load()}if(d.extend(t.virtual,{from:b,to:w,offset:y,slidesGrid:t.slidesGrid}),o===b&&l===w&&!e)return t.slidesGrid!==p&&y!==u&&t.slides.css(v,y+"px"),void t.updateProgress();if(t.params.virtual.renderExternal)return t.params.virtual.renderExternal.call(t,{offset:y,from:b,to:w,slides:function(){for(var e=[],t=b;t<=w;t+=1)e.push(h[t]);return e}()}),void x();var E=[],T=[];if(e)t.$wrapperEl.find("."+t.params.slideClass).remove();else for(var S=o;S<=l;S+=1)(S<b||S>w)&&t.$wrapperEl.find("."+t.params.slideClass+'[data-swiper-slide-index="'+S+'"]').remove();for(var C=0;C<h.length;C+=1)C>=b&&C<=w&&(void 0===l||e?T.push(C):(C>l&&T.push(C),C<o&&E.push(C)));T.forEach(function(e){t.$wrapperEl.append(c(h[e],e))}),E.sort(function(e,t){return e<t}).forEach(function(e){t.$wrapperEl.prepend(c(h[e],e))}),t.$wrapperEl.children(".swiper-slide").css(v,y+"px"),x()},renderSlide:function(e,t){var i=this.params.virtual;if(i.cache&&this.virtual.cache[t])return this.virtual.cache[t];var a=i.renderSlide?s(i.renderSlide.call(this,e,t)):s('<div class="'+this.params.slideClass+'" data-swiper-slide-index="'+t+'">'+e+"</div>");return a.attr("data-swiper-slide-index")||a.attr("data-swiper-slide-index",t),i.cache&&(this.virtual.cache[t]=a),a},appendSlide:function(e){this.virtual.slides.push(e),this.virtual.update(!0)},prependSlide:function(e){if(this.virtual.slides.unshift(e),this.params.virtual.cache){var t=this.virtual.cache,i={};Object.keys(t).forEach(function(e){i[e+1]=t[e]}),this.virtual.cache=i}this.virtual.update(!0),this.slideNext(0)}},G={name:"virtual",params:{virtual:{enabled:!1,slides:[],cache:!0,renderSlide:null,renderExternal:null}},create:function(){d.extend(this,{virtual:{update:A.update.bind(this),appendSlide:A.appendSlide.bind(this),prependSlide:A.prependSlide.bind(this),renderSlide:A.renderSlide.bind(this),slides:this.params.virtual.slides,cache:{}}})},on:{beforeInit:function(){if(this.params.virtual.enabled){this.classNames.push(this.params.containerModifierClass+"virtual");var e={watchSlidesProgress:!0};d.extend(this.params,e),d.extend(this.originalParams,e),this.virtual.update()}},setTranslate:function(){this.params.virtual.enabled&&this.virtual.update()}}},H={handle:function(i){var s=this.rtlTranslate,a=i;a.originalEvent&&(a=a.originalEvent);var r=a.keyCode||a.charCode;if(!this.allowSlideNext&&(this.isHorizontal()&&39===r||this.isVertical()&&40===r))return!1;if(!this.allowSlidePrev&&(this.isHorizontal()&&37===r||this.isVertical()&&38===r))return!1;if(!(a.shiftKey||a.altKey||a.ctrlKey||a.metaKey||e.activeElement&&e.activeElement.nodeName&&("input"===e.activeElement.nodeName.toLowerCase()||"textarea"===e.activeElement.nodeName.toLowerCase()))){if(this.params.keyboard.onlyInViewport&&(37===r||39===r||38===r||40===r)){var n=!1;if(this.$el.parents("."+this.params.slideClass).length>0&&0===this.$el.parents("."+this.params.slideActiveClass).length)return;var o=t.innerWidth,l=t.innerHeight,d=this.$el.offset();s&&(d.left-=this.$el[0].scrollLeft);for(var h=[[d.left,d.top],[d.left+this.width,d.top],[d.left,d.top+this.height],[d.left+this.width,d.top+this.height]],p=0;p<h.length;p+=1){var c=h[p];c[0]>=0&&c[0]<=o&&c[1]>=0&&c[1]<=l&&(n=!0)}if(!n)return}this.isHorizontal()?(37!==r&&39!==r||(a.preventDefault?a.preventDefault():a.returnValue=!1),(39===r&&!s||37===r&&s)&&this.slideNext(),(37===r&&!s||39===r&&s)&&this.slidePrev()):(38!==r&&40!==r||(a.preventDefault?a.preventDefault():a.returnValue=!1),40===r&&this.slideNext(),38===r&&this.slidePrev()),this.emit("keyPress",r)}},enable:function(){this.keyboard.enabled||(s(e).on("keydown",this.keyboard.handle),this.keyboard.enabled=!0)},disable:function(){this.keyboard.enabled&&(s(e).off("keydown",this.keyboard.handle),this.keyboard.enabled=!1)}},N={name:"keyboard",params:{keyboard:{enabled:!1,onlyInViewport:!0}},create:function(){d.extend(this,{keyboard:{enabled:!1,enable:H.enable.bind(this),disable:H.disable.bind(this),handle:H.handle.bind(this)}})},on:{init:function(){this.params.keyboard.enabled&&this.keyboard.enable()},destroy:function(){this.keyboard.enabled&&this.keyboard.disable()}}};var B={lastScrollTime:d.now(),event:t.navigator.userAgent.indexOf("firefox")>-1?"DOMMouseScroll":function(){var t="onwheel"in e;if(!t){var i=e.createElement("div");i.setAttribute("onwheel","return;"),t="function"==typeof i.onwheel}return!t&&e.implementation&&e.implementation.hasFeature&&!0!==e.implementation.hasFeature("","")&&(t=e.implementation.hasFeature("Events.wheel","3.0")),t}()?"wheel":"mousewheel",normalize:function(e){var t=0,i=0,s=0,a=0;return"detail"in e&&(i=e.detail),"wheelDelta"in e&&(i=-e.wheelDelta/120),"wheelDeltaY"in e&&(i=-e.wheelDeltaY/120),"wheelDeltaX"in e&&(t=-e.wheelDeltaX/120),"axis"in e&&e.axis===e.HORIZONTAL_AXIS&&(t=i,i=0),s=10*t,a=10*i,"deltaY"in e&&(a=e.deltaY),"deltaX"in e&&(s=e.deltaX),(s||a)&&e.deltaMode&&(1===e.deltaMode?(s*=40,a*=40):(s*=800,a*=800)),s&&!t&&(t=s<1?-1:1),a&&!i&&(i=a<1?-1:1),{spinX:t,spinY:i,pixelX:s,pixelY:a}},handleMouseEnter:function(){this.mouseEntered=!0},handleMouseLeave:function(){this.mouseEntered=!1},handle:function(e){var i=e,s=this,a=s.params.mousewheel;if(!s.mouseEntered&&!a.releaseOnEdges)return!0;i.originalEvent&&(i=i.originalEvent);var r=0,n=s.rtlTranslate?-1:1,o=B.normalize(i);if(a.forceToAxis)if(s.isHorizontal()){if(!(Math.abs(o.pixelX)>Math.abs(o.pixelY)))return!0;r=o.pixelX*n}else{if(!(Math.abs(o.pixelY)>Math.abs(o.pixelX)))return!0;r=o.pixelY}else r=Math.abs(o.pixelX)>Math.abs(o.pixelY)?-o.pixelX*n:-o.pixelY;if(0===r)return!0;if(a.invert&&(r=-r),s.params.freeMode){s.params.loop&&s.loopFix();var l=s.getTranslate()+r*a.sensitivity,h=s.isBeginning,p=s.isEnd;if(l>=s.minTranslate()&&(l=s.minTranslate()),l<=s.maxTranslate()&&(l=s.maxTranslate()),s.setTransition(0),s.setTranslate(l),s.updateProgress(),s.updateActiveIndex(),s.updateSlidesClasses(),(!h&&s.isBeginning||!p&&s.isEnd)&&s.updateSlidesClasses(),s.params.freeModeSticky&&(clearTimeout(s.mousewheel.timeout),s.mousewheel.timeout=d.nextTick(function(){s.slideToClosest()},300)),s.emit("scroll",i),s.params.autoplay&&s.params.autoplayDisableOnInteraction&&s.autoplay.stop(),l===s.minTranslate()||l===s.maxTranslate())return!0}else{if(d.now()-s.mousewheel.lastScrollTime>60)if(r<0)if(s.isEnd&&!s.params.loop||s.animating){if(a.releaseOnEdges)return!0}else s.slideNext(),s.emit("scroll",i);else if(s.isBeginning&&!s.params.loop||s.animating){if(a.releaseOnEdges)return!0}else s.slidePrev(),s.emit("scroll",i);s.mousewheel.lastScrollTime=(new t.Date).getTime()}return i.preventDefault?i.preventDefault():i.returnValue=!1,!1},enable:function(){if(!B.event)return!1;if(this.mousewheel.enabled)return!1;var e=this.$el;return"container"!==this.params.mousewheel.eventsTarged&&(e=s(this.params.mousewheel.eventsTarged)),e.on("mouseenter",this.mousewheel.handleMouseEnter),e.on("mouseleave",this.mousewheel.handleMouseLeave),e.on(B.event,this.mousewheel.handle),this.mousewheel.enabled=!0,!0},disable:function(){if(!B.event)return!1;if(!this.mousewheel.enabled)return!1;var e=this.$el;return"container"!==this.params.mousewheel.eventsTarged&&(e=s(this.params.mousewheel.eventsTarged)),e.off(B.event,this.mousewheel.handle),this.mousewheel.enabled=!1,!0}},X={update:function(){var e=this.params.navigation;if(!this.params.loop){var t=this.navigation,i=t.$nextEl,s=t.$prevEl;s&&s.length>0&&(this.isBeginning?s.addClass(e.disabledClass):s.removeClass(e.disabledClass),s[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](e.lockClass)),i&&i.length>0&&(this.isEnd?i.addClass(e.disabledClass):i.removeClass(e.disabledClass),i[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](e.lockClass))}},init:function(){var e,t,i=this,a=i.params.navigation;(a.nextEl||a.prevEl)&&(a.nextEl&&(e=s(a.nextEl),i.params.uniqueNavElements&&"string"==typeof a.nextEl&&e.length>1&&1===i.$el.find(a.nextEl).length&&(e=i.$el.find(a.nextEl))),a.prevEl&&(t=s(a.prevEl),i.params.uniqueNavElements&&"string"==typeof a.prevEl&&t.length>1&&1===i.$el.find(a.prevEl).length&&(t=i.$el.find(a.prevEl))),e&&e.length>0&&e.on("click",function(e){e.preventDefault(),i.isEnd&&!i.params.loop||i.slideNext()}),t&&t.length>0&&t.on("click",function(e){e.preventDefault(),i.isBeginning&&!i.params.loop||i.slidePrev()}),d.extend(i.navigation,{$nextEl:e,nextEl:e&&e[0],$prevEl:t,prevEl:t&&t[0]}))},destroy:function(){var e=this.navigation,t=e.$nextEl,i=e.$prevEl;t&&t.length&&(t.off("click"),t.removeClass(this.params.navigation.disabledClass)),i&&i.length&&(i.off("click"),i.removeClass(this.params.navigation.disabledClass))}},Y={update:function(){var e=this.rtl,t=this.params.pagination;if(t.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var i,a=this.virtual&&this.params.virtual.enabled?this.virtual.slides.length:this.slides.length,r=this.pagination.$el,n=this.params.loop?Math.ceil((a-2*this.loopedSlides)/this.params.slidesPerGroup):this.snapGrid.length;if(this.params.loop?((i=Math.ceil((this.activeIndex-this.loopedSlides)/this.params.slidesPerGroup))>a-1-2*this.loopedSlides&&(i-=a-2*this.loopedSlides),i>n-1&&(i-=n),i<0&&"bullets"!==this.params.paginationType&&(i=n+i)):i=void 0!==this.snapIndex?this.snapIndex:this.activeIndex||0,"bullets"===t.type&&this.pagination.bullets&&this.pagination.bullets.length>0){var o,l,d,h=this.pagination.bullets;if(t.dynamicBullets&&(this.pagination.bulletSize=h.eq(0)[this.isHorizontal()?"outerWidth":"outerHeight"](!0),r.css(this.isHorizontal()?"width":"height",this.pagination.bulletSize*(t.dynamicMainBullets+4)+"px"),t.dynamicMainBullets>1&&void 0!==this.previousIndex&&(this.pagination.dynamicBulletIndex+=i-this.previousIndex,this.pagination.dynamicBulletIndex>t.dynamicMainBullets-1?this.pagination.dynamicBulletIndex=t.dynamicMainBullets-1:this.pagination.dynamicBulletIndex<0&&(this.pagination.dynamicBulletIndex=0)),o=i-this.pagination.dynamicBulletIndex,d=((l=o+(Math.min(h.length,t.dynamicMainBullets)-1))+o)/2),h.removeClass(t.bulletActiveClass+" "+t.bulletActiveClass+"-next "+t.bulletActiveClass+"-next-next "+t.bulletActiveClass+"-prev "+t.bulletActiveClass+"-prev-prev "+t.bulletActiveClass+"-main"),r.length>1)h.each(function(e,a){var r=s(a),n=r.index();n===i&&r.addClass(t.bulletActiveClass),t.dynamicBullets&&(n>=o&&n<=l&&r.addClass(t.bulletActiveClass+"-main"),n===o&&r.prev().addClass(t.bulletActiveClass+"-prev").prev().addClass(t.bulletActiveClass+"-prev-prev"),n===l&&r.next().addClass(t.bulletActiveClass+"-next").next().addClass(t.bulletActiveClass+"-next-next"))});else if(h.eq(i).addClass(t.bulletActiveClass),t.dynamicBullets){for(var p=h.eq(o),c=h.eq(l),u=o;u<=l;u+=1)h.eq(u).addClass(t.bulletActiveClass+"-main");p.prev().addClass(t.bulletActiveClass+"-prev").prev().addClass(t.bulletActiveClass+"-prev-prev"),c.next().addClass(t.bulletActiveClass+"-next").next().addClass(t.bulletActiveClass+"-next-next")}if(t.dynamicBullets){var v=Math.min(h.length,t.dynamicMainBullets+4),f=(this.pagination.bulletSize*v-this.pagination.bulletSize)/2-d*this.pagination.bulletSize,m=e?"right":"left";h.css(this.isHorizontal()?m:"top",f+"px")}}if("fraction"===t.type&&(r.find("."+t.currentClass).text(t.formatFractionCurrent(i+1)),r.find("."+t.totalClass).text(t.formatFractionTotal(n))),"progressbar"===t.type){var g;g=t.progressbarOpposite?this.isHorizontal()?"vertical":"horizontal":this.isHorizontal()?"horizontal":"vertical";var b=(i+1)/n,w=1,y=1;"horizontal"===g?w=b:y=b,r.find("."+t.progressbarFillClass).transform("translate3d(0,0,0) scaleX("+w+") scaleY("+y+")").transition(this.params.speed)}"custom"===t.type&&t.renderCustom?(r.html(t.renderCustom(this,i+1,n)),this.emit("paginationRender",this,r[0])):this.emit("paginationUpdate",this,r[0]),r[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](t.lockClass)}},render:function(){var e=this.params.pagination;if(e.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var t=this.virtual&&this.params.virtual.enabled?this.virtual.slides.length:this.slides.length,i=this.pagination.$el,s="";if("bullets"===e.type){for(var a=this.params.loop?Math.ceil((t-2*this.loopedSlides)/this.params.slidesPerGroup):this.snapGrid.length,r=0;r<a;r+=1)e.renderBullet?s+=e.renderBullet.call(this,r,e.bulletClass):s+="<"+e.bulletElement+' class="'+e.bulletClass+'"></'+e.bulletElement+">";i.html(s),this.pagination.bullets=i.find("."+e.bulletClass)}"fraction"===e.type&&(s=e.renderFraction?e.renderFraction.call(this,e.currentClass,e.totalClass):'<span class="'+e.currentClass+'"></span> / <span class="'+e.totalClass+'"></span>',i.html(s)),"progressbar"===e.type&&(s=e.renderProgressbar?e.renderProgressbar.call(this,e.progressbarFillClass):'<span class="'+e.progressbarFillClass+'"></span>',i.html(s)),"custom"!==e.type&&this.emit("paginationRender",this.pagination.$el[0])}},init:function(){var e=this,t=e.params.pagination;if(t.el){var i=s(t.el);0!==i.length&&(e.params.uniqueNavElements&&"string"==typeof t.el&&i.length>1&&1===e.$el.find(t.el).length&&(i=e.$el.find(t.el)),"bullets"===t.type&&t.clickable&&i.addClass(t.clickableClass),i.addClass(t.modifierClass+t.type),"bullets"===t.type&&t.dynamicBullets&&(i.addClass(""+t.modifierClass+t.type+"-dynamic"),e.pagination.dynamicBulletIndex=0,t.dynamicMainBullets<1&&(t.dynamicMainBullets=1)),"progressbar"===t.type&&t.progressbarOpposite&&i.addClass(t.progressbarOppositeClass),t.clickable&&i.on("click","."+t.bulletClass,function(t){t.preventDefault();var i=s(this).index()*e.params.slidesPerGroup;e.params.loop&&(i+=e.loopedSlides),e.slideTo(i)}),d.extend(e.pagination,{$el:i,el:i[0]}))}},destroy:function(){var e=this.params.pagination;if(e.el&&this.pagination.el&&this.pagination.$el&&0!==this.pagination.$el.length){var t=this.pagination.$el;t.removeClass(e.hiddenClass),t.removeClass(e.modifierClass+e.type),this.pagination.bullets&&this.pagination.bullets.removeClass(e.bulletActiveClass),e.clickable&&t.off("click","."+e.bulletClass)}}},V={setTranslate:function(){if(this.params.scrollbar.el&&this.scrollbar.el){var e=this.scrollbar,t=this.rtlTranslate,i=this.progress,s=e.dragSize,a=e.trackSize,r=e.$dragEl,n=e.$el,o=this.params.scrollbar,l=s,d=(a-s)*i;t?(d=-d)>0?(l=s-d,d=0):-d+s>a&&(l=a+d):d<0?(l=s+d,d=0):d+s>a&&(l=a-d),this.isHorizontal()?(h.transforms3d?r.transform("translate3d("+d+"px, 0, 0)"):r.transform("translateX("+d+"px)"),r[0].style.width=l+"px"):(h.transforms3d?r.transform("translate3d(0px, "+d+"px, 0)"):r.transform("translateY("+d+"px)"),r[0].style.height=l+"px"),o.hide&&(clearTimeout(this.scrollbar.timeout),n[0].style.opacity=1,this.scrollbar.timeout=setTimeout(function(){n[0].style.opacity=0,n.transition(400)},1e3))}},setTransition:function(e){this.params.scrollbar.el&&this.scrollbar.el&&this.scrollbar.$dragEl.transition(e)},updateSize:function(){if(this.params.scrollbar.el&&this.scrollbar.el){var e=this.scrollbar,t=e.$dragEl,i=e.$el;t[0].style.width="",t[0].style.height="";var s,a=this.isHorizontal()?i[0].offsetWidth:i[0].offsetHeight,r=this.size/this.virtualSize,n=r*(a/this.size);s="auto"===this.params.scrollbar.dragSize?a*r:parseInt(this.params.scrollbar.dragSize,10),this.isHorizontal()?t[0].style.width=s+"px":t[0].style.height=s+"px",i[0].style.display=r>=1?"none":"",this.params.scrollbarHide&&(i[0].style.opacity=0),d.extend(e,{trackSize:a,divider:r,moveDivider:n,dragSize:s}),e.$el[this.params.watchOverflow&&this.isLocked?"addClass":"removeClass"](this.params.scrollbar.lockClass)}},setDragPosition:function(e){var t,i=this.scrollbar,s=this.rtlTranslate,a=i.$el,r=i.dragSize,n=i.trackSize;t=((this.isHorizontal()?"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageX:e.pageX||e.clientX:"touchstart"===e.type||"touchmove"===e.type?e.targetTouches[0].pageY:e.pageY||e.clientY)-a.offset()[this.isHorizontal()?"left":"top"]-r/2)/(n-r),t=Math.max(Math.min(t,1),0),s&&(t=1-t);var o=this.minTranslate()+(this.maxTranslate()-this.minTranslate())*t;this.updateProgress(o),this.setTranslate(o),this.updateActiveIndex(),this.updateSlidesClasses()},onDragStart:function(e){var t=this.params.scrollbar,i=this.scrollbar,s=this.$wrapperEl,a=i.$el,r=i.$dragEl;this.scrollbar.isTouched=!0,e.preventDefault(),e.stopPropagation(),s.transition(100),r.transition(100),i.setDragPosition(e),clearTimeout(this.scrollbar.dragTimeout),a.transition(0),t.hide&&a.css("opacity",1),this.emit("scrollbarDragStart",e)},onDragMove:function(e){var t=this.scrollbar,i=this.$wrapperEl,s=t.$el,a=t.$dragEl;this.scrollbar.isTouched&&(e.preventDefault?e.preventDefault():e.returnValue=!1,t.setDragPosition(e),i.transition(0),s.transition(0),a.transition(0),this.emit("scrollbarDragMove",e))},onDragEnd:function(e){var t=this.params.scrollbar,i=this.scrollbar.$el;this.scrollbar.isTouched&&(this.scrollbar.isTouched=!1,t.hide&&(clearTimeout(this.scrollbar.dragTimeout),this.scrollbar.dragTimeout=d.nextTick(function(){i.css("opacity",0),i.transition(400)},1e3)),this.emit("scrollbarDragEnd",e),t.snapOnRelease&&this.slideToClosest())},enableDraggable:function(){if(this.params.scrollbar.el){var t=this.scrollbar,i=this.touchEvents,s=this.touchEventsDesktop,a=this.params,r=t.$el[0],n=!(!h.passiveListener||!a.passiveListener)&&{passive:!1,capture:!1},o=!(!h.passiveListener||!a.passiveListener)&&{passive:!0,capture:!1};h.touch||!h.pointerEvents&&!h.prefixedPointerEvents?(h.touch&&(r.addEventListener(i.start,this.scrollbar.onDragStart,n),r.addEventListener(i.move,this.scrollbar.onDragMove,n),r.addEventListener(i.end,this.scrollbar.onDragEnd,o)),(a.simulateTouch&&!y.ios&&!y.android||a.simulateTouch&&!h.touch&&y.ios)&&(r.addEventListener("mousedown",this.scrollbar.onDragStart,n),e.addEventListener("mousemove",this.scrollbar.onDragMove,n),e.addEventListener("mouseup",this.scrollbar.onDragEnd,o))):(r.addEventListener(s.start,this.scrollbar.onDragStart,n),e.addEventListener(s.move,this.scrollbar.onDragMove,n),e.addEventListener(s.end,this.scrollbar.onDragEnd,o))}},disableDraggable:function(){if(this.params.scrollbar.el){var t=this.scrollbar,i=this.touchEvents,s=this.touchEventsDesktop,a=this.params,r=t.$el[0],n=!(!h.passiveListener||!a.passiveListener)&&{passive:!1,capture:!1},o=!(!h.passiveListener||!a.passiveListener)&&{passive:!0,capture:!1};h.touch||!h.pointerEvents&&!h.prefixedPointerEvents?(h.touch&&(r.removeEventListener(i.start,this.scrollbar.onDragStart,n),r.removeEventListener(i.move,this.scrollbar.onDragMove,n),r.removeEventListener(i.end,this.scrollbar.onDragEnd,o)),(a.simulateTouch&&!y.ios&&!y.android||a.simulateTouch&&!h.touch&&y.ios)&&(r.removeEventListener("mousedown",this.scrollbar.onDragStart,n),e.removeEventListener("mousemove",this.scrollbar.onDragMove,n),e.removeEventListener("mouseup",this.scrollbar.onDragEnd,o))):(r.removeEventListener(s.start,this.scrollbar.onDragStart,n),e.removeEventListener(s.move,this.scrollbar.onDragMove,n),e.removeEventListener(s.end,this.scrollbar.onDragEnd,o))}},init:function(){if(this.params.scrollbar.el){var e=this.scrollbar,t=this.$el,i=this.params.scrollbar,a=s(i.el);this.params.uniqueNavElements&&"string"==typeof i.el&&a.length>1&&1===t.find(i.el).length&&(a=t.find(i.el));var r=a.find("."+this.params.scrollbar.dragClass);0===r.length&&(r=s('<div class="'+this.params.scrollbar.dragClass+'"></div>'),a.append(r)),d.extend(e,{$el:a,el:a[0],$dragEl:r,dragEl:r[0]}),i.draggable&&e.enableDraggable()}},destroy:function(){this.scrollbar.disableDraggable()}},R={setTransform:function(e,t){var i=this.rtl,a=s(e),r=i?-1:1,n=a.attr("data-swiper-parallax")||"0",o=a.attr("data-swiper-parallax-x"),l=a.attr("data-swiper-parallax-y"),d=a.attr("data-swiper-parallax-scale"),h=a.attr("data-swiper-parallax-opacity");if(o||l?(o=o||"0",l=l||"0"):this.isHorizontal()?(o=n,l="0"):(l=n,o="0"),o=o.indexOf("%")>=0?parseInt(o,10)*t*r+"%":o*t*r+"px",l=l.indexOf("%")>=0?parseInt(l,10)*t+"%":l*t+"px",void 0!==h&&null!==h){var p=h-(h-1)*(1-Math.abs(t));a[0].style.opacity=p}if(void 0===d||null===d)a.transform("translate3d("+o+", "+l+", 0px)");else{var c=d-(d-1)*(1-Math.abs(t));a.transform("translate3d("+o+", "+l+", 0px) scale("+c+")")}},setTranslate:function(){var e=this,t=e.$el,i=e.slides,a=e.progress,r=e.snapGrid;t.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){e.parallax.setTransform(i,a)}),i.each(function(t,i){var n=i.progress;e.params.slidesPerGroup>1&&"auto"!==e.params.slidesPerView&&(n+=Math.ceil(t/2)-a*(r.length-1)),n=Math.min(Math.max(n,-1),1),s(i).find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){e.parallax.setTransform(i,n)})})},setTransition:function(e){void 0===e&&(e=this.params.speed);this.$el.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(t,i){var a=s(i),r=parseInt(a.attr("data-swiper-parallax-duration"),10)||e;0===e&&(r=0),a.transition(r)})}},F={getDistanceBetweenTouches:function(e){if(e.targetTouches.length<2)return 1;var t=e.targetTouches[0].pageX,i=e.targetTouches[0].pageY,s=e.targetTouches[1].pageX,a=e.targetTouches[1].pageY;return Math.sqrt(Math.pow(s-t,2)+Math.pow(a-i,2))},onGestureStart:function(e){var t=this.params.zoom,i=this.zoom,a=i.gesture;if(i.fakeGestureTouched=!1,i.fakeGestureMoved=!1,!h.gestures){if("touchstart"!==e.type||"touchstart"===e.type&&e.targetTouches.length<2)return;i.fakeGestureTouched=!0,a.scaleStart=F.getDistanceBetweenTouches(e)}a.$slideEl&&a.$slideEl.length||(a.$slideEl=s(e.target).closest(".swiper-slide"),0===a.$slideEl.length&&(a.$slideEl=this.slides.eq(this.activeIndex)),a.$imageEl=a.$slideEl.find("img, svg, canvas"),a.$imageWrapEl=a.$imageEl.parent("."+t.containerClass),a.maxRatio=a.$imageWrapEl.attr("data-swiper-zoom")||t.maxRatio,0!==a.$imageWrapEl.length)?(a.$imageEl.transition(0),this.zoom.isScaling=!0):a.$imageEl=void 0},onGestureChange:function(e){var t=this.params.zoom,i=this.zoom,s=i.gesture;if(!h.gestures){if("touchmove"!==e.type||"touchmove"===e.type&&e.targetTouches.length<2)return;i.fakeGestureMoved=!0,s.scaleMove=F.getDistanceBetweenTouches(e)}s.$imageEl&&0!==s.$imageEl.length&&(h.gestures?this.zoom.scale=e.scale*i.currentScale:i.scale=s.scaleMove/s.scaleStart*i.currentScale,i.scale>s.maxRatio&&(i.scale=s.maxRatio-1+Math.pow(i.scale-s.maxRatio+1,.5)),i.scale<t.minRatio&&(i.scale=t.minRatio+1-Math.pow(t.minRatio-i.scale+1,.5)),s.$imageEl.transform("translate3d(0,0,0) scale("+i.scale+")"))},onGestureEnd:function(e){var t=this.params.zoom,i=this.zoom,s=i.gesture;if(!h.gestures){if(!i.fakeGestureTouched||!i.fakeGestureMoved)return;if("touchend"!==e.type||"touchend"===e.type&&e.changedTouches.length<2&&!y.android)return;i.fakeGestureTouched=!1,i.fakeGestureMoved=!1}s.$imageEl&&0!==s.$imageEl.length&&(i.scale=Math.max(Math.min(i.scale,s.maxRatio),t.minRatio),s.$imageEl.transition(this.params.speed).transform("translate3d(0,0,0) scale("+i.scale+")"),i.currentScale=i.scale,i.isScaling=!1,1===i.scale&&(s.$slideEl=void 0))},onTouchStart:function(e){var t=this.zoom,i=t.gesture,s=t.image;i.$imageEl&&0!==i.$imageEl.length&&(s.isTouched||(y.android&&e.preventDefault(),s.isTouched=!0,s.touchesStart.x="touchstart"===e.type?e.targetTouches[0].pageX:e.pageX,s.touchesStart.y="touchstart"===e.type?e.targetTouches[0].pageY:e.pageY))},onTouchMove:function(e){var t=this.zoom,i=t.gesture,s=t.image,a=t.velocity;if(i.$imageEl&&0!==i.$imageEl.length&&(this.allowClick=!1,s.isTouched&&i.$slideEl)){s.isMoved||(s.width=i.$imageEl[0].offsetWidth,s.height=i.$imageEl[0].offsetHeight,s.startX=d.getTranslate(i.$imageWrapEl[0],"x")||0,s.startY=d.getTranslate(i.$imageWrapEl[0],"y")||0,i.slideWidth=i.$slideEl[0].offsetWidth,i.slideHeight=i.$slideEl[0].offsetHeight,i.$imageWrapEl.transition(0),this.rtl&&(s.startX=-s.startX,s.startY=-s.startY));var r=s.width*t.scale,n=s.height*t.scale;if(!(r<i.slideWidth&&n<i.slideHeight)){if(s.minX=Math.min(i.slideWidth/2-r/2,0),s.maxX=-s.minX,s.minY=Math.min(i.slideHeight/2-n/2,0),s.maxY=-s.minY,s.touchesCurrent.x="touchmove"===e.type?e.targetTouches[0].pageX:e.pageX,s.touchesCurrent.y="touchmove"===e.type?e.targetTouches[0].pageY:e.pageY,!s.isMoved&&!t.isScaling){if(this.isHorizontal()&&(Math.floor(s.minX)===Math.floor(s.startX)&&s.touchesCurrent.x<s.touchesStart.x||Math.floor(s.maxX)===Math.floor(s.startX)&&s.touchesCurrent.x>s.touchesStart.x))return void(s.isTouched=!1);if(!this.isHorizontal()&&(Math.floor(s.minY)===Math.floor(s.startY)&&s.touchesCurrent.y<s.touchesStart.y||Math.floor(s.maxY)===Math.floor(s.startY)&&s.touchesCurrent.y>s.touchesStart.y))return void(s.isTouched=!1)}e.preventDefault(),e.stopPropagation(),s.isMoved=!0,s.currentX=s.touchesCurrent.x-s.touchesStart.x+s.startX,s.currentY=s.touchesCurrent.y-s.touchesStart.y+s.startY,s.currentX<s.minX&&(s.currentX=s.minX+1-Math.pow(s.minX-s.currentX+1,.8)),s.currentX>s.maxX&&(s.currentX=s.maxX-1+Math.pow(s.currentX-s.maxX+1,.8)),s.currentY<s.minY&&(s.currentY=s.minY+1-Math.pow(s.minY-s.currentY+1,.8)),s.currentY>s.maxY&&(s.currentY=s.maxY-1+Math.pow(s.currentY-s.maxY+1,.8)),a.prevPositionX||(a.prevPositionX=s.touchesCurrent.x),a.prevPositionY||(a.prevPositionY=s.touchesCurrent.y),a.prevTime||(a.prevTime=Date.now()),a.x=(s.touchesCurrent.x-a.prevPositionX)/(Date.now()-a.prevTime)/2,a.y=(s.touchesCurrent.y-a.prevPositionY)/(Date.now()-a.prevTime)/2,Math.abs(s.touchesCurrent.x-a.prevPositionX)<2&&(a.x=0),Math.abs(s.touchesCurrent.y-a.prevPositionY)<2&&(a.y=0),a.prevPositionX=s.touchesCurrent.x,a.prevPositionY=s.touchesCurrent.y,a.prevTime=Date.now(),i.$imageWrapEl.transform("translate3d("+s.currentX+"px, "+s.currentY+"px,0)")}}},onTouchEnd:function(){var e=this.zoom,t=e.gesture,i=e.image,s=e.velocity;if(t.$imageEl&&0!==t.$imageEl.length){if(!i.isTouched||!i.isMoved)return i.isTouched=!1,void(i.isMoved=!1);i.isTouched=!1,i.isMoved=!1;var a=300,r=300,n=s.x*a,o=i.currentX+n,l=s.y*r,d=i.currentY+l;0!==s.x&&(a=Math.abs((o-i.currentX)/s.x)),0!==s.y&&(r=Math.abs((d-i.currentY)/s.y));var h=Math.max(a,r);i.currentX=o,i.currentY=d;var p=i.width*e.scale,c=i.height*e.scale;i.minX=Math.min(t.slideWidth/2-p/2,0),i.maxX=-i.minX,i.minY=Math.min(t.slideHeight/2-c/2,0),i.maxY=-i.minY,i.currentX=Math.max(Math.min(i.currentX,i.maxX),i.minX),i.currentY=Math.max(Math.min(i.currentY,i.maxY),i.minY),t.$imageWrapEl.transition(h).transform("translate3d("+i.currentX+"px, "+i.currentY+"px,0)")}},onTransitionEnd:function(){var e=this.zoom,t=e.gesture;t.$slideEl&&this.previousIndex!==this.activeIndex&&(t.$imageEl.transform("translate3d(0,0,0) scale(1)"),t.$imageWrapEl.transform("translate3d(0,0,0)"),t.$slideEl=void 0,t.$imageEl=void 0,t.$imageWrapEl=void 0,e.scale=1,e.currentScale=1)},toggle:function(e){var t=this.zoom;t.scale&&1!==t.scale?t.out():t.in(e)},in:function(e){var t,i,a,r,n,o,l,d,h,p,c,u,v,f,m,g,b=this.zoom,w=this.params.zoom,y=b.gesture,x=b.image;(y.$slideEl||(y.$slideEl=this.clickedSlide?s(this.clickedSlide):this.slides.eq(this.activeIndex),y.$imageEl=y.$slideEl.find("img, svg, canvas"),y.$imageWrapEl=y.$imageEl.parent("."+w.containerClass)),y.$imageEl&&0!==y.$imageEl.length)&&(y.$slideEl.addClass(""+w.zoomedSlideClass),void 0===x.touchesStart.x&&e?(t="touchend"===e.type?e.changedTouches[0].pageX:e.pageX,i="touchend"===e.type?e.changedTouches[0].pageY:e.pageY):(t=x.touchesStart.x,i=x.touchesStart.y),b.scale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,b.currentScale=y.$imageWrapEl.attr("data-swiper-zoom")||w.maxRatio,e?(m=y.$slideEl[0].offsetWidth,g=y.$slideEl[0].offsetHeight,a=y.$slideEl.offset().left+m/2-t,r=y.$slideEl.offset().top+g/2-i,l=y.$imageEl[0].offsetWidth,d=y.$imageEl[0].offsetHeight,h=l*b.scale,p=d*b.scale,v=-(c=Math.min(m/2-h/2,0)),f=-(u=Math.min(g/2-p/2,0)),n=a*b.scale,o=r*b.scale,n<c&&(n=c),n>v&&(n=v),o<u&&(o=u),o>f&&(o=f)):(n=0,o=0),y.$imageWrapEl.transition(300).transform("translate3d("+n+"px, "+o+"px,0)"),y.$imageEl.transition(300).transform("translate3d(0,0,0) scale("+b.scale+")"))},out:function(){var e=this.zoom,t=this.params.zoom,i=e.gesture;i.$slideEl||(i.$slideEl=this.clickedSlide?s(this.clickedSlide):this.slides.eq(this.activeIndex),i.$imageEl=i.$slideEl.find("img, svg, canvas"),i.$imageWrapEl=i.$imageEl.parent("."+t.containerClass)),i.$imageEl&&0!==i.$imageEl.length&&(e.scale=1,e.currentScale=1,i.$imageWrapEl.transition(300).transform("translate3d(0,0,0)"),i.$imageEl.transition(300).transform("translate3d(0,0,0) scale(1)"),i.$slideEl.removeClass(""+t.zoomedSlideClass),i.$slideEl=void 0)},enable:function(){var e=this.zoom;if(!e.enabled){e.enabled=!0;var t=!("touchstart"!==this.touchEvents.start||!h.passiveListener||!this.params.passiveListeners)&&{passive:!0,capture:!1};h.gestures?(this.$wrapperEl.on("gesturestart",".swiper-slide",e.onGestureStart,t),this.$wrapperEl.on("gesturechange",".swiper-slide",e.onGestureChange,t),this.$wrapperEl.on("gestureend",".swiper-slide",e.onGestureEnd,t)):"touchstart"===this.touchEvents.start&&(this.$wrapperEl.on(this.touchEvents.start,".swiper-slide",e.onGestureStart,t),this.$wrapperEl.on(this.touchEvents.move,".swiper-slide",e.onGestureChange,t),this.$wrapperEl.on(this.touchEvents.end,".swiper-slide",e.onGestureEnd,t)),this.$wrapperEl.on(this.touchEvents.move,"."+this.params.zoom.containerClass,e.onTouchMove)}},disable:function(){var e=this.zoom;if(e.enabled){this.zoom.enabled=!1;var t=!("touchstart"!==this.touchEvents.start||!h.passiveListener||!this.params.passiveListeners)&&{passive:!0,capture:!1};h.gestures?(this.$wrapperEl.off("gesturestart",".swiper-slide",e.onGestureStart,t),this.$wrapperEl.off("gesturechange",".swiper-slide",e.onGestureChange,t),this.$wrapperEl.off("gestureend",".swiper-slide",e.onGestureEnd,t)):"touchstart"===this.touchEvents.start&&(this.$wrapperEl.off(this.touchEvents.start,".swiper-slide",e.onGestureStart,t),this.$wrapperEl.off(this.touchEvents.move,".swiper-slide",e.onGestureChange,t),this.$wrapperEl.off(this.touchEvents.end,".swiper-slide",e.onGestureEnd,t)),this.$wrapperEl.off(this.touchEvents.move,"."+this.params.zoom.containerClass,e.onTouchMove)}}},W={loadInSlide:function(e,t){void 0===t&&(t=!0);var i=this,a=i.params.lazy;if(void 0!==e&&0!==i.slides.length){var r=i.virtual&&i.params.virtual.enabled?i.$wrapperEl.children("."+i.params.slideClass+'[data-swiper-slide-index="'+e+'"]'):i.slides.eq(e),n=r.find("."+a.elementClass+":not(."+a.loadedClass+"):not(."+a.loadingClass+")");!r.hasClass(a.elementClass)||r.hasClass(a.loadedClass)||r.hasClass(a.loadingClass)||(n=n.add(r[0])),0!==n.length&&n.each(function(e,n){var o=s(n);o.addClass(a.loadingClass);var l=o.attr("data-background"),d=o.attr("data-src"),h=o.attr("data-srcset"),p=o.attr("data-sizes");i.loadImage(o[0],d||l,h,p,!1,function(){if(void 0!==i&&null!==i&&i&&(!i||i.params)&&!i.destroyed){if(l?(o.css("background-image",'url("'+l+'")'),o.removeAttr("data-background")):(h&&(o.attr("srcset",h),o.removeAttr("data-srcset")),p&&(o.attr("sizes",p),o.removeAttr("data-sizes")),d&&(o.attr("src",d),o.removeAttr("data-src"))),o.addClass(a.loadedClass).removeClass(a.loadingClass),r.find("."+a.preloaderClass).remove(),i.params.loop&&t){var e=r.attr("data-swiper-slide-index");if(r.hasClass(i.params.slideDuplicateClass)){var s=i.$wrapperEl.children('[data-swiper-slide-index="'+e+'"]:not(.'+i.params.slideDuplicateClass+")");i.lazy.loadInSlide(s.index(),!1)}else{var n=i.$wrapperEl.children("."+i.params.slideDuplicateClass+'[data-swiper-slide-index="'+e+'"]');i.lazy.loadInSlide(n.index(),!1)}}i.emit("lazyImageReady",r[0],o[0])}}),i.emit("lazyImageLoad",r[0],o[0])})}},load:function(){var e=this,t=e.$wrapperEl,i=e.params,a=e.slides,r=e.activeIndex,n=e.virtual&&i.virtual.enabled,o=i.lazy,l=i.slidesPerView;function d(e){if(n){if(t.children("."+i.slideClass+'[data-swiper-slide-index="'+e+'"]').length)return!0}else if(a[e])return!0;return!1}function h(e){return n?s(e).attr("data-swiper-slide-index"):s(e).index()}if("auto"===l&&(l=0),e.lazy.initialImageLoaded||(e.lazy.initialImageLoaded=!0),e.params.watchSlidesVisibility)t.children("."+i.slideVisibleClass).each(function(t,i){var a=n?s(i).attr("data-swiper-slide-index"):s(i).index();e.lazy.loadInSlide(a)});else if(l>1)for(var p=r;p<r+l;p+=1)d(p)&&e.lazy.loadInSlide(p);else e.lazy.loadInSlide(r);if(o.loadPrevNext)if(l>1||o.loadPrevNextAmount&&o.loadPrevNextAmount>1){for(var c=o.loadPrevNextAmount,u=l,v=Math.min(r+u+Math.max(c,u),a.length),f=Math.max(r-Math.max(u,c),0),m=r+l;m<v;m+=1)d(m)&&e.lazy.loadInSlide(m);for(var g=f;g<r;g+=1)d(g)&&e.lazy.loadInSlide(g)}else{var b=t.children("."+i.slideNextClass);b.length>0&&e.lazy.loadInSlide(h(b));var w=t.children("."+i.slidePrevClass);w.length>0&&e.lazy.loadInSlide(h(w))}}},q={LinearSpline:function(e,t){var i,s,a,r,n,o=function(e,t){for(s=-1,i=e.length;i-s>1;)e[a=i+s>>1]<=t?s=a:i=a;return i};return this.x=e,this.y=t,this.lastIndex=e.length-1,this.interpolate=function(e){return e?(n=o(this.x,e),r=n-1,(e-this.x[r])*(this.y[n]-this.y[r])/(this.x[n]-this.x[r])+this.y[r]):0},this},getInterpolateFunction:function(e){this.controller.spline||(this.controller.spline=this.params.loop?new q.LinearSpline(this.slidesGrid,e.slidesGrid):new q.LinearSpline(this.snapGrid,e.snapGrid))},setTranslate:function(e,t){var i,s,a=this,r=a.controller.control;function n(e){var t=a.rtlTranslate?-a.translate:a.translate;"slide"===a.params.controller.by&&(a.controller.getInterpolateFunction(e),s=-a.controller.spline.interpolate(-t)),s&&"container"!==a.params.controller.by||(i=(e.maxTranslate()-e.minTranslate())/(a.maxTranslate()-a.minTranslate()),s=(t-a.minTranslate())*i+e.minTranslate()),a.params.controller.inverse&&(s=e.maxTranslate()-s),e.updateProgress(s),e.setTranslate(s,a),e.updateActiveIndex(),e.updateSlidesClasses()}if(Array.isArray(r))for(var o=0;o<r.length;o+=1)r[o]!==t&&r[o]instanceof k&&n(r[o]);else r instanceof k&&t!==r&&n(r)},setTransition:function(e,t){var i,s=this,a=s.controller.control;function r(t){t.setTransition(e,s),0!==e&&(t.transitionStart(),t.$wrapperEl.transitionEnd(function(){a&&(t.params.loop&&"slide"===s.params.controller.by&&t.loopFix(),t.transitionEnd())}))}if(Array.isArray(a))for(i=0;i<a.length;i+=1)a[i]!==t&&a[i]instanceof k&&r(a[i]);else a instanceof k&&t!==a&&r(a)}},j={makeElFocusable:function(e){return e.attr("tabIndex","0"),e},addElRole:function(e,t){return e.attr("role",t),e},addElLabel:function(e,t){return e.attr("aria-label",t),e},disableEl:function(e){return e.attr("aria-disabled",!0),e},enableEl:function(e){return e.attr("aria-disabled",!1),e},onEnterKey:function(e){var t=this.params.a11y;if(13===e.keyCode){var i=s(e.target);this.navigation&&this.navigation.$nextEl&&i.is(this.navigation.$nextEl)&&(this.isEnd&&!this.params.loop||this.slideNext(),this.isEnd?this.a11y.notify(t.lastSlideMessage):this.a11y.notify(t.nextSlideMessage)),this.navigation&&this.navigation.$prevEl&&i.is(this.navigation.$prevEl)&&(this.isBeginning&&!this.params.loop||this.slidePrev(),this.isBeginning?this.a11y.notify(t.firstSlideMessage):this.a11y.notify(t.prevSlideMessage)),this.pagination&&i.is("."+this.params.pagination.bulletClass)&&i[0].click()}},notify:function(e){var t=this.a11y.liveRegion;0!==t.length&&(t.html(""),t.html(e))},updateNavigation:function(){if(!this.params.loop){var e=this.navigation,t=e.$nextEl,i=e.$prevEl;i&&i.length>0&&(this.isBeginning?this.a11y.disableEl(i):this.a11y.enableEl(i)),t&&t.length>0&&(this.isEnd?this.a11y.disableEl(t):this.a11y.enableEl(t))}},updatePagination:function(){var e=this,t=e.params.a11y;e.pagination&&e.params.pagination.clickable&&e.pagination.bullets&&e.pagination.bullets.length&&e.pagination.bullets.each(function(i,a){var r=s(a);e.a11y.makeElFocusable(r),e.a11y.addElRole(r,"button"),e.a11y.addElLabel(r,t.paginationBulletMessage.replace(/{{index}}/,r.index()+1))})},init:function(){this.$el.append(this.a11y.liveRegion);var e,t,i=this.params.a11y;this.navigation&&this.navigation.$nextEl&&(e=this.navigation.$nextEl),this.navigation&&this.navigation.$prevEl&&(t=this.navigation.$prevEl),e&&(this.a11y.makeElFocusable(e),this.a11y.addElRole(e,"button"),this.a11y.addElLabel(e,i.nextSlideMessage),e.on("keydown",this.a11y.onEnterKey)),t&&(this.a11y.makeElFocusable(t),this.a11y.addElRole(t,"button"),this.a11y.addElLabel(t,i.prevSlideMessage),t.on("keydown",this.a11y.onEnterKey)),this.pagination&&this.params.pagination.clickable&&this.pagination.bullets&&this.pagination.bullets.length&&this.pagination.$el.on("keydown","."+this.params.pagination.bulletClass,this.a11y.onEnterKey)},destroy:function(){var e,t;this.a11y.liveRegion&&this.a11y.liveRegion.length>0&&this.a11y.liveRegion.remove(),this.navigation&&this.navigation.$nextEl&&(e=this.navigation.$nextEl),this.navigation&&this.navigation.$prevEl&&(t=this.navigation.$prevEl),e&&e.off("keydown",this.a11y.onEnterKey),t&&t.off("keydown",this.a11y.onEnterKey),this.pagination&&this.params.pagination.clickable&&this.pagination.bullets&&this.pagination.bullets.length&&this.pagination.$el.off("keydown","."+this.params.pagination.bulletClass,this.a11y.onEnterKey)}},K={init:function(){if(this.params.history){if(!t.history||!t.history.pushState)return this.params.history.enabled=!1,void(this.params.hashNavigation.enabled=!0);var e=this.history;e.initialized=!0,e.paths=K.getPathValues(),(e.paths.key||e.paths.value)&&(e.scrollToSlide(0,e.paths.value,this.params.runCallbacksOnInit),this.params.history.replaceState||t.addEventListener("popstate",this.history.setHistoryPopState))}},destroy:function(){this.params.history.replaceState||t.removeEventListener("popstate",this.history.setHistoryPopState)},setHistoryPopState:function(){this.history.paths=K.getPathValues(),this.history.scrollToSlide(this.params.speed,this.history.paths.value,!1)},getPathValues:function(){var e=t.location.pathname.slice(1).split("/").filter(function(e){return""!==e}),i=e.length;return{key:e[i-2],value:e[i-1]}},setHistory:function(e,i){if(this.history.initialized&&this.params.history.enabled){var s=this.slides.eq(i),a=K.slugify(s.attr("data-history"));t.location.pathname.includes(e)||(a=e+"/"+a);var r=t.history.state;r&&r.value===a||(this.params.history.replaceState?t.history.replaceState({value:a},null,a):t.history.pushState({value:a},null,a))}},slugify:function(e){return e.toString().toLowerCase().replace(/\s+/g,"-").replace(/[^\w-]+/g,"").replace(/--+/g,"-").replace(/^-+/,"").replace(/-+$/,"")},scrollToSlide:function(e,t,i){if(t)for(var s=0,a=this.slides.length;s<a;s+=1){var r=this.slides.eq(s);if(K.slugify(r.attr("data-history"))===t&&!r.hasClass(this.params.slideDuplicateClass)){var n=r.index();this.slideTo(n,e,i)}}else this.slideTo(0,e,i)}},U={onHashCange:function(){var t=e.location.hash.replace("#","");t!==this.slides.eq(this.activeIndex).attr("data-hash")&&this.slideTo(this.$wrapperEl.children("."+this.params.slideClass+'[data-hash="'+t+'"]').index())},setHash:function(){if(this.hashNavigation.initialized&&this.params.hashNavigation.enabled)if(this.params.hashNavigation.replaceState&&t.history&&t.history.replaceState)t.history.replaceState(null,null,"#"+this.slides.eq(this.activeIndex).attr("data-hash")||"");else{var i=this.slides.eq(this.activeIndex),s=i.attr("data-hash")||i.attr("data-history");e.location.hash=s||""}},init:function(){if(!(!this.params.hashNavigation.enabled||this.params.history&&this.params.history.enabled)){this.hashNavigation.initialized=!0;var i=e.location.hash.replace("#","");if(i)for(var a=0,r=this.slides.length;a<r;a+=1){var n=this.slides.eq(a);if((n.attr("data-hash")||n.attr("data-history"))===i&&!n.hasClass(this.params.slideDuplicateClass)){var o=n.index();this.slideTo(o,0,this.params.runCallbacksOnInit,!0)}}this.params.hashNavigation.watchState&&s(t).on("hashchange",this.hashNavigation.onHashCange)}},destroy:function(){this.params.hashNavigation.watchState&&s(t).off("hashchange",this.hashNavigation.onHashCange)}},_={run:function(){var e=this,t=e.slides.eq(e.activeIndex),i=e.params.autoplay.delay;t.attr("data-swiper-autoplay")&&(i=t.attr("data-swiper-autoplay")||e.params.autoplay.delay),e.autoplay.timeout=d.nextTick(function(){e.params.autoplay.reverseDirection?e.params.loop?(e.loopFix(),e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.isBeginning?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(e.slides.length-1,e.params.speed,!0,!0),e.emit("autoplay")):(e.slidePrev(e.params.speed,!0,!0),e.emit("autoplay")):e.params.loop?(e.loopFix(),e.slideNext(e.params.speed,!0,!0),e.emit("autoplay")):e.isEnd?e.params.autoplay.stopOnLastSlide?e.autoplay.stop():(e.slideTo(0,e.params.speed,!0,!0),e.emit("autoplay")):(e.slideNext(e.params.speed,!0,!0),e.emit("autoplay"))},i)},start:function(){return void 0===this.autoplay.timeout&&(!this.autoplay.running&&(this.autoplay.running=!0,this.emit("autoplayStart"),this.autoplay.run(),!0))},stop:function(){return!!this.autoplay.running&&(void 0!==this.autoplay.timeout&&(this.autoplay.timeout&&(clearTimeout(this.autoplay.timeout),this.autoplay.timeout=void 0),this.autoplay.running=!1,this.emit("autoplayStop"),!0))},pause:function(e){this.autoplay.running&&(this.autoplay.paused||(this.autoplay.timeout&&clearTimeout(this.autoplay.timeout),this.autoplay.paused=!0,0!==e&&this.params.autoplay.waitForTransition?(this.$wrapperEl[0].addEventListener("transitionend",this.autoplay.onTransitionEnd),this.$wrapperEl[0].addEventListener("webkitTransitionEnd",this.autoplay.onTransitionEnd)):(this.autoplay.paused=!1,this.autoplay.run())))}},Z={setTranslate:function(){for(var e=this.slides,t=0;t<e.length;t+=1){var i=this.slides.eq(t),s=-i[0].swiperSlideOffset;this.params.virtualTranslate||(s-=this.translate);var a=0;this.isHorizontal()||(a=s,s=0);var r=this.params.fadeEffect.crossFade?Math.max(1-Math.abs(i[0].progress),0):1+Math.min(Math.max(i[0].progress,-1),0);i.css({opacity:r}).transform("translate3d("+s+"px, "+a+"px, 0px)")}},setTransition:function(e){var t=this,i=t.slides,s=t.$wrapperEl;if(i.transition(e),t.params.virtualTranslate&&0!==e){var a=!1;i.transitionEnd(function(){if(!a&&t&&!t.destroyed){a=!0,t.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],i=0;i<e.length;i+=1)s.trigger(e[i])}})}}},Q={setTranslate:function(){var e,t=this.$el,i=this.$wrapperEl,a=this.slides,r=this.width,n=this.height,o=this.rtlTranslate,l=this.size,d=this.params.cubeEffect,h=this.isHorizontal(),p=this.virtual&&this.params.virtual.enabled,c=0;d.shadow&&(h?(0===(e=i.find(".swiper-cube-shadow")).length&&(e=s('<div class="swiper-cube-shadow"></div>'),i.append(e)),e.css({height:r+"px"})):0===(e=t.find(".swiper-cube-shadow")).length&&(e=s('<div class="swiper-cube-shadow"></div>'),t.append(e)));for(var u=0;u<a.length;u+=1){var v=a.eq(u),f=u;p&&(f=parseInt(v.attr("data-swiper-slide-index"),10));var m=90*f,g=Math.floor(m/360);o&&(m=-m,g=Math.floor(-m/360));var b=Math.max(Math.min(v[0].progress,1),-1),w=0,y=0,x=0;f%4==0?(w=4*-g*l,x=0):(f-1)%4==0?(w=0,x=4*-g*l):(f-2)%4==0?(w=l+4*g*l,x=l):(f-3)%4==0&&(w=-l,x=3*l+4*l*g),o&&(w=-w),h||(y=w,w=0);var E="rotateX("+(h?0:-m)+"deg) rotateY("+(h?m:0)+"deg) translate3d("+w+"px, "+y+"px, "+x+"px)";if(b<=1&&b>-1&&(c=90*f+90*b,o&&(c=90*-f-90*b)),v.transform(E),d.slideShadows){var T=h?v.find(".swiper-slide-shadow-left"):v.find(".swiper-slide-shadow-top"),C=h?v.find(".swiper-slide-shadow-right"):v.find(".swiper-slide-shadow-bottom");0===T.length&&(T=s('<div class="swiper-slide-shadow-'+(h?"left":"top")+'"></div>'),v.append(T)),0===C.length&&(C=s('<div class="swiper-slide-shadow-'+(h?"right":"bottom")+'"></div>'),v.append(C)),T.length&&(T[0].style.opacity=Math.max(-b,0)),C.length&&(C[0].style.opacity=Math.max(b,0))}}if(i.css({"-webkit-transform-origin":"50% 50% -"+l/2+"px","-moz-transform-origin":"50% 50% -"+l/2+"px","-ms-transform-origin":"50% 50% -"+l/2+"px","transform-origin":"50% 50% -"+l/2+"px"}),d.shadow)if(h)e.transform("translate3d(0px, "+(r/2+d.shadowOffset)+"px, "+-r/2+"px) rotateX(90deg) rotateZ(0deg) scale("+d.shadowScale+")");else{var M=Math.abs(c)-90*Math.floor(Math.abs(c)/90),z=1.5-(Math.sin(2*M*Math.PI/360)/2+Math.cos(2*M*Math.PI/360)/2),k=d.shadowScale,P=d.shadowScale/z,$=d.shadowOffset;e.transform("scale3d("+k+", 1, "+P+") translate3d(0px, "+(n/2+$)+"px, "+-n/2/P+"px) rotateX(-90deg)")}var L=S.isSafari||S.isUiWebView?-l/2:0;i.transform("translate3d(0px,0,"+L+"px) rotateX("+(this.isHorizontal()?0:c)+"deg) rotateY("+(this.isHorizontal()?-c:0)+"deg)")},setTransition:function(e){var t=this.$el;this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),this.params.cubeEffect.shadow&&!this.isHorizontal()&&t.find(".swiper-cube-shadow").transition(e)}},J={setTranslate:function(){for(var e=this.slides,t=this.rtlTranslate,i=0;i<e.length;i+=1){var a=e.eq(i),r=a[0].progress;this.params.flipEffect.limitRotation&&(r=Math.max(Math.min(a[0].progress,1),-1));var n=-180*r,o=0,l=-a[0].swiperSlideOffset,d=0;if(this.isHorizontal()?t&&(n=-n):(d=l,l=0,o=-n,n=0),a[0].style.zIndex=-Math.abs(Math.round(r))+e.length,this.params.flipEffect.slideShadows){var h=this.isHorizontal()?a.find(".swiper-slide-shadow-left"):a.find(".swiper-slide-shadow-top"),p=this.isHorizontal()?a.find(".swiper-slide-shadow-right"):a.find(".swiper-slide-shadow-bottom");0===h.length&&(h=s('<div class="swiper-slide-shadow-'+(this.isHorizontal()?"left":"top")+'"></div>'),a.append(h)),0===p.length&&(p=s('<div class="swiper-slide-shadow-'+(this.isHorizontal()?"right":"bottom")+'"></div>'),a.append(p)),h.length&&(h[0].style.opacity=Math.max(-r,0)),p.length&&(p[0].style.opacity=Math.max(r,0))}a.transform("translate3d("+l+"px, "+d+"px, 0px) rotateX("+o+"deg) rotateY("+n+"deg)")}},setTransition:function(e){var t=this,i=t.slides,s=t.activeIndex,a=t.$wrapperEl;if(i.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e),t.params.virtualTranslate&&0!==e){var r=!1;i.eq(s).transitionEnd(function(){if(!r&&t&&!t.destroyed){r=!0,t.animating=!1;for(var e=["webkitTransitionEnd","transitionend"],i=0;i<e.length;i+=1)a.trigger(e[i])}})}}},ee={setTranslate:function(){for(var e=this.width,t=this.height,i=this.slides,a=this.$wrapperEl,r=this.slidesSizesGrid,n=this.params.coverflowEffect,o=this.isHorizontal(),l=this.translate,d=o?e/2-l:t/2-l,p=o?n.rotate:-n.rotate,c=n.depth,u=0,v=i.length;u<v;u+=1){var f=i.eq(u),m=r[u],g=(d-f[0].swiperSlideOffset-m/2)/m*n.modifier,b=o?p*g:0,w=o?0:p*g,y=-c*Math.abs(g),x=o?0:n.stretch*g,E=o?n.stretch*g:0;Math.abs(E)<.001&&(E=0),Math.abs(x)<.001&&(x=0),Math.abs(y)<.001&&(y=0),Math.abs(b)<.001&&(b=0),Math.abs(w)<.001&&(w=0);var T="translate3d("+E+"px,"+x+"px,"+y+"px)  rotateX("+w+"deg) rotateY("+b+"deg)";if(f.transform(T),f[0].style.zIndex=1-Math.abs(Math.round(g)),n.slideShadows){var S=o?f.find(".swiper-slide-shadow-left"):f.find(".swiper-slide-shadow-top"),C=o?f.find(".swiper-slide-shadow-right"):f.find(".swiper-slide-shadow-bottom");0===S.length&&(S=s('<div class="swiper-slide-shadow-'+(o?"left":"top")+'"></div>'),f.append(S)),0===C.length&&(C=s('<div class="swiper-slide-shadow-'+(o?"right":"bottom")+'"></div>'),f.append(C)),S.length&&(S[0].style.opacity=g>0?g:0),C.length&&(C[0].style.opacity=-g>0?-g:0)}}(h.pointerEvents||h.prefixedPointerEvents)&&(a[0].style.perspectiveOrigin=d+"px 50%")},setTransition:function(e){this.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)}},te=[P,$,L,I,O,G,N,{name:"mousewheel",params:{mousewheel:{enabled:!1,releaseOnEdges:!1,invert:!1,forceToAxis:!1,sensitivity:1,eventsTarged:"container"}},create:function(){d.extend(this,{mousewheel:{enabled:!1,enable:B.enable.bind(this),disable:B.disable.bind(this),handle:B.handle.bind(this),handleMouseEnter:B.handleMouseEnter.bind(this),handleMouseLeave:B.handleMouseLeave.bind(this),lastScrollTime:d.now()}})},on:{init:function(){this.params.mousewheel.enabled&&this.mousewheel.enable()},destroy:function(){this.mousewheel.enabled&&this.mousewheel.disable()}}},{name:"navigation",params:{navigation:{nextEl:null,prevEl:null,hideOnClick:!1,disabledClass:"swiper-button-disabled",hiddenClass:"swiper-button-hidden",lockClass:"swiper-button-lock"}},create:function(){d.extend(this,{navigation:{init:X.init.bind(this),update:X.update.bind(this),destroy:X.destroy.bind(this)}})},on:{init:function(){this.navigation.init(),this.navigation.update()},toEdge:function(){this.navigation.update()},fromEdge:function(){this.navigation.update()},destroy:function(){this.navigation.destroy()},click:function(e){var t=this.navigation,i=t.$nextEl,a=t.$prevEl;!this.params.navigation.hideOnClick||s(e.target).is(a)||s(e.target).is(i)||(i&&i.toggleClass(this.params.navigation.hiddenClass),a&&a.toggleClass(this.params.navigation.hiddenClass))}}},{name:"pagination",params:{pagination:{el:null,bulletElement:"span",clickable:!1,hideOnClick:!1,renderBullet:null,renderProgressbar:null,renderFraction:null,renderCustom:null,progressbarOpposite:!1,type:"bullets",dynamicBullets:!1,dynamicMainBullets:1,formatFractionCurrent:function(e){return e},formatFractionTotal:function(e){return e},bulletClass:"swiper-pagination-bullet",bulletActiveClass:"swiper-pagination-bullet-active",modifierClass:"swiper-pagination-",currentClass:"swiper-pagination-current",totalClass:"swiper-pagination-total",hiddenClass:"swiper-pagination-hidden",progressbarFillClass:"swiper-pagination-progressbar-fill",progressbarOppositeClass:"swiper-pagination-progressbar-opposite",clickableClass:"swiper-pagination-clickable",lockClass:"swiper-pagination-lock"}},create:function(){d.extend(this,{pagination:{init:Y.init.bind(this),render:Y.render.bind(this),update:Y.update.bind(this),destroy:Y.destroy.bind(this),dynamicBulletIndex:0}})},on:{init:function(){this.pagination.init(),this.pagination.render(),this.pagination.update()},activeIndexChange:function(){this.params.loop?this.pagination.update():void 0===this.snapIndex&&this.pagination.update()},snapIndexChange:function(){this.params.loop||this.pagination.update()},slidesLengthChange:function(){this.params.loop&&(this.pagination.render(),this.pagination.update())},snapGridLengthChange:function(){this.params.loop||(this.pagination.render(),this.pagination.update())},destroy:function(){this.pagination.destroy()},click:function(e){this.params.pagination.el&&this.params.pagination.hideOnClick&&this.pagination.$el.length>0&&!s(e.target).hasClass(this.params.pagination.bulletClass)&&this.pagination.$el.toggleClass(this.params.pagination.hiddenClass)}}},{name:"scrollbar",params:{scrollbar:{el:null,dragSize:"auto",hide:!1,draggable:!1,snapOnRelease:!0,lockClass:"swiper-scrollbar-lock",dragClass:"swiper-scrollbar-drag"}},create:function(){d.extend(this,{scrollbar:{init:V.init.bind(this),destroy:V.destroy.bind(this),updateSize:V.updateSize.bind(this),setTranslate:V.setTranslate.bind(this),setTransition:V.setTransition.bind(this),enableDraggable:V.enableDraggable.bind(this),disableDraggable:V.disableDraggable.bind(this),setDragPosition:V.setDragPosition.bind(this),onDragStart:V.onDragStart.bind(this),onDragMove:V.onDragMove.bind(this),onDragEnd:V.onDragEnd.bind(this),isTouched:!1,timeout:null,dragTimeout:null}})},on:{init:function(){this.scrollbar.init(),this.scrollbar.updateSize(),this.scrollbar.setTranslate()},update:function(){this.scrollbar.updateSize()},resize:function(){this.scrollbar.updateSize()},observerUpdate:function(){this.scrollbar.updateSize()},setTranslate:function(){this.scrollbar.setTranslate()},setTransition:function(e){this.scrollbar.setTransition(e)},destroy:function(){this.scrollbar.destroy()}}},{name:"parallax",params:{parallax:{enabled:!1}},create:function(){d.extend(this,{parallax:{setTransform:R.setTransform.bind(this),setTranslate:R.setTranslate.bind(this),setTransition:R.setTransition.bind(this)}})},on:{beforeInit:function(){this.params.parallax.enabled&&(this.params.watchSlidesProgress=!0)},init:function(){this.params.parallax&&this.parallax.setTranslate()},setTranslate:function(){this.params.parallax&&this.parallax.setTranslate()},setTransition:function(e){this.params.parallax&&this.parallax.setTransition(e)}}},{name:"zoom",params:{zoom:{enabled:!1,maxRatio:3,minRatio:1,toggle:!0,containerClass:"swiper-zoom-container",zoomedSlideClass:"swiper-slide-zoomed"}},create:function(){var e=this,t={enabled:!1,scale:1,currentScale:1,isScaling:!1,gesture:{$slideEl:void 0,slideWidth:void 0,slideHeight:void 0,$imageEl:void 0,$imageWrapEl:void 0,maxRatio:3},image:{isTouched:void 0,isMoved:void 0,currentX:void 0,currentY:void 0,minX:void 0,minY:void 0,maxX:void 0,maxY:void 0,width:void 0,height:void 0,startX:void 0,startY:void 0,touchesStart:{},touchesCurrent:{}},velocity:{x:void 0,y:void 0,prevPositionX:void 0,prevPositionY:void 0,prevTime:void 0}};"onGestureStart onGestureChange onGestureEnd onTouchStart onTouchMove onTouchEnd onTransitionEnd toggle enable disable in out".split(" ").forEach(function(i){t[i]=F[i].bind(e)}),d.extend(e,{zoom:t})},on:{init:function(){this.params.zoom.enabled&&this.zoom.enable()},destroy:function(){this.zoom.disable()},touchStart:function(e){this.zoom.enabled&&this.zoom.onTouchStart(e)},touchEnd:function(e){this.zoom.enabled&&this.zoom.onTouchEnd(e)},doubleTap:function(e){this.params.zoom.enabled&&this.zoom.enabled&&this.params.zoom.toggle&&this.zoom.toggle(e)},transitionEnd:function(){this.zoom.enabled&&this.params.zoom.enabled&&this.zoom.onTransitionEnd()}}},{name:"lazy",params:{lazy:{enabled:!1,loadPrevNext:!1,loadPrevNextAmount:1,loadOnTransitionStart:!1,elementClass:"swiper-lazy",loadingClass:"swiper-lazy-loading",loadedClass:"swiper-lazy-loaded",preloaderClass:"swiper-lazy-preloader"}},create:function(){d.extend(this,{lazy:{initialImageLoaded:!1,load:W.load.bind(this),loadInSlide:W.loadInSlide.bind(this)}})},on:{beforeInit:function(){this.params.lazy.enabled&&this.params.preloadImages&&(this.params.preloadImages=!1)},init:function(){this.params.lazy.enabled&&!this.params.loop&&0===this.params.initialSlide&&this.lazy.load()},scroll:function(){this.params.freeMode&&!this.params.freeModeSticky&&this.lazy.load()},resize:function(){this.params.lazy.enabled&&this.lazy.load()},scrollbarDragMove:function(){this.params.lazy.enabled&&this.lazy.load()},transitionStart:function(){this.params.lazy.enabled&&(this.params.lazy.loadOnTransitionStart||!this.params.lazy.loadOnTransitionStart&&!this.lazy.initialImageLoaded)&&this.lazy.load()},transitionEnd:function(){this.params.lazy.enabled&&!this.params.lazy.loadOnTransitionStart&&this.lazy.load()}}},{name:"controller",params:{controller:{control:void 0,inverse:!1,by:"slide"}},create:function(){d.extend(this,{controller:{control:this.params.controller.control,getInterpolateFunction:q.getInterpolateFunction.bind(this),setTranslate:q.setTranslate.bind(this),setTransition:q.setTransition.bind(this)}})},on:{update:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},resize:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},observerUpdate:function(){this.controller.control&&this.controller.spline&&(this.controller.spline=void 0,delete this.controller.spline)},setTranslate:function(e,t){this.controller.control&&this.controller.setTranslate(e,t)},setTransition:function(e,t){this.controller.control&&this.controller.setTransition(e,t)}}},{name:"a11y",params:{a11y:{enabled:!0,notificationClass:"swiper-notification",prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",paginationBulletMessage:"Go to slide {{index}}"}},create:function(){var e=this;d.extend(e,{a11y:{liveRegion:s('<span class="'+e.params.a11y.notificationClass+'" aria-live="assertive" aria-atomic="true"></span>')}}),Object.keys(j).forEach(function(t){e.a11y[t]=j[t].bind(e)})},on:{init:function(){this.params.a11y.enabled&&(this.a11y.init(),this.a11y.updateNavigation())},toEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},fromEdge:function(){this.params.a11y.enabled&&this.a11y.updateNavigation()},paginationUpdate:function(){this.params.a11y.enabled&&this.a11y.updatePagination()},destroy:function(){this.params.a11y.enabled&&this.a11y.destroy()}}},{name:"history",params:{history:{enabled:!1,replaceState:!1,key:"slides"}},create:function(){d.extend(this,{history:{init:K.init.bind(this),setHistory:K.setHistory.bind(this),setHistoryPopState:K.setHistoryPopState.bind(this),scrollToSlide:K.scrollToSlide.bind(this),destroy:K.destroy.bind(this)}})},on:{init:function(){this.params.history.enabled&&this.history.init()},destroy:function(){this.params.history.enabled&&this.history.destroy()},transitionEnd:function(){this.history.initialized&&this.history.setHistory(this.params.history.key,this.activeIndex)}}},{name:"hash-navigation",params:{hashNavigation:{enabled:!1,replaceState:!1,watchState:!1}},create:function(){d.extend(this,{hashNavigation:{initialized:!1,init:U.init.bind(this),destroy:U.destroy.bind(this),setHash:U.setHash.bind(this),onHashCange:U.onHashCange.bind(this)}})},on:{init:function(){this.params.hashNavigation.enabled&&this.hashNavigation.init()},destroy:function(){this.params.hashNavigation.enabled&&this.hashNavigation.destroy()},transitionEnd:function(){this.hashNavigation.initialized&&this.hashNavigation.setHash()}}},{name:"autoplay",params:{autoplay:{enabled:!1,delay:3e3,waitForTransition:!0,disableOnInteraction:!0,stopOnLastSlide:!1,reverseDirection:!1}},create:function(){var e=this;d.extend(e,{autoplay:{running:!1,paused:!1,run:_.run.bind(e),start:_.start.bind(e),stop:_.stop.bind(e),pause:_.pause.bind(e),onTransitionEnd:function(t){e&&!e.destroyed&&e.$wrapperEl&&t.target===this&&(e.$wrapperEl[0].removeEventListener("transitionend",e.autoplay.onTransitionEnd),e.$wrapperEl[0].removeEventListener("webkitTransitionEnd",e.autoplay.onTransitionEnd),e.autoplay.paused=!1,e.autoplay.running?e.autoplay.run():e.autoplay.stop())}}})},on:{init:function(){this.params.autoplay.enabled&&this.autoplay.start()},beforeTransitionStart:function(e,t){this.autoplay.running&&(t||!this.params.autoplay.disableOnInteraction?this.autoplay.pause(e):this.autoplay.stop())},sliderFirstMove:function(){this.autoplay.running&&(this.params.autoplay.disableOnInteraction?this.autoplay.stop():this.autoplay.pause())},destroy:function(){this.autoplay.running&&this.autoplay.stop()}}},{name:"effect-fade",params:{fadeEffect:{crossFade:!1}},create:function(){d.extend(this,{fadeEffect:{setTranslate:Z.setTranslate.bind(this),setTransition:Z.setTransition.bind(this)}})},on:{beforeInit:function(){if("fade"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"fade");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"fade"===this.params.effect&&this.fadeEffect.setTranslate()},setTransition:function(e){"fade"===this.params.effect&&this.fadeEffect.setTransition(e)}}},{name:"effect-cube",params:{cubeEffect:{slideShadows:!0,shadow:!0,shadowOffset:20,shadowScale:.94}},create:function(){d.extend(this,{cubeEffect:{setTranslate:Q.setTranslate.bind(this),setTransition:Q.setTransition.bind(this)}})},on:{beforeInit:function(){if("cube"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"cube"),this.classNames.push(this.params.containerModifierClass+"3d");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,resistanceRatio:0,spaceBetween:0,centeredSlides:!1,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"cube"===this.params.effect&&this.cubeEffect.setTranslate()},setTransition:function(e){"cube"===this.params.effect&&this.cubeEffect.setTransition(e)}}},{name:"effect-flip",params:{flipEffect:{slideShadows:!0,limitRotation:!0}},create:function(){d.extend(this,{flipEffect:{setTranslate:J.setTranslate.bind(this),setTransition:J.setTransition.bind(this)}})},on:{beforeInit:function(){if("flip"===this.params.effect){this.classNames.push(this.params.containerModifierClass+"flip"),this.classNames.push(this.params.containerModifierClass+"3d");var e={slidesPerView:1,slidesPerColumn:1,slidesPerGroup:1,watchSlidesProgress:!0,spaceBetween:0,virtualTranslate:!0};d.extend(this.params,e),d.extend(this.originalParams,e)}},setTranslate:function(){"flip"===this.params.effect&&this.flipEffect.setTranslate()},setTransition:function(e){"flip"===this.params.effect&&this.flipEffect.setTransition(e)}}},{name:"effect-coverflow",params:{coverflowEffect:{rotate:50,stretch:0,depth:100,modifier:1,slideShadows:!0}},create:function(){d.extend(this,{coverflowEffect:{setTranslate:ee.setTranslate.bind(this),setTransition:ee.setTransition.bind(this)}})},on:{beforeInit:function(){"coverflow"===this.params.effect&&(this.classNames.push(this.params.containerModifierClass+"coverflow"),this.classNames.push(this.params.containerModifierClass+"3d"),this.params.watchSlidesProgress=!0,this.originalParams.watchSlidesProgress=!0)},setTranslate:function(){"coverflow"===this.params.effect&&this.coverflowEffect.setTranslate()},setTransition:function(e){"coverflow"===this.params.effect&&this.coverflowEffect.setTransition(e)}}}];return void 0===k.use&&(k.use=k.Class.use,k.installModule=k.Class.installModule),k.use(te),k});
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
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_"+id).fadeOut( "slow");
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
            if(data==1){
                $("#lista_destinos_"+id).fadeOut( "slow");
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

        var a_total_=a_s+a_d+a_m+a_t;
        if(a_total_==0){
            swal(
                'Oops...',
                'Escoja la acomodacion!',
                'error'
            )
            return false;
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

function variar_profit(acom) {
    var dias=$('#dias').val();
    var valor=parseFloat($('#cost_'+acom).html());
    var pro=parseFloat($('#pro_'+acom).val());
    var sale=Math.round(valor+pro,2);
    $('#sale_'+acom).val(sale);
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    var sale_s=parseFloat($('#sale_s').val());
    var sale_d=parseFloat($('#sale_d').val());
    var sale_m=parseFloat($('#sale_m').val());
    var sale_t=parseFloat($('#sale_t').val());
    var sale_sh=parseFloat($('#sale_sh').val());
    if(dias>1) {
        $('#total_profit').html(sale_s + sale_d + sale_m + sale_t);
    }
    else if(dias==1){
        $('#total_profit').html(sale_sh);
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
    var pro=Math.round(sale-valor);
    $('#pro_'+acom).val(pro);
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    $('#sale_'+acom).val(sale);

    var sale_s=0;
    var sale_d=0;
    var sale_m=0;
    var sale_t=0;
    var sale_sh=0;
    if(dias>1) {
        var sale_s=parseFloat($('#sale_s').val());
        var sale_d=parseFloat($('#sale_d').val());
        var sale_m=parseFloat($('#sale_m').val());
        var sale_t=parseFloat($('#sale_t').val());
    }
    else if(dias==1){
        sale_sh=parseFloat($('#sale_sh').val());
    }

    if(dias>1) {
        $('#total_profit').html(sale_s + sale_d + sale_m + sale_t);
    }
    else if(dias==1){
        $('#total_profit').html(sale_sh);

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

    if(dias>1) {
        if (sale_s != 0)
            uti_por_d = Math.round((pro_s / sale_s) * 100, 0);
        if (sale_d != 0)
            uti_por_d = Math.round((pro_d / sale_d) * 100, 0);
        if (sale_m != 0)
            uti_por_m = Math.round((pro_m / sale_m) * 100, 0);
        if (sale_t != 0)
            uti_por_t = Math.round((pro_t / sale_t) * 100, 0);

        $('#profit_por_s').val(uti_por_s);
        $('#profit_por_d').val(uti_por_d);
        $('#profit_por_m').val(uti_por_m);
        $('#profit_por_t').val(uti_por_t);
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
    var d=0;
    var s=0;
    if(paxs==6){
        t=0;
        d=3;
        s=0;
    }
    else if(paxs==8){
        t=0;
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

        var a_total=a_s_+a_d_+a_m_+a_t_;
        if(a_total==0){

            swal(
                'Oops...',
                'Escoja la acomodacion!',
                'error'
            )
            return false;
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
    });
}

function borrar_serv_quot_paso1(id,servicio){
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
        $.post('/admin/quotes/servicio/delete', 'id='+id, function(data) {
            if(data==1){
                $("#lista_servicios_"+id).fadeOut( "slow");
                $("#lista_servicios_"+id).remove();
                calcularPrecio();
            }
        }).fail(function (data) {

        });

    })

}
function borrar_hotel_quot_paso1(id,dia){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar hotel para el dia "+dia+"?",
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
        $.post('/admin/quotes/hotel/delete', 'id='+id, function(data) {
            if(data==1){
                $("#caja_detalle_"+id).fadeOut( "slow");
                $("#caja_detalle_"+id).remove();
                calcularPrecio();
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
    if(traveles<=7){
        for (var i=1;i<=traveles;i++){
            icon_human+='<i class="fa fa-male fa-2x" aria-hidden="true"></i> ';
        }
    }
    else{
        icon_human='<i class="fa fa-male fa-2x" aria-hidden="true"></i> x '+traveles;
    }
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
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $("#tb_datos_"+grupo).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&filtro=Normal', function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
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
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Codigo guardado correctamente',
                        'success'
                    )
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
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Codigo guardada correctamente',
                        'success'
                    )
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
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Hora guardada correctamente',
                        'success'
                    )
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
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Hora guardado correctamente',
                        'success'
                    )
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
function dato_producto(valor){
    dato_producto_id=valor;
    console.log('valor:'+valor);
}
function Guardar_proveedor(id,url,csrf_field) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var csrf='<input type="hidden" name="_token" value="'+csrf_field+'">';
    var field_id='<input type="hidden" name="id" value="'+id+'">';
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_path_'+id).attr('action'),
        data: $('#asignar_proveedor_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
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

                $('#book_precio_asig_'+id).html('<span id="costo_servicio_'+id+'">'+precio_pro+'</span>');
                $('#book_precio_asig_'+id).append(popup);
                prove=$('#proveedor_servicio_'+dato_producto_id).val();
                $('#boton_prove_'+id).html('<i class="fa fa-edit"></i>');
                // $('#boton_prove_'+id).removeClass('btn-primary');
                // $('#boton_prove_'+id).addClass('btn-warning');
                $('#book_proveedor_'+id).html(prove);
                $('#book_proveedor_'+id).fadeIn();
                $('#estado_proveedor_serv_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
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
function dato_producto_hotel(valor){
    dato_producto_hotel_id=valor;
    console.log('valor:'+valor);
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
            data: 'costo_id='+costo_id+'&proveedor_id='+proveedor_id,
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

function eliminar_liquidacion(id,ini,fin) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la liquidacion (Desde:"+ini+" - Hasta:"+fin+"?",
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
                $("#lista_liquidaciones_"+id).fadeOut( "slow");
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

                iti_temp += itinerario[4]+'<span class="text-warning"> ('+destino_escoj_titulo+')</span><input type="hidden" name="servicios_esc[]" value="'+itinerario[2]+'"><input type="hidden" name="destinos_esc[]" value="'+destino_escoj+'"></div>'+
            '<div class="col-lg-1 small puntero"><span class="text-danger float-right text-right" onclick="borrar_servicios_esc(\''+itinerario[2]+'\',\''+itinerario[4]+'\')"><i class="fas fa-trash" aria-hidden="true"></i></span></div>'+
                '</div>'+
                '</div>';

                $('#caja_1').append(iti_temp);
            }
            $(this).prop("checked", "");
        }
    });
    $('#nroServicios').val(total_serv);

    // if(!existe_destino('#txt_destino_foco option',destino_escoj)) {
    //     var destino_foco = '<option value="' + destino_escoj + '">' + destino_escoj_titulo + '</option>';
    //     $('#txt_destino_foco').append(destino_foco);
    // }
    // if(!existe_destino('#txt_destino_duerme option',destino_escoj)) {
    //     var destino_duerme = '<option value="' + destino_escoj + '">' + destino_escoj_titulo + '</option>';
    //     $('#txt_destino_duerme').append(destino_duerme);
    // }
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
            $("#proveedor_" + value).addClass('d-none');
            $("#proveedor_" + value).fadeOut("slow");
        });
        $("#proveedor_" + proveedor[0]).removeClass('d-none');
        $("#proveedor_" + proveedor[0]).fadeIn("slow");
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
        $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html(iti_temp1);
    }
    else {
        $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html('');
    }
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
        $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id+'&filtro=Normal', function(data) {
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
            $('#list_servicios_grupo_'+servicios_id).html(data);
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
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id,
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
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id,
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
            url: '../../../../../book/listar-servicios-paso1',
            data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#list_servicios_grupo_'+servicios_id).html(data);
            }
        })
    }
}
function mostrar_servicios_localizacion_paso1(itinerario_id,servicios_id,localizacion,grupo,proveedor_id) {
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
        url: '../../../../../book/listar-servicios/localizacion-paso1',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&servicios_id='+servicios_id+'&itinerario_id='+itinerario_id+'&proveedor_id='+proveedor_id,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend:
            function() {
                $('#servicio_localizacion_'+servicios_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
        success: function(data) {
            $('#servicio_localizacion_'+servicios_id).html(data);
        }
    })
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
            $('#response_notas_'+pqt_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Loading');
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
        url: '../../../admin/package/buscar-day-by-day/ajax',
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
function  modificar_fecha(fecha,iti_id,tipo){
    console.log('fecha:'+fecha+',iti_id:'+iti_id);
    $('#rp_cambio_fecha_'+iti_id).removeClass('text-danger');
    $('#rp_cambio_fecha_'+iti_id).removeClass('text-success');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    if(tipo=='s') {
        $.ajax({
            type: 'POST',
            url: '../../../../../quotes/new/step1/cambiar-fecha/ajax',
            data: 'fecha=' + fecha + '&iti_id=' + iti_id,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend: function () {
                $('#rp_cambio_fecha_' + iti_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
            },
            success: function (data) {
                if (data == '1') {
                    var fecha1 = fecha.split('-');
                    $('#iti_fecha_b_' + iti_id).html(fecha1[2] + '-' + fecha1[1] + '-' + fecha1[0]);
                    $('#rp_cambio_fecha_' + iti_id).addClass('text-success');
                    $('#rp_cambio_fecha_' + iti_id).html('Fecha cambiada correctamente');
                }
                else {
                    $('#rp_cambio_fecha_' + iti_id).addClass('text-danger');
                }
            }
        })
    }
    else{
        $.ajax({
            type: 'POST',
            url: '../../../../../quotes/new/step1/cambiar-fecha/ajax',
            data: 'fecha='+fecha+'&iti_id='+iti_id,
            // Mostramos un mensaje con la respuesta de PHP
            beforeSend:
                function() {
                    $('#rp_cambio_fecha_'+iti_id).html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
                },
            success: function(data){
                if(data=='1'){
                    var fecha1=fecha.split('-');
                    $('#iti_fecha_b_'+iti_id).html(fecha1[2]+'-'+fecha1[1]+'-'+fecha1[0]);
                    $('#rp_cambio_fecha_'+iti_id).addClass('text-success');
                    $('#rp_cambio_fecha_'+iti_id).html('Fecha cambiada correctamente');
                }
                else{
                    $('#rp_cambio_fecha_'+iti_id).addClass('text-danger');
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
            url: "../new/profile/list-paquetes",
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

function buscar_x_codigo_nuevo(codigo){
    console.log('codigo::'+codigo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: "../admin/book/list-paquetes-codigo",
        data: 'codigo='+codigo,
        // Mostramos un mensaje con la respuesta de PHP
        beforeSend: function(data1){
            $('#nuevos').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        },
        success: function(data){
            $('#nuevos').html(data);
        }
    });
}