<?php
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
} else {
    $message = null;
}
?>

<?php if ($message && isset($message['text'])) : ?>
<div class="alert alert-<?php echo isset($message['type']) ? $message['type'] : ''; ?> alert-dismissible fade <?php echo isset($message['show']) ? $message['show'] : ''; ?>"
    role="alert">
    <?php if (isset($message['icon'])) : ?>
    <i class="fa fa-<?php echo $message['icon']; ?>"></i>
    <?php endif; ?>
    <?php echo $message['text']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>