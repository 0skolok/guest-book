<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><body>
<nav class="nav_bar navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<? echo base_url()."guestpage/index"; ?>">Guest Book</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
            <ul class="nav navbar-nav">
                <li><a href="<? echo base_url()."guestpage/index"; ?>#bottom_y">Добавить запись</a></li>
                <li><a href="<? echo base_url()."guestpage/changeBook"; ?>">Управление записями</a></li>
            </ul>
        </div>
    </div>
</nav>