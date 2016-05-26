
<div class="nav-container custom-back1 remove-margin">
	  <ul class="nav">
        <?php foreach ($data["category"] as $key => $num) : ?>
            <?php if($key == "0") { ?>
                <li class="active">
            <?php } else { ?>
                <li>
            <?php } ?>
                <a href="#">
                    <span class="text"><?= htmlspecialchars($num) ?></span>
                </a>
            </li>
        <?php endforeach ?>
      </ul>
</div>