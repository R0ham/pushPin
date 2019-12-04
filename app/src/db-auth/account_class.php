<?php

class Account{
    private $id;
    private $name;
    private $authenticated;

    public function __construct(){
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = False;
    }

    // Destructor
    public function __destruct(){

    }

    //Add a new account to the system and return its ID (the account_id column of the accounts table)
 
    public function addAccount(string $name, string $passwd): int{
        // global $pdo object
        global $pdo;

        // trim the strings to remove extra spaces
        $name = trim($name);
        $passwd = trim($passwd);

        // check if the user name is valid. If not throw an exception
        if (!$this->isNameValid($name)){
            throw new Exception('Invalid user name');
        }

        // check password
        if (!$this->isPasswordValid($passwd)){
            throw new Exception('Invalid password');
        }

        if (!is_null($this->getIdFromName($name))){
            throw new Exception('User name not available');
        }

        /* add new account */

        $query = 'INSERT INTO pushpin.accounts (account_name, account_passwd) VALUES (:name, :passwd)';
        // password hash
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        // Values array for PDO
        $values = array(':name' => $name, ':passwd' => $hash);

        // execute the query
        try{
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){
            throw new Exception('addAccount: DB query error');
        }

        return $pdo->lastInsertID();
    }

    public function isNameValid(string $name): bool{
        $valid = TRUE;
        $len = mb_strlen($name);

        if (strpos($name, '@rpi.edu') === false){
            $valid = FALSE;
        }

        // potentially more checks

        return $valid;
    }

    public function isPasswordValid(string $passwd): bool{
        $valid = TRUE;
        $len = mb_strlen($passwd);

        if (($len < 8)){
            $valid = FALSE;
        }        
        return $valid;
    }

    public function getIdFromName($name): ?int{
        global $pdo;
        
        //  Since this method is public, we check $name again here
        if (!$this->isNameValid($name)){
            throw new Exception('Invalid user name');
        }

        $id = NULL;

        $query = 'SELECT account_id FROM pushpin.accounts WHERE (account_name = :name)';
        $value = array(':name' => $name);

        try{
            $res = $pdo->prepare($query);
            $res->execute($value);
        }
        catch (PDOException $e){
            throw new Exception('Database query error');
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (is_array($row)){
            $id = intval($row['account_id'], 10);
        }

        return $id;
    }

    /* Edit an account (selected by its ID). The name, the password and the status (enabled/disabled) can be changed */
    public function editAccount(int $id, string $name, string $passwd, bool $enabled){
        global $pdo;
        
        $name = trim($name);
        $passwd = trim($passwd);
        
        // Check if the ID is valid
        if (!$this->isIdValid($id)){
            throw new Exception('Invalid account ID');
        }
        
        /* Check if the user name is valid. */
        if (!$this->isNameValid($name))
        {
            throw new Exception('Invalid user name');
        }
        
        /* Check if the password is valid. */
        if (!$this->isPasswdValid($passwd)){
            throw new Exception('Invalid password');
        }
        
        //Check if an account having the same name already exists 
        $idFromName = $this->getIdFromName($name);
        
        if (!is_null($idFromName) && ($idFromName != $id)){
            throw new Exception('User name already used');
        }
        
        /* edit the account */
        
        // Edit query template 
        $query = 'UPDATE pushpin.accounts SET account_name = :name, account_passwd = :passwd, account_enabled = :enabled WHERE account_id = :id';
        
        // Password hash
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        
        //Int value for the $enabled variable (0 = false, 1 = true)
        $intEnabled = $enabled ? 1 : 0;
        
        // Values array for PDO
        $values = array(':name' => $name, ':passwd' => $hash, ':enabled' => $intEnabled, ':id' => $id);
        
        try{
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){
            throw new Exception('Database query error');
        }
    }

    public function isIdValid(int $id): bool{
        /* Initialize the return variable */
        $valid = TRUE;
        
        //Example check: the ID must be between 1 and 1000000 */        
        if (($id < 1) || ($id > 1000000)){
            $valid = FALSE;
        }
        
        // can add more checks here
        
        return $valid;
    }

    public function deleteAccount(int $id){
        global $pdo;
        
        if (!$this->isIdValid($id)){
            throw new Exception('Invalid account ID');
        }
        
        // Query template
        $query = 'DELETE FROM pushpin.accounts WHERE account_id = :id';
        
        // Values array for PDO
        $values = array(':id' => $id);
        
        // Execute the query
        try{
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){
            throw new Exception('Database query error');
        }

        // Delete the Sessions related to the account
        $query = 'DELETE FROM pushpin.account_sessions WHERE (account_id = :id)';

        $values = array(':id' => $id);

        // Execute the query
        try{
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){
            throw new Exception('Database query error');
        }
    }

    public function login(string $name, string $passwd): bool{
        global $pdo;

        $name = trim($name);
        $passwd = trim($passwd);

        if (!$this->isNameValid($name)){
            return FALSE;
        }

        if (!$this->isPasswordValid($passwd)){
            return FALSE;
        }

        // look for the account in the db
        $query = 'SELECT * FROM pushpin.accounts WHERE (account_name = :name) AND (account_enabled = 1)';
        $values = array(':name' => $name);

        try{
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){
            throw new Exception('login: DB query error');
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        // If there is a result, we must check if the password matches using password_verify()
        if (is_array($row)){
            if (password_verify($passwd, $row['account_passwd']))
            {
                // Authentication succeeded. Set the class properties (id and name)
                $this->id = intval($row['account_id'], 10);
                $this->name = $name;
                $this->authenticated = TRUE;
                
                // Register the current Sessions on the database
                $this->registerLoginSession();
                
                return TRUE;
            }
        }
        
        // If we are here, it means the authentication failed: return FALSE
        return FALSE;
    }

    /* Saves the current Session ID with the account ID */
    private function registerLoginSession(){
        global $pdo;
        
        // Check that a Session has been started
        if (session_status() == PHP_SESSION_ACTIVE)
        {
            /* 	Use a REPLACE statement to:
                - insert a new row with the session id, if it doesn't exist, or...
                - update the row having the session id, if it does exist.
            */
            $query = 'REPLACE INTO pushpin.account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
            $values = array(':sid' => session_id(), ':accountId' => $this->id);
            
            // Execute the query
            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e)
            {
            // If there is a PDO exception, throw a standard exception
            throw new Exception('Database query error');
            }
        }
    }

    /* Login using Sessions 
       We also want to set Session Cookie Lifetime parameter in 
       the PHP configuration (usually, the php.ini file) to 7 days
       7 days = 604800 seconds.
    */
    public function sessionLogin(): bool{
        global $pdo;
        
        /* Check that the Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE){
            /* 
                Query template to look for the current session ID on the account_sessions table.
                The query also make sure the Session is not older than 7 days
            */
            $query = 
            'SELECT * FROM pushpin.account_sessions, pushpin.accounts WHERE (account_sessions.session_id = :sid) ' . 
            'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
            'AND (accounts.account_enabled = 1)';
            
            // Values array for PDO
            $values = array(':sid' => session_id());
            
            // Execute the query
            try{
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e){
                throw new Exception('Database query error');
            }
            
            $row = $res->fetch(PDO::FETCH_ASSOC);
            
            if (is_array($row)){
                // Authentication succeeded. Set the class properties (id and name) and return TRU
                $this->id = intval($row['account_id'], 10);
                $this->name = $row['account_name'];
                $this->authenticated = TRUE;
                
                return TRUE;
            }
        }
        
        // If we are here, the authentication failed
        return FALSE;
    }

    /* Logout the current user */
    public function logout(){
        global $pdo;	
        
        // If there is no logged in user, do nothing
        if (is_null($this->id)){
            return;
        }
        
        // Reset the account-related properties
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;
        
        // If there is an open Session, remove it from the account_sessions table
        if (session_status() == PHP_SESSION_ACTIVE){
            // Delete query
            $query = 'DELETE FROM pushpin.account_sessions WHERE (session_id = :sid)';
            
            // Values array for PDO
            $values = array(':sid' => session_id());
            
            try{
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e){
                throw new Exception('Database query error');
            }
        }
    }

    /* "Getter" function for the $authenticated variable
    Returns TRUE if the remote user is authenticated */
    public function isAuthenticated(): bool{
        return $this->authenticated;
    }

    /* Close all account Sessions except for the current one (aka: "logout from other devices") */
    public function closeOtherSessions()
    {
        global $pdo;
        
        // If there is no logged in user, do nothing
        if (is_null($this->id)){
            return;
        }
        
        // Check that a Session has been started
        if (session_status() == PHP_SESSION_ACTIVE){
            // Delete all account Sessions with session_id different from the current one
            $query = 'DELETE FROM myschema.account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';
            
            // Values array for PDO
            $values = array(':sid' => session_id(), ':account_id' => $this->id);
            
            // Execute the query
            try{
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e){
                throw new Exception('Database query error');
            }
        }
    }
}

?>