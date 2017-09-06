<?php

class IndexController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle("HeadDB");
    }

    public function indexAction() {
        $this->tag->prependTitle("Index - ");
 
    }

}

