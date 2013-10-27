<?php
/**
 * Inline theme documentation
 *
 * ========
 * Contents
 * ========
 *
 * - Theme Documentation page
 *
 * @package Cazuela
 * @since Cazuela 1.1
 */
 

/**
 * Registers dashboard documentation page
 *
 * @since Cazuela 1.1
 */
function thsp_theme_documentation_page() {

	add_theme_page(
		__ ( 'Theme Documentation', 'cazuela' ),
		__ ( 'Theme Documentation', 'cazuela' ),
		'read',
		'thsp_theme_documentation',
		'thsp_theme_documentation_cb'
	);
	
}
add_action( 'admin_menu', 'thsp_theme_documentation_page' );


/**
 * Dashboard documentation page callback function
 *
 * @since Cazuela 1.1
 */
function thsp_theme_documentation_cb() { ?>
	
	<div class="wrap about-wrap">
		<h1><?php _e( 'Cazuela Theme Documentation', 'cazuela' ); ?></h1>
		<div class="about-text">
			<?php _e( 'Cazuela is amazingly flexible and powerful free theme. It comes with 6 different page layouts and 9 widgetized areas. Clean code and latest WordPress quality guidelines make it secure and very light.', 'cazuela' ); ?>
		</div><!-- .about-text -->
		<div class="wp-badge">Cazuela Theme</div>
		
		<?php
			// Set up tabs
			$docu_page = 'thsp_theme_documentation';
			$docu_page_tabs = array(
				'features'			=> __( 'Features', 'cazuela' ),
				'faq'				=> __( 'FAQ', 'cazuela' ),
				/*
				'child'				=> __( 'Child Theming', 'cazuela' ),
				'about_cazuela'		=> __( 'About Cazuela Theme', 'cazuela' ),
				'about_thematosoup'	=> __( 'About ThematoSoup', 'cazuela' ),
				*/
			);
			
			if ( isset( $_GET['tab'] ) ) {
				$current_docu_page_tab = $_GET['tab'];
			} else {
				$current_docu_page_tab = 'features';
			}
		?>
		
		<h2 class="nav-tab-wrapper">
			<?php
				// Display tabs
				foreach( $docu_page_tabs as $docu_page_tab_name => $docu_page_tab_title ) {
					if( $docu_page_tab_name == $current_docu_page_tab ) {
						echo '<a class="nav-tab nav-tab-active" href="?page=' . $docu_page . '&tab=' . $docu_page_tab_name . '">' . $docu_page_tab_title . '</a>';
					} else {
						echo '<a class="nav-tab" href="?page=' . $docu_page . '&tab=' . $docu_page_tab_name . '">' . $docu_page_tab_title . '</a>';
					}
				} 
			?>
		</h2>
		
		<?php
			switch( $current_docu_page_tab ) {
				case 'features' : ?>
					<p><?php _e( 'Every feature you want to enable or disable is in one place - Theme Customizer, so whenever you change something you get an instant preview. Theme customizer is a native WordPress feature which makes it very easy to adjust the theme to your liking.', 'cazuela'); ?></p>
					<p><?php _e( 'Cazuela is carefully thought through and gives you much flexibility for you to sway it into anything you need.', 'cazuela' ); ?></p>
					
					<h3><?php _e( 'Layouts', 'cazuela' ); ?></h3>
					<p><?php _e( 'Cazuela lets you choose between <strong>2 layout types</strong>:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Boxed', 'cazuela' ); ?></li>
						<li><?php _e( 'Full width', 'cazuela' ); ?></li>
					</ul>
					<p><?php _e( 'In addition to this you have the option of <strong>6 page layouts</strong>:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'One column', 'cazuela' ); ?></li>
						<li><?php _e( 'Two columns (right sidebar)', 'cazuela' ); ?></li>
						<li><?php _e( 'Two columns (left sidebar)', 'cazuela' ); ?></li>
						<li><?php _e( 'Three columns (two right sidebars)', 'cazuela' ); ?></li>
						<li><?php _e( 'Three columns (two left sidebars)', 'cazuela' ); ?></li>
						<li><?php _e( 'Three columns (left primary sidebar, right secondary sidebar)', 'cazuela' ); ?></li>
					</ul>

					<h3><?php _e( 'Page Templates', 'cazuela' ); ?></h3>
					<p><?php _e( '<strong>4 different templates</strong> (with more to come) let you choose the best possible way to present your content:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Widgetized Homepage (Widget area below content)', 'cazuela' ); ?></li>
						<li><?php _e( 'Authors (Sortable list of subscribers, contributors, authors, editors and administrators)', 'cazuela' ); ?></li>
						<li><?php _e( 'Masonry (Pinterest-like template)', 'cazuela' ); ?></li>
						<li><?php _e( 'Sitemap (Pages, categories and 25 of your latest posts)', 'cazuela' ); ?></li>
					</ul>

					<h3><?php _e( 'Widget Areas', 'cazuela' ); ?></h3>
					<p><?php _e( 'There are <strong>3 main widget areas:</strong>', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Primary', 'cazuela' ); ?></li>
						<li><?php _e( 'Secondary', 'cazuela' ); ?></li>
						<li><?php _e( 'Footer', 'cazuela' ); ?></li>
					</ul>
					<p><?php _e( 'Most of you will use these three, but some will have the need for inserting banners, AdSense ads, calls-to-action and other content and have more control over positioning.', 'cazuela' ); ?></p>
					<p><?php _e( 'Cazuela has one <strong>Homepage widget area</strong> below all your content where you can insert three widgets per row in unlimited number of columns.', 'cazuela' ); ?></p>
					<p><?php _e( 'In addition to this you control <strong>6 more widget areas</strong>:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Before header', 'cazuela' ); ?></li>
						<li><?php _e( 'After header', 'cazuela' ); ?></li>
						<li><?php _e( 'Before content', 'cazuela' ); ?></li>
						<li><?php _e( 'After content', 'cazuela' ); ?></li>
						<li><?php _e( 'Before footer', 'cazuela' ); ?></li>
						<li><?php _e( 'After footer', 'cazuela' ); ?></li>
					</ul>

					<h3><?php _e( 'Typography', 'cazuela' ); ?></h3>
					<p><?php _e( 'Typography is what makes every website usable, readable and also beautiful or not. You can choose from <strong>8 Body and 7 Header fonts</strong>.', 'cazuela' ); ?></p>
					<p><?php _e( 'Body fonts:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Arial', 'cazuela' ); ?></li>
						<li><?php _e( 'Helvetica', 'cazuela' ); ?></li>
						<li><?php _e( 'Open Sans', 'cazuela' ); ?></li>
						<li><?php _e( 'Lato', 'cazuela' ); ?></li>
						<li><?php _e( 'PT Sans', 'cazuela' ); ?></li>
						<li><?php _e( 'Gudea', 'cazuela' ); ?></li>
						<li><?php _e( 'Lora', 'cazuela' ); ?></li>
						<li><?php _e( 'Istok Web', 'cazuela' ); ?></li>
					</ul>
					<p><?php _e( 'Heading fonts:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Georgia', 'cazuela' ); ?></li>
						<li><?php _e( 'Open Sans', 'cazuela' ); ?></li>
						<li><?php _e( 'Lato', 'cazuela' ); ?></li>
						<li><?php _e( 'Oswald', 'cazuela' ); ?></li>
						<li><?php _e( 'Bitter', 'cazuela' ); ?></li>
						<li><?php _e( 'Merriweather', 'cazuela' ); ?></li>
						<li><?php _e( 'Droid Serif', 'cazuela' ); ?></li>
					</ul>

					<h3><?php _e( 'Site Title and Tagline', 'cazuela' ); ?></h3>
					<p><?php _e( 'Site title and tagline are your standard WordPress features. They are placed in the header area. Site title is substituted by logo if you upload one.', 'cazuela' ); ?></p>

					<h3><?php _e( 'Colors', 'cazuela' ); ?></h3>
					<p><?php _e( 'Cazuela comes with <strong>11 predefined color schemes</strong>. You can tweak any color scheme to your liking by choosing its link color and background color which applies only for boxed layout.', 'cazuela' ); ?></p>

					<h3><?php _e( 'Background Image', 'cazuela' ); ?></h3>
					<p><?php _e( 'You have the option of setting a custom background image or a pattern. This will only be visible if you select boxed layout. A custom background color will be overridden by a background image.', 'cazuela' ); ?></p>

					<h3><?php _e( 'WordPress Menus', 'cazuela' ); ?></h3>
					<p><?php _e( 'Cazuela lets you select your menus from within theme customizer, as well. You also have the option of showing your navigation above or below posts.', 'cazuela' ); ?></p>

					<h3><?php _e( 'Front Page', 'cazuela' ); ?></h3>
					<p><?php _e( 'Static Front Page is where you choose what to show on your home page, as well as which page will serve as your blogroll.', 'cazuela' ); ?></p>
					<?php break;

				case 'faq' : ?>
					<h4><?php _e( 'Q: Where is my Theme Options page?', 'cazuela' ); ?></h4>
					<p><?php _e( 'All options and theme features are controlled via <a href="customize.php">Theme Customizer</a>.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How can I switch layouts?', 'cazuela' ); ?></h4>
					<p><?php _e( 'There are 2 main layout types (boxed and full-width) and 6 layout types you can choose from. You can find them in Layout section of <a href="customize.php">Theme Customizer</a>.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: What about changing fonts?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Open Typography section in <a href="customize.php">Theme Customizer</a> and choose from 8 different body fonts and 7 header font.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How can I set title, tagline and logo?', 'cazuela' ); ?></h4>
					<p><?php _e( 'You can set all this in Site Title & Tagline section of <a href="customize.php">Theme Customizer</a>. Logo file upload field allows you to upload a logo which will replace your site title.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How can I select a color scheme?', 'cazuela' ); ?></h4>
					<p><?php _e( '<a href="customize.php">Theme Customizer</a> Colors section holds is the place where you\'ll find all your color related settings. You can choose from 10 different color-schemes and manually set your links and background color.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: Can I use a custom background image?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Yes. Once you click on the drop-down menu in <a href="customize.php">Theme Customizer</a> Background Image section, you\'ll be able to upload a custom background image. Layout style must be set to boxed for background image to be shown.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How do I use navigation menus?', 'cazuela' ); ?></h4>
					<p><?php _e( 'First you need to create one or more menus in Appearance > Menus and add some links to them. Once you do this head over to <a href="customize.php">Theme Customizer</a> Navigation section, where you can set where menus you created should be shown.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: Can I toggle navigation above and below the posts?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Sure. Head over to <a href="customize.php">Theme Customizer</a> Navigation section. There you\'ll find the option for displaying previous/next post links above or below your posts.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How can I set a custom front page?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Static Front Page section in <a href="customize.php">Theme Customizer</a> is where you set what your front page displays (static page or your latest posts) and which page holds your blogroll.', 'cazuela' ); ?></p>
					
					<h4><?php _e( 'Q: How can I create <a href="http://demo.thematosoup.com/cazuela/pagetemplates/widgetized-homepage-slider/">page with slider aside</a>?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Prepare your images. Size should be at least 500px and ideally 660px wide. Bear in mind that images are not cropped vertically.', 'cazuela' ); ?></p>
					<p><?php _e( 'Go to edit the page you want slider to show on and upload your cropped images using Media > Add New. Last uploaded image will show first in your slider. Don\t click "Insert into Page". Just populate fields - title, caption, alt text, description and exit "Media uploader".', 'cazuela' ); ?></p>
					<p><?php _e( 'Edit the page, by selecting:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Template: Widgetized Homepage', 'cazuela' ); ?></li>
						<li><?php _e( 'Widgetized homepage aside: Slider (all attachments from this page)', 'cazuela' ); ?></li>
					</ul>
										
					<h4><?php _e( 'Q: How can I create <a href="http://demo.thematosoup.com/cazuela/pagetemplates/widgetized-homepage-featured-image/">page with featured image aside</a>?', 'cazuela' ); ?></h4>
					<p><?php _e( 'Prepare your image. Image should be at least 660px wide. Bear in mind that height of images is never cropped, so if you don\'t do it adjust height manually, your images may look weirdly tall.', 'cazuela' ); ?></p>
					<p><?php _e( 'Click "Set featured image" and upload the image. Once you do that set the following:', 'cazuela' ); ?></p>
					<p><?php _e( 'Edit the page, by selecting:', 'cazuela' ); ?></p>
					<ul style="list-style:disc;margin-left:2em">
						<li><?php _e( 'Template: Widgetized Homepage', 'cazuela' ); ?></li>
						<li><?php _e( 'Widgetized homepage aside: Featured Image', 'cazuela' ); ?></li>
					</ul>				
					<?php break;
			}
		?>
	</div><!-- .wrap -->
	
<?php }