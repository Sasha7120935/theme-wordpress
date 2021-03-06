// jQuery tagEditor v1.0.13
// https://github.com/Pixabay/jQuery-tagEditor
! function(t) {
    t.fn.tagEditorInput = function() {
        var e = " ",
            i = t(this),
            a = parseInt(i.css("fontSize")),
            r = t("<span/>").css({
                position: "absolute",
                top: -9999,
                left: -9999,
                width: "auto",
                fontSize: i.css("fontSize"),
                fontFamily: i.css("fontFamily"),
                fontWeight: i.css("fontWeight"),
                letterSpacing: i.css("letterSpacing"),
                whiteSpace: "nowrap"
            }),
            l = function() {
                if (e !== (e = i.val())) {
                    r.html(e.replace(/&/g, "&amp;").replace(/\s/g, "&nbsp;").replace(/</g, "&lt;").replace(/>/g, "&gt;"));
                    var t = r.width() + a;
                    20 > t && (t = 20), t != i.width() && i.width(t)
                }
            };
        return r.insertAfter(i), i.bind("keyup keydown focus", l)
    }, t.fn.tagEditor = function(e, a, r) {
        function l(e) {
            if (8 == e.which || 46 == e.which || e.ctrlKey && 88 == e.which) {
                try {
                    var a = getSelection(),
                        r = t(a.getRangeAt(0).commonAncestorContainer)
                } catch (e) {
                    r = 0
                }
                if (r && r.hasClass("tag-editor")) {
                    var l = [],
                        n = a.toString().split(r.prev().data("options").dregex);
                    for (i = 0; i < n.length; i++) {
                        var o = t.trim(n[i]);
                        o && l.push(o)
                    }
                    t(".tag-editor-tag", r).each(function() {
                        ~t.inArray(t(this).html(), l) && t(this).closest("li").find(".tag-editor-delete").click()
                    })
                }
            }
        }
        var n, o = t.extend({}, t.fn.tagEditor.defaults, e),
            c = this;
        if (o.dregex = new RegExp("[" + o.delimiter.replace("-", "-") + "]", "g"), "string" == typeof e) {
            var s = [];
            return c.each(function() {
                var i = t(this),
                    l = i.data("options"),
                    n = i.next(".tag-editor");
                "getTags" == e ? s.push({
                    field: i[0],
                    editor: n,
                    tags: n.data("tags")
                }) : "addTag" == e ? (t('<li><div class="tag-editor-spacer">&nbsp;' + l.delimiter[0] + '</div><div class="tag-editor-tag"></div><div class="tag-editor-delete"><i></i></div></li>').appendTo(n).find(".tag-editor-tag").html('<input type="text" maxlength="' + l.maxLength + '">').addClass("active").find("input").val(a).blur(), r ? t(".placeholder", n).remove() : n.click()) : "removeTag" == e ? (t(".tag-editor-tag", n).filter(function() {
                    return t(this).html() == a
                }).closest("li").find(".tag-editor-delete").click(), r || n.click()) : "destroy" == e && i.removeClass("tag-editor-hidden-src").removeData("options").off("focus.tag-editor").next(".tag-editor").remove()
            }), "getTags" == e ? s : this
        }
        return window.getSelection && t(document).off("keydown.tag-editor").on("keydown.tag-editor", l), c.each(function() {
            function e() {
                !o.placeholder || c.length || t(".deleted, .placeholder, input", s).length || s.append('<li class="placeholder"><div>' + o.placeholder + "</div></li>")
            }

            function a(i) {
                var a = c.toString();
                c = t(".tag-editor-tag:not(.deleted)", s).map(function(e, i) {
                    var a = t.trim(t(this).hasClass("active") ? t(this).find("input").val() : t(i).text());
                    return a ? a : void 0
                }).get(), s.data("tags", c), l.val(c.join(o.delimiter[0])), i || a != c.toString() && o.onChange(l, s, c), e()
            }

            function r(e) {
                var r = e.closest("li"),
                    n = e.val().replace(/ +/, " ").split(o.dregex),
                    d = e.data("old_tag"),
                    g = c.slice(0);
                for (i = 0; i < n.length; i++) u = t.trim(n[i]).slice(0, o.maxLength), u && (o.forceLowercase && (u = u.toLowerCase()), u = o.beforeTagSave(l, s, g, d, u) || u, ~t.inArray(u, g) && t(".tag-editor-tag", s).each(function() {
                    t(this).html() == u && t(this).closest("li").remove()
                }), g.push(u), r.before('<li><div class="tag-editor-spacer">&nbsp;' + o.delimiter[0] + '</div><div class="tag-editor-tag">' + u + '</div><div class="tag-editor-delete"><i></i></div></li>'));
                e.attr("maxlength", o.maxLength).removeData("old_tag").val("").focus(), a()
            }
            var l = t(this),
                c = [],
                s = t("<ul " + (o.clickDelete ? 'oncontextmenu="return false;" ' : "") + 'class="tag-editor"></ul>').insertAfter(l);
            l.addClass("tag-editor-hidden-src").data("options", o).on("focus.tag-editor", function() {
                s.click()
            }), s.append('<li style="width:1px">&nbsp;</li>');
            var d = '<li><div class="tag-editor-spacer">&nbsp;' + o.delimiter[0] + '</div><div class="tag-editor-tag"></div><div class="tag-editor-delete"><i></i></div></li>';
            s.click(function(e, i) {
                var a, r, l = 99999;
                if (!window.getSelection || "" == getSelection()) return n = !0, t("input:focus", s).blur(), n ? (n = !0, t(".placeholder", s).remove(), i && i.length ? r = "before" : t(".tag-editor-tag", s).each(function() {
                    var n = t(this),
                        o = n.offset(),
                        c = o.left,
                        s = o.top;
                    e.pageY >= s && e.pageY <= s + n.height() && (e.pageX < c ? (r = "before", a = c - e.pageX) : (r = "after", a = e.pageX - c - n.width()), l > a && (l = a, i = n))
                }), "before" == r ? t(d).insertBefore(i.closest("li")).find(".tag-editor-tag").click() : "after" == r ? t(d).insertAfter(i.closest("li")).find(".tag-editor-tag").click() : t(d).appendTo(s).find(".tag-editor-tag").click(), !1) : !1
            }), s.on("click", ".tag-editor-delete", function() {
                if (t(this).prev().hasClass("active")) return t(this).closest("li").find("input").caret(-1), !1;
                var i = t(this).closest("li"),
                    r = i.find(".tag-editor-tag");
                return o.beforeTagDelete(l, s, c, r.html()) === !1 ? !1 : (r.addClass("deleted").animate({
                    width: 0
                }, 175, function() {
                    i.remove(), e()
                }), a(), !1)
            }), o.clickDelete && s.on("mousedown", ".tag-editor-tag", function(i) {
                if (i.ctrlKey || i.which > 1) {
                    var r = t(this).closest("li"),
                        n = r.find(".tag-editor-tag");
                    return o.beforeTagDelete(l, s, c, n.html()) === !1 ? !1 : (n.addClass("deleted").animate({
                        width: 0
                    }, 175, function() {
                        r.remove(), e()
                    }), a(), !1)
                }
            }), s.on("click", ".tag-editor-tag", function(e) {
                if (o.clickDelete && (e.ctrlKey || e.which > 1)) return !1;
                if (!t(this).hasClass("active")) {
                    var i = t(this).html(),
                        a = Math.abs((t(this).offset().left - e.pageX) / t(this).width()),
                        r = parseInt(i.length * a),
                        l = t(this).html('<input type="text" maxlength="' + o.maxLength + '" value="' + i + '">').addClass("active").find("input");
                    if (l.data("old_tag", i).tagEditorInput().focus().caret(r), o.autocomplete) {
                        var n = t.extend({}, o.autocomplete),
                            c = "select" in n ? o.autocomplete.select : "";
                        n.select = function() {
                            c && c(), setTimeout(function() {
                                t(".active", s).find("input").focus()
                            }, 20)
                        }, l.autocomplete(n)
                    }
                }
                return !1
            }), s.on("blur", "input", function() {
                var i = t(this),
                    d = i.data("old_tag"),
                    g = t.trim(i.val().replace(/ +/, " ").replace(o.dregex, o.delimiter[0]));
                if (g) {
                    if (g.indexOf(o.delimiter[0]) >= 0) return void r(i);
                    g != d && (o.forceLowercase && (g = g.toLowerCase()), g = o.beforeTagSave(l, s, c, d, g) || g, t(".tag-editor-tag:not(.active)", s).each(function() {
                        t(this).html() == g && t(this).closest("li").remove()
                    }))
                } else {
                    if (d && o.beforeTagDelete(l, s, c, d) === !1) return i.val(d).focus(), n = !1, void a();
                    try {
                        i.closest("li").remove()
                    } catch (f) {}
                    d && a()
                }
                i.parent().html(g).removeClass("active"), g != d && a(), e()
            });
            var g;
            s.on("paste", "input", function() {
                t(this).removeAttr("maxlength"), g = t(this), setTimeout(function() {
                    r(g)
                }, 30)
            });
            var f;
            s.on("keypress", "input", function(e) {
                o.delimiter.indexOf(String.fromCharCode(e.which)) >= 0 && (f = t(this), setTimeout(function() {
                    r(f)
                }, 20))
            }), s.on("keydown", "input", function(e) {
                var i = t(this);
                if ((37 == e.which || !o.autocomplete && 38 == e.which) && !i.caret() || 8 == e.which && !i.val()) {
                    var a = i.closest("li").prev("li").find(".tag-editor-tag");
                    return a.length ? a.click().find("input").caret(-1) : i.val() && t(d).insertBefore(i.closest("li")).find(".tag-editor-tag").click(), !1
                }
                if ((39 == e.which || !o.autocomplete && 40 == e.which) && i.caret() == i.val().length) {
                    var r = i.closest("li").next("li").find(".tag-editor-tag");
                    return r.length ? r.click().find("input").caret(0) : i.val() && s.click(), !1
                }
                if (9 == e.which) {
                    if (e.shiftKey) {
                        var a = i.closest("li").prev("li").find(".tag-editor-tag");
                        if (a.length) a.click().find("input").caret(0);
                        else {
                            if (!i.val()) return l.attr("disabled", "disabled"), void setTimeout(function() {
                                l.removeAttr("disabled")
                            }, 30);
                            t(d).insertBefore(i.closest("li")).find(".tag-editor-tag").click()
                        }
                        return !1
                    }
                    var r = i.closest("li").next("li").find(".tag-editor-tag");
                    if (r.length) r.click().find("input").caret(0);
                    else {
                        if (!i.val()) return;
                        s.click()
                    }
                    return !1
                }
                if (!(46 != e.which || t.trim(i.val()) && i.caret() != i.val().length)) {
                    var r = i.closest("li").next("li").find(".tag-editor-tag");
                    return r.length ? r.click().find("input").caret(0) : i.val() && s.click(), !1
                }
                if (13 == e.which) return s.trigger("click", [i.closest("li").next("li").find(".tag-editor-tag")]), !1;
                if (36 != e.which || i.caret()) {
                    if (35 == e.which && i.caret() == i.val().length) s.find(".tag-editor-tag").last().click();
                    else if (27 == e.which) return i.val(i.data("old_tag") ? i.data("old_tag") : "").blur(), !1
                } else s.find(".tag-editor-tag").first().click()
            });
            var h = o.initialTags.length ? o.initialTags : l.val().split(o.dregex);
            for (i = 0; i < h.length; i++) {
                var u = t.trim(h[i].replace(/ +/, " "));
                u && (o.forceLowercase && (u = u.toLowerCase()), c.push(u), s.append('<li><div class="tag-editor-spacer">&nbsp;' + o.delimiter[0] + '</div><div class="tag-editor-tag">' + u + '</div><div class="tag-editor-delete"><i></i></div></li>'))
            }
            a(!0), o.sortable && t.fn.sortable && s.sortable({
                distance: 5,
                cancel: ".tag-editor-spacer, input",
                helper: "clone",
                update: function() {
                    a()
                }
            })
        })
    }, t.fn.tagEditor.defaults = {
        initialTags: [],
        maxLength: 50,
        delimiter: ",;",
        placeholder: "",
        forceLowercase: !0,
        clickDelete: !1,
        sortable: !0,
        autocomplete: null,
        onChange: function() {},
        beforeTagSave: function() {},
        beforeTagDelete: function() {}
    }
}(jQuery);