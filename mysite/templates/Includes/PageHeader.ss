 <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="$Basehref">Dashboard</a></li>
		                <li class="active"><a href="$Link" title="">$MenuTitle</a></li>
		            </ul>
			        
		            <ul class="alt-buttons">
		                <li><a href="#" title=""><i class="icon-signal"></i><span>Stats</span></a></li>
		                <li><a href="#" title=""><i class="icon-comments"></i><span>Messages</span></a></li>
		                <li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Tasks</span> <strong>(+16)</strong></a>
		                	<ul class="dropdown-menu pull-right">
		                        <li><a href="#" title=""><i class="icon-plus"></i>Add new task</a></li>
		                        <li><a href="#" title=""><i class="icon-reorder"></i>Statement</a></li>
		                        <li><a href="#" title=""><i class="icon-cog"></i>Settings</a></li>
		                	</ul>
		                </li>
		            </ul>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>$Title</h5>
				    	<span>$Subtitle</span>
			    	</div>
					
					<% if URLSegment = home %>
			    	<ul class="page-stats">
			    		<li>
			    			<div class="showcase">
			    				<span>New visits</span>
			    				<h2>22.504</h2>
			    			</div>
			    			<div id="total-visits" class="chart">10,14,8,45,23,41,22,31,19,12, 28, 21, 24, 20</div>
			    		</li>
			    		<li>
			    			<div class="showcase">
			    				<span>My balance</span>
			    				<h2>$16.290</h2>
			    			</div>
			    			<div id="balance" class="chart">10,14,8,45,23,41,22,31,19,12, 28, 21, 24, 20</div>
			    		</li>
			    	</ul>
			    	<% end_if %>
			    </div>
			    <!-- /page header -->