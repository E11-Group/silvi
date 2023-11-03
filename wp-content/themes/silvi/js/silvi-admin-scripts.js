jQuery(document).ready(function($){
 dynamic_title_repeater_accordion('ppg_gallery_item', 'title');

    $().fancybox({
        selector : '.silviAdmin__seeModuleExample',
        loop : false,
        arrows : false,
        keyboard : false,
        touch : false,
        wheel : false
    });

    $('.layout[data-layout]').each(function(){
         var $data_layout = $(this).attr('data-layout');
         if ($data_layout !== ''){
             $(this).find('.acf-fc-layout-controls').append('<a href="'+localized.siteurl+'/wp-content/themes/silvi/images/module-examples/'+$data_layout+'.png" class="silviAdmin__seeModuleExample">See example</a>');
         }
    });
});



//Function added to update the ACF accordion heading
function dynamic_title_repeater_accordion(repeater_name, field_name) {
  var information_tabs = jQuery("div[data-name='" + repeater_name + "']");
  if (information_tabs.length) {
      var selector = "tr:not(.acf-clone) td.acf-fields .acf-accordion-content div[data-name='" + field_name + "'] input, tr:not(.acf-clone) td.acf-fields .acf-accordion-content div[data-name='" + field_name + "'] textarea";
      jQuery(information_tabs).on('input', selector, function () {
          var me = jQuery(this);
          var accordionTitle = me.closest('.acf-accordion-content').prev('.acf-accordion-title').find('label');
          accordionTitle.text(me.val().replace(/(<([^>]+)>)/gi, ''));
      });

      information_tabs.find(selector).trigger('input');
  }
}