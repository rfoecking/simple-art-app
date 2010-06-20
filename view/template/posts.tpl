{include file="header.tpl"}
<ul>
{foreach from=$posts item=post}
	<li><p>Title: {$post.title}</p>
		<p>Content: {$post.content}</p>
		<p>Posted on: {$post.time}</p>
	</li>
{/foreach}
</ul>
{include file="footer.tpl"}