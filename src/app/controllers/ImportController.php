<?php

class ImportController extends \Phalcon\Mvc\Controller {

    public function indexAction() {
        // TO-DO | Will probably need help figuring out the best method to maybe allow this to be public.
    }

    public function importAction() {
        $this->view->disable();
        header("Content-Type: application/json");
        if ($this->request->get('verify') != $this->config->application->verify) {
            return 'Invalid Request';
        } else {
            $redis = new Redis();
            $redis->pconnect($this->config->application->redis->host);
            $displayName = $this->request->get('displayName') ?: false;
            $category = $this->request->get('category') ?: false;
            $texture = $this->request->get('texture') ?: false;
            if(!$displayName) {
                return 'invalid displayName';
            } elseif(!$category) {
                return 'invalid category';
            } elseif(!$texture) {
                return 'invalid texture';
            } else {
                $displayName = filter_var($displayName ,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                $category = filter_var($category ,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                $texture = filter_var($texture ,FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                if(!strpos($texture, 'http://textures.minecraft.net/texture/') || !strpos($texture, 'https://textures.minecraft.net/texture/')) {
                    return 'invalid texture';
                }

                // Credit to https://gist.github.com/games647/2b6a00a8fc21fd3b88375f03c9e2e603
                // Edited to work with HeadDB though.
                function constructOfflinePlayerUuid($username) {
                    $data = random_bytes(16);
                    $data[6] = chr(ord($data[6]) & 0x0f | 0x30);
                    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
                    $striped = bin2hex($data);
                    $components = array(
                        substr($striped, 0, 8),
                        substr($striped, 8, 4),
                        substr($striped, 12, 4),
                        substr($striped, 16, 4),
                        substr($striped, 20),
                    );
                    return implode('-', $components);
                }
                $uuid = constructOfflinePlayerUuid(str_replace(' ', '_', $displayName));
                $base64url = array('textures' => array('SKIN' => array('url' => $texture)));
                $base64 = base64_encode(json_encode($base64url, JSON_UNESCAPED_SLASHES));
                $jsonArray = array('uuid' => $uuid,'name' => $displayName, 'value' => $base64, 'image' => file_get_contents($this->config->application->generateHeadUrl.$base64));
                $redis->set('headmc:'.$category.':'.$uuid, json_encode($jsonArray));
                return json_encode($jsonArray);
            }
        }
    }

}