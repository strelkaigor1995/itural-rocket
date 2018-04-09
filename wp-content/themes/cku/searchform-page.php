<!-- Яндекс.Поиск для сайта -->
<script type="text/javascript">
	function ysFormSubmit() {
		var form = document.getElementById('ysForm');
		var el0 = form.elements[0];
		var el1 = form.elements[1];
		var el2 = form.elements[2];
		var el3 = form.elements[3];
		document.location = form.action + "?" + el0.name + "=" + encodeURIComponent(el0.value) + "&" + el1.name + "=" + encodeURIComponent(el1.value)+ "&" + el2.name + "=" + encodeURIComponent(el2.value) + "&" + el3.name + "=" + encodeURIComponent(el3.value);
		return false;
	}
</script>
<form action="/poisk" method="get" target="_self" id="ysForm" onsubmit="return ysFormSubmit()">
	<input type="hidden" name="searchid" value="244334" />
	<input type="hidden" name="l10n" value="ru" />
	<input type="hidden" name="reqenc" value="" />
	<input type="text" name="text" value="<?php echo $_GET['text']; ?>" class="s-page" size="80" title="Введите запрос для поиска на сайте" />
	<input type="submit" value="<?php _e('Search', 'arras') ?>" title="Найти на сайте" />
</form>
<!-- -------------------------- -->