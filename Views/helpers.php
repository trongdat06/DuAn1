<?php
// Helper functions for views

function baseUrl($path = '') {
    $base = '/duann1';
    return $base . ($path ? '/' . ltrim($path, '/') : '');
}

function assetUrl($path) {
    return baseUrl('assets/' . ltrim($path, '/'));
}

function formatCurrency($amount) {
    return number_format($amount, 0, ',', '.') . ' đ';
}

function formatDate($date) {
    return date('d/m/Y', strtotime($date));
}

function formatDateTime($datetime) {
    return date('d/m/Y H:i', strtotime($datetime));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && 
           ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'manager');
}

function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

function getCartCount() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

