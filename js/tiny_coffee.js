jQuery("[data-slider]").bind("slider:ready slider:changed", function (event, data) {
    var num = data.value.toFixed(0);
    var count = num/600;
    jQuery(this).nextAll("span.count").html('');
    for (var i=0;i<count;++i)
      jQuery(this).nextAll("span.count").append('<i class="icon-coffee"></i>');
    jQuery(this).nextAll("small.count2").html(num/100);
  });
