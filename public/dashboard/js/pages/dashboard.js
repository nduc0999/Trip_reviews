
var optionsPostall = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300,
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: '',
		data: [],
	}],
	colors: '#435ebe',
	xaxis: {
		categories: [],
	},
}
let piePost  = {
	series: percentPost,
	labels: ['Homestay', 'Resort'],
	colors: ['#435ebe','#55c6e8'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '30%'
			}
		}
	}
}

var optionsPost = {
		series: [
		{
		name: "Homestay",
		data: []
		},
		{
		name: "Resort",
		data: []
		},
		
	],
		chart: {
		height: 350,
		type: 'line',
		dropShadow: {
		enabled: true,
		color: '#000',
		top: 18,
		left: 7,
		blur: 10,
		opacity: 0.2,
		
		},
		toolbar: {
		show: true
		}
	},
	colors: ['#77B6EA', '#545454'],
	dataLabels: {
		enabled: false,
	},
	stroke: {
		curve: 'smooth'
	},
	title: {
		text: 'Bieu do so luong Homestay-Resort',
		align: 'left',
		
	},
	grid: {
		borderColor: '#e7e7e7',
		row: {
		colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
		opacity: 0.5
		},
	},
	markers: {
		size: 1
	},
	xaxis: {
		categories: [],
		title: {
		text: 'Thang-nam'
		}
	},
	yaxis: {
		title: {
		text: 'So luong'
		},
		
	},
	legend: {
		position: 'top',
		horizontalAlign: 'right',
		floating: true,
		offsetY: -25,
		offsetX: -5,
		 
	}
};

	
var optionsTotalReview = {
        series: [{
            name: "",
            data: [],
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'So luong Danh gia',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: [],
        }
};

var optionsTotalUser = {
	series: [{
		name: 'series1',
		data: dataUser.data
	}],
	chart: {
		height: 80,
		type: 'area',
		toolbar: {
			show:false,
		},
	},
	colors: ['#5350e9'],
	stroke: {
		width: 2,
	},
	grid: {
		show:false,
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		
		categories: dataUser.categories,
		axisBorder: {
			show:false
		},
		axisTicks: {
			show:false
		},
		labels: {
			show:false,
		}
	},
	show:false,
	yaxis: {
		labels: {
			show:false,
		},
	},
	
};

var optionsPieUser = {
	series: percentUser,
	labels: ['Hoạt động', 'Cấm đánh giá'],
	colors: ['#72f776','#f2735c'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '50%'
			}
		}
	}
	};



	var chartPostAll = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsPostall);
	var chartPostLine = new ApexCharts(document.querySelector("#chart-post-line"), optionsPost);
    var chartTotalReview = new ApexCharts(document.querySelector("#chart-total-review"), optionsTotalReview);
	var chartPiePost = new ApexCharts(document.getElementById('chart-pie-post'), piePost)
	
	var chartUserTotal = new ApexCharts(document.querySelector("#chart-area-user"), optionsTotalUser);
	var chartPieUser = new ApexCharts(document.querySelector("#chart-pie-user"), optionsPieUser);
	chartPieUser.render();
	chartUserTotal.render();
	chartPostAll.render();
	chartPostLine.render();
	chartTotalReview.render();
	chartPiePost.render()

$(document).ready(function () {
	var todayDate = new Date().toISOString().slice(0, 10);
	var d = new Date(todayDate);
	d.setMonth(d.getMonth() -6);
	$('#date-from').val(d.toISOString().slice(0, 10));
	$('#date-from').attr('max', todayDate);

	$('#date-to').val(todayDate);
	$('#date-to').attr('max', todayDate);
	$('#date-to').attr('min', $('#date-from').val());
	
	loadChart();
})

function loadChart() {
	
	var data = {
		column: [],
		line: {
			homestay: [],
			resort: [],
		},
		reviewLine:[],
	};
	var categories = {
		column: [],
		line: [],
		reviewLine: [],
	};

	$.ajax({
		url: config.routes.loadChart,
		type: "GET",
		data: {
			dateFrom: $('#date-from').val(),
			dateTo: $('#date-to').val(),
			filter: $('#filter-chart').val(),
		},
		success: function (result) {
			console.log(result);
			
			if (result.status) {
				
				result.posts.forEach(element => {
					let obj = {
						x: element.month + '-' + element.year,
						y: element.data,
					}
					categories.column.push( element.month? element.month + '-' + element.year: element.year);
					data.column.push(obj);	
				});
				chartPostAll.updateSeries([{
					name: 'Số lượng',
					data: data.column
				}]);
				chartPostAll.updateOptions({
					xaxis: {
						categories: categories.column
					}
				});
					
				result.homestay.forEach(e => {
					data.line.homestay.push(e.data);
					categories.line.push(e.categories);
				});
	
				result.resort.forEach(e => {
					data.line.resort.push(e.data);
				});
				
				chartPostLine.updateSeries([
					{
						name: "Homestay",
						data: data.line.homestay
					},
					{
						name: "Resort",
						data: data.line.resort
					},
				]);
				chartPostLine.updateOptions({
					xaxis: {
						categories: categories.line
					}
				});
				
				result.totalReview.forEach(e => {
					data.reviewLine.push(e.data);
					categories.reviewLine.push(e.month? e.month + '-' + e.year : e.year);
				});
				console.log(result.totalReview);
				chartTotalReview.updateSeries([{
					name: "Số lượng",
					data: data.reviewLine,
				}]);
				chartTotalReview.updateOptions({
					xaxis: {
						categories: categories.reviewLine,
					}
				});
			} else {
				console.log(result.mess);
			}
			
		}
	})
}



$('#date-from').change(function () {

	$('#date-to').attr('min', $(this).val());
	loadChart();
})
$('#date-to').change(function () {
	$('#date-from').attr('max', $(this).val());
	loadChart();
})
$('#filter-chart').change(function () {
	loadChart();
})