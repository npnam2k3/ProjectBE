<?php
unset($_SESSION['is_login']);
unset($_SESSION['user_login']);
header("Location: ?modules=products&action=list");