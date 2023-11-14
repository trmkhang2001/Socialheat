<?php

/**
 * @var $posts
 * @var $socials
 * @var $total_posts
 * @var $total_social
 * @var $channelTypes
 * @var $totalEmail
 * @var $totalBirthDay
 * @var $totalRelationShip
 * @var $item
 */

?>
<style>
    .list_keyword_social li {
        float: left;
    }

    .interaction li {
        float: left;
        width: calc((100% - 107px)/5);
        height: 105px;
        margin-right: 16px;
        margin-left: 5px;
        padding: 16px 20px;
    }

    .interaction li .img {
        float: left
    }

    @media(max-width: 1024px) {
        .interaction li {
            float: left;
            width: calc((100% - 107px)/2);
            height: 105px;
            margin-right: 21px;
            margin-left: 25px;
            padding: 16px 20px;
            margin-bottom: 10px;
        }
    }
</style>
<div class="card mx-5 p-3">
    <div class="m-content">
        <div class="clearfix">
            <h2>Reports</h2>
            <div class="clearfix " style="margin-top: 20px;margin-bottom: 10px">
                <form method="get" class="form_filters_post">
                    <?php $this->load->view('/backend/monitoring/item_keywords'); ?>
                </form>
            </div>
        </div>
        <div class="row margin-bottom-25">
            <div class="col-md-4 no-padding" style="padding-right: 10px;padding-left: 0">
                <div class="m-widget14" style="background: #ffffff">
                    <div class="clearfix">
                        <div class="row  align-items-center">
                            <div class="col">
                                <div id="m_chart_social" class="m-widget14__chart" style="height: 160px">
                                    <h5 class="m-widget14__title" style=" position: absolute;top: 38%;width: 100%; text-align: center; color: #595959;font-weight: bold">
                                        Social<br>Listening
                                    </h5>
                                    <div class="m-widget14__stat"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="m-widget14__legends">
                                    <?php foreach ($socials as $key => $social) :
                                        $value = 0;
                                        if ($total_social > 0) {
                                            $value = round($social['value'] * 100 / $total_social, 2);
                                        }
                                        $social['value'] = $value;
                                        $socials[$key] = $social;
                                    ?>
                                        <div class="m-widget14__legend" data-value="<?= $value ?>">
                                            <span class="m-widget14__legend-bullet" style="background-color: <?php echo $social['meta']['color']; ?>"></span>
                                            <span class="m-widget14__legend-text"> <?php echo $social['label']; ?></span>
                                            <span class="m-widget14__legend-text"> <b><?= $value ?>%</b></span>
                                        </div>
                                    <?php endforeach; ?>
                                    <script type="text/json" id="socials">
                                        <?php echo json_encode($socials); ?>
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 no-padding" style="padding-right: 0;padding-left: 10px">
                <div class="m-widget14" style="background: #ffffff">
                    <div class="clearfix">
                        <div class="row  align-items-center">
                            <div class="col">
                                <div id="m_chart_posts" class="m-widget14__chart" style="height: 160px">
                                    <h5 class="m-widget14__title" style=" position: absolute;top: 38%;width: 100%; text-align: center;color: #595959;font-weight: bold">
                                        Total Post
                                    </h5>
                                    <div class="m-widget14__stat"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="m-widget14__legends">
                                    <?php foreach ($posts as $key => $post) :
                                        $value = 0;
                                        if ($total_posts > 0) {
                                            $value = round($post['value'] * 100 / $total_posts, 2);
                                        }
                                        $post['value'] = $value;
                                        $posts[$key] = $post;
                                    ?>
                                        <div class="m-widget14__legend" data-value="<?= $value ?>">
                                            <span class="m-widget14__legend-bullet" style="background-color: <?php echo $post['meta']['color']; ?>"></span>
                                            <span class="m-widget14__legend-text"> <?php echo $post['label']; ?> <b><?= $value ?>%</b></span>
                                        </div>
                                    <?php endforeach; ?>
                                    <script type="text/json" id="posts">
                                        <?php echo json_encode($posts); ?>
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4 no-padding" style="padding-right: 0;padding-left: 10px">
                <div class="m-widget14" style="background: #ffffff">
                    <div class="clearfix">
                        <div class="row  align-items-center">
                            <div class="col">
                                <div id="m_chart_channel_types" class="m-widget14__chart" style="height: 160px">
                                    <h5 class="m-widget14__title" style=" position: absolute;top: 38%;width: 100%; text-align: center;color: #595959;font-weight: bold">
                                        Total<br>Channel
                                    </h5>
                                    <div class="m-widget14__stat"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="m-widget14__legends">
                                    <?php foreach ($channelTypes as $key => $channel) :
                                        $value = 0;
                                        if ($total_posts > 0) {
                                            $value = round($channel['value'] * 100 / $total_posts, 2);
                                        }
                                        $channel['value'] = $value;
                                        $channel[$key] = $channel;
                                    ?>
                                        <div class="m-widget14__legend" data-value="<?= $value ?>">
                                            <span class="m-widget14__legend-bullet" style="background-color: <?php echo $channel['meta']['color']; ?>"></span>
                                            <span class="m-widget14__legend-text"> <?php echo $channel['label']; ?> <b><?= $value ?>%</b></span>
                                        </div>
                                    <?php endforeach; ?>
                                    <script type="text/json" id="channelTypes">
                                        <?php echo json_encode($channelTypes); ?>
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row margin-bottom-25">
            <div class="col-md-12" style="padding: 0">
                <ul class="list-inline interaction">
                    <li>
                        <span class="img"><img src="/assets/images/like_share_icon.png"></span>
                        <span class="number"><?= $item->count_like_share ?></span><br>
                        <span class="text-title">DATA LIKE & SHARE</span>
                    </li>
                    <li>
                        <span class="img"><img src="/assets/images/comment_icon.png"></span>
                        <span class="number"><?= $item->count_comment ?></span><br>
                        <span class="text-title">DATA COMMENT</span>
                    </li>
                    <li>
                        <span class="img"><img src="/assets/images/comment_icon.png"></span>
                        <span class="number"><?= $item->total_comment ?></span><br>
                        <span class="text-title">COMMENT</span>
                    </li>
                    <li>
                        <span class="img"><img src="/assets/images/share_icon.png"></span>
                        <span class="number"><?= $item->total_share ?></span><br>
                        <span class="text-title">SHARE</span>
                    </li>
                    <li>
                        <span class="img"><img src="/assets/images/like_icon.png"></span>
                        <span class="number"><?= $item->total_like ?></span><br>
                        <span class="text-title">LIKE</span>

                    </li>

                </ul>
            </div>
        </div>
        <!--	<div class="row">-->
        <!--		<div class="col-md-6" style="background: #ffffff">-->
        <!--			<div class="m-widget14">-->
        <!--				<div class="m-widget14__header">-->
        <!--					<h3 class="m-widget14__title">-->
        <!--						Ages-->
        <!--					</h3>-->
        <!--					<span class="m-widget14__desc">-->
        <!--                                    Users age demographic-->
        <!--                                </span>-->
        <!--				</div>-->
        <!--				<div class="row  align-items-center">-->
        <!--					<div class="col">-->
        <!--						<div id="m_chart_ages" class="m-widget14__chart" style="height: 160px">-->
        <!--							<div class="m-widget14__stat"></div>-->
        <!--						</div>-->
        <!--					</div>-->
        <!--					<div class="col">-->
        <!--						<div class="m-widget14__legends">-->
        <!--							--><?php
                                            //
                                            //							$series = array();
                                            //							$get_age_ranges = get_age_ranges();
                                            //							
                                            ?>
        <!--							--><?php //foreach ($ages as $key => $age) :
                                            //								$value = round($age / $total * 100, 2);
                                            //								if ($key == 0)
                                            //								{
                                            //									$color = '#fd7e14';
                                            //									$age_label = 'None';
                                            //								} else
                                            //								{
                                            //									$color = $get_age_ranges[$key][3];
                                            //									$age_label = $get_age_ranges[$key][2];
                                            //								}
                                            //								$seri = array('value' => $value, 'className' => 'custom', 'meta' => array('color' => $color));
                                            //								$series[] = $seri;
                                            //								
                                            ?>
        <!--								<div class="m-widget14__legend" data-value="--><?php //echo $value 
                                                                                            ?><!--">-->
        <!--									<span class="m-widget14__legend-bullet"-->
        <!--										  style="background-color: --><?php //echo $color; 
                                                                                    ?><!--"></span>-->
        <!--									<span class="m-widget14__legend-text">--><?php //echo $value; 
                                                                                            ?><!--% --><?php //echo $age_label; 
                                                                                                        ?><!--</span>-->
        <!--								</div>-->
        <!--							--><?php //endforeach; 
                                            ?>
        <!--							<script type="text/json" id="ages-series">-->
        <!--                                            --><?php //echo json_encode($series); 
                                                            ?>
        <!---->
        <!--							</script>-->
        <!--						</div>-->
        <!--					</div>-->
        <!--				</div>-->
        <!--			</div>-->
        <!---->
        <!--		</div>-->
        <!--		<div class="col-md-6" style="background: #ffffff">-->
        <!--			<div class="m-widget14">-->
        <!--				<div class="m-widget14__header">-->
        <!--					<h3 class="m-widget14__title">-->
        <!--						Ages-->
        <!--					</h3>-->
        <!--					<span class="m-widget14__desc">-->
        <!--                                    Users age demographic-->
        <!--                                </span>-->
        <!--				</div>-->
        <!--				<div class="row  align-items-center">-->
        <!--					<div class="col">-->
        <!--						<div id="m_chart_ages_" class="m-widget14__chart" style="height: 160px">-->
        <!--							<div class="m-widget14__stat"></div>-->
        <!--						</div>-->
        <!--					</div>-->
        <!--					<div class="col">-->
        <!--						<div class="m-widget14__legends">-->
        <!--							--><?php
                                            //
                                            //							$series = array();
                                            //							$get_age_ranges = get_age_ranges();
                                            //							
                                            ?>
        <!--							--><?php //foreach ($ages as $key => $age) :
                                            //								$value = round($age / $total * 100, 2);
                                            //								if ($key == 0)
                                            //								{
                                            //									$color = '#fd7e14';
                                            //									$age_label = 'None';
                                            //								} else
                                            //								{
                                            //									$color = $get_age_ranges[$key][3];
                                            //									$age_label = $get_age_ranges[$key][2];
                                            //								}
                                            //								$seri = array('value' => $value, 'className' => 'custom', 'meta' => array('color' => $color));
                                            //								$series[] = $seri;
                                            //								
                                            ?>
        <!--								<div class="m-widget14__legend" data-value="--><?php //echo $value 
                                                                                            ?><!--">-->
        <!--									<span class="m-widget14__legend-bullet"-->
        <!--										  style="background-color: --><?php //echo $color; 
                                                                                    ?><!--"></span>-->
        <!--									<span class="m-widget14__legend-text">--><?php //echo $value; 
                                                                                            ?><!--% --><?php //echo $age_label; 
                                                                                                        ?><!--</span>-->
        <!--								</div>-->
        <!--							--><?php //endforeach; 
                                            ?>
        <!--							<script type="text/json" id="ages-series_">-->
        <!--                                            --><?php //echo json_encode($series); 
                                                            ?>
        <!---->
        <!--							</script>-->
        <!--						</div>-->
        <!--					</div>-->
        <!--				</div>-->
        <!--			</div>-->
        <!---->
        <!--		</div>-->
        <!--	</div>-->
        <div class="row">
            <div class="m-portlet">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Stats2-1 -->
                            <div class="m-widget1">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Total Data</h3>
                                            <span class="m-widget1__desc">Number of users</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand"><?= number_format($total_social) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Email</h3>
                                            <span class="m-widget1__desc">Data have email</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger"><?= number_format($totalEmail) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Birthday</h3>
                                            <span class="m-widget1__desc">Data have birthday</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success"><?= number_format($totalBirthDay) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Relationship</h3>
                                            <span class="m-widget1__desc">Data have relationship</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-yellow"><?= number_format($totalRelationShip) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Reach</h3>
                                            <span class="m-widget1__desc">Cost 1,000 reach (<sup>$</sup>2.1)</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand"><sup>$</sup><?= number_format($total_social / 1000 * 2.1, 3) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">SMS</h3>
                                            <span class="m-widget1__desc">Cost for sending SMS (<sup>$</sup>0.01)</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger"><sup>$</sup><?= number_format($total_social * 0.01, 3) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Email</h3>
                                            <span class="m-widget1__desc">Cost for sending email (<sup>$</sup>0.013)</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success"><sup>$</sup><?= number_format(($totalEmail * 0.013), 3) ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!--end:: Widgets/Stats2-1 -->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Profit Share-->
                            <div class="m-widget14">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                        Ages
                                    </h3>
                                    <span class="m-widget14__desc">
                                        Users age demographic
                                    </span>
                                </div>
                                <div class="row  align-items-center">
                                    <div class="col">
                                        <div id="m_chart_ages" class="m-widget14__chart" style="height: 160px">
                                            <div class="m-widget14__stat"></div>
                                            <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;">
                                                <g class="ct-series custom">
                                                    <path d="M56.156,19.101A64.8,64.8,0,1,0,78.3,15.2" class="ct-slice-donut" ct:value="94.44" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#fd7e14&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="384.58935546875px 384.58935546875px" stroke-dashoffset="-384.58935546875px" stroke="#fd7e14">
                                                        <animate attributeName="stroke-dashoffset" id="anim0" dur="100ms" from="-384.58935546875px" to="0px" fill="freeze" stroke="#fd7e14" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M56.578,18.949A64.8,64.8,0,0,0,55.944,19.179" class="ct-slice-donut" ct:value="0.11" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#007bff&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.6744314432144165px 0.6744314432144165px" stroke-dashoffset="-0.6744314432144165px" stroke="#007bff">
                                                        <animate attributeName="stroke-dashoffset" id="anim1" dur="100ms" from="-0.6744314432144165px" to="0px" fill="freeze" stroke="#007bff" begin="anim0.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M72.485,15.461A64.8,64.8,0,0,0,56.365,19.026" class="ct-slice-donut" ct:value="4.01" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#6610f2&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="16.554487228393555px 16.554487228393555px" stroke-dashoffset="-16.554487228393555px" stroke="#6610f2">
                                                        <animate attributeName="stroke-dashoffset" id="anim2" dur="100ms" from="-16.554487228393555px" to="0px" fill="freeze" stroke="#6610f2" begin="anim1.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M77.404,15.206A64.8,64.8,0,0,0,72.26,15.482" class="ct-slice-donut" ct:value="1.21" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#6f42c1&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="5.152754783630371px 5.152754783630371px" stroke-dashoffset="-5.152754783630371px" stroke="#6f42c1">
                                                        <animate attributeName="stroke-dashoffset" id="anim3" dur="100ms" from="-5.152754783630371px" to="0px" fill="freeze" stroke="#6f42c1" begin="anim2.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M77.852,15.202A64.8,64.8,0,0,0,77.178,15.21" class="ct-slice-donut" ct:value="0.11" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#5867dd&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.6740466356277466px 0.6740466356277466px" stroke-dashoffset="-0.6740466356277466px" stroke="#5867dd">
                                                        <animate attributeName="stroke-dashoffset" id="anim4" dur="100ms" from="-0.6740466356277466px" to="0px" fill="freeze" stroke="#5867dd" begin="anim3.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.015,15.201A64.8,64.8,0,0,0,77.626,15.204" class="ct-slice-donut" ct:value="0.04" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#ffb822&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.3890122175216675px 0.3890122175216675px" stroke-dashoffset="-0.3890122175216675px" stroke="#ffb822">
                                                        <animate attributeName="stroke-dashoffset" id="anim5" dur="100ms" from="-0.3890122175216675px" to="0px" fill="freeze" stroke="#ffb822" begin="anim4.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.3,15.2A64.8,64.8,0,0,0,77.789,15.202" class="ct-slice-donut" ct:value="0.07" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;#34bfa3&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.5110071897506714px 0.5110071897506714px" stroke-dashoffset="-0.5110071897506714px" stroke="#34bfa3">
                                                        <animate attributeName="stroke-dashoffset" id="anim6" dur="100ms" from="-0.5110071897506714px" to="0px" fill="freeze" stroke="#34bfa3" begin="anim5.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="m-widget14__legends">
                                            <div class="m-widget14__legend" data-value="94.44">
                                                <span class="m-widget14__legend-bullet" style="background-color: #fd7e14"></span>
                                                <span class="m-widget14__legend-text">94.44% None</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0.11">
                                                <span class="m-widget14__legend-bullet" style="background-color: #007bff"></span>
                                                <span class="m-widget14__legend-text">0.11% 18 - 24</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="4.01">
                                                <span class="m-widget14__legend-bullet" style="background-color: #6610f2"></span>
                                                <span class="m-widget14__legend-text">4.01% 25 - 34</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="1.21">
                                                <span class="m-widget14__legend-bullet" style="background-color: #6f42c1"></span>
                                                <span class="m-widget14__legend-text">1.21% 35 - 44</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0.11">
                                                <span class="m-widget14__legend-bullet" style="background-color: #5867dd"></span>
                                                <span class="m-widget14__legend-text">0.11% 45 - 54</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0.04">
                                                <span class="m-widget14__legend-bullet" style="background-color: #ffb822"></span>
                                                <span class="m-widget14__legend-text">0.04% 55 - 64</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0.07">
                                                <span class="m-widget14__legend-bullet" style="background-color: #34bfa3"></span>
                                                <span class="m-widget14__legend-text">0.07% 65 - 0</span>
                                            </div>
                                            <script type="text/json" id="ages-series">
                                                [{
                                                    "value": 94.44,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#fd7e14"
                                                    }
                                                }, {
                                                    "value": 0.11,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#007bff"
                                                    }
                                                }, {
                                                    "value": 4.01,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#6610f2"
                                                    }
                                                }, {
                                                    "value": 1.21,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#6f42c1"
                                                    }
                                                }, {
                                                    "value": 0.11,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#5867dd"
                                                    }
                                                }, {
                                                    "value": 0.04,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#ffb822"
                                                    }
                                                }, {
                                                    "value": 0.07,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "#34bfa3"
                                                    }
                                                }]
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Profit Share-->
                        </div>
                        <div class="col-xl-4">

                            <!--begin:: Widgets/Profit Share-->
                            <div class="m-widget14">
                                <div class="m-widget14__header">
                                    <h3 class="m-widget14__title">
                                        Relationship
                                    </h3>
                                    <span class="m-widget14__desc">
                                        There are some type of relationship
                                    </span>
                                </div>
                                <div class="row  align-items-center">
                                    <div class="col">
                                        <div id="m_chart_relationship" class="m-widget14__chart" style="height: 160px">
                                            <div class="m-widget14__stat"></div>
                                            <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-donut" style="width: 100%; height: 100%;">
                                                <g class="ct-series custom">
                                                    <path d="M40.315,132.627A65.05,65.05,0,1,0,78.55,14.95" class="ct-slice-donut" ct:value="60" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;green&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="245.240966796875px 245.240966796875px" stroke-dashoffset="-245.240966796875px" stroke="green">
                                                        <animate attributeName="stroke-dashoffset" id="anim0" dur="100ms" from="-245.240966796875px" to="0px" fill="freeze" stroke="green" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M16.684,59.898A65.05,65.05,0,0,0,40.499,132.76" class="ct-slice-donut" ct:value="20" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;yellow&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="81.97537994384766px 81.97537994384766px" stroke-dashoffset="-81.97537994384766px" stroke="yellow">
                                                        <animate attributeName="stroke-dashoffset" id="anim1" dur="100ms" from="-81.97537994384766px" to="0px" fill="freeze" stroke="yellow" begin="anim0.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M54.603,19.518A65.05,65.05,0,0,0,16.614,60.115" class="ct-slice-donut" ct:value="14" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;blue&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="57.4483528137207px 57.4483528137207px" stroke-dashoffset="-57.4483528137207px" stroke="blue">
                                                        <animate attributeName="stroke-dashoffset" id="anim2" dur="100ms" from="-57.4483528137207px" to="0px" fill="freeze" stroke="blue" begin="anim1.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M66.361,16.102A65.05,65.05,0,0,0,54.393,19.602" class="ct-slice-donut" ct:value="3" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;orange&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="12.488458633422852px 12.488458633422852px" stroke-dashoffset="-12.488458633422852px" stroke="orange">
                                                        <animate attributeName="stroke-dashoffset" id="anim3" dur="100ms" from="-12.488458633422852px" to="0px" fill="freeze" stroke="orange" begin="anim2.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M70.397,15.463A65.05,65.05,0,0,0,66.138,16.145" class="ct-slice-donut" ct:value="1" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;red&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="4.314053058624268px 4.314053058624268px" stroke-dashoffset="-4.314053058624268px" stroke="red">
                                                        <animate attributeName="stroke-dashoffset" id="anim4" dur="100ms" from="-4.314053058624268px" to="0px" fill="freeze" stroke="red" begin="anim3.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M74.465,15.078A65.05,65.05,0,0,0,70.172,15.492" class="ct-slice-donut" ct:value="1" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;yellow&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="4.313706874847412px 4.313706874847412px" stroke-dashoffset="-4.313706874847412px" stroke="yellow">
                                                        <animate attributeName="stroke-dashoffset" id="anim5" dur="100ms" from="-4.313706874847412px" to="0px" fill="freeze" stroke="yellow" begin="anim4.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,74.239,15.093" class="ct-slice-donut" ct:value="1" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;pink&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="4.314168453216553px 4.314168453216553px" stroke-dashoffset="-4.314168453216553px" stroke="pink">
                                                        <animate attributeName="stroke-dashoffset" id="anim6" dur="100ms" from="-4.314168453216553px" to="0px" fill="freeze" stroke="pink" begin="anim5.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,78.323,14.95" class="ct-slice-donut" ct:value="0" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;red&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.2270052433013916px 0.2270052433013916px" stroke-dashoffset="-0.2270052433013916px" stroke="red">
                                                        <animate attributeName="stroke-dashoffset" id="anim7" dur="100ms" from="-0.2270052433013916px" to="0px" fill="freeze" stroke="red" begin="anim6.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,78.323,14.95" class="ct-slice-donut" ct:value="0" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;orange&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.2270052433013916px 0.2270052433013916px" stroke-dashoffset="-0.2270052433013916px" stroke="orange">
                                                        <animate attributeName="stroke-dashoffset" id="anim8" dur="100ms" from="-0.2270052433013916px" to="0px" fill="freeze" stroke="orange" begin="anim7.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,78.323,14.95" class="ct-slice-donut" ct:value="0" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;blue&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.2270052433013916px 0.2270052433013916px" stroke-dashoffset="-0.2270052433013916px" stroke="blue">
                                                        <animate attributeName="stroke-dashoffset" id="anim9" dur="100ms" from="-0.2270052433013916px" to="0px" fill="freeze" stroke="blue" begin="anim8.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,78.323,14.95" class="ct-slice-donut" ct:value="0" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;pink&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.2270052433013916px 0.2270052433013916px" stroke-dashoffset="-0.2270052433013916px" stroke="pink">
                                                        <animate attributeName="stroke-dashoffset" id="anim10" dur="100ms" from="-0.2270052433013916px" to="0px" fill="freeze" stroke="pink" begin="anim9.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                                <g class="ct-series custom">
                                                    <path d="M78.55,14.95A65.05,65.05,0,0,0,78.323,14.95" class="ct-slice-donut" ct:value="0" ct:meta="{&amp;quot;data&amp;quot;:{&amp;quot;color&amp;quot;:&amp;quot;green&amp;quot;}}" style="stroke-width: 17px;" stroke-dasharray="0.2270052433013916px 0.2270052433013916px" stroke-dashoffset="-0.2270052433013916px" stroke="green">
                                                        <animate attributeName="stroke-dashoffset" id="anim11" dur="100ms" from="-0.2270052433013916px" to="0px" fill="freeze" stroke="green" begin="anim10.end" calcMode="spline" keySplines="0.23 1 0.32 1" keyTimes="0;1"></animate>
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="m-widget14__legends">
                                            <div class="m-widget14__legend" data-value="60" id="relationship-None">
                                                <span class="m-widget14__legend-bullet m-badge--none"></span>
                                                <span class="m-widget14__legend-text">60% None</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="20" id="relationship-Married">
                                                <span class="m-widget14__legend-bullet m-badge--married"></span>
                                                <span class="m-widget14__legend-text">20% Married</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="14" id="relationship-Single">
                                                <span class="m-widget14__legend-bullet m-badge--single"></span>
                                                <span class="m-widget14__legend-text">14% Single</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="3" id="relationship-In-a-relationship">
                                                <span class="m-widget14__legend-bullet m-badge--in_a_relationship"></span>
                                                <span class="m-widget14__legend-text">3% In a relationship</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="1" id="relationship-It-s-complicated">
                                                <span class="m-widget14__legend-bullet m-badge--it_s_complicated"></span>
                                                <span class="m-widget14__legend-text">1% It's complicated</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="1" id="relationship-In-an-open-relationship">
                                                <span class="m-widget14__legend-bullet m-badge--in_an_open_relationship"></span>
                                                <span class="m-widget14__legend-text">1% In an open relationship</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="1" id="relationship-Engaged">
                                                <span class="m-widget14__legend-bullet m-badge--engaged"></span>
                                                <span class="m-widget14__legend-text">1% Engaged</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0" id="relationship-Widowed">
                                                <span class="m-widget14__legend-bullet m-badge--widowed"></span>
                                                <span class="m-widget14__legend-text">0% Widowed</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0" id="relationship-Divorced">
                                                <span class="m-widget14__legend-bullet m-badge--divorced"></span>
                                                <span class="m-widget14__legend-text">0% Divorced</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0" id="relationship-In-a-domestic-partnership">
                                                <span class="m-widget14__legend-bullet m-badge--in_a_domestic_partnership"></span>
                                                <span class="m-widget14__legend-text">0% In a domestic partnership</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0" id="relationship-In-a-civil-union">
                                                <span class="m-widget14__legend-bullet m-badge--in_a_civil_union"></span>
                                                <span class="m-widget14__legend-text">0% In a civil union</span>
                                            </div>
                                            <div class="m-widget14__legend" data-value="0" id="relationship-Separated">
                                                <span class="m-widget14__legend-bullet m-badge--separated"></span>
                                                <span class="m-widget14__legend-text">0% Separated</span>
                                            </div>
                                            <script type="text/json" id="relationship-series">
                                                [{
                                                    "value": 60,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "green"
                                                    }
                                                }, {
                                                    "value": 20,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "yellow"
                                                    }
                                                }, {
                                                    "value": 14,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "blue"
                                                    }
                                                }, {
                                                    "value": 3,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "orange"
                                                    }
                                                }, {
                                                    "value": 1,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "red"
                                                    }
                                                }, {
                                                    "value": 1,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "yellow"
                                                    }
                                                }, {
                                                    "value": 1,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "pink"
                                                    }
                                                }, {
                                                    "value": 0,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "red"
                                                    }
                                                }, {
                                                    "value": 0,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "orange"
                                                    }
                                                }, {
                                                    "value": 0,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "blue"
                                                    }
                                                }, {
                                                    "value": 0,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "pink"
                                                    }
                                                }, {
                                                    "value": 0,
                                                    "className": "custom",
                                                    "meta": {
                                                        "color": "green"
                                                    }
                                                }]
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end:: Widgets/Profit Share-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end:: Widgets/Profit Share-->
<!--<script src="/assets/plugins/chartist-js/dist/chartist.min.js"></script>-->
<script src="<?php echo base_url() ?>assets/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>

<script>
    $('.list_keyword_social input').click(function() {
        let $parent = $(this).parents('li');
        let color = $parent.attr('data-color');
        if ($parent.hasClass('active')) {
            $parent.removeClass('active');
            $parent.css({
                'color': '#ffffff'
            });
        } else {
            $parent.addClass('active');
            $parent.css({
                'color': color
            });
        }
        $('.form_filters_post').submit();
    });
    if ($('#m_chart_social').length > 0) {
        var socials = JSON.parse($('#socials').html());
        new Chartist.Pie('#m_chart_social', {
            series: socials,
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
        }, {
            donut: 1,
            donutWidth: 17,
            showLabel: !1,
        }).on('draw', function(e) {
            if ('slice' === e.type) {
                var t = e.element._node.getTotalLength();
                e.element.attr({
                    'stroke-dasharray': t + 'px ' + t + 'px',
                });
                var a = {
                    'stroke-dashoffset': {
                        id: 'anim' + e.index,
                        dur: 1e2,
                        from: -t + 'px',
                        to: '0px',
                        easing: Chartist.Svg.Easing.easeOutQuint,
                        fill: 'freeze',
                        stroke: e.meta.color,
                    },
                };
                0 !== e.index && (a['stroke-dashoffset'].begin = 'anim' + (e.index - 1) + '.end'), e.element.attr({
                    'stroke-dashoffset': -t + 'px',
                    stroke: e.meta.color,
                }), e.element.animate(a, !1);
            }
        });
    }
    if ($('#m_chart_posts').length > 0) {
        var posts = JSON.parse($('#posts').html());
        new Chartist.Pie('#m_chart_posts', {
            series: posts,
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
        }, {
            donut: 1,
            donutWidth: 17,
            showLabel: !1,
        }).on('draw', function(e) {
            if ('slice' === e.type) {
                var t = e.element._node.getTotalLength();
                e.element.attr({
                    'stroke-dasharray': t + 'px ' + t + 'px',
                });
                var a = {
                    'stroke-dashoffset': {
                        id: 'anim' + e.index,
                        dur: 1e2,
                        from: -t + 'px',
                        to: '0px',
                        easing: Chartist.Svg.Easing.easeOutQuint,
                        fill: 'freeze',
                        stroke: e.meta.color,
                    },
                };
                0 !== e.index && (a['stroke-dashoffset'].begin = 'anim' + (e.index - 1) + '.end'), e.element.attr({
                    'stroke-dashoffset': -t + 'px',
                    stroke: e.meta.color,
                }), e.element.animate(a, !1);
            }
        });
    }
    if ($('#m_chart_channel_types').length > 0) {
        var channelTypes = JSON.parse($('#channelTypes').html());
        new Chartist.Pie('#m_chart_channel_types', {
            series: channelTypes,
            labels: [1, 2, 3, 4, 5, 6, 7, 8],
        }, {
            donut: 1,
            donutWidth: 17,
            showLabel: !1,
        }).on('draw', function(e) {
            if ('slice' === e.type) {
                var t = e.element._node.getTotalLength();
                e.element.attr({
                    'stroke-dasharray': t + 'px ' + t + 'px',
                });
                var a = {
                    'stroke-dashoffset': {
                        id: 'anim' + e.index,
                        dur: 1e2,
                        from: -t + 'px',
                        to: '0px',
                        easing: Chartist.Svg.Easing.easeOutQuint,
                        fill: 'freeze',
                        stroke: e.meta.color,
                    },
                };
                0 !== e.index && (a['stroke-dashoffset'].begin = 'anim' + (e.index - 1) + '.end'), e.element.attr({
                    'stroke-dashoffset': -t + 'px',
                    stroke: e.meta.color,
                }), e.element.animate(a, !1);
            }
        });
    }
    // if ($('#m_chart_ages').length > 0) {
    //   var series = JSON.parse($('#ages-series').html());
    //   console.log(series);
    //   new Chartist.Pie('#m_chart_ages', {
    //     series: series,
    //     labels: [1, 2, 3, 4, 5, 6, 7, 8],
    //   }, {
    //     donut: 1,
    //     donutWidth: 17,
    //     showLabel: !1,
    //   }).on('draw', function(e) {
    //     if ('slice' === e.type) {
    //       var t = e.element._node.getTotalLength();
    //       e.element.attr({
    //         'stroke-dasharray': t + 'px ' + t + 'px',
    //       });
    //       var a = {
    //         'stroke-dashoffset': {
    //           id: 'anim' + e.index,
    //           dur: 1e2,
    //           from: -t + 'px',
    //           to: '0px',
    //           easing: Chartist.Svg.Easing.easeOutQuint,
    //           fill: 'freeze',
    //           stroke: e.meta.color,
    //         },
    //       };
    //       0 !== e.index && (a['stroke-dashoffset'].begin = 'anim' + (e.index - 1) + '.end'), e.element.attr({
    //         'stroke-dashoffset': -t + 'px',
    //         stroke: e.meta.color,
    //       }), e.element.animate(a, !1);
    //     }
    //   });
    // }
</script>