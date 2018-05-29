<?php
// 模板常量声明
$appRoot = app('request')->root();
$uriRoot = rtrim(preg_match('/\.php$/', $appRoot) ? dirname($appRoot) : $appRoot, '\\/');

return [
    // 模板引擎类型 支持 php think 支持扩展
    'type'               => 'Think',
    // 模板路径
    'view_path'          => '',
    // 模板后缀
    'view_suffix'        => 'html',
    // 模板文件名分隔符
    'view_depr'          => DIRECTORY_SEPARATOR,
    // 模板引擎普通标签开始标记
    'tpl_begin'          => '{',
    // 模板引擎普通标签结束标记
    'tpl_end'            => '}',
    // 标签库标签开始标记
    'taglib_begin'       => '{',
    // 标签库标签结束标记
    'taglib_end'         => '}',
    // 定义模板替换字符串
    'tpl_replace_string' => [
        '__APP__'    => $appRoot,
        '__ROOT__'   => $uriRoot,
        '__STATIC__' => $uriRoot . "/static",
    ],
];

