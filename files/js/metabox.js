jQuery(document).ready(function(){
    var navel=jQuery('#song_meta .nav span:first-child');
    navel.addClass('active');
    var navelid=navel.attr('id');
    
    jQuery('#song_meta #'+navelid).addClass('active');
    
    jQuery('#song_meta .nav span').on('click',function(){
        var ident=jQuery(this).attr('id');
        jQuery('#song_meta .section.active').removeClass('active');
        jQuery('#song_meta .nav span.active').removeClass('active');
        
        jQuery('#song_meta .nav span#'+ident).addClass('active');
        jQuery('#song_meta .section#'+ident).addClass('active');
        
    });
    
});