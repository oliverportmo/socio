<!-- Content wrapper -->
<div class="wrapper">

  	<% include PageHeader %>

	<!-- Grid widgets -->
    <div class="row-fluid">
    	
    	<% if EntityType = 'Accounts' %>
    	
	    	<div class="span6">
	        	<div class="widget">
					<div class="navbar"><div class="navbar-inner"><h6>Facebook Profile</h6></div></div>
	               	<div class="well body">
	               		$FacebookForm
	               	</div>
				</div>
	         </div>
	         
	         <div class="span6">
	        	<div class="widget">
					<div class="navbar"><div class="navbar-inner"><h6>Twitter Account</h6></div></div>
	               	<div class="well body">
	               		$TwitterForm
	               	</div>
				</div>
	         </div>
	         
	         <div class="span6">
	        	<div class="widget">
					<div class="navbar"><div class="navbar-inner"><h6>Google Account</h6></div></div>
	               	<div class="well body">
	               		$GoogleForm
	               	</div>
				</div>
	         </div>
         
         <% else_if EntityType = 'Websites' %>
         
	         <div class="span6">
	        	<div class="widget">
					<div class="navbar"><div class="navbar-inner"><h6>Websites</h6></div></div>
	               	<div class="well body">
	               		$WebsiteForm
	               	</div>
				</div>
	         </div>
         
         <% end_if %>
     
	</div>
    <!-- /grid widgets -->
  	
</div>
<!-- /content wrapper -->