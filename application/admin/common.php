<?php
function replaceIndex($char,$str,$index){
  $strArr = str_split($str);
  $strArr[$index] = $char;
  return implode("",$strArr);
}