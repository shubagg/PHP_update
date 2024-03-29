/*	
 * jQuery mmenu v4.0.2
 * @requires jQuery 1.7.0 or later
 *
 * mmenu.frebsite.nl
 *	
 * Copyright (c) Fred Heusschen
 * www.frebsite.nl
 *
 * Dual licensed under the MIT and GPL licenses.
 * http://en.wikipedia.org/wiki/MIT_License
 * http://en.wikipedia.org/wiki/GNU_General_Public_License
 */

! function (a) {
	function j(c, d, e) {
		if ("object" != typeof c && (c = {}), e) {
			if ("boolean" != typeof c.isMenu) {
				var f = e.children();
				c.isMenu = 1 == f.length && f.is(d.panelNodeType)
			}
			return c
		}
		if ("object" != typeof c.onClick && (c.onClick = {}), "undefined" != typeof c.onClick.setLocationHref && (a[b].deprecated("onClick.setLocationHref option", "!onClick.preventDefault"), "boolean" == typeof c.onClick.setLocationHref && (c.onClick.preventDefault = !c.onClick.setLocationHref)), c = a.extend(!0, {}, a[b].defaults, c), a[b].useOverflowScrollingFallback()) {
			switch (c.position) {
				case "top":
				case "right":
				case "bottom":
					a[b].debug('position: "' + c.position + '" not supported when using the overflowScrolling-fallback.'), c.position = "left"
			}
			switch (c.zposition) {
				case "front":
				case "next":
					a[b].debug('z-position: "' + c.zposition + '" not supported when using the overflowScrolling-fallback.'), c.zposition = "back"
			}
		}
		return c
	}

	function k(c) {
		return "object" != typeof c && (c = {}), c = a.extend(!0, {}, a[b].configuration, c), "string" != typeof c.pageSelector && (c.pageSelector = "> " + c.pageNodetype), c
	}

	function l() {
		d.$wndw = a(window), d.$html = a("html"), d.$body = a("body"), d.$allMenus = a(), a.each([e, g, f], function (a, b) {
			b.add = function (a) {
				a = a.split(" ");
				for (var c in a) b[a[c]] = b.mm(a[c])
			}
		}), e.mm = function (a) {
			return "mm-" + a
		}, e.add("menu ismenu panel list current highest hidden page blocker modal background opened opening subopen fullsubopen subclose subopened subtitle selected label nooverflowscrolling"), e.umm = function (a) {
			return "mm-" == a.slice(0, 3) && (a = a.slice(3)), a
		}, g.mm = function (a) {
			return "mm-" + a
		}, g.add("parent style scrollTop offetLeft"), f.mm = function (a) {
			return a + ".mm"
		}, f.add("toggle open opening opened close closing closed keydown resize setPage setSelected transitionend touchstart touchend click scroll"), a[b].support.touch || (f.touchstart = f.mm("mousedown"), f.touchend = f.mm("mouseup")), a[b]._c = e, a[b]._d = g, a[b]._e = f, a[b].glbl = d, a[b].useOverflowScrollingFallback(i)
	}

	function m(b, c) {
		if (b.hasClass(e.current)) return !1;
		var d = a("." + e.panel, c),
			f = d.filter("." + e.current);
		return d.removeClass(e.highest).removeClass(e.current).not(b).not(f).addClass(e.hidden), b.hasClass(e.opened) ? f.addClass(e.highest).removeClass(e.opened).removeClass(e.subopened) : (b.addClass(e.highest), f.addClass(e.subopened)), b.removeClass(e.hidden).removeClass(e.subopened).addClass(e.current).addClass(e.opened), "open"
	}

	function n() {
		return d.$scrollTopNode || (0 != d.$html.scrollTop() ? d.$scrollTopNode = d.$html : 0 != d.$body.scrollTop() && (d.$scrollTopNode = d.$body)), d.$scrollTopNode ? d.$scrollTopNode.scrollTop() : 0
	}

	function o(c, d, e) {
		var g = a[b].support.transition;
		"webkitTransition" == g ? c.one("webkitTransitionEnd", d) : g ? c.one(f.transitionend, d) : setTimeout(d, e)
	}

	function p(b, c, d, e) {
		"string" == typeof b && (b = a(b));
		var g = d ? f.touchstart : f.click;
		e || b.off(g), b.on(g, function (a) {
			a.preventDefault(), a.stopPropagation(), c.call(this, a)
		})
	}
	var b = "mmenu",
		c = "4.0.2";
	if (!a[b]) {
		var d = {
				$wndw: null,
				$html: null,
				$body: null,
				$page: null,
				$blck: null,
				$allMenus: null,
				$scrollTopNode: null
			},
			e = {},
			f = {},
			g = {},
			h = 0;
		a[b] = function (a, b, c) {
				return d.$allMenus = d.$allMenus.add(a), this.$menu = a, this.opts = b, this.conf = c, this.serialnr = h++, this._init(), this
			}, a[b].prototype = {
				open: function () {
					return this._openSetup(), this._openFinish(), "open"
				},
				_openSetup: function () {
					var a = n();
					this.$menu.addClass(e.current), d.$allMenus.not(this.$menu).trigger(f.close), d.$page.data(g.style, d.$page.attr("style") || "").data(g.scrollTop, a).data(g.offetLeft, d.$page.offset().left);
					var b = 0;
					d.$wndw.off(f.resize).on(f.resize, function (a, c) {
						if (d.$html.hasClass(e.opened) || c) {
							var f = d.$wndw.width();
							f != b && (b = f, d.$page.width(f - d.$page.data(g.offetLeft)))
						}
					}).trigger(f.resize, [!0]), this.conf.preventTabbing && d.$wndw.off(f.keydown).on(f.keydown, function (a) {
						return 9 == a.keyCode ? (a.preventDefault(), !1) : void 0
					}), this.opts.modal && d.$html.addClass(e.modal), this.opts.moveBackground && d.$html.addClass(e.background), "left" != this.opts.position && d.$html.addClass(e.mm(this.opts.position)), "back" != this.opts.zposition && d.$html.addClass(e.mm(this.opts.zposition)), this.opts.classes && d.$html.addClass(this.opts.classes), d.$html.addClass(e.opened), this.$menu.addClass(e.opened), d.$page.scrollTop(a), this.$menu.scrollTop(0)
				},
				_openFinish: function () {
					var a = this;
					o(d.$page, function () {
						a.$menu.trigger(f.opened)
					}, this.conf.transitionDuration), d.$html.addClass(e.opening), this.$menu.trigger(f.opening), window.scrollTo(0, 0)
				},
				close: function () {
					var a = this;
					return o(d.$page, function () {
						a.$menu.removeClass(e.current).removeClass(e.opened), d.$html.removeClass(e.opened).removeClass(e.modal).removeClass(e.background).removeClass(e.mm(a.opts.position)).removeClass(e.mm(a.opts.zposition)), a.opts.classes && d.$html.removeClass(a.opts.classes), d.$wndw.off(f.resize).off(f.scroll), d.$page.attr("style", d.$page.data(g.style)), d.$scrollTopNode && d.$scrollTopNode.scrollTop(d.$page.data(g.scrollTop)), a.$menu.trigger(f.closed)
					}, this.conf.transitionDuration), d.$html.removeClass(e.opening), d.$wndw.off(f.keydown), this.$menu.trigger(f.closing), "close"
				},
				_init: function () {
					if (this.opts = j(this.opts, this.conf, this.$menu), this.direction = this.opts.slidingSubmenus ? "horizontal" : "vertical", this._initPage(d.$page), this._initMenu(), this._initBlocker(), this._initPanles(), this._initLinks(), this._initOpenClose(), this._bindCustomEvents(), a[b].addons)
						for (var c = 0; c < a[b].addons.length; c++) "function" == typeof this["_addon_" + a[b].addons[c]] && this["_addon_" + a[b].addons[c]]()
				},
				_bindCustomEvents: function () {
					var b = this;
					this.$menu.off(f.open + " " + f.close + " " + f.setPage).on(f.open + " " + f.close + " " + f.setPage, function (a) {
						a.stopPropagation()
					}), this.$menu.on(f.open, function (c) {
						return a(this).hasClass(e.current) ? (c.stopImmediatePropagation(), !1) : b.open(a(this), b.opts, b.conf)
					}).on(f.close, function (c) {
						return a(this).hasClass(e.current) ? b.close(a(this), b.opts, b.conf) : (c.stopImmediatePropagation(), !1)
					}).on(f.setPage, function (a, c) {
						b._initPage(c), b._initOpenClose()
					});
					var c = this.$menu.find(this.opts.isMenu && "horizontal" != this.direction ? "ul" : "." + e.panel);
					c.off(f.toggle + " " + f.open + " " + f.close).on(f.toggle + " " + f.open + " " + f.close, function (a) {
						a.stopPropagation()
					}), "horizontal" == this.direction ? c.on(f.open, function () {
						return m(a(this), b.$menu)
					}) : c.on(f.toggle, function () {
						var c = a(this);
						return c.triggerHandler(c.parent().hasClass(e.opened) ? f.close : f.open)
					}).on(f.open, function () {
						return a(this).parent().addClass(e.opened), "open"
					}).on(f.close, function () {
						return a(this).parent().removeClass(e.opened), "close"
					})
				},
				_initBlocker: function () {
					var b = this;
					d.$blck || (d.$blck = a('<div id="' + e.blocker + '" />').appendTo(d.$body)), p(d.$blck, function () {
						d.$html.hasClass(e.modal) || b.$menu.trigger(f.close)
					}, !0, !0)
				},
				_initPage: function (c) {
					c || (c = a(this.conf.pageSelector, d.$body), c.length > 1 && (a[b].debug("Multiple nodes found for the page-node, all nodes are wrapped in one <" + this.conf.pageNodetype + ">."), c = c.wrapAll("<" + this.conf.pageNodetype + " />").parent())), c.addClass(e.page), d.$page = c
				},
				_initMenu: function () {
					this.conf.clone && (this.$menu = this.$menu.clone(!0), this.$menu.add(this.$menu.find("*")).filter("[id]").each(function () {
						a(this).attr("id", e.mm(a(this).attr("id")))
					})), this.$menu.contents().each(function () {
						3 == a(this)[0].nodeType && a(this).remove()
					}), this.$menu.prependTo("body").addClass(e.menu), this.$menu.addClass(e.mm(this.direction)), this.opts.classes && this.$menu.addClass(this.opts.classes), this.opts.isMenu && this.$menu.addClass(e.ismenu), "left" != this.opts.position && this.$menu.addClass(e.mm(this.opts.position)), "back" != this.opts.zposition && this.$menu.addClass(e.mm(this.opts.zposition))
				},
				_initPanles: function () {
					var b = this;
					this.__refactorClass(a("ul." + this.conf.listClass, this.$menu), "list"), this.opts.isMenu && a("ul", this.$menu).not(".mm-nolist").addClass(e.list);
					var c = a("ul." + e.list + " > li", this.$menu);
					this.__refactorClass(c.filter("." + this.conf.selectedClass), "selected"), this.__refactorClass(c.filter("." + this.conf.labelClass), "label"), c.off(f.setSelected).on(f.setSelected, function (b, d) {
						b.stopPropagation(), c.removeClass(e.selected), "boolean" != typeof d && (d = !0), d && a(this).addClass(e.selected)
					}), this.__refactorClass(a("." + this.conf.panelClass, this.$menu), "panel"), this.$menu.children().filter(this.conf.panelNodeType).add(this.$menu.find("ul." + e.list).children().children().filter(this.conf.panelNodeType)).addClass(e.panel);
					var d = a("." + e.panel, this.$menu);
					d.each(function (c) {
						var d = a(this),
							f = d.attr("id") || e.mm("m" + b.serialnr + "-p" + c);
						d.attr("id", f)
					}), d.find("." + e.panel).each(function () {
						var d = a(this),
							f = d.is("ul") ? d : d.find("ul").first(),
							h = d.parent(),
							i = h.find("> a, > span"),
							j = h.closest("." + e.panel);
						if (d.data(g.parent, h), h.parent().is("ul." + e.list)) {
							var k = a('<a class="' + e.subopen + '" href="#' + d.attr("id") + '" />').insertBefore(i);
							i.is("a") || k.addClass(e.fullsubopen), "horizontal" == b.direction && f.prepend('<li class="' + e.subtitle + '"><a class="' + e.subclose + '" href="#' + j.attr("id") + '">' + i.text() + "</a></li>")
						}
					});
					var h = "horizontal" == this.direction ? f.open : f.toggle;
					if (d.each(function () {
							var d = a(this),
								e = d.attr("id");
							p(a('a[href="#' + e + '"]', b.$menu), function () {
								d.trigger(h)
							})
						}), "horizontal" == this.direction) {
						var i = a("ul." + e.list + " > li." + e.selected, this.$menu);
						i.add(i.parents("li")).parents("li").removeClass(e.selected).end().each(function () {
							var b = a(this),
								c = b.find("> ." + e.panel);
							c.length && (b.parents("." + e.panel).addClass(e.subopened), c.addClass(e.opened))
						}).closest("." + e.panel).addClass(e.opened).parents("." + e.panel).addClass(e.subopened)
					} else a("li." + e.selected, this.$menu).addClass(e.opened).parents("." + e.selected).removeClass(e.selected);
					var j = d.filter("." + e.opened);
					j.length || (j = d.first()), j.addClass(e.opened).last().addClass(e.current), "horizontal" == this.direction && d.find("." + e.panel).appendTo(this.$menu)
				},
				_initLinks: function () {
					var b = this,
						c = a("ul." + e.list + " > li > a", this.$menu).not("." + e.subopen).not("." + e.subclose).not('[rel="external"]').not('[target="_blank"]');
					c.off(f.click).on(f.click, function (c) {
						var g = a(this),
							h = g.attr("href");
						b.__valueOrFn(b.opts.onClick.setSelected, g) && g.parent().trigger(f.setSelected);
						var i = b.__valueOrFn(b.opts.onClick.preventDefault, g, "#" == h.slice(0, 1));
						i && (c.preventDefault(), c.stopPropagation()), b.__valueOrFn(b.opts.onClick.blockUI, g, !i) && d.$html.addClass(e.blocking), b.__valueOrFn(b.opts.onClick.close, g, i) && b.$menu.triggerHandler(f.close)
					})
				},
				_initOpenClose: function () {
					var b = this,
						c = this.$menu.attr("id");
					c && c.length && (this.conf.clone && (c = e.umm(c)), p(a('a[href="#' + c + '"]'), function () {
						b.$menu.trigger(f.open)
					}));
					var c = d.$page.attr("id");
					c && c.length && p(a('a[href="#' + c + '"]'), function () {
						b.$menu.trigger(f.close)
					}, !1, !0)
				},
				__valueOrFn: function (a, b, c) {
					return "function" == typeof a ? a.call(b[0]) : "undefined" == typeof a && "undefined" != typeof c ? c : a
				},
				__refactorClass: function (a, b) {
					a.removeClass(this.conf[b + "Class"]).addClass(e[b])
				}
			}, a.fn[b] = function (c, e) {
				return d.$wndw || l(), c = j(c, e), e = k(e), this.each(function () {
					var d = a(this);
					d.data(b) || d.data(b, new a[b](d, c, e))
				})
			}, a[b].version = c, a[b].defaults = {
				position: "left",
				zposition: "back",
				moveBackground: !0,
				slidingSubmenus: !0,
				modal: !1,
				classes: "",
				onClick: {
					setSelected: !0
				}
			}, a[b].configuration = {
				preventTabbing: !0,
				panelClass: "Panel",
				listClass: "List",
				selectedClass: "Selected",
				labelClass: "Label",
				pageNodetype: "div",
				panelNodeType: "ul, div",
				transitionDuration: 400
			},
			function () {
				var c = window.document,
					d = window.navigator.userAgent,
					e = "ontouchstart" in c,
					f = "WebkitOverflowScrolling" in c.documentElement.style,
					g = function () {
						var a = document.createElement("div").style;
						return "webkitTransition" in a ? "webkitTransition" : "transition" in a
					}(),
					h = function () {
						return d.indexOf("Android") >= 0 ? 2.4 > parseFloat(d.slice(d.indexOf("Android") + 8)) : !1
					}();
				a[b].support = {
					touch: e,
					transition: g,
					oldAndroidBrowser: h,
					overflowscrolling: function () {
						return e ? f ? !0 : h ? !1 : !0 : !0
					}()
				}
			}(), a[b].useOverflowScrollingFallback = function (a) {
				return d.$html ? ("boolean" == typeof a && d.$html[a ? "addClass" : "removeClass"](e.nooverflowscrolling), d.$html.hasClass(e.nooverflowscrolling)) : (i = a, a)
			}, a[b].debug = function () {}, a[b].deprecated = function (a, b) {
				"undefined" != typeof console && "undefined" != typeof console.warn && console.warn("MMENU: " + a + " is deprecated, use " + b + " instead.")
			};
		var i = !a[b].support.overflowscrolling
	}
}(jQuery);
/*	
 * jQuery mmenu counters addon
 */
! function (a) {
	var b = "mmenu",
		c = "counters";
	a[b].prototype["_addon_" + c] = function () {
		var e = this.opts[c],
			f = a[b]._c,
			g = a[b]._d,
			h = a[b]._e;
		f.add("counter noresults"), h.add("update"), "boolean" == typeof e && (e = {
			add: e,
			update: e
		}), "object" != typeof e && (e = {}), e = a.extend(!0, {}, a[b].defaults[c], e), e.count && (a[b].deprecated('the option "count" for counters, the option "update"'), e.update = e.count), this.__refactorClass(a("em." + this.conf.counterClass, this.$menu), "counter"), e.add && a("." + f.panel, this.$menu).each(function () {
			var b = a(this),
				c = b.data(g.parent);
			if (c) {
				var d = a('<em class="' + f.counter + '" />'),
					e = c.find("> a." + f.subopen);
				e.parent().find("em." + f.counter).length || e.before(d)
			}
		}), e.update && a("em." + f.counter, this.$menu).each(function () {
			var b = a(this),
				c = a(b.next().attr("href"), this.$menu);
			c.is("." + f.list) || (c = c.find("> ." + f.list)), c.length && b.off(h.update).on(h.update, function (a) {
				a.stopPropagation();
				var d = c.children().not("." + f.label).not("." + f.subtitle).not("." + f.hidden).not("." + f.noresults);
				b.html(d.length)
			})
		}).trigger(h.update)
	}, a[b].defaults[c] = {
		add: !1,
		update: !1
	}, a[b].configuration.counterClass = "Counter", a[b].addons = a[b].addons || [], a[b].addons.push(c)
}(jQuery);
/*	
 * jQuery mmenu dragOpen addon
 */
! function (a) {
	function d(a, b, c) {
		return b > a && (a = b), a > c && (a = c), a
	}
	var b = "mmenu",
		c = "dragOpen";
	a[b].prototype["_addon_" + c] = function () {
		var e = this,
			f = this.opts[c];
		if (a.fn.hammer) {
			var g = a[b]._c,
				i = (a[b]._d, a[b]._e);
			g.add("dragging"), i.add("dragleft dragright dragup dragdown dragend");
			var j = a[b].glbl;
			if ("boolean" == typeof f && (f = {
					open: f
				}), "object" != typeof f && (f = {}), "number" != typeof f.maxStartPos && (f.maxStartPos = "left" == this.opts.position || "right" == this.opts.position ? 150 : 50), f = a.extend(!0, {}, a[b].defaults[c], f), f.open) {
				var k = 0,
					l = !1,
					m = 0,
					n = 0,
					o = "width";
				switch (this.opts.position) {
					case "left":
					case "right":
						o = "width";
						break;
					default:
						o = "height"
				}
				switch (this.opts.position) {
					case "left":
						var p = {
							events: i.dragleft + " " + i.dragright,
							open_dir: "right",
							close_dir: "left",
							delta: "deltaX",
							page: "pageX",
							negative: !1
						};
						break;
					case "right":
						var p = {
							events: i.dragleft + " " + i.dragright,
							open_dir: "left",
							close_dir: "right",
							delta: "deltaX",
							page: "pageX",
							negative: !0
						};
						break;
					case "top":
						var p = {
							events: i.dragup + " " + i.dragdown,
							open_dir: "down",
							close_dir: "up",
							delta: "deltaY",
							page: "pageY",
							negative: !1
						};
						break;
					case "bottom":
						var p = {
							events: i.dragup + " " + i.dragdown,
							open_dir: "up",
							close_dir: "down",
							delta: "deltaY",
							page: "pageY",
							negative: !0
						}
				}
				$dragNode = this.__valueOrFn(f.pageNode, this.$menu, j.$page), "string" == typeof $dragNode && ($dragNode = a($dragNode)), $dragNode.hammer().on(i.touchstart, function (a) {
					switch (e.opts.position) {
						case "right":
						case "bottom":
							a[p.page] >= j.$wndw[o]() - f.maxStartPos && (k = 1);
							break;
						default:
							a[p.page] <= f.maxStartPos && (k = 1)
					}
				}).on(p.events + " " + i.dragend, function (a) {
					k > 0 && (a.gesture.preventDefault(), a.stopPropagation())
				}).on(p.events, function (a) {
					var b = p.negative ? -a.gesture[p.delta] : a.gesture[p.delta];
					if (l = b > m ? p.open_dir : p.close_dir, m = b, m > f.threshold && 1 == k) {
						if (j.$html.hasClass(g.opened)) return;
						k = 2, e._openSetup(), j.$html.addClass(g.dragging), n = d(j.$wndw[o]() * e.conf[c][o].perc, e.conf[c][o].min, e.conf[c][o].max)
					}
					if (2 == k) {
						var h = j.$page;
						switch (e.opts.zposition) {
							case "front":
								h = e.$menu;
								break;
							case "next":
								h = h.add(e.$menu)
						}
						h.css(e.opts.position, d(m, 10, n))
					}
				}).on(i.dragend, function () {
					if (2 == k) {
						var b = j.$page;
						switch (e.opts.zposition) {
							case "front":
								b = e.$menu;
								break;
							case "next":
								b = b.add(e.$menu)
						}
						j.$html.removeClass(g.dragging), b.css(e.opts.position, ""), l == p.open_dir ? e._openFinish() : e.close()
					}
					k = 0
				})
			}
		}
	}, a[b].defaults[c] = {
		open: !1,
		threshold: 50
	}, a[b].configuration[c] = {
		width: {
			perc: .8,
			min: 140,
			max: 440
		},
		height: {
			perc: .8,
			min: 140,
			max: 880
		}
	}, a[b].addons = a[b].addons || [], a[b].addons.push(c)
}(jQuery);
/*	
 * jQuery mmenu header addon
 */

! function (a) {
	var b = "mmenu",
		c = "header";
	a[b].prototype["_addon_" + c] = function () {
		var d = this,
			e = this.opts[c],
			f = this.conf[c];
		if ("horizontal" == this.direction) {
			var g = a[b]._c,
				i = (a[b]._d, a[b]._e);
			g.add("header hasheader prev next"), i.add("setheader");
			var j = a[b].glbl;
			"boolean" == typeof e && (e = {
				add: e,
				update: e
			}), "object" != typeof e && (e = {}), e = a.extend(!0, {}, a[b].defaults[c], e), e.add && a('<div class="' + g.header + '" />').prependTo(this.$menu).append('<a class="' + g.prev + '" href="#"></a>').append("<span></span>").append('<a class="' + g.next + '" href="#"></a>');
			var k = a("div." + g.header, this.$menu);
			if (k.length && this.$menu.addClass(g.hasheader), e.update && k.length) {
				var l = k.find("span"),
					m = k.find("." + g.prev),
					n = k.find("." + g.next),
					o = "#" + j.$page.attr("id");
				m.add(n).on(i.click, function (b) {
					b.preventDefault(), b.stopPropagation();
					var c = a(this).attr("href");
					"#" !== c && (c == o ? d.$menu.trigger(i.close) : a(c, d.$menu).trigger(i.open))
				}), a("." + g.panel, this.$menu).each(function () {
					var b = a(this),
						c = a("." + f.panelHeaderClass, b).text(),
						d = a("." + f.panelPrevClass, b).attr("href"),
						h = a("." + f.panelNextClass, b).attr("href");
					c || (c = a("." + g.subclose, b).text()), c || (c = e.title), d || (d = a("." + g.subclose, b).attr("href")), b.off(i.setheader).on(i.setheader, function (a) {
						a.stopPropagation(), l[c ? "show" : "hide"]().text(c), m[d ? "show" : "hide"]().attr("href", d), n[h ? "show" : "hide"]().attr("href", h)
					}), b.on(i.open, function () {
						a(this).trigger(i.setheader)
					})
				}).filter("." + g.current).trigger(i.setheader)
			}
		}
	}, a[b].defaults[c] = {
		add: !1,
		update: !1,
		title: "Menu"
	}, a[b].configuration[c] = {
		panelHeaderClass: "Header",
		panelNextClass: "Next",
		panelPrevClass: "Prev"
	}, a[b].addons = a[b].addons || [], a[b].addons.push(c)
}(jQuery);
/*	
 * jQuery mmenu searchfield addon
 */

