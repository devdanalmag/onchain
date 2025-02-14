<div id="bdo">
</div>
<div class="page-content header-clear-medium">
<h1 class="p-relative">Dashboard</h1>

<div class="wrapper d-grid gap-20">
    <div class="popup" id="fund">
        <!-- <span id="copy-alert"></span> -->
        <?php if ($controller->getConfigValue($data2, "monifyFeStatus") == "On"): ?>
            <?php $chargesText = $controller->getConfigValue($data2, "monifyCharges"); ?>
            <?php if ($chargesText == 50 || $chargesText == "50") {
                $chargesText = "N" . $chargesText;
            } else {
                $chargesText = $chargesText . "%";
            } ?>
            <div class="tickets p-20 bg-white rad-10">
                <img src="<?php echo HOME_IMAGE_LOC; ?>/Opay-New-Logo-2023-.png" width="100" alt="" />
                <h4 class="mt-0 mb-10">Bank-name: Fidelity Bank <br> Account Name: Abdullmajid <br> Account-No:
                    <?php echo $data->sFidelityBank; ?></h4>
                <div class="d-flex txt-c gap-20 f-wrap">
                </div>
                <div class="do d-flex">
                    <!-- <div class="fs-14"> -->
                    <button type="button" class="btn d-block visit fs-14 bg-blue c-white w-fit btn-shape btn-bold"
                        style="width: 39%; font-size: medium; margin-left: 30%;"
                        onclick="copyToClipboard(<?php echo $data->sFidelityBank; ?>);">Copy Acc
                        No</button>
                    <!-- </div> -->
                </div>
            </div>
            <br>
        <?php endif;
        if ($controller->getConfigValue($data2, "monifyMoStatus") == "On"): ?>
            <div class="tickets p-20 bg-white rad-10">
                <img src="<?php echo HOME_IMAGE_LOC; ?>/Moniepoint.png" width="100" alt="" />
                <h4 class="mt-0 mb-10">Bank-name: Moniepoint Bank <br> Account Name: Abdullmajid <br> Account-No:
                    <?php echo $data->sRolexBank; ?></h4>
                <div class="d-flex txt-c gap-20 f-wrap">
                </div>
                <div class="do d-flex">
                    <!-- <div class="fs-14"> -->
                    <button type="button" class="btn d-block visit fs-14 bg-blue c-white w-fit btn-shape btn-bold"
                        style="width: 39%; font-size: medium; margin-left: 30%;"
                        onclick="copyToClipboard(<?php echo $data->sRolexBank; ?>);">Copy Acc
                        No</button>
                    <!-- </div> -->
                </div>
            </div>
            <br>
        <?php endif;
        if ($controller->getConfigValue($data2, "monifyWeStatus") == "On"): ?>
            <div class="tickets p-20 bg-white rad-10">
                <img src="<?php echo HOME_IMAGE_LOC; ?>/Sterling.png" width="100" alt="" />
                <h4 class="mt-0 mb-10">Bank-name: Wema Bank <br> Account Name: Abdullmajid <br> Account-No:
                    <?php echo $data->sBankNo; ?></h4>
                <div class="d-flex txt-c gap-20 f-wrap">
                </div>
                <div class="do d-flex">
                    <!-- <div class="fs-14"> -->
                    <button type="button" class="btn d-block visit fs-14 bg-blue c-white w-fit btn-shape btn-bold"
                        style="width: 39%; font-size: medium; margin-left: 30%;"
                        onclick="copyToClipboard(<?php echo $data->sBankNo; ?>);">Copy Acc
                        No</button>
                    <!-- </div> -->
                </div>
            </div>
        <?php endif; ?>
        <!-- <br>
          <div class="tickets p-20 bg-white rad-10">
            <h2 class="mt-0 mb-10">Withdraw, Fund Buy Data Airtem E.T.C</h2>
            <div class="d-flex txt-c gap-20 f-wrap">
            </div>
          </div> -->
        <br>
        <div class="do d-flex">
            <!-- <div class="fs-14"> -->
            <button type="button" class="btn d-block visit fs-14 bg-orange c-white w-fit btn-shape btn-bold"
                style="width: 39%; font-size: medium; margin-left: 30%;"
                onclick="closeNotification('fund');">Ok</button>
            <!-- </div> -->
        </div>
    </div>
    <!-- start welcome -->
    <div class="welcome tickets bg-white rad-10 txt-c-mobile block-mobile">
        <div class="intro p-20 d-flex space-between bg-eee">
            <div>
                <h2 class="m-0">Welcome</h2>
                <p class="c-grey mt-5"></p>
            </div>
            <img class="hide-mobile"
                src="<?php echo HOME_IMAGE_LOC; ?>/2012.i605.033_design_studio-removebg-preview.png" alt="" />
        </div>
        <img src="<?php echo HOME_IMAGE_LOC; ?>/IMG_20220602_160945_858.jpg" alt="#" class="avatar" />
        <div class="body txt-c d-flex p-20 mt-20 mb-20 block-mobile">
            <div>
                <?php echo "Hi, " . $data->sFname; ?> <span class="d-block c-grey fs-14 mt-10">
                    <?php echo $controller->formatUserType($data->sType); ?>
                </span>
            </div>
            <div>
                <b><b class="c-blue" id="Wbalance"
                        amount="₦<?php echo number_format($data->sWallet); ?>">**,***</b><span
                        class="d-block c-grey fs-14 mt-10">Wallet Balance</span></b>
            </div>
            <div>
                <i id="Ebalance" amount="₦<?php echo number_format($data->sRefWallet); ?>">**,***</i><span
                    class="d-block c-grey fs-14 mt-10">Earned</span>
            </div>
            <div>
                80 <span class="d-block c-grey fs-14 mt-10">Task Completed</span>
            </div>
        </div>
        <div>
            <span class="d-block c-grey fs-14 w-fit mt-10" style="padding-left:10%;"> <a><i onclick="hide_amount();"
                        class="fa fa-eye fa-2x show-hide" id="eye-show" style="display: none;"></i>
                    <i onclick="show_amount();" class="fa fa-eye-slash fa-2x show-hide" id="eye-hide"></i></a>
            </span>
        </div>
        <a href="profile" class="visit d-block fs-14 bg-blue c-white w-fit btn-shape">Profile</a>
    </div>
    <!-- end welcome -->

    <div class="tickets p-20 bg-white rad-10">
        <div class="d-flex txt-c gap-20 f-wrap">
            <div class="box p-20 rad-10 fs-13 c-grey" style="width: calc(100% - 10px);">
                <a href="#" onclick="showNotification('fund');">
                    <i class="fa fa-arrow-up fa-4x funding"></i>
                    <span class="d-block c-black fw-bold fs-25 mb-5">FUND Wallet</span>
                </a>
            </div>
            <br>
            <div class="box p-20 rad-10 fs-13 c-grey" style="width: calc(100% - 10px);">
                <a href="transfer">
                    <!-- <a href="#" onclick="showNotification('withdraw');"> -->
                    <i class="fa fa-arrow-down fa-4x withdraw"></i>
                    <span class="d-block c-black fw-bold fs-25 mb-5">Withdraw To Wallet</span>
                </a>
            </div>
        </div>

    </div>

    <!-- start draft -->
    <div class="tickets p-20 bg-white rad-10">
        <h2 class="mt-0 mb-10">Services</h2>
        <div class="d-flex txt-c gap-20 f-wrap">

            <div class="box p-20 rad-10 fs-13 c-grey">
                <a href="giveaway">
                    <i class="fa fa-gift fa-4x"></i>
                    <span class="d-block c-black fw-bold fs-25 mb-2" style="" >Giveaway's</span>
                </a>
            </div>
            <div class="box p-20 rad-10 fs-13">
                <a href="2bank">
                    <!-- <a href="#" onclick="showNotification('withdraw');"> -->
                    <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60">
                        <path
                            d="M12,12a3,3,0,1,0,3,3A3,3,0,0,0,12,12Zm0,4a1,1,0,1,1,1-1A1,1,0,0,1,12,16Zm-.71-6.29a1,1,0,0,0,.33.21.94.94,0,0,0,.76,0,1,1,0,0,0,.33-.21L15,7.46A1,1,0,1,0,13.54,6L13,6.59V3a1,1,0,0,0-2,0V6.59L10.46,6A1,1,0,0,0,9,7.46ZM19,15a1,1,0,1,0-1,1A1,1,0,0,0,19,15Zm1-7H17a1,1,0,0,0,0,2h3a1,1,0,0,1,1,1v8a1,1,0,0,1-1,1H4a1,1,0,0,1-1-1V11a1,1,0,0,1,1-1H7A1,1,0,0,0,7,8H4a3,3,0,0,0-3,3v8a3,3,0,0,0,3,3H20a3,3,0,0,0,3-3V11A3,3,0,0,0,20,8ZM5,15a1,1,0,1,0,1-1A1,1,0,0,0,5,15Z"
                            fill="blue"></path>
                    </svg>
                    <span class="d-block c-black fw-bold fs-25 mb-2">Cashout</span></a>
            </div>

            <div class="box p-20 rad-10 fs-13 c-grey">
                <a href="buy-airtime">
                    <i class="fa fa-phone fa-4x"></i>
                    <span class="d-block c-black fw-bold fs-25 mb-2">AIRTIME</span>
                </a>
            </div>
            <div class="box p-20 rad-10 fs-13">
                <a href="buy-data">
                    <i class="fa fa-wifi fa-4x c-green"></i>
                    <span class="d-block c-black fw-bold fs-25 mb-2">DATA</span></a>
            </div>
        </div>
    </div>
    <!-- end draft -->
    <div class="popup" id="withdraw">
        <!-- <span id="copy-alert"></span> -->
        <div class="do d-flex">
            <!-- <div class="fs-14"> -->
            <button type="button" class="btn d-block visit fs-14 bg-orange c-white w-fit btn-shape btn-bold"
                style="width: 39%; font-size: medium; margin-left: 30%;"
                onclick="closeNotification('withdraw');">Ok</button>
            <!-- </div> -->
        </div>
    </div>
    </div></div>
    <div class="gap-50"> <br> <br></div>
