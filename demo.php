<?php

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

require_once "vendor/autoload.php";
$file = "/path/to/video.mp4";
$tmpFile = "/path/to/output.gif";
$ffmpeg = FFMpeg::create();
$format = new X264();
$format->on('progress',function ($video,$format,$percentage){
    echo " $percentage ";
});
$gif = $ffmpeg->open($file);
$mediaInfo = $gif->getStreams()->first()->all();
$height = $mediaInfo['height'] ?: 220;
$width = $mediaInfo['width'] ?: 1280;
$gif->gif(TimeCode::fromSeconds(0), new Dimension($width / 5, $height / 5),5)
    ->save_with_high_quality($tmpFile, 10,$format);
