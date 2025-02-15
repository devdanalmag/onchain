<script>
    function trythis() {
        var myid = 10;
        $.ajax({
            url: 'home/includes/route.php?uid',
            data: {
                uid: myid
            },
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {
                console.log(resp);
                if (resp == 1) {
                    alert(resp);
                }
                else {
                    alert(resp);
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error('Error:', error);
            }
        });
    }
    $("document").ready(function () {

        //Dispaly Home Notification
        <?php echo $homemsg; ?>

        $("#thetranspin").val(null);

        $("#hideEye").click(function () {
            $("#hideEyeDiv").show();
            $("#openEyeDiv").hide();
            $("#openEye").show();
            $("#hideEye").hide();
        });

        $("#openEye").click(function () {
            $("#openEyeDiv").show();
            $("#hideEyeDiv").hide();
            $("#hideEye").show();
            $("#openEye").hide();
        });

        $(".the-submit-form").submit(function () {
            $('.the-form-btn').removeClass("gradient-highlight");
            $('.the-form-btn').addClass("btn-secondary");
            $('.the-form-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        //Update Profile Password
        $("#passForm").submit(function (e) {
            e.preventDefault();

            if ($("#new-pass").val() != $("#retype-pass").val()) {
                swal("Error!", "New Password & Retype Password Don't Match.", "error");
                return 0;
            }

            $('#update-pass-btn').removeClass("gradient-highlight");
            $('#update-pass-btn').addClass("btn-secondary");
            $('#update-pass-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating ...');


            $.ajax({
                url: 'home/includes/route.php?update-pass',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (resp) {
                    console.log(resp);
                    if (resp == 0) {
                        swal('Alert!!', "Password Updated Successfully.", "success");
                        $("#old-pass").val("");
                        $("#new-pass").val("");
                        $("#retype-pass").val("");
                    } else if (resp == 1) {
                        swal('Alert!!', "Old Password Is Incorrect.", "error");
                        $("#old-pass").val("");
                        $("#new-pass").val("");
                        $("#retype-pass").val("");
                    } else {
                        swal('Alert!!', "Unknow Error, Please Contact Our Customer Support", "error");
                    }

                    $('#update-pass-btn').removeClass("btn-secondary");
                    $('#update-pass-btn').addClass("gradient-highlight");
                    $('#update-pass-btn').html("Update Password");

                }
            });

        });

        //Update Transaction Pin
        $("#pinForm").submit(function (e) {
            e.preventDefault();

            if ($("#new-pin").val() != $("#retype-pin").val()) {
                swal("Error!", "New Pin & Retype Pin Don't Match.", "error");
                return 0;
            }

            if ($("#old-pin").val().length < 4) {
                $(this).val(null);
                swal("Opps!!", "Pin Length Should Be Four Digits.", "info");
                return;
            }
            if ($("#new-pin").val().length < 4) {
                $(this).val(null);
                swal("Opps!!", "Pin Length Should Be Four Digits.", "info");
                return;
            }
            if ($("#retype-pin").val().length < 4) {
                $(this).val(null);
                swal("Opps!!", "Pin Length Should Be Four Digits.", "info");
                return;
            }

            $('#update-pin-btn').removeClass("gradient-highlight");
            $('#update-pin-btn').addClass("btn-secondary");
            $('#update-pin-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating ...');


            $.ajax({
                url: 'home/includes/route.php?update-pin',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (resp) {
                    console.log(resp);
                    if (resp == 0) {
                        swal('Alert!!', "Pin Updated Successfully.", "success");
                        $("#old-pin").val("");
                        $("#new-pin").val("");
                        $("#retype-pin").val("");
                    } else if (resp == 1) {
                        swal('Alert!!', "Old Pin Is Incorrect.", "error");
                        $("#old-pin").val("");
                        $("#new-pin").val("");
                        $("#retype-pin").val("");
                    } else {
                        swal('Alert!!', "Unknow Error, Please Contact Our Customer Support", "error");
                    }

                    $('#update-pin-btn').removeClass("btn-secondary");
                    $('#update-pin-btn').addClass("gradient-highlight");
                    $('#update-pin-btn').html("Update Pin");

                }
            });

        });

        $("#old-pin").on("keyup", function () {
            if (isNaN($(this).val())) {
                $(this).val(null);
                swal("Opps!!", "Please Enter A Numeric Value.", "info");
            }
        });

        $("#new-pin").on("keyup", function () {
            if (isNaN($(this).val())) {
                $(this).val(null);
                swal("Opps!!", "Please Enter A Numeric Value.", "info");
            }
        });

        $("#retype-pin").on("keyup", function () {
            if (isNaN($(this).val())) {
                $(this).val(null);
                swal("Opps!!", "Please Enter A Numeric Value.", "info");
            }
        });


        // ----------------------------------------------------------------------------
        // Airtime Management
        // ----------------------------------------------------------------------------

        $("#transpinbtn").click(function () {
            let actionbtn = $(this).attr("action-btn");
            $("#transkey").val($("#thetranspin").val());
            $("#" + actionbtn).click();
        });

        $("#networktype").on("change", function () {
            $("#airtimeamount").val(null);
            $("#amounttopay").val(null);
            $("#discount").val(null);
        });

        $("#airtimeamount").on("keyup", function () {
            var airtimediscount = '<?php echo (!empty($data2) && is_string($data2)) ? $data2 : ""; ?>';
            if (!airtimediscount == "") {
                airtimediscount = JSON.parse(airtimediscount);
            }
            var amounttopay = 0;
            var discount = 0;
            var useraccount = getCookie("loginAccount");
            useraccount = useraccount.replace(/%3D/g, "=");
            useraccount = atob(useraccount);
            useraccount = parseInt(useraccount);

            var amount = $("#airtimeamount").val();
            amount = parseInt(amount);

            if ($("#networkid").val() == "" || $("#networkid").val() == null) {
                swal("Opps!!", "Please Select A Network First.", "info");
                $("#airtimeamount").val(null);
                return 0;
            }

            for (i = 0; i < airtimediscount.length; i++) {
                if (airtimediscount[i].aNetwork == $("#networkid").val() && airtimediscount[i].aType == $("#networktype").val()) {
                    if (useraccount == 3 || useraccount == '3') {
                        discount = airtimediscount[i].aVendorDiscount;
                    } else if (useraccount == 2 || useraccount == '2') {
                        discount = airtimediscount[i].aAgentDiscount;
                    } else {
                        discount = airtimediscount[i].aUserDiscount;
                    }
                    discount = parseInt(discount);
                    amounttopay = (amount * discount) / 100;
                    discount = 100 - discount;
                }
            }

            $("#amounttopay").val(amounttopay);
            $("#discount").val(discount + "%");

        });


        //Purchase Airtime
        $("#airtimeForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "airtime-btn");

                let msg = "You are about to purchase an ";
                msg += '"' + $('#networkid').find(":selected").attr('networkname') + '"' + " airtime of ";
                msg += '"' + $("#airtimeamount").val() + '"' + " for the phone number " + '"' + $("#phone").val() + '"';
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#airtime-btn').removeClass("gradient-highlight");
            $('#airtime-btn').addClass("btn-secondary");
            $('#airtime-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        // ----------------------------------------------------------------------------
        // Cable Plan Management
        // ----------------------------------------------------------------------------

        //If provider selected, get plans
        $("#cableid").on("change", function () {
            if ($("#cableid").val() == '' || $("#cableid").val() == null) {
                swal("Opps!!", "Please Select A Provider First.", "info");
            } else {
                let provider = $("#cableid").val();
                let useraccount = getCookie("loginAccount");
                let plans = '<?php echo (!empty($data2) && is_string($data2)) ? $data2 : ""; ?>';
                let options = "<option value=''>Select Plan</option>";
                let price = 0;

                useraccount = useraccount.replace(/%3D/g, "=");
                useraccount = atob(useraccount);
                useraccount = parseInt(useraccount);

                if (!plans == "") {

                    plans = JSON.parse(plans);

                    for (i = 0; i < plans.length; i++) {

                        if (useraccount == 3 || useraccount == '3') {
                            price = plans[i].vendorprice;
                        } else if (useraccount == 2 || useraccount == '2') {
                            price = plans[i].agentprice;
                        } else {
                            price = plans[i].userprice;
                        }

                        if (plans[i].cableprovider == provider) {
                            options += "<option value='" + plans[i].cpId + "' cableprice='" + price + "' planname='" + plans[i].name + " (N" + plans[i].price + ")(" + plans[i].day + " Days) '>" + plans[i].name + " (N" + plans[i].price + ")(" + plans[i].day + " Days) </option>";
                        }

                    }

                }

                $("#cableplan").html(options);
                $("#amounttopay").val(null);

            }
        });

        //If Cable Plan Is Selected, Get And Set The Price
        $("#cableplan").on("change", function () {
            $("#amounttopay").val("N" + $('#cableplan').find(":selected").attr('cableprice'));
            $("#cabledetails").val($('#cableplan').find(":selected").attr('planname'));
        });

        //Verify cableplan
        $("#verifycableplanForm").submit(function (e) {

            $('#cable-btn').removeClass("gradient-highlight");
            $('#cable-btn').addClass("btn-secondary");
            $('#cable-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        //Purchase Cable Plan
        $("#cableplanForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "cable-btn");

                let msg = "You are about to purchase ";
                let cableplan = $('#cabledetails').val();
                msg += '"' + cableplan + " for the IUC Number " + '"' + $("#iucnumber").val() + '"';
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#cable-btn').removeClass("gradient-highlight");
            $('#cable-btn').addClass("btn-secondary");
            $('#cable-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        // ----------------------------------------------------------------------------
        // Recharge Card Pin Management
        // ----------------------------------------------------------------------------
        $("#rechargepinamount").on("keyup", function () {
            $("#amounttopay").val(null);
            $("#norechargepin").val(null);
        });

        $("#norechargepin").on("keyup", function () {

            if ($("#rechargepinamount").val() != null || $("#norechargepin").val() != null) {
                var airtimediscount = '<?php echo (!empty($data2) && is_string($data2)) ? $data2 : ""; ?>';
                if (!airtimediscount == "") {
                    airtimediscount = JSON.parse(airtimediscount);
                }
                var amounttopay = 0;
                var discount = 0;
                var useraccount = getCookie("loginAccount");
                useraccount = useraccount.replace(/%3D/g, "=");
                useraccount = atob(useraccount);
                useraccount = parseInt(useraccount);

                var amount = $("#rechargepinamount").val();
                let quantity = parseInt($("#norechargepin").val());

                amount = parseInt(amount);
                quantity = parseInt(quantity);

                if ($("#networkid").val() == "" || $("#networkid").val() == null) {
                    swal("Opps!!", "Please Select A Network First.", "info");
                    $("#rechargepinamount").val(null);
                    return 0;
                }

                for (i = 0; i < airtimediscount.length; i++) {
                    if (airtimediscount[i].aNetwork == $("#networkid").val()) {
                        if (useraccount == 3 || useraccount == '3') {
                            discount = airtimediscount[i].aVendorDiscount;
                        } else if (useraccount == 2 || useraccount == '2') {
                            discount = airtimediscount[i].aAgentDiscount;
                        } else {
                            discount = airtimediscount[i].aUserDiscount;
                        }
                        discount = parseInt(discount);
                        if (!(quantity > 0)) {
                            quantity = 0;
                        }
                        if (!(amount > 0)) {
                            amount = 0;
                        }
                        amounttopay = amount * quantity;
                        amounttopay = (amounttopay * discount) / 100;
                        discount = 100 - discount;
                    }
                }

                $("#amounttopay").val(amounttopay);
                $("#discount").val(discount + "%");
            } else {
                $("#amounttopay").val("0");
            }
        });

        //Purchase Exam Pin
        $("#rechargepinForm").submit(function (e) {

            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "rechargepin-btn");

                let msg = "You are about to purchase ";
                msg += $("#norechargepin").val() + ' unit of N' + $("#rechargepinamount").val() + ' ';
                msg += $('#networkid').find(":selected").attr('networkname') + " recharge card pin at the price of N" + $("#amounttopay").val() + " with the business name " + $("#businessname").val();
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#rechargepin-btn').removeClass("gradient-highlight");
            $('#rechargepin-btn').addClass("btn-secondary");
            $('#rechargepin-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        // ----------------------------------------------------------------------------
        // Exam Pin Management
        // ----------------------------------------------------------------------------

        $("#examid").on("change", function () {
            $("#amounttopay").val(null);
            $("#examquantity").val(null);
        });

        $("#examquantity").on("keyup", function () {

            if ($("#examid").val() != null || $("#examquantity").val() != null) {
                let price = parseInt($('#examid').find(":selected").attr('providerprice'));
                let quantity = parseInt($("#examquantity").val());
                let amount = 0;

                if (!(quantity > 0)) {
                    quantity = 0;
                }
                if (!(price > 0)) {
                    price = 0;
                }

                amount = price * quantity;

                $("#amounttopay").val("N" + amount);
            } else {
                $("#amounttopay").val("0");
            }

        });

        //Purchase Exam Pin
        $("#exampinForm").submit(function (e) {

            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "exampin-btn");

                let msg = "You are about to purchase ";
                let exampindetails = $('#examid').find(":selected").attr('providername');
                msg += $("#examquantity").val() + ' token of  ' + exampindetails + ' ';
                msg += " pin at the price of " + $("#amounttopay").val();
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#exampin-btn').removeClass("gradient-highlight");
            $('#exampin-btn').addClass("btn-secondary");
            $('#exampin-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });


        // ----------------------------------------------------------------------------
        // Electricity Management
        // ----------------------------------------------------------------------------

        //If Amount Input, Get And Set The Price
        $("#meteramount").on("keyup", function () {
            let amount = parseInt($('#meteramount').val());
            let electricitycharges = parseInt($('#electricitycharges').text());
            let amounttopay = amount + electricitycharges;
            $("#amounttopay").val("N" + amounttopay);
            $("#electricitydetails").val($('#electricityid').find(":selected").attr('providername'));
        });

        $("#verifyelectricityplanForm").submit(function (e) {
            let amount = parseInt($('#meteramount').val());

            if (amount < 1000) {
                e.preventDefault();
                swal("Alert!!", "Minimum Unit Purchase Is N1000.", "error");
                return null;
            }

            $('#electricity-btn').removeClass("gradient-highlight");
            $('#electricity-btn').addClass("btn-secondary");
            $('#electricity-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        //Purchase Electricity Plan
        $("#electricityForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "electricity-btn");

                let msg = "You are about to purchase ";
                let electricitydetails = $('#electricitydetails').val();
                msg += '"' + electricitydetails + " (" + $("#metertype").val() + ") for the Meter Number " + '"' + $("#meternumber").val() + '"';
                msg += " at the price of " + $("#amounttopay").val();
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#electricity-btn').removeClass("gradient-highlight");
            $('#electricity-btn').addClass("btn-secondary");
            $('#electricity-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        // ----------------------------------------------------------------------------
        // Data Plan Management
        // ----------------------------------------------------------------------------

        //If  notwork selected, empty data type, plan, amount
        $("#networkid").on("change", function () {
            $("#datagroup").val(null);
            $("#dataplan").val(null);
            $("#amounttopay").val(null);

            let sme = $('#networkid').find(":selected").attr('sme');
            let gifting = $('#networkid').find(":selected").attr('gifting');
            let corporate = $('#networkid').find(":selected").attr('corporate');
            let vtu = $('#networkid').find(":selected").attr('vtu');
            let sharesell = $('#networkid').find(":selected").attr('sharesell');
            let networkname = $('#networkid').find(":selected").attr('networkname');
            let thegroup = '<option value="">Select Type</option>';

            //Check If Network Is Disabled
            if ($("#networkid").val() == "allnetwork") {
                thegroup += '<option value="smecg">SME/CG</option>';
            }

            if (sme == "On") {
                thegroup += '<option value="SME">SME</option>';
            }

            //Check If Network Is Disabled
            if (gifting == "On") {
                thegroup += '<option value="Gifting">Gifting</option>';
            }

            //Check If Network Is Disabled
            if (corporate == "On") {
                thegroup += '<option value="Corporate">Corporate</option>';
            }

            //Check If Network Is Disabled
            if (vtu == "On") {
                thegroup += '<option value="VTU">VTU</option>';
            }

            //Check If Network Is Disabled
            if (sharesell == "On") {
                thegroup += '<option value="Share And Sell">Share And Sell</option>';
            }
            $("#datagroup").html(thegroup);
            $("#networktype").html(thegroup);
        });

        //If data type selected, get plans
        $("#datagroup").on("change", function () {
            if ($("#networkid").val() == '' || $("#networkid").val() == null) {
                $("#datagroup").val(null);
                swal("Opps!!", "Please Select A Network First.", "info");
            } else {
                let network = $("#networkid").val();
                let datagroup = $("#datagroup").val();
                let useraccount = getCookie("loginAccount");
                let plans = '<?php echo (!empty($data2) && is_string($data2)) ? $data2 : ""; ?>';
                let options = "<option value=''>Select Plan</option>";
                let price = 0;
                let networkname = $('#networkid').find(":selected").attr('networkname');


                useraccount = useraccount.replace(/%3D/g, "=");
                useraccount = atob(useraccount);
                useraccount = parseInt(useraccount);

                if (!plans == "") {

                    plans = JSON.parse(plans);

                    for (i = 0; i < plans.length; i++) {

                        if (useraccount == 3 || useraccount == '3') {
                            price = plans[i].vendorprice;
                        } else if (useraccount == 2 || useraccount == '2') {
                            price = plans[i].agentprice;
                        } else {
                            price = plans[i].userprice;
                        }

                        if (plans[i].datanetwork == network && plans[i].type == datagroup) {
                            options += "<option value='" + plans[i].pId + "' dataprice='" + price + "' dataname='" + plans[i].name + " " + plans[i].type + " (N" + price + ")(" + plans[i].day + " Days) '>" + plans[i].name + " " + plans[i].type + " (N" + price + ")(" + plans[i].day + " Days)</option>";
                        }

                    }

                }

                $("#dataplan").html(options);
                $("#amounttopay").val(null);

            }
        });

        //If Data Plan Is Selected, Get And Set The Price
        $("#dataplan").on("change", function () {
            $("#amounttopay").val("N" + $('#dataplan').find(":selected").attr('dataprice'));
        });

        //Purchase Data
        $("#dataplanForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "data-btn");

                let msg = "You are about to purchase ";
                let dataplan = $('#dataplan').find(":selected").attr('dataname');
                msg += '"' + $('#networkid').find(":selected").attr('networkname') + '" ' + dataplan + " plan of ";
                msg += '"' + $("#amounttopay").val() + '"' + " for the phone number " + '"' + $("#phone").val() + '"';
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#data-btn').removeClass("gradient-highlight");
            $('#data-btn').addClass("btn-secondary");
            $('#data-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });
        // Post Job Form
        $("#postjobForm").submit(function (e) {
            // let jtype = "";
            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "job-btn");
                var jtype = "";
                var ljtype = "";
                var cjtype = "";
                var sjtype = "";
                var vjtype = "";
                var subsjtype = "";
                var fjtype = "";
                function checkck() {
                    if ($("#likeck").is(":checked")) {
                        ljtype = "Like";
                        lprice = 2;
                    }
                    if ($("#followck").is(":checked")) {
                        fjtype = " Follow,";
                        fprice = 2;

                    }
                    if ($("#commentck").is(":checked")) {
                        cjtype = " Comment,";
                        cprice = 2;

                    }
                    if ($("#viewck").is(":checked")) {
                        vjtype = " View,";
                        vprice = 1;

                    }
                    if ($("#subsck").is(":checked")) {
                        subsjtype = " Subscribe,";
                        subsprice = 5;

                    }
                    if ($("#shareck").is(":checked")) {
                        sjtype = " Share,";
                        sprice = 5;

                    }
                    if (!$("#likeck").is(":checked") &&
                        !$("#followck").is(":checked") &&
                        !$("#commentck").is(":checked") &&
                        !$("#viewck").is(":checked") &&
                        !$("#subsck").is(":checked") &&
                        !$("#shareck").is(":checked")) {
                        // alert("")
                        swal("Opps!!", "Please Select Media Type First.", "info");

                        mediaplan = "0";
                        jtype = "Unknown"
                    }
                }
                checkck();
                // $("#amounttopay").val() =10;
                jtype = ljtype + fjtype + cjtype + vjtype + subsjtype + sjtype;
                let msg = "You are about to purchase ";
                let mediaplan = $('#Jobnumbers').find(":selected").val();
                msg += '<b>' + mediaplan + '</b> ' + jtype + " plan of ₦";
                msg += '<b>' + $("#amounttopay").val() + '</b>' + " for the Social Media " + '<b>' + $("#Smedia").val() + '</b>';
                msg += " Link " + '<i>' + $("#jlink").val() + '</i>';
                msg += " <br/> Do you wish to continue?"
                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();
                swal("Alert!!", "Are You Sure The Job link is Correct. To Check Click No and verify Before tranction Confirmation", "error");
                return;
            }

            $('#job-btn').removeClass("gradient-highlight");
            $('#job-btn').addClass("btn-secondary");
            $('#job-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });


        // Create Giveaway Form
        $("#creategiveawayForm").submit(function (e) {
            // let jtype = "";
            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "job-btn");
                var jtype = "";
                var ljtype = "";
                var cjtype = "";
                var sjtype = "";
                var vjtype = "";
                var subsjtype = "";
                var fjtype = "";
                function checkck() {
                    if ($("#likeck").is(":checked")) {
                        ljtype = "Like";
                        lprice = 2;
                    }
                    if ($("#followck").is(":checked")) {
                        fjtype = " Follow,";
                        fprice = 2;

                    }
                    if ($("#commentck").is(":checked")) {
                        cjtype = " Comment,";
                        cprice = 2;

                    }
                    if ($("#viewck").is(":checked")) {
                        vjtype = " View,";
                        vprice = 1;

                    }
                    if ($("#subsck").is(":checked")) {
                        subsjtype = " Subscribe,";
                        subsprice = 5;

                    }
                    if ($("#shareck").is(":checked")) {
                        sjtype = " Share,";
                        sprice = 5;

                    }
                    if (!$("#likeck").is(":checked") &&
                        !$("#followck").is(":checked") &&
                        !$("#commentck").is(":checked") &&
                        !$("#viewck").is(":checked") &&
                        !$("#subsck").is(":checked") &&
                        !$("#shareck").is(":checked")) {
                        // alert("")
                        swal("Opps!!", "Please Select Media Type First.", "info");

                        mediaplan = "0";
                        jtype = "Unknown"
                    }
                }
                checkck();
                // $("#amounttopay").val() =10;
                jtype = ljtype + fjtype + cjtype + vjtype + subsjtype + sjtype;
                let msg = "You are about to purchase ";
                let mediaplan = $('#Jobnumbers').find(":selected").val();
                msg += '<b>' + mediaplan + '</b> ' + jtype + " plan of ₦";
                msg += '<b>' + $("#amounttopay").val() + '</b>' + " for the Social Media " + '<b>' + $("#Smedia").val() + '</b>';
                msg += " Link " + '<i>' + $("#jlink").val() + '</i>';
                msg += " <br/> Do you wish to continue?"
                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();
                swal("Alert!!", "Are You Sure The Job link is Correct. To Check Click No and verify Before tranction Confirmation", "error");
                return;
            }

            $('#job-btn').removeClass("gradient-highlight");
            $('#job-btn').addClass("btn-secondary");
            $('#job-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });



        // ----------------------------------------------------------------------------
        // Data Pin
        // ----------------------------------------------------------------------------

        //If data type selected, get plans
        $("#datapingroup").on("change", function () {

            if ($("#datanetworkid").val() == '' || $("#datanetworkid").val() == null) {
                swal("Opps!!", "Please Select A Network First.", "info");
                return 0;
            }

            let network = $("#datanetworkid").val();
            let datagroup = $("#datapingroup").val();
            let useraccount = getCookie("loginAccount");
            let plans = '<?php echo (!empty($data2) && is_string($data2)) ? $data2 : ""; ?>';
            let options = "<option value=''>Select Plan</option>";
            let price = 0;
            let networkname = $('#datanetworkid').find(":selected").attr('networkname');


            useraccount = useraccount.replace(/%3D/g, "=");
            useraccount = atob(useraccount);
            useraccount = parseInt(useraccount);

            if (!plans == "") {

                plans = JSON.parse(plans);

                for (i = 0; i < plans.length; i++) {

                    if (useraccount == 3 || useraccount == '3') {
                        price = plans[i].vendorprice;
                    } else if (useraccount == 2 || useraccount == '2') {
                        price = plans[i].agentprice;
                    } else {
                        price = plans[i].userprice;
                    }

                    if (plans[i].datanetwork == network && plans[i].type == datagroup) {
                        options += "<option value='" + plans[i].dpId + "' dataprice='" + price + "' dataname='" + plans[i].name + " " + plans[i].type + " (N" + price + ")(" + plans[i].day + " Days) '>" + plans[i].name + " " + plans[i].type + " (N" + price + ")(" + plans[i].day + " Days)</option>";
                    }

                }

            }

            $("#datapinplan").html(options);
            $("#amount").val(null);
            $("#amounttopay").val(null);


        });

        //If Data Plan Is Selected, Get And Set The Price
        $("#datapinplan").on("change", function () {
            $("#amount").val($('#datapinplan').find(":selected").attr('dataprice'));
        });

        $("#datapinquantity").on("change", function () {

            if ($("#datanetworkid").val() == '' || $("#datanetworkid").val() == null) {
                swal("Opps!!", "Please Select A Network First.", "info");
            } else {
                let price = parseInt($("#amount").val());
                let quantity = parseInt($("#datapinquantity").val());
                let amounttopay = 0;
                if (quantity > 0) {
                    amounttopay = price * quantity;
                } else {
                    swal("Alert!!", "Please Enter A Valid Quantity", "error");
                }
                $("#amounttopay").val("N" + amounttopay);
            }

        });

        //Purchase Data Pin
        $("#datapinForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "datapin-btn");

                let dataplan = $('#datapinplan').find(":selected").attr('dataname');
                let msg = "You are about to purchase " + $("#datapinquantity").val() + " data pin of ";

                msg += '"' + $('#datanetworkid').find(":selected").attr('networkname') + '" ' + dataplan + " plan at ";
                msg += '"' + $("#amounttopay").val() + '"' + " with business name " + '"' + $("#businessname").val() + '"';
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#datapin-btn').removeClass("gradient-highlight");
            $('#datapin-btn').addClass("btn-secondary");
            $('#datapin-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });



        // ----------------------------------------------------------------------------
        // Wallet Management
        // ----------------------------------------------------------------------------


        $("#transfertype").on("change", function () {
            if ($(this).val() == "wallet-wallet") {
                $("#walletreceiver").show();
                $("#walletreceiverinput").attr("required", "required");
            } else {
                $("#walletreceiver").hide();
                $("#walletreceiverinput").removeAttr("required");
            }
            $("#amounttopay").val("N0.00");
        });

        $("#wallettransferamount").on("keyup", function () {
            let amount = parseInt($('#wallettransferamount').val());
            let charges = parseInt($('#wallettowalletcharges').text());
            if ($("#transfertype").val() == "wallet-wallet") {
                amounttopay = amount + charges;
            } else {
                amounttopay = amount + 0;
            }
            $("#amounttopay").val("N" + amounttopay);
        });

        //Submit Transfer Request
        $("#transferForm").submit(function (e) {

            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "transfer-btn");

                let msg = "You are about to perform a  ";
                let action = "Wallet To Wallet";

                if ($("#transfertype").val() == 'referral-wallet') {
                    action = "Referal To Wallet Transfer";
                    receiver = "your main wallet.";
                } else {
                    action = "Wallet To Wallet Transfer";
                    receiver = $("#walletreceiverinput").val();
                }

                msg += action + " of N" + $('#wallettransferamount').val() + " to " + receiver;
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#transfer-btn').removeClass("gradient-highlight");
            $('#transfer-btn').addClass("btn-secondary");
            $('#transfer-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });

        // ----------------------------------------------------------------------------
        // Contact Page Management
        // ----------------------------------------------------------------------------

        //Send Contact Message
        $("#message-form").submit(function (e) {
            e.preventDefault();

            $('#message-btn').removeClass("gradient-highlight");
            $('#message-btn').addClass("btn-secondary");
            $('#message-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Sending ...');


            $.ajax({
                url: 'home/includes/route.php?save-message',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (resp) {
                    console.log(resp);
                    if (resp == 0) {
                        swal('Alert!!', "Message Sent Successfully, We Would Get Back To You Soon.", "success");
                        $("#message-form")[0].reset();
                    } else {
                        swal('Alert!!', "Unexpected Error, Please Contact Our Customer Support Team.", "error");
                    }

                    $('#message-btn').removeClass("btn-secondary");
                    $('#message-btn').addClass("gradient-highlight");
                    $('#message-btn').html("Send Message");

                }
            });

        });

        // ----------------------------------------------------------------------------
        // Alpha Topup Management
        // ----------------------------------------------------------------------------

        //If Alpha Plan Is Selected, Get And Set The Price
        $("#alphaplan").on("change", function () {
            let useraccount = getCookie("loginAccount");
            useraccount = useraccount.replace(/%3D/g, "=");
            useraccount = atob(useraccount);
            useraccount = parseInt(useraccount);

            if (useraccount == 3) {
                $("#amounttopay").val("N" + $('#alphaplan').find(":selected").attr('vendor'));
            }
            if (useraccount == 2) {
                $("#amounttopay").val("N" + $('#alphaplan').find(":selected").attr('agent'));
            } else {
                $("#amounttopay").val("N" + $('#alphaplan').find(":selected").attr('user'));
            }
        });

        //Purchase Alpha Plan
        $("#alphaplanForm").submit(function (e) {


            if ($("#thetranspin").val() == null || $("#thetranspin").val() == '') {
                e.preventDefault();
                $("#transpinbtn").attr("action-btn", "alpha-plan-btn");

                let msg = "You are about to purchase ";
                let dataplan = $('#alphaplan').find(":selected").attr('plan');
                msg += dataplan + " Alpha Topup at " + $("#amounttopay").val() + " for the phone number " + '"' + $("#phone").val() + '"';
                msg += " <br/> Do you wish to continue?"

                $("#continue-transaction-prompt-msg").html(msg);
                $("#continue-transaction-prompt-btn").click();

                return;
            }

            $('#alpha-plan-btn').removeClass("gradient-highlight");
            $('#alpha-plan-btn').addClass("btn-secondary");
            $('#alpha-plan-btn').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Processing ...');

        });
// GIVEAWAY-section TYPE and OTHERS
        $("#whattype").on("change", function () {
        if($("#giveawaytype").val() == "privategiveaway"){
            // if($("#whattype").val() == "cash"){
            //     // document.getElementById("uiddiv").style.display = "block";
            //     document.getElementById("numberdiv").style.display = "none";

            // }else{
                // document.getElementById("uiddiv").style.display = "none";
                document.getElementById("numberdiv").style.display = "block";
                $("#numberInput").attr("required","");
            // }
        }
        else if($("#giveawaytype").val() == "publicgiveaway"){
            // document.getElementById("uiddiv").style.display = "none";
            document.getElementById("numberdiv").style.display = "none";
        }
        else{
            $("#whattype").val("");
            swal("Oops!", "Select Giveaway Type Before", "info");
        }
    });
    $("#giveawaytype").on("change", function () {
        $("#whattype").val("");
            // $("#useruid").val("");
            $("#numberInput").val("");
            // document.getElementById("uiddiv").style.display = "none";
            document.getElementById("numberdiv").style.display = "none";
    });
    });


    function copyToClipboard(url) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(url).select();
        document.execCommand("copy");
        $temp.remove();
        swal("Success!!", "Copied To Clipboard Successfully", "success");
    }

    function calculatePaystackCharges() {
        let charges = $("#paystackcharges").val();
        let amount = $("#amount").val();
        amount = parseInt(amount);
        charges = parseFloat(charges);

        if (amount > 2500) {
            let amounttopay = amount;
            let discount = 0;

            discount = ((amount * charges) / 100) + 100;
            amounttopay = amount - discount;

            $("#amounttopay").val("N" + amounttopay);
            $("#charges").val("N" + discount);
        } else {
            let amounttopay = amount;
            let discount = 0;

            discount = (amount * charges) / 100;
            amounttopay = amount - discount;

            $("#amounttopay").val("N" + amounttopay);
            $("#charges").val("N" + discount);
        }

    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    }

    function verifyNetwork() {
        var selNetwork = $('#networkid').find(":selected").attr('networkname');
        var verNetwork = "";
        var phoneT = document.getElementById('phone').value;
        var phoneStr = phoneT.substr(0, 4);
        let fieldsd = document.getElementById('networkid');
        let mtns = document.getElementById('mtnspan');
        let airtels = document.getElementById('airtelspan');
        let glos = document.getElementById('glospan');
        let _9mobiles = document.getElementById('9mobilespan');



        if (phoneT === "" || phoneT.length < 6) {
            mtns.style.background = '#f2f2f2';
            document.getElementById('mtnimg').style.width = '45px';
            document.getElementById('mtnimg').style.height = '45px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            airtels.style.background = '#f2f2f2';
            document.getElementById('airtelimg').style.width = '45px';
            document.getElementById('airtelimg').style.height = '45px';
            /////////////////////////////////////////////
            glos.style.background = '#f2f2f2';
            document.getElementById('gloimg').style.width = '45px';
            document.getElementById('gloimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#f2f2f2';
            document.getElementById('9mobileimg').style.width = '45px';
            document.getElementById('9mobileimg').style.height = '45px';

            document.getElementById('verifyer').innerHTML = "";
        } else {
            if (/0702|0704|0803|0806|0703|0706|0813|0816|0810|0814|0903|0906|0913/.test(phoneStr)) {
                verNetwork = "MTN";
                // fieldsd.value = 1;
                selectNetworkByIcon('MTN'); // console.log(thetype.value);
                mtns.style.background = '#56d772d9';
                document.getElementById('mtnimg').style.width = '60px';
                document.getElementById('mtnimg').style.height = '60px';

            } else if (/0805|0807|0705|0815|0811|0905/.test(phoneStr)) {
                verNetwork = "GLO";
                // fieldsd.value = 2;
                selectNetworkByIcon('GLO');
                glos.style.background = '#56d772d9';
                document.getElementById('gloimg').style.width = '60px';
                document.getElementById('gloimg').style.height = '60px';

            } else if (/0702|0704|0803|0806|0703|0706|0813|0816|0810|0814|0903|0906|0913/.test(phoneStr)) {
                verNetwork = "GIFTING";
            } else if (/0802|0808|0708|0812|0701|0901|0902|0907|0912/.test(phoneStr)) {
                verNetwork = "AIRTEL";
                // fieldsd.value = 4;
                selectNetworkByIcon('AIRTEL');
                _9mobiles.style.background = '#f2f2f2';
                document.getElementById('9mobileimg').style.width = '45px';
                document.getElementById('9mobileimg').style.height = '45px';
                airtels.style.background = '#56d772d9';
                document.getElementById('airtelimg').style.width = '60px';
                document.getElementById('airtelimg').style.height = '60px';
            } else if (/0809|0818|0817|0908|0909/.test(phoneStr)) {
                verNetwork = "9MOBILE";
                // fieldsd.value = 3;
                selectNetworkByIcon('9MOBILE');
                _9mobiles.style.background = '#56d772d9';
                document.getElementById('9mobileimg').style.width = '60px';
                document.getElementById('9mobileimg').style.height = '60px';
            } else if (/0804/.test(phoneStr)) {
                verNetwork = "NTEL";
                selectNetworkByIcon('NTEL');

            } else {
                mtns.style.background = '#f2f2f2';
                document.getElementById('mtnimg').style.width = '45px';
                document.getElementById('mtnimg').style.height = '45px';
                // $('#mtnimg').style.height
                ////////////////////////////////////////////
                airtels.style.background = '#f2f2f2';
                document.getElementById('airtelimg').style.width = '45px';
                document.getElementById('airtelimg').style.height = '45px';
                /////////////////////////////////////////////
                glos.style.background = '#f2f2f2';
                document.getElementById('gloimg').style.width = '45px';
                document.getElementById('gloimg').style.height = '45px';
                //////////////////////////////////////////////////
                _9mobiles.style.background = '#f2f2f2';
                document.getElementById('9mobileimg').style.width = '45px';
                document.getElementById('9mobileimg').style.height = '45px';

                verNetwork = "Unable to identify network !";
            }
            if (selNetwork == "ETISALAT") {
                selNetwork = "9MOBILE";
                selectNetworkByIcon('9MOBILE');
                _9mobiles.style.background = '#56d772d9';
                document.getElementById('9mobileimg').style.width = '60px';
                document.getElementById('9mobileimg').style.height = '60px';
            }
            if (verNetwork == selNetwork) {
                var ic = "<i class = 'fas fa-check-circle' style ='color: #4BB543;'></i>";
            } else {
                ic = "<i class = 'fas fa-exclamation-triangle' style ='color:#B33A3A'></i>";
            }

            document.getElementById('verifyer').innerHTML = "Identified Network: <b>" + verNetwork + "  " + ic + "</b><br><b> Note: </b> Ignore warning for <b>Ported Numbers</b>";
        }
    }


    function selectNetworkByIcon(name) {
        let fieldsd = document.getElementById('networkid');
        let mtns = document.getElementById('mtnspan');
        let airtels = document.getElementById('airtelspan');
        let glos = document.getElementById('glospan');
        let _9mobiles = document.getElementById('9mobilespan');

        $("option[networkname]").removeAttr("selected");
        $("option[networkname='" + name + "']").attr("selected", "selected");
        if (name == 'MTN') {
            mtns.style.background = '#56d772d9';
            document.getElementById('mtnimg').style.width = '60px';
            document.getElementById('mtnimg').style.height = '60px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            airtels.style.background = '#f2f2f2';
            document.getElementById('airtelimg').style.width = '45px';
            document.getElementById('airtelimg').style.height = '45px';
            /////////////////////////////////////////////
            glos.style.background = '#f2f2f2';
            document.getElementById('gloimg').style.width = '45px';
            document.getElementById('gloimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#f2f2f2';
            document.getElementById('9mobileimg').style.width = '45px';
            document.getElementById('9mobileimg').style.height = '45px';
        } else if (name == 'GLO') {
            glos.style.background = '#56d772d9';
            document.getElementById('gloimg').style.width = '60px';
            document.getElementById('gloimg').style.height = '60px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            airtels.style.background = '#f2f2f2';
            document.getElementById('airtelimg').style.width = '45px';
            document.getElementById('airtelimg').style.height = '45px';
            /////////////////////////////////////////////
            mtns.style.background = '#f2f2f2';
            document.getElementById('mtnimg').style.width = '45px';
            document.getElementById('mtnimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#f2f2f2';
            document.getElementById('9mobileimg').style.width = '45px';
            document.getElementById('9mobileimg').style.height = '45px';
        }
        else if (name == '9MOBILE') {
            glos.style.background = '#f2f2f2';
            document.getElementById('gloimg').style.width = '45px';
            document.getElementById('gloimg').style.height = '45px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            airtels.style.background = '#f2f2f2';
            document.getElementById('airtelimg').style.width = '45px';
            document.getElementById('airtelimg').style.height = '45px';
            /////////////////////////////////////////////
            mtns.style.background = '#f2f2f2';
            document.getElementById('mtnimg').style.width = '45px';
            document.getElementById('mtnimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#56d772d9';
            document.getElementById('9mobileimg').style.width = '60px';
            document.getElementById('9mobileimg').style.height = '60px';
        }
        else if (name == 'AIRTEL') {
            airtels.style.background = '#56d772d9';
            document.getElementById('airtelimg').style.width = '60px';
            document.getElementById('airtelimg').style.height = '60px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            glos.style.background = '#f2f2f2';
            document.getElementById('gloimg').style.width = '45px';
            document.getElementById('gloimg').style.height = '45px';
            /////////////////////////////////////////////
            mtns.style.background = '#f2f2f2';
            document.getElementById('mtnimg').style.width = '45px';
            document.getElementById('mtnimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#f2f2f2';
            document.getElementById('9mobileimg').style.width = '45px';
            document.getElementById('9mobileimg').style.height = '45px';
        } else {
            mtns.style.background = '#f2f2f2';
            document.getElementById('mtnimg').style.width = '45px';
            document.getElementById('mtnimg').style.height = '45px';
            // $('#mtnimg').style.height
            ////////////////////////////////////////////
            airtels.style.background = '#f2f2f2';
            document.getElementById('airtelimg').style.width = '45px';
            document.getElementById('airtelimg').style.height = '45px';
            /////////////////////////////////////////////
            glos.style.background = '#f2f2f2';
            document.getElementById('gloimg').style.width = '45px';
            document.getElementById('gloimg').style.height = '45px';
            //////////////////////////////////////////////////
            _9mobiles.style.background = '#f2f2f2';
            document.getElementById('9mobileimg').style.width = '45px';
            document.getElementById('9mobileimg').style.height = '45px';
        }
        let sme = $('#networkid').find(":selected").attr('sme');
        let gifting = $('#networkid').find(":selected").attr('gifting');
        let corporate = $('#networkid').find(":selected").attr('corporate');
        let networkname = $('#networkid').find(":selected").attr('networkname');
        let thegroup = '<option value="">Select Type</option>';

        //Check If Network Is Disabled
        if (sme == "On") {
            thegroup += '<option value="SME">SME</option>';
        }

        //Check If Network Is Disabled
        if (gifting == "On") {
            thegroup += '<option value="Gifting">Gifting</option>';
        }

        //Check If Network Is Disabled
        if (corporate == "On") {
            thegroup += '<option value="Corporate">Corporate</option>';
        }
        $("#datagroup").html(thegroup);
    }


    function selectExamByIcon(name) {
        $("option[providername]").removeAttr("selected");
        $("option[providername='" + name + "']").attr("selected", "selected");
    }

    // <--- Create Giveaway JS CODE START--->
    function checktype() {
        var giveawaytype = document.getElementById("giveawaytype");
        var number_div = document.getElementById("numberdiv");
        let numbe_field = document.getElementById("numberInput");

        if (giveawaytype.value === "privategiveaway") {
            number_div.style.display = "block";
            numbe_field.required = true;
            swal("Alert!!", "Please Copy The Phone numbers and Paste. It Will Automatically Arrage It Min.<?php $minnumber = 5; echo $minnumber; ?>", "info");
        }
        else if (giveawaytype.value === "publicgiveaway") {
            number_div.style.display = "none";
            numbe_field.required = false;
        }
    }
    function handlePaste(event) {
        event.preventDefault(); // Prevent default paste action

        // Get the pasted data
        const pastedData = (event.clipboardData || window.clipboardData).getData('text');

        // Define the desired number length (11 digits) and min/max count
        const numberLength = 11;
        const minCount = 5;
        const maxCount = 100;

        // Split the pasted data by commas, trimming spaces
        let separatedNumbers = pastedData.split(',').map(num => num.trim());

        // Check if numbers are already in the correct format
        const allNumbersValid = separatedNumbers.every(num => num.length === numberLength && /^0\d{10}$/.test(num));

        if (allNumbersValid) {
            // If numbers are correctly formatted, display them directly
            if (separatedNumbers.length < minCount || separatedNumbers.length > maxCount) {
                document.getElementById('numberInput').value = ''; // Clear the input field
                swal("Oops!", "Minimum of 5 numbers and maximum of 100 numbers.", "info");
            } else {
                document.getElementById('numberInput').value = separatedNumbers.join(', ');
                document.getElementById('error').innerText = ''; // Clear any previous error
            }
        } else {
            // If not formatted, split pasted data into chunks of 11 digits
            separatedNumbers = [];
            for (let i = 0; i < pastedData.length; i += numberLength) {
                let chunk = pastedData.slice(i, i + numberLength);
                if (/^0\d{10}$/.test(chunk)) {
                    separatedNumbers.push(chunk);
                } else {
                    swal("Invalid Number", "Please check the number format. Only valid 11-digit Nigerian numbers are allowed.", "error");
                    return;
                }
            }
            // 091274063110912740631109127406311091274063110912740631109127406311091274063110912740631109127406311
            // Check if the number count is within the allowed range
            if (separatedNumbers.length < minCount || separatedNumbers.length > maxCount) {
                document.getElementById('numberInput').value = ''; // Clear the input field
                swal("Oops!", "Minimum of 5 numbers and maximum of 100 numbers.", "info");
            } else {
                // If within the range, display separated numbers in the input field
                document.getElementById('numberInput').value = separatedNumbers.join(', ');
                document.getElementById('error').innerText = ''; // Clear any previous error
            }
        }
    }


    function checkthedata() {
        // Get the pasted data
        const pastedData = document.getElementById("numberInput").value;

        // Define the desired number length (11 digits) and min/max count
        const numberLength = 11;
        const minCount = 5;
        const maxCount = 100;

        // Split the pasted data by commas, trimming spaces
        let separatedNumbers = pastedData.split(',').map(num => num.trim());

        // Check if numbers are already in the correct format
        const allNumbersValid = separatedNumbers.every(num => num.length === numberLength && /^0\d{10}$/.test(num));

        if (allNumbersValid) {
            // If numbers are correctly formatted, display them directly
            if (separatedNumbers.length < minCount || separatedNumbers.length > maxCount) {
                document.getElementById('numberInput').value = ''; // Clear the input field
                swal("Oops!", "Minimum of 5 numbers and maximum of 100 numbers.", "info");
            } else {
                document.getElementById('numberInput').value = separatedNumbers.join(',');
                document.getElementById('error').innerText = ''; // Clear any previous error
            }
        } else {
            // If not formatted, split pasted data into chunks of 11 digits
            separatedNumbers = [];
            for (let i = 0; i < pastedData.length; i += numberLength) {
                let chunk = pastedData.slice(i, i + numberLength);
                if (/^0\d{10}$/.test(chunk)) {
                    separatedNumbers.push(chunk);
                } else {
                    swal("Invalid Number", "Please check the number format. Only valid 11-digit Nigerian numbers are allowed.", "error");
                    return;
                }
            }
            // 091274063110912740631109127406311091274063110912740631109127406311091274063110912740631109127406311
            // Check if the number count is within the allowed range
            if (separatedNumbers.length < minCount || separatedNumbers.length > maxCount) {
                document.getElementById('numberInput').value = ''; // Clear the input field
                swal("Oops!", "Minimum of 5 numbers and maximum of 100 numbers.", "info");
            } else {
                // If within the range, display separated numbers in the input field
                document.getElementById('numberInput').value = separatedNumbers.join(',');
                document.getElementById('error').innerText = ''; // Clear any previous error
            }
        }
    }
    // function checkwhat() {
    //    var whattype = document.getElementById("whattype");
    //    var giveawaytype = document.getElementById("giveawaytype");
    //     if(giveawaytype.value !== "privategiveaway" && giveawaytype.value !== "publicgiveaway"){
    //         swal("Oops!", "Minimum of 5 numbers and maximum of 100 numbers.", "info");
    //     }
    // }
    

    // <--- Create Giveaway JS CODE END--->

</script>