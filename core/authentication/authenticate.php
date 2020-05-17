<?php
    class Authenticate {
        /* DB stuff */
        private $conn;
        private $table = 'users';


        /* Post properties */
        public $id;
        public $fname;
        public $lname;
        public $email;
        public $password;

        //Constructor with db connection
        public function __construct($db) {
            $this->conn = $db;
        }

        //User Login
        public function login() {
            /* Fetch query for user data */
            $query = 'SELECT id, fname, lname, email, password FROM '.$this->table.' WHERE email = :email';

            /* Prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Clean/sanitize Data*/
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $posted_pass = $this->password;

            /* Binding param */
            $stmt->bindParam(':email', $this->email);

            /* Execute query*/
            if($stmt->execute()) {
                // Fetch password from db
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $dbpassword = $row['password'];

                //Password verification
                if (password_verify($posted_pass, $dbpassword)) {
                    // get number of rows
                    $num = $stmt->rowCount();
                       
                    if($num > 0) {
                        $post_arr = array();
                        $post_arr['data'] = array();
                   
                        $post_item = array(
                            $this->id = $row['id'],
                            $this->fname = $row['fname'],
                            $this->lname = $row['lname'],
                            $this->email = $row['email']
                        ); 
                        array_push($post_arr['data'], $post_item);
                        
                        /* Convert to JSON and display output */
                        echo json_encode($post_arr);

                    }else{
                        echo json_encode(array('Message' => 'No User Found.'));
                    }
                }
                else {
                   echo 'Invalid user and password combination';
                }
                
            }else {
                /* Print error */
                printf('Error %s. \n', $stmt->error);
                return false;
            }
        }

        //Register New User
        Public function register() {
            /* Create query */
            $query = 'INSERT INTO ' .$this->table.' SET fname = :fname, lname = :lname, email = :email, password = :password';
            
            /* Prepare statement */
            $stmt = $this->conn->prepare($query);

            /* Clean data */
            $this->fname = htmlspecialchars(strip_tags($this->fname));
            $this->lname = htmlspecialchars(strip_tags($this->lname));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            //Hash password
            $hashed_pass = password_hash($this->password, PASSWORD_BCRYPT);

            /* Binding of parameters */
            $stmt->bindParam(':fname', $this->fname);
            $stmt->bindParam(':lname', $this->lname);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashed_pass);

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
