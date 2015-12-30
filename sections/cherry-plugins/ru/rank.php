	<h3>Cherry Rank</h3>

	<p><a href="https://github.com/CherryFramework/cherry-style-switcher">Cherry Rank</a> - плагин предназначенный для вывода элементов рейтинга, проставления лайков / дизлайков, а также количества просмотров.</p>

	<p>
		На главной странице переходим “Cherry => Option => Blog => Additional post meta", и там настраиваем вывод элементов, <a href="./index.php?project=monstroid&lang=en&section=cherry-options#option-blog">подробнее</a>.
	</p>

<p>Вывод элементов в шаблоне осуществляется посредством макросов:</p>

	<ul class="marked-list">
		<li>
			<dl class="inline-term">
				<dt>%%LIKES%%</dt>
				<dd>
					Для вывода счетчика лайков
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>%%DISLIKES%%</dt>
				<dd>
					Для вывода счетчика дизлайков
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>%%VIEWS%%</dt>
				<dd>
					Для вывода счетчика просмотров
				</dd>
			</dl>
		</li>
		<li>
			<dl class="inline-term">
				<dt>%%RATING%%</dt>
				<dd>
					Для вывода счетчика рейтинга
				</dd>
			</dl>
		</li>
	</ul>
	<figure class="img-polaroid">
		<img src="img/cherryframework/plugins/rank-front.png" alt="" style="opacity: 1;"><i class="icon-search"></i><span></span>
	</figure>