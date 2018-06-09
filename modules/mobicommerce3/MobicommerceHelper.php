<?php

?><?php


function mc_include($path)
{
    include $path;
}

function mc_include_once($path)
{
    include_once $path;
}

function mc_file_exists($filename)
{
    return file_exists($filename);
} ?>