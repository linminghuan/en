
function InitRadio(radio,param){
	if(param == 0){
		radio[0].checked = true;
		radio[1].checked = false;
	}else{
		radio[0].checked = false;
		radio[1].checked = false;
	}
}

function InitNav(li,param){
	for(var i = 0 ; i < li.length ; i++){
		if(li[i].id == "l_"+ param){
			li[i].className = "active";
		}
	}
}

function InitCategory(options,sub_options,param,param_sub){
	/*let sub_options = arguments[1]?arguments[1]:null;
	let param_sub = arguments[3]?arguments[3]:"";*/
	for(var i = 0 ; i < options.length ; i++){
		if(options[i].value == param){
			options[i].selected = true ;
		}
	}

	if(sub_options != null){
		if(param == "teachers"){
			sub_options.disabled = false;
			for(var i = 0 ; i < sub_options.length ; i++){
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

function batchDel(elementId, url)
{
	$(elementId).click(function(event) {
		var checkedList = new Array(); 
		$("input[name='checkbox']:checked").each(function() {   
			checkedList.push($(this).val());   
		});
		if(checkedList.length == 0){
			alert('至少选中一项');
			return;
		} 
		if(confirm("确定要删除所选项目？")){
			$.ajax({   
				type: "POST",   
				url: url,   
				data: {
					'delitems':checkedList.toString()}, 
					success: function(result) {  
						$("[name ='checkbox']:checkbox").attr("checked", false); 
						window.location.reload();   
					}   
			});
		}
	});
	
}

//全选
function checkAll(elementId)
{
	$(elementId).click(function(event) {
		$("[name ='checkbox']:checkbox").attr("checked", this.checked);
	});
	
}



