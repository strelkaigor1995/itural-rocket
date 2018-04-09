(function (window,document){
	var $j = jq = (function (a, b) {
		var c = [], d = c.slice, e = c.concat, f = c.push, g = c.indexOf, h = {}, i = h.toString, j = h.hasOwnProperty, k = {}, l = "1.11.3", m = function (a, b) {
			return new m.fn.init(a, b)
		}, n = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, o = /^-ms-/, p = /-([\da-z])/gi, q = function (a, b) {
			return b.toUpperCase()
		};
		m.fn = m.prototype = {
			jq: l, constructor: m, selector: "", length: 0, toArray: function () {
				return d.call(this)
			}, get: function (a) {
				return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this)
			}, pushStack: function (a) {
				var b = m.merge(this.constructor(), a);
				return b.prevObject = this, b.context = this.context, b
			}, each: function (a, b) {
				return m.each(this, a, b)
			}, map: function (a) {
				return this.pushStack(m.map(this, function (b, c) {
					return a.call(b, c, b)
				}))
			}, slice: function () {
				return this.pushStack(d.apply(this, arguments))
			}, first: function () {
				return this.eq(0)
			}, last: function () {
				return this.eq(-1)
			}, eq: function (a) {
				var b = this.length, c = +a + (0 > a ? b : 0);
				return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
			}, end: function () {
				return this.prevObject || this.constructor(null)
			}, push: f, sort: c.sort, splice: c.splice
		}, m.extend = m.fn.extend = function () {
			var a, b, c, d, e, f, g = arguments[0] || {}, h = 1, i = arguments.length, j = !1;
			for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || m.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)if (null != (e = arguments[h]))for (d in e)a = g[d], c = e[d], g !== c && (j && c && (m.isPlainObject(c) || (b = m.isArray(c))) ? (b ? (b = !1, f = a && m.isArray(a) ? a : []) : f = a && m.isPlainObject(a) ? a : {}, g[d] = m.extend(j, f, c)) : void 0 !== c && (g[d] = c));
			return g
		}, m.extend({
			expando: "jq" + (l + Math.random()).replace(/\D/g, ""), isReady: !0, error: function (a) {
				throw new Error(a)
			}, noop: function () {
			}, isFunction: function (a) {
				return "function" === m.type(a)
			}, isArray: Array.isArray || function (a) {
				return "array" === m.type(a)
			}, isWindow: function (a) {
				return null != a && a == a.window
			}, isNumeric: function (a) {
				return !m.isArray(a) && a - parseFloat(a) + 1 >= 0
			}, isEmptyObject: function (a) {
				var b;
				for (b in a)return !1;
				return !0
			}, isPlainObject: function (a) {
				var b;
				if (!a || "object" !== m.type(a) || a.nodeType || m.isWindow(a))return !1;
				try {
					if (a.constructor && !j.call(a, "constructor") && !j.call(a.constructor.prototype, "isPrototypeOf"))return !1
				} catch (c) {
					return !1
				}
				if (k.ownLast)for (b in a)return j.call(a, b);
				for (b in a);
				return void 0 === b || j.call(a, b)
			}, type: function (a) {
				return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a
			}, globalEval: function (b) {
				b && m.trim(b) && (a.execScript || function (b) {
					a.eval.call(a, b)
				})(b)
			}, camelCase: function (a) {
				return a.replace(o, "ms-").replace(p, q)
			}, nodeName: function (a, b) {
				return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
			}, each: function (a, b, c) {
				var d, e = 0, f = a.length, g = r(a);
				if (c) {
					if (g) {
						for (; f > e; e++)if (d = b.apply(a[e], c), d === !1)break
					} else for (e in a)if (d = b.apply(a[e], c), d === !1)break
				} else if (g) {
					for (; f > e; e++)if (d = b.call(a[e], e, a[e]), d === !1)break
				} else for (e in a)if (d = b.call(a[e], e, a[e]), d === !1)break;
				return a
			}, trim: function (a) {
				return null == a ? "" : (a + "").replace(n, "")
			}, makeArray: function (a, b) {
				var c = b || [];
				return null != a && (r(Object(a)) ? m.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)), c
			}, inArray: function (a, b, c) {
				var d;
				if (b) {
					if (g)return g.call(b, a, c);
					for (d = b.length, c = c ? 0 > c ? Math.max(0, d + c) : c : 0; d > c; c++)if (c in b && b[c] === a)return c
				}
				return -1
			}, merge: function (a, b) {
				var c = +b.length, d = 0, e = a.length;
				while (c > d)a[e++] = b[d++];
				if (c !== c)while (void 0 !== b[d])a[e++] = b[d++];
				return a.length = e, a
			}, grep: function (a, b, c) {
				for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++)d = !b(a[f], f), d !== h && e.push(a[f]);
				return e
			}, map: function (a, b, c) {
				var d, f = 0, g = a.length, h = r(a), i = [];
				if (h)for (; g > f; f++)d = b(a[f], f, c), null != d && i.push(d); else for (f in a)d = b(a[f], f, c), null != d && i.push(d);
				return e.apply([], i)
			}, guid: 1, proxy: function (a, b) {
				var c, e, f;
				return "string" == typeof b && (f = a[b], b = a, a = f), m.isFunction(a) ? (c = d.call(arguments, 2), e = function () {
					return a.apply(b || this, c.concat(d.call(arguments)))
				}, e.guid = a.guid = a.guid || m.guid++, e) : void 0
			}, now: function () {
				return +new Date
			}, support: k
		}), m.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
			h["[object " + b + "]"] = b.toLowerCase()
		});
		function r(a) {
			var b = "length" in a && a.length, c = m.type(a);
			return "function" === c || m.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
		}

		var s = function (a) {
			var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + 1 * new Date, v = a.document, w = 0, x = 0, y = ha(), z = ha(), A = ha(), B = function (a, b) {
				return a === b && (l = !0), 0
			}, C = 1 << 31, D = {}.hasOwnProperty, E = [], F = E.pop, G = E.push, H = E.push, I = E.slice, J = function (a, b) {
				for (var c = 0, d = a.length; d > c; c++)if (a[c] === b)return c;
				return -1
			}, K = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", L = "[\\x20\\t\\r\\n\\f]", M = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", N = M.replace("w", "w#"), O = "\\[" + L + "*(" + M + ")(?:" + L + "*([*^$|!~]?=)" + L + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + N + "))|)" + L + "*\\]", P = ":(" + M + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + O + ")*)|.*)\\)|)", Q = new RegExp(L + "+", "g"), R = new RegExp("^" + L + "+|((?:^|[^\\\\])(?:\\\\.)*)" + L + "+$", "g"), S = new RegExp("^" + L + "*," + L + "*"), T = new RegExp("^" + L + "*([>+~]|" + L + ")" + L + "*"), U = new RegExp("=" + L + "*([^\\]'\"]*?)" + L + "*\\]", "g"), V = new RegExp(P), W = new RegExp("^" + N + "$"), X = {
				ID: new RegExp("^#(" + M + ")"),
				CLASS: new RegExp("^\\.(" + M + ")"),
				TAG: new RegExp("^(" + M.replace("w", "w*") + ")"),
				ATTR: new RegExp("^" + O),
				PSEUDO: new RegExp("^" + P),
				CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + L + "*(even|odd|(([+-]|)(\\d*)n|)" + L + "*(?:([+-]|)" + L + "*(\\d+)|))" + L + "*\\)|)", "i"),
				bool: new RegExp("^(?:" + K + ")$", "i"),
				needsContext: new RegExp("^" + L + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + L + "*((?:-\\d)?\\d*)" + L + "*\\)|)(?=[^-]|$)", "i")
			}, Y = /^(?:input|select|textarea|button)$/i, Z = /^h\d$/i, $ = /^[^{]+\{\s*\[native \w/, _ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, aa = /[+~]/, ba = /'|\\/g, ca = new RegExp("\\\\([\\da-f]{1,6}" + L + "?|(" + L + ")|.)", "ig"), da = function (a, b, c) {
				var d = "0x" + b - 65536;
				return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
			}, ea = function () {
				m()
			};
			try {
				H.apply(E = I.call(v.childNodes), v.childNodes), E[v.childNodes.length].nodeType
			} catch (fa) {
				H = {
					apply: E.length ? function (a, b) {
						G.apply(a, I.call(b))
					} : function (a, b) {
						var c = a.length, d = 0;
						while (a[c++] = b[d++]);
						a.length = c - 1
					}
				}
			}
			function ga(a, b, d, e) {
				var f, h, j, k, l, o, r, s, w, x;
				if ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, d = d || [], k = b.nodeType, "string" != typeof a || !a || 1 !== k && 9 !== k && 11 !== k)return d;
				if (!e && p) {
					if (11 !== k && (f = _.exec(a)))if (j = f[1]) {
						if (9 === k) {
							if (h = b.getElementById(j), !h || !h.parentNode)return d;
							if (h.id === j)return d.push(h), d
						} else if (b.ownerDocument && (h = b.ownerDocument.getElementById(j)) && t(b, h) && h.id === j)return d.push(h), d
					} else {
						if (f[2])return H.apply(d, b.getElementsByTagName(a)), d;
						if ((j = f[3]) && c.getElementsByClassName)return H.apply(d, b.getElementsByClassName(j)), d
					}
					if (c.qsa && (!q || !q.test(a))) {
						if (s = r = u, w = b, x = 1 !== k && a, 1 === k && "object" !== b.nodeName.toLowerCase()) {
							o = g(a), (r = b.getAttribute("id")) ? s = r.replace(ba, "\\$&") : b.setAttribute("id", s), s = "[id='" + s + "'] ", l = o.length;
							while (l--)o[l] = s + ra(o[l]);
							w = aa.test(a) && pa(b.parentNode) || b, x = o.join(",")
						}
						if (x)try {
							return H.apply(d, w.querySelectorAll(x)), d
						} catch (y) {
						} finally {
							r || b.removeAttribute("id")
						}
					}
				}
				return i(a.replace(R, "$1"), b, d, e)
			}

			function ha() {
				var a = [];

				function b(c, e) {
					return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e
				}

				return b
			}

			function ia(a) {
				return a[u] = !0, a
			}

			function ja(a) {
				var b = n.createElement("div");
				try {
					return !!a(b)
				} catch (c) {
					return !1
				} finally {
					b.parentNode && b.parentNode.removeChild(b), b = null
				}
			}

			function ka(a, b) {
				var c = a.split("|"), e = a.length;
				while (e--)d.attrHandle[c[e]] = b
			}

			function la(a, b) {
				var c = b && a, d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || C) - (~a.sourceIndex || C);
				if (d)return d;
				if (c)while (c = c.nextSibling)if (c === b)return -1;
				return a ? 1 : -1
			}

			function ma(a) {
				return function (b) {
					var c = b.nodeName.toLowerCase();
					return "input" === c && b.type === a
				}
			}

			function na(a) {
				return function (b) {
					var c = b.nodeName.toLowerCase();
					return ("input" === c || "button" === c) && b.type === a
				}
			}

			function oa(a) {
				return ia(function (b) {
					return b = +b, ia(function (c, d) {
						var e, f = a([], c.length, b), g = f.length;
						while (g--)c[e = f[g]] && (c[e] = !(d[e] = c[e]))
					})
				})
			}

			function pa(a) {
				return a && "undefined" != typeof a.getElementsByTagName && a
			}

			c = ga.support = {}, f = ga.isXML = function (a) {
				var b = a && (a.ownerDocument || a).documentElement;
				return b ? "HTML" !== b.nodeName : !1
			}, m = ga.setDocument = function (a) {
				var b, e, g = a ? a.ownerDocument || a : v;
				return g !== n && 9 === g.nodeType && g.documentElement ? (n = g, o = g.documentElement, e = g.defaultView, e && e !== e.top && (e.addEventListener ? e.addEventListener("unload", ea, !1) : e.attachEvent && e.attachEvent("onunload", ea)), p = !f(g), c.attributes = ja(function (a) {
					return a.className = "i", !a.getAttribute("className")
				}), c.getElementsByTagName = ja(function (a) {
					return a.appendChild(g.createComment("")), !a.getElementsByTagName("*").length
				}), c.getElementsByClassName = $.test(g.getElementsByClassName), c.getById = ja(function (a) {
					return o.appendChild(a).id = u, !g.getElementsByName || !g.getElementsByName(u).length
				}), c.getById ? (d.find.ID = function (a, b) {
					if ("undefined" != typeof b.getElementById && p) {
						var c = b.getElementById(a);
						return c && c.parentNode ? [c] : []
					}
				}, d.filter.ID = function (a) {
					var b = a.replace(ca, da);
					return function (a) {
						return a.getAttribute("id") === b
					}
				}) : (delete d.find.ID, d.filter.ID = function (a) {
					var b = a.replace(ca, da);
					return function (a) {
						var c = "undefined" != typeof a.getAttributeNode && a.getAttributeNode("id");
						return c && c.value === b
					}
				}), d.find.TAG = c.getElementsByTagName ? function (a, b) {
					return "undefined" != typeof b.getElementsByTagName ? b.getElementsByTagName(a) : c.qsa ? b.querySelectorAll(a) : void 0
				} : function (a, b) {
					var c, d = [], e = 0, f = b.getElementsByTagName(a);
					if ("*" === a) {
						while (c = f[e++])1 === c.nodeType && d.push(c);
						return d
					}
					return f
				}, d.find.CLASS = c.getElementsByClassName && function (a, b) {
						return p ? b.getElementsByClassName(a) : void 0
					}, r = [], q = [], (c.qsa = $.test(g.querySelectorAll)) && (ja(function (a) {
					o.appendChild(a).innerHTML = "<a id='" + u + "'></a><select id='" + u + "-\f]' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + L + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || q.push("\\[" + L + "*(?:value|" + K + ")"), a.querySelectorAll("[id~=" + u + "-]").length || q.push("~="), a.querySelectorAll(":checked").length || q.push(":checked"), a.querySelectorAll("a#" + u + "+*").length || q.push(".#.+[+~]")
				}), ja(function (a) {
					var b = g.createElement("input");
					b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + L + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), q.push(",.*:")
				})), (c.matchesSelector = $.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ja(function (a) {
					c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", P)
				}), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), b = $.test(o.compareDocumentPosition), t = b || $.test(o.contains) ? function (a, b) {
					var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
					return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
				} : function (a, b) {
					if (b)while (b = b.parentNode)if (b === a)return !0;
					return !1
				}, B = b ? function (a, b) {
					if (a === b)return l = !0, 0;
					var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
					return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === g || a.ownerDocument === v && t(v, a) ? -1 : b === g || b.ownerDocument === v && t(v, b) ? 1 : k ? J(k, a) - J(k, b) : 0 : 4 & d ? -1 : 1)
				} : function (a, b) {
					if (a === b)return l = !0, 0;
					var c, d = 0, e = a.parentNode, f = b.parentNode, h = [a], i = [b];
					if (!e || !f)return a === g ? -1 : b === g ? 1 : e ? -1 : f ? 1 : k ? J(k, a) - J(k, b) : 0;
					if (e === f)return la(a, b);
					c = a;
					while (c = c.parentNode)h.unshift(c);
					c = b;
					while (c = c.parentNode)i.unshift(c);
					while (h[d] === i[d])d++;
					return d ? la(h[d], i[d]) : h[d] === v ? -1 : i[d] === v ? 1 : 0
				}, g) : n
			}, ga.matches = function (a, b) {
				return ga(a, null, null, b)
			}, ga.matchesSelector = function (a, b) {
				if ((a.ownerDocument || a) !== n && m(a), b = b.replace(U, "='$1']"), !(!c.matchesSelector || !p || r && r.test(b) || q && q.test(b)))try {
					var d = s.call(a, b);
					if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType)return d
				} catch (e) {
				}
				return ga(b, n, null, [a]).length > 0
			}, ga.contains = function (a, b) {
				return (a.ownerDocument || a) !== n && m(a), t(a, b)
			}, ga.attr = function (a, b) {
				(a.ownerDocument || a) !== n && m(a);
				var e = d.attrHandle[b.toLowerCase()], f = e && D.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0;
				return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null
			}, ga.error = function (a) {
				throw new Error("Syntax error, unrecognized expression: " + a)
			}, ga.uniqueSort = function (a) {
				var b, d = [], e = 0, f = 0;
				if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) {
					while (b = a[f++])b === a[f] && (e = d.push(f));
					while (e--)a.splice(d[e], 1)
				}
				return k = null, a
			}, e = ga.getText = function (a) {
				var b, c = "", d = 0, f = a.nodeType;
				if (f) {
					if (1 === f || 9 === f || 11 === f) {
						if ("string" == typeof a.textContent)return a.textContent;
						for (a = a.firstChild; a; a = a.nextSibling)c += e(a)
					} else if (3 === f || 4 === f)return a.nodeValue
				} else while (b = a[d++])c += e(b);
				return c
			}, d = ga.selectors = {
				cacheLength: 50,
				createPseudo: ia,
				match: X,
				attrHandle: {},
				find: {},
				relative: {
					">": {dir: "parentNode", first: !0},
					" ": {dir: "parentNode"},
					"+": {dir: "previousSibling", first: !0},
					"~": {dir: "previousSibling"}
				},
				preFilter: {
					ATTR: function (a) {
						return a[1] = a[1].replace(ca, da), a[3] = (a[3] || a[4] || a[5] || "").replace(ca, da), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
					}, CHILD: function (a) {
						return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || ga.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && ga.error(a[0]), a
					}, PSEUDO: function (a) {
						var b, c = !a[6] && a[2];
						return X.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && V.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
					}
				},
				filter: {
					TAG: function (a) {
						var b = a.replace(ca, da).toLowerCase();
						return "*" === a ? function () {
							return !0
						} : function (a) {
							return a.nodeName && a.nodeName.toLowerCase() === b
						}
					}, CLASS: function (a) {
						var b = y[a + " "];
						return b || (b = new RegExp("(^|" + L + ")" + a + "(" + L + "|$)")) && y(a, function (a) {
								return b.test("string" == typeof a.className && a.className || "undefined" != typeof a.getAttribute && a.getAttribute("class") || "")
							})
					}, ATTR: function (a, b, c) {
						return function (d) {
							var e = ga.attr(d, a);
							return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e.replace(Q, " ") + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0
						}
					}, CHILD: function (a, b, c, d, e) {
						var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
						return 1 === d && 0 === e ? function (a) {
							return !!a.parentNode
						} : function (b, c, i) {
							var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode, r = h && b.nodeName.toLowerCase(), s = !i && !h;
							if (q) {
								if (f) {
									while (p) {
										l = b;
										while (l = l[p])if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType)return !1;
										o = p = "only" === a && !o && "nextSibling"
									}
									return !0
								}
								if (o = [g ? q.firstChild : q.lastChild], g && s) {
									k = q[u] || (q[u] = {}), j = k[a] || [], n = j[0] === w && j[1], m = j[0] === w && j[2], l = n && q.childNodes[n];
									while (l = ++n && l && l[p] || (m = n = 0) || o.pop())if (1 === l.nodeType && ++m && l === b) {
										k[a] = [w, n, m];
										break
									}
								} else if (s && (j = (b[u] || (b[u] = {}))[a]) && j[0] === w)m = j[1]; else while (l = ++n && l && l[p] || (m = n = 0) || o.pop())if ((h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) && ++m && (s && ((l[u] || (l[u] = {}))[a] = [w, m]), l === b))break;
								return m -= e, m === d || m % d === 0 && m / d >= 0
							}
						}
					}, PSEUDO: function (a, b) {
						var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || ga.error("unsupported pseudo: " + a);
						return e[u] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? ia(function (a, c) {
							var d, f = e(a, b), g = f.length;
							while (g--)d = J(a, f[g]), a[d] = !(c[d] = f[g])
						}) : function (a) {
							return e(a, 0, c)
						}) : e
					}
				},
				pseudos: {
					not: ia(function (a) {
						var b = [], c = [], d = h(a.replace(R, "$1"));
						return d[u] ? ia(function (a, b, c, e) {
							var f, g = d(a, null, e, []), h = a.length;
							while (h--)(f = g[h]) && (a[h] = !(b[h] = f))
						}) : function (a, e, f) {
							return b[0] = a, d(b, null, f, c), b[0] = null, !c.pop()
						}
					}), has: ia(function (a) {
						return function (b) {
							return ga(a, b).length > 0
						}
					}), contains: ia(function (a) {
						return a = a.replace(ca, da), function (b) {
							return (b.textContent || b.innerText || e(b)).indexOf(a) > -1
						}
					}), lang: ia(function (a) {
						return W.test(a || "") || ga.error("unsupported lang: " + a), a = a.replace(ca, da).toLowerCase(), function (b) {
							var c;
							do if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang"))return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
							return !1
						}
					}), target: function (b) {
						var c = a.location && a.location.hash;
						return c && c.slice(1) === b.id
					}, root: function (a) {
						return a === o
					}, focus: function (a) {
						return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
					}, enabled: function (a) {
						return a.disabled === !1
					}, disabled: function (a) {
						return a.disabled === !0
					}, checked: function (a) {
						var b = a.nodeName.toLowerCase();
						return "input" === b && !!a.checked || "option" === b && !!a.selected
					}, selected: function (a) {
						return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
					}, empty: function (a) {
						for (a = a.firstChild; a; a = a.nextSibling)if (a.nodeType < 6)return !1;
						return !0
					}, parent: function (a) {
						return !d.pseudos.empty(a)
					}, header: function (a) {
						return Z.test(a.nodeName)
					}, input: function (a) {
						return Y.test(a.nodeName)
					}, button: function (a) {
						var b = a.nodeName.toLowerCase();
						return "input" === b && "button" === a.type || "button" === b
					}, text: function (a) {
						var b;
						return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
					}, first: oa(function () {
						return [0]
					}), last: oa(function (a, b) {
						return [b - 1]
					}), eq: oa(function (a, b, c) {
						return [0 > c ? c + b : c]
					}), even: oa(function (a, b) {
						for (var c = 0; b > c; c += 2)a.push(c);
						return a
					}), odd: oa(function (a, b) {
						for (var c = 1; b > c; c += 2)a.push(c);
						return a
					}), lt: oa(function (a, b, c) {
						for (var d = 0 > c ? c + b : c; --d >= 0;)a.push(d);
						return a
					}), gt: oa(function (a, b, c) {
						for (var d = 0 > c ? c + b : c; ++d < b;)a.push(d);
						return a
					})
				}
			}, d.pseudos.nth = d.pseudos.eq;
			for (b in{radio: !0, checkbox: !0, file: !0, password: !0, image: !0})d.pseudos[b] = ma(b);
			for (b in{submit: !0, reset: !0})d.pseudos[b] = na(b);
			function qa() {
			}

			qa.prototype = d.filters = d.pseudos, d.setFilters = new qa, g = ga.tokenize = function (a, b) {
				var c, e, f, g, h, i, j, k = z[a + " "];
				if (k)return b ? 0 : k.slice(0);
				h = a, i = [], j = d.preFilter;
				while (h) {
					(!c || (e = S.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = T.exec(h)) && (c = e.shift(), f.push({
						value: c,
						type: e[0].replace(R, " ")
					}), h = h.slice(c.length));
					for (g in d.filter)!(e = X[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({
						value: c,
						type: g,
						matches: e
					}), h = h.slice(c.length));
					if (!c)break
				}
				return b ? h.length : h ? ga.error(a) : z(a, i).slice(0)
			};
			function ra(a) {
				for (var b = 0, c = a.length, d = ""; c > b; b++)d += a[b].value;
				return d
			}

			function sa(a, b, c) {
				var d = b.dir, e = c && "parentNode" === d, f = x++;
				return b.first ? function (b, c, f) {
					while (b = b[d])if (1 === b.nodeType || e)return a(b, c, f)
				} : function (b, c, g) {
					var h, i, j = [w, f];
					if (g) {
						while (b = b[d])if ((1 === b.nodeType || e) && a(b, c, g))return !0
					} else while (b = b[d])if (1 === b.nodeType || e) {
						if (i = b[u] || (b[u] = {}), (h = i[d]) && h[0] === w && h[1] === f)return j[2] = h[2];
						if (i[d] = j, j[2] = a(b, c, g))return !0
					}
				}
			}

			function ta(a) {
				return a.length > 1 ? function (b, c, d) {
					var e = a.length;
					while (e--)if (!a[e](b, c, d))return !1;
					return !0
				} : a[0]
			}

			function ua(a, b, c) {
				for (var d = 0, e = b.length; e > d; d++)ga(a, b[d], c);
				return c
			}

			function va(a, b, c, d, e) {
				for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
				return g
			}

			function wa(a, b, c, d, e, f) {
				return d && !d[u] && (d = wa(d)), e && !e[u] && (e = wa(e, f)), ia(function (f, g, h, i) {
					var j, k, l, m = [], n = [], o = g.length, p = f || ua(b || "*", h.nodeType ? [h] : h, []), q = !a || !f && b ? p : va(p, m, a, h, i), r = c ? e || (f ? a : o || d) ? [] : g : q;
					if (c && c(q, r, h, i), d) {
						j = va(r, n), d(j, [], h, i), k = j.length;
						while (k--)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l))
					}
					if (f) {
						if (e || a) {
							if (e) {
								j = [], k = r.length;
								while (k--)(l = r[k]) && j.push(q[k] = l);
								e(null, r = [], j, i)
							}
							k = r.length;
							while (k--)(l = r[k]) && (j = e ? J(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
						}
					} else r = va(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : H.apply(g, r)
				})
			}

			function xa(a) {
				for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = sa(function (a) {
					return a === b
				}, h, !0), l = sa(function (a) {
					return J(b, a) > -1
				}, h, !0), m = [function (a, c, d) {
					var e = !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d));
					return b = null, e
				}]; f > i; i++)if (c = d.relative[a[i].type])m = [sa(ta(m), c)]; else {
					if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) {
						for (e = ++i; f > e; e++)if (d.relative[a[e].type])break;
						return wa(i > 1 && ta(m), i > 1 && ra(a.slice(0, i - 1).concat({value: " " === a[i - 2].type ? "*" : ""})).replace(R, "$1"), c, e > i && xa(a.slice(i, e)), f > e && xa(a = a.slice(e)), f > e && ra(a))
					}
					m.push(c)
				}
				return ta(m)
			}

			function ya(a, b) {
				var c = b.length > 0, e = a.length > 0, f = function (f, g, h, i, k) {
					var l, m, o, p = 0, q = "0", r = f && [], s = [], t = j, u = f || e && d.find.TAG("*", k), v = w += null == t ? 1 : Math.random() || .1, x = u.length;
					for (k && (j = g !== n && g); q !== x && null != (l = u[q]); q++) {
						if (e && l) {
							m = 0;
							while (o = a[m++])if (o(l, g, h)) {
								i.push(l);
								break
							}
							k && (w = v)
						}
						c && ((l = !o && l) && p--, f && r.push(l))
					}
					if (p += q, c && q !== p) {
						m = 0;
						while (o = b[m++])o(r, s, g, h);
						if (f) {
							if (p > 0)while (q--)r[q] || s[q] || (s[q] = F.call(i));
							s = va(s)
						}
						H.apply(i, s), k && !f && s.length > 0 && p + b.length > 1 && ga.uniqueSort(i)
					}
					return k && (w = v, j = t), r
				};
				return c ? ia(f) : f
			}

			return h = ga.compile = function (a, b) {
				var c, d = [], e = [], f = A[a + " "];
				if (!f) {
					b || (b = g(a)), c = b.length;
					while (c--)f = xa(b[c]), f[u] ? d.push(f) : e.push(f);
					f = A(a, ya(e, d)), f.selector = a
				}
				return f
			}, i = ga.select = function (a, b, e, f) {
				var i, j, k, l, m, n = "function" == typeof a && a, o = !f && g(a = n.selector || a);
				if (e = e || [], 1 === o.length) {
					if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) {
						if (b = (d.find.ID(k.matches[0].replace(ca, da), b) || [])[0], !b)return e;
						n && (b = b.parentNode), a = a.slice(j.shift().value.length)
					}
					i = X.needsContext.test(a) ? 0 : j.length;
					while (i--) {
						if (k = j[i], d.relative[l = k.type])break;
						if ((m = d.find[l]) && (f = m(k.matches[0].replace(ca, da), aa.test(j[0].type) && pa(b.parentNode) || b))) {
							if (j.splice(i, 1), a = f.length && ra(j), !a)return H.apply(e, f), e;
							break
						}
					}
				}
				return (n || h(a, o))(f, b, !p, e, aa.test(a) && pa(b.parentNode) || b), e
			}, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, m(), c.sortDetached = ja(function (a) {
				return 1 & a.compareDocumentPosition(n.createElement("div"))
			}), ja(function (a) {
				return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
			}) || ka("type|href|height|width", function (a, b, c) {
				return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
			}), c.attributes && ja(function (a) {
				return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
			}) || ka("value", function (a, b, c) {
				return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
			}), ja(function (a) {
				return null == a.getAttribute("disabled")
			}) || ka(K, function (a, b, c) {
				var d;
				return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
			}), ga
		}(a);
		m.find = s, m.expr = s.selectors, m.expr[":"] = m.expr.pseudos, m.unique = s.uniqueSort, m.text = s.getText, m.isXMLDoc = s.isXML, m.contains = s.contains;
		var t = m.expr.match.needsContext, u = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, v = /^.[^:#\[\.,]*$/;

		function w(a, b, c) {
			if (m.isFunction(b))return m.grep(a, function (a, d) {
				return !!b.call(a, d, a) !== c
			});
			if (b.nodeType)return m.grep(a, function (a) {
				return a === b !== c
			});
			if ("string" == typeof b) {
				if (v.test(b))return m.filter(b, a, c);
				b = m.filter(b, a)
			}
			return m.grep(a, function (a) {
				return m.inArray(a, b) >= 0 !== c
			})
		}

		m.filter = function (a, b, c) {
			var d = b[0];
			return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? m.find.matchesSelector(d, a) ? [d] : [] : m.find.matches(a, m.grep(b, function (a) {
				return 1 === a.nodeType
			}))
		}, m.fn.extend({
			find: function (a) {
				var b, c = [], d = this, e = d.length;
				if ("string" != typeof a)return this.pushStack(m(a).filter(function () {
					for (b = 0; e > b; b++)if (m.contains(d[b], this))return !0
				}));
				for (b = 0; e > b; b++)m.find(a, d[b], c);
				return c = this.pushStack(e > 1 ? m.unique(c) : c), c.selector = this.selector ? this.selector + " " + a : a, c
			}, filter: function (a) {
				return this.pushStack(w(this, a || [], !1))
			}, not: function (a) {
				return this.pushStack(w(this, a || [], !0))
			}, is: function (a) {
				return !!w(this, "string" == typeof a && t.test(a) ? m(a) : a || [], !1).length
			}
		});
		var x, y = a.document, z = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, A = m.fn.init = function (a, b) {
			var c, d;
			if (!a)return this;
			if ("string" == typeof a) {
				if (c = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : z.exec(a), !c || !c[1] && b)return !b || b.jq ? (b || x).find(a) : this.constructor(b).find(a);
				if (c[1]) {
					if (b = b instanceof m ? b[0] : b, m.merge(this, m.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : y, !0)), u.test(c[1]) && m.isPlainObject(b))for (c in b)m.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
					return this
				}
				if (d = y.getElementById(c[2]), d && d.parentNode) {
					if (d.id !== c[2])return x.find(a);
					this.length = 1, this[0] = d
				}
				return this.context = y, this.selector = a, this
			}
			return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : m.isFunction(a) ? "undefined" != typeof x.ready ? x.ready(a) : a(m) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), m.makeArray(a, this))
		};
		A.prototype = m.fn, x = m(y);
		var B = /^(?:parents|prev(?:Until|All))/, C = {children: !0, contents: !0, next: !0, prev: !0};
		m.extend({
			dir: function (a, b, c) {
				var d = [], e = a[b];
				while (e && 9 !== e.nodeType && (void 0 === c || 1 !== e.nodeType || !m(e).is(c)))1 === e.nodeType && d.push(e), e = e[b];
				return d
			}, sibling: function (a, b) {
				for (var c = []; a; a = a.nextSibling)1 === a.nodeType && a !== b && c.push(a);
				return c
			}
		}), m.fn.extend({
			has: function (a) {
				var b, c = m(a, this), d = c.length;
				return this.filter(function () {
					for (b = 0; d > b; b++)if (m.contains(this, c[b]))return !0
				})
			}, closest: function (a, b) {
				for (var c, d = 0, e = this.length, f = [], g = t.test(a) || "string" != typeof a ? m(a, b || this.context) : 0; e > d; d++)for (c = this[d]; c && c !== b; c = c.parentNode)if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && m.find.matchesSelector(c, a))) {
					f.push(c);
					break
				}
				return this.pushStack(f.length > 1 ? m.unique(f) : f)
			}, index: function (a) {
				return a ? "string" == typeof a ? m.inArray(this[0], m(a)) : m.inArray(a.jq ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
			}, add: function (a, b) {
				return this.pushStack(m.unique(m.merge(this.get(), m(a, b))))
			}, addBack: function (a) {
				return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
			}
		});
		function D(a, b) {
			do a = a[b]; while (a && 1 !== a.nodeType);
			return a
		}

		m.each({
			parent: function (a) {
				var b = a.parentNode;
				return b && 11 !== b.nodeType ? b : null
			}, parents: function (a) {
				return m.dir(a, "parentNode")
			}, parentsUntil: function (a, b, c) {
				return m.dir(a, "parentNode", c)
			}, next: function (a) {
				return D(a, "nextSibling")
			}, prev: function (a) {
				return D(a, "previousSibling")
			}, nextAll: function (a) {
				return m.dir(a, "nextSibling")
			}, prevAll: function (a) {
				return m.dir(a, "previousSibling")
			}, nextUntil: function (a, b, c) {
				return m.dir(a, "nextSibling", c)
			}, prevUntil: function (a, b, c) {
				return m.dir(a, "previousSibling", c)
			}, siblings: function (a) {
				return m.sibling((a.parentNode || {}).firstChild, a)
			}, children: function (a) {
				return m.sibling(a.firstChild)
			}, contents: function (a) {
				return m.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : m.merge([], a.childNodes)
			}
		}, function (a, b) {
			m.fn[a] = function (c, d) {
				var e = m.map(this, b, c);
				return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = m.filter(d, e)), this.length > 1 && (C[a] || (e = m.unique(e)), B.test(a) && (e = e.reverse())), this.pushStack(e)
			}
		});
		var E = /\S+/g, F = {};

		function G(a) {
			var b = F[a] = {};
			return m.each(a.match(E) || [], function (a, c) {
				b[c] = !0
			}), b
		}

		m.Callbacks = function (a) {
			a = "string" == typeof a ? F[a] || G(a) : m.extend({}, a);
			var b, c, d, e, f, g, h = [], i = !a.once && [], j = function (l) {
				for (c = a.memory && l, d = !0, f = g || 0, g = 0, e = h.length, b = !0; h && e > f; f++)if (h[f].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
					c = !1;
					break
				}
				b = !1, h && (i ? i.length && j(i.shift()) : c ? h = [] : k.disable())
			}, k = {
				add: function () {
					if (h) {
						var d = h.length;
						!function f(b) {
							m.each(b, function (b, c) {
								var d = m.type(c);
								"function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && f(c)
							})
						}(arguments), b ? e = h.length : c && (g = d, j(c))
					}
					return this
				}, remove: function () {
					return h && m.each(arguments, function (a, c) {
						var d;
						while ((d = m.inArray(c, h, d)) > -1)h.splice(d, 1), b && (e >= d && e--, f >= d && f--)
					}), this
				}, has: function (a) {
					return a ? m.inArray(a, h) > -1 : !(!h || !h.length)
				}, empty: function () {
					return h = [], e = 0, this
				}, disable: function () {
					return h = i = c = void 0, this
				}, disabled: function () {
					return !h
				}, lock: function () {
					return i = void 0, c || k.disable(), this
				}, locked: function () {
					return !i
				}, fireWith: function (a, c) {
					return !h || d && !i || (c = c || [], c = [a, c.slice ? c.slice() : c], b ? i.push(c) : j(c)), this
				}, fire: function () {
					return k.fireWith(this, arguments), this
				}, fired: function () {
					return !!d
				}
			};
			return k
		}, m.extend({
			Deferred: function (a) {
				var b = [["resolve", "done", m.Callbacks("once memory"), "resolved"], ["reject", "fail", m.Callbacks("once memory"), "rejected"], ["notify", "progress", m.Callbacks("memory")]], c = "pending", d = {
					state: function () {
						return c
					}, always: function () {
						return e.done(arguments).fail(arguments), this
					}, then: function () {
						var a = arguments;
						return m.Deferred(function (c) {
							m.each(b, function (b, f) {
								var g = m.isFunction(a[b]) && a[b];
								e[f[1]](function () {
									var a = g && g.apply(this, arguments);
									a && m.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
								})
							}), a = null
						}).promise()
					}, promise: function (a) {
						return null != a ? m.extend(a, d) : d
					}
				}, e = {};
				return d.pipe = d.then, m.each(b, function (a, f) {
					var g = f[2], h = f[3];
					d[f[1]] = g.add, h && g.add(function () {
						c = h
					}, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function () {
						return e[f[0] + "With"](this === e ? d : this, arguments), this
					}, e[f[0] + "With"] = g.fireWith
				}), d.promise(e), a && a.call(e, e), e
			}, when: function (a) {
				var b = 0, c = d.call(arguments), e = c.length, f = 1 !== e || a && m.isFunction(a.promise) ? e : 0, g = 1 === f ? a : m.Deferred(), h = function (a, b, c) {
					return function (e) {
						b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c)
					}
				}, i, j, k;
				if (e > 1)for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++)c[b] && m.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
				return f || g.resolveWith(k, c), g.promise()
			}
		});
		var H;
		m.fn.ready = function (a) {
			return m.ready.promise().done(a), this
		}, m.extend({
			isReady: !1, readyWait: 1, holdReady: function (a) {
				a ? m.readyWait++ : m.ready(!0)
			}, ready: function (a) {
				if (a === !0 ? !--m.readyWait : !m.isReady) {
					if (!y.body)return setTimeout(m.ready);
					m.isReady = !0, a !== !0 && --m.readyWait > 0 || (H.resolveWith(y, [m]), m.fn.triggerHandler && (m(y).triggerHandler("ready"), m(y).off("ready")))
				}
			}
		});
		function I() {
			y.addEventListener ? (y.removeEventListener("DOMContentLoaded", J, !1), a.removeEventListener("load", J, !1)) : (y.detachEvent("onreadystatechange", J), a.detachEvent("onload", J))
		}

		function J() {
			(y.addEventListener || "load" === event.type || "complete" === y.readyState) && (I(), m.ready())
		}

		m.ready.promise = function (b) {
			if (!H)if (H = m.Deferred(), "complete" === y.readyState)setTimeout(m.ready); else if (y.addEventListener)y.addEventListener("DOMContentLoaded", J, !1), a.addEventListener("load", J, !1); else {
				y.attachEvent("onreadystatechange", J), a.attachEvent("onload", J);
				var c = !1;
				try {
					c = null == a.frameElement && y.documentElement
				} catch (d) {
				}
				c && c.doScroll && !function e() {
					if (!m.isReady) {
						try {
							c.doScroll("left")
						} catch (a) {
							return setTimeout(e, 50)
						}
						I(), m.ready()
					}
				}()
			}
			return H.promise(b)
		};
		var K = "undefined", L;
		for (L in m(k))break;
		k.ownLast = "0" !== L, k.inlineBlockNeedsLayout = !1, m(function () {
			var a, b, c, d;
			c = y.getElementsByTagName("body")[0], c && c.style && (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1", k.inlineBlockNeedsLayout = a = 3 === b.offsetWidth, a && (c.style.zoom = 1)), c.removeChild(d))
		}), function () {
			var a = y.createElement("div");
			if (null == k.deleteExpando) {
				k.deleteExpando = !0;
				try {
					delete a.test
				} catch (b) {
					k.deleteExpando = !1
				}
			}
			a = null
		}(), m.acceptData = function (a) {
			var b = m.noData[(a.nodeName + " ").toLowerCase()], c = +a.nodeType || 1;
			return 1 !== c && 9 !== c ? !1 : !b || b !== !0 && a.getAttribute("classid") === b
		};
		var M = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, N = /([A-Z])/g;

		function O(a, b, c) {
			if (void 0 === c && 1 === a.nodeType) {
				var d = "data-" + b.replace(N, "-$1").toLowerCase();
				if (c = a.getAttribute(d), "string" == typeof c) {
					try {
						c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : M.test(c) ? m.parseJSON(c) : c
					} catch (e) {
					}
					m.data(a, b, c)
				} else c = void 0
			}
			return c
		}

		function P(a) {
			var b;
			for (b in a)if (("data" !== b || !m.isEmptyObject(a[b])) && "toJSON" !== b)return !1;

			return !0
		}

		function Q(a, b, d, e) {
			if (m.acceptData(a)) {
				var f, g, h = m.expando, i = a.nodeType, j = i ? m.cache : a, k = i ? a[h] : a[h] && h;
				if (k && j[k] && (e || j[k].data) || void 0 !== d || "string" != typeof b)return k || (k = i ? a[h] = c.pop() || m.guid++ : h), j[k] || (j[k] = i ? {} : {toJSON: m.noop}), ("object" == typeof b || "function" == typeof b) && (e ? j[k] = m.extend(j[k], b) : j[k].data = m.extend(j[k].data, b)), g = j[k], e || (g.data || (g.data = {}), g = g.data), void 0 !== d && (g[m.camelCase(b)] = d), "string" == typeof b ? (f = g[b], null == f && (f = g[m.camelCase(b)])) : f = g, f
			}
		}

		function R(a, b, c) {
			if (m.acceptData(a)) {
				var d, e, f = a.nodeType, g = f ? m.cache : a, h = f ? a[m.expando] : m.expando;
				if (g[h]) {
					if (b && (d = c ? g[h] : g[h].data)) {
						m.isArray(b) ? b = b.concat(m.map(b, m.camelCase)) : b in d ? b = [b] : (b = m.camelCase(b), b = b in d ? [b] : b.split(" ")), e = b.length;
						while (e--)delete d[b[e]];
						if (c ? !P(d) : !m.isEmptyObject(d))return
					}
					(c || (delete g[h].data, P(g[h]))) && (f ? m.cleanData([a], !0) : k.deleteExpando || g != g.window ? delete g[h] : g[h] = null)
				}
			}
		}

		m.extend({
			cache: {},
			noData: {"applet ": !0, "embed ": !0, "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},
			hasData: function (a) {
				return a = a.nodeType ? m.cache[a[m.expando]] : a[m.expando], !!a && !P(a)
			},
			data: function (a, b, c) {
				return Q(a, b, c)
			},
			removeData: function (a, b) {
				return R(a, b)
			},
			_data: function (a, b, c) {
				return Q(a, b, c, !0)
			},
			_removeData: function (a, b) {
				return R(a, b, !0)
			}
		}), m.fn.extend({
			data: function (a, b) {
				var c, d, e, f = this[0], g = f && f.attributes;
				if (void 0 === a) {
					if (this.length && (e = m.data(f), 1 === f.nodeType && !m._data(f, "parsedAttrs"))) {
						c = g.length;
						while (c--)g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = m.camelCase(d.slice(5)), O(f, d, e[d])));
						m._data(f, "parsedAttrs", !0)
					}
					return e
				}
				return "object" == typeof a ? this.each(function () {
					m.data(this, a)
				}) : arguments.length > 1 ? this.each(function () {
					m.data(this, a, b)
				}) : f ? O(f, a, m.data(f, a)) : void 0
			}, removeData: function (a) {
				return this.each(function () {
					m.removeData(this, a)
				})
			}
		}), m.extend({
			queue: function (a, b, c) {
				var d;
				return a ? (b = (b || "fx") + "queue", d = m._data(a, b), c && (!d || m.isArray(c) ? d = m._data(a, b, m.makeArray(c)) : d.push(c)), d || []) : void 0
			}, dequeue: function (a, b) {
				b = b || "fx";
				var c = m.queue(a, b), d = c.length, e = c.shift(), f = m._queueHooks(a, b), g = function () {
					m.dequeue(a, b)
				};
				"inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
			}, _queueHooks: function (a, b) {
				var c = b + "queueHooks";
				return m._data(a, c) || m._data(a, c, {
						empty: m.Callbacks("once memory").add(function () {
							m._removeData(a, b + "queue"), m._removeData(a, c)
						})
					})
			}
		}), m.fn.extend({
			queue: function (a, b) {
				var c = 2;
				return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? m.queue(this[0], a) : void 0 === b ? this : this.each(function () {
					var c = m.queue(this, a, b);
					m._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && m.dequeue(this, a)
				})
			}, dequeue: function (a) {
				return this.each(function () {
					m.dequeue(this, a)
				})
			}, clearQueue: function (a) {
				return this.queue(a || "fx", [])
			}, promise: function (a, b) {
				var c, d = 1, e = m.Deferred(), f = this, g = this.length, h = function () {
					--d || e.resolveWith(f, [f])
				};
				"string" != typeof a && (b = a, a = void 0), a = a || "fx";
				while (g--)c = m._data(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
				return h(), e.promise(b)
			}
		});
		var S = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, T = ["Top", "Right", "Bottom", "Left"], U = function (a, b) {
			return a = b || a, "none" === m.css(a, "display") || !m.contains(a.ownerDocument, a)
		}, V = m.access = function (a, b, c, d, e, f, g) {
			var h = 0, i = a.length, j = null == c;
			if ("object" === m.type(c)) {
				e = !0;
				for (h in c)m.access(a, b, h, c[h], !0, f, g)
			} else if (void 0 !== d && (e = !0, m.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function (a, b, c) {
					return j.call(m(a), c)
				})), b))for (; i > h; h++)b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
			return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
		}, W = /^(?:checkbox|radio)$/i;
		!function () {
			var a = y.createElement("input"), b = y.createElement("div"), c = y.createDocumentFragment();
			if (b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", k.leadingWhitespace = 3 === b.firstChild.nodeType, k.tbody = !b.getElementsByTagName("tbody").length, k.htmlSerialize = !!b.getElementsByTagName("link").length, k.html5Clone = "<:nav></:nav>" !== y.createElement("nav").cloneNode(!0).outerHTML, a.type = "checkbox", a.checked = !0, c.appendChild(a), k.appendChecked = a.checked, b.innerHTML = "<textarea>x</textarea>", k.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue, c.appendChild(b), b.innerHTML = "<input type='radio' checked='checked' name='t'/>", k.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, k.noCloneEvent = !0, b.attachEvent && (b.attachEvent("onclick", function () {
					k.noCloneEvent = !1
				}), b.cloneNode(!0).click()), null == k.deleteExpando) {
				k.deleteExpando = !0;
				try {
					delete b.test
				} catch (d) {
					k.deleteExpando = !1
				}
			}
		}(), function () {
			var b, c, d = y.createElement("div");
			for (b in{
				submit: !0,
				change: !0,
				focusin: !0
			})c = "on" + b, (k[b + "Bubbles"] = c in a) || (d.setAttribute(c, "t"), k[b + "Bubbles"] = d.attributes[c].expando === !1);
			d = null
		}();
		var X = /^(?:input|select|textarea)$/i, Y = /^key/, Z = /^(?:mouse|pointer|contextmenu)|click/, $ = /^(?:focusinfocus|focusoutblur)$/, _ = /^([^.]*)(?:\.(.+)|)$/;

		function aa() {
			return !0
		}

		function ba() {
			return !1
		}

		function ca() {
			try {
				return y.activeElement
			} catch (a) {
			}
		}

		m.event = {
			global: {},
			add: function (a, b, c, d, e) {
				var f, g, h, i, j, k, l, n, o, p, q, r = m._data(a);
				if (r) {
					c.handler && (i = c, c = i.handler, e = i.selector), c.guid || (c.guid = m.guid++), (g = r.events) || (g = r.events = {}), (k = r.handle) || (k = r.handle = function (a) {
						return typeof m === K || a && m.event.triggered === a.type ? void 0 : m.event.dispatch.apply(k.elem, arguments)
					}, k.elem = a), b = (b || "").match(E) || [""], h = b.length;
					while (h--)f = _.exec(b[h]) || [], o = q = f[1], p = (f[2] || "").split(".").sort(), o && (j = m.event.special[o] || {}, o = (e ? j.delegateType : j.bindType) || o, j = m.event.special[o] || {}, l = m.extend({
						type: o,
						origType: q,
						data: d,
						handler: c,
						guid: c.guid,
						selector: e,
						needsContext: e && m.expr.match.needsContext.test(e),
						namespace: p.join(".")
					}, i), (n = g[o]) || (n = g[o] = [], n.delegateCount = 0, j.setup && j.setup.call(a, d, p, k) !== !1 || (a.addEventListener ? a.addEventListener(o, k, !1) : a.attachEvent && a.attachEvent("on" + o, k))), j.add && (j.add.call(a, l), l.handler.guid || (l.handler.guid = c.guid)), e ? n.splice(n.delegateCount++, 0, l) : n.push(l), m.event.global[o] = !0);
					a = null
				}
			},
			remove: function (a, b, c, d, e) {
				var f, g, h, i, j, k, l, n, o, p, q, r = m.hasData(a) && m._data(a);
				if (r && (k = r.events)) {
					b = (b || "").match(E) || [""], j = b.length;
					while (j--)if (h = _.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
						l = m.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, n = k[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = n.length;
						while (f--)g = n[f], !e && q !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (n.splice(f, 1), g.selector && n.delegateCount--, l.remove && l.remove.call(a, g));
						i && !n.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || m.removeEvent(a, o, r.handle), delete k[o])
					} else for (o in k)m.event.remove(a, o + b[j], c, d, !0);
					m.isEmptyObject(k) && (delete r.handle, m._removeData(a, "events"))
				}
			},
			trigger: function (b, c, d, e) {
				var f, g, h, i, k, l, n, o = [d || y], p = j.call(b, "type") ? b.type : b, q = j.call(b, "namespace") ? b.namespace.split(".") : [];
				if (h = l = d = d || y, 3 !== d.nodeType && 8 !== d.nodeType && !$.test(p + m.event.triggered) && (p.indexOf(".") >= 0 && (q = p.split("."), p = q.shift(), q.sort()), g = p.indexOf(":") < 0 && "on" + p, b = b[m.expando] ? b : new m.Event(p, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = q.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + q.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : m.makeArray(c, [b]), k = m.event.special[p] || {}, e || !k.trigger || k.trigger.apply(d, c) !== !1)) {
					if (!e && !k.noBubble && !m.isWindow(d)) {
						for (i = k.delegateType || p, $.test(i + p) || (h = h.parentNode); h; h = h.parentNode)o.push(h), l = h;
						l === (d.ownerDocument || y) && o.push(l.defaultView || l.parentWindow || a)
					}
					n = 0;
					while ((h = o[n++]) && !b.isPropagationStopped())b.type = n > 1 ? i : k.bindType || p, f = (m._data(h, "events") || {})[b.type] && m._data(h, "handle"), f && f.apply(h, c), f = g && h[g], f && f.apply && m.acceptData(h) && (b.result = f.apply(h, c), b.result === !1 && b.preventDefault());
					if (b.type = p, !e && !b.isDefaultPrevented() && (!k._default || k._default.apply(o.pop(), c) === !1) && m.acceptData(d) && g && d[p] && !m.isWindow(d)) {
						l = d[g], l && (d[g] = null), m.event.triggered = p;
						try {
							d[p]()
						} catch (r) {
						}
						m.event.triggered = void 0, l && (d[g] = l)
					}
					return b.result
				}
			},
			dispatch: function (a) {
				a = m.event.fix(a);
				var b, c, e, f, g, h = [], i = d.call(arguments), j = (m._data(this, "events") || {})[a.type] || [], k = m.event.special[a.type] || {};
				if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
					h = m.event.handlers.call(this, a, j), b = 0;
					while ((f = h[b++]) && !a.isPropagationStopped()) {
						a.currentTarget = f.elem, g = 0;
						while ((e = f.handlers[g++]) && !a.isImmediatePropagationStopped())(!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, a.data = e.data, c = ((m.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i), void 0 !== c && (a.result = c) === !1 && (a.preventDefault(), a.stopPropagation()))
					}
					return k.postDispatch && k.postDispatch.call(this, a), a.result
				}
			},
			handlers: function (a, b) {
				var c, d, e, f, g = [], h = b.delegateCount, i = a.target;
				if (h && i.nodeType && (!a.button || "click" !== a.type))for (; i != this; i = i.parentNode || this)if (1 === i.nodeType && (i.disabled !== !0 || "click" !== a.type)) {
					for (e = [], f = 0; h > f; f++)d = b[f], c = d.selector + " ", void 0 === e[c] && (e[c] = d.needsContext ? m(c, this).index(i) >= 0 : m.find(c, this, null, [i]).length), e[c] && e.push(d);
					e.length && g.push({elem: i, handlers: e})
				}
				return h < b.length && g.push({elem: this, handlers: b.slice(h)}), g
			},
			fix: function (a) {
				if (a[m.expando])return a;
				var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
				g || (this.fixHooks[e] = g = Z.test(e) ? this.mouseHooks : Y.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new m.Event(f), b = d.length;
				while (b--)c = d[b], a[c] = f[c];
				return a.target || (a.target = f.srcElement || y), 3 === a.target.nodeType && (a.target = a.target.parentNode), a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a
			},
			props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
			fixHooks: {},
			keyHooks: {
				props: "char charCode key keyCode".split(" "), filter: function (a, b) {
					return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
				}
			},
			mouseHooks: {
				props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
				filter: function (a, b) {
					var c, d, e, f = b.button, g = b.fromElement;
					return null == a.pageX && null != b.clientX && (d = a.target.ownerDocument || y, e = d.documentElement, c = d.body, a.pageX = b.clientX + (e && e.scrollLeft || c && c.scrollLeft || 0) - (e && e.clientLeft || c && c.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || c && c.scrollTop || 0) - (e && e.clientTop || c && c.clientTop || 0)), !a.relatedTarget && g && (a.relatedTarget = g === a.target ? b.toElement : g), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a
				}
			},
			special: {
				load: {noBubble: !0}, focus: {
					trigger: function () {
						if (this !== ca() && this.focus)try {
							return this.focus(), !1
						} catch (a) {
						}
					}, delegateType: "focusin"
				}, blur: {
					trigger: function () {
						return this === ca() && this.blur ? (this.blur(), !1) : void 0
					}, delegateType: "focusout"
				}, click: {
					trigger: function () {
						return m.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
					}, _default: function (a) {
						return m.nodeName(a.target, "a")
					}
				}, beforeunload: {
					postDispatch: function (a) {
						void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result)
					}
				}
			},
			simulate: function (a, b, c, d) {
				var e = m.extend(new m.Event, c, {type: a, isSimulated: !0, originalEvent: {}});
				d ? m.event.trigger(e, null, b) : m.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
			}
		}, m.removeEvent = y.removeEventListener ? function (a, b, c) {
			a.removeEventListener && a.removeEventListener(b, c, !1)
		} : function (a, b, c) {
			var d = "on" + b;
			a.detachEvent && (typeof a[d] === K && (a[d] = null), a.detachEvent(d, c))
		}, m.Event = function (a, b) {
			return this instanceof m.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && a.returnValue === !1 ? aa : ba) : this.type = a, b && m.extend(this, b), this.timeStamp = a && a.timeStamp || m.now(), void(this[m.expando] = !0)) : new m.Event(a, b)
		}, m.Event.prototype = {
			isDefaultPrevented: ba,
			isPropagationStopped: ba,
			isImmediatePropagationStopped: ba,
			preventDefault: function () {
				var a = this.originalEvent;
				this.isDefaultPrevented = aa, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
			},
			stopPropagation: function () {
				var a = this.originalEvent;
				this.isPropagationStopped = aa, a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
			},
			stopImmediatePropagation: function () {
				var a = this.originalEvent;
				this.isImmediatePropagationStopped = aa, a && a.stopImmediatePropagation && a.stopImmediatePropagation(), this.stopPropagation()
			}
		}, m.each({
			mouseenter: "mouseover",
			mouseleave: "mouseout",
			pointerenter: "pointerover",
			pointerleave: "pointerout"
		}, function (a, b) {
			m.event.special[a] = {
				delegateType: b, bindType: b, handle: function (a) {
					var c, d = this, e = a.relatedTarget, f = a.handleObj;
					return (!e || e !== d && !m.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
				}
			}
		}), k.submitBubbles || (m.event.special.submit = {
			setup: function () {
				return m.nodeName(this, "form") ? !1 : void m.event.add(this, "click._submit keypress._submit", function (a) {
					var b = a.target, c = m.nodeName(b, "input") || m.nodeName(b, "button") ? b.form : void 0;
					c && !m._data(c, "submitBubbles") && (m.event.add(c, "submit._submit", function (a) {
						a._submit_bubble = !0
					}), m._data(c, "submitBubbles", !0))
				})
			}, postDispatch: function (a) {
				a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && m.event.simulate("submit", this.parentNode, a, !0))
			}, teardown: function () {
				return m.nodeName(this, "form") ? !1 : void m.event.remove(this, "._submit")
			}
		}), k.changeBubbles || (m.event.special.change = {
			setup: function () {
				return X.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (m.event.add(this, "propertychange._change", function (a) {
					"checked" === a.originalEvent.propertyName && (this._just_changed = !0)
				}), m.event.add(this, "click._change", function (a) {
					this._just_changed && !a.isTrigger && (this._just_changed = !1), m.event.simulate("change", this, a, !0)
				})), !1) : void m.event.add(this, "beforeactivate._change", function (a) {
					var b = a.target;
					X.test(b.nodeName) && !m._data(b, "changeBubbles") && (m.event.add(b, "change._change", function (a) {
						!this.parentNode || a.isSimulated || a.isTrigger || m.event.simulate("change", this.parentNode, a, !0)
					}), m._data(b, "changeBubbles", !0))
				})
			}, handle: function (a) {
				var b = a.target;
				return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
			}, teardown: function () {
				return m.event.remove(this, "._change"), !X.test(this.nodeName)
			}
		}), k.focusinBubbles || m.each({focus: "focusin", blur: "focusout"}, function (a, b) {
			var c = function (a) {
				m.event.simulate(b, a.target, m.event.fix(a), !0)
			};
			m.event.special[b] = {
				setup: function () {
					var d = this.ownerDocument || this, e = m._data(d, b);
					e || d.addEventListener(a, c, !0), m._data(d, b, (e || 0) + 1)
				}, teardown: function () {
					var d = this.ownerDocument || this, e = m._data(d, b) - 1;
					e ? m._data(d, b, e) : (d.removeEventListener(a, c, !0), m._removeData(d, b))
				}
			}
		}), m.fn.extend({
			on: function (a, b, c, d, e) {
				var f, g;
				if ("object" == typeof a) {
					"string" != typeof b && (c = c || b, b = void 0);
					for (f in a)this.on(f, b, c, a[f], e);
					return this
				}
				if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1)d = ba; else if (!d)return this;
				return 1 === e && (g = d, d = function (a) {
					return m().off(a), g.apply(this, arguments)
				}, d.guid = g.guid || (g.guid = m.guid++)), this.each(function () {
					m.event.add(this, a, d, c, b)
				})
			}, one: function (a, b, c, d) {
				return this.on(a, b, c, d, 1)
			}, off: function (a, b, c) {
				var d, e;
				if (a && a.preventDefault && a.handleObj)return d = a.handleObj, m(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
				if ("object" == typeof a) {
					for (e in a)this.off(e, b, a[e]);
					return this
				}
				return (b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = ba), this.each(function () {
					m.event.remove(this, a, c, b)
				})
			}, trigger: function (a, b) {
				return this.each(function () {
					m.event.trigger(a, b, this)
				})
			}, triggerHandler: function (a, b) {
				var c = this[0];
				return c ? m.event.trigger(a, b, c, !0) : void 0
			}
		});
		function da(a) {
			var b = ea.split("|"), c = a.createDocumentFragment();
			if (c.createElement)while (b.length)c.createElement(b.pop());
			return c
		}

		var ea = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", fa = / jq\d+="(?:null|\d+)"/g, ga = new RegExp("<(?:" + ea + ")[\\s/>]", "i"), ha = /^\s+/, ia = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, ja = /<([\w:]+)/, ka = /<tbody/i, la = /<|&#?\w+;/, ma = /<(?:script|style|link)/i, na = /checked\s*(?:[^=]|=\s*.checked.)/i, oa = /^$|\/(?:java|ecma)script/i, pa = /^true\/(.*)/, qa = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, ra = {
			option: [1, "<select multiple='multiple'>", "</select>"],
			legend: [1, "<fieldset>", "</fieldset>"],
			area: [1, "<map>", "</map>"],
			param: [1, "<object>", "</object>"],
			thead: [1, "<table>", "</table>"],
			tr: [2, "<table><tbody>", "</tbody></table>"],
			col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
			td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
			_default: k.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
		}, sa = da(y), ta = sa.appendChild(y.createElement("div"));
		ra.optgroup = ra.option, ra.tbody = ra.tfoot = ra.colgroup = ra.caption = ra.thead, ra.th = ra.td;
		function ua(a, b) {
			var c, d, e = 0, f = typeof a.getElementsByTagName !== K ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== K ? a.querySelectorAll(b || "*") : void 0;
			if (!f)for (f = [], c = a.childNodes || a; null != (d = c[e]); e++)!b || m.nodeName(d, b) ? f.push(d) : m.merge(f, ua(d, b));
			return void 0 === b || b && m.nodeName(a, b) ? m.merge([a], f) : f
		}

		function va(a) {
			W.test(a.type) && (a.defaultChecked = a.checked)
		}

		function wa(a, b) {
			return m.nodeName(a, "table") && m.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
		}

		function xa(a) {
			return a.type = (null !== m.find.attr(a, "type")) + "/" + a.type, a
		}

		function ya(a) {
			var b = pa.exec(a.type);
			return b ? a.type = b[1] : a.removeAttribute("type"), a
		}

		function za(a, b) {
			for (var c, d = 0; null != (c = a[d]); d++)m._data(c, "globalEval", !b || m._data(b[d], "globalEval"))
		}

		function Aa(a, b) {
			if (1 === b.nodeType && m.hasData(a)) {
				var c, d, e, f = m._data(a), g = m._data(b, f), h = f.events;
				if (h) {
					delete g.handle, g.events = {};
					for (c in h)for (d = 0, e = h[c].length; e > d; d++)m.event.add(b, c, h[c][d])
				}
				g.data && (g.data = m.extend({}, g.data))
			}
		}

		function Ba(a, b) {
			var c, d, e;
			if (1 === b.nodeType) {
				if (c = b.nodeName.toLowerCase(), !k.noCloneEvent && b[m.expando]) {
					e = m._data(b);
					for (d in e.events)m.removeEvent(b, d, e.handle);
					b.removeAttribute(m.expando)
				}
				"script" === c && b.text !== a.text ? (xa(b).text = a.text, ya(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), k.html5Clone && a.innerHTML && !m.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && W.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
			}
		}

		m.extend({
			clone: function (a, b, c) {
				var d, e, f, g, h, i = m.contains(a.ownerDocument, a);
				if (k.html5Clone || m.isXMLDoc(a) || !ga.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (ta.innerHTML = a.outerHTML, ta.removeChild(f = ta.firstChild)), !(k.noCloneEvent && k.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || m.isXMLDoc(a)))for (d = ua(f), h = ua(a), g = 0; null != (e = h[g]); ++g)d[g] && Ba(e, d[g]);
				if (b)if (c)for (h = h || ua(a), d = d || ua(f), g = 0; null != (e = h[g]); g++)Aa(e, d[g]); else Aa(a, f);
				return d = ua(f, "script"), d.length > 0 && za(d, !i && ua(a, "script")), d = h = e = null, f
			}, buildFragment: function (a, b, c, d) {
				for (var e, f, g, h, i, j, l, n = a.length, o = da(b), p = [], q = 0; n > q; q++)if (f = a[q], f || 0 === f)if ("object" === m.type(f))m.merge(p, f.nodeType ? [f] : f); else if (la.test(f)) {
					h = h || o.appendChild(b.createElement("div")), i = (ja.exec(f) || ["", ""])[1].toLowerCase(), l = ra[i] || ra._default, h.innerHTML = l[1] + f.replace(ia, "<$1></$2>") + l[2], e = l[0];
					while (e--)h = h.lastChild;
					if (!k.leadingWhitespace && ha.test(f) && p.push(b.createTextNode(ha.exec(f)[0])), !k.tbody) {
						f = "table" !== i || ka.test(f) ? "<table>" !== l[1] || ka.test(f) ? 0 : h : h.firstChild, e = f && f.childNodes.length;
						while (e--)m.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j)
					}
					m.merge(p, h.childNodes), h.textContent = "";
					while (h.firstChild)h.removeChild(h.firstChild);
					h = o.lastChild
				} else p.push(b.createTextNode(f));
				h && o.removeChild(h), k.appendChecked || m.grep(ua(p, "input"), va), q = 0;
				while (f = p[q++])if ((!d || -1 === m.inArray(f, d)) && (g = m.contains(f.ownerDocument, f), h = ua(o.appendChild(f), "script"), g && za(h), c)) {
					e = 0;
					while (f = h[e++])oa.test(f.type || "") && c.push(f)
				}
				return h = null, o
			}, cleanData: function (a, b) {
				for (var d, e, f, g, h = 0, i = m.expando, j = m.cache, l = k.deleteExpando, n = m.event.special; null != (d = a[h]); h++)if ((b || m.acceptData(d)) && (f = d[i], g = f && j[f])) {
					if (g.events)for (e in g.events)n[e] ? m.event.remove(d, e) : m.removeEvent(d, e, g.handle);
					j[f] && (delete j[f], l ? delete d[i] : typeof d.removeAttribute !== K ? d.removeAttribute(i) : d[i] = null, c.push(f))
				}
			}
		}), m.fn.extend({
			text: function (a) {
				return V(this, function (a) {
					return void 0 === a ? m.text(this) : this.empty().append((this[0] && this[0].ownerDocument || y).createTextNode(a))
				}, null, a, arguments.length)
			}, append: function () {
				return this.domManip(arguments, function (a) {
					if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
						var b = wa(this, a);
						b.appendChild(a)
					}
				})
			}, prepend: function () {
				return this.domManip(arguments, function (a) {
					if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
						var b = wa(this, a);
						b.insertBefore(a, b.firstChild)
					}
				})
			}, before: function () {
				return this.domManip(arguments, function (a) {
					this.parentNode && this.parentNode.insertBefore(a, this)
				})
			}, after: function () {
				return this.domManip(arguments, function (a) {
					this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
				})
			}, remove: function (a, b) {
				for (var c, d = a ? m.filter(a, this) : this, e = 0; null != (c = d[e]); e++)b || 1 !== c.nodeType || m.cleanData(ua(c)), c.parentNode && (b && m.contains(c.ownerDocument, c) && za(ua(c, "script")), c.parentNode.removeChild(c));
				return this
			}, empty: function () {
				for (var a, b = 0; null != (a = this[b]); b++) {
					1 === a.nodeType && m.cleanData(ua(a, !1));
					while (a.firstChild)a.removeChild(a.firstChild);
					a.options && m.nodeName(a, "select") && (a.options.length = 0)
				}
				return this
			}, clone: function (a, b) {
				return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function () {
					return m.clone(this, a, b)
				})
			}, html: function (a) {
				return V(this, function (a) {
					var b = this[0] || {}, c = 0, d = this.length;
					if (void 0 === a)return 1 === b.nodeType ? b.innerHTML.replace(fa, "") : void 0;
					if (!("string" != typeof a || ma.test(a) || !k.htmlSerialize && ga.test(a) || !k.leadingWhitespace && ha.test(a) || ra[(ja.exec(a) || ["", ""])[1].toLowerCase()])) {
						a = a.replace(ia, "<$1></$2>");
						try {
							for (; d > c; c++)b = this[c] || {}, 1 === b.nodeType && (m.cleanData(ua(b, !1)), b.innerHTML = a);
							b = 0
						} catch (e) {
						}
					}
					b && this.empty().append(a)
				}, null, a, arguments.length)
			}, replaceWith: function () {
				var a = arguments[0];
				return this.domManip(arguments, function (b) {
					a = this.parentNode, m.cleanData(ua(this)), a && a.replaceChild(b, this)
				}), a && (a.length || a.nodeType) ? this : this.remove()
			}, detach: function (a) {
				return this.remove(a, !0)
			}, domManip: function (a, b) {
				a = e.apply([], a);
				var c, d, f, g, h, i, j = 0, l = this.length, n = this, o = l - 1, p = a[0], q = m.isFunction(p);
				if (q || l > 1 && "string" == typeof p && !k.checkClone && na.test(p))return this.each(function (c) {
					var d = n.eq(c);
					q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b)
				});
				if (l && (i = m.buildFragment(a, this[0].ownerDocument, !1, this), c = i.firstChild, 1 === i.childNodes.length && (i = c), c)) {
					for (g = m.map(ua(i, "script"), xa), f = g.length; l > j; j++)d = i, j !== o && (d = m.clone(d, !0, !0), f && m.merge(g, ua(d, "script"))), b.call(this[j], d, j);
					if (f)for (h = g[g.length - 1].ownerDocument, m.map(g, ya), j = 0; f > j; j++)d = g[j], oa.test(d.type || "") && !m._data(d, "globalEval") && m.contains(h, d) && (d.src ? m._evalUrl && m._evalUrl(d.src) : m.globalEval((d.text || d.textContent || d.innerHTML || "").replace(qa, "")));
					i = c = null
				}
				return this
			}
		}), m.each({
			appendTo: "append",
			prependTo: "prepend",
			insertBefore: "before",
			insertAfter: "after",
			replaceAll: "replaceWith"
		}, function (a, b) {
			m.fn[a] = function (a) {
				for (var c, d = 0, e = [], g = m(a), h = g.length - 1; h >= d; d++)c = d === h ? this : this.clone(!0), m(g[d])[b](c), f.apply(e, c.get());
				return this.pushStack(e)
			}
		});
		var Ca, Da = {};

		function Ea(b, c) {
			var d, e = m(c.createElement(b)).appendTo(c.body), f = a.getDefaultComputedStyle && (d = a.getDefaultComputedStyle(e[0])) ? d.display : m.css(e[0], "display");
			return e.detach(), f
		}

		function Fa(a) {
			var b = y, c = Da[a];
			return c || (c = Ea(a, b), "none" !== c && c || (Ca = (Ca || m("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = (Ca[0].contentWindow || Ca[0].contentDocument).document, b.write(), b.close(), c = Ea(a, b), Ca.detach()), Da[a] = c), c
		}

		!function () {
			var a;
			k.shrinkWrapBlocks = function () {
				if (null != a)return a;
				a = !1;
				var b, c, d;
				return c = y.getElementsByTagName("body")[0], c && c.style ? (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), typeof b.style.zoom !== K && (b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1", b.appendChild(y.createElement("div")).style.width = "5px", a = 3 !== b.offsetWidth), c.removeChild(d), a) : void 0
			}
		}();
		var Ga = /^margin/, Ha = new RegExp("^(" + S + ")(?!px)[a-z%]+$", "i"), Ia, Ja, Ka = /^(top|right|bottom|left)$/;
		a.getComputedStyle ? (Ia = function (b) {
			return b.ownerDocument.defaultView.opener ? b.ownerDocument.defaultView.getComputedStyle(b, null) : a.getComputedStyle(b, null)
		}, Ja = function (a, b, c) {
			var d, e, f, g, h = a.style;
			return c = c || Ia(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, c && ("" !== g || m.contains(a.ownerDocument, a) || (g = m.style(a, b)), Ha.test(g) && Ga.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 === g ? g : g + ""
		}) : y.documentElement.currentStyle && (Ia = function (a) {
			return a.currentStyle
		}, Ja = function (a, b, c) {
			var d, e, f, g, h = a.style;
			return c = c || Ia(a), g = c ? c[b] : void 0, null == g && h && h[b] && (g = h[b]), Ha.test(g) && !Ka.test(b) && (d = h.left, e = a.runtimeStyle, f = e && e.left, f && (e.left = a.currentStyle.left), h.left = "fontSize" === b ? "1em" : g, g = h.pixelLeft + "px", h.left = d, f && (e.left = f)), void 0 === g ? g : g + "" || "auto"
		});
		function La(a, b) {
			return {
				get: function () {
					var c = a();
					if (null != c)return c ? void delete this.get : (this.get = b).apply(this, arguments)
				}
			}
		}

		!function () {
			var b, c, d, e, f, g, h;
			if (b = y.createElement("div"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", d = b.getElementsByTagName("a")[0], c = d && d.style) {
				c.cssText = "float:left;opacity:.5", k.opacity = "0.5" === c.opacity, k.cssFloat = !!c.cssFloat, b.style.backgroundClip = "content-box", b.cloneNode(!0).style.backgroundClip = "", k.clearCloneStyle = "content-box" === b.style.backgroundClip, k.boxSizing = "" === c.boxSizing || "" === c.MozBoxSizing || "" === c.WebkitBoxSizing, m.extend(k, {
					reliableHiddenOffsets: function () {
						return null == g && i(), g
					}, boxSizingReliable: function () {
						return null == f && i(), f
					}, pixelPosition: function () {
						return null == e && i(), e
					}, reliableMarginRight: function () {
						return null == h && i(), h
					}
				});
				function i() {
					var b, c, d, i;
					c = y.getElementsByTagName("body")[0], c && c.style && (b = y.createElement("div"), d = y.createElement("div"), d.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px", c.appendChild(d).appendChild(b), b.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;display:block;margin-top:1%;top:1%;border:1px;padding:1px;width:4px;position:absolute", e = f = !1, h = !0, a.getComputedStyle && (e = "1%" !== (a.getComputedStyle(b, null) || {}).top, f = "4px" === (a.getComputedStyle(b, null) || {width: "4px"}).width, i = b.appendChild(y.createElement("div")), i.style.cssText = b.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", i.style.marginRight = i.style.width = "0", b.style.width = "1px", h = !parseFloat((a.getComputedStyle(i, null) || {}).marginRight), b.removeChild(i)), b.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", i = b.getElementsByTagName("td"), i[0].style.cssText = "margin:0;border:0;padding:0;display:none", g = 0 === i[0].offsetHeight, g && (i[0].style.display = "", i[1].style.display = "none", g = 0 === i[0].offsetHeight), c.removeChild(d))
				}
			}
		}(), m.swap = function (a, b, c, d) {
			var e, f, g = {};
			for (f in b)g[f] = a.style[f], a.style[f] = b[f];
			e = c.apply(a, d || []);
			for (f in b)a.style[f] = g[f];
			return e
		};
		var Ma = /alpha\([^)]*\)/i, Na = /opacity\s*=\s*([^)]*)/, Oa = /^(none|table(?!-c[ea]).+)/, Pa = new RegExp("^(" + S + ")(.*)$", "i"), Qa = new RegExp("^([+-])=(" + S + ")", "i"), Ra = {
			position: "absolute",
			visibility: "hidden",
			display: "block"
		}, Sa = {letterSpacing: "0", fontWeight: "400"}, Ta = ["Webkit", "O", "Moz", "ms"];

		function Ua(a, b) {
			if (b in a)return b;
			var c = b.charAt(0).toUpperCase() + b.slice(1), d = b, e = Ta.length;
			while (e--)if (b = Ta[e] + c, b in a)return b;
			return d
		}

		function Va(a, b) {
			for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++)d = a[g], d.style && (f[g] = m._data(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && U(d) && (f[g] = m._data(d, "olddisplay", Fa(d.nodeName)))) : (e = U(d), (c && "none" !== c || !e) && m._data(d, "olddisplay", e ? c : m.css(d, "display"))));
			for (g = 0; h > g; g++)d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
			return a
		}

		function Wa(a, b, c) {
			var d = Pa.exec(b);
			return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
		}

		function Xa(a, b, c, d, e) {
			for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2)"margin" === c && (g += m.css(a, c + T[f], !0, e)), d ? ("content" === c && (g -= m.css(a, "padding" + T[f], !0, e)), "margin" !== c && (g -= m.css(a, "border" + T[f] + "Width", !0, e))) : (g += m.css(a, "padding" + T[f], !0, e), "padding" !== c && (g += m.css(a, "border" + T[f] + "Width", !0, e)));
			return g
		}

		function Ya(a, b, c) {
			var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = Ia(a), g = k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, f);
			if (0 >= e || null == e) {
				if (e = Ja(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ha.test(e))return e;
				d = g && (k.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
			}
			return e + Xa(a, b, c || (g ? "border" : "content"), d, f) + "px"
		}

		m.extend({
			cssHooks: {
				opacity: {
					get: function (a, b) {
						if (b) {
							var c = Ja(a, "opacity");
							return "" === c ? "1" : c
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
			cssProps: {"float": k.cssFloat ? "cssFloat" : "styleFloat"},
			style: function (a, b, c, d) {
				if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
					var e, f, g, h = m.camelCase(b), i = a.style;
					if (b = m.cssProps[h] || (m.cssProps[h] = Ua(i, h)), g = m.cssHooks[b] || m.cssHooks[h], void 0 === c)return g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b];
					if (f = typeof c, "string" === f && (e = Qa.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(m.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || m.cssNumber[h] || (c += "px"), k.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), !(g && "set" in g && void 0 === (c = g.set(a, c, d)))))try {
						i[b] = c
					} catch (j) {
					}
				}
			},
			css: function (a, b, c, d) {
				var e, f, g, h = m.camelCase(b);
				return b = m.cssProps[h] || (m.cssProps[h] = Ua(a.style, h)), g = m.cssHooks[b] || m.cssHooks[h], g && "get" in g && (f = g.get(a, !0, c)), void 0 === f && (f = Ja(a, b, d)), "normal" === f && b in Sa && (f = Sa[b]), "" === c || c ? (e = parseFloat(f), c === !0 || m.isNumeric(e) ? e || 0 : f) : f
			}
		}), m.each(["height", "width"], function (a, b) {
			m.cssHooks[b] = {
				get: function (a, c, d) {
					return c ? Oa.test(m.css(a, "display")) && 0 === a.offsetWidth ? m.swap(a, Ra, function () {
						return Ya(a, b, d)
					}) : Ya(a, b, d) : void 0
				}, set: function (a, c, d) {
					var e = d && Ia(a);
					return Wa(a, c, d ? Xa(a, b, d, k.boxSizing && "border-box" === m.css(a, "boxSizing", !1, e), e) : 0)
				}
			}
		}), k.opacity || (m.cssHooks.opacity = {
			get: function (a, b) {
				return Na.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : ""
			}, set: function (a, b) {
				var c = a.style, d = a.currentStyle, e = m.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "", f = d && d.filter || c.filter || "";
				c.zoom = 1, (b >= 1 || "" === b) && "" === m.trim(f.replace(Ma, "")) && c.removeAttribute && (c.removeAttribute("filter"), "" === b || d && !d.filter) || (c.filter = Ma.test(f) ? f.replace(Ma, e) : f + " " + e)
			}
		}), m.cssHooks.marginRight = La(k.reliableMarginRight, function (a, b) {
			return b ? m.swap(a, {display: "inline-block"}, Ja, [a, "marginRight"]) : void 0
		}), m.each({margin: "", padding: "", border: "Width"}, function (a, b) {
			m.cssHooks[a + b] = {
				expand: function (c) {
					for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++)e[a + T[d] + b] = f[d] || f[d - 2] || f[0];
					return e
				}
			}, Ga.test(a) || (m.cssHooks[a + b].set = Wa)
		}), m.fn.extend({
			css: function (a, b) {
				return V(this, function (a, b, c) {
					var d, e, f = {}, g = 0;
					if (m.isArray(b)) {
						for (d = Ia(a), e = b.length; e > g; g++)f[b[g]] = m.css(a, b[g], !1, d);
						return f
					}
					return void 0 !== c ? m.style(a, b, c) : m.css(a, b)
				}, a, b, arguments.length > 1)
			}, show: function () {
				return Va(this, !0)
			}, hide: function () {
				return Va(this)
			}, toggle: function (a) {
				return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function () {
					U(this) ? m(this).show() : m(this).hide()
				})
			}
		});
		function Za(a, b, c, d, e) {
			return new Za.prototype.init(a, b, c, d, e)
		}

		m.Tween = Za, Za.prototype = {
			constructor: Za, init: function (a, b, c, d, e, f) {
				this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (m.cssNumber[c] ? "" : "px")
			}, cur: function () {
				var a = Za.propHooks[this.prop];
				return a && a.get ? a.get(this) : Za.propHooks._default.get(this)
			}, run: function (a) {
				var b, c = Za.propHooks[this.prop];
				return this.options.duration ? this.pos = b = m.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Za.propHooks._default.set(this), this
			}
		}, Za.prototype.init.prototype = Za.prototype, Za.propHooks = {
			_default: {
				get: function (a) {
					var b;
					return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = m.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
				}, set: function (a) {
					m.fx.step[a.prop] ? m.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[m.cssProps[a.prop]] || m.cssHooks[a.prop]) ? m.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
				}
			}
		}, Za.propHooks.scrollTop = Za.propHooks.scrollLeft = {
			set: function (a) {
				a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
			}
		}, m.easing = {
			linear: function (a) {
				return a
			}, swing: function (a) {
				return .5 - Math.cos(a * Math.PI) / 2
			}
		}, m.fx = Za.prototype.init, m.fx.step = {};
		var $a, _a, ab = /^(?:toggle|show|hide)$/, bb = new RegExp("^(?:([+-])=|)(" + S + ")([a-z%]*)$", "i"), cb = /queueHooks$/, db = [ib], eb = {
			"*": [function (a, b) {
				var c = this.createTween(a, b), d = c.cur(), e = bb.exec(b), f = e && e[3] || (m.cssNumber[a] ? "" : "px"), g = (m.cssNumber[a] || "px" !== f && +d) && bb.exec(m.css(c.elem, a)), h = 1, i = 20;
				if (g && g[3] !== f) {
					f = f || g[3], e = e || [], g = +d || 1;
					do h = h || ".5", g /= h, m.style(c.elem, a, g + f); while (h !== (h = c.cur() / d) && 1 !== h && --i)
				}
				return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c
			}]
		};

		function fb() {
			return setTimeout(function () {
				$a = void 0
			}), $a = m.now()
		}

		function gb(a, b) {
			var c, d = {height: a}, e = 0;
			for (b = b ? 1 : 0; 4 > e; e += 2 - b)c = T[e], d["margin" + c] = d["padding" + c] = a;
			return b && (d.opacity = d.width = a), d
		}

		function hb(a, b, c) {
			for (var d, e = (eb[b] || []).concat(eb["*"]), f = 0, g = e.length; g > f; f++)if (d = e[f].call(c, b, a))return d
		}

		function ib(a, b, c) {
			var d, e, f, g, h, i, j, l, n = this, o = {}, p = a.style, q = a.nodeType && U(a), r = m._data(a, "fxshow");
			c.queue || (h = m._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function () {
				h.unqueued || i()
			}), h.unqueued++, n.always(function () {
				n.always(function () {
					h.unqueued--, m.queue(a, "fx").length || h.empty.fire()
				})
			})), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [p.overflow, p.overflowX, p.overflowY], j = m.css(a, "display"), l = "none" === j ? m._data(a, "olddisplay") || Fa(a.nodeName) : j, "inline" === l && "none" === m.css(a, "float") && (k.inlineBlockNeedsLayout && "inline" !== Fa(a.nodeName) ? p.zoom = 1 : p.display = "inline-block")), c.overflow && (p.overflow = "hidden", k.shrinkWrapBlocks() || n.always(function () {
				p.overflow = c.overflow[0], p.overflowX = c.overflow[1], p.overflowY = c.overflow[2]
			}));
			for (d in b)if (e = b[d], ab.exec(e)) {
				if (delete b[d], f = f || "toggle" === e, e === (q ? "hide" : "show")) {
					if ("show" !== e || !r || void 0 === r[d])continue;
					q = !0
				}
				o[d] = r && r[d] || m.style(a, d)
			} else j = void 0;
			if (m.isEmptyObject(o))"inline" === ("none" === j ? Fa(a.nodeName) : j) && (p.display = j); else {
				r ? "hidden" in r && (q = r.hidden) : r = m._data(a, "fxshow", {}), f && (r.hidden = !q), q ? m(a).show() : n.done(function () {
					m(a).hide()
				}), n.done(function () {
					var b;
					m._removeData(a, "fxshow");
					for (b in o)m.style(a, b, o[b])
				});
				for (d in o)g = hb(q ? r[d] : 0, d, n), d in r || (r[d] = g.start, q && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
			}
		}

		function jb(a, b) {
			var c, d, e, f, g;
			for (c in a)if (d = m.camelCase(c), e = b[d], f = a[c], m.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = m.cssHooks[d], g && "expand" in g) {
				f = g.expand(f), delete a[d];
				for (c in f)c in a || (a[c] = f[c], b[c] = e)
			} else b[d] = e
		}

		function kb(a, b, c) {
			var d, e, f = 0, g = db.length, h = m.Deferred().always(function () {
				delete i.elem
			}), i = function () {
				if (e)return !1;
				for (var b = $a || fb(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++)j.tweens[g].run(f);
				return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
			}, j = h.promise({
				elem: a,
				props: m.extend({}, b),
				opts: m.extend(!0, {specialEasing: {}}, c),
				originalProperties: b,
				originalOptions: c,
				startTime: $a || fb(),
				duration: c.duration,
				tweens: [],
				createTween: function (b, c) {
					var d = m.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
					return j.tweens.push(d), d
				},
				stop: function (b) {
					var c = 0, d = b ? j.tweens.length : 0;
					if (e)return this;
					for (e = !0; d > c; c++)j.tweens[c].run(1);
					return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
				}
			}), k = j.props;
			for (jb(k, j.opts.specialEasing); g > f; f++)if (d = db[f].call(j, a, k, j.opts))return d;
			return m.map(k, hb, j), m.isFunction(j.opts.start) && j.opts.start.call(a, j), m.fx.timer(m.extend(i, {
				elem: a,
				anim: j,
				queue: j.opts.queue
			})), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
		}

		m.Animation = m.extend(kb, {
			tweener: function (a, b) {
				m.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
				for (var c, d = 0, e = a.length; e > d; d++)c = a[d], eb[c] = eb[c] || [], eb[c].unshift(b)
			}, prefilter: function (a, b) {
				b ? db.unshift(a) : db.push(a)
			}
		}), m.speed = function (a, b, c) {
			var d = a && "object" == typeof a ? m.extend({}, a) : {
				complete: c || !c && b || m.isFunction(a) && a,
				duration: a,
				easing: c && b || b && !m.isFunction(b) && b
			};
			return d.duration = m.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in m.fx.speeds ? m.fx.speeds[d.duration] : m.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function () {
				m.isFunction(d.old) && d.old.call(this), d.queue && m.dequeue(this, d.queue)
			}, d
		}, m.fn.extend({
			fadeTo: function (a, b, c, d) {
				return this.filter(U).css("opacity", 0).show().end().animate({opacity: b}, a, c, d)
			}, animate: function (a, b, c, d) {
				var e = m.isEmptyObject(a), f = m.speed(b, c, d), g = function () {
					var b = kb(this, m.extend({}, a), f);
					(e || m._data(this, "finish")) && b.stop(!0)
				};
				return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
			}, stop: function (a, b, c) {
				var d = function (a) {
					var b = a.stop;
					delete a.stop, b(c)
				};
				return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function () {
					var b = !0, e = null != a && a + "queueHooks", f = m.timers, g = m._data(this);
					if (e)g[e] && g[e].stop && d(g[e]); else for (e in g)g[e] && g[e].stop && cb.test(e) && d(g[e]);
					for (e = f.length; e--;)f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
					(b || !c) && m.dequeue(this, a)
				})
			}, finish: function (a) {
				return a !== !1 && (a = a || "fx"), this.each(function () {
					var b, c = m._data(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = m.timers, g = d ? d.length : 0;
					for (c.finish = !0, m.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;)f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
					for (b = 0; g > b; b++)d[b] && d[b].finish && d[b].finish.call(this);
					delete c.finish
				})
			}
		}), m.each(["toggle", "show", "hide"], function (a, b) {
			var c = m.fn[b];
			m.fn[b] = function (a, d, e) {
				return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(gb(b, !0), a, d, e)
			}
		}), m.each({
			slideDown: gb("show"),
			slideUp: gb("hide"),
			slideToggle: gb("toggle"),
			fadeIn: {opacity: "show"},
			fadeOut: {opacity: "hide"},
			fadeToggle: {opacity: "toggle"}
		}, function (a, b) {
			m.fn[a] = function (a, c, d) {
				return this.animate(b, a, c, d)
			}
		}), m.timers = [], m.fx.tick = function () {
			var a, b = m.timers, c = 0;
			for ($a = m.now(); c < b.length; c++)a = b[c], a() || b[c] !== a || b.splice(c--, 1);
			b.length || m.fx.stop(), $a = void 0
		}, m.fx.timer = function (a) {
			m.timers.push(a), a() ? m.fx.start() : m.timers.pop()
		}, m.fx.interval = 13, m.fx.start = function () {
			_a || (_a = setInterval(m.fx.tick, m.fx.interval))
		}, m.fx.stop = function () {
			clearInterval(_a), _a = null
		}, m.fx.speeds = {slow: 600, fast: 200, _default: 400}, m.fn.delay = function (a, b) {
			return a = m.fx ? m.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function (b, c) {
				var d = setTimeout(b, a);
				c.stop = function () {
					clearTimeout(d)
				}
			})
		}, function () {
			var a, b, c, d, e;
			b = y.createElement("div"), b.setAttribute("className", "t"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", d = b.getElementsByTagName("a")[0], c = y.createElement("select"), e = c.appendChild(y.createElement("option")), a = b.getElementsByTagName("input")[0], d.style.cssText = "top:1px", k.getSetAttribute = "t" !== b.className, k.style = /top/.test(d.getAttribute("style")), k.hrefNormalized = "/a" === d.getAttribute("href"), k.checkOn = !!a.value, k.optSelected = e.selected, k.enctype = !!y.createElement("form").enctype, c.disabled = !0, k.optDisabled = !e.disabled, a = y.createElement("input"), a.setAttribute("value", ""), k.input = "" === a.getAttribute("value"), a.value = "t", a.setAttribute("type", "radio"), k.radioValue = "t" === a.value
		}();
		var lb = /\r/g;
		m.fn.extend({
			val: function (a) {
				var b, c, d, e = this[0];
				{
					if (arguments.length)return d = m.isFunction(a), this.each(function (c) {
						var e;
						1 === this.nodeType && (e = d ? a.call(this, c, m(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : m.isArray(e) && (e = m.map(e, function (a) {
							return null == a ? "" : a + ""
						})), b = m.valHooks[this.type] || m.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e))
					});
					if (e)return b = m.valHooks[e.type] || m.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(lb, "") : null == c ? "" : c)
				}
			}
		}), m.extend({
			valHooks: {
				option: {
					get: function (a) {
						var b = m.find.attr(a, "value");
						return null != b ? b : m.trim(m.text(a))
					}
				}, select: {
					get: function (a) {
						for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)if (c = d[i], !(!c.selected && i !== e || (k.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && m.nodeName(c.parentNode, "optgroup"))) {
							if (b = m(c).val(), f)return b;
							g.push(b)
						}
						return g
					}, set: function (a, b) {
						var c, d, e = a.options, f = m.makeArray(b), g = e.length;
						while (g--)if (d = e[g], m.inArray(m.valHooks.option.get(d), f) >= 0)try {
							d.selected = c = !0
						} catch (h) {
							d.scrollHeight
						} else d.selected = !1;
						return c || (a.selectedIndex = -1), e
					}
				}
			}
		}), m.each(["radio", "checkbox"], function () {
			m.valHooks[this] = {
				set: function (a, b) {
					return m.isArray(b) ? a.checked = m.inArray(m(a).val(), b) >= 0 : void 0
				}
			}, k.checkOn || (m.valHooks[this].get = function (a) {
				return null === a.getAttribute("value") ? "on" : a.value
			})
		});
		var mb, nb, ob = m.expr.attrHandle, pb = /^(?:checked|selected)$/i, qb = k.getSetAttribute, rb = k.input;
		m.fn.extend({
			attr: function (a, b) {
				return V(this, m.attr, a, b, arguments.length > 1)
			}, removeAttr: function (a) {
				return this.each(function () {
					m.removeAttr(this, a)
				})
			}
		}), m.extend({
			attr: function (a, b, c) {
				var d, e, f = a.nodeType;
				if (a && 3 !== f && 8 !== f && 2 !== f)return typeof a.getAttribute === K ? m.prop(a, b, c) : (1 === f && m.isXMLDoc(a) || (b = b.toLowerCase(), d = m.attrHooks[b] || (m.expr.match.bool.test(b) ? nb : mb)), void 0 === c ? d && "get" in d && null !== (e = d.get(a, b)) ? e : (e = m.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set" in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void m.removeAttr(a, b))
			}, removeAttr: function (a, b) {
				var c, d, e = 0, f = b && b.match(E);
				if (f && 1 === a.nodeType)while (c = f[e++])d = m.propFix[c] || c, m.expr.match.bool.test(c) ? rb && qb || !pb.test(c) ? a[d] = !1 : a[m.camelCase("default-" + c)] = a[d] = !1 : m.attr(a, c, ""), a.removeAttribute(qb ? c : d)
			}, attrHooks: {
				type: {
					set: function (a, b) {
						if (!k.radioValue && "radio" === b && m.nodeName(a, "input")) {
							var c = a.value;
							return a.setAttribute("type", b), c && (a.value = c), b
						}
					}
				}
			}
		}), nb = {
			set: function (a, b, c) {
				return b === !1 ? m.removeAttr(a, c) : rb && qb || !pb.test(c) ? a.setAttribute(!qb && m.propFix[c] || c, c) : a[m.camelCase("default-" + c)] = a[c] = !0, c
			}
		}, m.each(m.expr.match.bool.source.match(/\w+/g), function (a, b) {
			var c = ob[b] || m.find.attr;
			ob[b] = rb && qb || !pb.test(b) ? function (a, b, d) {
				var e, f;
				return d || (f = ob[b], ob[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, ob[b] = f), e
			} : function (a, b, c) {
				return c ? void 0 : a[m.camelCase("default-" + b)] ? b.toLowerCase() : null
			}
		}), rb && qb || (m.attrHooks.value = {
			set: function (a, b, c) {
				return m.nodeName(a, "input") ? void(a.defaultValue = b) : mb && mb.set(a, b, c)
			}
		}), qb || (mb = {
			set: function (a, b, c) {
				var d = a.getAttributeNode(c);
				return d || a.setAttributeNode(d = a.ownerDocument.createAttribute(c)), d.value = b += "", "value" === c || b === a.getAttribute(c) ? b : void 0
			}
		}, ob.id = ob.name = ob.coords = function (a, b, c) {
			var d;
			return c ? void 0 : (d = a.getAttributeNode(b)) && "" !== d.value ? d.value : null
		}, m.valHooks.button = {
			get: function (a, b) {
				var c = a.getAttributeNode(b);
				return c && c.specified ? c.value : void 0
			}, set: mb.set
		}, m.attrHooks.contenteditable = {
			set: function (a, b, c) {
				mb.set(a, "" === b ? !1 : b, c)
			}
		}, m.each(["width", "height"], function (a, b) {
			m.attrHooks[b] = {
				set: function (a, c) {
					return "" === c ? (a.setAttribute(b, "auto"), c) : void 0
				}
			}
		})), k.style || (m.attrHooks.style = {
			get: function (a) {
				return a.style.cssText || void 0
			}, set: function (a, b) {
				return a.style.cssText = b + ""
			}
		});
		var sb = /^(?:input|select|textarea|button|object)$/i, tb = /^(?:a|area)$/i;
		m.fn.extend({
			prop: function (a, b) {
				return V(this, m.prop, a, b, arguments.length > 1)
			}, removeProp: function (a) {
				return a = m.propFix[a] || a, this.each(function () {
					try {
						this[a] = void 0, delete this[a]
					} catch (b) {
					}
				})
			}
		}), m.extend({
			propFix: {"for": "htmlFor", "class": "className"}, prop: function (a, b, c) {
				var d, e, f, g = a.nodeType;
				if (a && 3 !== g && 8 !== g && 2 !== g)return f = 1 !== g || !m.isXMLDoc(a), f && (b = m.propFix[b] || b, e = m.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b]
			}, propHooks: {
				tabIndex: {
					get: function (a) {
						var b = m.find.attr(a, "tabindex");
						return b ? parseInt(b, 10) : sb.test(a.nodeName) || tb.test(a.nodeName) && a.href ? 0 : -1
					}
				}
			}
		}), k.hrefNormalized || m.each(["href", "src"], function (a, b) {
			m.propHooks[b] = {
				get: function (a) {
					return a.getAttribute(b, 4)
				}
			}
		}), k.optSelected || (m.propHooks.selected = {
			get: function (a) {
				var b = a.parentNode;
				return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null
			}
		}), m.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
			m.propFix[this.toLowerCase()] = this
		}), k.enctype || (m.propFix.enctype = "encoding");
		var ub = /[\t\r\n\f]/g;
		m.fn.extend({
			addClass: function (a) {
				var b, c, d, e, f, g, h = 0, i = this.length, j = "string" == typeof a && a;
				if (m.isFunction(a))return this.each(function (b) {
					m(this).addClass(a.call(this, b, this.className))
				});
				if (j)for (b = (a || "").match(E) || []; i > h; h++)if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ub, " ") : " ")) {
					f = 0;
					while (e = b[f++])d.indexOf(" " + e + " ") < 0 && (d += e + " ");
					g = m.trim(d), c.className !== g && (c.className = g)
				}
				return this
			}, removeClass: function (a) {
				var b, c, d, e, f, g, h = 0, i = this.length, j = 0 === arguments.length || "string" == typeof a && a;
				if (m.isFunction(a))return this.each(function (b) {
					m(this).removeClass(a.call(this, b, this.className))
				});
				if (j)for (b = (a || "").match(E) || []; i > h; h++)if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(ub, " ") : "")) {
					f = 0;
					while (e = b[f++])while (d.indexOf(" " + e + " ") >= 0)d = d.replace(" " + e + " ", " ");
					g = a ? m.trim(d) : "", c.className !== g && (c.className = g)
				}
				return this
			}, toggleClass: function (a, b) {
				var c = typeof a;
				return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(m.isFunction(a) ? function (c) {
					m(this).toggleClass(a.call(this, c, this.className, b), b)
				} : function () {
					if ("string" === c) {
						var b, d = 0, e = m(this), f = a.match(E) || [];
						while (b = f[d++])e.hasClass(b) ? e.removeClass(b) : e.addClass(b)
					} else(c === K || "boolean" === c) && (this.className && m._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : m._data(this, "__className__") || "")
				})
			}, hasClass: function (a) {
				for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(ub, " ").indexOf(b) >= 0)return !0;
				return !1
			}
		}), m.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) {
			m.fn[b] = function (a, c) {
				return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
			}
		}), m.fn.extend({
			hover: function (a, b) {
				return this.mouseenter(a).mouseleave(b || a)
			}, bind: function (a, b, c) {
				return this.on(a, null, b, c)
			}, unbind: function (a, b) {
				return this.off(a, null, b)
			}, delegate: function (a, b, c, d) {
				return this.on(b, a, c, d)
			}, undelegate: function (a, b, c) {
				return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
			}
		});
		var vb = m.now(), wb = /\?/, xb = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
		m.parseJSON = function (b) {
			if (a.JSON && a.JSON.parse)return a.JSON.parse(b + "");
			var c, d = null, e = m.trim(b + "");
			return e && !m.trim(e.replace(xb, function (a, b, e, f) {
				return c && b && (d = 0), 0 === d ? a : (c = e || b, d += !f - !e, "")
			})) ? Function("return " + e)() : m.error("Invalid JSON: " + b)
		}, m.parseXML = function (b) {
			var c, d;
			if (!b || "string" != typeof b)return null;
			try {
				a.DOMParser ? (d = new DOMParser, c = d.parseFromString(b, "text/xml")) : (c = new ActiveXObject("Microsoft.XMLDOM"), c.async = "false", c.loadXML(b))
			} catch (e) {
				c = void 0
			}
			return c && c.documentElement && !c.getElementsByTagName("parsererror").length || m.error("Invalid XML: " + b), c
		};
		var yb, zb, Ab = /#.*$/, Bb = /([?&])_=[^&]*/, Cb = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm, Db = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Eb = /^(?:GET|HEAD)$/, Fb = /^\/\//, Gb = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, Hb = {}, Ib = {}, Jb = "*/".concat("*");
		try {
			zb = location.href
		} catch (Kb) {
			zb = y.createElement("a"), zb.href = "", zb = zb.href
		}
		yb = Gb.exec(zb.toLowerCase()) || [];
		function Lb(a) {
			return function (b, c) {
				"string" != typeof b && (c = b, b = "*");
				var d, e = 0, f = b.toLowerCase().match(E) || [];
				if (m.isFunction(c))while (d = f[e++])"+" === d.charAt(0) ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
			}
		}

		function Mb(a, b, c, d) {
			var e = {}, f = a === Ib;

			function g(h) {
				var i;
				return e[h] = !0, m.each(a[h] || [], function (a, h) {
					var j = h(b, c, d);
					return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
				}), i
			}

			return g(b.dataTypes[0]) || !e["*"] && g("*")
		}

		function Nb(a, b) {
			var c, d, e = m.ajaxSettings.flatOptions || {};
			for (d in b)void 0 !== b[d] && ((e[d] ? a : c || (c = {}))[d] = b[d]);
			return c && m.extend(!0, a, c), a
		}

		function Ob(a, b, c) {
			var d, e, f, g, h = a.contents, i = a.dataTypes;
			while ("*" === i[0])i.shift(), void 0 === e && (e = a.mimeType || b.getResponseHeader("Content-Type"));
			if (e)for (g in h)if (h[g] && h[g].test(e)) {
				i.unshift(g);
				break
			}
			if (i[0] in c)f = i[0]; else {
				for (g in c) {
					if (!i[0] || a.converters[g + " " + i[0]]) {
						f = g;
						break
					}
					d || (d = g)
				}
				f = f || d
			}
			return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
		}

		function Pb(a, b, c, d) {
			var e, f, g, h, i, j = {}, k = a.dataTypes.slice();
			if (k[1])for (g in a.converters)j[g.toLowerCase()] = a.converters[g];
			f = k.shift();
			while (f)if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())if ("*" === f)f = i; else if ("*" !== i && i !== f) {
				if (g = j[i + " " + f] || j["* " + f], !g)for (e in j)if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
					g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
					break
				}
				if (g !== !0)if (g && a["throws"])b = g(b); else try {
					b = g(b)
				} catch (l) {
					return {state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f}
				}
			}
			return {state: "success", data: b}
		}

		m.extend({
			active: 0,
			lastModified: {},
			etag: {},
			ajaxSettings: {
				url: zb,
				type: "GET",
				isLocal: Db.test(yb[1]),
				global: !0,
				processData: !0,
				async: !0,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				accepts: {
					"*": Jb,
					text: "text/plain",
					html: "text/html",
					xml: "application/xml, text/xml",
					json: "application/json, text/javascript"
				},
				contents: {xml: /xml/, html: /html/, json: /json/},
				responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"},
				converters: {"* text": String, "text html": !0, "text json": m.parseJSON, "text xml": m.parseXML},
				flatOptions: {url: !0, context: !0}
			},
			ajaxSetup: function (a, b) {
				return b ? Nb(Nb(a, m.ajaxSettings), b) : Nb(m.ajaxSettings, a)
			},
			ajaxPrefilter: Lb(Hb),
			ajaxTransport: Lb(Ib),
			ajax: function (a, b) {
				"object" == typeof a && (b = a, a = void 0), b = b || {};
				var c, d, e, f, g, h, i, j, k = m.ajaxSetup({}, b), l = k.context || k, n = k.context && (l.nodeType || l.jq) ? m(l) : m.event, o = m.Deferred(), p = m.Callbacks("once memory"), q = k.statusCode || {}, r = {}, s = {}, t = 0, u = "canceled", v = {
					readyState: 0,
					getResponseHeader: function (a) {
						var b;
						if (2 === t) {
							if (!j) {
								j = {};
								while (b = Cb.exec(f))j[b[1].toLowerCase()] = b[2]
							}
							b = j[a.toLowerCase()]
						}
						return null == b ? null : b
					},
					getAllResponseHeaders: function () {
						return 2 === t ? f : null
					},
					setRequestHeader: function (a, b) {
						var c = a.toLowerCase();
						return t || (a = s[c] = s[c] || a, r[a] = b), this
					},
					overrideMimeType: function (a) {
						return t || (k.mimeType = a), this
					},
					statusCode: function (a) {
						var b;
						if (a)if (2 > t)for (b in a)q[b] = [q[b], a[b]]; else v.always(a[v.status]);
						return this
					},
					abort: function (a) {
						var b = a || u;
						return i && i.abort(b), x(0, b), this
					}
				};
				if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || zb) + "").replace(Ab, "").replace(Fb, yb[1] + "//"), k.type = b.method || b.type || k.method || k.type, k.dataTypes = m.trim(k.dataType || "*").toLowerCase().match(E) || [""], null == k.crossDomain && (c = Gb.exec(k.url.toLowerCase()), k.crossDomain = !(!c || c[1] === yb[1] && c[2] === yb[2] && (c[3] || ("http:" === c[1] ? "80" : "443")) === (yb[3] || ("http:" === yb[1] ? "80" : "443")))), k.data && k.processData && "string" != typeof k.data && (k.data = m.param(k.data, k.traditional)), Mb(Hb, k, b, v), 2 === t)return v;
				h = m.event && k.global, h && 0 === m.active++ && m.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), k.hasContent = !Eb.test(k.type), e = k.url, k.hasContent || (k.data && (e = k.url += (wb.test(e) ? "&" : "?") + k.data, delete k.data), k.cache === !1 && (k.url = Bb.test(e) ? e.replace(Bb, "$1_=" + vb++) : e + (wb.test(e) ? "&" : "?") + "_=" + vb++)), k.ifModified && (m.lastModified[e] && v.setRequestHeader("If-Modified-Since", m.lastModified[e]), m.etag[e] && v.setRequestHeader("If-None-Match", m.etag[e])), (k.data && k.hasContent && k.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + Jb + "; q=0.01" : "") : k.accepts["*"]);
				for (d in k.headers)v.setRequestHeader(d, k.headers[d]);
				if (k.beforeSend && (k.beforeSend.call(l, v, k) === !1 || 2 === t))return v.abort();
				u = "abort";
				for (d in{success: 1, error: 1, complete: 1})v[d](k[d]);
				if (i = Mb(Ib, k, b, v)) {
					v.readyState = 1, h && n.trigger("ajaxSend", [v, k]), k.async && k.timeout > 0 && (g = setTimeout(function () {
						v.abort("timeout")
					}, k.timeout));
					try {
						t = 1, i.send(r, x)
					} catch (w) {
						if (!(2 > t))throw w;
						x(-1, w)
					}
				} else x(-1, "No Transport");
				function x(a, b, c, d) {
					var j, r, s, u, w, x = b;
					2 !== t && (t = 2, g && clearTimeout(g), i = void 0, f = d || "", v.readyState = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, c && (u = Ob(k, v, c)), u = Pb(k, u, v, j), j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (m.lastModified[e] = w), w = v.getResponseHeader("etag"), w && (m.etag[e] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v.statusCode(q), q = void 0, h && n.trigger(j ? "ajaxSuccess" : "ajaxError", [v, k, j ? r : s]), p.fireWith(l, [v, x]), h && (n.trigger("ajaxComplete", [v, k]), --m.active || m.event.trigger("ajaxStop")))
				}

				return v
			},
			getJSON: function (a, b, c) {
				return m.get(a, b, c, "json")
			},
			getScript: function (a, b) {
				return m.get(a, void 0, b, "script")
			}
		}), m.each(["get", "post"], function (a, b) {
			m[b] = function (a, c, d, e) {
				return m.isFunction(c) && (e = e || d, d = c, c = void 0), m.ajax({
					url: a,
					type: b,
					dataType: e,
					data: c,
					success: d
				})
			}
		}), m._evalUrl = function (a) {
			return m.ajax({url: a, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
		}, m.fn.extend({
			wrapAll: function (a) {
				if (m.isFunction(a))return this.each(function (b) {
					m(this).wrapAll(a.call(this, b))
				});
				if (this[0]) {
					var b = m(a, this[0].ownerDocument).eq(0).clone(!0);
					this[0].parentNode && b.insertBefore(this[0]), b.map(function () {
						var a = this;
						while (a.firstChild && 1 === a.firstChild.nodeType)a = a.firstChild;
						return a
					}).append(this)
				}
				return this
			}, wrapInner: function (a) {
				return this.each(m.isFunction(a) ? function (b) {
					m(this).wrapInner(a.call(this, b))
				} : function () {
					var b = m(this), c = b.contents();
					c.length ? c.wrapAll(a) : b.append(a)
				})
			}, wrap: function (a) {
				var b = m.isFunction(a);
				return this.each(function (c) {
					m(this).wrapAll(b ? a.call(this, c) : a)
				})
			}, unwrap: function () {
				return this.parent().each(function () {
					m.nodeName(this, "body") || m(this).replaceWith(this.childNodes)
				}).end()
			}
		}), m.expr.filters.hidden = function (a) {
			return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !k.reliableHiddenOffsets() && "none" === (a.style && a.style.display || m.css(a, "display"))
		}, m.expr.filters.visible = function (a) {
			return !m.expr.filters.hidden(a)
		};
		var Qb = /%20/g, Rb = /\[\]$/, Sb = /\r?\n/g, Tb = /^(?:submit|button|image|reset|file)$/i, Ub = /^(?:input|select|textarea|keygen)/i;

		function Vb(a, b, c, d) {
			var e;
			if (m.isArray(b))m.each(b, function (b, e) {
				c || Rb.test(a) ? d(a, e) : Vb(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
			}); else if (c || "object" !== m.type(b))d(a, b); else for (e in b)Vb(a + "[" + e + "]", b[e], c, d)
		}

		m.param = function (a, b) {
			var c, d = [], e = function (a, b) {
				b = m.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
			};
			if (void 0 === b && (b = m.ajaxSettings && m.ajaxSettings.traditional), m.isArray(a) || a.jq && !m.isPlainObject(a))m.each(a, function () {
				e(this.name, this.value)
			}); else for (c in a)Vb(c, a[c], b, e);
			return d.join("&").replace(Qb, "+")
		}, m.fn.extend({
			serialize: function () {
				return m.param(this.serializeArray())
			}, serializeArray: function () {
				return this.map(function () {
					var a = m.prop(this, "elements");
					return a ? m.makeArray(a) : this
				}).filter(function () {
					var a = this.type;
					return this.name && !m(this).is(":disabled") && Ub.test(this.nodeName) && !Tb.test(a) && (this.checked || !W.test(a))
				}).map(function (a, b) {
					var c = m(this).val();
					return null == c ? null : m.isArray(c) ? m.map(c, function (a) {
						return {name: b.name, value: a.replace(Sb, "\r\n")}
					}) : {name: b.name, value: c.replace(Sb, "\r\n")}
				}).get()
			}
		}), m.ajaxSettings.xhr = void 0 !== a.ActiveXObject ? function () {
			return !this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && Zb() || $b()
		} : Zb;
		var Wb = 0, Xb = {}, Yb = m.ajaxSettings.xhr();
		a.attachEvent && a.attachEvent("onunload", function () {
			for (var a in Xb)Xb[a](void 0, !0)
		}), k.cors = !!Yb && "withCredentials" in Yb, Yb = k.ajax = !!Yb, Yb && m.ajaxTransport(function (a) {
			if (!a.crossDomain || k.cors) {
				var b;
				return {
					send: function (c, d) {
						var e, f = a.xhr(), g = ++Wb;
						if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields)for (e in a.xhrFields)f[e] = a.xhrFields[e];
						a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
						for (e in c)void 0 !== c[e] && f.setRequestHeader(e, c[e] + "");
						f.send(a.hasContent && a.data || null), b = function (c, e) {
							var h, i, j;
							if (b && (e || 4 === f.readyState))if (delete Xb[g], b = void 0, f.onreadystatechange = m.noop, e)4 !== f.readyState && f.abort(); else {
								j = {}, h = f.status, "string" == typeof f.responseText && (j.text = f.responseText);
								try {
									i = f.statusText
								} catch (k) {
									i = ""
								}
								h || !a.isLocal || a.crossDomain ? 1223 === h && (h = 204) : h = j.text ? 200 : 404
							}
							j && d(h, i, j, f.getAllResponseHeaders())
						}, a.async ? 4 === f.readyState ? setTimeout(b) : f.onreadystatechange = Xb[g] = b : b()
					}, abort: function () {
						b && b(void 0, !0)
					}
				}
			}
		});
		function Zb() {
			try {
				return new a.XMLHttpRequest
			} catch (b) {
			}
		}

		function $b() {
			try {
				return new a.ActiveXObject("Microsoft.XMLHTTP")
			} catch (b) {
			}
		}

		m.ajaxSetup({
			accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},
			contents: {script: /(?:java|ecma)script/},
			converters: {
				"text script": function (a) {
					return m.globalEval(a), a
				}
			}
		}), m.ajaxPrefilter("script", function (a) {
			void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
		}), m.ajaxTransport("script", function (a) {
			if (a.crossDomain) {
				var b, c = y.head || m("head")[0] || y.documentElement;
				return {
					send: function (d, e) {
						b = y.createElement("script"), b.async = !0, a.scriptCharset && (b.charset = a.scriptCharset), b.src = a.url, b.onload = b.onreadystatechange = function (a, c) {
							(c || !b.readyState || /loaded|complete/.test(b.readyState)) && (b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b), b = null, c || e(200, "success"))
						}, c.insertBefore(b, c.firstChild)
					}, abort: function () {
						b && b.onload(void 0, !0)
					}
				}
			}
		});
		var _b = [], ac = /(=)\?(?=&|$)|\?\?/;
		m.ajaxSetup({
			jsonp: "callback", jsonpCallback: function () {
				var a = _b.pop() || m.expando + "_" + vb++;
				return this[a] = !0, a
			}
		}), m.ajaxPrefilter("json jsonp", function (b, c, d) {
			var e, f, g, h = b.jsonp !== !1 && (ac.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && ac.test(b.data) && "data");
			return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = m.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(ac, "$1" + e) : b.jsonp !== !1 && (b.url += (wb.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function () {
				return g || m.error(e + " was not called"), g[0]
			}, b.dataTypes[0] = "json", f = a[e], a[e] = function () {
				g = arguments
			}, d.always(function () {
				a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, _b.push(e)), g && m.isFunction(f) && f(g[0]), g = f = void 0
			}), "script") : void 0
		}), m.parseHTML = function (a, b, c) {
			if (!a || "string" != typeof a)return null;
			"boolean" == typeof b && (c = b, b = !1), b = b || y;
			var d = u.exec(a), e = !c && [];
			return d ? [b.createElement(d[1])] : (d = m.buildFragment([a], b, e), e && e.length && m(e).remove(), m.merge([], d.childNodes))
		};
		var bc = m.fn.load;
		m.fn.load = function (a, b, c) {
			if ("string" != typeof a && bc)return bc.apply(this, arguments);
			var d, e, f, g = this, h = a.indexOf(" ");
			return h >= 0 && (d = m.trim(a.slice(h, a.length)), a = a.slice(0, h)), m.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (f = "POST"), g.length > 0 && m.ajax({
				url: a,
				type: f,
				dataType: "html",
				data: b
			}).done(function (a) {
				e = arguments, g.html(d ? m("<div>").append(m.parseHTML(a)).find(d) : a)
			}).complete(c && function (a, b) {
					g.each(c, e || [a.responseText, b, a])
				}), this
		}, m.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (a, b) {
			m.fn[b] = function (a) {
				return this.on(b, a)
			}
		}), m.expr.filters.animated = function (a) {
			return m.grep(m.timers, function (b) {
				return a === b.elem
			}).length
		};
		var cc = a.document.documentElement;

		function dc(a) {
			return m.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1
		}

		m.offset = {
			setOffset: function (a, b, c) {
				var d, e, f, g, h, i, j, k = m.css(a, "position"), l = m(a), n = {};
				"static" === k && (a.style.position = "relative"), h = l.offset(), f = m.css(a, "top"), i = m.css(a, "left"), j = ("absolute" === k || "fixed" === k) && m.inArray("auto", [f, i]) > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), m.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (n.top = b.top - h.top + g), null != b.left && (n.left = b.left - h.left + e), "using" in b ? b.using.call(a, n) : l.css(n)
			}
		}, m.fn.extend({
			offset: function (a) {
				if (arguments.length)return void 0 === a ? this : this.each(function (b) {
					m.offset.setOffset(this, a, b)
				});
				var b, c, d = {top: 0, left: 0}, e = this[0], f = e && e.ownerDocument;
				if (f)return b = f.documentElement, m.contains(b, e) ? (typeof e.getBoundingClientRect !== K && (d = e.getBoundingClientRect()), c = dc(f), {
					top: d.top + (c.pageYOffset || b.scrollTop) - (b.clientTop || 0),
					left: d.left + (c.pageXOffset || b.scrollLeft) - (b.clientLeft || 0)
				}) : d
			}, position: function () {
				if (this[0]) {
					var a, b, c = {top: 0, left: 0}, d = this[0];
					return "fixed" === m.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), m.nodeName(a[0], "html") || (c = a.offset()), c.top += m.css(a[0], "borderTopWidth", !0), c.left += m.css(a[0], "borderLeftWidth", !0)), {
						top: b.top - c.top - m.css(d, "marginTop", !0),
						left: b.left - c.left - m.css(d, "marginLeft", !0)
					}
				}
			}, offsetParent: function () {
				return this.map(function () {
					var a = this.offsetParent || cc;
					while (a && !m.nodeName(a, "html") && "static" === m.css(a, "position"))a = a.offsetParent;
					return a || cc
				})
			}
		}), m.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function
			(a, b) {
			var c = /Y/.test(b);
			m.fn[a] = function (d) {
				return V(this, function (a, d, e) {
					var f = dc(a);
					return void 0 === e ? f ? b in f ? f[b] : f.document.documentElement[d] : a[d] : void(f ? f.scrollTo(c ? m(f).scrollLeft() : e, c ? e : m(f).scrollTop()) : a[d] = e)
				}, a, d, arguments.length, null)
			}
		}), m.each(["top", "left"], function (a, b) {
			m.cssHooks[b] = La(k.pixelPosition, function (a, c) {
				return c ? (c = Ja(a, b), Ha.test(c) ? m(a).position()[b] + "px" : c) : void 0
			})
		}), m.each({Height: "height", Width: "width"},
			function (a, b) {
				m.each({padding: "inner" + a, content: b, "": "outer" + a}, function (c, d) {
					m.fn[d] = function (d, e) {
						var f = arguments.length && (c || "boolean" != typeof d), g = c || (d === !0 || e === !0 ? "margin" : "border");
						return V(this, function (b, c, d) {
							var e;
							return m.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? m.css(b, c, g) : m.style(b, c, d, g)
						}, b, f ? d : void 0, f, null)
					}
				})
			}), m.fn.size = function () {
			return this.length
		}, m.fn.andSelf = m.fn.addBack, "function" == typeof
			define && define.amd && define("jq", [], function () {
			return m
		});

		var ec = a.jq, fc = a.$;

		return m.noConflict = function (b) {
			return a.$ === m && (a.$ = fc), b && a.jq === m && (a.jq = ec), m
		}, typeof b === K && (a.jq = a.$ = m), m


	})(window,!0);
	function PozvonimcomWidgetEvent(type, message, context, exception) {
		context = context || {};
		if (type == PozvonimcomWidgetEvent.prototype.TYPE.ERROR) {
			context.columnNumber = exception.columnNumber || null;
			context.fileName = exception.fileName || null;
			context.lineNumber = exception.lineNumber || null;
			context.message = exception.message || null;
			context.name = exception.name || null;
			context.stack = exception.stack || null;
		}
		context.version = '1.0.1';
		context.userAgent = navigator.userAgent;
		if (typeof window.PozvonimcomWidgetRootConfig !== 'undefined') {
			var config = jq.extend({}, window.PozvonimcomWidgetRootConfig);
			delete config.ready;
			delete config.onReady;
			delete config.window_style;
			delete config.window_text;
			delete config.schelude;
			delete config.prefixes;
			context.widget = config;
		}
		jq.ajax({
			url: PozvonimcomWidgetRootConfig.apiPath + '',
			data: {type: type, message: message, context: context, action: 'callback', exec: 'event'},
			method: 'POST',
			async: true,
			cache: false,
			timeout: 30000,
			dataType: 'json',
			xhrFields: {withCredentials: true},
			crossDomain: true
		});
	}
	PozvonimcomWidgetEvent.prototype.TYPE = {
		"REQUEST": 1,
		"LOADED": 2,
		"ERROR": 3,
		"OPENED": 4,
		"CALL": 5,
		"LOG": 6,
		"EVENT": 7
	};
	function PozvonimcomWidgetPrototype(window, document, jq) {
		var JSON;
		(function ($) {
			$.extend({
				getCookie: function (name, def) {
					var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
					return matches ? decodeURIComponent(matches[1]) : def
				},
				setCookie: function (name, value, options) {
					options = options || {};
					if (typeof options.expires === 'number') {
						var days = options.expires, t = options.expires = new Date();
						t.setTime(+t + days * 864e+5);
					}
					return (document.cookie = [
						name, '=', encodeURIComponent(value),
						options.expires ? '; expires=' + options.expires.toUTCString() : '',
						options.path ? '; path=' + options.path : '/',
						options.domain ? '; domain=' + options.domain : '',
						options.secure ? '; secure' : ''
					].join(''));
				}
			});
		})(jq);
		(function ($) {
			var templateSettings = {
				evaluate: /<%([\s\S]+?)%>/g,
				interpolate: /<%=([\s\S]+?)%>/g,
				escape: /<%-([\s\S]+?)%>/g
			};
			var noMatch = /(.)^/;
			var escapes = {"'": "'", '\\': '\\', '\r': 'r', '\n': 'n', '\u2028': 'u2028', '\u2029': 'u2029'};
			var escapeRegExp = /\\|'|\r|\n|\u2028|\u2029/g;
			var escapeChar = function (match) {
				return '\\' + escapes[match];
			};
			$.extend({
				template: function (text, settings, oldSettings) {
					if (!settings && oldSettings) settings = oldSettings;
					settings = $.extend({}, settings, templateSettings);
					var matcher = new RegExp([
							(settings.escape || noMatch).source,
							(settings.interpolate || noMatch).source,
							(settings.evaluate || noMatch).source
						].join('|') + '|$', 'g');
					var index = 0;
					var source = "__p+='";
					text.replace(matcher, function (match, escape, interpolate, evaluate, offset) {
						source += text.slice(index, offset).replace(escapeRegExp, escapeChar);
						index = offset + match.length;
						if (escape) {
							source += "'+\n((__t=(" + escape + "))==null?'':_.escape(__t))+\n'";
						} else if (interpolate) {
							source += "'+\n((__t=(" + interpolate + "))==null?'':__t)+\n'";
						} else if (evaluate) {
							source += "';\n" + evaluate + "\n__p+='";
						}
						return match;
					});
					source += "';\n";
					if (!settings.variable) source = 'with(obj||{}){\n' + source + '}\n';
					source = "var __t,__p='',__j=Array.prototype.join," +
						"print=function(){__p+=__j.call(arguments,'');};\n" +
						source + 'return __p;\n';
					var render;
					try {
						render = new Function(settings.variable || 'obj', '$', source);
					} catch (e) {
						e.source = source;
						throw e;
					}
					var template = function (data) {
						return render.call(this, data, $);
					};
					var argument = settings.variable || 'obj';
					template.source = 'function(' + argument + '){\n' + source + '}';
					return template;
				}
			});
		})(jq);
		(function ($) {
			$.fn.drags = function (opt){
				opt = $.extend({}, opt);
				var $window = $(window),
					$drag,
					width,
					height,
					x, y,
					animated = false,
					timer = false,
					move = function (e){
						if (timer === false){
							timer = window.setTimeout(function (){
								opt.move.apply($drag, [e]);
								timer = false;
							}, 100);
						}
						$drag.offset({top: e.pageY + y - height, left: e.pageX + x - width});
					},
					down = function (e){
						$drag = $(this).addClass('pozvonim-dragging');

						width = $drag.outerWidth();
						height = $drag.outerHeight();

						y = $drag.offset().top + height - e.pageY;
						x = $drag.offset().left + width - e.pageX;

						//animated = $drag.hasClass('pozvonim-animated');
						if (animated){
							//$drag.removeClass('pozvonim-animated');
						}
						opt.start.apply($drag, [e]);

						$window.on('mouseup', up);
						$window.on('mousemove', move);

						e.preventDefault();
					},
					up = function (e){
						$drag.removeClass('pozvonim-dragging');
						if (animated){
							//$drag.addClass('pozvonim-animated');
						}

						opt.stop.apply($drag, [e]);

						$window.off('mouseup', up);
						$window.off('mousemove', move);
					};

				return $(this).on('mousedown', down);

			}
		})(jq);
		(function ($) {
			$.extend({
				Utils: {
					padZero: function (num, size) {
						if (num.toString().length >= size) {
							return num;
						}
						return ( Math.pow(10, size) + Math.floor(num) ).toString().substring(1);
					},
					regexCheck: function (value, regexList) {
						var result = false,
							check = function (index, item) {
								if (value.match(item)) {
									result = true;
									return false;
								}
							};
						$.each(regexList, check);
						return result;
					},
					regexEscape: function (literal_string) {
						return literal_string.replace(/[-[\]{}()*+!<=:?.\/\\^$|#\s,]/g, '\\$&');
					},
					pluralDigits: function (number, options) {
						var config = [2, 0, 1, 1, 1, 2];
						number = Math.round(number);
						return options[
							number % 100 > 4 && 20 > number % 100 ?
								2 :
								config[5 > number % 10 ? number % 10 : 5]]
					},
					windowSize: function (window,document) {
						var w = window,
							d = document,
							e = d.documentElement,
							g = d.getElementsByTagName('body')[0],
							x = w.innerWidth || e.clientWidth || g.clientWidth,
							y = w.innerHeight || e.clientHeight || g.clientHeight;


						return {width: x, height: y};
					}
				}
			});
		})(jq);
		(function ($) {
			(function(a,b,c,d){"use strict";function e(b,c){this.element=b,this.options=a.extend({},h,c),this._defaults=h,this.ns="."+f+g++,this.isGoodBrowser=Boolean(b.setSelectionRange),this.hadInitialPlaceholder=Boolean(a(b).attr("placeholder")),this._name=f,this.init()}var f="intlTelInput",g=1,h={autoFormat:!0,autoHideDialCode:!0,defaultCountry:"",nationalMode:!1,numberType:"",onlyCountries:[],preferredCountries:["us","gb"],responsiveDropdown:!1,utilsScript:""},i={UP:38,DOWN:40,ENTER:13,ESC:27,PLUS:43,A:65,Z:90,ZERO:48,NINE:57,SPACE:32,BSPACE:8,DEL:46,CTRL:17,CMD1:91,CMD2:224},j=!1;a(b).load(function(){j=!0}),e.prototype={init:function(){var b=this;"auto"==this.options.defaultCountry?a.get("http://ipinfo.io",function(a){b.options.defaultCountry=a&&a.country?a.country.toLowerCase():"",b.ready()},"jsonp"):this.ready()},ready:function(){this.options.nationalMode&&(this.options.autoHideDialCode=!1),(navigator.userAgent.match(/IEMobile/i)||navigator.userAgent.match(/Android/i)&&navigator.userAgent.match(/Chrome/i))&&(this.options.autoFormat=!1),b.innerWidth<500&&(this.options.responsiveDropdown=!0),this._processCountryData(),this._generateMarkup(),this._setInitialState(),this._initListeners()},_processCountryData:function(){this._setInstanceCountryData(),this._setPreferredCountries()},_addCountryCode:function(a,b,c){b in this.countryCodes||(this.countryCodes[b]=[]);var d=c||0;this.countryCodes[b][d]=a},_setInstanceCountryData:function(){var a;if(this.options.onlyCountries.length)for(this.countries=[],a=0;a<this.options.onlyCountries.length;a++){var b=this._getCountryData(this.options.onlyCountries[a],!0,!1);b&&this.countries.push(b)}else this.countries=k;for(this.countryCodes={},a=0;a<this.countries.length;a++){var c=this.countries[a];if(this._addCountryCode(c.iso2,c.dialCode,c.priority),c.areaCodes)for(var d=0;d<c.areaCodes.length;d++)this._addCountryCode(c.iso2,c.dialCode+c.areaCodes[d])}},_setPreferredCountries:function(){this.preferredCountries=[];for(var a=0;a<this.options.preferredCountries.length;a++){var b=this.options.preferredCountries[a],c=this._getCountryData(b,!1,!0);c&&this.preferredCountries.push(c)}},_generateMarkup:function(){this.telInput=a(this.element),this.telInput.wrap(a("<div>",{"class":"intl-tel-input"}));var b=a("<div>",{"class":"flag-dropdown"}).insertAfter(this.telInput),c=a("<div>",{"class":"selected-flag"}).appendTo(b);this.selectedFlagInner=a("<div>",{"class":"flag"}).appendTo(c),a("<div>",{"class":"arrow"}).appendTo(this.selectedFlagInner),this.countryList=a("<ul>",{"class":"country-list v-hide"}).appendTo(b),this.preferredCountries.length&&(this._appendListItems(this.preferredCountries,"preferred"),a("<li>",{"class":"divider"}).appendTo(this.countryList)),this._appendListItems(this.countries,""),this.dropdownHeight=this.countryList.outerHeight(),this.countryList.removeClass("v-hide").addClass("hide"),this.options.responsiveDropdown&&this.countryList.outerWidth(this.telInput.outerWidth()),this.countryListItems=this.countryList.children(".country")},_appendListItems:function(a,b){for(var c="",d=0;d<a.length;d++){var e=a[d];c+="<li class='country "+b+"' data-dial-code='"+e.dialCode+"' data-country-code='"+e.iso2+"'>",c+="<div class='flag "+e.iso2+"'></div>",c+="<span class='country-name'>"+e.name+"</span>",c+="<span class='dial-code'>+"+e.dialCode+"</span>",c+="</li>"}this.countryList.append(c)},_setInitialState:function(){var a=this.telInput.val();if(this._getDialCode(a))this._updateFlagFromNumber(a);else{var b;b=this.options.defaultCountry?this._getCountryData(this.options.defaultCountry,!1,!1):this.preferredCountries.length?this.preferredCountries[0]:this.countries[0],this._selectFlag(b.iso2),a||this._updateDialCode(b.dialCode,!1)}a&&this._updateVal(a,!1)},_initListeners:function(){var c=this;this._initKeyListeners(),(this.options.autoHideDialCode||this.options.autoFormat)&&this._initFocusListeners();var d=this.telInput.closest("label");d.length&&d.on("click"+this.ns,function(a){c.countryList.hasClass("hide")?c.telInput.focus():a.preventDefault()});var e=this.selectedFlagInner.parent();e.on("click"+this.ns,function(){c.countryList.hasClass("hide")&&!c.telInput.prop("disabled")&&c._showDropdown()}),this.options.utilsScript&&(j?this.loadUtils():a(b).load(function(){c.loadUtils()}))},_initKeyListeners:function(){var a=this;this.options.autoFormat&&this.telInput.on("keypress"+this.ns,function(b){if(b.which>=i.SPACE&&!b.metaKey){b.preventDefault();var c=b.which>=i.ZERO&&b.which<=i.NINE||b.which==i.PLUS,d=a.telInput[0],e=a.isGoodBrowser&&d.selectionStart==d.selectionEnd,f=a.telInput.attr("maxlength"),g=f?a.telInput.val().length<f:!0;if(g&&(c||e)){var h=c?String.fromCharCode(b.which):null;a._handleInputKey(h,!0)}}}),this.telInput.on("keyup"+this.ns,function(b){if(b.which==i.ENTER);else if(a.options.autoFormat){var c=b.which==i.CTRL||b.which==i.CMD1||b.which==i.CMD2,d=a.telInput[0],e=a.isGoodBrowser&&d.selectionStart==d.selectionEnd,f=a.isGoodBrowser&&d.selectionStart==a.telInput.val().length;if(b.which==i.DEL||b.which==i.BSPACE||c&&e){var g=!(b.which==i.BSPACE&&f);a._handleInputKey(null,g)}if(!a.options.nationalMode){var h=a.telInput.val();if("+"!=h.substr(0,1)){var j=a.isGoodBrowser?d.selectionStart+1:0;a.telInput.val("+"+h),a.isGoodBrowser&&d.setSelectionRange(j,j)}}}else a._updateFlagFromNumber(a.telInput.val())})},_handleInputKey:function(a,b){var c=this.telInput.val(),d=null,e=!1,f=this.telInput[0];if(this.isGoodBrowser){var g=f.selectionEnd,h=c.length;e=g==h,a?(c=c.substr(0,f.selectionStart)+a+c.substring(g,h),e||(d=g+(c.length-h))):d=f.selectionStart}else a&&(c+=a);this.setNumber(c,b),this.isGoodBrowser&&(e&&(d=this.telInput.val().length),f.setSelectionRange(d,d))},_initFocusListeners:function(){var a=this;this.options.autoHideDialCode&&this.telInput.on("mousedown"+this.ns,function(b){a.telInput.is(":focus")||a.telInput.val()||(b.preventDefault(),a.telInput.focus())}),this.telInput.on("focus"+this.ns,function(){var b=a.telInput.val();a.telInput.data("focusVal",b),a.options.autoHideDialCode&&(b||(a._updateVal("+"+a.selectedCountryData.dialCode,!0),a.telInput.one("keypress.plus"+a.ns,function(b){if(b.which==i.PLUS){var c=a.options.autoFormat?"+":"";a.telInput.val(c)}}),setTimeout(function(){var b=a.telInput[0];if(a.isGoodBrowser){var c=a.telInput.val().length;b.setSelectionRange(c,c)}})))}),this.telInput.on("blur"+this.ns,function(){if(a.options.autoHideDialCode){var b=a.telInput.val(),c="+"==b.substr(0,1);if(c){var d=a._getNumeric(b);d&&a.selectedCountryData.dialCode!=d||a.telInput.val("")}a.telInput.off("keypress.plus"+a.ns)}a.options.autoFormat&&a.telInput.val()!=a.telInput.data("focusVal")&&a.telInput.trigger("change")})},_getNumeric:function(a){return a.replace(/\D/g,"")},_showDropdown:function(){this._setDropdownPosition();var a=this.countryList.children(".active");this._highlightListItem(a),this.countryList.removeClass("hide"),this._scrollTo(a),this._bindDropdownListeners(),this.selectedFlagInner.children(".arrow").addClass("up")},_setDropdownPosition:function(){var c=this.telInput.offset().top,d=a(b).scrollTop(),e=c+this.telInput.outerHeight()+this.dropdownHeight<d+a(b).height(),f=c-this.dropdownHeight>d,g=!e&&f?"-"+(this.dropdownHeight-1)+"px":"";this.countryList.css("top",g)},_bindDropdownListeners:function(){var b=this;this.countryList.on("mouseover"+this.ns,".country",function(){b._highlightListItem(a(this))}),this.countryList.on("click"+this.ns,".country",function(){b._selectListItem(a(this))});var d=!0;a("html").on("click"+this.ns,function(){d||b._closeDropdown(),d=!1});var e="",f=null;a(c).on("keydown"+this.ns,function(a){a.preventDefault(),a.which==i.UP||a.which==i.DOWN?b._handleUpDownKey(a.which):a.which==i.ENTER?b._handleEnterKey():a.which==i.ESC?b._closeDropdown():(a.which>=i.A&&a.which<=i.Z||a.which==i.SPACE)&&(f&&clearTimeout(f),e+=String.fromCharCode(a.which),b._searchForCountry(e),f=setTimeout(function(){e=""},1e3))})},_handleUpDownKey:function(a){var b=this.countryList.children(".highlight").first(),c=a==i.UP?b.prev():b.next();c.length&&(c.hasClass("divider")&&(c=a==i.UP?c.prev():c.next()),this._highlightListItem(c),this._scrollTo(c))},_handleEnterKey:function(){var a=this.countryList.children(".highlight").first();a.length&&this._selectListItem(a)},_searchForCountry:function(a){for(var b=0;b<this.countries.length;b++)if(this._startsWith(this.countries[b].name,a)){var c=this.countryList.children("[data-country-code="+this.countries[b].iso2+"]").not(".preferred");this._highlightListItem(c),this._scrollTo(c,!0);break}},_startsWith:function(a,b){return a.substr(0,b.length).toUpperCase()==b},_updateVal:function(a,c){var d;if(this.options.autoFormat&&b.intlTelInputUtils){d=intlTelInputUtils.formatNumber(a,this.selectedCountryData.iso2,c);var e=this.telInput.attr("maxlength");e&&d.length>e&&(d=d.substr(0,e))}else d=a;this.telInput.val(d)},_updateFlagFromNumber:function(a){this.options.nationalMode&&this.selectedCountryData&&"1"==this.selectedCountryData.dialCode&&"+"!=a.substr(0,1)&&(a="+1"+a);var b=this._getDialCode(a);if(b){var c=this.countryCodes[this._getNumeric(b)],d=!1;if(this.selectedCountryData)for(var e=0;e<c.length;e++)c[e]==this.selectedCountryData.iso2&&(d=!0);if(!d||this._isUnknownNanp(a,b))for(var f=0;f<c.length;f++)if(c[f]){this._selectFlag(c[f]);break}}},_isUnknownNanp:function(a,b){return"+1"==b&&this._getNumeric(a).length>=4},_highlightListItem:function(a){this.countryListItems.removeClass("highlight"),a.addClass("highlight")},_getCountryData:function(a,b,c){for(var d=b?k:this.countries,e=0;e<d.length;e++)if(d[e].iso2==a)return d[e];if(c)return null;throw new Error("No country data for '"+a+"'")},_selectFlag:function(a){this.selectedCountryData=this._getCountryData(a,!1,!1),this.selectedFlagInner.attr("class","flag "+a);var b=this.selectedCountryData.name+": +"+this.selectedCountryData.dialCode;this.selectedFlagInner.parent().attr("title",b),this._updatePlaceholder();var c=this.countryListItems.children(".flag."+a).first().parent();this.countryListItems.removeClass("active"),c.addClass("active")},_updatePlaceholder:function(){if(b.intlTelInputUtils&&!this.hadInitialPlaceholder){var a=this.selectedCountryData.iso2,c=this.options.numberType?intlTelInputUtils.numberType[this.options.numberType]:intlTelInputUtils.numberType.FIXED_LINE,d=intlTelInputUtils.getExampleNumber(a,this.options.nationalMode,c);this.telInput.attr("placeholder",d)}},_selectListItem:function(a){var b=a.attr("data-country-code");this._selectFlag(b),this._closeDropdown(),this._updateDialCode(a.attr("data-dial-code"),!0),this.telInput.trigger("change"),this.telInput.focus()},_closeDropdown:function(){this.countryList.addClass("hide"),this.selectedFlagInner.children(".arrow").removeClass("up"),a(c).off(this.ns),a("html").off(this.ns),this.countryList.off(this.ns)},_scrollTo:function(a,b){var c=this.countryList,d=c.height(),e=c.offset().top,f=e+d,g=a.outerHeight(),h=a.offset().top,i=h+g,j=h-e+c.scrollTop(),k=d/2-g/2;if(e>h)b&&(j-=k),c.scrollTop(j);else if(i>f){b&&(j+=k);var l=d-g;c.scrollTop(j-l)}},_updateDialCode:function(b,c){var d,e=this.telInput.val();if(b="+"+b,this.options.nationalMode&&"+"!=e.substr(0,1))d=e;else if(e){var f=this._getDialCode(e);if(f.length>1)d=e.replace(f,b);else{var g="+"!=e.substr(0,1)?a.trim(e):"";d=b+g}}else d=!this.options.autoHideDialCode||c?b:"";this._updateVal(d,c)},_getDialCode:function(b){var c="";if("+"==b.charAt(0))for(var d="",e=0;e<b.length;e++){var f=b.charAt(e);if(a.isNumeric(f)&&(d+=f,this.countryCodes[d]&&(c=b.substr(0,e+1)),4==d.length))break}return c},destroy:function(){this._closeDropdown(),this.telInput.off(this.ns),this.selectedFlagInner.parent().off(this.ns),this.telInput.closest("label").off(this.ns);var a=this.telInput.parent();a.before(this.telInput).remove()},getCleanNumber:function(){return b.intlTelInputUtils?intlTelInputUtils.formatNumberE164(this.telInput.val(),this.selectedCountryData.iso2):""},getNumberType:function(){return b.intlTelInputUtils?intlTelInputUtils.getNumberType(this.telInput.val(),this.selectedCountryData.iso2):-99},getSelectedCountryData:function(){return this.selectedCountryData||{}},getValidationError:function(){return b.intlTelInputUtils?intlTelInputUtils.getValidationError(this.telInput.val(),this.selectedCountryData.iso2):-99},isValidNumber:function(){var c=a.trim(this.telInput.val()),d=this.options.nationalMode?this.selectedCountryData.iso2:"",e=/[a-zA-Z]/.test(c);return!e&&b.intlTelInputUtils?intlTelInputUtils.isValidNumber(c,d):!1},loadUtils:function(b){var c=b||this.options.utilsScript;!a.fn[f].loadedUtilsScript&&c&&(a.fn[f].loadedUtilsScript=!0,a.ajax({url:c,success:function(){a(".intl-tel-input input").intlTelInput("utilsLoaded")},dataType:"script",cache:!0}))},selectCountry:function(a){this.selectedFlagInner.hasClass(a)||(this._selectFlag(a),this._updateDialCode(this.selectedCountryData.dialCode,!1))},setNumber:function(a,b){this.options.nationalMode||"+"==a.substr(0,1)||(a="+"+a),this._updateFlagFromNumber(a),this._updateVal(a,b)},utilsLoaded:function(){this.options.autoFormat&&this.telInput.val()&&this._updateVal(this.telInput.val()),this._updatePlaceholder()}},a.fn[f]=function(b){var c=arguments;if(b===d||"object"==typeof b)return this.each(function(){a.data(this,"plugin_"+f)||a.data(this,"plugin_"+f,new e(this,b))});if("string"==typeof b&&"_"!==b[0]&&"init"!==b){var g;return this.each(function(){var d=a.data(this,"plugin_"+f);d instanceof e&&"function"==typeof d[b]&&(g=d[b].apply(d,Array.prototype.slice.call(c,1))),"destroy"===b&&a.data(this,"plugin_"+f,null)}),g!==d?g:this}},a.fn[f].getCountryData=function(){return k},a.fn[f].setCountryData=function(a){k=a};for(var k=[["Afghanistan (‫افغانستان‬‎)","af","93"],["Albania (Shqipëri)","al","355"],["Algeria (‫الجزائر‬‎)","dz","213"],["American Samoa","as","1684"],["Andorra","ad","376"],["Angola","ao","244"],["Anguilla","ai","1264"],["Antigua and Barbuda","ag","1268"],["Argentina","ar","54"],["Armenia (Հայաստան)","am","374"],["Aruba","aw","297"],["Australia","au","61"],["Austria (Österreich)","at","43"],["Azerbaijan (Azərbaycan)","az","994"],["Bahamas","bs","1242"],["Bahrain (‫البحرين‬‎)","bh","973"],["Bangladesh (বাংলাদেশ)","bd","880"],["Barbados","bb","1246"],["Belarus (Беларусь)","by","375"],["Belgium (België)","be","32"],["Belize","bz","501"],["Benin (Bénin)","bj","229"],["Bermuda","bm","1441"],["Bhutan (འབྲུག)","bt","975"],["Bolivia","bo","591"],["Bosnia and Herzegovina (Босна и Херцеговина)","ba","387"],["Botswana","bw","267"],["Brazil (Brasil)","br","55"],["British Indian Ocean Territory","io","246"],["British Virgin Islands","vg","1284"],["Brunei","bn","673"],["Bulgaria (България)","bg","359"],["Burkina Faso","bf","226"],["Burundi (Uburundi)","bi","257"],["Cambodia (កម្ពុជា)","kh","855"],["Cameroon (Cameroun)","cm","237"],["Canada","ca","1",1,["204","236","249","250","289","306","343","365","387","403","416","418","431","437","438","450","506","514","519","548","579","581","587","604","613","639","647","672","705","709","742","778","780","782","807","819","825","867","873","902","905"]],["Cape Verde (Kabu Verdi)","cv","238"],["Caribbean Netherlands","bq","599",1],["Cayman Islands","ky","1345"],["Central African Republic (République centrafricaine)","cf","236"],["Chad (Tchad)","td","235"],["Chile","cl","56"],["China (中国)","cn","86"],["Colombia","co","57"],["Comoros (‫جزر القمر‬‎)","km","269"],["Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)","cd","243"],["Congo (Republic) (Congo-Brazzaville)","cg","242"],["Cook Islands","ck","682"],["Costa Rica","cr","506"],["Côte d’Ivoire","ci","225"],["Croatia (Hrvatska)","hr","385"],["Cuba","cu","53"],["Curaçao","cw","599",0],["Cyprus (Κύπρος)","cy","357"],["Czech Republic (Česká republika)","cz","420"],["Denmark (Danmark)","dk","45"],["Djibouti","dj","253"],["Dominica","dm","1767"],["Dominican Republic (República Dominicana)","do","1",2,["809","829","849"]],["Ecuador","ec","593"],["Egypt (‫مصر‬‎)","eg","20"],["El Salvador","sv","503"],["Equatorial Guinea (Guinea Ecuatorial)","gq","240"],["Eritrea","er","291"],["Estonia (Eesti)","ee","372"],["Ethiopia","et","251"],["Falkland Islands (Islas Malvinas)","fk","500"],["Faroe Islands (Føroyar)","fo","298"],["Fiji","fj","679"],["Finland (Suomi)","fi","358"],["France","fr","33"],["French Guiana (Guyane française)","gf","594"],["French Polynesia (Polynésie française)","pf","689"],["Gabon","ga","241"],["Gambia","gm","220"],["Georgia (საქართველო)","ge","995"],["Germany (Deutschland)","de","49"],["Ghana (Gaana)","gh","233"],["Gibraltar","gi","350"],["Greece (Ελλάδα)","gr","30"],["Greenland (Kalaallit Nunaat)","gl","299"],["Grenada","gd","1473"],["Guadeloupe","gp","590",0],["Guam","gu","1671"],["Guatemala","gt","502"],["Guinea (Guinée)","gn","224"],["Guinea-Bissau (Guiné Bissau)","gw","245"],["Guyana","gy","592"],["Haiti","ht","509"],["Honduras","hn","504"],["Hong Kong (香港)","hk","852"],["Hungary (Magyarország)","hu","36"],["Iceland (Ísland)","is","354"],["India (भारत)","in","91"],["Indonesia","id","62"],["Iran (‫ایران‬‎)","ir","98"],["Iraq (‫العراق‬‎)","iq","964"],["Ireland","ie","353"],["Israel (‫ישראל‬‎)","il","972"],["Italy (Italia)","it","39",0],["Jamaica","jm","1876"],["Japan (日本)","jp","81"],["Jordan (‫الأردن‬‎)","jo","962"],["Kazakhstan (Казахстан)","kz","77",1],["Kenya","ke","254"],["Kiribati","ki","686"],["Kuwait (‫الكويت‬‎)","kw","965"],["Kyrgyzstan (Кыргызстан)","kg","996"],["Laos (ລາວ)","la","856"],["Latvia (Latvija)","lv","371"],["Lebanon (‫لبنان‬‎)","lb","961"],["Lesotho","ls","266"],["Liberia","lr","231"],["Libya (‫ليبيا‬‎)","ly","218"],["Liechtenstein","li","423"],["Lithuania (Lietuva)","lt","370"],["Luxembourg","lu","352"],["Macau (澳門)","mo","853"],["Macedonia (FYROM) (Македонија)","mk","389"],["Madagascar (Madagasikara)","mg","261"],["Malawi","mw","265"],["Malaysia","my","60"],["Maldives","mv","960"],["Mali","ml","223"],["Malta","mt","356"],["Marshall Islands","mh","692"],["Martinique","mq","596"],["Mauritania (‫موريتانيا‬‎)","mr","222"],["Mauritius (Moris)","mu","230"],["Mexico (México)","mx","52"],["Micronesia","fm","691"],["Moldova (Republica Moldova)","md","373"],["Monaco","mc","377"],["Mongolia (Монгол)","mn","976"],["Montenegro (Crna Gora)","me","382"],["Montserrat","ms","1664"],["Morocco (‫المغرب‬‎)","ma","212"],["Mozambique (Moçambique)","mz","258"],["Myanmar (Burma) (မြန်မာ)","mm","95"],["Namibia (Namibië)","na","264"],["Nauru","nr","674"],["Nepal (नेपाल)","np","977"],["Netherlands (Nederland)","nl","31"],["New Caledonia (Nouvelle-Calédonie)","nc","687"],["New Zealand","nz","64"],["Nicaragua","ni","505"],["Niger (Nijar)","ne","227"],["Nigeria","ng","234"],["Niue","nu","683"],["Norfolk Island","nf","672"],["North Korea (조선 민주주의 인민 공화국)","kp","850"],["Northern Mariana Islands","mp","1670"],["Norway (Norge)","no","47"],["Oman (‫عُمان‬‎)","om","968"],["Pakistan (‫پاکستان‬‎)","pk","92"],["Palau","pw","680"],["Palestine (‫فلسطين‬‎)","ps","970"],["Panama (Panamá)","pa","507"],["Papua New Guinea","pg","675"],["Paraguay","py","595"],["Peru (Perú)","pe","51"],["Philippines","ph","63"],["Poland (Polska)","pl","48"],["Portugal","pt","351"],["Puerto Rico","pr","1",3,["787","939"]],["Qatar (‫قطر‬‎)","qa","974"],["Réunion (La Réunion)","re","262"],["Romania (România)","ro","40"],["Russia (Россия)","ru","7",0],["Rwanda","rw","250"],["Saint Barthélemy (Saint-Barthélemy)","bl","590",1],["Saint Helena","sh","290"],["Saint Kitts and Nevis","kn","1869"],["Saint Lucia","lc","1758"],["Saint Martin (Saint-Martin (partie française))","mf","590",2],["Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)","pm","508"],["Saint Vincent and the Grenadines","vc","1784"],["Samoa","ws","685"],["San Marino","sm","378"],["São Tomé and Príncipe (São Tomé e Príncipe)","st","239"],["Saudi Arabia (‫المملكة العربية السعودية‬‎)","sa","966"],["Senegal (Sénégal)","sn","221"],["Serbia (Србија)","rs","381"],["Seychelles","sc","248"],["Sierra Leone","sl","232"],["Singapore","sg","65"],["Sint Maarten","sx","1721"],["Slovakia (Slovensko)","sk","421"],["Slovenia (Slovenija)","si","386"],["Solomon Islands","sb","677"],["Somalia (Soomaaliya)","so","252"],["South Africa","za","27"],["South Korea (대한민국)","kr","82"],["South Sudan (‫جنوب السودان‬‎)","ss","211"],["Spain (España)","es","34"],["Sri Lanka (ශ්‍රී ලංකාව)","lk","94"],["Sudan (‫السودان‬‎)","sd","249"],["Suriname","sr","597"],["Swaziland","sz","268"],["Sweden (Sverige)","se","46"],["Switzerland (Schweiz)","ch","41"],["Syria (‫سوريا‬‎)","sy","963"],["Taiwan (台灣)","tw","886"],["Tajikistan","tj","992"],["Tanzania","tz","255"],["Thailand (ไทย)","th","66"],["Timor-Leste","tl","670"],["Togo","tg","228"],["Tokelau","tk","690"],["Tonga","to","676"],["Trinidad and Tobago","tt","1868"],["Tunisia (‫تونس‬‎)","tn","216"],["Turkey (Türkiye)","tr","90"],["Turkmenistan","tm","993"],["Turks and Caicos Islands","tc","1649"],["Tuvalu","tv","688"],["U.S. Virgin Islands","vi","1340"],["Uganda","ug","256"],["Ukraine (Україна)","ua","380"],["United Arab Emirates (‫الإمارات العربية المتحدة‬‎)","ae","971"],["United Kingdom","gb","44"],["United States","us","1",0],["Uruguay","uy","598"],["Uzbekistan (Oʻzbekiston)","uz","998"],["Vanuatu","vu","678"],["Vatican City (Città del Vaticano)","va","39",1],["Venezuela","ve","58"],["Vietnam (Việt Nam)","vn","84"],["Wallis and Futuna","wf","681"],["Yemen (‫اليمن‬‎)","ye","967"],["Zambia","zm","260"],["Zimbabwe","zw","263"]],l=0;l<k.length;l++){var m=k[l];k[l]={name:m[0],iso2:m[1],dialCode:m[2],priority:m[3]||0,areaCodes:m[4]||null}}})(jq,window,document);
		})(jq);
		if (typeof JSON !== 'object') {
			JSON = {};
		}
		(function () {
			'use strict';
			var rx_one = /^[\],:{}\s]*$/, rx_two = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, rx_three = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, rx_four = /(?:^|:|,)(?:\s*\[)+/g, rx_escapable = /[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, rx_dangerous = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;

			function f(n) {
				return n < 10 ? '0' + n : n;
			}

			function this_value() {
				return this.valueOf();
			}

			if (typeof Date.prototype.toJSON !== 'function') {
				Date.prototype.toJSON = function () {
					return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-' +
					f(this.getUTCMonth() + 1) + '-' +
					f(this.getUTCDate()) + 'T' +
					f(this.getUTCHours()) + ':' +
					f(this.getUTCMinutes()) + ':' +
					f(this.getUTCSeconds()) + 'Z' : null;
				};
				Boolean.prototype.toJSON = this_value;
				Number.prototype.toJSON = this_value;
				String.prototype.toJSON = this_value;
			}
			var gap, indent, meta, rep;

			function quote(string) {
				rx_escapable.lastIndex = 0;
				return rx_escapable.test(string) ? '"' + string.replace(rx_escapable, function (a) {
					var c = meta[a];
					return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
				}) + '"' : '"' + string + '"';
			}

			function str(key, holder) {
				var i, k, v, length, mind = gap, partial, value = holder[key];
				if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
					value = value.toJSON(key);
				}
				if (typeof rep === 'function') {
					value = rep.call(holder, key, value);
				}
				switch (typeof value) {
					case'string':
						return quote(value);
					case'number':
						return isFinite(value) ? String(value) : 'null';
					case'boolean':
					case'null':
						return String(value);
					case'object':
						if (!value) {
							return 'null';
						}
						gap += indent;
						partial = [];
						if (Object.prototype.toString.apply(value) === '[object Array]') {
							length = value.length;
							for (i = 0; i < length; i += 1) {
								partial[i] = str(i, value) || 'null';
							}
							v = partial.length === 0 ? '[]' : gap ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' : '[' + partial.join(',') + ']';
							gap = mind;
							return v;
						}
						if (rep && typeof rep === 'object') {
							length = rep.length;
							for (i = 0; i < length; i += 1) {
								if (typeof rep[i] === 'string') {
									k = rep[i];
									v = str(k, value);
									if (v) {
										partial.push(quote(k) + (gap ? ': ' : ':') + v);
									}
								}
							}
						} else {
							for (k in value) {
								if (Object.prototype.hasOwnProperty.call(value, k)) {
									v = str(k, value);
									if (v) {
										partial.push(quote(k) + (gap ? ': ' : ':') + v);
									}
								}
							}
						}
						v = partial.length === 0 ? '{}' : gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' : '{' + partial.join(',') + '}';
						gap = mind;
						return v;
				}
			}

			if (typeof JSON.stringify !== 'function') {
				meta = {'\b': '\\b', '\t': '\\t', '\n': '\\n', '\f': '\\f', '\r': '\\r', '"': '\\"', '\\': '\\\\'};
				JSON.stringify = function (value, replacer, space) {
					var i;
					gap = '';
					indent = '';
					if (typeof space === 'number') {
						for (i = 0; i < space; i += 1) {
							indent += ' ';
						}
					} else if (typeof space === 'string') {
						indent = space;
					}
					rep = replacer;
					if (replacer && typeof replacer !== 'function' && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
						throw new Error('JSON.stringify');
					}
					return str('', {'': value});
				};
			}
			if (typeof JSON.parse !== 'function') {
				JSON.parse = function (text, reviver) {
					var j;

					function walk(holder, key) {
						var k, v, value = holder[key];
						if (value && typeof value === 'object') {
							for (k in value) {
								if (Object.prototype.hasOwnProperty.call(value, k)) {
									v = walk(value, k);
									if (v !== undefined) {
										value[k] = v;
									} else {
										delete value[k];
									}
								}
							}
						}
						return reviver.call(holder, key, value);
					}

					text = String(text);
					rx_dangerous.lastIndex = 0;
					if (rx_dangerous.test(text)) {
						text = text.replace(rx_dangerous, function (a) {
							return '\\u' +
								('0000' + a.charCodeAt(0).toString(16)).slice(-4);
						});
					}
					if (rx_one.test(text.replace(rx_two, '@').replace(rx_three, ']').replace(rx_four, ''))) {
						j = eval('(' + text + ')');
						return typeof reviver === 'function' ? walk({'': j}, '') : j;
					}
					throw new SyntaxError('JSON.parse');
				};
			}
		}());
		var desktop = desktop || {};
		desktop["src/assets/desktop/iframe.ejs"] = '<!DOCTYPE html> <html> <head> <meta charset="utf-8"> <title>Виджет - Pozvonim.com</title> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <meta name="viewport" content="width=device-width, initial-scale=1"> <link href="<%= cdnPath %>/font-awesome-4.4.0/css/font-awesome.css" rel="stylesheet" type="text/css"/> <link href="//fonts.googleapis.com/css?family=Open+Sans:300&subset=latin,cyrillic" rel="stylesheet" type="text/css"/> <style type="text/css">.CENTER .flag-dropdown, .TOP_CENTER .flag-dropdown, .BOTTOM_CENTER .flag-dropdown {bottom: 0 !important;} .flag{width:16px;height:11px;background-image: url(data:image/png;base64,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);}.intl-tel-input .ad{background-position:-16px 0}.intl-tel-input .ae{background-position:-32px 0}.intl-tel-input .af{background-position:-48px 0}.intl-tel-input .ag{background-position:-64px 0}.intl-tel-input .ai{background-position:-80px 0}.intl-tel-input .al{background-position:-96px 0}.intl-tel-input .am{background-position:-112px 0}.intl-tel-input .ao{background-position:-128px 0}.intl-tel-input .ar{background-position:-144px 0}.intl-tel-input .as{background-position:-160px 0}.intl-tel-input .at{background-position:-176px 0}.intl-tel-input .au{background-position:-192px 0}.intl-tel-input .aw{background-position:-208px 0}.intl-tel-input .az{background-position:-224px 0}.intl-tel-input .ba{background-position:-240px 0}.intl-tel-input .bb{background-position:0 -11px}.intl-tel-input .bd{background-position:-16px -11px}.intl-tel-input .be{background-position:-32px -11px}.intl-tel-input .bf{background-position:-48px -11px}.intl-tel-input .bg{background-position:-64px -11px}.intl-tel-input .bh{background-position:-80px -11px}.intl-tel-input .bi{background-position:-96px -11px}.intl-tel-input .bj{background-position:-112px -11px}.intl-tel-input .bm{background-position:-128px -11px}.intl-tel-input .bn{background-position:-144px -11px}.intl-tel-input .bo{background-position:-160px -11px}.intl-tel-input .br{background-position:-176px -11px}.intl-tel-input .bs{background-position:-192px -11px}.intl-tel-input .bt{background-position:-208px -11px}.intl-tel-input .bw{background-position:-224px -11px}.intl-tel-input .by{background-position:-240px -11px}.intl-tel-input .bz{background-position:0 -22px}.intl-tel-input .ca{background-position:-16px -22px}.intl-tel-input .cd{background-position:-32px -22px}.intl-tel-input .cf{background-position:-48px -22px}.intl-tel-input .cg{background-position:-64px -22px}.intl-tel-input .ch{background-position:-80px -22px}.intl-tel-input .ci{background-position:-96px -22px}.intl-tel-input .ck{background-position:-112px -22px}.intl-tel-input .cl{background-position:-128px -22px}.intl-tel-input .cm{background-position:-144px -22px}.intl-tel-input .cn{background-position:-160px -22px}.intl-tel-input .co{background-position:-176px -22px}.intl-tel-input .cr{background-position:-192px -22px}.intl-tel-input .cu{background-position:-208px -22px}.intl-tel-input .cv{background-position:-224px -22px}.intl-tel-input .cw{background-position:-240px -22px}.intl-tel-input .cy{background-position:0 -33px}.intl-tel-input .cz{background-position:-16px -33px}.intl-tel-input .de{background-position:-32px -33px}.intl-tel-input .dj{background-position:-48px -33px}.intl-tel-input .dk{background-position:-64px -33px}.intl-tel-input .dm{background-position:-80px -33px}.intl-tel-input .do{background-position:-96px -33px}.intl-tel-input .dz{background-position:-112px -33px}.intl-tel-input .ec{background-position:-128px -33px}.intl-tel-input .ee{background-position:-144px -33px}.intl-tel-input .eg{background-position:-160px -33px}.intl-tel-input .er{background-position:-176px -33px}.intl-tel-input .es{background-position:-192px -33px}.intl-tel-input .et{background-position:-208px -33px}.intl-tel-input .fi{background-position:-224px -33px}.intl-tel-input .fj{background-position:-240px -33px}.intl-tel-input .fk{background-position:0 -44px}.intl-tel-input .fm{background-position:-16px -44px}.intl-tel-input .fo{background-position:-32px -44px}.intl-tel-input .fr,.intl-tel-input .bl,.intl-tel-input .mf{background-position:-48px -44px}.intl-tel-input .ga{background-position:-64px -44px}.intl-tel-input .gb{background-position:-80px -44px}.intl-tel-input .gd{background-position:-96px -44px}.intl-tel-input .ge{background-position:-112px -44px}.intl-tel-input .gf{background-position:-128px -44px}.intl-tel-input .gh{background-position:-144px -44px}.intl-tel-input .gi{background-position:-160px -44px}.intl-tel-input .gl{background-position:-176px -44px}.intl-tel-input .gm{background-position:-192px -44px}.intl-tel-input .gn{background-position:-208px -44px}.intl-tel-input .gp{background-position:-224px -44px}.intl-tel-input .gq{background-position:-240px -44px}.intl-tel-input .gr{background-position:0 -55px}.intl-tel-input .gt{background-position:-16px -55px}.intl-tel-input .gu{background-position:-32px -55px}.intl-tel-input .gw{background-position:-48px -55px}.intl-tel-input .gy{background-position:-64px -55px}.intl-tel-input .hk{background-position:-80px -55px}.intl-tel-input .hn{background-position:-96px -55px}.intl-tel-input .hr{background-position:-112px -55px}.intl-tel-input .ht{background-position:-128px -55px}.intl-tel-input .hu{background-position:-144px -55px}.intl-tel-input .id{background-position:-160px -55px}.intl-tel-input .ie{background-position:-176px -55px}.intl-tel-input .il{background-position:-192px -55px}.intl-tel-input .in{background-position:-208px -55px}.intl-tel-input .io{background-position:-224px -55px}.intl-tel-input .iq{background-position:-240px -55px}.intl-tel-input .ir{background-position:0 -66px}.intl-tel-input .is{background-position:-16px -66px}.intl-tel-input .it{background-position:-32px -66px}.intl-tel-input .jm{background-position:-48px -66px}.intl-tel-input .jo{background-position:-64px -66px}.intl-tel-input .jp{background-position:-80px -66px}.intl-tel-input .ke{background-position:-96px -66px}.intl-tel-input .kg{background-position:-112px -66px}.intl-tel-input .kh{background-position:-128px -66px}.intl-tel-input .ki{background-position:-144px -66px}.intl-tel-input .km{background-position:-160px -66px}.intl-tel-input .kn{background-position:-176px -66px}.intl-tel-input .kp{background-position:-192px -66px}.intl-tel-input .kr{background-position:-208px -66px}.intl-tel-input .kw{background-position:-224px -66px}.intl-tel-input .ky{background-position:-240px -66px}.intl-tel-input .kz{background-position:0 -77px}.intl-tel-input .la{background-position:-16px -77px}.intl-tel-input .lb{background-position:-32px -77px}.intl-tel-input .lc{background-position:-48px -77px}.intl-tel-input .li{background-position:-64px -77px}.intl-tel-input .lk{background-position:-80px -77px}.intl-tel-input .lr{background-position:-96px -77px}.intl-tel-input .ls{background-position:-112px -77px}.intl-tel-input .lt{background-position:-128px -77px}.intl-tel-input .lu{background-position:-144px -77px}.intl-tel-input .lv{background-position:-160px -77px}.intl-tel-input .ly{background-position:-176px -77px}.intl-tel-input .ma{background-position:-192px -77px}.intl-tel-input .mc{background-position:-208px -77px}.intl-tel-input .md{background-position:-224px -77px}.intl-tel-input .me{background-position:-112px -154px;height:12px}.intl-tel-input .mg{background-position:0 -88px}.intl-tel-input .mh{background-position:-16px -88px}.intl-tel-input .mk{background-position:-32px -88px}.intl-tel-input .ml{background-position:-48px -88px}.intl-tel-input .mm{background-position:-64px -88px}.intl-tel-input .mn{background-position:-80px -88px}.intl-tel-input .mo{background-position:-96px -88px}.intl-tel-input .mp{background-position:-112px -88px}.intl-tel-input .mq{background-position:-128px -88px}.intl-tel-input .mr{background-position:-144px -88px}.intl-tel-input .ms{background-position:-160px -88px}.intl-tel-input .mt{background-position:-176px -88px}.intl-tel-input .mu{background-position:-192px -88px}.intl-tel-input .mv{background-position:-208px -88px}.intl-tel-input .mw{background-position:-224px -88px}.intl-tel-input .mx{background-position:-240px -88px}.intl-tel-input .my{background-position:0 -99px}.intl-tel-input .mz{background-position:-16px -99px}.intl-tel-input .na{background-position:-32px -99px}.intl-tel-input .nc{background-position:-48px -99px}.intl-tel-input .ne{background-position:-64px -99px}.intl-tel-input .nf{background-position:-80px -99px}.intl-tel-input .ng{background-position:-96px -99px}.intl-tel-input .ni{background-position:-112px -99px}.intl-tel-input .nl,.intl-tel-input .bq{background-position:-128px -99px}.intl-tel-input .no{background-position:-144px -99px}.intl-tel-input .np{background-position:-160px -99px}.intl-tel-input .nr{background-position:-176px -99px}.intl-tel-input .nu{background-position:-192px -99px}.intl-tel-input .nz{background-position:-208px -99px}.intl-tel-input .om{background-position:-224px -99px}.intl-tel-input .pa{background-position:-240px -99px}.intl-tel-input .pe{background-position:0 -110px}.intl-tel-input .pf{background-position:-16px -110px}.intl-tel-input .pg{background-position:-32px -110px}.intl-tel-input .ph{background-position:-48px -110px}.intl-tel-input .pk{background-position:-64px -110px}.intl-tel-input .pl{background-position:-80px -110px}.intl-tel-input .pm{background-position:-96px -110px}.intl-tel-input .pr{background-position:-112px -110px}.intl-tel-input .ps{background-position:-128px -110px}.intl-tel-input .pt{background-position:-144px -110px}.intl-tel-input .pw{background-position:-160px -110px}.intl-tel-input .py{background-position:-176px -110px}.intl-tel-input .qa{background-position:-192px -110px}.intl-tel-input .re{background-position:-208px -110px}.intl-tel-input .ro{background-position:-224px -110px}.intl-tel-input .rs{background-position:-240px -110px}.intl-tel-input .ru{background-position:0 -121px}.intl-tel-input .rw{background-position:-16px -121px}.intl-tel-input .sa{background-position:-32px -121px}.intl-tel-input .sb{background-position:-48px -121px}.intl-tel-input .sc{background-position:-64px -121px}.intl-tel-input .sd{background-position:-80px -121px}.intl-tel-input .se{background-position:-96px -121px}.intl-tel-input .sg{background-position:-112px -121px}.intl-tel-input .sh{background-position:-128px -121px}.intl-tel-input .si{background-position:-144px -121px}.intl-tel-input .sk{background-position:-160px -121px}.intl-tel-input .sl{background-position:-176px -121px}.intl-tel-input .sm{background-position:-192px -121px}.intl-tel-input .sn{background-position:-208px -121px}.intl-tel-input .so{background-position:-224px -121px}.intl-tel-input .sr{background-position:-240px -121px}.intl-tel-input .ss{background-position:0 -132px}.intl-tel-input .st{background-position:-16px -132px}.intl-tel-input .sv{background-position:-32px -132px}.intl-tel-input .sx{background-position:-48px -132px}.intl-tel-input .sy{background-position:-64px -132px}.intl-tel-input .sz{background-position:-80px -132px}.intl-tel-input .tc{background-position:-96px -132px}.intl-tel-input .td{background-position:-112px -132px}.intl-tel-input .tg{background-position:-128px -132px}.intl-tel-input .th{background-position:-144px -132px}.intl-tel-input .tj{background-position:-160px -132px}.intl-tel-input .tk{background-position:-176px -132px}.intl-tel-input .tl{background-position:-192px -132px}.intl-tel-input .tm{background-position:-208px -132px}.intl-tel-input .tn{background-position:-224px -132px}.intl-tel-input .to{background-position:-240px -132px}.intl-tel-input .tr{background-position:0 -143px}.intl-tel-input .tt{background-position:-16px -143px}.intl-tel-input .tv{background-position:-32px -143px}.intl-tel-input .tw{background-position:-48px -143px}.intl-tel-input .tz{background-position:-64px -143px}.intl-tel-input .ua{background-position:-80px -143px}.intl-tel-input .ug{background-position:-96px -143px}.intl-tel-input .us{background-position:-112px -143px}.intl-tel-input .uy{background-position:-128px -143px}.intl-tel-input .uz{background-position:-144px -143px}.intl-tel-input .va{background-position:-160px -143px}.intl-tel-input .vc{background-position:-176px -143px}.intl-tel-input .ve{background-position:-192px -143px}.intl-tel-input .vg{background-position:-208px -143px}.intl-tel-input .vi{background-position:-224px -143px}.intl-tel-input .vn{background-position:-240px -143px}.intl-tel-input .vu{background-position:0 -154px}.intl-tel-input .wf{background-position:-16px -154px}.intl-tel-input .ws{background-position:-32px -154px}.intl-tel-input .ye{background-position:-48px -154px}.intl-tel-input .za{background-position:-64px -154px}.intl-tel-input .zm{background-position:-80px -154px}.intl-tel-input .zw{background-position:-96px -154px}.intl-tel-input{position:relative;display:inline-block}.intl-tel-input *{box-sizing:border-box;-moz-box-sizing:border-box}.intl-tel-input .hide{display:none}.intl-tel-input .v-hide{visibility:hidden}.intl-tel-input input,.intl-tel-input input[type=text],.intl-tel-input input[type=tel]{position:relative;z-index:0; padding-left:44px;margin-left:0}.intl-tel-input .flag-dropdown{font-size:0.8em;position:absolute;top:0;bottom:15px;padding:1px}.intl-tel-input .flag-dropdown:hover{cursor:pointer}.intl-tel-input .flag-dropdown:hover .selected-flag{background-color:rgba(0,0,0,0.05)}.intl-tel-input input[disabled]+.flag-dropdown:hover{cursor:default}.intl-tel-input input[disabled]+.flag-dropdown:hover .selected-flag{background-color:transparent}.intl-tel-input .selected-flag{z-index:1;position:relative;width:38px;height:100%;padding:0 0 0 8px}.intl-tel-input .selected-flag .flag{position:absolute;top:50%;margin-top:-5px}.intl-tel-input .selected-flag .arrow{position:relative;top:50%;margin-top:-2px;left:20px;width:0;height:0;border-left:3px solid transparent;border-right:3px solid transparent;border-top:4px solid #555}.intl-tel-input .selected-flag .arrow.up{border-top:none;border-bottom:4px solid #555}.intl-tel-input .country-list{list-style:none;position:absolute;z-index:2;padding:0;margin:5px 0 0 -1px;box-shadow:1px 1px 4px rgba(0,0,0,0.2);background-color: #555555; background-color: <%= window_style.phone_background %>; border: 1px solid <%= window_style.phone_border %>; color: <%= window_style.phone_color %>;text-align:left;width:266px;max-height:240px;overflow-y:scroll}.intl-tel-input .country-list .flag{display:inline-block}.intl-tel-input .country-list .divider{padding-bottom:5px;margin-bottom:5px;border-bottom:1px solid #CCC}.intl-tel-input .country-list .country{padding:5px 10px}.intl-tel-input .country-list .country .dial-code{color:#999}.intl-tel-input .country-list .country.highlight{background-color:rgba(0,0,0,0.05)}.intl-tel-input .country-list .flag,.intl-tel-input .country-list .country-name{margin-right:6px} *, *::before, *::after { -moz-box-sizing: border-box; box-sizing: border-box; }  html, body { padding: 0; margin: 0; height: 100%; width: 100%; overflow-x: hidden; overflow-y: auto; -webkit-font-smoothing: antialiased; font-family: "Open Sans", arial, sans-serif; font-weight: 200; color: #ffffff; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#7f444444, endColorstr=#7f444444); background-color: rgba(0, 0, 0, 0); }  input, button, select { color: #ffffff; -webkit-font-smoothing: antialiased; font-family: "Open Sans", arial, sans-serif; font-weight: 200; }  .clearfix { clear: both; }  .margin-0 { margin: 0; }  .padding-0 { padding: 0; }  .table-row { width: 100%; margin: 0 auto; padding: 0 25px; }  .table-content { border-collapse: collapse; height: 100%; width: 100%; }  .text-left { text-align: left; }  .text-center { text-align: center; }  .text-right { text-align: right; }  .text-small { font-size: 12px; }  .text-title { font-size: 20px; margin-bottom: 20px; }  .text-description { font-size: 16px; padding: 10px 0; }  .left { float: left; }  .right { float: right; }  .center { margin: 0 auto; }  .top { vertical-align: top; }  .middle { vertical-align: middle; }  .bottom { vertical-align: bottom; }  .hide { font-size: 12px; line-height: 35px; padding: 0 25px 0 0; position: relative; text-decoration: none; cursor: pointer; }  .hide:after { width: 18px; height: 18px; content: ""; background: url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAVdJREFUeNqc1MtKw0AUxvFctNVqg1VBrWDrDZdduPUtfA3RrZeFiFRRNz6AG1GqIHh9LDeWirb1Ev+DZ2AYMol14Aehk3w5M3NSP45jjxGgiKb3z6ECfGzgDPM9PBthDTWEHhUF2MYHHrGkqsxQwhG+sItxPVHADrq4RTUlZBh1tHGFGVWMecMQNvGKJywkhIzgGB2co6zn7Btz2MIb7lGxXlSXkEtMmc8mlT4oe9aVymYxgBP5rWFWkhak5CWsiRucyvUFJpOeSTsZFbaH7/h3qEOYcN0fZPRKHrFc94vk4XhDQfqkLRt7iJb0WeWvSxs1+kTvSZ/smWqNu6TWsEPUER9Ix15bR5yTsE+prOoKiqzlTDuWrMLe8YA5OyiSSjqynHLKaeo+a0nTLpqfyLqU3MgIMVtDfZsvWEWoJ5ax7zoRhyJWZO88X/7YQozh2eibnsaPAAMA1sw3kvKZ7zAAAAAASUVORK5CYII=\') no-repeat; position: absolute; right: 0; top: 0; }  .top, .bottom { height: 35px; }  .content { background-color: rgba(0, 0, 0, 0.8); }  .select {max-width: 266px; border: 1px solid #555555; border-radius: 4px; background: #000000; color: #ffffff; padding: 2px 4px; }  .hide {   font-size: 12px; line-height: 35px; padding: 0 25px 0 0; position: relative; text-decoration: none; cursor: pointer; }  .hide:after { width: 18px; height: 18px; content: ""; background: url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAVdJREFUeNqc1MtKw0AUxvFctNVqg1VBrWDrDZdduPUtfA3RrZeFiFRRNz6AG1GqIHh9LDeWirb1Ev+DZ2AYMol14Aehk3w5M3NSP45jjxGgiKb3z6ECfGzgDPM9PBthDTWEHhUF2MYHHrGkqsxQwhG+sItxPVHADrq4RTUlZBh1tHGFGVWMecMQNvGKJywkhIzgGB2co6zn7Btz2MIb7lGxXlSXkEtMmc8mlT4oe9aVymYxgBP5rWFWkhak5CWsiRucyvUFJpOeSTsZFbaH7/h3qEOYcN0fZPRKHrFc94vk4XhDQfqkLRt7iJb0WeWvSxs1+kTvSZ/smWqNu6TWsEPUER9Ix15bR5yTsE+prOoKiqzlTDuWrMLe8YA5OyiSSjqynHLKaeo+a0nTLpqfyLqU3MgIMVtDfZsvWEWoJ5ax7zoRhyJWZO88X/7YQozh2eibnsaPAAMA1sw3kvKZ7zAAAAAASUVORK5CYII=\') no-repeat; position: absolute; right: 0; top: 0; }  .copyright { color: #ffffff; font-size: 12px; line-height: 35px; position: relative; text-decoration: none; cursor: pointer; }  .copyright::before { background: url(\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAANCAYAAABy6+R8AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAASJJREFUeNqEkq9LBFEUhWeHyWqy+qMIIrggCCbHKAiuGKyLScSwi//A+B9ssYqbBIMYDAbDCFbBYLKoUZMm4/gdOReeG/TCx3tz3733nXeYVtM02X/xvlqW3j5M3tYfrb+aKO6xiCmnPmH6VxNFbZYJTYQBLHufwzqMwVrhYhWewqan3cA2nMM8XEDhXJa7oXaD4tqHan6THJj19ytvqnM3LLphCDvej8MCnEEFS37fj9aOdMIWhEtPcOz8HjxrOLdc6nDUCL1rBb5gxg9XnMCh7I6boqFjGfdJg95xBbvQjtoiuUGG3MG+JW/AnNfM1mfhXukp0nugJDI05NFGKI5CWsirbGtXRiSHMXlIrkr/FMlTUTecSeIF+uQHo7/XtwADAL/9XXyqm4tEAAAAAElFTkSuQmCC\') no-repeat scroll 0 0; content: ""; height: 20px; left: 50%; position: absolute; top: -15px; width: 20px; }  .content-offline .btn { -webkit-transition: background-color 300ms ease 0s; -moz-transition: background-color 300ms ease 0s; -o-transition: background-color 300ms ease 0s; transition: background-color 300ms ease 0s; background-color: <%= window_style.button_background %>; color: <%= window_style.button_color%>; cursor: pointer; }  .content-offline .btn:hover { background-color: <%= window_style.button_hover_background %>; color: <%= window_style.button_hover_color %>; }  .content-offline .btn.disabled, .content-offline .btn.disabled:hover { background-color: #cccccc; background-color: rgba(204, 204, 204, 0.5); color: #ffffff; }  .content-offline .input, .content-offline .select, .content-offline .select option { background-color: #555555; background-color: <%= window_style.phone_background %>; border: 1px solid <%= window_style.phone_border %>; color: <%= window_style.phone_color %>; }  .content-call .timer { font-size: 55px; padding: 0; <% if(logo) { %> margin: 10px; <%}%><%= (call_time == 0 || working == false ? \'display:none;\' : \'\') %> }  .content-call .btn { color: #ffffff; font-size: 20px; height: 45px; line-height: 45px; width: 266px; background-color: #00aaff; border: 0 none; border-radius: 3px; }  .content-call .btn:hover { background-color: #97cf26; }  .content-call .input { background-color: #cccccc; background-color: rgba(0, 0, 0, 0.8); border: 0 none; border-radius: 5px; font-size: 25px; height: 45px; margin: 0 0 15px 0; padding: 0 15px; width: 266px; }  .content-call .btn { -webkit-transition: background-color 300ms ease 0s; -moz-transition: background-color 300ms ease 0s; -o-transition: background-color 300ms ease 0s; transition: background-color 300ms ease 0s; background-color: <%= window_style.button_background%>; color: <%= window_style.button_color%>; cursor: pointer; }  .content-call .btn:hover { background-color: <%= window_style.button_hover_background%>; color: <%= window_style.button_hover_color%>; }  .content-call .btn.disabled, .content-call .btn.disabled:hover { background-color: #cccccc; background-color: rgba(204, 204, 204, 0.5); color: #ffffff; }  .content-call .input, .content-call .select, .content-call .select option { background-color: #555555; background-color: <%= window_style.phone_background%>; border: 1px solid <%= window_style.phone_border%>; color: <%= window_style.phone_color%>; }  .content-final .btn { background-color: #00aaff; border: 0 none; border-radius: 3px; color: #ffffff; font-size: 16px; height: 50px; margin: 5px; }  .content-final .btn:hover { background-color: #97cf26; }  .content { background-color: #444444; background-color: <%= window_style.widget_background%>; color: <%= window_style.widget_color%>; }  a, a:link, a:visited, a:hover { color: #ffffff; color: <%= window_style.widget_color%>; }  .TOP_LEFT .content-call .input, .TOP_RIGHT .content-call .input { /*width: 210px\9;*/ margin-bottom: 10px \9; }  .TOP_LEFT .table-row, .TOP_RIGHT .table-row { width: 280px \9; padding: 0 \9; }  .CENTER .table-row, .TOP_CENTER .table-row, .BOTTOM_CENTER .table-row { width: 590px; width: 590px \9; padding: 0 \9; }  .CENTER .timer { font-size: 56px; text-align: center; padding: 0; margin: 0; }  .CENTER .content-final, .TOP_CENTER .content-final, .BOTTOM_CENTER .content-final { text-align: center; }  .TOP_CENTER .timer, .BOTTOM_CENTER .timer { font-size: 52px; text-align: center; margin: 0; padding: 0; }  .CENTER .content-call .btn, .TOP_CENTER .content-call .btn, .BOTTOM_CENTER .content-call .btn { float: right; }  .CENTER .content-bottom .copyright:before, .TOP_CENTER .content-bottom .copyright:before, .BOTTOM_CENTER .content-bottom .copyright:before { top: 2px; left: -20px; }  .CENTER .text-title, .TOP_CENTER .text-title, .BOTTOM_CENTER .text-title, .CENTER .text-description, .TOP_CENTER .text-description, .BOTTOM_CENTER .text-description { margin: 0; }  .CENTER .content-call, .TOP_CENTER .content-call, .BOTTOM_CENTER .content-call { text-align: left; }  .TOP_LEFT.content-analytic, .TOP_RIGHT .content-analytic { padding-top: 30px }  .CENTER .content-logo { display: none; }  .TOP_CENTER .content-logo, .BOTTOM_CENTER .content-logo { left: 50%; margin-left: -510px; max-height: 200px; position: absolute; text-align: start; width: 260px; }  .CENTER .content-call .input, .TOP_CENTER .content-call .input, .BOTTOM_CENTER .content-call .input { margin: 0; float: left; }  .logo { display: block; margin: 0 auto; max-height: 200px; max-width: 200px; }  .text-analytic { padding: 25px 0 0; }  .rating { font-size: 0; padding: 10px 0px 5px; }  option.disabled { opacity: 0.2; }  .rating .wrap { display: inline-block; font-size: 1rem; }  .rating .wrap:after { content: ""; display: table; clear: both; }  .rating .ico { float: right; padding-left: 5px; cursor: pointer; color: #FFB300; }  .rating .ico:last-child { padding-left: 0; }  .rating .input { display: none; }  .rating .ico:hover:before, .rating .ico:hover ~ .ico:before, .rating .input:checked ~ .ico:before { content: "\f005"; }  .input.error { border-color: #ff0000; }  .content-delayed { text-align: center; font-size: 14px; }  .content-delayed a { font-size: 14px; text-decoration: none; border-bottom: 1px dashed <%= window_style.widget_color%>; }  .delayed { text-align: left; padding: 0 0 5px 0; }  #pozvonim-validation-element::after { border-color: rgba(0, 0, 0, 0.8) transparent transparent; border-color: <%= window_style.phone_background%> transparent transparent; border-style: solid; border-width: 12px; content: " "; display: block; height: 20px; left: 35px; position: absolute; top: 76px; width: 0; }  #pozvonim-validation-element { border-radius: 5px; box-shadow: 2px 0 27px 0 rgba(204, 204, 204, 0.5); display: block; font-size: 16px; margin-left: -20px; margin-top: -89px; opacity: 1; padding: 15px; position: absolute; width: 266px; border: 1px solid transparent; background-color: rgba(0, 0, 0, 0.8); color: #ffffff; background-color: <%= window_style.phone_background%>; border: 1px solid <%= window_style.phone_border%>; color: <%= window_style.phone_color%>; }  .input, .select, .select option { background-color: #555555; background-color: <%= window_style.phone_background%>; border: 1px solid <%= window_style.phone_border%>; color: <%= window_style.phone_color%>;} .CENTER .flag-dropdown,.TOP_CENTER .flag-dropdown,.BOTTOM_CENTER .flag-dropdown {bottom: 0 !important;}.TOP_LEFT .content-offline,.TOP_RIGHT .content-offline {margin-bottom:-20px !important;} </style> </head> <body id="pozvonim-widget"> <table class="table table-content content <%= window_position %>"> <tr> <td class="top"> <div class="table-row text-right content-top actionHide"><a class="hide actionHide">Закрыть</a></div> </td></tr><tr> <td class="middle"><% if(logo) { %><div class="table-row text-center content-logo" style="padding: 0 10px 10px 0;"><img class="logo"  src="<%= cdnPath %>/files/widget/<%= logo %>"/></div> <% } %> <div id="pozvonim-element-balance" class="table-row text-center content-balance" style="display:none;"> <div class="text-title">Спасибо. Мы позвоним вам позже.</div> </div> <div id="pozvonim-element-offline" class="table-row text-center content-offline" style="display:none;"> <div class="text-title"><%= window_text.offline.final %></div> </div> <div id="pozvonim-element-final" class="table-row text-center content-final" style="display:none;"> <div class="text-title"><%= window_text.final.title %></div> <button class="btn actionHide"><%= window_text.final.success %></button> <button class="btn actionReport"><%= window_text.final.fail %></button> <div class="clearfix"></div> <span class="text-small"><%= window_text.final.message %></span> <div class="clearfix"></div> <span class="reported text-small" style="display: none;"><%= window_text.final.send %></span> <div class="clearfix"></div> <% if(report_analytic) { %> <div class="content-analytic text-center"> <div class="text-description text-analytic">Пожалуйста оцените работу нашего менеджера!</div> <div class="rating"> <div class="wrap"><input class="input" id="rating-5" type="radio" name="rating" value="5"> <label class="ico fa fa-star-o fa-2x" for="rating-5"></label> <input class="input"  id="rating-4"  type="radio"  name="rating"  value="4"> <label class="ico fa fa-star-o fa-2x" for="rating-4"></label> <input class="input" id="rating-3" type="radio" name="rating" value="3"> <label class="ico fa fa-star-o fa-2x" for="rating-3"></label> <input class="input" id="rating-2" type="radio" name="rating" value="2"> <label class="ico fa fa-star-o fa-2x" for="rating-2"></label> <input class="input" id="rating-1" type="radio" name="rating" value="1"> <label class="ico fa fa-star-o fa-2x" for="rating-1"></label></div> </div> </div> <% } %> </div> <div id="pozvonim-element-call" class="table-row text-left content-call"> <% if(logo && window_position == \'CENTER\'){  %> <div style="float:left;min-height: 120px;padding: 0 20px 10px 0;position: relative;top: 30px; "> <img width="130" src="<%= cdnPath %>/files/widget/<%= logo %>" class="logo"> </div> <br/><%}%> <div class="events enter" style="display: none;"> <div class="text-title"><%= window_text.enter.title %></div> <p class="text-description"><%= window_text.enter.description %></p> </div> <div class="events exit" style="display: none;"> <div class="text-title"><%= window_text.exit.title.replace(\'%staytime%\', \'<span id="pozvonim-element-staytime"></span>\') %></div> <p class="text-description"><%= window_text.exit.description %></p> </div> <div class="events wait" style="display: none;"> <div class="text-title"><%= window_text.wait.title %></div> <p class="text-description"><%= window_text.wait.description %></p> </div> <div class="events return" style="display: none;"> <div class="text-title"><%= window_text.return.title.replace(\' раза\',\'\').replace(\'%counter%\', \'<span id="pozvonim-element-returncount">1</span>\') %></div> <p class="text-description"><%= window_text.return.description %></p> </div> <div class="events click"> <div class="text-title"><%= window_text.click.title %></div> <p class="text-description"><%= window_text.click.description %></p> </div> <div class="events offline" style="display: none;"> <% var offlineText = window_text.offline.description.split(\'%calltime%\'); %> <div class="text-title"><%= window_text.offline.title %></div> <div class="text-description" style="padding:0px;margin: 0 0 5px;"><%= offlineText[0] %>в рабочее время в <div style="margin-top:5px;"><select id="pozvonim-delay-day-input" name="delay_day" class="day select"></select>&nbsp;<select id="pozvonim-delay-hour-input" name="delay_hour" class="hours select"></select>&nbsp;<select id="pozvonim-delay-minute-input" name="delay_minute" class="minutes select"></select></div>&nbsp;<%= offlineText[1] %></div> </div> <% if(manager_region_enable) {var regionText = window_text.region.select.split(\'%regionselect%\');  %> <div style="padding-bottom:5px;"><%= regionText[0] %><select name="region" class="select region" id="pozvonim-region-input"> <% $.each(regions, function (index, item) { %> <option value="<%= item %>"><%= item %></option> <% }); %> </select><%= regionText[1] %> </div><% } %> <div style="clear:both"></div><form method="post" enctype="application/x-www-form-urlencoded" style="display:inline;" class="text-center inline actionCall"> <div id="pozvonim-validation-element" style="display: none;border-radius: 5px; box-shadow: 2px 0 27px 0 rgba(204, 204, 204, 0.5); font-size: 16px; margin-top: -89px; opacity: 1; padding: 15px; position: absolute; width: 266px; border: 1px solid transparent; background-color: rgba(0, 0, 0, 0.8); color: #ffffff; background-color: rgba(0, 0, 0, 0.8); border: 1px solid transparent; color: #ffffff; ">Неверный номер телефона, пример: +<%= phone_prefix %>000000000. </div> <input id="pozvonim-phone-input" class="input phone" name="phone" type="tel" maxlength="18" placeholder="+<%= phone_prefix %>" value="+<%= phone_prefix %>"/> <button id="pozvonim-button-element" class="btn call actionCall" type="submit"><%= window_text.button.select %></button> </form> <div class="text-center"> <p id="pozvonim-timer-element" class="timer">00:<%= call_time %>:00</p> </div> </div> </td> </tr> <tr> <td class="bottom"> <div class="table-row text-center text-small content-bottom"> <% if(copyright === 1) { if(user_id != 564){ %> <a href="<%= referal_url %>" target="_blank" class="copyright">Установить на свой сайт</a> <% }} %> </div> </td> </tr> </table> </body> </html>';
		desktop["src/assets/desktop/wrapper.ejs"] = '<style type="text/css">#pozvonim-button div {background: transparent none repeat scroll 0 0;} #pozvonim-wrapper, #pozvonim-cover, #pozvonim-wrapper iframe { background-attachment: scroll !important; background-color: transparent !important; background-image: none !important; background-position: 0 0 !important; background-repeat: repeat !important; border-color: black !important; border-color: currentColor !important; border-radius: 0 !important; border-style: none !important; border-width: medium !important; bottom: auto !important; clear: none !important; direction: inherit !important; float: none !important; font-family: inherit !important; font-size: inherit !important; font-style: inherit !important; font-variant: normal !important; font-weight: inherit !important; height: auto !important; left: auto !important; letter-spacing: normal !important; line-height: inherit !important; margin: 0 !important; max-height: none !important; max-width: none !important; min-height: 0 !important; min-width: 0 !important; opacity: 1; outline: invert none medium !important; overflow: visible !important; padding: 0 !important; position: static !important; right: auto !important; table-layout: auto !important; text-align: inherit !important; text-decoration: inherit !important; text-indent: 0 !important; text-transform: none !important; top: auto !important; vertical-align: baseline !important; visibility: inherit !important; white-space: normal !important; width: auto !important; word-spacing: normal !important; z-index: auto !important; overflow-x: visible !important; overflow-y: visible !important; word-break: normal !important; }  @keyframes pzv-inner-animation { 0% { transform: scale(1); } 40% { opacity: 0.9; transform: scale(1.2); } 100% { transform: scale(1.5); } }  @keyframes pzv-outer-animation { 0%, 100% { transform: scale(1.5); } 40% { transform: scale(1); } }  @keyframes pzv-phone-animation { 0%, 50%, 100% { transform: rotate(0deg); } 10%, 30% { transform: rotate(-25deg); } 20%, 40% { transform: rotate(25deg); } }  @-webkit-keyframes pzv-inner-animation { 0% { -webkit-transform: scale(1); } 40% { opacity: 0.9; transform: scale(1.2); -webkit-transform: scale(1.2); } 100% { -webkit-transform: scale(1.5); } }  @-webkit-keyframes pzv-outer-animation { 0%, 100% { -webkit-transform: scale(1.5); } 40% { -webkit-transform: scale(1); } }  @-webkit-keyframes pzv-phone-animation { 0%, 50%, 100% { -webkit-transform: rotate(0deg); } 10%, 30% { -webkit-transform: rotate(-25deg); } 20%, 40% { -webkit-transform: rotate(25deg); } }  @-moz-keyframes pzv-inner-animation { 0% { -moz-transform: scale(1); } 40% { opacity: 0.9; -moz-transform: scale(1.2); } 100% { -moz-transform: scale(1.5); } }  @-moz-keyframes pzv-outer-animation { 0%, 100% { -moz-transform: scale(1.5); } 40% { -moz-transform: scale(1); } }  @-moz-keyframes pzv-phone-animation { 0%, 50%, 100% { -moz-transform: rotate(0deg); } 10%, 30% { -moz-transform: rotate(-25deg); } 20%, 40% { -moz-transform: rotate(25deg); } }  #pozvonim-cover *, #pozvonim-cover *::before, #pozvonim-cover *::after, #pozvonim-button *, #pozvonim-button *::before, #pozvonim-button *::after, #pozvonim-wrapper *, #pozvonim-wrapper *::before, #pozvonim-wrapper *::after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }  #pozvonim-wrapper { position: fixed !important; z-index: 30000000 !important; min-width: 0 !important; }  #pozvonim-wrapper iframe { -webkit-transition: all 300ms ease 0s; -moz-transition: all 300ms ease 0s !important; -o-transition: all 300ms ease 0s !important; transition: all 300ms ease 0s !important; display: block !important; }  #pozvonim-wrapper .pozvonim-wrapper-opening { background-color: #e6e6e6 !important; }  #pozvonim-wrapper .pozvonim-wrapper-toggler { position: absolute !important; background-position: 50% 50% !important; background-repeat: no-repeat !important; cursor: pointer !important; }  #pozvonim-wrapper .pozvonim-wrapper-closing, #pozvonim-wrapper.opened .pozvonim-wrapper-opening { display: none !important; }  #pozvonim-wrapper .pozvonim-wrapper-opening, #pozvonim-wrapper.opened .pozvonim-wrapper-closing { display: block !important; }  #pozvonim-wrapper.TOP_LEFT { left: 0 !important; top: 0 !important; height: 100% !important; }  #pozvonim-wrapper.TOP_LEFT iframe { height: 100% !important; overflow-y: auto !important; overflow-x: hidden !important; margin-left: -320px !important; width: 320px !important; }  #pozvonim-wrapper.TOP_LEFT.opened iframe { margin-left: 0 !important; }  #pozvonim-wrapper.TOP_LEFT .pozvonim-wrapper-toggler { margin-top: -32.5px !important; width: 25px !important; height: 65px !important; top: 50% !important; }  #pozvonim-wrapper.TOP_LEFT .pozvonim-wrapper-opening { right: -25px !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAXCAYAAAAoRj52AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAAD0SURBVHjaXNExLwRRFIbhZ1ehUBGVCqGT0NlEYRU7CiIS+wPM7zCd+R/TqYRCRNysUiERSolCNAoqjYJgNNfkZk5zizffm3PP1xnsHxyiwHaoynNxurjEN3Yk08U9bjDM8mKyAaEqP3CFKQzSBIzwi90sLzopuIvKdcw1IOouMINemoDjqNvK8mIsBQ9xuz5mGxCq8gunUbeWJv63e8deGzzjBSttsIwFhDbYxDjOOnVdgywvJuInf9BPE6tYRMBbCoaoEUJV1t2omY7+R9ymJ+lhHqNQla8pyOJ70vQRNRt4wnVaVA9LOApV+dkGb7GPZv4GAHMLRBks9t3xAAAAAElFTkSuQmCC); border-radius: 0 3px 3px 0 !important; }  #pozvonim-wrapper.TOP_LEFT .pozvonim-wrapper-closing { right: 0 !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAXCAYAAAAoRj52AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAADySURBVHjaXNItS8RBEIDx51bRcEXh0GCRE8RmEQRf2qEYLIcfyS/hB9CkIIJBi+U4DAZBQREMBoNwRoPI8VhmZfwvLBtm57c7w6CS9ob6oR4W/q89YA64zben1Vf1Qe3kjE2gC9wAoxzox3kNUJl59TmojkrNWAOWgStgBFCAFrAT5+kfHMyT+qK26y8LsA6sAGfAV00owD7wHT6ZelMf1dncngLcAwvAYk4oYc8AvSa1pL6rQ3WqUqgT6rE6VlfzG2PgMtiDTKF2g7urRdZASz0Jbjs3UeA8uF6miAI/1YHapjEMR+qPutUchgtgEtj9HQCxFOt2q53iKQAAAABJRU5ErkJggg==); }  #pozvonim-wrapper.TOP_RIGHT { top: 0 !important; right: 0 !important; height: 100% !important; }  #pozvonim-wrapper.TOP_RIGHT iframe { height: 100% !important; width: 320px !important; margin-right: -320px !important; }  #pozvonim-wrapper.TOP_RIGHT.opened iframe { margin-right: 0 !important; }  #pozvonim-wrapper.TOP_RIGHT .pozvonim-wrapper-toggler { top: 50% !important; width: 25px !important; height: 65px !important; margin-top: -32.5px !important; }  #pozvonim-wrapper.TOP_RIGHT .pozvonim-wrapper-opening { left: -25px !important; border-radius: 3px 0 0 3px !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAXCAYAAAAoRj52AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAPlJREFUeNpi/P//PwMMuCXWeAOpLUDcwsSACvyA+A8Q72RCUi0IpEKA+CQQn0fW4QrEQkC8d9f8lq9MUNWMQCoAiP8B8R6QGEyHIhDbg4wA4nPIEhZALAXE20HGgCWAxjADaW+oMWtgFoJ0KACxA9Q115ElrKHGrAca8wtZIhiIP8BcgyxhAMRPgfgBusQuIFYBYn10ic1AzA7E7ugSINfcANkFdDo3ssQrqHGqQGwOlwA68T9U4j80dBmQg+QMEN8C2QM0TgQuAdT1EuoPJWi4MSDHxzpYnKFLHAXie0DsCDIOLgE07ieQWgbEOiDj0BPDdqjzLQACDABkKEGr78e33gAAAABJRU5ErkJggg==); }  #pozvonim-wrapper.TOP_RIGHT .pozvonim-wrapper-closing { left: 0 !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAXCAYAAAAoRj52AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAO5JREFUeNpc0r9qAkEQx/G9M2ghgoIkhY0YELs0gYB/ukOxsBEfyZfIAySVgSCkMI2FIhYWgoUiWFoIsbQQOS7fOXZhvIHPbTHsb2eXM1EUDXFCHcbxjTFLPKJrdNEtYoMDMnrHH6aooOE2+Hb9tWtfR7k4idrhyUUZGzdBFa86SmoED+14VbNnscdW4vSOC75Qw5tv7kvOuaLnSYyqAmbIJXeUUcI62QiQj89SU6WxwBHPuvGCEB9I6aiBvfAPQn25lY2pxJPaRsvGfMLTjxjYmG95cPfsEjPHGQU3jHyauOE9+TN08ICxvum/AAMA77jboW0LeaAAAAAASUVORK5CYII=); }  #pozvonim-wrapper.TOP_CENTER { left: 0 !important; top: 0 !important; height: auto !important; width: 100% !important; }  #pozvonim-wrapper.TOP_CENTER iframe { overflow-y: auto !important; overflow-x: hidden !important; width: 100% !important; margin-top: -300px !important; }  #pozvonim-wrapper.TOP_CENTER.opened iframe { margin: 0 !important; height: 300px !important; }  #pozvonim-wrapper.TOP_CENTER .pozvonim-wrapper-toggler { top: auto !important; left: 50% !important; margin-left: -32.5px !important; height: 15px !important; width: 65px !important; }  #pozvonim-wrapper.TOP_CENTER .pozvonim-wrapper-opening { bottom: -15px !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAGCAYAAAAooAWeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAADhSURBVHjapNGxK4VxFMbxz+8mBouJwSKDGK/ULUbeK4OB7mR6/R3X+P4f7z9ASRm8Bgzq2igbYVJKTAaDXsshdA1y6kznPN/nOZ2U5d0CPfSqsnj0z2pvbg2jieWU5d0HjOISR6j+ahTAWSxhES0MpCzvzmMFG5iM/RscYBtnVVm89AEOYgad0DfRwFPo9lJd1x/LQ1jAeiSYQsIVdsLsAhMxX4uEDdzjBLs4rMriGT7hP1KNYQ7t6Gm84hrjGAngMfbjZ7dVWXyD9YV/MUnxjxZWw+g8LjnFXVUWb7/p3wcAePZGK3bqMAgAAAAASUVORK5CYII=); border-radius: 0 0 3px 3px !important; }  #pozvonim-wrapper.TOP_CENTER .pozvonim-wrapper-closing { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAGCAYAAAAooAWeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAADXSURBVHjalJG9SoIBFIafD8IGl1xq8AbcxBAEp6iwQVq9E68goRsQwRtwc3Rx0aVoaGhokEh0SRDqAhrscfBIn4NSL5ztvM97fhKVA0qAU6AC3AI14AXoAw/AHFjtNe+BnwHlgNWAAvANvAN54ARYAGNgADwBM2AXpm7rWL1U2+pE/XGjN/VevVBzakltqo/qKno+1J7aiB5UUKvqnTr1V1O1E2HZ1ADpyqjF8D6ngr7UrlpP1GXc9RUYAcNY85O/KwucA9fAVfzoKFFbAfsv8FBQCbhZDwCN9MFYxMJfmAAAAABJRU5ErkJggg==); margin-top: 0 !important; bottom: 0 !important; }  #pozvonim-wrapper.BOTTOM_CENTER { left: 0 !important; bottom: 0 !important; height: auto !important; width: 100% !important; }  #pozvonim-wrapper.BOTTOM_CENTER iframe { overflow-y: auto !important; overflow-x: hidden !important; width: 100% !important; margin-bottom: -300px !important; }  #pozvonim-wrapper.BOTTOM_CENTER.opened iframe { margin: 0 !important; height: 300px !important; }  #pozvonim-wrapper.BOTTOM_CENTER .pozvonim-wrapper-toggler { margin-left: -32.5px !important; width: 65px !important; left: 50% !important; height: 15px !important; }  #pozvonim-wrapper.BOTTOM_CENTER .pozvonim-wrapper-opening { top: -15px !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAGCAYAAAAooAWeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAADhSURBVHjalNCxK0VxGMbxz09isJgYLDKI8UopRu6RwUAm0zl/xz3j+T/OP0BJGRwDBnVtlI0wKSUmg0HH8o73hmd9e77P+zypbVvDlBVlwhRWsI0MNzjEFZ6buvoe5k+D4FlRTmM5YBkW8IUHzGASL7jACfp4auqqHQjPinIca9jFBuaRcB+fnuIWs3HfiUYjEXSJI5w1dfUBqZv3VrGFfcxF6GPADnDd1NXngHZjWMRe+DsR9B6+49TNe6+x6x3O0aDf1NWbPyorygksRaP1aDSaunmvis3+BfwlqIPNnwEAthFGK1lcy2EAAAAASUVORK5CYII=); border-radius: 3px 3px 0 !important; bottom: auto !important; }  #pozvonim-wrapper.BOTTOM_CENTER .pozvonim-wrapper-closing { top: 0 !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAGCAYAAAAooAWeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDoAABSCAABFVgAADqXAAAXb9daH5AAAADUSURBVHjapJG9SoIBFIafD0KHb8nFBm+gTZRAcJIKG6TVO+kKErwBCboBt8YWF12MhoYGB5HElgQhL6BBH5dDGuhiL7zTeX845yRqC3gNfvN/pEAJuEnUBZAHRkAf6B1RlAJl4Bq4AirACWpVvVenbjFVH9RLNVXZw4xaDO+bugrvUn1UG7vibIR11LG6DvFEbas1NaeW1Dv1ZSfwS+2qzdCgkqj71jwDLoB68Bz4AT6AAnAKzIEB8BxnnAF/wg6F/87jHxXgNoregSdgCHwCq0PmzQCi5MFYiklGogAAAABJRU5ErkJggg==); }  #pozvonim-wrapper.CENTER { width: 100% !important; height: 100% !important; left: 0 !important; top: 0 !important; visibility: hidden !important; background-color: rgba(0, 0, 0, 0.3) !important; }  #pozvonim-wrapper.CENTER.opened { visibility: visible !important; }  #pozvonim-wrapper.CENTER iframe { border-radius: 5px !important; height: 380px !important; margin: -175px auto 0 !important; position: relative !important; top: 50% !important; width: 610px !important; display: none !important; }  #pozvonim-wrapper.CENTER.opened iframe { display: block !important; }  #pozvonim-wrapper.CENTER .pozvonim-wrapper-toggler { display: none !important; }  #pozvonim-button { transform-origin: center center 0 !important; -webkit-transform: rotateY(0deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>); -ms-transform: rotateY(0deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>); -o-transform: rotateY(0deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>); -moz-transform: rotateY(0deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>); transform: rotateY(0deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>); opacity: 0; width: auto !important; height: auto !important; cursor: pointer !important; position: absolute; display: block; z-index: 1000 !important; background: transparent none repeat scroll 0 0 !important; }  #pozvonim-button * { transform-origin: center center 0 !important; }  #pozvonim-button.pozvonim-dragging { -o-transition: none 0s ease 0s !important; -moz-transition: none 0s ease 0s !important; -webkit-transition: none 0s ease 0s !important; transition: none 0s ease 0s !important; }  #pozvonim-button .pozvonim-button-phone { /*-webkit-animation: pzv-phone-animation 1.2s ease-in-out 0s normal none infinite running; -moz-animation: pzv-phone-animation 1.2s ease-in-out 0s normal none infinite running; -o-animation: pzv-phone-animation 1.2s ease-in-out 0s normal none infinite running; animation: pzv-phone-animation 1.2s ease-in-out 0s normal none infinite running;*/ position: absolute !important; background-color: #4BC2CE !important; background-color: rgba(29, 179, 194, 0.8) !important; background-color: <%= window_style.opener_background%> !important; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAABECAYAAAA4E5OyAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAJKSURBVHja7Nk7aBRRFIDh/8QHPvBBQNTGRgVNZ7AI2Ai+sBOLiAabINgKirWCjQQRQUtLC8FCgoUprERsVLAzRhAUo60WIWrgt3BFXTK7i9nZZJxz4DZzL7tzv7mvMxMqGb+jLwkSJEESJEESJEESJEESJEESJEESJEESJEESJCNBeggSEV0pwHbgOTALjAHLmurLCbWrpUv3tEF97d/xUF1X1n3/Kkt1ytwAdjZdOwJMqGtK/eelNkLUQ7aOm2WOkOj2d5mFzm/1BbCnVRNgAHj13+8y6mAbDIAARuuy7e7osN2BuoC8bEyJdrGrFiARMQmc76BpaTvNkltUG2vJCeA2sLagySywujZH94i4Cxxt0WSqdrlMRDwGJguqn9YORO0DthZUj9cx2z0GrJ/n+jQwUSsQdRVwpaD6ekTM1W2EXAV2z3P9HXCrbsndSIvE7njZ6X9PQNSN6pYOMPapXwsw7pX5IHsCom5W76hzjU49UjcVYAypnwsw3qv9lQZRB9VP83RuSt3W1LlT6kwBxqw6VPZULxVEPah+abEWfFTPqMPqeJsXQiO9WPtKe0EEHAYeACu68FsXIuJaEUglkjvgDT/fmC80LkfEpVa7Y1VAZrqQiV6MiLF2x4WqHMzOLRDzZDuMyh3M1NE/ttpO45k6sFj33Yttd7/6tgOIafWsunwxH2RPPkOoK4HTwDCwF+gHvgMfgCeNNP5+RHz7l5FdlUW10pFf/xMkQRIkQRIkQRIkQRIkQRIkQRIkQRIkQRIkI0FaxI8BAMGiej+TuldEAAAAAElFTkSuQmCC); border-radius: 100% !important; height: 70px !important; width: 70px !important; left: 44px !important; top: 44px !important; z-index: 1000 !important; }  #pozvonim-button .pozvonim-button-border-inner { /*-webkit-animation: 2.3s ease-in-out 0s normal none infinite running pzv-outer-animation; -moz-animation: 2.3s ease-in-out 0s normal none infinite running pzv-outer-animation; -o-animation: 2.3s ease-in-out 0s normal none infinite running pzv-outer-animation; animation: 2.3s ease-in-out 0s normal none infinite running pzv-outer-animation;*/ border: 1px solid #68cafa !important; border: 1px solid <%= window_style.opener_inner_border%> !important; border-radius: 100% !important; opacity: 0.5 !important; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)" !important; height: 70px !important; left: 44px !important; top: 44px !important; width: 70px !important; position: absolute !important; z-index: 1000 !important; display: block !important; }  #pozvonim-button .pozvonim-button-border-outer { /*-webkit-animation: 2.3s ease-in-out 0s normal none infinite running pzv-inner-animation; -moz-animation: 2.3s ease-in-out 0s normal none infinite running pzv-inner-animation; -o-animation: 2.3s ease-in-out 0s normal none infinite running pzv-inner-animation; animation: 2.3s ease-in-out 0s normal none infinite running pzv-inner-animation;*/ border: 1px solid #9abfd3 !important; border: 1px solid <%= window_style.opener_outer_border%> !important; border-radius: 100% !important; width: 100px !important; height: 100px !important; left: 30px !important; top: 30px !important; position: absolute !important; z-index: 1000 !important; display: block !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-phone, #pozvonim-button:hover .pozvonim-button-phone { background-color: #79D000 !important; background-color: rgba(121, 208, 0, 0.8) !important; background-color: <%= window_style.opener_hover_background %> !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-border-inner, #pozvonim-button:hover .pozvonim-button-border-inner { border: 1px solid #b7de69 !important; border: 1px solid <%= window_style.opener_hover_inner_border %> !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-border-outer, #pozvonim-button:hover .pozvonim-button-border-outer { border: 1px solid #b7de69 !important; border: 1px solid <%= window_style.opener_hover_outer_border %> !important; }  #pozvonim-button .pozvonim-button-wrapper { padding: 0 !important; display: block !important; width: 160px !important; height: 160px !important; }  #pozvonim-cover { background-color: rgba(0, 0, 0, 0.25) !important; display: none; height: 100% !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 2000 !important; }  /*.pozvonim-animated { -o-transition: all 0.8s ease 0s; -moz-transition: all 0.8s ease 0s; -webkit-transition: all 0.8s ease 0s; transition: all 0.8s ease 0s; }*/  .pozvonim-hovered { -webkit-transform: rotateY(-360deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>) !important; -ms-transform: rotateY(-360deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>) !important; -o-transform: rotateY(-360deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>) !important; -moz-transform: rotateY(-360deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>) !important; transform: rotateY(-360deg) scale(<% if(button_size == 0){ %>1.0<% } else if(button_size == 1){%>1.3<%} else if(button_size == 2){%>1.5<%}%>) !important; }  <% if(button_animation === 0){%> #pozvonim-button { top: <%= button_position_y%>%; left: <%= button_position_x%>%; }  <%}%> <%if(button_text === 1) {%> #pozvonim-button.pozvonim-hovered .pozvonim-button-phone, #pozvonim-button:hover .pozvonim-button-phone { display: none !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-border-inner, #pozvonim-button:hover .pozvonim-button-border-inner { height: 90px !important; left: 33px !important; top: 33px !important; width: 90px !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-border-outer, #pozvonim-button:hover .pozvonim-button-border-outer { height: 100px !important; left: 28px !important; top: 28px !important; width: 100px !important; }  #pozvonim-button.pozvonim-hovered .pozvonim-button-text, #pozvonim-button:hover .pozvonim-button-text { display: block !important; }  #pozvonim-button .pozvonim-button-text { padding: 0 !important; background-color: <%= window_style.opener_hover_background %> !important; color: <%= window_style.opener_text_color %> !important; border-radius: 100% !important; display: none !important; width: 90px !important; height: 90px !important; left: 33px !important; top: 33px !important; margin: 0 !important; position: absolute; text-align: center !important; font-size: 14px !important; font-family: "Open Sans", "Helvetica Neue", "Helvetica", arial, sans-serif !important; font-weight: 500 !important; line-height: 19px !important; }  #pozvonim-button .pozvonim-button-center-text { vertical-align: middle; text-align: center; display: table-cell !important; height: 90px !important; width: 90px !important; word-break: break-all !important; line-height: 14px !important; padding: 0 !important; font-size: 14px !important; font-weight: 500 !important; font-family: "Open Sans", "Helvetica Neue", "Helvetica", arial, sans-serif !important; white-space: pre-wrap !important; }  <% } %> </style><% if(button === 1){ %> <div id="pozvonim-button" class="<%= button_position %>"> <div class="pozvonim-button-wrapper actionShow"> <% if (button_wawes === 1){ %> <div class="pozvonim-button-border-inner"></div> <div class="pozvonim-button-border-outer"></div> <% } %> <% if(button_text === 1){ %> <div class="pozvonim-button-text"><span class="pozvonim-button-center-text"><%= ($.trim(window_text.button.hover)) %></span></div> <% } %> <div class="pozvonim-button-phone"></div> </div> </div><% } %> <div id="pozvonim-wrapper" class="pozvonim-wrapper <%= window_position %>"> <% if(button_arrow){ %> <a class="pozvonim-wrapper-toggler pozvonim-wrapper-opening actionShow"></a> <a class="pozvonim-wrapper-toggler pozvonim-wrapper-closing actionHide"></a> <% } %> </div> <div id="pozvonim-cover" class="actionHide" style="display:none;"></div>';

		var offset,enterAt = new Date().getTime();
		var $ = jq,
			$window = $(window),
			$document = $(document),
			self = this,
			opts = $.extend(window.PozvonimcomWidgetRootConfig, (typeof window.PozvonimcomWidgetConfig === 'undefined' ? {
				lang:{"days": {"sunday": "Воскресенье", "monday": "Понедельник", "tuesday": "Вторник", "wednesday":"Среда", "thursday": "Четверг", "friday": "Пятница", "saturday": "Суббота"}}
			} : window.PozvonimcomWidgetConfig)),
			lang = {"ru":opts.lang},
			location = window.location.href,
			referer = window.document.referrer.replace('http://', '').replace('https://', ''),
			iframe,
			widgetState = {
				id: null,
				mouse: {x: 0, y: 0, nextX: 0, distance: 0},
				button: {isDragging: false, isDragged: false},
				events: {},
				scroll: {top: 0, left: 0},
				window: {width: 0, height: 0},

				isActive: true,
				isLocked: false,
				isReturned: false,
				isRating: false,
				isReported: false,
				isCalled: false,
				permanent: {
					enterPreviousAt: null,
					showPreviousAt: 0,
					returnCount: 0
				},
				session: {
					enterAt: null,
					enterSessionAt: null,
					showSessionCount: 0,
					sourceEnter: location,
					sourceReferer: referer,
					sourceCall: location
				}
			};


		var onScroll = function (event) {
				widgetState.scroll.top = $window.scrollTop();
				widgetState.scroll.left = $window.scrollLeft();
				if (opts.button === 1 && widgetState.isLocked === false) {
					if (opts.button_display === 0 && widgetState.scroll.top > 10) {
						self.api.Button.show();
					}

					var offset = {
						top: ((widgetState.window.height / 100 * widgetState.button.offsetTop) + widgetState.scroll.top - widgetState.button.height) ,
						left: ((widgetState.window.width / 100 * widgetState.button.offsetLeft) - widgetState.button.width)
					};
					if (offset.top < 0) offset.top = 0;
					if (offset.left < 0) offset.left = 0;
					
					offset.top += 'px';
					offset.left += 'px';
					self.elButton.css(offset);

				}
			},
			onResize = function (event) {
				widgetState.window = $.Utils.windowSize(window, document);
				if (opts.button === 1 && widgetState.isLocked === false) {
					var offset = {
						top: ((widgetState.window.height / 100 * widgetState.button.offsetTop) + widgetState.scroll.top - widgetState.button.height) ,
						left: ((widgetState.window.width / 100 * widgetState.button.offsetLeft) - widgetState.button.width)
					};
					if (offset.top < 0) offset.top = 0;
					if (offset.left < 0) offset.left = 0;
					offset.top += 'px';
					offset.left += 'px';
					self.elButton.css(offset);
				}
			},
			onMouse = function (event) {
				widgetState.mouse.y = widgetState.mouse.nextY;
				widgetState.mouse.x = event.clientX;
				widgetState.mouse.nextY = event.clientY;
				widgetState.mouse.distance += event.clientY;
			},
			onTimer = function (event) {
				if (!widgetState.isActive) {
					return;//false;
				}
				var timeStay = new Date().getTime() - widgetState.session.enterAt;
				if (
					opts.algoritms.onenter.enable === 1 &&
					widgetState.mouse.distance > 2000 &&
					timeStay > opts.algoritms.onenter.time * 1000
				) {
					return self.api.show('enter');
				}
				if (
					opts.algoritms.onexit.enable === 1 &&
					timeStay > opts.algoritms.onexit.time * 1000 &&
					widgetState.mouse.nextY < 200 &&
					widgetState.mouse.y / widgetState.mouse.nextY > 2
				) {
					var sessionStay = (new Date().getTime() - widgetState.session.enterSessionAt) / 1000;
					self.api.Element.staytime.html(
						[
							Math.round(sessionStay / 60 - 0.5),
							$.Utils.pluralDigits(sessionStay / 60 - 0.5, ['минуту', 'минуты', 'минут']),
							Math.round(sessionStay % 60),
							$.Utils.pluralDigits(sessionStay % 60, ['секунду', 'секунды', 'секунд'])
						].join(" ")
					);
					return self.api.show('exit');
				}
				if (
					opts.algoritms.onwait.enable === 1 &&
					timeStay > opts.algoritms.onwait.time * 1000 &&
					widgetState.mouse.distance > 2000
				) {
					return self.api.show('wait');
				}
				if (
					opts.algoritms.onreturn.enable === 1 &&
					widgetState.isReturned === 1 &&
					timeStay > 15 * 1000 &&
					widgetState.mouse.distance > 10000
				) {

					self.api.Element.returncount.html((widgetState.permanent.returnCount || 1) + ' ' + $.Utils.pluralDigits((widgetState.permanent.returnCount || 1), ['раз', 'раза','раз']));
					return self.api.show('return');
				}
				/*if(
				 opts.api_algoritm_code.length > 5

				 )*/
				window.setTimeout(onTimer, 300);
			},
			onInit = function () {
				var index, html;
				if (opts.blacklist_referer) {
					for (index = 0; index < opts.blacklist_referer.length; index++) {
						if (new RegExp(opts.blacklist_referer[index]).test(referer)) {
							self.elWrapper.remove();
							self.elButton.remove();
							throw new Error('CustomError: this referer blocked by owner');
						}
					}
				}
				if (opts.blacklist_url) {
					for (index = 0; index < opts.blacklist_url.length; index++) {

						if (new RegExp(opts.blacklist_url[index]).test(window.location.pathname)) {
							self.elWrapper.remove();
							self.elButton.remove();
							throw new Error('CustomError: this page blocked by owner');
						}
					}
				}
				if (opts.working === 0) {
					html = '';
					$.each(opts.schelude, function (it, item) {
						if(
							it != "sunday" &&
							it != "monday" &&
							it != "tuesday" &&
							it != "wednesday" &&
							it != "thursday" &&
							it != "friday" &&
							it != "saturday"
						){
							return;
						}
						var from = opts.schelude[it].from.split(':');
						from[0] = parseInt(from[0]);
						from[1] = parseInt(from[1]);
						var to = opts.schelude[it].to.split(':');
						to[0] = parseInt(to[0]);
						to[1] = parseInt(to[1]);
						opts.schelude[it].from = from;
						opts.schelude[it].to= to;
						if (item.enable === 0) {
							html +=
								'<option value="' + it + '" class="disabled" disabled="disabled" ' + (it === opts.widget_date.day_name ? 'selected="selected"' : '') + '>'
								+ lang.ru.days[it] +
								'</option>';
						} else {
							if (it === opts.widget_date.day_name && opts.widget_date.hour >= opts.schelude[it].to[0]) {
								html +=
									'<option value="' + it + '" class="disabled" disabled="disabled" ' + (it === opts.widget_date.day_name ? 'selected="selected"' : '') + '>'
									+ lang.ru.days[it] +
									'</option>';
							} else {
								html +=
									'<option value="' + it + '" ' + (it === opts.widget_date.day_name ? 'selected="selected"' : '') + '>'
									+ lang.ru.days[it] +
									'</option>';
							}
						}
					});
					html = $(html);
					if (html.filter(':selected').prop('disabled')) {
						var next = html.filter(':selected').nextAll(':not(.disabled)').eq(0);
						if (next.size() == 0) {
							html.filter(':selected').prop('selected', false);
						} else {
							next.prop('selected', true);
						}
					}
					self.api.Input.delayed.day.html(html);
					if(self.api.Input.delayed.day.find('option').size() == 0){
						self.api.Input.delayed.day.get(0).insertAdjacentHTML('beforeend',html);
					}
					self.api.Input.delayed.day.on('change', function (event) {
						var options = '';
						var day = self.api.Input.delayed.day.val();
						var hour = self.api.Input.delayed.hour;
						if (!day) {
							day = 'monday';
						}
						if (!hour) {
							hour = 9;
						}
						var selected = opts.schelude[day];
						for (var it = selected.from[0]; it < selected.to[0] && it < 24; it++) {
							options += '<option value="' + it + '">' + $.Utils.padZero(it, 2) + '</option>';
						}
						hour.html(options);
						if(hour.find('option').size() == 0){
							hour.get(0).insertAdjacentHTML('beforeend',options);
						}
						self.api.Input.delayed.hour.trigger('change');
					});

					self.api.Input.delayed.hour.on('change', function (event) {
						var options = '';
						var day = self.api.Input.delayed.day.val();
						var hour = self.api.Input.delayed.hour.val();
						var minute = self.api.Input.delayed.minute;
						if (!day) {
							day = 'monday';
						}
						if (!hour) {
							hour = 9;
						}
						var selected = opts.schelude[day];

						for (var it = (hour == selected.from[0] ? selected.from[1] : 0); it <= (hour == selected.to[0] ? selected.to[1] : 50); it+=10) {
							options += '<option value="' + it + '">' + $.Utils.padZero(it, 2) + '</option>';
						}
						minute.html(options);
						if(minute.find('option').size() == 0){
							minute.get(0).insertAdjacentHTML('beforeend',options);
						}
					});

					self.api.Input.delayed.day.trigger('change');
				}
				if (opts.report_analytic === 1) {
					self.elWidget.find('.rating .input').on('click', ratingSend);
				}
				if (opts.tracking_google_enable === 1) {
					self.api.on('call.success',
						function (number) {
							try {
								ga('send', 'event', 'button', opts.tracking_google_target, 'widget', number);
							} catch (e) {
								PozvonimcomWidgetEvent(
									PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'CustomError: User google analytic error'), {}, e
								);
							}
						}
					);
					self.api.on('call.delayed',
						function (number) {
							try {
								ga('send', 'event', 'button', opts.tracking_google_target, 'widget', number);
							} catch (e) {
								PozvonimcomWidgetEvent(
									PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'CustomError: User google analytic error'), {}, e
								);
							}
						}
					);
				}
				if (opts.tracking_yandex_enable === 1) {
					self.api.on('call.success',
						function (number) {
							try {
								$.each(Ya.Metrika.counters(), function (index, counter) {
									window['yaCounter' + counter.id].reachGoal(opts.tracking_yandex_target);
								});
							}
							catch (e) {
								PozvonimcomWidgetEvent(
									PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'CustomError: User yandex metrika error'), {}, e
								);
							}
						}
					);
					self.api.on('call.delayed',
						function (number) {
							try {
								$.each(Ya.Metrika.counters(), function (index, counter) {
									window['yaCounter' + counter.id].reachGoal(opts.tracking_yandex_target);
								});
							}
							catch (e) {
								PozvonimcomWidgetEvent(
									PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'CustomError: User yandex metrika error'), {}, e
								);
							}
						}
					);
				}
				if (opts.button === 1) {
					widgetState.window = $.Utils.windowSize(window, document);
					if (opts.button_animation === 1) {
						//self.elButton.addClass('pozvonim-animated');
					}
					if (opts.button_drag === 1){
						self.elButton.drags({
							start: function (){
								widgetState.button.isDragging = true;
								widgetState.button.isDragged = false;
							},
							stop: function (){
								widgetState.button.isDragging = false;
								window.setTimeout(function (){widgetState.button.isDragged = false;}, 0);
							},
							move: function (){
								if (widgetState.button.isDragging){
									widgetState.button.isDragged = true;
								}
							}
						});
					}
					if (opts.button_text_show === 1) {
						window.setInterval(function () {
							self.elButton.toggleClass('pozvonim-hovered');
						}, 5000);
					}
					if (opts.button_display === 0) {
						self.api.Button.hide();
					}
				}
				if (opts.api_enable === 1) {
					try {
						var callback;
						if(typeof opts.ready === 'function') callback = opts.ready;
						else if(typeof window[opts.ready] ===  'function') callback = window[opts.ready];
						else if(typeof window[opts.api_callback]) callback = window[opts.api_callback];
						if (typeof callback === 'function') {
							callback.apply(self);
						}
					}
					catch (e) {
						PozvonimcomWidgetEvent(
							PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'CustomError: User onReady function error'), {}, e
						);
					}
				}
				PozvonimcomWidgetEvent(
					PozvonimcomWidgetEvent.prototype.TYPE.LOADED,
					'Event: widget called onReady'
				);
				return true;
			},

			ratingSend = function (event) {
				event.preventDefault();
				event.stopPropagation();
				if (widgetState.isRating) {
					return;
				}
				widgetState.isRating = true;
				self.api.rating($(event.currentTarget).val());
				self.elWidget.find('.text-analytic').html('Спасибо, ваше мнение учтено.');
				self.elWidget.find('.rating').hide();
			},
			reportSend = function (event) {
				event.preventDefault();
				event.stopPropagation();
				if (widgetState.isReported) {
					return;
				}
				widgetState.isReported = true;
				self.api.report(0);
				self.elWidget.find('.report').addClass('disabled');
				self.elWidget.find('.reported').show();
			},
			callSend = function (event) {
				event.preventDefault();
				event.stopPropagation();
				if (widgetState.isCalled) {
					return false;
				}
				var delayed,
					wait = {s: opts.call_time - 1, ms: 9},
					timer = function () {
						if (wait.ms <= 1) {
							wait.ms = 9;
							wait.s--;
						}
						wait.ms--;
						if (wait.s <= 0) {
							self.api.Content.call.hide();
							self.api.Content.final.show();
							return true;
						}
						self.api.Element.timer.html(['00:', wait.s > 9 ? '' : '0', wait.s, ':', wait.ms, '9'].join(''));
						window.setTimeout(timer, 100);
					},
					status = self.api.call({
						phone: self.api.Input.phone.val(),
						region: self.api.Input.region.val(),
						delayed: (opts.working === 1 ? false : self.api.getDelayed())
					});
				if (status === 'validation') {
					self.api.Input.phone.focus();
					self.api.Input.phone.addClass('error');
					self.api.Element.validation.fadeIn();
					window.setTimeout(
						function () {
							self.api.Element.validation.fadeOut();
							self.api.Input.phone.removeClass('error');
						}, 2000
					);
					return false;
				}
				widgetState.isCalled = true;
				if (status === 'blacklist') {
					self.api.Content.call.hide();
					self.api.Content.balance.show();
				}
				if (status === 'balance') {
					self.api.Content.call.hide();
					self.api.Content.balance.show();
				}
				if (status === 'delayed') {
					self.api.Content.call.hide();
					self.api.Content.offline.show();
				}
				if (status === 'call') {
					self.api.Input.phone.addClass('disabled');
					self.api.Element.button.addClass('disabled');
					self.api.Input.phone.attr('disabled', true);
					self.api.Element.button.attr('disabled', true);
					self.api.Element.button.html("Звоним...");
					timer();
				}
				return false;
			};

		var height = '100%';
		if (opts.window_position == 'CENTER') height = '385px';
		if (opts.window_position == 'BOTTOM_CENTER' || opts.window_position == 'TOP_CENTER') height = '300px';
		if (opts.window_position == 'TOP_LEFT' || opts.window_position == 'TOP_RIGHT') height = '100%';


		$('body').append( $.template(desktop["src/assets/desktop/wrapper.ejs"])(opts));
		$('#pozvonim-wrapper').append( '<iframe id="pozvonim-frame" class="' + opts.window_position + '" style="height:' + height + ' !important;" frameborder="0" name="pozvonim-frame" scrolling="yes" allowtransparency="true"></iframe>');

		iframe = $('#pozvonim-frame').get(0);
		iframe = iframe.contentDocument || iframe.contentWindow.document;
		iframe.open();
		iframe.write($.template(desktop["src/assets/desktop/iframe.ejs"])(opts));
		iframe.close();
		this.$ = $;

		this.elWrapper = $('#pozvonim-wrapper');
		this.elWidget = $(iframe).find('#pozvonim-widget');
		this.elButton = $('#pozvonim-button');
		this.elCover = $('#pozvonim-cover');
		var Api = (function () {
			return {
				getStayTime: function (){
					return (new Date().getTime() - widgetState.session.enterSessionAt) / 1000;
				},
				style:function (link){
					var cssLink = document.createElement("link");
					cssLink.href = link;
					cssLink.rel = "stylesheet";
					cssLink.type = "text/css";
					frames['pozvonim-frame'].document.body.appendChild(cssLink);
				},
				request: function (options, data) {
					options.url = opts.apiPath + options.url;
					var params = $.extend(
						{
							method: 'POST',
							async: true,
							cache: false,
							timeout: 30000,
							dataType: 'json',
							data: $.extend(
								self.api.getClient(),
								data || {}
							),
							xhrFields: {withCredentials: true},
							crossDomain: true
						}, options || {}
					);

					return $.ajax(params);
				},
				show: function (event) {
					if (widgetState.button.isDragged) {
						return ;//false;
					}
					if (typeof event !== "string") {
						event = 'click';
					}
					if (opts.working === 0) {
						event = 'offline';
					}
					if (opts.window_cover === 1) {
						self.elCover.css('display','block');//show();
					}
					if (event != 'click') {
						widgetState.isActive = false;
						widgetState.session.showSessionCount++;
						widgetState.permanent.showPreviousAt = new Date().getTime();
						self.api.Storage.save('permanent', widgetState.permanent, 3600 * 24 * 30);
					}
					widgetState.catchType = event;
					widgetState.isLocked = true;
					self.api.Button.hide();
					self.api.Content.call.find('.events').hide();
					self.api.Content.call.find('.' + event).show();
					self.elWrapper.addClass('opened');
					PozvonimcomWidgetEvent(
						PozvonimcomWidgetEvent.prototype.TYPE.OPENED,
						'Widget called api function show:' + event
					);
				},
				hide: function (event) {
					widgetState.isLocked = false;
					self.api.Button.show();
					self.elCover.hide();
					self.elWrapper.removeClass('opened');
					onScroll();
				},
				on: function (type, callback) {
					if (!widgetState.events[type]) {
						widgetState.events[type] = [];
					}
					widgetState.events[type].push(callback);

				},
				event: function (type, data) {
					$.each(widgetState.events[type] || [], function (index, callback) {
						try {
							callback.apply(self, [data]);
						} catch (e) {
							PozvonimcomWidgetEvent(
								PozvonimcomWidgetEvent.prototype.TYPE.ERROR, 'User event handler error', {}, e
							);
						}
					});
				},
				report: function (status) {
					self.api.event('report', self.api.getPhone());
					self.api.request({url: ''}, {call_id: widgetState.id, status: status, action: 'callback', exec: 'report'});
				},
				rating: function (rating) {
					self.api.event('rating', self.api.getPhone());
					self.api.request({url: ''}, {call_id: widgetState.id, rating: rating, action: 'callback', exec: 'rating'});
				},
				call: function (options) {
					var status,
						number = options.phone.replace(/[^0-9]/g, '') || '',
						region = options.region || '',
						delayed = options.delayed || false;

					//var re = new RegExp('^(' + opts.prefixes.join('|') + '0' + ')[0-9]{7,20}$');
					var re = new RegExp('^(' + opts.prefixes.join('|') + ')[0-6,8,9][0-9]{9}$');
					//console.log(re);
					
					if (!number.match(re)) {
					 return 'validation';
					 }

					if (opts.blacklist_phone) {
						var normalizeNumber = number.replace(/[^0-9]/g, '');
						for (var key = 0; key < opts.blacklist_phone.length; key++) {
							if (new RegExp(opts.blacklist_phone[key]).test(normalizeNumber)) {
								return 'blacklist';
							}
						}
					}
					widgetState.session.sourceCall = window.location.href;
					PozvonimcomWidgetEvent(
						PozvonimcomWidgetEvent.prototype.TYPE.CALL,
						'Widget called api function call'
					);
					self.api.event('call.before', number);
					self.api.event('call', number);
					if (delayed !== false) {
						self.api.event('call.delayed', number);
						self.api.request(
							{
								url: '',
								success: function (respond) {
									widgetState.id = respond.id;
								}
							},
							{phone: number, region: region, delayed: delayed.join(':'), action: 'callback', exec: 'call-delayed'}
						);
						status = 'delayed';
					} else {
						self.api.event('call.success', number);
						self.api.request(
							{
								url: '',
								success: function (respond) {
									widgetState.id = respond.id;
								}
							},
							{phone: number, region: region, action: 'callback', exec: 'call'}
						);
						status = 'call';
					}
					if (opts.balance === 0) {
						self.api.event('call.balance', number);
						status = 'balance';
					}
					return status;
				},
				getState: function () {
					return widgetState;
				},
				getClient: function () {
					return {
						source_enter: widgetState.session.sourceEnter,
						source_referer: widgetState.session.sourceReferer,
						source_call: widgetState.session.sourceCall,
						catch_type: widgetState.catchType,
						return_count: widgetState.session.isReturned
					};
				},
				getOptions: function () {
					return opts;
				},setOptions: function (key,value) {
					opts[key] = value;
				},
				getPhone: function () {
					return self.api.Input.phone.val();
				},
				setPhone: function (phone) {
					return self.api.Input.phone.val(phone);
				},
				getDelayed: function () {
					return [
						self.api.Input.delayed.day.val(),
						self.api.Input.delayed.hour.val(),
						self.api.Input.delayed.minute.val()
					];
				},
				setDelayed: function (options) {
					self.Input.delayed.day.val(options[0] || 'monday');
					self.Input.delayed.hour.val(options[1] || '9');
					self.Input.delayed.minute.val(options[2] || '00');
				},
				Input: {
					phone: self.elWidget.find('#pozvonim-phone-input'),
					region: self.elWidget.find('#pozvonim-region-input'),
					delayed: {
						day: self.elWidget.find('#pozvonim-delay-day-input'),
						hour: self.elWidget.find('#pozvonim-delay-hour-input'),
						minute: self.elWidget.find('#pozvonim-delay-minute-input')
					}
				},
				Element: {
					timer: self.elWidget.find('#pozvonim-timer-element'),
					button: self.elWidget.find('#pozvonim-button-element'),
					validation: self.elWidget.find('#pozvonim-validation-element'),
					staytime: self.elWidget.find('#pozvonim-element-staytime'),
					returncount: self.elWidget.find('#pozvonim-element-returncount')
				},
				Content: {
					call: self.elWidget.find('#pozvonim-element-call'),
					final: self.elWidget.find('#pozvonim-element-final'),
					balance: self.elWidget.find('#pozvonim-element-balance'),
					offline: self.elWidget.find('#pozvonim-element-offline')
				},
				Button: {
					show: function () {
						self.elButton.show();
					},
					hide: function () {
						self.elButton.hide();
					},
					update: function () {

					}
				},
				Storage: {
					prefix: 'pozvonimcom',
					load: function (id) {
						id = id || 'session';
						try {
							var rawData =$.getCookie([this.prefix, id, opts.id].join(':'), '{}');
							if(rawData[rawData.length-1] == '/'){
								rawData = rawData.substr(0, rawData.length-1);
							}
							return $.parseJSON(rawData);
						} catch (e) {
							PozvonimcomWidgetEvent(
								PozvonimcomWidgetEvent.prototype.TYPE.ERROR,
								(e ? e.toString() : 'CustomError: Storage load error'),
								{loaded:rawData},
								e
							);
							return {}
						}
					},
					save: function (id, data, expires) {
						id = id || 'session';
						data = data || {};
						expires = expires || false;
						try {
							var rawData = JSON.stringify(data);
							if(rawData[rawData.length-1] == '/'){
								rawData = rawData.substr(0, rawData.length-1);
							}
							$.setCookie([this.prefix, id, opts.id].join(':'), rawData, {expires: expires});
						} catch (e) {
							PozvonimcomWidgetEvent(
								PozvonimcomWidgetEvent.prototype.TYPE.ERROR,
								(e ? e.toString() : 'CustomError: Storage load error'),
								{saved:rawData},
								e
							);
						}
					}
				}
			}
		})();
		this.api = Api;
		//window.frames['pozvonim-frame'].PozvonimcomWidget = self;
		offset = {top: 'auto', left: 'auto', right: 'auto', bottom: 'auto'};
		switch (opts.button_position) {
			case 'TOP_LEFT':
				offset.top = 0;
				offset.left = 0;
				offset.right = 'auto';
				offset.bottom = 'auto';
				break;
			case 'TOP_RIGHT':
				offset.top = 0;
				offset.left = 100;
				offset.right = 'auto';
				offset.bottom = 'auto';
				break;
			case 'BOTTOM_LEFT':
				offset.top = 100;
				offset.bottom = 'auto';
				offset.right = 'auto';
				offset.left = 0;
				break;
			case 'BOTTOM_RIGHT':
				offset.top = 100;
				offset.bottom = 'auto';
				offset.left = 100;
				offset.right = 'auto';
				break;
			case 'CUSTOM':
				offset.top = opts.button_position_y;
				offset.bottom = 'auto';
				offset.left = opts.button_position_x;
				offset.right = 'auto';
				break;
		}
		widgetState.window = $.Utils.windowSize(window, document);
		widgetState.scroll.top = $window.scrollTop();
		widgetState.scroll.left = $window.scrollLeft();
		widgetState.button.width = 80;
		widgetState.button.height = 80;

		
		if (offset.top >= 0 && offset.top <= 40) {
			widgetState.button.height = 0;
		}
		if (offset.top >= 41 && offset.top <= 70) {
			widgetState.button.height = 80;
		}
		if (offset.top >= 71 && offset.top <= 100) {
			widgetState.button.height = 195;
		}

		if (offset.left >= 0 && offset.left <= 40) {
			widgetState.button.width = 0;
		}
		if (offset.left >= 41 && offset.left <= 70) {
			widgetState.button.width = 80;
		}
		if (offset.left >= 71 && offset.left <= 100) {
			widgetState.button.width = 178;
		}
		

		widgetState.button.offsetTop = offset.top;
		widgetState.button.offsetLeft = offset.left;

		if (opts.button_size === 1) {
			widgetState.button.width = (widgetState.button.width-(widgetState.button.width > 80 ? 20:0))*1.3;
			widgetState.button.height = (widgetState.button.height-(widgetState.button.height > 80 ? 20:0))*1.3;
		}
		if (opts.button_size === 2) {
			widgetState.button.width = (widgetState.button.width-(widgetState.button.width > 80 ? 20:0))*1.5;
			widgetState.button.height = (widgetState.button.height-(widgetState.button.height > 80 ? 20:0))*1.5;
		}
		offset = {
			top: (widgetState.window.height / 100 * widgetState.button.offsetTop) - widgetState.button.height ,
			left: ((widgetState.window.width / 100 * widgetState.button.offsetLeft) - widgetState.button.width),
		};
		if (offset.left !== 'auto') {
			offset.left += 'px';
		}
		self.elButton.css(offset);

		widgetState.permanent = $.extend(widgetState.permanent, this.api.Storage.load('permanent'));
		widgetState.session = $.extend(widgetState.session, this.api.Storage.load('session'));
		if (widgetState.session.enterSessionAt === null) {
			widgetState.session.enterSessionAt = enterAt;
		}
		widgetState.session.enterAt = enterAt;
		if (widgetState.session.enterAt === widgetState.session.enterSessionAt) {
			widgetState.session.sourceEnter = location;
			widgetState.session.sourceReferer = referer;
		}
		if (widgetState.permanent.enterPreviousAt !== widgetState.session.enterSessionAt) {
			widgetState.permanent.returnCount++;
			widgetState.isReturned = 1;
		}
		self.api.Element.returncount.html((widgetState.permanent.returnCount || 1) + ' ' + $.Utils.pluralDigits((widgetState.permanent.returnCount || 1), ['раз', 'раза','раз']));
		var elapsed = (widgetState.session.enterAt - widgetState.permanent.showPreviousAt) / 1000 / 3600;
		if (elapsed < 24 && opts.period === 1) {
			widgetState.isActive = false;
		}
		if (elapsed < 24 * 7 && opts.period === 2) {
			widgetState.isActive = false;
		}
		if (elapsed < 24 * 30 && opts.period === 3) {
			widgetState.isActive = false;
		}
		self.api.Storage.save('permanent', widgetState.permanent, 3600 * 24 * 30);
		self.api.Storage.save('session', widgetState.session);

		var $link = $('a[href*="#pozvonim"]');
		if($link.size() > 0 && $link.get(0) !== undefined){
			$link.on('click tab dblclick', Api.show);
		}
		if (opts.api_button_selector && opts.api_button_selector.length > 0){
			console.log($(opts.api_button_selector));
			$(opts.api_button_selector).on('click tab dblclick', Api.show);
		}
		$link = $('.actionShow');
		if($link.size() > 0 && $link.get(0) !== undefined) {
			$link.on('click tab dblclick', Api.show);
		}

		$('.actionHide').on('click tab dblclick', Api.hide);
		$link = this.elWidget.find('.actionShow');
		if($link.size() > 0 && $link.get(0) !== undefined) {
			$link.on('click tab dblclick', Api.show);
		}
		this.elWidget.find('.actionHide').on('click tab dblclick', Api.hide);
		this.elWidget.find('.actionReport').on('click tab dblclick', reportSend);

		this.elWidget.find('button.actionCall').on('click tab dblclick', callSend);
		this.elWidget.find('form.actionCall').on('submit', callSend);
		if(opts.id==18568){
			$.Utils.windowSize = function (window,document) {
				var w = window,
					d = document,
					e = d.documentElement,
					g = d.getElementsByTagName('body')[0],
					x = w.innerWidth || e.clientWidth,
					y = w.innerHeight || e.clientHeight || g.clientHeight;

				x = g.clientWidth + ((x - g.clientWidth) / 2);

				return {width: x, height: y};
			}
		}

		if(opts.id==18568){
			$.Utils.windowSize = function (window,document) {
				var w = window,
					d = document,
					e = d.documentElement,
					g = d.getElementsByTagName('body')[0],
					x = w.innerWidth || e.clientWidth,
					y = w.innerHeight || e.clientHeight || g.clientHeight;
					x = g.clientWidth + ((x - g.clientWidth) / 2);
				return {width: x, height: y};
			}
		}

		$window.on('mousemove', onMouse);
		$window.on('scroll', onScroll);
		$window.on('resize', onResize);

		onInit();
		onScroll();
		onTimer();



		$(document).ready(function () {
			self.elButton.css('opacity', .8);
			try{
				self.api.Input.phone.intlTelInput({
					utilsScript: "phone.utils-0.1.js",
					autoFormat: true,
					autoHideDialCode: false,
					//defaultCountry: "auto",
					nationalMode: true,
					numberType: "",
					onlyCountries: ['ru'],
					preferredCountries: [],
					responsiveDropdown: false
				});
			}
			catch(e){
				PozvonimcomWidgetEvent(PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : ''), {}, e);
			}
		});

	}
	try {
		if(typeof window.PozvonimcomWidget === 'undefined')
		{
			jq(document).ready(function () {
				window.PozvonimcomWidget = new PozvonimcomWidgetPrototype(window, document, jq);
			});
		}
	} catch (e) {
		PozvonimcomWidgetEvent(PozvonimcomWidgetEvent.prototype.TYPE.ERROR, (e ? e.toString() : 'Catched error'), {}, e);
		throw e;
	}
})(window,document);
