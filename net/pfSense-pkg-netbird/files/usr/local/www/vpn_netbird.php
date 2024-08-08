<?php

/*
function addLink() {
$file = 'head.inc';
$dashboardLine = '$vpn_menu[] = array(gettext("IPsec"), "/vpn_ipsec.php");';
$newLine = '$vpn_menu[] = array(gettext("Netbird"), "/vpn_netbird.php");';
$content = file_get_contents($file);
    // Only proceed if 'vpn_netbird.php' does not exist anywhere in the file
    if (strpos($content, '"/vpn_netbird.php"') === false) {
        // Position right after the dashboard line
        $position = strpos($content, $dashboardLine) + strlen($dashboardLine);
        if ($position) {
            $updatedContent = substr_replace($content, "\n" . $newLine, $position, 0);
            file_put_contents($file, $updatedContent);
        }
    }
}
addLink();
*/
$pgtitle = array(gettext("Status"), gettext("Netbird"));

include("guiconfig.inc");
require_once("head.inc");
$nb_bin = '/usr/local/bin/netbird';
switch ($_GET['action']) {
    case 'statusd':
        $command = $nb_bin . ' status -d';
        break;
    case 'status':
        $command = $nb_bin . ' status';
        break;
    case 'restartsvc':
        $command = '/usr/sbin/service netbird restart';
        break;
    case 'up':
        $command = $nb_bin . ' up';
        break;
    case 'down':
        $command = $nb_bin . ' down';
        break;

}

if (isset($command)) {
    $exec = exec($command, $output, $return_var);
    if ($return_var === 0) {
        $output = nl2br(implode(PHP_EOL, $output));
    } else {
        $output = 'Error executing command.';
    }
}


$exec2 = exec('/usr/local/bin/netbird status --json', $output2, $return_var);
$peers = implode('', $output2);
$peers = json_decode($peers, true);


?>
<style>
    .scrollable-pre {
        max-height: 500px; /* Adjust based on your line-height */
        overflow-y: auto; /* Enables vertical scrolling */
    }

    .online {
        background-color: #d4ffdd;
    }

    .offline {
        background-color: #ff6041;
    }
</style>
<!--
        <div class="panel panel-default">
            <div class="panel-heading">Netbird Initial Config</div>
            <div class="panel-body">
        <form action="vpn_netbird.php?action=custom_up" method="post">
            <div class="form-group">
                <label for="hostname">Hostname (Optional):</label>
                <input type="text" class="form-control" id="hostname" name="hostname" placeholder="Enter hostname">
            </div>
            <div class="form-group">
                <label for="key">Key (Optional):</label>
                <input type="password" class="form-control" id="key" name="key" placeholder="Enter key">
            </div>
            <div class="form-group">
                <label for="key">Port (Optional):</label>
                <input type="password" class="form-control" id="port" name="port" placeholder="51820">
            </div>
            <button type="submit" class="btn btn-primary">run netbird up with these settings</button>
        </form>
            </div>
        </div>
-->
<div class="panel panel-default">
    <div class="panel-heading">Netbird Control</div>
    <div class="panel-body">
        <a href="vpn_netbird.php?action=up" class="btn btn-primary">Netbird Up</a>
        <a href="vpn_netbird.php?action=down" class="btn btn-danger">Netbird Down</a>
        <a href="vpn_netbird.php?action=status" class="btn btn-success">Netbird Status</a>
        <a href="vpn_netbird.php?action=statusd" class="btn btn-success">Netbird Detailed Status</a>
        <a href="vpn_netbird.php?action=restartsvc" class="btn btn-danger">Restart Netbird Service</a>
    </div>
</div>
<?php if (isset($output)) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">Outputs</div>
        <div class="panel-body">
            <pre class="scrollable-pre"><?= $output; ?></pre>
        </div>
    </div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">Peers</div>
    <div class="panel-body">
        <?php
        $peers = $peers['peers']['details'];
        foreach ($peers as $peer) {
            if ($peer['status'] === "Connected") {
                ?>
                <div class="peer online">
                    <div class="peer-name"><b><?= $peer['fqdn']; ?></b></div>
                    <div class="peer-info">
                        <div>IP: <?= $peer['netbirdIp']; ?></div>
                        <div>Type: <?= $peer['connectionType']; ?>
                            Direct: <?= $peer['direct'] == 1 ? "Yes" : "No"; ?></div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <?php
        foreach ($peers as $peer) {
            if ($peer['status'] === "Disconnected") {
                ?>
                <div class="peer offline">
                    <div class="peer-name"><b><?=$peer['fqdn'];?></b></div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<?php
include("foot.inc");
?>
