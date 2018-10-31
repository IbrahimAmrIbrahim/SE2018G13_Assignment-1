<?php


include_once('database.php');

class Grade extends Database {

    function __construct($id, $src) {
        if ($src == "std") {
            $sql = "SELECT G.*,C.name as crs_name,C.max_degree,S.name as std_name FROM grades as G join courses as C on (G.course_id = C.id) join students as S on (G.student_id = S.id) WHERE G.id = ('$id');";
            $statement = Database::$db->prepare($sql);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return;
            }
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        } else if ($src == "crs") {
            $sql = "SELECT G.*,S.name as std_name FROM grades as G join students as S on (G.student_id = S.id) WHERE G.id = ('$id');";
            $statement = Database::$db->prepare($sql);
            $statement->execute();
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                return;
            }
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    public function delete() {
        $sql = "DELETE FROM grades WHERE id = $this->id;";
        Database::$db->query($sql);
    }

    public function save() {
        $sql = "UPDATE grades SET degree = ?,examine_at = ? WHERE id = ?;";
        Database::$db->prepare($sql)->execute([$this->degree, $this->examine_at, $this->id]);
    }

    public static function std_all($id) {
        $sql = "SELECT * FROM grades WHERE student_id = ('$id');";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $grades = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $grades[] = new Grade($row['id'], "std");
        }
        return $grades;
    }

    public static function crs_all($id) {
        $sql = "SELECT * FROM grades WHERE course_id = ('$id');";
        $statement = Database::$db->prepare($sql);
        $statement->execute();
        $grades = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $grades[] = new Grade($row['id'], "crs");
        }
        return $grades;
    }

}

?>