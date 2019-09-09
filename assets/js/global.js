Array.prototype.inArray = function (value)
{
	var i;
	for (i=0; i < this.length; i++)
	{
		if (this[i] == value)
		{
			return true;
		}
	}
	return false;
};

function change_language(id)
{
	if(id=='ch')
	{
		$('.languageButton').html(ui_string['chinese_lang']);
		$('.languageButton').attr('onclick','change_language("en")');
	}
	if(id=='en')
	{
		$('.languageButton').html(ui_string['enlish']);
		$('.languageButton').attr('onclick','change_language("ar")');
	}

	$.ajax({
		url:admin_ui_url+"change_language.php",
		data:"id="+id,
		type:"POST",
		success:function(suc)
				{
					location.reload();
				}
	})
}

// Rendering UI Components
$("div.renderComponents").each(function(){
	renderComponents($(this));
  })
  
   function renderComponents(ele){
	   	if($(ele)[0]==undefined)
	  		return;
	   	var params={};
		var action = $(ele).attr("data-type");
	  	console.log("rendering Comp");
	  	htmlParams={};
	   $.each($(ele)[0].attributes, function (key, attr) {
	     if(attr.name.indexOf("data-params")!==-1){
	     	var attrName = attr.name;
	     	attrName = attrName.replace("data-params-","");
	       params[attrName]=attr.value;
	     }
	     if(attr.name.indexOf("data-html")!==-1){
	       var attrName = attr.name;
	     	attrName = attrName.replace("data-html-","");
	       htmlParams[attrName]=attr.value;
	     }
	   });
	   getRenderComponentData(action,params,htmlParams,$(ele)[0]);
  }

  function getRenderComponentData(action,param,htmlParams,ele){
  	var params={};
  	params['action']=action;
  	params['html']=JSON.stringify(htmlParams);
  	params['params']=JSON.stringify(param);
  	$.ajax({
		url:site_url+"framework/commonRender.php",
		data:params,
		type:"POST",
		success:function(suc
			)
				{
					console.log($(ele));
					$(ele).html(suc);
				}
	});
  }


