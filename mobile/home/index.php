<?php require_once("includes/route.php"); ?>
<?php
define("HOME_IMAGE_LOC", "../../assets/home-img");
require_once("includes/custom.php");
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="../assets/scripts/sweetalert/sweetalert.css">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
    <title><?php echo $title; ?></title>
    <?php include_once("includes/cssFiles.php"); ?>
    <style>
        .bt-hovering:hover {
            color: white;
        }
    </style>
</head>

<body class="theme-light">

    <?php if ($title <> "Print Data Pin"): ?>
        <!-- <div id="preloader">
            <div class="spinner-border color-highlight" role="status"></div>
        </div> -->
    <?php endif; ?>

    <div id="page">
        <div class="page d-flex">
            <div class="content w-full">
                <?php if ($title <> "Print Data Pin"): ?>
                    <div class="head header-fixed p-10 between-flex">
                        <div class="p-relative">
                            <?php if ($title == "Homepage") { ?>
                                <a href="#" class="font-17 header-icon header-icon-1"><i class="fas fa-home"></i></a>
                            <?php } else { ?>
                                <a href="#" data-back-button class="font-17 header-icon header-icon-1"><i
                                        class="fas fa-chevron-left"></i></a>
                            <?php } ?>
                        </div>
                        <!-- <div class="p-relative"> -->
                        <!-- <a href="post-job" type="button"
                            class="btn p-10 bg-blue c-white w-fit btn-shape btn-bold bt-hovering"
                            style="width: 30%; padding: 1.2%; font-size: medium;"> Post
                            Job</a> -->

                        <a href="create-giveaway" type="button"
                            class="btn p-10 bg-blue c-white w-fit btn-shape btn-bold bt-hovering"
                            style="width: 40%; padding: 1.2%; font-size: medium;">Create Giveway</a>
                        <!-- </div> -->
                        <div class="icons d-flex align-center">
                            <span class="notification p-relative">
                                <a href="notifications" style="padding-left:-50%;">

                                    <i class="fa fa-regular fa-bell fa-lg"></i>
                                </a>
                            </span>
                            <a href="profile">
                                <img src="<?php echo HOME_IMAGE_LOC; ?>/IMG_20220602_160945_858.jpg" alt="" /></a>
                        </div>
                    </div>
                    <!-- Page Nav Title Header -->
                    <!-- <div class="header header-fixed header-logo-center">
            <a href="./" class="header-title"><?php echo $sitename; ?></a>

            <a href="notifications" class="font-17 header-icon header-icon-4"><i class="fas fa-envelope"></i><span class="badge bg-red-dark">1</span></a>
            <a href="#" data-toggle-theme class="font-17 header-icon header-icon-3 show-on-theme-dark"><i class="fas fa-sun"></i></a>
            <a href="#" data-toggle-theme class="font-17 header-icon header-icon-3 show-on-theme-light"><i class="fas fa-moon"></i></a>
        </div> -->

                    <!-- Page Footer -->
                    <?php
                    include_once("includes/footer.php");
                    ?>
                <?php endif; ?>



                <!-- Page content start here-->
                <?php
                if (Scustom::checkpage($page) == 'online') {
                    include($page);
                } else {
                    $reason = Scustom::checkpage($page);
                    if (Scustom::checkpage($page) == 'atwork') {
                        $reason = 'Under Maitenance';
                    }
                    if (Scustom::checkpage($page) == 'notfound') {
                        $reason = 'No Longer Available';
                    }
                    ?>
                    <div class="page-content header-clear-medium">
                        <div class="card card-style">
                            <div class="content">
                                <h1 class="text-center">Sorry This Page Is <?php echo $reason; ?> </h1>
                                <h5 class="text-center"><a href="./">Back Home</a></h5>
                                <em class="text-center">Note: we will notify you soon when the page is back</em>
                            </div>
                        </div>
                    </div><?php
                }
                ?>
                <!-- Page content ends here-->
            </div>
        </div>
        <!-- Notification Message -->
        <?php echo $msg; ?>

        <!-- Notification Message -->

        <!-- Models -->

        <button id="continue-transaction-prompt-btn" data-menu="continue-transaction-prompt" class="d-none"></button>

        <!-- Verify transaction Prompt Model -->
        <div id="continue-transaction-prompt" class="menu menu-box-modal rounded-m" data-menu-height="350"
            data-menu-width="300">
            <h1 class="text-center mt-4"><i
                    class="fa fa-3x fa-info-circle scale-box color-blue-dark shadow-xl rounded-circle"></i></h1>
            <h3 class="text-center mt-3 font-700">Are you sure?</h3>
            <p class="boxed-text-xl" id="continue-transaction-prompt-msg"></p>
            <div class="row mb-0 me-3 ms-3">
                <div class="col-6">
                    <a href="#"
                        class="btn close-menu btn-full btn-m color-red-dark border-red-dark font-600 rounded-s">No</a>
                </div>
                <div class="col-6">
                    <?php if ($pinstatus == 0): ?>
                        <a href="#" data-menu="pin-modal"
                            class="btn btn-full btn-m color-green-dark border-green-dark font-600 rounded-s">Yes</a>
                    <?php else: ?>
                        <a href="#" onclick="$('#thetranspin').val(5); $('#transpinbtn').click();"
                            class="btn btn-full btn-m color-green-dark border-green-dark font-600 rounded-s">Yes</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Confirm Trasaction Pin Model -->
        <div id="pin-modal" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="300" data-menu-height="350">
            <div class="menu-title">
                <p class="color-highlight">Confirm Transaction </p>
                <h1 class="font-800">Continue?</h1>
                <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
            </div>

            <div class="content">
                <div class="divider mt-n2"></div>

                <div class="row mb-0">
                    <div class="col-12">
                        <div class="input-style input-style-always-active has-borders mb-4">
                            <label for="form1" class="color-highlight">Transaction Pin</label>
                            <input type="number" id="thetranspin" maxlength="4" class="form-control" placeholder="1234"
                                required>
                        </div>
                    </div>
                </div>
                <button action-btn="" id="transpinbtn" style="width:100%"
                    class="close-menu btn btn-full gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Continue</button>
            </div>
        </div>

        <!-- Agent Account Upgrade Model -->
        <div id="agent-upgrade-modal" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="300"
            data-menu-height="450">
            <div class="menu-title">
                <p class="color-highlight">Confirm Transaction </p>
                <h1 class="font-800">Upgrade</h1>
                <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
            </div>

            <div class="content">
                <div class="divider mt-n2"></div>
                <div id="agent-upgrade-msg" class="text-danger mb-3">
                    You are about to upgrade to an Agent Account.
                    You can view our pricing page for details about the discounts available for Agents.
                    <br /> You would be charged a total of
                    N<?php echo (is_object($data3)) ? $data3->agentupgrade : "0"; ?> for this service.
                    <?php if ($pinstatus == 0) {
                        echo "To continue, enter your transaction pin below.";
                    } ?>
                </div>
                <form action="./" method="POST">
                    <div class="row mb-0">
                        <?php if ($pinstatus == 0): ?>
                            <div class="col-12">
                                <div class="input-style input-style-always-active has-borders mb-4">
                                    <input type="password" name="kpin" maxlength="4" class="form-control" placeholder="1234"
                                        required>
                                    <label for="form1" class="color-highlight">Transaction Pin</label>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="kpin" value="0000" />
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="upgrade-to-agent" id="agent-upgrade-btn" style="width:100%"
                        class="btn btn-full gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Continue</button>
                </form>
            </div>
        </div>

        <!-- Vendor Account Upgrade Model -->
        <div id="vendor-upgrade-modal" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="300"
            data-menu-height="450">
            <div class="menu-title">
                <p class="color-highlight">Confirm Transaction </p>
                <h1 class="font-800">Enter Pin</h1>
                <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
            </div>

            <div class="content">
                <div class="divider mt-n2"></div>
                <div id="vendor-upgrade-msg" class="text-danger mb-3">
                    You are about to upgrade to a Vendor Account.
                    You can view our pricing page for details about the discounts available for Vendors.
                    <br /> You would be charged a total of
                    N<?php echo (is_object($data3)) ? $data3->vendorupgrade : "0"; ?> for this service.
                    To continue, enter your transaction pin below.
                </div>
                <form action="./" method="POST">
                    <div class="row mb-0">
                        <div class="col-12">
                            <div class="input-style input-style-always-active has-borders mb-4">
                                <input type="password" name="kpin" maxlength="4" class="form-control" placeholder="1234"
                                    required>
                                <label for="form1" class="color-highlight">Transaction Pin</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="upgrade-to-vendor" id="vendor-upgrade-btn" style="width:100%"
                        class="btn btn-full gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Continue</button>
                </form>
            </div>
        </div>





        <!-- Main Menu-->
        <div id="menu-main" class="menu menu-box-left rounded-0" data-menu-width="280" data-menu-active="nav-pages">
            <?php include("../menu/menu-main.php"); ?>
        </div>

        <!-- Share Menu-->
        <div id="menu-share" class="menu menu-box-bottom rounded-m" data-menu-load="../menu/menu-share.php"
            data-menu-height="370"></div>

        <!-- Colors Menu-->
        <div id="menu-colors" class="menu menu-box-bottom rounded-m" data-menu-load="../menu/menu-colors.php"
            data-menu-height="480"></div>


    </div>


    <?php include_once("includes/jsFiles.php"); ?>
    <?php include_once("includes/topupmatescript.php"); ?>
    <script type="module">
    import { Address, beginCell, Cell } from 'https://esm.sh/@ton/core';
    import { TonClient } from 'https://esm.sh/@ton/ton';
    import { sha256 } from 'https://esm.sh/@ton/crypto';

    // const TARGETADDRESS = '0:614a6ab7f8b855c36d06c71194a4cf3e208e38f584fddd3a1cfe8645286606e0';
    const TARGETADDRESS = 'UQBhSmq3-LhVw20GxxGUpM8-II449YT93Toc_oZFKGYG4Foj';

    // Create a TON client using the mainnet endpoint.
    const client = new TonClient({
      endpoint: 'https://toncenter.com/api/v2/jsonRPC',
      apiKey: '2ad5a114b9db4ed117861301988ddee4d53765c6a22e7ac1e579bc683e7355b3',
    });

    // Initialize TON Connect UI
    const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
      manifestUrl: 'https://onchain.com.ng/mobile/home/tonconnect-manifest.json',
      buttonRootId: 'ton-connect',
    });

    // When wallet status changes (connect/disconnect)
    tonConnectUI.onStatusChange(async (status) => {
      if (status) {
        const rawAddress = status.account.address;

        // Check if wallet appears to be a testnet wallet by its appName.
        const isTestnet =
          tonConnectUI.wallet?.device?.appName?.toLowerCase().includes(
            'testnet'
          );
        if (isTestnet) {
          alert(
            'Testnet wallets are not allowed. Please connect a mainnet wallet.'
          );
          tonConnectUI.disconnect();
          return;
        }

        // Convert raw address to a mainnet-friendly format
        const userFriendlyAddress = Address.parse(rawAddress).toString({
          testOnly: false,
          bounceable: false,
        });

        document.getElementById(
          'wallet-info'
        ).innerHTML = `<p>Connected Wallet Address: ${userFriendlyAddress}</p>`;

        // Show transaction form
        document.getElementById('transaction-form').style.display = 'block';

        // Fetch wallet balance from mainnet
        try {
          const response = await fetch(
            `https://toncenter.com/api/v2/getAddressBalance?address=${encodeURIComponent(
              userFriendlyAddress
            )}&api_key=2ad5a114b9db4ed117861301988ddee4d53765c6a22e7ac1e579bc683e7355b3`
          );
          if (!response.ok) {
            throw new Error('Failed to fetch wallet balance');
          }
          const data = await response.json();
          const balance = data.result / 1e9;
          document.getElementById('wallet-info').innerHTML += `<p>Wallet Balance: ${balance} TON</p>`;
        } catch (error) {
          console.error('Error fetching wallet balance:', error);
          document.getElementById('wallet-info').innerHTML +=
            '<p>Failed to fetch wallet balance. Please try again later.</p>';
        }
      } else {
        document.getElementById('ton-viewer-link').innerHTML = '';
        document.getElementById('transaction-info').style.display = 'none';
        document.getElementById('wallet-info').innerHTML = '';
        document.getElementById('transaction-form').style.display = 'none';
      }
    });

    // Event listener for sending a transaction.
    document
      .getElementById('send-transaction')
      .addEventListener('click', async () => {
        const amount = parseFloat(document.getElementById('amount').value);
        if (isNaN(amount) || amount <= 0) {
          alert('Please enter a valid amount.');
          return;
        }

        const rawAddress = tonConnectUI.wallet?.account?.address;
        if (!rawAddress) {
          alert('Wallet is not connected.');
          return;
        }

        const amountInNano = BigInt(Math.floor(amount * 1e9));
        // Replace the target address below with your own mainnet address.
        // const targetAddress = Address.parse(TARGETADDRESS);
        const targetAddress = TARGETADDRESS;
        // Create the transaction object.
        const transaction = {
          validUntil: Math.floor(Date.now() / 1000) + 600,
          messages: [
            {
              address: targetAddress.toString(),
              amount: amountInNano.toString(),
            },
          ],
        };

        try {
          // Send the transaction via TON Connect.
          const result = await tonConnectUI.sendTransaction(transaction);
          console.log('Transaction sent:', result);

          // Parse the transaction BOC to extract a transaction hash.
          const cell = Cell.fromBase64(result.boc);
          const hashBuffer = cell.hash();
          const txHash = hashBuffer.toString('hex');
          console.log('Transaction Hash:', txHash);
          console.log('User Raw Address', rawAddress);
          console.log('Target Address', targetAddress.toString());
          // Display preliminary transaction details.
          document.getElementById('target-account').textContent = targetAddress.toString();
          document.getElementById('tx-hash').textContent = txHash;

          // Now poll the mainnet to confirm the transaction and retrieve its lt.
          const lt = await verifyTransaction(txHash, TARGETADDRESS.toString(), rawAddress);
          if (lt) {
            // Display the lt value once the transaction is confirmed.
            // document.getElementById('tx-lt').textContent = lt;
            // Display TON Viewer link on success.
            alert('Transaction confirmed on mainnet!');
            const tonViewerLink = `https://tonviewer.com/transaction/${txHash}`;
            document.getElementById('ton-viewer-link').innerHTML = `<a href="${tonViewerLink}" target="_blank">${tonViewerLink}</a>`;
            document.getElementById('transaction-info').style.display = 'block';
          } else {
            alert(
              'Transaction not confirmed on mainnet within the expected time. Please try again.'
            );
          }
        } catch (error) {
          console.error('Transaction error:', error);
          alert('Failed to send or verify transaction. Please try again.');
        }
      });



    // Function to poll for transaction confirmation on mainnet.
    async function verifyTransaction(txHash, targetAddress, rawAddress) {
      const maxAttempts = 10; // Maximum number of polling attempts
      const interval = 2000; // Interval in milliseconds (5 seconds)
      let attempts = 0;

      while (attempts < maxAttempts) {
        console.log(`Polling for transaction confirmation... Attempt ${attempts + 1}/${maxAttempts}`);
        // Construct the URL for getTransactions API with lt and to_lt
        const url = `https://tonapi.io/v2/blockchain/messages/${txHash.toString()}/transaction`;
        try {
          const response = await fetch(url);
          const data = await response.json();
          const targetFriendlyAddress = Address.parse(data.out_msgs[0].destination.address).toString({
            testOnly: false,
            bounceable: false,
          });

          if (data.account.address.toString() === rawAddress.toString()
            && data.success === true
            && targetFriendlyAddress === targetAddress
            && data.in_msg.hash.toString() === txHash.toString()
          ) {
            console.log('Transaction confirmed:', data);
            return true;
          }
          else {
            console.error('Error in response:', data.error);
          }
        } catch (error) {
          console.error('Error fetching transaction:', error);
        }

        // Wait before the next attempt
        await new Promise((resolve) => setTimeout(resolve, interval));
        attempts++;
      }
      return null;
    }
  </script>

</body>
<script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script>

</html>