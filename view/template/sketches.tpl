{include file="header.tpl"}
<ul>
<h2> Sketches </h2>
{foreach from=$pictures item=picture}

<a href="view?id={$picture.id}&sketch=1"><img src="../uploads/{$picture.filename_thumb}"></a>

{/foreach}
</ul>
{include file="footer.tpl"}