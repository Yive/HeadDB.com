<?php

class DetailsController extends ControllerBase {

    public function indexAction() {
        $params = $this->dispatcher->getParams();
        if(empty($params['uuid'])) {
            return $this->response->redirect("https://headdb.com/", true);
        } else {
            $redis = new Redis();
            $redis->pconnect($this->config->application->redis->host);
            $keys = $redis->keys($this->config->application->redis->keys->all.'*');
            if(empty($keys)) {
                return $this->response->redirect("https://headdb.com/", true);
            } else {
                foreach ($keys as $key) {
                    if(strpos($key, $params['uuid'])) {
                        $success = true;
                        $finalKey = $key;
                        break;
                    } else {
                        $success = false;
                        continue;
                    }
                }
                if(!$success) {
                    return $this->response->redirect("https://headdb.com/", true);
                } else {
                    $head = json_decode($redis->get($finalKey),true);
                    echo '<div class="col-md-4 col-lg-3 col-xl-3">
        <div class="card"style="margin-bottom:20px;">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
    </center>
  </div>
</div>
<div class="alert alert-danger">
    <strong>Warning:</strong> The UUIDs are not real.
</div>
</div>';
$getCategory = str_replace('headmc:', '', $finalKey);
$getCategory = str_replace(':'.$head['uuid'], '', $getCategory);
if($getCategory == 'block') {
  $getCategory = 'blocks';
}
$api = array('name' => $head['name'],'uuid' => $head['uuid'],'value' => $head['value'],'valueDecoded' => json_decode(base64_decode($head['value']),true),'command' => '/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}');
$apiJson = json_encode($api,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                    echo '<div class="col-md-8 col-lg-9 col-xl-9" style="margin-bottom:20px;">
        <div class="card" style="margin-bottom:20px;">
  <div class="card-header">
    Command <a href="#" class="btn btn-secondary btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
  </div>
  <div class="card-block">
        <textarea readonly class="form-control" rows="6" onclick="this.focus();this.select()">/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}</textarea>
  </div>
</div>
        <div class="card">
  <div class="card-header">
    API Usage
  </div>
  <div class="card-block">
        <h6><label class="badge badge-success">GET</label> https://headdb.com/api/head/'.$head['uuid'].'</h6>
        <textarea readonly class="form-control" rows="22" onclick="this.focus();this.select()">'.$apiJson.'</textarea>
        <h6 style="margin-top:15px;"><label class="badge badge-success">GET</label> https://headdb.com/api/category/'.$getCategory.'</h6>
        <textarea readonly class="form-control" rows="24" onclick="this.focus();this.select()">'.json_encode(array($head['uuid'] => $api),JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).'</textarea>
  </div>
</div>
</div>';
                }
            }
        }

    }

}
