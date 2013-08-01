<!-- Main navigation -->
<ul class="navigation widget">
	<% loop $Menu(1) %>
		<li class="<% if $LinkingMode = 'current' %>active<% else %>link<% end_if %>"><a href="$Link" title="$Title.XML"><i class="icon-$Icon"></i>$MenuTitle.XML</a></li>
	<% end_loop %>	        
</ul>
<!-- /main navigation -->