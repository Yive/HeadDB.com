<?php

class ViewController extends \Phalcon\Mvc\Controller {

    public function initialize() {
        $this->tag->setTitle("HeadDB");
    }

    public function indexAction() {
        return $this->response->redirect("https://headdb.com/", true);
    }

    public function allAction() {
        $this->tag->prependTitle("View All - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function foodAction() {
        $this->tag->prependTitle("View Food - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:food:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function blocksAction() {
        $this->tag->prependTitle("View Blocks - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:block:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function electronicsAction() {
        $this->tag->prependTitle("View Electronics - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:electronics:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function charactersAction() {
        $this->tag->prependTitle("View Characters - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:characters:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function flagsAction() {
        $this->tag->prependTitle("View Flags - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:flags:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function lettersAction() {
        $this->tag->prependTitle("View Letters - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:letters:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function miscAction() {
        $this->tag->prependTitle("View Misc - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:misc:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function youtubersAction() {
        $this->tag->prependTitle("View Youtubers - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:youtubers:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function halloweenAction() {
        $this->tag->prependTitle("View Halloween - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:halloween:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

    public function christmasAction() {
        $this->tag->prependTitle("View Christmas - ");
        $redis = new Redis();
        $redis->pconnect('/var/run/redis/redis.sock');
        $json = $redis->keys('headmc:christmas:*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$head['name'].'
  </div>
  <div class="card-block">
    <center>
        <img src="data:image/png;base64,'.$head['image'].'" style="margin-bottom:10px;">
        <br/>
        <br/>
        <div class="btn-group" role="group">
            <a style="cursor:pointer;" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Copy command to clipboard" data-clipboard-text=\'/give @p skull 1 3 {display:{Name:"'.$head['name'].'",Lore:["Skull from HeadDB.com"]},SkullOwner:{Id:"'.$head['uuid'].'",Properties:{textures:[{Value:"'.$head['value'].'"}]}}}\'><i class="fa fa-clipboard" aria-hidden="true"></i></a>
            <a href="'.$decodedValue['textures']['SKIN']['url'].'" download="'.str_replace(' ', '', strtolower($head['name'])).'" target="_blank" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Download skin"><i class="fa fa-download" aria-hidden="true"></i></a>
            <a href="/details/'.$head['uuid'].'" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        </div>
    </center>
  </div>
</div>
</div>';
        }
    }

}
