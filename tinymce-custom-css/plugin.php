<?php

class pluginTinyMCECustomCSS extends Plugin
{
    private $loadOnController = ['new-content', 'edit-content'];

    public function init() {}

    public function adminBodyEnd()
    {
        if (!in_array($GLOBALS['ADMIN_CONTROLLER'], $this->loadOnController)) return false;

        $file = $this->phpPath() . 'css/editor.css';
        $cssUrl = $this->htmlPath() . 'css/editor.css?' . filemtime($file);

        return '<script>
(function(){
    var u=' . json_encode($cssUrl) . ',a=0,t=setInterval(function(){
        if(window.tinymce){
            var e=tinymce.get("jseditor");
            if(e&&e.dom){e.dom.loadCSS(u);clearInterval(t);return;}
        }
        if(++a>=50)clearInterval(t);
    },200);
})();
</script>';
    }
}

