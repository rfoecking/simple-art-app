{include file="header.tpl"}
<ul>
<h2> Finished Works </h2>
{foreach from=$pictures item=picture}
	{if !$picture.id == 0}<!-- HACKKK -->
	<li><p>Name: {$picture.name}</p>
		<p>Description: {$picture.description}</p>
		<p><a href="../uploads/{$picture.filename_full}"><img src="../uploads/{$picture.filename_thumb}"></a></p>
	</li>
	{/if}
{/foreach}
</ul>
{include file="footer.tpl"}