<?php

/* - - - - - - - - - - - - - - - - - - - - - - - - - - -

 Title : HTML Output for Php Quick Profiler
 Author : Created by Ryan Campbell
 URL : https://github.com/particletree ( http://www.particletree.com no longer works  )

 Last Updated : August 19, 2012 by Peter Schmalfeldt <manifestinteractive@gmail.com>

 Description : This is a horribly ugly function used to output
 the PQP HTML. This is great because it will just work in your project,
 but it is hard to maintain and read. See the README file for how to use
 the Smarty file we provided with PQP.

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

function displayPqp($output) {

	$css = preg_replace('/[\n\r]/', '', <<<CSS
.pQp {width:100%;z-index:9999;text-align:center;position:fixed;bottom:0;}
* html .pQp {position:absolute;}
.pQp * {margin:0 ;padding:0;border:none;background:transparent;}
#pQp {margin:0 auto;width:85%;min-width:960px;background-color:#222;border:12px solid #000;border-bottom:none;font-family:"Lucida Grande",Tahoma,Arial,sans-serif;-webkit-border-top-left-radius:15px;-webkit-border-top-right-radius:15px;-moz-border-radius-topleft:15px;-moz-border-radius-topright:15px;border-top-left-radius:15px;border-top-right-radius:15px;}
#pQp tbody {background:transparent;}
#pQp .pqp-box h3 {font-weight:normal;line-height:200px;padding:0 15px;color:#fff;}
.pQp,.pQp td {color:#444}
#pqp-metrics {background:#000;width:100%}
#pqp-console,#pqp-speed,#pqp-queries,#pqp-memory,#pqp-files,#pqp-config,#pqp-session,#pqp-get,#pqp-post {background-color:#000;border-top:1px solid #ccc;height:200px;overflow:auto}
.pQp .pqp-green {color:#588e13!important}
.pQp .pqp-blue {color:#3769a0!important}
.pQp .pqp-purple {color:#953fa1!important}
.pQp .pqp-orange {color:#d28c00!important}
.pQp .pqp-red {color:#b72f09!important}
.pQp .pqp-yellow {color:#CDCF3A!important}
.pQp .pqp-cyan {color:#3EC4D3!important}
.pQp .pqp-pink {color:#FF7CAD!important}
.pQp .pqp-flesh {color:#FFA46E!important}
.pQp strong {color:#fff}
#pQp,#pqp-console,#pqp-speed,#pqp-queries,#pqp-memory,#pqp-files,#pqp-config,#pqp-session,#pqp-get,#pqp-post {display:none}
.pQp .pqp-console,.pQp .pqp-speed,.pQp .pqp-queries,.pQp .pqp-memory,.pQp .pqp-files,.pQp .pqp-config,.pQp .pqp-session,.pQp .pqp-get,.pQp .pqp-post {display:block!important}
.pQp .pqp-console #pqp-console,.pQp .pqp-speed #pqp-speed,.pQp .pqp-queries #pqp-queries,.pQp .pqp-memory #pqp-memory,.pQp .pqp-files #pqp-files,.pQp .pqp-config #pqp-config,.pQp .pqp-session #pqp-session,.pQp .pqp-get #pqp-get,.pQp .pqp-post #pqp-post {display:block}
.pqp-console td.pqp-green,.pqp-speed td.pqp-blue,.pqp-queries td.pqp-purple,.pqp-memory td.pqp-orange,.pqp-files td.pqp-red,.pqp-config td.pqp-yellow,.pqp-session td.pqp-cyan,.pqp-get td.pqp-pink,.pqp-post td.pqp-flesh {background:#222!important;border-bottom:6px solid #fff!important;cursor:default!important}
.pqp-tallDetails #pQp .pqp-box {height:500px}
.pqp-tallDetails #pQp .pqp-box h3 {line-height:500px}
.pqp-hideDetails #pQp .pqp-box {display:none!important}
.pqp-hideDetails #pqp-footer {border-top:1px dotted #444}
.pqp-hideDetails #pQp #pqp-metrics td {height:50px;background:#000!important;border-bottom:none!important;cursor:default!important}
#pQp var {font-size:18px;margin:0 0 2px 0}
#pQp h4 {font-size:10px}
.pqp-hideDetails .heightToggle {visibility:hidden}
#pqp-metrics td {height:80px;width:11%;text-align:center;cursor:pointer;border:4px solid #000;border-bottom:6px solid #444;-webkit-border-top-left-radius:15px;-moz-border-radius-topleft:15px;-webkit-border-top-right-radius:15px;-moz-border-radius-topright:15px;border-top-left-radius:15px;border-top-right-radius:15px;background-color:#222;}
#pqp-metrics td:hover {background:#222;border-bottom:6px solid #777}
#pqp-metrics .pqp-green {border-left:none}
#pqp-metrics .pqp-red {border-right:none}
#pqp-metrics h4 {text-shadow:#000 1px 1px 1px}
.pqp-side var {text-shadow:#444 1px 1px 1px;background-color:transparent;}
.pQp var {font-size:23px;font-weight:bold;font-style:normal;margin:0 0 3px 0;display:block; margin-top: 16px !important;}
.pQp h4 {font-size:12px;color:#fff;margin:0 0 4px 0}
.pQp .pqp-main {width:80%; float: left;}
.pQp .pqp-main table {width:100%;}
*+html .pQp .pqp-main {width:78%}
* html .pQp .pqp-main {width:77%}
.pQp .pqp-main td {padding:7px 15px;text-align:left;border-left:1px solid #333;border-right:1px solid #333;border-bottom:1px dotted #323232;color:#FFF;}
.pQp .pqp-main td,.pQp .pqp-main pre {font-family:Monaco,"Consolas","Lucida Console","Courier New",monospace;font-size:11px; background: #222;}
.pQp .pqp-main td.pqp-alt {background:#111}
.pQp .pqp-main tr.pqp-alt td {background:#2e2e2e;border-top:1px dotted #4e4e4e}
.pQp .pqp-main tr.pqp-alt td.pqp-alt {background:#333}
.pQp .pqp-main td b {float:right;font-weight:normal;color:#e6f387}
.pQp .pqp-main td:hover {background:#2e2e2e}
.pQp .pqp-side {float:left;width:20%;background:#000;color:#fff;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px;text-align:center}
.pQp .pqp-side tr {background-color: #000;}
.pQp .pqp-side td {padding:10px 0 5px 0;background-color: #000; text-align: center !important}
.pQp .pqp-side var {color:#fff;font-size:15px}
.pQp .pqp-side h4 {font-weight:normal;color:#f4fcca;font-size:11px;background-color:transparent;}
#pqp-console .pqp-side td {padding:12px 0; text-align: center !important}
#pqp-console .pqp-side td.pqp-alt1 {background:#588e13;width:51%}
#pqp-console .pqp-side td.pqp-alt2 {background-color:#b72f09}
#pqp-console .pqp-side td.pqp-alt3 {background:#d28c00;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-console .pqp-side td.pqp-alt4 {background-color:#3769a0;border-bottom:1px solid #274b74}
#pqp-console .pqp-main table {width:100%}
#pqp-console td div {width:100%;overflow:hidden;background-color:transparent;}
#pqp-console td.pqp-type {font-family:"Lucida Grande",Tahoma,Arial,sans-serif;text-align:center;text-transform:uppercase;font-size:9px;padding-top:9px;color:#f4fcca;vertical-align:top;width:40px}
.pQp .pqp-log-log td.pqp-type {background:#47740d!important}
.pQp .pqp-log-error td.pqp-type {background:#9b2700!important}
.pQp .pqp-log-memory td.pqp-type {background:#d28c00!important}
.pQp .pqp-log-speed td.pqp-type {background:#2b5481!important}
.pQp .pqp-log-log prepqp-{color:#999;background-color:transparent;}
.pQp .pqp-log-log td:hover pre {color:#fff}
.pQp .pqp-log-log em,.pqp-log-memory em,.pQp .pqp-log-speed em {float:left;font-style:normal;display:block;color:#fff;background-color:transparent;}
.pQp .pqp-log-memory pre,.pQp .pqp-log-speed pre {float:right;white-space:normal;display:block;color:#fffd70;background-color:transparent;}
#pqp-speed .pqp-side td {padding:12px 0;border-left:1px solid #1e3c5c;border-bottom:1px solid #1e3c5c;border-right:1px solid #1e3c5c;}
#pqp-speed .pqp-side td.pqp-alt {background-color:#2b5481;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-queries .pqp-side td {border-bottom:1px solid #662a6e;border-left:1px solid #662a6e;border-right:1px solid #662a6e}
#pqp-queries .pqp-side td.pqp-alt {background-color:#7b3384;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-queries .pqp-main b {float:none;background-color:transparent;}
#pqp-queries .pqp-main em {display:block;padding:2px 0 0 0;font-style:normal;color:#aaa;background-color:transparent;}
#pqp-memory .pqp-side td {padding:12px 0;background-color:#c48200;border-bottom:1px solid #865900;border-left:1px solid #865900;border-right:1px solid #865900}
#pqp-memory .pqp-side td.pqp-alt {background-color:#ac7200;border-bottom:bone;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-files .pqp-side td {border-bottom:1px solid #7c1f00;border-left:1px solid #7c1f00;border-right:1px solid #7c1f00}
#pqp-files .pqp-side td.pqp-alt {background-color:#9b2700;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-config .pqp-side td {border-bottom:1px solid #CDCF3A;border-left:1px solid #CDCF3A;border-right:1px solid #CDCF3A}
#pqp-config .pqp-side td.pqp-alt {background-color:#CDCF3A;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-session .pqp-side td {border-bottom:1px solid #3EC4D3;border-left:1px solid #3EC4D3;border-right:1px solid #3EC4D3}
#pqp-session .pqp-side td.pqp-alt {background-color:#3EC4D3;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-get .pqp-side td {border-bottom:1px solid #FF7CAD;border-left:1px solid #FF7CAD;border-right:1px solid #FF7CAD}
#pqp-get .pqp-side td.pqp-alt {background-color:#FF7CAD;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-post .pqp-side td {border-bottom:1px solid #FFA46E;border-left:1px solid #FFA46E;border-right:1px solid #FFA46E}
#pqp-post .pqp-side td.pqp-alt {background-color:#FFA46E;border-bottom:none;border-left:none;-webkit-border-bottom-left-radius:30px;-moz-border-radius-bottomleft:30px;border-bottom-left-radius:30px}
#pqp-footer {width:100%;background:#000;font-size:11px;border-top:1px solid #ccc}
#pqp-footer td {padding:0!important;border:none!important}
#pqp-footer strong {color:#fff}
#pqp-footer a {color:#999;padding:5px 10px;text-decoration:none}
#pqp-footer .pqp-credit {width:20%;text-align:left}
#pqp-footer .pqp-credit a {line-height: 30px}
#pqp-footer .pqp-actions {width:80%;text-align:right}
#pqp-footer .pqp-actions a {float:right;width:auto}
#pqp-footer a:hover,#pqp-footer a:hover strong,#pqp-footer a:hover b {background:#fff;color:black!important;text-decoration:none}
#pqp-footer a:active,#pqp-footer a:active strong,#pqp-footer a:active b {background:#ecf488;color:green!important}
#openProfiler { position: fixed; bottom: 0; right: 20px; z-index:999999; }
#openProfiler a { height:32px;text-align:center;width:100px;background-color:#222;border:2px solid #000;border-bottom:none;font-size:12px;font-family:"Lucida Grande",Tahoma,Arial,sans-serif;-webkit-border-top-left-radius:4px;-webkit-border-top-right-radius:4px;-moz-border-radius-topleft:4px;-moz-border-radius-topright:4px;;border-top-right-radius:4px;color:#999;line-height: 32px;display:block;}
#openProfiler a:hover {color:white;text-decoration:none}
#pqp-container {display:none;position:inherit;}
CSS
);

	$return_output = '';
	$return_output .=<<<JAVASCRIPT
<!-- JavaScript -->
<script type="text/javascript">
	var PQP_SHOWONLOAD = (typeof PQP_SHOWONLOAD != "undefined" && PQP_SHOWONLOAD) ? "open" : "closed";
	var PQP_HEIGHT = (typeof PQP_HEIGHT != "undefined" && PQP_HEIGHT == "tall") ? "short" : "tall";
	var PQP_DETAILS = (typeof PQP_DETAILS != "undefined" && PQP_DETAILS) ? true : false;
	var PQP_BOTTOM = (typeof PQP_BOTTOM == "undefined" || PQP_BOTTOM == true) ? true : false;

	addEvent(window, 'load', loadCSS);

	function changeTab(tab) {
		var pQp = document.getElementById('pQp');
		hideAllTabs();
		addClassName(pQp, tab, true);
	}

	function hideAllTabs() {
		var pQp = document.getElementById('pQp');
		removeClassName(pQp, 'pqp-console');
		removeClassName(pQp, 'pqp-speed');
		removeClassName(pQp, 'pqp-queries');
		removeClassName(pQp, 'pqp-memory');
		removeClassName(pQp, 'pqp-files');
		removeClassName(pQp, 'pqp-config');
		removeClassName(pQp, 'pqp-session');
		removeClassName(pQp, 'pqp-get');
		removeClassName(pQp, 'pqp-post');
	}

	function toggleDetails(){
		var container = document.getElementById('pqp-container');

		if(PQP_DETAILS){
			addClassName(container, 'pqp-hideDetails', true);
			PQP_DETAILS = false;
		}
		else{
			removeClassName(container, 'pqp-hideDetails');
			PQP_DETAILS = true;
		}
	}
	function toggleHeight(){
		var container = document.getElementById('pqp-container');

		if(PQP_HEIGHT == "short"){
			addClassName(container, 'pqp-tallDetails', true);
			PQP_HEIGHT = "tall";
		}
		else{
			removeClassName(container, 'pqp-tallDetails');
			PQP_HEIGHT = "short";
		}
	}
	function toggleBottom(){
		var container = document.getElementById('pqp-container');
		if (container.style.position == "inherit")
		{
			container.style.position="";
		}
		else
		{
			container.style.position="inherit";
		}
	}

	function loadCSS() {
		var sheet = document.createElement("style");
		sheet.setAttribute("type", "text/css");
		sheet.innerHTML = '$css';
		document.getElementsByTagName("head")[0].appendChild(sheet);
	}


	//http://www.bigbold.com/snippets/posts/show/2630
	function addClassName(objElement, strClass, blnMayAlreadyExist){
	   if ( objElement.className ){
	      var arrList = objElement.className.split(' ');
	      if ( blnMayAlreadyExist ){
	         var strClassUpper = strClass.toUpperCase();
	         for ( var i = 0; i < arrList.length; i++ ){
	            if ( arrList[i].toUpperCase() == strClassUpper ){
	               arrList.splice(i, 1);
	               i--;
	             }
	           }
	      }
	      arrList[arrList.length] = strClass;
	      objElement.className = arrList.join(' ');
	   }
	   else{
	      objElement.className = strClass;
	      }
	}

	//http://www.bigbold.com/snippets/posts/show/2630
	function removeClassName(objElement, strClass){
	   if ( objElement.className ){
	      var arrList = objElement.className.split(' ');
	      var strClassUpper = strClass.toUpperCase();
	      for ( var i = 0; i < arrList.length; i++ ){
	         if ( arrList[i].toUpperCase() == strClassUpper ){
	            arrList.splice(i, 1);
	            i--;
	         }
	      }
	      objElement.className = arrList.join(' ');
	   }
	}

	//http://ejohn.org/projects/flexible-javascript-events/
	function addEvent( obj, type, fn ) {
	  if ( obj.attachEvent ) {
	    obj["e"+type+fn] = fn;
	    obj[type+fn] = function() { obj["e"+type+fn]( window.event ) };
	    obj.attachEvent( "on"+type, obj[type+fn] );
	  }
	  else{
	    obj.addEventListener( type, fn, false );
	  }
	}

	function openProfiler()
	{
		document.getElementById("pqp-container").style.display = "block";
		document.getElementById("openProfiler").style.display = "none";
	}

	function closeProfiler()
	{
		document.getElementById("pqp-container").style.display = "none";
		document.getElementById("openProfiler").style.display = "block";
	}

	function preventDefault(e) {
	  e = e || window.event;
	  if (e.preventDefault)
	    e.preventDefault();
	  e.returnValue = false;
	}

	window.onload = function() {
		document.getElementById('pqp-console').onmousewheel = function(e){
		  document.getElementById('pqp-console').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-speed').onmousewheel = function(e){
		  document.getElementById('pqp-speed').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-queries').onmousewheel = function(e){
		  document.getElementById('pqp-queries').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-memory').onmousewheel = function(e){
		  document.getElementById('pqp-memory').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-files').onmousewheel = function(e){
		  document.getElementById('pqp-files').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-config').onmousewheel = function(e){
		  document.getElementById('pqp-config').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-session').onmousewheel = function(e){
		  document.getElementById('pqp-session').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-get').onmousewheel = function(e){
		  document.getElementById('pqp-get').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		document.getElementById('pqp-post').onmousewheel = function(e){
		  document.getElementById('pqp-post').scrollTop -= e.wheelDeltaY;
		  preventDefault(e);
		}
		if (PQP_BOTTOM)
		{
			toggleBottom();
		}
		if (PQP_SHOWONLOAD == 'open')
		{
			setTimeout(function() {
				openProfiler();
				if (PQP_HEIGHT == 'short')
				{
					PQP_HEIGHT = 'tall';
					toggleHeight();
				}
				if (PQP_DETAILS == false)
				{
					PQP_DETAILS = true;
					toggleDetails();
				}
			});
		}
	}
</script>
JAVASCRIPT;

$return_output .='<div style="clear:both;"></div><div id="pqp-container" class="pQp pqp-tallDetails">';

$logCount = count($output['logs']['console']);
$fileCount = count($output['files']);
$memoryUsed = $output['memoryTotals']['used'];
$queryCount = $output['queryTotals']['count'];
$speedTotal = $output['speedTotals']['total'];

$printarray = function($items, $depth, &$class, &$count) use(&$printarray)
{
	$output = '';
	foreach($items as $item => $value) {
		$count++;
		$output .='<tr><td class="'.$class.'">';
		if (is_bool($value))
		{
			$output .= '<b>'.($value?'true':'false').'</b>';
		}
		elseif (is_null($value))
		{
			$output .= '<b>null</b>';
		}
		elseif( ! is_array($value) AND ! is_object($value))
		{
			$output .= '<b>'.\Security::htmlentities($value).'</b>';
		}
		$output .= str_repeat('&rsaquo;&nbsp;', $depth).\Security::htmlentities($item).'</td></tr>';
		if($class == '') $class = 'pqp-alt'; else $class = '';
		is_array($value) and $output .= $printarray($value, $depth + 1, $class, $count);
		is_object($value) and $output .= $printarray($value, $depth + 1, $class, $count);
	}
	return $output;
};

$class = '';
$configCount = 0;
$output['configItems'] = $printarray(\Config::$items, 0, $class, $configCount);

$class = '';
$sessionCount = 0;
$output['sessionItems'] = $printarray(\Session::get(null), 0, $class, $sessionCount);

$class = '';
$getCount = 0;
$output['getItems'] = $printarray(\Input::get(), 0, $class, $getCount);

$class = '';
$postCount = 0;
$output['postItems'] = $printarray(\Input::post(), 0, $class, $postCount);

	$return_output .=<<<PQPTABS
<div id="pQp" class="pqp-console">
<table id="pqp-metrics" cellspacing="0">
<tr>
	<td class="pqp-green" onclick="changeTab('pqp-console');">
		<var>$logCount</var>
		<h4>Console</h4>
	</td>
	<td class="pqp-blue" onclick="changeTab('pqp-speed');">
		<var>$speedTotal</var>
		<h4>Load Time</h4>
	</td>
	<td class="pqp-purple" onclick="changeTab('pqp-queries');">
		<var>$queryCount Queries</var>
		<h4>Database</h4>
	</td>
	<td class="pqp-orange" onclick="changeTab('pqp-memory');">
		<var>$memoryUsed</var>
		<h4>Memory Used</h4>
	</td>
	<td class="pqp-red" onclick="changeTab('pqp-files');">
		<var>{$fileCount} Files</var>
		<h4>Included</h4>
	</td>
	<td class="pqp-yellow" onclick="changeTab('pqp-config');">
		<var>{$configCount} Config</var>
		<h4>items loaded</h4>
	</td>
	<td class="pqp-cyan" onclick="changeTab('pqp-session');">
		<var>{$sessionCount} Session</var>
		<h4>vars loaded</h4>
	</td>
	<td class="pqp-pink" onclick="changeTab('pqp-get');">
		<var>{$getCount} GET</var>
		<h4>vars loaded</h4>
	</td>
	<td class="pqp-flesh" onclick="changeTab('pqp-post');">
		<var>{$postCount} POST</var>
		<h4>vars loaded</h4>
	</td>
</tr>
</table>
PQPTABS;

	$return_output .='<div id="pqp-console" class="pqp-box">';

if($logCount ==  0) {
	$return_output .='<h3>This panel has no log items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
		<tr>
			<td class="pqp-alt1"><var>'.$output['logs']['logCount'].'</var><h4>Logs</h4></td>
			<td class="pqp-alt2"><var>'.$output['logs']['errorCount'].'</var> <h4>Errors</h4></td>
		</tr>
		<tr>
			<td class="pqp-alt3"><var>'.$output['logs']['memoryCount'].'</var> <h4>Memory</h4></td>
			<td class="pqp-alt4"><var>'.$output['logs']['speedCount'].'</var> <h4>Speed</h4></td>
		</tr>
		</table>
		<div class="pqp-main"><table cellspacing="0">';

		$class = '';
		foreach($output['logs']['console'] as $log) {
			$log['data'] = \Security::htmlentities($log['data']);
			$return_output .='<tr class="pqp-log-'.$log['type'].'">
				<td class="pqp-type">'.$log['type'].'</td>
				<td class="'.$class.'">';
			if($log['type'] == 'log') {
				$return_output .='<div><pre></pre><em>'.$log['data'].'</em></div>';
			}
			elseif($log['type'] == 'memory') {
				$return_output .='<div><pre>'.$log['data'].'</pre> <em>'.$log['dataType'].'</em>: '.$log['name'].' </div>';
			}
			elseif($log['type'] == 'speed') {
				$return_output .='<div><pre>'.$log['data'].'</pre> <em>'.$log['name'].'</em></div>';
			}
			elseif($log['type'] == 'error') {
				$return_output .='<div><em>Line '.$log['line'].'</em> : '.$log['data'].' <pre>'.$log['file'].'</pre></div>';
			}

			$return_output .='</td></tr>';
			if($class == '') $class = 'pqp-alt';
			else $class = '';
		}

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-speed" class="pqp-box">';

if($output['logs']['speedCount'] ==  0) {
	$return_output .='<h3>This panel has no log items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
		  <tr><td><var>'.$output['speedTotals']['total'].'</var><h4>Load Time</h4></td></tr>
		  <tr><td class="pqp-alt"><var>'.$output['speedTotals']['allowed'].' s</var> <h4>Max Execution Time</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$class = '';
		foreach($output['logs']['console'] as $log) {
			if($log['type'] == 'speed') {
				$return_output .='<tr class="pqp-log-'.$log['type'].'">
				<td class="'.$class.'">';
				$return_output .='<div><pre>'.$log['data'].'</pre> <em>'.$log['name'].'</em></div>';
				$return_output .='</td></tr>';
				if($class == '') $class = 'pqp-alt';
				else $class = '';
			}
		}

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-queries" class="pqp-box">';

if($output['queryTotals']['count'] ==  0) {
	$return_output .='<h3>This panel has no log items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
		  <tr><td><var>'.$output['queryTotals']['count'].'</var><h4>Total Queries</h4></td></tr>
		  <tr><td><var>'.$output['queryTotals']['time'].'</var> <h4>Total Time</h4></td></tr>
		  <tr><td class="pqp-alt"><var>'.$output['queryTotals']['duplicates'].'</var> <h4>Duplicates</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$class = '';
		foreach($output['queries'] as $query) {
			$return_output .='<tr>
				<td class="'.$class.'">'.$query['sql'];
			$return_output .='<em>';
			$return_output .='Connection name: <b>'.$query['dbname'].'</b><br />Speed: <b>'.$query['time'].'</b>';
			$query['duplicate'] and $return_output .=' &middot; <b>DUPLICATE</b>';
			if(isset($query['explain'])) {
				$return_output .= '<br />Query analysis:';
				foreach($query['explain'] as $qe)
				{
					isset($qe['select_type']) and $return_output .='<br /> &middot; Query: <b>'.$qe['select_type'].'</b>';
					empty($qe['table']) or $return_output .=' on <b>'.htmlentities($qe['table']).'</b>';
					isset($qe['possible_keys']) and $return_output .=' &middot; Possible keys: <b>'.$qe['possible_keys'].'</b>';
					isset($qe['key']) and $return_output .=' &middot; Key Used: <b>'.$qe['key'].'</b>';
					isset($qe['type']) and $return_output .=' &middot; Type: <b>'.$qe['type'].'</b>';
					isset($qe['rows']) and $return_output .=' &middot; Rows: <b>'.$qe['rows'].'</b>';
					empty($qe['Extra']) or $return_output .=' ('.$qe['Extra'].')';
//					$return_output .='<br />';
				}
			}
			if ( ! empty($query['stacktrace']))
			{
				$return_output .='<br />Call trace for this query:</em>';
				foreach ($query['stacktrace'] as $st)
				{
					$return_output .='<em>File: <b>'.$st['file'].'</b>, line <b>'.$st['line'].'</b></em>';
				}
			}
			else
			{
				$return_output .='</em>';
			}
			$return_output .='</td></tr>';
			if($class == '') $class = 'pqp-alt';
			else $class = '';
		}

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-memory" class="pqp-box">';

if($output['logs']['memoryCount'] ==  0) {
	$return_output .='<h3>This panel has no log items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
		  <tr><td><var>'.$output['memoryTotals']['used'].'</var><h4>Used Memory</h4></td></tr>
		  <tr><td class="pqp-alt"><var>'.$output['memoryTotals']['total'].'</var> <h4>Total Available</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$class = '';
		foreach($output['logs']['console'] as $log) {
			if($log['type'] == 'memory') {
				$return_output .='<tr class="pqp-log-'.$log['type'].'">';
				$return_output .='<td class="'.$class.'"><b>'.$log['data'].'</b> <em>'.$log['dataType'].'</em>: '.$log['name'].'</td>';
				$return_output .='</tr>';
				if($class == '') $class = 'pqp-alt';
				else $class = '';
			}
		}

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-files" class="pqp-box">';

if($output['fileTotals']['count'] + $output['pathTotals']['count'] ==  0) {
	$return_output .='<h3>This panel has no log items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
		  	<tr><td><var>'.count($output['paths']).'</var><h4>Finder Paths</h4></td></tr>
		  	<tr><td><var>'.$output['fileTotals']['count'].'</var><h4>Total Files</h4></td></tr>
			<tr><td><var>'.$output['fileTotals']['size'].'</var> <h4>Total Size</h4></td></tr>
			<tr><td class="pqp-alt"><var>'.$output['fileTotals']['largest'].'</var> <h4>Largest</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$class ='';
		$return_output .='<tr><td><strong style="font-size:120%;">Finder paths:</strong></td></tr>';
		foreach($output['paths'] as $path) {
			$return_output .='<tr><td class="'.$class.'">'.$path.'</td></tr>';
			if($class == '') $class = 'pqp-alt';
			else $class = '';
		}
		$return_output .='<tr><td><strong style="font-size:120%;">Loaded files:</strong></td></tr>';
		foreach($output['files'] as $file) {
			$return_output .='<tr><td class="'.$class.'"><b>'.$file['size'].'</b> '.$file['name'].'</td></tr>';
			if($class == '') $class = 'pqp-alt';
			else $class = '';
		}

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-config" class="pqp-box">';

if($configCount ==  0) {
	$return_output .='<h3>This panel has no config items.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
			<tr><td class="pqp-alt"><var>'.$configCount.'</var> <h4>Configuration items</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$return_output .= $output['configItems'];

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-session" class="pqp-box">';

if($sessionCount ==  0) {
	$return_output .='<h3>This panel has no session variables.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
			<tr><td class="pqp-alt"><var>'.$sessionCount.'</var> <h4>Session variables</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$return_output .= $output['sessionItems'];

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-get" class="pqp-box">';

if($getCount ==  0) {
	$return_output .='<h3>This panel has no GET variables.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
			<tr><td class="pqp-alt"><var>'.$getCount.'</var> <h4>GET variables</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$return_output .= $output['getItems'];

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .='<div id="pqp-post" class="pqp-box">';

if($postCount ==  0) {
	$return_output .='<h3>This panel has no POST variables.</h3>';
}
else {
	$return_output .='<table class="pqp-side" cellspacing="0">
			<tr><td class="pqp-alt"><var>'.$postCount.'</var> <h4>POST variables</h4></td></tr>
		 </table>
		<div class="pqp-main"><table cellspacing="0">';

		$return_output .= $output['postItems'];

		$return_output .='</table></div>';
}

$return_output .='</div>';

$return_output .=<<<FOOTER
	<table id="pqp-footer" cellspacing="0">
		<tr>
			<td class="pqp-credit">
				<a href="https://github.com/particletree" target="_blank">
				Based on
				<strong>PHP</strong>
				<b class="pqp-green">Q</b><b class="pqp-blue">u</b><b class="pqp-purple">i</b><b class="pqp-orange">c</b><b class="pqp-red">k</b>
				Profiler</a></td>
			<td class="pqp-actions">
				<a class="pqp-closeProfiler" href="#" onclick="closeProfiler();return false" title="Close Code Profiler">Close</a>
				<a class="pqp-heightToggle" href="#" onclick="toggleHeight();return false" title="Toggle Height">Height</a>
				<a class="pqp-bottomToggle" href="#" onclick="toggleBottom();return false" title="Toggle Bottom">Bottom</a>
			</td>
		</tr>
	</table>
FOOTER;

	$return_output .='</div></div><div id="openProfiler"><a href="#" onclick="openProfiler();return false" title="Open Code Profiler">Code Profiler</a></div>';

	return $return_output;
}
