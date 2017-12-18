$(document).ready(function(){
  var date_input=$('input[name="date"]'); //our date input has the name "date"
  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
  var options={
    format: 'mm/dd/yyyy',
    container: container,
    todayHighlight: true,
    autoclose: true,
  };
  date_input.datepicker(options);
})

$(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

$('.override-monster').on('change', function(){
  console.log($('.override-monster .selected').text());
  var selectedOption = $('.override-monster .selected').text();
    if(selectedOption == "Create new set") {
      $('#editStudentImageModal').modal('hide');
      $('#createNewImageSetModal').modal('show');
    }
});

/*My Institute modal - parents - connection circular progress bar - START*/
var defValue = $(".meter input").attr("value");
// var defAngle = $("input").attr("value") * 3.6;

if ( defValue < 50 ) {
  var defAngle = defValue * 3.6 + 90 + "deg";
  // $(".print").text(defAngle);
  $(".percent").css({
    "background-image": "linear-gradient(90deg, #efefef 50%, transparent 51%, transparent), linear-gradient( "+defAngle+", rgb(147, 213, 83) 50%, #efefef 51%, #efefef)"
  });
} else {
  var defAngle = ( defValue - 50 ) * 3.6 - 90 + "deg";
  // $(".print").text(defAngle);
  $(".percent").css({
    "background-image": "linear-gradient("+defAngle+", rgb(147, 213, 83) 50%, transparent 51%, transparent), linear-gradient(270deg, rgb(147, 213, 83) 50%, #efefef 51%, #efefef)"
  });
}

$('.connection-percent').prepend(defValue);

$('input[type=checkbox][name=quietHours]').change(function() {
    alert('help'); 
});

$("#quietHours").change(function(){
    if($(this).prop("checked")){
       $('.hours-duration').show();
    }else{
       $('.hours-duration').hide();
    }
});

$("#commentToggle").change(function(){
    if(!($(this).prop("checked"))) {
      $('#commentsModal').modal('show');
    }
    
});


/*$('#editPositiveTab .points-content .points-panel').hover(
  function() {
    var src = $('#editPositiveTab .points-content .points-panel .panel-body > img').attr('src');
    console.log(src);
  },
  function() {
    console.log("mouse release");
  }
);
*/
var parentAccountvalue = 57866;
var parentAccountMaxValue = 80000;

var parent_account_ctx = document.getElementById('parent-account-chart');
var bar_chart = new Chart(parent_account_ctx, {
  type: 'horizontalBar',
  data: {
    labels: [],
    datasets: [{
      data: [parentAccountvalue],
      backgroundColor: "rgb(0, 174, 239)"
    }, {
      data: [parentAccountMaxValue - parentAccountvalue],
      backgroundColor: "lightgrey",
    }, ]
  },
  options: {
    legend: {
      display: false
    },
    tooltips: {
      enabled: false
    },
    scales: {
      xAxes: [{
        display: false,
        stacked: true
      }],
      yAxes: [{
        display: false,
        stacked: true
      }],
    } // scales
  } // options
});

var studentAccountvalue = 30000;
var studentAccountMaxValue = 80000;

var student_account_ctx = document.getElementById('student-account-chart');
var bar_chart = new Chart(student_account_ctx, {
  type: 'horizontalBar',
  data: {
    labels: [],
    datasets: [{
      data: [studentAccountvalue],
      backgroundColor: "rgb(0, 174, 239)"
    }, {
      data: [studentAccountMaxValue - studentAccountvalue],
      backgroundColor: "lightgrey",
    }, ]
  },
  options: {
    legend: {
      display: false
    },
    tooltips: {
      enabled: false
    },
    scales: {
      xAxes: [{
        display: false,
        stacked: true
      }],
      yAxes: [{
        display: false,
        stacked: true
      }],
    } // scales
  } // options
});