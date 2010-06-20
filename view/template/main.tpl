{include file="header.tpl" title="LEROY!"}
<h2>Welcome to LEROY!</h2>
<ul>
{foreach from=$posts item=post}
	{if $post.picture == 0}
	<li><p>Title: {$post.title}</p>
		<p>Content: {$post.content}</p>
		<p>Posted on: {$post.datetime}</p>
	</li>
	{else}
	<li>Leroy posted a new artwork at {$post.datetime} ..
		<p>{$post.title}, {$post.content}</p>
		<p><a href="../uploads/{$post.filename_full}"><img src="../uploads/{$post.filename_thumb}"></a></p>
	</li>
	{/if}
{/foreach}
</ul>
{include file="footer.tpl}
