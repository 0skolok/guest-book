<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="wrapper_def container">

    <div class="">
        <h1>Просмотр записей гостевой книги</h1>
    </div>
    <div class="comments">
        <h3 class="title-comments">Записей в книге (<span id="count_ent"><? echo $count; ?></span>)</h3>
        <ul class="media-list">

            <?
                foreach ($result as $res)
                {
            ?>
                    <li id="med_<? echo $res['id']?>" class="media">
                        <div class="media-body">
                            <div class="footer-comment">
                                <a href="#" id="bt-<? echo $res['id']?>" class="btn btn-danger btn-xs delbtn">Удалить</a>
                            </div>
                            <div class="media-heading">
                                <div class="author"><? echo $res['username']; ?></div>
                                <div class="metadata">
                                    <span class="date"><? echo date('d.m.Y', strtotime($res['created_date'])); ?></span>
                                </div>
                            </div>
                            <div class="media-text text-justify"><? echo $res['text'] ?></div>
                            <hr>
                        </div>
                    </li>
           <? } ?>
        </ul>
<!--        --><?php //echo $links; ?>
</div>