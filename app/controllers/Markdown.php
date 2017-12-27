<?php
/**
 * Created by PhpStorm.
 * User: BM
 */
use Library\Core\Controller;

class MarkdownController extends Controller{

    public $_layout = "markdown_layout";

    public function indexAction(){
        $md = isset($_GET['md']) ? trim($_GET['md']) : "php-yajl";

        $parser = new System_Parsedown();
        $markdown = file_get_contents(APPLICATION_PATH."/data/doc/{$md}.md");
        $html = $parser->parse($markdown);

        // $this->getView()->assign("content",  $html);
        $content = $this->render('index', ['content' => $html]);
        $this->getView()->display('markdown_layout.phtml',['content' => $content]);
    }
}