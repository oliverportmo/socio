<!-- Content wrapper -->
<div class="wrapper">

  	<% include PageHeader %>

	<!-- Grid widgets -->
    <div class="row-fluid">
    	<div class="span6">
        	<div class="widget">
				<div class="navbar">
					<div class="navbar-inner">
						<h6>Like pages to earn more credits</h6>
						<button class="btn btn-info pull-right" type="button" onclick="skipAction();return false;">Skip</button>
					</div>
				</div>
               	<div class="well body">
               		<div id="fb-root"></div>
					
					$Content
					<% if Entity %>
						$Entity.Title <br />
						$Entity.Description <br />
						<br />
						$Action 
						<br /><a href="" onclick="saveAction();return false;">click</a>
						<div id="action"></div>
					<% else %>
						There are no more actions here for you...				
					<% end_if %>
		    	</div>
			</div>
         </div>
     
	</div>
    <!-- /grid widgets -->
  	
</div>
<!-- /content wrapper -->