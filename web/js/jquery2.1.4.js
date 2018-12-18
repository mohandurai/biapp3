/*!
 * jQuery JavaScript Library v2.1.4
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2005, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2015-04-28T16:01Z
 */
! function(e, t) {
	"object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
		if (!e.document) throw new Error("jQuery requires a window with a document");
		return t(e)
	} : t(e)
}("undefined" != typeof window ? window : this, function(e, t) {
	function n(e) {
		var t = "length" in e && e.length,
			n = Q.type(e);
		return "function" !== n && !Q.isWindow(e) && (!(1 !== e.nodeType || !t) || ("array" === n || 0 === t || "number" ==
			typeof t && t > 0 && t - 1 in e))
	}

	function r(e, t, n) {
		if (Q.isFunction(t)) return Q.grep(e, function(e, r) {
			return !!t.call(e, r, e) !== n
		});
		if (t.nodeType) return Q.grep(e, function(e) {
			return e === t !== n
		});
		if ("string" == typeof t) {
			if (ae.test(t)) return Q.filter(t, e, n);
			t = Q.filter(t, e)
		}
		return Q.grep(e, function(e) {
			return U.call(t, e) >= 0 !== n
		})
	}

	function i(e, t) {
		for (;
			(e = e[t]) && 1 !== e.nodeType;);
		return e
	}

	function o(e) {
		var t = he[e] = {};
		return Q.each(e.match(pe) || [], function(e, n) {
			t[n] = !0
		}), t
	}

	function s() {
		K.removeEventListener("DOMContentLoaded", s, !1), e.removeEventListener("load", s, !1), Q.ready()
	}

	function a() {
		Object.defineProperty(this.cache = {}, 0, {
			get: function() {
				return {}
			}
		}), this.expando = Q.expando + a.uid++
	}

	function u(e, t, n) {
		var r;
		if (void 0 === n && 1 === e.nodeType)
			if (r = "data-" + t.replace(xe, "-$1").toLowerCase(), n = e.getAttribute(r), "string" == typeof n) {
				try {
					n = "true" === n || "false" !== n && ("null" === n ? null : +n + "" === n ? +n : be.test(n) ? Q.parseJSON(n) : n)
				} catch (i) {}
				ye.set(e, t, n)
			} else n = void 0;
		return n
	}

	function l() {
		return !0
	}

	function c() {
		return !1
	}

	function d() {
		try {
			return K.activeElement
		} catch (e) {}
	}

	function f(e, t) {
		return Q.nodeName(e, "table") && Q.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName(
			"tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
	}

	function p(e) {
		return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
	}

	function h(e) {
		var t = Ie.exec(e.type);
		return t ? e.type = t[1] : e.removeAttribute("type"), e
	}

	function m(e, t) {
		for (var n = 0, r = e.length; n < r; n++) ve.set(e[n], "globalEval", !t || ve.get(t[n], "globalEval"))
	}

	function g(e, t) {
		var n, r, i, o, s, a, u, l;
		if (1 === t.nodeType) {
			if (ve.hasData(e) && (o = ve.access(e), s = ve.set(t, o), l = o.events)) {
				delete s.handle, s.events = {};
				for (i in l)
					for (n = 0, r = l[i].length; n < r; n++) Q.event.add(t, i, l[i][n])
			}
			ye.hasData(e) && (a = ye.access(e), u = Q.extend({}, a), ye.set(t, u))
		}
	}

	function v(e, t) {
		var n = e.getElementsByTagName ? e.getElementsByTagName(t || "*") : e.querySelectorAll ? e.querySelectorAll(t || "*") : [];
		return void 0 === t || t && Q.nodeName(e, t) ? Q.merge([e], n) : n
	}

	function y(e, t) {
		var n = t.nodeName.toLowerCase();
		"input" === n && Te.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
	}

	function b(t, n) {
		var r, i = Q(n.createElement(t)).appendTo(n.body),
			o = e.getDefaultComputedStyle && (r = e.getDefaultComputedStyle(i[0])) ? r.display : Q.css(i[0], "display");
		return i.detach(), o
	}

	function x(e) {
		var t = K,
			n = We[e];
		return n || (n = b(e, t), "none" !== n && n || (Le = (Le || Q("<iframe frameborder='0' width='0' height='0'/>")).appendTo(
			t.documentElement), t = Le[0].contentDocument, t.write(), t.close(), n = b(e, t), Le.detach()), We[e] = n), n
	}

	function w(e, t, n) {
		var r, i, o, s, a = e.style;
		return n = n || Ve(e), n && (s = n.getPropertyValue(t) || n[t]), n && ("" !== s || Q.contains(e.ownerDocument, e) ||
			(s = Q.style(e, t)), Be.test(s) && Ye.test(t) && (r = a.width, i = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth =
				a.width = s, s = n.width, a.width = r, a.minWidth = i, a.maxWidth = o)), void 0 !== s ? s + "" : s
	}

	function D(e, t) {
		return {
			get: function() {
				return e() ? void delete this.get : (this.get = t).apply(this, arguments)
			}
		}
	}

	function S(e, t) {
		if (t in e) return t;
		for (var n = t[0].toUpperCase() + t.slice(1), r = t, i = Je.length; i--;)
			if (t = Je[i] + n, t in e) return t;
		return r
	}

	function T(e, t, n) {
		var r = $e.exec(t);
		return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
	}

	function _(e, t, n, r, i) {
		for (var o = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0, s = 0; o < 4; o += 2) "margin" === n && (
			s += Q.css(e, n + De[o], !0, i)), r ? ("content" === n && (s -= Q.css(e, "padding" + De[o], !0, i)), "margin" !==
			n && (s -= Q.css(e, "border" + De[o] + "Width", !0, i))) : (s += Q.css(e, "padding" + De[o], !0, i), "padding" !==
			n && (s += Q.css(e, "border" + De[o] + "Width", !0, i)));
		return s
	}

	function E(e, t, n) {
		var r = !0,
			i = "width" === t ? e.offsetWidth : e.offsetHeight,
			o = Ve(e),
			s = "border-box" === Q.css(e, "boxSizing", !1, o);
		if (i <= 0 || null == i) {
			if (i = w(e, t, o), (i < 0 || null == i) && (i = e.style[t]), Be.test(i)) return i;
			r = s && (X.boxSizingReliable() || i === e.style[t]), i = parseFloat(i) || 0
		}
		return i + _(e, t, n || (s ? "border" : "content"), r, o) + "px"
	}

	function C(e, t) {
		for (var n, r, i, o = [], s = 0, a = e.length; s < a; s++) r = e[s], r.style && (o[s] = ve.get(r, "olddisplay"), n =
			r.style.display, t ? (o[s] || "none" !== n || (r.style.display = ""), "" === r.style.display && Se(r) && (o[s] =
				ve.access(r, "olddisplay", x(r.nodeName)))) : (i = Se(r), "none" === n && i || ve.set(r, "olddisplay", i ? n : Q.css(
				r, "display"))));
		for (s = 0; s < a; s++) r = e[s], r.style && (t && "none" !== r.style.display && "" !== r.style.display || (r.style.display =
			t ? o[s] || "" : "none"));
		return e
	}

	function k(e, t, n, r, i) {
		return new k.prototype.init(e, t, n, r, i)
	}

	function N() {
		return setTimeout(function() {
			Xe = void 0
		}), Xe = Q.now()
	}

	function O(e, t) {
		var n, r = 0,
			i = {
				height: e
			};
		for (t = t ? 1 : 0; r < 4; r += 2 - t) n = De[r], i["margin" + n] = i["padding" + n] = e;
		return t && (i.opacity = i.width = e), i
	}

	function M(e, t, n) {
		for (var r, i = (nt[t] || []).concat(nt["*"]), o = 0, s = i.length; o < s; o++)
			if (r = i[o].call(n, t, e)) return r
	}

	function A(e, t, n) {
		var r, i, o, s, a, u, l, c, d = this,
			f = {},
			p = e.style,
			h = e.nodeType && Se(e),
			m = ve.get(e, "fxshow");
		n.queue || (a = Q._queueHooks(e, "fx"), null == a.unqueued && (a.unqueued = 0, u = a.empty.fire, a.empty.fire =
			function() {
				a.unqueued || u()
			}), a.unqueued++, d.always(function() {
			d.always(function() {
				a.unqueued--, Q.queue(e, "fx").length || a.empty.fire()
			})
		})), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [p.overflow, p.overflowX, p.overflowY], l =
			Q.css(e, "display"), c = "none" === l ? ve.get(e, "olddisplay") || x(e.nodeName) : l, "inline" === c && "none" ===
			Q.css(e, "float") && (p.display = "inline-block")), n.overflow && (p.overflow = "hidden", d.always(function() {
			p.overflow = n.overflow[0], p.overflowX = n.overflow[1], p.overflowY = n.overflow[2]
		}));
		for (r in t)
			if (i = t[r], Ze.exec(i)) {
				if (delete t[r], o = o || "toggle" === i, i === (h ? "hide" : "show")) {
					if ("show" !== i || !m || void 0 === m[r]) continue;
					h = !0
				}
				f[r] = m && m[r] || Q.style(e, r)
			} else l = void 0;
		if (Q.isEmptyObject(f)) "inline" === ("none" === l ? x(e.nodeName) : l) && (p.display = l);
		else {
			m ? "hidden" in m && (h = m.hidden) : m = ve.access(e, "fxshow", {}), o && (m.hidden = !h), h ? Q(e).show() : d.done(
				function() {
					Q(e).hide()
				}), d.done(function() {
				var t;
				ve.remove(e, "fxshow");
				for (t in f) Q.style(e, t, f[t])
			});
			for (r in f) s = M(h ? m[r] : 0, r, d), r in m || (m[r] = s.start, h && (s.end = s.start, s.start = "width" === r ||
				"height" === r ? 1 : 0))
		}
	}

	function F(e, t) {
		var n, r, i, o, s;
		for (n in e)
			if (r = Q.camelCase(n), i = t[r], o = e[n], Q.isArray(o) && (i = o[1], o = e[n] = o[0]), n !== r && (e[r] = o,
					delete e[n]), s = Q.cssHooks[r], s && "expand" in s) {
				o = s.expand(o), delete e[r];
				for (n in o) n in e || (e[n] = o[n], t[n] = i)
			} else t[r] = i
	}

	function H(e, t, n) {
		var r, i, o = 0,
			s = tt.length,
			a = Q.Deferred().always(function() {
				delete u.elem
			}),
			u = function() {
				if (i) return !1;
				for (var t = Xe || N(), n = Math.max(0, l.startTime + l.duration - t), r = n / l.duration || 0, o = 1 - r, s = 0,
						u = l.tweens.length; s < u; s++) l.tweens[s].run(o);
				return a.notifyWith(e, [l, o, n]), o < 1 && u ? n : (a.resolveWith(e, [l]), !1)
			},
			l = a.promise({
				elem: e,
				props: Q.extend({}, t),
				opts: Q.extend(!0, {
					specialEasing: {}
				}, n),
				originalProperties: t,
				originalOptions: n,
				startTime: Xe || N(),
				duration: n.duration,
				tweens: [],
				createTween: function(t, n) {
					var r = Q.Tween(e, l.opts, t, n, l.opts.specialEasing[t] || l.opts.easing);
					return l.tweens.push(r), r
				},
				stop: function(t) {
					var n = 0,
						r = t ? l.tweens.length : 0;
					if (i) return this;
					for (i = !0; n < r; n++) l.tweens[n].run(1);
					return t ? a.resolveWith(e, [l, t]) : a.rejectWith(e, [l, t]), this
				}
			}),
			c = l.props;
		for (F(c, l.opts.specialEasing); o < s; o++)
			if (r = tt[o].call(l, e, c, l.opts)) return r;
		return Q.map(c, M, l), Q.isFunction(l.opts.start) && l.opts.start.call(e, l), Q.fx.timer(Q.extend(u, {
			elem: e,
			anim: l,
			queue: l.opts.queue
		})), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always)
	}

	function j(e) {
		return function(t, n) {
			"string" != typeof t && (n = t, t = "*");
			var r, i = 0,
				o = t.toLowerCase().match(pe) || [];
			if (Q.isFunction(n))
				for (; r = o[i++];) "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(
					n)
		}
	}

	function I(e, t, n, r) {
		function i(a) {
			var u;
			return o[a] = !0, Q.each(e[a] || [], function(e, a) {
				var l = a(t, n, r);
				return "string" != typeof l || s || o[l] ? s ? !(u = l) : void 0 : (t.dataTypes.unshift(l), i(l), !1)
			}), u
		}
		var o = {},
			s = e === bt;
		return i(t.dataTypes[0]) || !o["*"] && i("*")
	}

	function P(e, t) {
		var n, r, i = Q.ajaxSettings.flatOptions || {};
		for (n in t) void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
		return r && Q.extend(!0, e, r), e
	}

	function R(e, t, n) {
		for (var r, i, o, s, a = e.contents, u = e.dataTypes;
			"*" === u[0];) u.shift(), void 0 === r && (r = e.mimeType || t.getResponseHeader("Content-Type"));
		if (r)
			for (i in a)
				if (a[i] && a[i].test(r)) {
					u.unshift(i);
					break
				}
		if (u[0] in n) o = u[0];
		else {
			for (i in n) {
				if (!u[0] || e.converters[i + " " + u[0]]) {
					o = i;
					break
				}
				s || (s = i)
			}
			o = o || s
		}
		if (o) return o !== u[0] && u.unshift(o), n[o]
	}

	function L(e, t, n, r) {
		var i, o, s, a, u, l = {},
			c = e.dataTypes.slice();
		if (c[1])
			for (s in e.converters) l[s.toLowerCase()] = e.converters[s];
		for (o = c.shift(); o;)
			if (e.responseFields[o] && (n[e.responseFields[o]] = t), !u && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)),
				u = o, o = c.shift())
				if ("*" === o) o = u;
				else if ("*" !== u && u !== o) {
			if (s = l[u + " " + o] || l["* " + o], !s)
				for (i in l)
					if (a = i.split(" "), a[1] === o && (s = l[u + " " + a[0]] || l["* " + a[0]])) {
						s === !0 ? s = l[i] : l[i] !== !0 && (o = a[0], c.unshift(a[1]));
						break
					}
			if (s !== !0)
				if (s && e["throws"]) t = s(t);
				else try {
					t = s(t)
				} catch (d) {
					return {
						state: "parsererror",
						error: s ? d : "No conversion from " + u + " to " + o
					}
				}
		}
		return {
			state: "success",
			data: t
		}
	}

	function W(e, t, n, r) {
		var i;
		if (Q.isArray(t)) Q.each(t, function(t, i) {
			n || Tt.test(e) ? r(e, i) : W(e + "[" + ("object" == typeof i ? t : "") + "]", i, n, r)
		});
		else if (n || "object" !== Q.type(t)) r(e, t);
		else
			for (i in t) W(e + "[" + i + "]", t[i], n, r)
	}

	function Y(e) {
		return Q.isWindow(e) ? e : 9 === e.nodeType && e.defaultView
	}
	var B = [],
		V = B.slice,
		q = B.concat,
		$ = B.push,
		U = B.indexOf,
		z = {},
		G = z.toString,
		J = z.hasOwnProperty,
		X = {},
		K = e.document,
		Z = "2.1.4",
		Q = function(e, t) {
			return new Q.fn.init(e, t)
		},
		ee = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
		te = /^-ms-/,
		ne = /-([\da-z])/gi,
		re = function(e, t) {
			return t.toUpperCase()
		};
	Q.fn = Q.prototype = {
		jquery: Z,
		constructor: Q,
		selector: "",
		length: 0,
		toArray: function() {
			return V.call(this)
		},
		get: function(e) {
			return null != e ? e < 0 ? this[e + this.length] : this[e] : V.call(this)
		},
		pushStack: function(e) {
			var t = Q.merge(this.constructor(), e);
			return t.prevObject = this, t.context = this.context, t
		},
		each: function(e, t) {
			return Q.each(this, e, t)
		},
		map: function(e) {
			return this.pushStack(Q.map(this, function(t, n) {
				return e.call(t, n, t)
			}))
		},
		slice: function() {
			return this.pushStack(V.apply(this, arguments))
		},
		first: function() {
			return this.eq(0)
		},
		last: function() {
			return this.eq(-1)
		},
		eq: function(e) {
			var t = this.length,
				n = +e + (e < 0 ? t : 0);
			return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
		},
		end: function() {
			return this.prevObject || this.constructor(null)
		},
		push: $,
		sort: B.sort,
		splice: B.splice
	}, Q.extend = Q.fn.extend = function() {
		var e, t, n, r, i, o, s = arguments[0] || {},
			a = 1,
			u = arguments.length,
			l = !1;
		for ("boolean" == typeof s && (l = s, s = arguments[a] || {}, a++), "object" == typeof s || Q.isFunction(s) || (s = {}),
			a === u && (s = this, a--); a < u; a++)
			if (null != (e = arguments[a]))
				for (t in e) n = s[t], r = e[t], s !== r && (l && r && (Q.isPlainObject(r) || (i = Q.isArray(r))) ? (i ? (i = !1,
						o = n && Q.isArray(n) ? n : []) : o = n && Q.isPlainObject(n) ? n : {}, s[t] = Q.extend(l, o, r)) : void 0 !==
					r && (s[t] = r));
		return s
	}, Q.extend({
		expando: "jQuery" + (Z + Math.random()).replace(/\D/g, ""),
		isReady: !0,
		error: function(e) {
			throw new Error(e)
		},
		noop: function() {},
		isFunction: function(e) {
			return "function" === Q.type(e)
		},
		isArray: Array.isArray,
		isWindow: function(e) {
			return null != e && e === e.window
		},
		isNumeric: function(e) {
			return !Q.isArray(e) && e - parseFloat(e) + 1 >= 0
		},
		isPlainObject: function(e) {
			return "object" === Q.type(e) && !e.nodeType && !Q.isWindow(e) && !(e.constructor && !J.call(e.constructor.prototype,
				"isPrototypeOf"))
		},
		isEmptyObject: function(e) {
			var t;
			for (t in e) return !1;
			return !0
		},
		type: function(e) {
			return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? z[G.call(e)] || "object" : typeof e
		},
		globalEval: function(e) {
			var t, n = eval;
			e = Q.trim(e), e && (1 === e.indexOf("use strict") ? (t = K.createElement("script"), t.text = e, K.head.appendChild(
				t).parentNode.removeChild(t)) : n(e))
		},
		camelCase: function(e) {
			return e.replace(te, "ms-").replace(ne, re)
		},
		nodeName: function(e, t) {
			return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
		},
		each: function(e, t, r) {
			var i, o = 0,
				s = e.length,
				a = n(e);
			if (r) {
				if (a)
					for (; o < s && (i = t.apply(e[o], r), i !== !1); o++);
				else
					for (o in e)
						if (i = t.apply(e[o], r), i === !1) break
			} else if (a)
				for (; o < s && (i = t.call(e[o], o, e[o]), i !== !1); o++);
			else
				for (o in e)
					if (i = t.call(e[o], o, e[o]), i === !1) break;
			return e
		},
		trim: function(e) {
			return null == e ? "" : (e + "").replace(ee, "")
		},
		makeArray: function(e, t) {
			var r = t || [];
			return null != e && (n(Object(e)) ? Q.merge(r, "string" == typeof e ? [e] : e) : $.call(r, e)), r
		},
		inArray: function(e, t, n) {
			return null == t ? -1 : U.call(t, e, n)
		},
		merge: function(e, t) {
			for (var n = +t.length, r = 0, i = e.length; r < n; r++) e[i++] = t[r];
			return e.length = i, e
		},
		grep: function(e, t, n) {
			for (var r, i = [], o = 0, s = e.length, a = !n; o < s; o++) r = !t(e[o], o), r !== a && i.push(e[o]);
			return i
		},
		map: function(e, t, r) {
			var i, o = 0,
				s = e.length,
				a = n(e),
				u = [];
			if (a)
				for (; o < s; o++) i = t(e[o], o, r), null != i && u.push(i);
			else
				for (o in e) i = t(e[o], o, r), null != i && u.push(i);
			return q.apply([], u)
		},
		guid: 1,
		proxy: function(e, t) {
			var n, r, i;
			if ("string" == typeof t && (n = e[t], t = e, e = n), Q.isFunction(e)) return r = V.call(arguments, 2), i =
				function() {
					return e.apply(t || this, r.concat(V.call(arguments)))
				}, i.guid = e.guid = e.guid || Q.guid++, i
		},
		now: Date.now,
		support: X
	}), Q.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(e, t) {
		z["[object " + t + "]"] = t.toLowerCase()
	});
	var ie =
		/*!
		 * Sizzle CSS Selector Engine v2.2.0-pre
		 * http://sizzlejs.com/
		 *
		 * Copyright 2008, 2014 jQuery Foundation, Inc. and other contributors
		 * Released under the MIT license
		 * http://jquery.org/license
		 *
		 * Date: 2014-12-16
		 */
		function(e) {
			function t(e, t, n, r) {
				var i, o, s, a, u, l, d, p, h, m;
				if ((t ? t.ownerDocument || t : W) !== A && M(t), t = t || A, n = n || [], a = t.nodeType, "string" != typeof e ||
					!e || 1 !== a && 9 !== a && 11 !== a) return n;
				if (!r && H) {
					if (11 !== a && (i = ye.exec(e)))
						if (s = i[1]) {
							if (9 === a) {
								if (o = t.getElementById(s), !o || !o.parentNode) return n;
								if (o.id === s) return n.push(o), n
							} else if (t.ownerDocument && (o = t.ownerDocument.getElementById(s)) && R(t, o) && o.id === s) return n.push(o),
								n
						} else {
							if (i[2]) return Z.apply(n, t.getElementsByTagName(e)), n;
							if ((s = i[3]) && w.getElementsByClassName) return Z.apply(n, t.getElementsByClassName(s)), n
						}
					if (w.qsa && (!j || !j.test(e))) {
						if (p = d = L, h = t, m = 1 !== a && e, 1 === a && "object" !== t.nodeName.toLowerCase()) {
							for (l = _(e), (d = t.getAttribute("id")) ? p = d.replace(xe, "\\$&") : t.setAttribute("id", p), p = "[id='" +
								p + "'] ", u = l.length; u--;) l[u] = p + f(l[u]);
							h = be.test(e) && c(t.parentNode) || t, m = l.join(",")
						}
						if (m) try {
							return Z.apply(n, h.querySelectorAll(m)), n
						} catch (g) {} finally {
							d || t.removeAttribute("id")
						}
					}
				}
				return C(e.replace(ue, "$1"), t, n, r)
			}

			function n() {
				function e(n, r) {
					return t.push(n + " ") > D.cacheLength && delete e[t.shift()], e[n + " "] = r
				}
				var t = [];
				return e
			}

			function r(e) {
				return e[L] = !0, e
			}

			function i(e) {
				var t = A.createElement("div");
				try {
					return !!e(t)
				} catch (n) {
					return !1
				} finally {
					t.parentNode && t.parentNode.removeChild(t), t = null
				}
			}

			function o(e, t) {
				for (var n = e.split("|"), r = e.length; r--;) D.attrHandle[n[r]] = t
			}

			function s(e, t) {
				var n = t && e,
					r = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || z) - (~e.sourceIndex || z);
				if (r) return r;
				if (n)
					for (; n = n.nextSibling;)
						if (n === t) return -1;
				return e ? 1 : -1
			}

			function a(e) {
				return function(t) {
					var n = t.nodeName.toLowerCase();
					return "input" === n && t.type === e
				}
			}

			function u(e) {
				return function(t) {
					var n = t.nodeName.toLowerCase();
					return ("input" === n || "button" === n) && t.type === e
				}
			}

			function l(e) {
				return r(function(t) {
					return t = +t, r(function(n, r) {
						for (var i, o = e([], n.length, t), s = o.length; s--;) n[i = o[s]] && (n[i] = !(r[i] = n[i]))
					})
				})
			}

			function c(e) {
				return e && "undefined" != typeof e.getElementsByTagName && e
			}

			function d() {}

			function f(e) {
				for (var t = 0, n = e.length, r = ""; t < n; t++) r += e[t].value;
				return r
			}

			function p(e, t, n) {
				var r = t.dir,
					i = n && "parentNode" === r,
					o = B++;
				return t.first ? function(t, n, o) {
					for (; t = t[r];)
						if (1 === t.nodeType || i) return e(t, n, o)
				} : function(t, n, s) {
					var a, u, l = [Y, o];
					if (s) {
						for (; t = t[r];)
							if ((1 === t.nodeType || i) && e(t, n, s)) return !0
					} else
						for (; t = t[r];)
							if (1 === t.nodeType || i) {
								if (u = t[L] || (t[L] = {}), (a = u[r]) && a[0] === Y && a[1] === o) return l[2] = a[2];
								if (u[r] = l, l[2] = e(t, n, s)) return !0
							}
				}
			}

			function h(e) {
				return e.length > 1 ? function(t, n, r) {
					for (var i = e.length; i--;)
						if (!e[i](t, n, r)) return !1;
					return !0
				} : e[0]
			}

			function m(e, n, r) {
				for (var i = 0, o = n.length; i < o; i++) t(e, n[i], r);
				return r
			}

			function g(e, t, n, r, i) {
				for (var o, s = [], a = 0, u = e.length, l = null != t; a < u; a++)(o = e[a]) && (n && !n(o, r, i) || (s.push(o),
					l && t.push(a)));
				return s
			}

			function v(e, t, n, i, o, s) {
				return i && !i[L] && (i = v(i)), o && !o[L] && (o = v(o, s)), r(function(r, s, a, u) {
					var l, c, d, f = [],
						p = [],
						h = s.length,
						v = r || m(t || "*", a.nodeType ? [a] : a, []),
						y = !e || !r && t ? v : g(v, f, e, a, u),
						b = n ? o || (r ? e : h || i) ? [] : s : y;
					if (n && n(y, b, a, u), i)
						for (l = g(b, p), i(l, [], a, u), c = l.length; c--;)(d = l[c]) && (b[p[c]] = !(y[p[c]] = d));
					if (r) {
						if (o || e) {
							if (o) {
								for (l = [], c = b.length; c--;)(d = b[c]) && l.push(y[c] = d);
								o(null, b = [], l, u)
							}
							for (c = b.length; c--;)(d = b[c]) && (l = o ? ee(r, d) : f[c]) > -1 && (r[l] = !(s[l] = d))
						}
					} else b = g(b === s ? b.splice(h, b.length) : b), o ? o(null, s, b, u) : Z.apply(s, b)
				})
			}

			function y(e) {
				for (var t, n, r, i = e.length, o = D.relative[e[0].type], s = o || D.relative[" "], a = o ? 1 : 0, u = p(function(
						e) {
						return e === t
					}, s, !0), l = p(function(e) {
						return ee(t, e) > -1
					}, s, !0), c = [function(e, n, r) {
						var i = !o && (r || n !== k) || ((t = n).nodeType ? u(e, n, r) : l(e, n, r));
						return t = null, i
					}]; a < i; a++)
					if (n = D.relative[e[a].type]) c = [p(h(c), n)];
					else {
						if (n = D.filter[e[a].type].apply(null, e[a].matches), n[L]) {
							for (r = ++a; r < i && !D.relative[e[r].type]; r++);
							return v(a > 1 && h(c), a > 1 && f(e.slice(0, a - 1).concat({
								value: " " === e[a - 2].type ? "*" : ""
							})).replace(ue, "$1"), n, a < r && y(e.slice(a, r)), r < i && y(e = e.slice(r)), r < i && f(e))
						}
						c.push(n)
					}
				return h(c)
			}

			function b(e, n) {
				var i = n.length > 0,
					o = e.length > 0,
					s = function(r, s, a, u, l) {
						var c, d, f, p = 0,
							h = "0",
							m = r && [],
							v = [],
							y = k,
							b = r || o && D.find.TAG("*", l),
							x = Y += null == y ? 1 : Math.random() || .1,
							w = b.length;
						for (l && (k = s !== A && s); h !== w && null != (c = b[h]); h++) {
							if (o && c) {
								for (d = 0; f = e[d++];)
									if (f(c, s, a)) {
										u.push(c);
										break
									}
								l && (Y = x)
							}
							i && ((c = !f && c) && p--, r && m.push(c))
						}
						if (p += h, i && h !== p) {
							for (d = 0; f = n[d++];) f(m, v, s, a);
							if (r) {
								if (p > 0)
									for (; h--;) m[h] || v[h] || (v[h] = X.call(u));
								v = g(v)
							}
							Z.apply(u, v), l && !r && v.length > 0 && p + n.length > 1 && t.uniqueSort(u)
						}
						return l && (Y = x, k = y), m
					};
				return i ? r(s) : s
			}
			var x, w, D, S, T, _, E, C, k, N, O, M, A, F, H, j, I, P, R, L = "sizzle" + 1 * new Date,
				W = e.document,
				Y = 0,
				B = 0,
				V = n(),
				q = n(),
				$ = n(),
				U = function(e, t) {
					return e === t && (O = !0), 0
				},
				z = 1 << 31,
				G = {}.hasOwnProperty,
				J = [],
				X = J.pop,
				K = J.push,
				Z = J.push,
				Q = J.slice,
				ee = function(e, t) {
					for (var n = 0, r = e.length; n < r; n++)
						if (e[n] === t) return n;
					return -1
				},
				te =
				"checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
				ne = "[\\x20\\t\\r\\n\\f]",
				re = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
				ie = re.replace("w", "w#"),
				oe = "\\[" + ne + "*(" + re + ")(?:" + ne + "*([*^$|!~]?=)" + ne +
				"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + ie + "))|)" + ne + "*\\]",
				se = ":(" + re + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + oe +
				")*)|.*)\\)|)",
				ae = new RegExp(ne + "+", "g"),
				ue = new RegExp("^" + ne + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ne + "+$", "g"),
				le = new RegExp("^" + ne + "*," + ne + "*"),
				ce = new RegExp("^" + ne + "*([>+~]|" + ne + ")" + ne + "*"),
				de = new RegExp("=" + ne + "*([^\\]'\"]*?)" + ne + "*\\]", "g"),
				fe = new RegExp(se),
				pe = new RegExp("^" + ie + "$"),
				he = {
					ID: new RegExp("^#(" + re + ")"),
					CLASS: new RegExp("^\\.(" + re + ")"),
					TAG: new RegExp("^(" + re.replace("w", "w*") + ")"),
					ATTR: new RegExp("^" + oe),
					PSEUDO: new RegExp("^" + se),
					CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ne + "*(even|odd|(([+-]|)(\\d*)n|)" +
						ne + "*(?:([+-]|)" + ne + "*(\\d+)|))" + ne + "*\\)|)", "i"),
					bool: new RegExp("^(?:" + te + ")$", "i"),
					needsContext: new RegExp("^" + ne + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ne + "*((?:-\\d)?\\d*)" +
						ne + "*\\)|)(?=[^-]|$)", "i")
				},
				me = /^(?:input|select|textarea|button)$/i,
				ge = /^h\d$/i,
				ve = /^[^{]+\{\s*\[native \w/,
				ye = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
				be = /[+~]/,
				xe = /'|\\/g,
				we = new RegExp("\\\\([\\da-f]{1,6}" + ne + "?|(" + ne + ")|.)", "ig"),
				De = function(e, t, n) {
					var r = "0x" + t - 65536;
					return r !== r || n ? t : r < 0 ? String.fromCharCode(r + 65536) : String.fromCharCode(r >> 10 | 55296, 1023 & r |
						56320)
				},
				Se = function() {
					M()
				};
			try {
				Z.apply(J = Q.call(W.childNodes), W.childNodes), J[W.childNodes.length].nodeType
			} catch (Te) {
				Z = {
					apply: J.length ? function(e, t) {
						K.apply(e, Q.call(t))
					} : function(e, t) {
						for (var n = e.length, r = 0; e[n++] = t[r++];);
						e.length = n - 1
					}
				}
			}
			w = t.support = {}, T = t.isXML = function(e) {
				var t = e && (e.ownerDocument || e).documentElement;
				return !!t && "HTML" !== t.nodeName
			}, M = t.setDocument = function(e) {
				var t, n, r = e ? e.ownerDocument || e : W;
				return r !== A && 9 === r.nodeType && r.documentElement ? (A = r, F = r.documentElement, n = r.defaultView, n &&
					n !== n.top && (n.addEventListener ? n.addEventListener("unload", Se, !1) : n.attachEvent && n.attachEvent(
						"onunload", Se)), H = !T(r), w.attributes = i(function(e) {
						return e.className = "i", !e.getAttribute("className")
					}), w.getElementsByTagName = i(function(e) {
						return e.appendChild(r.createComment("")), !e.getElementsByTagName("*").length
					}), w.getElementsByClassName = ve.test(r.getElementsByClassName), w.getById = i(function(e) {
						return F.appendChild(e).id = L, !r.getElementsByName || !r.getElementsByName(L).length
					}), w.getById ? (D.find.ID = function(e, t) {
						if ("undefined" != typeof t.getElementById && H) {
							var n = t.getElementById(e);
							return n && n.parentNode ? [n] : []
						}
					}, D.filter.ID = function(e) {
						var t = e.replace(we, De);
						return function(e) {
							return e.getAttribute("id") === t
						}
					}) : (delete D.find.ID, D.filter.ID = function(e) {
						var t = e.replace(we, De);
						return function(e) {
							var n = "undefined" != typeof e.getAttributeNode && e.getAttributeNode("id");
							return n && n.value === t
						}
					}), D.find.TAG = w.getElementsByTagName ? function(e, t) {
						return "undefined" != typeof t.getElementsByTagName ? t.getElementsByTagName(e) : w.qsa ? t.querySelectorAll(e) :
							void 0
					} : function(e, t) {
						var n, r = [],
							i = 0,
							o = t.getElementsByTagName(e);
						if ("*" === e) {
							for (; n = o[i++];) 1 === n.nodeType && r.push(n);
							return r
						}
						return o
					}, D.find.CLASS = w.getElementsByClassName && function(e, t) {
						if (H) return t.getElementsByClassName(e)
					}, I = [], j = [], (w.qsa = ve.test(r.querySelectorAll)) && (i(function(e) {
						F.appendChild(e).innerHTML = "<a id='" + L + "'></a><select id='" + L +
							"-\f]' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']")
							.length && j.push("[*^$]=" + ne + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || j.push("\\[" +
								ne + "*(?:value|" + te + ")"), e.querySelectorAll("[id~=" + L + "-]").length || j.push("~="), e.querySelectorAll(
								":checked").length || j.push(":checked"), e.querySelectorAll("a#" + L + "+*").length || j.push(".#.+[+~]")
					}), i(function(e) {
						var t = r.createElement("input");
						t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]")
							.length && j.push("name" + ne + "*[*^$|!~]?="), e.querySelectorAll(":enabled").length || j.push(":enabled",
								":disabled"), e.querySelectorAll("*,:x"), j.push(",.*:")
					})), (w.matchesSelector = ve.test(P = F.matches || F.webkitMatchesSelector || F.mozMatchesSelector || F.oMatchesSelector ||
						F.msMatchesSelector)) && i(function(e) {
						w.disconnectedMatch = P.call(e, "div"), P.call(e, "[s!='']:x"), I.push("!=", se)
					}), j = j.length && new RegExp(j.join("|")), I = I.length && new RegExp(I.join("|")), t = ve.test(F.compareDocumentPosition),
					R = t || ve.test(F.contains) ? function(e, t) {
						var n = 9 === e.nodeType ? e.documentElement : e,
							r = t && t.parentNode;
						return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 &
							e.compareDocumentPosition(r)))
					} : function(e, t) {
						if (t)
							for (; t = t.parentNode;)
								if (t === e) return !0;
						return !1
					}, U = t ? function(e, t) {
						if (e === t) return O = !0, 0;
						var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
						return n ? n : (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 &
							n || !w.sortDetached && t.compareDocumentPosition(e) === n ? e === r || e.ownerDocument === W && R(W, e) ? -
							1 : t === r || t.ownerDocument === W && R(W, t) ? 1 : N ? ee(N, e) - ee(N, t) : 0 : 4 & n ? -1 : 1)
					} : function(e, t) {
						if (e === t) return O = !0, 0;
						var n, i = 0,
							o = e.parentNode,
							a = t.parentNode,
							u = [e],
							l = [t];
						if (!o || !a) return e === r ? -1 : t === r ? 1 : o ? -1 : a ? 1 : N ? ee(N, e) - ee(N, t) : 0;
						if (o === a) return s(e, t);
						for (n = e; n = n.parentNode;) u.unshift(n);
						for (n = t; n = n.parentNode;) l.unshift(n);
						for (; u[i] === l[i];) i++;
						return i ? s(u[i], l[i]) : u[i] === W ? -1 : l[i] === W ? 1 : 0
					}, r) : A
			}, t.matches = function(e, n) {
				return t(e, null, null, n)
			}, t.matchesSelector = function(e, n) {
				if ((e.ownerDocument || e) !== A && M(e), n = n.replace(de, "='$1']"), w.matchesSelector && H && (!I || !I.test(n)) &&
					(!j || !j.test(n))) try {
					var r = P.call(e, n);
					if (r || w.disconnectedMatch || e.document && 11 !== e.document.nodeType) return r
				} catch (i) {}
				return t(n, A, null, [e]).length > 0
			}, t.contains = function(e, t) {
				return (e.ownerDocument || e) !== A && M(e), R(e, t)
			}, t.attr = function(e, t) {
				(e.ownerDocument || e) !== A && M(e);
				var n = D.attrHandle[t.toLowerCase()],
					r = n && G.call(D.attrHandle, t.toLowerCase()) ? n(e, t, !H) : void 0;
				return void 0 !== r ? r : w.attributes || !H ? e.getAttribute(t) : (r = e.getAttributeNode(t)) && r.specified ? r
					.value : null
			}, t.error = function(e) {
				throw new Error("Syntax error, unrecognized expression: " + e)
			}, t.uniqueSort = function(e) {
				var t, n = [],
					r = 0,
					i = 0;
				if (O = !w.detectDuplicates, N = !w.sortStable && e.slice(0), e.sort(U), O) {
					for (; t = e[i++];) t === e[i] && (r = n.push(i));
					for (; r--;) e.splice(n[r], 1)
				}
				return N = null, e
			}, S = t.getText = function(e) {
				var t, n = "",
					r = 0,
					i = e.nodeType;
				if (i) {
					if (1 === i || 9 === i || 11 === i) {
						if ("string" == typeof e.textContent) return e.textContent;
						for (e = e.firstChild; e; e = e.nextSibling) n += S(e)
					} else if (3 === i || 4 === i) return e.nodeValue
				} else
					for (; t = e[r++];) n += S(t);
				return n
			}, D = t.selectors = {
				cacheLength: 50,
				createPseudo: r,
				match: he,
				attrHandle: {},
				find: {},
				relative: {
					">": {
						dir: "parentNode",
						first: !0
					},
					" ": {
						dir: "parentNode"
					},
					"+": {
						dir: "previousSibling",
						first: !0
					},
					"~": {
						dir: "previousSibling"
					}
				},
				preFilter: {
					ATTR: function(e) {
						return e[1] = e[1].replace(we, De), e[3] = (e[3] || e[4] || e[5] || "").replace(we, De), "~=" === e[2] && (e[3] =
							" " + e[3] + " "), e.slice(0, 4)
					},
					CHILD: function(e) {
						return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] +
								(e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t
							.error(e[0]), e
					},
					PSEUDO: function(e) {
						var t, n = !e[6] && e[2];
						return he.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && fe.test(n) && (t = _(n, !0)) && (
							t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0,
							3))
					}
				},
				filter: {
					TAG: function(e) {
						var t = e.replace(we, De).toLowerCase();
						return "*" === e ? function() {
							return !0
						} : function(e) {
							return e.nodeName && e.nodeName.toLowerCase() === t
						}
					},
					CLASS: function(e) {
						var t = V[e + " "];
						return t || (t = new RegExp("(^|" + ne + ")" + e + "(" + ne + "|$)")) && V(e, function(e) {
							return t.test("string" == typeof e.className && e.className || "undefined" != typeof e.getAttribute && e.getAttribute(
								"class") || "")
						})
					},
					ATTR: function(e, n, r) {
						return function(i) {
							var o = t.attr(i, e);
							return null == o ? "!=" === n : !n || (o += "", "=" === n ? o === r : "!=" === n ? o !== r : "^=" === n ? r &&
								0 === o.indexOf(r) : "*=" === n ? r && o.indexOf(r) > -1 : "$=" === n ? r && o.slice(-r.length) === r :
								"~=" === n ? (" " + o.replace(ae, " ") + " ").indexOf(r) > -1 : "|=" === n && (o === r || o.slice(0, r.length +
									1) === r + "-"))
						}
					},
					CHILD: function(e, t, n, r, i) {
						var o = "nth" !== e.slice(0, 3),
							s = "last" !== e.slice(-4),
							a = "of-type" === t;
						return 1 === r && 0 === i ? function(e) {
							return !!e.parentNode
						} : function(t, n, u) {
							var l, c, d, f, p, h, m = o !== s ? "nextSibling" : "previousSibling",
								g = t.parentNode,
								v = a && t.nodeName.toLowerCase(),
								y = !u && !a;
							if (g) {
								if (o) {
									for (; m;) {
										for (d = t; d = d[m];)
											if (a ? d.nodeName.toLowerCase() === v : 1 === d.nodeType) return !1;
										h = m = "only" === e && !h && "nextSibling"
									}
									return !0
								}
								if (h = [s ? g.firstChild : g.lastChild], s && y) {
									for (c = g[L] || (g[L] = {}), l = c[e] || [], p = l[0] === Y && l[1], f = l[0] === Y && l[2], d = p && g.childNodes[
											p]; d = ++p && d && d[m] || (f = p = 0) || h.pop();)
										if (1 === d.nodeType && ++f && d === t) {
											c[e] = [Y, p, f];
											break
										}
								} else if (y && (l = (t[L] || (t[L] = {}))[e]) && l[0] === Y) f = l[1];
								else
									for (;
										(d = ++p && d && d[m] || (f = p = 0) || h.pop()) && ((a ? d.nodeName.toLowerCase() !== v : 1 !== d.nodeType) ||
											!++f || (y && ((d[L] || (d[L] = {}))[e] = [Y, f]), d !== t)););
								return f -= i, f === r || f % r === 0 && f / r >= 0
							}
						}
					},
					PSEUDO: function(e, n) {
						var i, o = D.pseudos[e] || D.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
						return o[L] ? o(n) : o.length > 1 ? (i = [e, e, "", n], D.setFilters.hasOwnProperty(e.toLowerCase()) ? r(
							function(e, t) {
								for (var r, i = o(e, n), s = i.length; s--;) r = ee(e, i[s]), e[r] = !(t[r] = i[s])
							}) : function(e) {
							return o(e, 0, i)
						}) : o
					}
				},
				pseudos: {
					not: r(function(e) {
						var t = [],
							n = [],
							i = E(e.replace(ue, "$1"));
						return i[L] ? r(function(e, t, n, r) {
							for (var o, s = i(e, null, r, []), a = e.length; a--;)(o = s[a]) && (e[a] = !(t[a] = o))
						}) : function(e, r, o) {
							return t[0] = e, i(t, null, o, n), t[0] = null, !n.pop()
						}
					}),
					has: r(function(e) {
						return function(n) {
							return t(e, n).length > 0
						}
					}),
					contains: r(function(e) {
						return e = e.replace(we, De),
							function(t) {
								return (t.textContent || t.innerText || S(t)).indexOf(e) > -1
							}
					}),
					lang: r(function(e) {
						return pe.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(we, De).toLowerCase(),
							function(t) {
								var n;
								do
									if (n = H ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return n = n.toLowerCase(), n ===
										e || 0 === n.indexOf(e + "-"); while ((t = t.parentNode) && 1 === t.nodeType);
								return !1
							}
					}),
					target: function(t) {
						var n = e.location && e.location.hash;
						return n && n.slice(1) === t.id
					},
					root: function(e) {
						return e === F
					},
					focus: function(e) {
						return e === A.activeElement && (!A.hasFocus || A.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
					},
					enabled: function(e) {
						return e.disabled === !1
					},
					disabled: function(e) {
						return e.disabled === !0
					},
					checked: function(e) {
						var t = e.nodeName.toLowerCase();
						return "input" === t && !!e.checked || "option" === t && !!e.selected
					},
					selected: function(e) {
						return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
					},
					empty: function(e) {
						for (e = e.firstChild; e; e = e.nextSibling)
							if (e.nodeType < 6) return !1;
						return !0
					},
					parent: function(e) {
						return !D.pseudos.empty(e)
					},
					header: function(e) {
						return ge.test(e.nodeName)
					},
					input: function(e) {
						return me.test(e.nodeName)
					},
					button: function(e) {
						var t = e.nodeName.toLowerCase();
						return "input" === t && "button" === e.type || "button" === t
					},
					text: function(e) {
						var t;
						return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) ||
							"text" === t.toLowerCase())
					},
					first: l(function() {
						return [0]
					}),
					last: l(function(e, t) {
						return [t - 1]
					}),
					eq: l(function(e, t, n) {
						return [n < 0 ? n + t : n]
					}),
					even: l(function(e, t) {
						for (var n = 0; n < t; n += 2) e.push(n);
						return e
					}),
					odd: l(function(e, t) {
						for (var n = 1; n < t; n += 2) e.push(n);
						return e
					}),
					lt: l(function(e, t, n) {
						for (var r = n < 0 ? n + t : n; --r >= 0;) e.push(r);
						return e
					}),
					gt: l(function(e, t, n) {
						for (var r = n < 0 ? n + t : n; ++r < t;) e.push(r);
						return e
					})
				}
			}, D.pseudos.nth = D.pseudos.eq;
			for (x in {
					radio: !0,
					checkbox: !0,
					file: !0,
					password: !0,
					image: !0
				}) D.pseudos[x] = a(x);
			for (x in {
					submit: !0,
					reset: !0
				}) D.pseudos[x] = u(x);
			return d.prototype = D.filters = D.pseudos, D.setFilters = new d, _ = t.tokenize = function(e, n) {
				var r, i, o, s, a, u, l, c = q[e + " "];
				if (c) return n ? 0 : c.slice(0);
				for (a = e, u = [], l = D.preFilter; a;) {
					r && !(i = le.exec(a)) || (i && (a = a.slice(i[0].length) || a), u.push(o = [])), r = !1, (i = ce.exec(a)) && (r =
						i.shift(), o.push({
							value: r,
							type: i[0].replace(ue, " ")
						}), a = a.slice(r.length));
					for (s in D.filter) !(i = he[s].exec(a)) || l[s] && !(i = l[s](i)) || (r = i.shift(), o.push({
						value: r,
						type: s,
						matches: i
					}), a = a.slice(r.length));
					if (!r) break
				}
				return n ? a.length : a ? t.error(e) : q(e, u).slice(0)
			}, E = t.compile = function(e, t) {
				var n, r = [],
					i = [],
					o = $[e + " "];
				if (!o) {
					for (t || (t = _(e)), n = t.length; n--;) o = y(t[n]), o[L] ? r.push(o) : i.push(o);
					o = $(e, b(i, r)), o.selector = e
				}
				return o
			}, C = t.select = function(e, t, n, r) {
				var i, o, s, a, u, l = "function" == typeof e && e,
					d = !r && _(e = l.selector || e);
				if (n = n || [], 1 === d.length) {
					if (o = d[0] = d[0].slice(0), o.length > 2 && "ID" === (s = o[0]).type && w.getById && 9 === t.nodeType && H &&
						D.relative[o[1].type]) {
						if (t = (D.find.ID(s.matches[0].replace(we, De), t) || [])[0], !t) return n;
						l && (t = t.parentNode), e = e.slice(o.shift().value.length)
					}
					for (i = he.needsContext.test(e) ? 0 : o.length; i-- && (s = o[i], !D.relative[a = s.type]);)
						if ((u = D.find[a]) && (r = u(s.matches[0].replace(we, De), be.test(o[0].type) && c(t.parentNode) || t))) {
							if (o.splice(i, 1), e = r.length && f(o), !e) return Z.apply(n, r), n;
							break
						}
				}
				return (l || E(e, d))(r, t, !H, n, be.test(e) && c(t.parentNode) || t), n
			}, w.sortStable = L.split("").sort(U).join("") === L, w.detectDuplicates = !!O, M(), w.sortDetached = i(function(e) {
				return 1 & e.compareDocumentPosition(A.createElement("div"))
			}), i(function(e) {
				return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
			}) || o("type|href|height|width", function(e, t, n) {
				if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
			}), w.attributes && i(function(e) {
				return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute(
					"value")
			}) || o("value", function(e, t, n) {
				if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
			}), i(function(e) {
				return null == e.getAttribute("disabled")
			}) || o(te, function(e, t, n) {
				var r;
				if (!n) return e[t] === !0 ? t.toLowerCase() : (r = e.getAttributeNode(t)) && r.specified ? r.value : null
			}), t
		}(e);
	Q.find = ie, Q.expr = ie.selectors, Q.expr[":"] = Q.expr.pseudos, Q.unique = ie.uniqueSort, Q.text = ie.getText, Q.isXMLDoc =
		ie.isXML, Q.contains = ie.contains;
	var oe = Q.expr.match.needsContext,
		se = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
		ae = /^.[^:#\[\.,]*$/;
	Q.filter = function(e, t, n) {
		var r = t[0];
		return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === r.nodeType ? Q.find.matchesSelector(r, e) ? [r] : [] :
			Q.find.matches(e, Q.grep(t, function(e) {
				return 1 === e.nodeType
			}))
	}, Q.fn.extend({
		find: function(e) {
			var t, n = this.length,
				r = [],
				i = this;
			if ("string" != typeof e) return this.pushStack(Q(e).filter(function() {
				for (t = 0; t < n; t++)
					if (Q.contains(i[t], this)) return !0
			}));
			for (t = 0; t < n; t++) Q.find(e, i[t], r);
			return r = this.pushStack(n > 1 ? Q.unique(r) : r), r.selector = this.selector ? this.selector + " " + e : e, r
		},
		filter: function(e) {
			return this.pushStack(r(this, e || [], !1))
		},
		not: function(e) {
			return this.pushStack(r(this, e || [], !0))
		},
		is: function(e) {
			return !!r(this, "string" == typeof e && oe.test(e) ? Q(e) : e || [], !1).length
		}
	});
	var ue, le = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
		ce = Q.fn.init = function(e, t) {
			var n, r;
			if (!e) return this;
			if ("string" == typeof e) {
				if (n = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : le.exec(e), !n || !n[1] && t)
					return !t || t.jquery ? (t || ue).find(e) : this.constructor(t).find(e);
				if (n[1]) {
					if (t = t instanceof Q ? t[0] : t, Q.merge(this, Q.parseHTML(n[1], t && t.nodeType ? t.ownerDocument || t : K, !0)),
						se.test(n[1]) && Q.isPlainObject(t))
						for (n in t) Q.isFunction(this[n]) ? this[n](t[n]) : this.attr(n, t[n]);
					return this
				}
				return r = K.getElementById(n[2]), r && r.parentNode && (this.length = 1, this[0] = r), this.context = K, this.selector =
					e, this
			}
			return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : Q.isFunction(e) ? "undefined" != typeof ue
				.ready ? ue.ready(e) : e(Q) : (void 0 !== e.selector && (this.selector = e.selector, this.context = e.context), Q.makeArray(
					e, this))
		};
	ce.prototype = Q.fn, ue = Q(K);
	var de = /^(?:parents|prev(?:Until|All))/,
		fe = {
			children: !0,
			contents: !0,
			next: !0,
			prev: !0
		};
	Q.extend({
		dir: function(e, t, n) {
			for (var r = [], i = void 0 !== n;
				(e = e[t]) && 9 !== e.nodeType;)
				if (1 === e.nodeType) {
					if (i && Q(e).is(n)) break;
					r.push(e)
				}
			return r
		},
		sibling: function(e, t) {
			for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
			return n
		}
	}), Q.fn.extend({
		has: function(e) {
			var t = Q(e, this),
				n = t.length;
			return this.filter(function() {
				for (var e = 0; e < n; e++)
					if (Q.contains(this, t[e])) return !0
			})
		},
		closest: function(e, t) {
			for (var n, r = 0, i = this.length, o = [], s = oe.test(e) || "string" != typeof e ? Q(e, t || this.context) : 0; r <
				i; r++)
				for (n = this[r]; n && n !== t; n = n.parentNode)
					if (n.nodeType < 11 && (s ? s.index(n) > -1 : 1 === n.nodeType && Q.find.matchesSelector(n, e))) {
						o.push(n);
						break
					}
			return this.pushStack(o.length > 1 ? Q.unique(o) : o)
		},
		index: function(e) {
			return e ? "string" == typeof e ? U.call(Q(e), this[0]) : U.call(this, e.jquery ? e[0] : e) : this[0] && this[0]
				.parentNode ? this.first().prevAll().length : -1
		},
		add: function(e, t) {
			return this.pushStack(Q.unique(Q.merge(this.get(), Q(e, t))))
		},
		addBack: function(e) {
			return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
		}
	}), Q.each({
		parent: function(e) {
			var t = e.parentNode;
			return t && 11 !== t.nodeType ? t : null
		},
		parents: function(e) {
			return Q.dir(e, "parentNode")
		},
		parentsUntil: function(e, t, n) {
			return Q.dir(e, "parentNode", n)
		},
		next: function(e) {
			return i(e, "nextSibling")
		},
		prev: function(e) {
			return i(e, "previousSibling")
		},
		nextAll: function(e) {
			return Q.dir(e, "nextSibling")
		},
		prevAll: function(e) {
			return Q.dir(e, "previousSibling")
		},
		nextUntil: function(e, t, n) {
			return Q.dir(e, "nextSibling", n)
		},
		prevUntil: function(e, t, n) {
			return Q.dir(e, "previousSibling", n)
		},
		siblings: function(e) {
			return Q.sibling((e.parentNode || {}).firstChild, e)
		},
		children: function(e) {
			return Q.sibling(e.firstChild)
		},
		contents: function(e) {
			return e.contentDocument || Q.merge([], e.childNodes)
		}
	}, function(e, t) {
		Q.fn[e] = function(n, r) {
			var i = Q.map(this, t, n);
			return "Until" !== e.slice(-5) && (r = n), r && "string" == typeof r && (i = Q.filter(r, i)), this.length > 1 &&
				(fe[e] || Q.unique(i), de.test(e) && i.reverse()), this.pushStack(i)
		}
	});
	var pe = /\S+/g,
		he = {};
	Q.Callbacks = function(e) {
		e = "string" == typeof e ? he[e] || o(e) : Q.extend({}, e);
		var t, n, r, i, s, a, u = [],
			l = !e.once && [],
			c = function(o) {
				for (t = e.memory && o, n = !0, a = i || 0, i = 0, s = u.length, r = !0; u && a < s; a++)
					if (u[a].apply(o[0], o[1]) === !1 && e.stopOnFalse) {
						t = !1;
						break
					}
				r = !1, u && (l ? l.length && c(l.shift()) : t ? u = [] : d.disable())
			},
			d = {
				add: function() {
					if (u) {
						var n = u.length;
						! function o(t) {
							Q.each(t, function(t, n) {
								var r = Q.type(n);
								"function" === r ? e.unique && d.has(n) || u.push(n) : n && n.length && "string" !== r && o(n)
							})
						}(arguments), r ? s = u.length : t && (i = n, c(t))
					}
					return this
				},
				remove: function() {
					return u && Q.each(arguments, function(e, t) {
						for (var n;
							(n = Q.inArray(t, u, n)) > -1;) u.splice(n, 1), r && (n <= s && s--, n <= a && a--)
					}), this
				},
				has: function(e) {
					return e ? Q.inArray(e, u) > -1 : !(!u || !u.length)
				},
				empty: function() {
					return u = [], s = 0, this
				},
				disable: function() {
					return u = l = t = void 0, this
				},
				disabled: function() {
					return !u
				},
				lock: function() {
					return l = void 0, t || d.disable(), this
				},
				locked: function() {
					return !l
				},
				fireWith: function(e, t) {
					return !u || n && !l || (t = t || [], t = [e, t.slice ? t.slice() : t], r ? l.push(t) : c(t)), this
				},
				fire: function() {
					return d.fireWith(this, arguments), this
				},
				fired: function() {
					return !!n
				}
			};
		return d
	}, Q.extend({
		Deferred: function(e) {
			var t = [
					["resolve", "done", Q.Callbacks("once memory"), "resolved"],
					["reject", "fail", Q.Callbacks("once memory"), "rejected"],
					["notify", "progress", Q.Callbacks("memory")]
				],
				n = "pending",
				r = {
					state: function() {
						return n
					},
					always: function() {
						return i.done(arguments).fail(arguments), this
					},
					then: function() {
						var e = arguments;
						return Q.Deferred(function(n) {
							Q.each(t, function(t, o) {
								var s = Q.isFunction(e[t]) && e[t];
								i[o[1]](function() {
									var e = s && s.apply(this, arguments);
									e && Q.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[o[
										0] + "With"](this === r ? n.promise() : this, s ? [e] : arguments)
								})
							}), e = null
						}).promise()
					},
					promise: function(e) {
						return null != e ? Q.extend(e, r) : r
					}
				},
				i = {};
			return r.pipe = r.then, Q.each(t, function(e, o) {
				var s = o[2],
					a = o[3];
				r[o[1]] = s.add, a && s.add(function() {
					n = a
				}, t[1 ^ e][2].disable, t[2][2].lock), i[o[0]] = function() {
					return i[o[0] + "With"](this === i ? r : this, arguments), this
				}, i[o[0] + "With"] = s.fireWith
			}), r.promise(i), e && e.call(i, i), i
		},
		when: function(e) {
			var t, n, r, i = 0,
				o = V.call(arguments),
				s = o.length,
				a = 1 !== s || e && Q.isFunction(e.promise) ? s : 0,
				u = 1 === a ? e : Q.Deferred(),
				l = function(e, n, r) {
					return function(i) {
						n[e] = this, r[e] = arguments.length > 1 ? V.call(arguments) : i, r === t ? u.notifyWith(n, r) : --a || u.resolveWith(
							n, r)
					}
				};
			if (s > 1)
				for (t = new Array(s), n = new Array(s), r = new Array(s); i < s; i++) o[i] && Q.isFunction(o[i].promise) ? o[i]
					.promise().done(l(i, r, o)).fail(u.reject).progress(l(i, n, t)) : --a;
			return a || u.resolveWith(r, o), u.promise()
		}
	});
	var me;
	Q.fn.ready = function(e) {
		return Q.ready.promise().done(e), this
	}, Q.extend({
		isReady: !1,
		readyWait: 1,
		holdReady: function(e) {
			e ? Q.readyWait++ : Q.ready(!0)
		},
		ready: function(e) {
			(e === !0 ? --Q.readyWait : Q.isReady) || (Q.isReady = !0, e !== !0 && --Q.readyWait > 0 || (me.resolveWith(K, [
				Q
			]), Q.fn.triggerHandler && (Q(K).triggerHandler("ready"), Q(K).off("ready"))))
		}
	}), Q.ready.promise = function(t) {
		return me || (me = Q.Deferred(), "complete" === K.readyState ? setTimeout(Q.ready) : (K.addEventListener(
			"DOMContentLoaded", s, !1), e.addEventListener("load", s, !1))), me.promise(t)
	}, Q.ready.promise();
	var ge = Q.access = function(e, t, n, r, i, o, s) {
		var a = 0,
			u = e.length,
			l = null == n;
		if ("object" === Q.type(n)) {
			i = !0;
			for (a in n) Q.access(e, t, a, n[a], !0, o, s)
		} else if (void 0 !== r && (i = !0, Q.isFunction(r) || (s = !0), l && (s ? (t.call(e, r), t = null) : (l = t, t =
				function(e, t, n) {
					return l.call(Q(e), n)
				})), t))
			for (; a < u; a++) t(e[a], n, s ? r : r.call(e[a], a, t(e[a], n)));
		return i ? e : l ? t.call(e) : u ? t(e[0], n) : o
	};
	Q.acceptData = function(e) {
		return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
	}, a.uid = 1, a.accepts = Q.acceptData, a.prototype = {
		key: function(e) {
			if (!a.accepts(e)) return 0;
			var t = {},
				n = e[this.expando];
			if (!n) {
				n = a.uid++;
				try {
					t[this.expando] = {
						value: n
					}, Object.defineProperties(e, t)
				} catch (r) {
					t[this.expando] = n, Q.extend(e, t)
				}
			}
			return this.cache[n] || (this.cache[n] = {}), n
		},
		set: function(e, t, n) {
			var r, i = this.key(e),
				o = this.cache[i];
			if ("string" == typeof t) o[t] = n;
			else if (Q.isEmptyObject(o)) Q.extend(this.cache[i], t);
			else
				for (r in t) o[r] = t[r];
			return o
		},
		get: function(e, t) {
			var n = this.cache[this.key(e)];
			return void 0 === t ? n : n[t]
		},
		access: function(e, t, n) {
			var r;
			return void 0 === t || t && "string" == typeof t && void 0 === n ? (r = this.get(e, t), void 0 !== r ? r : this.get(
				e, Q.camelCase(t))) : (this.set(e, t, n), void 0 !== n ? n : t)
		},
		remove: function(e, t) {
			var n, r, i, o = this.key(e),
				s = this.cache[o];
			if (void 0 === t) this.cache[o] = {};
			else {
				Q.isArray(t) ? r = t.concat(t.map(Q.camelCase)) : (i = Q.camelCase(t), t in s ? r = [t, i] : (r = i, r = r in s ? [
					r
				] : r.match(pe) || [])), n = r.length;
				for (; n--;) delete s[r[n]]
			}
		},
		hasData: function(e) {
			return !Q.isEmptyObject(this.cache[e[this.expando]] || {})
		},
		discard: function(e) {
			e[this.expando] && delete this.cache[e[this.expando]]
		}
	};
	var ve = new a,
		ye = new a,
		be = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
		xe = /([A-Z])/g;
	Q.extend({
		hasData: function(e) {
			return ye.hasData(e) || ve.hasData(e)
		},
		data: function(e, t, n) {
			return ye.access(e, t, n)
		},
		removeData: function(e, t) {
			ye.remove(e, t)
		},
		_data: function(e, t, n) {
			return ve.access(e, t, n)
		},
		_removeData: function(e, t) {
			ve.remove(e, t)
		}
	}), Q.fn.extend({
		data: function(e, t) {
			var n, r, i, o = this[0],
				s = o && o.attributes;
			if (void 0 === e) {
				if (this.length && (i = ye.get(o), 1 === o.nodeType && !ve.get(o, "hasDataAttrs"))) {
					for (n = s.length; n--;) s[n] && (r = s[n].name, 0 === r.indexOf("data-") && (r = Q.camelCase(r.slice(5)), u(o,
						r, i[r])));
					ve.set(o, "hasDataAttrs", !0)
				}
				return i
			}
			return "object" == typeof e ? this.each(function() {
				ye.set(this, e)
			}) : ge(this, function(t) {
				var n, r = Q.camelCase(e);
				if (o && void 0 === t) {
					if (n = ye.get(o, e), void 0 !== n) return n;
					if (n = ye.get(o, r), void 0 !== n) return n;
					if (n = u(o, r, void 0), void 0 !== n) return n
				} else this.each(function() {
					var n = ye.get(this, r);
					ye.set(this, r, t), e.indexOf("-") !== -1 && void 0 !== n && ye.set(this, e, t)
				})
			}, null, t, arguments.length > 1, null, !0)
		},
		removeData: function(e) {
			return this.each(function() {
				ye.remove(this, e)
			})
		}
	}), Q.extend({
		queue: function(e, t, n) {
			var r;
			if (e) return t = (t || "fx") + "queue", r = ve.get(e, t), n && (!r || Q.isArray(n) ? r = ve.access(e, t, Q.makeArray(
				n)) : r.push(n)), r || []
		},
		dequeue: function(e, t) {
			t = t || "fx";
			var n = Q.queue(e, t),
				r = n.length,
				i = n.shift(),
				o = Q._queueHooks(e, t),
				s = function() {
					Q.dequeue(e, t)
				};
			"inprogress" === i && (i = n.shift(), r--), i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e,
				s, o)), !r && o && o.empty.fire()
		},
		_queueHooks: function(e, t) {
			var n = t + "queueHooks";
			return ve.get(e, n) || ve.access(e, n, {
				empty: Q.Callbacks("once memory").add(function() {
					ve.remove(e, [t + "queue", n])
				})
			})
		}
	}), Q.fn.extend({
		queue: function(e, t) {
			var n = 2;
			return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? Q.queue(this[0], e) : void 0 === t ?
				this : this.each(function() {
					var n = Q.queue(this, e, t);
					Q._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && Q.dequeue(this, e)
				})
		},
		dequeue: function(e) {
			return this.each(function() {
				Q.dequeue(this, e)
			})
		},
		clearQueue: function(e) {
			return this.queue(e || "fx", [])
		},
		promise: function(e, t) {
			var n, r = 1,
				i = Q.Deferred(),
				o = this,
				s = this.length,
				a = function() {
					--r || i.resolveWith(o, [o])
				};
			for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;) n = ve.get(o[s], e + "queueHooks"), n &&
				n.empty && (r++, n.empty.add(a));
			return a(), i.promise(t)
		}
	});
	var we = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
		De = ["Top", "Right", "Bottom", "Left"],
		Se = function(e, t) {
			return e = t || e, "none" === Q.css(e, "display") || !Q.contains(e.ownerDocument, e)
		},
		Te = /^(?:checkbox|radio)$/i;
	! function() {
		var e = K.createDocumentFragment(),
			t = e.appendChild(K.createElement("div")),
			n = K.createElement("input");
		n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n),
			X.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", X.noCloneChecked = !
			!t.cloneNode(!0).lastChild.defaultValue
	}();
	var _e = "undefined";
	X.focusinBubbles = "onfocusin" in e;
	var Ee = /^key/,
		Ce = /^(?:mouse|pointer|contextmenu)|click/,
		ke = /^(?:focusinfocus|focusoutblur)$/,
		Ne = /^([^.]*)(?:\.(.+)|)$/;
	Q.event = {
		global: {},
		add: function(e, t, n, r, i) {
			var o, s, a, u, l, c, d, f, p, h, m, g = ve.get(e);
			if (g)
				for (n.handler && (o = n, n = o.handler, i = o.selector), n.guid || (n.guid = Q.guid++), (u = g.events) || (u =
						g.events = {}), (s = g.handle) || (s = g.handle = function(t) {
						return typeof Q !== _e && Q.event.triggered !== t.type ? Q.event.dispatch.apply(e, arguments) : void 0
					}), t = (t || "").match(pe) || [""], l = t.length; l--;) a = Ne.exec(t[l]) || [], p = m = a[1], h = (a[2] || "")
					.split(".").sort(), p && (d = Q.event.special[p] || {}, p = (i ? d.delegateType : d.bindType) || p, d = Q.event
						.special[p] || {}, c = Q.extend({
							type: p,
							origType: m,
							data: r,
							handler: n,
							guid: n.guid,
							selector: i,
							needsContext: i && Q.expr.match.needsContext.test(i),
							namespace: h.join(".")
						}, o), (f = u[p]) || (f = u[p] = [], f.delegateCount = 0, d.setup && d.setup.call(e, r, h, s) !== !1 || e.addEventListener &&
							e.addEventListener(p, s, !1)), d.add && (d.add.call(e, c), c.handler.guid || (c.handler.guid = n.guid)), i ?
						f.splice(f.delegateCount++, 0, c) : f.push(c), Q.event.global[p] = !0)
		},
		remove: function(e, t, n, r, i) {
			var o, s, a, u, l, c, d, f, p, h, m, g = ve.hasData(e) && ve.get(e);
			if (g && (u = g.events)) {
				for (t = (t || "").match(pe) || [""], l = t.length; l--;)
					if (a = Ne.exec(t[l]) || [], p = m = a[1], h = (a[2] || "").split(".").sort(), p) {
						for (d = Q.event.special[p] || {}, p = (r ? d.delegateType : d.bindType) || p, f = u[p] || [], a = a[2] && new RegExp(
								"(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = o = f.length; o--;) c = f[o], !i && m !== c.origType ||
							n && n.guid !== c.guid || a && !a.test(c.namespace) || r && r !== c.selector && ("**" !== r || !c.selector) ||
							(f.splice(o, 1), c.selector && f.delegateCount--, d.remove && d.remove.call(e, c));
						s && !f.length && (d.teardown && d.teardown.call(e, h, g.handle) !== !1 || Q.removeEvent(e, p, g.handle),
							delete u[p])
					} else
						for (p in u) Q.event.remove(e, p + t[l], n, r, !0);
				Q.isEmptyObject(u) && (delete g.handle, ve.remove(e, "events"))
			}
		},
		trigger: function(t, n, r, i) {
			var o, s, a, u, l, c, d, f = [r || K],
				p = J.call(t, "type") ? t.type : t,
				h = J.call(t, "namespace") ? t.namespace.split(".") : [];
			if (s = a = r = r || K, 3 !== r.nodeType && 8 !== r.nodeType && !ke.test(p + Q.event.triggered) && (p.indexOf(".") >=
					0 && (h = p.split("."), p = h.shift(), h.sort()), l = p.indexOf(":") < 0 && "on" + p, t = t[Q.expando] ? t :
					new Q.Event(p, "object" == typeof t && t), t.isTrigger = i ? 2 : 3, t.namespace = h.join("."), t.namespace_re =
					t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target ||
					(t.target = r), n = null == n ? [t] : Q.makeArray(n, [t]), d = Q.event.special[p] || {}, i || !d.trigger || d.trigger
					.apply(r, n) !== !1)) {
				if (!i && !d.noBubble && !Q.isWindow(r)) {
					for (u = d.delegateType || p, ke.test(u + p) || (s = s.parentNode); s; s = s.parentNode) f.push(s), a = s;
					a === (r.ownerDocument || K) && f.push(a.defaultView || a.parentWindow || e)
				}
				for (o = 0;
					(s = f[o++]) && !t.isPropagationStopped();) t.type = o > 1 ? u : d.bindType || p, c = (ve.get(s, "events") || {})[
					t.type] && ve.get(s, "handle"), c && c.apply(s, n), c = l && s[l], c && c.apply && Q.acceptData(s) && (t.result =
					c.apply(s, n), t.result === !1 && t.preventDefault());
				return t.type = p, i || t.isDefaultPrevented() || d._default && d._default.apply(f.pop(), n) !== !1 || !Q.acceptData(
					r) || l && Q.isFunction(r[p]) && !Q.isWindow(r) && (a = r[l], a && (r[l] = null), Q.event.triggered = p, r[p](),
					Q.event.triggered = void 0, a && (r[l] = a)), t.result
			}
		},
		dispatch: function(e) {
			e = Q.event.fix(e);
			var t, n, r, i, o, s = [],
				a = V.call(arguments),
				u = (ve.get(this, "events") || {})[e.type] || [],
				l = Q.event.special[e.type] || {};
			if (a[0] = e, e.delegateTarget = this, !l.preDispatch || l.preDispatch.call(this, e) !== !1) {
				for (s = Q.event.handlers.call(this, e, u), t = 0;
					(i = s[t++]) && !e.isPropagationStopped();)
					for (e.currentTarget = i.elem, n = 0;
						(o = i.handlers[n++]) && !e.isImmediatePropagationStopped();) e.namespace_re && !e.namespace_re.test(o.namespace) ||
						(e.handleObj = o, e.data = o.data, r = ((Q.event.special[o.origType] || {}).handle || o.handler).apply(i.elem,
							a), void 0 !== r && (e.result = r) === !1 && (e.preventDefault(), e.stopPropagation()));
				return l.postDispatch && l.postDispatch.call(this, e), e.result
			}
		},
		handlers: function(e, t) {
			var n, r, i, o, s = [],
				a = t.delegateCount,
				u = e.target;
			if (a && u.nodeType && (!e.button || "click" !== e.type))
				for (; u !== this; u = u.parentNode || this)
					if (u.disabled !== !0 || "click" !== e.type) {
						for (r = [], n = 0; n < a; n++) o = t[n], i = o.selector + " ", void 0 === r[i] && (r[i] = o.needsContext ? Q(
							i, this).index(u) >= 0 : Q.find(i, this, null, [u]).length), r[i] && r.push(o);
						r.length && s.push({
							elem: u,
							handlers: r
						})
					}
			return a < t.length && s.push({
				elem: this,
				handlers: t.slice(a)
			}), s
		},
		props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which"
			.split(" "),
		fixHooks: {},
		keyHooks: {
			props: "char charCode key keyCode".split(" "),
			filter: function(e, t) {
				return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e
			}
		},
		mouseHooks: {
			props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
			filter: function(e, t) {
				var n, r, i, o = t.button;
				return null == e.pageX && null != t.clientX && (n = e.target.ownerDocument || K, r = n.documentElement, i = n.body,
					e.pageX = t.clientX + (r && r.scrollLeft || i && i.scrollLeft || 0) - (r && r.clientLeft || i && i.clientLeft ||
						0), e.pageY = t.clientY + (r && r.scrollTop || i && i.scrollTop || 0) - (r && r.clientTop || i && i.clientTop ||
						0)), e.which || void 0 === o || (e.which = 1 & o ? 1 : 2 & o ? 3 : 4 & o ? 2 : 0), e
			}
		},
		fix: function(e) {
			if (e[Q.expando]) return e;
			var t, n, r, i = e.type,
				o = e,
				s = this.fixHooks[i];
			for (s || (this.fixHooks[i] = s = Ce.test(i) ? this.mouseHooks : Ee.test(i) ? this.keyHooks : {}), r = s.props ?
				this.props.concat(s.props) : this.props, e = new Q.Event(o), t = r.length; t--;) n = r[t], e[n] = o[n];
			return e.target || (e.target = K), 3 === e.target.nodeType && (e.target = e.target.parentNode), s.filter ? s.filter(
				e, o) : e
		},
		special: {
			load: {
				noBubble: !0
			},
			focus: {
				trigger: function() {
					if (this !== d() && this.focus) return this.focus(), !1
				},
				delegateType: "focusin"
			},
			blur: {
				trigger: function() {
					if (this === d() && this.blur) return this.blur(), !1
				},
				delegateType: "focusout"
			},
			click: {
				trigger: function() {
					if ("checkbox" === this.type && this.click && Q.nodeName(this, "input")) return this.click(), !1
				},
				_default: function(e) {
					return Q.nodeName(e.target, "a")
				}
			},
			beforeunload: {
				postDispatch: function(e) {
					void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
				}
			}
		},
		simulate: function(e, t, n, r) {
			var i = Q.extend(new Q.Event, n, {
				type: e,
				isSimulated: !0,
				originalEvent: {}
			});
			r ? Q.event.trigger(i, null, t) : Q.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault()
		}
	}, Q.removeEvent = function(e, t, n) {
		e.removeEventListener && e.removeEventListener(t, n, !1)
	}, Q.Event = function(e, t) {
		return this instanceof Q.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented =
			e.defaultPrevented || void 0 === e.defaultPrevented && e.returnValue === !1 ? l : c) : this.type = e, t && Q.extend(
			this, t), this.timeStamp = e && e.timeStamp || Q.now(), void(this[Q.expando] = !0)) : new Q.Event(e, t)
	}, Q.Event.prototype = {
		isDefaultPrevented: c,
		isPropagationStopped: c,
		isImmediatePropagationStopped: c,
		preventDefault: function() {
			var e = this.originalEvent;
			this.isDefaultPrevented = l, e && e.preventDefault && e.preventDefault()
		},
		stopPropagation: function() {
			var e = this.originalEvent;
			this.isPropagationStopped = l, e && e.stopPropagation && e.stopPropagation()
		},
		stopImmediatePropagation: function() {
			var e = this.originalEvent;
			this.isImmediatePropagationStopped = l, e && e.stopImmediatePropagation && e.stopImmediatePropagation(), this.stopPropagation()
		}
	}, Q.each({
		mouseenter: "mouseover",
		mouseleave: "mouseout",
		pointerenter: "pointerover",
		pointerleave: "pointerout"
	}, function(e, t) {
		Q.event.special[e] = {
			delegateType: t,
			bindType: t,
			handle: function(e) {
				var n, r = this,
					i = e.relatedTarget,
					o = e.handleObj;
				return i && (i === r || Q.contains(r, i)) || (e.type = o.origType, n = o.handler.apply(this, arguments), e.type =
					t), n
			}
		}
	}), X.focusinBubbles || Q.each({
		focus: "focusin",
		blur: "focusout"
	}, function(e, t) {
		var n = function(e) {
			Q.event.simulate(t, e.target, Q.event.fix(e), !0)
		};
		Q.event.special[t] = {
			setup: function() {
				var r = this.ownerDocument || this,
					i = ve.access(r, t);
				i || r.addEventListener(e, n, !0), ve.access(r, t, (i || 0) + 1)
			},
			teardown: function() {
				var r = this.ownerDocument || this,
					i = ve.access(r, t) - 1;
				i ? ve.access(r, t, i) : (r.removeEventListener(e, n, !0), ve.remove(r, t))
			}
		}
	}), Q.fn.extend({
		on: function(e, t, n, r, i) {
			var o, s;
			if ("object" == typeof e) {
				"string" != typeof t && (n = n || t, t = void 0);
				for (s in e) this.on(s, t, n, e[s], i);
				return this
			}
			if (null == n && null == r ? (r = t, n = t = void 0) : null == r && ("string" == typeof t ? (r = n, n = void 0) :
					(r = n, n = t, t = void 0)), r === !1) r = c;
			else if (!r) return this;
			return 1 === i && (o = r, r = function(e) {
				return Q().off(e), o.apply(this, arguments)
			}, r.guid = o.guid || (o.guid = Q.guid++)), this.each(function() {
				Q.event.add(this, e, r, n, t)
			})
		},
		one: function(e, t, n, r) {
			return this.on(e, t, n, r, 1)
		},
		off: function(e, t, n) {
			var r, i;
			if (e && e.preventDefault && e.handleObj) return r = e.handleObj, Q(e.delegateTarget).off(r.namespace ? r.origType +
				"." + r.namespace : r.origType, r.selector, r.handler), this;
			if ("object" == typeof e) {
				for (i in e) this.off(i, t, e[i]);
				return this
			}
			return t !== !1 && "function" != typeof t || (n = t, t = void 0), n === !1 && (n = c), this.each(function() {
				Q.event.remove(this, e, n, t)
			})
		},
		trigger: function(e, t) {
			return this.each(function() {
				Q.event.trigger(e, t, this)
			})
		},
		triggerHandler: function(e, t) {
			var n = this[0];
			if (n) return Q.event.trigger(e, t, n, !0)
		}
	});
	var Oe = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
		Me = /<([\w:]+)/,
		Ae = /<|&#?\w+;/,
		Fe = /<(?:script|style|link)/i,
		He = /checked\s*(?:[^=]|=\s*.checked.)/i,
		je = /^$|\/(?:java|ecma)script/i,
		Ie = /^true\/(.*)/,
		Pe = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
		Re = {
			option: [1, "<select multiple='multiple'>", "</select>"],
			thead: [1, "<table>", "</table>"],
			col: [2, "<table><colgroup>", "</colgroup></table>"],
			tr: [2, "<table><tbody>", "</tbody></table>"],
			td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
			_default: [0, "", ""]
		};
	Re.optgroup = Re.option, Re.tbody = Re.tfoot = Re.colgroup = Re.caption = Re.thead, Re.th = Re.td, Q.extend({
		clone: function(e, t, n) {
			var r, i, o, s, a = e.cloneNode(!0),
				u = Q.contains(e.ownerDocument, e);
			if (!(X.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || Q.isXMLDoc(e)))
				for (s = v(a), o = v(e), r = 0, i = o.length; r < i; r++) y(o[r], s[r]);
			if (t)
				if (n)
					for (o = o || v(e), s = s || v(a), r = 0, i = o.length; r < i; r++) g(o[r], s[r]);
				else g(e, a);
			return s = v(a, "script"), s.length > 0 && m(s, !u && v(e, "script")), a
		},
		buildFragment: function(e, t, n, r) {
			for (var i, o, s, a, u, l, c = t.createDocumentFragment(), d = [], f = 0, p = e.length; f < p; f++)
				if (i = e[f], i || 0 === i)
					if ("object" === Q.type(i)) Q.merge(d, i.nodeType ? [i] : i);
					else if (Ae.test(i)) {
				for (o = o || c.appendChild(t.createElement("div")), s = (Me.exec(i) || ["", ""])[1].toLowerCase(), a = Re[s] ||
					Re._default, o.innerHTML = a[1] + i.replace(Oe, "<$1></$2>") + a[2], l = a[0]; l--;) o = o.lastChild;
				Q.merge(d, o.childNodes), o = c.firstChild, o.textContent = ""
			} else d.push(t.createTextNode(i));
			for (c.textContent = "", f = 0; i = d[f++];)
				if ((!r || Q.inArray(i, r) === -1) && (u = Q.contains(i.ownerDocument, i), o = v(c.appendChild(i), "script"), u &&
						m(o), n))
					for (l = 0; i = o[l++];) je.test(i.type || "") && n.push(i);
			return c
		},
		cleanData: function(e) {
			for (var t, n, r, i, o = Q.event.special, s = 0; void 0 !== (n = e[s]); s++) {
				if (Q.acceptData(n) && (i = n[ve.expando], i && (t = ve.cache[i]))) {
					if (t.events)
						for (r in t.events) o[r] ? Q.event.remove(n, r) : Q.removeEvent(n, r, t.handle);
					ve.cache[i] && delete ve.cache[i]
				}
				delete ye.cache[n[ye.expando]]
			}
		}
	}), Q.fn.extend({
		text: function(e) {
			return ge(this, function(e) {
				return void 0 === e ? Q.text(this) : this.empty().each(function() {
					1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
				})
			}, null, e, arguments.length)
		},
		append: function() {
			return this.domManip(arguments, function(e) {
				if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
					var t = f(this, e);
					t.appendChild(e)
				}
			})
		},
		prepend: function() {
			return this.domManip(arguments, function(e) {
				if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
					var t = f(this, e);
					t.insertBefore(e, t.firstChild)
				}
			})
		},
		before: function() {
			return this.domManip(arguments, function(e) {
				this.parentNode && this.parentNode.insertBefore(e, this)
			})
		},
		after: function() {
			return this.domManip(arguments, function(e) {
				this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
			})
		},
		remove: function(e, t) {
			for (var n, r = e ? Q.filter(e, this) : this, i = 0; null != (n = r[i]); i++) t || 1 !== n.nodeType || Q.cleanData(
				v(n)), n.parentNode && (t && Q.contains(n.ownerDocument, n) && m(v(n, "script")), n.parentNode.removeChild(n));
			return this
		},
		empty: function() {
			for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (Q.cleanData(v(e, !1)), e.textContent = "");
			return this
		},
		clone: function(e, t) {
			return e = null != e && e, t = null == t ? e : t, this.map(function() {
				return Q.clone(this, e, t)
			})
		},
		html: function(e) {
			return ge(this, function(e) {
				var t = this[0] || {},
					n = 0,
					r = this.length;
				if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
				if ("string" == typeof e && !Fe.test(e) && !Re[(Me.exec(e) || ["", ""])[1].toLowerCase()]) {
					e = e.replace(Oe, "<$1></$2>");
					try {
						for (; n < r; n++) t = this[n] || {}, 1 === t.nodeType && (Q.cleanData(v(t, !1)), t.innerHTML = e);
						t = 0
					} catch (i) {}
				}
				t && this.empty().append(e)
			}, null, e, arguments.length)
		},
		replaceWith: function() {
			var e = arguments[0];
			return this.domManip(arguments, function(t) {
				e = this.parentNode, Q.cleanData(v(this)), e && e.replaceChild(t, this)
			}), e && (e.length || e.nodeType) ? this : this.remove()
		},
		detach: function(e) {
			return this.remove(e, !0)
		},
		domManip: function(e, t) {
			e = q.apply([], e);
			var n, r, i, o, s, a, u = 0,
				l = this.length,
				c = this,
				d = l - 1,
				f = e[0],
				m = Q.isFunction(f);
			if (m || l > 1 && "string" == typeof f && !X.checkClone && He.test(f)) return this.each(function(n) {
				var r = c.eq(n);
				m && (e[0] = f.call(this, n, r.html())), r.domManip(e, t)
			});
			if (l && (n = Q.buildFragment(e, this[0].ownerDocument, !1, this), r = n.firstChild, 1 === n.childNodes.length &&
					(n = r), r)) {
				for (i = Q.map(v(n, "script"), p), o = i.length; u < l; u++) s = n, u !== d && (s = Q.clone(s, !0, !0), o && Q.merge(
					i, v(s, "script"))), t.call(this[u], s, u);
				if (o)
					for (a = i[i.length - 1].ownerDocument, Q.map(i, h), u = 0; u < o; u++) s = i[u], je.test(s.type || "") && !ve
						.access(s, "globalEval") && Q.contains(a, s) && (s.src ? Q._evalUrl && Q._evalUrl(s.src) : Q.globalEval(s.textContent
							.replace(Pe, "")))
			}
			return this
		}
	}), Q.each({
		appendTo: "append",
		prependTo: "prepend",
		insertBefore: "before",
		insertAfter: "after",
		replaceAll: "replaceWith"
	}, function(e, t) {
		Q.fn[e] = function(e) {
			for (var n, r = [], i = Q(e), o = i.length - 1, s = 0; s <= o; s++) n = s === o ? this : this.clone(!0), Q(i[s])[
				t](n), $.apply(r, n.get());
			return this.pushStack(r)
		}
	});
	var Le, We = {},
		Ye = /^margin/,
		Be = new RegExp("^(" + we + ")(?!px)[a-z%]+$", "i"),
		Ve = function(t) {
			return t.ownerDocument.defaultView.opener ? t.ownerDocument.defaultView.getComputedStyle(t, null) : e.getComputedStyle(
				t, null)
		};
	! function() {
		function t() {
			s.style.cssText =
				"-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute",
				s.innerHTML = "", i.appendChild(o);
			var t = e.getComputedStyle(s, null);
			n = "1%" !== t.top, r = "4px" === t.width, i.removeChild(o)
		}
		var n, r, i = K.documentElement,
			o = K.createElement("div"),
			s = K.createElement("div");
		s.style && (s.style.backgroundClip = "content-box", s.cloneNode(!0).style.backgroundClip = "", X.clearCloneStyle =
			"content-box" === s.style.backgroundClip, o.style.cssText =
			"border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;position:absolute", o.appendChild(s), e.getComputedStyle &&
			Q.extend(X, {
				pixelPosition: function() {
					return t(), n
				},
				boxSizingReliable: function() {
					return null == r && t(), r
				},
				reliableMarginRight: function() {
					var t, n = s.appendChild(K.createElement("div"));
					return n.style.cssText = s.style.cssText =
						"-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",
						n.style.marginRight = n.style.width = "0", s.style.width = "1px", i.appendChild(o), t = !parseFloat(e.getComputedStyle(
							n, null).marginRight), i.removeChild(o), s.removeChild(n), t
				}
			}))
	}(), Q.swap = function(e, t, n, r) {
		var i, o, s = {};
		for (o in t) s[o] = e.style[o], e.style[o] = t[o];
		i = n.apply(e, r || []);
		for (o in t) e.style[o] = s[o];
		return i
	};
	var qe = /^(none|table(?!-c[ea]).+)/,
		$e = new RegExp("^(" + we + ")(.*)$", "i"),
		Ue = new RegExp("^([+-])=(" + we + ")", "i"),
		ze = {
			position: "absolute",
			visibility: "hidden",
			display: "block"
		},
		Ge = {
			letterSpacing: "0",
			fontWeight: "400"
		},
		Je = ["Webkit", "O", "Moz", "ms"];
	Q.extend({
		cssHooks: {
			opacity: {
				get: function(e, t) {
					if (t) {
						var n = w(e, "opacity");
						return "" === n ? "1" : n
					}
				}
			}
		},
		cssNumber: {
			columnCount: !0,
			fillOpacity: !0,
			flexGrow: !0,
			flexShrink: !0,
			fontWeight: !0,
			lineHeight: !0,
			opacity: !0,
			order: !0,
			orphans: !0,
			widows: !0,
			zIndex: !0,
			zoom: !0
		},
		cssProps: {
			"float": "cssFloat"
		},
		style: function(e, t, n, r) {
			if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
				var i, o, s, a = Q.camelCase(t),
					u = e.style;
				return t = Q.cssProps[a] || (Q.cssProps[a] = S(u, a)), s = Q.cssHooks[t] || Q.cssHooks[a], void 0 === n ? s &&
					"get" in s && void 0 !== (i = s.get(e, !1, r)) ? i : u[t] : (o = typeof n, "string" === o && (i = Ue.exec(n)) &&
						(n = (i[1] + 1) * i[2] + parseFloat(Q.css(e, t)), o = "number"), null != n && n === n && ("number" !== o || Q
							.cssNumber[a] || (n += "px"), X.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (u[t] =
								"inherit"), s && "set" in s && void 0 === (n = s.set(e, n, r)) || (u[t] = n)), void 0)
			}
		},
		css: function(e, t, n, r) {
			var i, o, s, a = Q.camelCase(t);
			return t = Q.cssProps[a] || (Q.cssProps[a] = S(e.style, a)), s = Q.cssHooks[t] || Q.cssHooks[a], s && "get" in s &&
				(i = s.get(e, !0, n)), void 0 === i && (i = w(e, t, r)), "normal" === i && t in Ge && (i = Ge[t]), "" === n ||
				n ? (o = parseFloat(i), n === !0 || Q.isNumeric(o) ? o || 0 : i) : i
		}
	}), Q.each(["height", "width"], function(e, t) {
		Q.cssHooks[t] = {
			get: function(e, n, r) {
				if (n) return qe.test(Q.css(e, "display")) && 0 === e.offsetWidth ? Q.swap(e, ze, function() {
					return E(e, t, r)
				}) : E(e, t, r)
			},
			set: function(e, n, r) {
				var i = r && Ve(e);
				return T(e, n, r ? _(e, t, r, "border-box" === Q.css(e, "boxSizing", !1, i), i) : 0)
			}
		}
	}), Q.cssHooks.marginRight = D(X.reliableMarginRight, function(e, t) {
		if (t) return Q.swap(e, {
			display: "inline-block"
		}, w, [e, "marginRight"])
	}), Q.each({
		margin: "",
		padding: "",
		border: "Width"
	}, function(e, t) {
		Q.cssHooks[e + t] = {
			expand: function(n) {
				for (var r = 0, i = {}, o = "string" == typeof n ? n.split(" ") : [n]; r < 4; r++) i[e + De[r] + t] = o[r] ||
					o[r - 2] || o[0];
				return i
			}
		}, Ye.test(e) || (Q.cssHooks[e + t].set = T)
	}), Q.fn.extend({
		css: function(e, t) {
			return ge(this, function(e, t, n) {
				var r, i, o = {},
					s = 0;
				if (Q.isArray(t)) {
					for (r = Ve(e), i = t.length; s < i; s++) o[t[s]] = Q.css(e, t[s], !1, r);
					return o
				}
				return void 0 !== n ? Q.style(e, t, n) : Q.css(e, t)
			}, e, t, arguments.length > 1)
		},
		show: function() {
			return C(this, !0)
		},
		hide: function() {
			return C(this)
		},
		toggle: function(e) {
			return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
				Se(this) ? Q(this).show() : Q(this).hide()
			})
		}
	}), Q.Tween = k, k.prototype = {
		constructor: k,
		init: function(e, t, n, r, i, o) {
			this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(),
				this.end = r, this.unit = o || (Q.cssNumber[n] ? "" : "px")
		},
		cur: function() {
			var e = k.propHooks[this.prop];
			return e && e.get ? e.get(this) : k.propHooks._default.get(this)
		},
		run: function(e) {
			var t, n = k.propHooks[this.prop];
			return this.options.duration ? this.pos = t = Q.easing[this.easing](e, this.options.duration * e, 0, 1, this.options
					.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options
				.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : k.propHooks._default.set(this), this
		}
	}, k.prototype.init.prototype = k.prototype, k.propHooks = {
		_default: {
			get: function(e) {
				var t;
				return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = Q.css(e.elem, e.prop, ""),
					t && "auto" !== t ? t : 0) : e.elem[e.prop]
			},
			set: function(e) {
				Q.fx.step[e.prop] ? Q.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[Q.cssProps[e.prop]] || Q.cssHooks[
					e.prop]) ? Q.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
			}
		}
	}, k.propHooks.scrollTop = k.propHooks.scrollLeft = {
		set: function(e) {
			e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
		}
	}, Q.easing = {
		linear: function(e) {
			return e
		},
		swing: function(e) {
			return .5 - Math.cos(e * Math.PI) / 2
		}
	}, Q.fx = k.prototype.init, Q.fx.step = {};
	var Xe, Ke, Ze = /^(?:toggle|show|hide)$/,
		Qe = new RegExp("^(?:([+-])=|)(" + we + ")([a-z%]*)$", "i"),
		et = /queueHooks$/,
		tt = [A],
		nt = {
			"*": [function(e, t) {
				var n = this.createTween(e, t),
					r = n.cur(),
					i = Qe.exec(t),
					o = i && i[3] || (Q.cssNumber[e] ? "" : "px"),
					s = (Q.cssNumber[e] || "px" !== o && +r) && Qe.exec(Q.css(n.elem, e)),
					a = 1,
					u = 20;
				if (s && s[3] !== o) {
					o = o || s[3], i = i || [], s = +r || 1;
					do a = a || ".5", s /= a, Q.style(n.elem, e, s + o); while (a !== (a = n.cur() / r) && 1 !== a && --u)
				}
				return i && (s = n.start = +s || +r || 0, n.unit = o, n.end = i[1] ? s + (i[1] + 1) * i[2] : +i[2]), n
			}]
		};
	Q.Animation = Q.extend(H, {
			tweener: function(e, t) {
				Q.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
				for (var n, r = 0, i = e.length; r < i; r++) n = e[r], nt[n] = nt[n] || [], nt[n].unshift(t)
			},
			prefilter: function(e, t) {
				t ? tt.unshift(e) : tt.push(e)
			}
		}), Q.speed = function(e, t, n) {
			var r = e && "object" == typeof e ? Q.extend({}, e) : {
				complete: n || !n && t || Q.isFunction(e) && e,
				duration: e,
				easing: n && t || t && !Q.isFunction(t) && t
			};
			return r.duration = Q.fx.off ? 0 : "number" == typeof r.duration ? r.duration : r.duration in Q.fx.speeds ? Q.fx.speeds[
					r.duration] : Q.fx.speeds._default, null != r.queue && r.queue !== !0 || (r.queue = "fx"), r.old = r.complete, r.complete =
				function() {
					Q.isFunction(r.old) && r.old.call(this), r.queue && Q.dequeue(this, r.queue)
				}, r
		}, Q.fn.extend({
			fadeTo: function(e, t, n, r) {
				return this.filter(Se).css("opacity", 0).show().end().animate({
					opacity: t
				}, e, n, r)
			},
			animate: function(e, t, n, r) {
				var i = Q.isEmptyObject(e),
					o = Q.speed(t, n, r),
					s = function() {
						var t = H(this, Q.extend({}, e), o);
						(i || ve.get(this, "finish")) && t.stop(!0)
					};
				return s.finish = s, i || o.queue === !1 ? this.each(s) : this.queue(o.queue, s)
			},
			stop: function(e, t, n) {
				var r = function(e) {
					var t = e.stop;
					delete e.stop, t(n)
				};
				return "string" != typeof e && (n = t, t = e, e = void 0), t && e !== !1 && this.queue(e || "fx", []), this.each(
					function() {
						var t = !0,
							i = null != e && e + "queueHooks",
							o = Q.timers,
							s = ve.get(this);
						if (i) s[i] && s[i].stop && r(s[i]);
						else
							for (i in s) s[i] && s[i].stop && et.test(i) && r(s[i]);
						for (i = o.length; i--;) o[i].elem !== this || null != e && o[i].queue !== e || (o[i].anim.stop(n), t = !1, o
							.splice(i, 1));
						!t && n || Q.dequeue(this, e)
					})
			},
			finish: function(e) {
				return e !== !1 && (e = e || "fx"), this.each(function() {
					var t, n = ve.get(this),
						r = n[e + "queue"],
						i = n[e + "queueHooks"],
						o = Q.timers,
						s = r ? r.length : 0;
					for (n.finish = !0, Q.queue(this, e, []), i && i.stop && i.stop.call(this, !0), t = o.length; t--;) o[t].elem ===
						this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
					for (t = 0; t < s; t++) r[t] && r[t].finish && r[t].finish.call(this);
					delete n.finish
				})
			}
		}), Q.each(["toggle", "show", "hide"], function(e, t) {
			var n = Q.fn[t];
			Q.fn[t] = function(e, r, i) {
				return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(O(t, !0), e, r, i)
			}
		}), Q.each({
			slideDown: O("show"),
			slideUp: O("hide"),
			slideToggle: O("toggle"),
			fadeIn: {
				opacity: "show"
			},
			fadeOut: {
				opacity: "hide"
			},
			fadeToggle: {
				opacity: "toggle"
			}
		}, function(e, t) {
			Q.fn[e] = function(e, n, r) {
				return this.animate(t, e, n, r)
			}
		}), Q.timers = [], Q.fx.tick = function() {
			var e, t = 0,
				n = Q.timers;
			for (Xe = Q.now(); t < n.length; t++) e = n[t], e() || n[t] !== e || n.splice(t--, 1);
			n.length || Q.fx.stop(), Xe = void 0
		}, Q.fx.timer = function(e) {
			Q.timers.push(e), e() ? Q.fx.start() : Q.timers.pop()
		}, Q.fx.interval = 13, Q.fx.start = function() {
			Ke || (Ke = setInterval(Q.fx.tick, Q.fx.interval))
		}, Q.fx.stop = function() {
			clearInterval(Ke), Ke = null
		}, Q.fx.speeds = {
			slow: 600,
			fast: 200,
			_default: 400
		}, Q.fn.delay = function(e, t) {
			return e = Q.fx ? Q.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function(t, n) {
				var r = setTimeout(t, e);
				n.stop = function() {
					clearTimeout(r)
				}
			})
		},
		function() {
			var e = K.createElement("input"),
				t = K.createElement("select"),
				n = t.appendChild(K.createElement("option"));
			e.type = "checkbox", X.checkOn = "" !== e.value, X.optSelected = n.selected, t.disabled = !0, X.optDisabled = !n.disabled,
				e = K.createElement("input"), e.value = "t", e.type = "radio", X.radioValue = "t" === e.value
		}();
	var rt, it, ot = Q.expr.attrHandle;
	Q.fn.extend({
		attr: function(e, t) {
			return ge(this, Q.attr, e, t, arguments.length > 1)
		},
		removeAttr: function(e) {
			return this.each(function() {
				Q.removeAttr(this, e)
			})
		}
	}), Q.extend({
		attr: function(e, t, n) {
			var r, i, o = e.nodeType;
			if (e && 3 !== o && 8 !== o && 2 !== o) return typeof e.getAttribute === _e ? Q.prop(e, t, n) : (1 === o && Q.isXMLDoc(
					e) || (t = t.toLowerCase(), r = Q.attrHooks[t] || (Q.expr.match.bool.test(t) ? it : rt)), void 0 === n ? r &&
				"get" in r && null !== (i = r.get(e, t)) ? i : (i = Q.find.attr(e, t), null == i ? void 0 : i) : null !== n ?
				r && "set" in r && void 0 !== (i = r.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : void Q.removeAttr(e,
					t))
		},
		removeAttr: function(e, t) {
			var n, r, i = 0,
				o = t && t.match(pe);
			if (o && 1 === e.nodeType)
				for (; n = o[i++];) r = Q.propFix[n] || n, Q.expr.match.bool.test(n) && (e[r] = !1), e.removeAttribute(n)
		},
		attrHooks: {
			type: {
				set: function(e, t) {
					if (!X.radioValue && "radio" === t && Q.nodeName(e, "input")) {
						var n = e.value;
						return e.setAttribute("type", t), n && (e.value = n), t
					}
				}
			}
		}
	}), it = {
		set: function(e, t, n) {
			return t === !1 ? Q.removeAttr(e, n) : e.setAttribute(n, n), n
		}
	}, Q.each(Q.expr.match.bool.source.match(/\w+/g), function(e, t) {
		var n = ot[t] || Q.find.attr;
		ot[t] = function(e, t, r) {
			var i, o;
			return r || (o = ot[t], ot[t] = i, i = null != n(e, t, r) ? t.toLowerCase() : null, ot[t] = o), i
		}
	});
	var st = /^(?:input|select|textarea|button)$/i;
	Q.fn.extend({
		prop: function(e, t) {
			return ge(this, Q.prop, e, t, arguments.length > 1)
		},
		removeProp: function(e) {
			return this.each(function() {
				delete this[Q.propFix[e] || e]
			})
		}
	}), Q.extend({
		propFix: {
			"for": "htmlFor",
			"class": "className"
		},
		prop: function(e, t, n) {
			var r, i, o, s = e.nodeType;
			if (e && 3 !== s && 8 !== s && 2 !== s) return o = 1 !== s || !Q.isXMLDoc(e), o && (t = Q.propFix[t] || t, i = Q
					.propHooks[t]), void 0 !== n ? i && "set" in i && void 0 !== (r = i.set(e, n, t)) ? r : e[t] = n : i && "get" in
				i && null !== (r = i.get(e, t)) ? r : e[t]
		},
		propHooks: {
			tabIndex: {
				get: function(e) {
					return e.hasAttribute("tabindex") || st.test(e.nodeName) || e.href ? e.tabIndex : -1
				}
			}
		}
	}), X.optSelected || (Q.propHooks.selected = {
		get: function(e) {
			var t = e.parentNode;
			return t && t.parentNode && t.parentNode.selectedIndex, null
		}
	}), Q.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap",
		"frameBorder", "contentEditable"
	], function() {
		Q.propFix[this.toLowerCase()] = this
	});
	var at = /[\t\r\n\f]/g;
	Q.fn.extend({
		addClass: function(e) {
			var t, n, r, i, o, s, a = "string" == typeof e && e,
				u = 0,
				l = this.length;
			if (Q.isFunction(e)) return this.each(function(t) {
				Q(this).addClass(e.call(this, t, this.className))
			});
			if (a)
				for (t = (e || "").match(pe) || []; u < l; u++)
					if (n = this[u], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(at, " ") : " ")) {
						for (o = 0; i = t[o++];) r.indexOf(" " + i + " ") < 0 && (r += i + " ");
						s = Q.trim(r), n.className !== s && (n.className = s)
					}
			return this
		},
		removeClass: function(e) {
			var t, n, r, i, o, s, a = 0 === arguments.length || "string" == typeof e && e,
				u = 0,
				l = this.length;
			if (Q.isFunction(e)) return this.each(function(t) {
				Q(this).removeClass(e.call(this, t, this.className))
			});
			if (a)
				for (t = (e || "").match(pe) || []; u < l; u++)
					if (n = this[u], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(at, " ") : "")) {
						for (o = 0; i = t[o++];)
							for (; r.indexOf(" " + i + " ") >= 0;) r = r.replace(" " + i + " ", " ");
						s = e ? Q.trim(r) : "", n.className !== s && (n.className = s)
					}
			return this
		},
		toggleClass: function(e, t) {
			var n = typeof e;
			return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : Q.isFunction(e) ?
				this.each(function(n) {
					Q(this).toggleClass(e.call(this, n, this.className, t), t)
				}) : this.each(function() {
					if ("string" === n)
						for (var t, r = 0, i = Q(this), o = e.match(pe) || []; t = o[r++];) i.hasClass(t) ? i.removeClass(t) : i.addClass(
							t);
					else n !== _e && "boolean" !== n || (this.className && ve.set(this, "__className__", this.className), this.className =
						this.className || e === !1 ? "" : ve.get(this, "__className__") || "")
				})
		},
		hasClass: function(e) {
			for (var t = " " + e + " ", n = 0, r = this.length; n < r; n++)
				if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(at, " ").indexOf(t) >= 0) return !0;
			return !1
		}
	});
	var ut = /\r/g;
	Q.fn.extend({
		val: function(e) {
			var t, n, r, i = this[0]; {
				if (arguments.length) return r = Q.isFunction(e), this.each(function(n) {
					var i;
					1 === this.nodeType && (i = r ? e.call(this, n, Q(this).val()) : e, null == i ? i = "" : "number" == typeof i ?
						i += "" : Q.isArray(i) && (i = Q.map(i, function(e) {
							return null == e ? "" : e + ""
						})), t = Q.valHooks[this.type] || Q.valHooks[this.nodeName.toLowerCase()], t && "set" in t && void 0 !==
						t.set(this, i, "value") || (this.value = i))
				});
				if (i) return t = Q.valHooks[i.type] || Q.valHooks[i.nodeName.toLowerCase()], t && "get" in t && void 0 !== (n =
					t.get(i, "value")) ? n : (n = i.value, "string" == typeof n ? n.replace(ut, "") : null == n ? "" : n)
			}
		}
	}), Q.extend({
		valHooks: {
			option: {
				get: function(e) {
					var t = Q.find.attr(e, "value");
					return null != t ? t : Q.trim(Q.text(e))
				}
			},
			select: {
				get: function(e) {
					for (var t, n, r = e.options, i = e.selectedIndex, o = "select-one" === e.type || i < 0, s = o ? null : [], a =
							o ? i + 1 : r.length, u = i < 0 ? a : o ? i : 0; u < a; u++)
						if (n = r[u], (n.selected || u === i) && (X.optDisabled ? !n.disabled : null === n.getAttribute("disabled")) &&
							(!n.parentNode.disabled || !Q.nodeName(n.parentNode, "optgroup"))) {
							if (t = Q(n).val(), o) return t;
							s.push(t)
						}
					return s
				},
				set: function(e, t) {
					for (var n, r, i = e.options, o = Q.makeArray(t), s = i.length; s--;) r = i[s], (r.selected = Q.inArray(r.value,
						o) >= 0) && (n = !0);
					return n || (e.selectedIndex = -1), o
				}
			}
		}
	}), Q.each(["radio", "checkbox"], function() {
		Q.valHooks[this] = {
			set: function(e, t) {
				if (Q.isArray(t)) return e.checked = Q.inArray(Q(e).val(), t) >= 0
			}
		}, X.checkOn || (Q.valHooks[this].get = function(e) {
			return null === e.getAttribute("value") ? "on" : e.value
		})
	}), Q.each(
		"blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu"
		.split(" "),
		function(e, t) {
			Q.fn[t] = function(e, n) {
				return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
			}
		}), Q.fn.extend({
		hover: function(e, t) {
			return this.mouseenter(e).mouseleave(t || e)
		},
		bind: function(e, t, n) {
			return this.on(e, null, t, n)
		},
		unbind: function(e, t) {
			return this.off(e, null, t)
		},
		delegate: function(e, t, n, r) {
			return this.on(t, e, n, r)
		},
		undelegate: function(e, t, n) {
			return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
		}
	});
	var lt = Q.now(),
		ct = /\?/;
	Q.parseJSON = function(e) {
		return JSON.parse(e + "")
	}, Q.parseXML = function(e) {
		var t, n;
		if (!e || "string" != typeof e) return null;
		try {
			n = new DOMParser, t = n.parseFromString(e, "text/xml")
		} catch (r) {
			t = void 0
		}
		return t && !t.getElementsByTagName("parsererror").length || Q.error("Invalid XML: " + e), t
	};
	var dt = /#.*$/,
		ft = /([?&])_=[^&]*/,
		pt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
		ht = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
		mt = /^(?:GET|HEAD)$/,
		gt = /^\/\//,
		vt = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,
		yt = {},
		bt = {},
		xt = "*/".concat("*"),
		wt = e.location.href,
		Dt = vt.exec(wt.toLowerCase()) || [];
	Q.extend({
		active: 0,
		lastModified: {},
		etag: {},
		ajaxSettings: {
			url: wt,
			type: "GET",
			isLocal: ht.test(Dt[1]),
			global: !0,
			processData: !0,
			async: !0,
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			accepts: {
				"*": xt,
				text: "text/plain",
				html: "text/html",
				xml: "application/xml, text/xml",
				json: "application/json, text/javascript"
			},
			contents: {
				xml: /xml/,
				html: /html/,
				json: /json/
			},
			responseFields: {
				xml: "responseXML",
				text: "responseText",
				json: "responseJSON"
			},
			converters: {
				"* text": String,
				"text html": !0,
				"text json": Q.parseJSON,
				"text xml": Q.parseXML
			},
			flatOptions: {
				url: !0,
				context: !0
			}
		},
		ajaxSetup: function(e, t) {
			return t ? P(P(e, Q.ajaxSettings), t) : P(Q.ajaxSettings, e)
		},
		ajaxPrefilter: j(yt),
		ajaxTransport: j(bt),
		ajax: function(e, t) {
			function n(e, t, n, s) {
				var u, c, v, y, x, D = t;
				2 !== b && (b = 2, a && clearTimeout(a), r = void 0, o = s || "", w.readyState = e > 0 ? 4 : 0, u = e >= 200 &&
					e < 300 || 304 === e, n && (y = R(d, w, n)), y = L(d, y, w, u), u ? (d.ifModified && (x = w.getResponseHeader(
							"Last-Modified"), x && (Q.lastModified[i] = x), x = w.getResponseHeader("etag"), x && (Q.etag[i] = x)), 204 ===
						e || "HEAD" === d.type ? D = "nocontent" : 304 === e ? D = "notmodified" : (D = y.state, c = y.data, v = y.error,
							u = !v)) : (v = D, !e && D || (D = "error", e < 0 && (e = 0))), w.status = e, w.statusText = (t || D) + "",
					u ? h.resolveWith(f, [c, D, w]) : h.rejectWith(f, [w, D, v]), w.statusCode(g), g = void 0, l && p.trigger(u ?
						"ajaxSuccess" : "ajaxError", [w, d, u ? c : v]), m.fireWith(f, [w, D]), l && (p.trigger("ajaxComplete", [w,
						d
					]), --Q.active || Q.event.trigger("ajaxStop")))
			}
			"object" == typeof e && (t = e, e = void 0), t = t || {};
			var r, i, o, s, a, u, l, c, d = Q.ajaxSetup({}, t),
				f = d.context || d,
				p = d.context && (f.nodeType || f.jquery) ? Q(f) : Q.event,
				h = Q.Deferred(),
				m = Q.Callbacks("once memory"),
				g = d.statusCode || {},
				v = {},
				y = {},
				b = 0,
				x = "canceled",
				w = {
					readyState: 0,
					getResponseHeader: function(e) {
						var t;
						if (2 === b) {
							if (!s)
								for (s = {}; t = pt.exec(o);) s[t[1].toLowerCase()] = t[2];
							t = s[e.toLowerCase()]
						}
						return null == t ? null : t
					},
					getAllResponseHeaders: function() {
						return 2 === b ? o : null
					},
					setRequestHeader: function(e, t) {
						var n = e.toLowerCase();
						return b || (e = y[n] = y[n] || e, v[e] = t), this
					},
					overrideMimeType: function(e) {
						return b || (d.mimeType = e), this
					},
					statusCode: function(e) {
						var t;
						if (e)
							if (b < 2)
								for (t in e) g[t] = [g[t], e[t]];
							else w.always(e[w.status]);
						return this
					},
					abort: function(e) {
						var t = e || x;
						return r && r.abort(t), n(0, t), this
					}
				};
			if (h.promise(w).complete = m.add, w.success = w.done, w.error = w.fail, d.url = ((e || d.url || wt) + "").replace(
					dt, "").replace(gt, Dt[1] + "//"), d.type = t.method || t.type || d.method || d.type, d.dataTypes = Q.trim(d.dataType ||
					"*").toLowerCase().match(pe) || [""], null == d.crossDomain && (u = vt.exec(d.url.toLowerCase()), d.crossDomain = !
					(!u || u[1] === Dt[1] && u[2] === Dt[2] && (u[3] || ("http:" === u[1] ? "80" : "443")) === (Dt[3] || ("http:" ===
						Dt[1] ? "80" : "443")))), d.data && d.processData && "string" != typeof d.data && (d.data = Q.param(d.data, d
					.traditional)), I(yt, d, t, w), 2 === b) return w;
			l = Q.event && d.global, l && 0 === Q.active++ && Q.event.trigger("ajaxStart"), d.type = d.type.toUpperCase(), d
				.hasContent = !mt.test(d.type), i = d.url, d.hasContent || (d.data && (i = d.url += (ct.test(i) ? "&" : "?") +
					d.data, delete d.data), d.cache === !1 && (d.url = ft.test(i) ? i.replace(ft, "$1_=" + lt++) : i + (ct.test(i) ?
					"&" : "?") + "_=" + lt++)), d.ifModified && (Q.lastModified[i] && w.setRequestHeader("If-Modified-Since", Q.lastModified[
					i]), Q.etag[i] && w.setRequestHeader("If-None-Match", Q.etag[i])), (d.data && d.hasContent && d.contentType !==
					!1 || t.contentType) && w.setRequestHeader("Content-Type", d.contentType), w.setRequestHeader("Accept", d.dataTypes[
					0] && d.accepts[d.dataTypes[0]] ? d.accepts[d.dataTypes[0]] + ("*" !== d.dataTypes[0] ? ", " + xt +
					"; q=0.01" : "") : d.accepts["*"]);
			for (c in d.headers) w.setRequestHeader(c, d.headers[c]);
			if (d.beforeSend && (d.beforeSend.call(f, w, d) === !1 || 2 === b)) return w.abort();
			x = "abort";
			for (c in {
					success: 1,
					error: 1,
					complete: 1
				}) w[c](d[c]);
			if (r = I(bt, d, t, w)) {
				w.readyState = 1, l && p.trigger("ajaxSend", [w, d]), d.async && d.timeout > 0 && (a = setTimeout(function() {
					w.abort("timeout")
				}, d.timeout));
				try {
					b = 1, r.send(v, n)
				} catch (D) {
					if (!(b < 2)) throw D;
					n(-1, D)
				}
			} else n(-1, "No Transport");
			return w
		},
		getJSON: function(e, t, n) {
			return Q.get(e, t, n, "json")
		},
		getScript: function(e, t) {
			return Q.get(e, void 0, t, "script")
		}
	}), Q.each(["get", "post"], function(e, t) {
		Q[t] = function(e, n, r, i) {
			return Q.isFunction(n) && (i = i || r, r = n, n = void 0), Q.ajax({
				url: e,
				type: t,
				dataType: i,
				data: n,
				success: r
			})
		}
	}), Q._evalUrl = function(e) {
		return Q.ajax({
			url: e,
			type: "GET",
			dataType: "script",
			async: !1,
			global: !1,
			"throws": !0
		})
	}, Q.fn.extend({
		wrapAll: function(e) {
			var t;
			return Q.isFunction(e) ? this.each(function(t) {
				Q(this).wrapAll(e.call(this, t))
			}) : (this[0] && (t = Q(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]),
				t.map(function() {
					for (var e = this; e.firstElementChild;) e = e.firstElementChild;
					return e
				}).append(this)), this)
		},
		wrapInner: function(e) {
			return Q.isFunction(e) ? this.each(function(t) {
				Q(this).wrapInner(e.call(this, t))
			}) : this.each(function() {
				var t = Q(this),
					n = t.contents();
				n.length ? n.wrapAll(e) : t.append(e)
			})
		},
		wrap: function(e) {
			var t = Q.isFunction(e);
			return this.each(function(n) {
				Q(this).wrapAll(t ? e.call(this, n) : e)
			})
		},
		unwrap: function() {
			return this.parent().each(function() {
				Q.nodeName(this, "body") || Q(this).replaceWith(this.childNodes)
			}).end()
		}
	}), Q.expr.filters.hidden = function(e) {
		return e.offsetWidth <= 0 && e.offsetHeight <= 0
	}, Q.expr.filters.visible = function(e) {
		return !Q.expr.filters.hidden(e)
	};
	var St = /%20/g,
		Tt = /\[\]$/,
		_t = /\r?\n/g,
		Et = /^(?:submit|button|image|reset|file)$/i,
		Ct = /^(?:input|select|textarea|keygen)/i;
	Q.param = function(e, t) {
		var n, r = [],
			i = function(e, t) {
				t = Q.isFunction(t) ? t() : null == t ? "" : t, r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
			};
		if (void 0 === t && (t = Q.ajaxSettings && Q.ajaxSettings.traditional), Q.isArray(e) || e.jquery && !Q.isPlainObject(
				e)) Q.each(e, function() {
			i(this.name, this.value)
		});
		else
			for (n in e) W(n, e[n], t, i);
		return r.join("&").replace(St, "+")
	}, Q.fn.extend({
		serialize: function() {
			return Q.param(this.serializeArray())
		},
		serializeArray: function() {
			return this.map(function() {
				var e = Q.prop(this, "elements");
				return e ? Q.makeArray(e) : this
			}).filter(function() {
				var e = this.type;
				return this.name && !Q(this).is(":disabled") && Ct.test(this.nodeName) && !Et.test(e) && (this.checked || !Te
					.test(e))
			}).map(function(e, t) {
				var n = Q(this).val();
				return null == n ? null : Q.isArray(n) ? Q.map(n, function(e) {
					return {
						name: t.name,
						value: e.replace(_t, "\r\n")
					}
				}) : {
					name: t.name,
					value: n.replace(_t, "\r\n")
				}
			}).get()
		}
	}), Q.ajaxSettings.xhr = function() {
		try {
			return new XMLHttpRequest
		} catch (e) {}
	};
	var kt = 0,
		Nt = {},
		Ot = {
			0: 200,
			1223: 204
		},
		Mt = Q.ajaxSettings.xhr();
	e.attachEvent && e.attachEvent("onunload", function() {
		for (var e in Nt) Nt[e]()
	}), X.cors = !!Mt && "withCredentials" in Mt, X.ajax = Mt = !!Mt, Q.ajaxTransport(function(e) {
		var t;
		if (X.cors || Mt && !e.crossDomain) return {
			send: function(n, r) {
				var i, o = e.xhr(),
					s = ++kt;
				if (o.open(e.type, e.url, e.async, e.username, e.password), e.xhrFields)
					for (i in e.xhrFields) o[i] = e.xhrFields[i];
				e.mimeType && o.overrideMimeType && o.overrideMimeType(e.mimeType), e.crossDomain || n["X-Requested-With"] ||
					(n["X-Requested-With"] = "XMLHttpRequest");
				for (i in n) o.setRequestHeader(i, n[i]);
				t = function(e) {
					return function() {
						t && (delete Nt[s], t = o.onload = o.onerror = null, "abort" === e ? o.abort() : "error" === e ? r(o.status,
							o.statusText) : r(Ot[o.status] || o.status, o.statusText, "string" == typeof o.responseText ? {
							text: o.responseText
						} : void 0, o.getAllResponseHeaders()))
					}
				}, o.onload = t(), o.onerror = t("error"), t = Nt[s] = t("abort");
				try {
					o.send(e.hasContent && e.data || null)
				} catch (a) {
					if (t) throw a
				}
			},
			abort: function() {
				t && t()
			}
		}
	}), Q.ajaxSetup({
		accepts: {
			script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
		},
		contents: {
			script: /(?:java|ecma)script/
		},
		converters: {
			"text script": function(e) {
				return Q.globalEval(e), e
			}
		}
	}), Q.ajaxPrefilter("script", function(e) {
		void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
	}), Q.ajaxTransport("script", function(e) {
		if (e.crossDomain) {
			var t, n;
			return {
				send: function(r, i) {
					t = Q("<script>").prop({
						async: !0,
						charset: e.scriptCharset,
						src: e.url
					}).on("load error", n = function(e) {
						t.remove(), n = null, e && i("error" === e.type ? 404 : 200, e.type)
					}), K.head.appendChild(t[0])
				},
				abort: function() {
					n && n()
				}
			}
		}
	});
	var At = [],
		Ft = /(=)\?(?=&|$)|\?\?/;
	Q.ajaxSetup({
		jsonp: "callback",
		jsonpCallback: function() {
			var e = At.pop() || Q.expando + "_" + lt++;
			return this[e] = !0, e
		}
	}), Q.ajaxPrefilter("json jsonp", function(t, n, r) {
		var i, o, s, a = t.jsonp !== !1 && (Ft.test(t.url) ? "url" : "string" == typeof t.data && !(t.contentType || "").indexOf(
			"application/x-www-form-urlencoded") && Ft.test(t.data) && "data");
		if (a || "jsonp" === t.dataTypes[0]) return i = t.jsonpCallback = Q.isFunction(t.jsonpCallback) ? t.jsonpCallback() :
			t.jsonpCallback, a ? t[a] = t[a].replace(Ft, "$1" + i) : t.jsonp !== !1 && (t.url += (ct.test(t.url) ? "&" : "?") +
				t.jsonp + "=" + i), t.converters["script json"] = function() {
				return s || Q.error(i + " was not called"), s[0]
			}, t.dataTypes[0] = "json", o = e[i], e[i] = function() {
				s = arguments
			}, r.always(function() {
				e[i] = o, t[i] && (t.jsonpCallback = n.jsonpCallback, At.push(i)), s && Q.isFunction(o) && o(s[0]), s = o =
					void 0
			}), "script"
	}), Q.parseHTML = function(e, t, n) {
		if (!e || "string" != typeof e) return null;
		"boolean" == typeof t && (n = t, t = !1), t = t || K;
		var r = se.exec(e),
			i = !n && [];
		return r ? [t.createElement(r[1])] : (r = Q.buildFragment([e], t, i), i && i.length && Q(i).remove(), Q.merge([], r
			.childNodes))
	};
	var Ht = Q.fn.load;
	Q.fn.load = function(e, t, n) {
		if ("string" != typeof e && Ht) return Ht.apply(this, arguments);
		var r, i, o, s = this,
			a = e.indexOf(" ");
		return a >= 0 && (r = Q.trim(e.slice(a)), e = e.slice(0, a)), Q.isFunction(t) ? (n = t, t = void 0) : t && "object" ==
			typeof t && (i = "POST"), s.length > 0 && Q.ajax({
				url: e,
				type: i,
				dataType: "html",
				data: t
			}).done(function(e) {
				o = arguments, s.html(r ? Q("<div>").append(Q.parseHTML(e)).find(r) : e)
			}).complete(n && function(e, t) {
				s.each(n, o || [e.responseText, t, e])
			}), this
	}, Q.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
		Q.fn[t] = function(e) {
			return this.on(t, e)
		}
	}), Q.expr.filters.animated = function(e) {
		return Q.grep(Q.timers, function(t) {
			return e === t.elem
		}).length
	};
	var jt = e.document.documentElement;
	Q.offset = {
		setOffset: function(e, t, n) {
			var r, i, o, s, a, u, l, c = Q.css(e, "position"),
				d = Q(e),
				f = {};
			"static" === c && (e.style.position = "relative"), a = d.offset(), o = Q.css(e, "top"), u = Q.css(e, "left"), l =
				("absolute" === c || "fixed" === c) && (o + u).indexOf("auto") > -1, l ? (r = d.position(), s = r.top, i = r.left) :
				(s = parseFloat(o) || 0, i = parseFloat(u) || 0), Q.isFunction(t) && (t = t.call(e, n, a)), null != t.top && (f.top =
					t.top - a.top + s), null != t.left && (f.left = t.left - a.left + i), "using" in t ? t.using.call(e, f) : d.css(
					f)
		}
	}, Q.fn.extend({
		offset: function(e) {
			if (arguments.length) return void 0 === e ? this : this.each(function(t) {
				Q.offset.setOffset(this, e, t)
			});
			var t, n, r = this[0],
				i = {
					top: 0,
					left: 0
				},
				o = r && r.ownerDocument;
			if (o) return t = o.documentElement, Q.contains(t, r) ? (typeof r.getBoundingClientRect !== _e && (i = r.getBoundingClientRect()),
				n = Y(o), {
					top: i.top + n.pageYOffset - t.clientTop,
					left: i.left + n.pageXOffset - t.clientLeft
				}) : i
		},
		position: function() {
			if (this[0]) {
				var e, t, n = this[0],
					r = {
						top: 0,
						left: 0
					};
				return "fixed" === Q.css(n, "position") ? t = n.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(),
					Q.nodeName(e[0], "html") || (r = e.offset()), r.top += Q.css(e[0], "borderTopWidth", !0), r.left += Q.css(e[0],
						"borderLeftWidth", !0)), {
					top: t.top - r.top - Q.css(n, "marginTop", !0),
					left: t.left - r.left - Q.css(n, "marginLeft", !0)
				}
			}
		},
		offsetParent: function() {
			return this.map(function() {
				for (var e = this.offsetParent || jt; e && !Q.nodeName(e, "html") && "static" === Q.css(e, "position");) e =
					e.offsetParent;
				return e || jt
			})
		}
	}), Q.each({
		scrollLeft: "pageXOffset",
		scrollTop: "pageYOffset"
	}, function(t, n) {
		var r = "pageYOffset" === n;
		Q.fn[t] = function(i) {
			return ge(this, function(t, i, o) {
				var s = Y(t);
				return void 0 === o ? s ? s[n] : t[i] : void(s ? s.scrollTo(r ? e.pageXOffset : o, r ? o : e.pageYOffset) : t[
					i] = o)
			}, t, i, arguments.length, null)
		}
	}), Q.each(["top", "left"], function(e, t) {
		Q.cssHooks[t] = D(X.pixelPosition, function(e, n) {
			if (n) return n = w(e, t), Be.test(n) ? Q(e).position()[t] + "px" : n
		})
	}), Q.each({
		Height: "height",
		Width: "width"
	}, function(e, t) {
		Q.each({
			padding: "inner" + e,
			content: t,
			"": "outer" + e
		}, function(n, r) {
			Q.fn[r] = function(r, i) {
				var o = arguments.length && (n || "boolean" != typeof r),
					s = n || (r === !0 || i === !0 ? "margin" : "border");
				return ge(this, function(t, n, r) {
					var i;
					return Q.isWindow(t) ? t.document.documentElement["client" + e] : 9 === t.nodeType ? (i = t.documentElement,
							Math.max(t.body["scroll" + e], i["scroll" + e], t.body["offset" + e], i["offset" + e], i["client" + e])) :
						void 0 === r ? Q.css(t, n, s) : Q.style(t, n, r, s)
				}, t, o ? r : void 0, o, null)
			}
		})
	}), Q.fn.size = function() {
		return this.length
	}, Q.fn.andSelf = Q.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
		return Q
	});
	var It = e.jQuery,
		Pt = e.$;
	return Q.noConflict = function(t) {
		return e.$ === Q && (e.$ = Pt), t && e.jQuery === Q && (e.jQuery = It), Q
	}, typeof t === _e && (e.jQuery = e.$ = Q), Q
}),
//! license : MIT
//! momentjs.com
function(e, t) {
	"object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define &&
		define.amd ? define(t) : e.moment = t()
}(this, function() {
	"use strict";

	function e() {
		return Hn.apply(null, arguments)
	}

	function t(e) {
		Hn = e
	}

	function n(e) {
		return "[object Array]" === Object.prototype.toString.call(e)
	}

	function r(e) {
		return e instanceof Date || "[object Date]" === Object.prototype.toString.call(e)
	}

	function i(e, t) {
		var n, r = [];
		for (n = 0; n < e.length; ++n) r.push(t(e[n], n));
		return r
	}

	function o(e, t) {
		return Object.prototype.hasOwnProperty.call(e, t)
	}

	function s(e, t) {
		for (var n in t) o(t, n) && (e[n] = t[n]);
		return o(t, "toString") && (e.toString = t.toString), o(t, "valueOf") && (e.valueOf = t.valueOf), e
	}

	function a(e, t, n, r) {
		return ke(e, t, n, r, !0).utc()
	}

	function u() {
		return {
			empty: !1,
			unusedTokens: [],
			unusedInput: [],
			overflow: -2,
			charsLeftOver: 0,
			nullInput: !1,
			invalidMonth: null,
			invalidFormat: !1,
			userInvalidated: !1,
			iso: !1
		}
	}

	function l(e) {
		return null == e._pf && (e._pf = u()), e._pf
	}

	function c(e) {
		if (null == e._isValid) {
			var t = l(e);
			e._isValid = !(isNaN(e._d.getTime()) || !(t.overflow < 0) || t.empty || t.invalidMonth || t.invalidWeekday || t.nullInput ||
				t.invalidFormat || t.userInvalidated), e._strict && (e._isValid = e._isValid && 0 === t.charsLeftOver && 0 === t.unusedTokens
				.length && void 0 === t.bigHour)
		}
		return e._isValid
	}

	function d(e) {
		var t = a(NaN);
		return null != e ? s(l(t), e) : l(t).userInvalidated = !0, t
	}

	function f(e, t) {
		var n, r, i;
		if ("undefined" != typeof t._isAMomentObject && (e._isAMomentObject = t._isAMomentObject), "undefined" != typeof t._i &&
			(e._i = t._i), "undefined" != typeof t._f && (e._f = t._f), "undefined" != typeof t._l && (e._l = t._l),
			"undefined" != typeof t._strict && (e._strict = t._strict), "undefined" != typeof t._tzm && (e._tzm = t._tzm),
			"undefined" != typeof t._isUTC && (e._isUTC = t._isUTC), "undefined" != typeof t._offset && (e._offset = t._offset),
			"undefined" != typeof t._pf && (e._pf = l(t)), "undefined" != typeof t._locale && (e._locale = t._locale), In.length >
			0)
			for (n in In) r = In[n], i = t[r], "undefined" != typeof i && (e[r] = i);
		return e
	}

	function p(t) {
		f(this, t), this._d = new Date(null != t._d ? t._d.getTime() : NaN), Pn === !1 && (Pn = !0, e.updateOffset(this), Pn = !
			1)
	}

	function h(e) {
		return e instanceof p || null != e && null != e._isAMomentObject
	}

	function m(e) {
		return e < 0 ? Math.ceil(e) : Math.floor(e)
	}

	function g(e) {
		var t = +e,
			n = 0;
		return 0 !== t && isFinite(t) && (n = m(t)), n
	}

	function v(e, t, n) {
		var r, i = Math.min(e.length, t.length),
			o = Math.abs(e.length - t.length),
			s = 0;
		for (r = 0; r < i; r++)(n && e[r] !== t[r] || !n && g(e[r]) !== g(t[r])) && s++;
		return s + o
	}

	function y() {}

	function b(e) {
		return e ? e.toLowerCase().replace("_", "-") : e
	}

	function x(e) {
		for (var t, n, r, i, o = 0; o < e.length;) {
			for (i = b(e[o]).split("-"), t = i.length, n = b(e[o + 1]), n = n ? n.split("-") : null; t > 0;) {
				if (r = w(i.slice(0, t).join("-"))) return r;
				if (n && n.length >= t && v(i, n, !0) >= t - 1) break;
				t--
			}
			o++
		}
		return null
	}

	function w(e) {
		var t = null;
		if (!Rn[e] && "undefined" != typeof module && module && module.exports) try {
			t = jn._abbr, require("./locale/" + e), D(t)
		} catch (n) {}
		return Rn[e]
	}

	function D(e, t) {
		var n;
		return e && (n = "undefined" == typeof t ? T(e) : S(e, t), n && (jn = n)), jn._abbr
	}

	function S(e, t) {
		return null !== t ? (t.abbr = e, Rn[e] = Rn[e] || new y, Rn[e].set(t), D(e), Rn[e]) : (delete Rn[e], null)
	}

	function T(e) {
		var t;
		if (e && e._locale && e._locale._abbr && (e = e._locale._abbr), !e) return jn;
		if (!n(e)) {
			if (t = w(e)) return t;
			e = [e]
		}
		return x(e)
	}

	function _(e, t) {
		var n = e.toLowerCase();
		Ln[n] = Ln[n + "s"] = Ln[t] = e
	}

	function E(e) {
		return "string" == typeof e ? Ln[e] || Ln[e.toLowerCase()] : void 0
	}

	function C(e) {
		var t, n, r = {};
		for (n in e) o(e, n) && (t = E(n), t && (r[t] = e[n]));
		return r
	}

	function k(t, n) {
		return function(r) {
			return null != r ? (O(this, t, r), e.updateOffset(this, n), this) : N(this, t)
		}
	}

	function N(e, t) {
		return e._d["get" + (e._isUTC ? "UTC" : "") + t]()
	}

	function O(e, t, n) {
		return e._d["set" + (e._isUTC ? "UTC" : "") + t](n)
	}

	function M(e, t) {
		var n;
		if ("object" == typeof e)
			for (n in e) this.set(n, e[n]);
		else if (e = E(e), "function" == typeof this[e]) return this[e](t);
		return this
	}

	function A(e, t, n) {
		var r = "" + Math.abs(e),
			i = t - r.length,
			o = e >= 0;
		return (o ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, i)).toString().substr(1) + r
	}

	function F(e, t, n, r) {
		var i = r;
		"string" == typeof r && (i = function() {
			return this[r]()
		}), e && (Vn[e] = i), t && (Vn[t[0]] = function() {
			return A(i.apply(this, arguments), t[1], t[2])
		}), n && (Vn[n] = function() {
			return this.localeData().ordinal(i.apply(this, arguments), e)
		})
	}

	function H(e) {
		return e.match(/\[[\s\S]/) ? e.replace(/^\[|\]$/g, "") : e.replace(/\\/g, "")
	}

	function j(e) {
		var t, n, r = e.match(Wn);
		for (t = 0, n = r.length; t < n; t++) Vn[r[t]] ? r[t] = Vn[r[t]] : r[t] = H(r[t]);
		return function(i) {
			var o = "";
			for (t = 0; t < n; t++) o += r[t] instanceof Function ? r[t].call(i, e) : r[t];
			return o
		}
	}

	function I(e, t) {
		return e.isValid() ? (t = P(t, e.localeData()), Bn[t] = Bn[t] || j(t), Bn[t](e)) : e.localeData().invalidDate()
	}

	function P(e, t) {
		function n(e) {
			return t.longDateFormat(e) || e
		}
		var r = 5;
		for (Yn.lastIndex = 0; r >= 0 && Yn.test(e);) e = e.replace(Yn, n), Yn.lastIndex = 0, r -= 1;
		return e
	}

	function R(e) {
		return "function" == typeof e && "[object Function]" === Object.prototype.toString.call(e)
	}

	function L(e, t, n) {
		ir[e] = R(t) ? t : function(e) {
			return e && n ? n : t
		}
	}

	function W(e, t) {
		return o(ir, e) ? ir[e](t._strict, t._locale) : new RegExp(Y(e))
	}

	function Y(e) {
		return e.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function(e, t, n, r, i) {
			return t || n || r || i
		}).replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&")
	}

	function B(e, t) {
		var n, r = t;
		for ("string" == typeof e && (e = [e]), "number" == typeof t && (r = function(e, n) {
				n[t] = g(e)
			}), n = 0; n < e.length; n++) or[e[n]] = r
	}

	function V(e, t) {
		B(e, function(e, n, r, i) {
			r._w = r._w || {}, t(e, r._w, r, i)
		})
	}

	function q(e, t, n) {
		null != t && o(or, e) && or[e](t, n._a, n, e)
	}

	function $(e, t) {
		return new Date(Date.UTC(e, t + 1, 0)).getUTCDate()
	}

	function U(e) {
		return this._months[e.month()]
	}

	function z(e) {
		return this._monthsShort[e.month()]
	}

	function G(e, t, n) {
		var r, i, o;
		for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), r = 0; r <
			12; r++) {
			if (i = a([2e3, r]), n && !this._longMonthsParse[r] && (this._longMonthsParse[r] = new RegExp("^" + this.months(i,
					"").replace(".", "") + "$", "i"), this._shortMonthsParse[r] = new RegExp("^" + this.monthsShort(i, "").replace(
					".", "") + "$", "i")), n || this._monthsParse[r] || (o = "^" + this.months(i, "") + "|^" + this.monthsShort(i, ""),
					this._monthsParse[r] = new RegExp(o.replace(".", ""), "i")), n && "MMMM" === t && this._longMonthsParse[r].test(e))
				return r;
			if (n && "MMM" === t && this._shortMonthsParse[r].test(e)) return r;
			if (!n && this._monthsParse[r].test(e)) return r
		}
	}

	function J(e, t) {
		var n;
		return "string" == typeof t && (t = e.localeData().monthsParse(t), "number" != typeof t) ? e : (n = Math.min(e.date(),
			$(e.year(), t)), e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, n), e)
	}

	function X(t) {
		return null != t ? (J(this, t), e.updateOffset(this, !0), this) : N(this, "Month")
	}

	function K() {
		return $(this.year(), this.month())
	}

	function Z(e) {
		var t, n = e._a;
		return n && l(e).overflow === -2 && (t = n[ar] < 0 || n[ar] > 11 ? ar : n[ur] < 1 || n[ur] > $(n[sr], n[ar]) ? ur :
			n[lr] < 0 || n[lr] > 24 || 24 === n[lr] && (0 !== n[cr] || 0 !== n[dr] || 0 !== n[fr]) ? lr : n[cr] < 0 || n[cr] >
			59 ? cr : n[dr] < 0 || n[dr] > 59 ? dr : n[fr] < 0 || n[fr] > 999 ? fr : -1, l(e)._overflowDayOfYear && (t < sr ||
				t > ur) && (t = ur), l(e).overflow = t), e
	}

	function Q(t) {
		e.suppressDeprecationWarnings === !1 && "undefined" != typeof console && console.warn && console.warn(
			"Deprecation warning: " + t)
	}

	function ee(e, t) {
		var n = !0;
		return s(function() {
			return n && (Q(e + "\n" + (new Error).stack), n = !1), t.apply(this, arguments)
		}, t)
	}

	function te(e, t) {
		mr[e] || (Q(t), mr[e] = !0)
	}

	function ne(e) {
		var t, n, r = e._i,
			i = gr.exec(r);
		if (i) {
			for (l(e).iso = !0, t = 0, n = vr.length; t < n; t++)
				if (vr[t][1].exec(r)) {
					e._f = vr[t][0];
					break
				}
			for (t = 0, n = yr.length; t < n; t++)
				if (yr[t][1].exec(r)) {
					e._f += (i[6] || " ") + yr[t][0];
					break
				}
			r.match(tr) && (e._f += "Z"), we(e)
		} else e._isValid = !1
	}

	function re(t) {
		var n = br.exec(t._i);
		return null !== n ? void(t._d = new Date((+n[1]))) : (ne(t), void(t._isValid === !1 && (delete t._isValid, e.createFromInputFallback(
			t))))
	}

	function ie(e, t, n, r, i, o, s) {
		var a = new Date(e, t, n, r, i, o, s);
		return e < 1970 && a.setFullYear(e), a
	}

	function oe(e) {
		var t = new Date(Date.UTC.apply(null, arguments));
		return e < 1970 && t.setUTCFullYear(e), t
	}

	function se(e) {
		return ae(e) ? 366 : 365
	}

	function ae(e) {
		return e % 4 === 0 && e % 100 !== 0 || e % 400 === 0
	}

	function ue() {
		return ae(this.year())
	}

	function le(e, t, n) {
		var r, i = n - t,
			o = n - e.day();
		return o > i && (o -= 7), o < i - 7 && (o += 7), r = Ne(e).add(o, "d"), {
			week: Math.ceil(r.dayOfYear() / 7),
			year: r.year()
		}
	}

	function ce(e) {
		return le(e, this._week.dow, this._week.doy).week
	}

	function de() {
		return this._week.dow
	}

	function fe() {
		return this._week.doy
	}

	function pe(e) {
		var t = this.localeData().week(this);
		return null == e ? t : this.add(7 * (e - t), "d")
	}

	function he(e) {
		var t = le(this, 1, 4).week;
		return null == e ? t : this.add(7 * (e - t), "d")
	}

	function me(e, t, n, r, i) {
		var o, s = 6 + i - r,
			a = oe(e, 0, 1 + s),
			u = a.getUTCDay();
		return u < i && (u += 7), n = null != n ? 1 * n : i, o = 1 + s + 7 * (t - 1) - u + n, {
			year: o > 0 ? e : e - 1,
			dayOfYear: o > 0 ? o : se(e - 1) + o
		}
	}

	function ge(e) {
		var t = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1;
		return null == e ? t : this.add(e - t, "d")
	}

	function ve(e, t, n) {
		return null != e ? e : null != t ? t : n
	}

	function ye(e) {
		var t = new Date;
		return e._useUTC ? [t.getUTCFullYear(), t.getUTCMonth(), t.getUTCDate()] : [t.getFullYear(), t.getMonth(), t.getDate()]
	}

	function be(e) {
		var t, n, r, i, o = [];
		if (!e._d) {
			for (r = ye(e), e._w && null == e._a[ur] && null == e._a[ar] && xe(e), e._dayOfYear && (i = ve(e._a[sr], r[sr]), e._dayOfYear >
					se(i) && (l(e)._overflowDayOfYear = !0), n = oe(i, 0, e._dayOfYear), e._a[ar] = n.getUTCMonth(), e._a[ur] = n.getUTCDate()
				), t = 0; t < 3 && null == e._a[t]; ++t) e._a[t] = o[t] = r[t];
			for (; t < 7; t++) e._a[t] = o[t] = null == e._a[t] ? 2 === t ? 1 : 0 : e._a[t];
			24 === e._a[lr] && 0 === e._a[cr] && 0 === e._a[dr] && 0 === e._a[fr] && (e._nextDay = !0, e._a[lr] = 0), e._d = (e
					._useUTC ? oe : ie).apply(null, o), null != e._tzm && e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), e._nextDay &&
				(e._a[lr] = 24)
		}
	}

	function xe(e) {
		var t, n, r, i, o, s, a;
		t = e._w, null != t.GG || null != t.W || null != t.E ? (o = 1, s = 4, n = ve(t.GG, e._a[sr], le(Ne(), 1, 4).year), r =
			ve(t.W, 1), i = ve(t.E, 1)) : (o = e._locale._week.dow, s = e._locale._week.doy, n = ve(t.gg, e._a[sr], le(Ne(), o,
			s).year), r = ve(t.w, 1), null != t.d ? (i = t.d, i < o && ++r) : i = null != t.e ? t.e + o : o), a = me(n, r, i,
			s, o), e._a[sr] = a.year, e._dayOfYear = a.dayOfYear
	}

	function we(t) {
		if (t._f === e.ISO_8601) return void ne(t);
		t._a = [], l(t).empty = !0;
		var n, r, i, o, s, a = "" + t._i,
			u = a.length,
			c = 0;
		for (i = P(t._f, t._locale).match(Wn) || [], n = 0; n < i.length; n++) o = i[n], r = (a.match(W(o, t)) || [])[0], r &&
			(s = a.substr(0, a.indexOf(r)), s.length > 0 && l(t).unusedInput.push(s), a = a.slice(a.indexOf(r) + r.length), c +=
				r.length), Vn[o] ? (r ? l(t).empty = !1 : l(t).unusedTokens.push(o), q(o, r, t)) : t._strict && !r && l(t).unusedTokens
			.push(o);
		l(t).charsLeftOver = u - c, a.length > 0 && l(t).unusedInput.push(a), l(t).bigHour === !0 && t._a[lr] <= 12 && t._a[
			lr] > 0 && (l(t).bigHour = void 0), t._a[lr] = De(t._locale, t._a[lr], t._meridiem), be(t), Z(t)
	}

	function De(e, t, n) {
		var r;
		return null == n ? t : null != e.meridiemHour ? e.meridiemHour(t, n) : null != e.isPM ? (r = e.isPM(n), r && t < 12 &&
			(t += 12), r || 12 !== t || (t = 0), t) : t
	}

	function Se(e) {
		var t, n, r, i, o;
		if (0 === e._f.length) return l(e).invalidFormat = !0, void(e._d = new Date(NaN));
		for (i = 0; i < e._f.length; i++) o = 0, t = f({}, e), null != e._useUTC && (t._useUTC = e._useUTC), t._f = e._f[i],
			we(t), c(t) && (o += l(t).charsLeftOver, o += 10 * l(t).unusedTokens.length, l(t).score = o, (null == r || o < r) &&
				(r = o, n = t));
		s(e, n || t)
	}

	function Te(e) {
		if (!e._d) {
			var t = C(e._i);
			e._a = [t.year, t.month, t.day || t.date, t.hour, t.minute, t.second, t.millisecond], be(e)
		}
	}

	function _e(e) {
		var t = new p(Z(Ee(e)));
		return t._nextDay && (t.add(1, "d"), t._nextDay = void 0), t
	}

	function Ee(e) {
		var t = e._i,
			i = e._f;
		return e._locale = e._locale || T(e._l), null === t || void 0 === i && "" === t ? d({
			nullInput: !0
		}) : ("string" == typeof t && (e._i = t = e._locale.preparse(t)), h(t) ? new p(Z(t)) : (n(i) ? Se(e) : i ? we(e) :
			r(t) ? e._d = t : Ce(e), e))
	}

	function Ce(t) {
		var o = t._i;
		void 0 === o ? t._d = new Date : r(o) ? t._d = new Date((+o)) : "string" == typeof o ? re(t) : n(o) ? (t._a = i(o.slice(
			0), function(e) {
			return parseInt(e, 10)
		}), be(t)) : "object" == typeof o ? Te(t) : "number" == typeof o ? t._d = new Date(o) : e.createFromInputFallback(t)
	}

	function ke(e, t, n, r, i) {
		var o = {};
		return "boolean" == typeof n && (r = n, n = void 0), o._isAMomentObject = !0, o._useUTC = o._isUTC = i, o._l = n, o._i =
			e, o._f = t, o._strict = r, _e(o)
	}

	function Ne(e, t, n, r) {
		return ke(e, t, n, r, !1)
	}

	function Oe(e, t) {
		var r, i;
		if (1 === t.length && n(t[0]) && (t = t[0]), !t.length) return Ne();
		for (r = t[0], i = 1; i < t.length; ++i) t[i].isValid() && !t[i][e](r) || (r = t[i]);
		return r
	}

	function Me() {
		var e = [].slice.call(arguments, 0);
		return Oe("isBefore", e)
	}

	function Ae() {
		var e = [].slice.call(arguments, 0);
		return Oe("isAfter", e)
	}

	function Fe(e) {
		var t = C(e),
			n = t.year || 0,
			r = t.quarter || 0,
			i = t.month || 0,
			o = t.week || 0,
			s = t.day || 0,
			a = t.hour || 0,
			u = t.minute || 0,
			l = t.second || 0,
			c = t.millisecond || 0;
		this._milliseconds = +c + 1e3 * l + 6e4 * u + 36e5 * a, this._days = +s + 7 * o, this._months = +i + 3 * r + 12 * n,
			this._data = {}, this._locale = T(), this._bubble()
	}

	function He(e) {
		return e instanceof Fe
	}

	function je(e, t) {
		F(e, 0, 0, function() {
			var e = this.utcOffset(),
				n = "+";
			return e < 0 && (e = -e, n = "-"), n + A(~~(e / 60), 2) + t + A(~~e % 60, 2)
		})
	}

	function Ie(e) {
		var t = (e || "").match(tr) || [],
			n = t[t.length - 1] || [],
			r = (n + "").match(Tr) || ["-", 0, 0],
			i = +(60 * r[1]) + g(r[2]);
		return "+" === r[0] ? i : -i
	}

	function Pe(t, n) {
		var i, o;
		return n._isUTC ? (i = n.clone(), o = (h(t) || r(t) ? +t : +Ne(t)) - +i, i._d.setTime(+i._d + o), e.updateOffset(i, !
			1), i) : Ne(t).local()
	}

	function Re(e) {
		return 15 * -Math.round(e._d.getTimezoneOffset() / 15)
	}

	function Le(t, n) {
		var r, i = this._offset || 0;
		return null != t ? ("string" == typeof t && (t = Ie(t)), Math.abs(t) < 16 && (t = 60 * t), !this._isUTC && n && (r =
			Re(this)), this._offset = t, this._isUTC = !0, null != r && this.add(r, "m"), i !== t && (!n || this._changeInProgress ?
			tt(this, Xe(t - i, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, e.updateOffset(this, !0),
				this._changeInProgress = null)), this) : this._isUTC ? i : Re(this)
	}

	function We(e, t) {
		return null != e ? ("string" != typeof e && (e = -e), this.utcOffset(e, t), this) : -this.utcOffset()
	}

	function Ye(e) {
		return this.utcOffset(0, e)
	}

	function Be(e) {
		return this._isUTC && (this.utcOffset(0, e), this._isUTC = !1, e && this.subtract(Re(this), "m")), this
	}

	function Ve() {
		return this._tzm ? this.utcOffset(this._tzm) : "string" == typeof this._i && this.utcOffset(Ie(this._i)), this
	}

	function qe(e) {
		return e = e ? Ne(e).utcOffset() : 0, (this.utcOffset() - e) % 60 === 0
	}

	function $e() {
		return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset()
	}

	function Ue() {
		if ("undefined" != typeof this._isDSTShifted) return this._isDSTShifted;
		var e = {};
		if (f(e, this), e = Ee(e), e._a) {
			var t = e._isUTC ? a(e._a) : Ne(e._a);
			this._isDSTShifted = this.isValid() && v(e._a, t.toArray()) > 0
		} else this._isDSTShifted = !1;
		return this._isDSTShifted
	}

	function ze() {
		return !this._isUTC
	}

	function Ge() {
		return this._isUTC
	}

	function Je() {
		return this._isUTC && 0 === this._offset
	}

	function Xe(e, t) {
		var n, r, i, s = e,
			a = null;
		return He(e) ? s = {
			ms: e._milliseconds,
			d: e._days,
			M: e._months
		} : "number" == typeof e ? (s = {}, t ? s[t] = e : s.milliseconds = e) : (a = _r.exec(e)) ? (n = "-" === a[1] ? -1 :
			1, s = {
				y: 0,
				d: g(a[ur]) * n,
				h: g(a[lr]) * n,
				m: g(a[cr]) * n,
				s: g(a[dr]) * n,
				ms: g(a[fr]) * n
			}) : (a = Er.exec(e)) ? (n = "-" === a[1] ? -1 : 1, s = {
			y: Ke(a[2], n),
			M: Ke(a[3], n),
			d: Ke(a[4], n),
			h: Ke(a[5], n),
			m: Ke(a[6], n),
			s: Ke(a[7], n),
			w: Ke(a[8], n)
		}) : null == s ? s = {} : "object" == typeof s && ("from" in s || "to" in s) && (i = Qe(Ne(s.from), Ne(s.to)), s = {},
			s.ms = i.milliseconds, s.M = i.months), r = new Fe(s), He(e) && o(e, "_locale") && (r._locale = e._locale), r
	}

	function Ke(e, t) {
		var n = e && parseFloat(e.replace(",", "."));
		return (isNaN(n) ? 0 : n) * t
	}

	function Ze(e, t) {
		var n = {
			milliseconds: 0,
			months: 0
		};
		return n.months = t.month() - e.month() + 12 * (t.year() - e.year()), e.clone().add(n.months, "M").isAfter(t) && --n
			.months, n.milliseconds = +t - +e.clone().add(n.months, "M"), n
	}

	function Qe(e, t) {
		var n;
		return t = Pe(t, e), e.isBefore(t) ? n = Ze(e, t) : (n = Ze(t, e), n.milliseconds = -n.milliseconds, n.months = -n.months),
			n
	}

	function et(e, t) {
		return function(n, r) {
			var i, o;
			return null === r || isNaN(+r) || (te(t, "moment()." + t + "(period, number) is deprecated. Please use moment()." +
					t + "(number, period)."), o = n, n = r, r = o), n = "string" == typeof n ? +n : n, i = Xe(n, r), tt(this, i, e),
				this
		}
	}

	function tt(t, n, r, i) {
		var o = n._milliseconds,
			s = n._days,
			a = n._months;
		i = null == i || i, o && t._d.setTime(+t._d + o * r), s && O(t, "Date", N(t, "Date") + s * r), a && J(t, N(t,
			"Month") + a * r), i && e.updateOffset(t, s || a)
	}

	function nt(e, t) {
		var n = e || Ne(),
			r = Pe(n, this).startOf("day"),
			i = this.diff(r, "days", !0),
			o = i < -6 ? "sameElse" : i < -1 ? "lastWeek" : i < 0 ? "lastDay" : i < 1 ? "sameDay" : i < 2 ? "nextDay" : i < 7 ?
			"nextWeek" : "sameElse";
		return this.format(t && t[o] || this.localeData().calendar(o, this, Ne(n)))
	}

	function rt() {
		return new p(this)
	}

	function it(e, t) {
		var n;
		return t = E("undefined" != typeof t ? t : "millisecond"), "millisecond" === t ? (e = h(e) ? e : Ne(e), +this > +e) :
			(n = h(e) ? +e : +Ne(e), n < +this.clone().startOf(t))
	}

	function ot(e, t) {
		var n;
		return t = E("undefined" != typeof t ? t : "millisecond"), "millisecond" === t ? (e = h(e) ? e : Ne(e), +this < +e) :
			(n = h(e) ? +e : +Ne(e), +this.clone().endOf(t) < n)
	}

	function st(e, t, n) {
		return this.isAfter(e, n) && this.isBefore(t, n)
	}

	function at(e, t) {
		var n;
		return t = E(t || "millisecond"), "millisecond" === t ? (e = h(e) ? e : Ne(e), +this === +e) : (n = +Ne(e), +this.clone()
			.startOf(t) <= n && n <= +this.clone().endOf(t))
	}

	function ut(e, t, n) {
		var r, i, o = Pe(e, this),
			s = 6e4 * (o.utcOffset() - this.utcOffset());
		return t = E(t), "year" === t || "month" === t || "quarter" === t ? (i = lt(this, o), "quarter" === t ? i /= 3 :
			"year" === t && (i /= 12)) : (r = this - o, i = "second" === t ? r / 1e3 : "minute" === t ? r / 6e4 : "hour" === t ?
			r / 36e5 : "day" === t ? (r - s) / 864e5 : "week" === t ? (r - s) / 6048e5 : r), n ? i : m(i)
	}

	function lt(e, t) {
		var n, r, i = 12 * (t.year() - e.year()) + (t.month() - e.month()),
			o = e.clone().add(i, "months");
		return t - o < 0 ? (n = e.clone().add(i - 1, "months"), r = (t - o) / (o - n)) : (n = e.clone().add(i + 1, "months"),
			r = (t - o) / (n - o)), -(i + r)
	}

	function ct() {
		return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
	}

	function dt() {
		var e = this.clone().utc();
		return 0 < e.year() && e.year() <= 9999 ? "function" == typeof Date.prototype.toISOString ? this.toDate().toISOString() :
			I(e, "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]") : I(e, "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
	}

	function ft(t) {
		var n = I(this, t || e.defaultFormat);
		return this.localeData().postformat(n)
	}

	function pt(e, t) {
		return this.isValid() ? Xe({
			to: this,
			from: e
		}).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
	}

	function ht(e) {
		return this.from(Ne(), e)
	}

	function mt(e, t) {
		return this.isValid() ? Xe({
			from: this,
			to: e
		}).locale(this.locale()).humanize(!t) : this.localeData().invalidDate()
	}

	function gt(e) {
		return this.to(Ne(), e)
	}

	function vt(e) {
		var t;
		return void 0 === e ? this._locale._abbr : (t = T(e), null != t && (this._locale = t), this)
	}

	function yt() {
		return this._locale
	}

	function bt(e) {
		switch (e = E(e)) {
			case "year":
				this.month(0);
			case "quarter":
			case "month":
				this.date(1);
			case "week":
			case "isoWeek":
			case "day":
				this.hours(0);
			case "hour":
				this.minutes(0);
			case "minute":
				this.seconds(0);
			case "second":
				this.milliseconds(0)
		}
		return "week" === e && this.weekday(0), "isoWeek" === e && this.isoWeekday(1), "quarter" === e && this.month(3 *
			Math.floor(this.month() / 3)), this
	}

	function xt(e) {
		return e = E(e), void 0 === e || "millisecond" === e ? this : this.startOf(e).add(1, "isoWeek" === e ? "week" : e).subtract(
			1, "ms")
	}

	function wt() {
		return +this._d - 6e4 * (this._offset || 0)
	}

	function Dt() {
		return Math.floor(+this / 1e3)
	}

	function St() {
		return this._offset ? new Date((+this)) : this._d
	}

	function Tt() {
		var e = this;
		return [e.year(), e.month(), e.date(), e.hour(), e.minute(), e.second(), e.millisecond()]
	}

	function _t() {
		var e = this;
		return {
			years: e.year(),
			months: e.month(),
			date: e.date(),
			hours: e.hours(),
			minutes: e.minutes(),
			seconds: e.seconds(),
			milliseconds: e.milliseconds()
		}
	}

	function Et() {
		return c(this)
	}

	function Ct() {
		return s({}, l(this))
	}

	function kt() {
		return l(this).overflow
	}

	function Nt(e, t) {
		F(0, [e, e.length], 0, t)
	}

	function Ot(e, t, n) {
		return le(Ne([e, 11, 31 + t - n]), t, n).week
	}

	function Mt(e) {
		var t = le(this, this.localeData()._week.dow, this.localeData()._week.doy).year;
		return null == e ? t : this.add(e - t, "y")
	}

	function At(e) {
		var t = le(this, 1, 4).year;
		return null == e ? t : this.add(e - t, "y")
	}

	function Ft() {
		return Ot(this.year(), 1, 4)
	}

	function Ht() {
		var e = this.localeData()._week;
		return Ot(this.year(), e.dow, e.doy)
	}

	function jt(e) {
		return null == e ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (e - 1) + this.month() % 3)
	}

	function It(e, t) {
		return "string" != typeof e ? e : isNaN(e) ? (e = t.weekdaysParse(e), "number" == typeof e ? e : null) : parseInt(e,
			10)
	}

	function Pt(e) {
		return this._weekdays[e.day()]
	}

	function Rt(e) {
		return this._weekdaysShort[e.day()]
	}

	function Lt(e) {
		return this._weekdaysMin[e.day()]
	}

	function Wt(e) {
		var t, n, r;
		for (this._weekdaysParse = this._weekdaysParse || [], t = 0; t < 7; t++)
			if (this._weekdaysParse[t] || (n = Ne([2e3, 1]).day(t), r = "^" + this.weekdays(n, "") + "|^" + this.weekdaysShort(
					n, "") + "|^" + this.weekdaysMin(n, ""), this._weekdaysParse[t] = new RegExp(r.replace(".", ""), "i")), this._weekdaysParse[
					t].test(e)) return t
	}

	function Yt(e) {
		var t = this._isUTC ? this._d.getUTCDay() : this._d.getDay();
		return null != e ? (e = It(e, this.localeData()), this.add(e - t, "d")) : t
	}

	function Bt(e) {
		var t = (this.day() + 7 - this.localeData()._week.dow) % 7;
		return null == e ? t : this.add(e - t, "d")
	}

	function Vt(e) {
		return null == e ? this.day() || 7 : this.day(this.day() % 7 ? e : e - 7)
	}

	function qt(e, t) {
		F(e, 0, 0, function() {
			return this.localeData().meridiem(this.hours(), this.minutes(), t)
		})
	}

	function $t(e, t) {
		return t._meridiemParse
	}

	function Ut(e) {
		return "p" === (e + "").toLowerCase().charAt(0)
	}

	function zt(e, t, n) {
		return e > 11 ? n ? "pm" : "PM" : n ? "am" : "AM"
	}

	function Gt(e, t) {
		t[fr] = g(1e3 * ("0." + e))
	}

	function Jt() {
		return this._isUTC ? "UTC" : ""
	}

	function Xt() {
		return this._isUTC ? "Coordinated Universal Time" : ""
	}

	function Kt(e) {
		return Ne(1e3 * e)
	}

	function Zt() {
		return Ne.apply(null, arguments).parseZone()
	}

	function Qt(e, t, n) {
		var r = this._calendar[e];
		return "function" == typeof r ? r.call(t, n) : r
	}

	function en(e) {
		var t = this._longDateFormat[e],
			n = this._longDateFormat[e.toUpperCase()];
		return t || !n ? t : (this._longDateFormat[e] = n.replace(/MMMM|MM|DD|dddd/g, function(e) {
			return e.slice(1)
		}), this._longDateFormat[e])
	}

	function tn() {
		return this._invalidDate
	}

	function nn(e) {
		return this._ordinal.replace("%d", e)
	}

	function rn(e) {
		return e
	}

	function on(e, t, n, r) {
		var i = this._relativeTime[n];
		return "function" == typeof i ? i(e, t, n, r) : i.replace(/%d/i, e)
	}

	function sn(e, t) {
		var n = this._relativeTime[e > 0 ? "future" : "past"];
		return "function" == typeof n ? n(t) : n.replace(/%s/i, t)
	}

	function an(e) {
		var t, n;
		for (n in e) t = e[n], "function" == typeof t ? this[n] = t : this["_" + n] = t;
		this._ordinalParseLenient = new RegExp(this._ordinalParse.source + "|" + /\d{1,2}/.source)
	}

	function un(e, t, n, r) {
		var i = T(),
			o = a().set(r, t);
		return i[n](o, e)
	}

	function ln(e, t, n, r, i) {
		if ("number" == typeof e && (t = e, e = void 0), e = e || "", null != t) return un(e, t, n, i);
		var o, s = [];
		for (o = 0; o < r; o++) s[o] = un(e, o, n, i);
		return s
	}

	function cn(e, t) {
		return ln(e, t, "months", 12, "month")
	}

	function dn(e, t) {
		return ln(e, t, "monthsShort", 12, "month")
	}

	function fn(e, t) {
		return ln(e, t, "weekdays", 7, "day")
	}

	function pn(e, t) {
		return ln(e, t, "weekdaysShort", 7, "day")
	}

	function hn(e, t) {
		return ln(e, t, "weekdaysMin", 7, "day")
	}

	function mn() {
		var e = this._data;
		return this._milliseconds = Jr(this._milliseconds), this._days = Jr(this._days), this._months = Jr(this._months), e.milliseconds =
			Jr(e.milliseconds), e.seconds = Jr(e.seconds), e.minutes = Jr(e.minutes), e.hours = Jr(e.hours), e.months = Jr(e.months),
			e.years = Jr(e.years), this
	}

	function gn(e, t, n, r) {
		var i = Xe(t, n);
		return e._milliseconds += r * i._milliseconds, e._days += r * i._days, e._months += r * i._months, e._bubble()
	}

	function vn(e, t) {
		return gn(this, e, t, 1)
	}

	function yn(e, t) {
		return gn(this, e, t, -1)
	}

	function bn(e) {
		return e < 0 ? Math.floor(e) : Math.ceil(e)
	}

	function xn() {
		var e, t, n, r, i, o = this._milliseconds,
			s = this._days,
			a = this._months,
			u = this._data;
		return o >= 0 && s >= 0 && a >= 0 || o <= 0 && s <= 0 && a <= 0 || (o += 864e5 * bn(Dn(a) + s), s = 0, a = 0), u.milliseconds =
			o % 1e3, e = m(o / 1e3), u.seconds = e % 60, t = m(e / 60), u.minutes = t % 60, n = m(t / 60), u.hours = n % 24, s +=
			m(n / 24), i = m(wn(s)), a += i, s -= bn(Dn(i)), r = m(a / 12), a %= 12, u.days = s, u.months = a, u.years = r,
			this
	}

	function wn(e) {
		return 4800 * e / 146097
	}

	function Dn(e) {
		return 146097 * e / 4800
	}

	function Sn(e) {
		var t, n, r = this._milliseconds;
		if (e = E(e), "month" === e || "year" === e) return t = this._days + r / 864e5, n = this._months + wn(t), "month" ===
			e ? n : n / 12;
		switch (t = this._days + Math.round(Dn(this._months)), e) {
			case "week":
				return t / 7 + r / 6048e5;
			case "day":
				return t + r / 864e5;
			case "hour":
				return 24 * t + r / 36e5;
			case "minute":
				return 1440 * t + r / 6e4;
			case "second":
				return 86400 * t + r / 1e3;
			case "millisecond":
				return Math.floor(864e5 * t) + r;
			default:
				throw new Error("Unknown unit " + e)
		}
	}

	function Tn() {
		return this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * g(this._months / 12)
	}

	function _n(e) {
		return function() {
			return this.as(e)
		}
	}

	function En(e) {
		return e = E(e), this[e + "s"]()
	}

	function Cn(e) {
		return function() {
			return this._data[e]
		}
	}

	function kn() {
		return m(this.days() / 7)
	}

	function Nn(e, t, n, r, i) {
		return i.relativeTime(t || 1, !!n, e, r)
	}

	function On(e, t, n) {
		var r = Xe(e).abs(),
			i = di(r.as("s")),
			o = di(r.as("m")),
			s = di(r.as("h")),
			a = di(r.as("d")),
			u = di(r.as("M")),
			l = di(r.as("y")),
			c = i < fi.s && ["s", i] || 1 === o && ["m"] || o < fi.m && ["mm", o] || 1 === s && ["h"] || s < fi.h && ["hh", s] ||
			1 === a && ["d"] || a < fi.d && ["dd", a] || 1 === u && ["M"] || u < fi.M && ["MM", u] || 1 === l && ["y"] || ["yy",
				l
			];
		return c[2] = t, c[3] = +e > 0, c[4] = n, Nn.apply(null, c)
	}

	function Mn(e, t) {
		return void 0 !== fi[e] && (void 0 === t ? fi[e] : (fi[e] = t, !0))
	}

	function An(e) {
		var t = this.localeData(),
			n = On(this, !e, t);
		return e && (n = t.pastFuture(+this, n)), t.postformat(n)
	}

	function Fn() {
		var e, t, n, r = pi(this._milliseconds) / 1e3,
			i = pi(this._days),
			o = pi(this._months);
		e = m(r / 60), t = m(e / 60), r %= 60, e %= 60, n = m(o / 12), o %= 12;
		var s = n,
			a = o,
			u = i,
			l = t,
			c = e,
			d = r,
			f = this.asSeconds();
		return f ? (f < 0 ? "-" : "") + "P" + (s ? s + "Y" : "") + (a ? a + "M" : "") + (u ? u + "D" : "") + (l || c || d ?
			"T" : "") + (l ? l + "H" : "") + (c ? c + "M" : "") + (d ? d + "S" : "") : "P0D"
	}
	var Hn, jn, In = e.momentProperties = [],
		Pn = !1,
		Rn = {},
		Ln = {},
		Wn =
		/(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
		Yn = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,
		Bn = {},
		Vn = {},
		qn = /\d/,
		$n = /\d\d/,
		Un = /\d{3}/,
		zn = /\d{4}/,
		Gn = /[+-]?\d{6}/,
		Jn = /\d\d?/,
		Xn = /\d{1,3}/,
		Kn = /\d{1,4}/,
		Zn = /[+-]?\d{1,6}/,
		Qn = /\d+/,
		er = /[+-]?\d+/,
		tr = /Z|[+-]\d\d:?\d\d/gi,
		nr = /[+-]?\d+(\.\d{1,3})?/,
		rr =
		/[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,
		ir = {},
		or = {},
		sr = 0,
		ar = 1,
		ur = 2,
		lr = 3,
		cr = 4,
		dr = 5,
		fr = 6;
	F("M", ["MM", 2], "Mo", function() {
		return this.month() + 1
	}), F("MMM", 0, 0, function(e) {
		return this.localeData().monthsShort(this, e)
	}), F("MMMM", 0, 0, function(e) {
		return this.localeData().months(this, e)
	}), _("month", "M"), L("M", Jn), L("MM", Jn, $n), L("MMM", rr), L("MMMM", rr), B(["M", "MM"], function(e, t) {
		t[ar] = g(e) - 1
	}), B(["MMM", "MMMM"], function(e, t, n, r) {
		var i = n._locale.monthsParse(e, r, n._strict);
		null != i ? t[ar] = i : l(n).invalidMonth = e
	});
	var pr = "January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
		hr = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
		mr = {};
	e.suppressDeprecationWarnings = !1;
	var gr =
		/^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
		vr = [
			["YYYYYY-MM-DD", /[+-]\d{6}-\d{2}-\d{2}/],
			["YYYY-MM-DD", /\d{4}-\d{2}-\d{2}/],
			["GGGG-[W]WW-E", /\d{4}-W\d{2}-\d/],
			["GGGG-[W]WW", /\d{4}-W\d{2}/],
			["YYYY-DDD", /\d{4}-\d{3}/]
		],
		yr = [
			["HH:mm:ss.SSSS", /(T| )\d\d:\d\d:\d\d\.\d+/],
			["HH:mm:ss", /(T| )\d\d:\d\d:\d\d/],
			["HH:mm", /(T| )\d\d:\d\d/],
			["HH", /(T| )\d\d/]
		],
		br = /^\/?Date\((\-?\d+)/i;
	e.createFromInputFallback = ee(
			"moment construction falls back to js Date. This is discouraged and will be removed in upcoming major release. Please refer to https://github.com/moment/moment/issues/1407 for more info.",
			function(e) {
				e._d = new Date(e._i + (e._useUTC ? " UTC" : ""))
			}), F(0, ["YY", 2], 0, function() {
			return this.year() % 100
		}), F(0, ["YYYY", 4], 0, "year"), F(0, ["YYYYY", 5], 0, "year"), F(0, ["YYYYYY", 6, !0], 0, "year"), _("year", "y"),
		L("Y", er), L("YY", Jn, $n), L("YYYY", Kn, zn), L("YYYYY", Zn, Gn), L("YYYYYY", Zn, Gn), B(["YYYYY", "YYYYYY"], sr),
		B("YYYY", function(t, n) {
			n[sr] = 2 === t.length ? e.parseTwoDigitYear(t) : g(t)
		}), B("YY", function(t, n) {
			n[sr] = e.parseTwoDigitYear(t)
		}), e.parseTwoDigitYear = function(e) {
			return g(e) + (g(e) > 68 ? 1900 : 2e3)
		};
	var xr = k("FullYear", !1);
	F("w", ["ww", 2], "wo", "week"), F("W", ["WW", 2], "Wo", "isoWeek"), _("week", "w"), _("isoWeek", "W"), L("w", Jn), L(
		"ww", Jn, $n), L("W", Jn), L("WW", Jn, $n), V(["w", "ww", "W", "WW"], function(e, t, n, r) {
		t[r.substr(0, 1)] = g(e)
	});
	var wr = {
		dow: 0,
		doy: 6
	};
	F("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), _("dayOfYear", "DDD"), L("DDD", Xn), L("DDDD", Un), B(["DDD", "DDDD"],
		function(e, t, n) {
			n._dayOfYear = g(e)
		}), e.ISO_8601 = function() {};
	var Dr = ee("moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548",
			function() {
				var e = Ne.apply(null, arguments);
				return e < this ? this : e
			}),
		Sr = ee("moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548", function() {
			var e = Ne.apply(null, arguments);
			return e > this ? this : e
		});
	je("Z", ":"), je("ZZ", ""), L("Z", tr), L("ZZ", tr), B(["Z", "ZZ"], function(e, t, n) {
		n._useUTC = !0, n._tzm = Ie(e)
	});
	var Tr = /([\+\-]|\d\d)/gi;
	e.updateOffset = function() {};
	var _r = /(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/,
		Er =
		/^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/;
	Xe.fn = Fe.prototype;
	var Cr = et(1, "add"),
		kr = et(-1, "subtract");
	e.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ";
	var Nr = ee(
		"moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.",
		function(e) {
			return void 0 === e ? this.localeData() : this.locale(e)
		});
	F(0, ["gg", 2], 0, function() {
		return this.weekYear() % 100
	}), F(0, ["GG", 2], 0, function() {
		return this.isoWeekYear() % 100
	}), Nt("gggg", "weekYear"), Nt("ggggg", "weekYear"), Nt("GGGG", "isoWeekYear"), Nt("GGGGG", "isoWeekYear"), _(
		"weekYear", "gg"), _("isoWeekYear", "GG"), L("G", er), L("g", er), L("GG", Jn, $n), L("gg", Jn, $n), L("GGGG", Kn,
		zn), L("gggg", Kn, zn), L("GGGGG", Zn, Gn), L("ggggg", Zn, Gn), V(["gggg", "ggggg", "GGGG", "GGGGG"], function(e, t,
		n, r) {
		t[r.substr(0, 2)] = g(e)
	}), V(["gg", "GG"], function(t, n, r, i) {
		n[i] = e.parseTwoDigitYear(t)
	}), F("Q", 0, 0, "quarter"), _("quarter", "Q"), L("Q", qn), B("Q", function(e, t) {
		t[ar] = 3 * (g(e) - 1)
	}), F("D", ["DD", 2], "Do", "date"), _("date", "D"), L("D", Jn), L("DD", Jn, $n), L("Do", function(e, t) {
		return e ? t._ordinalParse : t._ordinalParseLenient
	}), B(["D", "DD"], ur), B("Do", function(e, t) {
		t[ur] = g(e.match(Jn)[0], 10)
	});
	var Or = k("Date", !0);
	F("d", 0, "do", "day"), F("dd", 0, 0, function(e) {
		return this.localeData().weekdaysMin(this, e)
	}), F("ddd", 0, 0, function(e) {
		return this.localeData().weekdaysShort(this, e)
	}), F("dddd", 0, 0, function(e) {
		return this.localeData().weekdays(this, e)
	}), F("e", 0, 0, "weekday"), F("E", 0, 0, "isoWeekday"), _("day", "d"), _("weekday", "e"), _("isoWeekday", "E"), L(
		"d", Jn), L("e", Jn), L("E", Jn), L("dd", rr), L("ddd", rr), L("dddd", rr), V(["dd", "ddd", "dddd"], function(e, t,
		n) {
		var r = n._locale.weekdaysParse(e);
		null != r ? t.d = r : l(n).invalidWeekday = e
	}), V(["d", "e", "E"], function(e, t, n, r) {
		t[r] = g(e)
	});
	var Mr = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
		Ar = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
		Fr = "Su_Mo_Tu_We_Th_Fr_Sa".split("_");
	F("H", ["HH", 2], 0, "hour"), F("h", ["hh", 2], 0, function() {
		return this.hours() % 12 || 12
	}), qt("a", !0), qt("A", !1), _("hour", "h"), L("a", $t), L("A", $t), L("H", Jn), L("h", Jn), L("HH", Jn, $n), L(
		"hh", Jn, $n), B(["H", "HH"], lr), B(["a", "A"], function(e, t, n) {
		n._isPm = n._locale.isPM(e), n._meridiem = e
	}), B(["h", "hh"], function(e, t, n) {
		t[lr] = g(e), l(n).bigHour = !0
	});
	var Hr = /[ap]\.?m?\.?/i,
		jr = k("Hours", !0);
	F("m", ["mm", 2], 0, "minute"), _("minute", "m"), L("m", Jn), L("mm", Jn, $n), B(["m", "mm"], cr);
	var Ir = k("Minutes", !1);
	F("s", ["ss", 2], 0, "second"), _("second", "s"), L("s", Jn), L("ss", Jn, $n), B(["s", "ss"], dr);
	var Pr = k("Seconds", !1);
	F("S", 0, 0, function() {
		return ~~(this.millisecond() / 100)
	}), F(0, ["SS", 2], 0, function() {
		return ~~(this.millisecond() / 10)
	}), F(0, ["SSS", 3], 0, "millisecond"), F(0, ["SSSS", 4], 0, function() {
		return 10 * this.millisecond()
	}), F(0, ["SSSSS", 5], 0, function() {
		return 100 * this.millisecond()
	}), F(0, ["SSSSSS", 6], 0, function() {
		return 1e3 * this.millisecond()
	}), F(0, ["SSSSSSS", 7], 0, function() {
		return 1e4 * this.millisecond()
	}), F(0, ["SSSSSSSS", 8], 0, function() {
		return 1e5 * this.millisecond()
	}), F(0, ["SSSSSSSSS", 9], 0, function() {
		return 1e6 * this.millisecond()
	}), _("millisecond", "ms"), L("S", Xn, qn), L("SS", Xn, $n), L("SSS", Xn, Un);
	var Rr;
	for (Rr = "SSSS"; Rr.length <= 9; Rr += "S") L(Rr, Qn);
	for (Rr = "S"; Rr.length <= 9; Rr += "S") B(Rr, Gt);
	var Lr = k("Milliseconds", !1);
	F("z", 0, 0, "zoneAbbr"), F("zz", 0, 0, "zoneName");
	var Wr = p.prototype;
	Wr.add = Cr, Wr.calendar = nt, Wr.clone = rt, Wr.diff = ut, Wr.endOf = xt, Wr.format = ft, Wr.from = pt, Wr.fromNow =
		ht, Wr.to = mt, Wr.toNow = gt, Wr.get = M, Wr.invalidAt = kt, Wr.isAfter = it, Wr.isBefore = ot, Wr.isBetween = st,
		Wr.isSame = at, Wr.isValid = Et, Wr.lang = Nr, Wr.locale = vt, Wr.localeData = yt, Wr.max = Sr, Wr.min = Dr, Wr.parsingFlags =
		Ct, Wr.set = M, Wr.startOf = bt, Wr.subtract = kr, Wr.toArray = Tt, Wr.toObject = _t, Wr.toDate = St, Wr.toISOString =
		dt, Wr.toJSON = dt, Wr.toString = ct, Wr.unix = Dt, Wr.valueOf = wt, Wr.year = xr, Wr.isLeapYear = ue, Wr.weekYear =
		Mt, Wr.isoWeekYear = At, Wr.quarter = Wr.quarters = jt, Wr.month = X, Wr.daysInMonth = K, Wr.week = Wr.weeks = pe,
		Wr.isoWeek = Wr.isoWeeks = he, Wr.weeksInYear = Ht, Wr.isoWeeksInYear = Ft, Wr.date = Or, Wr.day = Wr.days = Yt, Wr.weekday =
		Bt, Wr.isoWeekday = Vt, Wr.dayOfYear = ge, Wr.hour = Wr.hours = jr, Wr.minute = Wr.minutes = Ir, Wr.second = Wr.seconds =
		Pr,
		Wr.millisecond = Wr.milliseconds = Lr, Wr.utcOffset = Le, Wr.utc = Ye, Wr.local = Be, Wr.parseZone = Ve, Wr.hasAlignedHourOffset =
		qe, Wr.isDST = $e, Wr.isDSTShifted = Ue, Wr.isLocal = ze, Wr.isUtcOffset = Ge, Wr.isUtc = Je, Wr.isUTC = Je, Wr.zoneAbbr =
		Jt, Wr.zoneName = Xt, Wr.dates = ee("dates accessor is deprecated. Use date instead.", Or), Wr.months = ee(
			"months accessor is deprecated. Use month instead", X), Wr.years = ee(
			"years accessor is deprecated. Use year instead", xr), Wr.zone = ee(
			"moment().zone is deprecated, use moment().utcOffset instead. https://github.com/moment/moment/issues/1779", We);
	var Yr = Wr,
		Br = {
			sameDay: "[Today at] LT",
			nextDay: "[Tomorrow at] LT",
			nextWeek: "dddd [at] LT",
			lastDay: "[Yesterday at] LT",
			lastWeek: "[Last] dddd [at] LT",
			sameElse: "L"
		},
		Vr = {
			LTS: "h:mm:ss A",
			LT: "h:mm A",
			L: "MM/DD/YYYY",
			LL: "MMMM D, YYYY",
			LLL: "MMMM D, YYYY h:mm A",
			LLLL: "dddd, MMMM D, YYYY h:mm A"
		},
		qr = "Invalid date",
		$r = "%d",
		Ur = /\d{1,2}/,
		zr = {
			future: "in %s",
			past: "%s ago",
			s: "a few seconds",
			m: "a minute",
			mm: "%d minutes",
			h: "an hour",
			hh: "%d hours",
			d: "a day",
			dd: "%d days",
			M: "a month",
			MM: "%d months",
			y: "a year",
			yy: "%d years"
		},
		Gr = y.prototype;
	Gr._calendar = Br, Gr.calendar = Qt, Gr._longDateFormat = Vr, Gr.longDateFormat = en, Gr._invalidDate = qr, Gr.invalidDate =
		tn, Gr._ordinal = $r, Gr.ordinal = nn, Gr._ordinalParse = Ur, Gr.preparse = rn, Gr.postformat = rn, Gr._relativeTime =
		zr, Gr.relativeTime = on, Gr.pastFuture = sn, Gr.set = an, Gr.months = U, Gr._months = pr, Gr.monthsShort = z, Gr._monthsShort =
		hr, Gr.monthsParse = G, Gr.week = ce, Gr._week = wr, Gr.firstDayOfYear = fe, Gr.firstDayOfWeek = de, Gr.weekdays =
		Pt, Gr._weekdays = Mr, Gr.weekdaysMin = Lt, Gr._weekdaysMin = Fr, Gr.weekdaysShort = Rt, Gr._weekdaysShort = Ar, Gr.weekdaysParse =
		Wt, Gr.isPM = Ut, Gr._meridiemParse = Hr, Gr.meridiem = zt, D("en", {
			ordinalParse: /\d{1,2}(th|st|nd|rd)/,
			ordinal: function(e) {
				var t = e % 10,
					n = 1 === g(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th";
				return e + n
			}
		}), e.lang = ee("moment.lang is deprecated. Use moment.locale instead.", D), e.langData = ee(
			"moment.langData is deprecated. Use moment.localeData instead.", T);
	var Jr = Math.abs,
		Xr = _n("ms"),
		Kr = _n("s"),
		Zr = _n("m"),
		Qr = _n("h"),
		ei = _n("d"),
		ti = _n("w"),
		ni = _n("M"),
		ri = _n("y"),
		ii = Cn("milliseconds"),
		oi = Cn("seconds"),
		si = Cn("minutes"),
		ai = Cn("hours"),
		ui = Cn("days"),
		li = Cn("months"),
		ci = Cn("years"),
		di = Math.round,
		fi = {
			s: 45,
			m: 45,
			h: 22,
			d: 26,
			M: 11
		},
		pi = Math.abs,
		hi = Fe.prototype;
	hi.abs = mn, hi.add = vn, hi.subtract = yn, hi.as = Sn, hi.asMilliseconds = Xr, hi.asSeconds = Kr, hi.asMinutes = Zr,
		hi.asHours = Qr, hi.asDays = ei, hi.asWeeks = ti, hi.asMonths = ni, hi.asYears = ri, hi.valueOf = Tn, hi._bubble =
		xn, hi.get = En, hi.milliseconds = ii, hi.seconds = oi, hi.minutes = si, hi.hours = ai, hi.days = ui, hi.weeks = kn,
		hi.months = li, hi.years = ci, hi.humanize = An, hi.toISOString = Fn, hi.toString = Fn, hi.toJSON = Fn, hi.locale =
		vt, hi.localeData = yt, hi.toIsoString = ee(
			"toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", Fn), hi.lang = Nr, F("X", 0,
			0, "unix"), F("x", 0, 0, "valueOf"), L("x", er), L("X", nr), B("X", function(e, t, n) {
			n._d = new Date(1e3 * parseFloat(e, 10))
		}), B("x", function(e, t, n) {
			n._d = new Date(g(e))
		}), e.version = "2.10.6", t(Ne), e.fn = Yr, e.min = Me, e.max = Ae, e.utc = a, e.unix = Kt, e.months = cn, e.isDate =
		r, e.locale = D, e.invalid = d, e.duration = Xe, e.isMoment = h, e.weekdays = fn, e.parseZone = Zt, e.localeData = T,
		e.isDuration = He, e.monthsShort = dn, e.weekdaysMin = hn, e.defineLocale = S, e.weekdaysShort = pn, e.normalizeUnits =
		E, e.relativeTimeThreshold = Mn;
	var mi = e;
	return mi
}),
/*!
 * Knockout JavaScript library v3.4.0
 * (c) Steven Sanderson - http://knockoutjs.com/
 * License: MIT (http://www.opensource.org/licenses/mit-license.php)
 */
function() {
	var e = !0;
	! function(t) {
		var n = this || (0, eval)("this"),
			r = n.document,
			i = n.navigator,
			o = n.jQuery,
			s = n.JSON;
		! function(e) {
			"function" == typeof define && define.amd ? define(["exports", "require"], e) : e("object" == typeof exports &&
				"object" == typeof module ? module.exports || exports : n.ko = {})
		}(function(a, u) {
			function l(e, t) {
				var n = null === e || typeof e in b;
				return !!n && e === t
			}

			function c(e, n) {
				var r;
				return function() {
					r || (r = y.utils.setTimeout(function() {
						r = t, e()
					}, n))
				}
			}

			function d(e, t) {
				var n;
				return function() {
					clearTimeout(n), n = y.utils.setTimeout(e, t)
				}
			}

			function f(e) {
				var t = this;
				return e && y.utils.objectForEach(e, function(e, n) {
					var r = y.extenders[e];
					"function" == typeof r && (t = r(t, n) || t)
				}), t
			}

			function p(e, t) {
				t && t !== x ? "beforeChange" === t ? this._limitBeforeChange(e) : this._origNotifySubscribers(e, t) : this._limitChange(
					e)
			}

			function h(e, t) {
				null !== t && t.dispose && t.dispose()
			}

			function m(e, t) {
				var n = this.computedObservable,
					r = n[E];
				r.isDisposed || (this.disposalCount && this.disposalCandidates[t] ? (n.addDependencyTracking(t, e, this.disposalCandidates[
					t]), this.disposalCandidates[t] = null, --this.disposalCount) : r.dependencyTracking[t] || n.addDependencyTracking(
					t, e, r.isSleeping ? {
						_target: e
					} : n.subscribeToDependency(e)))
			}

			function g(e) {
				y.bindingHandlers[e] = {
					init: function(t, n, r, i, o) {
						var s = function() {
							var t = {};
							return t[e] = n(), t
						};
						return y.bindingHandlers.event.init.call(this, t, s, r, i, o)
					}
				}
			}

			function v(e, t, n, r) {
				y.bindingHandlers[e] = {
					init: function(e, i, o, s, a) {
						var u, l;
						return y.computed(function() {
							var o = y.utils.unwrapObservable(i()),
								s = !n != !o,
								c = !l,
								d = c || t || s !== u;
							d && (c && y.computedContext.getDependenciesCount() && (l = y.utils.cloneNodes(y.virtualElements.childNodes(
								e), !0)), s ? (c || y.virtualElements.setDomNodeChildren(e, y.utils.cloneNodes(l)), y.applyBindingsToDescendants(
								r ? r(a, o) : a, e)) : y.virtualElements.emptyNode(e), u = s)
						}, null, {
							disposeWhenNodeIsRemoved: e
						}), {
							controlsDescendantBindings: !0
						}
					}
				}, y.expressionRewriting.bindingRewriteValidators[e] = !1, y.virtualElements.allowedBindings[e] = !0
			}
			var y = "undefined" != typeof a ? a : {};
			y.exportSymbol = function(e, t) {
					for (var n = e.split("."), r = y, i = 0; i < n.length - 1; i++) r = r[n[i]];
					r[n[n.length - 1]] = t
				}, y.exportProperty = function(e, t, n) {
					e[t] = n
				}, y.version = "3.4.0", y.exportSymbol("version", y.version), y.options = {
					deferUpdates: !1,
					useOnlyNativeEvents: !1
				}, y.utils = function() {
					function a(e, t) {
						for (var n in e) e.hasOwnProperty(n) && t(n, e[n])
					}

					function u(e, t) {
						if (t)
							for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);
						return e
					}

					function l(e, t) {
						return e.__proto__ = t, e
					}

					function c(e, t) {
						if ("input" !== y.utils.tagNameLower(e) || !e.type) return !1;
						if ("click" != t.toLowerCase()) return !1;
						var n = e.type;
						return "checkbox" == n || "radio" == n
					}

					function d(e, t, n) {
						var r;
						t && ("object" == typeof e.classList ? (r = e.classList[n ? "add" : "remove"], y.utils.arrayForEach(t.match(S),
							function(t) {
								r.call(e.classList, t)
							})) : "string" == typeof e.className.baseVal ? f(e.className, "baseVal", t, n) : f(e, "className", t, n))
					}

					function f(e, t, n, r) {
						var i = e[t].match(S) || [];
						y.utils.arrayForEach(n.match(S), function(e) {
							y.utils.addOrRemoveItem(i, e, r)
						}), e[t] = i.join(" ")
					}
					var p = {
						__proto__: []
					}
					instanceof Array, h = !e && "function" == typeof Symbol, m = {}, g = {}, v = i && /Firefox\/2/i.test(i.userAgent) ?
						"KeyboardEvent" : "UIEvents";
					m[v] = ["keyup", "keydown", "keypress"], m.MouseEvents = ["click", "dblclick", "mousedown", "mouseup",
						"mousemove", "mouseover", "mouseout", "mouseenter", "mouseleave"
					], a(m, function(e, t) {
						if (t.length)
							for (var n = 0, r = t.length; n < r; n++) g[t[n]] = e
					});
					var b = {
							propertychange: !0
						},
						x = r && function() {
							for (var e = 3, n = r.createElement("div"), i = n.getElementsByTagName("i"); n.innerHTML = "<!--[if gt IE " +
								++e + "]><i></i><![endif]-->", i[0];);
							return e > 4 ? e : t
						}(),
						w = 6 === x,
						D = 7 === x,
						S = /\S+/g;
					return {
						fieldsIncludedWithJsonPost: ["authenticity_token", /^__RequestVerificationToken(_.*)?$/],
						arrayForEach: function(e, t) {
							for (var n = 0, r = e.length; n < r; n++) t(e[n], n)
						},
						arrayIndexOf: function(e, t) {
							if ("function" == typeof Array.prototype.indexOf) return Array.prototype.indexOf.call(e, t);
							for (var n = 0, r = e.length; n < r; n++)
								if (e[n] === t) return n;
							return -1
						},
						arrayFirst: function(e, t, n) {
							for (var r = 0, i = e.length; r < i; r++)
								if (t.call(n, e[r], r)) return e[r];
							return null
						},
						arrayRemoveItem: function(e, t) {
							var n = y.utils.arrayIndexOf(e, t);
							n > 0 ? e.splice(n, 1) : 0 === n && e.shift()
						},
						arrayGetDistinctValues: function(e) {
							e = e || [];
							for (var t = [], n = 0, r = e.length; n < r; n++) y.utils.arrayIndexOf(t, e[n]) < 0 && t.push(e[n]);
							return t
						},
						arrayMap: function(e, t) {
							e = e || [];
							for (var n = [], r = 0, i = e.length; r < i; r++) n.push(t(e[r], r));
							return n
						},
						arrayFilter: function(e, t) {
							e = e || [];
							for (var n = [], r = 0, i = e.length; r < i; r++) t(e[r], r) && n.push(e[r]);
							return n
						},
						arrayPushAll: function(e, t) {
							if (t instanceof Array) e.push.apply(e, t);
							else
								for (var n = 0, r = t.length; n < r; n++) e.push(t[n]);
							return e
						},
						addOrRemoveItem: function(e, t, n) {
							var r = y.utils.arrayIndexOf(y.utils.peekObservable(e), t);
							r < 0 ? n && e.push(t) : n || e.splice(r, 1)
						},
						canSetPrototype: p,
						extend: u,
						setPrototypeOf: l,
						setPrototypeOfOrExtend: p ? l : u,
						objectForEach: a,
						objectMap: function(e, t) {
							if (!e) return e;
							var n = {};
							for (var r in e) e.hasOwnProperty(r) && (n[r] = t(e[r], r, e));
							return n
						},
						emptyDomNode: function(e) {
							for (; e.firstChild;) y.removeNode(e.firstChild)
						},
						moveCleanedNodesToContainerElement: function(e) {
							for (var t = y.utils.makeArray(e), n = t[0] && t[0].ownerDocument || r, i = n.createElement("div"), o = 0, s =
									t.length; o < s; o++) i.appendChild(y.cleanNode(t[o]));
							return i
						},
						cloneNodes: function(e, t) {
							for (var n = 0, r = e.length, i = []; n < r; n++) {
								var o = e[n].cloneNode(!0);
								i.push(t ? y.cleanNode(o) : o)
							}
							return i
						},
						setDomNodeChildren: function(e, t) {
							if (y.utils.emptyDomNode(e), t)
								for (var n = 0, r = t.length; n < r; n++) e.appendChild(t[n])
						},
						replaceDomNodes: function(e, t) {
							var n = e.nodeType ? [e] : e;
							if (n.length > 0) {
								for (var r = n[0], i = r.parentNode, o = 0, s = t.length; o < s; o++) i.insertBefore(t[o], r);
								for (var o = 0, s = n.length; o < s; o++) y.removeNode(n[o])
							}
						},
						fixUpContinuousNodeArray: function(e, t) {
							if (e.length) {
								for (t = 8 === t.nodeType && t.parentNode || t; e.length && e[0].parentNode !== t;) e.splice(0, 1);
								for (; e.length > 1 && e[e.length - 1].parentNode !== t;) e.length--;
								if (e.length > 1) {
									var n = e[0],
										r = e[e.length - 1];
									for (e.length = 0; n !== r;) e.push(n), n = n.nextSibling;
									e.push(r)
								}
							}
							return e
						},
						setOptionNodeSelectionState: function(e, t) {
							x < 7 ? e.setAttribute("selected", t) : e.selected = t
						},
						stringTrim: function(e) {
							return null === e || e === t ? "" : e.trim ? e.trim() : e.toString().replace(/^[\s\xa0]+|[\s\xa0]+$/g, "")
						},
						stringStartsWith: function(e, t) {
							return e = e || "", !(t.length > e.length) && e.substring(0, t.length) === t
						},
						domNodeIsContainedBy: function(e, t) {
							if (e === t) return !0;
							if (11 === e.nodeType) return !1;
							if (t.contains) return t.contains(3 === e.nodeType ? e.parentNode : e);
							if (t.compareDocumentPosition) return 16 == (16 & t.compareDocumentPosition(e));
							for (; e && e != t;) e = e.parentNode;
							return !!e
						},
						domNodeIsAttachedToDocument: function(e) {
							return y.utils.domNodeIsContainedBy(e, e.ownerDocument.documentElement)
						},
						anyDomNodeIsAttachedToDocument: function(e) {
							return !!y.utils.arrayFirst(e, y.utils.domNodeIsAttachedToDocument)
						},
						tagNameLower: function(e) {
							return e && e.tagName && e.tagName.toLowerCase()
						},
						catchFunctionErrors: function(e) {
							return y.onError ? function() {
								try {
									return e.apply(this, arguments)
								} catch (t) {
									throw y.onError && y.onError(t), t
								}
							} : e
						},
						setTimeout: function(e, t) {
							return setTimeout(y.utils.catchFunctionErrors(e), t)
						},
						deferError: function(e) {
							setTimeout(function() {
								throw y.onError && y.onError(e), e
							}, 0)
						},
						registerEventHandler: function(e, t, n) {
							var r = y.utils.catchFunctionErrors(n),
								i = x && b[t];
							if (y.options.useOnlyNativeEvents || i || !o)
								if (i || "function" != typeof e.addEventListener) {
									if ("undefined" == typeof e.attachEvent) throw new Error(
										"Browser doesn't support addEventListener or attachEvent");
									var s = function(t) {
											r.call(e, t)
										},
										a = "on" + t;
									e.attachEvent(a, s), y.utils.domNodeDisposal.addDisposeCallback(e, function() {
										e.detachEvent(a, s)
									})
								} else e.addEventListener(t, r, !1);
							else o(e).bind(t, r)
						},
						triggerEvent: function(e, t) {
							if (!e || !e.nodeType) throw new Error("element must be a DOM node when calling triggerEvent");
							var i = c(e, t);
							if (y.options.useOnlyNativeEvents || !o || i)
								if ("function" == typeof r.createEvent) {
									if ("function" != typeof e.dispatchEvent) throw new Error(
										"The supplied element doesn't support dispatchEvent");
									var s = g[t] || "HTMLEvents",
										a = r.createEvent(s);
									a.initEvent(t, !0, !0, n, 0, 0, 0, 0, 0, !1, !1, !1, !1, 0, e), e.dispatchEvent(a)
								} else if (i && e.click) e.click();
							else {
								if ("undefined" == typeof e.fireEvent) throw new Error("Browser doesn't support triggering events");
								e.fireEvent("on" + t)
							} else o(e).trigger(t)
						},
						unwrapObservable: function(e) {
							return y.isObservable(e) ? e() : e
						},
						peekObservable: function(e) {
							return y.isObservable(e) ? e.peek() : e
						},
						toggleDomNodeCssClass: d,
						setTextContent: function(e, n) {
							var r = y.utils.unwrapObservable(n);
							null !== r && r !== t || (r = "");
							var i = y.virtualElements.firstChild(e);
							!i || 3 != i.nodeType || y.virtualElements.nextSibling(i) ? y.virtualElements.setDomNodeChildren(e, [e.ownerDocument
								.createTextNode(r)
							]) : i.data = r, y.utils.forceRefresh(e)
						},
						setElementName: function(e, t) {
							if (e.name = t, x <= 7) try {
								e.mergeAttributes(r.createElement("<input name='" + e.name + "'/>"), !1)
							} catch (n) {}
						},
						forceRefresh: function(e) {
							if (x >= 9) {
								var t = 1 == e.nodeType ? e : e.parentNode;
								t.style && (t.style.zoom = t.style.zoom)
							}
						},
						ensureSelectElementIsRenderedCorrectly: function(e) {
							if (x) {
								var t = e.style.width;
								e.style.width = 0, e.style.width = t
							}
						},
						range: function(e, t) {
							e = y.utils.unwrapObservable(e), t = y.utils.unwrapObservable(t);
							for (var n = [], r = e; r <= t; r++) n.push(r);
							return n
						},
						makeArray: function(e) {
							for (var t = [], n = 0, r = e.length; n < r; n++) t.push(e[n]);
							return t
						},
						createSymbolOrString: function(e) {
							return h ? Symbol(e) : e
						},
						isIe6: w,
						isIe7: D,
						ieVersion: x,
						getFormFields: function(e, t) {
							for (var n = y.utils.makeArray(e.getElementsByTagName("input")).concat(y.utils.makeArray(e.getElementsByTagName(
									"textarea"))), r = "string" == typeof t ? function(e) {
									return e.name === t
								} : function(e) {
									return t.test(e.name)
								}, i = [], o = n.length - 1; o >= 0; o--) r(n[o]) && i.push(n[o]);
							return i
						},
						parseJson: function(e) {
							return "string" == typeof e && (e = y.utils.stringTrim(e)) ? s && s.parse ? s.parse(e) : new Function(
								"return " + e)() : null
						},
						stringifyJson: function(e, t, n) {
							if (!s || !s.stringify) throw new Error(
								"Cannot find JSON.stringify(). Some browsers (e.g., IE < 8) don't support it natively, but you can overcome this by adding a script reference to json2.js, downloadable from http://www.json.org/json2.js"
							);
							return s.stringify(y.utils.unwrapObservable(e), t, n)
						},
						postJson: function(e, t, n) {
							n = n || {};
							var i = n.params || {},
								o = n.includeFields || this.fieldsIncludedWithJsonPost,
								s = e;
							if ("object" == typeof e && "form" === y.utils.tagNameLower(e)) {
								var u = e;
								s = u.action;
								for (var l = o.length - 1; l >= 0; l--)
									for (var c = y.utils.getFormFields(u, o[l]), d = c.length - 1; d >= 0; d--) i[c[d].name] = c[d].value
							}
							t = y.utils.unwrapObservable(t);
							var f = r.createElement("form");
							f.style.display = "none", f.action = s, f.method = "post";
							for (var p in t) {
								var h = r.createElement("input");
								h.type = "hidden", h.name = p, h.value = y.utils.stringifyJson(y.utils.unwrapObservable(t[p])), f.appendChild(
									h)
							}
							a(i, function(e, t) {
								var n = r.createElement("input");
								n.type = "hidden", n.name = e, n.value = t, f.appendChild(n)
							}), r.body.appendChild(f), n.submitter ? n.submitter(f) : f.submit(), setTimeout(function() {
								f.parentNode.removeChild(f)
							}, 0)
						}
					}
				}(), y.exportSymbol("utils", y.utils), y.exportSymbol("utils.arrayForEach", y.utils.arrayForEach), y.exportSymbol(
					"utils.arrayFirst", y.utils.arrayFirst), y.exportSymbol("utils.arrayFilter", y.utils.arrayFilter), y.exportSymbol(
					"utils.arrayGetDistinctValues", y.utils.arrayGetDistinctValues), y.exportSymbol("utils.arrayIndexOf", y.utils.arrayIndexOf),
				y.exportSymbol("utils.arrayMap", y.utils.arrayMap), y.exportSymbol("utils.arrayPushAll", y.utils.arrayPushAll), y.exportSymbol(
					"utils.arrayRemoveItem", y.utils.arrayRemoveItem), y.exportSymbol("utils.extend", y.utils.extend), y.exportSymbol(
					"utils.fieldsIncludedWithJsonPost", y.utils.fieldsIncludedWithJsonPost), y.exportSymbol("utils.getFormFields", y.utils
					.getFormFields), y.exportSymbol("utils.peekObservable", y.utils.peekObservable), y.exportSymbol("utils.postJson",
					y.utils.postJson), y.exportSymbol("utils.parseJson", y.utils.parseJson), y.exportSymbol(
					"utils.registerEventHandler", y.utils.registerEventHandler), y.exportSymbol("utils.stringifyJson", y.utils.stringifyJson),
				y.exportSymbol("utils.range", y.utils.range), y.exportSymbol("utils.toggleDomNodeCssClass", y.utils.toggleDomNodeCssClass),
				y.exportSymbol("utils.triggerEvent", y.utils.triggerEvent), y.exportSymbol("utils.unwrapObservable", y.utils.unwrapObservable),
				y.exportSymbol("utils.objectForEach", y.utils.objectForEach), y.exportSymbol("utils.addOrRemoveItem", y.utils.addOrRemoveItem),
				y.exportSymbol("utils.setTextContent", y.utils.setTextContent), y.exportSymbol("unwrap", y.utils.unwrapObservable),
				Function.prototype.bind || (Function.prototype.bind = function(e) {
					var t = this;
					if (1 === arguments.length) return function() {
						return t.apply(e, arguments)
					};
					var n = Array.prototype.slice.call(arguments, 1);
					return function() {
						var r = n.slice(0);
						return r.push.apply(r, arguments), t.apply(e, r)
					}
				}), y.utils.domData = new function() {
					function e(e, o) {
						var s = e[r],
							a = s && "null" !== s && i[s];
						if (!a) {
							if (!o) return t;
							s = e[r] = "ko" + n++, i[s] = {}
						}
						return i[s]
					}
					var n = 0,
						r = "__ko__" + (new Date).getTime(),
						i = {};
					return {
						get: function(n, r) {
							var i = e(n, !1);
							return i === t ? t : i[r]
						},
						set: function(n, r, i) {
							if (i !== t || e(n, !1) !== t) {
								var o = e(n, !0);
								o[r] = i
							}
						},
						clear: function(e) {
							var t = e[r];
							return !!t && (delete i[t], e[r] = null, !0)
						},
						nextKey: function() {
							return n++ + r
						}
					}
				}, y.exportSymbol("utils.domData", y.utils.domData), y.exportSymbol("utils.domData.clear", y.utils.domData.clear),
				y.utils.domNodeDisposal = new function() {
					function e(e, n) {
						var r = y.utils.domData.get(e, s);
						return r === t && n && (r = [], y.utils.domData.set(e, s, r)), r
					}

					function n(e) {
						y.utils.domData.set(e, s, t)
					}

					function r(t) {
						var n = e(t, !1);
						if (n) {
							n = n.slice(0);
							for (var r = 0; r < n.length; r++) n[r](t)
						}
						y.utils.domData.clear(t), y.utils.domNodeDisposal.cleanExternalData(t), u[t.nodeType] && i(t)
					}

					function i(e) {
						for (var t, n = e.firstChild; t = n;) n = t.nextSibling, 8 === t.nodeType && r(t)
					}
					var s = y.utils.domData.nextKey(),
						a = {
							1: !0,
							8: !0,
							9: !0
						},
						u = {
							1: !0,
							9: !0
						};
					return {
						addDisposeCallback: function(t, n) {
							if ("function" != typeof n) throw new Error("Callback must be a function");
							e(t, !0).push(n)
						},
						removeDisposeCallback: function(t, r) {
							var i = e(t, !1);
							i && (y.utils.arrayRemoveItem(i, r), 0 == i.length && n(t))
						},
						cleanNode: function(e) {
							if (a[e.nodeType] && (r(e), u[e.nodeType])) {
								var t = [];
								y.utils.arrayPushAll(t, e.getElementsByTagName("*"));
								for (var n = 0, i = t.length; n < i; n++) r(t[n])
							}
							return e
						},
						removeNode: function(e) {
							y.cleanNode(e), e.parentNode && e.parentNode.removeChild(e)
						},
						cleanExternalData: function(e) {
							o && "function" == typeof o.cleanData && o.cleanData([e])
						}
					}
				}, y.cleanNode = y.utils.domNodeDisposal.cleanNode, y.removeNode = y.utils.domNodeDisposal.removeNode, y.exportSymbol(
					"cleanNode", y.cleanNode), y.exportSymbol("removeNode", y.removeNode), y.exportSymbol("utils.domNodeDisposal", y.utils
					.domNodeDisposal), y.exportSymbol("utils.domNodeDisposal.addDisposeCallback", y.utils.domNodeDisposal.addDisposeCallback),
				y.exportSymbol("utils.domNodeDisposal.removeDisposeCallback", y.utils.domNodeDisposal.removeDisposeCallback),
				function() {
					function e(e) {
						var t = e.match(/^<([a-z]+)[ >]/);
						return t && f[t[1]] || a
					}

					function i(t, i) {
						i || (i = r);
						var o = i.parentWindow || i.defaultView || n,
							s = y.utils.stringTrim(t).toLowerCase(),
							a = i.createElement("div"),
							u = e(s),
							l = u[0],
							c = "ignored<div>" + u[1] + t + u[2] + "</div>";
						for ("function" == typeof o.innerShiv ? a.appendChild(o.innerShiv(c)) : (p && i.appendChild(a), a.innerHTML = c,
								p && a.parentNode.removeChild(a)); l--;) a = a.lastChild;
						return y.utils.makeArray(a.lastChild.childNodes)
					}

					function s(e, t) {
						if (o.parseHTML) return o.parseHTML(e, t) || [];
						var n = o.clean([e], t);
						if (n && n[0]) {
							for (var r = n[0]; r.parentNode && 11 !== r.parentNode.nodeType;) r = r.parentNode;
							r.parentNode && r.parentNode.removeChild(r)
						}
						return n
					}
					var a = [0, "", ""],
						u = [1, "<table>", "</table>"],
						l = [2, "<table><tbody>", "</tbody></table>"],
						c = [3, "<table><tbody><tr>", "</tr></tbody></table>"],
						d = [1, "<select multiple='multiple'>", "</select>"],
						f = {
							thead: u,
							tbody: u,
							tfoot: u,
							tr: l,
							td: c,
							th: c,
							option: d,
							optgroup: d
						},
						p = y.utils.ieVersion <= 8;
					y.utils.parseHtmlFragment = function(e, t) {
						return o ? s(e, t) : i(e, t)
					}, y.utils.setHtml = function(e, n) {
						if (y.utils.emptyDomNode(e), n = y.utils.unwrapObservable(n), null !== n && n !== t)
							if ("string" != typeof n && (n = n.toString()), o) o(e).html(n);
							else
								for (var r = y.utils.parseHtmlFragment(n, e.ownerDocument), i = 0; i < r.length; i++) e.appendChild(r[i])
					}
				}(), y.exportSymbol("utils.parseHtmlFragment", y.utils.parseHtmlFragment), y.exportSymbol("utils.setHtml", y.utils
					.setHtml), y.memoization = function() {
					function e() {
						return (4294967296 * (1 + Math.random()) | 0).toString(16).substring(1)
					}

					function n() {
						return e() + e()
					}

					function r(e, t) {
						if (e)
							if (8 == e.nodeType) {
								var n = y.memoization.parseMemoText(e.nodeValue);
								null != n && t.push({
									domNode: e,
									memoId: n
								})
							} else if (1 == e.nodeType)
							for (var i = 0, o = e.childNodes, s = o.length; i < s; i++) r(o[i], t)
					}
					var i = {};
					return {
						memoize: function(e) {
							if ("function" != typeof e) throw new Error("You can only pass a function to ko.memoization.memoize()");
							var t = n();
							return i[t] = e, "<!--[ko_memo:" + t + "]-->"
						},
						unmemoize: function(e, n) {
							var r = i[e];
							if (r === t) throw new Error("Couldn't find any memo with ID " + e + ". Perhaps it's already been unmemoized.");
							try {
								return r.apply(null, n || []), !0
							} finally {
								delete i[e]
							}
						},
						unmemoizeDomNodeAndDescendants: function(e, t) {
							var n = [];
							r(e, n);
							for (var i = 0, o = n.length; i < o; i++) {
								var s = n[i].domNode,
									a = [s];
								t && y.utils.arrayPushAll(a, t), y.memoization.unmemoize(n[i].memoId, a), s.nodeValue = "", s.parentNode && s
									.parentNode.removeChild(s)
							}
						},
						parseMemoText: function(e) {
							var t = e.match(/^\[ko_memo\:(.*?)\]$/);
							return t ? t[1] : null
						}
					}
				}(), y.exportSymbol("memoization", y.memoization), y.exportSymbol("memoization.memoize", y.memoization.memoize), y
				.exportSymbol("memoization.unmemoize", y.memoization.unmemoize), y.exportSymbol("memoization.parseMemoText", y.memoization
					.parseMemoText), y.exportSymbol("memoization.unmemoizeDomNodeAndDescendants", y.memoization.unmemoizeDomNodeAndDescendants),
				y.tasks = function() {
					function e() {
						if (a)
							for (var e, t = a, n = 0; l < a;)
								if (e = s[l++]) {
									if (l > t) {
										if (++n >= 5e3) {
											l = a, y.utils.deferError(Error("'Too much recursion' after processing " + n + " task groups."));
											break
										}
										t = a
									}
									try {
										e()
									} catch (r) {
										y.utils.deferError(r)
									}
								}
					}

					function t() {
						e(), l = a = s.length = 0
					}

					function i() {
						y.tasks.scheduler(t)
					}
					var o, s = [],
						a = 0,
						u = 1,
						l = 0;
					// From https://github.com/petkaantonov/bluebird * Copyright (c) 2014 Petka Antonov * License: MIT
					o = n.MutationObserver ? function(e) {
						var t = r.createElement("div");
						return new MutationObserver(e).observe(t, {
								attributes: !0
							}),
							function() {
								t.classList.toggle("foo")
							}
					}(t) : r && "onreadystatechange" in r.createElement("script") ? function(e) {
						var t = r.createElement("script");
						t.onreadystatechange = function() {
							t.onreadystatechange = null, r.documentElement.removeChild(t), t = null, e()
						}, r.documentElement.appendChild(t)
					} : function(e) {
						setTimeout(e, 0)
					};
					var c = {
						scheduler: o,
						schedule: function(e) {
							return a || i(), s[a++] = e, u++
						},
						cancel: function(e) {
							var t = e - (u - a);
							t >= l && t < a && (s[t] = null)
						},
						resetForTesting: function() {
							var e = a - l;
							return l = a = s.length = 0, e
						},
						runEarly: e
					};
					return c
				}(), y.exportSymbol("tasks", y.tasks), y.exportSymbol("tasks.schedule", y.tasks.schedule), y.exportSymbol(
					"tasks.runEarly", y.tasks.runEarly), y.extenders = {
					throttle: function(e, t) {
						e.throttleEvaluation = t;
						var n = null;
						return y.dependentObservable({
							read: e,
							write: function(r) {
								clearTimeout(n), n = y.utils.setTimeout(function() {
									e(r)
								}, t)
							}
						})
					},
					rateLimit: function(e, t) {
						var n, r, i;
						"number" == typeof t ? n = t : (n = t.timeout, r = t.method), e._deferUpdates = !1, i = "notifyWhenChangesStop" ==
							r ? d : c, e.limit(function(e) {
								return i(e, n)
							})
					},
					deferred: function(e, n) {
						if (n !== !0) throw new Error(
							"The 'deferred' extender only accepts the value 'true', because it is not supported to turn deferral off once enabled."
						);
						e._deferUpdates || (e._deferUpdates = !0, e.limit(function(n) {
							var r;
							return function() {
								y.tasks.cancel(r), r = y.tasks.schedule(n), e.notifySubscribers(t, "dirty")
							}
						}))
					},
					notify: function(e, t) {
						e.equalityComparer = "always" == t ? null : l
					}
				};
			var b = {
				undefined: 1,
				"boolean": 1,
				number: 1,
				string: 1
			};
			y.exportSymbol("extenders", y.extenders), y.subscription = function(e, t, n) {
				this._target = e, this.callback = t, this.disposeCallback = n, this.isDisposed = !1, y.exportProperty(this,
					"dispose", this.dispose)
			}, y.subscription.prototype.dispose = function() {
				this.isDisposed = !0, this.disposeCallback()
			}, y.subscribable = function() {
				y.utils.setPrototypeOfOrExtend(this, w), w.init(this)
			};
			var x = "change",
				w = {
					init: function(e) {
						e._subscriptions = {}, e._versionNumber = 1
					},
					subscribe: function(e, t, n) {
						var r = this;
						n = n || x;
						var i = t ? e.bind(t) : e,
							o = new y.subscription(r, i, function() {
								y.utils.arrayRemoveItem(r._subscriptions[n], o), r.afterSubscriptionRemove && r.afterSubscriptionRemove(n)
							});
						return r.beforeSubscriptionAdd && r.beforeSubscriptionAdd(n), r._subscriptions[n] || (r._subscriptions[n] = []),
							r._subscriptions[n].push(o), o
					},
					notifySubscribers: function(e, t) {
						if (t = t || x, t === x && this.updateVersion(), this.hasSubscriptionsForEvent(t)) try {
							y.dependencyDetection.begin();
							for (var n, r = this._subscriptions[t].slice(0), i = 0; n = r[i]; ++i) n.isDisposed || n.callback(e)
						} finally {
							y.dependencyDetection.end()
						}
					},
					getVersion: function() {
						return this._versionNumber
					},
					hasChanged: function(e) {
						return this.getVersion() !== e
					},
					updateVersion: function() {
						++this._versionNumber
					},
					limit: function(e) {
						var t, n, r, i = this,
							o = y.isObservable(i),
							s = "beforeChange";
						i._origNotifySubscribers || (i._origNotifySubscribers = i.notifySubscribers, i.notifySubscribers = p);
						var a = e(function() {
							i._notificationIsPending = !1, o && r === i && (r = i()), t = !1, i.isDifferent(n, r) && i._origNotifySubscribers(
								n = r)
						});
						i._limitChange = function(e) {
							i._notificationIsPending = t = !0, r = e, a()
						}, i._limitBeforeChange = function(e) {
							t || (n = e, i._origNotifySubscribers(e, s))
						}
					},
					hasSubscriptionsForEvent: function(e) {
						return this._subscriptions[e] && this._subscriptions[e].length
					},
					getSubscriptionsCount: function(e) {
						if (e) return this._subscriptions[e] && this._subscriptions[e].length || 0;
						var t = 0;
						return y.utils.objectForEach(this._subscriptions, function(e, n) {
							"dirty" !== e && (t += n.length)
						}), t
					},
					isDifferent: function(e, t) {
						return !this.equalityComparer || !this.equalityComparer(e, t)
					},
					extend: f
				};
			y.exportProperty(w, "subscribe", w.subscribe), y.exportProperty(w, "extend", w.extend), y.exportProperty(w,
					"getSubscriptionsCount", w.getSubscriptionsCount), y.utils.canSetPrototype && y.utils.setPrototypeOf(w, Function.prototype),
				y.subscribable.fn = w, y.isSubscribable = function(e) {
					return null != e && "function" == typeof e.subscribe && "function" == typeof e.notifySubscribers
				}, y.exportSymbol("subscribable", y.subscribable), y.exportSymbol("isSubscribable", y.isSubscribable), y.computedContext =
				y.dependencyDetection = function() {
					function e() {
						return ++o
					}

					function t(e) {
						i.push(r), r = e
					}

					function n() {
						r = i.pop()
					}
					var r, i = [],
						o = 0;
					return {
						begin: t,
						end: n,
						registerDependency: function(t) {
							if (r) {
								if (!y.isSubscribable(t)) throw new Error("Only subscribable things can act as dependencies");
								r.callback.call(r.callbackTarget, t, t._id || (t._id = e()))
							}
						},
						ignore: function(e, r, i) {
							try {
								return t(), e.apply(r, i || [])
							} finally {
								n()
							}
						},
						getDependenciesCount: function() {
							if (r) return r.computed.getDependenciesCount()
						},
						isInitial: function() {
							if (r) return r.isInitial
						}
					}
				}(), y.exportSymbol("computedContext", y.computedContext), y.exportSymbol("computedContext.getDependenciesCount",
					y.computedContext.getDependenciesCount), y.exportSymbol("computedContext.isInitial", y.computedContext.isInitial),
				y.exportSymbol("ignoreDependencies", y.ignoreDependencies = y.dependencyDetection.ignore);
			var D = y.utils.createSymbolOrString("_latestValue");
			y.observable = function(e) {
				function t() {
					return arguments.length > 0 ? (t.isDifferent(t[D], arguments[0]) && (t.valueWillMutate(), t[D] = arguments[0], t
						.valueHasMutated()), this) : (y.dependencyDetection.registerDependency(t), t[D])
				}
				return t[D] = e, y.utils.canSetPrototype || y.utils.extend(t, y.subscribable.fn), y.subscribable.fn.init(t), y.utils
					.setPrototypeOfOrExtend(t, S), y.options.deferUpdates && y.extenders.deferred(t, !0), t
			};
			var S = {
				equalityComparer: l,
				peek: function() {
					return this[D]
				},
				valueHasMutated: function() {
					this.notifySubscribers(this[D])
				},
				valueWillMutate: function() {
					this.notifySubscribers(this[D], "beforeChange")
				}
			};
			y.utils.canSetPrototype && y.utils.setPrototypeOf(S, y.subscribable.fn);
			var T = y.observable.protoProperty = "__ko_proto__";
			S[T] = y.observable, y.hasPrototype = function(e, n) {
					return null !== e && e !== t && e[T] !== t && (e[T] === n || y.hasPrototype(e[T], n))
				}, y.isObservable = function(e) {
					return y.hasPrototype(e, y.observable)
				}, y.isWriteableObservable = function(e) {
					return "function" == typeof e && e[T] === y.observable || !("function" != typeof e || e[T] !== y.dependentObservable ||
						!e.hasWriteFunction)
				}, y.exportSymbol("observable", y.observable), y.exportSymbol("isObservable", y.isObservable), y.exportSymbol(
					"isWriteableObservable", y.isWriteableObservable), y.exportSymbol("isWritableObservable", y.isWriteableObservable),
				y.exportSymbol("observable.fn", S), y.exportProperty(S, "peek", S.peek), y.exportProperty(S, "valueHasMutated", S.valueHasMutated),
				y.exportProperty(S, "valueWillMutate", S.valueWillMutate), y.observableArray = function(e) {
					if (e = e || [], "object" != typeof e || !("length" in e)) throw new Error(
						"The argument passed when initializing an observable array must be an array, or null, or undefined.");
					var t = y.observable(e);
					return y.utils.setPrototypeOfOrExtend(t, y.observableArray.fn), t.extend({
						trackArrayChanges: !0
					})
				}, y.observableArray.fn = {
					remove: function(e) {
						for (var t = this.peek(), n = [], r = "function" != typeof e || y.isObservable(e) ? function(t) {
								return t === e
							} : e, i = 0; i < t.length; i++) {
							var o = t[i];
							r(o) && (0 === n.length && this.valueWillMutate(), n.push(o), t.splice(i, 1), i--)
						}
						return n.length && this.valueHasMutated(), n
					},
					removeAll: function(e) {
						if (e === t) {
							var n = this.peek(),
								r = n.slice(0);
							return this.valueWillMutate(), n.splice(0, n.length), this.valueHasMutated(), r
						}
						return e ? this.remove(function(t) {
							return y.utils.arrayIndexOf(e, t) >= 0
						}) : []
					},
					destroy: function(e) {
						var t = this.peek(),
							n = "function" != typeof e || y.isObservable(e) ? function(t) {
								return t === e
							} : e;
						this.valueWillMutate();
						for (var r = t.length - 1; r >= 0; r--) {
							var i = t[r];
							n(i) && (t[r]._destroy = !0)
						}
						this.valueHasMutated()
					},
					destroyAll: function(e) {
						return e === t ? this.destroy(function() {
							return !0
						}) : e ? this.destroy(function(t) {
							return y.utils.arrayIndexOf(e, t) >= 0
						}) : []
					},
					indexOf: function(e) {
						var t = this();
						return y.utils.arrayIndexOf(t, e)
					},
					replace: function(e, t) {
						var n = this.indexOf(e);
						n >= 0 && (this.valueWillMutate(), this.peek()[n] = t, this.valueHasMutated())
					}
				}, y.utils.canSetPrototype && y.utils.setPrototypeOf(y.observableArray.fn, y.observable.fn), y.utils.arrayForEach(
					["pop", "push", "reverse", "shift", "sort", "splice", "unshift"],
					function(e) {
						y.observableArray.fn[e] = function() {
							var t = this.peek();
							this.valueWillMutate(), this.cacheDiffForKnownOperation(t, e, arguments);
							var n = t[e].apply(t, arguments);
							return this.valueHasMutated(), n === t ? this : n
						}
					}), y.utils.arrayForEach(["slice"], function(e) {
					y.observableArray.fn[e] = function() {
						var t = this();
						return t[e].apply(t, arguments)
					}
				}), y.exportSymbol("observableArray", y.observableArray);
			var _ = "arrayChange";
			y.extenders.trackArrayChanges = function(e, t) {
				function n() {
					if (!o) {
						o = !0;
						var t = e.notifySubscribers;
						e.notifySubscribers = function(e, n) {
							return n && n !== x || ++a, t.apply(this, arguments)
						};
						var n = [].concat(e.peek() || []);
						s = null, i = e.subscribe(function(t) {
							if (t = [].concat(t || []), e.hasSubscriptionsForEvent(_)) var i = r(n, t);
							n = t, s = null, a = 0, i && i.length && e.notifySubscribers(i, _)
						})
					}
				}

				function r(t, n) {
					return (!s || a > 1) && (s = y.utils.compareArrays(t, n, e.compareArrayOptions)), s
				}
				if (e.compareArrayOptions = {}, t && "object" == typeof t && y.utils.extend(e.compareArrayOptions, t), e.compareArrayOptions
					.sparse = !0, !e.cacheDiffForKnownOperation) {
					var i, o = !1,
						s = null,
						a = 0,
						u = e.beforeSubscriptionAdd,
						l = e.afterSubscriptionRemove;
					e.beforeSubscriptionAdd = function(t) {
						u && u.call(e, t), t === _ && n()
					}, e.afterSubscriptionRemove = function(t) {
						l && l.call(e, t), t !== _ || e.hasSubscriptionsForEvent(_) || (i.dispose(), o = !1)
					}, e.cacheDiffForKnownOperation = function(e, t, n) {
						function r(e, t, n) {
							return i[i.length] = {
								status: e,
								value: t,
								index: n
							}
						}
						if (o && !a) {
							var i = [],
								u = e.length,
								l = n.length,
								c = 0;
							switch (t) {
								case "push":
									c = u;
								case "unshift":
									for (var d = 0; d < l; d++) r("added", n[d], c + d);
									break;
								case "pop":
									c = u - 1;
								case "shift":
									u && r("deleted", e[c], c);
									break;
								case "splice":
									for (var f = Math.min(Math.max(0, n[0] < 0 ? u + n[0] : n[0]), u), p = 1 === l ? u : Math.min(f + (n[1] ||
											0), u), h = f + l - 2, m = Math.max(p, h), g = [], v = [], d = f, b = 2; d < m; ++d, ++b) d < p && v.push(
										r("deleted", e[d], d)), d < h && g.push(r("added", n[b], d));
									y.utils.findMovesInArrayComparison(v, g);
									break;
								default:
									return
							}
							s = i
						}
					}
				}
			};
			var E = y.utils.createSymbolOrString("_state");
			y.computed = y.dependentObservable = function(n, r, i) {
				function o() {
					if (arguments.length > 0) {
						if ("function" != typeof s) throw new Error(
							"Cannot write a value to a ko.computed unless you specify a 'write' option. If you wish to read the current value, don't pass any parameters."
						);
						return s.apply(a.evaluatorFunctionTarget, arguments), this
					}
					return y.dependencyDetection.registerDependency(o), (a.isStale || a.isSleeping && o.haveDependenciesChanged()) &&
						o.evaluateImmediate(), a.latestValue
				}
				if ("object" == typeof n ? i = n : (i = i || {}, n && (i.read = n)), "function" != typeof i.read) throw Error(
					"Pass a function that returns the value of the ko.computed");
				var s = i.write,
					a = {
						latestValue: t,
						isStale: !0,
						isBeingEvaluated: !1,
						suppressDisposalUntilDisposeWhenReturnsFalse: !1,
						isDisposed: !1,
						pure: !1,
						isSleeping: !1,
						readFunction: i.read,
						evaluatorFunctionTarget: r || i.owner,
						disposeWhenNodeIsRemoved: i.disposeWhenNodeIsRemoved || i.disposeWhenNodeIsRemoved || null,
						disposeWhen: i.disposeWhen || i.disposeWhen,
						domNodeDisposalCallback: null,
						dependencyTracking: {},
						dependenciesCount: 0,
						evaluationTimeoutInstance: null
					};
				return o[E] = a, o.hasWriteFunction = "function" == typeof s, y.utils.canSetPrototype || y.utils.extend(o, y.subscribable
						.fn), y.subscribable.fn.init(o), y.utils.setPrototypeOfOrExtend(o, C), i.pure ? (a.pure = !0, a.isSleeping = !0,
						y.utils.extend(o, k)) : i.deferEvaluation && y.utils.extend(o, N), y.options.deferUpdates && y.extenders.deferred(
						o, !0), e && (o._options = i), a.disposeWhenNodeIsRemoved && (a.suppressDisposalUntilDisposeWhenReturnsFalse = !
						0, a.disposeWhenNodeIsRemoved.nodeType || (a.disposeWhenNodeIsRemoved = null)), a.isSleeping || i.deferEvaluation ||
					o.evaluateImmediate(), a.disposeWhenNodeIsRemoved && o.isActive() && y.utils.domNodeDisposal.addDisposeCallback(
						a.disposeWhenNodeIsRemoved, a.domNodeDisposalCallback = function() {
							o.dispose()
						}), o
			};
			var C = {
					equalityComparer: l,
					getDependenciesCount: function() {
						return this[E].dependenciesCount
					},
					addDependencyTracking: function(e, t, n) {
						if (this[E].pure && t === this) throw Error("A 'pure' computed must not be called recursively");
						this[E].dependencyTracking[e] = n, n._order = this[E].dependenciesCount++, n._version = t.getVersion()
					},
					haveDependenciesChanged: function() {
						var e, t, n = this[E].dependencyTracking;
						for (e in n)
							if (n.hasOwnProperty(e) && (t = n[e], t._target.hasChanged(t._version))) return !0
					},
					markDirty: function() {
						this._evalDelayed && !this[E].isBeingEvaluated && this._evalDelayed()
					},
					isActive: function() {
						return this[E].isStale || this[E].dependenciesCount > 0
					},
					respondToChange: function() {
						this._notificationIsPending || this.evaluatePossiblyAsync()
					},
					subscribeToDependency: function(e) {
						if (e._deferUpdates && !this[E].disposeWhenNodeIsRemoved) {
							var t = e.subscribe(this.markDirty, this, "dirty"),
								n = e.subscribe(this.respondToChange, this);
							return {
								_target: e,
								dispose: function() {
									t.dispose(), n.dispose()
								}
							}
						}
						return e.subscribe(this.evaluatePossiblyAsync, this)
					},
					evaluatePossiblyAsync: function() {
						var e = this,
							t = e.throttleEvaluation;
						t && t >= 0 ? (clearTimeout(this[E].evaluationTimeoutInstance), this[E].evaluationTimeoutInstance = y.utils.setTimeout(
							function() {
								e.evaluateImmediate(!0)
							}, t)) : e._evalDelayed ? e._evalDelayed() : e.evaluateImmediate(!0)
					},
					evaluateImmediate: function(e) {
						var t = this,
							n = t[E],
							r = n.disposeWhen;
						if (!n.isBeingEvaluated && !n.isDisposed) {
							if (n.disposeWhenNodeIsRemoved && !y.utils.domNodeIsAttachedToDocument(n.disposeWhenNodeIsRemoved) || r && r()) {
								if (!n.suppressDisposalUntilDisposeWhenReturnsFalse) return void t.dispose()
							} else n.suppressDisposalUntilDisposeWhenReturnsFalse = !1;
							n.isBeingEvaluated = !0;
							try {
								this.evaluateImmediate_CallReadWithDependencyDetection(e)
							} finally {
								n.isBeingEvaluated = !1
							}
							n.dependenciesCount || t.dispose()
						}
					},
					evaluateImmediate_CallReadWithDependencyDetection: function(e) {
						var n = this,
							r = n[E],
							i = r.pure ? t : !r.dependenciesCount,
							o = {
								computedObservable: n,
								disposalCandidates: r.dependencyTracking,
								disposalCount: r.dependenciesCount
							};
						y.dependencyDetection.begin({
							callbackTarget: o,
							callback: m,
							computed: n,
							isInitial: i
						}), r.dependencyTracking = {}, r.dependenciesCount = 0;
						var s = this.evaluateImmediate_CallReadThenEndDependencyDetection(r, o);
						n.isDifferent(r.latestValue, s) && (r.isSleeping || n.notifySubscribers(r.latestValue, "beforeChange"), r.latestValue =
							s, r.isSleeping ? n.updateVersion() : e && n.notifySubscribers(r.latestValue)), i && n.notifySubscribers(r.latestValue,
							"awake")
					},
					evaluateImmediate_CallReadThenEndDependencyDetection: function(e, t) {
						try {
							var n = e.readFunction;
							return e.evaluatorFunctionTarget ? n.call(e.evaluatorFunctionTarget) : n()
						} finally {
							y.dependencyDetection.end(), t.disposalCount && !e.isSleeping && y.utils.objectForEach(t.disposalCandidates, h),
								e.isStale = !1
						}
					},
					peek: function() {
						var e = this[E];
						return (e.isStale && !e.dependenciesCount || e.isSleeping && this.haveDependenciesChanged()) && this.evaluateImmediate(),
							e.latestValue
					},
					limit: function(e) {
						y.subscribable.fn.limit.call(this, e), this._evalDelayed = function() {
							this._limitBeforeChange(this[E].latestValue), this[E].isStale = !0, this._limitChange(this)
						}
					},
					dispose: function() {
						var e = this[E];
						!e.isSleeping && e.dependencyTracking && y.utils.objectForEach(e.dependencyTracking, function(e, t) {
								t.dispose && t.dispose()
							}), e.disposeWhenNodeIsRemoved && e.domNodeDisposalCallback && y.utils.domNodeDisposal.removeDisposeCallback(e
								.disposeWhenNodeIsRemoved, e.domNodeDisposalCallback), e.dependencyTracking = null, e.dependenciesCount = 0,
							e.isDisposed = !0, e.isStale = !1, e.isSleeping = !1, e.disposeWhenNodeIsRemoved = null
					}
				},
				k = {
					beforeSubscriptionAdd: function(e) {
						var t = this,
							n = t[E];
						if (!n.isDisposed && n.isSleeping && "change" == e) {
							if (n.isSleeping = !1, n.isStale || t.haveDependenciesChanged()) n.dependencyTracking = null, n.dependenciesCount =
								0, n.isStale = !0, t.evaluateImmediate();
							else {
								var r = [];
								y.utils.objectForEach(n.dependencyTracking, function(e, t) {
									r[t._order] = e
								}), y.utils.arrayForEach(r, function(e, r) {
									var i = n.dependencyTracking[e],
										o = t.subscribeToDependency(i._target);
									o._order = r, o._version = i._version, n.dependencyTracking[e] = o
								})
							}
							n.isDisposed || t.notifySubscribers(n.latestValue, "awake")
						}
					},
					afterSubscriptionRemove: function(e) {
						var n = this[E];
						n.isDisposed || "change" != e || this.hasSubscriptionsForEvent("change") || (y.utils.objectForEach(n.dependencyTracking,
							function(e, t) {
								t.dispose && (n.dependencyTracking[e] = {
									_target: t._target,
									_order: t._order,
									_version: t._version
								}, t.dispose())
							}), n.isSleeping = !0, this.notifySubscribers(t, "asleep"))
					},
					getVersion: function() {
						var e = this[E];
						return e.isSleeping && (e.isStale || this.haveDependenciesChanged()) && this.evaluateImmediate(), y.subscribable
							.fn.getVersion.call(this)
					}
				},
				N = {
					beforeSubscriptionAdd: function(e) {
						"change" != e && "beforeChange" != e || this.peek()
					}
				};
			y.utils.canSetPrototype && y.utils.setPrototypeOf(C, y.subscribable.fn);
			var O = y.observable.protoProperty;
			y.computed[O] = y.observable, C[O] = y.computed, y.isComputed = function(e) {
					return y.hasPrototype(e, y.computed)
				}, y.isPureComputed = function(e) {
					return y.hasPrototype(e, y.computed) && e[E] && e[E].pure
				}, y.exportSymbol("computed", y.computed), y.exportSymbol("dependentObservable", y.computed), y.exportSymbol(
					"isComputed", y.isComputed), y.exportSymbol("isPureComputed", y.isPureComputed), y.exportSymbol("computed.fn", C),
				y.exportProperty(C, "peek", C.peek), y.exportProperty(C, "dispose", C.dispose), y.exportProperty(C, "isActive", C.isActive),
				y.exportProperty(C, "getDependenciesCount", C.getDependenciesCount), y.pureComputed = function(e, t) {
					return "function" == typeof e ? y.computed(e, t, {
						pure: !0
					}) : (e = y.utils.extend({}, e), e.pure = !0, y.computed(e, t))
				}, y.exportSymbol("pureComputed", y.pureComputed),
				function() {
					function e(i, o, s) {
						s = s || new r, i = o(i);
						var a = !("object" != typeof i || null === i || i === t || i instanceof RegExp || i instanceof Date || i instanceof String ||
							i instanceof Number || i instanceof Boolean);
						if (!a) return i;
						var u = i instanceof Array ? [] : {};
						return s.save(i, u), n(i, function(n) {
							var r = o(i[n]);
							switch (typeof r) {
								case "boolean":
								case "number":
								case "string":
								case "function":
									u[n] = r;
									break;
								case "object":
								case "undefined":
									var a = s.get(r);
									u[n] = a !== t ? a : e(r, o, s)
							}
						}), u
					}

					function n(e, t) {
						if (e instanceof Array) {
							for (var n = 0; n < e.length; n++) t(n);
							"function" == typeof e.toJSON && t("toJSON")
						} else
							for (var r in e) t(r)
					}

					function r() {
						this.keys = [], this.values = []
					}
					var i = 10;
					y.toJS = function(t) {
						if (0 == arguments.length) throw new Error("When calling ko.toJS, pass the object you want to convert.");
						return e(t, function(e) {
							for (var t = 0; y.isObservable(e) && t < i; t++) e = e();
							return e
						})
					}, y.toJSON = function(e, t, n) {
						var r = y.toJS(e);
						return y.utils.stringifyJson(r, t, n)
					}, r.prototype = {
						constructor: r,
						save: function(e, t) {
							var n = y.utils.arrayIndexOf(this.keys, e);
							n >= 0 ? this.values[n] = t : (this.keys.push(e), this.values.push(t))
						},
						get: function(e) {
							var n = y.utils.arrayIndexOf(this.keys, e);
							return n >= 0 ? this.values[n] : t
						}
					}
				}(), y.exportSymbol("toJS", y.toJS), y.exportSymbol("toJSON", y.toJSON),
				function() {
					var e = "__ko__hasDomDataOptionValue__";
					y.selectExtensions = {
						readValue: function(n) {
							switch (y.utils.tagNameLower(n)) {
								case "option":
									return n[e] === !0 ? y.utils.domData.get(n, y.bindingHandlers.options.optionValueDomDataKey) : y.utils.ieVersion <=
										7 ? n.getAttributeNode("value") && n.getAttributeNode("value").specified ? n.value : n.text : n.value;
								case "select":
									return n.selectedIndex >= 0 ? y.selectExtensions.readValue(n.options[n.selectedIndex]) : t;
								default:
									return n.value
							}
						},
						writeValue: function(n, r, i) {
							switch (y.utils.tagNameLower(n)) {
								case "option":
									switch (typeof r) {
										case "string":
											y.utils.domData.set(n, y.bindingHandlers.options.optionValueDomDataKey, t), e in n && delete n[e], n.value =
												r;
											break;
										default:
											y.utils.domData.set(n, y.bindingHandlers.options.optionValueDomDataKey, r), n[e] = !0, n.value = "number" ==
												typeof r ? r : ""
									}
									break;
								case "select":
									"" !== r && null !== r || (r = t);
									for (var o, s = -1, a = 0, u = n.options.length; a < u; ++a)
										if (o = y.selectExtensions.readValue(n.options[a]), o == r || "" == o && r === t) {
											s = a;
											break
										}(i || s >= 0 || r === t && n.size > 1) && (n.selectedIndex = s);
									break;
								default:
									null !== r && r !== t || (r = ""), n.value = r
							}
						}
					}
				}(), y.exportSymbol("selectExtensions", y.selectExtensions), y.exportSymbol("selectExtensions.readValue", y.selectExtensions
					.readValue), y.exportSymbol("selectExtensions.writeValue", y.selectExtensions.writeValue), y.expressionRewriting =
				function() {
					function e(e) {
						if (y.utils.arrayIndexOf(r, e) >= 0) return !1;
						var t = e.match(i);
						return null !== t && (t[1] ? "Object(" + t[1] + ")" + t[2] : e)
					}

					function t(e) {
						var t = y.utils.stringTrim(e);
						123 === t.charCodeAt(0) && (t = t.slice(1, -1));
						var n, r = [],
							i = t.match(d),
							o = [],
							s = 0;
						if (i) {
							i.push(",");
							for (var a, u = 0; a = i[u]; ++u) {
								var l = a.charCodeAt(0);
								if (44 === l) {
									if (s <= 0) {
										r.push(n && o.length ? {
											key: n,
											value: o.join("")
										} : {
											unknown: n || o.join("")
										}), n = s = 0, o = [];
										continue
									}
								} else if (58 === l) {
									if (!s && !n && 1 === o.length) {
										n = o.pop();
										continue
									}
								} else if (47 === l && u && a.length > 1) {
									var c = i[u - 1].match(f);
									c && !p[c[0]] && (t = t.substr(t.indexOf(a) + 1), i = t.match(d), i.push(","), u = -1, a = "/")
								} else 40 === l || 123 === l || 91 === l ? ++s : 41 === l || 125 === l || 93 === l ? --s : n || o.length || 34 !==
									l && 39 !== l || (a = a.slice(1, -1));
								o.push(a)
							}
						}
						return r
					}

					function n(n, r) {
						function i(t, n) {
							function r(e) {
								return !e || !e.preprocess || (n = e.preprocess(n, t, i))
							}
							var l;
							if (!u) {
								if (!r(y.getBindingHandler(t))) return;
								h[t] && (l = e(n)) && s.push("'" + t + "':function(_z){" + l + "=_z}")
							}
							a && (n = "function(){return " + n + " }"), o.push("'" + t + "':" + n)
						}
						r = r || {};
						var o = [],
							s = [],
							a = r.valueAccessors,
							u = r.bindingParams,
							l = "string" == typeof n ? t(n) : n;
						return y.utils.arrayForEach(l, function(e) {
							i(e.key || e.unknown, e.value)
						}), s.length && i("_ko_property_writers", "{" + s.join(",") + " }"), o.join(",")
					}
					var r = ["true", "false", "null", "undefined"],
						i = /^(?:[$_a-z][$\w]*|(.+)(\.\s*[$_a-z][$\w]*|\[.+\]))$/i,
						o = '"(?:[^"\\\\]|\\\\.)*"',
						s = "'(?:[^'\\\\]|\\\\.)*'",
						a = "/(?:[^/\\\\]|\\\\.)*/w*",
						u = ",\"'{}()/:[\\]",
						l = "[^\\s:,/][^" + u + "]*[^\\s" + u + "]",
						c = "[^\\s]",
						d = RegExp(o + "|" + s + "|" + a + "|" + l + "|" + c, "g"),
						f = /[\])"'A-Za-z0-9_$]+$/,
						p = {
							"in": 1,
							"return": 1,
							"typeof": 1
						},
						h = {};
					return {
						bindingRewriteValidators: [],
						twoWayBindings: h,
						parseObjectLiteral: t,
						preProcessBindings: n,
						keyValueArrayContainsKey: function(e, t) {
							for (var n = 0; n < e.length; n++)
								if (e[n].key == t) return !0;
							return !1
						},
						writeValueToProperty: function(e, t, n, r, i) {
							if (e && y.isObservable(e)) !y.isWriteableObservable(e) || i && e.peek() === r || e(r);
							else {
								var o = t.get("_ko_property_writers");
								o && o[n] && o[n](r)
							}
						}
					}
				}(), y.exportSymbol("expressionRewriting", y.expressionRewriting), y.exportSymbol(
					"expressionRewriting.bindingRewriteValidators", y.expressionRewriting.bindingRewriteValidators), y.exportSymbol(
					"expressionRewriting.parseObjectLiteral", y.expressionRewriting.parseObjectLiteral), y.exportSymbol(
					"expressionRewriting.preProcessBindings", y.expressionRewriting.preProcessBindings), y.exportSymbol(
					"expressionRewriting._twoWayBindings", y.expressionRewriting.twoWayBindings), y.exportSymbol(
					"jsonExpressionRewriting", y.expressionRewriting), y.exportSymbol(
					"jsonExpressionRewriting.insertPropertyAccessorsIntoJson", y.expressionRewriting.preProcessBindings),
				function() {
					function e(e) {
						return 8 == e.nodeType && a.test(s ? e.text : e.nodeValue)
					}

					function t(e) {
						return 8 == e.nodeType && u.test(s ? e.text : e.nodeValue)
					}

					function n(n, r) {
						for (var i = n, o = 1, s = []; i = i.nextSibling;) {
							if (t(i) && (o--, 0 === o)) return s;
							s.push(i), e(i) && o++
						}
						if (!r) throw new Error("Cannot find closing comment tag to match: " + n.nodeValue);
						return null
					}

					function i(e, t) {
						var r = n(e, t);
						return r ? r.length > 0 ? r[r.length - 1].nextSibling : e.nextSibling : null
					}

					function o(n) {
						var r = n.firstChild,
							o = null;
						if (r)
							do
								if (o) o.push(r);
								else if (e(r)) {
							var s = i(r, !0);
							s ? r = s : o = [r]
						} else t(r) && (o = [r]);
						while (r = r.nextSibling);
						return o
					}
					var s = r && "<!--test-->" === r.createComment("test").text,
						a = s ? /^<!--\s*ko(?:\s+([\s\S]+))?\s*-->$/ : /^\s*ko(?:\s+([\s\S]+))?\s*$/,
						u = s ? /^<!--\s*\/ko\s*-->$/ : /^\s*\/ko\s*$/,
						l = {
							ul: !0,
							ol: !0
						};
					y.virtualElements = {
						allowedBindings: {},
						childNodes: function(t) {
							return e(t) ? n(t) : t.childNodes
						},
						emptyNode: function(t) {
							if (e(t))
								for (var n = y.virtualElements.childNodes(t), r = 0, i = n.length; r < i; r++) y.removeNode(n[r]);
							else y.utils.emptyDomNode(t)
						},
						setDomNodeChildren: function(t, n) {
							if (e(t)) {
								y.virtualElements.emptyNode(t);
								for (var r = t.nextSibling, i = 0, o = n.length; i < o; i++) r.parentNode.insertBefore(n[i], r)
							} else y.utils.setDomNodeChildren(t, n)
						},
						prepend: function(t, n) {
							e(t) ? t.parentNode.insertBefore(n, t.nextSibling) : t.firstChild ? t.insertBefore(n, t.firstChild) : t.appendChild(
								n)
						},
						insertAfter: function(t, n, r) {
							r ? e(t) ? t.parentNode.insertBefore(n, r.nextSibling) : r.nextSibling ? t.insertBefore(n, r.nextSibling) : t
								.appendChild(n) : y.virtualElements.prepend(t, n)
						},
						firstChild: function(n) {
							return e(n) ? !n.nextSibling || t(n.nextSibling) ? null : n.nextSibling : n.firstChild
						},
						nextSibling: function(n) {
							return e(n) && (n = i(n)), n.nextSibling && t(n.nextSibling) ? null : n.nextSibling
						},
						hasBindingValue: e,
						virtualNodeBindingValue: function(e) {
							var t = (s ? e.text : e.nodeValue).match(a);
							return t ? t[1] : null
						},
						normaliseVirtualElementDomStructure: function(e) {
							if (l[y.utils.tagNameLower(e)]) {
								var t = e.firstChild;
								if (t)
									do
										if (1 === t.nodeType) {
											var n = o(t);
											if (n)
												for (var r = t.nextSibling, i = 0; i < n.length; i++) r ? e.insertBefore(n[i], r) : e.appendChild(n[i])
										}
								while (t = t.nextSibling)
							}
						}
					}
				}(), y.exportSymbol("virtualElements", y.virtualElements), y.exportSymbol("virtualElements.allowedBindings", y.virtualElements
					.allowedBindings), y.exportSymbol("virtualElements.emptyNode", y.virtualElements.emptyNode), y.exportSymbol(
					"virtualElements.insertAfter", y.virtualElements.insertAfter), y.exportSymbol("virtualElements.prepend", y.virtualElements
					.prepend), y.exportSymbol("virtualElements.setDomNodeChildren", y.virtualElements.setDomNodeChildren),
				function() {
					function e(e, n, r) {
						var i = e + (r && r.valueAccessors || "");
						return n[i] || (n[i] = t(e, r))
					}

					function t(e, t) {
						var n = y.expressionRewriting.preProcessBindings(e, t),
							r = "with($context){with($data||{}){return{" + n + "}}}";
						return new Function("$context", "$element", r)
					}
					var n = "data-bind";
					y.bindingProvider = function() {
						this.bindingCache = {}
					}, y.utils.extend(y.bindingProvider.prototype, {
						nodeHasBindings: function(e) {
							switch (e.nodeType) {
								case 1:
									return null != e.getAttribute(n) || y.components.getComponentNameForNode(e);
								case 8:
									return y.virtualElements.hasBindingValue(e);
								default:
									return !1
							}
						},
						getBindings: function(e, t) {
							var n = this.getBindingsString(e, t),
								r = n ? this.parseBindingsString(n, t, e) : null;
							return y.components.addBindingsForCustomElement(r, e, t, !1)
						},
						getBindingAccessors: function(e, t) {
							var n = this.getBindingsString(e, t),
								r = n ? this.parseBindingsString(n, t, e, {
									valueAccessors: !0
								}) : null;
							return y.components.addBindingsForCustomElement(r, e, t, !0)
						},
						getBindingsString: function(e, t) {
							switch (e.nodeType) {
								case 1:
									return e.getAttribute(n);
								case 8:
									return y.virtualElements.virtualNodeBindingValue(e);
								default:
									return null
							}
						},
						parseBindingsString: function(t, n, r, i) {
							try {
								var o = e(t, this.bindingCache, i);
								return o(n, r)
							} catch (s) {
								throw s.message = "Unable to parse bindings.\nBindings value: " + t + "\nMessage: " + s.message, s
							}
						}
					}), y.bindingProvider.instance = new y.bindingProvider
				}(), y.exportSymbol("bindingProvider", y.bindingProvider),
				function() {
					function e(e) {
						return function() {
							return e
						}
					}

					function r(e) {
						return e()
					}

					function i(e) {
						return y.utils.objectMap(y.dependencyDetection.ignore(e), function(t, n) {
							return function() {
								return e()[n]
							}
						})
					}

					function s(t, n, r) {
						return "function" == typeof t ? i(t.bind(null, n, r)) : y.utils.objectMap(t, e)
					}

					function a(e, t) {
						return i(this.getBindings.bind(this, e, t))
					}

					function u(e) {
						var t = y.virtualElements.allowedBindings[e];
						if (!t) throw new Error("The binding '" + e + "' cannot be used with virtual elements")
					}

					function l(e, t, n) {
						var r, i = y.virtualElements.firstChild(t),
							o = y.bindingProvider.instance,
							s = o.preprocessNode;
						if (s) {
							for (; r = i;) i = y.virtualElements.nextSibling(r), s.call(o, r);
							i = y.virtualElements.firstChild(t)
						}
						for (; r = i;) i = y.virtualElements.nextSibling(r), c(e, r, n)
					}

					function c(e, t, n) {
						var r = !0,
							i = 1 === t.nodeType;
						i && y.virtualElements.normaliseVirtualElementDomStructure(t);
						var o = i && n || y.bindingProvider.instance.nodeHasBindings(t);
						o && (r = f(t, null, e, n).shouldBindDescendants), r && !h[y.utils.tagNameLower(t)] && l(e, t, !i)
					}

					function d(e) {
						var t = [],
							n = {},
							r = [];
						return y.utils.objectForEach(e, function i(o) {
							if (!n[o]) {
								var s = y.getBindingHandler(o);
								s && (s.after && (r.push(o), y.utils.arrayForEach(s.after, function(t) {
									if (e[t]) {
										if (y.utils.arrayIndexOf(r, t) !== -1) throw Error(
											"Cannot combine the following bindings, because they have a cyclic dependency: " + r.join(", "));
										i(t)
									}
								}), r.length--), t.push({
									key: o,
									handler: s
								})), n[o] = !0
							}
						}), t
					}

					function f(e, n, i, o) {
						function s() {
							return y.utils.objectMap(h ? h() : c, r)
						}
						var l = y.utils.domData.get(e, m);
						if (!n) {
							if (l) throw Error("You cannot apply bindings multiple times to the same element.");
							y.utils.domData.set(e, m, !0)
						}!l && o && y.storedBindingContextForNode(e, i);
						var c;
						if (n && "function" != typeof n) c = n;
						else {
							var f = y.bindingProvider.instance,
								p = f.getBindingAccessors || a,
								h = y.dependentObservable(function() {
									return c = n ? n(i, e) : p.call(f, e, i), c && i._subscribable && i._subscribable(), c
								}, null, {
									disposeWhenNodeIsRemoved: e
								});
							c && h.isActive() || (h = null)
						}
						var g;
						if (c) {
							var v = h ? function(e) {
								return function() {
									return r(h()[e])
								}
							} : function(e) {
								return c[e]
							};
							s.get = function(e) {
								return c[e] && r(v(e))
							}, s.has = function(e) {
								return e in c
							};
							var b = d(c);
							y.utils.arrayForEach(b, function(n) {
								var r = n.handler.init,
									o = n.handler.update,
									a = n.key;
								8 === e.nodeType && u(a);
								try {
									"function" == typeof r && y.dependencyDetection.ignore(function() {
										var n = r(e, v(a), s, i.$data, i);
										if (n && n.controlsDescendantBindings) {
											if (g !== t) throw new Error("Multiple bindings (" + g + " and " + a +
												") are trying to control descendant bindings of the same element. You cannot use these bindings together on the same element."
											);
											g = a
										}
									}), "function" == typeof o && y.dependentObservable(function() {
										o(e, v(a), s, i.$data, i)
									}, null, {
										disposeWhenNodeIsRemoved: e
									})
								} catch (l) {
									throw l.message = 'Unable to process binding "' + a + ": " + c[a] + '"\nMessage: ' + l.message, l
								}
							})
						}
						return {
							shouldBindDescendants: g === t
						}
					}

					function p(e) {
						return e && e instanceof y.bindingContext ? e : new y.bindingContext(e)
					}
					y.bindingHandlers = {};
					var h = {
						script: !0,
						textarea: !0,
						template: !0
					};
					y.getBindingHandler = function(e) {
						return y.bindingHandlers[e]
					}, y.bindingContext = function(e, n, r, i) {
						function o() {
							var t = l ? e() : e,
								o = y.utils.unwrapObservable(t);
							return n ? (n._subscribable && n._subscribable(), y.utils.extend(u, n), c && (u._subscribable = c)) : (u.$parents = [],
								u.$root = o, u.ko = y), u.$rawData = t, u.$data = o, r && (u[r] = o), i && i(u, n, o), u.$data
						}

						function s() {
							return a && !y.utils.anyDomNodeIsAttachedToDocument(a)
						}
						var a, u = this,
							l = "function" == typeof e && !y.isObservable(e),
							c = y.dependentObservable(o, null, {
								disposeWhen: s,
								disposeWhenNodeIsRemoved: !0
							});
						c.isActive() && (u._subscribable = c, c.equalityComparer = null, a = [], c._addNode = function(e) {
							a.push(e), y.utils.domNodeDisposal.addDisposeCallback(e, function(e) {
								y.utils.arrayRemoveItem(a, e), a.length || (c.dispose(), u._subscribable = c = t)
							})
						})
					}, y.bindingContext.prototype.createChildContext = function(e, t, n) {
						return new y.bindingContext(e, this, t, function(e, t) {
							e.$parentContext = t, e.$parent = t.$data, e.$parents = (t.$parents || []).slice(0), e.$parents.unshift(e.$parent),
								n && n(e)
						})
					}, y.bindingContext.prototype.extend = function(e) {
						return new y.bindingContext(this._subscribable || this.$data, this, null, function(t, n) {
							t.$rawData = n.$rawData, y.utils.extend(t, "function" == typeof e ? e() : e)
						})
					};
					var m = y.utils.domData.nextKey(),
						g = y.utils.domData.nextKey();
					y.storedBindingContextForNode = function(e, t) {
							return 2 != arguments.length ? y.utils.domData.get(e, g) : (y.utils.domData.set(e, g, t), void(t._subscribable &&
								t._subscribable._addNode(e)))
						}, y.applyBindingAccessorsToNode = function(e, t, n) {
							return 1 === e.nodeType && y.virtualElements.normaliseVirtualElementDomStructure(e), f(e, t, p(n), !0)
						}, y.applyBindingsToNode = function(e, t, n) {
							var r = p(n);
							return y.applyBindingAccessorsToNode(e, s(t, r, e), r)
						}, y.applyBindingsToDescendants = function(e, t) {
							1 !== t.nodeType && 8 !== t.nodeType || l(p(e), t, !0)
						}, y.applyBindings = function(e, t) {
							if (!o && n.jQuery && (o = n.jQuery), t && 1 !== t.nodeType && 8 !== t.nodeType) throw new Error(
								"ko.applyBindings: first parameter should be your view model; second parameter should be a DOM node");
							t = t || n.document.body, c(p(e), t, !0)
						}, y.contextFor = function(e) {
							switch (e.nodeType) {
								case 1:
								case 8:
									var n = y.storedBindingContextForNode(e);
									if (n) return n;
									if (e.parentNode) return y.contextFor(e.parentNode)
							}
							return t
						}, y.dataFor = function(e) {
							var n = y.contextFor(e);
							return n ? n.$data : t
						}, y.exportSymbol("bindingHandlers", y.bindingHandlers), y.exportSymbol("applyBindings", y.applyBindings), y.exportSymbol(
							"applyBindingsToDescendants", y.applyBindingsToDescendants), y.exportSymbol("applyBindingAccessorsToNode", y.applyBindingAccessorsToNode),
						y.exportSymbol("applyBindingsToNode", y.applyBindingsToNode), y.exportSymbol("contextFor", y.contextFor), y.exportSymbol(
							"dataFor", y.dataFor)
				}(),
				function(e) {
					function t(t, n) {
						return t.hasOwnProperty(n) ? t[n] : e
					}

					function n(e, n) {
						var i, a = t(o, e);
						a ? a.subscribe(n) : (a = o[e] = new y.subscribable, a.subscribe(n), r(e, function(t, n) {
							var r = !(!n || !n.synchronous);
							s[e] = {
								definition: t,
								isSynchronousComponent: r
							}, delete o[e], i || r ? a.notifySubscribers(t) : y.tasks.schedule(function() {
								a.notifySubscribers(t)
							})
						}), i = !0)
					}

					function r(e, t) {
						i("getConfig", [e], function(n) {
							n ? i("loadComponent", [e, n], function(e) {
								t(e, n)
							}) : t(null, null)
						})
					}

					function i(t, n, r, o) {
						o || (o = y.components.loaders.slice(0));
						var s = o.shift();
						if (s) {
							var a = s[t];
							if (a) {
								var u = !1,
									l = a.apply(s, n.concat(function(e) {
										u ? r(null) : null !== e ? r(e) : i(t, n, r, o)
									}));
								if (l !== e && (u = !0, !s.suppressLoaderExceptions)) throw new Error(
									"Component loaders must supply values by invoking the callback, not by returning values synchronously.")
							} else i(t, n, r, o)
						} else r(null)
					}
					var o = {},
						s = {};
					y.components = {
						get: function(e, r) {
							var i = t(s, e);
							i ? i.isSynchronousComponent ? y.dependencyDetection.ignore(function() {
								r(i.definition)
							}) : y.tasks.schedule(function() {
								r(i.definition)
							}) : n(e, r)
						},
						clearCachedDefinition: function(e) {
							delete s[e]
						},
						_getFirstResultFromLoaders: i
					}, y.components.loaders = [], y.exportSymbol("components", y.components), y.exportSymbol("components.get", y.components
						.get), y.exportSymbol("components.clearCachedDefinition", y.components.clearCachedDefinition)
				}(),
				function(e) {
					function t(e, t, n, r) {
						var i = {},
							o = 2,
							s = function() {
								0 === --o && r(i)
							},
							a = n.template,
							u = n.viewModel;
						a ? c(t, a, function(t) {
							y.components._getFirstResultFromLoaders("loadTemplate", [e, t], function(e) {
								i.template = e, s()
							})
						}) : s(), u ? c(t, u, function(t) {
							y.components._getFirstResultFromLoaders("loadViewModel", [e, t], function(e) {
								i[p] = e, s()
							})
						}) : s()
					}

					function i(e, t, n) {
						if ("string" == typeof t) n(y.utils.parseHtmlFragment(t));
						else if (t instanceof Array) n(t);
						else if (l(t)) n(y.utils.makeArray(t.childNodes));
						else if (t.element) {
							var i = t.element;
							if (a(i)) n(s(i));
							else if ("string" == typeof i) {
								var o = r.getElementById(i);
								o ? n(s(o)) : e("Cannot find element with ID " + i)
							} else e("Unknown element type: " + i)
						} else e("Unknown template value: " + t)
					}

					function o(e, t, n) {
						if ("function" == typeof t) n(function(e) {
							return new t(e)
						});
						else if ("function" == typeof t[p]) n(t[p]);
						else if ("instance" in t) {
							var r = t.instance;
							n(function(e, t) {
								return r
							})
						} else "viewModel" in t ? o(e, t.viewModel, n) : e("Unknown viewModel value: " + t)
					}

					function s(e) {
						switch (y.utils.tagNameLower(e)) {
							case "script":
								return y.utils.parseHtmlFragment(e.text);
							case "textarea":
								return y.utils.parseHtmlFragment(e.value);
							case "template":
								if (l(e.content)) return y.utils.cloneNodes(e.content.childNodes)
						}
						return y.utils.cloneNodes(e.childNodes)
					}

					function a(e) {
						return n.HTMLElement ? e instanceof HTMLElement : e && e.tagName && 1 === e.nodeType
					}

					function l(e) {
						return n.DocumentFragment ? e instanceof DocumentFragment : e && 11 === e.nodeType
					}

					function c(e, t, r) {
						"string" == typeof t.require ? u || n.require ? (u || n.require)([t.require], r) : e(
							"Uses require, but no AMD loader is present") : r(t)
					}

					function d(e) {
						return function(t) {
							throw new Error("Component '" + e + "': " + t)
						}
					}
					var f = {};
					y.components.register = function(e, t) {
						if (!t) throw new Error("Invalid configuration for " + e);
						if (y.components.isRegistered(e)) throw new Error("Component " + e + " is already registered");
						f[e] = t
					}, y.components.isRegistered = function(e) {
						return f.hasOwnProperty(e)
					}, y.components.unregister = function(e) {
						delete f[e], y.components.clearCachedDefinition(e)
					}, y.components.defaultLoader = {
						getConfig: function(e, t) {
							var n = f.hasOwnProperty(e) ? f[e] : null;
							t(n)
						},
						loadComponent: function(e, n, r) {
							var i = d(e);
							c(i, n, function(n) {
								t(e, i, n, r)
							})
						},
						loadTemplate: function(e, t, n) {
							i(d(e), t, n)
						},
						loadViewModel: function(e, t, n) {
							o(d(e), t, n)
						}
					};
					var p = "createViewModel";
					y.exportSymbol("components.register", y.components.register), y.exportSymbol("components.isRegistered", y.components
							.isRegistered), y.exportSymbol("components.unregister", y.components.unregister), y.exportSymbol(
							"components.defaultLoader", y.components.defaultLoader), y.components.loaders.push(y.components.defaultLoader),
						y.components._allRegisteredComponents = f
				}(),
				function(e) {
					function t(e, t) {
						var r = e.getAttribute("params");
						if (r) {
							var i = n.parseBindingsString(r, t, e, {
									valueAccessors: !0,
									bindingParams: !0
								}),
								o = y.utils.objectMap(i, function(t, n) {
									return y.computed(t, null, {
										disposeWhenNodeIsRemoved: e
									})
								}),
								s = y.utils.objectMap(o, function(t, n) {
									var r = t.peek();
									return t.isActive() ? y.computed({
										read: function() {
											return y.utils.unwrapObservable(t())
										},
										write: y.isWriteableObservable(r) && function(e) {
											t()(e)
										},
										disposeWhenNodeIsRemoved: e
									}) : r
								});
							return s.hasOwnProperty("$raw") || (s.$raw = o), s
						}
						return {
							$raw: {}
						}
					}
					y.components.getComponentNameForNode = function(e) {
						var t = y.utils.tagNameLower(e);
						if (y.components.isRegistered(t) && (t.indexOf("-") != -1 || "" + e == "[object HTMLUnknownElement]" || y.utils
								.ieVersion <= 8 && e.tagName === t)) return t
					}, y.components.addBindingsForCustomElement = function(e, n, r, i) {
						if (1 === n.nodeType) {
							var o = y.components.getComponentNameForNode(n);
							if (o) {
								if (e = e || {}, e.component) throw new Error(
									'Cannot use the "component" binding on a custom element matching a component');
								var s = {
									name: o,
									params: t(n, r)
								};
								e.component = i ? function() {
									return s
								} : s
							}
						}
						return e
					};
					var n = new y.bindingProvider;
					y.utils.ieVersion < 9 && (y.components.register = function(e) {
						return function(t) {
							return r.createElement(t), e.apply(this, arguments)
						}
					}(y.components.register), r.createDocumentFragment = function(e) {
						return function() {
							var t = e(),
								n = y.components._allRegisteredComponents;
							for (var r in n) n.hasOwnProperty(r) && t.createElement(r);
							return t
						}
					}(r.createDocumentFragment))
				}(),
				function(e) {
					function t(e, t, n) {
						var r = t.template;
						if (!r) throw new Error("Component '" + e + "' has no template");
						var i = y.utils.cloneNodes(r);
						y.virtualElements.setDomNodeChildren(n, i)
					}

					function n(e, t, n, r) {
						var i = e.createViewModel;
						return i ? i.call(e, r, {
							element: t,
							templateNodes: n
						}) : r
					}
					var r = 0;
					y.bindingHandlers.component = {
						init: function(i, o, s, a, u) {
							var l, c, d = function() {
									var e = l && l.dispose;
									"function" == typeof e && e.call(l), l = null, c = null
								},
								f = y.utils.makeArray(y.virtualElements.childNodes(i));
							return y.utils.domNodeDisposal.addDisposeCallback(i, d), y.computed(function() {
								var s, a, p = y.utils.unwrapObservable(o());
								if ("string" == typeof p ? s = p : (s = y.utils.unwrapObservable(p.name), a = y.utils.unwrapObservable(p.params)), !
									s) throw new Error("No component name specified");
								var h = c = ++r;
								y.components.get(s, function(r) {
									if (c === h) {
										if (d(), !r) throw new Error("Unknown component '" + s + "'");
										t(s, r, i);
										var o = n(r, i, f, a),
											p = u.createChildContext(o, e, function(e) {
												e.$component = o, e.$componentTemplateNodes = f
											});
										l = o, y.applyBindingsToDescendants(p, i)
									}
								})
							}, null, {
								disposeWhenNodeIsRemoved: i
							}), {
								controlsDescendantBindings: !0
							}
						}
					}, y.virtualElements.allowedBindings.component = !0
				}();
			var M = {
				"class": "className",
				"for": "htmlFor"
			};
			y.bindingHandlers.attr = {
					update: function(e, n, r) {
						var i = y.utils.unwrapObservable(n()) || {};
						y.utils.objectForEach(i, function(n, r) {
							r = y.utils.unwrapObservable(r);
							var i = r === !1 || null === r || r === t;
							i && e.removeAttribute(n), y.utils.ieVersion <= 8 && n in M ? (n = M[n], i ? e.removeAttribute(n) : e[n] = r) :
								i || e.setAttribute(n, r.toString()), "name" === n && y.utils.setElementName(e, i ? "" : r.toString())
						})
					}
				},
				function() {
					y.bindingHandlers.checked = {
						after: ["value", "attr"],
						init: function(e, n, r) {
							function i() {
								var t = e.checked,
									i = p ? s() : t;
								if (!y.computedContext.isInitial() && (!u || t)) {
									var o = y.dependencyDetection.ignore(n);
									if (c) {
										var a = d ? o.peek() : o;
										f !== i ? (t && (y.utils.addOrRemoveItem(a, i, !0), y.utils.addOrRemoveItem(a, f, !1)), f = i) : y.utils.addOrRemoveItem(
											a, i, t), d && y.isWriteableObservable(o) && o(a)
									} else y.expressionRewriting.writeValueToProperty(o, r, "checked", i, !0)
								}
							}

							function o() {
								var t = y.utils.unwrapObservable(n());
								c ? e.checked = y.utils.arrayIndexOf(t, s()) >= 0 : a ? e.checked = t : e.checked = s() === t
							}
							var s = y.pureComputed(function() {
									return r.has("checkedValue") ? y.utils.unwrapObservable(r.get("checkedValue")) : r.has("value") ? y.utils.unwrapObservable(
										r.get("value")) : e.value
								}),
								a = "checkbox" == e.type,
								u = "radio" == e.type;
							if (a || u) {
								var l = n(),
									c = a && y.utils.unwrapObservable(l) instanceof Array,
									d = !(c && l.push && l.splice),
									f = c ? s() : t,
									p = u || c;
								u && !e.name && y.bindingHandlers.uniqueName.init(e, function() {
									return !0
								}), y.computed(i, null, {
									disposeWhenNodeIsRemoved: e
								}), y.utils.registerEventHandler(e, "click", i), y.computed(o, null, {
									disposeWhenNodeIsRemoved: e
								}), l = t
							}
						}
					}, y.expressionRewriting.twoWayBindings.checked = !0, y.bindingHandlers.checkedValue = {
						update: function(e, t) {
							e.value = y.utils.unwrapObservable(t())
						}
					}
				}();
			var A = "__ko__cssValue";
			y.bindingHandlers.css = {
				update: function(e, t) {
					var n = y.utils.unwrapObservable(t());
					null !== n && "object" == typeof n ? y.utils.objectForEach(n, function(t, n) {
						n = y.utils.unwrapObservable(n), y.utils.toggleDomNodeCssClass(e, t, n)
					}) : (n = y.utils.stringTrim(String(n || "")), y.utils.toggleDomNodeCssClass(e, e[A], !1), e[A] = n, y.utils.toggleDomNodeCssClass(
						e, n, !0))
				}
			}, y.bindingHandlers.enable = {
				update: function(e, t) {
					var n = y.utils.unwrapObservable(t());
					n && e.disabled ? e.removeAttribute("disabled") : n || e.disabled || (e.disabled = !0)
				}
			}, y.bindingHandlers.disable = {
				update: function(e, t) {
					y.bindingHandlers.enable.update(e, function() {
						return !y.utils.unwrapObservable(t())
					})
				}
			}, y.bindingHandlers.event = {
				init: function(e, t, n, r, i) {
					var o = t() || {};
					y.utils.objectForEach(o, function(o) {
						"string" == typeof o && y.utils.registerEventHandler(e, o, function(e) {
							var s, a = t()[o];
							if (a) {
								try {
									var u = y.utils.makeArray(arguments);
									r = i.$data, u.unshift(r), s = a.apply(r, u)
								} finally {
									s !== !0 && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
								}
								var l = n.get(o + "Bubble") !== !1;
								l || (e.cancelBubble = !0, e.stopPropagation && e.stopPropagation())
							}
						})
					})
				}
			}, y.bindingHandlers.foreach = {
				makeTemplateValueAccessor: function(e) {
					return function() {
						var t = e(),
							n = y.utils.peekObservable(t);
						return n && "number" != typeof n.length ? (y.utils.unwrapObservable(t), {
							foreach: n.data,
							as: n.as,
							includeDestroyed: n.includeDestroyed,
							afterAdd: n.afterAdd,
							beforeRemove: n.beforeRemove,
							afterRender: n.afterRender,
							beforeMove: n.beforeMove,
							afterMove: n.afterMove,
							templateEngine: y.nativeTemplateEngine.instance
						}) : {
							foreach: t,
							templateEngine: y.nativeTemplateEngine.instance
						}
					}
				},
				init: function(e, t, n, r, i) {
					return y.bindingHandlers.template.init(e, y.bindingHandlers.foreach.makeTemplateValueAccessor(t))
				},
				update: function(e, t, n, r, i) {
					return y.bindingHandlers.template.update(e, y.bindingHandlers.foreach.makeTemplateValueAccessor(t), n, r, i)
				}
			}, y.expressionRewriting.bindingRewriteValidators.foreach = !1, y.virtualElements.allowedBindings.foreach = !0;
			var F = "__ko_hasfocusUpdating",
				H = "__ko_hasfocusLastValue";
			y.bindingHandlers.hasfocus = {
					init: function(e, t, n) {
						var r = function(r) {
								e[F] = !0;
								var i = e.ownerDocument;
								if ("activeElement" in i) {
									var o;
									try {
										o = i.activeElement
									} catch (s) {
										o = i.body
									}
									r = o === e
								}
								var a = t();
								y.expressionRewriting.writeValueToProperty(a, n, "hasfocus", r, !0), e[H] = r, e[F] = !1
							},
							i = r.bind(null, !0),
							o = r.bind(null, !1);
						y.utils.registerEventHandler(e, "focus", i), y.utils.registerEventHandler(e, "focusin", i), y.utils.registerEventHandler(
							e, "blur", o), y.utils.registerEventHandler(e, "focusout", o)
					},
					update: function(e, t) {
						var n = !!y.utils.unwrapObservable(t());
						e[F] || e[H] === n || (n ? e.focus() : e.blur(), !n && e[H] && e.ownerDocument.body.focus(), y.dependencyDetection
							.ignore(y.utils.triggerEvent, null, [e, n ? "focusin" : "focusout"]))
					}
				}, y.expressionRewriting.twoWayBindings.hasfocus = !0, y.bindingHandlers.hasFocus = y.bindingHandlers.hasfocus, y.expressionRewriting
				.twoWayBindings.hasFocus = !0, y.bindingHandlers.html = {
					init: function() {
						return {
							controlsDescendantBindings: !0
						}
					},
					update: function(e, t) {
						y.utils.setHtml(e, t())
					}
				}, v("if"), v("ifnot", !1, !0), v("with", !0, !1, function(e, t) {
					return e.createChildContext(t)
				});
			var j = {};
			y.bindingHandlers.options = {
					init: function(e) {
						if ("select" !== y.utils.tagNameLower(e)) throw new Error("options binding applies only to SELECT elements");
						for (; e.length > 0;) e.remove(0);
						return {
							controlsDescendantBindings: !0
						}
					},
					update: function(e, n, r) {
						function i() {
							return y.utils.arrayFilter(e.options, function(e) {
								return e.selected
							})
						}

						function o(e, t, n) {
							var r = typeof t;
							return "function" == r ? t(e) : "string" == r ? e[t] : n
						}

						function s(n, i, s) {
							s.length && (v = !h && s[0].selected ? [y.selectExtensions.readValue(s[0])] : [], b = !0);
							var a = e.ownerDocument.createElement("option");
							if (n === j) y.utils.setTextContent(a, r.get("optionsCaption")), y.selectExtensions.writeValue(a, t);
							else {
								var u = o(n, r.get("optionsValue"), n);
								y.selectExtensions.writeValue(a, y.utils.unwrapObservable(u));
								var l = o(n, r.get("optionsText"), u);
								y.utils.setTextContent(a, l)
							}
							return [a]
						}

						function a(t, n) {
							if (b && h) y.selectExtensions.writeValue(e, y.utils.unwrapObservable(r.get("value")), !0);
							else if (v.length) {
								var i = y.utils.arrayIndexOf(v, y.selectExtensions.readValue(n[0])) >= 0;
								y.utils.setOptionNodeSelectionState(n[0], i), b && !i && y.dependencyDetection.ignore(y.utils.triggerEvent,
									null, [e, "change"])
							}
						}
						var u, l, c = 0 == e.length,
							d = e.multiple,
							f = !c && d ? e.scrollTop : null,
							p = y.utils.unwrapObservable(n()),
							h = r.get("valueAllowUnset") && r.has("value"),
							m = r.get("optionsIncludeDestroyed"),
							g = {},
							v = [];
						h || (d ? v = y.utils.arrayMap(i(), y.selectExtensions.readValue) : e.selectedIndex >= 0 && v.push(y.selectExtensions
							.readValue(e.options[e.selectedIndex]))), p && ("undefined" == typeof p.length && (p = [p]), l = y.utils.arrayFilter(
							p,
							function(e) {
								return m || e === t || null === e || !y.utils.unwrapObservable(e._destroy)
							}), r.has("optionsCaption") && (u = y.utils.unwrapObservable(r.get("optionsCaption")), null !== u && u !== t &&
							l.unshift(j)));
						var b = !1;
						g.beforeRemove = function(t) {
							e.removeChild(t)
						};
						var x = a;
						r.has("optionsAfterRender") && "function" == typeof r.get("optionsAfterRender") && (x = function(e, n) {
							a(e, n), y.dependencyDetection.ignore(r.get("optionsAfterRender"), null, [n[0], e !== j ? e : t])
						}), y.utils.setDomNodeChildrenFromArrayMapping(e, l, s, g, x), y.dependencyDetection.ignore(function() {
							if (h) y.selectExtensions.writeValue(e, y.utils.unwrapObservable(r.get("value")), !0);
							else {
								var t;
								t = d ? v.length && i().length < v.length : v.length && e.selectedIndex >= 0 ? y.selectExtensions.readValue(
									e.options[e.selectedIndex]) !== v[0] : v.length || e.selectedIndex >= 0, t && y.utils.triggerEvent(e,
									"change")
							}
						}), y.utils.ensureSelectElementIsRenderedCorrectly(e), f && Math.abs(f - e.scrollTop) > 20 && (e.scrollTop = f)
					}
				}, y.bindingHandlers.options.optionValueDomDataKey = y.utils.domData.nextKey(), y.bindingHandlers.selectedOptions = {
					after: ["options", "foreach"],
					init: function(e, t, n) {
						y.utils.registerEventHandler(e, "change", function() {
							var r = t(),
								i = [];
							y.utils.arrayForEach(e.getElementsByTagName("option"), function(e) {
								e.selected && i.push(y.selectExtensions.readValue(e))
							}), y.expressionRewriting.writeValueToProperty(r, n, "selectedOptions", i)
						})
					},
					update: function(e, t) {
						if ("select" != y.utils.tagNameLower(e)) throw new Error("values binding applies only to SELECT elements");
						var n = y.utils.unwrapObservable(t()),
							r = e.scrollTop;
						n && "number" == typeof n.length && y.utils.arrayForEach(e.getElementsByTagName("option"), function(e) {
							var t = y.utils.arrayIndexOf(n, y.selectExtensions.readValue(e)) >= 0;
							e.selected != t && y.utils.setOptionNodeSelectionState(e, t)
						}), e.scrollTop = r
					}
				}, y.expressionRewriting.twoWayBindings.selectedOptions = !0, y.bindingHandlers.style = {
					update: function(e, n) {
						var r = y.utils.unwrapObservable(n() || {});
						y.utils.objectForEach(r, function(n, r) {
							r = y.utils.unwrapObservable(r), null !== r && r !== t && r !== !1 || (r = ""), e.style[n] = r
						})
					}
				}, y.bindingHandlers.submit = {
					init: function(e, t, n, r, i) {
						if ("function" != typeof t()) throw new Error("The value for a submit binding must be a function");
						y.utils.registerEventHandler(e, "submit", function(n) {
							var r, o = t();
							try {
								r = o.call(i.$data, e)
							} finally {
								r !== !0 && (n.preventDefault ? n.preventDefault() : n.returnValue = !1)
							}
						})
					}
				}, y.bindingHandlers.text = {
					init: function() {
						return {
							controlsDescendantBindings: !0
						}
					},
					update: function(e, t) {
						y.utils.setTextContent(e, t())
					}
				}, y.virtualElements.allowedBindings.text = !0,
				function() {
					if (n && n.navigator) var r = function(e) {
							if (e) return parseFloat(e[1])
						},
						i = n.opera && n.opera.version && parseInt(n.opera.version()),
						o = n.navigator.userAgent,
						s = r(o.match(/^(?:(?!chrome).)*version\/([^ ]*) safari/i)),
						a = r(o.match(/Firefox\/([^ ]*)/));
					if (y.utils.ieVersion < 10) var u = y.utils.domData.nextKey(),
						l = y.utils.domData.nextKey(),
						c = function(e) {
							var t = this.activeElement,
								n = t && y.utils.domData.get(t, l);
							n && n(e)
						},
						d = function(e, t) {
							var n = e.ownerDocument;
							y.utils.domData.get(n, u) || (y.utils.domData.set(n, u, !0), y.utils.registerEventHandler(n, "selectionchange",
								c)), y.utils.domData.set(e, l, t)
						};
					y.bindingHandlers.textInput = {
						init: function(n, r, o) {
							var u, l, c = n.value,
								f = function(i) {
									clearTimeout(u), l = u = t;
									var s = n.value;
									c !== s && (e && i && (n._ko_textInputProcessedEvent = i.type), c = s, y.expressionRewriting.writeValueToProperty(
										r(), o, "textInput", s))
								},
								p = function(t) {
									if (!u) {
										l = n.value;
										var r = e ? f.bind(n, {
											type: t.type
										}) : f;
										u = y.utils.setTimeout(r, 4)
									}
								},
								h = 9 == y.utils.ieVersion ? p : f,
								m = function() {
									var e = y.utils.unwrapObservable(r());
									return null !== e && e !== t || (e = ""), l !== t && e === l ? void y.utils.setTimeout(m, 4) : void(n.value !==
										e && (c = e, n.value = e))
								},
								g = function(e, t) {
									y.utils.registerEventHandler(n, e, t)
								};
							e && y.bindingHandlers.textInput._forceUpdateOn ? y.utils.arrayForEach(y.bindingHandlers.textInput._forceUpdateOn,
								function(e) {
									"after" == e.slice(0, 5) ? g(e.slice(5), p) : g(e, f)
								}) : y.utils.ieVersion < 10 ? (g("propertychange", function(e) {
								"value" === e.propertyName && h(e)
							}), 8 == y.utils.ieVersion && (g("keyup", f), g("keydown", f)), y.utils.ieVersion >= 8 && (d(n, h), g(
								"dragend", p))) : (g("input", f), s < 5 && "textarea" === y.utils.tagNameLower(n) ? (g("keydown", p), g(
								"paste", p), g("cut", p)) : i < 11 ? g("keydown", p) : a < 4 && (g("DOMAutoComplete", f), g("dragdrop", f),
								g("drop", f))), g("change", f), y.computed(m, null, {
								disposeWhenNodeIsRemoved: n
							})
						}
					}, y.expressionRewriting.twoWayBindings.textInput = !0, y.bindingHandlers.textinput = {
						preprocess: function(e, t, n) {
							n("textInput", e)
						}
					}
				}(), y.bindingHandlers.uniqueName = {
					init: function(e, t) {
						if (t()) {
							var n = "ko_unique_" + ++y.bindingHandlers.uniqueName.currentIndex;
							y.utils.setElementName(e, n)
						}
					}
				}, y.bindingHandlers.uniqueName.currentIndex = 0, y.bindingHandlers.value = {
					after: ["options", "foreach"],
					init: function(e, t, n) {
						if ("input" == e.tagName.toLowerCase() && ("checkbox" == e.type || "radio" == e.type)) return void y.applyBindingAccessorsToNode(
							e, {
								checkedValue: t
							});
						var r = ["change"],
							i = n.get("valueUpdate"),
							o = !1,
							s = null;
						i && ("string" == typeof i && (i = [i]), y.utils.arrayPushAll(r, i), r = y.utils.arrayGetDistinctValues(r));
						var a = function() {
								s = null, o = !1;
								var r = t(),
									i = y.selectExtensions.readValue(e);
								y.expressionRewriting.writeValueToProperty(r, n, "value", i)
							},
							u = y.utils.ieVersion && "input" == e.tagName.toLowerCase() && "text" == e.type && "off" != e.autocomplete &&
							(!e.form || "off" != e.form.autocomplete);
						u && y.utils.arrayIndexOf(r, "propertychange") == -1 && (y.utils.registerEventHandler(e, "propertychange",
							function() {
								o = !0
							}), y.utils.registerEventHandler(e, "focus", function() {
							o = !1
						}), y.utils.registerEventHandler(e, "blur", function() {
							o && a()
						})), y.utils.arrayForEach(r, function(t) {
							var n = a;
							y.utils.stringStartsWith(t, "after") && (n = function() {
								s = y.selectExtensions.readValue(e), y.utils.setTimeout(a, 0)
							}, t = t.substring("after".length)), y.utils.registerEventHandler(e, t, n)
						});
						var l = function() {
							var r = y.utils.unwrapObservable(t()),
								i = y.selectExtensions.readValue(e);
							if (null !== s && r === s) return void y.utils.setTimeout(l, 0);
							var o = r !== i;
							if (o)
								if ("select" === y.utils.tagNameLower(e)) {
									var a = n.get("valueAllowUnset"),
										u = function() {
											y.selectExtensions.writeValue(e, r, a)
										};
									u(), a || r === y.selectExtensions.readValue(e) ? y.utils.setTimeout(u, 0) : y.dependencyDetection.ignore(y
										.utils.triggerEvent, null, [e, "change"])
								} else y.selectExtensions.writeValue(e, r)
						};
						y.computed(l, null, {
							disposeWhenNodeIsRemoved: e
						})
					},
					update: function() {}
				}, y.expressionRewriting.twoWayBindings.value = !0, y.bindingHandlers.visible = {
					update: function(e, t) {
						var n = y.utils.unwrapObservable(t()),
							r = !("none" == e.style.display);
						n && !r ? e.style.display = "" : !n && r && (e.style.display = "none")
					}
				}, g("click"), y.templateEngine = function() {}, y.templateEngine.prototype.renderTemplateSource = function(e, t,
					n, r) {
					throw new Error("Override renderTemplateSource")
				}, y.templateEngine.prototype.createJavaScriptEvaluatorBlock = function(e) {
					throw new Error("Override createJavaScriptEvaluatorBlock")
				}, y.templateEngine.prototype.makeTemplateSource = function(e, t) {
					if ("string" == typeof e) {
						t = t || r;
						var n = t.getElementById(e);
						if (!n) throw new Error("Cannot find template with ID " + e);
						return new y.templateSources.domElement(n)
					}
					if (1 == e.nodeType || 8 == e.nodeType) return new y.templateSources.anonymousTemplate(e);
					throw new Error("Unknown template type: " + e)
				}, y.templateEngine.prototype.renderTemplate = function(e, t, n, r) {
					var i = this.makeTemplateSource(e, r);
					return this.renderTemplateSource(i, t, n, r)
				}, y.templateEngine.prototype.isTemplateRewritten = function(e, t) {
					return this.allowTemplateRewriting === !1 || this.makeTemplateSource(e, t).data("isRewritten")
				}, y.templateEngine.prototype.rewriteTemplate = function(e, t, n) {
					var r = this.makeTemplateSource(e, n),
						i = t(r.text());
					r.text(i), r.data("isRewritten", !0)
				}, y.exportSymbol("templateEngine", y.templateEngine), y.templateRewriting = function() {
					function e(e) {
						for (var t = y.expressionRewriting.bindingRewriteValidators, n = 0; n < e.length; n++) {
							var r = e[n].key;
							if (t.hasOwnProperty(r)) {
								var i = t[r];
								if ("function" == typeof i) {
									var o = i(e[n].value);
									if (o) throw new Error(o)
								} else if (!i) throw new Error("This template engine does not support the '" + r +
									"' binding within its templates")
							}
						}
					}

					function t(t, n, r, i) {
						var o = y.expressionRewriting.parseObjectLiteral(t);
						e(o);
						var s = y.expressionRewriting.preProcessBindings(o, {
								valueAccessors: !0
							}),
							a = "ko.__tr_ambtns(function($context,$element){return(function(){return{ " + s + " } })()},'" + r.toLowerCase() +
							"')";
						return i.createJavaScriptEvaluatorBlock(a) + n
					}
					var n =
						/(<([a-z]+\d*)(?:\s+(?!data-bind\s*=\s*)[a-z0-9\-]+(?:=(?:\"[^\"]*\"|\'[^\']*\'|[^>]*))?)*\s+)data-bind\s*=\s*(["'])([\s\S]*?)\3/gi,
						r = /<!--\s*ko\b\s*([\s\S]*?)\s*-->/g;
					return {
						ensureTemplateIsRewritten: function(e, t, n) {
							t.isTemplateRewritten(e, n) || t.rewriteTemplate(e, function(e) {
								return y.templateRewriting.memoizeBindingAttributeSyntax(e, t)
							}, n)
						},
						memoizeBindingAttributeSyntax: function(e, i) {
							return e.replace(n, function() {
								return t(arguments[4], arguments[1], arguments[2], i)
							}).replace(r, function() {
								return t(arguments[1], "<!-- ko -->", "#comment", i)
							})
						},
						applyMemoizedBindingsToNextSibling: function(e, t) {
							return y.memoization.memoize(function(n, r) {
								var i = n.nextSibling;
								i && i.nodeName.toLowerCase() === t && y.applyBindingAccessorsToNode(i, e, r)
							})
						}
					}
				}(), y.exportSymbol("__tr_ambtns", y.templateRewriting.applyMemoizedBindingsToNextSibling),
				function() {
					function e(e) {
						return y.utils.domData.get(e, u) || {}
					}

					function n(e, t) {
						y.utils.domData.set(e, u, t)
					}
					y.templateSources = {};
					var r = 1,
						i = 2,
						o = 3,
						s = 4;
					y.templateSources.domElement = function(e) {
						if (this.domElement = e, e) {
							var t = y.utils.tagNameLower(e);
							this.templateType = "script" === t ? r : "textarea" === t ? i : "template" == t && e.content && 11 === e.content
								.nodeType ? o : s
						}
					}, y.templateSources.domElement.prototype.text = function() {
						var e = this.templateType === r ? "text" : this.templateType === i ? "value" : "innerHTML";
						if (0 == arguments.length) return this.domElement[e];
						var t = arguments[0];
						"innerHTML" === e ? y.utils.setHtml(this.domElement, t) : this.domElement[e] = t
					};
					var a = y.utils.domData.nextKey() + "_";
					y.templateSources.domElement.prototype.data = function(e) {
						return 1 === arguments.length ? y.utils.domData.get(this.domElement, a + e) : void y.utils.domData.set(this.domElement,
							a + e, arguments[1])
					};
					var u = y.utils.domData.nextKey();
					y.templateSources.domElement.prototype.nodes = function() {
							var r = this.domElement;
							if (0 == arguments.length) {
								var i = e(r),
									a = i.containerData;
								return a || (this.templateType === o ? r.content : this.templateType === s ? r : t)
							}
							var u = arguments[0];
							n(r, {
								containerData: u
							})
						}, y.templateSources.anonymousTemplate = function(e) {
							this.domElement = e
						}, y.templateSources.anonymousTemplate.prototype = new y.templateSources.domElement, y.templateSources.anonymousTemplate
						.prototype.constructor = y.templateSources.anonymousTemplate, y.templateSources.anonymousTemplate.prototype.text =
						function() {
							if (0 == arguments.length) {
								var r = e(this.domElement);
								return r.textData === t && r.containerData && (r.textData = r.containerData.innerHTML), r.textData
							}
							var i = arguments[0];
							n(this.domElement, {
								textData: i
							})
						}, y.exportSymbol("templateSources", y.templateSources), y.exportSymbol("templateSources.domElement", y.templateSources
							.domElement), y.exportSymbol("templateSources.anonymousTemplate", y.templateSources.anonymousTemplate)
				}(),
				function() {
					function e(e, t, n) {
						for (var r, i = e, o = y.virtualElements.nextSibling(t); i && (r = i) !== o;) i = y.virtualElements.nextSibling(
							r), n(r, i)
					}

					function n(t, n) {
						if (t.length) {
							var r = t[0],
								i = t[t.length - 1],
								o = r.parentNode,
								s = y.bindingProvider.instance,
								a = s.preprocessNode;
							if (a) {
								if (e(r, i, function(e, t) {
										var n = e.previousSibling,
											o = a.call(s, e);
										o && (e === r && (r = o[0] || t), e === i && (i = o[o.length - 1] || n))
									}), t.length = 0, !r) return;
								r === i ? t.push(r) : (t.push(r, i), y.utils.fixUpContinuousNodeArray(t, o))
							}
							e(r, i, function(e) {
								1 !== e.nodeType && 8 !== e.nodeType || y.applyBindings(n, e)
							}), e(r, i, function(e) {
								1 !== e.nodeType && 8 !== e.nodeType || y.memoization.unmemoizeDomNodeAndDescendants(e, [n])
							}), y.utils.fixUpContinuousNodeArray(t, o)
						}
					}

					function r(e) {
						return e.nodeType ? e : e.length > 0 ? e[0] : null
					}

					function i(e, t, i, o, s) {
						s = s || {};
						var u = e && r(e),
							l = (u || i || {}).ownerDocument,
							c = s.templateEngine || a;
						y.templateRewriting.ensureTemplateIsRewritten(i, c, l);
						var d = c.renderTemplate(i, o, s, l);
						if ("number" != typeof d.length || d.length > 0 && "number" != typeof d[0].nodeType) throw new Error(
							"Template engine must return an array of DOM nodes");
						var f = !1;
						switch (t) {
							case "replaceChildren":
								y.virtualElements.setDomNodeChildren(e, d), f = !0;
								break;
							case "replaceNode":
								y.utils.replaceDomNodes(e, d), f = !0;
								break;
							case "ignoreTargetNode":
								break;
							default:
								throw new Error("Unknown renderMode: " + t)
						}
						return f && (n(d, o), s.afterRender && y.dependencyDetection.ignore(s.afterRender, null, [d, o.$data])), d
					}

					function o(e, t, n) {
						return y.isObservable(e) ? e() : "function" == typeof e ? e(t, n) : e
					}

					function s(e, n) {
						var r = y.utils.domData.get(e, u);
						r && "function" == typeof r.dispose && r.dispose(), y.utils.domData.set(e, u, n && n.isActive() ? n : t)
					}
					var a;
					y.setTemplateEngine = function(e) {
						if (e != t && !(e instanceof y.templateEngine)) throw new Error(
							"templateEngine must inherit from ko.templateEngine");
						a = e
					}, y.renderTemplate = function(e, n, s, u, l) {
						if (s = s || {}, (s.templateEngine || a) == t) throw new Error(
							"Set a template engine before calling renderTemplate");
						if (l = l || "replaceChildren", u) {
							var c = r(u),
								d = function() {
									return !c || !y.utils.domNodeIsAttachedToDocument(c)
								},
								f = c && "replaceNode" == l ? c.parentNode : c;
							return y.dependentObservable(function() {
								var t = n && n instanceof y.bindingContext ? n : new y.bindingContext(y.utils.unwrapObservable(n)),
									a = o(e, t.$data, t),
									d = i(u, l, a, t, s);
								"replaceNode" == l && (u = d, c = r(u))
							}, null, {
								disposeWhen: d,
								disposeWhenNodeIsRemoved: f
							})
						}
						return y.memoization.memoize(function(t) {
							y.renderTemplate(e, n, s, t, "replaceNode")
						})
					}, y.renderTemplateForEach = function(e, r, s, a, u) {
						var l, c = function(t, n) {
								l = u.createChildContext(t, s.as, function(e) {
									e.$index = n
								});
								var r = o(e, t, l);
								return i(null, "ignoreTargetNode", r, l, s)
							},
							d = function(e, t, r) {
								n(t, l), s.afterRender && s.afterRender(t, e), l = null
							};
						return y.dependentObservable(function() {
							var e = y.utils.unwrapObservable(r) || [];
							"undefined" == typeof e.length && (e = [e]);
							var n = y.utils.arrayFilter(e, function(e) {
								return s.includeDestroyed || e === t || null === e || !y.utils.unwrapObservable(e._destroy)
							});
							y.dependencyDetection.ignore(y.utils.setDomNodeChildrenFromArrayMapping, null, [a, n, c, s, d])
						}, null, {
							disposeWhenNodeIsRemoved: a
						})
					};
					var u = y.utils.domData.nextKey();
					y.bindingHandlers.template = {
						init: function(e, t) {
							var n = y.utils.unwrapObservable(t());
							if ("string" == typeof n || n.name) y.virtualElements.emptyNode(e);
							else if ("nodes" in n) {
								var r = n.nodes || [];
								if (y.isObservable(r)) throw new Error('The "nodes" option must be a plain, non-observable array.');
								var i = y.utils.moveCleanedNodesToContainerElement(r);
								new y.templateSources.anonymousTemplate(e).nodes(i)
							} else {
								var o = y.virtualElements.childNodes(e),
									i = y.utils.moveCleanedNodesToContainerElement(o);
								new y.templateSources.anonymousTemplate(e).nodes(i)
							}
							return {
								controlsDescendantBindings: !0
							}
						},
						update: function(e, t, n, r, i) {
							var o, a, u = t(),
								l = y.utils.unwrapObservable(u),
								c = !0,
								d = null;
							if ("string" == typeof l ? (a = u, l = {}) : (a = l.name, "if" in l && (c = y.utils.unwrapObservable(l["if"])),
									c && "ifnot" in l && (c = !y.utils.unwrapObservable(l.ifnot)), o = y.utils.unwrapObservable(l.data)),
								"foreach" in l) {
								var f = c && l.foreach || [];
								d = y.renderTemplateForEach(a || e, f, l, e, i)
							} else if (c) {
								var p = "data" in l ? i.createChildContext(o, l.as) : i;
								d = y.renderTemplate(a || e, p, l, e)
							} else y.virtualElements.emptyNode(e);
							s(e, d)
						}
					}, y.expressionRewriting.bindingRewriteValidators.template = function(e) {
						var t = y.expressionRewriting.parseObjectLiteral(e);
						return 1 == t.length && t[0].unknown ? null : y.expressionRewriting.keyValueArrayContainsKey(t, "name") ? null :
							"This template engine does not support anonymous templates nested within its templates"
					}, y.virtualElements.allowedBindings.template = !0
				}(), y.exportSymbol("setTemplateEngine", y.setTemplateEngine), y.exportSymbol("renderTemplate", y.renderTemplate),
				y.utils.findMovesInArrayComparison = function(e, t, n) {
					if (e.length && t.length) {
						var r, i, o, s, a;
						for (r = i = 0;
							(!n || r < n) && (s = e[i]); ++i) {
							for (o = 0; a = t[o]; ++o)
								if (s.value === a.value) {
									s.moved = a.index, a.moved = s.index, t.splice(o, 1), r = o = 0;
									break
								}
							r += o
						}
					}
				}, y.utils.compareArrays = function() {
					function e(e, i, o) {
						return o = "boolean" == typeof o ? {
							dontLimitMoves: o
						} : o || {}, e = e || [], i = i || [], e.length < i.length ? t(e, i, n, r, o) : t(i, e, r, n, o)
					}

					function t(e, t, n, r, i) {
						var o, s, a, u, l, c, d = Math.min,
							f = Math.max,
							p = [],
							h = e.length,
							m = t.length,
							g = m - h || 1,
							v = h + m + 1;
						for (o = 0; o <= h; o++)
							for (u = a, p.push(a = []), l = d(m, o + g), c = f(0, o - 1), s = c; s <= l; s++)
								if (s)
									if (o)
										if (e[o - 1] === t[s - 1]) a[s] = u[s - 1];
										else {
											var b = u[s] || v,
												x = a[s - 1] || v;
											a[s] = d(b, x) + 1
										}
						else a[s] = s + 1;
						else a[s] = o + 1;
						var w, D = [],
							S = [],
							T = [];
						for (o = h, s = m; o || s;) w = p[o][s] - 1, s && w === p[o][s - 1] ? S.push(D[D.length] = {
							status: n,
							value: t[--s],
							index: s
						}) : o && w === p[o - 1][s] ? T.push(D[D.length] = {
							status: r,
							value: e[--o],
							index: o
						}) : (--s, --o, i.sparse || D.push({
							status: "retained",
							value: t[s]
						}));
						return y.utils.findMovesInArrayComparison(T, S, !i.dontLimitMoves && 10 * h), D.reverse()
					}
					var n = "added",
						r = "deleted";
					return e
				}(), y.exportSymbol("utils.compareArrays", y.utils.compareArrays),
				function() {
					function e(e, n, r, i, o) {
						var s = [],
							a = y.dependentObservable(function() {
								var t = n(r, o, y.utils.fixUpContinuousNodeArray(s, e)) || [];
								s.length > 0 && (y.utils.replaceDomNodes(s, t), i && y.dependencyDetection.ignore(i, null, [r, t, o])), s.length =
									0, y.utils.arrayPushAll(s, t)
							}, null, {
								disposeWhenNodeIsRemoved: e,
								disposeWhen: function() {
									return !y.utils.anyDomNodeIsAttachedToDocument(s)
								}
							});
						return {
							mappedNodes: s,
							dependentObservable: a.isActive() ? a : t
						}
					}
					var n = y.utils.domData.nextKey(),
						r = y.utils.domData.nextKey();
					y.utils.setDomNodeChildrenFromArrayMapping = function(i, o, s, a, u) {
						function l(e, t) {
							d = m[t], w !== t && (_[e] = d), d.indexObservable(w++), y.utils.fixUpContinuousNodeArray(d.mappedNodes, i), b
								.push(d), S.push(d)
						}

						function c(e, t) {
							if (e)
								for (var n = 0, r = t.length; n < r; n++) t[n] && y.utils.arrayForEach(t[n].mappedNodes, function(r) {
									e(r, n, t[n].arrayEntry)
								})
						}
						o = o || [], a = a || {};
						for (var d, f, p, h = y.utils.domData.get(i, n) === t, m = y.utils.domData.get(i, n) || [], g = y.utils.arrayMap(
									m,
									function(e) {
										return e.arrayEntry
									}), v = y.utils.compareArrays(g, o, a.dontLimitMoves), b = [], x = 0, w = 0, D = [], S = [], T = [], _ = [],
								E = [], C = 0; f = v[C]; C++) switch (p = f.moved, f.status) {
							case "deleted":
								p === t && (d = m[x], d.dependentObservable && (d.dependentObservable.dispose(), d.dependentObservable = t),
									y.utils.fixUpContinuousNodeArray(d.mappedNodes, i).length && (a.beforeRemove && (b.push(d), S.push(d), d.arrayEntry ===
										r ? d = null : T[C] = d), d && D.push.apply(D, d.mappedNodes))), x++;
								break;
							case "retained":
								l(C, x++);
								break;
							case "added":
								p !== t ? l(C, p) : (d = {
									arrayEntry: f.value,
									indexObservable: y.observable(w++)
								}, b.push(d), S.push(d), h || (E[C] = d))
						}
						y.utils.domData.set(i, n, b), c(a.beforeMove, _), y.utils.arrayForEach(D, a.beforeRemove ? y.cleanNode : y.removeNode);
						for (var k, N, C = 0, O = y.virtualElements.firstChild(i); d = S[C]; C++) {
							d.mappedNodes || y.utils.extend(d, e(i, s, d.arrayEntry, u, d.indexObservable));
							for (var M = 0; N = d.mappedNodes[M]; O = N.nextSibling, k = N, M++) N !== O && y.virtualElements.insertAfter(
								i, N, k);
							!d.initialized && u && (u(d.arrayEntry, d.mappedNodes, d.indexObservable), d.initialized = !0)
						}
						for (c(a.beforeRemove, T), C = 0; C < T.length; ++C) T[C] && (T[C].arrayEntry = r);
						c(a.afterMove, _), c(a.afterAdd, E)
					}
				}(), y.exportSymbol("utils.setDomNodeChildrenFromArrayMapping", y.utils.setDomNodeChildrenFromArrayMapping), y.nativeTemplateEngine =
				function() {
					this.allowTemplateRewriting = !1
				}, y.nativeTemplateEngine.prototype = new y.templateEngine, y.nativeTemplateEngine.prototype.constructor = y.nativeTemplateEngine,
				y.nativeTemplateEngine.prototype.renderTemplateSource = function(e, t, n, r) {
					var i = !(y.utils.ieVersion < 9),
						o = i ? e.nodes : null,
						s = o ? e.nodes() : null;
					if (s) return y.utils.makeArray(s.cloneNode(!0).childNodes);
					var a = e.text();
					return y.utils.parseHtmlFragment(a, r)
				}, y.nativeTemplateEngine.instance = new y.nativeTemplateEngine, y.setTemplateEngine(y.nativeTemplateEngine.instance),
				y.exportSymbol("nativeTemplateEngine", y.nativeTemplateEngine),
				function() {
					y.jqueryTmplTemplateEngine = function() {
							function e() {
								if (n < 2) throw new Error(
									"Your version of jQuery.tmpl is too old. Please upgrade to jQuery.tmpl 1.0.0pre or later.")
							}

							function t(e, t, n) {
								return o.tmpl(e, t, n)
							}
							var n = this.jQueryTmplVersion = function() {
								if (!o || !o.tmpl) return 0;
								try {
									if (o.tmpl.tag.tmpl.open.toString().indexOf("__") >= 0) return 2
								} catch (e) {}
								return 1
							}();
							this.renderTemplateSource = function(n, i, s, a) {
								a = a || r, s = s || {}, e();
								var u = n.data("precompiled");
								if (!u) {
									var l = n.text() || "";
									l = "{{ko_with $item.koBindingContext}}" + l + "{{/ko_with}}", u = o.template(null, l), n.data("precompiled",
										u);
								}
								var c = [i.$data],
									d = o.extend({
										koBindingContext: i
									}, s.templateOptions),
									f = t(u, c, d);
								return f.appendTo(a.createElement("div")), o.fragments = {}, f
							}, this.createJavaScriptEvaluatorBlock = function(e) {
								return "{{ko_code ((function() { return " + e + " })()) }}"
							}, this.addTemplate = function(e, t) {
								r.write("<script type='text/html' id='" + e + "'>" + t + "</script>")
							}, n > 0 && (o.tmpl.tag.ko_code = {
								open: "__.push($1 || '');"
							}, o.tmpl.tag.ko_with = {
								open: "with($1) {",
								close: "} "
							})
						}, y.jqueryTmplTemplateEngine.prototype = new y.templateEngine, y.jqueryTmplTemplateEngine.prototype.constructor =
						y.jqueryTmplTemplateEngine;
					var e = new y.jqueryTmplTemplateEngine;
					e.jQueryTmplVersion > 0 && y.setTemplateEngine(e), y.exportSymbol("jqueryTmplTemplateEngine", y.jqueryTmplTemplateEngine)
				}()
		})
	}()
}();
