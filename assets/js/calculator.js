jQuery( function() {

	var sliders_def_value = 0;
	var slider_loan_min = 0, slider_salary_min = 0, slider_interest_min = 0;
	var slider_loan_max = 12000,
		slider_salary_max = 60000,
		slider_interest_max = 25;

	var pie_chart = $('.chart');
	var pie_chart_yearsToRepay = $('.yearsToRepay');
	var bar_chart_unit_val = $('.bar-chart-unit-val');//24,800
	var bar_chart_line = $('.bar-chart-line');//27px

	var year_select = $('#start_course');
	var duration_select = $('#duration_course');

	var tool_errors = $('.tool-errors');
	var bar_chart = $('.bar-chart');

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
console.log('start');
		//
		// Year Starting Course: 2018
		//
		// Duration: 3 years
		//
		// Loan balance: 20,000
		//
		// Likely Starting Salary: 35,000
		//
		// Interest: 5%
		//
		//
		//
		// The repayments amount is 9% of salary above £25,000. So in this example £35,000 - £25,000 = 10,000 eligible salary and 9% of that is £900 so the annual repayment amount is £900 per year.
		//
		//
		//
		// 	Annual interest is 5% of 20,000 = £1,800
		//
		//
		//
		// The repayments and interest need to be looped through up to 30 times (maximum loan duration is 30 years) and each year add interest and deduct repayments but also increase salary by 2% for inflation.

		// $totalLoan = tuitionFee + maintenanceLoan * courseDuration;    // values provided by user from the form
		// var start = 20000;
		// var duration = 3;
		var loan = parseInt($(slider_loan_val).val());
		var like_salary = parseInt($(slider_salary_val).val());
		var interest = parseInt($(slider_interest_val).val());

		var loan_now = loan;
		var loan_total = 0;
		var loanDuration = 1;
		for(var i=1;i<=30;i++){
			loanDuration = i;
			// 20000 + (20000*(1+5/100)^1)-20000) - ((35000*102%^1-25000)/100*9)
			// console.log('loan_now1 = ' + loan_now);
			loan_now = loan_now + ((loan_now*Math.pow((1+interest/100),i))-loan)-((like_salary*Math.pow((1+2/100),i)-25000)/100*9);
			console.log('loan_now2 = ' + loan_now);
			console.log('i = ' + i);
			// console.log('like_salary = ' + (like_salary*Math.pow((1+2/100),i)));
			// console.log('pay = ' + ((like_salary*Math.pow((1+2/100),i)-25000)/100*9));
			if(loan_now >= 0){
				loan_total += loan_now;
			}
			if(loan_now <= 0){
				break;
			}
		}
		if(loan_now >= 0){
			$(tool_errors).show();
			$(bar_chart).hide();
		}else if(loan_now <= 0){
			$(tool_errors).hide();
			$(bar_chart).show();
		}
		// 0								900
		// y1 = 20000 + (20000*(1+5/100)^0)-20000) - ((35000*102%^0-25000)/100*9) 		19100
		// 1000							963
		// 19100 + (20000*(1+5/100)^1)-20000) - ((35000*102%^1-25000)/100*9) 		19137
		// 2050							1027.26
		// y2 = 19137 + (20000*(1+5/100)^2)-20000) - ((35000*102%^2-25000)/100*9) 		20159.74

		/*
		весь кредит под 5% годовых
		20000*(1+5/100)^3
		20000*5%^3
		23152.5


		если зп 35000+

y1 35000				35000-25000=10000  10000/100*9 = 900 //(35000*102%^2-25000)/100*9
y2 35000+2% = 35700		35700-25000=10700  10700/100*9 = 963
y3 35700+2% = 36414		36414-25000=11414  11414/100*9 = 1027.26
32114
за 3 года 2890.26


простые проценты
20000+(20000/100*5)
23000
20000 + (20000*(1+5/100)^1)-20000) - ((50000*102%^1-25000)/100*9) 18600
18600 + (20000*(1+5/100)^1)-20000) - ((50000*102%^1-25000)/100*9) 18600
						1000								900
y1 = 20000 + (20000*(1+5/100)^1)-20000) - ((35000*102%^1-25000)/100*9) 		20100
													963
y2 = 20100 + (20000*(1+5/100)^2)-20000) - ((35000*102%^2-25000)/100*9) 		21122.74
						2050							1027.26
y2 = 19137 + (20000*(1+5/100)^2)-20000) - ((35000*102%^2-25000)/100*9) 		20159.74







Вы положили 50 000 руб в банк под 10% годовых на 5 лет. Какая сумма будет у вас через 5 лет? Рассчитаем по формуле сложного процента:

SUM = 50000 * (1 + 10/100)5 = 80 525, 5 руб.
50000*(1+10/100)^5

If the salary is high they will pay the loan off in under 30 years so it will show for example loan duration 25 years and over those 25 years it will show total cost of amount borrowed and total interest paid over 25 years.
*/


			/*
			нету tuitionFee, maintenanceLoan и не используеться course Duration и year starting course - юзер задаёт сразу целое знаечние totalLoan
			поле дуратион это loanDuration или надо заменить 30?
			где используеться year starting course?
			где и как используеться ползунок interest?
			откуда взять год для графика
			откуда взять значение для отображение на нижнем графике?
			*/


		// // $totalLoan = tuitionFee + maintenanceLoan * courseDuration;    // values provided by user from the form
		// var totalLoan = $(slider_loan_val).val();
		// var interestRate = 0.03;  // interest rate is 3%
		// var inflationRate = 0.02; // annual inflation rate is 2%
		// var annualInterest = totalLoan * (interestRate + inflationRate);
		// var cumulativeTotal = totalLoan;
		//
		// var startingSalary = $(slider_salary_val).val();
		// var salary = 0;
		// for (var x = 0; x <= 30; x++) {
		// 	// Max loan duration is 30 years – after that length of time any outstanding balance is written off.
		// 	totalLoan = totalLoan + annualInterest; // add annual interest to loan total
		// 	cumulativeTotal = cumulativeTotal + annualInterest; // add annual interest to cumulative loan total
		//
		// 	var loanDuration = x;
		// 	if (x === 0) {
		// 		salary = startingSalary + (startingSalary * inflationRate); //in first year use starting salary from form
		// 	} else {
		// 		salary = salary + (salary * inflationRate); // subsequent years increment salary by inflation rate
		// 	}
		// 	console.log('salary '+salary)
		// 	if(salary > 25000) {              // Repayments do not start until the student is employed and earning over £25,000 per year. After this the amount due will be 9% of earnings which exceed the threshold.
		// 		var eligibleSalary = salary - 25000;
		// 		var annualRepayment = eligibleSalary * 0.09; //the amount repaid in the year is 9% of salary above £25k threshold
		// 		totalLoan = totalLoan - annualRepayment;
		// 		if (totalLoan <= 0) {
		// 			console.log('---');
		// 			console.log('loanDuration = '+loanDuration);
		// 			console.log('totalLoan = '+totalLoan);
		// 			console.log('annualRepayment = '+annualRepayment);
		// 			console.log('breack');
		//
		// 			break; // loan has been repaid
		// 		}
		// 	}
		// 	console.log('loanDuration = '+loanDuration);
		// 	console.log('totalLoan = '+totalLoan);
		// 	console.log('annualRepayment = '+annualRepayment);
		// }


		var yearsToRepay = loanDuration;
		var totalRepaymentAmount = parseInt(loan_total);
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


