{include file="header.tpl"}
{if $newest == 1}
<p>< back
{else}
<p><a href="view?id={$previousId}&sketch={$picture.sketch}">< back</a> 
{/if}
{if $oldest == 1}
next > </p>
{else}
<a href="view?id={$nextId}&sketch={$picture.sketch}">next ></a></p>
{/if}
<img src="../uploads/{$picture.filename_full}">
<p>{$picture.name} - {$picture.description}</p>
{include file="footer.tpl"}