<?php
/**
 * Template Name: Student Calculator
 * 
 * @package thescholarshiphub
 */

get_header();
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
                        <div class="row">
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
																	<?php for($i=2000;$i<2051;++$i){?>
																		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-md-5">
															<div class="form-group">
																<label for="duration_course">Duration</label>
																<select class="form-control" id="duration_course">
																	<option value="1">1 year</option>
																	<?php for($i=2;$i<10;++$i){?>
																		<option value="<?php echo $i; ?>"><?php echo $i; ?> years</option>
																	<?php } ?>
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
														<div class="col-md-4">
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
														<div class="col-md-4">
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
														<div class="col-md-4">
															<label for="slider_interest_val">slider_interest_val</label>
															<input type="number" class="form-control" id="slider_interest_val">
														</div>
													</div>
												</div>
												<div class="center_line"></div>
												<div class="right_part">
													<p class="right_top_text">When will the loan be cleared?</p>
													<div class="pie-chart chart" data-percent="73" data-scale-color="#ffb400">
														<div class="pie-chart-contents">
															<div class="pie-chart-unit ng-binding yearsToRepay">16</div>
															<div class="pie-chart-suffix">Yrs</div>
														</div>
													</div>
													<p>How much will you repay?</p>
													<div class="bar-chart-container">
														<div class="bar-chart">
															<div class="bar-chart-contents">
																<div class="bar-chart-unit">£<span class="ng-binding">24,800</span></div>
																<div class="bar-chart-line" style="height: 27.28px;"></div>
																<p class="bar-chart-info help-label">What you <br> repay? <a href="#repay-modal" class="info-tooltip js-help-btn ng-isolate-scope"></a></p>
															</div>
														</div>
													</div>
												</div>
												<div class="bottom_part">
													<div class="row">
														<div class="col-md-12">
															<p>The results are a rough estimate only, as a number of assumptions have been made...</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"><p>&checkmark;</p></div>
														<div class="col-md-11">
															<p>Interest is accrued and applied monthly (in reality it will accrue daily, but we have simplified
																it so that the tool can work properly - this makes a difference of up to 'plus or minus 2%'.</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"><p>&checkmark;</p></div>
														<div class="col-md-11">
															<p>You don't take any time off during the 30 years after graduation, and your salary rise is
																consistent. If you retire before the 30 years are up, there's a significant chance you'll repay
																far less.
																Repayments start in the April following graduation.</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"><p>&checkmark;</p></div>
														<div class="col-md-11">
															<p>No tuition fee inflation as some universities will keep you at the rate you start on, so if you
																pay £9,250 in year one, you pay it for each year of study.</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"><p>&checkmark;</p></div>
														<div class="col-md-11">
															<p>The repayment threshold is £25,000 in 2018/19 after which it will rise by average earnings
																growth (we assume this to be RPI+1% per annum).</p>
														</div>
													</div>
												</div>
											</div>
                                        </div><!-- .entry-content -->
                                </article><!-- #post-->
                            </div>
                        </div>
                    </div>
            <?php
            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer('without-edf');//edf = extra degree funding