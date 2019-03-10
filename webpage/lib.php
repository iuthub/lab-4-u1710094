<?php

function getSize($size)
{
	if ($size >= 1048576)
  {
      return number_format($size / 1048576, 2) . 'MB ';
  }
  elseif ($size >= 1024)
  {
      return number_format($size / 1024, 2) . 'KB ';
  }
  elseif ($size > 1)
  {
      return $size . 'B ';
  }
}

?>