<?php

class CategorieManager extends BDD{
    public function add(string $nom, string $description){
        $sql = 'INSERT INTO categories (nom, description) VALUES (:n, :d)';
        $insert = $this->co->prepare($sql);
        $insert->execute([
            'n' => $nom,
            'd' => $description
        ]);

        return $insert->rowCount(); // Retourne le nombre de lignes affectées par la requete
    }

    public function modifier(string $nom, string $description, $id){
        $sql = 'UPDATE categories SET nom = :n, description = :d WHERE id = :id';
        $insert = $this->co->prepare($sql);
        $insert->execute([
            'n' => $nom,
            'd' => $description,
            'id' => $id
        ]);

        return $insert->rowCount(); // Retourne le nombre de lignes affectées par la requete
    }

    public function categories(){
        $sql = 'SELECT * FROM categories';

        $select = $this->co->prepare($sql);
        $select->execute();

        return $select->fetchAll();
    }

    public function supprimer($id){
        $sql = 'DELETE FROM categories WHERE id = :id';

        $delete = $this->co->prepare($sql);
        $delete->execute([
            'id' => $id
        ]);

        return $delete->rowCount();
    }

    public function une_categorie($id){
        $sql = 'SELECT * FROM categories WHERE id = :id';

        $select = $this->co->prepare($sql);
        $select->execute([
            'id' => $id
        ]);

        return $select->fetch();
    }
}
