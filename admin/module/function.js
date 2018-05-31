// JavaScript Document

	function MouseOverMenu(id){
		document.getElementById(id).className='MouseOverMenu';
	}
	function MouseOutMenu(id){
		document.getElementById(id).className='MouseOutMenu';	
	}
	
	function MouseOverProduct(id){
		document.getElementById(id).className='MouseOverProduct';	
	}
	function MouseOutProduct(id){
		document.getElementById(id).className='MouseOutProduct';	
	}
	
	function MouseOverCategory(id){
		document.getElementById(id).className='MouseOverCategory';	
	}
	function MouseOutCategory(id){
		document.getElementById(id).className='MouseOutCategory';	
	}
	
	function MouseOverMenuStand(id){
		document.getElementById(id).className='MouseOverMenuStand';	
	}
	function MouseOutMenuStand(id){
		document.getElementById(id).className='MouseOutMenuStand';
	}

	// function MouseOverMenuStand(id){
	// 	document.getElementById(id).className='MouseOverMenuExit';
	// }
	// function MouseOutMenuStand(id){
	// 	document.getElementById(id).className='MouseOutMenuExit';
	// }
	
// JavaScript CheckNum

	function CheckNum(id){
		if(isNaN(document.getElementById(id).value)){
			alert('กรุณากรอก จำนวนเต็มเท่านั้น');
			document.getElementById(id).focus();
			return false;	
		}	
	}





