<!-- Sidebar -->
<div id="sidebar">

	<div class="sidebar-tabs">
		
		<ul class="tabs-nav two-items">
	    	<li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
	        <li><a href="#stuff" title=""><i class="icon-cogs"></i></a></li>
	    </ul>

        <div id="general">

	        <!-- Sidebar user -->
	        <div class="sidebar-user widget">
				<div class="navbar"><div class="navbar-inner"><h6>Welkom, {$CurrentMember.FirstName}!</h6></div></div>
	            <a href="#" title="" class="user"><img src="http://placehold.it/210x110" alt="" /></a>
	            <ul class="user-links">
	            	<% loop ChildrenOf(user) %>
	            		<li><a href="$Link" title="$MenuTitle.XML">$MenuTitle.XML<strong>1</strong></a></li>
	            	<% end_loop %>
	            </ul>
	        </div>
	        <!-- /sidebar user -->

		    <% include Navigation %>

        </div>

        <div id="stuff">

	        <!-- Social stats -->
	        <div class="widget">
	        	<h6 class="widget-name"><i class="icon-twitter"></i>Social statistics</h6>
	        	<ul class="social-stats">
	        		<li>
	        			<a href="" title="" class="orange-square"><i class="icon-rss"></i></a>
	        			<div>
		        			<h4>1,286</h4>
		        			<span>total feed subscribers</span>
		        		</div>
	        		</li>
	        		<li>
	        			<a href="" title="" class="blue-square"><i class="icon-twitter"></i></a>
	        			<div>
		        			<h4>12,683</h4>
		        			<span>total twitter followers</span>
		        		</div>
	        		</li>
	        		<li>
	        			<a href="" title="" class="dark-blue-square"><i class="icon-facebook"></i></a>
	        			<div>
		        			<h4>530,893</h4>
		        			<span>total facebook likes</span>
		        		</div>
	        		</li>
	        	</ul>
	        </div>
	        <!-- /social stats -->




	

        	<!-- Action buttons -->
            <div class="widget">
               	<h6 class="widget-name"><i class="icon-search"></i>Action buttons</h6>
               	<button class="btn btn-block btn-danger">Action button</button>
               	<button class="btn btn-block btn-info">Action button</button>
               	<button class="btn btn-block btn-success">Action button</button>
            </div>
            <!-- /action buttons -->

		  

		</div>

	</div>
</div>
<!-- /sidebar -->