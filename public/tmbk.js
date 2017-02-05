var reqLock = false;
function setEventA() {
	document.getElementById("reset").addEventListener("click", function(event){
		event.returnValue = false;
		if (reqLock) return;
		reqLock = true;
		connec = new XMLHttpRequest();
		connec.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("kittyArea").innerHTML = this.responseText;
				setEventA();
			}
			reqLock = false;
		};
		connec.open('GET','select_kitten.php?equal=1', true);
		connec.send();
	});
	[].slice.call(document.getElementsByClassName("kitty")).forEach(function(elmt) {
		elmt.addEventListener("click", function(event){
			event.returnValue = false;
			if (reqLock) return;
			reqLock = true;
			connec = new XMLHttpRequest();
			connec.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("kittyArea").innerHTML = this.responseText;
					setEventA();
				}
				else if (this.readyState == 4 && this.status == 429) {
					alert("Doucement ! Prenez le temps d'admirer ces chatons !");
				}
				reqLock = false;
			};
			connec.open('GET','selected.php?kitten='+this.getAttribute('data'), true);
			connec.send();
		});
	});
};

setEventA();
