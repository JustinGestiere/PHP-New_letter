<?php
function dd($var)
{
    dump($var);
    die;
}
function dump($var)
{
    preprint($var);
}
function preprint($var)
{
    echo "<pre style='color:red'>";
    print_r($var);
    echo "</pre>";
}