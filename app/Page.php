<?php

namespace App;


use cebe\markdown\GithubMarkdown;
use VKBansal\FrontMatter\Parser;

/**
 * Page model constructed from a YAML file
 *
 * @package App
 */
class Page
{

    private $path;
    private $parsed_data;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property){
        if(!property_exists($this, $property)){
            $this->$property = $this->get($property);
        }
        return $this->$property;
    }

    /**
     * Render the page within the layout
     * @return string
     */
    public function render(){
        $page = $this;
        return $this->renderLayout($page->layout, $page->content);
    }

    /**
     * Get a value from the YAML file (content give the content part)
     * @param $key
     * @return null|string
     */
    public function get($key){
        if(!$this->parsed_data){
            $this->parsed_data = Parser::parse(file_get_contents($this->path));
        }
        if($key === "content"){
            $pathinfo = explode('.', pathinfo($this->path, PATHINFO_FILENAME));
            $type = end($pathinfo);
            $method = "parse_$type";
            return $this->$method($this->parsed_data->getContent());
        }
        if(!isset($this->parsed_data->getConfig()[$key])){
            return null;
        }
        if(is_array($this->parsed_data->getConfig()[$key])){
            return $this->parsed_data->getConfig()[$key];
        }
        return nl2br($this->parsed_data->getConfig()[$key]);
    }

    /**
     * Return the URL for the page based on content path
     * @return string
     */
    public function getUrl(){
        $path = str_replace(content_path, '', $this->path);
        $path = current(explode('.', $path));
        $path = str_replace('index', '', $path);
        return $path;
    }

    /**
     * Return the name of the page using . as separators, used for router
     * @return string
     */
    public function getName(){
        $name = str_replace('/', '.', $this->getUrl());
        $name = trim($name, '.');
        if(empty($name)){
            return 'home';
        }
        return $name;
    }

    /**
     * Recursive method that insert content inside the layout and check for parent layout
     * @param string $layout Name of the layout to use (starting from layouts_path)
     * @param string $content
     * @return string
     */
    private function renderLayout($layout, $content){
        if(!$layout){
            $layout = 'default';
        }
        $page = $this;
        ob_start();
        require(layouts_path . DIRECTORY_SEPARATOR . $layout . '.php');
        $content = ob_get_clean();
        if(isset($_layout)){
            return $this->renderLayout($_layout, $content);
        } else {
            return $content;
        }
    }

    /**
     * Parse content using Markdown
     * @param string $content
     * @return string
     */
    private function parse_markdown($content){
        $parser = new GithubMarkdown();
        $parser->enableNewlines = true;
        return $parser->parse($content);
    }

    /**
     * Parse content using HTML (doing nothing at the moment)
     * @param $content
     * @return mixed
     */
    private function parse_html($content){
        return $content;
    }

}