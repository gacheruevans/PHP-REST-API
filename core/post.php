<?php
    class Post {
        //db stuff
        private $conn;
        private $table = 'post';


        //post properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //constructor with db connection
        public function __construct($db) {
            $this->conn = $db;
        }

        //getting all posts from db
        public function read() {
            //fetch query plus join post and categories table
            $query = 'SELECT c.name as category_name, 
                p.id, 
                p.category_id, 
                p.title, 
                p.body, 
                p.author, 
                p.created_at FROM 
                '.$this->table. ' p 
                LEFT JOIN 
                    categories c ON p.category_id = c.id
                    ORDER BY p.created_at DESC';

            //prepare statement
            $stmt = $this->conn->prepare($query);
            //execute query
            $stmt->execute();
            return $stmt;
        }

        //getting a single post from db
        public function read_single() {
            //fetch query plus join post and categories table
            $query = 'SELECT c.name as category_name, 
                p.id, 
                p.category_id, 
                p.title, 
                p.body, 
                p.author, 
                p.created_at FROM 
                '.$this->table. ' p 
                LEFT JOIN 
                    categories c ON p.category_id = c.id
                    WHERE p.id = ? LIMIT 1';

            //prepare statement
            $stmt = $this->conn->prepare($query);
            //binding param
            $stmt->bindParam(1, $this->id);
            //execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
        }

        Public function create() {
            //create query
            $query = 'INSERT INTO ' .$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id';
            //prepare statement
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            //binding of parameters
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);

            //execute query
            if($stmt->execute()) {
                return true;
            }

            //print error
            printf('Error %s. \n', $stmt->error);
            return false;
        }

    }
?>