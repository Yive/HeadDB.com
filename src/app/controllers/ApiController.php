<?php

class ApiController extends ControllerBase {

    public function indexAction() {
        $this->tag->prependTitle("API Documentation - ");

    }

    public function headAction() {
        $this->view->disable();
        header("Content-Type: application/json");
        $params = $this->dispatcher->getParams();
        if(empty($params['uuid'])) {
            return json_encode(array('error' => "UUID required."), JSON_PRETTY_PRINT);
        } elseif(strlen($params['uuid']) < 36) {
            return json_encode(array('error' => "Invalid UUID."), JSON_PRETTY_PRINT);
        } else {
            $redis = new Redis();
            $redis->pconnect($this->config->application->redis->host);
            $keys = $redis->keys($this->config->application->redis->keys->all.'*');
            $output = array();
            foreach ($keys as $key) {
                if(strpos($key, $params['uuid'])) {
                    $finalKey = $key;
                    break;
                }
            }
            if(empty($finalKey)) {
                return json_encode(array('error' => "Invalid UUID."), JSON_PRETTY_PRINT);
            } else {
                $head = json_decode($redis->get($finalKey),true);
                $output = array('name' => $head['name'],'uuid' => $head['uuid'],'value' => $head['value'],'valueDecoded' => json_decode(base64_decode($head['value']),true),'command' => '/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}');
                return json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            }
        }
    }

    public function categoryAction() {
        $this->view->disable();
        header("Content-Type: application/json");
        $params = $this->dispatcher->getParams();
        if(empty($params['category'])) {
            return json_encode(array('error' => "Category required."), JSON_PRETTY_PRINT);
        } else {
            if(!in_array(strtolower($params['category']), array('blocks','youtubers','food','electronics','characters','flags','letters','halloween','christmas','all','unverified'))) {
                return json_encode(array('error' => "Invalid category."), JSON_PRETTY_PRINT);
            } else {
                $redis = new Redis();
                $redis->pconnect($this->config->application->redis->host);
                if(strtolower($params['category']) == 'all') {
                    $keys = $redis->keys($this->config->application->redis->keys->all.'*');
                } elseif(strtolower($params['category']) == 'blocks') {
                    $keys = $redis->keys($this->config->application->redis->keys->blocks.'*');
                } else {
                    $keys = $redis->keys('headmc:'.strtolower($params['category']).'*');
                }
                $output = array();
                foreach ($keys as $key) {
                    if(strpos($key, 'unverified') && $params['category'] == 'all') {
                        continue;
                    }
                    $head = json_decode($redis->get($key),true);
                    $output[$head['uuid']] = array('name' => $head['name'],'uuid' => $head['uuid'],'value' => $head['value'],'valueDecoded' => json_decode(base64_decode($head['value']),true),'command' => '/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}');
                }
                return json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            }
        }
    }
}
