<!DOCTYPE html>
<html>
<style>
body, input, button { font-size: 125%; }
div { width: 50%; margin: 0 auto; }
</style>
<body onload="myFunction()">

<ol>
<li>Kopírovat text (Ctrl + C nebo pravé tlačítko myši a z nabídky zvolit kopírovat)</li>
<li>Zavřít okno (Ctrl + W nebo myší /při kliknutí kolečkem se záložka zavře a nemusíte se trefovat na křížek/)</li>
<li>Vložit jméno v tritiu (Ctrl + V nebo pr. tl. myši)</li>
</ol>

<div>
<input onclick="myFunction()" type="text" value="<?php echo htmlspecialchars($_GET["name"]); ?>" id="myInput">
<button onclick="myFunction()">označ</button>
</div>

<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  //navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}
</script>



</body>
</html>