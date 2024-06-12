<li><a href="#">Category <i class="fa-solid fa-angle-down"></i></a>
    <ul class="subMenu">
        <?php
        $query = "SELECT * FROM new_category WHERE status=1";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            while ($category = mysqli_fetch_assoc($query_run)) {
                ?>
                <li><a href="#"><?= $category['name']; ?></a>
                    <ul class="superSubMenu" id="superSubMenu">
                        <?php
                        $category_id = $category['id'];
                        $product_query = "SELECT pn.product_name 
                                          FROM product_new pn 
                                          JOIN new_category nc ON pn.category_id = nc.id 
                                          WHERE pn.status = 1 AND nc.status = 1 AND pn.category_id = $category_id";
                        $product_query_run = mysqli_query($conn, $product_query);
                        if (mysqli_num_rows($product_query_run) > 0) {
                            while ($product = mysqli_fetch_assoc($product_query_run)) {
                                ?>
                                <li><a href="#"><?= $product['product_name']; ?></a></li>
                                <?php
                            }
                        } else {
                            echo "<li>No products found</li>";
                        }
                        ?>
                    </ul>
                </li>
                <?php
            }
        } else {
            echo "<li>No categories found</li>";
        }
        ?>
    </ul>
</li>

// IMportant query_run

$query= "SELECT pn.*, nc.*
FROM users pn
JOIN delegate_profile nc ON pn.id = nc.user_id";



SELECT pn.*, nc.title, nc.first_name, nc.last_name
FROM users pn
LEFT JOIN delegate_profile nc ON pn.id = nc.user_id