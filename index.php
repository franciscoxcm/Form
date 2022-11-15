<?php
require_once 'head.php';
require_once 'config.php';


$message = "";
$color = "";

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $con = mysqli_connect("localhost", "root", "", "programming");
    $sql = mysqli_query($con, "SELECT * FROM customers WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $message = "The email already exists";
        $color = "text-danger";
    } else {
        if (
            !empty($_POST['first_name']) &&
            !empty($_POST['surname']) &&
            !empty($_POST['email'])
        ) {
            $query = 'INSERT INTO customers (first_name, surname, email, message) VALUES (?, ?, ?, ?)';
            $sql = $pdo->prepare($query);
            if ($sql->execute([
                $_POST['first_name'],
                $_POST['surname'],
                $_POST['email'],
                $_POST['message']
            ]));
            $message = "You added a customer";
            $color = "text-success";
        } else {
            $message = "You did not fill in all fields";
            $color = "text-danger";
        }
    }
}
?>
<div class="container">
    <div class="d-flex justify-content-center form-control">
        <form class="form" method="POST" action="index.php">

            <h2 class="card-header">Add Customers</h2>
            <br>
            <div class="mb-3">
                <label class="form-label">Your First Name</label>
                <input class="form-control" type="text" name="first_name" placeholder="First Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Your Surname</label>
                <input class="form-control" type="text" name="surname" placeholder="Surname">
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail address</label>
                <input class="form-control" type="email" required="e-mail" name="email" placeholder="E-mail Address">
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" id="" name="message"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="mb-3">
                <p class="<?php echo ($color) ?>"><?php echo ($message); ?></p>
            </div>
        </form>
    </div>
</div>
<?php
require_once 'foot.php';
?>