<?php namespace KosmosKosmos\ContentEmailObfuscator;

use App;
use File;
use Event;
use Cms\Classes\Page;
use Cms\Classes\Content;
use System\Classes\PluginBase;
use KosmosKosmos\ContentEmailObfuscator\Classes\Obfuscator as Obfuscator;

/**
 * ContentEmailObfuscator Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Content Email Obfuscator',
            'description' => 'Obfuscates E-Mail Adresses from Contents and Pages',
            'author'      => 'KosmosKosmos',
            'icon'        => 'icon-shield'
        ];
    }

    public function registerComponents() {
        return [
        'KosmosKosmos\ContentEmailObfuscator\Components\Obfuscator' => "obfuscator"
        ];
    }



    public function boot() {

        // Do it with pages
        Event::listen('cms.page.beforeDisplay',function($controller, $url, $page){
            if (!$page) return;
            $page->markup = (Obfuscator::obfuscate($page->markup));
        });


        // Do it with contents
        Event::listen('cms.page.beforeRenderContent', function($controller, $fileName) {

            // TODO SET DIRECTORY
            $controller->addJs('/plugins/kosmoskosmos/contentemailobfuscator/assets/js/obfuscator.js');

            if (!strlen(File::extension($fileName))) $fileName .= '.htm';

            if (($content = Content::loadCached($controller->getTheme(), $fileName)) !== null) {
                $content->parsedMarkup = Obfuscator::obfuscate($content->parsedMarkup);
                return $content;
            }
        });


    }

}
