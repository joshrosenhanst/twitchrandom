<?php

class DevController extends BaseController {
    public function mobiletest(){
        return View::make('layouts.dev.mobiletest', array(
        ));
    }
}