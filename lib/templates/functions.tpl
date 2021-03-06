{* Global functions *}
{function input n="" type="" placeholder="" big=false repeat=false}
	{$type = strtolower($type)}
	{if in_array($type, ['text', 'password', 'user', 'email'])}
		{* is textfield? *}
		{if in_array($type, ['user'])} {$ftype = 'text'} {else} {$ftype = $type} {/if}

		<div class="input {$type}{if $big} big{/if}">
			<input type="{$ftype}" name="{$n}"{if $placeholder} placeholder="{$placeholder}"{/if}>{if $type == 'password'}<span class="switch" title="{lang n='form.show_password'}"></span>{/if}
		</div>
	{else}
		{sprintf({lang n="form.input_not_found"}, $type)}
	{/if}
{/function}

{function breadcrumbs}
	<div class="w_content">
		<div class="breadcrumbs">
		{foreach $nav.crumbs as $crumb}
			<a href="{$crumb.link}" class="crust">
				<span class="crumb">{$crumb.name}</span>
			</a>
		{/foreach}
		</div>
	</div>
{/function}
