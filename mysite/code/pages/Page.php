<?php
class Page extends SiteTree {
	private static $db = array (
			'Icon' => 'Varchar',
			'Subtitle' => 'Varchar'
	);
	private static $has_one = array ();
	function getCMSFields() {
		$fields = parent::getCMSFields ();
		
		$fields->addFieldToTab ( 'Root.Main', new TextField ( 'Subtitle', 'Subtitle' ), 'Content' );
		$fields->addFieldToTab ( 'Root.Main', new TextField ( 'Icon', 'Icon' ), 'Content' );
		
		return $fields;
	}
}
class Page_Controller extends ContentController {
	
	/**
	 * An array of actions that can be accessed via a request.
	 * Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 * 'action', // anyone can access this action
	 * 'action' => true, // same as above
	 * 'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 * 'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array ();
	public function init() {
		parent::init ();
		
		Requirements::clear ();
		Requirements::javascript ( "//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" );
		Requirements::javascript ( "//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" );
		
		Requirements::javascript ( "mysite/js/plugins/charts/excanvas.min.js" );
		Requirements::javascript ( "mysite/js/plugins/charts/jquery.flot.js" );
		Requirements::javascript ( "mysite/js/plugins/charts/jquery.flot.resize.js" );
		Requirements::javascript ( "mysite/js/plugins/charts/jquery.sparkline.min.js" );
		
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.easytabs.min.js" );
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.collapsible.min.js" );
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.mousewheel.js" );
		Requirements::javascript ( "mysite/js/plugins/ui/prettify.js" );
		
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.bootbox.min.js" );
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.jgrowl.js" );
		
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.fancybox.js" );
		Requirements::javascript ( "mysite/js/plugins/ui/jquery.elfinder.js" );
		
		Requirements::javascript ( "mysite/js/plugins/forms/jquery.uniform.min.js" );
		Requirements::javascript ( "mysite/js/plugins/forms/jquery.autosize.js" );
		Requirements::javascript ( "mysite/js/plugins/forms/jquery.inputlimiter.min.js" );
		Requirements::javascript ( "mysite/js/plugins/forms/jquery.tagsinput.min.js" );
		
		// Requirements::javascript ( "mysite/js/plugins/forms/jquery.inputmask.js" );
		Requirements::javascript ( "mysite/js/plugins/forms/jquery.select2.min.js" );
		// Requirements::javascript ( "mysite/js/plugins/forms/jquery.listbox.js" );
		
		// Requirements::javascript ( "mysite/js/plugins/tables/jquery.dataTables.min.js" );
		
		Requirements::javascript ( "mysite/js/files/bootstrap.min.js" );
		Requirements::javascript ( "mysite/js/files/functions.js" );
		
		// Requirements::javascript ( "mysite/js/charts/graph.js" );
		// Requirements::javascript ( "mysite/js/charts/chart1.js" );
		// Requirements::javascript ( "mysite/js/charts/chart2.js" );
		// Requirements::javascript ( "mysite/js/charts/chart3.js" );
	}
}