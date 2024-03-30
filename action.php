<?php

use dokuwiki\Extension\ActionPlugin;
use dokuwiki\Extension\EventHandler;
use dokuwiki\Extension\Event;

/**
 * DokuWiki Plugin secedit2head (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author Jef Shilt <github@fortytwo-it.com>
 */
class action_plugin_secedit2head extends ActionPlugin
{
    /** @inheritDoc */
    public function register(EventHandler $controller)
    {
        $controller->register_hook('TPL_ACT_RENDER', 'AFTER', $this, 'handleTplActRender');
    }

    /**
     * Event handler for TPL_ACT_RENDER
     *
     * @see https://www.dokuwiki.org/devel:events:TPL_ACT_RENDER
     * @param Event $event Event object
     * @param mixed $param optional parameter passed when event was registered
     * @return void
     */
    public function handleTplActRender(Event $event, $param)
    {
?>
<script>
    // first, make sure jQuery has loaded
    var secedit2head_jQueryLoaded = setInterval(function(){
        if (typeof jQuery !== "undefined") {
            clearInterval(secedit2head_jQueryLoaded);
            var secedit2head_sections = jQuery(".editbutton_section").length;
            // second, wait for page.js to have setup section wrappers
            var secedit2head_PageJSLoaded = setInterval(function(){
                var secedit2head_wrappers = jQuery(".section_highlight_wrapper").length;
                if (secedit2head_wrappers == secedit2head_sections) {
                    clearInterval(secedit2head_PageJSLoaded);
                    jQuery(".editbutton_section").each(function() {
                        var se2h_matched = jQuery(this).prop("class").match(/editbutton_(\d+)/);
                        if (se2h_matched[1]) {
                            var secedit2head_btn = jQuery(this).remove();
                            // find section header and append btn node
                            jQuery(".sectionedit" + se2h_matched[1]).prepend(secedit2head_btn);
                            secedit2head_btn.on("mouseover", function(){jQuery(this).parents(".section_highlight_wrapper").addClass("section_highlight");}
                            ).on("mouseout", function(){jQuery(this).parents(".section_highlight_wrapper").removeClass("section_highlight");});
                        }
                    });
                }
            },10);
        }
    },10);
</script>
<?php
    }
}
