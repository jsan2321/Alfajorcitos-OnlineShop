<div class="box-container">
    <?php
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ? LIMIT 6");
        $select_products->execute(['active']);

        if($select_products->rowCount() > 0) {
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {           
    ?>

    <form action="" method="post" class="box" <?php if($fetch_products['stock'] == 0){echo 'disabled';} ?> >
        <img src="uploaded_files/<?= $fetch_products['image']; ?>" >
        <?php if($fetch_products['stock'] > 9){ ?>
            <span class="stock" style="color:green;" >In stock</span>
        <?php }elseif($fetch_products['stock'] == 0){ ?>
            <span class="stock" style="color:red;" >Out of stock</span>
        <?php }else{ ?>
            <span class="stock" style="color:red;" >Hurrey Only <?= $fetch_products['stock']; ?> Left</span>
        <?php } ?>
    </form>

    <?php
            }
        } else {
            echo '    
                <div class="empty" >
                    <p>no products added yet!</p>
                </div>
            ';
        }
    ?>
</div>
