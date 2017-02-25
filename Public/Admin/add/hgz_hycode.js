
var hystrVar = "";
    hystrVar += "<div  class=\"aui_state_box\"><div class=\"aui_state_box_bg\"></div>";
    hystrVar += "<div class=\"aui_outer aui_alert\" id=\"drag_con\">";
    hystrVar += "<table class=\"aui_border aui_hybox\" style=\"border:2px solid #8a9499;\">";
    hystrVar += "<tbody>";
    hystrVar += "<tr>";
    hystrVar += "	<td class=\"aui_w\">";
    hystrVar += "	</td>";
    hystrVar += "	<td class=\"aui_c\">";
    hystrVar += "		<div class=\"aui_inner\">";
    hystrVar += "			<table class=\"aui_dialog\">";
    hystrVar += "			<tbody>";
    hystrVar += "			<tr>";
    hystrVar += "				<td class=\"aui_header\" colspan=\"2\">";
    hystrVar += "					<div class=\"aui_titleBar\">";
    hystrVar += "						<div class=\"aui_title\" style=\"cursor: move;\">";
    hystrVar += "							选择服务项目";
    hystrVar += "						</div>";
    hystrVar += "						<a href=\"javascript:;\" class=\"aui_close\" onclick=\"Close()\">×</a>";
    hystrVar += "					</div>";
    hystrVar += "				</td>";
    hystrVar += "			</tr>";
    hystrVar += "			<tr>";
    hystrVar += "				<td class=\"aui_icon\" style=\"display: none;\">";
    hystrVar += "					<div class=\"aui_iconBg\" style=\"background: transparent none repeat scroll 0% 0%;\">";
    hystrVar += "					</div>";
    hystrVar += "				</td>";
    hystrVar += "				<td class=\"aui_main\" style=\"width: auto; height: auto;\">";
    hystrVar += "					<div class=\"aui_content\" style=\"padding: 10px 25px;\">";
    hystrVar += "						<div class=\"items jquery-localdata\">";
    hystrVar += "							<span class=\"tips aui-titlespan\">";
    hystrVar += "								"+"<span class=\"aui-selecteditem\"></span>"+"<span class=\"aui-selecteditem2\"></span>";
    hystrVar += "							</span>";
	
    hystrVar += "							<div style=\"height:400px\" class=\"item-table\">";
    hystrVar += "								<table style=\"width:700px;\" class=\"options-table\">";
    hystrVar += "								<tbody class=\"item-list\" >";
	var maxhy=znhycode;

for(var i in znhycode)
{
	var node="";
	for(var j in znhycode[i].maxhycode)
	{
		if(j!=znhycode[i].maxhycode.length-1){
            		if(j%5==0){
                        node += "       <tr>";
                        node += "           <td>";
                        node += "               <label>";
                        node += "               <input type=\"checkbox\"  name=\"item-list\" class=\"input-checkbox\" data-value=\""+znhycode[i].maxhycode[j].CodeValue+"\" data-name=\""+znhycode[i].maxhycode[j].CodeName+"\" data-id=\""+znhycode[i].maxhycode[j].id+"\" onclick=\"addhyitem(this)\">";
                        node += znhycode[i].maxhycode[j].CodeName;
                        node += "               </label>";
                        node += "           </td>";
                    }else{
                        node += "           <td>";
                        node += "               <label>";
                        node += "               <input type=\"checkbox\"  name=\"item-list\" class=\"input-checkbox\" data-value=\""+znhycode[i].maxhycode[j].CodeValue+"\" data-name=\""+znhycode[i].maxhycode[j].CodeName+"\" data-id=\""+znhycode[i].maxhycode[j].id+"\" onclick=\"addhyitem(this)\">";
                        node += znhycode[i].maxhycode[j].CodeName;
                        node += "               </label>";
                        node += "           </td>";
                    }
		}else
		{
            			if(j/4==0)
            		{
            			node += "		<tr>";
                node += "			<td>";
                node += "				<label>";
                node += "				<input type=\"checkbox\"  name=\"item-list\" class=\"input-checkbox\" data-value=\""+znhycode[i].maxhycode[j].CodeValue+"\" data-name=\""+znhycode[i].maxhycode[j].CodeName+"\" data-id=\""+znhycode[i].maxhycode[j].id+"\" onclick=\"addhyitem(this)\">";
                node += znhycode[i].maxhycode[j].CodeName;
                node += "				</label>";
                node += "			</td>";
            	    node += "		</tr>";
            		}else
            		{
            			    node += "			<td>";
                node += "				<label>";
                node += "				<input type=\"checkbox\"  name=\"item-list\" class=\"input-checkbox\" data-value=\""+znhycode[i].maxhycode[j].CodeValue+"\" data-name=\""+znhycode[i].maxhycode[j].CodeName+"\" data-id=\""+znhycode[i].maxhycode[j].id+"\" onclick=\"addhyitem(this)\">";
                node += znhycode[i].maxhycode[j].CodeName;
                node += "				</label>";
                node += "			</td>";
                node += "		</tr>";
            			}
			}
		
		}
	hystrVar += "<tr>";
    hystrVar += "	<th width=\"40\">";
    hystrVar +=znhycode[i].CodeName;
    hystrVar += "	</th>";
    hystrVar += "	<td>";
    hystrVar += "		<table>";
    hystrVar += "		<tbody>";
	hystrVar+=node;
    hystrVar += "		</tbody>";
    hystrVar += "		</table>";
    hystrVar += "	</td>";
    hystrVar += "</tr>";	
	}

	hystrVar += "          <tr>";
    hystrVar += "               <td class=\"aui_footer\" colspan=\"2\">";
    hystrVar += "                   <div class=\"aui_buttons\">";
    hystrVar += "                       <button class=\"aui-btn aui-btn-primary\" type=\"button\" style=\"width:300px;height:40px;background:#009900;\" onclick=\"svae_hyitem()\">确定</button>";
    hystrVar += "                       <button class=\"aui-btn aui-btn-light btn btn-default0\" type=\"button\" style=\"width:300px;height:40px;background: #FFFFFF;border-color: #fbfbfb;color: black;\" onclick=\"Close()\">取消</button>";
    hystrVar += "                   </div>";
    hystrVar += "               </td>";
    hystrVar += "           </tr>";
    hystrVar += "								</tbody>";
    hystrVar += "								</table>";
    hystrVar += "							</div>";
    hystrVar += "						</div>";
    hystrVar += "					</div>";
    hystrVar += "				</td>";
    hystrVar += "			</tr>";

    hystrVar += "			</tbody>";
    hystrVar += "			</table>";
    hystrVar += "		</div>";
    hystrVar += "	</td>";
    hystrVar += "	<td class=\"aui_e\">";
    hystrVar += "	</td>";
    hystrVar += "</tr>";
    hystrVar += "<tr>";
    hystrVar += "	<td class=\"aui_sw\">";
    hystrVar += "	</td>";
    hystrVar += "	<td class=\"aui_s\">";
    hystrVar += "	</td>";
    hystrVar += "	<td class=\"aui_se\" style=\"cursor: se-resize;\">";
    hystrVar += "	</td>";
    hystrVar += "</tr>";
    hystrVar += "</tbody> </table></div></div>";
//多选
var datainput=null;	
var xmtypes=null;
var zytype="";
function appendhybar(thiscon,type,types){
	datainput=thiscon;
    xmtypes=types;
	zytype=type;
	$('body').append(hystrVar);
	if(zytype=="duoxuan"){
		if($(datainput).data("value")!="")
		{
			var inputarry= $(datainput).data("value").split('-');
			$('.options-table .input-checkbox').each(function(index) {
				for(var i in inputarry)
				{
				if($(this).data("value")==inputarry[i])
				{
					$(this).click();
				}
				}
			});
		}
	}else
	{
		$('.aui_state_box .aui_buttons').remove();
		$('.aui-titlespan').remove();
	}

	var minwid=document.documentElement.clientWidth;
	$('.aui_outer .aui_header').on("mousedown",function(e){
                        /*$(this)[0].onselectstart = function(e) { return false; }*///防止拖动窗口时，会有文字被选中的现象(事实证明不加上这段效果会更好)
                        $(this)[0].oncontextmenu = function(e) { return false; }//防止右击弹出菜单
                        var getStartX = e.pageX,
                            getStartY =  e.pageY;
                        var getPositionX = (minwid/2)-$(this).offset().left,
                            getPositionY = $(this).offset().top;							
                        $(document).on("mousemove",function(e){
                            var getEndX = e.pageX,
                                getEndY =  e.pageY;
                            $('.aui_outer').css({
                                left:getEndX-getStartX-getPositionX,
                                top: getEndY-getStartY+getPositionY
                            });
							
                        });
                        $(document).on("mouseup",function(){
                            $(document).unbind("mousemove");
                        })
                    });
}
//选择行业
function addhyitem(con){
	if(zytype=="duoxuan"){
	if($(con).prop("checked")==true)
	{
		//判断是否存在
		if($(".sltnode-checkbox[data-value="+$(con).data("value")+"]").prop("checked")) return false;
		
		if($('.options-table .input-checkbox:checked').length > 100)
		{
			$(con).prop("checked",false);
			alert('最多只能选择10项！'); return false;
		}else
		{
            var selectnode="<label id=\"sltnode-"+$(con).data("value")+"\"><input type=\"checkbox\" checked=\"checked\"  name=\"item-list\" class=\"sltnode-checkbox\" data-value=\""+$(con).data("value")+"\" data-name=\""+$(con).data("name")+"\" data-id=\""+$(con).data("id")+"\" onchange=\"removehyitem(this)\">"+$(con).data("name")+ "<i>×</i></label>";
				
            // $('.aui-selecteditem').append(selectnode);

            $('.aui-selecteditem').append("<span class=\"svae_box aui-titlespan\" data-code=\""+$(con).data("value")+"\"  data-name=\""+$(con).data("name")+"\" onclick=\"removespan(this)\">"+$(con).data("name")+"<i>×<\/i><label style=\"display:none\" id=\"sltnode-"+$(con).data("value")+"\"><input type=\"checkbox\" checked=\"checked\"  name=\"item-list\" class=\"sltnode-checkbox\" data-value=\""+$(con).data("value")+"\" data-name=\""+$(con).data("name")+"\" data-id=\""+$(con).data("id")+"\" onchange=\"removehyitem(this)\">"+$(con).data("name")+ "<i>×</i></label><\/span>");           
			
		}
	}else
	{
		$(".sltnode-checkbox[data-value="+$(con).data("value")+"]").prop("checked",false);
		$(".sltnode-checkbox[data-value="+$(con).data("value")+"]").parent('label').remove();
		}
	}else
	{
		$(datainput).data("value",$(con).data("value"));
		$(datainput).val($(con).data("name"));
		$('.aui_state_box').remove();
	}
}


//移除所选
function removehyitem(con){
	$(con).parent('label').remove();
	$('.options-table .input-checkbox[data-value="'+$(con).data('value')+'"]').prop("checked",false);
	
};

//确定选择
function svae_hyitem()
{
    var id='';
	var val='';
	var valname='';
	$('.sltnode-checkbox').each(function(){
        id+=$(this).data("id")+'-';
		val+=$(this).data("value")+'-';
		valname+=$(this).data("name")+'-';
		})
    if(val!='')
       {
        val=val.substring(0,val.lastIndexOf('-'));
        }
	if(id!='')
	   {
		id=id.substring(0,id.lastIndexOf('-'));
		}
	if(valname!='')
	   {
		valname=valname.substring(0,valname.lastIndexOf('-'));
		}
	
    $(datainput).data("value",val);
	$('#'+xmtypes).attr("value",id);
	$(datainput).attr('value',valname);
	$('.aui_state_box').remove();
}
function Close() {
	$('.aui_state_box').remove();
}





//单选输出

//function addhyitem(con){
//		var output=''
//	output+="<label id=\"sltnode-"+$(con).data("value")+"\"><input type=\"checkbox\" checked=\"checked\"  name=\"item-list\" class=\"sltnode-checkbox\" data-value=\""+$(con).data("value")+"\"  data-name=\""+$(con).data("name")+"\" onchange=\"removehyitem(this)\">"+$(con).data("name")+ "</label>";
//		}
//		$('.aui-selecteditem').append(output);
	


