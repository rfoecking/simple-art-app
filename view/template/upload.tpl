{include file="header.tpl"}
<form action="upload.do" enctype="multipart/form-data" method="post">
<p>Name:</p>
<input type="text" name="name" size="30">
</p>
<p>Description:</p>
<input type="text" name="description" size="30">
</p>
<p>Full image: </p>
<input name="image[]" type="file" />
<p>Thumbnail: </p>
<input name="image[]" type="file" />
</p>
 <p>Sketch?
<input type="checkbox" name="isSketch" value="1" />
</p>
<input type="submit" value="Send">

</form>
{include file="footer.tpl"}