/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {
    
    let win = $(window);
    let w = win.width();
    
    let body = $('body');
    let btn = $('#sidebarToggle');
    let sidebar = $('.sidebar');
    
    // Collapse on load
    
    if (win.width() < 992) {
        sidebar.addClass('collapsed');
    }
    
    sidebar.removeClass('mobile-hid');
    
    // Events
    
    btn.click(toggleSidebar);
    
    win.resize(function() {
        
        if (w==win.width()) {
            return;
        }
        
        w = win.width();
        
        if (w < 992 && !sidebar.hasClass('collapsed')) {
            toggleSidebar();
        } else if (w > 992 && sidebar.hasClass('collapsed')) {
            toggleSidebar();
        }
    });
    
    function toggleSidebar() { 
        
        if (win.width() < 992 || !sidebar.hasClass('collapsed')) {
            body.animate({'padding-left':'0'},100);
        }
        else if (win.width() > 992 && sidebar.hasClass('collapsed')) {
            body.animate({'padding-left':'14rem'},100);
        }
        
        if (!sidebar.hasClass('collapsed')) {
            sidebar.fadeOut(100,function(){
                btn.hide();
                sidebar.addClass('collapsed');
                btn.fadeIn(100);
            });
        }
        else {
            sidebar.removeClass('collapsed');
            sidebar.fadeIn(100);
        }
       
    }
})(jQuery)