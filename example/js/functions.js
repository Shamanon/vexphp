function imgLoad(imgName,imgID,interval) 
{
	tmp = new Date();
	tmp = "?"+tmp.getTime();
	document.getElementById(imgID).src = imgName+tmp;
	setTimeout("imgLoad('"+imgName+"','"+imgID+"','"+interval+"')", interval);
} 

function statsLoad(interval) 
{
	ajax('/ajax/input_read.php','inputs');
	setTimeout("statsLoad('"+interval+"')", interval);
} 

function ajax(theCall,theDiv) 
{
    
    var xhr;
    
    if (window.XMLHttpRequest) { // non-IE
        
        xhr = new XMLHttpRequest();
        
    } else if (window.ActiveXObject) { // IE
    
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    //assign a handler for the response
    xhr.onreadystatechange = function() {
    	
    	if(xhr.readyState == 4){
        	
			if(xhr.status  == 200) 
				document.getElementById(theDiv).innerHTML = xhr.responseText;
			else 
				alert('Cannot contact server: ' + theCall);
				
    	}
    }
	
    // open page
    xhr.open('GET', theCall, true);
    xhr.send(null);
}

function output(toWhat,toWhere,theValue)
{
	
	ajax('/ajax/output_'+toWhat+'.php?port='+toWhere+'&value='+theValue,'message');
	
}