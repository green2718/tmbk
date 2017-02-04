function setEventA() {
	document.getElementById("reset").addEventListener("click", function(event){
		event.returnValue = false;
		connec = new XMLHttpRequest();
		connec.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("kittyArea").innerHTML = this.responseText;
				setEventA();
			}
		};
		connec.open('GET','select_kitten.php', true);
		connec.send();
	});
	[].slice.call(document.getElementsByClassName("kitty")).forEach(function(elmt) {
		elmt.addEventListener("click", function(event){
			event.returnValue = false;
			connec = new XMLHttpRequest();
			connec.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("kittyArea").innerHTML = this.responseText;
					setEventA();
				}
			};
			connec.open('GET','selected.php?kitten='+this.getAttribute('data'), true);
			connec.send();
		});
	});
};

setEventA();
