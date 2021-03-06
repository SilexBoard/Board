{* TODO: Make a nicer error page *}
{if $compose.error}

<div class="container">

	{if $compose.type == 1}
    {lang n="error.no_board"}
	{elseif $compose.type == 2}
	{lang n="error.no_thread"}
	{/if}

</div>

{else}

<form method="post">

	<input type="hidden" name="type" value="{$compose.type}">
	<input type="hidden" name="target" value="{$compose.target}">

	<div class="container">

		<div class="container_head">
			{if $compose.type == 1}
			<div class="title">{lang n="compose.compose_thread"}</div>
            <div class="description">{lang n="compose.thread_in"} {$compose.board->GetTitle()}</div>
			{elseif $compose.type == 2}
			<div class="title">{lang n="compose.compose_reply"}</div>
			<div class="description">{lang n="compose.reply_to"} {$compose.thread->GetTopic()}</div>
            {elseif $compose.type == 3}
            <div class="title">{lang n="compose.compose_edit"}</div>
            <div class="description">{lang n="compose.edit_in"} {$compose.post->GetThread()->GetTopic()}</div>
			{/if}
		</div>

		<div class="container_content">

			{if $compose.type == 1} {* New threads only *}
			<fieldset class="compose_info">
                <legend>{lang n="compose.info"}</legend>
				<label for="Topic">{lang n="compose.topic"}</label><br>
                <input type="text" name="topic" id="topic" required="required"{if $input.topic} value="{$input.topic}"{/if}>
				{* Prefixes - someday *}
			</fieldset>
			{/if}

			<fieldset class="compose_message">
                <legend>{lang n="compose.message"}</legend>
				<div class="compose_message_text">
					<textarea name="message" id="message" required="required">{if $input.message}{$input.message}{/if}</textarea>
				</div>
			</fieldset>

			<fieldset class="compose_settings">
				<legend>{lang n="compose.settings"}</legend>

				<table>
					<tr>
						<td>{lang n="compose.settings.silexcode"}</td>
						<td>
							<select name="setting_silexcode">
								<option value="1"{if !isset($input.silexcode) || $input.silexcode === true} selected="selected"{/if}>{lang n="compose.settings.yes"}</option>
								<option value="0"{if $input.silexcode === false} selected="selected"{/if}>{lang n="compose.settings.no"}</option>
							</select>
						</td>
					</tr>
                    <tr>
                        <td>{lang n="compose.settings.html"}</td>
                        <td>
                            <select name="setting_html">
                                <option value="1"{if $input.html === true} selected="selected"{/if}>{lang n="compose.settings.yes"}</option>
                                <option value="0"{if !isset($input.html) || $input.html === false} selected="selected"{/if}>{lang n="compose.settings.no"}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{lang n="compose.settings.smileys"}</td>
                        <td>
                            <select name="setting_smileys">
                                <option value="1"{if !isset($input.smileys) || $input.smileys === true} selected="selected"{/if}>{lang n="compose.settings.yes"}</option>
                                <option value="0"{if $input.smileys === false} selected="selected"{/if}>{lang n="compose.settings.no"}</option>
                            </select>
                        </td>
                    </tr>
				</table>

			</fieldset>

		</div>

		<div class="container_footer">
			<div class="compose_number_characters left">
				{lang n="compose.number_characters"}: <span id="number_characters">{if $input.numchars}{$input.numchars}{else}0{/if}</span>
			</div>

			<div class="button_bar right">
				<div class="button_group">
					<input type="submit" name="save" id="save" class="s_button" value="{lang n="compose.save"}">
					{*<input type="submit" name="preview" id="preview" class="s_button" value="{lang n="compose.preview"}">*}
					<div class="s_button">{lang n="compose.preview"}</div>
				</div>
			</div>

		</div>

	</div>

</form>
{/if}