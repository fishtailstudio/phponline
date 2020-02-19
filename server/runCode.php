<?php
if (isset($_POST['code'])) {
    //从post数据中取出代码
    $originalCode = $_POST['code'];
    //将代码中的`替换为空格，并进行URLCode解码
    $code = str_replace('`', ' ', urldecode($originalCode));
    //包含eval或sql或file或py
    if (
        strpos($code, 'eval') !== false ||
        strpos($code, 'sql') !== false ||
        strpos($code, 'file') !== false ||
        strpos($code, 'py') !== false
    ) {
        echo 'error';
        die;
    }
    //以< ? php或< ?开头
    if (substr($code, 0, 5) == '<?php') {
        $code = substr($code, 5);
    } else if (substr($code, 0, 2) == '<?') {
        $code = substr($code, 2);
    }
    //以? >结尾
    if (substr($code, -2) == '?>') {
        $code = substr($code, 0, -2);
    }
    //运行php代码
    $result = eval($code);
    //将经过URLCode编码的代码写入cookie，“/phponline/client”为前端代码所在的相对网站根目录的地址
    setcookie('code', $originalCode, time() + 3600 * 24 * 7, '/phponline/client');
}
