<?php
function urlVersion($url = "")
{
    $version = "202310270719";
    return url("{$url}?v={$version}");
}
