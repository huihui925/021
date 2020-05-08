!function(e,E){"use strict";var n=E.module("ngTouch",[]);function t(n,t){var o=!1,c=!1;this.ngClickOverrideEnabled=function(e){return E.isDefined(e)?(e&&!c&&(c=!0,i.$$moduleName="ngTouch",t.directive("ngClick",i),n.decorator("ngClickDirective",["$delegate",function(e){if(o)e.shift();else for(var n=e.length-1;0<=n;){if("ngTouch"===e[n].$$moduleName){e.splice(n,1);break}n--}return e}])),o=e,this):o},this.$get=function(){return{ngClickOverrideEnabled:function(){return o}}}}n.provider("$touch",t),t.$inject=["$provide","$compileProvider"],n.factory("$swipe",[function(){var c={mouse:{start:"mousedown",move:"mousemove",end:"mouseup"},touch:{start:"touchstart",move:"touchmove",end:"touchend",cancel:"touchcancel"}};function s(e){var n=e.originalEvent||e,t=n.touches&&n.touches.length?n.touches:[n],o=n.changedTouches&&n.changedTouches[0]||t[0];return{x:o.clientX,y:o.clientY}}function l(e,t){var o=[];return E.forEach(e,function(e){var n=c[e][t];n&&o.push(n)}),o.join(" ")}return{bind:function(e,t,n){var o,c,i,r,u=!1;n=n||["mouse","touch"],e.on(l(n,"start"),function(e){i=s(e),u=!0,c=o=0,r=i,t.start&&t.start(i,e)});var a=l(n,"cancel");a&&e.on(a,function(e){u=!1,t.cancel&&t.cancel(e)}),e.on(l(n,"move"),function(e){if(u&&i){var n=s(e);if(o+=Math.abs(n.x-r.x),c+=Math.abs(n.y-r.y),r=n,!(o<10&&c<10))return o<c?(u=!1,void(t.cancel&&t.cancel(e))):(e.preventDefault(),void(t.move&&t.move(n,e)))}}),e.on(l(n,"end"),function(e){u&&(u=!1,t.end&&t.end(s(e),e))})}}}]);var i=["$parse","$timeout","$rootElement",function(e,c,m){var w,$,i,r=2500,a=25,u="ng-click-active";function b(e,n,t){for(var o=0;o<e.length;o+=2)if(c=e[o],i=e[o+1],r=n,u=t,Math.abs(c-r)<a&&Math.abs(i-u)<a)return e.splice(o,o+2),!0;var c,i,r,u;return!1}function k(e){if(!(Date.now()-w>r)){var n,t=e.touches&&e.touches.length?e.touches:[e],o=t[0].clientX,c=t[0].clientY;if(!(o<1&&c<1))if(!i||i[0]!==o||i[1]!==c)i&&(i=null),"label"===(n=e.target,E.lowercase(n.nodeName||n[0]&&n[0].nodeName))&&(i=[o,c]),b($,o,c)||(e.stopPropagation(),e.preventDefault(),e.target&&e.target.blur&&e.target.blur())}}function D(e){var n=e.touches&&e.touches.length?e.touches:[e],t=n[0].clientX,o=n[0].clientY;$.push(t,o),c(function(){for(var e=0;e<$.length;e+=2)if($[e]==t&&$[e+1]==o)return void $.splice(e,e+2)},r,!1)}return function(t,s,l){var h,f,d,v,o=e(l.ngClick),g=!1;function p(){g=!1,s.removeClass(u)}s.on("touchstart",function(e){g=!0,3==(h=e.target?e.target:e.srcElement).nodeType&&(h=h.parentNode),s.addClass(u),f=Date.now();var n=e.originalEvent||e,t=(n.touches&&n.touches.length?n.touches:[n])[0];d=t.clientX,v=t.clientY}),s.on("touchcancel",function(e){p()}),s.on("touchend",function(e){var n,t,o=Date.now()-f,c=e.originalEvent||e,i=(c.changedTouches&&c.changedTouches.length?c.changedTouches:c.touches&&c.touches.length?c.touches:[c])[0],r=i.clientX,u=i.clientY,a=Math.sqrt(Math.pow(r-d,2)+Math.pow(u-v,2));g&&o<750&&a<12&&(n=r,t=u,$||(m[0].addEventListener("click",k,!0),m[0].addEventListener("touchstart",D,!0),$=[]),w=Date.now(),b($,n,t),h&&h.blur(),E.isDefined(l.disabled)&&!1!==l.disabled||s.triggerHandler("click",[e])),p()}),s.onclick=function(e){},s.on("click",function(e,n){t.$apply(function(){o(t,{$event:n||e})})}),s.on("mousedown",function(e){s.addClass(u)}),s.on("mousemove mouseup",function(e){s.removeClass(u)})}}];function o(s,l,h){n.directive(s,["$parse","$swipe",function(u,a){return function(t,o,e){var c,i,r=u(e[s]);var n=["touch"];E.isDefined(e.ngSwipeDisableMouse)||n.push("mouse"),a.bind(o,{start:function(e,n){c=e,i=!0},cancel:function(e){i=!1},end:function(e,n){(function(e){if(!c)return!1;var n=Math.abs(e.y-c.y),t=(e.x-c.x)*l;return i&&n<75&&0<t&&30<t&&n/t<.3})(e)&&t.$apply(function(){o.triggerHandler(h),r(t,{$event:n})})}},n)}}])}o("ngSwipeLeft",-1,"swipeleft"),o("ngSwipeRight",1,"swiperight")}(window,window.angular);