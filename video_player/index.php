<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/functions.php';

function getEpisodesForBigScr($EnglAnimeName, $numSeson)
{
    $res = '';
    $n = countFiles($_SERVER['DOCUMENT_ROOT'].'/anime/'.$EnglAnimeName.'/Seson'.$numSeson);
    for($i=1; $i<=$n; $i++)
    {
        $res .='
            <div class="col-12 p-0 ChoiceSer">
                <div class="numberSerForBigScr">'.$i.' серия</div>
                <div class="mask1" id="numberSerForBigScrMask1_'.$i.'"></div>
                <div class="mask2" id="numberSerForBigScrMask2_'.$i.'"></div>
                <img src="/video_player/Barrel%20(2).png" alt="" class="w-100">
            </div>';
    }
    return $res;
}

function getEpisodesForSmallScr($EnglAnimeName, $numSeson)
{
    $res = '';
    $n = countFiles($_SERVER['DOCUMENT_ROOT'].'/anime/'.$EnglAnimeName.'/Seson'.$numSeson);
    for($i=1; $i<=$n; $i++)
    {
        $res .='<button class="dropdown-item text-uppercase" type="button">'.$i.'</button>';
    }
    return $res;
}

function getVideoPlayer($EnglAnimeName, $numSeson, $numEpisode){
	$n = countDir($_SERVER['DOCUMENT_ROOT'].'/anime/'.$EnglAnimeName);//кол-во сезонов
    $res = '
    <div class="w-100 containerVideoPlayer pt-3 pb-3" id="everythingInVideo">
        <video id="my-video" class="video-js" controls preload="auto" width="640" height="264" poster="images.jpg" data-setup="{}" onloadeddata="onloadeddataVideo(this.clientHeight)">
                <source id="sourseVideo" src="anime/'.$EnglAnimeName.'/Seson'.$numSeson.'/'.$numEpisode.'.mp4" type="video/mp4">
            </video>
        <div class="ChoiceVideo">
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownChoiceSeason" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">сезон</button>
                <div class="dropdown-menu" aria-labelledby="dropdownChoiceSeason" id="ChoiceSeason">';
				for($i=1; $i<=$n; $i++)
                {
                    $res .= '<button class="dropdown-item text-uppercase" type="button">'.$i.'</button>';
				}
					$res .= '
                </div>
            </div>
            <div class="dropdown ml-1">
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownChoiceSeries" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">серия</button>
                <div class="dropdown-menu" aria-labelledby="dropdownChoiceSeries" id="ChoiceSeries">
                    '.getEpisodesForSmallScr($EnglAnimeName, $numSeson).'
                </div>
            </div>
        </div>
        <div class="ChoiceVideoForBigScr p-0">
            <div class="row w-100 m-0">
                <div id="ChoiceVideoForBigScrSesonsBut" class="w-100 p-0">
                    <div class="ChoiceVideoForBigScrSesonsBut w-100">Выбрать сезон</div>
                    <div class="row m-0 pr-3">';
                        for($i=1; $i<=$n; $i++)
                        {
                            $res .= '
                            <div class="col-6 p-0 ChoiceSeson">
                                '.$i.' сезон
                            </div>';
                        }
                        $res .='
                    </div>
                </div>
                <div class="col-12 ChoiceSerForBigScr p-0" id="ChoiceSerForBigScr">';
                
                $res .= getEpisodesForBigScr($EnglAnimeName, $numSeson);
                    
                $res .= '</div>
            </div>
        </div>
    </div>
    <script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
    <script src="/video_player/js/handler.js"></script>
    ';
    return $res;
}

?>
