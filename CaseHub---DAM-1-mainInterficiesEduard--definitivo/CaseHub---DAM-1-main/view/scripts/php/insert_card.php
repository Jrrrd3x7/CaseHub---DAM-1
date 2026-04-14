<?php
require_once __DIR__ . '/auth.php';

requireRole('standard');
include __DIR__ . '/../html/insert_card.php';
