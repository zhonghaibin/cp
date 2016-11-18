String.prototype.trim = function () {
    return this.replace(/(?:^\s*)|(?:\s*$)/g, "")
};
function selectAll(a) {
    jQuery(":checkbox[id!='" + a + "']").attr("checked", jQuery("#" + a).attr("checked"))
}
function validateUserName(b) {
    var a = /^[0-9a-zA-Z]{6,16}$/;
    if (a.exec(b)) {
        return true
    } else {
        return false
    }
}
function validateUserPss(b) {
    var a = /^[0-9a-zA-Z]{6,16}$/;
    if (!a.exec(b)) {
        return false
    }
    a = /^\d+$/;
    if (a.exec(b)) {
        return false
    }
    a = /^[a-zA-Z]+$/;
    if (a.exec(b)) {
        return false
    }
    a = /(.)\1{2,}/;
    if (a.exec(b)) {
        return false
    }
    return true
}
function validateNickName(b) {
    var a = /^(.){2,8}$/;
    if (a.exec(b)) {
        return true
    } else {
        return false
    }
}
function validateBranch(b) {
    var a = /^(.){2,24}$/;
    if (a.exec(b)) {
        return true
    } else {
        return false
    }
}
function validateInputDate(e) {
    e = e.trim();
    if (e == "" || e == null) {
        return true
    }
    var d = e.split(" ");
    var c = new Array();
    var a = new Array();
    if (d[0].indexOf("-") != -1) {
        c = d[0].split("-")
    } else {
        if (d[0].indexOf("/") != -1) {
            c = d[0].split("/")
        } else {
            if (d[0].toString().length < 8) {
                return false
            }
            c[0] = d[0].substring(0, 4);
            c[1] = d[0].substring(4, 6);
            c[2] = d[0].substring(6, 8)
        }
    }
    if (d[1] == undefined || d[1] == null) {
        d[1] = "00:00:00"
    }
    if (d[1].indexOf(":") != -1) {
        a = d[1].split(":")
    }
    if (c[2] != undefined && (c[0] == "" || c[1] == "")) {
        return false
    }
    if (c[1] != undefined && c[0] == "") {
        return false
    }
    if (a[2] != undefined && (a[0] == "" || a[1] == "")) {
        return false
    }
    if (a[1] != undefined && a[0] == "") {
        return false
    }
    c[0] = (c[0] == undefined || c[0] == "") ? 1970 : c[0];
    c[1] = (c[1] == undefined || c[1] == "") ? 0 : (c[1] - 1);
    c[2] = (c[2] == undefined || c[2] == "") ? 0 : c[2];
    a[0] = (a[0] == undefined || a[0] == "") ? 0 : a[0];
    a[1] = (a[1] == undefined || a[1] == "") ? 0 : a[1];
    a[2] = (a[2] == undefined || a[2] == "") ? 0 : a[2];
    var b = new Date(c[0], c[1], c[2], a[0], a[1], a[2]);
    if (b.getFullYear() == c[0] && b.getMonth() == c[1] && b.getDate() == c[2]
        && b.getHours() == a[0] && b.getMinutes() == a[1] && b.getSeconds() == a[2]) {
        return true
    } else {
        return false
    }
    return true
}
function JsRound(c, a, b) {
    a = parseInt(a, 10);
    if (a < 0) {
        a = Math.abs(a);
        return Math.round(Number(c) / Math.pow(10, a)) * Math.pow(10, a)
    } else {
        if (a == 0) {
            return Math.round(Number(c))
        }
    }
    c = Math.round(Number(c) * Math.pow(10, a)) / Math.pow(10, a);
    if (b && b == true) {
        var e = "", d = 0; c = c.toString();
        if (c.indexOf(".") == -1) {
            c = "" + c + ".0"
        }
        data = c.split(".");
        for (d = data[1].length; d < a; d++) {
            e += "0"
        }
        return "" + c + "" + e
    }
    return c
}
function checkMoney(a) {
    a.value = formatFloat(a.value)
}
function checkWithdraw(c, a, b) {
    c.value = formatFloat(c.value);
    if (parseFloat(c.value) > parseFloat(b)) {
        alert("\u8f93\u5165\u91d1\u989d\u8d85\u51fa\u4e86\u53ef\u7528\u4f59\u989d");
        c.value = b
    }
    jQuery("#" + a).html(changeMoneyToChinese(c.value))
}
function checkOnlineWithdraw(b, a) {
    b.value = formatFloat(b.value);
    if (parseFloat(b.value) > parseFloat(a)) {
        alert("\u63d0\u73b0\u91d1\u989d\u8d85\u51fa\u4e86\u53ef\u63d0\u73b0\u9650\u989d");
        b.value = a;
        b.focus()
    }
}
function checkIntWithdraw(c, a, b) {
    c.value = parseInt(c.value, 10);
    c.value = isNaN(c.value) ? 0 : c.value;
    if (parseFloat(c.value) > parseFloat(b)) {
        alert("\u8f93\u5165\u91d1\u989d\u8d85\u51fa\u4e86\u53ef\u7528\u4f59\u989d");
        c.value = parseInt(b, 10)
    }
    jQuery("#" + a).html(changeMoneyToChinese(c.value))
}
function moneyFormat(b) {
    sign = Number(b) < 0 ? "-" : "";
    b = b.toString().replace(/[^\d.]/g, "");
    b = b.replace(/\.{2,}/g, ".");
    b = b.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    if (b.indexOf(".") != -1) {
        var c = b.split(".");
        c[0] = c[0].substr(0, 15);
        var a = [];
        for (i = c[0].length; i > 0; i -= 3) {
            a.unshift(c[0].substring(i, i - 3))
        }
        c[0] = a.join(",");
        b = c[0] + "." + (c[1].substr(0, 4))
    } else {
        b = b.substr(0, 15);
        var a = [];
        for (i = b.length; i > 0; i -= 3) {
            a.unshift(b.substring(i, i - 3))
        }
        b = a.join(",") + ".0000"
    }
    return sign + b
}
function formatFloat(a) {
    a = a.replace(/^[^\d]/g, "");
    a = a.replace(/[^\d.]/g, "");
    a = a.replace(/\.{2,}/g, ".");
    a = a.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    if (a.indexOf(".") != -1) {
        var b = a.split(".");
        a = (b[0].substr(0, 15)) + "." + (b[1].substr(0, 2))
    } else {
        a = a.substr(0, 15)
    }
    return a
}
Array.prototype.each = function (f) {
    f = f || Function.K;
    var b = [];
    var c = Array.prototype.slice.call(arguments, 1);
    for (var e = 0; e < this.length; e++) {
        var d = f.apply(this, [this[e], e].concat(c));
        if (d != null) {
            b.push(d)
        }
    }
    return b
};
Array.prototype.uniquelize = function () {
    var b = new Array();
    for (var a = 0; a < this.length; a++) {
        if (!b.contains(this[a])) {
            b.push(this[a])
        }
    }
    return b
};
Array.complement = function (d, c) {
    return Array.minus(Array.union(d, c), Array.intersect(d, c))
};
Array.intersect = function (d, c) {
    return d.uniquelize().each(function (a) {
        return c.contains(a) ? a : null
    })
};
Array.minus = function (d, c) {
    return d.uniquelize().each(function (a) {
        return c.contains(a) ? null : a
    })
};
Array.union = function (d, c) {
    return d.concat(c).uniquelize()
};
Array.prototype.contains = function (b) {
    for (var a = 0; a < this.length; a++) {
        if (this[a] == b) {
            return true
        }
    }
    return false
};
Array.prototype.remove = function (b) {
    for (var a = 0; a < this.length; a++) {
        if (this[a] == b) {
            this.splice(a, 1)
        }
    }
};
function changeMoneyToChinese(a) {
    var o = new Array("\u96f6", "\u58f9", "\u8d30", "\u53c1", "\u8086", "\u4f0d", "\u9646", "\u67d2", "\u634c", "\u7396");
    var l = new Array("", "\u62fe", "\u4f70", "\u4edf");
    var k = new Array("", "\u4e07", "\u4ebf", "\u5146");
    var h = new Array("\u89d2", "\u5206", "\u6beb", "\u5398");
    var d = "\u6574";
    var g = "\u5143";
    var b = 1000000000000000;
    var c;
    var e;
    var j = "";
    var f;
    if (a == "") { return "" }
    a = parseFloat(a);
    if (a >= b) {
        alert("\u8d85\u51fa\u6700\u5927\u5904\u7406\u6570\u5b57");
        return ""
    }
    if (a == 0) {
        j = o[0] + g + d;
        return j
    }
    a = a.toString();
    if (a.indexOf(".") == -1) {
        c = a;
        e = ""
    } else {
        f = a.split(".");
        c = f[0];
        e = f[1].substr(0, 4)
    }
    if (parseInt(c, 10) > 0) {
        zeroCount = 0;
        IntLen = c.length;
        for (i = 0; i < IntLen; i++) {
            n = c.substr(i, 1);
            p = IntLen - i - 1;
            q = p / 4;
            m = p % 4;
            if (n == "0") {
                zeroCount++
            } else {
                if (zeroCount > 0) {
                    j += o[0]
                }
                zeroCount = 0;
                j += o[parseInt(n)] + l[m]
            }
            if (m == 0 && zeroCount < 4) {
                j += k[q]
            }
        }
        j += g
    }
    if (e != "") {
        decLen = e.length;
        for (i = 0; i < decLen; i++) {
            n = e.substr(i, 1);
            if (n != "0") {
                j += o[Number(n)] + h[i]
            }
        }
    }
    if (j == "") {
        j += o[0] + g + d
    } else {
        if (e == "") { j += d }
    }
    return j
}
function replaceHTML(a) {
    a = a.replace(/[&]/g, "&amp;");
    a = a.replace(/[\"]/g, "&quot;");
    a = a.replace(/[\']/g, "&#039;");
    a = a.replace(/[<]/g, "&lt;");
    a = a.replace(/[>]/g, "&gt;");
    a = a.replace(/[ ]/g, "&nbsp;");
    return a
}
function replaceHTML_DECODE(a) {
    a = a.replace(/&amp;/g, "&");
    a = a.replace(/&quot;/g, '"');
    a = a.replace(/&#039;/g, "'");
    a = a.replace(/&lt;/g, "<");
    a = a.replace(/&gt;/g, ">");
    a = a.replace(/&nbsp;/g, " ");
    return a
}
function copyToClipboard(f, c) {
    txt = jQuery("#" + f).text().trim();
    if (window.clipboardData) {
        window.clipboardData.clearData();
        window.clipboardData.setData("Text", txt)
    } else {
        if (navigator.userAgent.indexOf("Opera") != -1) {
            window.location = txt
        } else {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect")
                } catch (h) {
                    alert("\u60a8\u7684\u0066\u0069\u0072\u0065\u0066\u006f\u0078\u5b89\u5168\u9650\u5236\u9650\u5236\u60a8\u8fdb\u884c\u526a\u8d34\u677f\u64cd\u4f5c\uff0c\u8bf7\u5728\u5730\u5740\u680f\u4e2d\u8f93\u5165¡°about:config¡±\u5c06¡°signed.applets.codebase_principal_support¡±\u8bbe\u7f6e\u4e3a¡°true¡±\u4e4b\u540e\u91cd\u8bd5");
                    return false
                }
                var d = Components.classes["@mozilla.org/widget/clipboard;1"].createInstance(Components.interfaces.nsIClipboard);
                if (!d) {
                    return
                }
                var k = Components.classes["@mozilla.org/widget/transferable;1"].createInstance(Components.interfaces.nsITransferable);
                if (!k) {
                    return
                }
                k.addDataFlavor("text/unicode");
                var j = new Object();
                var g = new Object();
                var j = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
                var b = txt;
                j.data = b;
                k.setTransferData("text/unicode", j, b.length * 2);
                var a = Components.interfaces.nsIClipboard;
                if (!d) {
                    return false
                }
                d.setData(k, null, a.kGlobalClipboard)
            }
        }
    }
    if (c) {
        alert(c + " \u590d\u5236\u6210\u529f")
    }
}
function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}
function GetCombinCount(a, d) {
    if (d > a) {
        return 0
    }
    if (a == d || d == 0) {
        return 1
    }
    if (d == 1) {
        return a
    }
    var b = 1;
    var e = 1;
    for (var c = 0; c < d; c++) {
        b *= a - c; e *= d - c
    }
    return b / e
}
function movestring(a) {
    var h = "";
    var k = "01";
    var b = "";
    var f = "";
    var j = "";
    var g = false;
    var c = false;
    for (var e = 0; e < a.length; e++) {
        if (g == false) {
            h += a.substr(e, 1)
        }
        if (g == false && a.substr(e, 1) == "1") {
            c = true
        } else {
            if (g == false && c == true && a.substr(e, 1) == "0") {
                g = true
            } else {
                if (g == true) { b += a.substr(e, 1) }
            }
        }
    }
    h = h.substr(0, h.length - 2);
    for (var d = 0; d < h.length; d++) {
        if (h.substr(d, 1) == "1") {
            f += h.substr(d, 1)
        } else {
            if (h.substr(d, 1) == "0") { j += h.substr(d, 1) }
        }
    }
    h = f + j;
    return h + k + b
}
function getCombination(o, c) {
    var l = o.length;
    var r = new Array();
    var f = new Array();
    if (c > l) {
        return r
    }
    if (c == 1) {
        return o
    }
    if (l == c) {
        r[0] = o.join(",");
        return r
    }
    var a = "";
    var b = "";
    var s = "";
    for (var g = 0; g < c; g++) {
        a += "1"; b += "1"
    }
    for (var e = 0; e < l - c; e++) {
        a += "0"
    }
    for (var d = 0; d < c; d++) {
        s += o[d] + ","
    }
    r[0] = s.substr(0, s.length - 1);
    var h = 1;
    s = "";
    while (a.substr(a.length - c, c) != b) {
        a = movestring(a);
        for (var d = 0; d < l; d++) {
            if (a.substr(d, 1) == "1") {
                s += o[d] + ","
            }
        }
        r[h] = s.substr(0, s.length - 1);
        s = "";
        h++
    }
    return r
}
function showCombination(b, c) {
    var f = b.split(",");
    var e = getCombination(f, c);
    var a = "<tr><td>\u53f7\u7801\u7ec4\u5408\u5982\u4e0b£º</td></tr>";
    for (var d = 1; d <= e.length; d++) {
        a += "<tr><td>" + d + ":" + e[d - 1] + "</td></tr>"
    }
    return a
}
function SetCookie(b, c, a) {
    var d = new Date();
    d.setTime(d.getTime() + (a * 1000));
    document.cookie = b + "=" + escape(c) + ";expires=" + d.toUTCString()
}
function getCookie(b) {
    var a = document.cookie.match(new RegExp("(^| )" + b + "=([^;]*)(;|$)"));
    if (a != null) {
        return unescape(a[2])
    }
    return null
}
function delCookie(a) {
    var c = new Date();
    c.setTime(c.getTime() - 1);
    var b = getCookie(a);
    if (b != null) {
        document.cookie = a + "=" + b + ";expires=" + c.toGMTString()
    }
}
function addItem(d, c, a) {
    var b = new Option(c, a);
    d.options.add(b)
}
function SelectItem(d, c) {
    var b = d.options.length;
    for (var a = 0; a < b; a++) {
        if (d.options[a].value == c) {
            d.options[a].selected = true;
            return true
        }
    }
}
var TimeCountDown = function (e, b, f) {
    var g = parseInt(b, 10);
    function a(h) {
        return Number(h) < 10 ? "" + 0 + Number(h) : Number(h)
    }
    function d(h) {
        return h > 0 ? {
            day: Math.floor(h / 86400),
            hour: Math.floor(h % 86400 / 3600),
            minute: Math.floor(h % 3600 / 60),
            second: Math.floor(h % 60)
        } : {
            day: 0,
            hour: 0,
            minute: 0,
            second: 0
        }
    }
    var c = window.setInterval(
        function () {
            if (g <= 0) {
                clearInterval(c);
                if (f && typeof (f) == "function") {
                    f()
                }
            }
            var h = d(g--);
            document.getElementById(e).innerHTML = "" + (h.day > 0 ? h.day + "\u5929 " : "") + (h.hour > 0 ? a(h.hour) + ":" : "") + a(h.minute) + ":" + a(h.second)
        },
        1000)
};
