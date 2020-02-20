<?php
// Всякие полезные функции
//
function password($pass)
{
    return md5(md5("ajifjr") . md5($pass) . md5("zxcmvkwd"));
}

//
function validate($str, $patterns)
{
    if (is_array($patterns))
    {
        foreach ($patterns as $pattern)
        {
            if (!validate($pattern, $str))
                return false;
        }

        return true;
    }

    return preg_match("/$patterns/", $str);
}