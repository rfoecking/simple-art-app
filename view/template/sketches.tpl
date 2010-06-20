{include file="header.tpl"}
<ul>
<h2> Sketches </h2>
{foreach from=$pictures item=picture}
	<li><p>Name: {$picture.name}</p>
		<p>Description: {$picture.description}</p>
		<p><a href="../uploads/{$picture.filename_full}"><img src="../uploads/{$picture.filename_thumb}"></a></p>
	</li>
{/foreach}
</ul>
{include file="footer.tpl"}