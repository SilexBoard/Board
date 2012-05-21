<div class="container">
	<div class="progressbar_trim">
		<div class="progressbar" title="Fortschritt">
			<div class="progress" style="width: {{ Register.Progress }}%;">
				<div class="shine"></div>
			</div>
		</div>
	</div>
	<div class="register_content">
		{% if Register.Step == "register.username" or not Register.Step %}
			<h1>{{ lang=sbb.register.username }}</h1>
			<form method="post">
				<input type="text" name="Username" value="{{ Register.Username|default('') }}" placeholder="{{ lang=sbb.register.username }}" autocomplete="on" required>
				<input type="submit" name="sub_username" value="Weiter">
				<div>
					Notes:<br>
					"Dieser Benutzername ist bereits vergeben, wollen sie sich stattdessen einloggen? [...]"
				</div>
			</form>
		{% elseif Register.Step == "register.password" %}
			<h1>{{ lang=sbb.register.password }}</h1>
			<form method="post">
				<input type="password" name="Password" value="{{ Register.RealPw|default('') }}" placeholder="{{ lang=sbb.register.password }}" autocomplete="off" required>
				<input type="password" name="Password_Re" placeholder="{{ lang=sbb.register.password_repeat }}" autocomplete="off" required>
				<input type="submit" name="sub_password" value="Weiter">
			</form>
		{% elseif Register.Step == "register.email" %}
			<h1>{{ lang=sbb.register.email }}</h1>
			<form method="post">
				<input type="email" name="Email" value="{{ Register.Email|default('') }}" placeholder="{{ lang=sbb.register.email }}" autocomplete="on" required>
				<input type="email" name="Email_Re" placeholder="{{ lang=sbb.register.email_repeat }}" autocomplete="off" required>
				<input type="submit" name="sub_email" value="Weiter">
			</form>
		{% elseif Register.Step == "register.captcha" %}
			<h1>{{ lang=sbb.register.captcha }}</h1>
			<form method="post">
				hier gibts noch nüscht!
				<input type="submit" name="sub_password" value="Weiter">
			</form>
		{% endif %}
		{% if Register.Step != "register.username" %}
			<form method="post">
				<input type="submit" name="sub_back" value="Zurück">
				<input type="submit" name="sub_restart" value="Neu beginnen">
			</form>
		{% endif %}
	</div>
	<div class="register_info">
		<img src="{{ Register.Avatar }}"><br><br>
		Benutzername: {{ Register.Username|default('') }}<br>
		Passwort: {{ Register.Password|default('') }}<br>
		E-Mail: {{ Register.Email|default('') }}<br>
	</div>
	<div style="clear:both;"></div>
</div>