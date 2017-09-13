
function InitRadio(radio,param){
	"use strict";
	console.log(radio);
	if(param == 2){
		radio[0].checked = true;
		radio[1].checked = false;
		radio[2].checked = false;
	}else if(param == 1){
		radio[0].checked = false;
		radio[1].checked = true;
		radio[2].checked = false;
	}else{
		radio[0].checked = false;
		radio[1].checked = false;
		radio[2].checked = true;
	}
}

function InitNav(li,param){
	"use strict";
	for(let i = 0 ; i < li.length ; i++){
		if(li[i].id == "l_"+ param){
			li[i].className = "active";
		}
	}
}

function InitCategory(options,sub_options,param,param_sub){
	/*let sub_options = arguments[1]?arguments[1]:null;
	let param_sub = arguments[3]?arguments[3]:"";*/
	for(let i = 0 ; i < options.length ; i++){
		if(options[i].value == param){
			options[i].selected = true ;
		}
	}

	if(sub_options != null){
		if(param == "teachers"){
			sub_options.disabled = false;
			for(let i = 0 ; i < sub_options.length ; i++){
				if(sub_options[i].value == param_sub){
					sub_options[i].selected = true ;
				}
			}
		}
	}
}

function InitSubCategory(select, subSelect){
	select.change(function(event) {
		if(this.options[this.selectedIndex].value == "teachers"){
			subSelect[0].disabled = false;
		}else{
			subSelect[0].disabled = true;
		}
	});
}



