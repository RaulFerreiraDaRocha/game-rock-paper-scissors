<!DOCTYPE html>
<html>
<title>JOGO PAPEL PEDRA TESOURA</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.w3-hover-sepia:hover{
	cursor:pointer;
	box-shadow: 2px 2px 2px #000;
}
#resultado{
	border: 3px dashed pink;
	padding: 20px;
	display: none;
}

</style>
<body>
<div class="w3-card-4 w3-margin" style="width:50%">
<button class="w3-button w3-pink w3-center w3-block" onclick="verResultado()">Ver Resultado</button>
  <div class="w3-display-container w3-text-white">
    <img src="imgs/arena.jpg" alt="Lights" style="width:100%">
	<div class="w3-display-topleft w3-container">Jogador 1</div>
  <div class="w3-display-topright w3-container">Jogador 2</div>
	<div class="w3-display-left w3-container w3-border w3-white" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="width:128px;height:128px;margin-left: 15px;"></div>
  <div class="w3-display-right w3-container w3-border w3-white" id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"style="width:128px;height:128px;margin-right: 15px;"></div>
  <div class="w3-display-middle w3-large"><span  id="resultado">Vencedor</span></div>
  </div>
  <div class="w3-row">
    <div class="w3-third w3-center" id="ddrag1">
      <h3>PEDRA</h3>
      <img src="imgs/rock.png" id="drag1"  class="w3-hover-sepia"  draggable="true" ondragstart="drag(event)" alt="pedra" style="width:80px">
    </div>
    <div class="w3-third w3-center" id="ddrag2">
      <h3>PAPEL</h3>
      <img src="imgs/paper.png" id="drag2"  class="w3-hover-sepia"  draggable="true" ondragstart="drag(event)"  alt="papel" style="width:80px">
    </div>
    <div class="w3-third w3-center w3-margin-bottom"  id="ddrag3">
      <h3>TESOURA</h3>
      <img src="imgs/scissors.png" id="drag3" class="w3-hover-sepia"  draggable="true" ondragstart="drag(event)" alt="tesoura" style="width:80px">
    </div>
  </div>
</div>
<script>

function verResultado(){
var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("resultado").innerHTML = this.responseText;
		document.getElementById("resultado").style.display = "block";
		setTimeout(function(){location.reload();},5000);
      }
    };
    xmlhttp.open("GET", "recebe_dados.php?resultado=1", true);
    xmlhttp.send();
}
/*DRAG AND DROP EVENTS*/
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  x = document.getElementById(data).getAttribute("id");
  //alert(x);
  var n_jogador = sessionStorage.getItem('jogador');
  
  if(n_jogador != 1 && n_jogador != 2){
  sessionStorage.setItem('jogador','1');
  var xmlhttp = new XMLHttpRequest(x);
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //não faz nada
      }
    };
    xmlhttp.open("GET", "recebe_dados.php?jogada=" + x + "&jogador=1", true);
    xmlhttp.send();
  }else{
  sessionStorage.setItem('jogador','2');  
  var xmlhttp = new XMLHttpRequest(x);
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        //apenas removo a session
		sessionStorage.removeItem('jogador');
      }
    };
    xmlhttp.open("GET", "recebe_dados.php?jogada=" + x + "&jogador=2", true);
    xmlhttp.send();
  }
  
}
window.onload = function(){
	sessionStorage.removeItem('jogador');
}
</script>
</body>
</html> 