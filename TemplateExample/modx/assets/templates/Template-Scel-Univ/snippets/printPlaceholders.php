<?php
if (!$modx->user->isAuthenticated('mgr')) return;
$placeholders = $prefix ? array() : $modx->placeholders;
if ($prefix) {
    foreach ($modx->placeholders as $key => $ph) {
        if (strpos($key, $prefix) === 0) {
            $placeholders[$key] = $ph;
        }
    }
}
return '<pre>' . print_r($placeholders, true) . '</pre>';