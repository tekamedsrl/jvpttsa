<?php
# PHPlot Example: Simple line graph
require_once 'phplot.php';
require_once 'mylibrary.php';
require_once 'myPlotlibrary.php';
require_once 'db.php';
require_once 'data.php';

$db = new Db(); 
$dataObj=new Data();


$suid=$_GET['study'];
$query="SELECT * from us_report inner join us_study on us_report.studyInstanceUID=us_report.studyInstanceUID where us_report.studyInstanceUID =".$db->quote($suid);
$rows = $db -> select($query);
$isCCSVIreport=count($rows,COUNT_NORMAL);

/*Dati InFlow*/
$infl=getInFlow($suid);
$hbinf=$infl["hbinf"];
$cbf=$infl["cbf"];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
     "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>



<script>
function myFunction(el) {
    var x = document.getElementById(el);
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.9&appId=763896243781229";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<title>JVP and Flow Study</title>
</head>
<body style="width:800px">
<div style="FLOAT:left;height:35px;width:200px;font-size:22;font-family:verdana;background-color:#ffffcc;"><a href='start.php'><img src=img/miniLogo.gif height=34></a></div><div style="FLOAT:left;height:35px;margin-top:0px;background-color:#ccd9ff;width:600px"><a href="#" onclick="history.go(-1);">back</a></div>
<br><br><br><br>
<div style="text-align: center">
<table align=center>
<tr>
<th>SOGGETTO</th><th>DATA DI NASCITA</th><th>DATA ESAME</th><th>RECAPITO TELEFONICO</th>
</tr>
<tr>
<?php
//echo "<td>$rows[0]['nomev']</td><td>$rows[0]['cognome']</td><td>$rows[0]['indirizzo']</td><td>$rows[0]['telefono']</td>";
?>
</tr>
</table>
</div>


<h1 style="text-align: center; font-size:16px; font-family: "Times New Roman", Georgia, Serif;">ANALISI ULTRASONORA NON INVASIVA DEL RITORNO VENOSO CEREBRALE E DEL POLSO GIUGULARE</h1>

<p>
<?php
if($isCCSVIreport>0)
{
?>
<a href='#' class='close_notification' title='Click to open'>CCSVI criteria<img src="img/close.png" width="20"  alt="Close" onClick="myFunction('ccsvi')" /></a>
<div id='ccsvi' style="display:none;">
<b>Storia: </b> <?php print($rows[0]['storia']); ?>
</p>
<p>
<b>Quesito clinico: </b> <?php print($rows[0]['quesito']); ?>
</p>
<p><b>CCA, ICA, ECA, AV</b> Arteria Carotide Comune, A. C. Interna, A. C. Esterna, A. Vertebrale<br>
Parametri emodinamici :
Flusso totale in ingresso alla testa (<b>HBinF</b>) e flusso totale in ingresso al cervello (<b>CBF</b>)
</p>
<table align=center>
<tr>
<th>HBinF</th><th>HBinF</th><th>CBF</th><th>CBF</th>
</tr>
<tr>
<td>cm<sup>3</sup>/s</td><td>ml/min</td><td>cm<sup>3</sup>/s</td><td>ml/min</td>
</tr>
<tr>
<td><?php echo $hbinf; ?></td><td><?php echo $hbinf*60; ?></td><td><?php echo $cbf; ?></td><td><?php echo $cbf*60; ?></td>
</tr>
</table>
<div><h4>CCSVI criteria</h4></div>
<div><h5>Right side</h5></div>
<table>
<tr valign=top>
<td>J1</td>
<td>Block<input  disabled type=checkbox name=j1_bloccoFlusso_d <?php print(chk($rows[0]['j1_bloccoFlusso_d'])); ?>></td>
<td>Compression<input  disabled type=checkbox name=j1_compressioni_d <?php print(chk($rows[0]['j1_compressioni_d'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j1_valvolaIpoMobile_d <?php print(chk($rows[0]['j1_valvolaIpoMobile_d'])); ?>></td>
<td>Bidirectional flow<input   disabled type=checkbox name=j1_flussoBi_d <?php print(chk($rows[0]['j1_flussoBi_d'])); ?>></td>
</tr>

<tr valign=top>
<td>J2</td>
<td>Block<input  disabled type=checkbox name=j2_bloccoFlusso_d <?php print(chk($rows[0]['j2_bloccoFlusso_d'])); ?>></td>
<td>Compression<input   disabled type=checkbox name=j2_compressioni_d <?php print(chk($rows[0]['j2_compressioni_d'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j2_valvolaIpoMobile_d <?php print(chk($rows[0]['j2_valvolaIpoMobile_d'])); ?>></td>
<td>Bidirectional flow<input   disabled type=checkbox name=j2_flussoBi_d <?php print(chk($rows[0]['j2_flussoBi_d'])); ?>></td>
</tr>

<tr valign=top>
<td>J2</td>
<td>Block<input  disabled type=checkbox name=j3_bloccoFlusso_d <?php print(chk($rows[0]['j3_bloccoFlusso_d'])); ?>></td>
<td>Compression<input  disabled type=checkbox name=j3_compressioni_d <?php print(chk($rows[0]['j3_compressioni_d'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j3_valvolaIpoMobile_d <?php print(chk($rows[0]['j3_valvolaIpoMobile_d'])); ?>></td>
<td>Bidirectional flow<input  disabled type=checkbox name=j3_flussoBi_d <?php print(chk($rows[0]['j3_flussoBi_d'])); ?>></td>
</tr>
</table>
<div><h5>Left side</h5></div>
<table>
<tr valign=top>
<td>J1</td>
<td>Block<input  disabled type=checkbox name=j1_bloccoFlusso_s <?php print(chk($rows[0]['j1_bloccoFlusso_s'])); ?>></td>
<td>Compression<input  disabled type=checkbox name=j1_compressioni_s <?php print(chk($rows[0]['j1_compressioni_s'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j1_valvolaIpoMobile_s <?php print(chk($rows[0]['j1_valvolaIpoMobile_s'])); ?>></td>
<td>Bidirectional flow<input  disabled type=checkbox name=j1_flussoBi_s <?php print(chk($rows[0]['j1_flussoBi_s'])); ?>></td>
</tr>

<tr valign=top>
<td>J2</td>
<td>Block<input  disabled type=checkbox name=j2_bloccoFlusso_s <?php print(chk($rows[0]['j2_bloccoFlusso_s'])); ?>></td>
<td>Compression<input  disabled type=checkbox name=j2_compressioni_s <?php print(chk($rows[0]['j2_compressioni_s'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j2_valvolaIpoMobile_s <?php print(chk($rows[0]['j2_valvolaIpoMobile_s'])); ?>></td>
<td>Bidirectional flow<input  disabled type=checkbox name=j2_flussoBi_s <?php print(chk($rows[0]['j2_flussoBi_s'])); ?>></td>
</tr>

<tr valign=top>
<td>J3</td>
<td>Block<input  disabled type=checkbox name=j3_bloccoFlusso_s <?php print(chk($rows[0]['j3_bloccoFlusso_s'])); ?>></td>
<td>Compression<input  disabled type=checkbox name=j3_compressioni_s <?php print(chk($rows[0]['j3_compressioni_s'])); ?>></td>
<td>Valves ipo<input  disabled type=checkbox name=j3_valvolaIpoMobile_s <?php print(chk($rows[0]['j3_valvolaIpoMobile_s'])); ?>></td>
<td>Bidirectional flow<input  disabled type=checkbox name=j3_flussoBi_s <?php print(chk($rows[0]['j3_flussoBi_s'])); ?>></td>
</tr>
</table>
</div>

<?php
}else
{
	echo "Valutazione CCSVI non presente<br><br>";

}

for($ik=1;$ik<=2;$ik++)
{
$iscvp=false;
$isjvp=false;
if($ik==1)
{
	$rl="R";
	$lato="DESTRA";
}
else
{
	$rl="L";
	$lato="SINISTRA";
}
$jp=2;

/*Selezione del video in base allo StudyID e al lato DESTRO o SINISTRO*/
$vid=getVideoId($suid,$rl,$jp);

/*** PLOT JVP***/
//Calcolo Valori limiti degli assi per il plot del JVP
$limit=getTraceParameter($vid);
$max=$limit["max"];
$min=$limit["min"];
$avg=$limit["avg"];
$std=$limit["std"];
$delta=$max-$min;
$tmax=$limit["tmax"];
$dataObj->CSA_mean=$avg;
$dataObj->CSA_min=$min;
$dataObj->CSA_max=$max;


//Fattore di conversione pixel->cm^2 e frame->s
$cal=getCalibration($vid);
$calibration=$cal['calibration'];
$tc=$cal['tc']; 



//Calcolo media e std Wave 'a'
$stat=getUncalibratedJVPstats($vid,"a");
$dataObj->a_m=round( $stat['m']*$calibration,2);
$dataObj->a_sd=round( $stat['d']*$calibration,2);


//Calcolo media e std Wave 'c'
$stat=getUncalibratedJVPstats($vid,"c");
$dataObj->c_m=round( $stat['m']*$calibration,2);
$dataObj->c_sd=round( $stat['d']*$calibration,2);


//Calcolo media e std Wave 'x'
$stat=getUncalibratedJVPstats($vid,"x");
$dataObj->x_m=round( $stat['m']*$calibration,2);
$dataObj->x_sd=round( $stat['d']*$calibration,2);


//Calcolo media e std Wave 'v'
$stat=getUncalibratedJVPstats($vid,"v");
$dataObj->v_m=round( $stat['m']*$calibration,2);
$dataObj->v_sd=round( $stat['d']*$calibration,2);


//Calcolo media e std Wave 'y'
$stat=getUncalibratedJVPstats($vid,"y");
$dataObj->y_m=round( $stat['m']*$calibration,2);
$dataObj->y_sd=round( $stat['d']*$calibration,2);



//Mostra il Doppler campionato
$isDoppler=false;
$did= getDopplerId($suid,$rl,$jp);
$dplot=plotDoppler($did);
if($dplot!=null) $isDoppler=true;


//Calcola il flusso
$isFlow=false;
$flow=getCalculatedFlowData($suid,$rl,$jp,1,1);
if($flow!=null)
{
echo "Diagramma temporale del flusso volumetrico di sangue<br>";
 	$isFlow=true;
	$fplot=plotFLow($flow);
}



/***	Delta t tra le onde JVP	***/ 

$ja=getUSSelectiveJVPwaves('a',$vid);
$jx=getUSSelectiveJVPwaves('x',$vid);
$i=0;
if(!empty($ja)&&!empty($jx)){
	while($jx[$i]['number']<$ja[0]['number'])$i++;
	$rn = count($jx,COUNT_NORMAL)-$i;
	$d=$i;
	$dtax=0;
	$inx=0;
	if($rn>0){
		for ($i=0; $i<$rn-1; $i++) {
			$si=$ja[$i]['number'];
			$sf=$ja[$i+1]['number'];
			$periodo=$sf+1-$si;
			$dtax=($jx[$i+$d]['number']-$ja[$i]['number'])/$periodo;
			if($dtax<1){
				$tax[$inx]['value']=$dtax;
				$inx++;
			}
		}
		if(!empty($tax)){
			$stat=stats($tax);
			$mudtax=round($stat[0]['mu'],3);
			$sddtax=round($stat[0]['sd'],3);
			$dataObj->dxa_m=$mudtax;
			$dataObj->dxa_sd=$sddtax;
		}
	}
	
}

$ja=getUSSelectiveJVPwaves('v',$vid);
$jx=getUSSelectiveJVPwaves('y',$vid);
$i=0;
if(!empty($ja)&&!empty($jx)){
	while($jx[$i]['number']<$ja[0]['number'])$i++;
	$rn = count($jx,COUNT_NORMAL)-$i;
	$d=$i;
	$dtax=0;
	$inx=0;
	for ($i=0; $i<$rn-1; $i++) {
		$si=$ja[$i]['number'];
		$sf=$ja[$i+1]['number'];
		$periodo=$sf+1-$si;
		$dtax=($jx[$i+$d]['number']-$ja[$i]['number'])/$periodo;
		if($dtax<1){
			$tax2[$inx]['value']=$dtax;
			$inx++;
		}
	
	}
	$stat=stats($tax2);
	$mudtvy=round($stat[0]['mu'],3);
	$sddtvy=round($stat[0]['sd'],3);
	
	$dataObj->dvy_m=$mudtvy;
	$dataObj->dvy_sd=$sddtvy;
	

	
}

//Calcolo Ritardo tra JVP/ECG per Ultrasound
//1) trova number onda P nP
//2) Da quel number trova number onde a,c,x,v,y: na, nc, nx, nv, ny
//3) Calcola intervalli nP-na, nP-nx, nP- ny. Lo stesso per nR
$dap=0;
$na=0;
$periodo=0;
$xp=0;
$nx=0;
$dxp=0;

$ers=getUSSelectiveECGwaves("P",$vid);
$rn = count($ers,COUNT_NORMAL);

for ($i=0; $i<$rn-1; $i++) {
	$si=$ers[$i]['number'];
	$sf=$ers[$i+1]['number'];
	$periodo=$sf+1-$si;
	$queryJ="SELECT *  FROM  us_jvp  WHERE number>=".$si." and number<".$sf." and us_jvp.videoclipid =".$vid;
	$jrs = $db-> select($queryJ);
	$en = count($jrs,COUNT_NORMAL);
	for ($j=0; $j<$en; $j++) {
		$isjvp=true;
		$wave=$jrs[$j]['acxvyWave'];
		$jn=$jrs[$j]['number'];
		if($wave=="a"){
			$a_ap[$na]['value']=($jn-$si)/$periodo;
			$na+=1;
			$dap+=($jn-$si)/$periodo;
			
		}
		if($wave=="x"){
			$a_xp[$nx]['value']=($jn-$si)/$periodo;
			$nx+=1;
			$dxp+=($jn-$si)/$periodo;
			
		}
	}
}
if(!empty($a_ap)){
	$stat=stats($a_ap);
	$dataObj->dajp_m=round($stat[0]['mu'],3);
	$dataObj->dajp_sd=round($stat[0]['sd'],3);
}
if(!empty($a_xp)){
	$stat=stats($a_xp);
	$dataObj->dxjp_m=round($stat[0]['mu'],3);
	$dataObj->dxjp_sd=round($stat[0]['sd'],3);
}


//Realzione onda T con onda v
$dvt=0;
$nv=0;
$periodo=0;
$yt=0;
$ny=0;
$dyt=0;

$ers=getUSSelectiveECGwaves("T",$vid);
$rn = count($ers,COUNT_NORMAL);

for ($i=0; $i<$rn-1; $i++) {
	$si=$ers[$i]['number'];
	$sf=$ers[$i+1]['number'];
	$periodo=$sf+1-$si;
	$queryJ="SELECT *  FROM  us_jvp  WHERE number>=".$si." and number<".$sf." and us_jvp.videoclipid =".$vid;
	$jrs = $db-> select($queryJ);
	$en = count($jrs,COUNT_NORMAL);
	for ($j=0; $j<$en; $j++) {
		$isjvp=true;
		$wave=$jrs[$j]['acxvyWave'];
		$jn=$jrs[$j]['number'];
		//echo $wave;
		if($wave=="v"){
			$a_vt[$nv]['value']=($jn-$si)/$periodo;
			$nv+=1;
		}
		if($wave=="y"){
			$a_yt[$ny]['value']=($jn-$si)/$periodo;
			$ny+=1;
		}
	}
}
if(!empty($a_vt)){
	$stat=stats($a_vt);
	$dataObj->dvjt_m=round($stat[0]['mu'],3);
	$dataObj->dvjt_sd=round($stat[0]['sd'],3);
}

if(!empty($a_yt)){
	$stat=stats($a_yt);
	$dataObj->dyjt_m=round($stat[0]['mu'],3);
	$dataObj->dyjt_sd=round($stat[0]['sd'],3);
}

//Calcolo Ritardo tra JVP/ECG per Cruenta
$c_dap=0;
$c_na=0;
$c_periodo=0;
$c_xp=0;
$c_dxp=0;
$c_nx=0;

//ID per lo screenshot
$sid=getScreenshotId(getCVPid($suid));

$ers=getCVPSelectiveECGwaves("P",$sid);
$rn = count($ers,COUNT_NORMAL);

for ($i=0; $i<$rn-1; $i++) {
	$si=$ers[$i]['number'];
	$sf=$ers[$i+1]['number'];
	$c_periodo=$sf+1-$si;
	$queryJ="SELECT *  FROM  cvp_waves  WHERE number>=".$si." and number<".$sf." and cvp_waves.idscreenshot =".$sid;
	//echo "$queryJ<br>";
	$jrs = $db-> select($queryJ);
	$en = count($jrs,COUNT_NORMAL);
	for ($j=0; $j<$en; $j++) {
		$iscvp=true;
		$wave=$jrs[$j]['acxvyWave'];
		$jn=$jrs[$j]['number'];
		if($wave=="a"){
			$c_na+=1;
			$c_dap+=($jn-$si)/$c_periodo;
		}
		if($wave=="x"){
			$c_nx+=1;
			$c_dxp+=($jn-$si)/$c_periodo;
		}
	}
}
if($iscvp){
	
//Calcolo media e std Wave 'a'
$stat=getCalibratedCVPstats("a",$sid);
$dataObj->cvp_a_m=round( $stat['m'],2);
$dataObj->cvp_a_sd=round( $stat['d'],2);


//Calcolo media e std Wave 'c'
$stat=getCalibratedCVPstats("c",$sid);
$dataObj->cvp_c_m=round( $stat['m'],2);
$dataObj->cvp_c_sd=round( $stat['d'],2);


//Calcolo media e std Wave 'x'
$stat=getCalibratedCVPstats("x",$sid);
$dataObj->cvp_x_m=round( $stat['m'],2);
$dataObj->cvp_x_sd=round( $stat['d'],2);


//Calcolo media e std Wave 'v'
$stat=getCalibratedCVPstats("v",$sid);
$dataObj->cvp_v_m=round( $stat['m'],2);
$dataObj->cvp_v_sd=round( $stat['d'],2);


//Calcolo media e std Wave 'y'
$stat=getCalibratedCVPstats("y",$sid);
$dataObj->cvp_y_m=round( $stat['m'],2);
$dataObj->cvp_y_sd=round( $stat['d'],2);


	$c_dap=($c_dap/$c_na);
	$c_dxp=($c_dxp/$c_nx);
	
	
	$dataObj->dacp_m=$c_dap;
	$dataObj->dxcp_m=$c_dxp;
}


//Preparazione dati per plot ECG
$myecg=getECGplottableData($vid);
$data=getCalibratedJVP($vid);
$plot=plotCSAwithECG($data,$myecg,$min,$delta,$tmax,$max);
?>

<p> <b>Vena Giugulare Interna, <?php echo $lato;?> </b> </p>


<?php
if(!empty($plot)){ ?>
<a href='#' class='close_notification' title='Click to open'>Condivisione<img src="img/close.png" width="20"  alt="Close" onClick="myFunction('social')" /></a>
<div id='social' style="display:none;">
<div class="fb-share-button"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Condividi</a></div>
</div>
<img src="<?php echo $plot->EncodeImage();?>" alt="Plot Image">
<head>
<meta property="og:url"           content="http://www.isisinipazzi.it/jvpAdmin/researchreport.php?study=<?php echo $art_id?>" />
	<meta property="og:type"          content="JVP Study" />
	<meta property="og:title"         content="JVP Study" />
	<meta property="og:description"   content="JVP Stud" />
	<meta property="og:image"         content="http://www.isisinipazzi.it/jvpAdmin/researchreport.php?study=<?php echo $suid?>/data" />
	<meta property="og:image:type"         content="image/png" />
	<meta property="og:image:width" content="120px" />
</head>
<?php 
}
?>
<!--Tutti i parametri della CSA-->
<br><br>
CSA Parameters<br>
<table style="font-family:verdana;font-size:14px" spacing=1 border=1 >
<tr>
<td>CSA<sub>mean</sub><td>CSA<sub>min</sub></td><td>CSA<sub>max</sub></td><td>a</td><td>c</td><td>x</td><td>v</td><td>y</td><td>&Delta;a</td><td>&Delta;v</td><td>&Delta;a/a</td><td>&Delta;v/v</td><td>&Delta;xa</td><td>&Delta;vy</td>
<td>&Delta;aP</td><td>&Delta;vT</td><td>&Delta;xP</td><td>&Delta;yT</td>
<tr>
	<td colspan=10 align=center>(cm<sup>2</sup>)</td><td colspan=2 align=center>#</td><td colspan=6 align=center> (ccf)</td>
</tr>
</tr>
<tr>
<?php
$da=round($dataObj->getDa(),3);
$dv=round($dataObj->getDv(),3);
$daa=round($dataObj->getDaOna(),3);
$dvv=round($dataObj->getDvOnv(),3);
echo "<td>$dataObj->CSA_mean</td><td>$dataObj->CSA_min</td><td>$dataObj->CSA_max</td><td>$dataObj->a_m</td><td>$dataObj->c_m</td><td>$dataObj->x_m</td><td>$dataObj->v_m</td><td>$dataObj->y_m</td><td>$da</td><td>$dv</td><td>$daa</td><td>$dvv</td><td>$dataObj->dxa_m</td><td>$dataObj->dvy_m</td><td>$dataObj->dajp_m</td><td>$dataObj->dvjt_m</td><td>$dataObj->dxjp_m</td><td>$dataObj->dyjt_m</td> ";

?>
</tr>
</table>

<?php
if($isDoppler){ ?>
<img src="<?php echo $dplot->EncodeImage();?>" alt="Plot Image">
<?php 
}
?>
<?php
if($isFlow){ ?>
Tracciato temporale del flusso volumetrico<br>
<img src="<?php echo $fplot->EncodeImage();?>" alt="Plot Image">
<?php 
}
?>
<?php

if($iscvp&&$isjvp)
{
?>
CVP Parameters<br>
<table style="font-family:verdana;font-size:14px" spacing=1 border=1 >
<tr>
<td>a</td><td>c</td><td>x</td><td>v</td><td>y</td><td>&Delta;a</td><td>&Delta;v</td><td>&Delta;a/a</td><td>&Delta;v/v</td>
<tr>
	<td colspan=7 align=center>(mmHg)</td><td colspan=2 align=center>#</td>
</tr>
</tr>
<tr>
<?php
$da=round($dataObj->getcvp_Da(),3);
$dv=round($dataObj->getcvp_Dv(),3);
$daa=round($dataObj->getcvp_DaOna(),3);
$dvv=round($dataObj->getcvp_DvOnv(),3);
echo "<td>$dataObj->cvp_a_m</td><td>$dataObj->cvp_c_m</td><td>$dataObj->cvp_x_m</td><td>$dataObj->cvp_v_m</td><td>$dataObj->cvp_y_m</td><td>$da</td><td>$dv</td><td>$daa</td><td>$dvv</td>";

?>
</tr>
</table>




<br>
<b>Pressure vs ECG wave relationship</b><br><br>
CVP/ECG:
<?php
echo "&Delta;t<sub> a<sub>cvp</sub>P</sub>=".round($dataObj->dacp_m,3)."&nbsp;&Delta;t <sub>x<sub>cvp</sub>P</sub>=".round($dataObj->dacp_sd,3)." (Cardiac cycle fraction)" ;
?>
</p>
<p>JVP/ECG:
<?php
echo "&Delta;t<sub> a<sub>jvp</sub>P</sub>=".round($dataObj->dajp_m,3)."&nbsp;&Delta;t <sub>x<sub>jvp</sub>P</sub>=".round($dataObj->dajp_sd,3) ;
?>
</p>
<p>CVP/JVP
<?php
$daa=$dataObj->getDaa();
$dxx=$dataObj->getDxx();
echo "&Delta;t<sub>a<sub>jvp</sub>a<sub>cvp</sub></sub>=".round(($daa),3)."&nbsp;&Delta;t<sub>x<sub>jvp</sub>x<sub>cvp</sub></sub>=".round(($dxx),3)." (Cardiac cycle fraction)" ;
?>
</p>
<?php
}
?>
<br>

<?php

}
?>
</body>
</html>

