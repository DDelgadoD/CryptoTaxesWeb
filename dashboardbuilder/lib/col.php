 <?php $xmlfile = $folder.'data/data.xml'; $col=0; $left=array(); $top=array(); $cheight=array(); $cwidth=array(); $xmlDoc=simplexml_load_file($xmlfile); $connectionstatus=""; $defaultcharttitle = ucwords($xmlDoc->col[0]->type) . " Chart"; if ($xmlDoc->col[0]->title==''){ $xmlDoc->col[0]->title = $defaultcharttitle ;} $xmlfileLayout = '../data/layout.xml'; $xmlDocLayout=simplexml_load_file($xmlfileLayout); $i=0; if (isset($_POST['click'])) { if (count($xmlDocLayout->left) > 1 ) { for($i=1; $i < count($xmlDocLayout->left); $i++) { unset($xmlDocLayout->left[$i]); unset($xmlDocLayout->top[$i]); unset($xmlDocLayout->height[$i]); unset($xmlDocLayout->width[$i]); } } $i=0; if (!empty($_POST['left'])) { foreach($_POST['left'] as $value){ $xmlDocLayout->left[$i] = $value; $left[$i] = $value; $i++; } } $i=0; if (!empty($_POST['top'])) { foreach($_POST['top'] as $value){ $xmlDocLayout->top[$i] = $value; $top[$i] = $value; $i++; } } $i=0; if (!empty($_POST['height'])) { foreach($_POST['height'] as $value){ $xmlDocLayout->height[$i] = $value; $cheight[$i] = $value; $i++; } } $i=0; if (!empty($_POST['width'])) { foreach($_POST['width'] as $value){ $xmlDocLayout->width[$i] = $value; $cwidth[$i] = $value; $i++; } } $xmlDocLayout->asXML($xmlfileLayout); } else { $i=0; foreach($xmlDocLayout->left as $value){ if (!empty($value)) { $left[$i] = $value; } else { $left[$i] = 0; } if (!empty($xmlDocLayout->top[$i])) { $top[$i] = $xmlDocLayout->top[$i]; } else { $top[$i] = 0; } if (!empty($xmlDocLayout->height[$i])) { $cheight[$i] = $xmlDocLayout->height[$i]; } else { $cheight[$i] = 450; } if (!empty($xmlDocLayout->width[$i])) { $cwidth[$i] = $xmlDocLayout->width[$i]; } else { $cwidth[$i] = 12; } $i++; } } ?>
<style>
.demo {position:absolute; width:100%;left:0;}
#number {font-size:34px; font-weight:bold;text-align:center;}
#number_legand {font-size:11px; text-align:center;}
</style>
<form id="form" method="post" action="" name="form">
	<input type="hidden" id="node" name="node"  value="0"/>
	<input type="hidden" id="col" name="col" value="0"/>
	<input type="hidden" name="click" value="true"/>
	<input type="hidden" id="deletenode0" name="deletenode[]" value="0"/>
	<input type="hidden" id="left0" name="left[]" value="<?php if(empty($left[0])) {echo '0';} else {echo $left[0];}?>"/>
	<input type="hidden" id="top0" name="top[]" value="<?php if(empty($top[0])) {echo '0';} else {echo $top[0];}?>"/>
	<input type="hidden" id="height0" name="height[]" value="<?php if(empty($heigth[0])) {echo '250';} else {echo $cheight[0];}?>"/>
	<input type="hidden" id="width0" name="width[]" value="<?php if(empty($cwidth[0])) {echo '12';} else {echo $cwidth[0];}?>"/>
</form>	

<div class="col-md-1 col-xs-1 col-lg-1" id="col-size"></div>
<!-- <div class="col-lg-12 col-md-12 col-xs-12" style="margin:0;padding:0; ">
<div id="append-panel" class="field_wrapper_col">
</div>
</div> --> 
<div class="col-lg-12 col-md-12 col-xs-12" style="margin:0;padding:0; ">
<div id="append-panel" class="field_wrapper_col">

<div class="col-md-offset-0" id="adjustposition"  >
<div  id="adjustwidth0">
<div class="col-lg-12 col-md-12 col-xs-12" id="widthid-0" >
<div class="panel panel-default demo" id="div0" >
	<div class="panel-heading" style="height:30px; cursor: move;">
	&nbsp;
	
	
	<div style="float:left; margin-top:-5px;">
	<button type="submit" class="close" onClick="submitform(0);" ><div class="fa fa-gear"></div></button>
	</div>
	<div style="margin-top:-25px;">&nbsp;&nbsp;<?php echo $xmlDoc->col[0]->title;?></div>
	
	 <?php $connectionstatus='<sub><div class="fa fa-close" style="color:#FF0000;" ></div></sub><div class="fa fa-database"></div>'; if ($xmlDoc->col[0]->dbconnected== '1'){ $connectionstatus='<sub><div class="fa fa-check" style="color:#009933;" ></div></sub><div class="fa fa-database"></div>'; } if ($xmlDoc->col[0]->source== 'upload'){ if (file_exists($xmlDoc->col[$col]->file)) { $connectionstatus='<div class="fa fa-file-excel-o" style="color:#669933;"></div>'; } if (substr($xmlDoc->col[$col]->file,0,6)=="https:" ) { $connectionstatus='<div class="fa fa-cloud-download" style="color:#669933;"></div>'; } if (!empty($xmlDoc->col[0]->json)) { $connectionstatus='<div class="fa fa-file-code-o" style="color:#669933;"></div>'; } } ?>
	  
	<button type="submit" class="close" onClick="submitDB(0);"  style="margin-top:-20px;"><span style="font-size:16px; "><?php echo $connectionstatus;?></span></button>
	</div>
	<div class="panel-body result" style="margin-right:5px;" >
		 <?php if ($xmlDoc->col[0]->type=='number') { if (!empty($xmlDoc->col[0]->color[0])) { echo '<style>.number0 {color: white;} 
					           #div0 {background:'.$xmlDoc->col[0]->color[0].';
						</style>'; } } if ($xmlDoc->col[0]->xaxis[0]) { echo $result[0]; } if (!empty($xmlDoc->col[0]->dbconnected) && ($xmlDoc->col[0]->source=="ADatabase")) { if ($xmlDoc->col[0]->dbconnected !=1) { ?>
							<div class="alert alert-danger alert-dismissable">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Error! Connection </strong> <?php echo $xmlDoc->col[0]->dbconnected;?>
										<br/>
										<div>For more details take a look at the <a href="https://dashboardbuilder.net/documentation" target="_blank">User Guide</a></div>
									  </div>
						 <?php } } ?>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="dbModal-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog <?php if(isset($_POST['node'])) { if ($_POST['node']=='g') { echo 'modal-lg';}}?>">
			<div class="modal-content">
		 <?php if (isset($_POST['node'])){ if ($_POST['node'] == "2") { include ('dbsetting2.php'); } if ($_POST['node'] == "3") { include ('save.php'); } if ($_POST['node'] == "n") { include ('new.php'); } if ($_POST['node'] == "o") { include ('open.php'); } if ($_POST['node'] == "g") { include ('codegenerate.php'); } if ($_POST['node'] == "s") { include ('createlink.php'); } }?>
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div> <!-- /.modal -->
	
	<!-- Modal -->
	<div class="modal fade in" id="settingModal-0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<!-- <div class="modal-content" style="min-height:98vh;"> -->
			<div class="modal-content" > 
		 <?php if (isset($_POST['node'])){ if ($_POST['node'] == "0") { include ('layoutsetting.php'); } } ?>			
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div> <!-- /.modal -->

</div></div>
</div>
</div>


</div>
</div> 
 <?php if (isset($_POST['click'])) { $_POST["click"]= array(); if ($_POST['node']=="0") { ?>
<script>

	$('#settingModal-0').modal('show');
</script> <?php } if (!empty($_POST['deletenode'])) { foreach($_POST['deletenode'] as $value){ $value = (int) $value; if ($value > 0) { ?> <script>document.getElementById('deletenode<?php echo $value;?>').value=0;</script><?php unset($xmlDoc->col[$value]); unset($result[$value]); $result = array_values($result); } } $xmlDoc->asXML($xmlfile); $xmlDoc=simplexml_load_file($xmlfile); } if (($_POST['node']=="2") || ($_POST['node']=="n") || ($_POST['node']=='o') || ($_POST['node']=='g') || ($_POST['node']=='s')) { ?>
<script>
	$('#dbModal-0').modal('show');
	document.getElementById("node").value = "0";
</script> <?php } if ($_POST['node']=="3") { if (!empty($_SESSION['filename'])) { $folder ="..".DIRECTORY_SEPARATOR; $file = $folder.'data'.DIRECTORY_SEPARATOR.'data.xml'; $newfile = $folder.'store'.DIRECTORY_SEPARATOR.$_SESSION['filename'].'.data'; if (!copy($file, $newfile)) { ?><script>alert ('Fail to copy');</script><?php } $file = $folder.'data'.DIRECTORY_SEPARATOR.'layout.xml'; $newfile = $folder.'store'.DIRECTORY_SEPARATOR.$_SESSION['filename'].'.lay'; if (!copy($file, $newfile)) { ?><script>alert ('Fail to copy');</script><?php }?>
			<script>document.getElementById("node").value = "0";
			window.location.href = window.location.href;
			</script>
		 <?php } else { ?>
	<script>
		$('#dbModal-0').modal('show');
	</script> <?php } } } if ((isset($_POST['runquery'])=='true') || (isset($_POST['save'])=='true')) { ?>
<script>
<!-- second modal -->
     $('#settingModal-0').modal('show');
</script> <?php } if (isset($_POST['node']) && ($_POST['node']=="0")) { ?>
<SCRIPT>
$('#layoutsettingchart').resizable({

	resize: function(event,ui){},
   
   stop : function(event,ui) {
        endW = $(this).outerWidth();
        endH = $(this).outerHeight();	
		var col_size = document.getElementById("wraplayoutsettingchart").clientWidth;	
	
			if (endW > col_size) { 
				endW = col_size;
				document.getElementById("layoutsettingchart").style.width = "100%";
			} 
			
				DashboardBuilder.relayout('collayoutsettings', {
					  height:endH-50,
					  width: endW - 55
				});
			
			
	}
});
</SCRIPT>
 <?php } else { ?>
<SCRIPT>

$(function(){
	$('.demo')
		.draggable()
		.resizable();
			
		//$('.TableQueryPanel')
		//.resizable();
});


$('#div0').resizable({
   //options...
   resize: function(event,ui){
	    endW = $(this).outerWidth();
        endH = $(this).outerHeight();
	  document.getElementById('resize').innerHTML="<?php echo _TEXT['SIZE'];?> "+endW+', '+endH;
	  document.getElementById('panelno').innerHTML="<?php echo _TEXT['PANEL'];?> 1";
   },
   
   stop : function(event,ui) {
        endW = $(this).outerWidth();
        endH = $(this).outerHeight();
		
			/* Adjust the size to col */
			document.getElementById('height0').value = endH;
			adjustwidth(endW, 0);
			 
			 
			DashboardBuilder.relayout('col0', {
				  height:endH-70
            });

	}
});


$('#div0').draggable({
   // options...
   drag: function(event,ui){
      dragposition = ui.position;
	  if (dragposition.left < 0 ) {
		 dragposition.left=0;
	  }
	  if (dragposition.top < 0 ) {
		 dragposition.top=0;
	  }  
	  document.getElementById('reposition').innerHTML="<?php echo _TEXT['POSITION'];?> "+Math.round(dragposition.left)+', '+Math.round(dragposition.top);
	  document.getElementById('panelno').innerHTML="<?php echo _TEXT['PANEL'];?> 1";
   },
   
   stop : function(event,ui) {
  	 dragposition = ui.position;
   	 adjustposition(dragposition.left, 0);
	 document.getElementById('top0').value = Math.round(dragposition.top);
   }
   

});

</SCRIPT> <?php } ?>
<SCRIPT>
$(document).ready(function(){
	
	    $("#takeatour").click(function(){

        $("#myModal").modal({

            backdrop: 'static',

            keyboard: false

        });

    });

var addButtoncol = $('.addpanel'); 
var col=0; 
var position_left = [];
var position_top = [];
var endWs = [];
var endHs = [];
var results = [];
var titles = [];
var connectionstatus = [];
 <?php $key=0; foreach($result as $value){ if ($key > 0 ) { $str = $value; $tmp = '<div id="col'.$key.'" ><!-- chart will be drawn inside this DIV --></div>'; $find = array($tmp,'<script>','</script>'); $str = str_replace($find,"",$str); $defaultcharttitle = ucwords($xmlDoc->col[$key]->type) . " Chart"; if ($xmlDoc->col[$key]->title==''){ $xmlDoc->col[$key]->title = $defaultcharttitle ;} ?>
				
				connectionstatus[<?php echo $key;?>]='<div class="fa fa-close" style="color:#FF0000;" ></div><div class="fa fa-database"></div>';
			 <?php if ($xmlDoc->col[$key]->dbconnected== '1'){ ?>
					connectionstatus[<?php echo $key;?>]='<sub><div class="fa fa-check" style="color:#009933;" ></div></sub><div class="fa fa-database"></div>';
				 <?php } if ($xmlDoc->col[$key]->source== 'upload'){ if (file_exists($xmlDoc->col[$key]->file)) { ?>
							connectionstatus[<?php echo $key;?>]='<sub><div class="fa fa-check" style="color:#000;" ></div></sub><div class="fa fa-file-excel-o" style="color:#669933;"></div>';
					 <?php } if (substr($xmlDoc->col[$key]->file,0,6)=="https:" ) { ?>
							connectionstatus[<?php echo $key;?>]='<sub><div class="fa fa-check" style="color:#000;" ></div></sub><div class="fa fa-cloud-download" style="color:#669933;"></div>';
					 <?php } if (!empty($xmlDoc->col[$key]->json)) { ?>
							connectionstatus[<?php echo $key;?>]='<sub><div class="fa fa-check" style="color:#000;" ></div></sub><div class="fa fa-file-code-o" style="color:#669933;"></div>';
					 <?php } } if ($xmlDoc->col[$key]->type=='number') { $str = 'document.getElementById("col'.$key.'").innerHTML="'.$str.'";'; if (!empty($xmlDoc->col[$key]->color[0])) { $str .= 'document.getElementById("div'.$key.'").setAttribute("style","color: white; background: '.$xmlDoc->col[$key]->color[0].';")'; } } ?>
				
				
				
			 <?php if (!empty($xmlDoc->col[$key]->dbconnected) && ($xmlDoc->col[$key]->source=="ADatabase")) { if ($xmlDoc->col[$key]->dbconnected !=1) { $string = trim(preg_replace('/\s\s+/', ' ', $xmlDoc->col[$key]->dbconnected )); $tmp ="<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error! Connection </strong>"; $tmp = $tmp.$string; $tmp = $tmp."<br/><div>For more details take a look at the <a href='https://dashboardbuilder.net/documentation' target='_blank'>User Guide</a></div></div>"; $str = 'document.getElementById("col'.$key.'").innerHTML="'.$tmp.'";'; } } ?>
				titles [<?php echo $key;?>] = '<?php echo $xmlDoc->col[$key]->title ;?>';
	
				results[<?php echo $key;?>] = `
			 <?php echo $str;?>
				`;

			 <?php } $key++; } ?>

$(addButtoncol).click(function(){
	var fieldHTML ="";
	col++;
	if (!(connectionstatus[col])) {
	  connectionstatus[col]='<div class="fa fa-close" style="color:#FF0000;" ></div><div class="fa fa-database"></div>';
	}

	fieldHTML += '<div id="adjustwidth'+col+'">';
	fieldHTML += '<div id="widthid-'+col+'" class="col-md-12 col-xs-12 col-lg-12" style="position:absolute;">';
	fieldHTML += '<div class="panel panel-default demo" id="div'+col+'" data-value="'+col+'" >';
	fieldHTML += '<div class="panel-heading" style="height:30px; cursor: move;">';
	
	fieldHTML += '<div style="float:left; margin-top:-5px;">';
	fieldHTML += '<button type="submit" class="close" onClick="submitform('+col+');"><div class="fa fa-gear"></div></button>';
	fieldHTML += '</div>';
	
	fieldHTML += '<div style="margin-top:-7px;">&nbsp;&nbsp;'+titles[col]+'</div>';
	
	
	fieldHTML += '<div style="float:right;width:50px;"><button type="submit" class="close" onClick="submitDB('+col+');"  style="margin-top:-15px;float:left;"><span style="font-size:16px; ">'+connectionstatus[col]+'</span></button>';
	fieldHTML += '&nbsp;&nbsp;<a href="javascript:void(0);" class="removebutton" data-value="'+col+'" aria-label="Close"  title="Remove Panel" style="color:#000000;  margin-top:-38px;float:right;font-size:20px;"> <span class="fa fa-times-circle"></span></a></div>';
	fieldHTML += '</div>';
	
	fieldHTML += '<div class="panel-body result">';
	fieldHTML += '<div id="col'+col+'" ><!-- chart will be drawn inside this DIV --></div>';

	fieldHTML += '</div>';
	fieldHTML += '</div>';
	fieldHTML += '</div>';
	fieldHTML += '</div>';

	$('#append-panel').append(fieldHTML);
	$('#form').append('<input type="hidden" id="left'+col+'" name="left[]" value="0" /><input type="hidden" id="top'+col+'" name="top[]" value="0" /><input type="hidden" id="height'+col+'" name="height[]" value="250" /><input type="hidden" id="width'+col+'" name="width[]" value="12" />');
	
	var d = document, s = d.createElement('script');
	
	 var t = document.createTextNode(results[col]);
     s.appendChild(t);
	 d.body.appendChild(s);
	 

	 $('.field_wrapper_col').on('click', '.removebutton', function(e){ 
				e.preventDefault();	
				x = $(this).data('value');
				var divremove = 'div'+x;
				var divleft = 'left'+x;
				var divtop = 'top'+x;
				var divheight = 'height'+x;
				var divwidth = 'width'+x;
				
				document.getElementById(divremove).remove();
				document.getElementById(divleft).remove();
				document.getElementById(divtop).remove();
				document.getElementById(divheight).remove();
				document.getElementById(divwidth).remove();
				$('#form').append('<input type="hidden" id="deletenode'+x+'" name="deletenode[]" value="'+x+'"/>');
				if (x== col) {
					col=col-1;	
				}
				
				
			});

	 
	$('#div'+col).draggable({
   // options...
   	 drag: function(event,ui){
		  dragposition = ui.position;
		  if (dragposition.left < 0 ) {
			  dragposition.left=0;
		  }	
		  if (dragposition.top < 0 ) {
			  dragposition.top=0;
		  }
		  var c = $(this).data('value');
		  position_left[c] = dragposition.left;
		  position_top[c] = dragposition.top;
		  document.getElementById('reposition').innerHTML="<?php echo _TEXT['POSITION'];?> "+Math.round(position_left[c])+', '+Math.round(position_top[c]);
		  var x = $(this).data('value');
		  document.getElementById('panelno').innerHTML="<?php echo _TEXT['PANEL'];?> "+parseInt( x+1);
      },
	  
	  stop : function(event,ui) {
	    var c = $(this).data('value');
  	 	dragposition = ui.position;
   	 	adjustposition(dragposition.left, c);
		document.getElementById('top'+c).value = Math.round(dragposition.top);
   		}
   
	})
	
	$('#div'+col).resizable({
   //options...
	   resize: function(event,ui){
	  	 var x = $(this).data('value');
			endWs[x] = $(this).outerWidth();
			endHs[x] = $(this).outerHeight();
		  document.getElementById('resize').innerHTML="<?php echo _TEXT['SIZE'];?> "+endWs[x]+', '+endHs[x];
		  
		  document.getElementById('panelno').innerHTML="<?php echo _TEXT['PANEL'];?> "+parseInt( x+1);
	   },
	   
	   stop : function(event,ui) {
	    var x = $(this).data('value');
			endW = $(this).outerWidth();
			endH = $(this).outerHeight();
			/* Adjust the size to col */
			document.getElementById('height'+x).value = endH;
			adjustwidth(endW, x); 

				DashboardBuilder.relayout('col'+x, {
					  height:endHs[x]-70
				});
	 
		}
	})

});

var col_size = document.getElementById("col-size").clientWidth;
 <?php $i=0; foreach($left as $value){ if ($i > 0 ) { ?>
		var l = document.getElementById('addpanelid');
		l.click(); <?php } $x = 'col-md-'.$cwidth[$i].' col-xs-'.$cwidth[$i].' col-lg-'.$cwidth[$i]; ?>
		   document.getElementById("widthid-<?php echo $i;?>").className = '<?php echo $x;?>'; 
		   var wleft = Math.round(col_size * <?php echo $left[$i];?>);
		   document.getElementById('div<?php echo $i;?>').style.left = wleft+'px';	
		   document.getElementById('div<?php echo $i;?>').style.top = '<?php echo $top[$i];?>px';	
		   document.getElementById('div<?php echo $i;?>').style.height = '<?php echo $cheight[$i];?>px';	
		   
		   
		   
		   document.getElementById('left<?php echo $i;?>').value = '<?php echo $left[$i];?>';	
		   		   
		   
		   document.getElementById('top<?php echo $i;?>').value = '<?php echo $top[$i];?>';	
		   document.getElementById('height<?php echo $i;?>').value = '<?php echo $cheight[$i];?>';
		   document.getElementById('width<?php echo $i;?>').value = '<?php echo $cwidth[$i];?>';	
		   
		   

	 <?php if ((isset($xml->col[$i]->type)) && (!empty($result[$i])) ) { if (!(($xml->col[$i]->type=='map') || ($xml->col[$i]->type=='number'))) {?>
		  if (document.getElementById('col<?php echo $i;?>') != null) {
		   DashboardBuilder.relayout('col<?php echo $i;?>', {
				width: (col_size*<?php echo $cwidth[$i];?>)-40,
				height:<?php echo $cheight[$i];?>-65,
				});	
		  }	
			
	 <?php } } $i++; } ?>
	
	
});

	 
function adjustwidth(endW, col) {
	var col_size = document.getElementById("col-size").clientWidth;

	if (endW < col_size ) {
		document.getElementById("widthid-"+col).className = "col-md-1 col-xs-1 col-lg-1";
		document.getElementById("div"+col).style.width = "100%";
		document.getElementById('width'+col).value = 1;
		DashboardBuilder.relayout('col'+col, {
		  width: col_size-40,
			});
		return;
	}
	
	
	if (endW > (col_size*12) ) {
		document.getElementById("widthid-"+col).className = "col-md-12 col-xs-12 col-lg-12";
		document.getElementById("div"+col).style.width = "100%";
		document.getElementById('width'+col).value = 12;
		DashboardBuilder.relayout('col'+col, {
		  width: (col_size*12)-40,
			});
		return;
	}
	
	for (i = 2; i < 13; i++) {
	    Wstart = (col_size * i) - col_size ;
		Wend = col_size * i;
		
		if ( (endW > Wstart) && (endW < Wend) ) {
		    x = 'col-md-'+i+' col-xs-'+i+' col-lg-'+i;
			document.getElementById("widthid-"+col).className = x; 
			document.getElementById("div"+col).style.width = "100%";
			document.getElementById('width'+col).value = i;
			DashboardBuilder.relayout('col'+col, {
			  width: (col_size*i)-40,
				});
			continue;
		}
	}
}


function adjustposition(l, col) {

var col_size = document.getElementById("col-size").clientWidth;
wtop = document.getElementById("div"+col).style.top;
wtop = wtop.substring(0, wtop.length - 2); // remove px

if (l>12) {l==12};

if (l==0) {
	wcol=0;}
else {
	wcol = Math.round(l / col_size);
}

	if (wcol < 1 ) {
		document.getElementById("div"+col).style.left = "0px";
		document.getElementById('reposition').innerHTML="<?php echo _TEXT['POSITION'];?> "+Math.round(0)+', '+wtop;
		document.getElementById("left"+col).value = "0";
		return;
	}
	
	if (wcol > 12 ) {
		document.getElementById("div"+col).style.left = Math.round(col_size*11)+"px";
		document.getElementById('reposition').innerHTML="<?php echo _TEXT['POSITION'];?> "+Math.round(col_size*11)+', '+wtop;
		document.getElementById("left"+col).value = "11";
		return;
	}

	
	    Wstart = col_size * wcol ;
					
		document.getElementById("div"+col).style.left = Math.round(Wstart)+"px";
		document.getElementById('reposition').innerHTML="<?php echo _TEXT['POSITION'];?> "+Math.round(Wstart)+', '+wtop;
		document.getElementById("left"+col).value = wcol;
		return;

}


<!-- Socal Nework Submission -->
function submitform(col) {
		document.getElementById("col").value = col;
		document.getElementById("node").value = "0";
		$( "#form" )[0].submit();
}

<!-- DB Submission -->
function submitDB(col) {
		document.getElementById("col").value = col;
		document.getElementById("node").value = "2";
		$( "#form" )[0].submit();
}

function submitAll(s) {
		document.getElementById("col").value = 0;
		if (s=='g') {
			document.getElementById("col").value = document.getElementById("col-size").clientWidth;
		}
		document.getElementById("node").value = s;
		$( "#form" )[0].submit();
}

function preview() {
 <?php if(!isset($_SESSION['filename'])) {?>
	 $("#filenotsave").modal();
 <?php } else { $sharelink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; $sharelink = preg_replace('|/lib|', '',$sharelink); $link = $sharelink.'?share='.$_SESSION['filename']; ?>
 
		$("#details").load("<?php echo $link;?>");
		
		document.getElementById("close_preview").style.display = "inline-block"; 
		document.getElementById("export_image").style.display = "inline-block"; 
		document.getElementById("print").style.display = "inline-block"; 
		
		document.getElementById("preview").style.display = "none"; 
		document.getElementById("addpanelid").style.display = "none";
		document.getElementById("file-generate").style.display = "none";
		document.getElementById("file-open").style.display = "none";
		document.getElementById("file-new").style.display = "none";
		document.getElementById("file-save").style.display = "none";
		document.getElementById("file-share").style.display = "none";
		
		$.getScript("../assets/js/html2canvas.min.js");	
		
 <?php } ?>
}

function close_preview() {
window.location.href = window.location.href;
}

function export_image() {
	var s = $(document).height();
	$("#details").height(s);
	
	html2canvas(document.getElementById('details')).then(function(canvas) {
		var link = document.createElement('a');
			link.href = canvas.toDataURL("image/png");
			link.download = '<?php if (isset($_SESSION['filename'])) { echo $_SESSION['filename']; } else { echo 'Download'; };?>.png'; 
			link.click();
	   });
}

function print() {
	var s = $(document).height();
	$("#details").height(s);

	html2canvas(document.getElementById('details')).then(function(canvas) {
		 //document.body.appendChild(canvas);
		 
			var printWindow = window.open('', '', 'height=600,width=auto;');
			
			printWindow.document.head.innerHTML ='<title>Print Dashboard</title>';
			printWindow.document.head.innerHTML ='<style type="text/css" media="print">';
			printWindow.document.head.innerHTML ='@page ';
			printWindow.document.head.innerHTML ='{size: auto; margin: 0mm;} ';
			printWindow.document.head.innerHTML ='</style>';
			printWindow.document.body.innerHTML ='<body>';

			var img = canvas.toDataURL("image/png");
			var x = document.createElement("IMG");
			x.setAttribute("src", img);
			x.setAttribute("width", "100%");
		    printWindow.document.body.appendChild(x);
  	
    
	setTimeout(function(){
		printWindow.document.close();
		printWindow.focus();
		printWindow.print();
		printWindow.close();}, 500);
	   });
	   
}

</SCRIPT>

	<div class="modal fade" id="filenotsave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog <?php if(isset($_POST['node'])) { if ($_POST['node']=='g') { echo 'modal-lg';}}?>">
			<div class="modal-content">
			
			<div class="modal-header">
			<div class="col-sm-12">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="javascript:window.location.href = window.location.href;">&times;</button>
			<h4 class="modal-title"><?php echo _TEXT['PREVIEW'];?></h4>
			</div>
			<hr>
			<br/>
			<div class="alert alert-danger alert-dismissable">
				<p><?php echo _TEXT['NO_FILE_NAME'];?></p>
			</div>
				<br/><br/>
				<div style="text-align:right;">
					<button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo _TEXT['CANCEL'];?></button>
				</div>
	</div>
	</div>
	</div>
	</div>
	
	