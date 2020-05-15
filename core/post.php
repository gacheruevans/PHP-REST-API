<?php
    class Post {
        /* DB stuff */
        private $conn;
        private $table = 'post';


        /* Post properties */
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //Constructor with db connection
        public function __construct($db) {
            $this->conn = $db;
        }

        //Gets all posts from db
        public function read() {
            /* Fetch query plus join post and categories table */
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

            /* prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Execute query */
            $stmt->execute();
            return $stmt;
        }

        //Gets a single post from db
        public function read_single() {
            /* Fetch query plus join data from post and categories table */
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

            /* Prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Binding param */
            $stmt->bindParam(1, $this->id);

            /* Execute query */
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
        }

        //Creates a record
        Public function create() {
            /* Create query */
            $query = 'INSERT INTO ' .$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id';
            
            /* Prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Clean data */
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            /* Binding of parameters */
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);

            /* Execute query */
            if($stmt->execute()) {
                return true;
            }

            /* Print error */
            printf('Error %s. \n', $stmt->error);
            return false;
        }

        //Update a record
        Public function update() {
            /* Updtae query */
            $query = 'UPDATE ' .$this->table.' 
            SET title = :title, body = :body, author = :author, category_id = :category_id
            WHERE id = :id';

            /* Prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Clean data */
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            /* Binding of parameters */
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            /* Execute query */
            if($stmt->execute()) {
                return true;
            }

            /* Print error */
            printf('Error %s. \n', $stmt->error);
            return false;
        }
    }
?>
