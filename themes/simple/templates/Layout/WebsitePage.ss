<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">
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
	</article>
		$Form
		$PageComments
</div>