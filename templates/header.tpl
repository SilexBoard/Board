{% include "userbar.tpl" %}
	<header class="min_size">
		<div class="LogoBlock">
			<div class="Logo size">
				<a href="./" title="{{ lang=sbb.header.logo_title }}">
					<img src="{{ logo }}" alt="Logo">
				</a>
				<div class="Slogan">
					{{ lang=sbb.header.slogan }}
				</div>
			</div>
		</div>
		<nav class="Menu">
			<div class="size">
				<ul class="MenuList">
				{% for MenuPoint in Menu %}
					{% if MenuPoint.Active %}
					<li class="active"><a href="{{ MenuPoint.Link }}"><span>{{ MenuPoint.Name }}</span></a></li>
					{% else %}
					<li><a href="{{ MenuPoint.Link }}"><span>{{ MenuPoint.Name }}</span></a></li>
					{% endif %}
				{% endfor %}
				</ul>
				{#<ul class="sub_menu">
				</ul>#}
				<div id="SearchForm">
					<form method="get" accept-charset="utf-8">
						<input title="{{ lang=sbb.header.search.title }}" type="search" value="" placeholder="{{ lang=sbb.header.search.placeholder }}" name="search" id="Search" pattern=".+" required><input type="submit" id="SearchSubmit" value="">
					</form>
				</div>
			</div>
		</nav>
	</header>