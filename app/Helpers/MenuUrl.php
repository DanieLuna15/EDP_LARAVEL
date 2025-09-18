<?php
// app/Helpers/MenuUrl.php
namespace App\Helpers;

class MenuUrl
{
    public static function fromTemplate(string $template, $ctx = null): string
    {
        return preg_replace_callback('/\{(\w+)\}/', function ($m) use ($ctx, $template) {
            $key = $m[1];
            $val = data_get($ctx, $key);
            if (is_null($val) || $val === '') {
                if (app()->environment('local')) {
                    throw new \RuntimeException("Falta el parámetro '{$key}' para '{$template}'");
                }
                return '#'; // fallback “deshabilitado” en prod
            }
            return urlencode((string)$val);
        }, $template);
    }
}