/*
showHint() ����
ÿ����������������һ���ַ����ú����ͻᱻִ��һ�Ρ�

����ı����������� (str.length > 0)���ú�������ִ�У�

����Ҫ���͵��������� URL���ļ����� 
�Ѵ������������ݵĲ��� (q) ��ӵ���� URL 
���һ����������Է�������ʹ�û����ļ� 
���� GetXmlHttpObject ���������� XMLHTTP ����
�����¼�������ʱ��֪�ö���ִ����Ϊ stateChanged �ĺ��� 
�ø����� URL ���򿪴���� XMLHTTP ���� 
����������� HTTP ���� 
���������Ϊ�գ������򵥵���� txtHint ռλ�������ݡ�

*/

var xmlHttp

function check_password()
{
	if(document.getElementById('pwd').value!=document.getElementById('pwd2').value)
	{
		document.getElementById('mobilespan').innerHTML='*���벻һ��<br/>';
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
		document.getElementById("mobilespan").innerHTML="*���������û���<br/>";
		return false;
	}
	else if(document.getElementById("pwd").value.length==0)
	{
		
		document.getElementById("mobilespan").innerHTML="*���������û�����<br/>";
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
		document.getElementById("mobilespan").innerHTML="*���������û���<br/>";
		return false;
	}
	else if(document.getElementById("pwd").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*���������û�����<br/>";
		return false;
	}
	else if(document.getElementById("mobile").value.length==0)
	{
		document.getElementById("mobilespan").innerHTML="*��������绰����<br/>";
		return false;
	}

	else if(document.getElementById("pwd").value!=document.getElementById("pwd2").value)
	{
		document.getElementById("mobilespan").innerHTML="*���벻һ��<br/>";
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
		document.getElementById("mobilespan").innerHTML="������11λ<br/>";
		document.getElementById("submit_botton").disabled=true;
		document.getElementById("submit_botton").style="background: rgb(100,100,100)";
	}
	else if(str.length<11)
	{
		document.getElementById("mobilespan").innerHTML="�绰����̫��<br/>";
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
stateChanged() ����
ÿ�� XMLHTTP �����״̬�����ı䣬
��ִ�иú�����

��״̬��� 4 ���� "complete"��ʱ��
����Ӧ�ı���� txtHint ռλ�� txtHint �����ݡ�
*/

/*
����һ�������
�ͻ����޷�ȷ��ʲôʱ��
������������
������Ҫ���¼����������������״̬��
XMLHttpRequest�����ṩ��
onreadyStateChange�¼�ʵ����һ���ܡ�
�������ڻص�������������
onreadyStateChange
�¼���ָ��һ���¼�������������
XMLHttpRequest�����ִ�н��
onreadyStateChange�¼�����
readyState���Է����ı�ʱ�����ģ�

readyState��ֵ��ʾ�˵�ǰ�����״̬��
���¼���������п��Ը������ֵ
�����в�ͬ�Ĵ���
 readyState�����ֿ�ȡֵ
 0����δ��ʼ����
 1�����ڼ��أ�
 2��������ϣ�
 3�����ڴ���
 4��������ϡ�
 һ��readyState���Ե�ֵ�����4��
 �Ϳ��Դӷ��������ص���Ӧ����
 ���з����ˡ�
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
		else if(xmlHttp.responseText=="*�û������������<br/>")
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
GetXmlHttpObject() ����
AJAX Ӧ�ó���ֻ������������֧�� XML �� web ������С�

����Ĵ����������Ϊ GetXmlHttpObject() �ĺ�����

�ú����������ǽ��Ϊ��ͬ�����������ͬ XMLHTTP ��������⡣
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