<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

?>
<!DOCTYPE html>
<html>
<body><!-- This is a comment node! -->

<p>Click the button get info about the body element's child nodes.</p>

<button onclick="myFunction()">Try it</button>

<p><strong>Note:</strong> Whitespace inside elements is considered as text, and text 
is considered as nodes. Comments are also considered as nodes.</p>

<p id="demo"></p>

</body>
</html>

<script>
// var x= Array.from(document.getElementsByClassName("box-1"));
// x.forEach(function(value,index){
//     value.innerHTML = index;
// })
Array.from(document.querySelectorAll(".box2")).forEach(function(value, index) {
    value.addEventListener("click", function() {
        console.log(this.querySelector(".box3"));
    })
})
</script>