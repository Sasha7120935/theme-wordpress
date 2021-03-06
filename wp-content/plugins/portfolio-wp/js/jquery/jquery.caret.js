! function(e) {
    e.fn.caret = function(e) {
        var t = this[0],
            n = "true" === t.contentEditable;
        if (0 == arguments.length) {
            if (window.getSelection) {
                if (n) {
                    t.focus();
                    var o = window.getSelection().getRangeAt(0),
                        r = o.cloneRange();
                    return r.selectNodeContents(t), r.setEnd(o.endContainer, o.endOffset), r.toString().length
                }
                return t.selectionStart
            }
            if (document.selection) {
                if (t.focus(), n) {
                    var o = document.selection.createRange(),
                        r = document.body.createTextRange();
                    return r.moveToElementText(t), r.setEndPoint("EndToEnd", o), r.text.length
                }
                var e = 0,
                    c = t.createTextRange(),
                    r = document.selection.createRange().duplicate(),
                    a = r.getBookmark();
                for (c.moveToBookmark(a); 0 !== c.moveStart("character", -1);) e++;
                return e
            }
            return t.selectionStart ? t.selectionStart : 0
        }
        if (-1 == e && (e = this[n ? "text" : "val"]().length), window.getSelection) n ? (t.focus(), window.getSelection().collapse(t.firstChild, e)) : t.setSelectionRange(e, e);
        else if (document.body.createTextRange)
            if (n) {
                var c = document.body.createTextRange();
                c.moveToElementText(t), c.moveStart("character", e), c.collapse(!0), c.select()
            } else {
                var c = t.createTextRange();
                c.move("character", e), c.select()
            } return n || t.focus(), e
    }
}(jQuery);