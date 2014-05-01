function filebox_tooltips(){
    $('#songbook_addfile_button').attr('title',songbook_tooltips_script.songbook_addfile_button);
    $('.textch').attr('title',songbook_tooltips_script.textch);
    $('.lock').attr('title',songbook_tooltips_script.lock);
    $('.remover').attr('title',songbook_tooltips_script.remover);
    $('#songbook_files').tooltip({track:true});
}
function addinfo_tooltips(){
    $('.songbook_tempo_meta').attr('title',songbook_tooltips_script.songbook_tempo_meta);
}
jQuery(document).ready(function($){
    $(function() {
        if(typenow==='song'){
           filebox_tooltips();
        }
    
  });
});