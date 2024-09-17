<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Vennligst legg inn brukernavn";
    } else{
        // Prepare a select statement
        $sql = "SELECT brukerID FROM bruker WHERE brukernavn = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Brukernavnet er tatt";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Det funka ikke gitt!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Vennligst legg inn passord";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Passord må ha minst 6 bokstaver";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Venligst bekreft passord";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "passord matcher ikke ";
        }
    }
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO bruker (brukernavn, passord) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Her ble det litt problemer gitt!";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    
    // Close connection
    mysqli_close($link);
}

$tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
$sql2="SELECT email, fornavn, etternavn, telefonnummer FROM bruker";
$datasett = $tilkobling->query($sql2);

if(isset($_POST["submit"]))
{
    $sql2 =sprintf("INSERT INTO bruker (email, fornavn, etternavn, telefonnummer) VALUES ('%s','%s','%s','%s')",

    $tilkobling->real_escape_string($_POST["txtMail"]),
    $tilkobling->real_escape_string($_POST["txtFornavn"]),
    $tilkobling->real_escape_string($_POST["txtEtternavn"]),
    $tilkobling->real_escape_string($_POST["txtTlf"]),

         );
    
        $tilkobling->query($sql2);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>

</head>

<body>
    <div class="wrapper">
        <h2>Registrer</h2>
        <p>Lag ny bruker</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Brukernavn</label>
                <input type="text" name="username"
                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="txtMail">E-post adresse:</label>
                <input type="email" name="txtMail" />
            </div>
            <div class="form-group">
                <label for="txtFornavn">Fullt navn:</label>
                <div id="name_input">
                    <input type="text" name="txtFornavn" />
                    <input type="text" name="txtEtternavn" />
                </div>
            </div>  
            <div class="form-group">
                <label for="txtTlf">telefonnummer:</label>
                <input type="tel" name="txtTlf" />
            </div>
            <div class="form-group">
                <label>Passord</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Bekreft Passord</label>
                <input type="password" name="confirm_password"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Har du allerede bruker? <a href="login.php">Logg inn her</a>.</p>
        </form>
    </div>
</body>

</html>