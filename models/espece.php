<?php

class espece
{

    private int $id_e;
    private string $spe_name;
   

    /**
     * Permet d'avoir toutes les espèces
     * @return array Tableau contenant toutes les espèces
     */
    public static function getespece(): array
    {
        $pdo = Database::createInstancePDO();

        $sql = "SELECT * FROM espece";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $espece = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $espece;
    }
}
