<?php   function smarty_modifier_capitalize($string, $uc_digits = false, $lc_rest = false) { if (Smarty::$_MBSTRING) { if ($lc_rest) {  $upper_string = mb_convert_case( $string, MB_CASE_TITLE, Smarty::$_CHARSET ); } else {  $upper_string = preg_replace("!(^|[^\p{L}'])([\p{Ll}])!eS" . Smarty::$_UTF8_MODIFIER, "stripslashes('\\1').mb_convert_case(stripslashes('\\2'),MB_CASE_UPPER, '" . addslashes(Smarty::$_CHARSET) . "')", $string); }  if (!$uc_digits) { if (preg_match_all("!\b([\p{L}]*[\p{N}]+[\p{L}]*)\b!" . Smarty::$_UTF8_MODIFIER, $string, $matches, PREG_OFFSET_CAPTURE)) { foreach($matches[1] as $match) { $upper_string = substr_replace($upper_string, mb_strtolower($match[0], Smarty::$_CHARSET), $match[1], strlen($match[0])); } } } $upper_string = preg_replace("!((^|\s)['\"])(\w)!e" . Smarty::$_UTF8_MODIFIER, "stripslashes('\\1').mb_convert_case(stripslashes('\\3'),MB_CASE_UPPER, '" . addslashes(Smarty::$_CHARSET) . "')", $upper_string); return $upper_string; }  if ($lc_rest) { $string = strtolower($string); }  $upper_string = preg_replace("!(^|[^\p{L}'])([\p{Ll}])!eS" . Smarty::$_UTF8_MODIFIER, "stripslashes('\\1').ucfirst(stripslashes('\\2'))", $string);  if (!$uc_digits) { if (preg_match_all("!\b([\p{L}]*[\p{N}]+[\p{L}]*)\b!" . Smarty::$_UTF8_MODIFIER, $string, $matches, PREG_OFFSET_CAPTURE)) { foreach($matches[1] as $match) { $upper_string = substr_replace($upper_string, strtolower($match[0]), $match[1], strlen($match[0])); } } } $upper_string = preg_replace("!((^|\s)['\"])(\w)!e" . Smarty::$_UTF8_MODIFIER, "stripslashes('\\1').strtoupper(stripslashes('\\3'))", $upper_string); return $upper_string; } ?>