	<script type="text/javascript" src="<?php echo base_url() ;?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ;?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	
	<script type="text/javascript">
		$(document).ready(function() {
			$(".qsobox").fancybox({
				'autoDimensions'	: false,
				'width'         	: 700,
				'height'        	: 300,
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'type'				: 'iframe'
			});
		});
	</script>
	
<h2>Logbook</h2>
<?php if($this->session->flashdata('notice')) { ?>
<div id="message" >
	<?php echo $this->session->flashdata('notice'); ?>
</div>
<?php } ?>

<div class="wrap_content">


<table class="logbook" width="100%">
	<tr class="log_title titles">
		<td>Date</td>
		<td>Time</td>
		<td>Call</td>
		<td>Mode</td>
		<td>Sent</td>
		<td>Recv</td>
		<td>Band</td>
		<td>Country</td>
		<td></td>
	</tr>
	
	<?php  $i = 0;  foreach ($results->result() as $row) { ?>
		<?php  echo '<tr class="tr'.($i & 1).'">'; ?>
		<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('d/m/y', $timestamp); ?></td>
		<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('H:i', $timestamp); ?></td>
		<td><a class="qsobox" href="<?php echo site_url('logbook/view')."/".$row->COL_PRIMARY_KEY; ?>"><?php echo strtoupper($row->COL_CALL); ?></a></td>
		<td><?php echo $row->COL_MODE; ?></td>
		<td><?php echo $row->COL_RST_SENT; ?></td>
		<td><?php echo $row->COL_RST_RCVD; ?></td>
		<?php if($row->COL_SAT_NAME != null) { ?>
		<td><?php echo $row->COL_SAT_NAME; ?></td>
		<?php } else { ?>
		<td><?php echo $row->COL_BAND; ?></td>
		<?php } ?>
		<td><?php echo $row->COL_COUNTRY; ?></td>
		<td><?php if(($this->config->item('use_auth')) && ($this->session->userdata('user_type') >= 2)) { ?><a href="<?php echo site_url('qso/edit'); ?>/<?php echo $row->COL_PRIMARY_KEY; ?>" ><img src="<?php echo base_url(); ?>/images/application_edit.png" width="16" height="16" alt="Edit" />
		<?php } ?></a></td>
	</tr>
	<?php $i++; } ?>
	
</table>

	<!-- Page Through the Logbook -->
	<div class="pager">
		<?php echo $this->pagination->create_links(); ?>
	</div>

</div>
