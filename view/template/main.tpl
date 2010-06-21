{include file="header.tpl" title="LEROY!"}
<h2>new artwork</h2>
<div id="post">
{foreach from=$posts item=post}

	{if $post.picture == 0}
	<span class="title">{$post.title}</span><span class="datetime">posted {$post.datetime} by leroy</span>
		<p class="content">{$post.content}</p>
	{else}
	<p class="update">leroy posted a new artwork on {$post.datetime} ... </p>
		<p><a href="view?id={$post.picture_id}&sketch={$post.sketch}"><img src="../uploads/{$post.filename_thumb}"></a></p>
			<span class="update-title">{$post.title}</span> - <span class="update-content">{$post.content}</span>
	{/if}
	<hr>
{/foreach}
</div>

{include file="footer.tpl}
