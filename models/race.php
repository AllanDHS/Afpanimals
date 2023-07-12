<?php

class race
{
    private int $id;
    private string $nom;
    private int $id_r;

    /**
     * Permet d'avoir toutes les races avec ou sans filtre  
     * @param int $id_r Id de l'espèce
     * @return array Tableau contenant toutes les races demandées
     */
    public static function getRace(?int $id_r = null): array
    {
        $pdo = Database::createInstancePDO();

        // Je regarde si l'id de l'espèce est null ou non : pas de param'
        if ($id_r === null) {
            $sql = "SELECT * FROM race";
            $stmt = $pdo->prepare($sql);
        } else {
            $sql = "SELECT * FROM race WHERE id_r = :id_r";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id_r', $id_r, PDO::PARAM_INT);
        }

        $stmt->execute();
        $race = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $race;
    }
}
