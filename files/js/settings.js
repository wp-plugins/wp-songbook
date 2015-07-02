
jQuery(document).ready(function($){
    
    var changed=0;
    
    function stopworking(event){
        event.preventDefault();
        return false;
    }
    
    function setchanged(){
        changed=changed+1;
    }
    
    jQuery('#shcdefs_listpageid .right select').on('load change',function(){
        
        if(!jQuery('#shcdefs_listpageid .right input[type=text]').hasClass('hidden'))
            jQuery('#shcdefs_listpageid .right input[type=text]').addClass('hidden');
        if(jQuery(this).val()==='autoaddpage')jQuery('#shcdefs_listpageid .right input[type=text]').removeClass('hidden');
    });
    
    jQuery('.button-donate').click(function(){
        
        window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted');
        
    });
    
    jQuery( ".sortable-default .tbitem" ).on('click',function(){
        jQuery(this).remove();
        var elid=jQuery(this).attr('id');
        var title=jQuery(this).html();
        jQuery( ".sortable-x" ).append('<div class="tbitem" id='+elid+'><input type="hidden" name="songbook[shcdefs_tablecont][]" value="'+elid+'"/>'+title+'</div>');
    });
    
    jQuery( ".sortable-x" ).sortable({
            axis: "x",
            placeholder: "tbitem placeholder",
            stop: setchanged
    });
    
    jQuery( 'input, select').change(setchanged);
    
    jQuery(window).on('beforeunload',function(){
        if(changed>0)return;
    });
});