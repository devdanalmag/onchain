<div class="page-content header-clear-medium">


    <div class="card card-style bg-theme pb-0">
        <div class="content" id="tab-group-1">
            <div class="tab-controls tabs-small tabs-rounded" data-highlight="bg-highlight">
                <a href="#" data-active data-bs-toggle="collapse" data-bs-target="#tab-1">Profile</a>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-2">Password</a>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-3">Pin</a>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#tab-4">S/Media</a>

            </div>
            <div class="clearfix mb-3"></div>
            <div data-bs-parent="#tab-group-1" class="collapse show" id="tab-1">
                <p class="mb-n1 color-highlight font-600 font-12">Account Details</p>
                <h4>Basic Information</h4>

                <div class="list-group list-custom-small">
                    <a href="#">
                        <i class="fa font-14 fa-user rounded-xl shadow-xl color-blue-dark"></i>
                        <span><b>Name: </b> <?php echo $data->sFname . " " . $data->sLname; ?></span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <a href="#">
                        <i class="fa font-14 fa-envelope rounded-xl shadow-xl color-blue-dark"></i>
                        <span><b>Email: </b> <?php echo $data->sEmail; ?></span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <a href="#">
                        <i class="fa font-14 fa-phone rounded-xl shadow-xl color-blue-dark"></i>
                        <span><b>Phone: </b> <?php echo $data->sPhone; ?></span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <a href="#">
                        <i class="fa font-14 fa-globe rounded-xl shadow-xl color-blue-dark"></i>
                        <span><b>State: </b> <?php echo $data->sState; ?></span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

                <p class="mb-n1 mt-2 color-highlight font-600 font-12">Referral</p>
                <h4>Referral Link</h4>
                <div class="list-group list-custom-small">
                    <a href="#">
                        <input type="text" class="form-control" readonly
                            value="<?php echo $siteurl . "mobile/register/?referral=" . $data->sPhone; ?>" />
                    </a>
                    <a href="#">
                        <button class="btn btn-danger btn-sm"
                            onclick='copyToClipboard("<?php echo $siteurl . "mobile/register/?referral=" . $data->sPhone; ?>")'>Copy
                            Link</button>
                        <button class="btn btn-success btn-sm" onclick="window.open('referrals')">View
                            Commission</button>
                    </a>
                </div>
                <?php if ($data->sType == 3): ?>
                    <p class="mb-n1 mt-2 color-highlight font-600 font-12">Developer</p>
                    <h4>Api Documentation</h4>
                    <div class="list-group list-custom-small">
                        <a href="#">
                            <input type="text" class="form-control" readonly value="<?php echo $data->sApiKey; ?>" />
                        </a>
                        <a href="#">
                            <button class="btn btn-danger btn-sm"
                                onclick="copyToClipboard('<?php echo $data->sApiKey; ?>')">Copy Api Key</button>
                            <?php if (!empty($data2)): ?>
                                <button class="pl-5 btn btn-success btn-sm"
                                    onclick="window.open('<?php echo $data2->apidocumentation; ?>')">View Documentation</button>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <div data-bs-parent="#tab-group-1" class="collapse" id="tab-2">
                <p class="mb-n1 color-highlight font-600 font-12">Update Login Details</p>
                <h4>Login Details</h4>

                <form id="passForm" method="post">
                    <div class="mt-5 mb-3">

                        <div class="input-style has-borders no-icon input-style-always-active mb-4">
                            <input type="password" class="form-control" id="old-pass" name="oldpass"
                                placeholder="Old Password" required>
                            <label for="old-pass" class="color-highlight">Old Password</label>
                            <em>(required)</em>
                        </div>
                        <div class="input-style has-borders no-icon input-style-always-active  mb-4">
                            <input type="password" class="form-control" id="new-pass" name="newpass"
                                placeholder="New Password" required>
                            <label for="new-pass" class="color-highlight">New Password</label>
                            <em>(required)</em>
                        </div>

                        <div class="input-style has-borders no-icon input-style-always-active mb-4">
                            <input type="password" class="form-control" id="retype-pass" placeholder="Retype Password"
                                required>
                            <label for="retype-pass" class="color-highlight">Retype Password</label>
                            <em>(required)</em>
                        </div>
                    </div>
                    <button type="submit" id="update-pass-btn" style="width: 100%;"
                        class="btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                        Update Password
                    </button>
                </form>
            </div>

            <div data-bs-parent="#tab-group-1" class="collapse" id="tab-3">
                <p class="mb-n1 color-highlight font-600 font-12">Update Transaction Pin</p>
                <h4>Transaction Pin</h4>

                <form id="pinForm" method="post">
                    <div class="mt-3 mb-3">
                        <p class="text-danger"><b>Note: </b> The Default Transaction Pin Is '1234'. Your Transaction Pin
                            should be a four digit number. </p>
                        <div class="input-style has-borders no-icon input-style-always-active mb-4">
                            <input type="number" class="form-control" id="old-pin" name="oldpin" placeholder="Old Pin"
                                required>
                            <label for="old-pin" class="color-highlight">Old Pin</label>
                            <em>(required)</em>
                        </div>
                        <div class="input-style has-borders no-icon input-style-always-active  mb-4">
                            <input type="number" class="form-control" id="new-pin" name="newpin" placeholder="New Pin"
                                required>
                            <label for="new-pin" class="color-highlight">New Pin</label>
                            <em>(required)</em>
                        </div>

                        <div class="input-style has-borders no-icon input-style-always-active mb-4">
                            <input type="number" class="form-control" id="retype-pin" placeholder="Retype Pin" required>
                            <label for="retype-pin" class="color-highlight">Retype Pin</label>
                            <em>(required)</em>
                        </div>
                    </div>
                    <button type="submit" id="update-pin-btn" style="width: 100%;"
                        class="btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                        Update Pin
                    </button>
                </form>

                <hr />

                <p class="mb-n1 color-highlight font-600 font-12">Disable Transaction Pin</p>
                <h4>Disable Pin</h4>

                <form class="the-submit-form" method="post">
                    <div class="mt-3 mb-3">
                        <p class="text-danger"><b>Note: </b> Only Disable Pin When You Are Sure About The Security Of
                            Your Phone And Your Account Is Secured With A Strong Password. </p>
                        <div class="input-style has-borders no-icon input-style-always-active mb-4">
                            <input type="number" maxlength="4" class="form-control" id="old-pin" name="oldpin"
                                placeholder="Old Pin" required>
                            <label for="old-pin" class="color-highlight">Old Pin</label>
                            <em>(required)</em>
                        </div>
                        <div class="input-style has-borders no-icon input-style-always-active  mb-4">
                            <select name="pinstatus">
                                <option value="">Change Status</option>
                                <?php if ($data->sPinStatus == 0): ?>
                                    <option value="0" selected>Enable</option>
                                    <option value="1">Disable</option>
                                <?php else: ?>
                                    <option value="0">Enable</option>
                                    <option value="1" selected>Disable</option>
                                <?php endif; ?>
                            </select><label for="new-pin" class="color-highlight">Change Status</label>
                            <em>(required)</em>
                        </div>
                    </div>
                    <button type="submit" name="disable-user-pin" style="width: 100%;"
                        class="the-form-btn btn btn-full btn-l font-600 font-15 gradient-highlight mt-4 rounded-s">
                        Update Pin
                    </button>
                </form>
            </div>
            <div data-bs-parent="#tab-group-1" class="collapse" id="tab-4">
            <h4>S/media Account</h4>
                <div class="friends d-grid m-20 gap-20">
                    <div class="friend rad-6 p-10 p-relative " style="background-color:#E8E0D9DE !important;">
                        <div class="contact ">
                            <i class="fa fa-youtube "></i>
                            <i class="fa fa-solid fa-message"></i>
                        </div>
                        <div class="txt-c">
                            <img class="rad-half mt-10 mb-10"style="width: 150px; heidth: 150px;"
                                src="<?php echo HOME_IMAGE_LOC; ?>/IMG_20220602_160945_858.jpg" alt="#">
                            <h4 class="m-0">Mohammad Zayed</h4>
                            <a href="#" class="c-grey fs-13 mt-0 mb-0">Tab Here To view Link</a>
                        </div>
                        <div class="icons fs-14 p-relative">
                        <div class="mb-10">
                                <span>S/media: <i class="fa fa-tiktok"></i>TikTok</span>
                            </div>
                            <div class="mb-10">
                                <span>Followers: 500</span>
                            </div>
                            <div class="mb-10">
                                <span>Following: 500</span>
                            </div>
                            <div class="mb-10">
                                <span>Likes: 20</span>
                            </div>
                            <div class="mb-10">
                                <span>Videos: 200</span>
                            </div>
                        </div>
                        <div class="info between-flex fs-13">
                            <span class="c-grey">Date: 02/10/2022</span>
                            <div class="">
                                <a class="bg-blue c-white btn-shape" href="profile.html">Start the Tasks</a>
                            </div>
                        </div>
                    </div>
                    <div class="friend rad-6 p-10 p-relative " style="background-color:#E8E0D9DE !important;">
                    <div class="txt-c">
                            <img class="rad-half mt-10 mb-10"style="width: 100px; heidth: 100px;"
                                src="<?php echo HOME_IMAGE_LOC; ?>/youtube_icon.png" alt="#">
                            <h4 class="m-0">Youtube</h4>
                            <a href="#" class="c-grey fs-13 mt-0 mb-0">Get Autorize on Youtube</a>
                        </div>  
                    <button class="bg-blue c-white btn-shape w-50" style="margin:25%; margin-top:40%; height: 12% !important;" href="profile.html">Tab To Get Autorize</button>
                    </div>

                    </div>
                </div>
        </div>
    </div>

</div>