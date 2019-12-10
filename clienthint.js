/*
showHint() 函数
每当在输入域中输入一个字符，该函数就会被执行一次。

如果文本框中有内容 (str.length > 0)，该函数这样执行：

定义要发送到服务器的 URL（文件名） 
把带有输入域内容的参数 (q) 添加到这个 URL 
添加一个随机数，以防服务器使用缓存文件 
调用 GetXmlHttpObject 函数来创建 XMLHTTP 对象，
并在事件被触发时告知该对象执行名为 stateChanged 的函数 
用给定的 URL 来打开打开这个 XMLHTTP 对象 
向服务器发送 HTTP 请求 
如果输入域为空，则函数简单地清空 txtHint 占位符的内容。

*/

var xmlHttp

function check_password()
{
	if(document.getElementById('pwd').value!=document.getElementById('pwd2').value)
	{
		document.getElementById('mobilespan').innerHTML='*密码不一致<br/>';
		document.getElementById("submit_botton").disabled=true;
		document.getElementById("submit_botton").style="background: rgb(100,100,100)";
	}
	else{
		document.getElementById('mobilespan').innerHTML='<br/>';
		document.getElementById("submit_botton").disabled=false;
		document.getElementById("submit_botton").style="background: rgb(250,0,0)";
	}
	return true;
}

function check_form(type)
{
	if(document.getElementById("username").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*请先输入用户名<br/>";
		return false;
	}
	else if(document.getElementById("pwd").value.length==0)
	{
		
		document.getElementById("mobilespan").innerHTML="*请先输入用户密码<br/>";
		return false;
	}
	if(document.getElementById("mobilespan").innerHTML=="ok<br/>")
	{
		return true;
	}
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	} 
	
	var url="gethint.php";
	url=url+"?username="+document.getElementById("username").value;
	url=url+"&password="+document.getElementById("pwd").value;
	if(type=='user')
	{
		url=url+"&type=0";
	}
	else
	{
		url=url+"&type=1";
	}
	url=url+"&check=loginInfo";
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	
	return false;
}

function check_form_rg()
{
	
	if(document.getElementById("username").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*请先输入用户名<br/>";
		return false;
	}
	else if(document.getElementById("pwd").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*请先输入用户密码<br/>";
		return false;
	}
	else if(document.getElementById("mobile").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*请先输入电话号码<br/>";
		return false;
	}

	else if(document.getElementById("pwd").value!=document.getElementById("pwd2").value)
	{
		document.getElementById("mobilespan").innerHTML="*密码不一致<br/>";
		return false;
	}
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return;
	} 
	var url="gethint.php";
	url=url+"?username="+document.getElementById("username").value;
	url=url+"&mobile="+document.getElementById("mobile").value;
	url=url+"&type="+document.getElementById("usertype").value;
	url=url+"&check=existInfo";
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	return false;
}

function check_name(str,type)
{
	xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request")
			return
		} 
		var url="gethint.php";
		url=url+"?username="+str;
		url=url+"&mobile="+document.getElementById("mobile").value;
		if(type=='user')
		{
			url=url+"&type=0";
		}
		else
		{
			url=url+"&type=1";
		}
		url=url+"&check=registerInfo";
		url=url+"&sid="+Math.random()
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
}

function check_number(str,type)
{
	if(str.length>11)
	{
		document.getElementById("mobilespan").innerHTML="必须是11位<br/>";
		document.getElementById("submit_botton").disabled=true;
		document.getElementById("submit_botton").style="background: rgb(100,100,100)";
	}
	else if(str.length<11)
	{
		document.getElementById("mobilespan").innerHTML="电话号码太短<br/>";
		document.getElementById("submit_botton").disabled=true;
		document.getElementById("submit_botton").style="background: rgb(100,100,100)";
	}
	else
	{
		document.getElementById("submit_botton").disabled=false;
		document.getElementById("submit_botton").style="background: rgb(200,0,0)";
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("Browser does not support HTTP Request")
			return
		} 
		var url="gethint.php";
		url=url+"?username="+document.getElementById("username").value;
		url=url+"&mobile="+str;
		if(type=='user')
		{
			url=url+"&type=0";
		}
		else
		{
			url=url+"&type=1";
		}
		url=url+"&check=registerInfo";
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
}

/*
stateChanged() 函数
每当 XMLHTTP 对象的状态发生改变，
则执行该函数。

在状态变成 4 （或 "complete"）时，
用响应文本填充 txtHint 占位符 txtHint 的内容。
*/

/*
发送一个请求后，
客户端无法确定什么时候
会完成这个请求，
所以需要用事件机制来捕获请求的状态，
XMLHttpRequest对象提供了
onreadyStateChange事件实现这一功能。
这类似于回调函数的做法。
onreadyStateChange
事件可指定一个事件处理函数来处理
XMLHttpRequest对象的执行结果
onreadyStateChange事件是在
readyState属性发生改变时触发的，

readyState的值表示了当前请求的状态，
在事件处理程序中可以根据这个值
来进行不同的处理。
 readyState有五种可取值
 0：尚未初始化，
 1：正在加载，
 2：加载完毕，
 3：正在处理；
 4：处理完毕。
 一旦readyState属性的值变成了4，
 就可以从服务器返回的响应数据
 进行访问了。
*/

function stateChanged() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 
		
		if(xmlHttp.responseText=="ok<br/>")
		{	
			document.getElementById("form1").submit();
			return;
		}
		else if(xmlHttp.responseText=="*用户名或密码错误<br/>")
		{
			document.getElementById("mobilespan").innerHTML=xmlHttp.responseText+'<br/>'
			document.getElementById("mobilespan").innerHTML=xmlHttp.responseText+'<br/>';
			return;
		}
		else if(xmlHttp.responseText.length>5)
		{
			document.getElementById("mobilespan").innerHTML=xmlHttp.responseText+'<br/>';
			document.getElementById("submit_botton").disabled=true;
			document.getElementById("submit_botton").style="background: rgb(100,100,100)";
		}
		else{
			document.getElementById("mobilespan").innerHTML=xmlHttp.responseText+'<br/>';
			document.getElementById("submit_botton").disabled=false;
			document.getElementById("submit_botton").style="background: rgb(200,0,0)";
		}
	} 
}


/*
GetXmlHttpObject() 函数
AJAX 应用程序只能运行在完整支持 XML 的 web 浏览器中。

上面的代码调用了名为 GetXmlHttpObject() 的函数。

该函数的作用是解决为不同浏览器创建不同 XMLHTTP 对象的问题。
*/
function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}