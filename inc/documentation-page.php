<?php

/**
 * Registers dashboard documentation page
 *
 * @since Cazuela 1.0
 */
function thsp_theme_documentation_page() {

	add_theme_page(
		'Theme Documentation',
		'Theme Documentation',
		'read',
		'thsp_theme_documentation',
		'thsp_theme_documentation_cb'
	);
	
}
add_action( 'admin_menu', 'thsp_theme_documentation_page' );


/**
 * Dashboard documentation page callback function
 *
 * @since Cazuela 1.0
 */
function thsp_theme_documentation_cb() { ?>
	
	<div class="wrap about-wrap">
		<h1>Cazuela Theme Documentation</h1>
		<div class="about-text">
			Thank you for updating to the latest version! WordPress 3.5 is more polished and enjoyable than ever before. We hope you like it.
		</div><!-- .about-text -->
		
		<?php
			// Set up tabs
			$docu_page = 'thsp_theme_documentation';
			$docu_page_tabs = array(
				'tab1'		=> 'Tab 1',
				'tab2'		=> 'Tab 2'
			);
			
			if ( isset( $_GET['tab'] ) ) {
				$current_docu_page_tab = $_GET['tab'];
			} else {
				$current_docu_page_tab = 'tab1';
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
				case 'tab1' : ?>
					<h3>Some heading in TAB 1</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ipsum elit, semper vitae adipiscing vitae, semper in turpis. Nunc fringilla volutpat ornare.</p>
					
					<h4>Sub-heading in tab 1</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ipsum elit, semper vitae adipiscing vitae, semper in turpis. Nunc fringilla volutpat ornare. Fusce tincidunt, lectus in gravida ullamcorper, nisl lorem luctus nisl, id molestie nunc tortor quis magna. Mauris posuere, arcu vel pharetra feugiat, justo tortor hendrerit felis, dignissim malesuada augue nibh euismod est. Integer laoreet lacus a tortor ornare cursus. Fusce ac sapien at magna porta viverra. Integer ullamcorper turpis et nisi aliquam et sollicitudin mauris sagittis.</p>
					<iframe width="853" height="480" src="http://www.youtube.com/embed/a1tO8WE7tdk" frameborder="0" allowfullscreen></iframe>
					<?php break;

				case 'tab2' : ?>
					<h3>Some heading in TAB 2</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ipsum elit, semper vitae adipiscing vitae, semper in turpis. Nunc fringilla volutpat ornare.</p>
					
					<h4>Sub-heading in tab 2</h4>
					<p>It is important to understand how the switch statement is executed in order to avoid mistakes. The switch statement executes line by line (actually, statement by statement). In the beginning, no code is executed. Only when a case statement is found with a value that matches the value of the switch expression does PHP begin to execute the statements. PHP continues to execute the statements until the end of the switch block, or the first time it sees a break statement. If you don't write a break statement at the end of a case's statement list, PHP will go on executing the statements of the following case. For example:</p>
					<?php break;
			}
		?>
	</div><!-- .wrap -->
	
<?php }