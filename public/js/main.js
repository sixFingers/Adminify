$(document).ready(function() {
  $('[data-action=toggle-field]').change(function() {
    $field = $(this).attr('data-target');
    $index = $('th[data-field='+$field+']').index() +1;
    $('th:nth-child('+$index+'), td:nth-child('+$index+')').toggle();
  });

  /* Table initialisation */
  $(document).ready(function() {
    $('table').dataTable({
      "sDom": "<'row'<'span8'l><'span8'f>r>t<'row'<'span8'i><'span8'p>>",
      "bPaginate": false,
      "oLanguage": {
        "sLengthMenu": "_MENU_ records per page"
      }
    });
  });
});