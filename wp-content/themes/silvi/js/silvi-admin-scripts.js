jQuery(document).ready(function($){
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
