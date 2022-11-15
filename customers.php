<?php
require_once 'config.php';
require_once 'head.php';

$query = 'SELECT * FROM customers';
$sql = $pdo->prepare($query);

if ($sql->execute()) {
    $customers = $sql->fetchALL(PDO::FETCH_ASSOC);
} else {
    $customers = [];
}

?>

<table class="table">
    <tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Surname</td>
        <td>E-mail</td>
        <td>Message</td>
    </tr>
    <?php
    foreach ($customers as $customer) : ?>
        <tr>
            <td><?php echo $customer['id']; ?></td>
            <td><?php echo $customer['first_name']; ?></td>
            <td><?php echo $customer['surname']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td><?php echo $customer['message']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
require_once 'foot.php';
?>