(function($) {
  "use strict";
 
  /* Load More AJAX
  -------------------------------------------------------*/
  $('.deo-loadmore').on('click', function(){

    let button = $(this);

    if ( ! button.is('.clicked') ) {
      button.addClass('clicked');

      let data = {
        'action': 'loadmore',
        'security': meridia_loadmore_params.ajax_nonce,
        'query': meridia_loadmore_params.posts,
        'page' : meridia_loadmore_params.current_page,
        'layout': meridia_loadmore_params.layout,
        'sidebar_on': meridia_loadmore_params.sidebar_on
      };

      $.ajax({
        url : meridia_loadmore_params.ajax_url,
        data : data,
        type : 'POST',
        beforeSend : function ( xhr ) {
          button.addClass('deo-loading');
          button.append('<div class="deo-loader"><div></div></div>');
        },
        success : function( data ){
          if( data ) { 
            button.removeClass('deo-loading clicked');
            button.find('.deo-loader').remove();

            // Grid
            if ( $('.grid-layout') ) {
              $('.grid-layout .row').append(data);
            }

            // List 
            if ( $('.list-layout') ) {
              $('.list-content').append(data);
            }
            
            if ($('.sidebar-on')) {
              $('.sidebar-on .col-lg-4').removeClass('col-lg-4').addClass('col-lg-6');
            }          

            meridia_loadmore_params.current_page++;

            if ( meridia_loadmore_params.current_page == meridia_loadmore_params.max_page ) 
              button.remove();

          } else {
            button.remove();
          }
        }
      });

    }

    return false;

  });

})(jQuery);