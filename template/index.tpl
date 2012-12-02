<!DOCTYPE HTML>
<html{if $user.lang_code} lang="{$user.lang_code}"{/if}>
<head>
	<meta charset="utf-8">
	<title>{$current_page.title} · {$page_title}</title>
	<link rel="shortcut icon" href="{$base_url}favicon.ico">
{foreach $style.css as $cssf}	<link rel="stylesheet" type="text/css" href="{$style.dir}{$cssf.file}"{if $cssf.media} media="{$cssf.media}"{/if}>{/foreach}
{foreach $js as $js_file}	<script type="text/javascript" src="{$base_url}{$js_file|escape}"></script>{/foreach}
</head>
<body>











{if !$debug}</body>
</html>{/if}
