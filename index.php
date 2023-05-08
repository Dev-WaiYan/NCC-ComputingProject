<?php

session_start();

require_once 'config.php';
require_once 'services/db/Db.php';

// routes must be last.
require_once 'routes.php';
