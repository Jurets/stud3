<?php

//Recent Testimonials
if (!function_exists('shortcode_recenttesti')) {

	function shortcode_recenttesti($atts, $content = null) {
		extract(shortcode_atts(array(
				'num' => '5',
				'thumb' => 'true',
				'excerpt_count' => '30',
				'custom_class' => ''
		), $atts));

		$testi = get_posts('post_type=testi&orderby=post_date&numberposts='.$num);

		$output = '<div class="testimonials '.$custom_class.'">';
		
		global $post;
		global $my_string_limit_words;

		foreach($testi as $post){
				setup_postdata($post);
				$excerpt = get_the_excerpt();
				$custom = get_post_custom($post->ID);
				if ( isset($custom["my_testi_caption"][0]) ) {
					$testiname = $custom["my_testi_caption"][0];
				}
				if ( isset($custom["my_testi_url"][0]) ) {
					$testiurl = $custom["my_testi_url"][0];
				}
				if ( isset($custom["my_testi_info"][0]) ) {
					$testiinfo = $custom["my_testi_info"][0];
				}				
				
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url = $attachment_url['0'];
				$image = aq_resize($url, 220, 144, true);

				$output .= '<div class="testi-item">';
						$output .= '<blockquote class="testi-item_blockquote">';
							if ($thumb == 'true') {
								if ( has_post_thumbnail($post->ID) ){
									$output .= '<figure class="featured-thumbnail">';
									$output .= '<img  src="'.$image.'"/>';
									$output .= '</figure>';
								}
							}
							$output .= '<small class="testi-meta">';
							if( isset($testiname) ) { 
								$output .= '<span class="user">';
									$output .= $testiname;
								$output .= '</span>';
							}
							
							if( isset($testiinfo) ) { 
								$output .= '<span class="info">';
									$output .= $testiinfo;
								$output .= '</span><br>';
							}
							
							if( isset($testiurl) ) { 
								$output .= '<a href="'.$testiurl.'">';
									$output .= $testiurl;
								$output .= '</a>';
							}
							
						$output .= '</small><div class="clear"></div>';
							$output .= '<a href="'.get_permalink($post->ID).'">';
								$output .= my_string_limit_words($excerpt,$excerpt_count);
							$output .= '</a>';

					$output .= '</blockquote>';
						
				$output .= '</div>';

		}
		$output .= '</div>';
		return $output;
	}
	add_shortcode('recenttesti', 'shortcode_recenttesti');

}
?>