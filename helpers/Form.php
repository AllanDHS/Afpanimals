<?php

class Form
{
    /**
     * Permet de sécuriser les données en appliquant les fonctions trim, stripslashes et htmlspecialchars
     */
    public static function safeData($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
}