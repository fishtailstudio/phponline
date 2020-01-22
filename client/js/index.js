//写入cookies 
function setCookie(name, value) {
    var exp = new Date();
    exp.setTime(exp.getTime() + 3600 * 24 * 7 * 1000);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
//读取cookies 
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}
//post请求运行结果
function runCode(code) {
    $.post("http://localhost/phponline/server/runCode.php", {
        //将代码中的空格替换为|，并进行URLCode编码
        //如果不将空格替换为|将会出现一些错误
        code: encodeURIComponent(code.replace(/ /g, "|"))
    }, function (res) {
        $("#result").text(res);
    });
}
//清除编辑器中的代码
function clearCode() {
    editor.setValue('');
    $("#result").text('');
    setCookie('code', '');
}