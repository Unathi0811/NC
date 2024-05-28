<?php

function sideBar($name): void
{
?>
    <div class="navcontainer">
        <nav class="nav">
            <div class="nav-upper-options">
                <a href="./" class="<?php echo $name == "dashboard" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon type="solid" name="dashboard"></box-icon>
                    <h3> Dashboard</h3>
                </a>

                <a href="./nannies.php" class="<?php echo $name == "nannies" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon name="child"></box-icon>
                    <h3> Nannies</h3>
                </a>

                <!-- <a href="./nannies.php" class="<?php echo $name == "report" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon type="solid" name="report"></box-icon>
                    <h3> Report</h3>
                </a>

                <a href="./nannies.php" class="<?php echo $name == "institution" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon name="bank" type="solid"></box-icon>
                    <h3> Institution</h3>
                </a> -->

                <!-- <a href="./nannies.php" class="<?php echo $name == "profile" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon type="solid" name="user-detail"></box-icon>
                    <h3> Profile</h3>
                </a>

                <a href="./nannies.php" class="<?php echo $name == "settings" ? 'nav-option option1' : 'nav-option'; ?>">
                    <box-icon name="cog" type="solid"></box-icon>
                    <h3> Settings</h3>
                </a> -->

                <a href="../logout.php" class="nav-option logout">
                    <box-icon name="log-out-circle"></box-icon>
                    <h3>Logout</h3>
                </a>

            </div>
        </nav>
    </div>'
<?php
}
