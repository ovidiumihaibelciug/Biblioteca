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

