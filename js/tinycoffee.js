jQuery(document).ready(function(){
  window.addEventListener("hashchange", detectCoffee, false);
  detectCoffee();
  function detectCoffee(){
    if (window.location.hash==jQuery('#modal-container .modal-body').attr('data-hash')){
      openCoffee();
    }
  };
  function openCoffee(){
    jQuery('#modal-container,.modal-background').css('display','block');
    jQuery('#modal-container>article,.modal-background').addClass('in');
  };
  jQuery('.modal-background,.coffee_close').click(function(e){
    e.preventDefault();
    jQuery('#modal-container>article,.modal-background').removeClass('in');
    setTimeout("jQuery('#modal-container,.modal-background').hide();",400);
  });
  jQuery('.tiny_coffee_slider').each(function(){
    var slider = jQuery(this);
    var parent = slider.parent();
    var opt = {
      icon      : parent.attr('data-icon'),
      rate      : parent.attr('data-rate')*1,
      price     : parent.attr('data-price')*1,
      currency  : parent.attr('data-currency'),
      start     : parent.attr('data-default'),
    }
    parent.show_amount = function(val){
      parent.find('.count2').text(opt.currency.replace('%s',val*opt.price));
      parent.find('form input[name=amount]').val(Math.round(val*opt.price*opt.rate*100)/100);
      parent.find('.count').html('');
      for (var i = 0; i<val; ++i) {
        parent.find('.count').append('<i class="fa fa-'+opt.icon+'"></i>');
      }
    };
    slider.noUiSlider({
      'range':[1,10],
      'step':1,
      'start':opt.start,
      'handles':1,
      'serialization':{
        to: [
          [parent.find('.count2'),parent.show_amount]//,
          //[parent.find('form input[name=amount]'),parent.write_amount]
        ],
        resolution:1
      }
    });
  });
});