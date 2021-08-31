<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.4.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#btnRight').click(function(e) {
        var selectedOpts = $('#lstBox1 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox2').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnLeft').click(function(e) {
        var selectedOpts = $('#lstBox2 option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('#lstBox1').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
});

function onClick(){
	//var data=document.getElementById("lstBox2");
	var select1 = document.getElementById('lstBox2');
	var values = new Array();

	for(var i=0; i < select1.options.length; i++){
		values.push(select1.options[i].value);
	}

	var allValues = values.join(";");
	alert(allValues);
}
</script>
<form method="post" action="Terima.php" name="frm">
<table style='width:370px;'>
    <tr>
        <td style='width:160px;'>
            <b>Group 1:</b><br/>
           <select multiple="multiple" id='lstBox1'>
              <option value="ajax">Ajax</option>
              <option value="jquery">jQuery</option>
              <option value="javascript">JavaScript</option>
              <option value="mootool">MooTools</option>
              <option value="prototype">Prototype</option>
              <option value="dojo">Dojo</option>
        </select>
    </td>
    <td style='width:50px;text-align:center;vertical-align:middle;'>
        <input type='button' id='btnRight' value ='  >  '/>
        <br/><input type='button' id='btnLeft' value ='  <  '/>
    </td>
    <td style='width:160px;'>
        <b>Group 2: </b><br/>
        <select multiple="multiple" id='lstBox2' name="lstBox2[]">
          <option value="asp">ASP.NET</option>
          <option value="c#">C#</option>
          <option value="vb">VB.NET</option>
          <option value="java">Java</option>
          <option value="php">PHP</option>
          <option value="python">Python</option>  
        </select>
    </td>
</tr>
<tr>
    <td><input type="submit" value="submit" onclick="onClick();"/></td>
</tr>
</table>
</form>