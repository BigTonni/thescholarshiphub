var uiController = (function () {

	var domStrings = {
		slider_loan: '#slider_loan',
		slider_loan_val: '#slider_loan_val',
		slider_main: '#slider_main',
		slider_main_val: '#slider_main_val',
		slider_salary: '#slider_salary',
		slider_salary_val: '#slider_salary_val',
		courseDuration: '#duration_course',
		calcButton: '#calc_repayment',
		yearsToRepay: '.yearsToRepay',
		pieChart: '.pie-chart',
		amountRepaid: '#amount-repaid',
	}

	return {
		getDomStrings: function () {
			return domStrings;
		},

		updateSliderVal: function (sliderId, sliderValue) {

			if (sliderId.includes('loan')) {
				document.querySelector(domStrings.slider_loan_val).value = sliderValue;
			} else if (sliderId.includes('salary')) {
				document.querySelector(domStrings.slider_salary_val).value = sliderValue;
			} else if (sliderId.includes('main')) {
				document.querySelector(domStrings.slider_main_val).value = sliderValue;
			}
		},

		updateSliderPosition: function (sliderId, sliderValue) {
			if (sliderId.includes('loan')) {
				document.querySelector(domStrings.slider_loan).value = sliderValue;
			} else if (sliderId.includes('salary')) {
				document.querySelector(domStrings.slider_salary).value = sliderValue;
			} else if (sliderId.includes('main')) {
				document.querySelector(domStrings.slider_main).value = sliderValue;
			}
		},

		pieChartUnitConversion: function (valueAmount, valueLimit) {
			return Math.round(valueAmount / valueLimit * 100);
		},

		updatePieChart: function (yearsTillPaidOff) {
			document.querySelector(domStrings.yearsToRepay).innerHTML = yearsTillPaidOff;


			var yearsToRepayPieValue = this.pieChartUnitConversion(yearsTillPaidOff, 30);


			jQuery(domStrings.pieChart).easyPieChart({
				animate: {
					duration: 500,
					enabled: true
				},
				size: 160,
				barColor: '#0ece71',
				scaleColor: false,
				scaleLength: 0,
				trackColor: false,
				lineWidth: 16,
				lineCap: 'square'
			});

			jQuery(domStrings.pieChart).data('easyPieChart').update(yearsToRepayPieValue);
		},

		updateRepaidAmount: function(amountRepaid, yearsTillPaidOff) {
			
          	

			if (yearsTillPaidOff == 30) {
              
              var amountRepaidRounded = Math.round(amountRepaid);
				var amountPaid = '<span id="amount-repaid-number">£' + this.numberWithCommas(amountRepaidRounded) + '</span>';
				document.querySelector(domStrings.amountRepaid).insertAdjacentHTML('beforeend', amountPaid);
              
              	var html = '<div id="no-repayment-text"><p>After 30 years, any remaining debt is wiped, the above number is how much you would have paid off before that.</p><p>Try increasing starting salary to see when you could fully pay off the debt.</p></div>';
				document.querySelector(domStrings.amountRepaid).insertAdjacentHTML('beforeend', html);
			} else {
              
				var amountRepaidRounded = Math.round(amountRepaid);
				var html = '<span id="amount-repaid-number">£' + this.numberWithCommas(amountRepaidRounded) + '</span>';
				document.querySelector(domStrings.amountRepaid).insertAdjacentHTML('beforeend', html);
            }
		},

		resetApp: function () {
			var el = document.getElementById("no-repayment-text");
			if (el) {
				el.parentNode.removeChild(el);
			}

			var amountRepaid = document.getElementById('amount-repaid');
			if (amountRepaid.children.length > 0) {
				amountRepaid.removeChild(document.getElementById('amount-repaid-number'));
			}
		},

		numberWithCommas: function(x) {
			x = x.toString();
			var pattern = /(-?\d+)(\d{3})/;
			while (pattern.test(x))
			x = x.replace(pattern, "$1,$2");
			return x;
		}


	};
})();

var calcController = (function () {

	var values = {
		totalLoan: 0,
		interestRate: 0.03,
		inflationRate: 0.03,
		salaryIncrease: 0.05,
		monthlyInterest: 0,
		minSalary: 25000,
		repaymentPercent: 0.09,
		cumulativeRepayments: 0,
	}

	return {
		setValues: function (totalLoanValue, startingSalaryValue, courseDuration) {
			values.totalLoan = totalLoanValue * courseDuration;
			values.cumulativeTotal = values.totalLoan;
			values.salary = startingSalaryValue;
		},
      
      	resetValues: function() {
        	values.totalLoan = 0,
          	values.cumulativeRepayments = 0,
            values.monthlyInterest = 0,
            values.monthlyRepayments = 0
        },

		totalRepayment: function () {

			var valObj = {};

			for (var i = 1; i < 360; i++) {
				// console.log(i);


				values.monthlyInterest = values.totalLoan * ((values.interestRate + values.inflationRate) / 12);

				values.totalLoan += values.monthlyInterest;

				values.cumulativeTotal += values.monthlyInterest;

				if (i % 12 === 0) {
					values.salary += (values.salary * values.salaryIncrease);
				}

				 /*console.log('salary ' + values.salary);
				 console.log('total loan ' + values.totalLoan);
				 console.log('monthly interest ' + values.monthlyInterest);
				 console.log('cumulative total ' + values.cumulativeTotal);*/

				if (values.salary > values.minSalary) {
					var eligibleSalary, monthlyRepayment;

					eligibleSalary = values.salary - values.minSalary;

					monthlyRepayment = (eligibleSalary / 12) * values.repaymentPercent;
					 console.log('monthly repayment ' + monthlyRepayment);
					values.cumulativeRepayments += monthlyRepayment;

					values.totalLoan -= monthlyRepayment;

				}

				loanDuration = i + 1;

				if (values.totalLoan <= 0) {
					// console.log('paid off');
					break;
				}
			}

			valObj.loanDuration = Math.ceil(loanDuration / 12);
			valObj.cumulativeTotal = values.cumulativeRepayments;
			return valObj;
		}
	};

})();

var controller = (function (uiCtrl, calcCtrl) {

	var domStrings = uiCtrl.getDomStrings();

	var setupEventListeners = function () {

		//Slider loan 
		document.querySelector(domStrings.slider_loan).addEventListener('input', ctrlUpdateSliderVal)

		//Slider main 
		document.querySelector(domStrings.slider_main).addEventListener('input', ctrlUpdateSliderVal)

		//Slider salary
		document.querySelector(domStrings.slider_salary).addEventListener('input', ctrlUpdateSliderVal)

		//Slider loan value typed
		document.querySelector(domStrings.slider_loan_val).addEventListener('keyup', ctrlUpdateSliderPosition);

		//Slider main value typed
		document.querySelector(domStrings.slider_main_val).addEventListener('keyup', ctrlUpdateSliderPosition);

		//Slider salary value  types
		document.querySelector(domStrings.slider_salary_val).addEventListener('keyup', ctrlUpdateSliderPosition);

		//Course duration change
		document.querySelector(domStrings.calcButton).addEventListener('click', ctrlCalculate)
	}

	var ctrlUpdateSliderVal = function () {
		uiCtrl.updateSliderVal(this.id, this.value);

	}

	var ctrlUpdateSliderPosition = function () {
		var sliderMin, sliderMax, sliderValue;

		sliderMin = parseInt(this.getAttribute("min"));
		sliderMax = parseInt(this.getAttribute("max"));
		sliderValue = this.value;

		if (sliderValue >= sliderMin && sliderValue <= sliderMax) {
			//update slider
			uiCtrl.updateSliderPosition(this.id, sliderValue);

		} else {
			//change value to min or max
			if (sliderValue >= (sliderMax / 2)) {
				uiCtrl.updateSliderVal(this.id, sliderMax);
			} else if (sliderValue < sliderMin) {
				uiCtrl.updateSliderVal(this.id, sliderMin);
			}
		}

	}

	var ctrlCalculate = function () {

		var loanValue, mainValue, salaryValue, totalLoan, courseDuration, yearsTillPaidOff;

		uiCtrl.resetApp();
      	calcCtrl.resetValues();

		loanValue = parseInt(document.querySelector(domStrings.slider_loan_val).value);
		mainValue = parseInt(document.querySelector(domStrings.slider_main_val).value);
		salaryValue = parseInt(document.querySelector(domStrings.slider_salary_val).value);
		courseDuration = parseInt(document.querySelector(domStrings.courseDuration).value)

		if (loanValue && salaryValue && mainValue) {
			totalLoan = loanValue + mainValue;

			calcCtrl.setValues(totalLoan, salaryValue, courseDuration);
			calcResults = calcCtrl.totalRepayment();
			uiCtrl.updatePieChart(calcResults.loanDuration);

			uiCtrl.updateRepaidAmount(calcResults.cumulativeTotal, calcResults.loanDuration);
		}

	}


	return {
		init: function () {
			console.log('Student Loan Calculator running.');
			setupEventListeners();
		}
	};

})(uiController, calcController);

controller.init();