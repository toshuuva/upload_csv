<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
	<title>Birthdays | Delhi Public School &#8211; Aligarh</title>
	<link rel="stylesheet" href="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/css/stylesheet-dps.css">
    <!--head tags generated dynamic-->
	<script type='text/javascript' src='http://www.dpsaligarh.org/wp-includes/js/jquery/jquery.js'></script>
	<script type='text/javascript' src='http://www.dpsaligarh.org/wp-includes/js/jquery/jquery-migrate.min.js'></script>

	    <!--head tags generated dynamic-->
</head>

<body>
          
<!--- Start dynamic Accordion here-->
<?php
include_once('../connection.php');
$sql="select std_name, class, date_format(bday, '%d') as birthday, date_format(bday, '%M') as bday_month from bday_detail order by date_format(bday, '%m') desc, date_format(bday, '%d') desc";
$res=$dbh->query($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
$data=array();
while($r=$res->fetch()):
$data[$r['bday_month']][]=array($r['std_name'], $r['class'], $r['birthday']);
endwhile;
//print_r($data);
?>

<div>
	<div class="row">
		<div class="col-md-12">
		<?php foreach($data as $key=>$value): ?>
		<div class="accordion">
			
			<div class="accordion-item"><i class="fa fa-birthday-cake"></i>&nbsp; <?php echo $key ?>
			<div class="type"></div>
			</div>
			<div class="data" style="display: none;">
				<div class="responsive-table-instruction">
					<div class="container-fluid cs-table">
						<div class="row bottom-brd bg-gray">
							<div class="col-md-2 pad8 right-brd prof-serial">DATE</div>
							<div class="col-md-6 pad8 right-brd prof-serial">NAME</div>
							<div class="col-md-4 pad8 prof-serial">CLASS</div>
						</div>
						<?php foreach($value as $k=>$val): ?>
						<div class="row bottom-brd">
							<div class="col-md-2 right-brd"><?php echo $val[2] ?></div>
							<div class="col-md-6 right-brd"><?php echo $val[0] ?></div>
							<div class="col-md-4 prof-name"><?php echo $val[1] ?></div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>

		</div>
	</div>
</div>
<!--- End dynamic Accordion -->



<script src="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/js/jquery.fancybox.js"></script> 
<script src="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/js/flexslider.js"></script> 
<script src="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/js/scriptbreaker-multiple-accordion-1.js"></script> 
<script src="http://www.dpsaligarh.org/wp-content/themes/twentythirteen/js/functions.js"></script>
</body></html>