(function($) {
  'use strict';
  $(function() {
    $('#order-listing').DataTable({
      "pagingType": "simple",
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "iDisplayLength": 5,
      "drawCallback": function( settings ) {
        document.getElementById('order-listing_previous').querySelector('a').innerHTML = '<i class="fa fa-angle-left"></i>';
        document.getElementById('order-listing_next').querySelector('a').innerHTML = '<i class="fa fa-angle-right"></i>';
      }
    });
  });
})(jQuery);