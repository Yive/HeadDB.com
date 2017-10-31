<?php

use Phalcon\Filter;

class ImportController extends ControllerBase {

    public function indexAction() {
        $this->tag->prependTitle("Submit Custom Head - ");
        if(!$this->request->isPost()) return;
        // Extremely terrible code, but whatever.
        $filter = new Filter();
        $playerName = $filter->sanitize($this->request->getPost('playerName'), "string") ?: false;
        $skullName = mb_convert_encoding($filter->sanitize($this->request->getPost('skullName'), "string"), "UTF-8") ?: false;

        if(!$playerName) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> You forgot to type a Minecraft username.</div>';
            return;
        }
        if(!$skullName) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> You forgot to type a name for the skull.</div>';
            return;
        }

        function file_get_contents_curl($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,1);
            curl_setopt($ch, CURLOPT_TIMEOUT,1);
            $data = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            return array($data, $info);
        }

        if(strlen($playerName) > 16) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Minecraft username you typed was over 16 characters.</div>';
            return;
        }
        $skin = @file_get_contents_curl('http://skins.minecraft.net/MinecraftSkins/'.$playerName.'.png');
        if(!$skin[0]) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Minecraft username you typed did not have a skin.</div>';
            return;
        }
        if(!strpos($skin[1]['url'], 'textures.minecraft.net')) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Contact Yive.</div>';
            return;
        }

        // Credit to https://gist.github.com/games647/2b6a00a8fc21fd3b88375f03c9e2e603
        // Edited to work with HeadDB though.
        function constructOfflinePlayerUuid() {
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
        $redis = new Redis();
        $redis->pconnect($this->config->application->redis->host);
        $uuid = constructOfflinePlayerUuid();
        $base64url = array('textures' => array('SKIN' => array('url' => $skin[1]['url'])));
        $base64 = base64_encode(json_encode($base64url, JSON_UNESCAPED_SLASHES));
        $jsonArray = array('uuid' => $uuid,'name' => $skullName, 'value' => $base64, 'image' => file_get_contents($this->config->application->generateHeadUrl.$base64));
        $redis->set('headmc:unverified:'.$uuid, json_encode($jsonArray));
        echo '<div class="alert alert-success" role="alert"><strong>Success:</strong> Your newly submitted head can be found at <a href="https://headdb.com/details/'.$uuid.'">https://headdb.com/details/'.$uuid.'</a>.<br>Note that this is a custom head, it will only work on versions which allows custom heads.</div>';
        return;
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
            $unverified = $this->request->get('unverified') ?: false;
            if(!$displayName) {
                return 'invalid displayName';
            } elseif(!$category) {
                return 'invalid category';
            } elseif(!$texture) {
                return 'invalid texture';
            } elseif(!$unverified) {
                return 'invalid unverified';
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
                if($unverified != false) {
                    $redis->del('headmc:'.$unverified);
                }
                $uuid = constructOfflinePlayerUuid();
                $base64url = array('textures' => array('SKIN' => array('url' => $texture)));
                $base64 = base64_encode(json_encode($base64url, JSON_UNESCAPED_SLASHES));
                $jsonArray = array('uuid' => $uuid,'name' => $displayName, 'value' => $base64, 'image' => file_get_contents($this->config->application->generateHeadUrl.$base64));
                $redis->set('headmc:'.$category.':'.$uuid, json_encode($jsonArray));
                return json_encode($jsonArray);
            }
        }
    }

}