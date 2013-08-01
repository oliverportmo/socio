<!-- Content wrapper -->
<div class="wrapper">

  	<% include PageHeader %>

	<!-- Grid widgets -->
    <div class="row-fluid">
    	<div class="span6">
        	<div class="widget">
				<div class="navbar"><div class="navbar-inner"><h6>$Title</h6></div></div>
               	<div class="well body">
               		<% if $CurrentMember %>
			
				<% with $CurrentMember %>
	    			    			
	    			<% if Complete != '1' %>
	    			
	    				$Top.CompletionForm
	    				
	    			<% else %>	
	    			
	    				<p>You are logged in as $FirstName. <a href="Security/logout">log out</a></p>
	    				
	    				$Content
	    				
			    		<!-- The plugin will be embedded into this div //-->
						<div id="social_link_container"></div>
						
						<script type="text/javascript">
						 	oneall.api.plugins.social_link.build("social_link_container", {
						  		'providers' :  ['facebook', 'google', 'twitter'], 
						  		'user_token': '$Token',
						  		'callback_uri': '{$Top.AbsoluteLink}connected'
						 	});
						</script>
						
	    			<% end_if %>
	    			
				<% end_with %>
				
			<% else %>
			
				<!-- The plugin will be embedded into this div //-->
				<div id="social_login_container"></div>
				
				<script type="text/javascript">
					 oneall.api.plugins.social_login.build("social_login_container", {
					  'providers' :  ['facebook', 'google', 'twitter'], 
					  'callback_uri': '{$AbsoluteLink}connected'
					 });
				</script>
			
			<% end_if %>
               	</div>
			</div>
         </div>
     
	</div>
    <!-- /grid widgets -->
  	
</div>
<!-- /content wrapper -->