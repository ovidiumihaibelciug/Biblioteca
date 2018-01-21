// TODO: Refactor
$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                            '<td>'+col.title+':'+'</td> '+
                            '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');

                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            }
        }
    } );
    $('#successAlert').on('click', function() {
        console.log("asd");
        $(this).fadeOut();
    });
} );

var currentTime = new Date();
var year = currentTime.getFullYear();
year += " © Colegiul Naţional \"Garabet Ibraileanu\" Iaşi.";
$('.year').text(year);

var $item = $('.carousel .item'); 
var $wHeight = $(window).height();
$item.eq(0).addClass('active');
$item.height($wHeight); 
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});

$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});

   var scroll_start = 0;
   var startchange = $('#main');
   var offset = startchange.offset();
    if (startchange.length){
   $(document).scroll(function() { 
      scroll_start = $(this).scrollTop();
      if(scroll_start > offset.top - 100) {
          $(".navbar").addClass('navbar-main');
       } else {
          $('.navbar').removeClass('navbar-main');
       }
   });
   $('.scroll').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $('#main').offset().top}, 500, 'linear');
  });
}