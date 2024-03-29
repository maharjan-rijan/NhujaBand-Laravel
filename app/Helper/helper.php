<?php

use App\Models\TeamMember;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Page;

function getTeamMembers(){
    return  TeamMember::orderBy('id','DESC')->get();
}

function getEvents(){
    return  Event::orderBy('id','DESC')->where('showHome',1)->get();
}
function getGalleries(){
    return  Gallery::orderBy('id','DESC')->where('showHome',1)->get();
}

function staticPages(){
    $pages = Page::orderBy('name','ASC')->get();
    return $pages;
}
?>
