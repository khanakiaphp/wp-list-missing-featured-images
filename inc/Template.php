<?php
namespace ListMissingFeaturedImage;

class Template {
    function __construct() {
   		
        $loader = new \Twig\Loader\FilesystemLoader(plugin_dir_path(__FILE__).'./../views');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        $this->twig = $twig;
   }

}
