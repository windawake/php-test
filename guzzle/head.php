<?php

var_dump($_SERVER);
file_put_contents('run.log', 'head', FILE_APPEND | LOCK_EX);