<script>
$j(function() {
	$j("[id*='-children']").parent().removeClass();
});
</script>
<script>
  $j('input[type="checkbox"]').each(function() {
    var input = $j(this),fg = input.closest('.form-group'), right = fg.children('.col-lg-offset-3');
    var container = input.closest('div.checkbox'), oldlabel = container.find('label');
    input.prependTo(right); oldlabel.prependTo(fg).append(' ').addClass('control-label').addClass('col-lg-3').append(container.find('i.glyphicon'));
    container.find('.help-block').prependTo(right); container.remove();
    var newlabel = $j('<label />').attr('value', 0).attr('for', input.attr('id')).css('font-size', '1em');
    right.removeClass('col-lg-offset-3').addClass('ckbx-style-14 ckbx-large').append(newlabel);
  })
  </script>
  
<style type="text/css">
.back-to-top {
cursor: pointer;
position: fixed;
bottom: 0;
right: 20px;
display:none;
}
.back-to-top:hover {
cursor: pointer;
position: fixed;
bottom: 0;
right: 20px;
display:inline !important;
}
</style>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Back to Top" data-toggle="tooltip" data-placement="top">
 	<span class="glyphicon glyphicon-chevron-up"></span>
</a>

 
<script src="resources/chartist-js/dist/chartjs.min.js"></script>

<script>
  $j(function() {
    $j('<i class="glyphicon glyphicon-list-alt"></i>').prependTo('.children-links a');
    $j('.children-links a > img').remove()
  })
</script>