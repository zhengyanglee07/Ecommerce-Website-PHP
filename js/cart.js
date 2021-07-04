function SetCookie (name, value)
{
    var expdate = new Date();
    expdate.setTime(expdate.getTime() + (30 * 60 * 1800));  // 30 * 60 * 1800
    document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
    window.location.reload(true);
}

function UpdateCookie(name, value){
    var expdate = new Date();
    expdate.setTime(expdate.getTime() + (30 * 60 * 1800));  // 30 * 60 * 1800
    document.cookie = name+"="+value+";expires="+expdate.toGMTString()+";path=/";
    window.location.reload(true);
}

function Deletecookie (name) {  			//删除名称为name的Cookie
    var exp = new Date();
    exp.setTime (exp.getTime() - 1);
    var cval = GetCookie (name);
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString()+";path=/";
    window.location.reload(true);
}
function Clearcookie()   					//清除Cookie
{
    var temp=document.cookie.split(";");
    var loop3;
    var ts;
    for (loop3=0;loop3<temp.length;loop3++)
    {
        ts=temp[loop3].split("=")[0];
        if (ts.indexOf('myname')!=-1)
            DeleteCookie(ts);     			//如果ts含“mycat”则执行清除
    }
}

function getCookieVal (offset) {     		//取得项名称为offset的Cookie值
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1)
        endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {       //取得名称为name的cookie值
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) === arg)
            return getCookieVal (j);
        i = document.cookie.indexOf(" ", i) + 1;
        if (i === 0) break;
    }
    return null;
}

function updateSubTotal(){
    var qty = document.getElementById('quantity').value;
    var price = document.getElementById('prodPrice').value;
    var total = price * qty;
    document.getElementById('subtotal').value = total.toFixed(2);
}