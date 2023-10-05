$( document ).ready(function() {
    $(".sidebar-dropdown > a").click(function() {
    $(".sidebar-submenu").slideUp(200);
      if (
      $(this)
        .parent()
        .hasClass("active")
    ) {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .parent()
        .removeClass("active");
    } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this)
        .next(".sidebar-submenu")
        .slideDown(200);
      $(this)
        .parent()
        .addClass("active");
    }
  });

  $(".toggle-sidebar").click(function() {
    $(".main-site").toggleClass("toggled");
  });
  $("#show-sidebar").click(function() {
   $(".main-site").addClass("toggled");
  });
     
});


$( document ).ready(function() {
  $('#TimesharePoints').owlCarousel({
      loop:true,
      margin:0,
      nav:false,
      dots:false,
      responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
  });
});

$(document).ready(function(){

    var options = {
          series: [10400, 5400, 5000,],
          labels: ['Total amount', 'Remaining amount', 'Used amount'],
          chart: {
          type: 'donut',
          height: 400,
        },
        colors: ['#353334','#0C8AFF', '#C0C0C0'],
        
        legend: {
          show: true,
          position: 'bottom',
          markers: {
            width: 7,
            height: 7,
            shape: 'square',
            radius: 0,
          }
        },
       
        };

        var chart = new ApexCharts(document.querySelector("#Timeshare-Budget-chart"), options);
        chart.render();

});




$(document).ready(function(){

    var options = {
          series: [10400, 5400, 5000,],
          labels: ['Total amount', 'Remaining amount', 'Used amount'],
          chart: {
          type: 'donut',
          height: 260,
        },
        colors: ['#353334','#0C8AFF', '#C0C0C0'],
        
        legend: {
          show: true,
          position: 'bottom',
          markers: {
            width: 7,
            height: 7,
            shape: 'square',
            radius: 0,
          }
        },
       
        };

        var chart = new ApexCharts(document.querySelector("#manage-budgets"), options);
        chart.render();

});

