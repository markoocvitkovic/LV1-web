<?php

interface iRadovi {
    public function create($name, $text, $link, $oib);
    public function save();
    public function read();
}

