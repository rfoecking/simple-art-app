{include file="header.tpl"}
<ul>
<h2> finished works </h2>
{foreach from=$pictures item=picture}
	<span id="finished">
	{if !$picture.id == 0}<!-- HACKKK -->
		<a href="view?id={$picture.id}&sketch=0"><img src="../uploads/{$picture.filename_thumb}"></a>
	{/if}
	</span>
{/foreach}
</ul>
{include file="footer.tpl"}