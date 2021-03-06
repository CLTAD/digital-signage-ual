<?php get_header(); ?>

    <header id="branding" role="banner" class="row">
      <div id="inner-header" class="twelve columns">
        <div id="site-heading">
            <div class="ual-logo-desktop">
            <div class="logo-ual college"></div>
            <div id="dashboard-link"><h5><a href="wp-admin">Dashboard</a></h5></div>
            </div>
        </div>
      </div>
    </header><!-- #branding -->

		<!-- Row for main content area -->
		<div id="content" class="row" role="main">

			<div class="four columns">
            <h3>Visit pages to view digital signs</h3>
                <div id="contents-list">
    			    <?php wp_list_pages(); ?>
    			</div>
			</div>

			<div id="howto" class="eight columns">
			<h3>How to set up digital signs</h3>
			<ol>
			    <li>Create one of the following categories, according to your college: 'csm', 'lcc', 'lcf', 'chelsea', 'wimbledon', 'camberwell'</li>
			    <li>Make some posts. Set each post to have the category from step 1.</li>
			    <li>(Optional) Use the 'Digital Signage Panel Options' to set post features.</li>
			    <li>To add an image to a post, use the 'Featured Image' option.</li>
			    <li>Create an empty page, with an appropriate title, e.g. 'CSM'</li>
			    <li>When editing that page, in the 'Digital Signage Display Settings' box, select the category you created in step 1. (Only those categories with existing posts will be displayed as options.)</li>
			    <li>To display the posts as signs, visit the page you created in step 5. It will be listed on the menu of pages on the left of the home page.</li>
			</ol>

		    <div id="info">
		    <p><h3>Additional notes</h3>
		    <ul>
		        <li>The display page is designed to include the ox-calendar widget on the right part of the page.</li>
		        <li>Expiry dates can be set on posts using ox-post-scheduler plugin. The display refreshes every hour, so any expired posts will be removed on refresh.</li>
		        <li>See the readme for more info. about widgets.</li>
		    </ul>
		    </div>
			</div>

		</div><!-- End Content row -->


<?php get_footer(); ?>