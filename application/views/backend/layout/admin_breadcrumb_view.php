<!-- -------------- Topbar -------------- -->
<?php
/**
 * @var  $breadcrumbs
 * @var  $baseLink
 */

?>
<header id="topbar" class="affix alt">
    <div class="topbar-left">
        <ol class="breadcrumb">
            <li class="">
                <a href="javascript::void()" class="text-system"></a>
            </li>
            <?php if (isset($breadcrumbs)): ?>
                <?php foreach ($breadcrumbs as $k => $bread): ?>
                    <?php if (isset($bread['url'])): ?>
                        <li class="breadcrumb-link">
                            <a class="text-system" href="<?php echo $bread['url'] ?>"><?php echo $bread['label'] ?></a>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-current-item "><?php echo $bread ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ol>
        <!---->
        <!--        <ol class="breadcrumb">-->
        <!---->
        <!--            <li class="breadcrumb-active">-->
        <!--                <a href="dashboard1.html">Dashboard</a>-->
        <!--            </li>-->
        <!--            <li class="breadcrumb-link">-->
        <!--                <a href="dashboard1.html">Home</a>-->
        <!--            </li>-->
        <!--            <li class="breadcrumb-current-item">Dashboard</li>-->
        <!--        </ol>-->
    </div>
    <div class="topbar-right">
        <ol class="breadcrumb">
            <li class="breadcrumb-link">
                <a href="<?php echo $baseLink?>" title="Trở về" class="text-system">
                    <i class="fa fa-backward breadcrumb-icon" style="background: none;color: #000"></i>
                </a>
            </li>
            <li>
                <a class="text-system" href="<?php echo $baseLink?>">  Trở về</a>
            </li>

        </ol>
    </div>
</header>
<!-- -------------- /Topbar -------------- -->