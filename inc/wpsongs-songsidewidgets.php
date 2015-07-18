<?php
class songbook_widgets{
    /* songbook_widgets class is adding feature of adding extra links under song */
    
    // first ask options if widgets are allowed
    protected $allow_widgets;
    // require string which will be replaced with widgets eg. new songbook_widgets("relatedsongs albumsongs authorsongs latestsongs")
    private $placed;
    // get the HTML structure for widgets
    private $structure_beforeall;
    private $structure_afterall;
    private $structure_beforewidg;
    private $structure_afterwidg;
    
    public function songbook_widgets($where=''){
        if(!isset($where))return'';
        $this->allow_widgets=get_option('songbook_enable_songwidgets');
        $this->placed=$where;
        
        $this->structure_beforeall='<div>';
        $this->structure_afterall='</div>';
        $this->structure_beforewidg='<div>';
        $this->structure_afterwidg='</div>';
    }
    
    public function widgcont() {
        if(!isset($this->allow_widgets)||!isset($this->placed))return'';
        $widgets=explode(' ',$this->placed);
        
        $result='<div id="sbwidgets">';
        if(is_array($widgets)){
            foreach ($widgets as $widget){
                $result.=$this->structure_beforewidg;
                $result.=$this-
                     
                        $widget();
                $result.=$this->structure_afterwidg;
            }
        }
        $result.='</div>';
    }
}