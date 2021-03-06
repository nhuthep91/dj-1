/*
 * @Author: Hoangdv
 * @Class: Base js
 * @Param : 
 * @Since : 20/2/2014
 */
var BASE = {
    /*
     * @Author: Hoangdv
     * @Function: SendRequest to sever
     * @Param : url (go to module/controller/action), data (data send to sever), callback (call to function after success)
     * @Since : 20/2/2014
     */
    sendRequest: function(url, data, callback) {
        var url = URL_ROOT + '/' + url;
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: (function(data) {
                callback(data);
            })
        });
    },
    getPage: function(url, page) {
        var url = url;
        var data = 'page=' + page;
        var callback = BASE.cbgetPage;
        BASE.sendRequest(url, data, callback);
    },
    cbgetPage: function(data) {
        try {
            $('#show_content').html(data.html);
        } catch (e) {
            alert('Loi');
        }
    },
    isEmty: function(id) {
        if (id != '') {
            var val = $("#" + id).val();
            if ($.trim(val) == '') {
                return true;
            } else {
                return false;
            }
        }
    },
    toogleCheckBox: function() {
        if ($("#check_all").attr("checked")) {
            $("td input:checkbox").attr('checked', true);
        } else {
            $("td input:checkbox").attr('checked', false);
        }
    }
}

Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
            decSeparator = decSeparator == undefined ? "." : decSeparator,
            thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
            sign = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};



// yepnope.js
// Version - 1.5.4pre
//
// by
// Alex Sexton - @SlexAxton - AlexSexton[at]gmail.com
// Ralph Holzmann - @ralphholzmann - ralphholzmann[at]gmail.com
//
// http://yepnopejs.com/
// https://github.com/SlexAxton/yepnope.js/
//
// Tri-license - WTFPL | MIT | BSD
//
// Please minify before use.
// Also available as Modernizr.load via the Modernizr Project
//
(function(e,t,n){function C(e){return!e||e=="loaded"||e=="complete"||e=="uninitialized"}function k(e,n,r,o,u,a){var l=t.createElement("script"),c,h;o=o||N.errorTimeout,l.src=e;for(h in r)l.setAttribute(h,r[h]);n=a?A:n||f,l.onreadystatechange=l.onload=function(){!c&&C(l.readyState)&&(c=1,n(),l.onload=l.onreadystatechange=null)},i(function(){c||(c=1,n(1))},o),u?l.onload():s.parentNode.insertBefore(l,s)}function L(e,n,r,o,u,a){var l=t.createElement("link"),c,h;o=o||N.errorTimeout,n=a?A:n||f,l.href=e,l.rel="stylesheet",l.type="text/css";for(h in r)l.setAttribute(h,r[h]);u||(s.parentNode.insertBefore(l,s),i(n,0))}function A(){var e=u.shift();a=1,e?e.t?i(function(){(e["t"]=="c"?N.injectCss:N.injectJs)(e.s,0,e.a,e.x,e.e,1)},0):(e(),A()):a=0}function O(e,n,r,o,f,l,p){function y(t){if(!v&&C(d.readyState)){g.r=v=1,!a&&A(),d.onload=d.onreadystatechange=null;if(t){e!="img"&&i(function(){h.removeChild(d)},50);for(var r in S[n])S[n].hasOwnProperty(r)&&S[n][r].onload()}}}p=p||N.errorTimeout;var d=t.createElement(e),v=0,m=0,g={t:r,s:n,e:f,a:l,x:p};S[n]===1&&(m=1,S[n]=[]),e=="object"?d.data=n:(d.src=n,d.type=e),d.width=d.height="0",d.onerror=d.onload=d.onreadystatechange=function(){y.call(this,m)},u.splice(o,0,g),e!="img"&&(m||S[n]===2?(h.insertBefore(d,c?null:s),i(y,p)):S[n].push(d))}function M(e,t,n,r,i){return a=0,t=t||"j",b(e)?O(t=="c"?m:v,e,t,this.i++,n,r,i):(u.splice(this.i++,0,e),u.length==1&&A()),this}function _(){var e=N;return e.loader={load:M,i:0},e}var r=t.documentElement,i=e.setTimeout,s=t.getElementsByTagName("script")[0],o={}.toString,u=[],a=0,f=function(){},l="MozAppearance"in r.style,c=l&&!!t.createRange().compareNode,h=c?r:s.parentNode,p=e.opera&&o.call(e.opera)=="[object Opera]",d=!!t.attachEvent&&!p,v=l?"object":d?"script":"img",m=d?"script":v,g=Array.isArray||function(e){return o.call(e)=="[object Array]"},y=function(e){return Object(e)===e},b=function(e){return typeof e=="string"},w=function(e){return o.call(e)=="[object Function]"},E=[],S={},x={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}},T,N;N=function(e){function s(e){var t=e.split("!"),n=E.length,r=t.pop(),i=t.length,s={url:r,origUrl:r,prefixes:t},o,u,a;for(u=0;u<i;u++)a=t[u].split("="),o=x[a.shift()],o&&(s=o(s,a));for(u=0;u<n;u++)s=E[u](s);return s}function o(e){return e.split(".").pop().split("?").shift()}function u(e,t,r,i,u){var a=s(e),f=a.autoCallback,l=o(a.url);if(a.bypass)return;t&&(t=w(t)?t:t[e]||t[i]||t[e.split("/").pop().split("?")[0]]);if(a.instead)return a.instead(e,t,r,i,u);S[a.url]?a.noexec=!0:S[a.url]=1,r.load(a.url,a.forceCSS||!a.forceJS&&"css"==o(a["url"])?"c":n,a.noexec,a.attrs,a.timeout),(w(t)||w(f))&&r.load(function(){_(),t&&t(a.origUrl,u,i),f&&f(a.origUrl,u,i),S[a.url]=2})}function a(e,t){function h(e,r){if(!e)!r&&a();else if(b(e))r||(s=function(){var e=[].slice.call(arguments);o.apply(this,e),a()}),u(e,s,t,0,n);else if(y(e)){l=function(){var t=0,n;for(n in e)e.hasOwnProperty(n)&&t++;return t}();for(c in e)e.hasOwnProperty(c)&&(!r&&!--l&&(w(s)?s=function(){var e=[].slice.call(arguments);o.apply(this,e),a()}:s[c]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),a()}}(o[c])),u(e[c],s,t,c,n))}}var n=!!e.test,r=n?e.yep:e.nope,i=e.load||e.both,s=e.callback||f,o=s,a=e.complete||f,l,c;h(r,!!i),i&&h(i)}var t,r,i=this.yepnope.loader;if(b(e))u(e,0,i,0);else if(g(e))for(t=0;t<e.length;t++)r=e[t],b(r)?u(r,0,i,0):g(r)?N(r):y(r)&&a(r,i);else y(e)&&a(e,i)},N.addPrefix=function(e,t){x[e]=t},N.addFilter=function(e){E.push(e)},N.errorTimeout=1e4,t.readyState==null&&t.addEventListener&&(t.readyState="loading",t.addEventListener("DOMContentLoaded",T=function(){t.removeEventListener("DOMContentLoaded",T,0),t.readyState="complete"},0)),e.yepnope=_(),e.yepnope.executeStack=A,e.yepnope.injectJs=k,e.yepnope.injectCss=L})(this,document),function(){var e;e=function(){function e(e){this.name=e,this.queues_have_been_run=!1,this.initializers={},this.validate={},this.fileQueue=[],this.callbackQueue=[],this.webtrends=[],this.nonCriticalScripts=[]}return e.prototype.queue=function(e){return this.queues_have_been_run?e.apply(window):this.callbackQueue.push(e)},e.prototype.load=function(e){return this.queues_have_been_run?yepnope.apply(window,[e]):this.fileQueue.push(e)},e.prototype.runQueues=function(){var e=this;return this.queues_have_been_run=!0,this.fileQueue.length?yepnope({load:this.fileQueue,complete:function(){return e.runCallbacks(e.callbackQueue)}}):this.runCallbacks(this.callbackQueue)},e.prototype.runCallbacks=function(e){var t,n,r,i;i=[];for(n=0,r=e.length;n<r;n++)t=e[n],i.push(t.apply(window));return i},e.prototype.loadNonCriticalScripts=function(){document.write=function(e){return $("body").append(e)};if(this.nonCriticalScripts.length)return yepnope({load:this.nonCriticalScripts})},e}(),window.Marketplace=e,window.marketplace=new e}.call(this);