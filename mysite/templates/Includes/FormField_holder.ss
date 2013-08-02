<div id="$Name" class="control-group field">
	<% if Title %><label class="left control-label" for="$ID">$Title</label><% end_if %>
	<div class="controls">
		$Field
		<% if RightTitle %><label class="radio right" for="$ID">$RightTitle</label><% end_if %>
		<% if Message %><span class="help-block message $MessageType">$Message</span><% end_if %>
		<% if Description %><span class="help-block description">$Description</span><% end_if %>
	</div>
</div>