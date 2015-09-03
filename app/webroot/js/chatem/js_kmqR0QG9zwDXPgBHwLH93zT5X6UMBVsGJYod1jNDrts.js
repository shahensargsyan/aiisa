/*! Respond.js v1.4.2: min/max-width media query polyfill
 * Copyright 2013 Scott Jehl
 * Licensed under MIT
 * http://j.mp/respondjs */

!function(a) {
    "use strict";
    a.matchMedia = a.matchMedia || function(a) {
        var b, c = a.documentElement, d = c.firstElementChild || c.firstChild, e = a.createElement("body"), f = a.createElement("div");
        return f.id = "mq-test-1", f.style.cssText = "position:absolute;top:-100em", e.style.background = "none", e.appendChild(f), function(a) {
            return f.innerHTML = '&shy;<style media="' + a + '"> #mq-test-1 { width: 42px; }</style>', c.insertBefore(e, d), b = 42 === f.offsetWidth, c.removeChild(e), {matches: b, media: a}
        }
    }(a.document)
}(this), function(a) {
    "use strict";
    function b() {
        v(!0)
    }
    var c = {};
    a.respond = c, c.update = function() {
    };
    var d = [], e = function() {
        var b = !1;
        try {
            b = new a.XMLHttpRequest
        } catch (c) {
            b = new a.ActiveXObject("Microsoft.XMLHTTP")
        }
        return function() {
            return b
        }
    }(), f = function(a, b) {
        var c = e();
        c && (c.open("GET", a, !0), c.onreadystatechange = function() {
            4 !== c.readyState || 200 !== c.status && 304 !== c.status || b(c.responseText)
        }, 4 !== c.readyState && c.send(null))
    }, g = function(a) {
        return a.replace(c.regex.minmaxwh, "").match(c.regex.other)
    };
    if (c.ajax = f, c.queue = d, c.unsupportedmq = g, c.regex = {media: /@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi, keyframes: /@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi, comments: /\/\*[^*]*\*+([^/][^*]*\*+)*\//gi, urls: /(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g, findStyles: /@media *([^\{]+)\{([\S\s]+?)$/, only: /(only\s+)?([a-zA-Z]+)\s?/, minw: /\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/, maxw: /\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/, minmaxwh: /\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi, other: /\([^\)]*\)/g}, c.mediaQueriesSupported = a.matchMedia && null !== a.matchMedia("only all") && a.matchMedia("only all").matches, !c.mediaQueriesSupported) {
        var h, i, j, k = a.document, l = k.documentElement, m = [], n = [], o = [], p = {}, q = 30, r = k.getElementsByTagName("head")[0] || l, s = k.getElementsByTagName("base")[0], t = r.getElementsByTagName("link"), u = function() {
            var a, b = k.createElement("div"), c = k.body, d = l.style.fontSize, e = c && c.style.fontSize, f = !1;
            return b.style.cssText = "position:absolute;font-size:1em;width:1em", c || (c = f = k.createElement("body"), c.style.background = "none"), l.style.fontSize = "100%", c.style.fontSize = "100%", c.appendChild(b), f && l.insertBefore(c, l.firstChild), a = b.offsetWidth, f ? l.removeChild(c) : c.removeChild(b), l.style.fontSize = d, e && (c.style.fontSize = e), a = j = parseFloat(a)
        }, v = function(b) {
            var c = "clientWidth", d = l[c], e = "CSS1Compat" === k.compatMode && d || k.body[c] || d, f = {}, g = t[t.length - 1], p = (new Date).getTime();
            if (b && h && q > p - h)
                return a.clearTimeout(i), i = a.setTimeout(v, q), void 0;
            h = p;
            for (var s in m)
                if (m.hasOwnProperty(s)) {
                    var w = m[s], x = w.minw, y = w.maxw, z = null === x, A = null === y, B = "em";
                    x && (x = parseFloat(x) * (x.indexOf(B) > -1 ? j || u() : 1)), y && (y = parseFloat(y) * (y.indexOf(B) > -1 ? j || u() : 1)), w.hasquery && (z && A || !(z || e >= x) || !(A || y >= e)) || (f[w.media] || (f[w.media] = []), f[w.media].push(n[w.rules]))
                }
            for (var C in o)
                o.hasOwnProperty(C) && o[C] && o[C].parentNode === r && r.removeChild(o[C]);
            o.length = 0;
            for (var D in f)
                if (f.hasOwnProperty(D)) {
                    var E = k.createElement("style"), F = f[D].join("\n");
                    E.type = "text/css", E.media = D, r.insertBefore(E, g.nextSibling), E.styleSheet ? E.styleSheet.cssText = F : E.appendChild(k.createTextNode(F)), o.push(E)
                }
        }, w = function(a, b, d) {
            var e = a.replace(c.regex.comments, "").replace(c.regex.keyframes, "").match(c.regex.media), f = e && e.length || 0;
            b = b.substring(0, b.lastIndexOf("/"));
            var h = function(a) {
                return a.replace(c.regex.urls, "$1" + b + "$2$3")
            }, i = !f && d;
            b.length && (b += "/"), i && (f = 1);
            for (var j = 0; f > j; j++) {
                var k, l, o, p;
                i ? (k = d, n.push(h(a))) : (k = e[j].match(c.regex.findStyles) && RegExp.$1, n.push(RegExp.$2 && h(RegExp.$2))), o = k.split(","), p = o.length;
                for (var q = 0; p > q; q++)
                    l = o[q], g(l) || m.push({media: l.split("(")[0].match(c.regex.only) && RegExp.$2 || "all", rules: n.length - 1, hasquery: l.indexOf("(") > -1, minw: l.match(c.regex.minw) && parseFloat(RegExp.$1) + (RegExp.$2 || ""), maxw: l.match(c.regex.maxw) && parseFloat(RegExp.$1) + (RegExp.$2 || "")})
            }
            v()
        }, x = function() {
            if (d.length) {
                var b = d.shift();
                f(b.href, function(c) {
                    w(c, b.href, b.media), p[b.href] = !0, a.setTimeout(function() {
                        x()
                    }, 0)
                })
            }
        }, y = function() {
            for (var b = 0; b < t.length; b++) {
                var c = t[b], e = c.href, f = c.media, g = c.rel && "stylesheet" === c.rel.toLowerCase();
                e && g && !p[e] && (c.styleSheet && c.styleSheet.rawCssText ? (w(c.styleSheet.rawCssText, e, f), p[e] = !0) : (!/^([a-zA-Z:]*\/\/)/.test(e) && !s || e.replace(RegExp.$1, "").split("/")[0] === a.location.host) && ("//" === e.substring(0, 2) && (e = a.location.protocol + e), d.push({href: e, media: f})))
            }
            x()
        };
        y(), c.update = y, c.getEmValue = u, a.addEventListener ? a.addEventListener("resize", b, !1) : a.attachEvent && a.attachEvent("onresize", b)
    }
}(this);
;
// html5shiv @rem remysharp.com/html5-enabling-script
// iepp v1.6.2 @jon_neal iecss.com/print-protector
// Dual licensed under the MIT or GPL Version 2 licenses
/*@cc_on(function(a,b){function r(a){var b=-1;while(++b<f)a.createElement(e[b])}if(!(!window.attachEvent||!b.createStyleSheet||!function(){var a=document.createElement("div");a.innerHTML="<elem></elem>";return a.childNodes.length!==1}())){a.iepp=a.iepp||{};var c=a.iepp,d=c.html5elements||"abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",e=d.split("|"),f=e.length,g=new RegExp("(^|\\s)("+d+")","gi"),h=new RegExp("<(/*)("+d+")","gi"),i=/^\s*[\{\}]\s*$/,j=new RegExp("(^|[^\\n]*?\\s)("+d+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),k=b.createDocumentFragment(),l=b.documentElement,m=l.firstChild,n=b.createElement("body"),o=b.createElement("style"),p=/print|all/,q;c.getCSS=function(a,b){if(a+""===undefined)return"";var d=-1,e=a.length,f,g=[];while(++d<e){f=a[d];if(f.disabled)continue;b=f.media||b,p.test(b)&&g.push(c.getCSS(f.imports,b),f.cssText),b="all"}return g.join("")},c.parseCSS=function(a){var b=[],c;while((c=j.exec(a))!=null)b.push(((i.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(g,"$1.iepp_$2")+c[4]);return b.join("\n")},c.writeHTML=function(){var a=-1;q=q||b.body;while(++a<f){var c=b.getElementsByTagName(e[a]),d=c.length,g=-1;while(++g<d)c[g].className.indexOf("iepp_")<0&&(c[g].className+=" iepp_"+e[a])}k.appendChild(q),l.appendChild(n),n.className=q.className,n.id=q.id,n.innerHTML=q.innerHTML.replace(h,"<$1font")},c._beforePrint=function(){o.styleSheet.cssText=c.parseCSS(c.getCSS(b.styleSheets,"all")),c.writeHTML()},c.restoreHTML=function(){n.innerHTML="",l.removeChild(n),l.appendChild(q)},c._afterPrint=function(){c.restoreHTML(),o.styleSheet.cssText=""},r(b),r(k);if(c.disablePP)return;m.insertBefore(o,m.firstChild),o.media="print",o.className="iepp-printshim",a.attachEvent("onbeforeprint",c._beforePrint),a.attachEvent("onafterprint",c._afterPrint)}})(this,document);@*/
;
/* Modernizr 2.8.1 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-flexbox-flexboxlegacy-svg-shiv-mq-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;
window.Modernizr = function(a, b, c) {
    function B(a) {
        j.cssText = a
    }
    function C(a, b) {
        return B(m.join(a + ";") + (b || ""))
    }
    function D(a, b) {
        return typeof a === b
    }
    function E(a, b) {
        return!!~("" + a).indexOf(b)
    }
    function F(a, b) {
        for (var d in a) {
            var e = a[d];
            if (!E(e, "-") && j[e] !== c)
                return b == "pfx" ? e : !0
        }
        return!1
    }
    function G(a, b, d) {
        for (var e in a) {
            var f = b[a[e]];
            if (f !== c)
                return d === !1 ? a[e] : D(f, "function") ? f.bind(d || b) : f
        }
        return!1
    }
    function H(a, b, c) {
        var d = a.charAt(0).toUpperCase() + a.slice(1), e = (a + " " + o.join(d + " ") + d).split(" ");
        return D(b, "string") || D(b, "undefined") ? F(e, b) : (e = (a + " " + p.join(d + " ") + d).split(" "), G(e, b, c))
    }
    var d = "2.8.1", e = {}, f = !0, g = b.documentElement, h = "modernizr", i = b.createElement(h), j = i.style, k, l = {}.toString, m = " -webkit- -moz- -o- -ms- ".split(" "), n = "Webkit Moz O ms", o = n.split(" "), p = n.toLowerCase().split(" "), q = {svg: "http://www.w3.org/2000/svg"}, r = {}, s = {}, t = {}, u = [], v = u.slice, w, x = function(a, c, d, e) {
        var f, i, j, k, l = b.createElement("div"), m = b.body, n = m || b.createElement("body");
        if (parseInt(d, 10))
            while (d--)
                j = b.createElement("div"), j.id = e ? e[d] : h + (d + 1), l.appendChild(j);
        return f = ["&#173;", '<style id="s', h, '">', a, "</style>"].join(""), l.id = h, (m ? l : n).innerHTML += f, n.appendChild(l), m || (n.style.background = "", n.style.overflow = "hidden", k = g.style.overflow, g.style.overflow = "hidden", g.appendChild(n)), i = c(l, a), m ? l.parentNode.removeChild(l) : (n.parentNode.removeChild(n), g.style.overflow = k), !!i
    }, y = function(b) {
        var c = a.matchMedia || a.msMatchMedia;
        if (c)
            return c(b) && c(b).matches || !1;
        var d;
        return x("@media " + b + " { #" + h + " { position: absolute; } }", function(b) {
            d = (a.getComputedStyle ? getComputedStyle(b, null) : b.currentStyle)["position"] == "absolute"
        }), d
    }, z = {}.hasOwnProperty, A;
    !D(z, "undefined") && !D(z.call, "undefined") ? A = function(a, b) {
        return z.call(a, b)
    } : A = function(a, b) {
        return b in a && D(a.constructor.prototype[b], "undefined")
    }, Function.prototype.bind || (Function.prototype.bind = function(b) {
        var c = this;
        if (typeof c != "function")
            throw new TypeError;
        var d = v.call(arguments, 1), e = function() {
            if (this instanceof e) {
                var a = function() {
                };
                a.prototype = c.prototype;
                var f = new a, g = c.apply(f, d.concat(v.call(arguments)));
                return Object(g) === g ? g : f
            }
            return c.apply(b, d.concat(v.call(arguments)))
        };
        return e
    }), r.flexbox = function() {
        return H("flexWrap")
    }, r.flexboxlegacy = function() {
        return H("boxDirection")
    }, r.fontface = function() {
        var a;
        return x('@font-face {font-family:"font";src:url("https://")}', function(c, d) {
            var e = b.getElementById("smodernizr"), f = e.sheet || e.styleSheet, g = f ? f.cssRules && f.cssRules[0] ? f.cssRules[0].cssText : f.cssText || "" : "";
            a = /src/i.test(g) && g.indexOf(d.split(" ")[0]) === 0
        }), a
    }, r.svg = function() {
        return!!b.createElementNS && !!b.createElementNS(q.svg, "svg").createSVGRect
    };
    for (var I in r)
        A(r, I) && (w = I.toLowerCase(), e[w] = r[I](), u.push((e[w] ? "" : "no-") + w));
    return e.addTest = function(a, b) {
        if (typeof a == "object")
            for (var d in a)
                A(a, d) && e.addTest(d, a[d]);
        else {
            a = a.toLowerCase();
            if (e[a] !== c)
                return e;
            b = typeof b == "function" ? b() : b, typeof f != "undefined" && f && (g.className += " " + (b ? "" : "no-") + a), e[a] = b
        }
        return e
    }, B(""), i = k = null, function(a, b) {
        function l(a, b) {
            var c = a.createElement("p"), d = a.getElementsByTagName("head")[0] || a.documentElement;
            return c.innerHTML = "x<style>" + b + "</style>", d.insertBefore(c.lastChild, d.firstChild)
        }
        function m() {
            var a = s.elements;
            return typeof a == "string" ? a.split(" ") : a
        }
        function n(a) {
            var b = j[a[h]];
            return b || (b = {}, i++, a[h] = i, j[i] = b), b
        }
        function o(a, c, d) {
            c || (c = b);
            if (k)
                return c.createElement(a);
            d || (d = n(c));
            var g;
            return d.cache[a] ? g = d.cache[a].cloneNode() : f.test(a) ? g = (d.cache[a] = d.createElem(a)).cloneNode() : g = d.createElem(a), g.canHaveChildren && !e.test(a) && !g.tagUrn ? d.frag.appendChild(g) : g
        }
        function p(a, c) {
            a || (a = b);
            if (k)
                return a.createDocumentFragment();
            c = c || n(a);
            var d = c.frag.cloneNode(), e = 0, f = m(), g = f.length;
            for (; e < g; e++)
                d.createElement(f[e]);
            return d
        }
        function q(a, b) {
            b.cache || (b.cache = {}, b.createElem = a.createElement, b.createFrag = a.createDocumentFragment, b.frag = b.createFrag()), a.createElement = function(c) {
                return s.shivMethods ? o(c, a, b) : b.createElem(c)
            }, a.createDocumentFragment = Function("h,f", "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" + m().join().replace(/[\w\-]+/g, function(a) {
                return b.createElem(a), b.frag.createElement(a), 'c("' + a + '")'
            }) + ");return n}")(s, b.frag)
        }
        function r(a) {
            a || (a = b);
            var c = n(a);
            return s.shivCSS && !g && !c.hasCSS && (c.hasCSS = !!l(a, "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")), k || q(a, c), a
        }
        var c = "3.7.0", d = a.html5 || {}, e = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i, f = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i, g, h = "_html5shiv", i = 0, j = {}, k;
        (function() {
            try {
                var a = b.createElement("a");
                a.innerHTML = "<xyz></xyz>", g = "hidden"in a, k = a.childNodes.length == 1 || function() {
                    b.createElement("a");
                    var a = b.createDocumentFragment();
                    return typeof a.cloneNode == "undefined" || typeof a.createDocumentFragment == "undefined" || typeof a.createElement == "undefined"
                }()
            } catch (c) {
                g = !0, k = !0
            }
        })();
        var s = {elements: d.elements || "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video", version: c, shivCSS: d.shivCSS !== !1, supportsUnknownElements: k, shivMethods: d.shivMethods !== !1, type: "default", shivDocument: r, createElement: o, createDocumentFragment: p};
        a.html5 = s, r(b)
    }(this, b), e._version = d, e._prefixes = m, e._domPrefixes = p, e._cssomPrefixes = o, e.mq = y, e.testProp = function(a) {
        return F([a])
    }, e.testAllProps = H, e.testStyles = x, g.className = g.className.replace(/(^|\s)no-js(\s|$)/, "$1$2") + (f ? " js " + u.join(" ") : ""), e
}(this, this.document), function(a, b, c) {
    function d(a) {
        return"[object Function]" == o.call(a)
    }
    function e(a) {
        return"string" == typeof a
    }
    function f() {
    }
    function g(a) {
        return!a || "loaded" == a || "complete" == a || "uninitialized" == a
    }
    function h() {
        var a = p.shift();
        q = 1, a ? a.t ? m(function() {
            ("c" == a.t ? B.injectCss : B.injectJs)(a.s, 0, a.a, a.x, a.e, 1)
        }, 0) : (a(), h()) : q = 0
    }
    function i(a, c, d, e, f, i, j) {
        function k(b) {
            if (!o && g(l.readyState) && (u.r = o = 1, !q && h(), l.onload = l.onreadystatechange = null, b)) {
                "img" != a && m(function() {
                    t.removeChild(l)
                }, 50);
                for (var d in y[c])
                    y[c].hasOwnProperty(d) && y[c][d].onload()
            }
        }
        var j = j || B.errorTimeout, l = b.createElement(a), o = 0, r = 0, u = {t: d, s: c, e: f, a: i, x: j};
        1 === y[c] && (r = 1, y[c] = []), "object" == a ? l.data = c : (l.src = c, l.type = a), l.width = l.height = "0", l.onerror = l.onload = l.onreadystatechange = function() {
            k.call(this, r)
        }, p.splice(e, 0, u), "img" != a && (r || 2 === y[c] ? (t.insertBefore(l, s ? null : n), m(k, j)) : y[c].push(l))
    }
    function j(a, b, c, d, f) {
        return q = 0, b = b || "j", e(a) ? i("c" == b ? v : u, a, b, this.i++, c, d, f) : (p.splice(this.i++, 0, a), 1 == p.length && h()), this
    }
    function k() {
        var a = B;
        return a.loader = {load: j, i: 0}, a
    }
    var l = b.documentElement, m = a.setTimeout, n = b.getElementsByTagName("script")[0], o = {}.toString, p = [], q = 0, r = "MozAppearance"in l.style, s = r && !!b.createRange().compareNode, t = s ? l : n.parentNode, l = a.opera && "[object Opera]" == o.call(a.opera), l = !!b.attachEvent && !l, u = r ? "object" : l ? "script" : "img", v = l ? "script" : u, w = Array.isArray || function(a) {
        return"[object Array]" == o.call(a)
    }, x = [], y = {}, z = {timeout: function(a, b) {
            return b.length && (a.timeout = b[0]), a
        }}, A, B;
    B = function(a) {
        function b(a) {
            var a = a.split("!"), b = x.length, c = a.pop(), d = a.length, c = {url: c, origUrl: c, prefixes: a}, e, f, g;
            for (f = 0; f < d; f++)
                g = a[f].split("="), (e = z[g.shift()]) && (c = e(c, g));
            for (f = 0; f < b; f++)
                c = x[f](c);
            return c
        }
        function g(a, e, f, g, h) {
            var i = b(a), j = i.autoCallback;
            i.url.split(".").pop().split("?").shift(), i.bypass || (e && (e = d(e) ? e : e[a] || e[g] || e[a.split("/").pop().split("?")[0]]), i.instead ? i.instead(a, e, f, g, h) : (y[i.url] ? i.noexec = !0 : y[i.url] = 1, f.load(i.url, i.forceCSS || !i.forceJS && "css" == i.url.split(".").pop().split("?").shift() ? "c" : c, i.noexec, i.attrs, i.timeout), (d(e) || d(j)) && f.load(function() {
                k(), e && e(i.origUrl, h, g), j && j(i.origUrl, h, g), y[i.url] = 2
            })))
        }
        function h(a, b) {
            function c(a, c) {
                if (a) {
                    if (e(a))
                        c || (j = function() {
                            var a = [].slice.call(arguments);
                            k.apply(this, a), l()
                        }), g(a, j, b, 0, h);
                    else if (Object(a) === a)
                        for (n in m = function() {
                            var b = 0, c;
                            for (c in a)
                                a.hasOwnProperty(c) && b++;
                            return b
                        }(), a)
                            a.hasOwnProperty(n) && (!c && !--m && (d(j) ? j = function() {
                                var a = [].slice.call(arguments);
                                k.apply(this, a), l()
                            } : j[n] = function(a) {
                                return function() {
                                    var b = [].slice.call(arguments);
                                    a && a.apply(this, b), l()
                                }
                            }(k[n])), g(a[n], j, b, n, h))
                } else
                    !c && l()
            }
            var h = !!a.test, i = a.load || a.both, j = a.callback || f, k = j, l = a.complete || f, m, n;
            c(h ? a.yep : a.nope, !!i), i && c(i)
        }
        var i, j, l = this.yepnope.loader;
        if (e(a))
            g(a, 0, l, 0);
        else if (w(a))
            for (i = 0; i < a.length; i++)
                j = a[i], e(j) ? g(j, 0, l, 0) : w(j) ? B(j) : Object(j) === j && h(j, l);
        else
            Object(a) === a && h(a, l)
    }, B.addPrefix = function(a, b) {
        z[a] = b
    }, B.addFilter = function(a) {
        x.push(a)
    }, B.errorTimeout = 1e4, null == b.readyState && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", A = function() {
        b.removeEventListener("DOMContentLoaded", A, 0), b.readyState = "complete"
    }, 0)), a.yepnope = k(), a.yepnope.executeStack = h, a.yepnope.injectJs = function(a, c, d, e, i, j) {
        var k = b.createElement("script"), l, o, e = e || B.errorTimeout;
        k.src = a;
        for (o in d)
            k.setAttribute(o, d[o]);
        c = j ? h : c || f, k.onreadystatechange = k.onload = function() {
            !l && g(k.readyState) && (l = 1, c(), k.onload = k.onreadystatechange = null)
        }, m(function() {
            l || (l = 1, c(1))
        }, e), i ? k.onload() : n.parentNode.insertBefore(k, n)
    }, a.yepnope.injectCss = function(a, c, d, e, g, i) {
        var e = b.createElement("link"), j, c = i ? h : c || f;
        e.href = a, e.rel = "stylesheet", e.type = "text/css";
        for (j in d)
            e.setAttribute(j, d[j]);
        g || (n.parentNode.insertBefore(e, n), m(c, 0))
    }
}(this, document), Modernizr.load = function() {
    yepnope.apply(window, [].slice.call(arguments, 0))
};
;
// Generated by CoffeeScript 1.3.3

/*
 
 Harvey, A Second Face for Your Application's JavaScript
 
 Copyright 2012, Joschka Kintscher
 Released under the MIT License
 
 https://github.com/harvesthq/harvey/
 */


(function() {
    var State, _mediaQueryList;

    this.Harvey = (function() {

        function Harvey() {
        }

        Harvey.states = {};

        /*
         Creates a new State object for the given media query using the passed hash
         of callbacks and stores it in @states. The passed hash may contain up to
         three callbacks. See documentation of the State class for more information.
         */


        Harvey.attach = function(mediaQuery, callbacks) {
            var state;
            if (!this.states.hasOwnProperty(mediaQuery)) {
                this.states[mediaQuery] = [];
                this._add_css_for(mediaQuery);
            }
            state = new State(mediaQuery, callbacks != null ? callbacks.setup : void 0, callbacks != null ? callbacks.on : void 0, callbacks != null ? callbacks.off : void 0);
            if (!this.states[mediaQuery].length) {
                this._watch_query(mediaQuery);
            }
            this.states[mediaQuery].push(state);
            if (this._window_matchmedia(mediaQuery).matches) {
                this._update_states([state], true);
            }
            return state;
        };

        /*
         Removes a given State object from the @states hash.
         
         @param  object  state  A valid state object
         */


        Harvey.detach = function(state) {
            var i, s, _i, _len, _ref, _results;
            _ref = this.states[state.condition];
            _results = [];
            for (i = _i = 0, _len = _ref.length; _i < _len; i = ++_i) {
                s = _ref[i];
                if (state === s) {
                    _results.push(this.states[s.condition][i] = void 0);
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        /*
         Create a new matchMediaListener for the passed media query.
         
         @param  string  mediaQuery  A valid CSS media query to watch
         */


        Harvey._watch_query = function(mediaQuery) {
            var _this = this;
            return this._window_matchmedia(mediaQuery).addListener(function(mql) {
                return _this._update_states(_this.states[mediaQuery], mql.matches);
            });
        };

        /*
         Activates/Deactivates every State object in the passed list.
         
         @param  array   states  A list of State objects to update
         @param  boolean active Whether to activate or deactivate the given states
         */


        Harvey._update_states = function(states, active) {
            var state, _i, _len, _results;
            _results = [];
            for (_i = 0, _len = states.length; _i < _len; _i++) {
                state = states[_i];
                if (active) {
                    _results.push(state.activate());
                } else {
                    _results.push(state.deactivate());
                }
            }
            return _results;
        };

        /*
         BEWARE: You're at the edge of the map, mate. Here there be monsters!
         
         ------------------------------------------------------------------------------------
         
         Private methods to fix and polyfill the matchMedia interface for several engines
         
         * Inspired by Nicholas C. Zakas' article on the different problems with matchMedia
         http://www.nczonline.net/blog/2012/01/19/css-media-queries-in-javascript-part-2/
         
         * Implementing a modified coffeescript version of Scott Jehl's and Paul Irish's matchMedia.js polyfill
         https://github.com/paulirish/matchMedia.js
         */


        /*
         [FIX] for Firefox/Gecko browsers that lose reference to the
         MediaQueryList object unless it's being stored for runtime.
         */


        Harvey._mediaList = {};

        /*
         @param  string  mediaQuery      A valid CSS media query to monitor for updates
         @Return object  MediaQueryList  Depending on the browser and matchMedia support either a native
         mediaQueryList object or an instance of _mediaQueryList
         */


        Harvey._window_matchmedia = function(mediaQuery) {
            if (window.matchMedia && 'addListener' in window.matchMedia('all')) {
                if (!(mediaQuery in this._mediaList)) {
                    this._mediaList[mediaQuery] = window.matchMedia(mediaQuery);
                }
                return this._mediaList[mediaQuery];
            }
            /*
             [POLYFILL] for all browsers that don't support matchMedia() at all (CSS media query support
             is still mandatory though).
             */

            if (!this._listening) {
                this._listen();
            }
            if (!(mediaQuery in this._mediaList)) {
                this._mediaList[mediaQuery] = new _mediaQueryList(mediaQuery);
            }
            return this._mediaList[mediaQuery];
        };

        /*
         Add resize and orientationChange event listeners to the window element
         to monitor updates to the viewport
         */


        Harvey._listen = function() {
            var evt,
                    _this = this;
            evt = window.addEventListener || window.attachEvent;
            evt('resize', function() {
                var mediaList, mediaQuery, _ref, _results;
                _ref = _this._mediaList;
                _results = [];
                for (mediaQuery in _ref) {
                    mediaList = _ref[mediaQuery];
                    _results.push(mediaList._process());
                }
                return _results;
            });
            evt('orientationChange', function() {
                var mediaList, mediaQuery, _ref, _results;
                _ref = _this._mediaList;
                _results = [];
                for (mediaQuery in _ref) {
                    mediaList = _ref[mediaQuery];
                    _results.push(mediaList._process());
                }
                return _results;
            });
            return this._listening = true;
        };

        /*
         [FIX] for Webkit engines that only trigger the MediaQueryListListener
         when there is at least one CSS selector for the respective media query
         
         @param  string  MediaQuery  The media query to inject CSS for
         */


        Harvey._add_css_for = function(mediaQuery) {
            if (!this.style) {
                this.style = document.createElement('style');
                this.style.setAttribute('type', 'text/css');
                document.getElementsByTagName('head')[0].appendChild(this.style);
            }
            mediaQuery = "@media " + mediaQuery + " {.harvey-test{}}";
            if (!this.style.styleSheet) {
                return this.style.appendChild(document.createTextNode(mediaQuery));
            }
        };

        return Harvey;

    })();

    /*
     A State allows to execute a set of callbacks for the given valid CSS media query.
     
     Callbacks are executed in the context of their state object to allow access to the
     corresponding media query of the State.
     
     States are not exposed to the global namespace. They can be used by calling the
     static Harvey.attach() and Harvey.detach() methods.
     */


    State = (function() {

        State.prototype.active = false;

        State.prototype.is_setup = false;

        /*
         Creates a new State object
         
         @param  string    condition The media query to check for
         @param  function  setup     Called the first time `condition` becomes valid
         @param  function  on        Called every time `condition` becomes valid
         @param  function  off       Called every time `condition` becomes invalid
         */


        function State(condition, setup, on, off) {
            this.condition = condition;
            this.setup = setup;
            this.on = on;
            this.off = off;
        }

        /*
         Activate this State object if it is currently deactivated. Also perform all
         set up tasks if this is the first time the State is activated
         */


        State.prototype.activate = function() {
            if (this.active) {
                return;
            }
            if (!this.is_setup) {
                if (typeof this.setup === "function") {
                    this.setup();
                }
                this.is_setup = true;
            }
            if (typeof this.on === "function") {
                this.on();
            }
            return this.active = true;
        };

        /*
         Deactive this State object if it is currently active
         */


        State.prototype.deactivate = function() {
            if (!this.active) {
                return;
            }
            if (typeof this.off === "function") {
                this.off();
            }
            return this.active = false;
        };

        return State;

    })();

    /*
     [FIX] simple implemenation of the matchMedia interface to mimic the native
     matchMedia interface behaviour to work as a polyfill for Harvey
     */


    _mediaQueryList = (function() {
        /*
         Creates a new _mediaQueryList object
         
         @param  string  media  A valid CSS media query
         */

        function _mediaQueryList(media) {
            this.media = media;
            this._listeners = [];
            this.matches = this._matches();
        }

        /*
         Add a new listener to this mediaQueryList that will be called every time
         the media query becomes valid
         */


        _mediaQueryList.prototype.addListener = function(listener) {
            this._listeners.push(listener);
            return void 0;
        };

        /*
         Evaluate the media query of this mediaQueryList object and notify
         all registered listeners if the state has changed
         */


        _mediaQueryList.prototype._process = function() {
            var callback, current, _i, _len, _ref, _results;
            current = this._matches();
            if (this.matches === current) {
                return;
            }
            this.matches = current;
            _ref = this._listeners;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                callback = _ref[_i];
                _results.push(callback(this));
            }
            return _results;
        };

        /*
         Check whether the media query is currently valid
         */


        _mediaQueryList.prototype._matches = function() {
            if (!this._tester) {
                this._get_tester();
            }
            this._tester.innerHTML = '&shy;<style media="' + this.media + '">#harvey-mq-test{width:42px;}</style>';
            this._tester.removeChild(this._tester.firstChild);
            return this._tester.offsetWidth === 42;
        };

        /*
         Retrieve the element to test the media query on from the DOM or create
         it if it has not been injected into the page yet
         */


        _mediaQueryList.prototype._get_tester = function() {
            this._tester = document.getElementById('harvey-mq-test');
            if (!this._tester) {
                return this._build_tester();
            }
        };

        /*
         Create a new div with a unique id, move it outsite of the viewport and inject it into the DOM.
         This element will be used to check whether the registered media query is currently valid.
         */


        _mediaQueryList.prototype._build_tester = function() {
            this._tester = document.createElement('div');
            this._tester.id = 'harvey-mq-test';
            this._tester.style.cssText = 'position:absolute;top:-100em';
            return document.body.insertBefore(this._tester, document.body.firstChild);
        };

        return _mediaQueryList;

    })();

}).call(this);
;
/*!
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e) {
    e.fn.hoverIntent = function(t, n, r) {
        var i = {interval: 100, sensitivity: 7, timeout: 0};
        if (typeof t === "object") {
            i = e.extend(i, t)
        } else if (e.isFunction(n)) {
            i = e.extend(i, {over: t, out: n, selector: r})
        } else {
            i = e.extend(i, {over: t, out: t, selector: n})
        }
        var s, o, u, a;
        var f = function(e) {
            s = e.pageX;
            o = e.pageY
        };
        var l = function(t, n) {
            n.hoverIntent_t = clearTimeout(n.hoverIntent_t);
            if (Math.abs(u - s) + Math.abs(a - o) < i.sensitivity) {
                e(n).unbind("mousemove.hoverIntent", f);
                n.hoverIntent_s = 1;
                return i.over.apply(n, [t])
            } else {
                u = s;
                a = o;
                n.hoverIntent_t = setTimeout(function() {
                    l(t, n)
                }, i.interval)
            }
        };
        var c = function(e, t) {
            t.hoverIntent_t = clearTimeout(t.hoverIntent_t);
            t.hoverIntent_s = 0;
            return i.out.apply(t, [e])
        };
        var h = function(t) {
            var n = jQuery.extend({}, t);
            var r = this;
            if (r.hoverIntent_t) {
                r.hoverIntent_t = clearTimeout(r.hoverIntent_t)
            }
            if (t.type == "mouseenter") {
                u = n.pageX;
                a = n.pageY;
                e(r).bind("mousemove.hoverIntent", f);
                if (r.hoverIntent_s != 1) {
                    r.hoverIntent_t = setTimeout(function() {
                        l(n, r)
                    }, i.interval)
                }
            } else {
                e(r).unbind("mousemove.hoverIntent", f);
                if (r.hoverIntent_s == 1) {
                    r.hoverIntent_t = setTimeout(function() {
                        c(n, r)
                    }, i.timeout)
                }
            }
        };
        return this.bind({"mouseenter.hoverIntent": h, "mouseleave.hoverIntent": h}, i.selector)
    }
}(jQuery));
(function($) {

    // Put in placeholder images on automated content lists for items with no image
    function putInPlaceholderImages() {
        var automatedContentListItems = $('.view-section-index-auto-content-listing .item-list li .node, .view-section-index-auto-content-listing-audio-and-video .item-list li .node');

        if (automatedContentListItems.length > 0) {
            automatedContentListItems.each(function() {
                var imageInThisItem = $(this).find('img');
                if (!(imageInThisItem.length > 0)) {
                    // Insert mockup similar to that for items with images, so that any
                    // required CSS is applied to these placeholder images also
                    $(this).prepend('<div class="field-name-field-image-listing"><img src="/sites/default/themes/custom/childship/images/automated-content-placeholder.png" /></div>');
                }
            });
        }
    }

    function redecorateViewListing(itemList) {
        var totalItems = itemList.find('li').length;

        itemList.find('li').each(function(i) {
            if (i == 0) {
                $(this).addClass('first');
                return;
            }
            if (i == totalItems - 1) {
                $(this).addClass('last');
                return;
            }

            $(this).removeClass('first').removeClass('last');
        });
    }

    function enhanceLoadMore(loadMoreWrapper) {
        var thisPager = loadMoreWrapper.find('.item-list-pager ul.pager');
        // Remove the 'previous' and page status list items
        thisPager.find('.previous, .current').remove();
        thisPager.find('.next a').attr('title', 'Load more').text('Load more');

        loadMoreWrapper.find('.item-list-pager .next a').click(function(e) {
            e.preventDefault();

            loadMoreClick($(this));
        })
    }

    function loadMoreClick(triggerLink) {
        var wrapper = triggerLink.closest('.load-more-pager');
        //index of this particular "load-more-pager" amongst all those on the page
        var wrapperIndex = $('.load-more-pager').index(wrapper);
        var nextPageUrl = triggerLink.attr('href');
        var initialList = wrapper.find('.item-list');
        var initialPager = wrapper.find('.item-list-pager');

        triggerLink.addClass('working');

        // Load data into temporary unrendered element;
        $('<div>').load(nextPageUrl + ' .load-more-pager', function() {
            var newContent = $(this).find('.load-more-pager:eq(' + wrapperIndex + ')');
            var newList = newContent.find('.item-list');
            var newPager = newContent.find('.item-list-pager');

            // Append the rows to the main unordered list
            initialList.find('> ul').append(newList.find('> ul > li'));
            redecorateViewListing(initialList.find('ul'));
            putInPlaceholderImages();

            // Remove old pager, add new one and restyle it
            initialPager.remove();
            newPager.appendTo(wrapper);
            enhanceLoadMore(wrapper);
            triggerLink.removeClass('working');
        });
    }

    /* Turn automated content lists into jQuery UI tabs */
    Drupal.behaviors.automatedContentListTabs = {
        attach: function(context, settings) {
            if ($('body').hasClass('node-type-section-index') || $('body').hasClass('node-type-member-dashboard')) {
                var existingPanels = $('.field-name-field-automated-content-listings, .field-name-field-events-listings');

                if ($('.automated-content-tabs').length > 0)
                    return;

                // Create tabs
                existingPanels.prepend('\
          <div class="automated-content-tabs">\
             <div class="item-list">\
               <ul class="automated-content-tabs-tabs"></ul>\
             </div>\
          </div>');

                existingPanels.find('.view-section-index-auto-content-listing,\
          .view-section-index-auto-content-listing-audio-and-video,\
          .view-events-listing,\
          .view-member-dashboard').each(function(index) {

                    // If this view has content, create a tab header for it
                    if ($(this).children().length) {
                        var thisViewHeader = $(this).children('.view-header');

                        thisViewHeader.wrap('<li></li>');
                        thisViewHeader.closest('li').wrapInner('<a href="#fragment-' + index + '"></a>').appendTo('.automated-content-tabs ul.automated-content-tabs-tabs');
                    }

                    // give the view an id an append to the tabs whether it has content or not
                    $(this).attr('id', 'fragment-' + index);
                    $(this).appendTo('.automated-content-tabs');

                    // Update any pager links, if they're in use
                    $(this).find('.item-list-pager .pager li a').each(function() {
                        $(this).attr('href', $(this).attr('href') + '#fragment-' + index);
                    });
                });

                if (window.location.hash) {
                    var tab_id = window.location.hash.slice(window.location.hash.indexOf('-') + 1);
                    $('.automated-content-tabs').tabs({active: tab_id});
                    // Assume we need the filters expanded as we've specified a tab.
                    $('.show-filters').click();
                } else {
                    $('.automated-content-tabs').tabs();
                }

                // Don't show the tabs on 'Department' display mode of section index nodes
                if ($('.page-content-main').hasClass('section_index_department')) {
                    $('.automated-content-tabs-tabs').hide();
                }
            }
        }
    }

    Drupal.behaviors.loadMorePager = {
        attach: function(context, settings) {
            putInPlaceholderImages();

            // Rewrite each ajax view, adding a "load more" button
            $('.load-more-pager').each(function() {
                $(this).once(function() {
                    enhanceLoadMore($(this));
                });
            });
        }
    }

    Drupal.behaviors.enableStickyHeader = {
        attach: function(context, settings) {
            function doStickyHeader() {
                scrolledAmount = $(window).scrollTop();
                if (scrolledAmount > 60) {
                    $('.primary-navigation').addClass('sticky');
                    $('.search').addClass('sticky');
                }
                else {
                    $('.primary-navigation').removeClass('sticky');
                    $('.search').removeClass('sticky');
                }
            }
            ;
            doStickyHeader();
            $(window, context).scroll(function() {
                doStickyHeader();
            });
        }
    }

    Drupal.behaviors.mobileSearchFieldOnClick = {
        attach: function(context, settings) {
            Harvey.attach('screen and (max-width:470px)', {
                on: function() {
                    // Make click on search icon toggle search field, unless
                    // the field is displayed and has a value, in which case
                    // submit it as a search.
                    var searchFieldOpen = false;
                    $('form#search-block-form input[type="submit"]').click(function(e) {
                        if (searchFieldOpen == false) {
                            // Search field is not open; open it.
                            $('header.page-header').addClass('mobile-search-active');
                            searchFieldOpen = !searchFieldOpen;
                            e.preventDefault();
                        }
                        else {
                            // Search field is open; check if there is a value
                            // in the field and if so, submit it. Otherwise
                            // close the field.
                            var inputValue = $('.search input').val();
                            if (!(inputValue.length > 0)) {
                                $('header.page-header').removeClass('mobile-search-active');
                                searchFieldOpen = !searchFieldOpen;
                                e.preventDefault();
                            }
                        }
                    })
                },
                off: function() {
                    // Remove click from search icon.
                    $('header.page-header').removeClass('mobile-search-active');
                    $('form#search-block-form input[type="submit"]').unbind('click');
                }
            });
        }
    }

    Drupal.behaviors.mobileMenuTrigger = {
        attach: function(context, settings) {
            function mobileMenuMovement(state) {
                if (state == false) {
                    $('html').addClass('mobile-menu-open');
                    $('.mobile-menu').css('display', 'block');
                    $('.mobile-menu').animate({
                        right: '0'
                    }, 200);
                    $('#visible-body').animate({
                        left: '-265px'
                    }, 200);
                    state = true;
                }
                else {
                    $('html').removeClass('mobile-menu-open');
                    $('.mobile-menu').animate({
                        right: '-265px'
                    }, 200, function() {
                        $('.mobile-menu').css('display', 'none');
                    });
                    $('#visible-body').animate({
                        left: '0'
                    }, 200);
                    state = false;
                }
                return state;
            }
            Harvey.attach('screen and (max-width:1022px)', {
                on: function() {
                    // This function is invoked both when the media query comes into effect,
                    // but also by modal windows. Without the check below, we fall into an amazing
                    // chain reaction of adding .mobile-menu elements which eventually eats all
                    // the client device's RAM and/or CPU cycles. Nice.
                    if ($('.mobile-menu').length > 0) {
                        return;
                    }
                    $('header.page-header').append('<a class="mobile-menu-trigger fa fa-bars"></a>');
                    // Retrospectivally fitting this into the mobile menu 
                    var becomeAMemberLink = $('<ul class="js-added dropdown"><li><a href="/user">Membership login</a></li><li><a href="/become-member">Want to become a member?</a></li></a></ul>');
                    $('.primary-navigation .membership ul').remove();
                    $('.primary-navigation .membership').append(becomeAMemberLink);
                    var primaryNavigation = $('.primary-navigation').clone();
                    $('.primary-navigation').remove();

                    var secondaryNavigation = $('.secondary-navigation').clone();
                    $('.secondary-navigation').remove();
                    var memberNavigation = $('.membership-info-block').clone();
                    $('.membership-info-block').remove();
                    $('#visible-body').before('<div class="mobile-menu"></div>');
                    $('.mobile-menu').prepend(primaryNavigation);
                    $('.mobile-menu').append(secondaryNavigation);
                    $('.mobile-menu').append(memberNavigation);

                    primaryNavigation.find('.main-nav-link:first').css('display', 'none');
                    primaryNavigation.find('.dropdown').css('display', 'none');
                    primaryNavigation.find('.mobile-menu-hide').css('display', 'none');
                    primaryNavigation.find('li i').click(function(e) {
                        var parentListItem = $(this).closest('li');
                        if (parentListItem.find('.dropdown').length > 0) {
                            parentListItem.find('.dropdown').toggle();
                            parentListItem.find('a i').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
                            primaryNavigation.find('ul.dropdown-list i').removeClass('fa-angle-down').removeClass('fa-angle-up').addClass('fa-angle-right');
                            parentListItem.toggleClass('mobile-menu-parent-active');
                            e.preventDefault();
                        }
                        else {
                            e.stopPropagation();
                        }
                    });
                    var mobileMenuOpen = false;
                    $('#visible-body').click(function(e) {
                        if (mobileMenuOpen == true) {
                            mobileMenuMovement(true);
                            e.preventDefault();
                            mobileMenuOpen = false;
                        }
                    });
                    $('.mobile-menu-trigger').click(function(e) {
                        mobileMenuOpen = mobileMenuMovement(mobileMenuOpen);
                        e.stopPropagation();
                        e.preventDefault();
                    });
                },
                off: function() {
                    $('html').removeClass('mobile-menu-open');
                    $('#visible-body').css('left', '0');
                    $('.primary-navigation').css('right', '-265px');
                    $('header.page-header .mobile-menu-trigger').remove();
                    var primaryNavigation = $('.primary-navigation').clone();
                    $('.primary-navigation').remove();
                    $('header.page-header .wrapper .row').prepend(primaryNavigation);
                    primaryNavigation.find('.main-nav-link:first').css('display', 'block');
                    primaryNavigation.find('.dropdown, .mobile-menu-hide').css('display', '');
                    primaryNavigation.find('li').removeClass('mobile-menu-parent-active');
                    primaryNavigation.find('a i').removeClass('fa-angle-right').removeClass('fa-angle-up').addClass('fa-angle-down');
                    $(primaryNavigation).css('display', 'block');
                    var secondaryNavigation = $('.secondary-navigation').clone();
                    $('.secondary-navigation').remove();
                    $('header.page-header .search').before(secondaryNavigation);
                    $('.secondary-navigation').css('display', 'block');
                    var memberNavigation = $('.membership-info-block').clone();
                    $('.membership-info-block').remove();
                    $('.membership .js-added').remove();
                    $('header.page-header .search').before(memberNavigation);
                    $('.membership-info-block').css('display', 'block');
                    $('.mobile-menu').remove();
                    //
                    $('<li><a href="/node/13927">Want to become a member?</a></li>').remove();

                }
            });
        }
    }

    Drupal.behaviors.preventChromeFormAutofillHighlighting = {
        attach: function(context, settings) {
            if ($.browser.webkit) {
                $('input').attr('autocomplete', 'off');
            }
        }
    }

    Drupal.behaviors.menuDropDowns = {
        attach: function(context, settings) {
            Harvey.attach('screen and (min-width:1023px)', {
                on: function() {
                    // Remove .has-hover from menu ul to disable CSS :hover drop-down
                    $('ul.has-hover').removeClass('has-hover');
                    // Add jQuery hover on relevant menu elements
                    $('.primary-navigation ul li').hoverIntent(function() {
                        $(this).siblings().removeClass('hovered');
                        $(this).toggleClass('hovered');
                        // Check if the drop-down fits into the viewport and if not, shift left
                        var dropDownWidth = $(this).find('.dropdown').width();
                        var dropDownX = $(this).find('.dropdown').offset().left;
                        var viewportWidth = $(window).width();
                        if ((dropDownX + dropDownWidth) > viewportWidth) {
                            shiftLeft = (viewportWidth - (dropDownX + dropDownWidth) - 10);
                            $(this).find('.dropdown').css('margin-left', shiftLeft + 'px');
                        }
                        else {
                            $(this).find('.dropdown').css('margin-left', '0');
                        }
                    });
                }
            });
        }
    }

    Drupal.behaviors.backToTopScroll = {
        attach: function(context, settings) {
            function showHideScrollIcon() {
                var scrollTo = $('#top');
                var scrollToPosition = scrollTo.offset().top - $(window).scrollTop();
                if (scrollToPosition < -100) {
                    $('.backtotop').fadeIn();
                }
                else {
                    $('.backtotop').fadeOut();
                }
            }
            showHideScrollIcon();
            $(window, context).scroll(function() {
                showHideScrollIcon();
            });
            $('a[href="#top"]').click(function(e) {
                e.preventDefault();
                $('html, body').stop().animate({
                    'scrollTop': 0
                }, 900, 'swing');
            });
        }
    }

    /* Views exposed filters found in Expert comments and other listings. */
    // In mobile they hide behind a big green button 
    Drupal.behaviors.filterTitle = {
        attach: function(context, settings) {
            $('.view-filters form').hide();

            $('a.show-filters').toggle(function(event) {
                event.preventDefault();
                $('.view .filter-container').addClass('active');
                $('.view .view-filters form').slideDown("fast");
            }, function(event) {
                event.preventDefault();
                $('.view .filter-container').removeClass('active');
                $('.view .view-filters form').slideUp("fast");
            });
        }
    }

    /* Show/hide filters on search results */
    // Drupal.behaviors.filtersOnSearchResults = {
    //   attach: function(context, settings){
    //     if ($('body').hasClass('page-search') && $('.block-facetapi').length > 0) {
    //       $('.block-facetapi').css('display','none');
    //       $('.search-form').append('<div class="filter-container"><h2 class="toggle"><a href="#views-exposed-form-experts-section-index-page" class="show-filters">Show filters</a></h2></div>');
    //       $('a.show-filters').toggle(function(event){
    //         event.preventDefault();
    //         $('.filter-container').addClass('active');
    //         $('.block-facetapi').slideDown("fast");
    //       }, function(event){
    //         event.preventDefault();
    //         $('.filter-container').removeClass('active');
    //         $('.block-facetapi').slideUp("fast");
    //       });
    //     }
    //   }
    // }

    /* Tab behaviours - events */
    Drupal.behaviors.showTabs = {
        attach: function(context, settings) {
            if ($('body').hasClass('node-type-event')) {
                // When logged in, reorder elements so that the correct one is called by UI tabs
                // Usually I'd use the logged-in class but we seem to be lacking it in this build
                if ($('body').hasClass('toolbar')) {
                    $('.view-mode-event_conferences .contextual-links-wrapper').insertAfter('.view-mode-event_conferences .conf-nav');
                }
                $('.view-mode-event_conferences').tabs();
                // Add in previous and next buttons
                var tabs = $('.view-mode-event_conferences').tabs();
                $(".ui-tabs-panel").each(function(i) {
                    $(this).append('<div class="tab-nav" />');
                    var totalSize = $(".ui-tabs-panel").size() - 1;
                    var nextTabID = $(this).parent().next().children('.ui-tabs-panel').attr('id');
                    var prevTabID = $(this).parent().prev().children('.ui-tabs-panel').attr('id');
                    var nextTabTitle = $(this)
                            .parents('.conf-sections')
                            .siblings('.conf-nav')
                            .find('a[href="#' + nextTabID + '"]')
                            .text();
                    var prevTabTitle = $(this)
                            .parents('.conf-sections')
                            .siblings('.conf-nav')
                            .find('a[href="#' + prevTabID + '"]')
                            .text();
                    if (i != totalSize) {
                        next = i + 2;
                        $(this).children('.tab-nav').append("<a href='#' class='next-tab mover' rel='" + next + "'>Next: <span>" + nextTabTitle + "</span></a>");
                    }
                    if (i != 0) {
                        prev = i;
                        $(this).children('.tab-nav').append("<a href='#' class='prev-tab mover' rel='" + prev + "'>Previous: <span>" + prevTabTitle + "</span></a>");
                    }
                });
                //there is no mover class in site atm, need to figure this out if we need to scroll to the tab content
                $('.mover').click(function(e) {
                    $('html, body').animate({
                        scrollTop: $("#node_event_event_conferences_group_event_meta").offset().top
                    }, 1000);
                    if ($(this).attr("rel") == 1) {
                        tabs.tabs('select', 0);
                    } else {
                        tabs.tabs('select', $(this).attr("rel"));
                    }
                    e.preventDefault();
                });
                // commenting this out to make the links in sponsor tabs work.
                // Stop links from jumping to content area
                // $('.view-mode-event_conferences').click(function (e) {
                //   e.preventDefault();
                // });
            }
        }
    }

    /* Awkward to preprocess DS label for some fields/filters, so wrap it
     using JS to service the design */
    Drupal.behaviors.wrapLabel = {
        attach: function(context, settings) {
            $('h2.label').wrap('<div class="label-container"></div>');
        }
    }

    Drupal.behaviors.primeExposedFilterFormsWithTabs = {
        attach: function(context, settings) {
            $('.node-type-section-index .views-exposed-widget').each(function() {
                // Find the specific hidden elements in the exposed form that
                // we need to use to determine which form was submitted. Views
                // GET forms submit automatically when the page loads making the traditional
                // approach impossible to use to determine the source of a submission.

                // TODO - abstract these specific items and relate to order of tabs?
                $(this).find('#views-exposed-form-events-forthcoming--tab')
                        .attr('value', 'fragment-0');
                $(this).find('#views-exposed-form-events-past--tab')
                        .attr('value', 'fragment-1');
            });
        }
    }

    /**
     * Behavior: add Font Awesome classes to login button.
     */
    Drupal.behaviors.membersLoginHasFontAwesome = {
        'attach': function(context, settings) {
            $('.secondary-navigation a[href$="/user"]', context).prepend("<i class='fa fa-user'></i>");
        }
    };

    /**
     * Behavior: remove .dropdown-wide if no upcoming event.
     */
    Drupal.behaviors.noDropdownWideIfNoEvent = {
        'attach': function(context, settings) {
            $('.dropdown-events .dropdown-wide:not(:has(.views-row))', context)
                    .removeClass('dropdown-wide');
        }
    }

    /**
     * Logged in member: remove 'Members login' from secondary menu items
     */
    Drupal.behaviors.membersLoginRemoveIfLoggedIn = {
        attach: function(context, settings) {
            if ($('body').hasClass('logged-in')) {
                $('.block.secondary-navigation li a').each(function() {
                    if ($(this).text() == 'Members login') {
                        $(this).parent('li').remove();
                    }
                });
            }
        }
    }

    /**
     * Behavior: links to external URLs.
     *
     * This cannot be done purely in CSS(3), because:
     * * selectors are domain-sensitive, so won't work when we go live (or on dev)
     * * LESS syntax doesn't support CSS3 attribute selectors within mixins
     * * most importantly, no way of not adding icon to e.g. <a><img></a>.
     */
    Drupal.behaviors.externalLinks = {
        'attach': function(context, settings) {
            // Reasonable set of all hostnames: can pare this down later if need be.
            var hostnames = [
                "chathamhouse.org", "www.chathamhouse.org",
                "chathamhouse-production.torchboxapps.com",
                "chathamhouse-staging.torchboxapps.com",
                "chathamhouse.local"
            ]
            // Get all links with no element children (i.e. no images) but which
            // aren't empty; then filter by external href; then check hostname.
            $('a:not(:has(*)):not(:empty)', context)
                    .filter('*[href^="http://"], *[href^="https://"]')
                    .filter(function(i) {
                        return (hostnames.indexOf(this.hostname) == -1)
                    })
                    // If it all matches, append a Font Awesome external link.
                    .append("<i class='fa fa-external-link'></i>");
            // Specifically add in icon on /in-the-news/listing page to titles.
            $('.page-in-the-news-listing ul.in-the-news.listing li')
                    .children('a:not(:empty)', context)
                    .filter('*[href^="http://"], *[href^="https://"]')
                    .filter(function(i) {
                        return (hostnames.indexOf(this.hostname) == -1)
                    })
                    // If it all matches, append a Font Awesome external link.
                    .find('.title')
                    .append("<i class='fa fa-external-link'></i>");
        }
    }

    /**
     * Behaviour: right sidebar to stick its bottom to the window when reached
     * during scroll
     */
    Drupal.behaviors.rightSidebarSticky = {
        attach: function(context, settings) {
            // Sticky sidebar class
            var stickySidebar = function() {
                // So we can refer to the class.
                var self = this;
                self.sticky = $('#page-content-sidebar-second'); //Cache the sidebar
                // Remove the stickyness
                self.removeSticky = function() {
                    $(self.sticky).removeClass('sticky-right-bar');
                }
                // Make some thing sticky is conditions are right.
                self.makeSticky = function() {
                    // Sticky right-bar after scroll
                    var win = $(window); //Cache the browser window
                    var winHeight = $(win).height(); //Find out the height of above
                    var doc = $(document); //Cache the document the whole HTML page
                    var docHeight = $(doc).height();
                    var initialTop = parseInt($('#page-content-sidebar-second').css('top'));
                    var stickyHeight = $(self.sticky).outerHeight(); // Get the height of the sticky element
                    win.resize(function() {
                        var winHeight = $(win).height(); //Find out the hight of above
                    });
                    // When the window is scrolled...
                    win.scroll(function() {
                        //var stickyBottom = stickyHeight + twitterHeight; // Now we know where the bottom of the sticky element.
                        var stickyBottom = $(self.sticky).outerHeight(true) + initialTop;
                        var stickyHeight = $(self.sticky).outerHeight() + initialTop;
                        var docTop = $(doc).scrollTop();
                        var docBottom = docTop + winHeight;

                        if ((docBottom > stickyBottom) && (winHeight < stickyBottom) && (docHeight > stickyHeight) && doc.width() > 1023) {
                            $(self.sticky).addClass('sticky-right-bar');
                        } else {
                            self.removeSticky();
                        }
                    });
                }
            }
            var stickyRightBar = new stickySidebar();
            Harvey.attach('screen and (min-width:1023px)', {
                on: function() {
                    stickyRightBar.makeSticky();
                },
                off: function() {
                    stickyRightBar.removeSticky();

                }

            });

        }
    }

    /**
     * Logged in member: remove 'Members login' from secondary menu items
     */
    Drupal.behaviors.membersLoginRemoveIfLoggedIn = {
        attach: function(context, settings) {
            if ($('body').hasClass('logged-in')) {
                $('.block.secondary-navigation li a').each(function() {
                    if ($(this).text() == 'Members login') {
                        $(this).parent('li').remove();
                    }
                });
            }
        }
    }

    /**
     * Behavior: Colorbox "embed this image" must be clicked to show embed code.
     */
    Drupal.behaviors.embedThisImage = {
        'attach': function(context, settings) {
            $('.media-colorbox .field', context).each(function(i) {
                var $t = $(this);
                // Hide embed in CSS using this class.
                var embed = $t.find("textarea").addClass("embed-this-image-code");

                // Add classes to labels so they can be CSSed, and
                // add an onclick to show the embed code in a colorbox.
                var label = $t.find('label').addClass("embed-this-image-link");
                label.click(function(ev) {
                    var newEmbed = embed.clone()
                            .click(function(ev) {
                                $(this).select();
                            });
                    // We do need some help text to explain what's going on.
                    var embedWrapper = $('<div class="embed-code-wrapper"></div>')
                            .append($("<h2></h2>").text(label.text()))
                            .append($("<p></p>").text(Drupal.t("Click the text below to highlight it, then copy it by right-clicking and selecting 'Copy'. You can then paste it anywhere else you want to embed it.")))
                            .append(newEmbed)
                            .append($("<p></p>").text(Drupal.t("When you're done, click the close button below to return to the Chatham House website.")));
                    $.colorbox({
                        "width": "600px",
                        "height": "340px",
                        "html": embedWrapper
                    });
                });
            });
        }
    }

    /**
     * Awkward markup and styles obscure the underlying input element;
     * client side click handler on the wrapper delegates a focus event to
     * the input element, which makes the calendar popup appear
     */
    Drupal.behaviors.formDateClickHandler = {
        attach: function(context, settings) {
            $('.views-widget-filter-field_date_publication_value').click(function(e) {
                $(this).find('input.bef-datepicker').focus();
            });
        }
    }

    /**
     * Expert DS view mode does not respect render arrays (eg: #attributes['class'])
     * for single items, so we cannot tell a single event node in field_featured_highlight
     * to have a different class on the wrapper if, for instance, it's a livestream event. Fortunately,
     * we have that class on the node it renders but we'll have to apply it client side to
     * the wrapper element
     */
    Drupal.behaviors.restyleFeaturedLivestreamEvent = {
        attach: function(context, settings) {
            $('.pathalias-events .featured-listing article').each(function(i) {
                if ($(this).children().hasClass('livestream')) {
                    $(this).toggleClass('livestream');
                }
            });
        }
    }

    Drupal.behaviors.restyleFeaturedPublicationTeaser = {
        attach: function(context, settings) {
            $('.node-section-index .featured-listing article').each(function(i) {
                if ($(this).children().hasClass('no-photo')) {
                    $(this).toggleClass('no-photo');
                }
            });
        }
    }

    /* Change the placeholder on the login form. */
    Drupal.behaviors.loginPlaceholder = {
        attach: function(context, settings) {
            if ($('body').hasClass('page-user')) {
                $('#user-login input#edit-name').attr('placeholder', 'Email address');
            }
        }
    }


    // Chatham House's 403 page changes - urgent so done client side
    Drupal.behaviors.http403PageChanges = {
        attach: function(context, settings) {
            $('.page-toboggan-denied #main-title h1').text('User login required');
            $('.page-toboggan-denied #drupal-messages .messages.error h2').hide();
            $('.page-toboggan-denied .page-content-header .breadcrumb').remove();
            // Move block 23 under the login form
            $('.page-toboggan-denied .block-block-23').insertAfter(
                    '.page-toboggan-denied form#user-login'
                    );
        }
    }

    // Convert exposed filters using selects to lists of radio buttons
    Drupal.behaviors.filterUpgradeSelectToRadio = {
        attach: function(context, settings) {
            $('.views-widget').has('select').each(function() {
                $(this).once(function() {
                    var $this = $(this);
                    var $select = $('select', $this);
                    var $options = $('option', $select);
                    var $wrapper = $('<div class="form-radios bef-select-as-radios"></div>').appendTo($this);

                    $options.each(function() {
                        var $option = $(this);
                        $wrapper.append('<div><input class="bef-select-as-radios" type="radio" id="' + $select.attr('id') + '-' + $option.attr('value') + '" name="' + $select.attr('name') + '" value="' + $option.attr('value') + '" autocomplete="off" ' + ($option.attr('selected') ? 'checked="checked"' : '') + '> <label class="option" for="' + $select.attr('id') + '-' + $option.attr('value') + '"">' + $option.html() + '</label></div>')
                    });

                    // hide any child of views-widget which isn't ".bef-select-as-radios"
                    $('> *', $this).not('.bef-select-as-radios').hide();
                })
            });
        }
    }

    // Add the selected radio value to the label of the dropdown
    Drupal.behaviors.filterRadioLabels = {
        attach: function(context, settings) {
            $('.views-widget').each(function() {
                var $this = $(this);
                var $checkedRadio = $('input:checked', $this);
                var $widgetLabel = $this.siblings('label');

                // On load, ensure any checked radio with a proper value is set as the widget label
                if ($checkedRadio.attr('value') && $checkedRadio.attr('value').toLowerCase() != 'all') {
                    $widgetLabel.addClass('active');
                    $widgetLabel.text($checkedRadio.siblings('label').text());
                }

                // On selection of a radio, display the label as the widget label
                $('label', $this).click(function() {
                    $widgetLabel.text($(this).text());
                    jQuery('.active-tab').removeClass('active-tab');
                    console.log($(this).text());
                });

            });
        }
    }

    // Make the filters look less drupal and more interactive. 
    // show & hide them 
    Drupal.behaviors.showHideFilters = {
        attach: function(context, settings) {
            
            //Open filter lists
            $('.views-exposed-widget > label', context).click(function(e) {
                var $this = $(this);
                var active = $this.hasClass('active-tab');
                $('.views-exposed-widget > label').removeClass('active-tab');
                $('.views-widget').removeClass('active-tab');
                console.log('as')
                if (!active) {
                    $this.addClass('active-tab');
                    $this.next().addClass('active-tab');
                    e.stopPropagation();
                    return false;
                }
            });
            $('.block-facetapi', context).click(function(e) {
                var $this = $(this);
                var active = $this.hasClass('active-tab');
                $('.block-facetapi').removeClass('active-tab');
                $('.item-list').removeClass('active-tab');

                if (!active) {
                    $this.addClass('active-tab');
                    $this.find('.item-list').addClass('active-tab');
                    e.stopPropagation();
                    return false;
                }
            });
        }
    }
}(jQuery));
;
