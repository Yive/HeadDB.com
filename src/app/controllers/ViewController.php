<?php

use Phalcon\Filter;

class ViewController extends ControllerBase {

    public function indexAction() {
        return $this->response->redirect("https://headdb.com/", true);
    }

    public function allAction() {
        $this->tag->prependTitle("View All - ");
        $redis = new Redis();
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->all.'*');
        foreach ($json as $key) {
            if(strpos($key, 'unverified')) {
                continue;
            }
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->food.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->blocks.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->electronics.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->characters.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->flags.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->letters.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->misc.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->youtubers.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->halloween.'*');
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
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->christmas.'*');
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

    public function unverifiedAction() {
        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><div class="alert alert-warning"><strong>Warning:</strong> These heads are unverified and are submitted by users. The creator of this site is not connected to any of the heads and names listed above the player heads.</div></div>';
        $filter = new Filter();
        $this->tag->prependTitle("View Unverified Skulls - ");
        $redis = new Redis();
        $redis->pconnect($this->config->application->redis->host);
        $json = $redis->keys($this->config->application->redis->keys->unverified.'*');
        foreach ($json as $key) {
            $head = json_decode($redis->get($key),true);
            $decodedValue = json_decode(base64_decode($head['value']),true);
        echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" style="margin-bottom:20px;">
        <div class="card">
  <div class="card-header">
    '.$filter->sanitize($head['name'],"string").'
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
