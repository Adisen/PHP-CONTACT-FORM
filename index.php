<?php
    /**
     * Created by PhpStorm.
     * User: israel
     * Date: 11/1/18
     * Time: 6:39 AM
     */
    //Check for submit
    //Message vars
    $msg = '';
    $msgClass = '';
    if (filter_has_var(INPUT_POST, 'submit')){
        //Get data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        //Check required fields
        if (!empty($email) && !empty($name) && !empty($message)){
            //PASSED
            //Check Email
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                //failed
                $msg = 'Please input a valid email';
                $msgClass = 'alert-danger';
            } else {
                //Passed
                $toEmail = 'adisen230@gmail.com';
                $subject = 'Contact Request From '.$name;
                $body = '<h2>Contact Request</h2>
                    <h4>Name</h4><p>'.$name.'</p>
                    <h4>Email</h4><p>'.$email.'</p>
                    <h4>Message</h4><p>'.$message.'</p>';
                //Email Headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                //Additional Headers
                $headers .= "From: " .$name. "<".$email.">". "\r\n";

                if (mail($toEmail, $subject, $body, $headers)){
                    $msg = 'Your request has been sent';
                    $msgClass = 'alert-success';
                } else {
                    $msg = 'Note that your message was not sent';
                    $msgClass = 'alert-danger';
                }
            }
        } else {
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>phpTutorial</title>
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">My Website</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name :
                 ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email
                : ''; ?>">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ?
                    $message :
                    ''; ?></textarea>
            </div>
            <?php if ($msg != ""): ?>
                <div class="alert <?php echo $msgClass; ?> "> <?php echo $msg; ?> </div>
            <?php endif; ?>
            <br>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </form>
    </div>
    </body>
</html>