<?php
$apiLocalDocFile = __DIR__ . '/api.loc.json';
$content = file_get_contents($apiLocalDocFile);
if ((empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')
    && !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
) {
    $content = preg_replace('~("schemes":\s*)\[(\s*)"http"(\s*)\]~', '$1[$2"https"$3]', $content);
}
echo preg_replace('~(\s*)"host":.+~', '$1"host": "' . $_SERVER['HTTP_HOST'] . '",', $content);
exit;