jQuery( function() {

	var sliders_def_value = 0;
	var slider_loan_min = 0, slider_salary_min = 0, slider_interest_min = 0;
	var slider_loan_max = 50000, slider_salary_max = 50000, slider_interest_max = 50000;

	var pie_chart = $('.chart');
	var pie_chart_yearsToRepay = $('.yearsToRepay');
	var bar_chart_unit_val = $('.bar-chart-unit-val');//24,800
	var bar_chart_line = $('.bar-chart-line');//27px

	var year_select = $('#start_course');
	var duration_select = $('#duration_course');

	var slider_loan = $( "#slider_loan" );
	var slider_loan_val = $('#slider_loan_val');
	var slider_salary = $( "#slider_salary" );
	var slider_salary_val = $('#slider_salary_val');
	var slider_interest = $( "#slider_interest" );
	var slider_interest_val = $('#slider_interest_val');

	function calculateBarHeight(valueAmount, pxHeight, barChartValueLimit) {
		var barChartHeightLimit = pxHeight;
		var barValuePercentage = (valueAmount / barChartValueLimit);
		barValuePercentage = (barValuePercentage >= 1) ? 1 : barValuePercentage;
		return barChartHeightLimit * barValuePercentage;
	}
	function pieChartUnitConversion(valueAmount, valueLimit) {
		return Math.round(valueAmount / valueLimit * 100);
	}

	function displayOutput() {

		/*
		нету tuitionFee, maintenanceLoan и не используеться course Duration и year starting course - юзер задаёт сразу целое знаечние totalLoan
		поле дуратион это loanDuration или надо заменить 30?
		где используеться year starting course?
		где и как используеться ползунок interest?
		откуда взять год для графика
		откуда взять значение для отображение на нижнем графике?
		*/


		// $totalLoan = tuitionFee + maintenanceLoan * courseDuration;    // values provided by user from the form
		var totalLoan = $(slider_loan_val).val();
		var interestRate = 0.03;  // interest rate is 3%
		var inflationRate = 0.02; // annual inflation rate is 2%
		var annualInterest = totalLoan * (interestRate + inflationRate);
		var cumulativeTotal = totalLoan;

		var startingSalary = $(slider_salary_val).val();
		var salary = 0;
		for (var x = 0; x <= 30; x++) {
			// Max loan duration is 30 years – after that length of time any outstanding balance is written off.
			totalLoan = totalLoan + annualInterest; // add annual interest to loan total
			cumulativeTotal = cumulativeTotal + annualInterest; // add annual interest to cumulative loan total

			var loanDuration = x;
			if (x === 0) {
				salary = startingSalary + (startingSalary * inflationRate); //in first year use starting salary from form
			} else {
				salary = salary + (salary * inflationRate); // subsequent years increment salary by inflation rate
			}
			console.log('salary '+salary)
			if(salary > 25000) {              // Repayments do not start until the student is employed and earning over £25,000 per year. After this the amount due will be 9% of earnings which exceed the threshold.
				var eligibleSalary = salary - 25000;
				var annualRepayment = eligibleSalary * 0.09; //the amount repaid in the year is 9% of salary above £25k threshold
				totalLoan = totalLoan - annualRepayment;
				if (totalLoan <= 0) {
					console.log('---');
					console.log('loanDuration = '+loanDuration);
					console.log('totalLoan = '+totalLoan);
					console.log('annualRepayment = '+annualRepayment);
					console.log('breack');

					break; // loan has been repaid
				}
			}
			console.log('loanDuration = '+loanDuration);
			console.log('totalLoan = '+totalLoan);
			console.log('annualRepayment = '+annualRepayment);
		}


		var yearsToRepay = loanDuration;
		var totalRepaymentAmount = annualRepayment;
		var yearsToRepayPieValue = pieChartUnitConversion(yearsToRepay, 30);
		var barChartUnit = totalRepaymentAmount;
		var barChartHeight = calculateBarHeight(totalRepaymentAmount, 220, 200000);


		$(bar_chart_unit_val).text(barChartUnit);
		$(bar_chart_line).css('height',barChartHeight+'px');
		$(pie_chart).data('easyPieChart').update(yearsToRepayPieValue);
		$(pie_chart_yearsToRepay).text(yearsToRepay);
	}

	$(slider_loan).slider({
		step: 1,
		min: slider_loan_min,
		max: slider_loan_max,
		value: sliders_def_value,
		slide: function( event, ui ) {
			$(slider_loan_val).val(ui.value);
			displayOutput();
		}
	});
	$(slider_loan_val).val(sliders_def_value);
	$(slider_salary).slider({
		step: 1,
		min: slider_salary_min,
		max: slider_salary_max,
		value: sliders_def_value,
		slide: function( event, ui ) {
			$(slider_salary_val).val(ui.value);
			displayOutput();
		}
	});
	$(slider_salary_val).val(sliders_def_value);
	$(slider_interest).slider({
		step: 1,
		min: slider_interest_min,
		max: slider_interest_max,
		value: sliders_def_value,
		slide: function( event, ui ) {
			$(slider_interest_val).val(ui.value);
			displayOutput();
		}
	});
	$(slider_interest_val).val(sliders_def_value);
	$(document).on('change',slider_loan_val,function(){
		$(slider_loan).slider( "option", "value", $(slider_loan_val).val() );
		displayOutput();
	});
	$(document).on('change',slider_salary_val,function(){
		$(slider_salary).slider( "option", "value", $(slider_salary_val).val() );
		displayOutput();
	});
	$(document).on('change',slider_interest_val,function(){
		$(slider_interest).slider( "option", "value", $(slider_interest_val).val() );
		displayOutput();
	});

	$(pie_chart).easyPieChart({
		animate: {
			duration: 500,
			enabled: true
		},
		size: 160,
		barColor: '#2c56a7',
		scaleColor: false,
		scaleLength: 0,
		trackColor: false,
		lineWidth: 16,
		lineCap: 'square'
	});
} );


