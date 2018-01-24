function openDialog(){
	paramers="dialogWidth:500px; dialogHeight:50px; status:no";
	workerId = window.showModalDialog("modal.html","",paramers);
	if(workerId!=undefined && workerId!=""){
		document.getElementById("news_content").value += workerId;
	  }
	
}


function openDialogCode(){
	paramers="dialogWidth:500px; dialogHeight:500px; status:no";
	workerId = window.showModalDialog("modalCode.html","",paramers);
	if(workerId!=undefined && workerId!=""){
		document.getElementById("news_content").value += workerId;
	  }
	
}