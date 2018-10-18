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

$args = array( 'posts_per_page' => -1, 'post_type' => 'job_listing');
$myposts = get_posts( $args );

//var_dump($myposts);

if ( $query->have_posts() )
{
    $curr_user = wp_get_current_user();
    $arr_ids = get_user_meta($curr_user->ID, '_scholarship_selected', true);
    $arr_ids = $arr_ids != false ? $arr_ids : array();
    $plan_not_free = (defined( 'RCP_PLUGIN_DIR' ) && (rcp_get_subscription_id() >= 2 || current_user_can('administrator'))) ? true : false;
    ?>
	
	<?php echo $query->found_posts; ?> Results<br />
	<!-- Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br /> -->
	
<ul class="job_listings">
	<?php
	while ($query->have_posts())
	{
		$query->the_post();
                $post_id = $query->post->ID;
		?>
		
		<li <?php job_listing_class(); ?>>
			<?php the_scholarship_logo(); ?>
		        <div class="row">
		            <div class="position col-md-8">
		                <h3 class="header"><?php wpjm_the_job_title(); ?></h3>
		                <div class="company">
		                    <?php $obj_meta = get_post_meta($post_id);
		                    $postterms = get_the_terms( $post_id, 'tsh_tax_institution' );
		                    $res = job_from_arr_to_text($postterms);
		                    ?>
		                    <p>
		                        <?php if($res){ ?>
		                            <span class="field-label">University:</span>
		                            <span class="field-value"><?php echo $res; ?></span>
		                        <?php }
		                        $postterms = get_the_terms( $post_id, 'tsh_tax_subject' );
		                        $res = job_from_arr_to_text($postterms);
		                        if($res){ ?>
		                            <span class="field-label">Subject:</span>
		                            <span class="field-value"><?php echo $res; ?></span>
		                        <?php } ?>
		                    </p>
		                    <p>
		                      <?php
		                        $postterms = get_the_terms( $post_id, 'tsh_tax_basic_selection' );
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

		                </div>
		            </div>
		            <div class="col-md-3 scholarship_sidebar">
		                <?php
		                if(!empty($obj_meta['_job_financial_award'][0])){ ?>
                                        <p class="field-label">Financial Award</p>
                                        <p class="field-items" style="font-weight: bold;font-size: 22px;"><?php echo $obj_meta['_job_financial_award'][0];?></p>
                                <?php }
                                if ($plan_not_free) {
                                    $args['single'] = true;
                                    tm_woocompare_add_button( $args );
                                }
                                ?>                        
                                <a class="button_link" href="<?php the_job_permalink(); ?>" style="width: 50%;background-color: #fff; color: #000; border: 2px solid; margin-bottom: 10px; margin-left: 1rem;  margin-right: 1rem;text-align: center;    cursor: pointer;    display: inline-block;    line-height: 1;    border-radius: 0;    padding: .6em 1em .4em;margin-top: 10px;">Details</a>
		            </div>
                            <?php if ($plan_not_free) { ?>
                                <div class="col-md-1 favorite_item <?php echo in_array($post_id, $arr_ids) ? 'favorited' : 'no-favorited';?>" data-sid="<?php echo $post_id; ?>">
                                    <i class="fa fa-star"></i>
                                </div>
                            <?php } ?>
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
