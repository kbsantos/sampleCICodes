//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('.sidebar-nav ul.nav a').filter(function() {
     return this.href == url;
    }).addClass('active').parent().parent().addClass('in').parent();
    
    var element = $('.sidebar-nav ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    };
    
    $('.sidebar-nav').metisMenu();
    
    
    // Bootstrap Datepicker Init
    $('.datepicker').datepicker({
        autoclose: true
    });
    
    // $('.datepicker').on('change', function(){
    //     console.log($(this).data('datepicker').viewDate);
    // });
    
    // Select 2 fix for cant enter anything on input (tabindex issue)
    $('#org-list').click(function(){
      $('#model-add-organization').on('shown.bs.modal', function(){
        $(this).removeAttr('tabindex')
      })
    });    
    
    $('#add-new-customer').click(function(){
      $('#modal-add-new-customer').on('shown.bs.modal', function(){
        $(this).removeAttr('tabindex')
      })
    });    
    
    
    // Bootstrap Select
    $('.selectpicker').selectpicker();

});
