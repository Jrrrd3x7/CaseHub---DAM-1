<?php
require_once __DIR__ . '/auth.php';

requireRole('admin');
include __DIR__ . '/../html/editEV.php';
