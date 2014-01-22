WordPress Theme Customizer Boilerplate
=================================================

Theme Customizer Boiler plate you can use in your themes. For detailed explanation, check [WP Explorer][1].

Copy entire '/customizer-boilerplate' directory into your theme's directory and include 'customizer.php' from your theme's functions.php':

    require( get_stylesheet_directory() . '/customizer-boilerplate/customizer.php' );

Then you can change contents of '$options' array in ['options.php'][2] file by using 'thsp_cbp_options_array' filter hook.

If you'd like to place Customizer Boilerplate in another folder inside your theme folder (e.g. /inc/customizer-boilerplate) make sure you hook into 'thsp_cbp_directory_uri' filter hook and change default customizer path (see 'thsp_cbp_directory_uri' function in ['helpers.php'][3]).

[@slobodanmanic][4]

  [1]: http://www.wpexplorer.com/theme-customizer-boilerplate/
  [2]: customizer-boilerplate/options.php#L28
  [3]: customizer-boilerplate/helpers.php#L9
  [4]: http://twitter.com/slobodanmanic