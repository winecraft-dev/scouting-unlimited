<?php

class Sanitizer
{
  public static function sanitize()
  {
		foreach($_POST as $key => $value)
		{
			$newValue = "";
			foreach(str_split($value) as $v)
			{
				if($v == '<')
				{
					$newValue .= '&lt;';
				}
				else if($v == '>')
				{
					$newValue .= '&gt;';
				}
				else
				{
					$newValue .= $v;
				}
			}
			$_POST[$key] = $newValue;
		}
		foreach($_GET as $key => $value)
		{
			$newValue = "";
			foreach(str_split($value) as $v)
			{
				if($v == '<')
				{
					$newValue .= '&lt;';
				}
				else if($v == '>')
				{
					$newValue .= '&gt;';
				}
				else
				{
					$newValue .= $v;
				}
			}
			$_GET[$key] = $newValue;
		}
  }
}

