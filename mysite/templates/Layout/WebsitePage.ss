<!-- Content wrapper -->
<div class="wrapper">

  	<% include PageHeader %>

	<!-- Grid widgets -->
    <div class="row-fluid">
    	<div class="span6">
        	<div class="widget">
				<div class="navbar"><div class="navbar-inner"><h6>$Title</h6></div></div>
               	<div class="well body">
               		<div id="fb-root"></div>
					<a href="" onclick="saveAction();return false;">click</a>
					$Content
					<% if Entity %>
						$Entity.Link
						$Action
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