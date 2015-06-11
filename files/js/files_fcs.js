jQuery(document).ready(function($){
var def_private=$('#defaults #private').html();
$("#obal").dragsort({dragSelector:".exticon"});
$('#obal').on('click','.textch',function(){
    var elid=$(this).attr('rel');
    var newtitle=window.prompt(songbook_filebox_func.new_title);
                    if(newtitle){
                        var hrefid='href_'+elid;
                        var titleid='title_'+elid;
                        $("#"+hrefid).html(newtitle);
                        $("#"+titleid).val(newtitle);
                    }
});
$('#obal').on('click','.remover',function(){
    var elid=$(this).attr('rel');
    var remconfirm=window.confirm(songbook_filebox_func.unlink_confirm);
                    if(remconfirm){
                        var idname='file_'+elid;
                        $("#"+idname).remove();
                    }
    
});
$("#obal").on('click','.lock',function() {
    var elid=$(this).attr('rel');
       $(this).toggleClass('locked');
       $(this).toggleClass('unlocked');
    var idname='private_'+elid;
    var privvalue=$("#"+idname).val();
    if(privvalue==='private')$("#"+idname).val('public');
    if(privvalue==='public')$("#"+idname).val('private');
});
$("#obal").sortable({axis:"y",handle:".exticon",placeholder:"ui-state-highlight"});
});
function extension(url) {
    var ext=(url = url.substr(1 + url.lastIndexOf("/")).split('?')[0]).substr(url.lastIndexOf(".")).replace(".","");;
    if(ext==="jpg"||ext==="png"||ext==="bmp"||ext==="gif"){
        return"image";
    }else return ext;
};