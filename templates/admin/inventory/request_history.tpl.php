<div id="main" class="dashboard">
<?php get_breadcrumb(); ?>
<style type="text/css">.popupselectbox{ width: 100px; }</style>
		<div id="content">
			<div class="row">
				<section class="panel">
					<header class="panel-heading">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<h3><strong>Request History </h3>
							</div>
						</div>
					</header>
					<div class="panel-body">
						<table class="table table-striped no-footer">
							<tr>
								<td>Product</td>
								<td><?php echo $history['productTitle']; ?></td>
							</tr>
							<tr>
								<td>Product Category</td>
								<td><?php echo $history['productCategory']; ?></td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td><?php echo $history['quantity']; ?></td>
							</tr>
							<tr>
								<td>Requested By</td>
								<td><?php echo $history['userName']; ?></td>
							</tr>
							<tr>
								<td>Job</td>
								<td><?php echo $history['jobId']; ?></td>
							</tr>
							<tr>
								<td>Status</td>
								<td><?php echo $history['approval']; ?></td>
							</tr>
							<tr>
								<td>Date</td>
								<td><?php echo $history['updatedOn']; ?></td>
							</tr>
						</table>
						<?php if($history['approval']=='PENDING'){ ?>
							<div class="text">
								<button type="button" class="btn btn-theme-inverse" onclick="manage_approval('fn_approved');">Approve </button>
								<button type="button" class="btn btn-theme-inverse" onclick="manage_approval('fn_rejected');">Reject</button>
							</div>
						<?php } ?>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?php get_admin_left_sidebar($language); ?>