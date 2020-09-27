<?php


function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function trimInputStr($str)
{
  return preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $str);
}
