
function imgvisual()
{
	var file=document.getElementById("uploadfile");
	var img=document.getElementById("preview");
	var imgURL=window.URL.createObjectURL(file.files[0]);
	
	img.src=imgURL;
	
	return;
}

function check_product()
{
	if(document.getElementById("productname").value.length==0)
	{
		alert("请输入商品名称");
		return false;
	}
	if(document.getElementById("productprice").value.length==0)
	{
		alert("请输入商品价格");
		return false;
	}
	if(doucument.getElementById("productstocknumber").value.length==0)
	{
		alert("请输入商品库存");
		return false;
	}
	if(document.getElementById("uploadfile").value.length==0)
	{
		alert("请上传图片");
		return false;
	}
	return true;
}