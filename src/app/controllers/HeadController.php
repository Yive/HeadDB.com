<?php

class HeadController extends \Phalcon\Mvc\Controller {

    public function indexAction() {
        $this->view->disable();
        $url = json_decode(base64_decode($this->request->get("url")),true);
        include_once __DIR__ . '/../helpers/skin/render.php';
        header("Content-Type: text/plain");

        $player = new render3DPlayer($url['textures']['SKIN']['url'], '-29', '45', '0', '0', '0', '0', '0', 'true', 'true', 'base64', '10', 'true', 'true'); //render3DPlayer(user, vr, hr, hrh, vrll, vrrl, vrla, vrra, displayHair, headOnly, format, ratio, aa, layers)
        echo $player->get3DRender();
    }

}

