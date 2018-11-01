<?php
/**
 * Template Name: Student Calculator
 * 
 * @package thescholarshiphub
 */

get_header();
$options = get_option('TheScholarshipHub');
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
            while ( have_posts() ) : the_post(); ?>
            
		<div class="container">
			<div class="col-md-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <header class="entry-header col-md-offset-1">                                                        
                                                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                        </header><!-- .entry-header -->
					<div class="entry-content">
                                                <?php
                                                the_content();
                                                ?>
						<div class="col-md-offset-1 col-md-10 calc_container">
							<div class="left_part">
								<div class="selects_container">
									<div class="col-md-5">
										<div class="form-group">
											<label for="duration_course">Course Duration</label>
											<select class="form-control" id="duration_course">
												<option value="3">3 years</option>
												<option value="4">4 years</option>
											</select>
										</div>
									</div>
								</div>
								<div class="slider_loan_container">
									<div class="col-md-8">
										<div class="form-group">
											<label for="slider_loan">Tuition fees (per year)</label>
											<input type="range" min="0" max="9250" value="0" id="slider_loan" class="slider">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="slider_loan_val">slider_loan_val</label>
											<input type="number" class="form-control" min="0" max="9250" id="slider_loan_val">
										</div>
									</div>
								</div>
								<div class="slider_main_container">
									<div class="col-md-8">
										<div class="form-group">
											<label for="slider_main">Maintenance loan (per year)</label>
											<input type="range" min="0" max="11000" value="0" id="slider_main" class="slider">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label for="slider_main_val">slider_loan_val</label>
											<input type="number" class="form-control" min="0" max="11000" id="slider_main_val">
										</div>
									</div>
								</div>
								<div class="slider_salary_container">
									<div class="col-md-8">
										<div class="form-group">
											<label for="slider_salary">Likely Starting Salary</label>
											<input type="range" min="0" max="60000" value="0" id="slider_salary" class="slider">
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<label for="slider_salary_val">slider_salary_val</label>
										<input type="number" class="form-control" id="slider_salary_val" min="0" max="60000">
									</div>
								</div>
								<button id="calc_repayment">Calculate</button>
								<!-- <div class="slider_interest_container">
														<div class="col-md-8">
															<div class="form-group">
																<label for="slider_interest">Interest</label>
																<div id="slider_interest"></div>
															</div>
														</div>
														<div class="col-md-4 col-sm-12">
															<label for="slider_interest_val">slider_interest_val</label>
															<div class="slider_interest_val_wrap">
															<input type="number" class="form-control" id="slider_interest_val">
															</div>
														</div>
													</div> -->
							</div>
							<div class="center_line"></div>
							<div class="right_part">
								<p class="right_top_text calc-title">When will the loan be cleared?</p>
								<div class="pie-chart chart" data-percent="0" data-scale-color="#ffb400">
									<div class="pie-chart-contents">
										<div class="pie-chart-unit ng-binding yearsToRepay">0</div>
										<div class="pie-chart-suffix">Yrs</div>
									</div>
								</div>
								<p class="calc-title">How much will you repay?</p>
								<p id="amount-repaid"></p>
								
							</div>
							<div class="bottom_part">
								<div class="row">
									<div class="col-md-12">
										<p>
											<?php echo $options[33]; ?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1 col-sm-1 col-xs-1">
										<p>&checkmark;</p>
									</div>
									<div class="col-md-11 col-sm-11 col-xs-11">
										<p>
											<?php echo $options[34]; ?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1 col-sm-1 col-xs-1">
										<p>&checkmark;</p>
									</div>
									<div class="col-md-11 col-sm-11 col-xs-11">
										<p>
											<?php echo $options[35]; ?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1 col-sm-1 col-xs-1">
										<p>&checkmark;</p>
									</div>
									<div class="col-md-11 col-sm-11 col-xs-11">
										<p>
											<?php echo $options[36]; ?>
										</p>
									</div>
								</div>
								<!--<div class="row">
									<div class="col-md-1 col-sm-1 col-xs-1">
										<p>&checkmark;</p>
									</div>
									<div class="col-md-11 col-sm-11 col-xs-11">
										<p>
											<?php echo $options[37]; ?>
										</p>
									</div>
								</div>-->
							</div>
						</div>
					</div><!-- .entry-content -->
				</article><!-- #post-->
			</div>
            <!--<div class="col-md-4 single_sidebar_wrap">
                 <?php // get_sidebar('sidebar_single'); ?>
            </div>-->
		</div>
		<?php
            endwhile; // End of the loop.
            ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
