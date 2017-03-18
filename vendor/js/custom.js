function get_rows(obj)
{
 $('#row_number').empty();
 $('#table_number').empty();
 $('#table_number').append('<option value="0">Select Table</option>');
 var blocks = document.getElementById("block_number");
 var block_number = blocks.options[blocks.selectedIndex].value;
 $.ajax({
         type: "GET",
         url: "/grid_counts.php",
         data: {
           'block': block_number
         },
         success: function(msg){
           $('#row_number').append('<option value="0">Select Row</option>');
           for(var i = 1 ; i <= msg ; i++){
             $('#row_number').append('<option value="' + i+ '">' + i + '</option>');
           }
         }
     });
}

function get_tables(obj)
{
 $('#table_number').empty()
 var rows = document.getElementById("row_number");
 var row_number = rows.options[rows.selectedIndex].value;
 var blocks = document.getElementById("block_number");
 var block_number = blocks.options[blocks.selectedIndex].value;
 $.ajax({
         type: "GET",
         url: "/grid_counts.php",
         data: {
           'block': block_number,
           'row':row_number
         },
         success: function(msg){
           $('#table_number').append('<option value="0">Select Table</option>');
           for(var i = 1 ; i <= msg ; i++){
             $('#table_number').append('<option value="' + i+ '">' + i + '</option>');
           }
         }
     });
}

function toggleCurrent(event,element) {
    if (element.style.display === 'none') {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
    }
}

var $easyzoom = $('.easyzoom').easyZoom();

$('input[name="daterange"]').daterangepicker({
    opens :'left',
    autoUpdateInput: false,
    dateLimit: {
        days: 120
    },
});

$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
});

$('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
