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
                while ( have_posts() ) :
                        the_post(); ?>
                    <section class="single_banner" style="background: #f6f6f6;">                        
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </section>
                    <div class="container">
                            <div class="col-md-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="entry-content">
											<div class="col-md-offset-1 col-md-10 calc_container">
												<div class="left_part">
													<div class="selects_container">
														<div class="col-md-7">
															<div class="form-group">
																<label for="start_course">Year Starting Course</label>
																<select class="form-control" id="start_course">
																		<option value="2018">2018</option>
																</select>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<label for="duration_course">Duration</label>
																<select class="form-control" id="duration_course">
																	<option value="1">1 year</option>
																	<option value="2">2 years</option>
																	<option value="3">3 years</option>
																</select>
															</div>
														</div>
													</div>
													<div class="slider_loan_container">
														<div class="col-md-8">
															<div class="form-group">
																<label for="slider_loan">Loan Balance</label>
																<div id="slider_loan"></div>
															</div>
														</div>
														<div class="col-md-4 col-sm-12">
															<div class="form-group">
																<label for="slider_loan_val">slider_loan_val</label>
																<input type="number" class="form-control" id="slider_loan_val">
															</div>
														</div>
													</div>
													<div class="slider_salary_container">
														<div class="col-md-8">
															<div class="form-group">
																<label for="slider_salary">Likely Starting Salary</label>
																<div id="slider_salary"></div>
															</div>
														</div>
														<div class="col-md-4 col-sm-12">
															<label for="slider_salary_val">slider_salary_val</label>
															<input type="number" class="form-control" id="slider_salary_val">
														</div>
													</div>
													<div class="slider_interest_container">
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
													</div>
												</div>
												<div class="center_line"></div>
												<div class="right_part">
													<p class="right_top_text">When will the loan be cleared?</p>
													<div class="pie-chart chart" data-percent="0" data-scale-color="#ffb400">
														<div class="pie-chart-contents">
															<div class="pie-chart-unit ng-binding yearsToRepay">0</div>
															<div class="pie-chart-suffix">Yrs</div>
														</div>
													</div>
													<p>How much will you repay?</p>
													<div class="bar-chart-container">
														<div class="bar-chart"style="display: none">
															<div class="bar-chart-contents" >
																<div class="bar-chart-unit">£<span class="bar-chart-unit-val">0</span></div>
																<div class="bar-chart-line" style="height: 0;"></div>
																<p class="bar-chart-info help-label">What you <br> repay?</p>
															</div>
														</div>
														<div class="tool-errors"  style="display: none">

																<span>
																	<p class="show-error"><strong>You won't repay anything before the 30 years when the debt wipes.</strong></p>
																	<p class="show-error"><strong>Try increasing starting salary to see when you'd start repaying.</strong></p>
																</span>

														</div>
													</div>
												</div>
												<div class="bottom_part">
													<div class="row">
														<div class="col-md-12">
															<p><?php echo $options[33]; ?></p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1 col-sm-1 col-xs-1"><p>&checkmark;</p></div>
														<div class="col-md-11 col-sm-11 col-xs-11">
															<p><?php echo $options[34]; ?></p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1 col-sm-1 col-xs-1"><p>&checkmark;</p></div>
														<div class="col-md-11 col-sm-11 col-xs-11">
															<p><?php echo $options[35]; ?></p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1 col-sm-1 col-xs-1"><p>&checkmark;</p></div>
														<div class="col-md-11 col-sm-11 col-xs-11">
															<p><?php echo $options[36]; ?></p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1 col-sm-1 col-xs-1"><p>&checkmark;</p></div>
														<div class="col-md-11 col-sm-11 col-xs-11">
															<p><?php echo $options[37]; ?></p>
														</div>
													</div>
												</div>
											</div>
                                        </div><!-- .entry-content -->
                                </article><!-- #post-->
                            </div>
                    </div>
            <?php
            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer('without-edf');//edf = extra degree funding