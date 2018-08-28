$(document).ready(function(){
	getRateChart();


	var countChartRevenue = 0;
    $('.btnChangeChartRevenueNext').click(function(){
    	switch(countChartRevenue){
    		case 0:
    			$('#chartRevenue01').css('left','-50%');
	    		$('#chartRevenue02').css('left','50%');
	    		$(this).text(' 1 năm >>');
	    		countChartRevenue = 1;
	    		$('.btnChangeChartRevenuePre').css('display','block');
	    		$('.btnChangeChartRevenuePre').text('<< 1 tháng');
    			break;
    		case 1:
	    		$('#chartRevenue02').css('left','-50%');
	    		$('#chartRevenue03').css('left','50%');
	    		$(this).text('<< 3 tháng');
	    		countChartRevenue = 2;
	    		$('.btnChangeChartRevenuePre').css('display','none');
	    		break;
	    	case 2:
	    		$('#chartRevenue02').css('left','50%');
	    		$('#chartRevenue03').css('left','150%');
	    		$(this).text('1 năm >>');
	    		countChartRevenue = 1;
	    		$('.btnChangeChartRevenuePre').css('display','block');
	    		break;
	    	default:
	    		alert('error');
	    		break;
    	};
    	
    });
    $('.btnChangeChartRevenuePre').click(function(){
    	$('#chartRevenue01').css('left','50%');
		$('#chartRevenue02').css('left','150%');
		$(this).css('display','none');
		countChartRevenue = 0;
		$('.btnChangeChartRevenueNext').text('3 tháng >>');
    });
});



function getRateChart (){
	var rate = $('.rateChartRightItem');
	for (var i = 0; i < rate.length; i++) {
		var rateValue = rate.eq(i).find('.rateChartRightItemValue').text();
		rateValue *= 100;
		rate.eq(i).find('.rateChartRightItemLineActive').css('width', rateValue+'%');

	}
}