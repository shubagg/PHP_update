<?php  
$html='  	 


<h3>form-validation</h3>
<br>
			<p>Enter a number and click OK:</p>
			<br>
<form id="id1">
<input  type="number" min="100" max="300" required>
<input  type="text" min="100" max="300" required>
<input  type="password" min="100" max="300" required>
<button class="" onclick="myFunction()">OK</button>
</form>
<p>If the number is less than 100 or greater than 300, an error message will be displayed.</p>

<p id="demo"></p>

																
																';

?>