<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */
global $post;
if ( $query->have_posts() )
{
	?>
	
	<?php echo $query->found_posts; ?> Results<br />
	<!-- Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br /> -->
	
<ul class="job_listings">
	<?php
	while ($query->have_posts())
	{
		$query->the_post();
		
		?>
<!-- 		<div>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<p><br /><?php the_excerpt(); ?></p>
			<?php 
				if ( has_post_thumbnail() ) {
					echo '<p>';
					the_post_thumbnail("small");
					echo '</p>';
				}
			?>
			<p><?php the_category(); ?></p>
			<p><?php the_tags(); ?></p>
			<p><small><?php the_date(); ?></small></p>
			
		</div> -->
		
		<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
			<?php // the_company_logo(); ?>
			<?php the_scholarship_logo(); ?>
		        <div class="row">
		            <div class="position col-md-9">
		                <h3 class="header"><?php wpjm_the_job_title(); ?></h3>
		                <div class="company">
		                    <?php $obj_meta = get_post_meta($post->ID);
		                    $postterms = get_the_terms( $post->ID, 'tsh_tax_institution' );
		                    $res = job_from_arr_to_text($postterms);
		                    ?>
		                    <p>
		                        <?php if($res){ ?>
		                            <span class="field-label">University:</span>
		                            <span class="field-value"><?php echo $res; ?></span>
		                        <?php }
		                        $postterms = get_the_terms( $post->ID, 'tsh_tax_subject' );
		                        $res = job_from_arr_to_text($postterms);
		                        if($res){ ?>
		                            <span class="field-label">Subject:</span>
		                            <span class="field-value"><?php echo $res; ?></span>
		                        <?php } ?>
		                    </p>
		                    <p>
		                      <?php
		                        $postterms = get_the_terms( $post->ID, 'tsh_tax_basic_selection' );
		                        $res = job_from_arr_to_text($postterms);
		                        if($res){ ?>
		                            <span class="field-label">Basis for Selection: </span>
		                            <span class="field-value"><?php echo $res; ?></span>
		                        <?php }
		                        if(!empty($obj_meta['_job_application_deadline'][0])){ ?>
		                            <span class="field-label">Application Deadline: </span>
		                            <span class="field-items"><?php echo $obj_meta['_job_application_deadline'][0];?></span>
		                        <?php } ?>                          

		                        <div class="field-label" style="margin-top: 10px;margin-bottom: 5px;">Eligibility Criteria: </div>
		                        <div class="field-items"><?php wpjm_the_job_description(); ?></div>
		                    </p>

		                        <?php // the_company_name( '<strong>', '</strong> ' ); ?>
		                        <?php // the_company_tagline( '<span class="tagline">', '</span>' ); ?>
		                </div>
		            </div>
		            <div class="col-md-3 scholarship_sidebar">
		                <?php
		                if(!empty($obj_meta['_job_financial_award'][0])){ ?>
		                <p class="field-label">Financial Award</p>
		                <p class="field-items" style="font-weight: bold;font-size: 22px;"><?php echo $obj_meta['_job_financial_award'][0];?></p>
		                <?php } ?>
		                    <a class="button_link" href="#">Add to Compare</a>
		                    <a class="button_link" href="<?php the_job_permalink(); ?>">Details</a>
		            </div>
		        </div>	
		</li>
		<?php
	}
	?>
</ul>	
	
	<div class="pagination">
		<span class="nav-previous"><?php previous_posts_link( '<<' ); ?></span>
		page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?>
		<span class="nav-next"><?php next_posts_link( '>>', $query->max_num_pages ); ?></span>
		
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<?php
}
else
{
	echo "No Results Found";
}
?>