{include file="header.tpl"}
<form action="upload.do" enctype="multipart/form-data" method="post">
<p>Name:</p>
<input type="text" name="name" size="30">
</p>
<p>Gallery description:</p>
<textarea rows="10" cols="30" name="gallery">Type stuff... </textarea>
</p>
<p>News feed description:</p>
<textarea rows="10" cols="30" name="newsfeed">Type stuff... </textarea>
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